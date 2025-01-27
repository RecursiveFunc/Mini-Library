<?php 
session_start(); // Mulai session

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../regis/login.php"); // Redirect ke halaman login jika belum login
    exit;
}

include("savedbook.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Buku - Mini Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="mybook-style.css"> <!-- Link ke CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <main>
        <?php include("mybook-header.php"); ?>

        <div class="container mt-5">
            <h1 class="text-center">Koleksi Buku Saya</h1>

            <!-- Tampilkan Daftar Buku -->
            <?php
        $books = getBooks($conn); // Panggil fungsi getBooks
        if ($books === false) {
            echo "<p>Error pada query SQL: " . $conn->error . "</p>";
            }

        if ($books && $books->num_rows > 0): // Pastikan $books bukan false dan memiliki data
        ?>
        <div class="accordion" id="bookAccordion">
            <?php while ($book = $books->fetch_assoc()): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?= $book['book_id']; ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $book['book_id']; ?>" aria-expanded="false" aria-controls="collapse<?= $book['book_id']; ?>">
                            <?= htmlspecialchars($book['title']); ?>
                        </button>
                    </h2>
                    <div id="collapse<?= $book['book_id']; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $book['book_id']; ?>" data-bs-parent="#bookAccordion">
                        <div class="accordion-body">
                            <p><strong>Penulis:</strong> <?= htmlspecialchars($book['author']); ?></p>
                            <p><strong>Status:</strong> <?= htmlspecialchars($book['status']); ?></p>
                            <p><strong>Genre:</strong> <?= htmlspecialchars($book['genres']); ?></p>
                            <p><strong>Sinopsis:</strong> <?= htmlspecialchars($book['sinopsis']); ?></p>
                            <p><strong>Tanggal Mulai Dibaca:</strong> <?= htmlspecialchars($book['start_date']); ?></p>
                            
                            <?php if ($book['status'] == "Selesai Dibaca"): ?>
                                <p><strong>Tanggal Selesai Dibaca:</strong> <?= htmlspecialchars($book['finish_date'] ?? 'Belum Ditentukan'); ?></p>
                            <?php else: ?>
                                <form method="POST" action="savedbook.php">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($book['book_id']); ?>">
                                    <input type="hidden" name="new_status" value="Selesai Dibaca">
                                    <label for="finish_date_<?= $book['book_id']; ?>"><strong>Tanggal Selesai:</strong></label>
                                    <input type="date" id="finish_date_<?= $book['book_id']; ?>" name="finish_date" class="form-control mb-2" required>
                                    <button type="submit" name="update_status" class="btn btn-primary">Selesai Baca</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <?php else: ?>
            <p class="text-center">Tidak ada buku dalam koleksi Anda.</p>
            <?php endif; ?>
        </div>
    </main>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Aktifkan input tanggal jika status diubah menjadi "Selesai Dibaca"
    const statusSelects = document.querySelectorAll('select[name="new_status"]');
    statusSelects.forEach(select => {
        select.addEventListener("change", function () {
            const parentForm = this.closest("form");
            const finishDateInput = parentForm.querySelector('input[name="tgl_selesai_baca"]');

            if (this.value === "Selesai Dibaca") {
                finishDateInput.disabled = false;
            } else {
                finishDateInput.disabled = true;
                finishDateInput.value = "";
            }
        });
    });
});
</script>

<script>
    function searchBooks(query) {
        const dropdown = document.getElementById('dropdownResult');
        if (query.length === 0) {
            dropdown.style.display = 'none'; // Sembunyikan dropdown jika input kosong
            dropdown.innerHTML = '';
            return;
        }

        // Kirim permintaan AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `searchbook.php?query=${encodeURIComponent(query)}`, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.length > 0) {
                    dropdown.style.display = 'block';
                    dropdown.innerHTML = response
                        .map(book => `
                            <a href="detailbook.php?id=${book.id}" class="dropdown-item">
                                <strong>${book.title}</strong><br>
                                Penulis: ${book.author} | Genre: ${book.genres}
                            </a>
                        `)
                        .join('');
                } else {
                    dropdown.innerHTML = '<p class="dropdown-item text-muted">Buku tidak ditemukan.</p>';
                }
            }
        };
        xhr.send();
    }
</script>
</body>
</html>
