<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="./output.css" />
    <link rel="stylesheet" href="home.css" />
    <style>
        .containerz {
            background-color: #fff;
            padding: 20px 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 1000px;
            margin-top: 10px;
            margin-left: 150px;
            margin-bottom: 50px;
        }
        .containerz h1 {
            color: #c8235a;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 30px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        .form-group input,
        .form-group textarea {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-group textarea {
            resize: vertical;
            height: 80px;
        }
        .submit-btn {
            width: 100%;
            background-color: #c8235a;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #c8235aaf;
        }
    </style>
</head>
<body>
    <header class="bg-primary">
        <nav class="flex items-center justify-between container mx-auto py-4">
            <a class="flex items-center text-white gap-x-2 font-bold text-2xl" href="#">
                <img class="w-16" src="./asset/logo pp 1.png" alt="" />
                PartyPal
            </a>
            <div class="relative w-full max-w-sm">
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5">
                    <svg
                        class="flex-shrink-0 size-4 text-gray-400 dark:text-white/60"
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </svg>
                </div>
                <div>
                    <input
                        class="py-3 ps-10 pe block w-full max-w-lg border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                        type="text"
                        placeholder="Type a product name"
                        value=""
                        data-hs-combo-box-input=""
                    />
                </div>
            </div>
            <div class="flex gap-x-5">
                <a href="Keranjang.html">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart" width="40" height="40" viewBox="0 0 25 25" stroke-width="1.5" stroke="#fff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M17 17h-11v-14h-2" />
                        <path d="M6 5l14 1l-1 7h-13" />
                    </svg>
                </a>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="icon icon-tabler icon-tabler-user-square-rounded"
                    width="40"
                    height="40"
                    viewBox="0 0 25 25"
                    stroke-width="1.5"
                    stroke="#fff"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" />
                    <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                    <path d="M6 20.05v-.05a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v.05" />
                </svg>
            </div>
        </nav>
        <div class="flex justify-center bg-white gap-x-16 py-3 text-primary text-lg">
            <a class="py-3" href="home.html">Home</a>
            <a class="py-3" href="produk.html">Product</a>
            <a class="py-3" href="#">History</a>
        </div>
    </header>
    <div class="containerz">
        <h1>TAMBAH DATA BARANG</h1>
        <form action="process_tambahbarang.php" method="POST">
            <div class="form-group">
                <label for="nama-barang">Nama barang:</label>
                <input type="text" id="nama-barang" name="nama_barang" required>
            </div>
            <div class="form-group">
                <label for="harga-jual">Harga Jual:</label>
                <input type="text" id="harga-jual" name="harga_jual" required>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori:</label>
                <input type="text" id="kategori" name="kategori" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="text" id="stok" name="stok" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea id="deskripsi" name="deskripsi" required></textarea>
            </div>
            <button type="submit" class="submit-btn">Simpan</button>
        </form>
    </div>
    <footer class="bg-primary py-8 pb-4">
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
                <p class="text-white font-medium mt-8"><a href="Panduan.html">Cara Pesan</a> </p>
                <p class="text-white font-medium mt-4"><a href="s&k.html">Syarat dan Ketentuan</a> </p>
                <p class="text-white font-medium mt-4"><a href="Kontak.html">Kontak</a> </p>
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
    <script src="https://kit.fontawesome.com/c4ce7ec2a0.js" crossorigin="anonymous"></script>
</body>
</html>
