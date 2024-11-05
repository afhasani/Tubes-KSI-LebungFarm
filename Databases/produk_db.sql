CREATE TABLE IF NOT EXISTS `produk` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `judul` VARCHAR(255) NOT NULL,
    `deskripsi` TEXT NOT NULL,
    `gambar` VARCHAR(255) NOT NULL,
    `link` VARCHAR(255) NOT NULL,
    'rating' INT NOT NULL,
    'nama_pemilik' VARCHAR(255) NOT NULL,
    'no_telepon' VARCHAR(50) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
