@component('mail::message')

    # Terimakasih Sudah Melakukan Pengembangan Wisata Di Gokarang!
    Di Wisata {{ $wisata->nama_wisata }},

    Harap Segera Melakukan Upload Bukti Transfer Pada Aplikasi Sebesar Rp.{{ number_format($pengembangan->pendanaan) }}
    Dengan Klik Tombol Dibawah Ini, Jika Sudah Upload Bukti Transfer Bisa Abaikan Email Ini
    @component('mail::button', ['url' => route('payment-invest', [$wisata->slug, $pengembangan->id])])
        Upload Bukti Pembayaran
    @endcomponent

    Terimakasih,<br>
    {{ config('app.name') }}
@endcomponent
