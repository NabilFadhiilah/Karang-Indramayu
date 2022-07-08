@component('mail::message')
    # Terimakasih Sudah Memesan Paket Wisata {{ $paket->nama_paket }} Di Gokarang!

    Harap Segera Melakukan Upload Bukti Transfer Pada Aplikasi Sebesar Rp.{{ number_format($reservasi->total_reservasi) }}
    Dengan Klik Tombol Dibawah Ini, Jika Sudah Upload Bukti Transfer Bisa Abaikan Email Ini

    @component('mail::button', ['url' => route('payment-paket', [$paket->slug, $reservasi->id])])
        Upload Bukti Pembayaran
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
