<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan nama server database Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "produk_beranda"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mendapatkan deskripsi produk unggulan
$query_unggulan_desc = "SELECT * FROM deskripsi WHERE kategori = 'unggulan'";
$result_unggulan_desc = $conn->query($query_unggulan_desc);

// Query untuk mendapatkan deskripsi produk favorit
$query_favorit_desc = "SELECT * FROM deskripsi WHERE kategori = 'favorit'";
$result_favorit_desc = $conn->query($query_favorit_desc);

// Query untuk mendapatkan data produk unggulan
$query_unggulan = "SELECT * FROM produk_beranda WHERE kategori = 'unggulan'";
$result_unggulan = $conn->query($query_unggulan);

// Query untuk mendapatkan data produk favorit
$query_favorit = "SELECT * FROM produk_beranda WHERE kategori = 'favorit'";
$result_favorit = $conn->query($query_favorit);

// Tutup koneksi database
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
    <?php include "sidebar.html" ?>

    <div class="content" id="top" style="margin-bottom: 50px;">
        <!-- Form untuk update deskripsi produk unggulan -->
        <h2>Update Deskripsi Produk Unggulan</h2>
        <?php while ($desc_unggulan = $result_unggulan_desc->fetch_assoc()) { ?>
            <form action="update_deskripsi.php" method="POST">
                <input type="hidden" name="kategori" value="unggulan">
                <div class="form-group">
                    <label for="deskripsi">Deskripsi Produk Unggulan</label>
                    <textarea class="form-control" name="deskripsi" rows="5"><?php echo $desc_unggulan['deskripsi']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Deskripsi</button>
            </form>
        <?php } ?>

        <!-- Tabel Produk Unggulan -->
        <h2>Produk Unggulan</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Caption</th>
                    <th>Update Gambar & Caption</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_unggulan->fetch_assoc()) { ?>
                    <tr>
                        <td><img src="produk_beranda/<?php echo $row['gambar']; ?>" alt="Gambar Produk" width="100"></td>
                        <td><?php echo $row['caption']; ?></td>
                        <td>
                            <!-- Tombol untuk mengupdate gambar dan caption -->
                            <button class="btn btn-primary" data-toggle="modal" data-target="#updateModal<?php echo $row['id']; ?>">Update Gambar & Caption</button>
                        </td>
                    </tr>
                    <!-- Modal untuk Update Gambar dan Caption -->
                    <div class="modal fade" id="updateModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h5 class="modal-title" id="updateModalLabel">Update Gambar dan Caption Produk Unggulan</h5>
                                </div>
                                <form action="update_gambar_caption.php" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="hidden" name="produk_id" value="<?php echo $row['id']; ?>">
                                        <div class="form-group">
                                            <label for="gambar">Pilih Gambar Baru</label>
                                            <input type="file" class="form-control" name="gambar" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="caption">Caption Gambar</label>
                                            <input type="text" class="form-control" name="caption" value="<?php echo $row['caption']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Update Gambar & Caption</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>

        <!-- Form untuk update deskripsi produk favorit -->
        <h2>Update Deskripsi Produk Favorit</h2>
        <?php while ($desc_favorit = $result_favorit_desc->fetch_assoc()) { ?>
            <form action="update_deskripsi.php" method="POST">
                <input type="hidden" name="kategori" value="favorit">
                <div class="form-group">
                    <label for="deskripsi">Deskripsi Produk Favorit</label>
                    <textarea class="form-control" name="deskripsi" rows="5"><?php echo $desc_favorit['deskripsi']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Deskripsi</button>
            </form>
        <?php } ?>

        <!-- Tabel Produk Favorit -->
        <h2>Produk Favorit</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Caption</th>
                    <th>Update Gambar & Caption</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_favorit->fetch_assoc()) { ?>
                    <tr>
                        <td><img src="produk_beranda/<?php echo $row['gambar']; ?>" alt="Gambar Produk" width="100"></td>
                        <td><?php echo $row['caption']; ?></td>
                        <td>
                            <!-- Tombol untuk mengupdate gambar dan caption -->
                            <button class="btn btn-primary" data-toggle="modal" data-target="#updateModal<?php echo $row['id']; ?>">Update Gambar & Caption</button>
                        </td>
                    </tr>
                    <!-- Modal untuk Update Gambar dan Caption -->
                    <div class="modal fade" id="updateModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h5 class="modal-title" id="updateModalLabel">Update Gambar dan Caption Produk Favorit</h5>
                                </div>
                                <form action="update_gambar_caption.php" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="hidden" name="produk_id" value="<?php echo $row['id']; ?>">
                                        <div class="form-group">
                                            <label for="gambar">Pilih Gambar Baru</label>
                                            <input type="file" class="form-control" name="gambar" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="caption">Caption Gambar</label>
                                            <input type="text" class="form-control" name="caption" value="<?php echo $row['caption']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Update Gambar & Caption</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>
