<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\EducationalYear;
use App\Http\Controllers\Controller;

class EducationalYearController extends Controller
{
    //
    public function create()
    {
        $educationalYears = EducationalYear::where('delete_at',0)->get();
        return view('admin.pages.educationalYears.create', compact('educationalYears'));
    }

    public function store(Request $request)
    {

        $active = 0;
        if ($request->active == 1) {
            $active = 1;
        }
        $year = EducationalYear::create([
            'name' => $request->name,
            'dateFrom' => $request->dateFrom,
            'dateTo' => $request->dateTo,
            'active' => $active,
        ]);
        if ($request->active == 1) {
            foreach (EducationalYear::where('id', '!=', $year->id)->get() as $years) {
                EducationalYear::where('id', $years->id)->update([
                    'active' => 0,
                ]);
            }
        }
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id)
    {
        $educationalYears = EducationalYear::FindOrFail($id);
        return view('admin.pages.educationalYears.edit', compact('educationalYears'));
    }

    public function update(Request $request, $id)
    {
        $educationalYears = EducationalYear::FindOrFail($id);
        $active = 0;
        if ($request->active == 1) {
            $active = 1;
        }
        $Year = $educationalYears;

        if ($request->active == 1) {
            foreach (EducationalYear::where('id', '!=', $Year->id)->get() as $years) {
                EducationalYear::where('id', $years->id)->update([
                    'active' => 0,
                ]);
            }
        }
        $educationalYears->update([
            'name' => $request->name,
            'amount' => $request->amount,
            'notes' => $request->notes,
            'active' => $active,
        ]);
        return redirect()->route('educationalYear.create')->with(['success' => " تم  التحديث بنجاح"]);
    }

    public function destroy($id)
    {
        $educationalYears = EducationalYear::FindOrFail($id);
        $educationalYears->update([
            'delete_at'=>1,
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }
}
