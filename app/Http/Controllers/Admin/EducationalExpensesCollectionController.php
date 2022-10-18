<?php

namespace App\Http\Controllers\Admin;

use App\Models\Leavel;
use App\Models\AddChild;
use App\Models\Treasury;
use Illuminate\Http\Request;
use App\Models\DaycareSettieng;
use App\Models\TreasuryProcess;
use App\Models\EducationalExpenses;
use App\Http\Controllers\Controller;
use App\Models\EducationalExpensesCollection;
use App\Models\IndebtednessLevel;

class EducationalExpensesCollectionController extends Controller
{
    //
    public function create(){
        $treasuries = Treasury::where('delete_at',0)->where('active',1)->get();
        $chlidren = AddChild::where('delete_at',0)->get();
        $levels = Leavel::where('delete_at', 0)->get();
        $educationalExpenses = EducationalExpenses::where('delete_at',0)->get();
        $educationalExpensesCollections = EducationalExpensesCollection::where('delete_at',0)->get();
        return view('admin.pages.educationalExpensesCollections.create' , compact('levels','educationalExpensesCollections','educationalExpenses','treasuries','chlidren'));
    }

    public function store(Request $request){

        EducationalExpensesCollection::create([
            'date' => $request->date,
            'level_id' => $request->level_id,
            'treasury_id' => $request->treasury_id,
            'child_id' => $request->child_id,
            'expenses_id' => $request->expenses_id,
            'total_paid' => $request->total_paid,
            'rest' => $request->rest,
            'notes' => $request->notes,
        ]);

        $balance=Treasury::where('id',$request->treasury_id)->value('balance');
        Treasury::where('id',$request->treasury_id)->update([
            'balance'=>$balance + $request->total_paid,
        ]);

        $name = EducationalExpenses::where('level_id',$request->level_id)->value('name');
        $child = AddChild::where('id',$request->child_id)->value('name_ar');

        TreasuryProcess::create([
            'date' => $request->date,
            'educationalExpense_id' => $request->expenses_id,
            'treasury_id' =>$request->treasury_id,
            'debt' => $request->total_paid,
            'comment'=>' تحصيل مصروف ' . $name . ' من الطفل ' . $child,
        ]);
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id){
        $treasuries = Treasury::where('delete_at',0)->where('active',1)->get();
        $chlidren = AddChild::where('delete_at',0)->get();
        $levels = Leavel::where('delete_at', 0)->get();
        $educationalExpenses = EducationalExpenses::where('delete_at',0)->get();
        $educationalExpensesCollections = EducationalExpensesCollection::findOrFail($id);
        return view('admin.pages.educationalExpensesCollections.edit' , compact('levels','educationalExpensesCollections','educationalExpenses','treasuries','chlidren'));
    }

    public function update(Request $request ,$id){
        $educationalExpensesCollections = EducationalExpensesCollection::findOrFail($id);
        $balance=Treasury::where('id',$request->treasury_id)->value('balance');
        $total_paid = EducationalExpensesCollection::where('level_id',$request->level_id)
        ->where('treasury_id',$request->treasury_id)
        ->where('child_id',$request->child_id)
        ->value('total_paid');
        $data = $total_paid - $request->total_paid;
        Treasury::where('id',$request->treasury_id)->update([
            'balance'=>$balance - $data,
        ]);
        $educationalExpensesCollections->update([
            'date' => $request->date,
            'level_id' => $request->level_id,
            'treasury_id' => $request->treasury_id,
            'child_id' => $request->child_id,
            'expenses_id' => $request->expenses_id,
            'total_paid' => $request->total_paid,
            'rest' => $request->rest,
            'notes' => $request->notes,
        ]);
        TreasuryProcess::create([
            'date' => $request->date,
            'educationalExpense_id' => $request->expenses_id,
            'treasury_id' =>$request->treasury_id,
            'debt' => $request->total,
            'comment'=>'تعديل تحصيل مصروفات دراسية',
        ]);
        return redirect()->route('educationalExpensesCollection.create')->with(['success' => "تم التحديث بنجاح"]);
    }

    public function destroy($id){
        $treasury_id = EducationalExpensesCollection::where('delete_at', 0)->where('id', $id)->value('treasury_id');
        $level_id = EducationalExpensesCollection::where('delete_at', 0)->where('id', $id)->value('level_id');
        $child_id = EducationalExpensesCollection::where('delete_at', 0)->where('id', $id)->value('child_id');
        $total_paid = EducationalExpensesCollection::where('delete_at', 0)
        ->where('id', $id)
        ->where('level_id',$level_id)
        ->where('child_id',$child_id)
        ->value('total_paid');
        $balance = Treasury::where('id', $treasury_id)->value('balance');
        Treasury::where('id', $treasury_id)->update([
            'balance' => $balance - $total_paid,
        ]);

        $educationalExpensesCollections = EducationalExpensesCollection::findOrFail($id);
        $educationalExpensesCollections->update([
            'delete_at'=>1,
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }

    public function levelExpensesAjax($id){
        $data=IndebtednessLevel::where('level_id',$id)->where('delete_at',0)->groupBy(['educationalExpense_id','name'])->with('educational_expenses')->get();
        return json_encode($data);
    }

    public function childRestAjax($id){
        $rest = educationalExpensesCollection::where('child_id',$id)->where('delete_at',0)->latest()->value('rest');
        return json_encode($rest);
    }

    public function expensesAjax($id){
        $amount = IndebtednessLevel::where('educationalExpense_id',$id)->where('delete_at',0)->value('amount');
        // $total_paid = educationalExpensesCollection::where('expenses_id',$id)->where('delete_at',0)->sum('total_paid');
        // $data = $amount - $total_paid;
        return json_encode($amount);
    }

    public function print($id)
    {
        $daycareSettieng = DaycareSettieng::first();
        $treasuries = Treasury::where('delete_at',0)->where('active',1)->get();
        $chlidren = AddChild::where('delete_at',0)->get();
        $levels = Leavel::where('delete_at', 0)->get();
        $educationalExpenses = EducationalExpenses::where('delete_at',0)->get();
        $educationalExpensesCollections = EducationalExpensesCollection::findOrFail($id);
        return view('admin.pages.educationalExpensesCollections.print' , compact('levels','daycareSettieng','educationalExpensesCollections','educationalExpenses','treasuries','chlidren'));
    }
}
