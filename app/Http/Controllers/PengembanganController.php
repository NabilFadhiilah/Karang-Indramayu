<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Wisata;
use App\Models\Pengembangan;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StorePengembanganRequest;
use App\Http\Requests\UpdatePengembanganRequest;
use App\Mail\Admin\AfterVerifiedPengembangan;
use App\Mail\Admin\SendPengembanganPromise;

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
        $data = Pengembangan::leftJoin('pengembangan_wisata', 'pengembangan.id_pengembangan', '=', 'pengembangan_wisata.id')->leftJoin('wisata', 'pengembangan_wisata.id_wisata', '=', 'wisata.id')->select('pengembangan.*', 'wisata.nama_wisata')->where('bukti_pembayaran', '!=', null)->get();
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
        $verifikasi_pengembangan->load('relationToRekening', 'relationToUser');
        // dd($verifikasi_pengembangan);
        return view('pages.admin.verifikasiPengembangan.show', ['verifikasi' => $verifikasi_pengembangan]);
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
        // dd($verifikasi_pengembangan);
        $verifikasi_pengembangan->update([
            'status' => $request->status_reservasi,
            'tgl_verifikasi' => Carbon::now('Asia/Jakarta'),
            'keterangan' => $request->keterangan
        ]);
        $verifikasi_pengembangan->load(['relationToUser', 'relationToPengembanganOne' => function ($query) {
            $query->join('wisata', 'wisata.id', '=', 'pengembangan_wisata.id_wisata')->select('pengembangan_wisata.*', 'wisata.nama_wisata')->get();
        }]);
        Mail::to($verifikasi_pengembangan->relationToUser->email)->send(new AfterVerifiedPengembangan($verifikasi_pengembangan));
        if ($request->status_reservasi == 'TERIMA') {
            Mail::to($verifikasi_pengembangan->relationToUser->email)->send(new SendPengembanganPromise($verifikasi_pengembangan));
        }
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
