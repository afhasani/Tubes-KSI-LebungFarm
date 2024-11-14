<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan host database Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "kontak_kami"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses pembaruan data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];

    // Update data di database
    $sql = "UPDATE kontak SET 
            judul='$judul', 
            deskripsi='$deskripsi', 
            alamat='$alamat', 
            telepon='$telepon', 
            email='$email' 
            WHERE id=1"; // Asumsi Anda hanya memiliki satu data kontak

    if ($conn->query($sql) === TRUE) {
        // Redirect setelah data berhasil diperbarui
        header("Location: adm_dsh_KontakKami.php"); // Mengarahkan ke halaman kontak_kami.php
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil data kontak dari database
$sql = "SELECT * FROM kontak WHERE id=1"; // Asumsi hanya ada satu data kontak
$result = $conn->query($sql);
$kontak = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="header" style="display: flex;">
        <img src="assets/Logo_lamsel.png">
        <img src="assets/Logo_kemendes.png">
        <div class="title-wrap text-left">
            <p class="judul">LEBUNGFARM</p>
            <p class="subjudul" style="color:gray;">Desa Lebung Sari</p>
        </div>
        <!-- Menu Burger untuk tampilan mobile -->
        <button class="burger-menu" onclick="toggleSidebar()" style="color: black;">&#9776;</button>
    </header>

    <!-- Sidebar -->
    <?php include "sidebar.html"?>

    <div class="content" id="top" style="margin-bottom: 50px;">
        <div class="form-section">
            <h1 class="text-center">Kontak Kami</h1>
            <form method="POST" enctype="multipart/form-data">
                <!-- Judul -->
                <div class="form-group">
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control" placeholder="Cth: KONTAK KAMI">
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="form-group">
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control"  name="deskripsi" rows="3" placeholder="Cth: Lihat di bawah ini"></textarea>
                    </div>
                </div>

                <!-- Informasi Kontak -->
                <h4 class="mt-4">Informasi Kontak</h4>
                <div class="form-group">
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" rows="3"  name="alamat" placeholder="Cth: Kecamatan Merbau Mataram, Kabupaten Lampung Selatan, Provinsi Lampung, Indonesia 35537"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" class="form-control"  name="telepon" placeholder="Cth: +62 812-3456-7890 (Budi Santoso)">
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control"  name="email" placeholder="Cth: budisantoso@example.com">
                    </div>
                </div>

                <!-- Simpan Perubahan Button -->
                <button type="submit" class="btn btn-primary">Simpan Semua Perubahan</button>
            </form>
        </div>
    </div>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show-sidebar');
        }
    </script>
    <footer class="footer">
        Copyright © 2024 UMKM Lebung Sari | All rights reserved.
    </footer>
</body>
</html>