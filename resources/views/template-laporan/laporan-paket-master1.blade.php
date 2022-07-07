<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <meta charset="UTF-8"> --}}
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
    <p style="font-size: 35px; text-align:center;">Laporan Paket Bedasarkan Periode</p>
    <p style="font-size: 20px; text-align:center;">Periode
        {{ Carbon\Carbon::parse($request->tgl_awal)->formatLocalized('%d %B %Y') }} Hingga
        {{ Carbon\Carbon::parse($request->tgl_akhir)->formatLocalized('%d %B %Y') }}
    </p>
    @foreach ($data as $transaksi)
        @foreach ($transaksi->relationToPaket as $paket)
            <p>Pengeluaran Paket : {{ $paket->nama_paket }}</p>
            <p>Harga Paket : Rp.{{ number_format($paket->harga) }}</p>
        @endforeach
        <table class="table" style="color: black;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pengeluaran</th>
                    <th scope="col">Biaya Pengeluaran</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi->relationToLaporan as $key => $laporan)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $laporan->pengeluaran }}</td>
                        <td style="text-align: center;">Rp.{{ number_format($laporan->biaya_pengeluaran) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align: center;">Pengeluaran Belum Dibuat</td>
                    </tr>
                @endforelse
                @foreach ($transaksi->relationToLaporan as $key => $laporan)
                    @if ($key == 0)
                        <tr>
                            <th colspan="2">Total Pengeluaran : </th>
                            <td style="text-align: center;">
                                Rp.{{ number_format($transaksi->relation_to_laporan_sum_biaya_pengeluaran) }}
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2">Total Pemasukan : </th>
                            <td style="text-align: center;">
                                Rp.{{ number_format($transaksi->total_reservasi) }}
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2">Laba : </th>
                            <td style="text-align: center;">
                                Rp.{{ number_format($transaksi->total_reservasi - $transaksi->relation_to_laporan_sum_biaya_pengeluaran) }}
                            </td>
                        </tr>
                        <tr>
                            @if ($transaksi->total_reservasi - $transaksi->relation_to_laporan_sum_biaya_pengeluaran < $transaksi->total_reservasi)
                                <td colspan="2"></td>
                                <td style="text-align: center; font-weight:bold; color:green;">Mendapatkan
                                    Keuntungan
                                </td>
                            @else
                                <td colspan="2"></td>
                                <td style="text-align: center; font-weight:bold; color:red;">Mendapatkan Kerugian
                                </td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>

</html>
