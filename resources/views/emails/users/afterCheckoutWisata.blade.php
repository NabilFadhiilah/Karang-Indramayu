@component('mail::message')

    # Terimakasih Sudah Memesan Wisata {{ $wisata->nama_wisata }} Di Gokarang!

    Harap Segera Melakukan Upload Bukti Transfer Pada Aplikasi Sebesar Rp.{{ number_format($reservasi->total_reservasi) }}
    Dengan Klik Tombol Dibawah Ini, Jika Sudah Upload Bukti Transfer Bisa Abaikan Email Ini
    @component('mail::button', ['url' => route('payment-wisata', [$wisata->slug, $reservasi->id])])
        Upload Bukti Pembayaran
    @endcomponent

    Terimakasih,<br>
    {{ config('app.name') }}
@endcomponent
