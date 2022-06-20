<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pengembangan;
use App\Http\Requests\StorePengembanganRequest;
use App\Http\Requests\UpdatePengembanganRequest;
use App\Models\Wisata;

class PengembanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Pengembangan::leftJoin('pengembangan_wisata', 'pengembangan.id_pengembangan', '=', 'pengembangan_wisata.id')->leftJoin('wisata', 'pengembangan_wisata.id_wisata', '=', 'wisata.id')->select('pengembangan.*', 'wisata.nama_wisata')->get();
        // dd($data);
        return view('pages.admin.verifikasiPengembangan.index', ['pengembangan' => $data]);
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
     * @param  \App\Http\Requests\StorePengembanganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengembanganRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengembangan  $verifikasi_pengembangan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengembangan $verifikasi_pengembangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengembangan  $verifikasi_pengembangan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengembangan $verifikasi_pengembangan)
    {
        //
        $verifikasi_pengembangan->load('relationToRekening', 'relationToUser');
        // dd($verifikasi_pengembangan);
        return view('pages.admin.verifikasiPengembangan.edit', ['verifikasi' => $verifikasi_pengembangan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePengembanganRequest  $request
     * @param  \App\Models\Pengembangan  $verifikasi_pengembangan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePengembanganRequest $request, Pengembangan $verifikasi_pengembangan)
    {
        //
        $verifikasi_pengembangan->update([
            'status' => $request->status_reservasi,
            'tgl_verifikasi' => Carbon::now('Asia/Jakarta')
        ]);
        // dd($verifikasi_pengembangan);
        return redirect()->route('admin.verifikasi-pengembangan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengembangan  $verifikasi_pengembangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengembangan $verifikasi_pengembangan)
    {
        //
    }
}
