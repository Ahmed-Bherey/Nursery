<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EducationalYear;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index(){

        $year_id = EducationalYear::where('delete_at',0)->where('active', 1)->value('id');
        return view('admin.pages.index',compact('year_id'));
    }
}
