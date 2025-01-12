<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #2c2c2c;
            color: white;
        }

        .btn-custom {
            border-radius: 50px;
            width: 40px;
            height: 40px;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-info img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            object-fit: cover;
            border: 2px solid white;
        }

        /* Perbaikan tampilan modal */
        .modal-content {
            background-color: #3a3a3a;
            color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        .form-control {
            background-color: #555;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
        }

        .form-control::placeholder {
            color: #aaa;
        }

        .form-control:focus {
            outline: none;
            box-shadow: 0 0 5px #ff0000;
        }

        .btn {
            border-radius: 5px;
        }

        .btn-danger {
            background-color: #ff0000;
            color: white;
        }

        .btn-danger:hover {
            background-color: #cc0000;
        }

        .btn-secondary {
            background-color: #444;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <button class="btn btn-danger px-4" data-bs-toggle="modal" data-bs-target="#addFilmModal">Tambah</button>
        <div class="d-flex align-items-center">
            <input type="text" class="form-control me-2" placeholder="Cari...">
            <button class="btn btn-danger">Cari</button>
        </div>
        <div class="admin-info">
            <img id="adminAvatar" src="" alt="Avatar">
            <span id="adminName"></span>
        </div>
    </div>

    <table class="table table-dark table-hover">
        <thead>
        <tr>
            <th>Nama Film</th>
            <th>Cover</th>
            <th>Tahun Rilis</th>
            <th>Sutradara</th>
            <th>Studio</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="addFilmModal" tabindex="-1" aria-labelledby="addFilmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFilmModalLabel">Tambah Film</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addFilmForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="filmName" class="form-label">Nama Film</label>
                        <input type="text" class="form-control" id="filmName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="filmCover" class="form-label">Cover</label>
                        <input type="file" class="form-control" id="filmCover" name="cover" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="releaseYear" class="form-label">Tahun Rilis</label>
                        <input type="number" class="form-control" id="releaseYear" name="release_year" required>
                    </div>
                    <div class="mb-3">
                        <label for="director" class="form-label">Sutradara</label>
                        <input type="text" class="form-control" id="director" name="director" required>
                    </div>
                    <div class="mb-3">
                        <label for="studio" class="form-label">Studio</label>
                        <input type="text" class="form-control" id="studio" name="studio" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit -->
<!-- Modal Edit -->
<div class="modal fade" id="editFilmModal" tabindex="-1" aria-labelledby="editFilmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFilmModalLabel">Edit Film</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editFilmForm" enctype="multipart/form-data">
                <input type="hidden" id="editFilmId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editFilmName" class="form-label">Nama Film</label>
                        <input type="text" class="form-control" id="editFilmName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editFilmCover" class="form-label">Cover</label>
                        <input type="file" class="form-control" id="editFilmCover" name="cover" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="editReleaseYear" class="form-label">Tahun Rilis</label>
                        <input type="number" class="form-control" id="editReleaseYear" name="release_year" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDirector" class="form-label">Sutradara</label>
                        <input type="text" class="form-control" id="editDirector" name="director" required>
                    </div>
                    <div class="mb-3">
                        <label for="editStudio" class="form-label">Studio</label>
                        <input type="text" class="form-control" id="editStudio" name="studio" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    fetch("{{ route('admin.data') }}")
        .then(response => response.json())
        .then(data => {
            if (data.profile_photo) {
                document.getElementById('adminAvatar').src = data.profile_photo;
            } else {
                document.getElementById('adminAvatar').src = "{{ asset('uploads/profile_photos/default-avatar.jpg') }}";
            }

            document.getElementById('adminName').textContent = `Admin - ${data.name}`;
        })
        .catch(error => console.error('Error fetching admin data:', error));


       // Tambahkan data film baru ke tabel
document.getElementById('addFilmForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("{{ route('admin.movies.store') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
        },
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Film berhasil ditambahkan.',
                    showConfirmButton: false,
                    timer: 2000,
                });

                // Tambahkan data film baru ke tabel
                const tbody = document.querySelector('table tbody');
                const row = `
                    <tr>
                        <td>${data.movie.name}</td>
                        <td><img src="${data.movie.cover}" alt="${data.movie.name}" width="50"></td>
                        <td>${data.movie.release_year}</td>
                        <td>${data.movie.director}</td>
                        <td>${data.movie.studio}</td>
                        <td>
                            <button class="btn btn-warning btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;

                // Reset form dan tutup modal
                document.getElementById('addFilmForm').reset();
                const modal = bootstrap.Modal.getInstance(document.getElementById('addFilmModal'));
                modal.hide();
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
                title: 'Error',
                text: 'Terjadi kesalahan saat menyimpan data.',
            });
        });
});

// Load semua film saat halaman dimuat
document.addEventListener('DOMContentLoaded', function () {
    fetch("{{ route('admin.movies.index') }}")
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('table tbody');
            tbody.innerHTML = ''; // Kosongkan isi tabel

            data.forEach(movie => {
                const row = `
                    <tr>
                        <td>${movie.name}</td>
                        <td><img src="${movie.cover}" alt="${movie.name}" width="50"></td>
                        <td>${movie.release_year}</td>
                        <td>${movie.director}</td>
                        <td>${movie.studio}</td>
                        <td>
                            <button class="btn btn-warning btn-sm btn-edit" data-id="${movie.id}">Edit</button>
                            <button class="btn btn-danger btn-sm btn-delete" data-id="${movie.id}">Hapus</button>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });

        })
        .catch(error => console.error('Error fetching movies:', error));
});



document.addEventListener('click', function (e) {
    if (e.target.classList.contains('btn-edit')) {
        const id = e.target.getAttribute('data-id'); // Ambil ID dari tombol
        fetch(`{{ url('/admin/movies') }}/${id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Film tidak ditemukan.');
                }
                return response.json();
            })
            .then(data => {
                // Isi modal edit dengan data film
                document.getElementById('editFilmId').value = id;
                document.getElementById('editFilmName').value = data.name;
                document.getElementById('editReleaseYear').value = data.release_year;
                document.getElementById('editDirector').value = data.director;
                document.getElementById('editStudio').value = data.studio;

                // Reset file input untuk cover
                document.getElementById('editFilmCover').value = null;

                // Tampilkan modal edit
                const editModal = new bootstrap.Modal(document.getElementById('editFilmModal'));
                editModal.show();
            })
            .catch(error => {
                console.error('Error fetching movie data:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal mengambil data film.',
                });
            });
    }
});


// Event listener untuk tombol delete
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('btn-delete')) {
        const id = e.target.getAttribute('data-id'); // Ambil ID dari tombol

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data tidak dapat dikembalikan setelah dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`{{ url('/admin/movies') }}/${id}/delete`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus!',
                                text: 'Film berhasil dihapus.',
                                showConfirmButton: false,
                                timer: 2000,
                            });
                            location.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: data.message,
                            });
                        }
                    });
            }
        });
    }
});

document.getElementById('editFilmForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const id = document.getElementById('editFilmId').value;
    const formData = new FormData(this);

    fetch(`{{ url('/admin/movies') }}/${id}/edit`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Film berhasil diperbarui.',
                    showConfirmButton: false,
                    timer: 2000,
                });
                location.reload();
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
                title: 'Error',
                text: 'Terjadi kesalahan saat memperbarui data.',
            });
        });
});




</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
