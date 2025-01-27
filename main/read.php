<?php 
include("../helper/path.php");
include("../database/dbconn.php"); // File koneksi database

// Query untuk mendapatkan jumlah buku total dan per status
$totalBooksQuery = "SELECT COUNT(*) AS total_books FROM books";
$statusBooksQuery = "SELECT status, COUNT(*) AS count FROM books GROUP BY status";

// Jalankan query
$totalBooksResult = $conn->query($totalBooksQuery);
$statusBooksResult = $conn->query($statusBooksQuery);

// Dapatkan data jumlah total buku
$totalBooks = ($totalBooksResult && $totalBooksResult->num_rows > 0) ? $totalBooksResult->fetch_assoc()['total_books'] : 0;

// Dapatkan data jumlah buku berdasarkan status
$statusCounts = [];
if ($statusBooksResult && $statusBooksResult->num_rows > 0) {
    while ($row = $statusBooksResult->fetch_assoc()) {
        $statusCounts[$row['status']] = $row['count'];
    }
}

// Tutup koneksi database
// $conn->close();
?>