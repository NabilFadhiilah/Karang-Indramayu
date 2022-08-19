<footer class="section-footer mt-5 mb-4 border-top">
    <div class="container pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <h5>Akun</h5>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="{{ route('login') }}">Login</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('register') }}">Daftar Akun</a>
                                    </li>
                                    @auth
                                        <li>
                                            <a href="{{ route('dashboard-user') }}">Dashboard</a>
                                        </li>
                                    @endauth
                                </ul>
                            </div>
                            <div class="col-12 col-lg-3">
                                <h5>Eksplorasi</h5>
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('eksplor') }}">Wisata</a></li>
                                    <li><a href="{{ route('invest') }}">Pengembangan Wisata</a></li>
                                </ul>
                            </div>
                            <div class="col-12 col-lg-3">
                                {{-- <h5>Kenali Lebih Jauh</h5>
                                <ul class="list-unstyled">
                                    <li><a href="#">Berita Kegiatan</a></li>
                                    <li><a href="#">Sistem Donasi</a></li>
                                    <li><a href="#">Sistem Wisata</a></li>
                                </ul> --}}
                            </div>
                            <div class="col-12 col-lg-3 d-flex align-items-center">
                                <img src="{{ url('Frontend/Asset/Images/Logo-Gokarang.png') }}" alt=""
                                    width="200">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row border-top justify-content-center align-items-center pt-4">
            <div class="col-auto text-gray-500 font-weight-light">
                2022 Copyright Gokarang • All rights reserved • Made in Bandung
            </div>
        </div>
    </div>
</footer>
