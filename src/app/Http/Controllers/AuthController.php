<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UserRequest;


class AuthController extends Controller
{

    public function toRegister(){

        return view('register');
    }

    public function thanks(UserRequest $request){

        $user = $request->all();
        User::create($user);

        return view('thanks');
    }

    public function toLogin(){

        return view('auth.login');
    }

}
