@extends('layouts.app')
@section('content')
    <section class="section-detail">
        <div class="container ">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-10 px-2 text-white">
                    <h3>Checkout Reservasi Wisata</h3>
                </div>
            </div>
        </div>
    </section>
    <section class="section-detail-card">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-7 px-1">
                    <div class=" main-card p-3 bg-white rounded-3 mb-2">
                        <h2>Informasi Wisata</h2>
                        <div class="row mb-3">
                            <div class="col-lg-4 pb-2 pe-md-0 mb-md-2 checkout-image">
                                <img src="{{ url('Frontend/Asset/Images/Main-wisata-landing-1.png') }}" alt="">
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
                        <h3>Data Reservasi</h3>
                        <div class="row ">
                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <label for="jumlah-partisipan" class="form-label">
                                        <p class="paragraph-2 m-0 fw-bold">Jumlah Partisipan</p>
                                    </label>
                                    <input type="number" class="form-control" id="jumlah-partisipan" value="1">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <label for="keberangkatan" class="form-label">
                                        <p class="paragraph-2 m-0 fw-bold">Tanggal Keberangkatan</p>
                                    </label>
                                    <input type="date" class="form-control" id="keberangkatan">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 px-1">
                    <div class="bg-white rounded-top p-3 side-card">
                        <h3>Informasi Paket Wisata</h3>
                        <table class="informasi-paket mb-3">
                            <tr>
                                <th width="50%">Peserta Reservasi</th>
                                <td width="50%" class="text-end">2 Orang</td>
                            </tr>
                            <tr>
                                <th width="50%">Harga Paket Wisata</th>
                                <td width="50%" class="text-end">Rp.1.234.123</td>
                            </tr>
                            <tr>
                                <th width="50%">Total Paket Wisata</th>
                                <td width="50%" class="text-end">Rp 2,468,246</td>
                            </tr>
                            <tr>
                                <th width="50%">Kode Unik</th>
                                <td width="50%" class="text-end">Rp 123</td>
                            </tr>
                            <tr>
                                <th width="50%">Total Pembayaran</th>
                                <td width="50%" class="text-end fw-bold">Rp 2,468,369</td>
                            </tr>
                        </table>
                        <h3>Metode Pembayaran</h3>
                        <div class="d-flex align-items-center mb-2">
                            <input class="form-check-input mt-0 mx-2" type="radio" name="radioNoLabel" id="radioNoLabel1"
                                value="" aria-label="...">
                            <p class="paragraph-2 justify-content-center d-flex mb-0 px-1">Asep Saripudin <br>
                                123123123 <br>
                                Bank BNI</p>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input class="form-check-input mt-0 mx-2" type="radio" name="radioNoLabel" id="radioNoLabel1"
                                value="" aria-label="...">
                            <p class="paragraph-2 justify-content-center d-flex mb-0 px-1">Asep Saripudin <br>
                                123123123 <br>
                                Bank BNI</p>
                        </div>
                    </div>
                    <a href="Pembayaran-Wisata-Terumbu.html"
                        class="btn btn-block btn-join-now py-2 col-lg-12 col-12">Reservasi Sekarang</a>
                </div>
            </div>
        </div>
    </section>
@endsection
