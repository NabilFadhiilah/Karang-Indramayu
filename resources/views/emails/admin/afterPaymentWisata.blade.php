@component('mail::message')
    # Hallo Admin!

    Wisatawan {{ $wisata->relationToUserOne->nama }} Sudah Melakukan Pembayaran Untuk Wisata
    {{ $wisata->relationToWisataOne->nama_wisata }} Sebesar Rp.{{ number_format($wisata->total_reservasi) }}, Dengan ID
    Transaksi #{{ $wisata->id }}.

    Harap Konfirmasi Pembayaran Dengan Klik Tombol Ini, Atau Akses Halaman Dashboard Admin

    @component('mail::button', ['url' => route('admin.verifikasi-wisata.index')])
        Verifikasi Pembayaran
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
