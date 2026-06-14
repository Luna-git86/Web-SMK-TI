<?php
// Konfigurasi database
$host = "localhost"; // Biasanya localhost untuk XAMPP
$user = "root";      // Username default MySQL di XAMPP
$pass = "";          // Password default MySQL di XAMPP biasanya kosong
$db   = "db_ppdb_smk"; // Nama database sesuai file SQL 

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Memeriksa koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Opsi: Jika ingin mengetes koneksi, hapus tanda komentar di bawah ini
// echo "Koneksi berhasil!";
?>