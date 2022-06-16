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
                        <div class="xzoom-container">
                            @foreach ($wisata->relationToGallery as $gallery)
                                {{-- @if ($key == 0) --}}
                                <img class="xzoom" id="xzoom-default"
                                    src="{{ asset('storage/' . $gallery->image) }}"
                                    xoriginal="{{ asset('storage/' . $gallery->image) }}" />
                                {{-- @endif --}}
                                <div class="xzoom-thumbs pt-3">
                                    <a href="{{ asset('storage/' . $gallery->image) }}"><img class="xzoom-gallery"
                                            width="115" height="125" src="{{ asset('storage/' . $gallery->image) }}"
                                            xpreview="{{ asset('storage/' . $gallery->image) }}" /></a>
                                </div>
                            @endforeach
                        </div>
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
                            <tr>
                                <th width="50%">Tanggal Keberangkatan</th>
                                <td width="50%" class="text-end">21-12-2021</td>
                            </tr>
                            <tr>
                                <th width="50%">Reservasi Awal</th>
                                <td width="50%" class="text-end">{{ $wisata->tgl_reservasi_awal }}</td>
                            </tr>
                            <tr>
                                <th width="50%">Reservasi Akhir</th>
                                <td width="50%" class="text-end">{{ $wisata->tgl_reservasi_akhir }}</td>
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
                            <a href="{{ route('checkout') }}"
                                class="btn btn-block btn-join-now py-2 col-lg-12 col-12">Reservasi
                                Sekarang</a>
                        @endif
                        @if (auth()->user()->roles == 'INVESTOR')
                            <form action="/roles" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-block btn-join-now py-2 col-lg-12 col-12">Ubah Ke Wisatawan
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
            {{-- <div class="row d-flex justify-content-center">
                <div class="col-lg-12 pt-3">
                    <h3>Wisata Dalam Paket Ini</h3>
                </div>
                <div class="swiper">
                    <div class="col-lg-10 swiper-wrapper">
                        <!--Card Wisata Lainnya-->
                        <div class="swiper-slide col-lg-3 bg-white rounded-3 mt-2 mx-1">
                            <img src="{{ url('/Frontend/Asset/Images/Main-wisata-landing-2.png') }}"
                                class="rounded-top" alt="">
                            <div class="p-2">
                                <h3>Wisata Mercusuar</h3>
                                <p class="paragraph-2">Mercusuar dibangun pada tahun 1872 oleh pemerintah
                                    belanda
                                    kala masih
                                    menjajah Indonesia, sampai saat ini usianya telah mencapai 184 tahun.</p>
                            </div>
                            <a href="{{ route('detail-wisata') }}"
                                class="btn btn-block btn-wisata-lainnya py-2 col-lg-12 col-12">Lihat
                                Wisata</a>
                        </div>
                        <!--Card Wisata Lainnya-->
                        <div class="swiper-slide col-lg-3 bg-white rounded-3 mt-2 mx-1">
                            <img src="{{ url('/Frontend/Asset/Images/Main-wisata-landing-2.png') }}"
                                class="rounded-top" alt="">
                            <div class="p-2">
                                <h3>Wisata Mercusuar</h3>
                                <p class="paragraph-2">Mercusuar dibangun pada tahun 1872 oleh pemerintah
                                    belanda
                                    kala masih
                                    menjajah Indonesia, sampai saat ini usianya telah mencapai 184 tahun.</p>
                            </div>
                            <a href="{{ route('detail-wisata') }}"
                                class="btn btn-block btn-wisata-lainnya py-2 col-lg-12 col-12">Lihat
                                Wisata</a>
                        </div>
                        <!--Card Wisata Lainnya-->
                        <div class="swiper-slide col-lg-3 bg-white rounded-3 mt-2 mx-1">
                            <img src="{{ url('/Frontend/Asset/Images/Main-wisata-landing-2.png') }}"
                                class="rounded-top" alt="">
                            <div class="p-2">
                                <h3>Wisata Mercusuar</h3>
                                <p class="paragraph-2">Mercusuar dibangun pada tahun 1872 oleh pemerintah
                                    belanda
                                    kala masih
                                    menjajah Indonesia, sampai saat ini usianya telah mencapai 184 tahun.</p>
                            </div>
                            <a href="{{ route('detail-wisata') }}"
                                class="btn btn-block btn-wisata-lainnya py-2 col-lg-12 col-12">Lihat
                                Wisata</a>
                        </div>
                        <!--Card Wisata Lainnya-->
                        <div class="swiper-slide col-lg-3 bg-white rounded-3 mt-2 mx-1">
                            <img src="{{ url('/Frontend/Asset/Images/Main-wisata-landing-2.png') }}"
                                class="rounded-top" alt="">
                            <div class="p-2">
                                <h3>Wisata Mercusuar</h3>
                                <p class="paragraph-2">Mercusuar dibangun pada tahun 1872 oleh pemerintah
                                    belanda
                                    kala masih
                                    menjajah Indonesia, sampai saat ini usianya telah mencapai 184 tahun.</p>
                            </div>
                            <a href="{{ route('detail-wisata') }}"
                                class="btn btn-block btn-wisata-lainnya py-2 col-lg-12 col-12">Lihat
                                Wisata</a>
                        </div>
                        <!--Card Wisata Lainnya-->
                        <div class="swiper-slide col-lg-3 bg-white rounded-3 mt-2 mx-1">
                            <img src="{{ url('/Frontend/Asset/Images/Main-wisata-landing-2.png') }}"
                                class="rounded-top" alt="">
                            <div class="p-2">
                                <h3>Wisata Mercusuar</h3>
                                <p class="paragraph-2">Mercusuar dibangun pada tahun 1872 oleh pemerintah
                                    belanda
                                    kala masih
                                    menjajah Indonesia, sampai saat ini usianya telah mencapai 184 tahun.</p>
                            </div>
                            <a href="{{ route('detail-wisata') }}"
                                class="btn btn-block btn-wisata-lainnya py-2 col-lg-12 col-12">Lihat
                                Wisata</a>
                        </div>
                    </div>
                </div>
            </div> --}}
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
