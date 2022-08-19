@extends('pages.admin.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ url('Backend/assets/vendors/simple-datatables/style.css') }}">
@endpush
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex">
                <div class="col-6">
                    <h2 class="m-0">Laporan Reservasi ID #{{ $paket->id }}</h2>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a href="{{ route('admin.cetak-laporan-paket-pdf', $paket->id) }}" class="btn btn-primary mx-2">Cetak
                        Laporan Ini</a>
                    @if (auth()->user()->roles == 'ADMIN')
                        <a href="{{ route('admin.reservasi-paket.laporan-paket.create', $paket->id) }}"
                            class="btn btn-primary">+
                            Tambah
                            Pengeluaran</a>
                    @endif
                </div>
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
                            <th>Pengeluaran</th>
                            <th>Tanggal Pengeluaran</th>
                            <th>Biaya Pengeluaran</th>
                            <th>Keterangan Pengeluaran</th>
                            @if (auth()->user()->roles == 'ADMIN')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($pengeluaran as $item)
                            <tr>
                                <td>{{ $item->pengeluaran }}</td>
                                <td>{{ Carbon\Carbon::parse($item->tgl_pengeluaran)->formatLocalized('%d %B %Y') }}</td>
                                <td>Rp.{{ number_format($item->biaya_pengeluaran) }}</td>
                                <td>{{ $item->ket_pengeluaran }}</td>
                                @if (auth()->user()->roles == 'ADMIN')
                                    <td class="d-flex justify-content-start">
                                        <a href="{{ route('admin.reservasi-paket.laporan-paket.edit', [$paket->id, $item->id]) }}"
                                            class="btn btn-success btn-sm mx-1">Edit</a>
                                        <form
                                            action="{{ route('admin.reservasi-paket.laporan-paket.destroy', [$paket->id, $item->id]) }}"
                                            method="post">
                                            @method('delete')
                                            @csrf
                                            <button
                                                class="btn btn-danger btn-sm"onclick="return konfirmasiHapusKonten(event)">Hapus</button>
                                        </form>
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
