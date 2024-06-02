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
