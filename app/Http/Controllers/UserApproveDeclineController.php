<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserApproveDeclineController extends Controller
{
    public function store()
    {
        if (request()->is('user-approve')) {
            User::where('id', request('id'))->update(['status' => 'approved']);
            return 'Approved ' . request('id') . '.';
        } elseif (request()->is('user-decline')) {
            User::where('id', request('id'))->update(['status' => 'declined']);
            return 'Not Approved' . request('id') . '.';
        } else {
            dd('');
        }
    }
}
