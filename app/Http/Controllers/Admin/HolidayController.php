<?php

namespace App\Http\Controllers\Admin;

use App\Models\Holiday;
use App\Models\AddChild;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HolidayController extends Controller
{
    //
    public function create()
    {
        $classRooms = Classroom::where('delete_at', 0)->get();
        $addChlidren = AddChild::where('delete_at', 0)->get();
        $holidays = Holiday::where('delete_at', 0)->get();
        return view('admin.pages.holiday.create', compact('holidays', 'classRooms', 'addChlidren'));
    }

    public function store(Request $request)
    {
        foreach ($request->data['addChild_id'] as $key => $value) {
            Holiday::create([
                'date' => $request->date,
                'holidayStart' => $request->holidayStart,
                'holidayEnd' => $request->holidayEnd,
                'classroom_id' => $request->classroom_id,
                'addChild_id' => $value,
                'holiday_reason' => $request->holiday_reason,
            ]);
        }
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id)
    {
        $classRooms = Classroom::where('delete_at', 0)->get();
        $addChlidren = AddChild::where('delete_at', 0)->get();
        $holidays = Holiday::findOrFail($id);
        return view('admin.pages.holiday.edit', compact('holidays', 'classRooms', 'addChlidren'));
    }

    public function update(Request $request, $id)
    {
        $holidays = Holiday::findOrFail($id);
        $holidays->update([
            'date' => $request->date,
            'holidayStart' => $request->holidayStart,
            'holidayEnd' => $request->holidayEnd,
            'classroom_id' => $request->classroom_id,
            'addChild_id' => $request->addChild_id,
            'holiday_reason' => $request->holiday_reason,
        ]);
        return redirect()->route('holiday.create')->with(['success' => "تم التحديث بنجاح"]);
    }

    public function destroy($id)
    {
        $holidays = Holiday::findOrFail($id);
        $holidays->update([
            'delete_at' => 1,
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }

    public function holidayAbcenceAjax($id, $date)
    {
        $data = AddChild::whereDoesntHave('holidays', function ($x) use ($date, $id) {
            $x->where('classroom_id', $id)->where('date', $date)->where('delete_at', 0);
        })->get();
        return json_encode($data);
    }
}
