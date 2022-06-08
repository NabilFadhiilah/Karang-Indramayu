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
                                                <input type="text" id="nama_paket" class="form-control" name="nama_paket"
                                                    placeholder="Nama Paket Wisata"
                                                    value="{{ old('nama_paket') ?? $item->nama_paket }}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="slug">Slug</label>
                                                <small class="text-muted">Otomatis Terisi</small>
                                                <input name="slug" type="text" class="form-control" id="slug"
                                                    value="{{ old('slug') ?? $item->slug }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-12 form-group fieldGroup">
                                            <label for="wisata">Pilih Wisata</label>
                                            <small class="text-muted">Maksimal 3 Wisata Dalam 1 Paket</small>
                                            <div class="input-group mb-3">
                                                <select class="form-select" id="wisata" name="id_wisata[]">
                                                    <option>Pilih Wisata</option>
                                                    @foreach ($wisata as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nama_wisata }}</option>
                                                    @endforeach
                                                </select>
                                                <a href="javascript:void(0)" class="input-group-text addMore"
                                                    for="wisata">Tambah Wisata</a>
                                            </div>
                                        </div>

                                        <div class="col-12 form-group fieldGroupCopy" style="display: none;">
                                            <div class="input-group mb-3">
                                                <select class="form-select" id="wisata" name="id_wisata[]">
                                                    <option>Pilih Wisata</option>
                                                    @foreach ($wisata as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nama_wisata }}</option>
                                                    @endforeach
                                                </select>
                                                <a href="javascript:void(0)" class="input-group-text remove" for="wisata"
                                                    aria-hidden="true">Hapus Wisata</a>
                                            </div>
                                        </div>

                                        {{-- <div class="col-12">
                                            <div class="card">
                                                <label for="gambar">Gambar</label>
                                                <small class="text-muted">Hanya Menerima 5 Gambar Dengan Masing-Masing
                                                    Gambar Maksimal
                                                    1MB</small>
                                                <div class="card-content">
                                                    <div class="card-body p-0">
                                                        <input id="gambar" type="file" class="with-validation-filepond"
                                                            multiple data-max-file-size="1MB" data-max-files="5"
                                                            name="gambar">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <div class="col-12">
                                            <div class="card">
                                                <label for="deskripsi">Deskripsi Paket Wisata</label>
                                                <input id="deskripsi" type="hidden" name="deskripsi"
                                                    value="{{ old('deskripsi') ?? $item->deskripsi }}">
                                                <trix-editor input="deskripsi"
                                                    value="{{ old('deskripsi') ?? $item->deskripsi }}"></trix-editor>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tgl_reservasi_awal">Tanggal Reservasi Awal</label>
                                                <input type="date" id="tgl_reservasi_awal" class="form-control"
                                                    name="tgl_reservasi_awal" placeholder="Tanggal Reservasi Awal"
                                                    value="{{ old('tgl_reservasi_awal') ?? $item->tgl_reservasi_awal }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tgl_reservasi_akhir">Tanggal Reservasi Akhir</label>
                                                <input type="date" id="tgl_reservasi_akhir" class="form-control"
                                                    name="tgl_reservasi_akhir" placeholder="Tanggal Reservasi Akhir"
                                                    value="{{ old('tgl_reservasi_akhir') ?? $item->tgl_reservasi_akhir }}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="durasi_wisata">Durasi Wisata</label>
                                                <input type="text" id="durasi_wisata" class="form-control"
                                                    name="durasi_wisata" placeholder="Durasi Wisata"
                                                    value="{{ old('durasi_wisata') ?? $item->durasi_wisata }}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="harga">Harga</label>
                                                <input type="text" id="harga" class="form-control" name="harga"
                                                    placeholder="Harga" value="{{ old('harga') ?? $item->harga }}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="card">
                                                <label for="ketentuan">Ketentuan Paket Wisata</label>
                                                <input id="ketentuan" type="hidden" name="ketentuan"
                                                    value="{{ old('ketentuan') ?? $item->ketentuan }}">
                                                <trix-editor input="ketentuan"
                                                    value="{{ old('ketentuan') ?? $item->ketentuan }}"></trix-editor>
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
    <!-- // Basic Vertical form layout section end -->
@endsection

@push('script')
    {{-- Duplicate selection --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            //group add limit
            var maxGroup = 3;

            //add more fields group
            $(".addMore").click(function() {
                if ($('body').find('.fieldGroup').length < maxGroup) {
                    var fieldHTML = '<div class="form-group fieldGroup">' + $(".fieldGroupCopy").html() +
                        '</div>';
                    $('body').find('.fieldGroup:last').after(fieldHTML);
                } else {
                    alert('Maksimal ' + maxGroup + ' wisata yang boleh dibuat.');
                }
            });

            //remove fields group
            $("body").on("click", ".remove", function() {
                $(this).parents(".fieldGroup").remove();
            });
        });
    </script>

    {{-- Trix Editor --}}
    <script type="text/javascript" src="{{ url('Backend/assets/js/trix.js') }}"></script>
    <script>
        document.addEventListener("trix-file-accept", function(event) {
            event.preventDefault();
        });
    </script>

    <script>
        const title = document.querySelector("#nama_paket");
        const slug = document.querySelector("#slug");

        title.addEventListener("change", function() {
            let preslug = title.value;
            preslug = preslug.replace(/ /g, "-");
            slug.value = preslug.toLowerCase();
        });
    </script>

    <!-- filepond validation -->
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>

    <!-- image editor -->
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-filter/dist/filepond-plugin-image-filter.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>

    <!-- toastify -->
    <script src="{{ url('Backend/assets/vendors/toastify/toastify.js') }}"></script>

    <!-- filepond -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
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
    </script>
@endpush
