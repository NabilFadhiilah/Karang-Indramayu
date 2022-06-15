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
                        <h2 class="m-0 d-flex justify-content-center">Edit Gambar Wisata</h2>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            {{-- {{ dd($item) }} --}}
                            <form class="form form-vertical" method="POST"
                                action="{{ route('admin.gallery.update', $item->id) }}" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="nama_wisata">Nama Wisata</label>
                                                <input type="text" id="nama_wisata" class="form-control"
                                                    name="nama_wisata" placeholder="Nama Wisata"
                                                    value="{{ $item->relationToWisata->nama_wisata }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="card">
                                                <label for="gambar">Gambar Sebelumnya</label>
                                                <div class="card-content fieldGroup">
                                                    <div class="card-body p-0 mb-2">
                                                        <div class="my-2 d-flex justify-content-center col-12">
                                                            <img src="{{ asset('storage/' . $item->image) }}"
                                                                style="width: 250px;" alt="">
                                                            <input type="hidden" name="oldImage"
                                                                value="{{ $item->image }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="card">
                                                <label for="gambar">Gambar Baru</label>
                                                <small class="text-muted">Ukuran Gambar Maksimal 1MB</small>
                                                <div class="card-content fieldGroup">
                                                    <div class="card-body p-0 mb-2">
                                                        <input id="gambar" type="file" class="form-control"
                                                            accept="image/*" name="gambar" onchange="previewImage()">
                                                        <div class="my-2 d-flex justify-content-center col-12">
                                                            <img class="img-preview" style="width: 250px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
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
    <!-- // Basic Vertical form layout section end -->
@endsection
@push('script')
    {{-- Preview Image --}}
    <script>
        function previewImage() {
            const image = document.querySelector('#gambar');
            const imagePreview = document.querySelector('.img-preview');

            imagePreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imagePreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush
