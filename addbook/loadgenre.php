<?php
// Ambil data genre dari database
include("../database/dbconn.php");

$query = "SELECT id, nama_genre FROM genres";
$result = $conn->query($query);

$genres = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $genres[] = $row;
    }
}
$conn->close();
?>