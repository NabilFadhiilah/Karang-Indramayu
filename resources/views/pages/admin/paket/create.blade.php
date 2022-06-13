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
                        <h2 class="m-0 d-flex justify-content-center">Tambah Paket</h2>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" action="{{ route('admin.paket.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="nama_paket">Nama Paket Wisata</label>
                                                <input type="text" id="nama_paket" class="form-control" name="nama_paket"
                                                    placeholder="Nama Paket Wisata">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="slug">Slug</label>
                                                <small class="text-muted">Otomatis Terisi</small>
                                                <input name="slug" type="text" class="form-control" id="slug" readonly>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="durasi_wisata">Durasi Wisata</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-select" id="durasi_wisata">
                                                        <option>Durasi Wisata</option>
                                                        <option value="1">1 Hari</option>
                                                        <option value="2">2 Hari</option>
                                                        <option value="3">3 Hari</option>
                                                        <option value="4">4 Hari</option>
                                                        <option value="5">5 Hari</option>
                                                        <option value="6">6 Hari</option>
                                                        <option value="7">7 Hari</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="durasi_paket">

                                        </div>
                                        {{-- <div class="col-12 form-group fieldGroup">
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
                                        </div>--}}

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

                                        <div class="col-12">
                                            <div class="card">
                                                <label for="deskripsi">Deskripsi Paket Wisata</label>
                                                <input id="deskripsi" type="hidden" name="deskripsi">
                                                <trix-editor input="deskripsi"></trix-editor>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tgl_reservasi_awal">Tanggal Reservasi Awal</label>
                                                <input type="date" id="tgl_reservasi_awal" class="form-control"
                                                    name="tgl_reservasi_awal" placeholder="Tanggal Reservasi Awal">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tgl_reservasi_akhir">Tanggal Reservasi Akhir</label>
                                                <input type="date" id="tgl_reservasi_akhir" class="form-control"
                                                    name="tgl_reservasi_akhir" placeholder="Tanggal Reservasi Akhir">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="harga">Harga</label>
                                                <input type="text" id="harga" class="form-control" name="harga"
                                                    placeholder="Harga">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="card">
                                                <label for="ketentuan">Ketentuan Paket Wisata</label>
                                                <input id="ketentuan" type="hidden" name="ketentuan">
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
    <!-- // Basic Vertical form layout section end -->
@endsection

@push('script')
    {{-- Duplicate selection --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $('#durasi_wisata').change(function() {
            const jumlahValue = parseInt($('#durasi_wisata').val());
            
            for (let i = 1; i <= jumlahValue; i++) {
                $('#durasi_paket').append(`
                <div class="col-12 form-group fieldGroup${i}">
                    <h5>Hari Ke ${i}</h5>
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
                        <a href="javascript:void(0)" class="input-group-text addMore${i}"
                            for="wisata">Tambah Wisata</a>
                    </div>
                </div>
            `);
            $(document).ready(function() {
                //group add limit
                var maxGroup = 99;
                //add more fields group
                $(`.addMore${i}`).click(function() {
                    // if ($('body').find('.fieldGroup${i}').length < maxGroup) {
                    if ($('body').find(`.fieldGroup${i}`).length < maxGroup) {
                        var fieldHTML = '<div class="form-group fieldGroup">' + $(".fieldGroupCopy").html() +
                            '</div>';
                            $('body').find(`.fieldGroup${i}:last`).after(fieldHTML);
                    } else {
                        alert('Maksimal ' + maxGroup + ' wisata yang boleh dibuat.');
                    }
                });

                //remove fields group
                $("body").on("click", ".remove", function() {
                    $(this).parents(".fieldGroup").remove();
                });
            });
            }
        });
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
