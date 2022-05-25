@extends('layouts.app')
@section('content')
    <section class="success-payment mt-3">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 py-3 bg-white rounded-3">
                <div class="col-12 d-flex justify-content-center">
                    <img src="{{ url('/Frontend/Asset/Images/Email-successful.png') }}" alt="">
                </div>
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="text-center">
                        <h3 class="mb-3">Reservasi Berhasil!<br>
                            Harap Tunggu E-mail Dari Kami!</h3>
                        <a href="Dashboard-Riwayat-Transaksi.html" class="col-12 mb-3 btn btn-primary">Ke Dashboard
                            Saya</a>
                        <br>
                        <a href="Index.html">Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
