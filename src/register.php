<?php
session_start();
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $daftar_sebagai = $_POST['daftar_sebagai'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (role, email, username, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $daftar_sebagai, $email, $username, $hashed_password);

    if ($stmt->execute()) {
        header("Location: home.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
