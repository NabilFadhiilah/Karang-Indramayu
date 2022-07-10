@component('mail::message')
    # Hallo Admin!

    Wisatawan {{ $wisata->relationToUser->nama }} Sudah Melakukan Pembayaran Untuk Pengembangan Wisata
    {{ $wisata->relationToWisataOne->nama_wisata }} Sebesar Rp.{{ number_format($wisata->pendanaan) }}, Dengan ID
    Transaksi #{{ $wisata->id }}.

    Harap Konfirmasi Pembayaran Dengan Klik Tombol Ini, Atau Akses Halaman Dashboard Admin

    @component('mail::button', ['url' => route('admin.verifikasi-pengembangan.index')])
        Verifikasi Pembayaran
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
