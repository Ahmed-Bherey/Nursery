<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DaycareSettieng;
use Illuminate\Http\Request;

class DaycareSettiengController extends Controller
{
    //
    public function create(){
        $daycareSettiengs = DaycareSettieng::first();
        return view('admin.pages.daycareSettiengs.create' , compact('daycareSettiengs'));
    }

    public function store(Request $request){
        if (isset($request->logo)) {
            DaycareSettieng::updateOrCreate([],[
                'name_ar' =>$request->name_ar,
                'name_en' =>$request->name_en,
                'email' =>$request->email,
                'website' =>$request->website,
                'tel1' =>$request->tel1,
                'tel2' =>$request->tel2,
                'tel3' =>$request->tel3,
                'fax' =>$request->fax,
                'address' =>$request->address,
                'commercial_number' =>$request->commercial_number,
                'commercial_id' =>$request->commercial_id,
                'vision' =>$request->vision,
                'message' =>$request->message,
                'logo' =>$request->logo->store('public/img/settings'),
            ]);
        } else {
            DaycareSettieng::updateOrCreate([],[
                'name_ar' =>$request->name_ar,
                'name_en' =>$request->name_en,
                'email' =>$request->email,
                'website' =>$request->website,
                'tel1' =>$request->tel1,
                'tel2' =>$request->tel2,
                'tel3' =>$request->tel3,
                'fax' =>$request->fax,
                'address' =>$request->address,
                'commercial_number' =>$request->commercial_number,
                'commercial_id' =>$request->commercial_id,
                'vision' =>$request->vision,
                'mission' =>$request->mission,
            ]);
        }
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }
}
