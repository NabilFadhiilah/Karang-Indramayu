@extends('layouts.auth')
@section('auth-content')
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">

                    {{-- <div class="auth-logo">
                        <a href="index.html"><img src="{{ url('Backend/assets/images/logo/logo.png') }}" alt="Logo"></a>
                    </div> --}}
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Gunakan Akun Gokarang Anda.</p>
                    @if (session()->has('sukses'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('sukses') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('loginError') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif


                    <form action="/login" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" name="email" required
                                class="form-control form-control-xl @error('email') is-invalid @enderror"
                                placeholder="Email" value="{{ old('email') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" required class="form-control form-control-xl"
                                placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Belum Punya Akun? <a href="{{ route('register') }}"
                                class="font-bold">Daftar</a>.</p>
                        {{-- <p><a class="font-bold" href="{{ route('forgot') }}">Lupa password?</a>.</p> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
@endsection
