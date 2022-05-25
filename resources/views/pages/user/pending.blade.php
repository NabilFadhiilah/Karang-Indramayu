@extends('pages.user.layouts.dashboard')
@section('subcontent')
    <div class="col-lg-7 px-1">
        <div class=" main-card p-3 bg-white rounded-3 mb-2">
            <div class="col-lg-12">
                <h4>Menunggu Pembayaran</h4>
            </div>
            <div class="row" id="nav-tabs" role="tablist">
                <nav class="nav nav-tabs py-0 flex-column flex-sm-row">
                    <button class="flex-sm-fill text-sm-center nav-link active" id="nav-wisata-tab" data-bs-toggle="tab"
                        data-bs-target="#wisata" type="button" role="tab" aria-controls="nav-home" aria-selected="true"
                        aria-current="page">Wisata</button>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active p-1" id="wisata" role="tabpanel" aria-labelledby="nav-wisata-tab">
                        <div class="card row">
                            <div class="col-lg-12 py-2">
                                <div class="d-flex justify-content-between">
                                    <h4>Pembayaran Wisata Bahari</h4>
                                    <h4>ID #333</h4>
                                </div>
                                <p class="paragraph-2 mb-1">Tanggal Pemesanan 14/12/2021</p>
                                <p class="paragraph-2 mb-1">Batas Pembayaran 17/12/2021</p>
                                <h4 class="mt-2">Bank Tujuan</h4>
                                <div class="d-flex justify-content-between">
                                    <p class="paragraph-2 mb-1">No Rekening Pembayaran</h4>
                                    <p class="paragraph-2 mb-1">1234-1234-1234</h4>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="paragraph-2 mb-1">Nama Rekening</h4>
                                    <p class="paragraph-2 mb-1">Asep Saripudin</h4>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="paragraph-2 mb-1">Bank Rekening</h4>
                                    <p class="paragraph-2 mb-1">Bank BNI</h4>
                                </div>
                                <h4 class="mt-2">Total Transaksi</h4>
                                <h4>Rp 1,234,123</h4>
                                <label class="btn btn-primary mt-3">
                                    Upload Bukti Pembayaran<input type="file"></input>
                                </label>
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
