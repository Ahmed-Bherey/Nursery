<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddChild;
use App\Models\ChildRegistration;
use App\Models\Leavel;
use DateTime;
use Illuminate\Http\Request;

class ChildRegistrationController extends Controller
{
    //
    public function create()
    {
        $children = AddChild::where('delete_at', 0)->where('active', 1)->whereDoesntHave('childRegistrations', function ($x) {
            $x->where('delete_at', [0, 1]);
        })->get();
        $leavels = Leavel::where('delete_at', 0)->get();
        $name = AddChild::select('name_ar')->get();
        $childRegistrations = ChildRegistration::where('delete_at', 0)->get();
        return view('admin.pages.childRegistrations.create', compact('childRegistrations','name', 'leavels', 'children'));
    }

    public function store(Request $request)
    {
        ChildRegistration::create([
            'registration_date' => $request->registration_date,
            'child_id' => $request->child_id,
            'acceptance_date' => $request->acceptance_date,
            'born_date' => $request->born_date,
            'age' => $request->age,
            'gender' => $request->gender,
            'city' => $request->city,
            'level_id' => $request->level_id,
        ]);
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id)
    {
        $children = AddChild::where('delete_at', 0)->where('active', 1)->whereDoesntHave('childRegistrations', function ($x) {
            $x->where('delete_at', [0, 1]);
        })->get();
        $leavels = Leavel::where('delete_at', 0)->get();
        $childRegistrations = ChildRegistration::findOrFail($id);

        return view('admin.pages.childRegistrations.edit', compact('childRegistrations', 'leavels', 'children'));
    }

    public function update(Request $request, $id)
    {
        $childRegistrations = ChildRegistration::findOrFail($id);
        $childRegistrations->update([
            'registration_date' => $request->registration_date,
            'child_id' => $request->child_id,
            'acceptance_date' => $request->acceptance_date,
            'born_date' => $request->born_date,
            'gender' => $request->gender,
            'city' => $request->city,
            'age' => $request->age,
            'level_id' => $request->level_id,
        ]);
        return redirect()->route('childRegistration.create')->with(['success' => "تم التحديث بنجاح"]);
    }

    public function destroy($id)
    {
        $childRegistrations = ChildRegistration::findOrFail($id);
        $childRegistrations->update([
            'delete_at' => 1,
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }
//تاريخ الملاد
    public function childRegistrationAgeAjax($id)
    {
        $age = AddChild::where('id', $id)->value('id_number');
        $string = (string)$age;
        $x = 19;
        if (substr($string, 0, 1) == 3) {
            $x = 20;
        }
        $date = substr($string, 5, 2) . "-" . substr($string, 3, 2) . "-" . $x . substr($string, 1, 2);
        return json_encode($date);
    }
//السن عن تاريه مغين
    public function childRegistrationidNumAjax($id, $acceptance_date)
    {
        $age = AddChild::where('id', $id)->value('id_number');
        $string = (string)$age;
        $x = 19;
        if (substr($string, 0, 1) == 3) {
            $x = 20;
        }
        $date = substr($string, 5, 2) . "-" . substr($string, 3, 2) . "-" . $x . substr($string, 1, 2);
        $date_expire = $date;
        $date = new DateTime($date_expire);
        $now = new DateTime($acceptance_date);
        $data = $date->diff($now)->format("%y سنه و%mشهر و%d يوم ");
        return json_encode($data);
    }
//لنوغ
    public function childRegistrationGenderAjax($id)
    {
        $age = AddChild::where('id', $id)->value('id_number');
        $string = (string)$age;
        $gender = 'ذكر';
        if (substr($string, -2, 1) % 2 == 0) {
            $gender = 'انثي';
        }
        return json_encode($gender);
    }
//محل الاميلاد
    public function childRegistrationCityAjax($id)
    {
        $age = AddChild::where('id', $id)->value('id_number');
        $string = (string)$age;
        $city = 'تاكد من رقم الميلاد';

        if (substr($string, -7, 2) == 01) {
            $city = 'القاهرة';
        } elseif (substr($string, -7, 2) == 02) {
            $city = 'الإسكندرية';
        } elseif (substr($string, -7, 2) == 03) {
            $city = 'بورسعيد';
        } elseif (substr($string, -7, 2) == 04) {
            $city = 'السويس';
        } elseif (substr($string, -7, 2) == 11) {
            $city = 'دمياط';
        } elseif (substr($string, -7, 2) == 12) {
            $city = 'الدقهلية';
        } elseif (substr($string, -7, 2) == 13) {
            $city = 'الشرقية';
        } elseif (substr($string, -7, 2) == 14) {
            $city = 'القليوبية';
        } elseif (substr($string, -7, 2) == 15) {
            $city = 'كفر الشيخ';
        } elseif (substr($string, -7, 2) == 16) {
            $city = 'الغربية';
        } elseif (substr($string, -7, 2) == 17) {
            $city = 'المنوفية';
        } elseif (substr($string, -7, 2) == 18) {
            $city = 'البحيرة';
        } elseif (substr($string, -7, 2) == 35) {
            $city = 'الإسماعيلية';
        } elseif (substr($string, -7, 2) == 88) {
            $city = 'الجيزة';
        } elseif (substr($string, -7, 2) == 22) {
            $city = 'بني سويف';
        } elseif (substr($string, -7, 2) == 23) {
            $city = 'الفيوم';
        } elseif (substr($string, -7, 2) == 24) {
            $city = 'المنيا';
        } elseif (substr($string, -7, 2) == 25) {
            $city = 'أسيوط';
        } elseif (substr($string, -7, 2) == 26) {
            $city = 'سوهاج';
        } elseif (substr($string, -7, 2) == 27) {
            $city = 'قنا';
        } elseif (substr($string, -7, 2) == 28) {
            $city = 'أسوان';
        } elseif (substr($string, -7, 2) == 29) {
            $city = 'الأقصر';
        } elseif (substr($string, -7, 2) == 31) {
            $city = 'البحر الأحمر';
        } elseif (substr($string, -7, 2) == 32) {
            $city = 'الوادى الجديد';
        } elseif (substr($string, -7, 2) == 33) {
            $city = 'مطروح';
        } elseif (substr($string, -7, 2) == 34) {
            $city = 'شمال سيناء';
        } elseif (substr($string, -7, 2) == 35) {
            $city = 'جنوب سيناء';
        } elseif (substr($string, -7, 2) == 88) {
            $city = 'خارج الجمهورية';
        }
        return json_encode($city);
    }
}
