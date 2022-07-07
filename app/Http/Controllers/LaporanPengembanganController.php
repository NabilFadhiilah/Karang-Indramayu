<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pengembangan;
use App\Models\PengembanganWisata;
use App\Models\LaporanPengembangan;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Http\Requests\StoreLaporanPengembanganRequest;
use App\Http\Requests\UpdateLaporanPengembanganRequest;

class LaporanPengembanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PengembanganWisata $reservasi_pengembangan)
    {
        //
        $pengeluaran = LaporanPengembangan::where('id_pengembangan', '=', $reservasi_pengembangan->id)->get();
        // dd($pengeluaran);
        return view('pages.admin.laporan-pengembangan.index', ['pengeluaran' => $pengeluaran, 'pengembangan' => $reservasi_pengembangan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PengembanganWisata $reservasi_pengembangan)
    {
        //
        return view('pages.admin.laporan-pengembangan.create', ['pengembangan' => $reservasi_pengembangan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLaporanPengembanganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengembanganWisata $reservasi_pengembangan, StoreLaporanPengembanganRequest $request)
    {
        //
        LaporanPengembangan::create([
            'id_pengembangan' => $reservasi_pengembangan->id,
            'pengeluaran' => $request->pengeluaran,
            'biaya_pengeluaran' => $request->biaya_pengeluaran
        ]);
        return redirect()->route('admin.reservasi-pengembangan.laporan-pengembangan.index', $reservasi_pengembangan->id)->with('sukses', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LaporanPengembangan  $laporan_pengembangan
     * @return \Illuminate\Http\Response
     */
    public function show(PengembanganWisata $reservasi_pengembangan, LaporanPengembangan $laporan_pengembangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LaporanPengembangan  $laporan_pengembangan
     * @return \Illuminate\Http\Response
     */
    public function edit(PengembanganWisata $reservasi_pengembangan, LaporanPengembangan $laporan_pengembangan)
    {
        //
        return view('pages.admin.laporan-pengembangan.edit', ['data' => $laporan_pengembangan, 'pengembangan' => $reservasi_pengembangan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLaporanPengembanganRequest  $request
     * @param  \App\Models\LaporanPengembangan  $laporan_pengembangan
     * @return \Illuminate\Http\Response
     */
    public function update(PengembanganWisata $reservasi_pengembangan, UpdateLaporanPengembanganRequest $request, LaporanPengembangan $laporan_pengembangan)
    {
        //
        $data = $request->all();
        $laporan_pengembangan->update($data);
        return redirect()->route('admin.reservasi-pengembangan.laporan-pengembangan.index', $reservasi_pengembangan->id)->with('sukses', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LaporanPengembangan  $laporan_pengembangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PengembanganWisata $reservasi_pengembangan, LaporanPengembangan $laporan_pengembangan)
    {
        //
        $laporan_pengembangan->delete();
        return redirect()->route('admin.reservasi-pengembangan.laporan-pengembangan.index', $reservasi_pengembangan->id)->with('sukses', 'Data Berhasil Dihapus');
    }

    public function generatePDF(PengembanganWisata $reservasi_pengembangan)
    {
        # code...
        # Query Data
        $reservasi_pengembangan->load('relationToWisata', 'relationToUser', 'relationToRekening', 'relationToLaporan')->get();

        # Downloading Data
        // dd($reservasi_pengembangan);
        $pdf = PDF::loadView('template-laporan.laporan-pengembangan', compact('reservasi_wisatum'));
        return $pdf->download(Carbon::now('Asia/Jakarta') . '_Laporan_Wisata_' . $reservasi_pengembangan->id . '.pdf');
    }
}
