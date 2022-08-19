@extends('pages.admin.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ url('Backend/assets/vendors/simple-datatables/style.css') }}">
@endpush
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex">
                <div class="col-6">
                    <h2 class="m-0">Verifikasi Pengembangan</h2>
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
                            <th>Pengembangan</th>
                            <th>Pendanaan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($pengembangan as $pengembangan)
                            <tr>
                                <td>{{ $pengembangan->nama_wisata }}</td>
                                <td>Rp.{{ number_format($pengembangan->pendanaan) }}</td>
                                <td>{{ $pengembangan->status }}</td>
                                @if ($pengembangan->status != 'TERIMA' && auth()->user()->roles == 'ADMIN')
                                    <td class="d-flex justify-content-start">
                                        <a href="{{ route('admin.verifikasi-pengembangan.edit', $pengembangan->id) }}"
                                            class="btn btn-success btn-sm mx-1">Verifikasi</a>
                                    </td>
                                @else
                                    <td class="d-flex justify-content-start">
                                        <a href="{{ route('admin.verifikasi-pengembangan.show', $pengembangan->id) }}"
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
