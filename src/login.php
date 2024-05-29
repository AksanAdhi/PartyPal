<?php
session_start();
include("koneksi.php");

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $pass = $_POST["pass"];

    // Perhatikan bahwa query ini rentan terhadap SQL Injection. Sebaiknya gunakan prepared statements.
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin'] = $row;
        header("Location: index.html");
    } else {
        echo "<script>alert('password salah');</script>";   
        header("Location: login.html");
   
    }
}
?>
