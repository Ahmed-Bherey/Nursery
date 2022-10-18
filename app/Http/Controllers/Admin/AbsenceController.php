<?php

namespace App\Http\Controllers\Admin;

use App\Models\Absence;
use App\Models\AddChild;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ChildRoom;

class AbsenceController extends Controller
{
    //
    public function create()
    {
        $classRooms = Classroom::where('delete_at', 0)->get();
        $addChlidren = AddChild::where('delete_at', 0)->get();
        $absences = Absence::where('delete_at', 0)->get();
        return view('admin.pages.absences.create', compact('absences', 'classRooms', 'addChlidren'));
    }

    public function store(Request $request)
    {
        foreach ($request->data['addChild_id'] as $key => $value) {
            Absence::create([
                'date' => $request->date,
                'classroom_id' => $request->classroom_id,
                'addChild_id' => $value,
                'type' => $request->type,
                'absence_reason' => $request->absence_reason,
            ]);
        }
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id)
    {
        $classRooms = Classroom::where('delete_at', 0)->get();
        $addChlidren = AddChild::where('delete_at', 0)->get();
        $absences = Absence::findOrFail($id);
        return view('admin.pages.absences.edit', compact('absences', 'classRooms', 'addChlidren'));
    }

    public function update(Request $request, $id)
    {
        $absences = Absence::findOrFail($id);
        $absences->update([
            'date' => $request->date,
            'classroom_id' => $request->classroom_id,
            'addChild_id' => $request->addChild_id,
            'type' => $request->type,
            'absence_reason' => $request->absence_reason,
        ]);
        return redirect()->route('absence.create')->with(['success' => "تم التحديث بنجاح"]);
    }

    public function destroy($id)
    {
        $absences = Absence::findOrFail($id);
        $absences->update([
            'delete_at' => 1,
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }

    public function classRoomAbcenceAjax($id, $date)
    {
        $data = AddChild::whereHas('childRooms', function ($x) use ($id) {
            $x->where('classRoom_id', $id);
        })->whereDoesntHave('absences', function ($x) use ($date, $id) {
            $x->where('date', $date)->where('delete_at', 0);
        })->get();
        return json_encode($data);
    }


    public function classRoomHolidayAjax($id, $date)
    {
        $data = AddChild::whereHas('childRooms', function ($x) use ($id) {
            $x->where('classRoom_id', $id);
        })->whereDoesntHave('holidays', function ($x) use ($date, $id) {
            $x->where('date', $date)->where('delete_at', 0);
        })->get();
        return json_encode($data);
    }
}





// public function childrenAbcenceAjax($id, $date)
//     {
//         $data =AddChild::whereDoesntHave('absences', function ($x) use ($date, $id) {
//             $x->where('type', $id)->where('date', $date)->where('delete_at', 0);
//         })->get();
//         return json_encode($data);




// $data = AddChild::whereHas('childRooms',function($x) use($id,$date){
//     $x->whereDoesntHave('absences', function ($y) use ($date, $id) {
//                 $y->where('date', $date)->where('delete_at', 0);
//         });
// })->get();
// return json_encode($data);
//     }
