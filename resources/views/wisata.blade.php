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
                                Eksplor Wisata
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
                    <div class="gallery main-card p-3 bg-white rounded-3 mb-2">
                        {{-- {{ dd($wisata) }} --}}
                        <h2>{{ $wisata->nama_wisata }}</h2>
                        @if ($wisata->relationToGallery->count())
                            <div class="xzoom-container">
                                <img class="xzoom" id="xzoom-default"
                                    src="{{ asset('storage/' . $wisata->relationToGallery->first()->image) }}"
                                    xoriginal="{{ asset('storage/' . $wisata->relationToGallery->first()->image) }}" />
                                <div class="xzoom-thumbs pt-3">
                                    @foreach ($wisata->relationToGallery as $gallery)
                                        <a href="{{ asset('storage/' . $gallery->image) }}"><img class="xzoom-gallery"
                                                width="115" height="125"
                                                src="{{ asset('storage/' . $gallery->image) }}"
                                                xpreview="{{ asset('storage/' . $gallery->image) }}" /></a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <h3>Tentang Wisata Ini</h3>
                        <p>{!! $wisata->deskripsi !!}
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 px-1">
                    <div class="bg-white rounded-top p-3 side-card">
                        <h3>Informasi Wisata</h3>
                        <table class="informasi-paket">
                            <tr>
                                <th width="50%">Durasi Wisata</th>
                                <td width="50%" class="text-end">{{ $wisata->durasi_wisata }}</td>
                            </tr>
                            {{-- <tr>
                                <th width="50%">Tanggal Keberangkatan</th>
                                <td width="50%" class="text-end">21-12-2021</td>
                            </tr> --}}
                            <tr>
                                <th width="50%">Reservasi Awal</th>
                                <td width="50%" class="text-end">
                                    {{ Carbon\Carbon::parse($wisata->tgl_reservasi_awal)->formatLocalized('%d %B %Y') }}
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">Reservasi Akhir</th>
                                <td width="50%" class="text-end">
                                    {{ Carbon\Carbon::parse($wisata->tgl_reservasi_akhir)->formatLocalized('%d %B %Y') }}
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">Harga</th>
                                <td width="50%" class="text-end">Rp.{{ number_format($wisata->harga) }} / orang
                                </td>
                            </tr>
                        </table>
                    </div>
                    @guest
                        <a href="{{ route('login') }}"
                            class="btn btn-block btn-join-now py-2 col-lg-12 col-12">Masuk/Daftar</a>
                    @endguest
                    @auth
                        @if (auth()->user()->roles == 'WISATAWAN')
                            @if (auth()->user()->email_verified_at == null)
                                <a href="#" class="btn btn-block btn-join-now py-2 col-lg-12 col-12">Harap Verifikasi
                                    Email</a>
                            @else
                                @if ($wisata->tgl_reservasi_akhir <= \Carbon\Carbon::now())
                                    <a href="#" class="btn btn-block btn-join-now py-2 col-lg-12 col-12">Reservasi
                                        Ditutup</a>
                                @else
                                    <a href="{{ route('checkout', $wisata->slug) }}"
                                        class="btn btn-block btn-join-now py-2 col-lg-12 col-12">Reservasi
                                        Sekarang</a>
                                @endif
                            @endif
                        @endif
                        @if (auth()->user()->roles == 'INVESTOR')
                            <form action="/roles" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-block btn-join-now py-2 col-lg-12 col-12">Ubah Ke
                                    Wisatawan
                            </form>
                        @endif
                    @endauth
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
