@extends('pages.admin.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ url('Backend/assets/vendors/simple-datatables/style.css') }}">
@endpush
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex">
                <div class="col-6">
                    <h2 class="m-0">Gallery Wisata</h2>
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
                            <th>Gambar</th>
                            @if (auth()->user()->roles == 'ADMIN')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($gallery as $item)
                            <tr>
                                <td>{{ $item->relationToWisata->nama_wisata }}</td>
                                <td><img src="{{ asset('storage/' . $item->image) }}" style="width: 75px;" alt="">
                                </td>
                                @if (auth()->user()->roles == 'ADMIN')
                                    <td class="d-flex justify-content-start">
                                        <a href="{{ route('admin.gallery.edit', $item->id) }}"
                                            class="btn btn-success btn-sm mx-1">Edit</a>
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
