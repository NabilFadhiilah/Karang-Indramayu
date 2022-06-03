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
                                    Eksplor Wisata
                                </li>
                            </ol>
                        </nav>
                    </h4>
                </div>
                <!--Filter Side Bar-->
                <div class="col-lg-3">
                    <div class="bg-white rounded-3 p-3 mb-3">
                        <h3>Cari Wisata</h3>
                        <div class="input-group flex-nowrap">
                            <input type="text" class="form-control" placeholder="Cari Wisata" aria-label="Cari Wisata"
                                aria-describedby="addon-wrapping">
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
                <div class="col-lg-7 px-2">
                    <!--Card Wisata-->
                    <div class="row bg-white rounded-3 mb-2">
                        <div class="col-lg-3 p-0 m-0">
                            <img src="{{ url('/Frontend/Asset/Images/card-wisata-1.png') }}"
                                class="img-responsive rounded-start" width="100%" height="100%" alt="">
                        </div>
                        <div class="col-lg-9 py-3">
                            <div class="d-flex justify-content-between">
                                <h3>Wisata Bahari</h3>
                                <h3>RP. 123,400.000</h3>
                            </div>
                            <p class="parahraph-2">
                                Wisata bahari artinya
                                segala jenis
                                kegiatan wisata atau
                                rekreasi yang aktivitasnya
                                dilakukan di kawasan laut, baik itu di pantai, pulau, atau bawah...</p>
                            <a href="{{ route('checkout') }}" class="btn btn-primary py-1">Reservasi Wisata</a>
                            <a href="{{ route('detail-wisata') }}" class="btn btn-outline-primary py-1">Lihat Detail
                                Wisata</a>
                        </div>
                    </div>
                    <!--Card Wisata-->
                    <div class="row bg-white rounded-3 mb-2">
                        <div class="col-lg-3 p-0 m-0">
                            <img src="{{ url('/Frontend/Asset/Images/card-wisata-2.png') }}"
                                class="img-responsive rounded-start" width="100%" height="100%" alt="">
                        </div>
                        <div class="col-lg-9 py-3">
                            <div class="d-flex justify-content-between">
                                <h3>Wisata Mercusuar</h3>
                                <h3>RP. 123,400.000</h3>
                            </div>
                            <p class="parahraph-2">
                                Mercusuar dibangun pada tahun 1872 oleh pemerintah belanda kala masih menjajah
                                Indonesia, sampai saat ini usianya telah mencapai 184 tahun.</p>
                            <a href="{{ route('checkout') }}" class="btn btn-primary py-1">Reservasi Wisata</a>
                            <a href="{{ route('detail-wisata') }}" class="btn btn-outline-primary py-1">Lihat Detail
                                Wisata</a>
                        </div>
                    </div>
                    <!--Card Wisata-->
                    <div class="row bg-white rounded-3 mb-2">
                        <div class="col-lg-3 p-0 m-0">
                            <img src="{{ url('/Frontend/Asset/Images/card-wisata-3.png') }}"
                                class="img-responsive rounded-start" width="100%" height="100%" alt="">
                        </div>
                        <div class="col-lg-9 py-3">
                            <div class="d-flex justify-content-between">
                                <h3>Wisata Pantai</h3>
                                <h3>RP. 123,400.000</h3>
                            </div>
                            <p class="parahraph-2">
                                Wisata Pantai berarti sebuah kegiatan yang dilakukan secara sendiri atau
                                bersama-sama untuk beraktivitas sekaligus menikmati indahnya suasana di sekitar
                                pantai</p>
                            <a href="{{ route('checkout') }}" class="btn btn-primary py-1">Reservasi Wisata</a>
                            <a href="{{ route('detail-wisata') }}" class="btn btn-outline-primary py-1">Lihat Detail
                                Wisata</a>
                        </div>
                    </div>
                    <!--Card Wisata-->
                    <div class="row bg-white rounded-3 mb-2">
                        <div class="col-lg-3 p-0 m-0">
                            <img src="{{ url('/Frontend/Asset/Images/card-wisata-4.png') }}"
                                class="img-responsive rounded-start" width="100%" height="100%" alt="">
                        </div>
                        <div class="col-lg-9 py-3">
                            <div class="d-flex justify-content-between">
                                <h3>Wisata Biawak</h3>
                                <h3>RP. 123,400.000</h3>
                            </div>
                            <p class="parahraph-2">
                                Mempunyai kemiripan dengan pulau Komodo yang dihuni oleh satwa komodo, pulau Biawak
                                digadang-gadang sebagai alternatif wisata murah bagi wisatawan.</p>
                            <a href="{{ route('checkout') }}" class="btn btn-primary py-1">Reservasi Wisata</a>
                            <a href="{{ route('detail-wisata') }}" class="btn btn-outline-primary py-1">Lihat Detail
                                Wisata</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 mt-4">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
