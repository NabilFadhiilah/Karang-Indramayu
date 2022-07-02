<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Paket;
use App\Models\Wisata;
use App\Models\Gallery;
use App\Models\Rekening;
use App\Models\PaketWisata;
use App\Models\Pengembangan;
use Illuminate\Http\Request;
use App\Models\ReservasiWisata;
use Dflydev\DotAccessData\Data;
use App\Models\PengembanganWisata;
use Illuminate\Support\Facades\DB;
use App\Models\ReservasiPaketWisata;
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
    | Paket Function
    |--------------------------------------------------------------------------
    */
    public function paket()
    {
        # code...
        $data = Paket::with(['relationToWisata' => function ($query) {
            $query->leftJoin('gallery', 'wisata.id', '=', 'gallery.id_wisata')->select('wisata.*', 'gallery.image');
        }])->paginate(5);
        return view('eksplor-paket', ['paket' => $data]);
    }

    public function paketWisata(Paket $paket)
    {
        # code...
        $wisata =
            DB::table('gallery')
            ->select('wisata.nama_wisata', 'paket_wisata.hari', 'paket_wisata.id_paket as laravel_through_key')
            ->join('wisata', 'wisata.id', '=', 'gallery.id_wisata')
            ->join('paket_wisata', 'paket_wisata.id_wisata', '=', 'wisata.id')
            ->whereIn('paket_wisata.id_paket', [$paket->id])
            ->groupBy('paket_wisata.id')
            ->get();
        $array = json_decode(json_encode($wisata), true);
        $collection = collect($array);
        $group = $collection->mapToGroups(function ($item) {
            return [$item['hari'] => $item['nama_wisata']];
        })->all();
        $bawah =
            DB::table('gallery')
            ->select('wisata.nama_wisata', 'wisata.deskripsi', 'gallery.image', 'wisata.slug', 'paket_wisata.hari', 'paket_wisata.id_paket as laravel_through_key')
            ->join('wisata', 'wisata.id', '=', 'gallery.id_wisata')
            ->join('paket_wisata', 'paket_wisata.id_wisata', '=', 'wisata.id')
            ->whereIn('paket_wisata.id_paket', [$paket->id])
            ->groupBy('wisata.id')
            ->get();
        return view('detail-paket', ['detailPaket' => $paket, 'detailWisata' => $group, 'bawah' => $bawah]);
    }

    public function checkoutPaket(Paket $paket)
    {
        # code...
        $paket->load('relationToPaketWisata');
        // dd($paket);
        $dataRekening = Rekening::all();
        return view('checkout-paket', compact('paket', 'dataRekening'));
    }

    public function pembayaranPaketStore(Request $request, Paket $paket)
    {
        # code...
        // dd($request->all());
        $data = $request->validate([
            'id_rekening' => 'required',
            'partisipan_reservasi' => 'required',
            'tgl_reservasi' => 'required',
            'total_reservasi' => 'required'
        ]);
        $reservasi = ReservasiPaketWisata::create([
            'id_user' => Auth::user()->id,
            'id_paket_wisata' => $paket->id,
            'id_rekening' => $data['id_rekening'],
            'partisipan_reservasi' => $data['partisipan_reservasi'],
            'tgl_reservasi' => $data['tgl_reservasi'],
            'tgl_pesan_reservasi' => Carbon::now('Asia/Jakarta'),
            'tgl_batas_pembayaran' => Carbon::now('Asia/Jakarta')->addDays(3),
            'total_reservasi' => $data['total_reservasi'],
            'status_reservasi' => 'PENDING'
        ]);
        return redirect()->route('payment-paket', [$paket->slug, $reservasi->id]);
    }

    public function pembayaranPaket(Paket $paket, ReservasiPaketWisata $ReservasiPaketWisata)
    {
        # code...
        $data = $ReservasiPaketWisata->load('relationToRekening')->where('id', '=', $ReservasiPaketWisata->id)->where('id_user', Auth::user()->id)->where('bukti_reservasi', '=', null)->get();
        return view('pembayaran-paket', ['pembayaran' => $data]);
    }

    public function paketUpload(Request $request, ReservasiPaketWisata $ReservasiPaketWisata)
    {
        # code...
        if ($request->hasFile('bukti_pembayaran')) {
            $data = $request->file('bukti_pembayaran')->store('bukti_reservasi_paket');
            $ReservasiPaketWisata->update([
                'bukti_reservasi' => $data
            ]);
        }
        return redirect()->route('sukses');
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
        return view('eksplor', ['wisata' => $dataWisata->paginate(5), 'paket' => PaketWisata::exists()]);
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
        $data = $request->validate([
            'id_rekening' => 'required',
            'partisipan_reservasi' => 'required',
            'tgl_reservasi' => 'required',
            'total_reservasi' => 'required'
        ]);
        $reservasi = ReservasiWisata::create([
            'id_user' => Auth::user()->id,
            'id_wisata' => $wisata->id,
            'id_rekening' => $data['id_rekening'],
            'partisipan_reservasi' => $data['partisipan_reservasi'],
            'tgl_reservasi' => $data['tgl_reservasi'],
            'tgl_pesan_reservasi' => Carbon::now('Asia/Jakarta'),
            'tgl_batas_pembayaran' => Carbon::now('Asia/Jakarta')->addDays(3),
            'total_reservasi' => $data['total_reservasi'],
            'status_reservasi' => 'PENDING'
        ]);
        return redirect()->route('payment-wisata', [$wisata->slug, $reservasi->id]);
    }

    public function pembayaranWisata(Wisata $wisata, ReservasiWisata $ReservasiWisata)
    {
        # code...
        // dd($ReservasiWisata);
        $data = $ReservasiWisata->load('relationToRekening')->where('id', '=', $ReservasiWisata->id)->where('id_user', Auth::user()->id)->where('bukti_reservasi', '=', null)->get();
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
        $wisata->load('relationToGallery', 'relationToPengembangan', 'relationToLaporan');
        // dd($wisata);
        $rekening = Rekening::all();
        $data = DB::table('pengembangan')->where('id_pengembangan', '=', $wisata->relationToPengembangan->first()->id)->where('status', 'like', 'TERIMA')->sum('pendanaan');
        return view('detail-invest', compact('wisata', 'rekening', 'data'));
    }
    public function pembayaraninveststore(Request $request, Wisata $wisata)
    {
        # code...
        // dd($request);
        $validate = $request->validate([
            'id_rekening' => 'required',
            'pendanaan' => 'required',
        ]);
        $investId = Pengembangan::create([
            'id_pengembangan' => $request->id_pengembangan,
            'id_user' => Auth::user()->id,
            'id_rekening' => $validate['id_rekening'],
            'pendanaan' => $validate['pendanaan'],
            'tgl_investasi' => Carbon::now('Asia/Jakarta'),
            'tgl_batas_pembayaran' => Carbon::now('Asia/Jakarta')->addDays(3),
            'status' => 'PENDING'
        ]);
        return redirect()->route('payment-invest', [$wisata->slug, $investId->id]);
    }

    public function pembayaraninvest(Wisata $wisata, Pengembangan $pengembangan)
    {
        # code...
        // dd($pengembangan);
        $data = $pengembangan->load('relationToRekening')->where('id', '=', $pengembangan->id)->where('id_user', Auth::user()->id)->where('bukti_pembayaran', '=', null)->get();
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
