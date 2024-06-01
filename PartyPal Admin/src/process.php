<?php
// Process the form submission
if(isset($_POST['tambah'])) {
    // Proses formulir untuk tombol "Tambah" di sini

    // Redirect user to tambah.html after processing
    header("Location: tambah.html");
    exit();
} elseif(isset($_POST['verifikasi'])) {
    // Proses formulir untuk tombol "Verifikasi" di sini

    // Redirect user to verifikasi.html after processing
    header("Location: verifikasi.html");
    exit();
}
?>
