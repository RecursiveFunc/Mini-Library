<?php
include("../helper/path.php");
include("../database/dbconn.php");

if (isset($_GET['query'])) {
    $query = "%" . $conn->real_escape_string($_GET['query']) . "%";

    $sql = "
        SELECT 
            b.id, 
            b.judul AS title, 
            b.penulis AS author, 
            GROUP_CONCAT(g.nama_genre SEPARATOR ', ') AS genres
        FROM 
            books AS b
        LEFT JOIN 
            books_genres AS bg ON b.id = bg.book_id
        LEFT JOIN 
            genres AS g ON bg.genre_id = g.id
        WHERE 
            b.judul LIKE ? OR b.penulis LIKE ?
        GROUP BY 
            b.id
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $query, $query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $books = [];
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($books);
    exit;
}
?>
