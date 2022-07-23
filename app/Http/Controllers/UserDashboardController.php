<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengembangan;
use Illuminate\Http\Request;
use App\Models\ReservasiWisata;
use App\Models\ReservasiPaketWisata;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $data = $request->validate([
            'nama' => 'required|max:255',
            'no_tlp' => 'required|max:255',
            'alamat' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'avatar' => 'file|max:1024'
        ]);
        // dd($data);
        if ($request->hasFile('avatar')) {
            if (auth()->user()->avatar != null) {
                Storage::delete(auth()->user()->avatar);
            }
            $dataAvatar = $request->file('avatar')->store('avatar');
            $user->update([
                'avatar' => $dataAvatar
            ]);
        }
        $user->update([
            'nama' => $data['nama'],
            'no_tlp' => $data['no_tlp'],
            'alamat' => $data['alamat'],
            'jenis_kelamin' => $data['jenis_kelamin'],
        ]);
        return redirect()->route('dashboard-user')->with('sukses', 'Profil Berhasil Diupdate!');
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
        $dataWisata = ReservasiWisata::with('relationToWisata', 'relationToRekening')->where('bukti_reservasi', '=', null)->where('id_user', Auth::user()->id)->get();
        $dataPaket = ReservasiPaketWisata::with('relationToPaket', 'relationToRekening')->where('bukti_reservasi', '=', null)->where('id_user', Auth::user()->id)->get();
        $dataInvest = Pengembangan::with('relationToRekening')->leftJoin('pengembangan_wisata', 'pengembangan.id_pengembangan', '=', 'pengembangan_wisata.id')->leftJoin('wisata', 'pengembangan_wisata.id_wisata', '=', 'wisata.id')->select('pengembangan.*', 'wisata.nama_wisata', 'wisata.slug')->where('bukti_pembayaran', '=', null)->where('id_user', Auth::user()->id)->get();
        return view('pages.user.pending', ['pendingWisata' => $dataWisata, 'pendingInvest' => $dataInvest, 'pendingPaket' => $dataPaket]);
    }
    public function riwayat()
    {
        # code...
        $dataWisata = ReservasiWisata::with(['relationToWisata' => function ($query) {
            $query->leftJoin('gallery', 'wisata.id', '=', 'gallery.id_wisata')->select('wisata.*', 'gallery.image')->get();
        }])->where('id_user', Auth::user()->id)->where('bukti_reservasi', '!=', null)->latest()->get();
        $dataPaket = ReservasiPaketWisata::with('relationToPaket')->where('bukti_reservasi', '!=', null)->where('id_user', Auth::user()->id)->get();
        $dataInvest = Pengembangan::join('pengembangan_wisata', 'pengembangan.id_pengembangan', '=', 'pengembangan_wisata.id')->leftJoin('wisata', 'pengembangan_wisata.id_wisata', '=', 'wisata.id')->select('pengembangan.*', 'wisata.nama_wisata', 'wisata.slug')->where('bukti_pembayaran', '!=', null)->where('id_user', Auth::user()->id)->get();
        // dd($dataPaket, $dataInvest);
        return view('pages.user.riwayat', ['riwayatWisata' => $dataWisata, 'riwayatPaket' => $dataPaket, 'riwayatInvest' => $dataInvest]);
    }
}
