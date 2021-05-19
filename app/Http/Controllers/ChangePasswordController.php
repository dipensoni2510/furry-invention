<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function edit(User $user)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['name' => "Change Password"]
        ];

        return view('pages.user-changepassword', ['breadcrumbs' => $breadcrumbs]);
    }

    public function update(User $user)
    {
        //dd('function called');
        $validate = request()->validate(
            [
                'old-password' => 'required|min:6|max:15',
                'password' => 'required|min:6|max:15|confirmed',
            ]
        );

        $hashed_password = User::where('id', auth()->user()->id)->first();

        if (Hash::check($validate['old-password'], $hashed_password->password)) {
            $user->where('id', auth()->user()->id)->update(['password' => Hash::make($validate['password'])]);
            return redirect()->route('home')->with('message', 'Password Changed!');
        } else {
            return redirect()->route('change-password')->with('message', 'Old Password is not Correct!');
        }
        // return redirect()->route('userdashboard')->with('message', 'Password Changed!');
    }
}
