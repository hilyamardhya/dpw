<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();

        // Mengakses data atribut yang diinginkan
        $username = $user->username;
        $wishlistCount = $user->wishlist_count;
        $favoritesCount = $user->favorites_count;
        $items = $user->items;

        // Menyiapkan data untuk dikirim ke view
        $profileData = [
            'username' => $username,  // Menggunakan variabel yang sudah diproses
            'wishlist' => $wishlistCount,
            'favorites' => $favoritesCount,
            'items' => $items,
        ];

        // Mengembalikan view dengan data yang diperlukan
        return view('profile', ['profile' => $profileData]);
    }
}
