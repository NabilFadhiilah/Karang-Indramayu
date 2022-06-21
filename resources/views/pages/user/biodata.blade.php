@extends('pages.user.layouts.dashboard')
@section('subcontent')
    <div class="col-lg-7 px-1">
        <div class=" main-card p-3 bg-white rounded-3 mb-2">
            <div class="row flex-column-reverse flex-lg-row">
                <div class="col-lg-6 col-sm-12 d-flex justify-content-center align-items-center">
                    <div class="avatar-circle text-center">
                        @if (Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="" srcset="">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->nama }}" alt=""
                                srcset="" class="img-preview" style="width: 125px; height:125px;">
                        @endif
                        {{-- <img class="img-preview" style="width: 125px; height:125px; display:none;"> --}}
                        <br>
                        <label class="btn btn-primary mt-3">
                            Pilih Foto
                            Profil<input type="file" name="avatar" id="avatar" onchange="previewImage()"
                                accept="image/*">
                        </label>
                        <p class="paragraph-2 mt-3">Besar file:
                            maksimum
                            1.000.000 bytes (1
                            Megabytes).
                            Ekstensi file yang diperbolehkan: .JPG .JPEG .PNG</p>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <form action="{{ route('dashboard-update', auth()->user()->id) }}" method="POST">
                        @method('put')
                        @csrf
                        <h3>Biodata Diri</h3>
                        <div class="ps-3">
                            <div class="mb-3">
                                <label for="Nama" class="form-label paragraph-2 fw-bold">Nama</label>
                                <input type="text" class="form-control" id="Nama" name="nama"
                                    value="{{ auth()->user()->nama }}">
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label paragraph-2 fw-bold">Jenis
                                    Kelamin</label>
                                @if (auth()->user()->jenis_kelamin == null)
                                    <div class="input-group">
                                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <small class="text-muted m-0 p-0">Sekali Terisi Tidak Bisa Diubah</small>
                                    hello
                                @else
                                    <input class="form-control" id="jenis_kelamin" name="jenis_kelamin"
                                        value="{{ auth()->user()->jenis_kelamin }}" readonly>
                                @endif
                            </div>
                        </div>
                        <h3>Kontak</h3>
                        <div class="ps-3">
                            <div class="mb-3">
                                <label for="telp" class="form-label paragraph-2 fw-bold">Telepon</label>
                                <input type="text" class="form-control" id="telp" name="no_telp"
                                    value="{{ auth()->user()->no_tlp }}">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label paragraph-2 fw-bold">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    value="{{ auth()->user()->alamat }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label paragraph-2 fw-bold">Email</label>
                                <input type="email" class="form-control" id="email"
                                    value="{{ auth()->user()->email }}" readonly>
                                <small class="text-muted">Harap Hubungi Admin Untuk Mengubah Email</small>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update Profil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImage() {
            const image = document.querySelector('#avatar');
            const imagePreview = document.querySelector('.img-preview');

            imagePreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imagePreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
