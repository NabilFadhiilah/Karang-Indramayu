@extends('pages.admin.layouts.app')

@section('content')
    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row match-height d-flex justify-content-center">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header ">
                        <h2 class="m-0 d-flex justify-content-center">Edit Rekening</h2>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST"
                                action="{{ route('admin.rekening.update', $item->id) }}">
                                @csrf
                                @method('put')
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="nama-rekening-pemilik">Nama Pemilik Rekening</label>
                                                <input type="text" id="nama-rekening-pemilik"
                                                    class="form-control  @error('pemilik_rekening') is-invalid @enderror"
                                                    name="pemilik_rekening" placeholder="Nama Pemilik Rekening"
                                                    value="{{ old('pemilik_rekening') ?? $item->pemilik_rekening }}">
                                                @error('pemilik_rekening')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="no_rekening">No Rekening</label>
                                                <input type="text" id="no_rekening"
                                                    class="form-control  @error('no_rekening') is-invalid @enderror"
                                                    name="no_rekening" placeholder="No Rekening"
                                                    value="{{ old('no_rekening') ?? $item->no_rekening }}">
                                                @error('no_rekening')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class=" col-12">
                                            <div class="form-group">
                                                <label for="nama_bank">Nama Bank</label>
                                                <input type="text" id="nama_bank"
                                                    class="form-control  @error('bank_rekening') is-invalid @enderror"
                                                    name="bank_rekening" placeholder="Nama Bank"
                                                    value="{{ old('bank_rekening') ?? $item->bank_rekening }}">
                                                @error('bank_rekening')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="  col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
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
