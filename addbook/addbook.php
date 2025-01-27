<?php 
session_start(); // Mulai session

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../regis/login.php"); // Redirect ke halaman login jika belum login
    exit;
}

include("../helper/path.php");
include("loadgenre.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku - Mini Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="addbook-style.css"> <!-- Link ke file CSS eksternal -->
</head>
<body>
<main>
    <?php include("addbook-header.php") ?>

    <!-- Konten Utama -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tambah Buku</h1>
        <form action="<?php echo BASE_URL . 'addbook/savebook.php'; ?>" method="POST" class="p-4 border rounded bg-light">
            <!-- Judul -->
            <div class="mb-3">
                <label for="title" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Masukkan judul buku" required>
            </div>

            <!-- Penulis -->
            <div class="mb-3">
                <label for="author" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="author" name="author" placeholder="Masukkan nama penulis" required>
            </div>

            <!-- Status Bacaan -->
            <div class="mb-3">
                <label for="status" class="form-label">Status Bacaan</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="" disabled selected>Pilih status bacaan</option>
                    <option value="Ingin Dibaca">Ingin Dibaca</option>
                    <option value="Sedang Dibaca">Sedang Dibaca</option>
                </select>
            </div>

            <!-- Genre -->
            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <div id="genre">
                    <?php foreach ($genres as $genre): ?>
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                id="genre-<?php echo $genre['id']; ?>" 
                                name="genre[]" 
                                value="<?php echo $genre['id']; ?>"
                            >
                            <label class="form-check-label" for="genre-<?php echo $genre['id']; ?>">
                                <?php echo htmlspecialchars($genre['nama_genre']); ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Sinopsis -->
            <div class="mb-3">
                <label for="synopsis" class="form-label">Sinopsis</label>
                <textarea class="form-control" id="synopsis" name="synopsis" rows="4" placeholder="Masukkan sinopsis buku" required></textarea>
            </div>

            <!-- Tanggal Mulai Dibaca -->
            <div class="mb-3">
                <label for="start_date" class="form-label">Tanggal Mulai Dibaca</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary w-100">Simpan Buku</button>
        </form>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<?php if (isset($_GET['success'])): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
    title: "Berhasil!",
    text: "Buku berhasil ditambahkan ke koleksi.",
    icon: "success",
    confirmButtonText: "OK"
});
</script>
<?php elseif (isset($_GET['error'])): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
    title: "Gagal!",
    text: "Terjadi kesalahan saat menyimpan data.",
    icon: "error",
    confirmButtonText: "Coba Lagi"
});
</script>
<?php endif; ?>


</body>
</html>
