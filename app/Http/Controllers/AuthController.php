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

 
     public function login(Request $request)
     {
         // Validasi input
         $credentials = $request->validate([
             'email' => 'required|email',
             'password' => 'required',
         ]);
     
         if (Auth::attempt($credentials)) {
             $request->session()->regenerate();
     
             // Periksa role pengguna
             $user = Auth::user();
     
             // Arahkan berdasarkan role
             if ($user->role === 'admin') {
                 return response()->json([
                     'message' => 'Login berhasil.',
                     'redirect' => route('admin.dashboard'), // Route untuk admin
                 ], 200);
             } elseif ($user->role === 'user') {
                 return response()->json([
                     'message' => 'Login berhasil.',
                     'redirect' => route('home'), // Route untuk user
                 ], 200);
             }
         }
     
         // Jika autentikasi gagal
         return response()->json([
             'message' => 'Email atau password tidak sesuai.',
             'errors' => [
                 'email' => ['Email atau password salah.']
             ]
         ], 422);
     }
     



    // Menampilkan halaman register
    public function showRegisterForm()
{
    return view('register'); // Pastikan view 'register' ada di resources/views/register.blade.php
}


    // Proses registrasi
    public function register(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users,email', // Email harus unik
                'password' => 'required|min:6|confirmed', // Password dan konfirmasinya harus cocok
            ]);
    
            // Membuat user baru setelah validasi sukses
            $user = new User();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->password = Hash::make($validated['password']); // Enkripsi password
            $user->role = 'user';
            $user->save();
    
            // Login user setelah registrasi
            Auth::login($user);
    
            // Kirim respons JSON untuk AJAX
            return response()->json([
                'message' => 'Registrasi berhasil.',
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login'); // Redirect ke halaman login setelah logout
    }
}
