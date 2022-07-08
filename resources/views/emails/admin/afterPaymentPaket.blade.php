@component('mail::message')
    # Hallo Admin!

    Wisatawan {{ $paket->relationToUserOne->nama }} Sudah Melakukan Pembayaran Untuk Paket Wisata
    {{ $paket->relationToPaketOne->nama_wisata }} Sebesar Rp.{{ number_format($paket->total_reservasi) }}, Dengan ID
    Transaksi #{{ $paket->id }}.

    Harap Konfirmasi Pembayaran Dengan Klik Tombol Ini, Atau Akses Halaman Dashboard Admin

    @component('mail::button', ['url' => route('admin.verifikasi-paket.index')])
        Verifikasi Pembayaran
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
