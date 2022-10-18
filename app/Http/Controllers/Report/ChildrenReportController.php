<?php

namespace App\Http\Controllers\Report;

use App\Models\Leavel;
use App\Models\Absence;
use App\Models\AddChild;
use App\Models\Employee;
use App\Models\Treasury;
use App\Models\ChildRoom;
use App\Models\Classroom;
use App\Models\SellUniform;
use Illuminate\Http\Request;
use App\Models\DaycareSettieng;
use App\Models\EducationalYear;
use App\Models\TreasuryProcess;
use App\Models\ChildRegistration;
use App\Models\EducationalExpenses;
use App\Http\Controllers\Controller;
use App\Models\EmployeeAbcencePermission;
use App\Models\EducationalExpensesCollection;

class ChildrenReportController extends Controller
{
    // استمارة الطفل
    public function clildIndex()
    {
        $children = AddChild::get();
        $levels = Leavel::where('delete_at', 0)->get();
        return view('admin.pages.reports.childrenReport.childForm.index', compact('levels', 'children'));
    }

    public function childRegistrationChildrenAjax($id)
    {
        $childRoom = ChildRoom::where('level_id', $id)->with('add_chlids')->get();
        return json_encode($childRoom);
    }

    public function clildShow(Request $request)
    {
        $children = AddChild::get();
        $levels = Leavel::where('delete_at', 0)->get();
        $daycareSettieng = DaycareSettieng::first();
        $educationalYears = EducationalYear::where('active', 1)->get();
        $childRegistrations = ChildRegistration::where('level_id', $request->student_level)
            ->where('child_id', $request->child_id)
            ->where('delete_at', 0)
            ->first();
        return view('admin.pages.reports.childrenReport.childForm.index', compact('childRegistrations','children','levels', 'educationalYears', 'daycareSettieng'));
    }

    // عرض كل الاطفال
    public function clildrenData(Request $request)
    {
        $daycareSettieng = DaycareSettieng::first();
        $children = ChildRegistration::with('children')->paginate(13);
        return view('admin.pages.reports.childrenReport.childrenData.index', compact('children', 'daycareSettieng'));
    }

    // اطفال كل مرحلة
    public function childLevelIndex()
    {
        $children = AddChild::get();
        $levels = Leavel::where('delete_at', 0)->get();
        $childRegistration = ChildRegistration::get();
        return view('admin.pages.reports.childrenReport.childLevel.index', compact('childRegistration', 'levels', 'children'));
    }

    public function childLevelShow(Request $request)
    {
        $daycareSettieng = DaycareSettieng::first();
        $childRegistrations = ChildRegistration::where('level_id', $request->student_level)->paginate(17);
        $Level = Leavel::find($request->student_level);

        $children = AddChild::get();
        $levels = Leavel::where('delete_at', 0)->get();
        $childRegistration = ChildRegistration::get();
        return view('admin.pages.reports.childrenReport.childLevel.index', compact('childRegistrations','children','levels','childRegistration','daycareSettieng','Level'));
    }

    // تقرير سداد الرسوم
    public function childDontPaidIndex()
    {
        $levels = Leavel::where('delete_at', 0)->get();
        $educationalExpenses = EducationalExpenses::where('delete_at', 0)->get();
        return view('admin.pages.reports.accounts.childDontPaid.index', compact('levels', 'educationalExpenses'));
    }

    public function childDontPaidShow(Request $request)
    {
        $daycareSettieng = DaycareSettieng::first();
        $expenses_type = $request->expenses_type;
        $request_level = $request->level_id;
        $Level = Leavel::find($request->level_id);
        $educationalExpense = EducationalExpenses::find($request->expenses_type);
        $levels = Leavel::where('delete_at', 0)->get();
        $educationalExpenses = EducationalExpenses::where('delete_at', 0)->get();

        $educationalExpensess = EducationalExpensesCollection::where('level_id',$request->level_id)
        ->where('expenses_id',$request->expenses_type)
        ->paginate(22);

        return view('admin.pages.reports.accounts.childDontPaid.index', compact('educationalExpensess','educationalExpenses','levels', 'Level', 'educationalExpense', 'daycareSettieng'));
    }

    public function educationalExpenseAjax($id)
    {
        $educationalExpenseAjax = EducationalExpenses::where('level_id', $id)->with('leavels')->get();
        return json_encode($educationalExpenseAjax);
    }

    // تقرير غياب واستأذان الاطفال
    public function absenceIndex()
    {
        $classRooms = Classroom::where('delete_at', 0)->get();
        return view('admin.pages.reports.childrenReport.absence.index', compact('classRooms'));
    }

