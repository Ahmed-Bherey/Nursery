<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Treasury;
use Illuminate\Http\Request;

class TreasuryController extends Controller
{
    //
    public function create(){
        $treasuries = Treasury::where('delete_at',0)->get();
        return view('admin.pages.treasuries.create' , compact('treasuries'));
    }

    public function store(Request $request)
    {
        if ($request->active == "") {
            Treasury::create([
                'name' => $request->name,
                'treasury_secretary' => $request->treasury_secretary,
                'balance' => $request->balance,
                'active' => 0,
            ]);
        } else {
            Treasury::create([
                'name' => $request->name,
                'treasury_secretary' => $request->treasury_secretary,
                'balance' => $request->balance,
                'active' => $request->active,
            ]);
        }
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id)
    {
        $treasuries = Treasury::findOrFail($id);
        return view('admin.pages.treasuries.edit' , compact('treasuries'));
    }

    public function update(Request $request, $id)
    {
        $treasuries = Treasury::findOrFail($id);
        if ($request->active == "") {
            $treasuries->update([
                'name' => $request->name,
                'treasury_secretary' => $request->treasury_secretary,
                'balance' => $request->balance,
                'active' => 0,
            ]);
        } else {
            $treasuries->update([
                'name' => $request->name,
                'treasury_secretary' => $request->treasury_secretary,
                'balance' => $request->balance,
                'active' => $request->active,
            ]);
        }
        return redirect()->route('treasury.create')->with(['success' => " تم  التحديث بنجاح"]);
    }

    public function destroy($id)
    {
        $treasuries = Treasury::findOrFail($id);
        $treasuries->update([
            'delete_at'=>1,
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }
}
