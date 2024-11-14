<?php
// Periksa apakah form telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $pesan = htmlspecialchars($_POST['pesan']);
    
    // Tentukan email tujuan
    $to = "afaqih864@gmail.com";  // Ganti dengan email yang ingin menerima pesan
    $subject = "Pesan dari Form Kontak";
    
    // Format pesan yang akan dikirim
    $body = "Nama: $nama\n";
    $body .= "Email: $email\n\n";
    $body .= "Pesan:\n$pesan\n";
    
    // Set header email
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    // Kirim email
    if (mail($to, $subject, $body, $headers)) {
        echo "Pesan berhasil dikirim.";
    } else {
        echo "Maaf, terjadi kesalahan saat mengirim pesan.";
    }
}
?>
