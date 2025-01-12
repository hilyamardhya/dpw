<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function index()
    {
        return view('admin');
    }
    public function getAdminData()
    {
        // Ambil data admin yang sedang login
        $admin = Auth::user();

        // Pastikan data admin ditemukan
        if (!$admin) {
            return response()->json([
                'message' => 'Admin not found',
            ], 404);
        }

        // Kirim data admin
        return response()->json([
            'name' => $admin->name,
            'profile_photo' => $admin->profile_photo 
                ? asset('uploads/profile_photos/' . $admin->profile_photo)
                : asset('uploads/profile_photos/default-avatar.jpg'),
        ]);
    }
    public function storeMovie(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'release_year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'director' => 'required|string|max:255',
            'studio' => 'required|string|max:255',
        ]);
    
        try {
            // Simpan file gambar ke folder storage/app/public/uploads/movies
            $coverPath = $request->file('cover')->store('uploads/movies', 'public');
    
            // Simpan path relatif ke database
            $movieId = DB::table('movies')->insertGetId([
                'name' => $request->name,
                'cover' => $coverPath, // Simpan path relatif
                'release_year' => $request->release_year,
                'director' => $request->director,
                'studio' => $request->studio,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            // Ambil data film yang baru ditambahkan
            $movie = DB::table('movies')->where('id', $movieId)->first();
            $movie->cover = asset('storage/' . $movie->cover); // Tambahkan URL lengkap untuk respons JSON
    
            return response()->json([
                'success' => true,
                'message' => 'Film berhasil ditambahkan.',
                'movie' => $movie,
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
            ], 500);
        }
    }
    

    public function getMovies()
    {
        // Ambil semua data film
        $movies = DB::table('movies')->get();
    
        // Ubah path relatif menjadi URL lengkap
        $movies->transform(function ($movie) {
            $movie->cover = asset('storage/' . $movie->cover);
            return $movie;
        });
    
        return response()->json($movies, 200);
    }

    public function editMovie(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Cover opsional
        'release_year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
        'director' => 'required|string|max:255',
        'studio' => 'required|string|max:255',
    ]);

    try {
        // Ambil data film
        $movie = DB::table('movies')->where('id', $id)->first();

        if (!$movie) {
            return response()->json([
                'success' => false,
                'message' => 'Film tidak ditemukan.',
            ], 404);
        }

        // Update cover jika ada
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('uploads/movies', 'public');
        } else {
            $coverPath = $movie->cover;
        }

        // Update data di database
        DB::table('movies')->where('id', $id)->update([
            'name' => $request->name,
            'cover' => $coverPath,
            'release_year' => $request->release_year,
            'director' => $request->director,
            'studio' => $request->studio,
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Film berhasil diperbarui.',
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage(),
        ], 500);
    }
}
public function deleteMovie($id)
{
    try {
        // Ambil data film
        $movie = DB::table('movies')->where('id', $id)->first();

        if (!$movie) {
            return response()->json([
                'success' => false,
                'message' => 'Film tidak ditemukan.',
            ], 404);
        }

        // Hapus file gambar
        if ($movie->cover && file_exists(public_path('storage/' . $movie->cover))) {
            unlink(public_path('storage/' . $movie->cover));
        }

        // Hapus data film dari database
        DB::table('movies')->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Film berhasil dihapus.',
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage(),
        ], 500);
    }
}
public function getMovieById($id)
{
    // Ambil data film berdasarkan ID
    $movie = DB::table('movies')->where('id', $id)->first();

    if (!$movie) {
        return response()->json([
            'success' => false,
            'message' => 'Film tidak ditemukan.',
        ], 404);
    }

    // Kirim data film sebagai respons
    return response()->json($movie, 200);
}


    


}