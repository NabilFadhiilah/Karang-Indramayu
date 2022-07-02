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
                        <h2 class="m-0 d-flex justify-content-center">Tambah Pengeluaran</h2>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST"
                                action="{{ route('admin.reservasi-paket.laporan-paket.store', $paket->id) }}">
                                @csrf
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="pengeluaran">Pengeluaran</label>
                                                <small class="text-muted">Pengeluaran Untuk Paket</small>
                                                <input type="text" id="pengeluaran"
                                                    class="form-control  @error('pengeluaran') is-invalid @enderror"
                                                    name="pengeluaran" placeholder="Cth: Bensin"
                                                    value="{{ old('pengeluaran') }}">
                                                @error('pengeluaran')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="biaya_pengeluaran">Biaya Pengeluaran</label>
                                                <input type="number" id="biaya_pengeluaran"
                                                    class="form-control  @error('biaya_pengeluaran') is-invalid @enderror"
                                                    name="biaya_pengeluaran" placeholder="Biaya Pengeluaran"
                                                    value="{{ old('biaya_pengeluaran') }}">
                                                @error('biaya_pengeluaran')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
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
    {{-- Trix Editor --}}
    <script type="text/javascript" src="{{ url('Backend/assets/js/trix.js') }}"></script>
    <script>
        document.addEventListener("trix-file-accept", function(event) {
            event.preventDefault();
        });
    </script>
@endpush
