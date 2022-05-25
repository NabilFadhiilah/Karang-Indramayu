@extends('pages.user.layouts.dashboard')
@section('subcontent')
    <div class="col-lg-7 px-1">
        <div class=" main-card p-3 bg-white rounded-3 mb-2">
            <div class="row flex-column-reverse flex-lg-row">
                <div class="col-lg-6 col-sm-12 d-flex justify-content-center align-items-center">
                    <div class="avatar-circle text-center">
                        <img src="{{ url('Frontend/Asset/Images/Avatar.png') }}" alt=""><br>
                        <label class="btn btn-primary mt-3">
                            Pilih Foto
                            Profil<input type="file"></input>
                        </label>
                        <p class="paragraph-2 mt-3">Besar file:
                            maksimum
                            10.000.000 bytes (10
                            Megabytes).
                            Ekstensi file yang diperbolehkan: .JPG .JPEG .PNG</p>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <h3>Biodata Diri</h3>
                    <div class="ps-3">
                        <div class="mb-3">
                            <label for="Nama" class="form-label paragraph-2 fw-bold">Nama</label>
                            <input type="text" class="form-control" id="Nama">
                        </div>
                        <div class="mb-3">
                            <label for="Tanggal-Lahir" class="form-label paragraph-2 fw-bold">Tanggal
                                Lahir</label>
                            <input type="date" class="form-control" id="Tanggal-Lahir">
                        </div>
                        <div class="mb-3">
                            <label for="jenis-kelamin" class="form-label paragraph-2 fw-bold">Jenis
                                Kelamin</label>
                            <input type="text" class="form-control" id="jenis-kelamin">
                        </div>
                    </div>
                    <h3>Kontak</h3>
                    <div class="ps-3">
                        <div class="mb-3">
                            <label for="telp" class="form-label paragraph-2 fw-bold">Telepon</label>
                            <input type="text" class="form-control" id="Nama">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label paragraph-2 fw-bold">Email</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
