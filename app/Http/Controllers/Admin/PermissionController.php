<?php

namespace App\Http\Controllers\Admin;

use App\Models\AddChild;
use App\Models\Classroom;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    //
    public function create(){
        $classRooms = Classroom::where('delete_at',0)->get();
        $addChlidren = AddChild::where('delete_at',0)->get();
        $permissions = Permission::where('delete_at',0)->get();
        return view('admin.pages.permissions.create' , compact('permissions','classRooms','addChlidren'));
    }

    public function store(Request $request){
        Permission::create([
            'date' => $request->date,
            'classroom_id' => $request->classroom_id,
            'addChild_id' => $request->addChild_id,
            'permission_reason' => $request->permission_reason,
        ]);
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id){
        $classRooms = Classroom::where('delete_at',0)->get();
        $addChlidren = AddChild::where('delete_at',0)->get();
        $permissions = Permission::findOrFail($id);
        return view('admin.pages.permissions.edit' , compact('permissions','classRooms','addChlidren'));
    }

    public function update(Request $request ,$id){
        $permissions = Permission::findOrFail($id);
        $permissions->update([
            'date' => $request->date,
            'classroom_id' => $request->classroom_id,
            'addChild_id' => $request->addChild_id,
            'permission_reason' => $request->permission_reason,
        ]);
        return redirect()->route('permission.create')->with(['success' => "تم التحديث بنجاح"]);
    }

    public function destroy($id){
        $permissions = Permission::findOrFail($id);
        $permissions->update([
            'delete_at'=>1,
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }
}
