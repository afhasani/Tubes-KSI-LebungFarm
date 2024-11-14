<?php
session_start();
include 'tentangkami_db.php';

if (!isset($_SESSION['session_username'])) {
    header("Location: LebungFarm/login.php");
    exit();
}

// Ambil deskripsi sejarah desa dari database
$deskripsi_sejarah = getDeskripsiSejarah();

// Perbarui deskripsi sejarah desa
if (isset($_POST['update_deskripsi'])) {
    $deskripsi = $_POST['deskripsi'];

    $deskripsi = nl2br($deskripsi);
    // Fungsi updateDeskripsiSejarah (disarankan buat fungsi di produk_db.php)
    if (updateDeskripsiSejarah($deskripsi)) {
        header("Location: adm_dsh_SejarahDesa.php?success=1"); // Redirect setelah berhasil update
        exit();
    } else {
        $error = "Gagal memperbarui deskripsi sejarah desa.";
    }
}

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
    <style>
        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            transition: all 0.3s;
        }
        .sidebar.show-sidebar {
            transform: translateX(0);
        }
        /* Additional styles for sidebar, header, and content */
    </style>
    <script>
        function toggleDeskripsi(id) {
            const fullDesc = document.getElementById('deskripsi-full-' + id);
            const shortDesc = document.getElementById('deskripsi-short-' + id);
            const btn = document.getElementById('toggle-btn-' + id);
            if (fullDesc.style.display === 'none') {
                fullDesc.style.display = 'block';
                shortDesc.style.display = 'none';
                btn.innerText = 'Tampilkan Sedikit';
            } else {
                fullDesc.style.display = 'none';
                shortDesc.style.display = 'block';
                btn.innerText = 'Tampilkan Semua';
            }
        }
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show-sidebar');
        }
    </script>
</head>
<body>
    <header class="header" style="display: flex;">
        <img src="assets/Logo_lamsel.png" alt="Logo Lamsel">
        <img src="assets/Logo_kemendes.png" alt="Logo Kemendes">
        <div class="title-wrap text-left">
            <p class="judul">LEBUNGFARM</p>
            <p class="subjudul" style="color:gray;">Desa Lebung Sari</p>
        </div>
        <button class="burger-menu" onclick="toggleSidebar()" style="color: black;">&#9776;</button>
    </header>

    <!-- Sidebar -->
    <?php include "sidebar.html" ?>

    <div class="content" id="top">
    <h1 class="text-center" style="font-weight: bold;">Sejarah Desa</h1>
    <h2>Ubah Sejarah Desa</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label>Deskripsi:</label>
            <textarea name="deskripsi" class="form-control" rows="5" required><?php echo htmlspecialchars($deskripsi_sejarah); ?></textarea>
        </div>
        <button type="submit" name="update_deskripsi" class="btn btn-primary">Konfirmasi Perubahan</button>
    </form>


    <?php if (isset($error)): ?>
        <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
    <?php endif; ?>
</div>