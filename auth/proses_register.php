<?php
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    // Menggunakan password_hash (lebih aman dari SHA-256 standar) sesuai standar keamanan modern
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek apakah email sudah terdaftar
    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Email sudah digunakan!'); window.location='register.php';</script>";
    } else {
        $query = "INSERT INTO users (username, password, nama_lengkap) VALUES ('$username', '$password', '$nama')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Registrasi Berhasil! Silakan Login.'); window.location='login.php';</script>";
        } else {
            echo "Gagal: " . mysqli_error($koneksi);
        }
    }
}
?>