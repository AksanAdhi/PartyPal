<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pengajuan Barang</title>
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
    <div class="flex flex-col w-full md:w-64 bg-custom text-white h-screen">
        <div class="flex items-center justify-center h-20 shadow-md">
            <img src="./asset/logo pp 1.png" alt="PartyPal Logo" class="h-12">
            <span class="ml-2 text-2xl font-bold">Admin</span>
        </div>
        <nav class="mt-10">
            <a href="pengajuanbarang.php" class="flex items-center mt-4 py-2 px-8 bg-pink-800 text-white">
                <span class="mx-4 font-bold">Pengajuan Barang</span>
            </a>
            <a href="verifikasipengguna.php" class="flex items-center mt-4 py-2 px-8 text-white hover:bg-pink-800">
                <span class="mx-4 font-bold">Verifikasi Pengguna</span>
            </a>
            <a href="loginadmin.html" class="flex items-center mt-4 py-2 px-8 text-white hover:bg-pink-800">
                <span class="mx-4 font-bold">Log Out</span>
            </a>
        </nav>
    </div>

    <div class="flex flex-col flex-grow bg-white">
        <header class="flex items-center h-20 px-6 sm:px-10 bg-custom text-white">
        </header>
        <main class="flex-grow p-6">
          <h1 class="ml-2 text-2xl font-bold mb-4" style="color: #C72056;">Pengajuan Barang</h1>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-6 bg-custom text-left text-white">Nama Barang</th>
                            <th class="py-2 px-6 bg-custom text-left text-white">Toko</th>
                            <th class="py-2 px-6 bg-custom text-left text-white">Harga</th>
                            <th class="py-2 px-6 bg-custom text-left text-white">Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php
                        include 'koneksi.php';
                        $sql = "SELECT * FROM verification_request";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='border-t-2 border-custom px-4 py-2'>" . $row['item_name'] . "</td>";
                                echo "<td class='border-t-2 border-custom px-4 py-2'>" . $row['store_name'] . "</td>";
                                echo "<td class='border-t-2 border-custom px-4 py-2'>" . $row['price'] . "</td>";
                                echo "<td class='border-t-2 border-custom px-4 py-2'>
                                      <select class='status-dropdown' data-id='" . $row['request_id'] . "'>
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
        <footer class="footer-custom p-4 text-center text-white">
            &copy; 2023 PartyPal. All rights reserved.
        </footer>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.status-dropdown').change(function() {
            var requestId = $(this).data('id');
            var newStatus = $(this).val();
            $.ajax({
                url: 'verify.php',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    id: requestId,
                    status: newStatus
                }),
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.success) {
                        alert('Status updated successfully.');
                    } else {
                        alert('Failed to update status.');
                    }
                },
                error: function() {
                    alert('Error occurred while updating status.');
                }
            });
        });
    });
</script>
</body>
</html>
