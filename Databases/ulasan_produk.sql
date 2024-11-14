CREATE TABLE ulasan_produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(255) NOT NULL,
    nama_pengulas VARCHAR(255) NOT NULL,
    ulasan TEXT NOT NULL,
    status ENUM('Pelanggan', 'Admin', 'Pengunjung') NOT NULL,
    rating INT NOT NULL CHECK (rating BETWEEN 1 AND 5)
);
