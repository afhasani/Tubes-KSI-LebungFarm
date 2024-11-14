<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'produk_db');

// Fungsi untuk menampilkan produk yang sudah ada
function tampilkanProduk()
{
    global $koneksi;
    $query = "SELECT * FROM produk";
    $result = mysqli_query($koneksi, $query);
    $produkList = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $produkList[] = $row;
    }
    return $produkList;
}

// Fungsi untuk menambah produk
function tambahProduk($judul, $deskripsi, $gambar, $link, $rating, $nama_pemilik, $no_telepon)
{
    global $koneksi;
    $query = "INSERT INTO produk (judul, deskripsi, gambar, link, rating, nama_pemilik, no_telepon) 
                VALUES ('$judul', '$deskripsi', '$gambar', '$link', $rating, '$nama_pemilik', '$no_telepon')";
    return mysqli_query($koneksi, $query);
}

// Fungsi untuk menghapus produk
function hapusProduk($id)
{
    global $koneksi;
    $query = "SELECT gambar FROM produk WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $gambar = $row['gambar'];
        $filePath = "images/" . $gambar;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    $query = "DELETE FROM produk WHERE id = $id";
    return mysqli_query($koneksi, $query);
}

// Fungsi untuk mengedit produk
function editProduk($id, $judul, $deskripsi, $gambar, $link, $rating, $nama_pemilik, $no_telepon)
{
    global $koneksi;
    $query = "UPDATE produk 
                SET judul = '$judul', deskripsi = '$deskripsi', gambar = '$gambar', link = '$link', 
                    rating = $rating, nama_pemilik = '$nama_pemilik', no_telepon = '$no_telepon' 
                WHERE id = $id";
    return mysqli_query($koneksi, $query);
}

// Fungsi untuk mendapatkan produk berdasarkan ID
function getProdukById($id)
{
    global $koneksi;
    $query = "SELECT * FROM produk WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    return mysqli_fetch_assoc($result);
}

// Fungsi untuk menampilkan ulasan produk
function tampilkanUlasan()
{
    global $koneksi;
    $query = "SELECT * FROM ulasan_produk";
    $result = mysqli_query($koneksi, $query);
    $ulasanList = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $ulasanList[] = $row;
    }
    return $ulasanList;
}

// Fungsi untuk menambah ulasan
function tambahUlasan($nama_produk, $nama_pengulas, $status, $ulasan, $rating)
{
    global $koneksi;
    $query = "INSERT INTO ulasan_produk (nama_produk, nama_pengulas, status, ulasan, rating) 
                VALUES ('$nama_produk', '$nama_pengulas', '$status', '$ulasan', $rating)";
    return mysqli_query($koneksi, $query);
}

// Fungsi untuk mengedit ulasan
function editUlasan($id, $nama_produk, $nama_pengulas, $status, $ulasan, $rating)
{
    global $koneksi;
    $query = "UPDATE ulasan_produk 
                SET nama_produk = '$nama_produk', nama_pengulas = '$nama_pengulas', status = '$status', 
                    ulasan = '$ulasan', rating = $rating 
                WHERE id = $id";
    return mysqli_query($koneksi, $query);
}

// Fungsi untuk menghapus ulasan
function hapusUlasan($id)
{
    global $koneksi;
    $query = "DELETE FROM ulasan_produk WHERE id = $id";
    return mysqli_query($koneksi, $query);
}

// Fungsi untuk mendapatkan ulasan berdasarkan ID
function getUlasanById($id)
{
    global $koneksi;
    $query = "SELECT * FROM ulasan_produk WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    return mysqli_fetch_assoc($result);
}
?>
