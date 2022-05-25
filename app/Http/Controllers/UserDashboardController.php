<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    //
    public function index()
    {
        # code...
        return view('pages.user.biodata');
    }
    public function detail()
    {
        # code...
        return view('pages.user.detail');
    }
    public function pending()
    {
        # code...
        return view('pages.user.pending');
    }
    public function riwayat()
    {
        # code...
        return view('pages.user.riwayat');
    }
}
