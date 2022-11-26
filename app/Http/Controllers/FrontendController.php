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
use App\Mail\User\AfterPaidPaket;
use App\Mail\User\AfterPaidWisata;
use App\Models\PengembanganWisata;
use Illuminate\Support\Facades\DB;
use App\Models\ReservasiPaketWisata;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Admin\AfterPaymentPaket;
use App\Mail\User\AfterCheckoutPaket;
use App\Mail\Admin\AfterPaymentWisata;
use App\Mail\User\AfterCheckoutWisata;
use App\Mail\Admin\SendCronEmailInvest;
use Illuminate\Support\Facades\Storage;
use App\Mail\User\AfterPaidPengembangan;
use App\Mail\Admin\AfterPaymentPengembangan;
use App\Mail\User\AfterCheckoutPengembangan;

class FrontendController extends Controller
{
    //
    public function index()
    {
        $pengembangan = Pengembangan::leftJoin('users', 'pengembangan.id_user', '=', 'users.id')
            ->leftJoin('pengembangan_wisata', 'pengembangan.id_pengembangan', '=', 'pengembangan_wisata.id')
            ->leftJoin('wisata', 'pengembangan_wisata.id_wisata', '=', 'wisata.id')
            ->select('pengembangan.*', 'users.email', 'users.nama', 'pengembangan_wisata.imbal_hasil', 'wisata.nama_wisata')
            ->where('status', '=', 'TERIMA')
            ->get();
        // dd($pengembangan);
        foreach ($pengembangan as $invest) {
            Mail::to($invest->email)->send(new SendCronEmailInvest($invest));
        }
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
            'total_reservasi' => 'required',
            'nama_partisipan.*' => 'required'
        ]);
        $nama_partisipan = json_encode($data['nama_partisipan']);
        $reservasi = ReservasiPaketWisata::create([
            'id_user' => Auth::user()->id,
            'id_paket_wisata' => $paket->id,
            'id_rekening' => $data['id_rekening'],
            'partisipan_reservasi' => $data['partisipan_reservasi'],
            'nama_partisipan' => $nama_partisipan,
            'tgl_reservasi' => $data['tgl_reservasi'],
            'tgl_pesan_reservasi' => Carbon::now('Asia/Jakarta'),
            'tgl_batas_pembayaran' => Carbon::now('Asia/Jakarta')->addDays(3),
            'total_reservasi' => $data['total_reservasi'],
            'status_reservasi' => 'PENDING'
        ]);
        Mail::to(Auth()->user()->email)->send(new AfterCheckoutPaket($reservasi, $paket));
        return redirect()->route('payment-paket', [$paket->slug, $reservasi->id]);
    }

    public function pembayaranPaket(Paket $paket, ReservasiPaketWisata $ReservasiPaketWisata)
    {
        # code...
        // dd($paket, $ReservasiPaketWisata);
        $data = $ReservasiPaketWisata->load('relationToRekening')->where('id', '=', $ReservasiPaketWisata->id)->where('id_user', Auth::user()->id)->where(function ($query) {
            $query->where('bukti_reservasi', '=', null)->orWhere('bukti_reservasi', '!=', null);
        })->get();
        return view('pembayaran-paket', ['pembayaran' => $data]);
    }

    public function paketUpload(Request $request, ReservasiPaketWisata $ReservasiPaketWisata)
    {
        # code...
        if ($ReservasiPaketWisata->status_reservasi = 'TOLAK') {
            $ReservasiPaketWisata->update([
                'status_reservasi' => 'PENDING'
            ]);
        }
        if ($request->hasFile('bukti_pembayaran')) {
            if ($ReservasiPaketWisata->bukti_reservasi != null) {
                Storage::delete($ReservasiPaketWisata->bukti_reservasi);
            }
            $data = $request->file('bukti_pembayaran')->store('bukti_reservasi_paket');
            $ReservasiPaketWisata->update([
                'bukti_reservasi' => $data
            ]);
        }
        $ReservasiPaketWisata->load('relationToPaketOne', 'relationToUserOne');
        Mail::to(Auth()->user()->email)->send(new AfterPaidPaket($ReservasiPaketWisata));
        Mail::to('agokarangindramayu@gmail.com')->send(new AfterPaymentPaket($ReservasiPaketWisata));
        return redirect()->route('sukses');
    }

    public function cancelPaket(Request $request, ReservasiPaketWisata $ReservasiPaketWisata)
    {
        # code...
        if ($ReservasiPaketWisata->bukti_reservasi != null) {
            $ReservasiPaketWisata->update([
                'status_reservasi' => 'BATAL',
                'tgl_verifikasi' => Carbon::now('Asia/Jakarta')
            ]);
        } else {
            $ReservasiPaketWisata->update([
                'status_reservasi' => 'BATAL',
                'bukti_reservasi' => 'A',
                'tgl_verifikasi' => Carbon::now('Asia/Jakarta')
            ]);
        }
        return redirect()->route('dashboard-riwayat');
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
        // dd($request->all());
        $data = $request->validate([
            'id_rekening' => 'required',
            'partisipan_reservasi' => 'required',
            'tgl_reservasi' => 'required',
            'total_reservasi' => 'required',
            'nama_partisipan.*' => 'required'
        ]);
        $nama_partisipan = json_encode($data['nama_partisipan']);
        $reservasi = ReservasiWisata::create([
            'id_user' => Auth::user()->id,
            'id_wisata' => $wisata->id,
            'id_rekening' => $data['id_rekening'],
            'partisipan_reservasi' => $data['partisipan_reservasi'],
            'nama_partisipan' => $nama_partisipan,
            'tgl_reservasi' => $data['tgl_reservasi'],
            'tgl_pesan_reservasi' => Carbon::now('Asia/Jakarta'),
            'tgl_batas_pembayaran' => Carbon::now('Asia/Jakarta')->addDays(3),
            'total_reservasi' => $data['total_reservasi'],
            'status_reservasi' => 'PENDING'
        ]);

        Mail::to(Auth()->user()->email)->send(new AfterCheckoutWisata($reservasi, $wisata));
        return redirect()->route('payment-wisata', [$wisata->slug, $reservasi->id]);
    }

    public function pembayaranWisata(Wisata $wisata, ReservasiWisata $ReservasiWisata)
    {
        # code...
        // dd($ReservasiWisata);
        $data = $ReservasiWisata->load('relationToRekening')->where('id', '=', $ReservasiWisata->id)->where('id_user', Auth::user()->id)->where(function ($query) {
            $query->where('bukti_reservasi', '=', null)->orWhere('bukti_reservasi', '!=', null);
        })->get();
        return view('pembayaran-wisata', ['pembayaran' => $data]);
    }

    public function wisataUpload(Request $request, ReservasiWisata $reservasiWisata)
    {
        # code...
        if ($reservasiWisata->status_reservasi = 'TOLAK') {
            $reservasiWisata->update([
                'status_reservasi' => 'PENDING'
            ]);
        }
        if ($request->hasFile('bukti_pembayaran')) {
            if ($reservasiWisata->bukti_reservasi != null) {
                Storage::delete($reservasiWisata->bukti_reservasi);
            }
            $data = $request->file('bukti_pembayaran')->store('bukti_reservasi');
            $reservasiWisata->update([
                'bukti_reservasi' => $data
            ]);
        }
        $reservasiWisata->load('relationToWisataOne', 'relationToUserOne');
        Mail::to(Auth()->user()->email)->send(new AfterPaidWisata($reservasiWisata));
        Mail::to('agokarangindramayu@gmail.com')->send(new AfterPaymentWisata($reservasiWisata));
        return redirect()->route('sukses');
    }

    public function cancelWisata(Request $request, ReservasiWisata $reservasiWisata)
    {
        # code...
        if ($reservasiWisata->bukti_reservasi != null) {
            $reservasiWisata->update([
                'status_reservasi' => 'BATAL',
                'tgl_verifikasi' => Carbon::now('Asia/Jakarta')
            ]);
        } else {
            $reservasiWisata->update([
                'status_reservasi' => 'BATAL',
                'bukti_reservasi' => 'A',
                'tgl_verifikasi' => Carbon::now('Asia/Jakarta')
            ]);
        }
        return redirect()->route('dashboard-riwayat');
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
        $wisata->load('relationToGallery', 'relationToPengembangan', 'relationToLaporan')->loadCount('relationToTransaction');
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
        Mail::to(Auth()->user()->email)->send(new AfterCheckoutPengembangan($investId, $wisata));
        return redirect()->route('payment-invest', [$wisata->slug, $investId->id]);
    }

    public function pembayaraninvest(Wisata $wisata, Pengembangan $pengembangan)
    {
        # code...
        $data = $pengembangan->load('relationToRekening')->where('id', '=', $pengembangan->id)->where('id_user', Auth::user()->id)->where('id_user', Auth::user()->id)->where(function ($query) {
            $query->where('bukti_pembayaran', '=', null)->orWhere('bukti_pembayaran', '!=', null);
        })->get();
        return view('pembayaran-invest', ['pembayaran' => $data]);
    }

    public function investUpload(Request $request, Pengembangan $pengembangan)
    {
        # code...
        if ($pengembangan->status = 'TOLAK') {
            $pengembangan->update([
                'status' => 'PENDING'
            ]);
        }
        if ($request->hasFile('bukti_pembayaran')) {
            if ($pengembangan->bukti_pembayaran != null) {
                Storage::delete($pengembangan->bukti_pembayaran);
            }
            $data = $request->file('bukti_pembayaran')->store('bukti_invest');
            $pengembangan->update([
                'bukti_pembayaran' => $data
            ]);
        }
        $pengembangan->load('relationToUser');
        // dd($pengembangan);
        Mail::to(Auth()->user()->email)->send(new AfterPaidPengembangan($pengembangan));
        Mail::to('agokarangindramayu@gmail.com')->send(new AfterPaymentPengembangan($pengembangan));
        return redirect()->route('sukses');
    }

    public function cancelInvest(Request $request, Pengembangan $pengembangan)
    {
        # code...
        if ($pengembangan->bukti_pembayaran != null) {
            $pengembangan->update([
                'status_reservasi' => 'BATAL',
                'tgl_verifikasi' => Carbon::now('Asia/Jakarta')
            ]);
        } else {
            $pengembangan->update([
                'status_reservasi' => 'BATAL',
                'bukti_reservasi' => 'A',
                'tgl_verifikasi' => Carbon::now('Asia/Jakarta')
            ]);
        }
        return redirect()->route('dashboard-riwayat');
    }


    /* Payment Success */
    public function sukses()
    {
        # code...
        return view('sukses');
    }
}