    public function absenceShow(Request $request)
    {
        $daycareSettieng = DaycareSettieng::first();
        $level = Leavel::find($request->student_level);
        $absences = Absence::where('delete_at', 0)
            ->where('classroom_id', $request->classroom_id)
            ->where('addChild_id', $request->addChild_id)
            ->where('date', '>=', $request->dateFrom)
            ->where('date', '<=', $request->dateTo)
            ->paginate(20);
        $classroom = Classroom::find($request->classroom_id);
        $children = AddChild::find($request->addChild_id);
        $classRooms = Classroom::where('delete_at', 0)->get();
        return view('admin.pages.reports.childrenReport.absence.index', compact('absences','classRooms', 'classroom', 'daycareSettieng', 'level', 'children'));
    }

    // تقرير حركات الخزنة
    public function tressuryProcessIndex()
    {
        $treasuries = Treasury::where('delete_at', 0)->get();
        return view('admin.pages.reports.treasuryProcess.index', compact('treasuries'));
    }

    public function tressuryProcessShow(Request $request)
    {
        $daycareSettieng = DaycareSettieng::first();
        $treasuryName_id = Treasury::find($request->treasury_id);
        // dd($treasuryName_id->name);
        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;
        $treasury_process = TreasuryProcess::where('date', '>=', $request->dateFrom)
            ->where('date', '<=', $request->dateTo)
            ->where('treasury_id', $request->treasury_id)
            ->paginate(20);
            $price = SellUniform::where('buyUniform_id', 3)->value('subTotal');
            $treasuries = Treasury::where('delete_at', 0)->get();
        return view('admin.pages.reports.treasuryProcess.index', compact('treasury_process','treasuries','price','dateFrom','dateTo','treasuryName_id','daycareSettieng'));
    }

    // اطفال كل قاعة
    public function classRoomStudents()
    {
        $classRooms = Classroom::where('delete_at', 0)->get();
        return view('admin.pages.reports.classRoomStudents.index', compact('classRooms'));
    }

    public function classRoomStudentShow(Request $request)
    {
        $daycareSettieng = DaycareSettieng::first();
        $students = ChildRoom::where('classRoom_id', $request->classRoom_id)->where('delete_at', 0)->paginate(20);
        $classRoom = Classroom::find($request->classRoom_id);

        $studentCount1 = ChildRoom::whereHas('add_chlids', function ($x) {
            $x->where('religion', 1);
        })->where('classRoom_id', $request->classRoom_id)->where('delete_at', 0)->count();

        $studentCount2 = ChildRoom::whereHas('add_chlids', function ($x) {
            $x->where('religion', 2);
        })->where('classRoom_id', $request->classRoom_id)->where('delete_at', 0)->count();

        $boys = ChildRoom::whereHas('add_chlids', function ($x) {
            $x->whereHas('childRegistrations', function ($x) {
                $x->where('gender', 'ذكر');
            });
        })->where('classRoom_id', $request->classRoom_id)->where('delete_at', 0)->count();

        $girls = ChildRoom::whereHas('add_chlids', function ($x) {
            $x->whereHas('childRegistrations', function ($x) {
                $x->where('gender', 'انثي');
            });
        })->where('classRoom_id', $request->classRoom_id)->where('delete_at', 0)->count();

        $classRooms = Classroom::where('delete_at', 0)->get();

        $total = ChildRoom::where('classRoom_id', $request->classRoom_id)->where('delete_at', 0)->count();
        return view('admin.pages.reports.classRoomStudents.index', compact('students', 'classRoom','classRooms', 'daycareSettieng', 'girls', 'boys', 'studentCount2', 'studentCount1', 'total'));
    }

    // تقرير غياب الموظفين
    public function employeeAbsenceIndex()
    {
        $employees = Employee::where('delete_at', 0)->get();
        return view('admin.pages.reports.employees.index', compact('employees'));
    }

    public function employeeAbsenceShow(Request $request)
    {
        $daycareSettieng = DaycareSettieng::first();
        $absences = EmployeeAbcencePermission::where('delete_at', 0)
            ->where('employee_id', $request->employee_id)
            ->where('date', '>=', $request->dateFrom)
            ->where('date', '<=', $request->dateTo)
            ->paginate(20);
        $employeess = Employee::find($request->employee_id);
        $employees = Employee::where('delete_at', 0)->get();
        return view('admin.pages.reports.employees.index', compact('absences','employeess', 'daycareSettieng', 'employees'));
    }
}
