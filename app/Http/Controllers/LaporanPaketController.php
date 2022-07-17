<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\LaporanPaket;
use Illuminate\Http\Request;
use App\Models\ReservasiWisata;
use App\Models\ReservasiPaketWisata;
use Illuminate\Foundation\Auth\User;
use App\Http\Requests\StoreLaporanPaketRequest;
use App\Http\Requests\UpdateLaporanPaketRequest;

class LaporanPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReservasiPaketWisata $reservasi_paket)
    {
        //
        $pengeluaran = LaporanPaket::where('id_reservasi_paket', '=', $reservasi_paket->id)->get();
        return view('pages.admin.laporan-paket.index', ['pengeluaran' => $pengeluaran, 'paket' => $reservasi_paket]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ReservasiPaketWisata $reservasi_paket)
    {
        //
        return view('pages.admin.laporan-paket.create', ['paket' => $reservasi_paket]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLaporanPaketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservasiPaketWisata $reservasi_paket, StoreLaporanPaketRequest $request)
    {
        //
        LaporanPaket::create([
            'id_reservasi_paket' => $reservasi_paket->id,
            'pengeluaran' => $request->pengeluaran,
            'biaya_pengeluaran' => $request->biaya_pengeluaran
        ]);
        return redirect()->route('admin.reservasi-paket.laporan-paket.index', $reservasi_paket->id)->with('sukses', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LaporanPaket  $laporan_paket
     * @return \Illuminate\Http\Response
     */
    public function show(ReservasiPaketWisata $reservasi_paket, LaporanPaket $laporan_paket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LaporanPaket  $laporan_paket
     * @return \Illuminate\Http\Response
     */
    public function edit(ReservasiPaketWisata $reservasi_paket, LaporanPaket $laporan_paket)
    {
        //
        return view('pages.admin.laporan-paket.edit', ['data' => $laporan_paket, 'paket' => $reservasi_paket]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLaporanPaketRequest  $request
     * @param  \App\Models\LaporanPaket  $laporan_paket
     * @return \Illuminate\Http\Response
     */
    public function update(ReservasiPaketWisata $reservasi_paket, UpdateLaporanPaketRequest $request, LaporanPaket $laporan_paket)
    {
        //
        $data = $request->all();
        $laporan_paket->update($data);
        return redirect()->route('admin.reservasi-paket.laporan-paket.index', $reservasi_paket->id)->with('sukses', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LaporanPaket  $laporan_paket
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReservasiPaketWisata $reservasi_paket, LaporanPaket $laporan_paket)
    {
        //
        $laporan_paket->delete();
        return redirect()->route('admin.reservasi-paket.laporan-paket.index', $reservasi_paket->id)->with('sukses', 'Data Berhasil Dihapus');
    }

    public function generatePDF(ReservasiPaketWisata $reservasi_paket)
    {
        # code...
        # Query Data
        $reservasi_paket->load('relationToPaket', 'relationToUser', 'relationToRekening', 'relationToLaporan')->get();

        # Downloading Data
        $pdf = PDF::loadView('template-laporan.laporan-paket', compact('reservasi_paket'))->setPaper('a4', 'potrait');
        return $pdf->stream(Carbon::now('Asia/Jakarta') . '_Laporan_Paket_' . $reservasi_paket->id . '.pdf');
        // return $pdf->download(Carbon::now('Asia/Jakarta') . '_Laporan_Paket_' . $reservasi_paket->id . '.pdf');
    }
}
