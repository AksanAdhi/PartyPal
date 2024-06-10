<?php
include 'koneksi.php';

$nama_barang = $_POST['nama_barang'];
$harga_jual = $_POST['harga_jual'];
$kategori = $_POST['kategori'];
$stok = $_POST['stok'];
$deskripsi = $_POST['deskripsi'];

$store_name = "kuyRent";
$image_url = "image.jpg";
$provider_id = 1;
$address = "Address";

ob_start();

$conn->begin_transaction();

try {
    $sql_items = "INSERT INTO items (name, price, category, stock, description, image_url, provider_id, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_items = $conn->prepare($sql_items);
    if (!$stmt_items) {
        throw new Exception("Error preparing items statement: " . $conn->error);
    }
    $stmt_items->bind_param("sdisssis", $nama_barang, $harga_jual, $kategori, $stok, $deskripsi, $image_url, $provider_id, $address);

    if (!$stmt_items->execute()) {
        throw new Exception("Error inserting into items table: " . $stmt_items->error);
    }

    $sql_verification = "INSERT INTO verification_request (item_name, store_name, price, image_url, provider_id, address) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_verification = $conn->prepare($sql_verification);
    if (!$stmt_verification) {
        throw new Exception("Error preparing verification request statement: " . $conn->error);
    }
    $stmt_verification->bind_param("ssdssi", $nama_barang, $store_name, $harga_jual, $image_url, $provider_id, $address);

    if (!$stmt_verification->execute()) {
        throw new Exception("Error inserting into verification_request table: " . $stmt_verification->error);
    }

    $conn->commit();

    header("Location: tambahbarang.php");
    exit();
} catch (Exception $e) {
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

$stmt_items->close();
$stmt_verification->close();
$conn->close();
ob_end_flush();
?>
