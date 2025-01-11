<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* CSS Anda tetap utuh */
        body {
            background-color: #2c2c2c;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #333;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .back-button:hover {
            background-color: #555;
        }

        .back-button i {
            font-size: 18px;
        }

        .header {
            background: url('/images/banner.jpg') no-repeat center center;
            height: 200px;
            background-size: cover;
        }

        .profile-section {
            display: flex;
            align-items: center;
            padding: 10px;
            background-image: url("{{ asset('gambar') }}/bg.png");
            background-size: cover;
            background-position: center;
            height: 300px;
        }

        .profile-icon {
            width: 80px;
            height: 80px;
            background: gray;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .update-button {
            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            width: 150px;
            height: 40px;
        }

        .update-button:hover {
            background-color: #cc0000;
        }

        .stats {
            padding: 20px;
        }

        .items {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .item {
            background: #444;
            padding: 10px;
            border-radius: 10px;
            width: 150px;
            text-align: center;
        }

        .item img {
            width: 100%;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    
    <!-- Tombol Back -->
    <a href="{{ url('/home') }}" class="back-button">
        <i class="fas fa-arrow-left"></i>
    </a>

    <!-- Header -->
    <div class="header"></div>

    <!-- Profile Section -->
<div class="profile-section">
    <div class="profile-icon">
        <span style="font-size: 30px;">😎</span>
    </div>
    <div style="margin-left: 20px;">
        <h3>{{ $profile['username'] }}</h3>
        <button class="update-button">Perbarui Profil</button>
    </div>
</div>

<!-- Stats -->
<div class="stats">
    <p>
        <strong>{{ $profile['wishlist'] ?? 0 }}</strong> Wishlist &nbsp;&nbsp;
        <strong>{{ $profile['favorites'] ?? 0 }}</strong> Favorit
    </p>
    
    <!-- Items -->
    <div class="items">
        @if($profile['items'] && $profile['items']->isNotEmpty())
            @foreach ($profile['items'] as $item)
                <div class="item">
                    <img src="{{ asset('gambar/' . $item['image']) }}" alt="{{ $item['title'] ?? 'Untitled' }}">
                    <p>{{ $item['title'] ?? 'Untitled' }}</p>
                </div>
            @endforeach
        @else
            <p>Tidak ada item untuk ditampilkan.</p>
        @endif
    </div>
</div>   
</body>
</html>
