<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index()
    {
        # code...
        return view('login');
    }

    public function register()
    {
        # code...
        return view('register');
    }

    public function forgot()
    {
        # code...
        return view('forgot');
    }
}
