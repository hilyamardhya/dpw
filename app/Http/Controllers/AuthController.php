<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
     // Menampilkan form login
     public function showLoginForm()
     {
         return view('login');  // Pastikan view 'auth.login' ada di resources/views/auth/login.blade.php
     }

    // Proses login
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        return redirect()->route('home');  // Redirect ke halaman home setelah login sukses
    } else {
        return back()->withErrors([
            'email' => 'Email atau password tidak sesuai.',
        ]);
    }
}


    // Menampilkan halaman register
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('home'); // Jika sudah login, redirect ke home
        }
        return view('login');
    }

    // Proses registrasi
public function register(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users,email', // Pastikan email unik
        'password' => 'required|min:6|confirmed', // Pastikan password terkonfirmasi
    ]);

    // Membuat user baru setelah validasi sukses
    $user = new User();
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->password = Hash::make($validated['password']); // Jangan lupa untuk mengenkripsi password
    $user->save(); // Menyimpan data user ke database

    // Login user setelah registrasi
    Auth::login($user);
    

    // Redirect ke halaman home setelah berhasil registrasi dan login
    return redirect()->route('home');
}


    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login'); // Redirect ke halaman login setelah logout
    }
}
