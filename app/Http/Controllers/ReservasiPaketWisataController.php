<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ReservasiPaketWisata;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreReservasiPaketWisataRequest;
use App\Http\Requests\UpdateReservasiPaketWisataRequest;
use App\Mail\Admin\AfterVerifiedPaket;
use App\Mail\Admin\SendTicketPaket;

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
        $data = ReservasiPaketWisata::with('relationToPaket')->where('bukti_reservasi', '!=', null)->latest()->get();
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
        $verifikasi_paket->load('relationToPaket', 'relationToRekening', 'relationToUserOne');
        // dd($verifikasi_paket);
        return view('pages.admin.verifikasiPaket.show', ['reservasi' => $verifikasi_paket]);
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
        $verifikasi_paket->load('relationToPaket', 'relationToRekening', 'relationToUserOne');
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
            'tgl_verifikasi' => Carbon::now('Asia/Jakarta'),
            'keterangan' => $request->keterangan
        ]);
        $verifikasi_paket->load('relationToUserOne', 'relationToPaketOne');
        Mail::to($verifikasi_paket->relationToUserOne->email)->send(new AfterVerifiedPaket($verifikasi_paket));
        if ($request->status_reservasi == 'TERIMA') {
            Mail::to($verifikasi_paket->relationToUserOne->email)->send(new SendTicketPaket($verifikasi_paket));
        }
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
