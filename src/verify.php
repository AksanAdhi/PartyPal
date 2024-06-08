<?php
include("koneksi.php");

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id']) && isset($data['status'])) {
    $id = $data['id'];
    $status = $data['status'];

    // Determine the verification status
    $verified = ($status === 'approve') ? 1 : 0;

    // Update the database
    $stmt = $conn->prepare("UPDATE items SET verified = ? WHERE id = ?");
    $stmt->bind_param("ii", $verified, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false]);
}
?>

