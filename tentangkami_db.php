<?php
$koneksiDesa = mysqli_connect('localhost', 'root', '', 'sejarahdesa_db');
$koneksiKepalaDesa= mysqli_connect('localhost', 'root', '', 'kepala_desa');
$koneksiVisiMisi = mysqli_connect('localhost', 'root', '', 'visimisi_db');

// Cek koneksi pertama
if (!$koneksiDesa) {
	die("Koneksi database gagal: " . mysqli_connect_error());
}

// Cek koneksi kedua
if (!$koneksiKepalaDesa) {
	die("Koneksi database kepala_desa_db gagal: " . mysqli_connect_error());
}

// Cek koneksi ketiga
if (!$koneksiVisiMisi) {
	die("Koneksi database visimisi_db gagal: " . mysqli_connect_error());
}


function updateDeskripsiSejarah($deskripsi) {
	global $koneksiDesa;
	$sql = "UPDATE sejarahdesa SET deskripsi_sejarah = ? WHERE id = 1";
	$stmt = $koneksiDesa->prepare($sql);

	if (!$stmt) {
			die("Gagal menyiapkan statement: " . $koneksiDesa->error);
	}

	// Jangan gunakan htmlspecialchars() atau entitas HTML lainnya
	$stmt->bind_param("s", $deskripsi); // Pastikan deskripsi disimpan dengan tag HTML
	$result = $stmt->execute();

	if (!$result) {
			error_log("Error updating deskripsi: " . $stmt->error);
	}

	$stmt->close(); 
	return $result;
}



// Tambahkan fungsi untuk mengambil deskripsi sejarah desa
function getDeskripsiSejarah() {
	global $koneksiDesa;
	$sql = "SELECT deskripsi_sejarah FROM sejarahdesa WHERE id = 1"; // Sesuaikan ID sesuai database
	$result = $koneksiDesa->query($sql);

	if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			// Mengganti line breaks dengan tag <br>
			return nl2br($row['deskripsi_sejarah']);
	} else {
			return ""; // Nilai default jika data tidak ditemukan
	}
}

// Fungsi untuk mengambil nama-nama kepala desa dari database
function getNamaKepalaDesa() {
	global $koneksiKepalaDesa;
	$sql = "SELECT id, nama, tahun FROM kepala_desa"; // Pastikan tabel dan kolom sesuai dengan database
	$result = $koneksiKepalaDesa->query($sql);

	$nama_kepala_desa = [];
	if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
					$nama_kepala_desa[] = $row;
			}
	}
	return $nama_kepala_desa;
}

// Fungsi untuk memperbarui nama kepala desa berdasarkan ID
function updateNamaKepalaDesa($id, $nama, $tahun) {
	global $koneksiKepalaDesa; // Pastikan koneksi ke database sudah ada
	$sql = "UPDATE kepala_desa SET nama = ?, tahun = ? WHERE id = ?";
	$stmt = $koneksiKepalaDesa->prepare($sql);
	$stmt->bind_param("ssi", $nama, $tahun, $id); // Pastikan $tahun adalah string (VARCHAR)
	return $stmt->execute();
}


function addNamaKepalaDesa($nama, $tahun) {
	global $koneksiKepalaDesa;
	
	// SQL query untuk menambahkan nama kepala desa baru
	$sql = "INSERT INTO kepala_desa (nama, tahun) VALUES (?, ?)";
	
	// Siapkan statement untuk eksekusi
	$stmt = $koneksiKepalaDesa->prepare($sql);
	
	if (!$stmt) {
			die("Gagal menyiapkan statement: " . $koneksiKepalaDesa->error);
	}

	// Bind parameter untuk query
	$stmt->bind_param("si", $nama, $tahun); // "s" untuk string (nama) dan "i" untuk integer (tahun)
	
	// Eksekusi query
	$result = $stmt->execute();

	if (!$result) {
			error_log("Error menambahkan nama kepala desa: " . $stmt->error);
	}

	// Tutup statement setelah eksekusi
	$stmt->close();
	
	return $result; // Kembalikan hasil eksekusi (true jika berhasil, false jika gagal)
}

// Fungsi untuk menghapus nama kepala desa berdasarkan ID
function hapusNamaKepalaDesa($id) {
	global $koneksiKepalaDesa; // Pastikan Anda memiliki koneksi database yang benar
	$query = "DELETE FROM kepala_desa WHERE id = ?";
	$stmt = $koneksiKepalaDesa->prepare($query);
	$stmt->bind_param("i", $id); // Pastikan tipe data `id` adalah integer
	return $stmt->execute();
}

// Fungsi untuk mendapatkan deskripsi Visi dan Misi Desa
function getVisiMisiDesa() {
	global $koneksiVisiMisi;
	$query = "SELECT visi_misi FROM visimisi_db LIMIT 1"; // Sesuaikan dengan nama tabel
	$result = $koneksiVisiMisi->query($query);

	if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return $row; // Pastikan return array atau hanya string
	} else {
			return ''; // Jika tidak ada data, return string kosong
	}
}


// Fungsi untuk memperbarui deskripsi Visi dan Misi Desa
function updateVisiMisiDesa($visi_misi) {
	global $koneksiVisiMisi;
	$sql = "UPDATE visimisi_db SET visi_misi = ? WHERE id = 1"; // Sesuaikan dengan struktur tabel Anda

	$stmt = $koneksiVisiMisi->prepare($sql);
	$stmt->bind_param('s', $visi_misi);

	if ($stmt->execute()) {
			return true;
	}
	return false;
}


?>
