<?php 
session_start(); // Mulai session

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../regis/login.php"); // Redirect ke halaman login jika belum login
    exit;
}

include("read.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mini Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="main-style.css"> <!-- Link ke file CSS eksternal -->

    <style>
        /* Style untuk header */
        .navbar {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Logo di header */
        .navbar-brand img {
            margin-right: 10px;
        }

        /* Warna aktif pada menu */
        .nav-link.active {
            color: #007bff !important;
            font-weight: bold;
        }

        /* Form pencarian */
        form.d-flex input[type="search"] {
            border-radius: 20px;
            border: 1px solid #ced4da;
        }

        /* Tombol pencarian */
        form.d-flex .btn-outline-success {
            border-radius: 20px;
        }

        /* Konten utama */
        .container h1 {
            font-size: 2.5rem;
            color: #333;
        }

        .container p {
            font-size: 1.2rem;
            color: #555;
        }

        /* Tombol dark mode */
        #darkModeToggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 1000;
        }

        /* Dark mode styles */
        body.dark-mode {
            background-color: #121212;
            color: #ffffff;
        }

        .dark-mode .card {
            background-color: #1f1f1f;
            color: white;
        }

        .dark-mode .navbar {
            background-color: #1f1f1f;
            color: white;
        }

        .dark-mode .container h1,
        .dark-mode .container p {
            color: #ffffff;
        }
    </style>

</head>
<body>
<main>
    <?php include("header.php") ?>

    <!-- Konten Utama -->
    <div class="container mt-5">
        <h1 class="text-center">Dashboard Mini Library</h1>
        <p class="text-center">Kelola koleksi buku Anda dengan mudah.</p>

        <!-- Statistik -->
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Buku</h5>
                        <p class="card-text fs-3"><?php echo $totalBooks; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Buku Selesai Dibaca</h5>
                        <p class="card-text fs-3"><?php echo $statusCounts['Selesai Dibaca'] ?? 0; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Buku Sedang Dibaca</h5>
                        <p class="card-text fs-3"><?php echo $statusCounts['Sedang Dibaca'] ?? 0; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Buku Ingin Dibaca</h5>
                        <p class="card-text fs-3"><?php echo $statusCounts['Ingin Dibaca'] ?? 0; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Tombol Toggle Dark Mode -->
<button id="darkModeToggle">&#9788;</button>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<script>
    const toggleButton = document.getElementById('darkModeToggle');
    const body = document.body;

    // Load mode from localStorage
    if (localStorage.getItem('dark-mode') === 'enabled') {
        body.classList.add('dark-mode');
    }

    toggleButton.addEventListener('click', () => {
        body.classList.toggle('dark-mode');

        // Save mode to localStorage
        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('dark-mode', 'enabled');
        } else {
            localStorage.removeItem('dark-mode');
        }
    });
</script>

</body>
</html>