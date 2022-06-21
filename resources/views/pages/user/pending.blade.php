@extends('pages.user.layouts.dashboard')
@section('subcontent')
    {{-- {{ dd($pending) }} --}}
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
                    <button class="flex-sm-fill text-sm-center nav-link" id="nav-invest-tab" data-bs-toggle="tab"
                        data-bs-target="#invest" type="button" role="tab" aria-controls="nav-home" aria-selected="true"
                        aria-current="page">Pengembangan Wisata</button>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active p-1" id="wisata" role="tabpanel"
                        aria-labelledby="nav-wisata-tab">
                        <div class="border">


                            @forelse ($pending as $dataPending)
                                <div class="card row mb-2">
                                    <div class="col-lg-12 py-2 ">
                                        <div class="d-flex justify-content-between">
                                            @foreach ($dataPending->relationToWisata as $wisata)
                                                <h4>Pembayaran {{ $wisata->nama_wisata }}</h4>
                                            @endforeach
                                            <h4>ID #{{ $dataPending->id }}</h4>
                                        </div>
                                        <p class="paragraph-2 mb-1">Tanggal Pemesanan
                                            {{ $dataPending->tgl_pesan_reservasi }}
                                        </p>
                                        <p class="paragraph-2 mb-1">Batas Pembayaran {{ $dataPending->tgl_reservasi }}</p>
                                        <h4 class="mt-2">Bank Tujuan</h4>
                                        @foreach ($dataPending->relationToRekening as $rekening)
                                            <div class="d-flex justify-content-between">
                                                <p class="paragraph-2 mb-1">No Rekening Pembayaran</h4>
                                                <p class="paragraph-2 mb-1">{{ $rekening->no_rekening }}</h4>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <p class="paragraph-2 mb-1">Nama Rekening</h4>
                                                <p class="paragraph-2 mb-1">{{ $rekening->pemilik_rekening }}</h4>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <p class="paragraph-2 mb-1">Bank Rekening</h4>
                                                <p class="paragraph-2 mb-1">{{ $rekening->bank_rekening }}</h4>
                                            </div>
                                        @endforeach
                                        <h4 class="mt-2">Total Transaksi</h4>
                                        <h4>Rp.{{ number_format($dataPending->total_reservasi) }}</h4>
                                        @foreach ($dataPending->relationToWisata as $wisata)
                                            <a href="{{ route('payment-wisata', [$wisata->slug, $dataPending->id]) }}"
                                                class="btn btn-primary mt-3">
                                                Upload Bukti Pembayaran
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @empty
                                <div class="col-lg-12 py-2 mb-2">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" style="width: 30%;object-fit: cover;"
                                            src="{{ url('Frontend/Asset/Images/no-payment.svg') }}" alt="">
                                        <h4 class="align-self-center mt-2">Hooraay! Tidak Ada Pembayaran Tertunda</h4>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="tab-pane fade p-1" id="invest" role="tabpanel" aria-labelledby="nav-invest-tab">
                        <div class="card row">
                            @forelse ($pendingInvest as $invest)
                                <div class="col-lg-12 py-2 mb-2">
                                    <div class="d-flex justify-content-between">
                                        <h4>Pembayaran Pengembangan {{ $invest->nama_wisata }}</h4>
                                        <h4>ID #{{ $invest->id }}</h4>
                                    </div>
                                    <p class="paragraph-2 mb-1">Tanggal Investasi {{ $invest->tgl_investasi }}
                                    </p>
                                    <p class="paragraph-2 mb-1">Batas Pembayaran {{ $invest->tgl_batas_pembayaran }}</p>
                                    <h4 class="mt-2">Bank Tujuan</h4>
                                    @foreach ($invest->relationToRekening as $rekening)
                                        <div class="d-flex justify-content-between">
                                            <p class="paragraph-2 mb-1">No Rekening Pembayaran</h4>
                                            <p class="paragraph-2 mb-1">{{ $rekening->no_rekening }}</h4>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p class="paragraph-2 mb-1">Nama Rekening</h4>
                                            <p class="paragraph-2 mb-1">{{ $rekening->pemilik_rekening }}</h4>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p class="paragraph-2 mb-1">Bank Rekening</h4>
                                            <p class="paragraph-2 mb-1">{{ $rekening->bank_rekening }}</h4>
                                        </div>
                                    @endforeach
                                    <h4 class="mt-2">Total Transaksi</h4>
                                    <h4>Rp.{{ number_format($invest->pendanaan) }}</h4>
                                    {{-- @foreach ($pending->relationToWisata as $wisataa)
                                <a href="{{ route('payment-wisata', $wisataa->slug) }}" class="btn btn-primary mt-3">
                                    Upload Bukti Pembayaran
                                </a>
                            @endforeach --}}
                                </div>
                            @empty
                                <div class="col-lg-12 py-2 mb-2">
                                    <div class="d-flex flex-column">
                                        <img class="align-self-center" style="width: 30%;object-fit: cover;"
                                            src="{{ url('Frontend/Asset/Images/no-payment.svg') }}" alt="">
                                        <h4 class="align-self-center mt-2">Hooraay! Tidak Ada Pembayaran Tertunda</h4>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-4">
                <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                    {{-- {{ $pending->links() }} --}}
                </nav>
            </div>
        </div>
    </div>
@endsection
