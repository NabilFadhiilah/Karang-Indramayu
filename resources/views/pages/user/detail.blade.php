@extends('pages.user.layouts.dashboard')
@section('subcontent')
    {{-- {{ dd($reservasiWisata) }} --}}
    <div class="col-lg-7 px-1">
        <div class=" main-card p-3 bg-white rounded-3 mb-2">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <h4>Detail Transaksi ID #{{ $reservasiWisata->id }}</h4>
                {{-- <a href="#" class="btn btn-outline-secondary">Cetak Invoice</a> --}}
            </div>
            <div class="row mb-1 mt-3">
                <div class="col-lg-4 pb-2 pe-md-0 mb-md-2 checkout-image">
                    @foreach ($reservasiWisata->relationToGallery as $key => $gallery)
                        @if ($key == 0)
                            <img src="{{ asset('storage/' . $gallery->image) }}" alt="">
                        @endif
                    @endforeach
                </div>
                <div class="col-lg-8">
                    @foreach ($reservasiWisata->relationToWisata as $wisata)
                        <h3>{{ $wisata->nama_wisata }}</h3>
                        <p class="paragraph-2">{!! $wisata->deskripsi !!}
                        </p>
                    @endforeach
                </div>
            </div>
            <div class="row mb-2 mt-1">
                <div class="col-lg-12">
                    <h4>Detail Tanggal</h4>
                </div>
                <div class="col-12 px-4 d-flex justify-content-between">
                    <div class="col-5">
                        <p class="paragraph-2 mb-0">Tanggal Pesan</p>
                        <p class="paragraph-2 mb-0">Tanggal Keberangkatan</p>
                    </div>
                    <div class="col-5 text-end">
                        <p class="paragraph-2 mb-0">{{ $reservasiWisata->tgl_pesan_reservasi }}</p>
                        <p class="paragraph-2 mb-0">{{ $reservasiWisata->tgl_reservasi }}</p>
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
                    @foreach ($reservasiWisata->relationToRekening as $rekening)
                        <div class="col-5 text-end">
                            <p class="paragraph-2 mb-0">{{ $rekening->no_rekening }}</p>
                            <p class="paragraph-2 mb-0">{{ $rekening->pemilik_rekening }}</p>
                            <p class="paragraph-2 mb-0">{{ $rekening->bank_rekening }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row mb-2 mt-1">
                <div class="col-lg-12">
                    <h4>Rincian Biaya</h4>
                </div>
                <div class="col-12 px-4 d-flex justify-content-between">
                    <div class="col-5">
                        <p class="paragraph-2 mb-0">Harga/Orang</p>
                    </div>
                    @foreach ($reservasiWisata->relationToWisata as $wisata)
                        <div class="col-5 text-end">
                            <p class="paragraph-2 mb-0">Rp.{{ number_format($wisata->harga) }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="col-12 px-4 d-flex justify-content-between">
                    <div class="col-5">
                        <p class="paragraph-2 mb-0">Partisipan</p>
                    </div>
                    <div class="col-5 text-end">
                        <p class="paragraph-2 mb-0">{{ $reservasiWisata->partisipan_reservasi }} Orang</p>
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
                        <h2 class=" mb-0">Rp.{{ number_format($reservasiWisata->total_reservasi) }}</h2>
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
