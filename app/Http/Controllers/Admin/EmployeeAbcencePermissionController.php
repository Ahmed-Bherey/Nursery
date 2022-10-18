<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeAbcencePermission;
use Illuminate\Http\Request;

class EmployeeAbcencePermissionController extends Controller
{
    //
    public function create()
    {
        $employees = Employee::where('delete_at', 0)->get();
        $employeeAbcencePermissions = EmployeeAbcencePermission::where('delete_at', 0)->get();
        return view('admin.pages.employeeAbcencePermissions.create', compact('employeeAbcencePermissions', 'employees'));
    }

    public function store(Request $request)
    {
        foreach ($request->data['employee_id'] as $key => $value) {
        EmployeeAbcencePermission::create([
            'date' => $request->date,
            'type' => $request->type,
            'employee_id' => $value,
            'absence_reason' => $request->absence_reason,
        ]);
    }
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id)
    {
        $employees = Employee::get();
        $employeeAbcencePermissions = EmployeeAbcencePermission::findOrFail($id);
        return view('admin.pages.employeeAbcencePermissions.edit', compact('employeeAbcencePermissions', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $employeeAbcencePermissions = EmployeeAbcencePermission::findOrFail($id);
        $employeeAbcencePermissions->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'id_number' => $request->id_number,
            'address' => $request->address,
            'tel' => $request->tel,
            'educational_qualification' => $request->educational_qualification,
            'graducation_date' => $request->graducation_date,
            'employee_type' => $request->employee_type,
            'hiring_date' => $request->hiring_date,
            'main_salary' => $request->main_salary,
        ]);
        return redirect()->route('employeeAbcencePermission.create')->with(['success' => "تم التحديث بنجاح"]);
    }

    public function destroy($id)
    {
        $employeeAbcencePermissions = EmployeeAbcencePermission::findOrFail($id);
        $employeeAbcencePermissions->update([
            'delete_at' => 1,
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }

    public function employeeAbcencePermissionAjax($date)
    {
        $data = Employee::whereDoesntHave('employeeAbcencePermissions', function ($x) use ($date) {
            $x->where('date', $date)->where('delete_at', 0);
        })->get();
        return json_encode($data);
    }
}
