<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'produk_db');

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

function tambahProduk($judul, $deskripsi, $gambar, $link)
{
    global $koneksi;
    $query = "INSERT INTO produk (judul, deskripsi, gambar, link) VALUES ('$judul', '$deskripsi', '$gambar', '$link')";
    return mysqli_query($koneksi, $query);
}

function hapusProduk($id)
{
    global $koneksi;
    $query = "DELETE FROM produk WHERE id = $id";
    return mysqli_query($koneksi, $query);
}

function editProduk($id, $judul, $deskripsi, $gambar, $link)
{
    global $koneksi;
    $query = "UPDATE produk SET judul = '$judul', deskripsi = '$deskripsi', gambar = '$gambar', link = '$link' WHERE id = $id";
    return mysqli_query($koneksi, $query);
}

function getProdukById($id)
{
    global $koneksi;
    $query = "SELECT * FROM produk WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    return mysqli_fetch_assoc($result);
}
?>
