<?php

namespace App\Http\Controllers\Admin;

use App\Models\AddChild;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Models\ChildTransfer;
use App\Http\Controllers\Controller;
use App\Models\ChildRoom;
use App\Models\Leavel;

class ChildTransferController extends Controller
{
    //
    public function create()
    {
        $levels = Leavel::where('delete_at',0)->get();
        $classroomsFrom = Classroom::where('delete_at',0)->get();
        $classroomsTo = Classroom::where('delete_at',0)->get();
        $addChildren = AddChild::where('delete_at',0)->get();
        $childTransfers = ChildTransfer::where('delete_at',0)->get();
        return view('admin.pages.childTransfers.create', compact('childTransfers','levels', 'classroomsFrom', 'classroomsTo', 'addChildren'));
    }

    public function store(Request $request)
    {
        ChildRoom::where('addChlid_id', $request->addChild_id)
            ->where('classRoom_id', $request->classroomFrom_id)
            ->update([
                'classRoom_id' => $request->classroomTo_id,
            ]);
        ChildTransfer::create([
            'date' => $request->date,
            'level_id' => $request->level_id,
            'classroomFrom_id' => $request->classroomFrom_id,
            'classroomTo_id' => $request->classroomTo_id,
            'addChild_id' => $request->addChild_id,
        ]);
        return redirect()->back()->with(['success' => "تم بنجاح"]);
    }

    public function edit($id)
    {
        $level_id = ChildTransfer::where('delete_at',0)->where('id',$id)->value('level_id');
        $levels = Leavel::where('delete_at',0)->get();
        $classroomsFrom = Classroom::where('delete_at',0)->where('level_id',$level_id)->get();
        $classroomsTo = Classroom::where('delete_at',0)->where('level_id',$level_id)->get();
        $addChildren = AddChild::where('delete_at',0)->whereHas('childRegistrations', function ($x) use($level_id){
            $x->where('level_id',$level_id);
        })->get();
        $childTransfers = ChildTransfer::findOrFail($id);
        return view('admin.pages.childTransfers.edit', compact('childTransfers','levels', 'classroomsFrom', 'classroomsTo', 'addChildren'));
    }

    public function update(Request $request, $id)
    {
        $childTransfers = ChildTransfer::where('delete_at',0)->findOrFail($id);
        ChildRoom::where('delete_at',0)->where('addChlid_id', $request->addChild_id)
            ->where('classRoom_id', $request->classroomFrom_id)
            ->update([
                'classRoom_id' => $request->classroomTo_id,
            ]);
        $childTransfers->update([
            'date' => $request->date,
            'level_id' => $request->level_id,
            'classroomFrom_id' => $request->classroomFrom_id,
            'classroomTo_id' => $request->classroomTo_id,
            'addChild_id' => $request->addChild_id,
        ]);
        return redirect()->route('childTransfer.create')->with(['success' => " تم  التحديث بنجاح"]);
    }

    public function destroy($id)
    {
        $childTransfers = ChildTransfer::findOrFail($id);
        $childTransfers->update([
            'delete_at'=>1,
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }

    public function childTransferAjax($id){
        $childTransferAjax = ChildRoom::where('delete_at',0)->where('classRoom_id',$id)->with('add_chlids')->get();
        return json_encode($childTransferAjax);
    }

    public function childTransferCountAjax($id)
    {
        $ChildRoom_count = ChildRoom::where('classRoom_id',$id)->where('delete_at', 0)->count();
        return json_encode($ChildRoom_count);
    }

    public function childTransferPaidAjax($id)
    {
        $ChildRoom_count = ChildRoom::where('classRoom_id',$id)->where('delete_at', 0)->count();
        $count = Classroom::where('id',$id)->value('student_count');
        $data = $count - $ChildRoom_count;
        return json_encode($data);
    }
}
