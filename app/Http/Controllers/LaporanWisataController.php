<?php

namespace App\Http\Controllers;

use App\Models\LaporanWisata;
use App\Http\Requests\StoreLaporanWisataRequest;
use App\Http\Requests\UpdateLaporanWisataRequest;
use App\Models\ReservasiWisata;

class LaporanWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReservasiWisata $reservasi_wisatum)
    {
        //
        // dd(LaporanWisata::where('id_reservasi_wisata', '=', $reservasi_wisatum->id)->get());
        $pengeluaran = LaporanWisata::where('id_reservasi_wisata', '=', $reservasi_wisatum->id)->get();
        return view('pages.admin.laporan-wisata.index', ['pengeluaran' => $pengeluaran, 'wisata' => $reservasi_wisatum]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ReservasiWisata $reservasi_wisatum)
    {
        //
        return view('pages.admin.laporan-wisata.create', ['wisata' => $reservasi_wisatum]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLaporanWisataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservasiWisata $reservasi_wisatum, StoreLaporanWisataRequest $request)
    {
        //
        LaporanWisata::create([
            'id_reservasi_wisata' => $reservasi_wisatum->id,
            'pengeluaran' => $request->pengeluaran,
            'biaya_pengeluaran' => $request->biaya_pengeluaran
        ]);
        return redirect()->route('admin.reservasi-wisata.laporan-wisata.index', $reservasi_wisatum->id)->with('sukses', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LaporanWisata  $laporan_wisatum
     * @return \Illuminate\Http\Response
     */
    public function show(ReservasiWisata $reservasi_wisatum, LaporanWisata $laporan_wisatum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LaporanWisata  $laporan_wisatum
     * @return \Illuminate\Http\Response
     */
    public function edit(ReservasiWisata $reservasi_wisatum, LaporanWisata $laporan_wisatum)
    {
        //
        return view('pages.admin.laporan-wisata.edit', ['data' => $laporan_wisatum, 'wisata' => $reservasi_wisatum]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLaporanWisataRequest  $request
     * @param  \App\Models\LaporanWisata  $laporan_wisatum
     * @return \Illuminate\Http\Response
     */
    public function update(ReservasiWisata $reservasi_wisatum, UpdateLaporanWisataRequest $request, LaporanWisata $laporan_wisatum)
    {
        //
        $data = $request->all();
        $laporan_wisatum->update($data);
        return redirect()->route('admin.reservasi-wisata.laporan-wisata.index', $reservasi_wisatum->id)->with('sukses', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LaporanWisata  $laporan_wisatum
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReservasiWisata $reservasi_wisatum, LaporanWisata $laporan_wisatum)
    {
        //
        $laporan_wisatum->delete();
        return redirect()->route('admin.reservasi-wisata.laporan-wisata.index', $reservasi_wisatum->id)->with('sukses', 'Data Berhasil Dihapus');
    }
}
