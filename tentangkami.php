<?php
include 'tentangkami_db.php';

$conn1 = new mysqli("localhost", "root", "", "sejarahdesa_db");
$conn2 = new mysqli("localhost", "root", "", "kepala_desa");
$conn3 = new mysqli("localhost", "root", "", "visimisi_db");

if ($conn1->connect_error || $conn2->connect_error || $conn3->connect_error) {
    die("Koneksi gagal: " . $conn1->connect_error);
}

// Mendapatkan daftar produk dari database
$sejarahDesa = getDeskripsiSejarah();
$nama_kepala_desa = getNamaKepalaDesa();
$visiMisi = getVisiMisiDesa();

// Mendapatkan daftar slider dari database
$namaKepalaDesa = [];
$tahunPemerintahan = [];
$visiMisi = '';

$result = $conn2->query("SELECT nama, tahun FROM kepala_desa");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Menambahkan nama dan tahun ke dalam array
        if (isset($row['nama']) && isset($row['tahun']) && is_string($row['nama'])) {
            $namaKepalaDesa[] = $row['nama']; // Menambahkan nama ke dalam array
            $tahunPemerintahan[] = $row['tahun']; // Menambahkan tahun ke dalam array
        }
    }
}

$result = $conn3->query("SELECT visi_misi FROM visimisi_db LIMIT 1");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $visiMisi = $row['visi_misi'];  // Pastikan ini adalah string
}

$conn1->close();
$conn2->close();
$conn3->close();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sejarah Desa Lebung Sari</title>
    <link href="tentangkami.css" rel="stylesheet">
    <link href="header.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet"> 
