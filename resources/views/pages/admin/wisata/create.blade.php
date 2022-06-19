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
                        <h2 class="m-0 d-flex justify-content-center">Tambah Wisata</h2>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" action="{{ route('admin.wisata.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="nama_wisata">Nama Wisata</label>
                                                <input type="text" id="nama_wisata"
                                                    class="form-control @error('nama_wisata') is-invalid @enderror"
                                                    name="nama_wisata" placeholder="Nama Wisata"
                                                    value="{{ old('nama_wisata') }}">
                                                @error('nama_wisata')
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
                                                <input name="slug" type="text"
                                                    class="form-control @error('slug') is-invalid @enderror" id="slug"
                                                    readonly value="{{ old('slug') }}">
                                                @error('slug')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">

                                            <div class="card">
                                                <label for="gambar">Gambar</label>
                                                <small class="text-muted">Hanya Menerima 5 Gambar Dengan Masing-Masing
                                                    Gambar Maksimal
                                                    1MB</small>
                                                <div class="card-content fieldGroup">
                                                    <div class="card-body p-0 mb-2">
                                                        <input id="gambar" type="file" class="form-control"
                                                            accept="image/*" name="gambar[]" onchange="previewImage()">
                                                        <div class="my-2 d-flex justify-content-center col-12">
                                                            <img class="img-preview" style="width: 250px;">
                                                        </div>
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-secondary btn-sm addMore" for="wisata">Tambah
                                                            Gambar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-content fieldGroupCopy d-none">
                                                    <div class="card-body p-0">
                                                        <input id="gambar" type="file" class="form-control"
                                                            accept="image/*" name="gambar[]" onchange="previewImage()">
                                                        <div class="my-2 d-flex justify-content-center col-12">
                                                            <img class="img-preview" style="width: 250px;">
                                                        </div>
                                                        <a href="javascript:void(0)" class="btn btn-secondary btn-sm remove"
                                                            for="wisata">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="card">
                                                <label for="deskripsi">Deskripsi Wisata</label>
                                                @error('deskripsi')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                                <input id="deskripsi" type="hidden" name="deskripsi"
                                                    value="{{ old('deskripsi') }}">
                                                <trix-editor input="deskripsi"></trix-editor>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tgl_reservasi_awal">Tanggal Reservasi Awal</label>
                                                <input type="date" id="tgl_reservasi_awal"
                                                    class="form-control  @error('tgl_reservasi_awal') is-invalid @enderror"
                                                    name="tgl_reservasi_awal" placeholder="Tanggal Reservasi Awal"
                                                    value="{{ old('tgl_reservasi_awal') }}">
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
                                                <input type="date" id="tgl_reservasi_akhir"
                                                    class="form-control  @error('tgl_reservasi_akhir') is-invalid @enderror"
                                                    name="tgl_reservasi_akhir" placeholder="Tanggal Reservasi Akhir"
                                                    value="{{ old('tgl_reservasi_akhir') }}">
                                                @error('tgl_reservasi_akhir')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="durasi_wisata">Durasi Wisata</label>
                                                <input type="text" id="durasi_wisata"
                                                    class="form-control  @error('durasi_wisata') is-invalid @enderror"
                                                    name="durasi_wisata" placeholder="Durasi Wisata"
                                                    value="{{ old('durasi_wisata') }}">
                                                @error('durasi_wisata')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="harga">Harga</label>
                                                <input type="text" id="harga"
                                                    class="form-control  @error('harga') is-invalid @enderror"
                                                    name="harga" placeholder="Harga" value="{{ old('harga') }}">
                                                @error('harga')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="card">
                                                <label for="ketentuan">Ketentuan Wisata</label>
                                                @error('ketentuan')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                                <input id="ketentuan" type="hidden" name="ketentuan"
                                                    value="{{ old('ketentuan') }}">
                                                <trix-editor input="ketentuan"></trix-editor>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
    {{-- Duplicate selection --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            //group add limit
            var maxGroup = 5;

            //add more fields group
            $(".addMore").click(function() {
                if ($('body').find('.fieldGroup').length < maxGroup) {
                    var fieldHTML = '<div class="form-group fieldGroup">' + $(".fieldGroupCopy").html() +
                        '</div>';
                    $('body').find('.fieldGroup:last').after(fieldHTML);
                } else {
                    alert('Maksimal ' + maxGroup + ' Gambar wisata yang boleh dibuat.');
                }
            });

            //remove fields group
            $("body").on("click", ".remove", function() {
                $(this).parents(".fieldGroup").remove();
            });
        });
    </script>

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
    {{-- Trix Editor --}}
    <script type="text/javascript" src="{{ url('Backend/assets/js/trix.js') }}"></script>
    <script>
        document.addEventListener("trix-file-accept", function(event) {
            event.preventDefault();
        });
    </script>

    {{-- Slug --}}
    <script>
        const title = document.querySelector("#nama_wisata");
        const slug = document.querySelector("#slug");

        title.addEventListener("change", function() {
            let preslug = title.value;
            preslug = preslug.replace(/ /g, "-");
            slug.value = preslug.toLowerCase();
        });
    </script>

    {{-- <!-- filepond validation -->
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script> --}}

    <!-- image editor -->
    {{-- <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-filter/dist/filepond-plugin-image-filter.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script> --}}

    <!-- toastify -->
    <script src="{{ url('Backend/assets/vendors/toastify/toastify.js') }}"></script>

    <!-- filepond -->
    {{-- <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script>
        // register desired plugins...
        FilePond.registerPlugin(
            // validates the size of the file...
            FilePondPluginFileValidateSize,
            // validates the file type...
            FilePondPluginFileValidateType,

            // calculates & dds cropping info based on the input image dimensions and the set crop ratio...
            FilePondPluginImageCrop,
            // preview the image file type...
            FilePondPluginImagePreview,
            // filter the image file
            FilePondPluginImageFilter,
            // corrects mobile image orientation...
            FilePondPluginImageExifOrientation,
            // calculates & adds resize information...
            FilePondPluginImageResize,
        );

        // Filepond: With Validation
        FilePond.create(document.querySelector('.with-validation-filepond'), {
            allowImagePreview: true,
            allowMultiple: true,
            allowFileEncode: false,
            required: true,
            acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
            fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
                // Do custom type detection here and return with promise
                resolve(type);
            })
        });
        const inputElement = document.querySelector('input[id="gambar"]');
        const pond = FilePond.create(inputElement);
        FilePond.setOptions({
            server: {
                url: '/upload',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
        });
    </script> --}}
@endpush
