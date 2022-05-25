<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index()
    {
        # code...
        return view('index');
    }

    public function eksplor()
    {
        # code...
        return view('eksplor');
    }
    public function wisata()
    {
        # code...
        return view('wisata');
    }
    public function checkout()
    {
        # code...
        return view('checkout');
    }
    public function pembayaran()
    {
        # code...
        return view('pembayaran');
    }
    public function sukses()
    {
        # code...
        return view('sukses');
    }
}
