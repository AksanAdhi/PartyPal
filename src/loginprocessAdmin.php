<?php
session_start();
require 'configAdmin.php'; // File configuration untuk koneksi database

// Ambil data dari form
$email = $_POST['email'];
$password = $_POST['pass'];

// Koneksi ke database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk memeriksa pengguna
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Cek password
    if ($user['password'] === $password) { // Ini harusnya menggunakan hash dan verify password
        $_SESSION['email'] = $user['email'];
        header("Location: admin.php");
        exit();
    } else {
        // Password tidak cocok
        header("Location: loginAdmin.html");
        exit();
    }
} else {
    // Email tidak ditemukan
    header("Location: loginAdmin.html");
    exit();
}

$stmt->close();
$conn->close();
?>
