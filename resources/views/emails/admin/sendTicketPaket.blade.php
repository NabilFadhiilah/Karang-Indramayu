@component('mail::message')
    # E-Tiket Paket Wisata {{ $paket->relationToPaketOne->nama_paket }}

    ID Transaksi #{{ $paket->id }}

    Paket Wisata Untuk {{ $paket->partisipan_reservasi }} Orang
    Tanggal Keberangkatan {{ $paket->tgl_reservasi }}
    Total Pembayaran Rp.{{ number_format($paket->total_reservasi) }}

    Detail Pemesan:
    Nama Pemesan {{ $paket->relationToUserOne->nama }}
    Nama Partisipan {{ $paket->nama_partisipan }}
    E-mail Pemesan {{ $paket->relationToUserOne->email }}

    Harap Simpan E-Tiket Ini Hingga Tanggal Keberangkatan
    *Email E-Tiket Ini Adalah Tiket Sah Untuk Paket Wisata {{ $paket->relationToPaketOne->nama_paket }}

    Thanks,
    {{ config('app.name') }}
@endcomponent
