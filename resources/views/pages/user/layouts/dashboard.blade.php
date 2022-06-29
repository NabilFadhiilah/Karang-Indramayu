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
                            @if (Auth::user()->avatar)
                                <div class="avatar-circle text-center">
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt=""
                                        srcset="" style="object-fit:cover; width:125px; height:125px;">
                                    <h4 class="mt-2">{{ Auth::user()->nama }}</h4>
                                </div>
                            @else
                                <div class="avatar-circle text-center">
                                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->nama }}" alt=""
                                        srcset="">
                                    <h4 class="mt-2">{{ Auth::user()->nama }}</h4>
                                </div>
                            @endif

                            <hr>
                            <p class="mb-1 fw-bold parahraph-2">
                                Pembelian
                            </p>
                            <div class="px-2 mb-2">
                                <p class="mb-0 paragraph-2"><a href="{{ route('dashboard-pending') }}">Menunggu
                                        Pembayaran</a></p>
                                <p class="mb-0 paragraph-2"><a href="{{ route('dashboard-riwayat') }}">Riwayat
                                        Transaksi</a></p>
                            </div>
                            <p class="mb-1 fw-bold parahraph-2">
                                Profil Saya
                            </p>
                            <div class="px-2">
                                <p class="mb-0 paragraph-2"><a href="{{ route('dashboard-user') }}">Biodata Saya</a></p>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit"
                                        style="  border: none;
                                    padding: 0;
                                    background: none;">
                                        <p class="mb-0 paragraph-2">
                                            Logout
                                        </p>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @yield('subcontent')
                </div>
            </div>
        </section>
    </main>
@endsection
