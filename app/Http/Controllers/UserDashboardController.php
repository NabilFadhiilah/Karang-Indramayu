<?php

namespace App\Http\Controllers;

use App\Models\Pengembangan;
use App\Models\ReservasiWisata;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    //
    public function index()
    {
        # code...
        return view('pages.user.biodata');
    }

    public function bioUpdate(Request $request, User $user)
    {
        # code...
        $user->update([
            'nama' => $request->nama,
            'no_tlp' => $request->no_telp,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);
        return redirect()->route('dashboard-user');
    }

    public function detail(ReservasiWisata $reservasiWisata)
    {
        # code...
        $reservasiWisata->load('relationToWisata', 'relationToGallery', 'relationToRekening');
        return view('pages.user.detail', compact('reservasiWisata'));
    }
    public function pending()
    {
        # code...
        $data = ReservasiWisata::with('relationToWisata', 'relationToRekening')->where('bukti_reservasi', '=', null)->where('id_user', Auth::user()->id)->get();
        $dataInvest = Pengembangan::with('relationToRekening')->leftJoin('pengembangan_wisata', 'pengembangan.id_pengembangan', '=', 'pengembangan_wisata.id')->leftJoin('wisata', 'pengembangan_wisata.id_wisata', '=', 'wisata.id')->select('pengembangan.*', 'wisata.nama_wisata')->where('bukti_pembayaran', '=', null)->where('id_user', Auth::user()->id)->get();
        // dd($dataInvest);
        return view('pages.user.pending', ['pending' => $data, 'pendingInvest' => $dataInvest]);
    }
    public function riwayat()
    {
        # code...
        $data = ReservasiWisata::with('relationToWisata', 'relationToGallery')->where('id_user', Auth::user()->id)->latest()->get();
        return view('pages.user.riwayat', ['riwayat' => $data]);
    }
}
