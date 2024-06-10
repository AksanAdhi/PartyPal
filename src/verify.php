<?php
include 'koneksi.php';

$input = json_decode(file_get_contents('php://input'), true);
$verification_id = $input['id'];
$status = $input['status'];

$sql = "UPDATE verification_request SET status = ? WHERE request_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('si', $status, $verification_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$stmt->close();
$conn->close();
?>
