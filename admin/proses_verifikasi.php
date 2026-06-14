<?php
session_start();
include '../config/koneksi.php';

// Proteksi Admin
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pendaftaran = mysqli_real_escape_string($koneksi, $_POST['id_pendaftaran']);
    $aksi = $_POST['aksi'];

    if ($aksi == 'terima') {
        // Jika diterima, ubah status pendaftaran jadi Diterima dan dokumen jadi Valid
        $query1 = "UPDATE pendaftaran SET status_pendaftaran = 'Diterima' WHERE id_pendaftaran = '$id_pendaftaran'";
        $query2 = "UPDATE dokumen SET status_dokumen = 'Valid' WHERE id_pendaftaran = '$id_pendaftaran'";
        $pesan = "Siswa berhasil DITERIMA dan dokumen divalidasi.";
    } else if ($aksi == 'tolak') {
        // Jika ditolak, ubah status pendaftaran jadi Ditolak dan dokumen jadi Tidak Valid
        $query1 = "UPDATE pendaftaran SET status_pendaftaran = 'Ditolak' WHERE id_pendaftaran = '$id_pendaftaran'";
        $query2 = "UPDATE dokumen SET status_dokumen = 'Tidak Valid' WHERE id_pendaftaran = '$id_pendaftaran'";
        $pesan = "Siswa telah DITOLAK.";
    }

    // Eksekusi kedua query
    $eksekusi1 = mysqli_query($koneksi, $query1);
    $eksekusi2 = mysqli_query($koneksi, $query2);

    if ($eksekusi1 && $eksekusi2) {
        echo "<script>alert('$pesan'); window.location.href='verifikasi.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah status: " . mysqli_error($koneksi) . "'); window.location.href='verifikasi.php';</script>";
    }
}
?>