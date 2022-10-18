<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leavel;
use Illuminate\Http\Request;

class LeavelController extends Controller
{
    //
    public function create()
    {
        $leavels = Leavel::where('delete_at', 0)->get();
        return view('admin.pages.leavels.create', compact('leavels'));
    }

    public function store(Request $request)
    {
        Leavel::create([
            'name' => $request->name,
            'value' => $request->value,
            'notes' => $request->notes,
        ]);
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id)
    {
        $leavel = Leavel::findOrFail($id);
        return view('admin.pages.leavels.edit', compact('leavel'));
    }

    public function update(Request $request, $id)
    {
        $leavel = Leavel::findOrFail($id);
        $leavel->update([
            'name' => $request->name,
            'value' => $request->value,
            'notes' => $request->notes,
        ]);
        return redirect()->route('leavel.create')->with(['success' => "تم التحديث بنجاح"]);
    }

    public function destroy($id)
    {
        $Leavel = Leavel::findOrFail($id);
        if ($Leavel->classrooms()->exists()) {
            return redirect()->back()->with(['error' => "لا يمكن حذف هذه القاعة , ربما تم عليها بعض العمليات"]);
        }
        Leavel::where('id', $id)->update([
            'delete_at' => 1,
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }
}
