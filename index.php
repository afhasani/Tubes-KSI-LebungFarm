<?php
include 'produk_db.php'; // Menghubungkan dengan database produk

// Mendapatkan daftar produk dari database
$produkList = tampilkanProduk();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama Produk</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <!-- Tombol Login -->
    <div class="text-right mb-4">
        <a href="login.php" class="btn btn-secondary">Login</a>
    </div>
    
    <h1 class="text-center mb-4">Produk Kami</h1>
    <div class="row">
        <?php foreach ($produkList as $produk): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="images/<?php echo $produk['gambar']; ?>" class="card-img-top" alt="<?php echo $produk['judul']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $produk['judul']; ?></h5>
                        <p class="card-text"><?php echo $produk['deskripsi']; ?></p>
                        <a href="<?php echo $produk['link']; ?>" class="btn btn-primary" target="_blank">Lihat Produk</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
