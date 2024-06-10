<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Verifikasi Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-custom {
            background-color: #C72056;
        }
        .footer-custom {
            background-color: #C72056;
        }
    </style>
</head>
<body class="bg-primary font-sans leading-normal tracking-normal">

<div class="flex flex-col md:flex-row">
    <!-- Sidebar -->
    <div class="flex flex-col w-full md:w-64 bg-custom text-white h-screen">
        <div class="flex items-center justify-center h-20 shadow-md">
            <img src="./asset/logo pp 1.png" alt="PartyPal Logo" class="h-12">
            <span class="ml-2 text-2xl font-bold">Admin</span>
        </div>
        <nav class="mt-10">
            <a href="pengajuanbarang.php" class="flex items-center mt-4 py-2 px-8 text-white hover:bg-pink-800">
                <span class="mx-4 font-bold">Pengajuan Barang</span>
            </a>
            <a href="#" class="flex items-center mt-4 py-2 px-8 bg-pink-800 text-white">
                <span class="mx-4 font-bold">Verifikasi Pengguna</span>
            </a>
            <a href="loginadmin.html" class="flex items-center mt-4 py-2 px-8 text-white hover:bg-pink-800">
                <span class="mx-4 font-bold">Log Out</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex flex-col flex-grow bg-white">
        <header class="flex items-center h-20 px-6 sm:px-10 bg-custom text-white">
        </header>
        <main class="flex-grow p-6">
            <h1 class="ml-2 text-2xl font-bold mb-4" style="color: #C72056;">Verifikasi Pengguna</h1>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-6 bg-custom text-left text-white">User ID</th>
                            <th class="py-2 px-6 bg-custom text-left text-white">Username</th>
                            <th class="py-2 px-6 bg-custom text-left text-white">Request Date</th>
                            <th class="py-2 px-6 bg-custom text-left text-white">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php
                        include 'koneksi.php';
                        $sql = "SELECT uv.verification_id, uv.user_id, u.username, uv.request_date, uv.status 
                                FROM user_verification uv
                                JOIN users u ON uv.user_id = u.user_id";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='border-t-2 border-custom px-4 py-2'>" . $row['user_id'] . "</td>";
                                echo "<td class='border-t-2 border-custom px-4 py-2'>" . $row['username'] . "</td>";
                                echo "<td class='border-t-2 border-custom px-4 py-2'>" . $row['request_date'] . "</td>";
                                echo "<td class='border-t-2 border-custom px-4 py-2'>
                                      <select class='status-dropdown' data-id='" . $row['verification_id'] . "'>
                                          <option value='pending' " . ($row['status'] == 'pending' ? 'selected' : '') . ">Pending</option>
                                          <option value='approved' " . ($row['status'] == 'approved' ? 'selected' : '') . ">Approved</option>
                                          <option value='rejected' " . ($row['status'] == 'rejected' ? 'selected' : '') . ">Rejected</option>
                                      </select>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='border-t-2 border-custom px-4 py-2 text-center'>No pending requests</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<footer class="footer-custom py-8 pb-4">
    <div class="grid grid-cols-3 container mx-auto">
            <div>
                <h1 class="text-white text-3xl font-bold">PartyPal</h1>
                <p class="mt-5 text-white max-w-xs leading-10 font-light">Jl. Prof. Dr. Sumantri Brojonegoro No. 1 Bandar Lampung, Lampung, 35145.</p>
                <div class="flex text-white items-center gap-x-3 mt-4">
                    <img src="./asset/phone.svg" alt="" /> +6280099442214
                </div>
                <div class="flex text-white items-center gap-x-3 mt-4">
                    <img src="./asset/mail.svg" alt="" /> partypal@gmail.com
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
                        <img class="h-8" src="./asset/bank/bni.png" alt="" />
                    </div>
                    <div class="px-2 py-2 rounded-lg bg-white flex items-center justify-center">
                        <img class="h-8" src="./asset/bank/bca 1.png" alt="" />
                    </div>
                    <div class="px-2 py-2 rounded-lg bg-white flex items-center justify-center">
                        <img class="h-8" src="./asset/bank/bri 1.png" alt="" />
                    </div>
                    <div class="px-2 py-2 rounded-lg bg-white">
                        <img src="./asset/bank/Mandiri_logo (1) 1.png" alt="" />
                    </div>
                    <div class="px-2 py-2 rounded-lg bg-white">
                        <img src="./asset/bank/seabank 1.png" alt="" />
                    </div>
                    <div class="px-2 py-2 rounded-lg bg-white flex items-center justify-center">
                        <img src="./asset/bank/gopay-logo-new 1 (1).png" alt="" />
                    </div>
                    <div class="px-2 py-1 rounded-lg bg-white">
                        <img class="w-20 mx-auto" src="./asset/bank/Logo-ShopeePay-768x403 1.png" alt="" />
                    </div>
                </div>
            </div>
        </div>
</footer>


<!-- Tailwind CSS -->
<script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
<!-- Font Awesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<!-- AJAX script -->
<script>
    document.querySelectorAll('.status-dropdown').forEach(dropdown => {
        dropdown.addEventListener('change', function () {
            const verificationId = this.getAttribute('data-id');
            const status = this.value;
            fetch('verify_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: verificationId,
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert('Failed to update status');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>
</body>
</html>
