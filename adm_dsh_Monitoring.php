<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Monitoring Pengunjung</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="header" style="display: flex;">
        <img src="assets/Logo_lamsel.png">
        <img src="assets/Logo_kemendes.png">
        <div class="title-wrap text-left">
            <p class="judul">LEBUNGFARM</p>
            <p class="subjudul" style="color:gray;">Desa Lebung Sari</p>
        </div>
        <!-- Menu Burger untuk tampilan mobile -->
        <button class="burger-menu" onclick="toggleSidebar()" style="color: black;">&#9776;</button>
    </header>

    <!-- Sidebar -->
    <?php include "sidebar.html"?>

    <!-- Main Content -->
    <div class="content" id="top">
        <h2>Monitoring Pengunjung</h2>

        <?php
        // Koneksi ke database
        $conn = new mysqli("localhost", "root", "", "monitoring_db");

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Ambil total jumlah pengunjung
        $totalVisitors = 0;
        $result = $conn->query("SELECT SUM(jumlah) AS total FROM kunjungan");
        if ($result) {
            $row = $result->fetch_assoc();
            $totalVisitors = $row['total'];
        }

        echo "<p>Total Pengunjung: <strong>" . $totalVisitors . "</strong></p>";

        // Ambil data pengunjung untuk 1 minggu terakhir
        $dataKunjungan = [];
        $labels = [];
        $date = new DateTime();
        for ($i = 6; $i >= 0; $i--) {
            $date->modify("-$i day");
            $tanggal = $date->format("Y-m-d");
            $result = $conn->query("SELECT jumlah FROM kunjungan WHERE tanggal = '$tanggal'");
            $jumlah = ($result && $result->num_rows > 0) ? $result->fetch_assoc()['jumlah'] : 0;
            $dataKunjungan[] = $jumlah;
            $labels[] = $tanggal;
            $date->modify("+$i day"); // reset date
        }

        $conn->close();
        ?>

        <!-- Grafik Pengunjung Mingguan -->
        <canvas id="visitorChart" style="width:400px; height:150px; margin-bottom:50px;"></canvas>
        <script>
            const ctx = document.getElementById('visitorChart').getContext('2d');
            const visitorChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($labels); ?>,
                    datasets: [{
                        label: 'Jumlah Pengunjung Harian',
                        data: <?php echo json_encode($dataKunjungan); ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>

    <footer class="footer">
        Copyright © 2024 UMKM Lebung Sari | All rights reserved.
    </footer>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show-sidebar');
        }
    </script>
</body>
</html>
