<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Paket;
use App\Models\Wisata;
use App\Models\Gallery;
use App\Models\Rekening;
use App\Models\Pengembangan;
use Illuminate\Http\Request;
use App\Models\ReservasiWisata;
use App\Models\PengembanganWisata;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    //
    public function index()
    {
        /* 
        eager relation withsum and using where
        $sumpengembangan = PengembanganWisata::withSum(['relationToPengembanganWisata' => function ($query) {
            $query->where('status', 'TERIMA');
        }], 'pendanaan')->latest()->get(); 
        */
        # code...
        $dataWisata = Wisata::with('relationToGallery')->limit(3)->get();
        $data = PengembanganWisata::with(
            [
                'relationToWisata' => function ($query) {
                    $query->limit(3)->get();
                },
                'relationToGallery'
            ]
        )->withSum(['relationToPengembanganWisata' => function ($query) {
            $query->where('status', 'TERIMA');
        }], 'pendanaan')->limit(3)->latest()->get();
        return view('index', ['data' => $data, 'dataWisata' => $dataWisata]);
    }

    /*
    |--------------------------------------------------------------------------
    | Wisata Function
    |--------------------------------------------------------------------------
    */
    public function eksplor()
    {
        # code...
        $dataWisata = Wisata::with('relationToGallery')->latest();
        if (request('search')) {
            # code...
            $dataWisata->where('nama_wisata', 'like', '%' . request('search') . '%');
        }
        return view('eksplor', ['wisata' => $dataWisata->paginate(5)]);
    }
    public function wisata(Wisata $wisata)
    {
        # code...
        $wisata->load('relationToGallery');
        return view('wisata', compact('wisata'));
    }

    public function checkout(Wisata $wisata)
    {
        # code...
        $wisata->load('relationToGallery');
        $dataRekening = Rekening::all();
        return view('checkout', compact('wisata', 'dataRekening'));
    }

    public function pembayaranWisataStore(Request $request, Wisata $wisata)
    {
        # code...
        $reservasi = ReservasiWisata::create([
            'id_user' => Auth::user()->id,
            'id_wisata' => $wisata->id,
            'id_rekening' => $request->rekening,
            'partisipan_reservasi' => $request->partisipan_reservasi,
            'tgl_reservasi' => $request->tgl_reservasi,
            'tgl_pesan_reservasi' => Carbon::now('Asia/Jakarta'),
            'tgl_batas_pembayaran' => Carbon::now('Asia/Jakarta')->addDays(3),
            'total_reservasi' => $request->total_reservasi,
            'status_reservasi' => 'PENDING'
        ]);
        return redirect()->route('payment-wisata', [$wisata->slug, $reservasi->id]);
    }

    /* 
    Butuh validasi kalau user iseng buka link yang sama
    */
    public function pembayaranWisata(Wisata $wisata, ReservasiWisata $reservasiWisata)
    {
        # code...
        // dd($reservasiWisata);
        $data = $reservasiWisata->load('relationToRekening')->where('id_user', Auth::user()->id)->where('bukti_reservasi', '=', null)->get();
        return view('pembayaran-wisata', ['pembayaran' => $data]);
    }

    public function wisataUpload(Request $request, ReservasiWisata $reservasiWisata)
    {
        # code...
        // dd($request);
        if ($request->hasFile('bukti_pembayaran')) {
            $data = $request->file('bukti_pembayaran')->store('bukti_reservasi');
            $reservasiWisata->update([
                'bukti_reservasi' => $data
            ]);
        }
        return redirect()->route('sukses');
    }

    /*
    |--------------------------------------------------------------------------
    | Invest Function
    |--------------------------------------------------------------------------
    */
    public function invest()
    {
        # code...
        $data = PengembanganWisata::with(
            'relationToWisata',
            'relationToGallery'
        )->withSum(['relationToPengembanganWisata' => function ($query) {
            $query->where('status', 'TERIMA');
        }], 'pendanaan')->latest();
        if (request('search')) {
            # code...
            $data->where('nama_wisata', 'like', '%' . request('search') . '%');
        }
        return view('eksplor-invest', ['data' => $data->paginate(5)]);
    }
    public function InvestWisata(Wisata $wisata)
    {
        # code...
        $wisata->load('relationToGallery', 'relationToPengembangan');
        $rekening = Rekening::all();
        $data = DB::table('pengembangan')->where('id_pengembangan', '=', $wisata->relationToPengembangan->first()->id)->where('status', 'like', 'TERIMA')->sum('pendanaan');
        return view('detail-invest', compact('wisata', 'rekening', 'data'));
    }
    public function pembayaraninveststore(Request $request, Wisata $wisata)
    {
        # code...
        Pengembangan::create([
            'id_pengembangan' => $request->id_pengembangan,
            'id_user' => Auth::user()->id,
            'id_rekening' => $request->id_rekening,
            'pendanaan' => $request->pendanaan,
            'tgl_investasi' => Carbon::now('Asia/Jakarta'),
            'tgl_batas_pembayaran' => Carbon::now('Asia/Jakarta')->addDays(3),
            'status' => 'PENDING'
        ]);
        return redirect()->route('payment-invest', $wisata->slug);
    }

    /* 
    Butuh validasi kalau user iseng buka link yang sama
    */
    public function pembayaraninvest()
    {
        # code...
        $data = Pengembangan::with('relationToRekening')->where('id_user', Auth::user()->id)->latest()->limit(1)->get();
        // dd($data);
        return view('pembayaran-invest', ['pembayaran' => $data]);
    }

    public function investUpload(Request $request, Pengembangan $pengembangan)
    {
        # code...
        if ($request->hasFile('bukti_pembayaran')) {
            $data = $request->file('bukti_pembayaran')->store('bukti_invest');
            $pengembangan->update([
                'bukti_pembayaran' => $data
            ]);
        }
        return redirect()->route('sukses');
    }



    /* Payment Success */
    public function sukses()
    {
        # code...
        return view('sukses');
    }
}
