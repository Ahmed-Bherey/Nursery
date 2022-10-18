<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    //
    public function create()
    {
        $users = User::where('delete_at', 0)->get();
        return view('admin.pages.users.create', compact('users'));
    }

    public function store(StoreUserRequest $request)
    {
        $active = 0;
        if ($request->active == 1) {
            $active = 1;
        }
        User::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'password2' => $request->password,
            'adderess' => $request->adderess,
            'tel' => $request->tel,
            'whatsapp' => $request->whatsapp,
            'active' => $active,
        ]);
        //    dd($request->address);
        return redirect()
            ->back()
            ->with(['success' => ' تم  بنجاح']);
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('admin.pages.users.edit', compact('users'));
    }

    public function update(StoreUserRequest $request, $id)
    {
        $users = User::findOrFail($id);
        $active = 0;
        if ($request->active == 1) {
            $active = 1;
        }

        $password = Hash::make($request->password);
        if ($request->adderess) {
            $password = $request->oldPassword;
        }
        $users->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'email' => $request->email,
            'password' => $password,
            'adderess' => $request->adderess,
            'tel' => $request->tel,
            'whatsapp' => $request->whatsapp,
            'active' => $active,
        ]);
        return redirect()
            ->route('user.create')
            ->with(['success' => ' تم  التحديث بنجاح']);
    }

    public function destroy($id)
    {
        if ($id == Auth::user()->id) {
            return redirect()
                ->back()
                ->with(['error' => 'لا يمكن حذف المستخدم الحالى']);
        } else {
            User::where('delete_at', 0)
                ->where('id', $id)
                ->delete();
        }

        return redirect()
            ->back()
            ->with(['success' => 'تم الحذف بنجاح']);
    }
}
