<?php
session_start();
include 'koneksi.php'; // Sesuaikan dengan konfigurasi database Anda

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $daftarSebagai = $_POST['daftar_sebagai'];

    // Cek apakah email sudah terdaftar
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email sudah terdaftar, arahkan kembali ke register.html dengan pesan kesalahan
        $_SESSION['error_message'] = "Akun sudah terdaftar!";
        header("Location: register.html?error=1");
        exit();
    } else {
        // Lanjutkan dengan proses registrasi
        $stmt = $conn->prepare("INSERT INTO users (email, username, password, role) VALUES (?, ?, ?, ?)");
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ssss", $email, $username, $hashed_password, $daftarSebagai);

        if ($stmt->execute()) {
            header("Location: success.html"); // Arahkan ke halaman sukses atau login
            exit();
        } else {
            echo "Terjadi kesalahan: " . $stmt->error;
        }
    }
    $stmt->close();
    $conn->close();
}
?>
