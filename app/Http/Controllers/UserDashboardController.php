<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
