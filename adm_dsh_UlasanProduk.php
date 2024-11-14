<?php
require_once 'produk_db.php'; // Pastikan file ini menghubungkan database dan fungsi yang sudah dibuat

// Mengambil aksi dari permintaan (POST)
$action = $_POST['action'] ?? null;
$statusMessage = '';

// Menangani aksi berdasarkan nilai 'action' yang diterima dari form
if ($action == 'add') {
    // Data untuk menambah ulasan
    $nama_produk = $_POST['nama_produk'];
    $nama_pengulas = $_POST['nama_pengulas'];
    $status = $_POST['status'];
    $ulasan = $_POST['ulasan'];
    $rating = $_POST['rating'];

    if (tambahUlasan($nama_produk, $nama_pengulas, $status, $ulasan, $rating)) {
        $statusMessage = "Ulasan berhasil ditambahkan.";
    } else {
        $statusMessage = "Gagal menambahkan ulasan.";
    }

} elseif ($action == 'edit') {
    // Data untuk mengedit ulasan
    $id = $_POST['id'];
    $nama_produk = $_POST['nama_produk'];
    $nama_pengulas = $_POST['nama_pengulas'];
    $status = $_POST['status'];
    $ulasan = $_POST['ulasan'];
    $rating = $_POST['rating'];

    if (editUlasan($id, $nama_produk, $nama_pengulas, $status, $ulasan, $rating)) {
        $statusMessage = "Ulasan berhasil diperbarui.";
    } else {
        $statusMessage = "Gagal memperbarui ulasan.";
    }

} elseif ($action == 'delete') {
    // Data untuk menghapus ulasan
    $id = $_POST['id'];

    if (hapusUlasan($id)) {
        $statusMessage = "Ulasan berhasil dihapus.";
    } else {
        $statusMessage = "Gagal menghapus ulasan.";
    }
}

// Ambil daftar ulasan untuk ditampilkan di halaman dashboard
$ulasanList = tampilkanUlasan();
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

        .tabel_ulasan{
            width: 100%;
            margin-bottom: 50px;
        }
        .btn_batal{
            margin: 3px 0;
        }
    </style>
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

    <div class="content" id="top">
    <h1 class="text-center" style="font-weight: bold;">Ulasan Produk</h1>
    <p><?php echo $statusMessage; ?></p>

    <!-- Form Tambah/Edit Ulasan -->
    <!-- Form Tambah Ulasan Baru -->
    <form method="POST" action="adm_dsh_UlasanProduk.php" class="form_ulasan">
            <input type="hidden" name="action" value="add">
            <h3>Tambah Ulasan Baru</h3>
            <div class="form-group">
                <label>Nama Produk:</label>
                <input type="text" name="nama_produk" class="form-control" placeholder="Keripik Tempe"  required>
            </div>
            <div class="form-group">
                <label>Nama Pengulas:</label>
                <input type="text" name="nama_pengulas" class="form-control" placeholder="Budi Setiawan" required>
            </div>
            <div class="form-group">
                <label>Status:</label>
                <input type="text" name="status" class="form-control" placeholder="Pelanggan" required>
            </div>
            <div class="form-group">
                <label>Ulasan:</label>
                <textarea name="ulasan" class="form-control" placeholder="Keripik Tempenya sangat enak" required></textarea>
            </div>
            <div class="form-group">
            <label>Rating:</label>
                <select class="form-control" id="editRating" name="rating" required>
                    <option value="1">1 - Sangat Buruk</option>
                    <option value="2">2 - Buruk</option>
                    <option value="3">3 - Cukup</option>
                    <option value="4">4 - Baik</option>
                    <option value="5">5 - Sangat Baik</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Ulasan</button>
        </form>

        <!-- Tabel Daftar Ulasan -->
        <h3>Daftar Ulasan Produk</h3>
        <table class="table-striped mt-3 tabel_ulasan table text-center">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Nama Pengulas</th>
                    <th>Status</th>
                    <th>Rating</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ulasanList as $ulasan): ?>
                    <tr>
                        <td><?php echo $ulasan['nama_produk']; ?></td>
                        <td><?php echo $ulasan['nama_pengulas']; ?></td>
                        <td><?php echo $ulasan['status']; ?></td>
                        <td><?php echo $ulasan['rating']; ?></td>
                        <td>
                            <button onclick="openEditModal(<?php echo $ulasan['id']; ?>, '<?php echo addslashes($ulasan['nama_produk']); ?>', '<?php echo addslashes($ulasan['nama_pengulas']); ?>', '<?php echo addslashes($ulasan['status']); ?>', '<?php echo addslashes($ulasan['ulasan']); ?>', <?php echo $ulasan['rating']; ?>)" class="btn btn-warning btn-sm">Edit</button>
                            <form method="POST" action="adm_dsh_UlasanProduk.php" style="display: inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $ulasan['id']; ?>">
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Edit Ulasan Produk -->
    <div class="modal fade" id="editUlasanModal" tabindex="-1" role="dialog" aria-labelledby="editUlasanModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title" id="editUlasanModalLabel">Edit Ulasan Produk</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="adm_dsh_UlasanProduk.php">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id" id="editUlasanId">
                        <label>Nama Produk:</label>
                        <input type="text" class="form-control" id="editNamaProduk" name="nama_produk" required>
                        <label>Nama Pengulas:</label>
                        <input type="text" class="form-control" id="editNamaPengulas" name="nama_pengulas" required>
                        <label>Status:</label>
                        <input type="text" class="form-control" id="editStatus" name="status" required>
                        <label>Ulasan:</label>
                        <textarea class="form-control" id="editUlasanText" name="ulasan" rows="3" required></textarea>
                        <label>Rating:</label>
                        <select class="form-control" id="editRating" name="rating" required>
                            <option value="1">1 - Sangat Buruk</option>
                            <option value="2">2 - Buruk</option>
                            <option value="3">3 - Cukup</option>
                            <option value="4">4 - Baik</option>
                            <option value="5">5 - Sangat Baik</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn_batal" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    // Fungsi untuk membuka modal edit dengan data ulasan yang dipilih
    function openEditModal(id, nama_produk, nama_pengulas, status, ulasan, rating) {
        $('#editUlasanId').val(id);
        $('#editNamaProduk').val(nama_produk);
        $('#editNamaPengulas').val(nama_pengulas);
        $('#editStatus').val(status);
        $('#editUlasanText').val(ulasan);
        $('#editRating').val(rating);
        $('#editUlasanModal').modal('show');
    }
    </script>
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