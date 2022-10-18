<?php

namespace App\Http\Controllers\Admin;

use App\Models\ChildRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AddChild;
use App\Models\ChildRegistration;
use App\Models\Classroom;
use App\Models\Leavel;

class ChildRoomController extends Controller
{
    //
    public function create()
    {
        $childRegisterions = ChildRegistration::where('delete_at', 0)->whereHas('levels')->get();
        $classRooms = Classroom::where('delete_at', 0)->get();
        $levels = Leavel::where('delete_at', 0)->get();
        $addChlids = AddChild::where('delete_at', 0)->whereDoesntHave('childRooms')->get();
        $childRooms = ChildRoom::where('delete_at', 0)->get();
        return view('admin.pages.childRooms.create', compact('childRooms', 'levels', 'childRegisterions', 'classRooms', 'addChlids'));
    }

    public function store(Request $request)
    {

        foreach ($request->addChlid_id as $value) {
            $classroom_count = Classroom::where('delete_at', 0)->where('id', $request->classRoom_id)->where('level_id', $request->level_id)->value('student_count');
            $childRoom_count = ChildRoom::where('delete_at', 0)->where('level_id', $request->level_id)->where('classRoom_id', $request->classRoom_id)->count();
            // dd($classroom_count,$childRoom_count);
            if ($classroom_count <= $childRoom_count) {

                return redirect()->back()->with(['error' => " عفوا اقصى عدد يمكن اضافته لهذه القاعة =" . $classroom_count]);
            }
            ChildRoom::where('delete_at', 0)->create([
                'level_id' => $request->level_id,
                'classRoom_id' => $request->classRoom_id,
                'addChlid_id' => $value,
            ]);
        }
        $classroom_count = Classroom::where('delete_at', 0)->where('id', $request->classRoom_id)->where('level_id', $request->level_id)->value('student_count');
        $childRoom_count = ChildRoom::where('delete_at', 0)->where('level_id', $request->level_id)->where('classRoom_id', $request->classRoom_id)->count();
        $remaining_number = $classroom_count - $childRoom_count;
        return redirect()->back()->with(['success' => "تم الاضافة بنجاح والعدد المتبقى " . $remaining_number]);
    }

    public function edit($id)
    {
        $childRegisterions = ChildRegistration::where('delete_at', 0)->get();
        $classRooms = Classroom::where('delete_at', 0)->get();
        $addChlids = AddChild::where('delete_at', 0)->get();
        $levels = Leavel::where('delete_at', 0)->get();
        $childRooms = ChildRoom::findOrFail($id);
        return view('admin.pages.childRooms.edit', compact('childRooms', 'levels', 'childRegisterions', 'classRooms', 'addChlids'));
    }

    public function update(Request $request, $id)
    {
        $childRooms = ChildRoom::findOrFail($id);
        foreach ($request->addChlid_id as $value)
            $childRooms->update([
                'level_id' => $request->level_id,
                'classRoom_id' => $request->classRoom_id,
                'addChlid_id' => $value,
            ]);
        return redirect()->route('childRoom.create')->with(['success' => "تم التحديث بنجاح"]);
    }

    public function destroy($id)
    {
        $childRooms = ChildRoom::findOrFail($id);
        $childRooms->update([
            'delete_at' => 1,
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }

    public function childRoomAjax($level)
    {
        $childRoomAjax = AddChild::where('delete_at', 0)->whereDoesntHave('childRooms', function ($x) {
            $x->where('delete_at', 0);
        })->whereHas('childRegistrations', function ($x) use ($level) {
            $x->where('delete_at', 0)->where('level_id', $level);
        })->get();
        return json_encode($childRoomAjax);
    }

    public function childRoomClassRoomAjax($id)
    {
        $classRooms = Classroom::where('delete_at', 0)->where('level_id',$id)->get();
        return json_encode($classRooms);
    }

    public function childRoomCountAjax($id)
    {
        $ChildRoom_count = ChildRoom::where('classRoom_id',$id)->where('delete_at', 0)->count();
        return json_encode($ChildRoom_count);
    }

    public function childRoomPaidAjax($id)
    {
        $ChildRoom_count = ChildRoom::where('classRoom_id',$id)->where('delete_at', 0)->count();
        $count = Classroom::where('id',$id)->value('student_count');
        $data = $count - $ChildRoom_count;
        return json_encode($data);
    }
}
