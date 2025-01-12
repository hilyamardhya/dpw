<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #2c2c2c;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background: url("{{ asset('gambar') }}/bg.png") no-repeat center center;
            height: 200px;
            background-size: cover;
        }

        .profile-section {
            text-align: center;
            margin-top: -50px;
        }

        .profile-icon {
            width: 100px;
            height: 100px;
            background: gray;
            border-radius: 50%;
            display: inline-block;
            overflow: hidden;
            border: 5px solid #444;
        }

        .profile-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .form-container {
            max-width: 500px;
            margin: 20px auto;
            background-color: #3c3c3c;
            padding: 20px;
            border-radius: 10px;
        }

        .form-label {
            color: #ccc;
        }

        .form-control {
            background-color: #555;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 15px;
        }

        .form-control:focus {
            outline: none;
            box-shadow: 0 0 5px #777;
        }

        .btn {
            width: 100%;
            background-color: #444;
            color: white;
            padding: 10px 15px;
            border-radius: 20px;
            border: none;
        }

        .btn:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="header"></div>

    <div class="profile-section">
        <div class="profile-icon" id="profileIcon">
            <img src="{{ $user->profile_photo ? asset('uploads/profile_photos/' . $user->profile_photo) : '' }}" 
                 alt="Profile Photo" 
                 onerror="showDefaultIcon()">
        </div>
    </div>

    <div class="form-container">
        @if (session('success'))
            <div class="alert alert-success" id="successMessage">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Pengguna</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Pengguna</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">Umur Pengguna</label>
                <input type="number" name="age" id="age" class="form-control" value="{{ $user->age }}" required>
            </div>

            <div class="mb-3">
                <label for="profile_photo" class="form-label">Ganti Foto Profil</label>
                <input type="file" name="profile_photo" id="profile_photo" class="form-control">
            </div>

            <button type="submit" class="btn">Simpan Perubahan</button>
        </form>
    </div>

    <script>
        function showDefaultIcon() {
            const profileIcon = document.getElementById('profileIcon');
            profileIcon.innerHTML = '<i class="bi bi-person-circle text-light" style="font-size: 50px;"></i>';
        }

        // Auto-refresh setelah pesan sukses muncul
        const successMessage = document.getElementById('successMessage');
        if (successMessage) {
            setTimeout(() => {
                window.location.reload();
            }, 2000); 
        }
    </script>
</body>
</html>
