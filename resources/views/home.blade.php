<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    

    <style>
        /* Body Style */
        body {
            background-color: #3a3a3a;
            color: white;
            font-family: Arial, sans-serif;
            padding-top: 70px; /* To avoid navbar overlap */
        }

        /* Navbar Style */
        .navbar {
            background-color: #1e1e1e; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add shadow for depth */
        }

        .navbar-brand {
            font-weight: bold;
            color: #f8f9fa !important;
        }
        .navbar-nav .nav-link {
            color: #f8f9fa !important;
        }
        .navbar-nav .dropdown-menu {
            background-color: #2c2c2c;
            border: none;
        }
        .navbar-nav .dropdown-menu .dropdown-item {
            color: #fff;
        }
        .navbar-nav .dropdown-menu .dropdown-item:hover {
            background-color: #444;
        }
        #profilePhoto {
            margin-right: 10px;
            width: 35px;
            height: 35px;
            object-fit: cover;
        }
        #userName {
            font-size: 0.9rem;
            color: #f8f9fa;
        }
        .movie-poster img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .ticket {
            background-color: #fff;
            color: #000;
            border-radius: 20px;
            padding: 10px 20px;
            font-weight: bold;
            white-space: nowrap;
            cursor: pointer;
            margin-right: 10px; /* Add spacing between tickets */
        }
        .ticket.red { background-color: #f44336; color: white; }
        .ticket.blue { background-color: #2196f3; color: white; }
        .ticket.green { background-color: #4caf50; color: white; }
        .ticket:hover {
            transform: scale(1.05);
            transition: all 0.3s ease-in-out;
        }
        .section-title {
            margin: 20px 0;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .movie-list {
            margin-right: 15px;
        }
        .movie-list img {
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
            width: 200px; /* Lebar seragam */
            height: 300px; /* Tinggi seragam */
            object-fit: contain; /* Menampilkan seluruh gambar tanpa cropping */
            background-color: #000; 
        }

        .movie-list img:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        .overflow-auto {
            display: flex;
            overflow-x: auto;
            gap: 15px;
            padding-bottom: 15px;
        }
        .overflow-auto::-webkit-scrollbar {
            display: none;
        }
        .overflow-auto {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;    /* Firefox */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">Movie Channel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown d-flex align-items-center">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img id="profilePhoto" class="rounded-circle" onerror="showDefaultIcon()">
                            <span id="userName" class="text-light"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bi bi-person"></i> Profil</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-decoration-none text-light p-0">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="movie-poster">
            <img src="{{ asset('sampul.jpg') }}" alt="Movie Poster">
        </div>

        <div class="d-flex justify-content-start overflow-auto mb-4">
            <div class="ticket blue">Premier League</div>
            <div class="ticket red">PLN Mobile Proliga</div>
            <div class="ticket green">New & Trending</div>
            <div class="ticket blue">Sinetron</div>
            <div class="ticket green">FTV</div>
            <div class="ticket red">Hollywood</div>
            <div class="ticket green">Indonesia</div>
            <div class="ticket blue">Korea</div>
            <div class="ticket red">Anime</div>
            <div class="ticket green">Asian</div>
            <div class="ticket blue">Kids</div>
        </div>

        <h2 class="section-title">Daftar Film Terbaru</h2>
        <div id="latestMovies" class="d-flex justify-content-start overflow-auto">

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function loadUserProfile() {
            fetch("{{ route('user.profile') }}")
                .then(response => response.json())
                .then(data => {
                    document.getElementById('userName').textContent = data.name;
                    document.getElementById('profilePhoto').src = data.profile_photo;
                })
                .catch(error => console.error('Error:', error));
        }
        function showDefaultIcon() {
            const profilePhoto = document.getElementById('profilePhoto');
            profilePhoto.outerHTML = '<i class="bi bi-person-circle text-light" style="font-size: 35px;"></i>';
        }
        document.addEventListener('DOMContentLoaded', loadUserProfile);
        function loadLatestMovies() {
    fetch("{{ route('movies.latest') }}")
        .then(response => response.json())
        .then(movies => {
            const container = document.getElementById('latestMovies');
            container.innerHTML = ''; // Bersihkan konten sebelumnya

            movies.forEach(movie => {
                const movieItem = `
                   <div class="movie-list" data-id="${movie.id}">
                        <img src="/storage/${movie.cover}" alt="${movie.name}" onclick="toggleFavorite(${movie.id})">
                    </div>
                `;
                container.innerHTML += movieItem;
            });
        })
        .catch(error => console.error('Error loading movies:', error));
}

// Panggil fungsi saat halaman dimuat
document.addEventListener('DOMContentLoaded', loadLatestMovies);
function toggleFavorite(movieId) {
    const url = `/movies/${movieId}/favorite`;

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false,
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message,
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: 'Tidak dapat memproses permintaan.',
            });
        });
}


    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
