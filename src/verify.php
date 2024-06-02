<?php
include 'db.php';

$id = $_GET['id'];
$sql = "UPDATE items SET verified = 1 WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header('Location: admin.php');
} else {
    echo "Error updating record: " . $conn->error;
}
?>
