<?php

namespace App\Http\Controllers\Admin;

use App\Models\Leavel;
use Illuminate\Http\Request;
use App\Models\EducationalYear;
use App\Models\TreasuryProcess;
use App\Models\ChildRegistration;
use App\Models\IndebtednessLevel;
use App\Models\IndebtednesProcess;
use App\Models\EducationalExpenses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndebtednessLevelController extends Controller
{
    //
    public function create()
    {
        $year_id = EducationalYear::where('delete_at', 0)
            ->where('active', 1)
            ->value('id');

        if ($year_id < 0) {
            return redirect()
                ->back()
                ->with(['success' => ' تاكد من وجود سنه مفعله ']);
        }
        $years = EducationalYear::get();
        $IndebtednessLevels = IndebtednessLevel::where('delete_at', 0)
            ->where('year_id', $year_id)
            ->groupBy(['name', 'level_id'])
            ->get();
        $levels = Leavel::where('delete_at', 0)->get();
        $educationalExpenses = EducationalExpenses::where('delete_at', 0)
            ->where('educationalYear_id', $year_id)
            ->get();
        return view(
            'admin.pages.indebtednessLevel.create',
            compact('IndebtednessLevels', 'educationalExpenses', 'levels', 'years')
        );
    }

    public function store(Request $request)
    {
        $year_id = EducationalYear::where('delete_at', 0)
            ->where('active', 1)
            ->value('id');
        if ($year_id < 0) {
            return redirect()
                ->back()
                ->with(['success' => ' تاكد من وجود سنه مفعله ']);
        }
        if (
            ChildRegistration::where('delete_at', 0)
            ->where('level_id', $request->level_id)
            ->count() < 1
        ) {
            return redirect()
                ->back()
                ->with(['success' => 'تاكد من وجود طلاب بهذه المرحله ']);
        }

        foreach (ChildRegistration::where('delete_at', 0)->where('level_id', $request->level_id)->get() as $child) {

            foreach ($request->educationalExpense_id as $educationalExpense) {
                $amount = EducationalExpenses::where('delete_at', 0)
                    ->where('educationalYear_id', $year_id)
                    ->where('id', $educationalExpense)
                    ->value('amount');
                IndebtednessLevel::updateOrCreate([
                    'name' => $request->name,
                    'level_id' => $request->level_id,
                    'year_id' => $year_id,
                    'child_id' => $child->child_id,
                    'educationalExpense_id' => $educationalExpense
                ], [
                    'amount' => $amount,
                    'note' => $request->note,
                ]);
            }
        }

        foreach (ChildRegistration::where('delete_at', 0)->where('level_id', $request->level_id)->get() as $child) {
            IndebtednesProcess::create([
                'user_id' => Auth::user()->id,
                'year_id' => $request->year_id,
                'level_id' => $request->level_id,
                'child_id' => $child->id,
                'educationalExpense_id' => $educationalExpense,
                'credit' => $amount,
                'debt' => 0,
            ]);
        }
        return redirect()
            ->back()
            ->with(['success' => ' تم  بنجاح']);
    }

    public function edit($id)
    {
        $years = EducationalYear::get();
        $year_id = EducationalYear::where('delete_at', 0)
            ->where('active', 1)
            ->value('id');
        if ($year_id < 0) {
            return redirect()
                ->back()
                ->with(['success' => ' تاكد من وجود سنه مفعله ']);
        }
        $levels = Leavel::get();
        $educationalExpenses = EducationalExpenses::where('delete_at', 0)
            ->where('educationalYear_id', $year_id)
            ->get();
        $IndebtednessLevel = IndebtednessLevel::find($id);
        return view(
            'admin.pages.indebtednessLevel.edit',
            compact('levels', 'educationalExpenses', 'IndebtednessLevel', 'years')
        );
    }

    public function update(Request $request, $id)
    {
        IndebtednessLevel::where('id', $id)->update([
            'amount' => $request->amount,
            'note' => $request->note,
        ]);

        return redirect()
            ->route('IndebtednessLevels.create')
            ->with(['success' => 'تم التحديث بنجاح']);
    }

    public function destroy($name, $level_id)
    {
        IndebtednessLevel::where('delete_at', 0)
            ->where('name', $name)
            ->where('level_id', $level_id)
            ->update([
                'delete_at' => 1,
            ]);

        return redirect()
            ->back()
            ->with(['success' => 'تم الحذف بنجاح']);
    }
    public function delete($id)
    {
        IndebtednessLevel::where('id', $id)->update([
            'delete_at' => 1,
        ]);
        return redirect()
            ->back()
            ->with(['success' => 'تم الحذف بنجاح']);
    }

    public function show($name, $level_id)
    {
        $year_id = EducationalYear::where('delete_at', 0)
            ->where('active', 1)
            ->value('id');
        if ($year_id < 0) {
            return redirect()
                ->back()
                ->with(['success' => ' تاكد من وجود سنه مفعله ']);
        }
        $IndebtednessLevels = IndebtednessLevel::where('delete_at', 0)
            ->where('year_id', $year_id)
            ->where('name', $name)
            ->where('level_id', $level_id)
            ->get();
        $educationLevelName = IndebtednessLevel::where('delete_at', 0)
            ->where('year_id', $year_id)
            ->where('name', $name)
            ->where('level_id', $level_id)
            ->value('name');
        return view(
            'admin.pages.indebtednessLevel.show',
            compact('IndebtednessLevels', 'educationLevelName')
        );
    }

    public function ajaxLevel($id)
    {
        $year_id = EducationalYear::where('delete_at', 0)
            ->where('active', 1)
            ->value('id');
        $data = EducationalExpenses::where('delete_at', 0)
            ->where('educationalYear_id', $year_id)
            ->where('level_id', $id)
            ->get();
        return json_encode($data);
    }

    public function ajaxAmount($level, $id)
    {
        $year_id = EducationalYear::where('delete_at', 0)
            ->where('active', 1)
            ->value('id');
        $ajaxAmount = EducationalExpenses::where('delete_at', 0)
            ->where('level_id', $level)
            ->where('educationalYear_id', $year_id)
            ->where('id', $id)
            ->value('amount');
        return $ajaxAmount;
        return json_encode($ajaxAmount);
    }

    public function ajaxYear($id)
    {
        $ajaxYear = EducationalExpenses::where('educationalYear_id', $id)->groupBy(['level_id'])->with('leavels')->get();
        return json_encode($ajaxYear);
    }

    //public function  ajax($id){
    //
    //    $data=EducationalExpenses::where('id',$id)->value('amount');
    //    return json_encode($data);
    //
    //}
}

