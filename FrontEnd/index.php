<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LebungFarm</title>
    <!-- Template Main CSS File -->
    <link href="style1.css" rel="stylesheet">
    <link href="Navbarmobile.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
    <link href="navbar.css" rel="stylesheet">
</head>
<body>
        <!--===== Header =====-->
        <header id="header" class="header-container">
            <div class="logo-container">
                <a href="beranda.html" class="logo"><img src="assets/Logo lamsel.jpg" alt="Logo 1"></a>
                <a href="beranda.html" class="logo"><img src="assets/Logo lamsel.jpg" alt="Logo 2"></a>
                <div class="logo-text">
                    <h1 class="main-title">LEBUNG FARM</h1>
                    <p class="sub-title">Desa Lebung Sari</p>
                </div>
            </div>
            <!-- Garis Vertikal -->
            <div class="vertical-line"></div>
            
            <!-- Tombol Burger untuk tampilan mobile -->
            <div class="mobile-nav-toggle" onclick="toggleMobileMenu()">
                ☰ <!-- karakter untuk ikon burger -->
            </div>

            <!-- Icon close untuk menu mobile (sembunyikan awalnya) -->
            <div class="mobile-nav-close" onclick="toggleMobileMenu()" style="display: none;">
                X <!-- karakter untuk ikon close -->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link active" href="beranda.html">BERANDA</a></li>
                    <li><a class="nav-link" href="tentangKami.html">TENTANG KAMI</a></li>
                    <li><a class="nav-link" href="produk.html">PRODUK/LAYANAN</a></li>
                    <li><a class="nav-link" href="kontak.html">KONTAK KAMI</a></li>
                </ul>
            </nav>
        </header>  

        <!-- Tambahkan JavaScript langsung di bawah ini atau di file script.js -->
        <script>
            function toggleMobileMenu() {
                const navbar = document.getElementById('navbar');
                navbar.classList.toggle('navbar-mobile'); // Toggle kelas 'navbar-mobile'
            }
        </script>
        <!--END HEADER-->
    <div class="card-container">
        <!-- Card 1 with Slider -->
        <div class="card">
            <div class="slider">
                <img src="assets/potensi/Peternakan/Peternakan1.png" class="slide active" alt="Peternakan 1">
                <img src="assets/potensi/Peternakan/Peternakan2.png" class="slide" alt="Peternakan 2">
                <img src="assets/potensi/Peternakan/Peternakan3.png" class="slide" alt="Peternakan 3">
                <img src="assets/potensi/Peternakan/Peternakan4.png" class="slide" alt="Peternakan 4">
                <button class="prev" onclick="prevSlide(this)">&#10094;</button>
                <button class="next" onclick="nextSlide(this)">&#10095;</button>
            </div>
            <div class="card-title">PETERNAKAN</div>
        </div>
        
        <!-- Card 2 with Slider -->
        <div class="card">
            <div class="slider">
                <img src="assets/potensi/Pertanian/Pertanian1.png" class="slide active" alt="PERTANIAN 1">
                <img src="assets/potensi/Pertanian/Pertanian2.png" class="slide" alt="PERTANIAN 2">
                <img src="assets/potensi/Pertanian/Pertanian3.png" class="slide" alt="PERTANIAN 3">
                <img src="assets/potensi/Pertanian/Pertanian4.png" class="slide" alt="PERTANIAN 4">
                <button class="prev" onclick="prevSlide(this)">&#10094;</button>
                <button class="next" onclick="nextSlide(this)">&#10095;</button>
            </div>
            <div class="card-title">PERTANIAN</div>
        </div>
    </div>

    <script src="script.js"></script>

    <section class="featured-products">
        <div class="text-content">
            <h2>Produk Unggulan Desa Lebung Sari</h2>
            <p>Produk unggulan dari Desa Lebung Sari dihasilkan melalui keahlian masyarakat lokal dan proses yang dijaga dengan baik. Setiap tahapan pembuatan dilakukan dengan cermat untuk menghasilkan Opak Singkong yang berkualitas dan autentik, memadukan cita rasa khas dengan kepuasan pelanggan.</p>
        </div>
        <div class="unggulan-gallery">
            <div class="unggulan-card large">
                <img src="assets/ProdukUnggulan/Unggul1.png" alt="Opak Singkong">
                
                <div class="unggulan-label">Produk Unggulan Opak Singkong</div>
            </div>
            <div class="unggulan-card ">
                <img src="assets/ProdukUnggulan/Unggul2.png" alt="Proses Pencetakan">
                
                <div class="unggulan-label">Proses Pencetakan</div>
            </div>
            <div class="unggulan-card">
                <img src="assets/ProdukUnggulan/Unggul3.png" alt="Proses Penjemuran">
                
                <div class="unggulan-label">Proses Penjemuran</div>
            </div>
        </div>
    </section>
    <div class="background">
        <div class="container">
            <div class="info-card">
                <h2>DESA LEBUNG SARI</h2>
                <p>Desa Lebung Sari merupakan sebuah Desa yang terletak di Kecamatan Lebung Sari Kabupaten Lampung Selatan yang dibentuk pada 09 Juli 1986 dan pejabat sementara adalah Sutarto. Desa Lebung Sari menjadi definitif pada tanggal 14 November 1991...</p>
            </div>
            <div class="info-card">
                <h2>UMKM DESA LEBUNG SARI</h2>
                <p>UMKM Desa Lebung Sari mencakup berbagai usaha mikro dan kecil yang bergerak di sektor pertanian dan peternakan. Masyarakat setempat berperan aktif dalam mengembangkan potensi desa melalui berbagai usaha produktif...</p>
            </div>
        </div>
    </div>
    <div class="favorit-section">
        <h2>Produk Favorit Desa Lebung Sari</h2>
        <p>Rengginang dari Desa Lebung Sari dihasilkan melalui keahlian masyarakat lokal dan proses yang dijaga dengan baik. Setiap tahapan pembuatan dilakukan dengan cermat untuk menghasilkan Rengginang berkualitas yang khas dan autentik.</p>
        
        <div class="favorit-gallery">
            <div class="favorit-card">
                <img src="assets/ProdukFav/fav1.png" alt="Proses Pencetakan">
                <div class="favorit-label">Proses Pencetakan</div>
            </div>
            <div class="favorit-card">
                <img src="assets/ProdukFav/fav2.png" alt="Proses Penjemuran">
                <div class="favorit-label">Proses Penjemuran</div>
            </div>
            <div class="favorit-card large">
                <img src="assets/ProdukFav/fav3.png" alt="Produk Favorit Rengginang">
                <div class="favorit-label">Produk Favorit Rengginang</div>
            </div>
        </div>
    </div>    

<!-- Footer Section -->
<footer class="footer">
    <div class="footer-content">
        <div class="footer-left">
            <h3>Inovasi Lokal,<br>Potensi Global</h3>
            <p>35357</p>
            <p>Kecamatan Merbau Mataram, Kabupaten Lampung Selatan, Lampung</p>
        </div>
        <div class="footer-right">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="tentangKami.html">Tentang Kami</a></li>
                <li><a href="produk.html">Produk / Layanan</a></li>
                <li><a href="kontak.html">Kontak Kami</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>Copyright © 2024 UMKM Lebung Sari | All rights reserved.</p>
        <a href="../login.php"><button class="login-button">Login</button></a>
    </div>
</footer>

</body>
</html>
