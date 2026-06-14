<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = $_SESSION['id_user'];

    // 1. Ambil ID Pendaftaran dari user ini
    $query_pend = mysqli_query($koneksi, "SELECT id_pendaftaran FROM pendaftaran WHERE id_user = '$id_user'");
    $data_pend = mysqli_fetch_assoc($query_pend);
    $id_pendaftaran = $data_pend['id_pendaftaran'];

    // Cek apakah sudah pernah upload dokumen sebelumnya
    $cek_dok = mysqli_query($koneksi, "SELECT * FROM dokumen WHERE id_pendaftaran = '$id_pendaftaran'");
    if (mysqli_num_rows($cek_dok) > 0) {
        echo "<script>alert('Anda sudah mengunggah dokumen!'); window.location.href='index.php';</script>";
        exit;
    }

    // 2. Persiapan Folder Tujuan
    $target_dir = "../assets/uploads/";

    // 3. Menangkap data file
    $nama_ijazah = $_FILES['file_ijazah']['name'];
    $nama_kk = $_FILES['file_kk']['name'];
    $nama_foto = $_FILES['file_foto']['name'];

    $tmp_ijazah = $_FILES['file_ijazah']['tmp_name'];
    $tmp_kk = $_FILES['file_kk']['tmp_name'];
    $tmp_foto = $_FILES['file_foto']['tmp_name'];

    // Bikin nama file baru yang unik agar tidak bentrok jika namanya sama (Misal: 123456_ijazah.pdf)
    $new_ijazah = time() . '_ijazah_' . $nama_ijazah;
    $new_kk = time() . '_kk_' . $nama_kk;
    $new_foto = time() . '_foto_' . $nama_foto;

    // 4. Pindahkan file dari memori sementara (tmp) ke folder assets/uploads/
    $upload_ijazah = move_uploaded_file($tmp_ijazah, $target_dir . $new_ijazah);
    $upload_kk = move_uploaded_file($tmp_kk, $target_dir . $new_kk);
    $upload_foto = move_uploaded_file($tmp_foto, $target_dir . $new_foto);

    // 5. Jika semua file berhasil dipindah, simpan ke database
    if ($upload_ijazah && $upload_kk && $upload_foto) {
        $query_insert = "INSERT INTO dokumen (id_pendaftaran, file_ijazah, file_kk, file_foto, status_dokumen) 
                         VALUES ('$id_pendaftaran', '$new_ijazah', '$new_kk', '$new_foto', 'Tidak Valid')";
        // Default status 'Tidak Valid' sampai dicek admin

        if (mysqli_query($koneksi, $query_insert)) {
            echo "<script>alert('Semua Dokumen Berhasil Diunggah! Pendaftaran Selesai.'); window.location.href='index.php';</script>";
        } else {
            echo "Error Database: " . mysqli_error($koneksi);
        }
    } else {
        echo "<script>alert('Gagal mengunggah file. Pastikan ukuran dan format sesuai.'); window.location.href='dokumen.php';</script>";
    }
}
?>