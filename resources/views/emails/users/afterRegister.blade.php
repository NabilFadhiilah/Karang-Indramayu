@component('mail::message')
    # Welcome

    Hallo {{ $user->nama }}!,
    Selamat Datang Di Gokarang!
    Terimakasih Sudah Melakukan Registrasi, Akun Anda Sudah Aktif Dan Anda Bisa Melakukan Pemesanan Wisata Dan Invest Wisata


    @component('mail::button', ['url' => route('login')])
        Login Disini
    @endcomponent

    Terimakasih,<br>
    {{ config('app.name') }}
@endcomponent
