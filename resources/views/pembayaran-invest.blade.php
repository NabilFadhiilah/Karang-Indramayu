@extends('layouts.app')
@section('content')
    {{-- {{ dd($pembayaran) }} --}}
    <section class="success-wisata mt-3">
        <div class="row col-12 d-flex justify-content-center">
            <div class="col-lg-6 py-3 bg-white rounded-3">
                @foreach ($pembayaran as $item)
                    <div class="col-12 d-flex justify-content-center">
                        <div class="text-center">
                            <h4 class="mb-1 p-0">Segera Melakukan Pembayaran Sebelum Waktu Habis</h4>
                            <p class="mb-2 p-0">Bayar Sebelum
                                {{ date('d F Y H:i:s', strtotime($item->tgl_batas_pembayaran)) }}</p>
                            <p class="m-0 p-0 fw-bold paragraph-2">Sisa Waktu Pembayaran Anda</p>
                            <h1 class="mt-2" id="Countdown"></h1>
                            <p class="paragraph-2">Transfer Pembayaran Anda Ke Rekening Berikut</p>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center pembayaran">
                        @foreach ($item->relationToRekening as $rekening)
                            <div class="">
                                <p class="mb-2">{{ $rekening->pemilik_rekening }}</p>
                                <h2>{{ $rekening->no_rekening }}</h2>
                                <p>{{ $rekening->bank_rekening }}</p>
                                <hr>
                        @endforeach
                        <p class="mb-2 paragraph-2">Jumlah Pembayaran</p>
                        <h2>Rp.{{ number_format($item->pendanaan) }}</h2>
                    </div>
                @endforeach
            </div>
            <div class="col-12 mt-2 d-flex justify-content-center">
                <div class="text-center col-8">
                    <p class="mb-3 paragraph-2">Pastikan Pembayaran Anda Berhasil Dan Segera Unggah
                        Bukti Pembayaran Untuk Mempercepat Verifikasi Pembayaran</p>
                    <form action="{{ route('investUpload', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label class="mb-1 col-8 btn btn-primary">Upload Bukti Pembayaran
                            <input type="file" id="bukti_pembayaran" accept="image/*" name="bukti_pembayaran"
                                onchange="previewImage()">
                        </label>
                        <div class="d-flex justify-content-center col-12">
                            <img class="img-preview mt-2" style="width: 250px; display: none;">
                        </div>
                        <div class="d-flex justify-content-center col-12">
                            <button type="submit" id="show_button" style="display: none;"
                                class="mt-2 col-8 btn btn-primary">Kirim Bukti
                                Pembayaran</button>
                        </div>
                    </form>
                    <br>
                    <a href="{{ route('dashboard-pending') }}">Saya Bayar Nanti</a>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        function previewImage() {
            const image = document.querySelector('#bukti_pembayaran');
            const imagePreview = document.querySelector('.img-preview');

            imagePreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imagePreview.src = oFREvent.target.result;
            }

            const button = document.querySelector('#show_button');
            button.style.display = 'block';
        }
    </script>
    <script>
        // Countdown
        var countDownDate = new Date("{{ date('F d, Y H:i:s', strtotime($item->tgl_batas_pembayaran)) }}").getTime();
        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("Countdown").innerHTML =
                days +
                " Hari " +
                hours +
                " Jam " +
                minutes +
                " Menit " +
                seconds +
                " Detik ";

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("Countdown").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
@endpush
