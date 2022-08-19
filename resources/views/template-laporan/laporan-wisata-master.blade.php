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
    <p style="font-size: 35px; text-align:center;">Laporan Wisata Bedasarkan Periode</p>
    <p style="font-size: 20px; text-align:center; margin-bottom:15px;">Periode
        {{ Carbon\Carbon::parse($request->tgl_awal)->formatLocalized('%d %B %Y') }} Hingga
        {{ Carbon\Carbon::parse($request->tgl_akhir)->formatLocalized('%d %B %Y') }}
    </p>
    <table class="table" style="color: black;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Wisata</th>
                <th scope="col">Nama Wisatawan</th>
                <th scope="col">Tanggal Reservasi</th>
                <th scope="col">Pemasukan</th>
                <th scope="col">Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
                $pemasukan = 0;
            @endphp
            @foreach ($data as $key => $transaksi)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    @foreach ($transaksi->relationToWisata as $wisata)
                        <td>{{ $wisata->nama_wisata }}</td>
                    @endforeach
                    @foreach ($transaksi->relationToUser as $user)
                        <td>{{ $user->nama }}</td>
                    @endforeach
                    <td>{{ Carbon\Carbon::parse($transaksi->tgl_reservasi)->formatLocalized('%d %B %Y') }}</td>
                    <td style="text-align: center;">
                        Rp.{{ number_format($transaksi->total_reservasi) }}
                    </td>
                    <td style="text-align: center;">
                        Rp.{{ number_format($transaksi->relation_to_laporan_sum_biaya_pengeluaran) }}
                    </td>
                </tr>
                @php
                    $pemasukan += $transaksi->total_reservasi;
                    $total += $transaksi->relation_to_laporan_sum_biaya_pengeluaran;
                @endphp
            @endforeach
            {{-- @foreach ($data as $key => $transaksi)
                @if ($key == 0) --}}
            <tr>
                <th colspan="4" style="text-align: center;">Total Pemasukan</th>
                <td colspan="2" style="text-align: center;">
                    Rp.{{ number_format($pemasukan) }}
                </td>
            </tr>
            <tr>
                <th colspan="4" style="text-align: center;">Total Pengeluaran</th>
                <td colspan="2" style="text-align: center;">
                    Rp.{{ number_format($total) }}
                </td>
            </tr>
            <tr>
                @if ($pemasukan >= $total)
                    <th colspan="4"style="text-align: center; font-weight:bold; color:green;">Keuntungan
                        Diperoleh : </th>
                @else
                    <th colspan="4"style="text-align: center; font-weight:bold; color:red;">Kerugian
                        Diperoleh : </th>
                @endif
                <td colspan="2" style="text-align: center;">
                    Rp.{{ number_format($pemasukan - $total) }}
                </td>
            </tr>
            {{-- @if ($pemasukan - $total < $pemasukan)
                <tr>
                    <td colspan="4"></td>
                    <th colspan="2" style="text-align: center; color:green;">Mengalami Keuntungan</th>
                </tr>
            @elseif ($pemasukan - $total > $pemasukan)
                <tr>
                    <td colspan="4"></td>
                    <th colspan="2" style="text-align: center; color:red;">Mengalami Kerugian</th>
                </tr>
            @else
                <tr>
                    <td colspan="4"></td>
                    <th colspan="2" style="text-align: center; color:grey;">Tidak Laba Tidak Rugi</th>
                </tr>
            @endif --}}
            {{-- @endif
            @endforeach --}}
        </tbody>
    </table>
    <p style="font-size: 15px;">*Bedasarkan Tanggal Pembayaran Diverifikasi</p>
</body>

</html>
