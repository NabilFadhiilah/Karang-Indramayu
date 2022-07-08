@component('mail::message')
    # Hallo {{ $wisata->relationToUserOne->nama }}!

    Kami Informasikan Bahwa Pembayaran Wisata {{ $wisata->relationToWisataOne->nama_wisata }} Sebesar
    Rp.{{ number_format($wisata->total_reservasi) }}
    Berubah Status Menjadi {{ $wisata->status_reservasi }}, Anda Bisa Lihat Status Pembayaran Ini Melalui
    Tombol Dibawah

    @component('mail::button', ['url' => route('dashboard-riwayat')])
        Dashboard Saya
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
