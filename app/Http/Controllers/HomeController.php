<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Menampilkan halaman home
        return view('home');
    }
    public function getUserProfile()
    {
        $user = Auth::user();

        // Pastikan user terautentikasi
        if (!$user) {
            return response()->json([
                'name' => 'Guest',
                'profile_photo' => asset('default-profile.jpg'),
            ]);
        }

        return response()->json([
            'name' => $user->name,
            'profile_photo' => asset($user->profile_photo ?? 'default-profile.jpg'),
        ]);
    }
    public function getLatestMovies()
    {
        $movies = DB::table('movies')
            ->orderBy('created_at', 'desc')
            ->select('id', 'name', 'cover')
            ->limit(10)
            ->get();

        return response()->json($movies, 200);
    }
    public function addToFavorites($id)
    {
        $userId = Auth::id();

        // Cek apakah film sudah ditambahkan ke favorit
        $exists = DB::table('user_favorites')->where('user_id', $userId)->where('movie_id', $id)->exists();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Film sudah ada di favorit.']);
        }

        // Tambahkan film ke favorit
        DB::table('user_favorites')->insert([
            'user_id' => $userId,
            'movie_id' => $id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Film berhasil ditambahkan ke favorit.']);
    }
}
