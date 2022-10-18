<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    public function create(){
        $employees = Employee::where('delete_at',0)->get();
        return view('admin.pages.employees.create' , compact('employees'));
    }

    public function store(Request $request){
        $insurance = 0;
        if($request->insurance == 1){
            $insurance = 1;
        }
        Employee::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'id_number' => $request->id_number,
            'address' => $request->address,
            'tel1' => $request->tel1,
            'tel2' => $request->tel2,
            'educational_qualification' => $request->educational_qualification,
            'graducation_date' => $request->graducation_date,
            'employee_type' => $request->employee_type,
            'hiring_date' => $request->hiring_date,
            'main_salary' => $request->main_salary,
            'insurance' => $insurance,
            'insurance_date' => $request->insurance_date,
        ]);
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id){
        $employees = Employee::findOrFail($id);
        return view('admin.pages.employees.edit' , compact('employees'));
    }

    public function update(Request $request ,$id){
        $employees = Employee::findOrFail($id);
        $insurance = 0;
        if($request->insurance == 1){
            $insurance = 1;
        }
        $employees->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'id_number' => $request->id_number,
            'address' => $request->address,
            'tel1' => $request->tel1,
            'tel2' => $request->tel2,
            'educational_qualification' => $request->educational_qualification,
            'graducation_date' => $request->graducation_date,
            'employee_type' => $request->employee_type,
            'hiring_date' => $request->hiring_date,
            'main_salary' => $request->main_salary,
            'insurance' => $insurance,
            'insurance_date' => $request->insurance_date,
        ]);
        return redirect()->route('employee.create')->with(['success' => "تم التحديث بنجاح"]);
    }

    public function destroy($id){
        $employees = Employee::findOrFail($id);
        $employees->update([
            'delete_at'=>1,
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }
}
