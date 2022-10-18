<?php

namespace App\Http\Controllers\Admin;

use App\Models\Leavel;
use App\Models\AddChild;
use App\Models\ChildRoom;
use Illuminate\Http\Request;
use App\Models\ChildTransfer;
use App\Models\LevelTransfer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LevelTransferController extends Controller
{
    //
    public function create()
    {
        $levelsFrom = Leavel::where('delete_at', 0)->get();
        $levelsTo = Leavel::where('delete_at', 0)->get();
        $children = AddChild::where('delete_at', 0)->get();
        $levelTransfers = LevelTransfer::where('delete_at', 0)->get();
        return view('admin.pages.levelTransfers.create', compact('levelTransfers', 'levelsFrom', 'levelsTo', 'children'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        foreach ($request->data['child_id'] as $key => $value) {
            ChildRoom::where('addChlid_id', $value)
                ->where('level_id', $request->levelFrom_id)
                ->update([
                    'level_id' => $request->levelTo_id,
                ]);
            LevelTransfer::create([
                'date' => $request->date,
                'user_id' => Auth::user()->id,
                'child_id' => $value,
                'levelFrom_id' => $request->levelFrom_id,
                'levelTo_id' => $request->levelTo_id,
            ]);
        }
        return redirect()->back()->with(['success' => "تم بنجاح"]);
    }

    public function edit($id)
    {
        $levelsFrom = Leavel::where('delete_at', 0)->get();
        $levelsTo = Leavel::where('delete_at', 0)->get();
        $children = AddChild::where('delete_at', 0)->get();
        $levelTransfers = LevelTransfer::where('delete_at', 0)->findOrFail($id);
        return view('admin.pages.levelTransfers.edit', compact('levelTransfers', 'levelsFrom', 'levelsTo', 'children'));
    }

    public function update(Request $request, $id)
    {
        $levelTransfers = LevelTransfer::where('delete_at', 0)->findOrFail($id);
        ChildRoom::where('addChlid_id', $request->child_id)
            ->where('level_id', $request->levelFrom_id)
            ->update([
                'level_id' => $request->levelTo_id,
            ]);
        $levelTransfers->update([
            'date' => $request->date,
            'user_id' => Auth::user()->id,
            'child_id' => $request->child_id,
            'levelFrom_id' => $request->levelFrom_id,
            'levelTo_id' => $request->levelTo_id,
        ]);
        return redirect()->route('levelTransfer.create')->with(['success' => " تم  التحديث بنجاح"]);
    }

    public function destroy($id)
    {
        $levelTransfers = LevelTransfer::findOrFail($id);
        $levelTransfers->update([
            'delete_at' => 1,
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }

    public function levelTransferAjax($id)
    {
        $levelTransferAjax = ChildRoom::where('delete_at', 0)->where('level_id', $id)->with('add_chlids')->get();
        return json_encode($levelTransferAjax);
    }

    // public function childTransferCountAjax($id)
    // {
    //     $ChildRoom_count = ChildRoom::where('classRoom_id',$id)->where('delete_at', 0)->count();
    //     return json_encode($ChildRoom_count);
    // }

    // public function childTransferPaidAjax($id)
    // {
    //     $ChildRoom_count = ChildRoom::where('classRoom_id',$id)->where('delete_at', 0)->count();
    //     $count = Classroom::where('id',$id)->value('student_count');
    //     $data = $count - $ChildRoom_count;
    //     return json_encode($data);
    // }
}
