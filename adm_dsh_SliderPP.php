<?php
session_start();
// Koneksi ke database slider_PP
$conn = new mysqli("localhost", "root", "", "slider_pp");

if (!isset($_SESSION['session_username'])) {
    header("Location: LebungFarm/login.php");
    exit();
}

$toast_message = ''; // Untuk menyimpan pesan toast

// Menambahkan gambar
if (isset($_POST['add'])) {
    $group = $_POST['slider_group'];
    
    // Menyimpan gambar di folder slider_PP
    $target_dir = "slider_PP/";
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
        $target_dir = "slider_PP/";
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
        $toast_message = 'Gambar berhasil diupdate.'; // Set pesan toast
    }
}

// Menghapus gambar
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $result = $conn->query("SELECT * FROM sliders WHERE id='$id'");
    $row = $result->fetch_assoc();
    $image_url = $row['image_url'];

    // Menghapus file gambar dari folder slider_PP
    if (unlink($image_url)) {
        $conn->query("DELETE FROM sliders WHERE id='$id'");
        $toast_message = 'Gambar berhasil dihapus.'; // Set pesan toast
    } else {
        $toast_message = 'Terjadi kesalahan saat menghapus file gambar.';
    }
}

// Menampilkan data gambar
$result = $conn->query("SELECT * FROM sliders");
$sliders = $result->fetch_all(MYSQLI_ASSOC);
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

    <div class="content" id="top" style="margin-bottom: 50px;">
        <h1>Admin Slider</h1>
        <!-- Form untuk Menambah Slider -->
        <form action="" method="post" enctype="multipart/form-data" class="mb-4">
            <div class="form-group">
                <label for="slider_group">Group Slider:</label>
                <select name="slider_group" id="slider_group" class="form-control" required>
                    <option value="1">Pertanian</option>
                    <option value="2">Peternakan</option>
                </select>
            </div><br>

            <div class="form-group">
                <label for="image">Pilih Gambar:</label>
                <input type="file" name="image" id="image" class="form-control" required><br><br>
            </div>

            <button type="submit" name="add" class="btn btn-primary">Tambah Gambar</button>
        </form>

        <!-- Daftar Gambar -->
        <h2>Daftar Slider</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Group</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sliders as $slider) { ?>
                    <tr>
                        <td><?php echo $slider['id']; ?></td>
                        <td><?php echo $slider['slider_group']; ?></td>
                        <td><img src="<?php echo $slider['image_url']; ?>" width="100"></td>
                        <td>
                            <!-- Tombol Edit untuk membuka modal -->
                            <button class="btn btn-warning edit-btn" data-id="<?php echo $slider['id']; ?>" data-group="<?php echo $slider['slider_group']; ?>" data-image="<?php echo $slider['image_url']; ?>">Edit</button>

                            <!-- Tombol Delete -->
                            <a href="?delete=<?php echo $slider['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus gambar ini?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Modal untuk Edit -->
        <!-- Modal Edit Slider -->
        <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="editModalLabel">Edit Slider</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="edit-id">
                            
                            <div class="form-group">
                                <label for="slider_group">Group Slider:</label>
                                <select name="slider_group" id="edit-slider_group" class="form-control" required>
                                    <option value="1">Pertanian</option>
                                    <option value="2">Peternakan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="image">Pilih Gambar:</label>
                                <input type="file" name="image" id="edit-image" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Preview Gambar:</label>
                                <img id="edit-image-preview" src="" width="100" class="img-thumbnail">
                            </div>

                            <button type="submit" name="update" class="btn btn-success">Update Gambar</button>
                        </form>
                    </div>
                </div>
            </div>
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
    <script>
    // Menampilkan modal saat tombol Edit ditekan
    $(document).on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        var group = $(this).data('group');
        var image = $(this).data('image');

        $('#edit-id').val(id);
        $('#edit-slider_group').val(group);
        $('#edit-image-preview').attr('src', image);
        $('#editModal').modal('show'); // Menampilkan modal dengan Bootstrap
    });
    </script>
</body>
</html>