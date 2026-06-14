<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$q_total = mysqli_query($koneksi, "SELECT id_pendaftaran FROM pendaftaran");
$total_pendaftar = mysqli_num_rows($q_total);

$q_proses = mysqli_query($koneksi, "SELECT id_pendaftaran FROM pendaftaran WHERE status_pendaftaran = 'Diproses'");
$total_proses = mysqli_num_rows($q_proses);

$q_terima = mysqli_query($koneksi, "SELECT id_pendaftaran FROM pendaftaran WHERE status_pendaftaran = 'Diterima'");
$total_terima = mysqli_num_rows($q_terima);

$q_tolak = mysqli_query($koneksi, "SELECT id_pendaftaran FROM pendaftaran WHERE status_pendaftaran = 'Ditolak'");
$total_tolak = mysqli_num_rows($q_tolak);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | PPDB SMK TI Pratama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .hover-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        }
        .bg-gradient-danger {
            background: linear-gradient(135deg, #dc3545 0%, #a71d2a 100%);
        }
        .stat-icon {
            font-size: 3rem;
            opacity: 0.2;
            position: absolute;
            right: 20px;
            bottom: 10px;
        }
    </style>
</head>
<body class="bg-light pb-5">

    <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-danger mb-4 shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <img src="../assets/img/logo_smk.png" alt="Logo" height="40" class="me-2 bg-white rounded p-1">
                Panel Admin PPDB
            </a>
            <div class="ms-auto text-white d-flex align-items-center">
                <span class="me-4 d-none d-md-block">Selamat bertugas, <strong><?php echo $_SESSION['nama']; ?></strong></span>
                <a href="../auth/logout.php" class="btn btn-light text-danger fw-bold rounded-pill px-4 shadow-sm"><i class="fas fa-sign-out-alt me-2"></i> Keluar</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm p-4 hover-card" style="border-radius: 1rem;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-bold text-dark mb-1">Ikhtisar Pendaftaran</h4>
                            <p class="text-muted mb-0">Pantau pergerakan data calon peserta didik baru secara aktual.</p>
                        </div>
                        <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 60px; height: 60px; font-size: 24px;">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card border-0 bg-primary text-white shadow-sm h-100 hover-card" style="border-radius: 1rem; position: relative; overflow: hidden;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3 text-uppercase" style="letter-spacing: 1px;">Total Pendaftar</h6>
                        <h2 class="display-5 fw-bold mb-0"><?php echo $total_pendaftar; ?></h2>
                        <i class="fas fa-users stat-icon"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card border-0 bg-warning text-dark shadow-sm h-100 hover-card" style="border-radius: 1rem; position: relative; overflow: hidden;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3 text-uppercase" style="letter-spacing: 1px;">Belum Diverifikasi</h6>
                        <h2 class="display-5 fw-bold mb-0"><?php echo $total_proses; ?></h2>
                        <i class="fas fa-file-signature stat-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 bg-success text-white shadow-sm h-100 hover-card" style="border-radius: 1rem; position: relative; overflow: hidden;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3 text-uppercase" style="letter-spacing: 1px;">Siswa Diterima</h6>
                        <h2 class="display-5 fw-bold mb-0"><?php echo $total_terima; ?></h2>
                        <i class="fas fa-user-check stat-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 bg-danger text-white shadow-sm h-100 hover-card" style="border-radius: 1rem; position: relative; overflow: hidden;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3 text-uppercase" style="letter-spacing: 1px;">Siswa Ditolak</h6>
                        <h2 class="display-5 fw-bold mb-0"><?php echo $total_tolak; ?></h2>
                        <i class="fas fa-user-times stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <h5 class="fw-bold text-dark mb-4 px-2">Menu Pengelolaan Panitia</h5>
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <a href="verifikasi.php" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100 p-4 hover-card" style="border-radius: 1rem;">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; font-size: 32px;">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h5 class="fw-bold text-dark">Verifikasi Data</h5>
                        <p class="text-muted small">Periksa keabsahan dokumen pendaftar baru dan tentukan status kelulusannya.</p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="laporan.php" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100 p-4 hover-card" style="border-radius: 1rem;">
                        <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; font-size: 32px;">
                            <i class="fas fa-print"></i>
                        </div>
                        <h5 class="fw-bold text-dark">Laporan PPDB</h5>
                        <p class="text-muted small">Cetak rekapitulasi data pendaftar dan hasil seleksi secara keseluruhan.</p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="#" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100 p-4 hover-card" style="border-radius: 1rem;">
                        <div class="bg-secondary bg-opacity-10 text-secondary rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; font-size: 32px;">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h5 class="fw-bold text-dark">Pengaturan Sistem</h5>
                        <p class="text-muted small">Buka atau tutup gelombang pendaftaran serta kelola pengaturan lainnya.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>