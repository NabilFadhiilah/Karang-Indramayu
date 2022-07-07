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
</head>

<body>
    Informasi Paket :
    @foreach ($reservasi_paket->relationToPaket as $paket)
        <p>{{ $paket->nama_paket }}</p>
    @endforeach
    {{-- @foreach ($reservasi_paket->relationToUser as $user)
        {{ $user->nama }}
        {{ $user->email }}
        {{ $user->no_tlp }}
        {{ $user->alamat }}
    @endforeach --}}
    Ditransfer Ke Rekening :
    @foreach ($reservasi_paket->relationToRekening as $rekening)
        <p>{{ $rekening->pemilik_rekening }}</p>
        <p>{{ $rekening->bank_rekening }}</p>
        <p>{{ $rekening->no_rekening }}</p>
    @endforeach
    Pengeluaran :
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pengeluaran</th>
                <th scope="col">Biaya Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservasi_paket->relationToLaporan as $key => $laporan)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $laporan->pengeluaran }}</td>
                    <td>{{ $laporan->biaya_pengeluaran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
