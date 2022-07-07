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
    <p style="font-size: 35px;">Transaksi ID #{{ $reservasi_paket->id }}</p>
    <p>Laporan Untuk Reservasi Paket :</p>
    @foreach ($reservasi_paket->relationToPaket as $paket)
        {{ $paket->nama_paket }}
    @endforeach
    <p>Tanggal Keberangkatan :
        {{ Carbon\Carbon::parse($reservasi_paket->tgl_reservasi)->formatLocalized('%d %B %Y') }}</p>
    <table class="table" style="border: 0p;">
        <tr>
            <td>
                <p>Kontak Pemesan :</p>
                @foreach ($reservasi_paket->relationToUser as $user)
                    <p style="font-weight: 0">Nama : {{ $user->nama }}</p>
                    <p style="font-weight: 0">Email : {{ $user->email }}</p>
                    <p style="font-weight: 0">No Telp : {{ $user->no_tlp }}</p>
                    <p style="font-weight: 0">Alamat : {{ $user->alamat }}</p>
                @endforeach
            </td>
            <td>
                <p>Informasi Pembayaran : </p>
                @foreach ($reservasi_paket->relationToRekening as $rekening)
                    <p style="font-weight: 0">Ditransfer Ke Rekening :
                        {{ $rekening->bank_rekening }}</p>
                    <p style="font-weight: 0">Atas Nama :
                        {{ $rekening->pemilik_rekening }}</p>
                    <p style="font-weight: 0">Dengan Norek :
                        {{ $rekening->no_rekening }}</p>
                    <p style="font-weight: 0">Total Transfer :
                        Rp.{{ number_format($reservasi_paket->total_reservasi) }}</p>
                @endforeach
            </td>
        </tr>
    </table>
    <p>Pengeluaran :</p>
    <table class="table" style="color: black;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pengeluaran</th>
                <th scope="col">Biaya Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservasi_paket->relationToLaporan as $key => $laporan)
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
            @foreach ($reservasi_paket->relationToLaporan as $key => $laporan)
                @if ($key == 0)
                    <tr>
                        <th colspan="2">Total Pengeluaran : </th>
                        <td style="text-align: center;">Rp.{{ number_format($laporan->sum('biaya_pengeluaran')) }}
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">Total Pemasukan : </th>
                        <td style="text-align: center;">Rp.{{ number_format($reservasi_paket->total_reservasi) }}
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">Laba : </th>
                        <td style="text-align: center;">
                            Rp.{{ number_format($reservasi_paket->total_reservasi - $laporan->sum('biaya_pengeluaran')) }}
                        </td>
                    </tr>
                    <tr>
                        @if ($reservasi_paket->total_reservasi - $laporan->sum('biaya_pengeluaran') < $reservasi_paket->total_reservasi)
                            <td colspan="2"></td>
                            <td style="text-align: center; font-weight:bold; color:green;">Mendapatkan Keuntungan</td>
                        @else
                            <td colspan="2"></td>
                            <td style="text-align: center; font-weight:bold; color:red;">Mendapatkan Kerugian</td>
                        @endif
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</body>

</html>
