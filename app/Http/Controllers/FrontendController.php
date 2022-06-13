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
        // dd(request('search'));


        $dataWisata = Wisata::with('relationToGallery')->latest();
        if (request('search')) {
            # code...
            $dataWisata->where('nama_wisata', 'like', '%' . request('search') . '%');
        }
        return view('eksplor', ['wisata' => $dataWisata->paginate(5)]);
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
        $data = PengembanganWisata::with(
            'relationToWisata',
            'relationToGallery'
        )->latest();
        if (request('search')) {
            # code...
            $data->where('nama_wisata', 'like', '%' . request('search') . '%');
        }
        return view('eksplor-invest', ['data' => $data->paginate(5)]);
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
