<?php
session_start();
include 'tentangkami_db.php';

if (!isset($_SESSION['session_username'])) {
    header("Location: LebungFarm/login.php");
    exit();
}

// Ambil data nama-nama kepala desa dari database
$nama_kepala_desa = getNamaKepalaDesa();

// Perbarui nama kepala desa
if (isset($_POST['add_nama'])) {
    $nama = $_POST['nama'];
    $tahun = $_POST['tahun'];
    if (!empty($nama) && !empty($tahun)) {
        // Panggil fungsi untuk menambahkan kepala desa
        if (addNamaKepalaDesa($nama, $tahun)) {
            // Redirect untuk refresh halaman agar data terbaru muncul
            header("Location: adm_dsh_NamaKepdes.php?success_add=1");
            exit();
        } else {
            echo "Gagal menambahkan kepala desa.";
        }
    } else {
        echo "Nama atau Tahun tidak boleh kosong!";
    }
}

// Perbarui nama kepala desa
if (isset($_POST['update_nama'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $tahun = $_POST['tahun'];

    // Debugging: cek apakah input sudah benar
    var_dump($tahun); // Cek apakah tahun mengandung "2001 - 2020"
    
    if (!empty($nama) && !empty($tahun)) {
        // Panggil fungsi untuk memperbarui kepala desa
        if (updateNamaKepalaDesa($id, $nama, $tahun)) {
            header("Location: adm_dsh_NamaKepdes.php?success_update=1");
            exit();
        } else {
            echo "Gagal memperbarui nama kepala desa.";
        }
    } else {
        echo "Nama atau Tahun tidak boleh kosong!";
    }
}



// Hapus nama kepala desa
if (isset($_POST['hapus_nama'])) {
    $id = $_POST['id'];

    if (hapusNamaKepalaDesa($id)) {
        header("Location: /LebungSari/adm_dsh_NamaKepdes.php?success_delete=1");
        exit();
    } else {
        $error = "Gagal menghapus kepala desa.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Nama Kepala Desa</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <header class="header" style="display: flex;">
        <img src="assets/Logo_lamsel.png" alt="Logo Lamsel">
        <img src="assets/Logo_kemendes.png" alt="Logo Kemendes">
        <div class="title-wrap text-left">
            <p class="judul">LEBUNGFARM</p>
            <p class="subjudul" style="color:gray;">Desa Lebung Sari</p>
        </div>
        <button class="burger-menu" onclick="toggleSidebar()" style="color: black;">&#9776;</button>
    </header>

    <?php include "sidebar.html" ?>

    <div class="content" id="top" style="margin-bottom: 50px;">
        <h1 class="text-center" style="font-weight: bold;">Dashboard Admin - Nama Kepala Desa</h1>
        
        <!-- Form Tambah Kepala Desa -->
        <h2>Tambah Nama Kepala Desa</h2>
        <form method="POST" action="">
            <label for="nama">Nama Kepala Desa:</label>
            <input type="text" id="nama" name="nama" required>
            
            <label for="tahun">Tahun Menjabat:</label>
            <input type="text" id="tahun" name="tahun" required>
            
            <button type="submit" name="add_nama" class="btn btn-success">Tambah</button>
        </form>

        <!-- Tabel Kepala Desa -->
        <h2>Ubah Nama Kepala Desa</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kepala Desa</th>
                    <th>Tahun Pemerintahan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($nama_kepala_desa as $kepala): ?>
                    <tr>
                        <td><?php echo $kepala['id']; ?></td>
                        <td><?php echo htmlspecialchars($kepala['nama']); ?></td>
                        <td><?php echo htmlspecialchars($kepala['tahun']); ?></td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="id" value="<?php echo $kepala['id']; ?>">
                                <input type="text" name="nama" value="<?php echo htmlspecialchars($kepala['nama']); ?>" required>
                                <input type="text" name="tahun" value="<?php echo htmlspecialchars($kepala['tahun']); ?>" required>
                                <button type="submit" name="update_nama" class="btn btn-primary">Perbarui</button>
                                <button type="submit" name="hapus_nama" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if (isset($error)) { echo "<p class='alert alert-danger'>$error</p>"; } ?>
    </div>
</body>
</html>
