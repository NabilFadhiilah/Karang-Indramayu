@extends('pages.admin.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ url('Backend/assets/vendors/simple-datatables/style.css') }}">
@endpush
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex">
                <div class="col-6">
                    <h2 class="m-0">Wisata</h2>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a href="{{ route('admin.wisata.create') }}" class="btn btn-primary">+ Tambah Wisata</a>
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
                            <th>Wisata</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wisata as $item)
                            <tr>
                                <td>{{ $item->nama_wisata }}</td>
                                <td>{!! $item->deskripsi !!}</td>
                                <td>Rp.{{ number_format($item->harga) }}</td>
                                <td class="d-flex justify-content-start">
                                    <a href="{{ route('admin.wisata.edit', $item->id) }}"
                                        class="btn btn-success btn-sm mx-1">Edit</a>
                                    <form action="{{ route('admin.wisata.destroy', $item->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return konfirmasiHapusKonten(event)">Hapus</button>
                                    </form>
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
    <script src="{{ url('Backend\assets\js\hapus.js') }}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
@endpush
