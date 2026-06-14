<?php
session_start();
include '../config/koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];

// 1. Cek di tabel Admin
$query_admin = mysqli_query($koneksi, "SELECT * FROM admin WHERE username = '$username'");
if (mysqli_num_rows($query_admin) > 0) {
    $data = mysqli_fetch_assoc($query_admin);
    
    // Cek password admin
    if ($password == $data['password'] || password_verify($password, $data['password'])) {
        $_SESSION['login'] = true;
        $_SESSION['role'] = 'admin';
        $_SESSION['nama'] = $data['nama_admin'];
        
        // Menggunakan JavaScript Redirect agar lebih aman
        echo "<script>window.location.href = '../admin/index.php';</script>";
        exit;
    }
}

// 2. Cek di tabel Users (Siswa)
$query_siswa = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
if (mysqli_num_rows($query_siswa) > 0) {
    $data = mysqli_fetch_assoc($query_siswa);
    
    // Cek password siswa (wajib pakai password_verify karena di-hash)
    if (password_verify($password, $data['password'])) {
        $_SESSION['login'] = true;
        $_SESSION['role'] = 'siswa';
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama_lengkap'];
        
        // Menggunakan JavaScript Redirect agar lebih aman
        echo "<script>window.location.href = '../siswa/index.php';</script>";
        exit;
    }
}

// Jika username tidak ada atau password salah, munculkan alert
echo "<script>alert('Gagal Masuk! Username atau Password Salah.'); window.location.href = 'login.php';</script>";
?>