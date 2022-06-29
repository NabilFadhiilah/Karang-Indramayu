@extends('layouts.app')
@section('content')
    <header class="banner-wisata"></header>
    <section class="eksplor-wisata mt-4">
        <div class="container">
            <div class="row justify-content-center mb-2">
                <!--Breadcrumb-->
                <div class="col-lg-10 mb-2">
                    <h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" aria-current="page">
                                    Beranda
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Eksplor Paket
                                </li>
                            </ol>
                        </nav>
                    </h4>
                </div>
                <!--Filter Side Bar-->
                <div class="col-lg-3">
                    <div class="bg-white rounded-3 border p-3 mb-3">
                        <h3>Cari Wisata</h3>
                        <form action="/eksplor" method="GET">
                            <div class="input-group flex-nowrap">
                                <input type="text" class="form-control" placeholder="Cari Wisata" name="search"
                                    value="{{ request('search') }}" aria-label="Cari Wisata"
                                    aria-describedby="addon-wrapping">
                                <span class="input-group-append">
                                    <button class="btn btn-outline-secondary border-left-0 border" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="bg-white rounded-3 border p-3 mb-2 pb-md-3">
                        <h3>Bedasarkan Harga</h3>
                        <div class="d-flex align-items-center mb-2">
                            <input class="form-check-input mt-0" type="radio" name="radioNoLabel" id="radioNoLabel1"
                                value="" aria-label="...">
                            <p class="paragraph-2 justify-content-center d-flex mb-0 px-1">Harga (Termurah Lebih
                                Dulu)</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <input class="form-check-input mt-0" type="radio" name="radioNoLabel" id="radioNoLabel1"
                                value="" aria-label="...">
                            <p class="paragraph-2 justify-content-center d-flex mb-0 px-1">Harga (Termahal Lebih
                                Dulu)</p>
                        </div>
                    </div>
                </div>
                <!--Main Content-->
                <div class="col-lg-7 px-2">
                    <!--Card Wisata-->
                    @forelse ($paket as $dataPaket)
                        <div class="row bg-white rounded-3 mb-2">
                            <div class="col-lg-3 p-0 m-0">
                                @foreach ($dataPaket->relationToWisata as $key => $gallery)
                                    @if ($key == 0)
                                        <img src="{{ asset('storage/' . $gallery->image) }}" style="object-fit: cover;"
                                            class="img-responsive rounded-start" width="100%" height="180px"
                                            alt="">
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-lg-9 py-3">
                                <div class="d-flex justify-content-between">
                                    <h3>{{ $dataPaket->nama_paket }}</h3>
                                    <h3>Rp.{{ number_format($dataPaket->harga) }}</h3>
                                </div>
                                <div class="d-flex align-items-start flex-column" style="height: 80%;">
                                    <div class="mb-auto">
                                        <p class="parahraph-2">
                                            {!! $dataPaket->deskripsi !!}</p>
                                    </div>
                                    <div class="">
                                        <a href=" {{ route('checkout-paket', $dataPaket->slug) }}"
                                            class="btn btn-primary m-1 py-1">Reservasi
                                            Wisata</a>
                                        <a href="{{ route('detail-paket', $dataPaket->slug) }}"
                                            class="btn btn-outline-primary m-1 py-1">Lihat
                                            Paket Wisata</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="d-flex flex-column">
                            <img class="align-self-center" style="width: 20%;object-fit: cover;"
                                src="{{ url('Frontend/Asset/Images/empty.svg') }}" alt="">
                            <h3 class="align-self-center mt-2">Data Belum Terserdia</h3>
                        </div>
                    @endforelse
                </div>
                <div class="col-lg-10 mt-4">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                        {{ $paket->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
