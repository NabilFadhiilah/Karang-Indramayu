@extends('layouts.app')
@section('content')
    <section class="success-wisata mt-3">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 py-3 bg-white rounded-3">
                <div class="col-12 d-flex justify-content-center">
                    <div class="text-center">
                        <h4 class="mb-1 p-0">Segera Melakukan Pembayaran Sebelum Waktu Habis</h4>
                        <p class="mb-2 p-0">Bayar Sebelum 14 Desember 2021 pukul 10.03</p>
                        <p class="m-0 p-0 fw-bold paragraph-2">Sisa Waktu Pembayaran Anda</p>
                        <h1 class="mt-2" id="Countdown"></h1>
                        <p class="paragraph-2">Transfer Pembayaran Anda Ke Rekening Berikut</p>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center pembayaran">
                    <div class="">
                        <p class="mb-2">Asep Saripudin</p>
                        <h2>1234-1234-1234</h2>
                        <p>Bank BNI</p>
                        <hr>
                        <p class="mb-2 paragraph-2">Jumlah Pembayaran</p>
                        <h2>Rp. 1,234,456</h2>
                    </div>
                </div>
                <div class="col-12 mt-2 d-flex justify-content-center">
                    <div class="text-center col-8">
                        <p class="mb-3 paragraph-2">Pastikan Pembayaran Anda Berhasil Dan Segera Unggah
                            Bukti Pembayaran Untuk Mempercepat Verifikasi Pembayaran</p>
                        <label class="mb-3 col-8 btn btn-primary">Upload Bukti Pembayaran<input type="file"></input>
                        </label>
                        <a href="Successful-Payment-Wisata.html">demo button</a>
                        <br>
                        <a href="Dashboard-Menunggu-Pembayaran.html">Dashboard Saya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="{{ url('/Frontend/Asset/Scripts/countdown.js') }}"></script>
@endpush
