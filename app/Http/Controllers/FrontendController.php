<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Wisata;
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
        $dataPaketWisata = Wisata::all();
        return view('eksplor', ['wisata' => $dataPaketWisata]);
        // return view('eksplor');
    }
    public function wisata()
    {
        # code...
        return view('wisata');
    }

    public function invest()
    {
        # code...
        return view('eksplor-invest');
    }
    public function InvestWisata()
    {
        # code...
        return view('detail-invest');
    }
    public function pembayaraninvest()
    {
        # code...
        return view('pembayaran');
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
