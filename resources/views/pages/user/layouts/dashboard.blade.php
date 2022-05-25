@extends('layouts.app')
@section('content')
    <main>
        <section class="section-detail">
            <div class="container ">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-10 px-2">
                        <h4 class="text-white">Dashboard Saya</h4>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-detail-card">
            <div class="container">
                <div class="row d-flex justify-content-center flex-column-reverse flex-lg-row">
                    <div class="col-lg-3 px-1">
                        <div class="bg-white rounded-top p-3 side-card">
                            <div class="avatar-circle text-center">
                                <img src="{{ url('Frontend/Asset/Images/Avatar.png') }}" alt="">
                                <h4 class="mt-2">Brooklyn Simmons</h4>
                            </div>
                            <hr>
                            <p class="mb-1 fw-bold parahraph-2">
                                Pembelian
                            </p>
                            <div class="px-2 mb-2">
                                <p class="mb-0 paragraph-2"><a href="Dashboard-Menunggu-Pembayaran.html">Menunggu
                                        Pembayaran</a></p>
                                <p class="mb-0 paragraph-2"><a href="Dashboard-Riwayat-Transaksi.html">Riwayat
                                        Transaksi</a></p>
                            </div>
                            <p class="mb-1 fw-bold parahraph-2">
                                Profil Saya
                            </p>
                            <div class="px-2">
                                <p class="mb-0 paragraph-2"><a href="Dashboard-Biodata.html">Biodata Saya</a></p>
                                <p class="mb-0 paragraph-2"><a href="#">Logout</a></p>
                            </div>
                        </div>
                    </div>
                    @yield('subcontent')
                </div>
            </div>
        </section>
    </main>
@endsection
