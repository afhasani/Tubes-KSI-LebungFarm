<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan host database Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "kontak_kami"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data kontak dari database
$sql = "SELECT * FROM kontak WHERE id=1"; // Asumsi hanya ada satu data kontak
$result = $conn->query($sql);
$kontak = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Kontak Kami</title>
    <link href="header.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"/>
    <style>
        .carousel {
            width: 40%;
            margin: 0 auto; /* Menempatkan slider di tengah */
        }
        .carousel-item img {
            width: 100%; /* Mengisi penuh area slider */
            height: auto; /* Menjaga rasio gambar */
        }
        .star-rating {
            color: gold;
        }
        .baris-1{
            width: 50%;
            border-bottom: 2px solid black;
            margin-bottom: 20px;
            justify-self: center;
        }
        .baris-2{
            width: 30%;
            border-bottom: 2px solid black;
            justify-self: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <header class="header-front">
        <!-- Logo Desa -->
        <img src="assets/Logo_lamsel.png" alt="Logo Desa" class="logo" width="50" />
        <!-- Logo UMKM -->
        <img src="assets/Logo_kemendes.png" alt="Logo UMKM" class="logo" width="50" />
        
        <!-- Teks Container -->
        <div class="text-container">
            <h1>LEBUNG FARM</h1>
            <p>Desa Lebung Sari</p>
        </div>
        
        <!-- Separator antara teks dan menu -->
        <div class="separator"></div>

        <!-- Hamburger Icon -->
        <div class="hamburger" onclick="toggleMenu()" aria-label="Toggle navigation menu">☰</div>
        
        <!-- Navigation Menu -->
        <nav class="menu">
            <a href="beranda.php" class="beranda">BERANDA</a>
            <a href="tentangkami.php" class="tentang-kami">TENTANG KAMI</a>
            <a href="produk.php" class="produk-layanan">PRODUK / LAYANAN</a>
            <a href="kontak_kami.php" class="kontak-kami">KONTAK KAMI</a>
        </nav>
    </header>

    <div class="container" style="margin-top: 30px; background-color: #f8f9fa; padding:50px; border-radius:10px;" id="top">
        <div class="row">
            <div class="col-md-12">
                <div class="baris-1"></div>
                <div class="baris-2"></div>
                <h4 class="text-center"><?= $kontak['judul']; ?></h4>
                <div class="teks">
                    <p><?= $kontak['deskripsi']; ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15887.13696810757!2d105.50058345!3d-5.4496896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40e3fd7df24db1%3A0x6cf95ff654956ff5!2sLebungsari%2C%20Merbau%20Mataram%2C%20South%20Lampung%20Regency%2C%20Lampung!5e0!3m2!1sen!2sid!4v1730993337138!5m2!1sen!2sid" width="100%" height="450" style="border:0; display:block; border-radius:10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-4">
                <form action="proses_kontak.php" method="POST" class="form_kontak">
                    <div class="form-group">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Anda" required>
                    </div>
                    <div class="form-group pt-3">
                        <input type="email" name="email" class="form-control" placeholder="Masukkan Email Anda" required>
                    </div>
                    <div class="form-group pt-3">
                        <textarea name="pesan" class="form-control" rows="3" placeholder="Pesan Anda" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark mt-3" style="width: 100%; bottom:0; position:relative; margin-bottom:0;">SUBMIT</button>
                </form>
            </div>
            <!-- Informasi Kontak -->
            <div class="col-md-6">
                <div class="col-md-12 mt-4 pt-2 info_kontak" style="border: 1px solid black; border-radius:10px;">
                    <img src="images/location-pin.png" style="width: 5%; display:inline;">
                    <span style="font-weight: bold; font-size:20px;">Alamat</span>
                    <p class="mt-2"><?= $kontak['alamat']; ?></p>
                </div>
                <div class="col-md-12 mt-3 pt-2 info_kontak" style="border: 1px solid black; border-radius:10px;">
                    <img src="images/telephone-call.png" style="width: 5%; display:inline;">
                    <span style="font-weight: bold; font-size:20px;">Telepon</span>
                    <p class="mt-2"><?= $kontak['telepon']; ?></p>
                </div>
                <div class="col-md-12 mt-3 pt-2 info_kontak" style="border: 1px solid black; border-radius:10px;">
                    <img src="images/email.png" style="width: 5%; display:inline;">
                    <span style="font-weight: bold; font-size:20px;">Email</span>
                    <p class="mt-2"><?= $kontak['email']; ?></p>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer-front">
        <div class="footer-content">
            <div class="footer-left">
                <h2>Inovasi Lokal,<br />Potensi Global</h2>
                <p>35357</p>
                <p>Kecamatan Merbau Mataram, Kabupaten Lampung Selatan, Lampung</p>
            </div>
            <div class="footer-right">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="#">❯ Tentang Kami</a></li>
                    <li><a href="#">❯ Produk / Layanan</a></li>
                    <li><a href="#">❯ Kontak Kami</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <div class="footer-bottom">
        <p>&copy; 2024 UMKM Lebung Sari | All rights reserved</p>
        <div class="login-container">
            <a href="login.php">
                <button class="login-button">
                <img src="assets/login.png" alt="Login Icon" class="login-icon" />
                Login
                </button>
            </a>
        </div>
    </div>
    <script>
    const hamburger = document.querySelector('.hamburger');
    const menu = document.querySelector('.menu');

    hamburger.addEventListener('click', () => {
    menu.classList.toggle('open');
    hamburger.classList.toggle('active');
    });
    </script>
</body>
</html>
