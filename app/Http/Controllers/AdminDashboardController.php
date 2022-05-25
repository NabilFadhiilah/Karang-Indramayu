<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        # code...
        return view('pages.admin.index');
    }
}
