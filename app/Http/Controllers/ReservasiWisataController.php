<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ReservasiWisata;
use App\Http\Requests\StoreReservasiWisataRequest;
use App\Http\Requests\UpdateReservasiWisataRequest;

class ReservasiWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = ReservasiWisata::with('relationToWisata')->get();
        return view('pages.admin.verifikasiWisata.index', ['reservasi' => $data]);
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
     * @param  \App\Http\Requests\StoreReservasiWisataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReservasiWisataRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReservasiWisata  $verifikasi_wisatum
     * @return \Illuminate\Http\Response
     */
    public function show(ReservasiWisata $verifikasi_wisatum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReservasiWisata  $verifikasi_wisatum
     * @return \Illuminate\Http\Response
     */
    public function edit(ReservasiWisata $verifikasi_wisatum)
    {
        //
        $verifikasi_wisatum->load('relationToWisata', 'relationToRekening', 'relationToUser');
        // dd($verifikasi_wisatum);
        return view('pages.admin.verifikasiWisata.edit', ['reservasi' => $verifikasi_wisatum]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReservasiWisataRequest  $request
     * @param  \App\Models\ReservasiWisata  $verifikasi_wisatum
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReservasiWisataRequest $request, ReservasiWisata $verifikasi_wisatum)
    {
        //
        $verifikasi_wisatum->update([
            'status_reservasi' => $request->status_reservasi,
            'tgl_verifikasi' => Carbon::now('Asia/Jakarta')
        ]);
        return redirect()->route('admin.verifikasi-wisata.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReservasiWisata  $verifikasi_wisatum
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReservasiWisata $verifikasi_wisatum)
    {
        //
    }
}
