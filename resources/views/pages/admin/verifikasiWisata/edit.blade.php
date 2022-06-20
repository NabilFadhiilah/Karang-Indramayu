@extends('pages.admin.layouts.app')
@section('content')
    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row match-height d-flex justify-content-center">
            <div class="col-md-10 col-12">
                <div class="card">
                    <div class="card-header ">
                        <h2 class="m-0 d-flex justify-content-center">Verifikasi Reservasi Wisata</h2>
                    </div>
                    <div class="card-content">
                        <div class="card-body">

                            <div class="form-body">
                                <div class="row">
                                    <div class="my-2 d-flex justify-content-center col-12">
                                        <img src="{{ asset('storage/' . $reservasi->bukti_reservasi) }}"
                                            class="img-preview" style="width: 50%;">
                                    </div>
                                    <form class="form form-vertical" method="POST"
                                        action="{{ route('admin.verifikasi-wisata.update', $reservasi->id) }}"
                                        enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <div class="col-12 form-group fieldGroup">
                                            <label for="wisata">Verifikasi Reservasi</label>
                                            <div class="input-group mb-3">
                                                <select class="form-select" id="wisata" name="status_reservasi">
                                                    <option value="{{ $reservasi->status_reservasi }}">Pending</option>
                                                    <option value="TERIMA">Terima</option>
                                                    <option value="TOLAK">Tolak</option>
                                                    <option value="BATAL">Batal</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </form>
                                    <h5>Informasi Reservasi Lebih Lanjut</h5>
                                    <div class="col-12 form-group fieldGroup">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="wisata-tab" data-bs-toggle="tab"
                                                    href="#wisata" role="tab" aria-controls="wisata"
                                                    aria-selected="true">Wisata</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="rekening-tab" data-bs-toggle="tab" href="#rekening"
                                                    role="tab" aria-controls="rekening"
                                                    aria-selected="false">Rekening</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="user-tab" data-bs-toggle="tab" href="#user"
                                                    role="tab" aria-controls="user" aria-selected="false">Kontak
                                                    Pemesan</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="wisata" role="tabpanel"
                                                aria-labelledby="wisata-tab">
                                                @foreach ($reservasi->relationToWisata as $wisata)
                                                    <p class='my-1'>Nama Wisata :
                                                        {{ $wisata->nama_wisata }}</p>
                                                    <p class='my-1'>Partisipan : {{ $reservasi->partisipan_reservasi }}
                                                        Orang</p>
                                                    <p class='my-1'>Tanggal Keberangkatan :
                                                        {{ $reservasi->tgl_reservasi }}
                                                    </p>
                                                    <p class='my-1'>Harga Wisata :
                                                        Rp.{{ number_format($wisata->harga) }}
                                                    </p>
                                                    <p class='my-1'>Total Pembayaran :
                                                        Rp.{{ number_format($reservasi->total_reservasi) }}</p>
                                                @endforeach
                                            </div>
                                            <div class="tab-pane fade" id="rekening" role="tabpanel"
                                                aria-labelledby="rekening-tab">
                                                @foreach ($reservasi->relationToRekening as $rekening)
                                                    <p class="my-1">Ditransfer Ke :
                                                        {{ $rekening->pemilik_rekening }}</p>
                                                    <p class="my-1">Dengan Norek :
                                                        {{ $rekening->no_rekening }}</p>
                                                    <p class="my-1">Bank :
                                                        {{ $rekening->bank_rekening }}</p>
                                                @endforeach
                                            </div>
                                            <div class="tab-pane fade" id="user" role="tabpanel"
                                                aria-labelledby="user-tab">
                                                <p class="my-1">Nama Pemesan : {{ $reservasi->relationToUser->nama }}
                                                </p>
                                                <p class="my-1">Email Pemesan : {{ $reservasi->relationToUser->email }}
                                                </p>
                                                <p class="my-1">No Tlp : Pemesan
                                                    {{ $reservasi->relationToUser->no_tlp }}</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic Vertical form layout section end -->
@endsection
