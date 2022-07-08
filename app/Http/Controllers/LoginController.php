<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\User\AfterRegister;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class LoginController extends Controller
{
    //
    public function index()
    {
        # code...
        return view('login');
    }

    public function auth(Request $request)
    {
        # code...
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            # code...
            $request->session()->regenerate();
            if (auth()->user()->roles == 'ADMIN' || auth()->user()->roles == 'SUPERUSER') {
                return redirect()->intended('admin');
            } elseif (auth()->user()->roles == 'INVESTOR') {
                return redirect()->intended('invest');
            } elseif (auth()->user()->roles == 'WISATAWAN') {
                return redirect()->intended('eksplor');
            } else {
                return redirect()->route('home');
            }
        }
        return back()->with('loginError', 'Email Atau Password Salah');
    }

    public function register()
    {
        # code...
        return view('register');
    }

    public function registerStore(Request $request)
    {
        # code...
        $data = $request->validate([
            'username' => 'required|max:255|min:3|unique:users',
            'nama' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);
        $data['password'] = Hash::make($data['password']);
        // dd($data);
        $user = User::create($data);
        event(new Registered($data));
        Mail::to($user->email)->send(new AfterRegister($user));
        return redirect('login')->with('sukses', 'Registrasi Berhasil!');
    }

    public function forgot()
    {
        # code...
        return view('forgot');
    }

    public function logout(Request $request)
    {
        # code...
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
