<?php 

include("../helper/path.php");
include("../database/dbconn.php");

// Cek apakah form sudah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $title = $conn->real_escape_string($_POST["title"]);
    $author = $conn->real_escape_string($_POST["author"]);
    $status = $conn->real_escape_string($_POST["status"]);
    $synopsis = $conn->real_escape_string($_POST["synopsis"]);
    $start_date = $conn->real_escape_string($_POST["start_date"]);

    // Ambil genre sebagai array
    $genres = $_POST["genre"] ?? []; // Jika genre kosong, tetap aman

    if (!empty($title) && !empty($author) && !empty($status) && !empty($start_date) && !empty($genres)) {
        // Query untuk menyimpan data buku ke tabel "books"
        $sql = "INSERT INTO books (judul, penulis, status, sinopsis, tgl_mulai_baca) 
                VALUES ('$title', '$author', '$status', '$synopsis', '$start_date')";

        if ($conn->query($sql) === TRUE) {
            // Ambil ID buku yang baru saja disimpan
            $book_id = $conn->insert_id;

            // Simpan genre ke tabel relasi "books_genres"
            foreach ($genres as $genre_id) {
                $genre_id = $conn->real_escape_string($genre_id); // Sanitasi ID genre
                $sql_genre = "INSERT INTO books_genres (book_id, genre_id) VALUES ('$book_id', '$genre_id')";
                $conn->query($sql_genre);
            }

            // Redirect ke addbook.php dengan parameter success
            header("Location: addbook.php?success=1");
            exit;
        } else {
            // Redirect ke addbook.php dengan parameter error jika gagal menyimpan buku
            header("Location: addbook.php?error=1");
            exit;
        }
    } else {
        // Redirect ke addbook.php dengan parameter error jika input tidak lengkap
        header("Location: addbook.php?error=1");
        exit;
    }
}

// Tutup koneksi
$conn->close();
?>
