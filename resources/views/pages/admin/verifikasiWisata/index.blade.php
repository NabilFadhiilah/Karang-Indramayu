@extends('pages.admin.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ url('Backend/assets/vendors/simple-datatables/style.css') }}">
@endpush
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex">
                <div class="col-6">
                    <h2 class="m-0">Verifikasi Wisata</h2>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Wisata</th>
                            <th>Tanggal Keberangkatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($reservasi as $item)
                            <tr>
                                <td>#{{ $item->id }}</td>
                                @foreach ($item->relationToWisata as $wisata)
                                    <td>{{ $wisata->nama_wisata }}</td>
                                @endforeach
                                <td>{{ $item->tgl_reservasi }}</td>
                                <td><span class="badge bg-success">{{ $item->status_reservasi }}</span></td>
                                @if ($item->status_reservasi == 'BATAL' && auth()->user()->roles == 'ADMIN')
                                    <td class="d-flex justify-content-start">
                                        <a href="{{ route('admin.verifikasi-wisata.show', $item->id) }}"
                                            class="btn btn-info btn-sm mx-1">Lihat</a>
                                    </td>
                                @elseif ($item->status_reservasi != 'TERIMA' && auth()->user()->roles == 'ADMIN')
                                    <td class="d-flex justify-content-start">
                                        <a href="{{ route('admin.verifikasi-wisata.edit', $item->id) }}"
                                            class="btn btn-success btn-sm mx-1">Verifikasi</a>
                                    </td>
                                @else
                                    <td class="d-flex justify-content-start">
                                        <a href="{{ route('admin.verifikasi-wisata.show', $item->id) }}"
                                            class="btn btn-info btn-sm mx-1">Lihat</a>
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
@endpush