// <script type="text/javascript">
// $(document).ready(function () {
//     $('select[name="roomType"]').on('change', function () {
//         var stateID = $(this).val();
//         var csrf = $('meta[name="csrf-token"]').attr('content');

//         var route =
//             '{{ route('admin.reservation.rate.ajax', ['id' => ':id', 'hotel' => ':hotel', 'from' => ':from', 'nights_no' => ':nights_no', 'meal' => ':meal', 'category' => ':category']) }}';
//         route = route.replace(':id', stateID).replace(':hotel', $('#hotel option:selected').val())
//             .replace(':from', $('input[name="from"]').val()).replace(':nights_no', $(
//                 'input[name="nights_no"]').val()).replace(
//                 ':meal', $('#meal option:selected').val()).replace(':category', $(
//                 '#category option:selected').val())

//         if (stateID) {
//             $.ajax({
//                 beforeSend: function (x) {
//                     return x.setRequestHeader('X-CSRF-TOKEN', csrf);
//                 },
//                 url: route,
//                 type: "GET",
//                 dataType: "json",

//                 success: function (data) {
//                     $('#rate').val(data);

//                     $('#rate').trigger('change');

//                 }
//             });
//         } else {
//             $('select[name="rate"]').empty();
//         }
//     });
// });
// </script>
