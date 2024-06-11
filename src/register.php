<?php
session_start();
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $daftar_sebagai = $_POST['daftar_sebagai'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Insert into users table
        $stmt = $conn->prepare("INSERT INTO users (role, email, username, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $daftar_sebagai, $email, $username, $hashed_password);
        
        if (!$stmt->execute()) {
            throw new Exception($stmt->error);
        }

        // Get the inserted user_id
        $user_id = $stmt->insert_id;

        // Insert into user_verification table
        $stmt = $conn->prepare("INSERT INTO user_verification (user_id, request_date, status) VALUES (?, NOW(), 'pending')");
        $stmt->bind_param("i", $user_id);
        
        if (!$stmt->execute()) {
            throw new Exception($stmt->error);
        }

        // Commit transaction
        $conn->commit();

        // Redirect to login page
        header("Location: login.html");
        exit();
    } catch (Exception $e) {
        // Rollback transaction
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    $stmt->close();
}

$conn->close();
?>
