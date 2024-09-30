<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function user_profile(){
        return view('user.profile');
    }

    public function specialist_profile(){
        return view('user.specialist_profile');
    }
}
