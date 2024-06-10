<?php
session_start();
require 'koneksi.php';

if (isset($_POST['email']) && isset($_POST['pass'])) {
    $email = $_POST['email'];
    $password = $_POST['pass'];

    $query = "SELECT * FROM admin WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;
        header('Location: pengajuanbarang.php');
        exit();
    } else {
        header('Location: loginadmin.html?login=failed');
        exit();
    }
}
?>
