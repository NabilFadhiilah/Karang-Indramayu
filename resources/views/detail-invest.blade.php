@extends('layouts.app')
@section('content')
    <section class="section-detail">
        <div class="container ">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-10 px-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">
                                Beranda
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Eksplor Wisata
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Wisata Bahari
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="section-detail-card">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-7 px-1">
                    <div class="gallery main-card p-3 bg-white rounded-3 mb-2">
                        <h2>Wisata Bahari</h2>
                        <div class="xzoom-container">
                            <img class="xzoom" id="xzoom-default"
                                src="{{ url('/Frontend/Asset/Images/Main-wisata-landing-1.png') }}"
                                xoriginal="{{ url('/Frontend/Asset/Images/Main-wisata-landing-1.png') }}" />
                            <div class="xzoom-thumbs pt-3">
                                <a href="{{ url('/Frontend/Asset/Images/Main-wisata-landing-1.png') }}"><img
                                        class="xzoom-gallery" width="115"
                                        src="{{ url('/Frontend/Asset/Images/Main-wisata-landing-1.png') }}"
                                        xpreview="{{ url('/Frontend/Asset/Images/Main-wisata-landing-1.png') }}" /></a>
                                <a href="{{ url('/Frontend/Asset/Images/Main-wisata-landing-2.png') }}"><img
                                        class="xzoom-gallery" width="115"
                                        src="{{ url('/Frontend/Asset/Images/Main-wisata-landing-2.png') }}"
                                        xpreview="{{ url('/Frontend/Asset/Images/Main-wisata-landing-2.png') }}" /></a>
                                <a href="{{ url('/Frontend/Asset/Images/Main-wisata-landing-3.png') }}"><img
                                        class="xzoom-gallery" width="115"
                                        src="{{ url('/Frontend/Asset/Images/Main-wisata-landing-3.png') }}"
                                        xpreview="{{ url('/Frontend/Asset/Images/Main-wisata-landing-3.png') }}" /></a>
                                <a href="{{ url('/Frontend/Asset/Images/card-wisata-4.png') }}"><img
                                        class="xzoom-gallery" width="115"
                                        src="{{ url('/Frontend/Asset/Images/card-wisata-4.png') }}"
                                        xpreview="{{ url('/Frontend/Asset/Images/card-wisata-4.png') }}" /></a>
                                <a href="{{ url('/Frontend/Asset/Images/Main-wisata-landing-1.png') }}"><img
                                        class="xzoom-gallery" width="115"
                                        src="{{ url('/Frontend/Asset/Images/Main-wisata-landing-1.png') }}"
                                        xpreview="{{ url('/Frontend/Asset/Images/Main-wisata-landing-1.png') }}" /></a>
                            </div>
                        </div>
                        <h3>Tentang Paket Wisata Ini</h3>
                        <p>Wisata bahari merupakan salah satu wisata unggulan yang dimiliki Indonesia. Menurut data
                            Kementerian Kelautan dan Perikanan, Indonesia memiliki 20,87Juta Ha kawasan konservasi
                            perairan, pesisir, dan pulau-pulau kecil. Garis pantai Indonesia membentang 99.093 km
                            dengan
                            luas laut 3,257Juta km².

                            Kekayaan maritim ini membuat wisata bahari di Indonesia tak diragukan lagi keindahan dan
                            keunikannya. Wisata bahari Indonesia tersebar dari Sabang sampai Merauke. Ada banyak
                            yang
                            bisa dieksplor dalam wisata bahari Indonesia.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 px-1">
                    <div class="bg-white rounded-top p-3 side-card">
                        <h3>Informasi Pengembangan Wisata</h3>
                        <table class="informasi-paket">
                            <tr>
                                <th width="50%">Durasi Wisata</th>
                                <td width="50%" class="text-end">2 Hari 1 Malam</td>
                            </tr>
                            <tr>
                                <th width="50%">Tanggal Keberangkatan</th>
                                <td width="50%" class="text-end">21-12-2021</td>
                            </tr>
                            <tr>
                                <th width="50%">Tanggal Reservasi Awal</th>
                                <td width="50%" class="text-end">14-12-2021</td>
                            </tr>
                            <tr>
                                <th width="50%">Tanggal Reservasi Akhir</th>
                                <td width="50%" class="text-end">31-12-2021</td>
                            </tr>
                            <tr>
                                <th width="50%">Harga</th>
                                <td width="50%" class="text-end">Rp 123.123.123 / orang</td>
                            </tr>
                        </table>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Jumlah Investasi"
                                aria-label="Jumlah Investasi" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <a href="{{ route('pembayaran-invest') }}"
                        class="btn btn-block btn-join-now py-2 col-lg-12 col-12">Investasi
                        Sekarang</a>
                </div>
            </div>

        </div>
    </section>
@endsection
@push('script')
    <script src="{{ url('/Frontend/Asset/Scripts/main.js') }}"></script>
    <script src="{{ url('/Frontend/Asset/Libraries/xzoom/xzoom.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.xzoom, .xzoom-gallery').xzoom({
                zoomWidth: 500,
                title: false,
                tint: '#333',
                Xoffset: 15
            });
        });
    </script>
@endpush
