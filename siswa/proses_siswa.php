<?php
session_start();
include '../config/koneksi.php';

// Proteksi keamanan
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tangkap id_user dari session yang sedang aktif
    $id_user = $_SESSION['id_user'];

    // Tangkap dan bersihkan data dari form (Sanitasi untuk keamanan)
    $nisn = mysqli_real_escape_string($koneksi, $_POST['nisn']);
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $asal_sekolah = mysqli_real_escape_string($koneksi, $_POST['asal_sekolah']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $id_jurusan = mysqli_real_escape_string($koneksi, $_POST['id_jurusan']);

    // Cek apakah siswa ini sudah pernah mengisi formulir sebelumnya (mencegah double data)
    $cek_daftar = mysqli_query($koneksi, "SELECT * FROM pendaftaran WHERE id_user = '$id_user'");
    if (mysqli_num_rows($cek_daftar) > 0) {
        echo "<script>alert('Anda sudah mengisi formulir pendaftaran. Tidak perlu mengisi lagi!'); window.location.href='index.php';</script>";
        exit;
    }

    // Query Insert ke tabel pendaftaran
    $query = "INSERT INTO pendaftaran 
              (id_user, nisn, nama_lengkap, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, asal_sekolah, no_hp, email, id_jurusan, status_pendaftaran) 
              VALUES 
              ('$id_user', '$nisn', '$nama_lengkap', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$asal_sekolah', '$no_hp', '$email', '$id_jurusan', 'Diproses')";

    // Eksekusi Query
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil, langsung arahkan ke halaman Upload Dokumen
        echo "<script>alert('Data diri berhasil disimpan! Silakan lanjut ke tahap Upload Dokumen.'); window.location.href='dokumen.php';</script>";
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}
?>