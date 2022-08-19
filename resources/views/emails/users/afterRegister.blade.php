@component('mail::message')
    # Welcome

    Hallo {{ $user->nama }}!,
    Selamat Datang Di Gokarang!
    Terimakasih Sudah Melakukan Registrasi, Akun Anda Sudah Aktif Harap Verifikasi Email Anda Di Tombol Berikut


    @component('mail::button', ['url' => route('verifikasi', $user->email)])
        Verifikasi Email Anda
    @endcomponent

    Terimakasih,<br>
    {{ config('app.name') }}
@endcomponent
