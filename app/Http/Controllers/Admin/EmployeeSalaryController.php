<?php

namespace App\Http\Controllers\Admin;

use App\Models\AddChild;
use App\Models\Employee;
use App\Models\Treasury;
use Illuminate\Http\Request;
use App\Models\EmployeeSalary;
use App\Models\TreasuryProcess;
use App\Http\Controllers\Controller;

class EmployeeSalaryController extends Controller
{
    //
    public function create()
    {
        $employees = Employee::where('delete_at', 0)->get();
        $treasuries = Treasury::where('delete_at', 0)->where('active', 1)->get();
        $employeeSalaries = EmployeeSalary::where('delete_at', 0)->get();
        return view('admin.pages.employeeSalaries.create', compact('employeeSalaries', 'employees', 'treasuries'));
    }

    public function store(Request $request)
    {
        $treasury_balance = Treasury::where('id', $request->treasury_id)->value('balance');
        if ($request->total_salary > $treasury_balance) {
            return redirect()->back()->with(['error' => "رصيد الخزنة لا يسمح"]);
        } else {
            EmployeeSalary::create([
                'date' => $request->date,
                'employee_id' => $request->employee_id,
                'treasury_id' => $request->treasury_id,
                'main_salary' => $request->main_salary,
                'job_type' => $request->job_type,
                'reward' => $request->reward,
                'reward_reason' => $request->reward_reason,
                'absent_day' => $request->absent_day,
                'discount' => $request->discount,
                'total_salary' => $request->total_salary,
            ]);
            Treasury::where('id', $request->treasury_id)->update([
                'balance' => $treasury_balance - $request->total_salary,
            ]);

            $name = Employee::where('id', $request->employee_id)->value('name_ar');
            // $child = AddChild::where('id',$request->child_id)->value('name_ar');

            TreasuryProcess::create([
                'date' => $request->date,
                'employee_id' => $request->employee_id,
                'treasury_id' => $request->treasury_id,
                'credit' => $request->total_salary,
                'comment' => ' صرف راتب الموظف ' . '' . $name,
            ]);

            return redirect()->back()->with(['success' => " تم  بنجاح"]);
        }
    }

    public function edit($id)
    {
        $employees = Employee::where('delete_at', 0)->get();
        $treasuries = Treasury::where('delete_at', 0)->where('active', 1)->get();
        $employeeSalaries = EmployeeSalary::findOrFail($id);
        return view('admin.pages.employeeSalaries.edit', compact('employeeSalaries', 'employees', 'treasuries'));
    }

    public function update(Request $request, $id)
    {
        $employeeSalary = EmployeeSalary::findOrFail($id);
        $treasury_balance = Treasury::where('delete_at', 0)->where('id', $request->treasury_id)->value('balance');
        $employeeSalary_totalSalary = EmployeeSalary::where('delete_at', 0)
            ->where('employee_id', $request->employee_id)
            ->where('treasury_id', $request->treasury_id)
            ->value('total_salary');
        $data = $employeeSalary_totalSalary - $request->total_salary;
        if ($request->total_salary > $treasury_balance) {
            return redirect()->back()->with(['error' => "رصيد الخزنة لا يسمح"]);
        } else {
            Treasury::where('id', $request->treasury_id)->update([
                'balance' => $treasury_balance + $data,
            ]);
            $employeeSalary->update([
                'date' => $request->date,
                'employee_id' => $request->employee_id,
                'treasury_id' => $request->treasury_id,
                'main_salary' => $request->main_salary,
                'job_type' => $request->job_type,
                'reward' => $request->reward,
                'reward_reason' => $request->reward_reason,
                'absent_day' => $request->absent_day,
                'discount' => $request->discount,
                'total_salary' => $request->total_salary,
            ]);
            TreasuryProcess::create([
                'date' => $request->date,
                'employee_id' => $request->employee_id,
                'treasury_id' => $request->treasury_id,
                'credit' => $request->total_salary,
                'comment' => 'تعديل صرف رواتب الموظفين',
            ]);
            return redirect()->route('employeeSalary.create')->with(['success' => "تم التحديث بنجاح"]);
        }
    }

    public function destroy($id)
    {
        $employeeSalary = EmployeeSalary::findOrFail($id);
        $salary = EmployeeSalary::where('delete_at', 0)->where('id', $id)->value('total_salary');
        $treasury_id = EmployeeSalary::where('delete_at', 0)->where('id', $id)->value('treasury_id');
        $balance = Treasury::where('delete_at', 0)->where('id', $treasury_id)->value('balance');
        Treasury::where('delete_at', 0)->where('id', $treasury_id)->update([
            'balance' => $balance + $salary,
        ]);
        $employeeSalary->update([
            'delete_at' => 1,
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }

    public function employeeSalaryAjax($id)
    {
        $employeeSalaryAjax = Employee::where('id', $id)->value('main_salary');
        return json_encode($employeeSalaryAjax);
    }

    public function employeeJobAjax($id)
    {
        $employeeJobAjax = Employee::where('id', $id)->value('employee_type');
        return json_encode($employeeJobAjax);
    }
}
