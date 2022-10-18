<?php

namespace App\Http\Controllers\Admin;

use App\Models\Leavel;
use App\Models\AddChild;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Models\EducationalYear;
use App\Models\ChildRegistration;
use App\Http\Controllers\Controller;
use App\Models\ChildRoom;

class AddChildController extends Controller
{
    //
    public function create()
    {
        $year_id = EducationalYear::where('delete_at', 0)->where('active', 1)->value('id');

        if ($year_id < 0) {
            return redirect()->back()->with(['success' => " تاكد من وجود سنه مفعله "]);
        }
        $addChilds = AddChild::where('year_id', $year_id)->where('delete_at', 0)->orderBy('name_ar', 'ASC')->get();
        return view('admin.pages.addChild.create', compact('addChilds'));
    }

    public function store(Request $request)
    {
        $year_id = EducationalYear::where('delete_at', 0)->where('active', 1)->value('id');

        if ($year_id < 0) {
            return redirect()->back()->with(['success' => " تاكد من وجود سنه مفعله "]);
        }
        $active = 0;
        if ($request->active == 1) {
            $active = 1;
        }
        $img = Null;
        if ($request->hasFile('img')) {
            $img = $request->img->store('public/img/children');
        }
        AddChild::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'id_number' => $request->id_number,
            'address' => $request->address,
            'father_name' => $request->father_name,
            'father_tel' => $request->father_tel,
            'mother_name' => $request->mother_name,
            'year_id' => $year_id,
            'mother_tel' => $request->mother_tel,
            'another_tel' => $request->another_tel,
            'fatherJob' => $request->fatherJob,
            'motherJob' => $request->motherJob,
            'img' => $img,
            'religion' => $request->religion,
            'active' => $active,
        ]);
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id)
    {
        $addChilds = AddChild::findOrFail($id);
        return view('admin.pages.addChild.edit', compact('addChilds'));
    }

    public function update(Request $request, $id)
    {
        $year_id = EducationalYear::where('delete_at', 0)->where('active', 1)->value('id');

        if ($year_id < 0) {
            return redirect()->back()->with(['success' => " تاكد من وجود سنه مفعله "]);
        }
        $addChilds = AddChild::findOrFail($id);
        if ($request->active == "") {
            if (isset($request->img)) {
                $addChilds->update([
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'id_number' => $request->id_number,
                    'address' => $request->address,
                    'father_name' => $request->father_name,
                    'father_tel' => $request->father_tel,
                    'mother_name' => $request->mother_name,
                    'year_id' => $year_id,
                    'fatherJob' => $request->fatherJob,
                    'motherJob' => $request->motherJob,
                    'mother_tel' => $request->mother_tel,
                    'another_tel' => $request->another_tel,
                    'img' => $request->img->store('public/img/children'),
                    'religion' => $request->religion,
                    'active' => 0,
                ]);
            } else {
                $addChilds->update([
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'id_number' => $request->id_number,
                    'address' => $request->address,
                    'father_name' => $request->father_name,
                    'father_tel' => $request->father_tel,
                    'year_id' => $year_id,
                    'fatherJob' => $request->fatherJob,
                    'motherJob' => $request->motherJob,
                    'mother_name' => $request->mother_name,
                    'mother_tel' => $request->mother_tel,
                    'another_tel' => $request->another_tel,
                    'religion' => $request->religion,
                    'active' => 0,
                ]);
            }
        } else {
            if (isset($request->img)) {
                $addChilds->update([
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'id_number' => $request->id_number,
                    'address' => $request->address,
                    'father_name' => $request->father_name,
                    'father_tel' => $request->father_tel,
                    'year_id' => $year_id,
                    'fatherJob' => $request->fatherJob,
                    'motherJob' => $request->motherJob,
                    'mother_name' => $request->mother_name,
                    'mother_tel' => $request->mother_tel,
                    'another_tel' => $request->another_tel,
                    'img' => $request->img->store('public/img/children'),
                    'religion' => $request->religion,
                    'active' => $request->active,
                ]);
            } else {
                $addChilds->update([
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'id_number' => $request->id_number,
                    'address' => $request->address,
                    'father_name' => $request->father_name,
                    'father_tel' => $request->father_tel,
                    'mother_name' => $request->mother_name,
                    'year_id' => $year_id,
                    'fatherJob' => $request->fatherJob,
                    'motherJob' => $request->motherJob,
                    'mother_tel' => $request->mother_tel,
                    'another_tel' => $request->another_tel,
                    'religion' => $request->religion,
                    'active' => $request->active,
                ]);
            }
        }
        return redirect()->route('addChild.create')->with(['success' => " تم  التحديث بنجاح"]);
    }

    public function destroy($id)
    {
        $addChilds = AddChild::findOrFail($id);
        $addChilds->update([
            'delete_at' => 1,
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }

    public function childrenSearch()
    {
        $levels = Leavel::where('delete_at', 0)->get();
        $classRooms = Classroom::get();
        return view('admin.pages.childSerch.index', compact('levels', 'classRooms'));
    }

    public function childrenData(Request $request)
    {
        $level = Leavel::find($request->level_id);
        $classRoom = Classroom::find($request->classRoom_id);
        if ($request->active == 1) {
            $children = ChildRoom::where('delete_at', 0)
                ->where('level_id', $request->level_id)
                ->where('classRoom_id', $request->classRoom_id)
                ->with('add_chlids')
                ->get();
        } elseif ($request->active == 2) {
            $children = ChildRoom::where('delete_at', 0)
                ->where('level_id', $request->level_id)
                ->where('classRoom_id', $request->classRoom_id)
                ->whereHas('add_chlids', function ($x) {
                    $x->where('active', 1);
                })
                ->get();
        } elseif ($request->active == 3) {
            $children = ChildRoom::where('delete_at', 0)
                ->where('level_id', $request->level_id)
                ->where('classRoom_id', $request->classRoom_id)
                ->whereHas('add_chlids', function ($x) {
                    $x->where('active', 0);
                })
                ->get();
        }
        $levels = Leavel::where('delete_at', 0)->get();
        $classRooms = Classroom::get();
        return view('admin.pages.childSerch.index', compact('levels', 'classRooms', 'level', 'classRoom', 'children'));
    }


    public function childrenNameSearch()
    {
        $children = AddChild::where('delete_at', 0)->get();
        return view('admin.pages.childrenNameSearch.index', compact('children'));
    }

    public function childrenNameData(Request $request)
    {
        $children = AddChild::where('delete_at', 0)->get();
        $childRoom = ChildRoom::where('delete_at', 0)
            ->where('addChlid_id', $request->child_id)
            ->first();
        $childd = AddChild::find($request->child_id);
        return view('admin.pages.childrenNameSearch.index', compact('childRoom', 'children','childd'));
    }
}
