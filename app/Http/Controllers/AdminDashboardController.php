<?php

namespace App\Http\Controllers;

use App\Models\Pengembangan;
use App\Models\ReservasiPaketWisata;
use Illuminate\Http\Request;
use App\Models\ReservasiWisata;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        # code...
        $wisata = ReservasiWisata::where('bukti_reservasi', '!=', null)->where('tgl_verifikasi', '=', null)->count();
        $paket = ReservasiPaketWisata::where('bukti_reservasi', '!=', null)->where('tgl_verifikasi', '=', null)->count();
        $invest = Pengembangan::where('bukti_pembayaran', '!=', null)->where('tgl_verifikasi', '=', null)->count();
        return view('pages.admin.index', ['wisata' => $wisata, 'paket' => $paket, 'invest' => $invest]);
    }
}
