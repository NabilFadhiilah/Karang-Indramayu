<?php

namespace App\Http\Controllers;

use App\Models\Pengembangan;
use Illuminate\Http\Request;
use App\Models\ReservasiWisata;
use App\Models\PengembanganWisata;
use App\Models\ReservasiPaketWisata;

class LaporanMasterController extends Controller
{
    //
    public function laporanWisata()
    {
        # code...
        $data = ReservasiWisata::with('relationToWisata')->where('status_reservasi', '=', 'TERIMA')->where('bukti_reservasi', '!=', null)->get();
        return view('pages.admin.laporan-master.laporan-wisata', ['reservasi' => $data]);
    }
    public function laporanPaket()
    {
        # code...
        $data = ReservasiPaketWisata::with('relationToPaket')->where('status_reservasi', '=', 'TERIMA')->where('bukti_reservasi', '!=', null)->get();
        // dd($data);
        return view('pages.admin.laporan-master.laporan-paket', ['paket' => $data]);
    }
    public function laporanInvest()
    {
        # code...
        $data = PengembanganWisata::with(
            'relationToWisata',
        )->withSum(['relationToPengembanganWisata' => function ($query) {
            $query->where('status', 'TERIMA');
        }], 'pendanaan')->get();
        // dd($data);
        return view('pages.admin.laporan-master.laporan-pengembangan', ['pengembangan' => $data]);
    }
}
