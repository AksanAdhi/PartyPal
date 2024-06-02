<?php
include 'db.php';
include 'templates.php';

// Fungsi untuk mengubah status verifikasi
if (isset($_GET['verify_id']) && isset($_GET['status'])) {
    $verify_id = $_GET['verify_id'];
    $status = $_GET['status'];

    $update_sql = "UPDATE items SET verified='$status' WHERE id='$verify_id'";
    if ($conn->query($update_sql) === TRUE) {
        header('Location: admin.php');
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$sql = "SELECT * FROM items";
$result = $conn->query($sql);

if ($result === FALSE) {
    echo "Error: " . $conn->error;
    exit;
}
?>

<div style="float: left; margin-top: 5px; margin-left: 30px;">
    <a href="#" style="color: pink; font-weight: bold; text-decoration: none;">Pengajuan Barang</a><br>
    <a href="verifikasiadmin.php" style="color: black; font-weight: bold; text-decoration: none;">Verifikasi</a><br>
    <a href="login.html" style="color: black; font-weight: bold; text-decoration: none;">Log Out</a>
</div>




<div style="float: left; margin-top: 5px; margin-left: 50px;">

<h1 style="color: pink; font-weight: bold; margin-left: 20px;">Pengajuan Barang</h1>
<table border="1" style="border-collapse: collapse; border-color: pink; margin-left: 20px;">
    <thead>
        <tr>
            <th style="color: black; font-weight: bold;">Nama Barang</th>
            <th style="color: black; font-weight: bold;">Toko</th>
            <th style="color: black; font-weight: bold;">Info (Tinjau)</th>
            <th style="color: black; font-weight: bold;">Verifikasi</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td style="color: black; font-weight: bold;"><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                    <td style="color: black; font-weight: bold;"><?php echo htmlspecialchars($row['toko']); ?></td>
                    <td style="color: black; font-weight: bold;"><a href="detail.php?id=<?php echo htmlspecialchars($row['id']); ?>" style="font-weight: bold;">Tinjau</a></td>
                    <td style="color: black; font-weight: bold;">
                        <?php if ($row['verified'] == 1): ?>
                            <span style="color: green; font-size: 20px;">✔</span>
                        <?php else: ?>
                            <span style="color: red; font-size: 20px;">✖</span>
                        <?php endif; ?>
                        <br>
                        <!-- Tombol untuk mengubah status verifikasi -->
                        <a href="?verify_id=<?php echo $row['id']; ?>&status=<?php echo $row['verified'] == 1 ? 0 : 1; ?>">
    <?php if ($row['verified'] == 1): ?>
        <span style="color: red; font-size: 20px;">✖</span>
    <?php else: ?>
        <span style="color: green; font-size: 20px;">✔</span>
    <?php endif; ?>
</a>

                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Tidak ada barang untuk ditampilkan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</div>

<?php
include 'templates.php';
?>
