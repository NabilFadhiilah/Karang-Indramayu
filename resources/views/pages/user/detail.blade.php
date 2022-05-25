@extends('pages.user.layouts.dashboard')
@section('subcontent')
    <div class="col-lg-7 px-1">
        <div class=" main-card p-3 bg-white rounded-3 mb-2">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <h4>Detail Transaksi ID #123</h4>
                <a href="#" class="btn btn-outline-secondary">Cetak Invoice</a>
            </div>
            <div class="row mb-1 mt-3">
                <div class="col-lg-4 pb-2 pe-md-0 mb-md-2 checkout-image">
                    <img src="{{ url('/Frontend/Asset/Images/Main-wisata-landing-1.png') }}" alt="">
                </div>
                <div class="col-lg-8">
                    <h3>Wisata Bahari</h3>
                    <p class="paragraph-2">Wisata bahari merupakan salah satu wisata unggulan yang
                        dimiliki Indonesia. Menurut data Kementerian Kelautan dan Perikanan, Indonesia
                        memiliki 20,87Juta Ha kawasan konservasi perairan, pesisir, dan pulau-pulau
                        kecil.
                    </p>
                </div>
            </div>
            <div class="row mb-2 mt-1">
                <div class="col-lg-12">
                    <h4>Detail Tanggal</h4>
                </div>
                <div class="col-12 px-4 d-flex justify-content-between">
                    <div class="col-5">
                        <p class="paragraph-2 mb-0">Tanggal Reservasi</p>
                        <p class="paragraph-2 mb-0">Tanggal Keberangkatan</p>
                        <p class="paragraph-2 mb-0">Jumlah Partisipan</p>
                    </div>
                    <div class="col-5 text-end">
                        <p class="paragraph-2 mb-0">9/12/2021</p>
                        <p class="paragraph-2 mb-0">14/12/2021</p>
                        <p class="paragraph-2 mb-0">2 Orang</p>
                    </div>
                </div>
            </div>
            <div class="row mb-2 mt-1">
                <div class="col-lg-12">
                    <h4>Metode Pembayaran</h4>
                </div>
                <div class="col-12 px-4 d-flex justify-content-between">
                    <div class="col-5">
                        <p class="paragraph-2 mb-0">No Rekening</p>
                        <p class="paragraph-2 mb-0">Nama Rekening</p>
                        <p class="paragraph-2 mb-0">Bank Rekening</p>
                    </div>
                    <div class="col-5 text-end">
                        <p class="paragraph-2 mb-0">1234-1234-1234</p>
                        <p class="paragraph-2 mb-0">Asep Saripudin</p>
                        <p class="paragraph-2 mb-0">BNI</p>
                    </div>
                </div>
            </div>
            <div class="row mb-2 mt-1">
                <div class="col-lg-12">
                    <h4>Rincian Biaya</h4>
                </div>
                <div class="col-12 px-4 d-flex justify-content-between">
                    <div class="col-5">
                        <p class="paragraph-2 mb-0">Harga Wisata</p>
                    </div>
                    <div class="col-5 text-end">
                        <p class="paragraph-2 mb-0">Rp.1,234,123</p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mb-2 mt-1">
                <div class="col-12 d-flex justify-content-between">
                    <div class="col-5">
                        <h2 class=" mb-0">Sub Total</h2>
                    </div>
                    <div class="col-5 text-end">
                        <h2 class=" mb-0">Rp.1,234,123</h2>
                    </div>
                </div>
            </div>
            <div class="row mb-1 mt-3 d-flex justify-content-center">
                <div class="col-lg-3 pb-2 pe-md-0 mb-md-2 checkout-image">
                    <img src="{{ url('/Frontend/Asset/Images/Terimakasih-Wisata.png') }}" alt="">
                </div>
                <div class="col-lg-6">
                    <h3>Kami Tunggu Kedatangan Anda</h3>
                    <p class="paragraph-2">Nulla Lorem mollit cupidatat irure. Laborum magna nulla duis
                        ullamco cillum dolor. Voluptate exercitation incididunt aliquip deserunt
                        reprehenderit elit laborum.
                    </p>
                </div>
            </div>
            <div class="col-lg-12 d-flex justify-content-center"><img src="/Asset/Images/Logo-Gokarang.png" width="150"
                    alt="" srcset=""></div>
        </div>
    </div>
@endsection
