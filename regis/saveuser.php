<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validasi input
    if (!empty($name) && !empty($email) && !empty($password)) {
        // Hash password untuk keamanan
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Query untuk menyimpan data pengguna
        $query = "INSERT INTO users (nama, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if ($stmt->execute()) {
            // Redirect ke main.php setelah berhasil mendaftar
            header("Location: ../main/main.php");
            exit;
        } else {
            $error = "Gagal menyimpan data ke database. Silakan coba lagi.";
        }

        // Tutup statement
        $stmt->close();
    } else {
        $error = "Semua field harus diisi!";
    }

    // Tutup koneksi database
    // $conn->close();
}
?>