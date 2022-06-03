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
                <div class="col-lg-7">
                    <div class="row mb-2 card-investment justify-content-center">

                        <!--Card Terumbu-->

                        <div class="col-lg-6 px-0 py-1">
                            <div class="card mx-1">
                                <img src="{{ url('/Frontend/Asset/Images/Main-wisata-landing-3.png') }}"
                                    class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Wisata Bahari</h5>
                                    <p class="card-text">Wisata bahari artinya segala jenis kegiatan wisata atau
                                        rekreasi yang aktivitasnya
                                        dilakukan di
                                        kawasan laut, baik itu di pantai, pulau, atau bawah laut.</p>
                                    <div class="progress mb-3">
                                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%"
                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                    </div>
                                    <div class="col-12 d-flex align-items-center">
                                        <div class="col-6">
                                            <a href="{{ route('invest-wisata') }}" class="btn btn-primary">Invest
                                                Sekarang</a>
                                        </div>
                                        <div class="col-6 text-end">
                                            <p class="small m-0">Target Pengembangan</p>
                                            <p class="fw-bold m-0">Rp.40.000.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 px-0 py-1">
                            <div class="card mx-1">
                                <img src="{{ url('/Frontend/Asset/Images/Main-wisata-landing-3.png') }}"
                                    class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Wisata Bahari</h5>
                                    <p class="card-text">Wisata bahari artinya segala jenis kegiatan wisata atau
                                        rekreasi yang aktivitasnya
                                        dilakukan di
                                        kawasan laut, baik itu di pantai, pulau, atau bawah laut.</p>
                                    <div class="progress mb-3">
                                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%"
                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                    </div>
                                    <div class="col-12 d-flex align-items-center">
                                        <div class="col-6">
                                            <a href="{{ route('invest-wisata') }}" class="btn btn-primary">Invest
                                                Sekarang</a>
                                        </div>
                                        <div class="col-6 text-end">
                                            <p class="small m-0">Target Pengembangan</p>
                                            <p class="fw-bold m-0">Rp.40.000.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 px-0 py-1">
                            <div class="card mx-1">
                                <img src="{{ url('/Frontend/Asset/Images/Main-wisata-landing-3.png') }}"
                                    class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Wisata Bahari</h5>
                                    <p class="card-text">Wisata bahari artinya segala jenis kegiatan wisata atau
                                        rekreasi yang aktivitasnya
                                        dilakukan di
                                        kawasan laut, baik itu di pantai, pulau, atau bawah laut.</p>
                                    <div class="progress mb-3">
                                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%"
                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                    </div>
                                    <div class="col-12 d-flex align-items-center">
                                        <div class="col-6">
                                            <a href="{{ route('invest-wisata') }}" class="btn btn-primary">Invest
                                                Sekarang</a>
                                        </div>
                                        <div class="col-6 text-end">
                                            <p class="small m-0">Target Pengembangan</p>
                                            <p class="fw-bold m-0">Rp.40.000.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
