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

// Memeriksa apakah data gambar telah diupload dan caption diubah
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['gambar']) && isset($_POST['produk_id']) && isset($_POST['caption'])) {
        $produk_id = $_POST['produk_id'];
        $gambar_baru = $_FILES['gambar']['name'];
        $caption_baru = $_POST['caption'];

        // Query untuk mengambil gambar lama berdasarkan produk_id
        $gambar_lama_query = "SELECT gambar FROM produk_beranda WHERE id = $produk_id";
        $result = $conn->query($gambar_lama_query);

        if ($result && $result->num_rows > 0) {
            // Ambil nama gambar lama
            $row = $result->fetch_assoc();
            $gambar_lama = $row['gambar'];

            // Hapus gambar lama dari folder produk_beranda
            $path_gambar_lama = 'produk_beranda/' . $gambar_lama;
            if (file_exists($path_gambar_lama)) {
                unlink($path_gambar_lama);  // Menghapus gambar lama
            }

            // Menyimpan gambar baru ke folder produk_beranda
            $path_gambar_baru = 'produk_beranda/' . $gambar_baru;
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $path_gambar_baru)) {
                // Update gambar dan caption di database
                $update_query = "UPDATE produk_beranda SET gambar = '$gambar_baru', caption = '$caption_baru' WHERE id = $produk_id";
                if ($conn->query($update_query) === TRUE) {
                    // Redirect ke halaman admin dashboard setelah berhasil
                    header("Location: adm_dsh_ProdukBeranda.php");
                    exit();  // Pastikan script tidak lanjut setelah redirect
                } else {
                    echo "Gagal memperbarui data gambar dan caption.";
                }
            } else {
                echo "Gagal mengunggah gambar baru.";
            }
        } else {
            echo "Produk tidak ditemukan.";
        }
    } else {
        echo "Data tidak lengkap.";
    }
} else {
    echo "Metode permintaan tidak valid.";
}

// Tutup koneksi database
$conn->close();
?>
