-- Membuat tabel gambar_caption
CREATE TABLE produk_beranda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kategori VARCHAR(50) NOT NULL,
    gambar VARCHAR(255) NOT NULL,
    caption VARCHAR(255) NOT NULL
);

-- Menambahkan data produk unggulan
INSERT INTO produk_beranda (kategori, gambar, caption) 
VALUES 
('unggulan', 'produkunggulan1.png', 'Produk Unggulan Opak Singkong'),
('unggulan', 'produkunggulan2.png', 'Proses Pencetakan'),
('unggulan', 'produkunggulan3.png', 'Proses Penjemuran'),
('favorit', 'produkfavorit1.png', 'Proses Pencetakan'),
('favorit', 'produkfavorit2.png', 'Proses Penjemuran'),
('favorit', 'produkfavorit3.png', 'Produk Favorit Rengginang');

-- Membuat tabel deskripsi
CREATE TABLE deskripsi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kategori VARCHAR(50) NOT NULL,
    deskripsi TEXT NOT NULL
);

-- Menambahkan deskripsi produk unggulan dan favorit
INSERT INTO deskripsi (kategori, deskripsi) 
VALUES 
('unggulan', 'Produk unggulan dari Desa Lebung Sari dihasilkan melalui keahlian masyarakat lokal dan proses yang dijaga dengan baik. Setiap tahapan pembuatan dilakukan dengan cermat untuk menghasilkan Opak Singkong yang berkualitas dan autentik, memadukan cita rasa khas dengan kepuasan pelanggan.'),
('favorit', 'Rengginang dari Desa Lebung Sari dihasilkan melalui keahlian masyarakat lokal dan proses yang dijaga dengan baik. Setiap tahapan pembuatan dilakukan dengan cermat untuk menghasilkan Rengginang berkualitas yang khas dan autentik.');
