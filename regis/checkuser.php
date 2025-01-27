<?php
session_start(); // Mulai session
include("../database/dbconn.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validasi input tidak kosong
    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['id']; // Ambil ID pengguna
            $hashed_password = $row['password'];

            // Verifikasi password yang diinput dengan hash yang tersimpan
            if (password_verify($password, $hashed_password)) {
                // Login berhasil, buat session untuk pengguna
                $_SESSION['user_id'] = $user_id; // Simpan ID pengguna ke session
                $_SESSION['email'] = $email; // Simpan email ke session (opsional)

                // Redirect ke halaman utama
                header("Location: ../main/main.php");
                exit;
            } else {
                // Password tidak sesuai
                header("Location: login.php?status=error");
                exit;
            }
        } else {
            // Email tidak ditemukan
            header("Location: login.php?status=error");
            exit;
        }
        $stmt->close();
    } else {
        // Input kosong
        header("Location: login.php?status=empty");
        exit;
    }
}
$conn->close();
?>
