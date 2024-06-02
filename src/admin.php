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

