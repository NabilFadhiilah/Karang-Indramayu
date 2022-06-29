@extends('layouts.app')
@section('content')
    {{-- {{ dd($dataRekening, $wisata) }} --}}
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
                            @foreach ($wisata->relationToGallery as $key => $gallery)
                                @if ($key == 0)
                                    <div class="col-lg-4 pb-2 pe-md-0 mb-md-2 checkout-image">
                                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="">
                                    </div>
                                @endif
                            @endforeach
                            <div class="col-lg-8">
                                <h3>{{ $wisata->nama_wisata }}</h3>
                                <p class="paragraph-2">{!! $wisata->deskripsi !!}
                                </p>
                            </div>
                        </div>
                        <h3>Data Reservasi</h3>
                        <form action="{{ route('pembayaran-wisata', $wisata->slug) }}" method="POST">
                            @csrf
                            <div class="row ">
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="jumlah-partisipan" class="form-label">
                                            <p class="paragraph-2 m-0 fw-bold">Jumlah Partisipan</p>
                                        </label>
                                        <input type="number" name="partisipan_reservasi"
                                            class="form-control @error('partisipan_reservasi') is-invalid @enderror"
                                            value="{{ old('partisipan_reservasi') }}" id="jumlah-partisipan"
                                            placeholder="Minimal 1 Orang" min="1" onchange="calculate()">
                                        @error('partisipan_reservasi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="keberangkatan" class="form-label">
                                            <p class="paragraph-2 m-0 fw-bold">Tanggal Keberangkatan</p>
                                        </label>
                                        <input type="date" name="tgl_reservasi" value="{{ old('tgl_reservasi') }}"
                                            class="form-control
                                            @error('tgl_reservasi') is-invalid @enderror"
                                            id="keberangkatan">
                                        @error('tgl_reservasi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-lg-3 px-1">
                    <div class="bg-white rounded-top p-3 side-card">
                        <h3>Informasi Paket Wisata</h3>
                        <table class="informasi-paket mb-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="m-0" width="50%">Peserta Reservasi</h6>
                                <p class="m-0" width="50%" class="text-end" id="orang">1 Orang</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="m-0" width="50%">Harga Per Orang</h6>
                                <p class="m-0" width="50%" class="text-end">Rp.{{ number_format($wisata->harga) }}
                                </p>
                                <input type="hidden" id="harga" value="{{ $wisata->harga }}">
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="m-0" width="50%">Total Paket Wisata</h6>
                                <p class="m-0" width="50%" class="text-end" id="perkalian">Rp
                                    {{ number_format($wisata->harga) }}
                                </p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="m-0" width="50%">Kode Unik</h6>
                                <p class="m-0"width="50%" class="text-end" id="kode_unik">{{ rand(0, 999) }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="m-0" width="50%">Total Pembayaran</h6>
                                <p class="m-0" width="50%" class="text-end fw-bold" id="total_pembayaran">
                                </p>
                                <input type="hidden" name="total_reservasi" id="total-reservasi" value="">
                            </div>
                        </table>
                        <h3>Metode Pembayaran</h3>
                        @forelse ($dataRekening as $rekening)
                            <div class="d-flex align-items-center mb-2">
                                <input class="form-check-input mt-0 mx-2 @error('id_rekening') is-invalid @enderror"
                                    type="radio" name="id_rekening" id="radioNoLabel1" value="{{ $rekening->id }}"
                                    aria-label="...">
                                <p class="paragraph-2 justify-content-center d-flex mb-0 px-1">
                                    {{ $rekening->pemilik_rekening }} <br>
                                    {{ $rekening->no_rekening }} <br>
                                    {{ $rekening->bank_rekening }}</p>
                            </div>
                        @empty
                            Metode Pembayaran Belum Tersedia, Harap Hubungi Admin
                        @endforelse
                    </div>
                    @if ($dataRekening->isNotEmpty())
                        <button type="submit" class="btn btn-block btn-join-now py-2 col-lg-12 col-12">Reservasi
                            Sekarang</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        var harga = document.getElementById('harga').value;
        var kode_unik = document.getElementById('kode_unik').innerHTML;
        var total = document.getElementById('total-reservasi');
        console.log(kode_unik);
        var formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0,
            minimumFractionDigits: 0,
        });

        function calculate() {
            var jumlah_peserta = document.getElementById('jumlah-partisipan').value;
            var perkalian = jumlah_peserta * harga;
            var tambah = parseInt(kode_unik) + perkalian;
            document.getElementById('perkalian').innerHTML = formatter.format(perkalian);
            document.getElementById('orang').innerHTML = jumlah_peserta + " Orang";
            document.getElementById('total_pembayaran').innerHTML = formatter.format(tambah);
            total.value = tambah;
        }
    </script>
@endpush
