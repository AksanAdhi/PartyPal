<?php
include 'db.php';
include 'templates.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga_jual = $_POST['harga_jual'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];
    $foto = $_FILES['foto']['name'];
    $toko = $_POST['toko']; // Menambahkan input untuk toko
    $target = "uploads/" . basename($foto);

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
        $sql = "INSERT INTO items (kode_barang, nama_barang, harga_jual, kategori, stok, deskripsi, foto, toko, verified) VALUES ('$kode_barang', '$nama_barang', '$harga_jual', '$kategori', '$stok', '$deskripsi', '$foto', '$toko', 0)";

        if ($conn->query($sql) === TRUE) {
            echo "Barang berhasil ditambahkan. Menunggu verifikasi.";
            header('refresh:3;url=index.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}
?>

<h1>Tambah Barang Baru</h1>
<form method="POST" enctype="multipart/form-data">
    <label>Kode Barang:</label><input type="text" name="kode_barang" required><br>
    <label>Nama Barang:</label><input type="text" name="nama_barang" required><br>
    <label>Harga Jual:</label><input type="number" step="0.01" name="harga_jual" required><br>
    <label>Kategori:</label><input type="text" name="kategori" required><br>
    <label>Stok:</label><input type="number" name="stok" required><br>
    <label>Toko:</label><input type="text" name="toko" required><br> <!-- Menambahkan input untuk toko -->
    <label>Deskripsi:</label><textarea name="deskripsi" required></textarea><br>
    <label>Foto:</label><input type="file" name="foto" required><br>
    <button type="submit">Tambah Barang</button>
</form>

<?php
include 'templates.php';
?>
