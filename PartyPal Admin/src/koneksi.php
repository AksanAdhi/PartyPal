<?php
$servername = "localhost";
$username = "username";
$password = "password";
$mydb = "admin";

// Buat koneksi
$conn = mysqli_connect($servername, $username, $password, $mydb);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
