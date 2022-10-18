<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EducationalExpenses;
use App\Models\EducationalYear;
use App\Models\Leavel;
use Illuminate\Http\Request;

class EducationalExpensesController extends Controller
{
    //
    public function create()
    {
        $leavels = Leavel::where('delete_at',0)->get();
        $educationalyears = EducationalYear::where('delete_at',0)->get();
        $educationalExpenses = EducationalExpenses::where('delete_at',0)->get();
        return view('admin.pages.educationalExpenses.create', compact('educationalExpenses','educationalyears','leavels'));
    }

    public function store(Request $request)
    {
        $active = 0;
        if($request->active == 1){
            $active = 1;
        }

        $educationalYear_id = EducationalYear::where('delete_at',0)->where('active',1)->value('id');
        if ($educationalYear_id < 1){
            return redirect()->back()->with(['success' => " تاكد من السنه المفعله"]);
        }
        foreach($request->data['amount'] as $key => $value){
            EducationalExpenses::create([
                'name' => $request->name,
                'notes' => $request->notes,
                'educationalYear_id' => $educationalYear_id,
                'active' => $active,
                'level_id' => $request->data['leavel_id'][$key],
                'amount' => $value,
            ]);
        }
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id)
    {
        $leavels = Leavel::where('delete_at',0)->get();
        $educationalyears = EducationalYear::where('delete_at',0)->get();
        $educationalExpenses = EducationalExpenses::findOrFail($id);
        return view('admin.pages.educationalExpenses.edit', compact('educationalExpenses','educationalyears','leavels'));
    }

    public function update(Request $request, $id)
    {
        $educationalExpenses = EducationalExpenses::findOrFail($id);
        $active = 0;
        if($request->active == 1){
            $active = 1;
        }
        $educationalYear_id = EducationalYear::where('delete_at',0)->where('active',1)->value('id');
            $educationalExpenses->update([
                'name' => $request->name,
                'notes' => $request->notes,
                'educationalYear_id' => $educationalYear_id,
                'active' => $active,
                'level_id' => $request->level_id,
                'amount' =>  $request->amount,
            ]);

        return redirect()->route('educationalExpenses.create')->with(['success' => " تم  التحديث بنجاح"]);
    }

    public function destroy($id)
    {
        $educationalExpenses = EducationalExpenses::findOrFail($id);
        $educationalExpenses->update([
            'delete_at'=>1,
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }
}
