@extends('pages.admin.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ url('Backend/assets/vendors/toastify/toastify.css') }}">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">

    {{-- trix editor --}}
    <link rel="stylesheet" type="text/css" href="{{ url('Backend/assets/css/trix.css') }}">
    <style>
        .trix-button-group.trix-button-group--file-tools {
            display: none;
        }
    </style>
@endpush

@section('content')
    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row match-height d-flex justify-content-center">
            <div class="col-md-10 col-12">
                <div class="card">
                    <div class="card-header ">
                        <h2 class="m-0 d-flex justify-content-center">Edit Paket</h2>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST"
                                action="{{ route('admin.paket.update', $item->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="nama_paket">Nama Paket Wisata</label>
                                                <input required type="text" id="nama_paket"
                                                    class="form-control @error('nama_paket') is-invalid @enderror"
                                                    value="{{ $item->nama_paket }}" name="nama_paket"
                                                    placeholder="Nama Paket Wisata">
                                                @error('nama_paket')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="slug">Slug</label>
                                                <small class="text-muted">Otomatis Terisi</small>
                                                <input required name="slug" type="text" value="{{ $item->slug }}"
                                                    class="form-control @error('slug') is-invalid @enderror" id="slug"
                                                    readonly>
                                                @error('slug')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="card">
                                                <label for="deskripsi">Deskripsi Paket Wisata</label>
                                                @error('deskripsi')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                                <input required id="deskripsi" type="hidden" name="deskripsi"
                                                    value="{{ $item->deskripsi }}">
                                                <trix-editor input="deskripsi"></trix-editor>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tgl_reservasi_awal">Tanggal Reservasi Awal</label>
                                                <input required type="date" id="tgl_reservasi_awal"
                                                    class="form-control @error('tgl_reservasi_awal') is-invalid @enderror"
                                                    name="tgl_reservasi_awal" placeholder="Tanggal Reservasi Awal"
                                                    value="{{ $item->tgl_reservasi_awal }}">
                                                @error('tgl_reservasi_awal')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tgl_reservasi_akhir">Tanggal Reservasi Akhir</label>
                                                <input required type="date" id="tgl_reservasi_akhir"
                                                    class="form-control @error('tgl_reservasi_akhir') is-invalid @enderror"
                                                    name="tgl_reservasi_akhir" placeholder="Tanggal Reservasi Akhir"
                                                    value="{{ $item->tgl_reservasi_akhir }}">
                                                @error('tgl_reservasi_akhir')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="harga">Harga</label>
                                                <input required type="number" id="harga"
                                                    class="form-control  @error('harga') is-invalid @enderror"
                                                    name="harga" placeholder="Harga" value="{{ $item->harga }}">
                                                @error('harga')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="card">
                                                <label for="ketentuan">Ketentuan Paket Wisata</label>
                                                @error('ketentuan')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                                <input required id="ketentuan" type="hidden" name="ketentuan"
                                                    value="{{ $item->ketentuan }}">
                                                <trix-editor input="ketentuan"></trix-editor>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    {{-- Duplicate selection --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    {{-- Trix Editor --}}
    <script type="text/javascript" src="{{ url('Backend/assets/js/trix.js') }}"></script>
    <script>
        document.addEventListener("trix-file-accept", function(event) {
            event.preventDefault();
        });
    </script>
    <script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementsByName("tgl_reservasi_awal")[0].setAttribute('max', today);
        document.getElementsByName("tgl_reservasi_akhir")[0].setAttribute('min', today);
    </script>

    {{-- Slug --}}
    <script>
        const title = document.querySelector("#nama_paket");
        const slug = document.querySelector("#slug");

        title.addEventListener("change", function() {
            let preslug = title.value;
            preslug = preslug.replace(/ /g, "-");
            slug.value = preslug.toLowerCase();
        });
    </script>

    <!-- toastify -->
    <script src="{{ url('Backend/assets/vendors/toastify/toastify.js') }}"></script>
@endpush
