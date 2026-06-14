<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// Ambil data pendaftaran dan nama jurusan
$query = mysqli_query($koneksi, "
    SELECT p.*, j.nama_jurusan 
    FROM pendaftaran p 
    LEFT JOIN jurusan j ON p.id_jurusan = j.id_jurusan 
    WHERE p.id_user = '$id_user'
");

$data = mysqli_fetch_assoc($query);

// Jika belum isi formulir, tendang balik ke index
if (!$data) {
    echo "<script>alert('Anda belum melengkapi data pendaftaran!'); window.location.href='index.php';</script>";
    exit;
}

$status = $data['status_pendaftaran'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Kelulusan | PPDB SMK TI Pratama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-custom mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard</a>
            <span class="text-white small">Pengumuman Hasil Seleksi</span>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-custom shadow p-5 text-center">
                    
                    <?php if ($status == 'Diterima'): ?>
                        <div class="text-success mb-4">
                            <i class="fas fa-check-circle" style="font-size: 80px;"></i>
                        </div>
                        <h2 class="fw-bold text-success mb-3">SELAMAT! ANDA LULUS</h2>
                        <p class="fs-5 text-muted">Berdasarkan hasil verifikasi dokumen, Anda dinyatakan <strong>DITERIMA</strong> sebagai siswa baru di SMK TI Pratama PGRI Samarinda pada program keahlian:</p>
                        <h4 class="fw-bold text-custom-primary mb-4"><?php echo $data['nama_jurusan'] ?? 'Jurusan Terpilih'; ?></h4>
                        
                        <div class="alert alert-info text-start">
                            <strong>Langkah Selanjutnya:</strong> Silakan cetak bukti pendaftaran ini dan bawa ke sekolah beserta dokumen asli untuk proses daftar ulang.
                        </div>
                        
                        <a href="cetak_bukti.php" target="_blank" class="btn btn-custom btn-lg mt-3 px-5"><i class="fas fa-print me-2"></i>Cetak Bukti Lulus</a>
                    
                    <?php elseif ($status == 'Ditolak'): ?>
                        <div class="text-danger mb-4">
                            <i class="fas fa-times-circle" style="font-size: 80px;"></i>
                        </div>
                        <h2 class="fw-bold text-danger mb-3">MOHON MAAF</h2>
                        <p class="fs-5 text-muted">Berdasarkan hasil verifikasi, pendaftaran Anda <strong>DITOLAK</strong> karena dokumen tidak memenuhi syarat atau kuota telah penuh.</p>
                        <a href="index.php" class="btn btn-outline-danger mt-3">Kembali ke Beranda</a>

                    <?php else: ?>
                        <div class="text-warning mb-4">
                            <i class="fas fa-hourglass-half" style="font-size: 80px;"></i>
                        </div>
                        <h2 class="fw-bold text-warning mb-3" style="color: #d39e00 !important;">SEDANG DIPROSES</h2>
                        <p class="fs-5 text-muted">Berkas Anda sedang dalam tahap verifikasi oleh panitia PPDB. Harap cek halaman ini secara berkala.</p>
                        <button class="btn btn-outline-warning mt-3" onclick="window.location.reload();"><i class="fas fa-sync-alt me-2"></i>Refresh Halaman</button>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</body>
</html>