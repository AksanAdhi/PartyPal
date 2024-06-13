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
        
        // Check if the user is verified
        $user_id = $row['user_id'];
        $verification_stmt = $conn->prepare("SELECT status FROM user_verification WHERE user_id = ?");
        $verification_stmt->bind_param("i", $user_id);
        $verification_stmt->execute();
        $verification_result = $verification_stmt->get_result();

        if ($verification_result->num_rows > 0) {
            $verification_row = $verification_result->fetch_assoc();
            $verification_status = $verification_row['status'];

            if ($verification_status === 'approved') {
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
                header("Location: login.html?error=verification_pending");
                exit;
            }
        } else {
            header("Location: login.html?error=not_found");
            exit;
        }

        $verification_stmt->close();
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
