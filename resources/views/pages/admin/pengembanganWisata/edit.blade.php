@extends('pages.admin.layouts.app')

@push('style')
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
            <div class="col-8">
                <div class="card">
                    <div class="card-header ">
                        <h2 class="m-0 d-flex justify-content-center">Edit Pengembangan Wisata</h2>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST"
                                action="{{ route('admin.pengembanganWisata.update', $item->id) }}">
                                @csrf
                                @method('put')
                                <div class="form-body">
                                    <div class="row">

                                        {{-- <div class="col-12">
                                            <div class="form-group">
                                                <label for="wisata">Pengembangan Wisata</label>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="wisata" name="id_wisata">
                                                        @foreach ($item->relationToWisata as $wisata)
                                                            <option selected value="{{ $wisata->id }}">
                                                                {{ $wisata->nama_wisata }}</option>
                                                        @endforeach
                                                        @foreach ($wisata as $data)
                                                            <option value="{{ $data->id }}">
                                                                {{ $data->nama_wisata }}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="card">
                                                <label for="deskripsi">Deskripsi Pengembangan Wisata</label>
                                                @error('deskripsi')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                                <input id="deskripsi" type="hidden" name="deskripsi"
                                                    value="{{ old('deskripsi') ?? $item->deskripsi }}">
                                                <trix-editor input="deskripsi"></trix-editor>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="imbal_hasil">Imbal Hasil</label>
                                                <small class="text-muted">Dana Imbal Hasil Pertahun (Dalam Bentuk
                                                    Persen)</small>
                                                <input type="number" id="imbal_hasil"
                                                    class="form-control  @error('imbal_hasil') is-invalid @enderror"
                                                    name="imbal_hasil" placeholder="Cth: 18"
                                                    value="{{ old('imbal_hasil') ?? $item->imbal_hasil }}">
                                                @error('imbal_hasil')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="target_dana">Target Pendanaan</label>
                                                <input type="number" id="target_dana"
                                                    class="form-control  @error('target_dana') is-invalid @enderror"
                                                    name="target_dana" placeholder="Target Pendanaan"
                                                    value="{{ old('target_dana') ?? $item->target_dana }}">
                                                @error('target_dana')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="min_investasi">Minimal Investasi</label>
                                                <input type="number" id="min_investasi"
                                                    class="form-control  @error('min_investasi') is-invalid @enderror"
                                                    name="min_investasi" placeholder="Minimal investasi"
                                                    value="{{ old('min_investasi') ?? $item->min_investasi }}">
                                                @error('min_investasi')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class=" col-12 d-flex justify-content-end">
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
    {{-- Trix Editor --}}
    <script type="text/javascript" src="{{ url('Backend/assets/js/trix.js') }}"></script>
    <script>
        document.addEventListener("trix-file-accept", function(event) {
            event.preventDefault();
        });
    </script>
@endpush
