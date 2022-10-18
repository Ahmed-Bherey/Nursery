<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;

class LoginController extends Controller
{
    //
    public function loginForm()
    {
        return view('admin.pages.auth.login');
    }

    public function login(Request $request)
    {
        $active = User::where('email',$request->email)->value('active');
        if ($active == 1){
            if (auth()->guard('web')->attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ])) {
                return redirect()->route('dashboard')->with(['success' => 'مرحبا ' . Auth::user()->name_ar . ' 😇']);
            } else {
                return redirect()->back()->with(['error' => '😕  ' . 'هناك خطا بالبيانات']);
            }
        }else{
            return redirect()->back()->with(['error' => '😡 ' . 'عذرا ليس لديك تصريح']);
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::forget('yourKeyGoesHere');
        session()->regenerate();
        Artisan::call('cache:clear');
        return redirect()
            ->route('admin.login')
            ->with(['success' => '☹️ ' . 'تم الخروج بنجاح']);
    }
}
