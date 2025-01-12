<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #3a3a3a;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-container {
            background-color: #d6d6d6;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 400px;
        }

        .form-control {
            background-color: #5b4f4f;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
        }

        .form-control::placeholder {
            color: #ccc;
        }

        .btn-register {
            background-color: #ff0000;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
        }

        .btn-register:hover {
            background-color: #cc0000;
        }

        .login-link {
            text-align: center;
            margin-top: 10px;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <form id="registerForm">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Nama" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
            </div>
            <button type="submit" class="btn btn-register w-100">Register</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#registerForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('register.post') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registrasi Berhasil',
                            text: 'Anda akan diarahkan ke halaman login.',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = "{{ route('login') }}";
                        });
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';

                        for (let key in errors) {
                            errorMessage += errors[key][0] + '<br>';
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Registrasi Gagal',
                            html: errorMessage
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
