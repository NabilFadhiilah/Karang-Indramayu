<?php

namespace App\Http\Controllers;

use App\Models\LaporanPaket;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
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
        $data = ReservasiWisata::with('relationToWisata')->withSum('relationToLaporan', 'biaya_pengeluaran')->where('status_reservasi', '=', 'TERIMA')->where('bukti_reservasi', '!=', null)->get();
        // dd($data);
        return view('pages.admin.laporan-master.laporan-wisata', ['reservasi' => $data]);
    }

    public function CetakPdfWisata(Request $request)
    {
        # code...
        $data = ReservasiWisata::withSum('relationToLaporan', 'biaya_pengeluaran')->with('relationToWisata', 'relationToUser')->where('tgl_verifikasi', '>=', $request->tgl_awal)->where('tgl_verifikasi', '<=', $request->tgl_akhir)->get();
        $pdf = PDF::loadView('template-laporan.laporan-wisata-master', compact('data', 'request'))->setPaper('a4', 'potrait');
        return $pdf->stream(Carbon::now('Asia/Jakarta') . '_Laporan_Paket_' . $request->tgl_awal . '-' . $request->tgl_akhir . '.pdf');
        // return $pdf->download(Carbon::now('Asia/Jakarta') . '_Laporan_Paket_' . $request->tgl_awal . '-' . $request->tgl_akhir . '.pdf');
    }

    public function laporanPaket()
    {
        # code...
        $data = ReservasiPaketWisata::with('relationToWisata')->withSum('relationToLaporan', 'biaya_pengeluaran')->where('status_reservasi', '=', 'TERIMA')->where('bukti_reservasi', '!=', null)->get();
        return view('pages.admin.laporan-master.laporan-paket', ['paket' => $data]);
    }

    public function CetakPdfPaket(Request $request)
    {
        # code...
        $data = ReservasiPaketWisata::withSum('relationToLaporan', 'biaya_pengeluaran')->with('relationToPaket', 'relationToUser')->where('tgl_verifikasi', '>=', $request->tgl_awal)->where('tgl_verifikasi', '<=', $request->tgl_akhir)->get();
        $pdf = PDF::loadView('template-laporan.laporan-paket-master', compact('data', 'request'))->setPaper('a4', 'potrait');
        return $pdf->stream(Carbon::now('Asia/Jakarta') . '_Laporan_Paket_' . $request->tgl_awal . '-' . $request->tgl_akhir . '.pdf');
        // return $pdf->download(Carbon::now('Asia/Jakarta') . '_Laporan_Paket_' . $request->tgl_awal . '-' . $request->tgl_akhir . '.pdf');
    }

    public function laporanInvest()
    {
        # code...
        $data = PengembanganWisata::with(
            'relationToWisata',
        )->withSum(['relationToPengembanganWisata' => function ($query) {
            $query->where('status', 'TERIMA');
        }], 'pendanaan')->get();
        return view('pages.admin.laporan-master.laporan-pengembangan', ['pengembangan' => $data]);
    }
}
