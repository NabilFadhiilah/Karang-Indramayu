@extends('layouts.app')
@section('content')
    <section class="section-detail">
        <div class="container ">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-10 px-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">
                                Beranda
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Pengembangan Wisata
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $wisata->nama_wisata }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="section-detail-card">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-7 px-1">
                    <div class="gallery main-card p-3 border bg-white rounded-3 mb-2">
                        <h2>{{ $wisata->nama_wisata }}</h2>
                        <div class="xzoom-container">
                            <img class="xzoom" id="xzoom-default"
                                src="{{ asset('storage/' . $wisata->relationToGallery->first()->image) }}"
                                xoriginal="{{ asset('storage/' . $wisata->relationToGallery->first()->image) }}" />
                            <div class="xzoom-thumbs pt-3">
                                @foreach ($wisata->relationToGallery as $gallery)
                                    <a href="{{ asset('storage/' . $gallery->image) }}"><img class="xzoom-gallery"
                                            width="115" height="125" src="{{ asset('storage/' . $gallery->image) }}"
                                            xpreview="{{ asset('storage/' . $gallery->image) }}" /></a>
                                @endforeach
                            </div>
                        </div>
                        <div class="my-2">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-tentang-wisata-ini-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-tentang-wisata-ini" type="button" role="tab"
                                        aria-controls="nav-tentang-wisata-ini" aria-selected="true">Tentang Wisata
                                        Ini</button>
                                    <button class="nav-link" id="nav-mengenai-investasi-ini-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-mengenai-investasi-ini" type="button" role="tab"
                                        aria-controls="nav-mengenai-investasi-ini" aria-selected="false">Mengenai Investasi
                                        Ini</button>
                                    <button class="nav-link" id="nav-Update-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-Update" type="button" role="tab"
                                        aria-controls="nav-Update" aria-selected="false">Update</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-tentang-wisata-ini" role="tabpanel"
                                    aria-labelledby="nav-tentang-wisata-ini-tab">
                                    <p>{!! $wisata->deskripsi !!}</p>
                                </div>
                                <div class="tab-pane fade" id="nav-mengenai-investasi-ini" role="tabpanel"
                                    aria-labelledby="nav-mengenai-investasi-ini-tab">
                                    @foreach ($wisata->relationToPengembangan as $key => $pengembangan)
                                        <p>{!! $pengembangan->deskripsi !!}</p>
                                    @endforeach
                                </div>
                                <div class="tab-pane fade" id="nav-Update" role="tabpanel" aria-labelledby="nav-Update-tab">
                                    @forelse ($wisata->relationToLaporan as $update)
                                        <p class="mb-0">{{ $update->pengeluaran }}</p>
                                        <p class="mb-0">Rp.{{ number_format($update->biaya_pengeluaran) }}</p>
                                        <p class="mb-0">{{ $update->created_at }}</p>
                                    @empty
                                        <p>Belum Ada Update Pengembangan Untuk Wisata Ini</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 px-1">
                    <div class="bg-white rounded p-3 side-card border mb-3">
                        <h3>Informasi Pengembangan</h3>
                        <div class="informasi-paket">
                            @foreach ($wisata->relationToPengembangan as $pengembangan)
                                <div class="d-flex justify-content-between">
                                    <h6 class="m-0">Target Dana</h6>
                                    <p class="m-0">Rp.{{ number_format($pengembangan->target_dana) }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="m-0">Imbal Hasil</h6>
                                    <p class="m-0">{{ $pengembangan->imbal_hasil }}%p.a</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="m-0">Minimal Invest</h6>
                                    <p class="m-0">Rp.{{ number_format($pengembangan->min_investasi) }}</p>
                                </div>
                            @endforeach
                        </div>
                        {{-- progress bar --}}
                        <div class="mb-1 d-flex justify-content-between">
                            <h6 class="m-0">Terkumpul</h6>
                            <p class="m-0 fw-bold text-success">Rp.{{ number_format($data) }}</p>
                        </div>
                        <h6 class="m-0 pb-2">Progres Pendanaan :</h6>
                        <div class="progress mb-3">
                            <div id="invest"class="progress-bar progress-bar-striped" role="progressbar"
                                style="width: {{ round(($data / $pengembangan->target_dana) * 100) }}%"
                                aria-valuenow="{{ round(($data / $pengembangan->target_dana) * 100) }}" aria-valuemin="0"
                                aria-valuemax="100">{{ round(($data / $pengembangan->target_dana) * 100) }}%
                            </div>
                        </div>
                    </div>
                    {{-- invest --}}
                    <div class="bg-white rounded-top p-3 mt-3 border side-card">
                        <form action={{ route('pembayaran-invest', $wisata->slug) }} method="POST">
                            @csrf
                            <h4>Jumlah Investasi</h4>
                            <div class="input-group mb-3">
                                <input type="number" min="{{ $pengembangan->min_investasi }}" id="pendanaan"
                                    class="form-control @error('pendanaan') is-invalid @enderror"
                                    placeholder="Min Rp.{{ number_format($pengembangan->min_investasi) }}"
                                    aria-label="Jumlah Investasi" name="pendanaan" aria-describedby="basic-addon1"
                                    value="{{ old('pendanaan') }}">
                                @error('pendanaan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input type="hidden" name="id_pengembangan" value="{{ $pengembangan->id }}">
                            </div>
                            <h4>Metode Pembayaran</h4>
                            @forelse ($rekening as $dataRekening)
                                <div class="d-flex align-items-center mb-2">
                                    <input class="form-check-input mt-0 mx-2 @error('id_rekening') is-invalid @enderror"
                                        type="radio" name="id_rekening" id="radioNoLabel1"
                                        value="{{ $dataRekening->id }}" aria-label="...">
                                    <p class="paragraph-2 justify-content-center d-flex mb-0 px-1">
                                        {{ $dataRekening->pemilik_rekening }} <br>
                                        {{ $dataRekening->no_rekening }} <br>
                                        {{ $dataRekening->bank_rekening }}</p>
                                </div>
                            @empty
                                Metode Pembayaran Belum Tersedia, Harap Hubungi Admin
                            @endforelse
                    </div>
                    @auth
                        @if (round(($data / $pengembangan->target_dana) * 100) >= 100)
                            <button type="button" class="btn btn-block btn-join-now py-2 col-lg-12 col-12">Target
                                Tercapai</button>
                        @elseif (auth()->user()->roles == 'INVESTOR' && $rekening->isNotEmpty())
                            @if (auth()->user()->email_verifed_at == null)
                                <a href="#" class="btn btn-block btn-join-now py-2 col-lg-12 col-12">Harap
                                    Verifikasi
                                    Email</a>
                            @else
                                <button type="submit" name="payment"
                                    class="btn btn-block btn-join-now py-2 col-lg-12 col-12">Invest
                                    Sekarang</button>
                                </form>
                            @endif
                        @elseif (auth()->user()->roles == 'WISATAWAN')
                            {{-- <form action="{{ route('roles') }}" method="POST">
                                @csrf --}}
                            <a class="btn btn-block btn-join-now py-2 col-lg-12 col-12">Ubah Ke
                                Investor</a>
                            {{-- </form> --}}
                        @endif
                    @endauth
                    @guest
                        <a href="{{ route('login') }}"
                            class="btn btn-block btn-join-now py-2 col-lg-12 col-12">Masuk/Daftar</a>
                    @endguest
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="{{ url('/Frontend/Asset/Scripts/main.js') }}"></script>
    <script src="{{ url('/Frontend/Asset/Libraries/xzoom/xzoom.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.xzoom, .xzoom-gallery').xzoom({
                zoomWidth: 500,
                title: false,
                tint: '#333',
                Xoffset: 15
            });
        });
    </script>
@endpush
