@extends('pages.admin.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ url('Backend/assets/vendors/simple-datatables/style.css') }}">
@endpush
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex">
                <div class="col-6">
                    <h2 class="m-0">Laporan Reservasi Paket</h2>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a href="#" class="btn btn-primary">Cetak Laporan</a>
                </div>
            </div>
            <div class="card-body d-flex col-12">
                <h6 class="m-0">Buat Laporan Yang Sudah Diverifikasi</h6>
            </div>
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
                            <th>Paket</th>
                            <th>Total Reservasi</th>
                            {{-- <th>Status</th> --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($paket as $item)
                            <tr>
                                <td>#{{ $item->id }}</td>
                                @foreach ($item->relationToPaket as $detailPaket)
                                    <td>{{ $detailPaket->nama_paket }}</td>
                                @endforeach
                                <td>Rp.{{ number_format($item->total_reservasi) }}</td>
                                {{-- <td><span class="badge bg-success">{{ $item->status_reservasi }}</span></td> --}}
                                <td class="d-flex justify-content-start">
                                    <a href="{{ route('admin.reservasi-paket.laporan-paket.index', $item->id) }}"
                                        class="btn btn-secondary btn-sm mx-1">Buat Laporan</a>
                                </td>
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
