<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralExpensese;
use Illuminate\Http\Request;

class GeneralExpenseseController extends Controller
{
    //
    public function create()
    {
        $generalExpenseses = GeneralExpensese::where('delete_at',0)->get();
        return view('admin.pages.generalExpenseses.create', compact('generalExpenseses'));
    }

    public function store(Request $request)
    {
        if($request->active == ""){
            GeneralExpensese::create([
                'name' => $request->name,
                'expensese_type' => $request->expensese_type,
                'price' => $request->price,
                'active' =>0,
            ]);
        }else{
            GeneralExpensese::create([
                'name' => $request->name,
                'expensese_type' => $request->expensese_type,
                'price' => $request->price,
                'active' =>$request->active,
            ]);
        }
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id)
    {
        $generalExpenseses = GeneralExpensese::findOrFail($id);
        return view('admin.pages.generalExpenseses.edit', compact('generalExpenseses'));
    }

    public function update(Request $request, $id)
    {
        $generalExpenseses = GeneralExpensese::findOrFail($id);
        if($request->active == ""){
            $generalExpenseses->update([
                'name' => $request->name,
                'expensese_type' => $request->expensese_type,
                'price' => $request->price,
                'active' =>0,
            ]);
        }else{
            $generalExpenseses->update([
                'name' => $request->name,
                'expensese_type' => $request->expensese_type,
                'price' => $request->price,
                'active' =>$request->active,
            ]);
        }
        return redirect()->route('generalExpensese.create')->with(['success' => " تم  التحديث بنجاح"]);
    }

    public function destroy($id)
    {
        $generalExpenseses = GeneralExpensese::findOrFail($id);
        $generalExpenseses->update([
            'delete_at'=>1,
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }
}
