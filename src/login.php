<?php
session_start();
include("koneksi.php");

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ? AND role = ?");
    $stmt->bind_param("sss", $email, $pass, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user'] = $row;

        if ($role == 'penyewa') {
            header("Location: penyewa_dashboard.php");
        } elseif ($role == 'penyedia') {
            header("Location: penyedia_dashboard.php");
        } else {
            header("Location: login.php");
        }
    } else {
        header("Location: login.html?error=not_found");
    }


    $stmt->close();
    $conn->close();
}
?>
