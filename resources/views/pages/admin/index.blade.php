@extends('pages.admin.layouts.app')
@section('content')
    <div class="page-heading">
        @if (auth()->user()->roles == 'DINAS')
            <h3>Hallo {{ auth()->user()->nama }}!
            @else
                <h3>Hallo Admin!</h3>
        @endif
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldDiscovery"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Verifikasi Pembayaran Wisata</h6>
                                        <h6 class="font-extrabold mb-0"><a class="text-decoration-underline"
                                                href="{{ route('admin.verifikasi-wisata.index') }}">{{ $wisata }}
                                                Transaksi</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Verifikasi Pembayaran Paket</h6>
                                        <h6 class="font-extrabold mb-0">
                                            <a class="text-decoration-underline"
                                                href="{{ route('admin.verifikasi-paket.index') }}">{{ $paket }}
                                                Transaksi</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldInfo-Circle"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Verifikasi Pembayaran Pengembangan</h6>
                                        <h6 class="font-extrabold mb-0"> <a class="text-decoration-underline"
                                                href="{{ route('admin.verifikasi-pengembangan.index') }}">{{ $invest }}
                                                Transaksi</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Saved Post</h6>
                                        <h6 class="font-extrabold mb-0">112</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
        @if (auth()->user()->roles == 'DINAS')
            <p>Anda Adalah Dinas, Tugas Anda Hanya Memantau Perkembangan</p>
        @endif
    </div>
@endsection
