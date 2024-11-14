<?php
session_start();
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "sliderDB");

if (!isset($_SESSION['session_username'])) {
    header("Location: LebungFarm/login.php");
    exit();
}

$toast_message = ''; // Untuk menyimpan pesan toast

// Menambahkan gambar
if (isset($_POST['add'])) {
    $group = $_POST['slider_group'];
    
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        $toast_message = 'File bukan gambar.'; // Set pesan toast
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $toast_message = 'Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.'; // Set pesan toast
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $conn->query("INSERT INTO sliders (slider_group, image_url) VALUES ('$group', '$target_file')");
            $toast_message = 'Gambar berhasil ditambah.'; // Set pesan toast
        } else {
            $toast_message = 'Terjadi kesalahan saat mengunggah file.';
        }
    }
}

// Mengubah gambar
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $group = $_POST['slider_group'];
    $uploadOk = 1;

    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            $toast_message = 'File bukan gambar.'; // Set pesan toast
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $toast_message = 'Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.'; // Set pesan toast
            $uploadOk = 0;
        }

        if ($uploadOk == 1 && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $conn->query("UPDATE sliders SET image_url='$target_file', slider_group='$group' WHERE id='$id'");
            $toast_message = 'Gambar berhasil diupdate.'; // Set pesan toast
        }
    } else {
        $conn->query("UPDATE sliders SET slider_group='$group' WHERE id='$id'");
        $toast_message = 'Gambar berhasil diupdate.'; // Set pesan toast tanpa mengubah gambar
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $result = $conn->query("SELECT image_url FROM sliders WHERE id='$id'");
    if ($result) {
        $row = $result->fetch_assoc();
        if (file_exists($row['image_url'])) {
            unlink($row['image_url']);
        }
    }
    $conn->query("DELETE FROM sliders WHERE id='$id'");
    $toast_message = 'Gambar berhasil dihapus.';
}

$images = $conn->query("SELECT * FROM sliders");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
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
    <h1 class="text-center" style="font-weight: bold;">Slide Produk</h1>
        <h2>Tambah Gambar</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Gambar:</label>
                <input type="file" name="image" class="form-control-file" required>
            </div>
            <div class="form-group">
                <label for="slider_group">Grup Slider:</label>
                <select name="slider_group" class="form-control" style="max-width:125px" required>
                    <option value="1">Slider 1</option>
                    <option value="2">Slider 2</option>
                </select>
            </div>
            <button type="submit" name="add" class="btn btn-primary">Tambah</button>
        </form>
        <h2 class="mt-4">Daftar Gambar</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Gambar</th>
                    <th>Grup Slider</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="data_slider">
                <?php while ($row = $images->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><img src="<?php echo $row['image_url']; ?>" alt="Image" width="100"></td>
                        <td><?php echo $row['slider_group']; ?></td>
                        <td>
                            <button type="button" class="btn btn-warning edit-button">Update</button>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus gambar ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Edit Produk -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title" id="editModalLabel">Edit Gambar</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editId">
                        <div class="form-group">
                            <label for="editSliderGroup">Grup Slider:</label>
                            <select name="slider_group" id="editSliderGroup" class="form-control" required>
                                <option value="1">Slider 1</option>
                                <option value="2">Slider 2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editImage">Ganti Gambar:</label>
                            <input type="file" name="image" id="editImage" class="form-control-file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="footer">
        Copyright © 2024 UMKM Lebung Sari | All rights reserved.
    </footer>
    <script>
        $(document).ready(function() {
            $('.edit-button').click(function() {
                var row = $(this).closest('tr');
                var id = row.find('td:eq(0)').text(); // Ambil ID dari kolom pertama
                var sliderGroup = row.find('td:eq(2)').text(); // Ambil grup slider dari kolom ketiga
                var imageUrl = row.find('img').attr('src'); // Ambil URL gambar

                // Set nilai untuk modal
                $('#editId').val(id);
                $('#editSliderGroup').val(sliderGroup);
                
                // Tampilkan modal
                $('#editModal').modal('show');
            });
        });
    </script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show-sidebar');
        }
    </script>
    <script>
        $(document).ready(function() {
            const toastMessage = "<?php echo $toast_message; ?>";
            if (toastMessage) {
                $('#toastMessage').text(toastMessage);
                $('#toast-container').fadeIn();

                // Sembunyikan toast setelah 3 detik
                setTimeout(hideToast, 3000);
            }
        });

        function hideToast() {
            $('#toast-container').fadeOut();
        }
    </script>
</body>
</html>
