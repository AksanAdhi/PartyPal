<?php
session_start();
include("koneksi.php");

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = ?");
    $stmt->bind_param("ss", $email, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($pass, $row['password'])) {
            $_SESSION['user'] = $row;

            if ($role == 'penyewa') {
                header("Location: home.html");
            } elseif ($role == 'penyedia') {
                header("Location: index.html");
            } else {
                header("Location: login.html?error=not_found");
            }
            exit;
        } else {
            header("Location: login.html?error=not_found");
            exit;
        }
    } else {
        header("Location: login.html?error=not_found");
        exit;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: login.html");
    exit;
}
?>
