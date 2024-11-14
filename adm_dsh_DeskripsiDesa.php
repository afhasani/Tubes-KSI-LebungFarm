<?php
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'deskripsi_desa';

$koneksi = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Menangani pembaruan deskripsi jika form dikirim
if (isset($_POST['update_deskripsi'])) {
    $deskripsi_desa = $koneksi->real_escape_string($_POST['deskripsi_desa']);
    $deskripsi_umkm = $koneksi->real_escape_string($_POST['deskripsi_umkm']);
    
    // Update deskripsi di database
    $updateQuery = "UPDATE deskripsi SET deskripsi_desa='$deskripsi_desa', deskripsi_umkm='$deskripsi_umkm' WHERE id=1";
    if ($koneksi->query($updateQuery) === TRUE) {
        echo "<script>alert('Deskripsi berhasil diperbarui!');</script>";
    } else {
        echo "Error: " . $updateQuery . "<br>" . $koneksi->error;
    }
}

// Mengambil deskripsi yang ada
$query = "SELECT deskripsi_desa, deskripsi_umkm FROM deskripsi WHERE id=1";
$result = $koneksi->query($query);
$row = $result->fetch_assoc();
$deskripsi_desa = $row['deskripsi_desa'] ?? '';
$deskripsi_umkm = $row['deskripsi_umkm'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Edit Deskripsi</title>
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
        <button class="burger-menu" onclick="toggleSidebar()" style="color: black;">&#9776;</button>
    </header>

    <!-- Sidebar -->
    <?php include "sidebar.html"; ?>

    <div class="content" id="top" style="margin-bottom: 50px;">
        <h2>Edit Deskripsi</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="deskripsi_desa">Deskripsi Desa:</label>
                <textarea name="deskripsi_desa" id="deskripsi_desa" class="form-control" rows="4" required><?php echo htmlspecialchars($deskripsi_desa); ?></textarea>
            </div>

            <div class="form-group">
                <label for="deskripsi_umkm">Deskripsi UMKM:</label>
                <textarea name="deskripsi_umkm" id="deskripsi_umkm" class="form-control" rows="4" required><?php echo htmlspecialchars($deskripsi_umkm); ?></textarea>
            </div>

            <button type="submit" name="update_deskripsi" class="btn btn-success">Update Deskripsi</button>
        </form>
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

<?php
// Menutup koneksi
$koneksi->close();
?>
