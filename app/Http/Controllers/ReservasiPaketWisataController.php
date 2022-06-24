<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ReservasiPaketWisata;
use App\Http\Requests\StoreReservasiPaketWisataRequest;
use App\Http\Requests\UpdateReservasiPaketWisataRequest;

class ReservasiPaketWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = ReservasiPaketWisata::with('relationToPaket')->get();
        // dd($data);
        return view('pages.admin.verifikasiPaket.index', ['paket' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReservasiPaketWisataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReservasiPaketWisataRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReservasiPaketWisata  $reservasiPaketWisata
     * @return \Illuminate\Http\Response
     */
    public function show(ReservasiPaketWisata $verifikasi_paket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReservasiPaketWisata  $reservasiPaketWisata
     * @return \Illuminate\Http\Response
     */
    public function edit(ReservasiPaketWisata $verifikasi_paket)
    {
        //
        $verifikasi_paket->load('relationToPaket', 'relationToRekening', 'relationToUser');
        // dd($verifikasi_paket);
        return view('pages.admin.verifikasiPaket.edit', ['reservasi' => $verifikasi_paket]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReservasiPaketWisataRequest  $request
     * @param  \App\Models\ReservasiPaketWisata  $reservasiPaketWisata
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReservasiPaketWisataRequest $request, ReservasiPaketWisata $verifikasi_paket)
    {
        //
        $verifikasi_paket->update([
            'status_reservasi' => $request->status_reservasi,
            'tgl_verifikasi' => Carbon::now('Asia/Jakarta')
        ]);
        return redirect()->route('admin.verifikasi-paket.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReservasiPaketWisata  $reservasiPaketWisata
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReservasiPaketWisata $verifikasi_paket)
    {
        //
    }
}
