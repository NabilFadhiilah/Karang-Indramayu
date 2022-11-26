@component('mail::message')
    # Hallo, {{ $invest->nama }}!

    Kami Sampaikan Laporan Investasi Anda Bulan {{ \Carbon\Carbon::now() }}

    Berikut Rinciannya

    Nama Wisata : {{ $invest->nama_wisata }}
    Jumlah Investasi Anda : Rp.{{ number_format($invest->pendanaan) }}
    Imbal Hasil : {{ $invest->imbal_hasil }}% Per-tahun
    Keuntungan Bulan Ini : Rp.{{ number_format(($invest->pendanaan * ($invest->imbal_hasil / 100)) / 12) }}

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
