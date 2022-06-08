@extends('pages.admin.layouts.app')

@section('content')
    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row match-height d-flex justify-content-center">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header ">
                        <h2 class="m-0 d-flex justify-content-center">Tambah Pengembangan Wisata</h2>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST"
                                action="{{ route('admin.pengembanganWisata.store') }}">
                                @csrf
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="wisata">Pengembangan Wisata</label>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="wisata" name="id_wisata">
                                                        <option>Pilih Wisata</option>
                                                        @foreach ($wisata as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->nama_wisata }}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="target_pendanaan">Target Pendanaan</label>
                                                <input type="number" id="target_pendanaan" class="form-control"
                                                    name="target_dana" placeholder="Target Pendanaan">
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
