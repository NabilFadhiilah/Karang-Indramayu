@extends('pages.user.layouts.dashboard')
@section('subcontent')
    <div class="col-lg-7 px-1">
        <div class=" main-card p-3 bg-white rounded-3 mb-2">
            <div class="col-lg-12">
                <h4>Riwayat Transaksi</h4>
            </div>
            <div class="row" id="nav-tabs" role="tablist">
                <nav class="nav nav-tabs py-0 flex-column flex-sm-row">
                    <button class="flex-sm-fill text-sm-center nav-link active" id="nav-wisata-tab" data-bs-toggle="tab"
                        data-bs-target="#wisata" type="button" role="tab" aria-controls="nav-home" aria-selected="true"
                        aria-current="page">Wisata</button>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active p-1" id="wisata" role="tabpanel" aria-labelledby="nav-wisata-tab">
                        <!--Card Riwayat-->
                        <div class="row bg-white rounded-3 mb-2 border border-1 border-light">
                            <div class="col-lg-3 p-0 m-0">
                                <img src="{{ url('/Frontend/Asset/Images/Banner-Eksplor-Wisata.png') }}"
                                    class="img-responsive rounded-start" width="100%" height="100%" alt="">
                            </div>
                            <div class="col-lg-9 py-3">
                                <div class="d-flex justify-content-between">
                                    <h4 class="mb-0">Wisata Biawak</h4>
                                    <span class="badge rounded-pill bg-success">Success</span>
                                </div>
                                <div class="d-flex justify-content-between mt-1">
                                    <div class="col-lg-6">
                                        <p class="paragraph-2 mb-1">Pemesanan 14/12/2021
                                        </p>
                                        <p class="paragraph-2 mb-1">Tanggal Wisata 31/12/2021</p>
                                    </div>
                                    <div class="col-lg-4 d-flex align-items-end flex-column mt-1">
                                        <h4>Total Transaksi</h4>
                                        <h4>RP. 123,400.000</h4>
                                    </div>
                                </div>

                                <a href="Dashboard-Detail-Transaksi-Wisata.html" class="btn btn-primary py-1">Lihat
                                    Detail</a>
                                <a href="#" class="px-3">Cetak Invoice</a>
                            </div>
                        </div>
                        <!--Card Riwayat-->
                        <div class="row bg-white rounded-3 mb-2 border border-1 border-light">
                            <div class="col-lg-3 p-0 m-0">
                                <img src="{{ url('/Frontend/Asset/Images/Banner-Eksplor-Wisata.png') }}"
                                    class="img-responsive rounded-start" width="100%" height="100%" alt="">
                            </div>
                            <div class="col-lg-9 py-3">
                                <div class="d-flex justify-content-between">
                                    <h4 class="mb-0">Wisata Biawak</h4>
                                    <span class="badge rounded-pill bg-danger">Pembayaran Ditolak</span>
                                </div>
                                <div class="d-flex justify-content-between mt-1">
                                    <div class="col-lg-6">
                                        <p class="paragraph-2 mb-1">Pemesanan 14/12/2021
                                        </p>
                                        <p class="paragraph-2 mb-1">Tanggal Wisata 31/12/2021</p>
                                    </div>
                                    <div class="col-lg-4 d-flex align-items-end flex-column mt-1">
                                        <h4>Total Transaksi</h4>
                                        <h4>RP. 123,400.000</h4>
                                    </div>
                                </div>

                                <a href="Dashboard-Detail-Transaksi-Wisata.html" class="btn btn-primary py-1">Lihat
                                    Detail</a>
                                <a href="#" class="px-3">Cetak Invoice</a>
                            </div>
                        </div>
                        <!--Card Riwayat-->
                        <div class="row bg-white rounded-3 mb-2 border border-1 border-light">
                            <div class="col-lg-3 p-0 m-0">
                                <img src="{{ url('/Frontend/Asset/Images/Banner-Eksplor-Wisata.png') }}"
                                    class="img-responsive rounded-start" width="100%" height="100%" alt="">
                            </div>
                            <div class="col-lg-9 py-3">
                                <div class="d-flex justify-content-between">
                                    <h4 class="mb-0">Wisata Biawak</h4>
                                    <span class="badge rounded-pill bg-secondary">Konfirmasi
                                        Pembayaran</span>
                                </div>
                                <div class="d-flex justify-content-between mt-1">
                                    <div class="col-lg-6">
                                        <p class="paragraph-2 mb-1">Pemesanan 14/12/2021
                                        </p>
                                        <p class="paragraph-2 mb-1">Tanggal Wisata 31/12/2021</p>
                                    </div>
                                    <div class="col-lg-4 d-flex align-items-end flex-column mt-1">
                                        <h4>Total Transaksi</h4>
                                        <h4>RP. 123,400.000</h4>
                                    </div>
                                </div>

                                <a href="Dashboard-Detail-Transaksi-Wisata.html" class="btn btn-primary py-1">Lihat
                                    Detail</a>
                                <a href="#" class="px-3">Cetak Invoice</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-4">
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
@endsection