</head>
<body>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
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
    <div class="container" style="margin-top: 30px;" id="top">
        <div class="container1"> 
        <h1 style="z-index: 10;">SEJARAH DESA LEBUNG SARI</h1>
        <hr>
        <p class="text-justify" style="z-index: 10;">
            <?php echo $sejarahDesa; ?>
        </p>
        <div class="table-container" style="z-index: 10;">
            <h1>Nama-Nama Kepala Desa / PJS Desa Lebung Sari</h1>
            <table>
                <tr>
                    <th><p>No</p></th>
                    <th>Nama Kepala Desa</th>
                    <th>Tahun Pemerintahan</th>
                </tr>
                <tbody>
                <?php
                if (count($namaKepalaDesa) > 0) {
                    foreach ($namaKepalaDesa as $index => $nama) {
                        // Pastikan kita menampilkan tahun yang sesuai
                        $tahun = isset($tahunPemerintahan[$index]) ? $tahunPemerintahan[$index] : "Tahun tidak tersedia"; // Cek jika tahun ada
                        echo "<tr>
                                <td>" . ($index + 1) . "</td>
                                <td>" . htmlspecialchars($nama) . "</td>
                                <td>" . htmlspecialchars($tahun) . "</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>Data kepala desa tidak ditemukan.</td></tr>";
                }
                ?>
            </tbody>
            </table>
        </div>
    </div>
    </div>
    <div class="content-all">
    <div class="content">
        <div class="head">
            <h2>VISI DAN MISI</h2>
            <h2>DESA LEBUNG SARI</h2>
            <hr>
        </div>
        <div class="visi">
            <div class="visi-title" style="z-index: 200; position: relative;">VISI</div>
            <p style="z-index: 200; position: relative;">"Terwujudnya Masyarakat Desa Lebung Sari Yang Berakhlak Mulia, Sehat, Cerdas, Mandiri dan Sejahtera"</p>
        </div>
        <div class="misi">
            <div class="misi-title" style="z-index: 200;">MISI</div>
            <div class="misi-content">
                <div class="misi-item">
                    <h3 style="height: 60px; z-index: 200;">Mewujudkan Pemerintahan Desa yang Tertib dan Berwibawa</h3>
                    <ul style="margin-top: 30px; border-top: 1px solid black; padding-top: 20px; z-index: 200;">
                        <li>Terwujudnya Kegiatan Pemerintahan Desa Lebung Sari tertib & lancar</li>
                        <li>Terwujudnya tata perencanaan Desa yang lebih baik</li>
                    </ul>
                </div>
                <div class="misi-item">
                    <h3 style="height: 60px; z-index: 200; ">Mewujudkan Sarana Prasarana Desa yang Memadai</h3>
                    <ul style="margin-top: 30px;  border-top: 1px solid black;  padding-top: 20px; z-index: 200;">
                        <li>Terwujudnya sarana jalan desa yang dapat mendukung perekonomian Desa</li>
                        <li>Terwujudnya sarana sanitasi lingkungan Desa yang baik</li>
                    </ul>
                </div>
                <div class="misi-item">
                    <h3 style="height: 60px; z-index: 200;">Mewujudkan Perekonomian dan Kesejahteraan Warga</h3>
                    <ul style="margin-top: 30px;  border-top: 1px solid black;  padding-top: 20px; z-index: 200;">
                        <li>Meningkatkan usaha ekonomi produktif warga Desa</li>
                        <li>Meningkatkan sistem ketertiban dan keamanan Masyarakat</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="content1 bg-blue-800 p-5 flex flex-col items-center mb-5">
        <div class="title text-white text-2xl mb-5" style="font-size:30px; font-family:'roboto'; font-weight: bold; text-align: left; margin-top: 10px; margin-bottom: 30px;">
          PEMERINTAHAN DESA LEBUNG SARI
        </div>
         <div class="slider">
          <div class="profiles" id="profiles1">
           <div class="profile">
            <img alt="Portrait of Kepala Desa Komariah" height="200" src="https://storage.googleapis.com/a1aa/image/fgeP46RAv3p6RkGuyvFZrLHsEFIlOffuX7BfCIpyq0QyFF8dC.jpg" width="200"/>
            <div class="position">
             <span>
              KEPALA DESA
             </span>
            </div>
            <div class="name">
             KOMARIAH
            </div>
           </div>
           <div class="profile">
            <img alt="Portrait of Sekretaris Desa Sulastri" height="200" src="https://storage.googleapis.com/a1aa/image/nvRwZj5aPRqgENnuS7YSKMm3nydY1izvec1MtsBroWDZUw3JA.jpg" width="200"/>
            <div class="position">
             <span>
              SEKRETARIS DESA
             </span>
            </div>
            <div class="name">
             SULASTRI
            </div>
           </div>
           <div class="profile">
            <img alt="Portrait of Kepala Urusan Tata Usaha Katiran" height="200" src="https://storage.googleapis.com/a1aa/image/TvGTdfFoXq3qAayp32QYWKDTsAlxDoIJazFhnY0UkN2YUw3JA.jpg" width="200"/>
            <div class="position">
             <span>
              KEPALA URUSAN TATA USAHA
             </span>
            </div>
            <div class="name">
             KATIRAN
            </div>
           </div>
           <div class="profile">
            <img alt="Portrait of Kepala Urusan Keuangan Didit Maryanto" height="200" src="https://storage.googleapis.com/a1aa/image/ljdu23Eqqg4EDJcZex6oeR0xeVCae0VXueJHqokkfPIZNK47E.jpg" width="200"/>
            <div class="position">
             <span>
              KEPALA URUSAN KEUANGAN
             </span>
            </div>
            <div class="name">
             DIDIT MARYANTO
            </div>
           </div>
           <div class="profile">
            <img alt="Portrait of Kepala Urusan Perencanaan Agus Sugiarto" height="200" src="https://storage.googleapis.com/a1aa/image/JzCvWPVew7RwJKZXW4s7enZLT1XN0SNPqXMfb1rNscfRjCedC.jpg" width="200"/>
            <div class="position">
             <span>
              KEPALA URUSAN PERENCANAAN
             </span>
            </div>
            <div class="name">
             AGUS SUGIARTO
            </div>
           </div>
           <div class="profile">
            <img alt="Portrait of Kepala Urusan Pemerintahan Berwin Eli Albert" height="200" src="https://storage.googleapis.com/a1aa/image/gjzEpbqF745RDtzptZdU0mNFDDeKJ2VY1d4oI9dCQe8wogvTA.jpg" width="200"/>
            <div class="position">
             <span>
              KEPALA URUSAN PEMERINTAHAN
             </span>
            </div>
            <div class="name">
             BERWIN ELI ALBERT
            </div>
           </div>
          </div>
         </div>
        </div>
        <div class="content2 bg-red-800 p-5 flex flex-col items-center mb-5">
         <div class="title text-white text-2xl mb-5" style="font-size:30px; font-family:'roboto';font-weight: bold; text-align: left; margin-top: 10px; margin-bottom: 30px;">
          SEKTOR PERTANIAN DESA LEBUNG SARI
         </div>
         <div class="slider">
          <div class="profiles" id="profiles2">
           <div class="profile">
            <img alt="Portrait of Kepala Desa Komariah" height="200" src="https://storage.googleapis.com/a1aa/image/fgeP46RAv3p6RkGuyvFZrLHsEFIlOffuX7BfCIpyq0QyFF8dC.jpg" width="200"/>
            <div class="position">
             <span>
              KEPALA DESA
             </span>
            </div>
            <div class="name">
             KOMARIAH
            </div>
           </div>
           <div class="profile">
            <img alt="Portrait of Sekretaris Desa Sulastri" height="200" src="https://storage.googleapis.com/a1aa/image/nvRwZj5aPRqgENnuS7YSKMm3nydY1izvec1MtsBroWDZUw3JA.jpg" width="200"/>
            <div class="position">
             <span>
              SEKRETARIS DESA
             </span>
            </div>
            <div class="name">
             SULASTRI
            </div>
           </div>
           <div class="profile">
            <img alt="Portrait of Kepala Urusan Tata Usaha Katiran" height="200" src="https://storage.googleapis.com/a1aa/image/TvGTdfFoXq3qAayp32QYWKDTsAlxDoIJazFhnY0UkN2YUw3JA.jpg" width="200"/>
            <div class="position">
             <span>
              KEPALA URUSAN TATA USAHA
             </span>
            </div>
            <div class="name">
             KATIRAN
            </div>
           </div>
           <div class="profile">
            <img alt="Portrait of Kepala Urusan Keuangan Didit Maryanto" height="200" src="https://storage.googleapis.com/a1aa/image/ljdu23Eqqg4EDJcZex6oeR0xeVCae0VXueJHqokkfPIZNK47E.jpg" width="200"/>
            <div class="position">
             <span>
              KEPALA URUSAN KEUANGAN
             </span>
            </div>
            <div class="name">
             DIDIT MARYANTO
            </div>
           </div>
           <div class="profile">
            <img alt="Portrait of Kepala Urusan Perencanaan Agus Sugiarto" height="200" src="https://storage.googleapis.com/a1aa/image/JzCvWPVew7RwJKZXW4s7enZLT1XN0SNPqXMfb1rNscfRjCedC.jpg" width="200"/>
            <div class="position">
             <span>
              KEPALA URUSAN PERENCANAAN
             </span>
            </div>
            <div class="name">
             AGUS SUGIARTO
            </div>
           </div>
           <div class="profile">
            <img alt="Portrait of Kepala Urusan Pemerintahan Berwin Eli Albert" height="200" src="https://storage.googleapis.com/a1aa/image/gjzEpbqF745RDtzptZdU0mNFDDeKJ2VY1d4oI9dCQe8wogvTA.jpg" width="200"/>
            <div class="position">
             <span>
              KEPALA URUSAN PEMERINTAHAN
             </span>
            </div>
            <div class="name">
             BERWIN ELI ALBERT
            </div>
           </div>
          </div>
         </div>
        </div>
        <div class="content3 bg-blue-800 p-5 flex flex-col items-center mb-5">
        <div class="title text-white text-2xl mb-5" style="font-size:30px; font-family:'roboto';font-weight: bold; text-align: left; margin-top: 10px; margin-bottom: 30px;">
            SEKTOR PETERNAKAN DESA LEBUNG SARI
        </div>
         <div class="slider">
          <div class="profiles" id="profiles3">
           <div class="profile">
            <img alt="Portrait of Kepala Desa Komariah" height="200" src="https://storage.googleapis.com/a1aa/image/fgeP46RAv3p6RkGuyvFZrLHsEFIlOffuX7BfCIpyq0QyFF8dC.jpg" width="200"/>
            <div class="position">
             <span>
              KEPALA DESA
             </span>
            </div>
            <div class="name">
             KOMARIAH
            </div>
           </div>
           <div class="profile">
            <img alt="Portrait of Sekretaris Desa Sulastri" height="200" src="https://storage.googleapis.com/a1aa/image/nvRwZj5aPRqgENnuS7YSKMm3nydY1izvec1MtsBroWDZUw3JA.jpg" width="200"/>
            <div class="position">
             <span>
              SEKRETARIS DESA
             </span>
            </div>
            <div class="name">
             SULASTRI
            </div>
           </div>
           <div class="profile">
            <img alt="Portrait of Kepala Urusan Tata Usaha Katiran" height="200" src="https://storage.googleapis.com/a1aa/image/TvGTdfFoXq3qAayp32QYWKDTsAlxDoIJazFhnY0UkN2YUw3JA.jpg" width="200"/>
            <div class="position">
             <span>
              KEPALA URUSAN TATA USAHA
             </span>
            </div>
            <div class="name">
             KATIRAN
            </div>
           </div>
           <div class="profile">
            <img alt="Portrait of Kepala Urusan Keuangan Didit Maryanto" height="200" src="https://storage.googleapis.com/a1aa/image/ljdu23Eqqg4EDJcZex6oeR0xeVCae0VXueJHqokkfPIZNK47E.jpg" width="200"/>
            <div class="position">
             <span>
              KEPALA URUSAN KEUANGAN
             </span>
            </div>
            <div class="name">
             DIDIT MARYANTO
            </div>
           </div>
           <div class="profile">
            <img alt="Portrait of Kepala Urusan Perencanaan Agus Sugiarto" height="200" src="https://storage.googleapis.com/a1aa/image/JzCvWPVew7RwJKZXW4s7enZLT1XN0SNPqXMfb1rNscfRjCedC.jpg" width="200"/>
            <div class="position">
             <span>
              KEPALA URUSAN PERENCANAAN
             </span>
            </div>
            <div class="name">
             AGUS SUGIARTO
            </div>
           </div>
           <div class="profile">
            <img alt="Portrait of Kepala Urusan Pemerintahan Berwin Eli Albert" height="200" src="https://storage.googleapis.com/a1aa/image/gjzEpbqF745RDtzptZdU0mNFDDeKJ2VY1d4oI9dCQe8wogvTA.jpg" width="200"/>
            <div class="position">
             <span>
              KEPALA URUSAN PEMERINTAHAN
             </span>
            </div>
            <div class="name">
             BERWIN ELI ALBERT
            </div>
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
        <script src="scriptTentangKami.js"></script>
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