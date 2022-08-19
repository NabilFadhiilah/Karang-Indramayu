@extends('pages.admin.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ url('Backend/assets/vendors/simple-datatables/style.css') }}">
@endpush
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex">
                <div class="col-6">
                    <h2 class="m-0">Laporan Pengembangan Wisata</h2>
                </div>
                {{-- <div class="col-6 d-flex justify-content-end">
                    <a href="#" class="btn btn-primary">Cetak Laporan</a>
                </div> --}}
            </div>
            {{-- <div class="card-body d-flex col-12">
                <h6 class="m-0">Buat Laporan Yang Sudah Diverifikasi</h6>
            </div> --}}
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
                            <th>Total Pengembangan</th>
                            <th>Progress Pengembangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($pengembangan as $item)
                            <tr>
                                <td>#{{ $item->id }}</td>
                                @foreach ($item->relationToWisata as $detailWisata)
                                    <td>{{ $detailWisata->nama_wisata }}</td>
                                @endforeach
                                <td>Rp.{{ number_format($item->relation_to_pengembangan_wisata_sum_pendanaan) }}</td>
                                <td><span
                                        class="badge bg-success">{{ round(($item->relation_to_pengembangan_wisata_sum_pendanaan / $item->target_dana) * 100) }}%</span>
                                </td>
                                @if (round(($item->relation_to_pengembangan_wisata_sum_pendanaan / $item->target_dana) * 100) >= 100 &&
                                    auth()->user()->roles == 'ADMIN')
                                    <td class="d-flex justify-content-start">
                                        <a href="{{ route('admin.reservasi-pengembangan.laporan-pengembangan.index', $item->id) }}"
                                            class="btn btn-primary btn-sm mx-1">Buat Laporan</a>
                                    </td>
                                @elseif(round(($item->relation_to_pengembangan_wisata_sum_pendanaan / $item->target_dana) * 100) >= 100 &&
                                    auth()->user()->roles == 'DINAS')
                                    <td class="d-flex justify-content-start">
                                        <a href="{{ route('admin.reservasi-pengembangan.laporan-pengembangan.index', $item->id) }}"
                                            class="btn btn-info btn-sm mx-1">Lihat Laporan</a>
                                    </td>
                                @else
                                    <td class="d-flex justify-content-start">
                                        <a href="#" class="btn btn-secondary btn-sm mx-1">Progress Belum Tercapai</a>
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
