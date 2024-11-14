<?php 
session_start();

// Atur koneksi ke database
$host_db    = "localhost";
$user_db    = "root";
$pass_db    = "";
$nama_db    = "login";
$koneksi    = mysqli_connect($host_db, $user_db, $pass_db, $nama_db);

// Atur variabel
$err        = "";
$username   = "";

if (isset($_SESSION['session_username'])) {
    header("location:adm_dsh_Monitoring.php");
    exit();
}

if (isset($_POST['login'])) {
    $username   = $_POST['username'];
    $password   = $_POST['password'];

    if ($username == '' || $password == '') {
        $err .= "<li>Silakan masukkan username dan juga password.</li>";
    } else {
        $sql1 = "SELECT * FROM login WHERE username = '$username'";
        $q1   = mysqli_query($koneksi, $sql1);
        $r1   = mysqli_fetch_array($q1);

        if ($r1['username'] == '') {
            $err .= "<li>Username <b>$username</b> tidak tersedia.</li>";
        } elseif ($r1['password'] != md5($password)) {
            $err .= "<li>Password yang dimasukkan tidak sesuai.</li>";
        }       

        if (empty($err)) {
            $_SESSION['session_username'] = $username; // Simpan username dalam sesi
            $_SESSION['session_password'] = md5($password);
            header("location:adm_dsh_Monitoring.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rufina:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="header.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
    <title>Admin Login</title>
    <style>
        /* CSS Umum */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Rufina', serif;
            background: url('images/login-background.png') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
        }

        header, footer, .footer-bottom{
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        /* Container Utama */
        .section_login {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Kotak Login */
        .login-box {
            display: flex;
            width: 60%;
            max-width: 800px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            overflow: hidden;
            margin-top: 50px;
        }

        /* Bagian Kiri */
        .login-left, .login-right {
            padding: 40px 30px;
            width: 50%;
            color: #333;
        }

        .login-left {
            background: rgba(255, 255, 255, 0.25);
        }

        .login-left h2 {
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: bold;
            color: black;
            text-align: center;
        }

        /* Input Form */
        .input-group {
            margin-bottom: 15px;
        }

        .input-group input {
            width: 100%;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            outline: none;
            box-sizing: border-box;
        }

        /* Warna placeholder */
        .input-group input::placeholder {
            color: black;
            opacity: 1; /* Ini memastikan warna placeholder tidak transparan */
        }


        /* Tombol Login */
        .login-btn {
            margin-top: 15px;
            box-sizing: border-box;
            width: 100%;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.75);
            border: 1px solid rgba(0, 0, 0, 1);
            border-radius: 10px;
            color: black;
            font-size: 16px;
            font-family: Rufina, serif;
            cursor: pointer;
        }

        .login-btn:hover {
            background-color: #0056b3;
        }

        /* Error */
        .error {
            color: red;
            margin-bottom: 15px;
        }

        /* Bagian Kanan */
        .login-right {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #f5f5f5;
        }

        .login-right h2 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .login-right p {
            font-size: 16px;
            text-align: center;
            max-width: 80%;
        }
        body, html {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .section_login {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }


        .username {
            background: url('images/profile-icon.svg') no-repeat right;
            background-size: 20px;
            background-position-x: 95%;
        }
        .password {
            background: url('images/password-icon.svg') no-repeat right;
            background-size: 20px;
            background-position-x: 95%;
        }
        /* CSS tambahan untuk tampilan responsif */
        @media (max-width: 768px) {
            .login-box {
                flex-direction: column;
                width: 100%;
                max-width: 500px;
            }

            .input-group input, .login-btn {
                height: 40px;
            }
            
            .login-left {
                width: 100%;
                padding: 20px;
            }

            .login-right {
                width: 100%;
                margin-top: 20px;
                padding: 40px 20px;
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

<div class="section_login">
    <div class="login-box">
        <div class="login-left">
            <h2>Login</h2>
            <?php if ($err) { ?>
                <div class="error">
                    <ul><?php echo $err ?></ul>
                </div>
            <?php } ?>
            <form action="" method="post">
                <div class="input-group">
                    <input type="text" class="username" name="username" value="<?php echo htmlspecialchars($username); ?>" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <input type="password" class="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="login" class="login-btn">Login</button>
            </form>
        </div>
        <div class="login-right">
            <h2>Admin Access Portal</h2>
            <p>Authorized Personnel Only. Please Login with Your Credentials.</p>
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
