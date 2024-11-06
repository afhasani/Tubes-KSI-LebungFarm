<?php
include 'produk_db.php'; // Menghubungkan dengan database produk

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $link = $_POST['link'];

    // Mengambil file gambar yang diupload
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "images/"; // Folder untuk menyimpan gambar
    $target_file = $target_dir . basename($gambar);

    // Memindahkan file gambar ke folder images
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
        // Gambar berhasil diupload, sekarang simpan data produk ke database
        $sql = "INSERT INTO produk (judul, deskripsi, gambar, link) VALUES ('$judul', '$deskripsi', '$gambar', '$link')";
        if (mysqli_query($koneksi, $sql)) {
            echo "Produk berhasil ditambahkan.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
        }
    } else {
        echo "Maaf, terjadi kesalahan saat mengupload gambar.";
    }
}
?>
