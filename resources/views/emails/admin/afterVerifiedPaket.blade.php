@component('mail::message')
    # Hallo {{ $paket->relationToUserOne->nama }}!

    Kami Informasikan Bahwa Pembayaran Paket Wisata {{ $paket->relationToPaketOne->nama_paket }} Sebesar
    Rp.{{ number_format($paket->total_reservasi) }}
    Berubah Status Menjadi {{ $paket->status_reservasi }}, dengan keterangan {{ $paket->keterangan }}
    Anda Bisa Lihat Status Pembayaran Ini Melalui
    Tombol Dibawah

    @component('mail::button', ['url' => route('dashboard-riwayat')])
        Dashboard Saya
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
