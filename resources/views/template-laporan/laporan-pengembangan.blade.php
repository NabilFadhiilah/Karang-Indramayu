<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        table,
        th,
        td {
            border: 2px solid;
        }

        p {
            font-weight: 200;
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    @foreach ($reservasi_pengembangan->relationToWisata as $wisata)
        <p style="font-size: 35px; text-align:center;">Laporan Pengembangan {{ $wisata->nama_wisata }}</p>
    @endforeach
    <p style="font-size: 15px; text-align:center;">Tanggal Cetak {{ Carbon\Carbon::now()->formatLocalized('%d %B %Y') }}
    </p>
    </p>
    {{-- Pemasukan:
    <p>Rp.{{ number_format($reservasi_pengembangan->relation_to_pengembangan_wisata_sum_pendanaan) }}</p> --}}
    Pengeluaran :
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Pengeluaran</th>
                <th scope="col">Tanggal Pengeluaran</th>
                <th scope="col">Keterangan Pengeluaran</th>
                <th scope="col">Biaya Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @forelse ($reservasi_pengembangan->relationToLaporan as $key => $laporan)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $laporan->pengeluaran }}</td>
                    <td style="text-align: center;">
                        {{ Carbon\Carbon::parse($laporan->tgl_pengeluaran)->formatLocalized('%d %B %Y') }}</td>
                    <td style="text-align: center;">Rp.{{ number_format($laporan->biaya_pengeluaran) }}</td>
                    <td>{{ $laporan->ket_pengeluaran }}</td>
                </tr>
                @php
                    $total += $laporan->biaya_pengeluaran;
                @endphp
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Laporan Belum Dibuat</td>
                </tr>
            @endforelse
            <tr>
                <th colspan="4" style="text-align: center;">Total Pemasukan</th>
                <td colspan="1" style="text-align: center;">
                    Rp.{{ number_format($reservasi_pengembangan->relation_to_pengembangan_wisata_sum_pendanaan) }}
                </td>
            </tr>
            <tr>
                <th colspan="4" style="text-align: center;">Total Pengeluaran</th>
                <td colspan="1" style="text-align: center;">
                    Rp.{{ number_format($total) }}
                </td>
            </tr>
            <tr>
                <th colspan="4" style="text-align: center;">Sisa Dana</th>
                <td colspan="1" style="text-align: center;">
                    Rp.{{ number_format($reservasi_pengembangan->relation_to_pengembangan_wisata_sum_pendanaan - $total) }}
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
