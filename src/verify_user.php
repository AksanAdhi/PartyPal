<?php
include 'koneksi.php'; // Ensure this file contains the proper database connection code

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id']) && isset($data['status'])) {
    $verificationId = intval($data['id']);
    $status = $conn->real_escape_string($data['status']);

    // Ensure status is one of the allowed values
    $allowedStatuses = ['pending', 'approved', 'rejected'];
    if (!in_array($status, $allowedStatuses)) {
        echo json_encode(['success' => false, 'message' => 'Invalid status']);
        exit;
    }

    $sql = "UPDATE user_verification SET status = '$status' WHERE verification_id = $verificationId";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update status']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

$conn->close();
?>
