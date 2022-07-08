@component('mail::message')
    # E-Tiket Wisata {{ $wisata->relationToWisataOne->nama_wisata }}

    ID Transaksi #{{ $wisata->id }}

    Wisata Untuk {{ $wisata->partisipan_reservasi }} Orang
    Tanggal Keberangkatan {{ $wisata->tgl_reservasi }}
    Total Pembayaran Rp.{{ number_format($wisata->total_reservasi) }}

    Detail Pemesan:
    Nama Pemesan {{ $wisata->relationToUserOne->nama }}
    E-mail Pemesan {{ $wisata->relationToUserOne->email }}

    Harap Simpan E-Tiket Ini Hingga Tanggal Keberangkatan
    *Email E-Tiket Ini Adalah Tiket Sah Untuk Wisata {{ $wisata->relationToWisataOne->nama_wisata }}

    Thanks,
    {{ config('app.name') }}
@endcomponent
