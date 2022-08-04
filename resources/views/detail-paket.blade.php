@extends('layouts.app')
@push('style')
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
@endpush
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
                                Eksplor Paket Wisata
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $detailPaket->nama_paket }}
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
                        <h2>{{ $detailPaket->nama_paket }}</h2>
                        @if ($bawah->count())
                            <div class="xzoom-container">
                                <img class="xzoom" id="xzoom-default"
                                    src="{{ asset('storage/' . $bawah->first()->image) }}"
                                    xoriginal="{{ asset('storage/' . $bawah->first()->image) }}" />
                                <div class="xzoom-thumbs pt-3">
                                    @foreach ($bawah as $key => $gallery)
                                        @if ($key == 1)
                                            @continue
                                        @endif
                                        <a href="{{ asset('storage/' . $gallery->image) }}"><img class="xzoom-gallery"
                                                width="115" height="125"
                                                src="{{ asset('storage/' . $gallery->image) }}"
                                                xpreview="{{ asset('storage/' . $gallery->image) }}" /></a>
                                        @if ($key == 5)
                                        @break
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <h3>Tentang Wisata Ini</h3>
                    <p>{!! $detailPaket->deskripsi !!}
                    </p>
                    <h5>Detail Perjalanan Paket :</h5>
                    @foreach ($detailWisata as $key => $item)
                        <h6>{{ $key }}</h6>
                        @foreach ($item as $wisata)
                            <p class="m-0">{{ $wisata }}</p>
                        @endforeach
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3 px-1">
                <div class="bg-white rounded-top p-3 side-card">
                    <h3>Informasi Wisata</h3>
                    <table class="informasi-paket">
                        <div class="d-flex justify-content-between">
                            <h6 class="m-0">Durasi Wisata</h6>
                            <p class="m-0">{{ $detailPaket->durasi_wisata }} Hari</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="m-0">Reservasi Awal</h6>
                            <p class="m-0">
                                {{ Carbon\Carbon::parse($detailPaket->tgl_reservasi_awal)->formatLocalized('%d %B %Y') }}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="m-0">Reservasi Akhir</h6>
                            <p class="m-0">
                                {{ Carbon\Carbon::parse($detailPaket->tgl_reservasi_akhir)->formatLocalized('%d %B %Y') }}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="m-0">Harga</h6>
                            <p class="m-0">Rp.{{ number_format($detailPaket->harga) }} / orang</p>
                        </div>
                    </table>
                </div>
                @guest
                    <a href="{{ route('login') }}"
                        class="btn btn-block btn-join-now py-2 col-lg-12 col-12">Masuk/Daftar</a>
                @endguest
                @auth
                    @if (auth()->user()->roles == 'WISATAWAN')
                        @if ($detailPaket->tgl_reservasi_akhir <= \Carbon\Carbon::now())
                            <a href="#" class="btn btn-block btn-join-now py-2 col-lg-12 col-12">Reservasi Ditutup</a>
                        @else
                            <a href="{{ route('checkout-paket', $detailPaket->slug) }}"
                                class="btn btn-block btn-join-now py-2 col-lg-12 col-12">Reservasi
                                Sekarang</a>
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
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12 pt-3">
                <h3>Wisata Dalam Paket Ini</h3>
            </div>
            <div class="swiper">
                <div class="col-lg-10 swiper-wrapper">
                    @foreach ($bawah as $key => $wisata)
                        <!--Card Wisata Lainnya-->
                        <div class="swiper-slide col-lg-3 bg-white rounded-3 mt-2 mx-1">
                            <img src="{{ asset('storage/' . $wisata->image) }}" class="rounded-top" alt="">
                            <div class="p-2">
                                <h3>{{ $wisata->nama_wisata }}</h3>
                                <p style="overflow-y:hidden;
                                text-overflow:ellipsis;
                                max-height:2.6em;"
                                    class="paragraph-2">{!! substr(strip_tags($wisata->deskripsi), 0, 120) !!}</p>
                            </div>
                            <a href="{{ route('detail-wisata', $wisata->slug) }}"
                                class="btn btn-block btn-wisata-lainnya py-2 col-lg-12 col-12">Lihat
                                Wisata</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
@push('script')
<script src="{{ url('/Frontend/Asset/Scripts/main.js') }}"></script>
<script src="{{ url('/Frontend/Asset/Libraries/xzoom/xzoom.min.js') }}"></script>
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
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
<script>
    var swiper = new Swiper('.swiper', {
        direction: "horizontal",
        centeredSlides: false,
        spaceBetween: 20,
        freeMode: true,
        breakpoints: {
            786: {
                slidesPerView: 4,
                slidesPerGroup: 4,
            },
        },
    });
</script>
@endpush
