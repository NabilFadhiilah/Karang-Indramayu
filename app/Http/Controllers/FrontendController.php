<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Paket;
use App\Models\Pengembangan;
use App\Models\PengembanganWisata;
use App\Models\Wisata;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index()
    {
        # code...
        $data = PengembanganWisata::with(
            [
                'relationToWisata' => function ($query) {
                    $query->limit(3)->get();
                },
                'relationToGallery'
            ]
        )->limit(3)->latest()->get();
        return view('index', ['data' => $data]);
    }

    public function eksplor()
    {
        # code...
        $dataWisata = Wisata::all();
        return view('eksplor', ['wisata' => $dataWisata]);
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
