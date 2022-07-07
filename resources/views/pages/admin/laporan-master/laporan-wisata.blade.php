@extends('pages.admin.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ url('Backend/assets/vendors/simple-datatables/style.css') }}">
@endpush
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex">
                <div class="col-6">
                    <h2 class="m-0">Laporan Reservasi Wisata</h2>
                </div>
            </div>
            <form action="{{ route('admin.laporan-wisata-master-pdf') }}" method="POST">
                @csrf
                <div class="card-body d-flex col-12 justify-content-start">
                    {{-- <h6 class="m-0 col-12">Buat Laporan Yang Sudah Diverifikasi Bedasarakan Tanggal Verifikasi</h6> --}}
                    <div class="col-4 mx-2">
                        <div class="form-group">
                            <label for="roundText">Tanggal Awal</label>
                            <input type="date" class="form-control round" name="tgl_awal" required>
                        </div>
                    </div>
                    <div class="col-4 mx-2">
                        <div class="form-group">
                            <label for="squareText">Tanggal Akhir</label>
                            <input type="date" class="form-control square" name="tgl_akhir" required>
                        </div>
                    </div>
                    <div class="col-3 d-flex justify-content-end align-self-center">
                        <button type="submit" class="btn btn-primary">Cetak Laporan
                    </div>
                </div>
            </form>
            @if (session()->has('sukses'))
                <div class="mx-3 alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('sukses') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Wisata</th>
                            <th>Tanggal Verifikasi</th>
                            <th>Total Reservasi</th>
                            <th>Total Pengeluaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($reservasi as $item)
                            <tr>
                                <td>#{{ $item->id }}</td>
                                @foreach ($item->relationToWisata as $detailWisata)
                                    <td>{{ $detailWisata->nama_wisata }}</td>
                                @endforeach
                                <td>{{ Carbon\Carbon::parse($item->tgl_verifikasi)->formatLocalized('%d %B %Y') }}
                                <td>Rp.{{ number_format($item->total_reservasi) }}</td>
                                <td>Rp.{{ number_format($item->relation_to_laporan_sum_biaya_pengeluaran) }}</td>
                                </td>
                                @if ($item->relation_to_laporan_sum_biaya_pengeluaran == null)
                                    <td class="d-flex justify-content-start">
                                        <a href="{{ route('admin.reservasi-wisata.laporan-wisata.index', $item->id) }}"
                                            class="btn btn-success btn-sm mx-1">Buat Laporan</a>
                                    </td>
                                @else
                                    <td class="d-flex justify-content-start">
                                        <a href="{{ route('admin.reservasi-wisata.laporan-wisata.index', $item->id) }}"
                                            class="btn btn-secondary btn-sm mx-1">Edit Laporan</a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
@push('script')
    <script src="{{ url('Backend/assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    <script src="{{ url('Backend\assets\js\hapus.js') }}"></script>
@endpush
