<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['name' => "Edit Profile"]
        ];
        return view('pages.user-profile-edit', ['user' => User::where('id', auth()->user()->id)->first(), 'breadcrumbs' => $breadcrumbs]);
    }

    public function update(User $user)
    {
        $validate = request()->validate(
            [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|max:255',
                'mobile' => 'required|max:255'
            ]
        );

        $user->where('id', auth()->user()->id)->update($validate);
        // User::where('id', auth()->user()->id)
        //     ->update($validate);

        //User::update()  auth()->user()->update($validate);
        return redirect()->route('home')->with('message', 'Profile Updated!');
    }
}
