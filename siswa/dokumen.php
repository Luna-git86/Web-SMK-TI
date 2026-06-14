<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../auth/login.php");
    exit;
}

// Cek apakah siswa sudah mengisi formulir data diri (Tabel pendaftaran)
$id_user = $_SESSION['id_user'];
$cek_pendaftaran = mysqli_query($koneksi, "SELECT id_pendaftaran FROM pendaftaran WHERE id_user = '$id_user'");
if (mysqli_num_rows($cek_pendaftaran) == 0) {
    echo "<script>alert('Harap isi Data Diri terlebih dahulu!'); window.location.href='formulir.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Upload Dokumen | PPDB SMK TI Pratama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-custom mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">Dashboard Siswa</a>
            <span class="text-white small">Tahap 2: Upload Berkas</span>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card card-custom shadow-sm p-4">
                    <h3 class="fw-bold text-custom-dark mb-3 text-center">Upload Berkas Persyaratan</h3>

                    <div class="alert alert-info small pb-0">
                        <ul>
                            <li>Format file yang diizinkan: <b>JPG, JPEG, PNG, atau PDF</b>.</li>
                            <li>Ukuran maksimal per file: <b>2 MB</b>.</li>
                            <li>Pastikan dokumen terlihat jelas dan tidak terpotong.</li>
                        </ul>
                    </div>

                    <form action="proses_dokumen.php" method="POST" enctype="multipart/form-data">

                        <div class="mb-4 mt-4">
                            <label class="form-label fw-bold">1. Scan Ijazah Asli / SKL</label>
                            <input type="file" name="file_ijazah" class="form-control" accept=".jpg,.jpeg,.png,.pdf"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">2. Scan Kartu Keluarga (KK)</label>
                            <input type="file" name="file_kk" class="form-control" accept=".jpg,.jpeg,.png,.pdf"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">3. Pas Foto 3x4 (Latar Merah/Biru)</label>
                            <input type="file" name="file_foto" class="form-control" accept=".jpg,.jpeg,.png" required>
                        </div>

                        <button type="submit" class="btn btn-custom w-100 py-3 fw-bold fs-5 shadow-sm">Unggah
                            Dokumen</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</body>

</html>