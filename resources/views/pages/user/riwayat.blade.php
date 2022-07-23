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
                    <button class="flex-sm-fill text-sm-center nav-link" id="nav-paket-tab" data-bs-toggle="tab"
                        data-bs-target="#paket" type="button" role="tab" aria-controls="nav-home" aria-selected="true"
                        aria-current="page">Paket Wisata</button>
                    <button class="flex-sm-fill text-sm-center nav-link" id="nav-invest-tab" data-bs-toggle="tab"
                        data-bs-target="#invest" type="button" role="tab" aria-controls="nav-home" aria-selected="true"
                        aria-current="page">Pengembangan Wisata</button>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active p-1" id="wisata" role="tabpanel"
                        aria-labelledby="nav-wisata-tab">
                        <!--Card Riwayat-->
                        @forelse ($riwayatWisata as $wisata)
                            @foreach ($wisata->relationToWisata as $key => $relasiwisata)
                                @if ($key == 0)
                                    <div class="row bg-white rounded-3 mb-2 border border-1 border-light">
                                        <div class="col-lg-3 p-0 m-0">
                                            <img src="{{ asset('storage/' . $relasiwisata->image) }}"
                                                class="img-responsive rounded-start" width="100%" height="100%"
                                                alt="">
                                        </div>
                                        <div class="col-lg-9 py-3">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="mb-0">{{ $relasiwisata->nama_wisata }}</h4>
                                @endif
                            @endforeach
                            <span class="badge rounded-pill bg-success">{{ $wisata->status_reservasi }}</span>
                    </div>

                    <div class="d-flex justify-content-between mt-1">
                        <div class="col-lg-6">
                            <p class="paragraph-2 mb-1">Pemesanan :
                                {{ $wisata->tgl_pesan_reservasi }}
                            </p>
                            <p class="paragraph-2 mb-1">Tanggal Wisata :
                                {{ $wisata->tgl_reservasi }}</p>
                        </div>
                        <div class="col-lg-4 d-flex align-items-end flex-column mt-1">
                            <h4>Total Transaksi</h4>
                            <h4>RP.{{ number_format($wisata->total_reservasi) }}</h4>
                        </div>
                    </div>

                    @if ($wisata->status_reservasi == 'TOLAK')
                        <a href="{{ route('payment-wisata', [$relasiwisata->slug, $wisata->id]) }}"
                            class="btn btn-primary mt-3">
                            Upload Bukti Pembayaran
                        </a>
                    @else
                        <a href="{{ route('dashboard-detail', $wisata->id) }}" class="btn btn-primary py-1">Lihat
                            Detail</a>
                        {{-- <a href="#" class="px-3">Cetak Invoice</a> --}}
                    @endif
                </div>
            </div>
        @empty
            <div class="col-lg-12 py-2 mb-2">
                <div class="d-flex flex-column">
                    <img class="align-self-center" style="width: 30%;object-fit: cover;"
                        src="{{ url('Frontend/Asset/Images/no-history.svg') }}" alt="">
                    <h4 class="align-self-center mt-2">Tidak Ada Riwayat Transaksi</h4>
                </div>
            </div>
            @endforelse
        </div>
        <div class="tab-pane fade p-1" id="paket" role="tabpanel" aria-labelledby="nav-paket-tab">
            <div class="card row">
                @forelse ($riwayatPaket as $Paket)
                    <div class="row bg-white rounded-3 mb-2 border border-1 border-light">
                        @foreach ($Paket->relationToPaket as $detailPaket)
                            <div class="col-lg-12 py-3">
                                <div class="d-flex justify-content-between">
                                    <h4 class="mb-0">Nama Paket : {{ $detailPaket->nama_paket }}</h4>
                                    <span class="badge rounded-pill bg-success">{{ $Paket->status_reservasi }}</span>
                                </div>
                                <p class="mb-0">Durasi Wisata : {{ $detailPaket->durasi_wisata }} Hari</p>
                                <p class="m-0">Partisipan : {{ $Paket->partisipan_reservasi }} Orang</p>
                                <p class="m-0">Tanggal Keberangkatan : {{ $Paket->tgl_reservasi }}</p>
                                <p class="m-0">Tanggal Pemesanan : {{ $Paket->tgl_pesan_reservasi }}</p>
                                <p class="m-0">Total : Rp.{{ number_format($Paket->total_reservasi) }}</p>
                            </div>
                            @if ($Paket->status_reservasi == 'TOLAK')
                                <a href="{{ route('payment-paket', [$detailPaket->slug, $Paket->id]) }}"
                                    class="btn btn-primary mt-3">
                                    Upload Bukti Pembayaran
                                </a>
                            @endif
                        @endforeach
                    </div>
                @empty
                    <div class="col-lg-12 py-2 mb-2">
                        <div class="d-flex flex-column">
                            <img class="align-self-center" style="width: 30%;object-fit: cover;"
                                src="{{ url('Frontend/Asset/Images/no-history.svg') }}" alt="">
                            <h4 class="align-self-center mt-2">Tidak Ada Riwayat Transaksi</h4>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="tab-pane fade p-1" id="invest" role="tabpanel" aria-labelledby="nav-invest-tab">
            <div class="card row">
                @forelse ($riwayatInvest as $invest)
                    {{-- {{ dd($invest) }} --}}
                    <div class="col-lg-12 py-3">
                        <div class="d-flex justify-content-between">
                            <h4 class="mb-0">Pengembangan Wisata : {{ $invest->nama_wisata }}</h4>
                            <span class="badge rounded-pill bg-success">{{ $invest->status }}</span>
                        </div>
                        <p class="m-0">Tanggal Pengembangan : {{ $invest->tgl_investasi }}</p>
                        <p class="m-0">Tanggal Verifikasi : {{ $invest->tgl_verifikasi }}</p>
                        <p class="m-0">Total Pengembangan : Rp.{{ number_format($invest->pendanaan) }}</p>
                    </div>
                    @if ($invest->status == 'TOLAK')
                        <a href="{{ route('payment-invest', [$invest->slug, $invest->id]) }}"
                            class="btn btn-primary mt-3">
                            Upload Bukti Pembayaran
                        </a>
                    @endif
                @empty
                    <div class="col-lg-12 py-2 mb-2">
                        <div class="d-flex flex-column">
                            <img class="align-self-center" style="width: 30%;object-fit: cover;"
                                src="{{ url('Frontend/Asset/Images/no-history.svg') }}" alt="">
                            <h4 class="align-self-center mt-2">Tidak Ada Riwayat Transaksi</h4>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    </div>
    <div class="col-lg-12 mt-4">
        <nav aria-label="Page navigation example" class="d-flex justify-content-center">
            {{-- {{ $riwayat->links() }} --}}
        </nav>
    </div>
    </div>
    </div>
@endsection
