@extends('layouts.app')
@section('content')
    <header class="text-center">
        <h1>
            Berwisata Di Kepulauan Biawak
            <br />
            Hanya Dengan Satu Klik
        </h1>
        <p class="mt-3 small">
            Berwisata Di Kepulauan Biawak Lebih Mudah, <br />
            Tidak Perlu Mencari Agen Hanya Klik Dan Langsung Berangkat
        </p>
        <a href="#informasi" class="btn btn-get-started px-4 mt-4">
            Mulai Eksplorasi
        </a>
    </header>

    <!--Main App-->
    <main>
        <!--Informasi-->
        <section class="section-informasi" id="informasi">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-lg-12 py-2 text-center section-Wisata-Heading">
                        <h2>Mari Berwisata Di Kepulauan Biawak!</h2>
                        <p class="small">
                            Mari Beriwisata Di Kepulauan Biawak
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-5 py-2 info-image">
                        <img src="{{ url('/Frontend/Asset/Images/card-wisata-1.png') }}" class="img-fluid rounded-3">
                    </div>
                    <div class="col-lg-5 py-2 ">
                        <div class="d-flex align-items-start flex-column" style="height: 325px;">
                            <div class="mb-auto">
                                <h2>Tempat Wisata Terbaik Di Kepulauan Biawak</h2>
                                <p>Wisata bahari artinya segala jenis kegiatan wisata atau rekreasi yang aktivitasnya
                                    dilakukan di
                                    kawasan
                                    laut, baik itu di pantai, pulau, atau bawah laut.</p>
                            </div>
                            <div class="d-flex">
                                <button class="btn btn-primary btn-wisata"><a href="{{ route('checkout') }}"
                                        class="text-white text-center">Pesan
                                        Wisata</a></button>
                                <a href="{{ route('detail-wisata') }}" class="d-flex align-items-center px-3">Lihat
                                    Wisata</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!--Section Wisata-->
        <section class="section-wisata" id="wisata">
            <div class="container ">
                <div class="row justify-content-center">
                    <div class="swiper">
                        <div class="swiper-wrapper">

                            @forelse ($data as $wisata)
                                <!--Card Wisata-->
                                <div class="col-lg-3 p-0 bg-white rounded-3 m-2 swiper-slide">
                                    <div class="wisata-image">
                                        @foreach ($wisata->relationToGallery as $key => $gallery)
                                            @if ($key == 0)
                                                <img src="{{ asset('storage/' . $gallery->image) }}" alt=""
                                                    class="rounded-top img-fluid">
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="p-3">
                                        <h2 class="overflow-ellipsis">{{ $wisata->nama_wisata }}</h2>
                                        <p>{!! $wisata->deskripsi !!}</p>
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('detail-wisata') }}" class="d-flex align-items-center">Lihat
                                                Wisata</a>
                                            <button class=" btn btn-primary btn-wisata"><a href="{{ route('checkout') }}"
                                                    class="text-white text-center">Pesan
                                                    Wisata</a></button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                ga ada
                            @endforelse

                            <!--Card Wisata Eksplore-->
                            <div
                                class="col-lg-3 p-0 bg-white rounded-3 m-2 d-flex justify-content-center align-items-center swiper-slide text-center">
                                <div>
                                    <i class="bi bi-search"></i>
                                    <h2>Eksplor Wisata</h2>
                                    <button class=" btn btn-primary btn-wisata"><a href="eksplor"
                                            class="text-white text-center">Mulai
                                            Eksplor</a>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>

        <section class="section-investasi">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-lg-12 py-2 text-center section-Wisata-Heading">
                        <h2>Mari Kembangkan Wisata Kepulauan Biawak Bersama!</h2>
                        <p class="small">
                            Dukung Pengembangan Wisata Kepulauan Biawak
                        </p>
                    </div>
                </div>

                <div class="col-lg-12 row justify-content-center">
                    @forelse ($data as $pengembangan)
                        <div class="col-lg-4 py-1 px-0">
                            <div class="card mx-1">
                                @foreach ($pengembangan->relationToGallery as $key => $gallery)
                                    @if ($key == 0)
                                        <img src="{{ asset('storage/' . $gallery->image) }}" alt=""
                                            class="rounded-top img-fluid">
                                    @endif
                                @endforeach
                                <div class="card-body">
                                    @foreach ($pengembangan->relationToWisata as $wisata)
                                        <h5 class="card-title">{{ $wisata->nama_wisata }}</h5>
                                        <p class="card-text">{!! $wisata->deskripsi !!}</p>
                                        <div class="progress mb-3">
                                            <div class="progress-bar progress-bar-striped" role="progressbar"
                                                style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-12 d-flex align-items-center">
                                        <div class="col-6">
                                            <a href="{{ route('invest-wisata') }}" class="btn btn-primary">Invest
                                                Sekarang</a>
                                        </div>
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
                        ga ada
                    @endforelse

                </div>
                <div class="row justify-content-center mt-4">
                    <div class="col-lg-12 py-2 text-center section-Wisata-Heading">
                        <a href="{{ route('invest') }}" class="btn btn-primary rounded-pill">Lihat Semua</a>
                    </div>
                </div>

            </div>
        </section>

        <section class="section-register">
            <div class="container ">
                <div class="row justify-content-center">
                    <div class="col-lg-5 py-2 d-flex justify-content-center">
                        <img src="/Frontend/Asset/Images/Register-now.png" alt="" class="img-fluid rounded-4">
                    </div>

                    <div class="col-lg-5 py-2 d-flex align-items-center text-lg-start text-center">
                        <div class="">
                            <h3>Kami Menunggu Dukungan Wisata Dan Berwisata Dengan Anda!</h3>
                            <a href="{{ route('register') }}" class="btn btn-primary btn-register ">Daftarkan Akun
                                Sekarang</a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
@push('script')
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="{{ url('/Frontend/Asset/Scripts/swiper.js') }}"></script>
@endpush
