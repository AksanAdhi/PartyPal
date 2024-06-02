<?php
include 'db.php';
include 'templates.php';

// Ambil semua barang yang belum diverifikasi dari database
$sql = "SELECT * FROM items WHERE verified = 0";
$result = $conn->query($sql);
?>

<h1>Daftar Barang yang Belum Diverifikasi</h1>
<?php if ($result->num_rows > 0): ?>
    <ul>
        <?php while ($item = $result->fetch_assoc()): ?>
            <li>
                <h2><?php echo $item['nama_barang']; ?></h2>
                <p>Kode Barang: <?php echo $item['kode_barang']; ?></p>
                <p>Harga Jual: <?php echo $item['harga_jual']; ?></p>
                <p>Kategori: <?php echo $item['kategori']; ?></p>
                <p>Stok: <?php echo $item['stok']; ?></p>
                <p>Deskripsi: <?php echo $item['deskripsi']; ?></p>
                <p>Toko: <?php echo $item['toko']; ?></p> <!-- Menampilkan nilai toko -->
                <p><img src="uploads/<?php echo $item['foto']; ?>" alt="<?php echo $item['nama_barang']; ?>"></p>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <p>Tidak ada barang yang perlu diverifikasi.</p>
<?php endif; ?>

<?php
include 'templates.php';
?>
