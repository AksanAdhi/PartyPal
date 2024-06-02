<?php
include 'db.php';
include 'templates.php';

$id = $_GET['id'];
$sql = "SELECT * FROM items WHERE id = $id";
$result = $conn->query($sql);
$item = $result->fetch_assoc();
?>

<div style="background-color: pink; padding: 20px;">

    <div style="display: flex;">
        <!-- Konten gambar barang -->
        <div style="flex: 1;">
            <img src="uploads/<?php echo $item['foto']; ?>" alt="<?php echo $item['nama_barang']; ?>" style="max-width: 300px;">
        </div>

        <!-- Konten keterangan barang -->
        <div style="flex: 1; background-color: white; padding-left: 20px;"> <!-- Tambahkan padding ke kiri -->
            <h1><?php echo $item['nama_barang']; ?></h1>
            <p>Kode Barang: <?php echo $item['kode_barang']; ?></p>
            <p>Harga Jual: <?php echo $item['harga_jual']; ?></p>
            <p>Kategori: <?php echo $item['kategori']; ?></p>
            <p>Stok: <?php echo $item['stok']; ?></p>
            <p>Deskripsi: <?php echo $item['deskripsi']; ?></p>
            <p>Toko: <?php echo $item['toko']; ?></p> <!-- Menampilkan nilai toko -->
        </div>
    </div>

</div>


<?php
include 'templates.php';
?>
