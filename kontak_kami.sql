CREATE TABLE kontak (
    id INT AUTO_INCREMENT PRIMARY KEY,    -- ID sebagai identifier unik
    judul VARCHAR(255) NOT NULL,          -- Judul kontak
    deskripsi TEXT NOT NULL,              -- Deskripsi kontak
    alamat TEXT NOT NULL,                 -- Alamat kontak
    telepon VARCHAR(20) NOT NULL,         -- Nomor telepon
    email VARCHAR(100) NOT NULL           -- Alamat email
);

INSERT INTO kontak (judul, deskripsi, alamat, telepon, email) 
VALUES 
    ('KONTAK KAMI', 'Lihat di bawah untuk mendapatkan detail alamat, informasi kontak, dan lokasi kami di peta agar Anda dapat menjangkau kami dengan mudah', 
        'Kecamatan Merbau Mataram, Kabupaten Lampung Selatan, Provinsi Lampung, Indonesia 35537', 
        '+62 812-3456-7890 (Budi Santoso)', 
        'budisantoso@example.com');
