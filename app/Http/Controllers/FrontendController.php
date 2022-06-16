<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Paket;
use App\Models\Pengembangan;
use App\Models\PengembanganWisata;
use App\Models\Rekening;
use App\Models\Wisata;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index()
    {
        # code...
        $dataWisata = Wisata::with('relationToGallery')->limit(3)->get();
        $data = PengembanganWisata::with(
            [
                'relationToWisata' => function ($query) {
                    $query->limit(3)->get();
                },
                'relationToGallery'
            ]
        )->limit(3)->latest()->get();
        return view('index', ['data' => $data, 'dataWisata' => $dataWisata]);
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
    public function wisata(Wisata $wisata)
    {
        # code...
        $wisata->load('relationToGallery');
        return view('wisata', compact('wisata'));
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

    public function checkout(Wisata $wisata)
    {
        # code...
        $wisata->load('relationToGallery');
        $dataRekening = Rekening::all();
        return view('checkout', compact('wisata', 'dataRekening'));
    }
    public function pembayaran()
    {
        # code...
        return view('pembayaran');
    }
    public function sukses(Request $request, Wisata $wisata)
    {
        # code...
        return view('sukses');
    }
}
