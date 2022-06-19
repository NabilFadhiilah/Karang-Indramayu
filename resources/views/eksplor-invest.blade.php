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
                                    Pengembangan Wisata
                                </li>
                            </ol>
                        </nav>
                    </h4>
                </div>
                <!--Filter Side Bar-->
                <div class="col-lg-3">
                    <div class="bg-white rounded-3 p-3 mb-3">
                        <h3>Cari Pemgembangan</h3>
                        <div class="input-group flex-nowrap">
                            <input type="text" class="form-control" placeholder="Cari Pemgembangan"
                                aria-label="Cari Pemgembangan" aria-describedby="addon-wrapping">
                            <span class="input-group-append">
                                <button class="btn btn-outline-secondary border-left-0 border" type="button">
                                    <i class="bi bi-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="bg-white rounded-3 p-3 mb-2 pb-md-3">
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
                <div class="col-lg-7">

                    <!--Card Invest-->
                    <div class="row mb-2 card-investment justify-content-center">
                        @forelse ($data as $pengembangan)
                            <div class="col-lg-6 px-0 py-1">
                                <div class="card mx-1">
                                    @foreach ($pengembangan->relationToGallery as $key => $gallery)
                                        @if ($key == 0)
                                            <img src="{{ asset('storage/' . $gallery->image) }}" class="card-img-top">
                                        @endif
                                    @endforeach
                                    <div class="card-body">
                                        @foreach ($pengembangan->relationToWisata as $wisata)
                                            <h5 class="card-title">{{ $wisata->nama_wisata }}</h5>
                                            <p class="card-text">{!! $wisata->deskripsi !!}</p>
                                            <div class="progress mb-3">
                                                <div class="progress-bar progress-bar-striped" role="progressbar"
                                                    style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                                    aria-valuemax="100">0%
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-12 d-flex align-items-center">
                                            @foreach ($pengembangan->relationToWisata as $wisata)
                                                <div class="col-6">
                                                    <a href="{{ route('invest-wisata', $wisata->slug) }}"
                                                        class="btn btn-primary">Invest
                                                        Sekarang</a>
                                                </div>
                                            @endforeach
                                            <div class="col-6 text-end">
                                                <p class="small m-0">Target Pengembangan</p>
                                                <p class="fw-bold m-0">
                                                    Rp.{{ number_format($pengembangan->target_dana) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                    </div>
                    <div class="d-flex flex-column">
                        <img class="align-self-center" style="width: 20%;object-fit: cover;"
                            src="{{ url('Frontend/Asset/Images/empty.svg') }}" alt="">
                        <h3 class="align-self-center mt-2">Data Belum Terserdia</h3>
                    </div>
                    @endforelse
                </div>
                <div class="col-lg-10 mt-4">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                        {{ $data->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
