CREATE TABLE deskripsi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    deskripsi_desa TEXT NOT NULL,
    deskripsi_umkm TEXT NOT NULL
);

-- Menambahkan data awal untuk deskripsi
INSERT INTO deskripsi (deskripsi_desa, deskripsi_umkm) VALUES 
(
    'Desa Lebung Sari merupakan sebuah Desa yang terletak di Kecamatan Lebung Sari Kabupaten Lampung Selatan yang dibentuk pada 09 Juli 1986 dan pejabat sementara adalah Sutarjo. Desa Lebung Sari menjadi difinitif pada tanggal 14 November 1991, dengan Jumlah KK 427 dan luas wilayah 4 390,6607 Ha. Batas wilayah Lebung Sari sebelah utara desa Snar Karya, sebelah selatan desa Mekar Sari, sebelah timur desa Puji Rahayu, sebelah barat desa Talangjawa, Daerah Kabupaten Lampung Selatan merupakan daerah tropis yang dimana sangat cocok bagi warga untuk berkebun atau bercocok tanam. Kondisi masyarakat, lembaga sosial dan aparatur desa sangat membantu untuk bisa menjadi desa yang maju.',
    'UMKM Desa Lebung Sari mencakup berbagai usaha mikro dan kecil yang bergerak di sektor pertanian dan peternakan. Masyarakat setempat berperan aktif dalam mengembangkan potensi desa melalui berbagai usaha produktif. Dukungan dari pemerintah desa dan lembaga sosial turut mendorong pertumbuhan UMKM untuk terus berinovasi, meningkatkan kualitas produk, dan memperluas akses pasar. Keberlanjutan dan kolaborasi antara masyarakat dan pemerintah desa menjadi kunci keberhasilan UMKM di Desa Lebung Sari. Melalui pengelolaan yang baik, UMKM di desa ini dapat terus berkontribusi pada peningkatan ekonomi lokal. Upaya tersebut menjadikan Desa Lebung Sari sebagai desa yang produktif dan inovatif.'
);
