<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="./output.css" />
    <style>
      .admin-button {
        background-color: white;
        color: rgb(242, 77, 105);
        padding: 0.25rem 0.75rem;
        border-radius: 0.5rem;
        font-weight: bold;
        margin-left: 10px;
        margin-top: 10px;
      }

      .action-button {
        width: 150px;
        height: 150px;
        background-color: #007bff;
        border-radius: 16px;
        overflow: hidden;
        padding: 0;
        border: none;
      }

      .action-button img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .center-box {
        width: 80%; /* Width of the white box */
        height: 400px; /* Height of the white box */
        background-color: white;
        margin: 40px auto; /* Centers the box horizontally and adds vertical spacing */
        border-radius: 16px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow */
      }
    </style>
  </head>
  <body>
    <header class="bg-primary py-8">
      <nav class="flex items-center justify-between container mx-auto py-4">
        <div class="flex items-center gap-x-4">
          <a
            class="flex items-center text-white gap-x-2 font-bold text-2xl"
            href="#"
          >
            <img class="w-16" src="./asset/logo pp 111.png" alt="Logo" />
            PartyPal
          </a>
          <button class="admin-button">Admin</button>
        </div>
      </nav>
    </header>

    <div class="center-box">
      <!-- This is the white empty space in the middle of the page -->
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

    </div>

    <footer class="bg-primary py-8 pb-4">
      <div class="grid grid-cols-3 container mx-auto">
        <div>
          <h1 class="text-white text-3xl font-bold">PartyPal</h1>
          <p class="mt-5 text-white max-w-xs leading-10 font-light">
            Jl. Prof. Dr. Sumantri Brojonegoro No. 1 Bandar Lampung, Lampung, 35145.
          </p>
          <div class="flex text-white items-center gap-x-3 mt-4">
            <img src="./asset/phone.svg" alt="Phone" /> +6280099442214
          </div>
          <div class="flex text-white items-center gap-x-3 mt-4">
            <img src="./asset/mail.svg" alt="Mail" /> partypal@gmail.com
          </div>
          <h3 class="mt-8 text-xl font-bold text-white">Follow Us</h3>
          <div class="flex gap-x-3 mt-3">
            <i class="fa-brands fa-instagram text-3xl text-white"></i>
            <i class="fa-brands fa-facebook text-3xl text-white"></i>
            <i class="fa-brands fa-x-twitter text-3xl text-white"></i>
          </div>
        </div>
        <div class="mx-auto">
          <h1 class="text-lg font-bold text-white">Informasi</h1>
          <p class="text-white font-medium mt-8">Cara Pesan</p>
          <p class="text-white font-medium mt-4">Syarat dan Ketentuan</p>
          <p class="text-white font-medium mt-4">Kontak</p>
        </div>
        <div class="mx-auto">
          <h1 class="text-lg font-bold text-white">Pembayaran</h1>
          <div class="grid grid-cols-3 gap-3 mt-8">
            <div class="bg-white px-2 py-2 rounded-lg flex items-center justify-center">
              <img class="h-8" src="./asset/bank/bni.png" alt="BNI" />
            </div>
            <div class="px-2 py-2 rounded-lg bg-white flex items-center justify-center">
              <img class="h-8" src="./asset/bank/bca 1.png" alt="BCA" />
            </div>
            <div class="px-2 py-2 rounded-lg bg-white flex items-center justify-center">
              <img class="h-8" src="./asset/bank/bri 1.png" alt="BRI" />
            </div>
            <div class="px-2 py-2 rounded-lg bg-white">
              <img src="./asset/bank/Mandiri_logo (1) 1.png" alt="Mandiri" />
            </div>
            <div class="px-2 py-2 rounded-lg bg-white">
              <img src="./asset/bank/seabank 1.png" alt="SeaBank" />
            </div>
            <div class="px-2 py-2 rounded-lg bg-white flex items-center justify-center">
              <img src="./asset/bank/gopay-logo-new 1 (1).png" alt="GoPay" />
            </div>
            <div class="px-2 py-1 rounded-lg bg-white">
              <img class="w-20 mx-auto" src="./asset/bank/Logo-ShopeePay-768x403 1.png" alt="ShopeePay" />
            </div>
          </div>
        </div>
      </div>
    </footer>

    <script src="https://kit.fontawesome.com/c4ce7ec2a0.js" crossorigin="anonymous"></script>
  </body>
</html>
