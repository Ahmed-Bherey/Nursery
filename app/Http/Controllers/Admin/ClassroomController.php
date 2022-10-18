<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Leavel;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    //
    public function create()
    {
        $classrooms = Classroom::where('delete_at',0)->get();
        $levels = Leavel::where('delete_at',0)->get();
        return view('admin.pages.classrooms.create', compact('classrooms','levels'));
    }

    public function store(Request $request)
    {
        $active = 0;
        if($request->active == 1){
            $active = 1;
        }
            Classroom::create([
                'name' =>$request->name,
                'level_id' =>$request->level_id,
                'student_count' =>$request->student_count,
                'notes' =>$request->notes,
                'active' =>$active,
            ]);
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id)
    {
        $classrooms = Classroom::findOrFail($id);
        $levels = Leavel::where('delete_at',0)->get();
        return view('admin.pages.classrooms.edit', compact('classrooms','levels'));
    }

    public function update(Request $request, $id)
    {
        $classrooms = Classroom::findOrFail($id);
        $active = 0;
        if($request->active == 1){
            $active = 1;
        }
            $classrooms->update([
                'name' =>$request->name,
                'level_id' =>$request->level_id,
                'student_count' =>$request->student_count,
                'notes' =>$request->notes,
                'active' =>$active,
            ]);
        return redirect()->route('classroom.create')->with(['success' => " تم  التحديث بنجاح"]);
    }

    public function destroy($id)
    {
        $classrooms = Classroom::findOrFail($id);
        if($classrooms->childRooms()->exists()){
            return redirect()->back()->with(['error' => "لا يمكن حذف هذه القاعة , ربما تم عليها بعض العمليات"]);
        }
        $classrooms->update([
            'delete_at'=>1,
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }
}
