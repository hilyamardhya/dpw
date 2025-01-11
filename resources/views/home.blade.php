<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #3a3a3a;
            color: white;
            font-family: Arial, sans-serif;
            padding-top: 50px; /* Added padding to avoid navbar overlap */
        }

        .movie-poster img {
            width: 43cm; /* Fixed width */
            height: 500px; /* Fixed height */
            background-size: cover; /* Agar gambar memenuhi navbar */
            background-repeat: no-repeat; /* Agar gambar tidak terulang */

        }

    
        .ticket {
            background-color: #fff;
            color: #000;
            border-radius: 50px;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            display: flex; /* Menggunakan Flexbox */
            align-items: center; /* Menyusun konten secara vertikal di tengah */
            justify-content: center; /* Menyusun konten secara horizontal di tengah */
                }

        .ticket.red {
            background-color: #f44336;
            color: white;
        }

        .ticket.blue {
            background-color: #2196f3;
            color: white;
        }

        .ticket.green {
            background-color: #4caf50;
            color: white;
        }

        .section-title {
            margin: 20px 0;
            font-size: 1.5rem;
            font-weight: bold;
            padding-right: 50px;
            
        }

        .movie-list img {
            border-radius: 10px;
            margin: 5px;
            width: 500px; /* Fixed width */
            height: 300px; /* Fixed height */
        }

        .overflow-auto {
            display: flex;
            overflow-x: auto;
            gap: 10px;
        }

        .overflow-auto::-webkit-scrollbar {
            display: none;
        }

        .overflow-auto {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        .section-title {
            padding-right: 20px;
        }
        
    </style>
</head>
<nav class="navbar bg-body-tertiary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('profile') }}">Movie Channel</a>
        <a href="{{ route('profile') }}" class="btn btn-outline-primary">
            <i class="bi bi-person-circle"></i> Profil
        </a>
    </div>
    
</nav>

<body>
    <div class="movie-poster">
        <img src="{{asset('sampul.jpg')}}" >
    </div>
    
    <div class="py-4">  
        <!-- Bagian Tiket -->
        <div class="d-flex justify-content-between overflow-auto my-2">
            <div class="ticket blue mx-2">Premier League</div>
            <div class="ticket red mx-2">PLN Monile Proliga</div>
            <div class="ticket green mx-2">New & Tranding</div>
            <div class="ticket blue mx-2">Sinetron</div>
            <div class="ticket green mx-2">FTV</div>
            <div class="ticket red mx-2">Hollywood</div>
            <div class="ticket green mx-2">Indonesia</div>
            <div class="ticket blue mx-2">Korea</div>
            <div class="ticket red mx-2">Anime</div>
            <div class="ticket green mx-2">Asian</div>
            <div class="ticket blue mx-2">Kids</div>
        </div>

        <h2 class="section-title">Daftar Film Terbaru</h2>   
        <div class="d-flex justify-content-between overflow-auto">
            <div class="movie-list mx-2" onclick="selectMovie('Squid Game', '{{asset('th2.jpg')}}')">
                <img src="{{asset('th2.jpg')}}" alt="Squid Game">
            </div>
            <div class="movie-list mx-2" onclick="selectMovie('Z Nation', '{{asset('te.jpg')}}')">
                <img src="{{asset('th1.jpg')}}" alt="Z Nation">
            </div>
            <div class="movie-list mx-2" onclick="selectMovie('Z Nation', '{{asset('th3.jpg')}}')">
                <img src="{{asset('th3.jpg')}}" alt="Z Nation">
            </div>
            <div class="movie-list mx-2" onclick="selectMovie('Seasion 1 Pride of a prince', '{{asset('th4.jpg')}}')">
                <img src="{{asset('th4.jpg')}}" alt="Seasion 1 Pride of a prince">
            </div>
            <div class="movie-list mx-2" onclick="selectMovie('Strange World', '{{asset('th5.jpg')}}')">
                <img src="{{asset('th5.jpg')}}" alt="Strange World">
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk menangani pemilihan film dan menambahkannya ke favorit
        function selectMovie(movieName, movieImage) {
            // Menyimpan nama film dan URL gambar di localStorage
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    
            // Menambahkan film ke daftar favorit
            favorites.push({ name: movieName, image: movieImage });
            localStorage.setItem('favorites', JSON.stringify(favorites));
    
            // Menampilkan pesan konfirmasi
            alert(movieName + " telah ditambahkan ke favorit!");
        }
    </script>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>