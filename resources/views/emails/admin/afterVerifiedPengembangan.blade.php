@component('mail::message')
    # Hallo {{ $pengembangan->relationToUser->nama }}!

    Kami Informasikan Bahwa Pembayaran Pengembangan {{ $pengembangan->relationToPengembanganOne->nama_wisata }} Sebesar
    Rp.{{ number_format($pengembangan->pendanaan) }}
    Berubah Status Menjadi {{ $pengembangan->status }}, Dengan Keterangan {{ $pengembangan->keterangan }}
    Anda Bisa Lihat Status Pembayaran Ini Melalui Tombol Dibawah

    @component('mail::button', ['url' => route('dashboard-riwayat')])
        Dashboard Saya
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
