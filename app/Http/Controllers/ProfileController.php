<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ProfileController extends Controller
{
    public function index()
{
    // Mendapatkan data user yang sedang login
    $user = Auth::user();

    // Mendapatkan daftar film favorit dari tabel user_favorites
    $favorites = DB::table('user_favorites')
        ->join('movies', 'user_favorites.movie_id', '=', 'movies.id')
        ->where('user_favorites.user_id', $user->id)
        ->select('movies.name', 'movies.cover', 'movies.release_year')
        ->get();

    // Menyiapkan data untuk dikirim ke view
    $profileData = [
        'name' => $user->name,
        'age' => $user->age,
        'profile_photo' => $user->profile_photo ? asset('uploads/profile_photos/' . $user->profile_photo) : null,
        'favorites_count' => $favorites->count(),
        'favorites' => $favorites,
    ];

    return view('profile', ['profile' => $profileData]);
}

    // Menampilkan form edit profil
    public function edit()
    {
        $user = Auth::user(); // Mengambil data user yang sedang login
        return view('edit', compact('user')); // Menampilkan form untuk mengedit profil
    }

    // Menyimpan perubahan profil
    public function update(Request $request)
{
    $user = Auth::user();

    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'age' => 'required|integer|min:0',
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Update data user
    $user->name = $request->name;
    $user->email = $request->email;
    $user->age = $request->age;

    if ($request->hasFile('profile_photo')) {
        $file = $request->file('profile_photo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/profile_photos'), $filename);

        if ($user->profile_photo && file_exists(public_path('uploads/profile_photos/' . $user->profile_photo))) {
            unlink(public_path('uploads/profile_photos/' . $user->profile_photo));
        }

        $user->profile_photo = $filename;
    }

    $user->save();

    // Tambahkan pesan flash sukses
    return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    
}



}
