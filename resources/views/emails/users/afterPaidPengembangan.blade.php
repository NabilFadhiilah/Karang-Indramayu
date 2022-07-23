@component('mail::message')

    # Hallo {{ $wisata->relationToUser->nama }}!

    Bukti Pembayaran Untuk Pengembangan Wisata Sudah Kami Terima, Harap
    Menunggu
    Email Konfirmasi Pembayaran Dari Kami.
    Anda Bisa Melihat Status Pembayaran Dengan Klik Tombol Dibawah Ini

    @component('mail::button', ['url' => route('dashboard-riwayat')])
        Dashboard Saya
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
