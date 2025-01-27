<?php
include("../helper/path.php");
include("../database/dbconn.php");

// Ambil data buku beserta genre-nya
function getBooks($conn) {
    $sql = "
        SELECT 
            b.id AS book_id, 
            b.judul AS title, 
            b.penulis AS author, 
            b.status, 
            b.sinopsis, 
            b.tgl_mulai_baca AS start_date,
            b.tgl_selesai_baca AS finish_date, 
            GROUP_CONCAT(g.nama_genre SEPARATOR ', ') AS genres
        FROM 
            books AS b
        LEFT JOIN 
            books_genres AS bg ON b.id = bg.book_id
        LEFT JOIN 
            genres AS g ON bg.genre_id = g.id
        GROUP BY 
            b.id
    ";
    
    $result = $conn->query($sql);

    if ($result === false) {
        // Jika terjadi error pada query, tampilkan pesan
        echo "Error: " . $conn->error;
        return false;
    }

    return $result; // Mengembalikan result object
}


// Update status buku
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $id = $_POST['id']; // ID buku
    $new_status = $_POST['new_status']; // Status baru (Selesai Dibaca)
    $finish_date = $_POST['finish_date'] ?? NULL; // Tanggal selesai baca

    // Validasi input tanggal selesai
    if ($finish_date) {
        $sql = "UPDATE books SET status = ?, tgl_selesai_baca = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $new_status, $finish_date, $id);

        if ($stmt->execute()) {
            // Redirect ke halaman buku dengan pesan sukses
            header("Location: book.php?success=1");
            exit;
        } else {
            // Redirect ke halaman buku dengan pesan error
            header("Location: book.php?error=1");
            exit;
        }
    } else {
        // Redirect jika tanggal selesai kosong
        header("Location: book.php?error=2");
        exit;
    }
}


?>