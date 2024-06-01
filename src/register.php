<?php
// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "partypal";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $daftar_sebagai = $_POST['daftar_sebagai'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        die("Password and Confirm Password do not match.");
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (daftar_sebagai, email, username, password) VALUES (?, ?, ?, ?)");
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
