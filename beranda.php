<?php 
// Koneksi ke database monitoring_db
$connection = new mysqli("localhost", "root", "", "monitoring_db");
$koneksi = new mysqli("localhost", "root", "", "slider_pp");
$conn = new mysqli("localhost", "root", "", "deskripsi_desa");
$konek = new mysqli("localhost", "root", "", "produk_beranda");

if ($connection->connect_error) {
   die("Koneksi gagal: " . $connection->connect_error);
}
if ($koneksi->connect_error) {
   die("Koneksi gagal: " . $koneksi->connect_error);
}
// Cek koneksi
if ($conn->connect_error) {
   die("Koneksi gagal: " . $conn->connect_error);
}
if ($konek->connect_error) {
   die("Koneksi gagal: " . $konek->connect_error);
}



$sql_deskripsi_unggulan = "SELECT deskripsi FROM deskripsi WHERE kategori = 'unggulan' LIMIT 1";
$result_deskripsi_unggulan = $konek->query($sql_deskripsi_unggulan);
$deskripsi_unggulan = "";
if ($result_deskripsi_unggulan->num_rows > 0) {
    $row = $result_deskripsi_unggulan->fetch_assoc();
    $deskripsi_unggulan = $row['deskripsi'];
}

// Query untuk mengambil deskripsi produk favorit
$sql_deskripsi_favorit = "SELECT deskripsi FROM deskripsi WHERE kategori = 'favorit' LIMIT 1";
$result_deskripsi_favorit = $konek->query($sql_deskripsi_favorit);
$deskripsi_favorit = "";
if ($result_deskripsi_favorit->num_rows > 0) {
    $row = $result_deskripsi_favorit->fetch_assoc();
    $deskripsi_favorit = $row['deskripsi'];
}

// Query untuk mengambil data produk unggulan
$sql_produk_unggulan = "SELECT gambar, caption FROM produk_beranda WHERE kategori = 'unggulan' ORDER BY id ASC";
$result_produk_unggulan = $konek->query($sql_produk_unggulan);
$produk_unggulan = [];
if ($result_produk_unggulan->num_rows > 0) {
    while ($row = $result_produk_unggulan->fetch_assoc()) {
        $produk_unggulan[] = [
            'gambar' => $row['gambar'],
            'caption' => $row['caption']
        ];
    }
}

// Query untuk mengambil data produk favorit
$sql_produk_favorit = "SELECT gambar, caption FROM produk_beranda WHERE kategori = 'favorit' ORDER BY id ASC";
$result_produk_favorit = $konek->query($sql_produk_favorit);
$produk_favorit = [];
if ($result_produk_favorit->num_rows > 0) {
    while ($row = $result_produk_favorit->fetch_assoc()) {
        $produk_favorit[] = [
            'gambar' => $row['gambar'],
            'caption' => $row['caption']
        ];
    }
}


$query = "SELECT deskripsi_desa, deskripsi_umkm FROM deskripsi WHERE id=1";
$result = $conn->query($query);
$row = $result->fetch_assoc();

$deskripsi_desa = $row['deskripsi_desa'] ?? 'Deskripsi Desa tidak tersedia.';
$deskripsi_umkm = $row['deskripsi_umkm'] ?? 'Deskripsi UMKM tidak tersedia.';



if (!isset($_COOKIE['visited'])) {

   setcookie("visited", "yes", time() + (86400), "/");

   $today = date("Y-m-d");
   $sql = "INSERT INTO kunjungan (tanggal, jumlah) VALUES ('$today', 1) 
            ON DUPLICATE KEY UPDATE jumlah = jumlah + 1";
   $connection->query($sql);
}

$sliderList1 = [];
$query_pertanian = "SELECT image_url FROM sliders WHERE slider_group = 1";
$result_pertanian = $koneksi->query($query_pertanian);

if ($result_pertanian->num_rows > 0) {
    while ($row = $result_pertanian->fetch_assoc()) {
        $sliderList1[] = $row;
    }
}


$sliderList2 = [];
$query_peternakan = "SELECT image_url FROM sliders WHERE slider_group = 2";
$result_peternakan = $koneksi->query($query_peternakan);

if ($result_peternakan->num_rows > 0) {
    while ($row = $result_peternakan->fetch_assoc()) {
        $sliderList2[] = $row;
    }
}

