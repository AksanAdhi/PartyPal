<?php
session_start();
include("koneksi.php");

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];


    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ? AND role = ?");
    $stmt->bind_param("sss", $email, $pass, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user'] = $row;

        if ($role == 'penyewa') {
            header("Location: home.html");
        } elseif ($role == 'penyedia') {
            header("Location: index.html");
        } else {
            header("Location: login.php");
        }
    } else {
        echo "<script>alert('Email or password incorrect');</script>";
        header("Location: login.php");
    }

    $stmt->close();
    $conn->close();
}
?>