$conn->close();
$konek->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Web Page</title>
   <link href="beranda.css" rel="stylesheet">
   <link href="header.css" rel="stylesheet">
   <link href="footer.css" rel="stylesheet">
   <style>
      .footer-bottom{
         width: 100%;
         padding: 18px 0;
      }
      .footer-front{
         width: 100%;
         padding: 0;
      }
      @media (max-width: 477px) {
      .footer-content {
         padding: 0 30px;
      }
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
   <div class="welcome" id="top">
    <video autoplay loop muted playsinline>
     <source src="assets/video.mp4" type="video/mp4">
     Your browser does not support this video.
    </video>
    <h1>Selamat Datang Di Website Desa Lebung Sari</h1>
  </div>

  <div class="card-sliders" style="margin-bottom: 100px;">
    <div class="card-slider-container">
        <div class="card-slider" id="slider-left">
            <div class="slider-content">
            <?php foreach ($sliderList1 as $slider): ?>
               <?php if (isset($slider['image_url'])): ?>
                  <img src="<?php echo htmlspecialchars($slider['image_url']); ?>" />
               <?php else: ?>
                  <p>Gambar tidak ditemukan.</p>
               <?php endif; ?>
            <?php endforeach; ?>

            </div>
            <!-- Tombol Navigasi Kiri -->
            <button class="nav-button left-button">&lt;</button>
            <!-- Tombol Navigasi Kanan -->
            <button class="nav-button right-button">&gt;</button>
        </div>
        <div class="label">PERTANIAN</div>
    </div>

    <div class="card-slider-container">
        <div class="card-slider" id="slider-right">
            <div class="slider-content">
                <?php foreach ($sliderList2 as $slider): ?>
                    <img src="<?php echo htmlspecialchars($slider['image_url']); ?>" alt="Peternakan Image" />
                <?php endforeach; ?>
            </div>
            <!-- Tombol Navigasi Kiri -->
            <button class="nav-button left-button">&lt;</button>
            <!-- Tombol Navigasi Kanan -->
            <button class="nav-button right-button">&gt;</button>
        </div>
        <div class="label">PETERNAKAN</div>
    </div>
</div>



  <!-- Product Section -->
  <div class="product-section">
    <div class="product-title">
       Produk Unggulan Desa Lebung Sari
    </div>
    <div class="product-description">
       <?php echo $deskripsi_unggulan; ?>
    </div>
    <div class="product-gallery">
        <?php
        // Menampilkan gambar utama dan caption produk unggulan
        if (isset($produk_unggulan[0])) {
            echo '
            <div class="product-image-item product-large-image">
                <img alt="Produk Unggulan" src="produk_beranda/' . $produk_unggulan[0]['gambar'] . '"/>
                <div class="product-caption" style="margin-bottom: 10px;">
                    ' . $produk_unggulan[0]['caption'] . '
                </div>
            </div>';
        }

        // Menampilkan gambar-gambar kecil dan caption produk unggulan
        if (count($produk_unggulan) > 1) {
            echo '<div class="product-small-images">';
            foreach ($produk_unggulan as $key => $produk) {
                if ($key > 0) { // Mulai dari indeks 1 untuk gambar kecil
                    echo '
                    <div class="product-image-item product-small-image">
                        <img alt="' . $produk['caption'] . '" src="produk_beranda/' . $produk['gambar'] . '"/>
                        <div class="product-caption">
                            ' . $produk['caption'] . '
                        </div>
                    </div>';
                }
            }
            echo '</div>';
        }
        ?>
    </div>
 </div>


  <!-- Desa Lebung Sari and UMKM Desa Lebung Sari Info Section -->
  <div class="info-container">
        <div class="info-box">
            <h2>DESA LEBUNG SARI</h2>
            <p><?php echo htmlspecialchars($deskripsi_desa); ?></p>
        </div>
        <div class="info-box">
            <h2>UMKM DESA LEBUNG SARI</h2>
            <p><?php echo htmlspecialchars($deskripsi_umkm); ?></p>
        </div>
  </div>

  <div class="product-section">
    <div class="product-title">
       Produk Favorit Desa Lebung Sari
    </div>
    <div class="product-description">
       <?php echo $deskripsi_favorit; ?>
    </div>
    <div class="product-gallery">
        <?php
        // Menampilkan gambar utama dan caption produk favorit
        if (isset($produk_favorit[0])) {
            echo '
            <div class="product-image-item product-large-image">
                <img alt="Produk Favorit" src="produk_beranda/' . $produk_favorit[0]['gambar'] . '"/>
                <div class="product-caption" style="margin-bottom: 10px;">
                    ' . $produk_favorit[0]['caption'] . '
                </div>
            </div>';
        }

        // Menampilkan gambar-gambar kecil dan caption produk favorit
        if (count($produk_favorit) > 1) {
            echo '<div class="product-small-images">';
            foreach ($produk_favorit as $key => $produk) {
                if ($key > 0) { // Mulai dari indeks 1 untuk gambar kecil
                    echo '
                    <div class="product-image-item product-small-image">
                        <img alt="' . $produk['caption'] . '" src="produk_beranda/' . $produk['gambar'] . '"/>
                        <div class="product-caption">
                            ' . $produk['caption'] . '
                        </div>
                    </div>';
                }
            }
            echo '</div>';
        }
        ?>
    </div>
 </div>
   <footer class="footer-front">
      <div class="footer-content">
         <div class="footer-left">
            <h2>Inovasi Lokal,<br />Potensi Global</h2>
            <p style="color: white;">35357</p>
            <p style="color: white;">Kecamatan Merbau Mataram, Kabupaten Lampung Selatan, Lampung</p>
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
         <p style="color: white;">&copy; 2024 UMKM Lebung Sari | All rights reserved</p>
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
   <script src="script1.js"></script>
   <div id="footer"></div>
   <script src="beranda_slider.js"></script>
</body>
</html>