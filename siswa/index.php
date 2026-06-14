<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$nama_siswa = $_SESSION['nama'];

// ==========================================
// LOGIKA PENGECEKAN STATUS PENDAFTARAN
// ==========================================
$step1_done = false; 
$step2_done = false; 
$butuh_revisi = false; // Variabel baru untuk membuka kunci form

$status_teks = "Belum Mengisi Formulir";
$status_warna = "bg-danger";
$status_icon = "fa-times-circle";

// 1. Cek tabel 'pendaftaran'
$query_form = mysqli_query($koneksi, "SELECT * FROM pendaftaran WHERE id_user = '$id_user'");
if (mysqli_num_rows($query_form) > 0) {
    $step1_done = true;
    $data_pend = mysqli_fetch_assoc($query_form);
    $id_pendaftaran = $data_pend['id_pendaftaran'];
    
    $status_teks = "Belum Upload Berkas";
    $status_warna = "bg-warning text-dark";
    $status_icon = "fa-exclamation-circle";

    // Jika dari awal form sudah ditolak (sebelum upload dokumen)
    if ($data_pend['status_pendaftaran'] == 'Ditolak') {
        $status_teks = "FORMULIR DITOLAK - PERBAIKI";
        $status_warna = "bg-danger";
        $status_icon = "fa-exclamation-triangle";
        $butuh_revisi = true;
    }

    // 2. Cek tabel 'dokumen'
    $query_dok = mysqli_query($koneksi, "SELECT * FROM dokumen WHERE id_pendaftaran = '$id_pendaftaran'");
    if (mysqli_num_rows($query_dok) > 0) {
        $step2_done = true;
        $data_dok = mysqli_fetch_assoc($query_dok);
        
        // Cek apakah ditolak oleh panitia (baik dokumennya atau status akhirnya)
        if ($data_dok['status_dokumen'] == 'Tidak Valid' || $data_pend['status_pendaftaran'] == 'Ditolak') {
            $status_teks = "DATA DITOLAK - HARAP PERBAIKI";
            $status_warna = "bg-danger text-white";
            $status_icon = "fa-exclamation-triangle";
            $butuh_revisi = true; // Buka kunci revisi
        } else if ($data_pend['status_pendaftaran'] == 'Diterima') {
            $status_teks = "LULUS / DITERIMA";
            $status_warna = "bg-success";
            $status_icon = "fa-check-circle";
        } else if ($data_dok['status_dokumen'] == 'Valid') {
            $status_teks = "Dokumen Valid - Menunggu Hasil";
            $status_warna = "bg-primary";
            $status_icon = "fa-check";
        } else {
            $status_teks = "Menunggu Verifikasi Panitia";
            $status_warna = "bg-info text-dark";
            $status_icon = "fa-hourglass-half";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa | PPDB SMK TI Pratama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .hover-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .hover-card:hover { transform: translateY(-3px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; }
        .bg-custom-purple { background: linear-gradient(135deg, #5409da 0%, #7633f9 100%); }
        .step-card { border-left: 5px solid #dee2e6; border-radius: 0.75rem; }
        .step-card.active-primary { border-left-color: #0d6efd; }
        .step-card.active-warning { border-left-color: #ffc107; }
        .step-card.active-success { border-left-color: #198754; }
        .step-card.active-info { border-left-color: #0dcaf0; }
        .step-card.active-danger { border-left-color: #dc3545; }
        .profile-header { height: 100px; background: url('../assets/img/poster_ppdb.jpg') center/cover; border-top-left-radius: 1rem; border-top-right-radius: 1rem; position: relative; }
        .profile-header::after { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(84, 9, 218, 0.7); border-top-left-radius: 1rem; border-top-right-radius: 1rem; }
    </style>
</head>
<body class="bg-light pb-5">

    <nav class="navbar navbar-expand-lg navbar-dark bg-custom-purple mb-5 shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
                <img src="../assets/img/logo_smk.png" alt="Logo" height="35" class="me-2 bg-white rounded p-1">
                Portal Calon Siswa
            </a>
            <div class="ms-auto text-white d-flex align-items-center">
                <span class="me-3 d-none d-md-block">Halo, <strong><?php echo $nama_siswa; ?></strong></span>
                <a href="../auth/logout.php" class="btn btn-sm btn-light text-danger fw-bold rounded-pill px-3 shadow-sm"><i class="fas fa-sign-out-alt me-1"></i> Keluar</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row g-4">
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm text-center" style="border-radius: 1rem;">
                    <div class="profile-header"></div>
                    <div class="card-body px-4 pb-4" style="margin-top: -50px; z-index: 1; position: relative;">
                        <div class="bg-white p-2 rounded-circle d-inline-block shadow-sm mb-3">
                            <img src="../assets/img/logo_smk.png" height="70" class="rounded-circle">
                        </div>
                        <h5 class="fw-bold text-dark mb-0"><?php echo $nama_siswa; ?></h5>
                        <p class="text-muted small mb-4">Calon Siswa Baru 2026</p>
                        
                        <div class="p-3 rounded-3 shadow-sm text-white <?php echo $status_warna; ?>">
                            <p class="small mb-1 opacity-75">Status Pendaftaran Saat Ini:</p>
                            <h6 class="fw-bold mb-0 text-uppercase"><i class="fas <?php echo $status_icon; ?> me-2"></i><?php echo $status_teks; ?></h6>
                        </div>

                        <?php if($butuh_revisi): ?>
                            <div class="alert alert-danger mt-3 small text-start border-0 shadow-sm" role="alert">
                                <strong><i class="fas fa-info-circle me-1"></i> Peringatan:</strong> Data atau berkas Anda ditolak oleh panitia. Silakan lakukan pengisian ulang pada menu di samping.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 1rem;">
                    <h4 class="fw-bold text-dark mb-1">Tahapan Pendaftaran</h4>
                    <p class="text-muted mb-4">Selesaikan seluruh tahapan di bawah ini secara berurutan agar data Anda dapat diproses oleh panitia.</p>
                    
                    <div class="d-flex flex-column gap-3">
                        
                        <?php if($step1_done && !$butuh_revisi): ?>
                            <div class="card step-card active-success bg-light border-0 shadow-sm hover-card">
                                <div class="card-body d-flex align-items-center justify-content-between p-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 50px; height: 50px; font-size: 20px;"><i class="fas fa-check"></i></div>
                                        <div>
                                            <h6 class="fw-bold text-success mb-1">Tahap 1: Formulir Pendaftaran</h6>
                                            <p class="text-muted small mb-0">Data diri dan asal sekolah berhasil disimpan.</p>
                                        </div>
                                    </div>
                                    <span class="badge bg-success rounded-pill px-3 py-2 d-none d-md-block">Selesai</span>
                                </div>
                            </div>
                        <?php elseif($step1_done && $butuh_revisi): ?>
                            <a href="formulir.php" class="text-decoration-none">
                                <div class="card step-card active-danger bg-white shadow-sm hover-card border-danger">
                                    <div class="card-body d-flex align-items-center justify-content-between p-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 50px; height: 50px; font-size: 20px;"><i class="fas fa-pencil-alt"></i></div>
                                            <div>
                                                <h6 class="fw-bold text-danger mb-1">Tahap 1: Perbaiki Formulir</h6>
                                                <p class="text-muted small mb-0">Panitia meminta Anda memperbaiki data pendaftaran ini.</p>
                                            </div>
                                        </div>
                                        <button class="btn btn-danger rounded-pill px-4 shadow-sm">Edit Data</button>
                                    </div>
                                </div>
                            </a>
                        <?php else: ?>
                            <a href="formulir.php" class="text-decoration-none">
                                <div class="card step-card active-primary bg-white shadow-sm hover-card">
                                    <div class="card-body d-flex align-items-center justify-content-between p-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 50px; height: 50px; font-size: 20px;">1</div>
                                            <div>
                                                <h6 class="fw-bold text-primary mb-1">Tahap 1: Isi Formulir Pendaftaran</h6>
                                                <p class="text-muted small mb-0">Lengkapi data diri, asal sekolah, dan pilih jurusan Anda.</p>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary rounded-pill px-4 shadow-sm">Mulai</button>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>


                        <?php if($step2_done && !$butuh_revisi): ?>
                            <div class="card step-card active-success bg-light border-0 shadow-sm hover-card">
                                <div class="card-body d-flex align-items-center justify-content-between p-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 50px; height: 50px; font-size: 20px;"><i class="fas fa-check"></i></div>
                                        <div>
                                            <h6 class="fw-bold text-success mb-1">Tahap 2: Upload Berkas</h6>
                                            <p class="text-muted small mb-0">Berkas telah diunggah dan sedang diproses panitia.</p>
                                        </div>
                                    </div>
                                    <span class="badge bg-success rounded-pill px-3 py-2 d-none d-md-block">Selesai</span>
                                </div>
                            </div>
                        <?php elseif($step2_done && $butuh_revisi): ?>
                             <a href="dokumen.php" class="text-decoration-none">
                                <div class="card step-card active-danger bg-white shadow-sm hover-card border-danger">
                                    <div class="card-body d-flex align-items-center justify-content-between p-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 50px; height: 50px; font-size: 20px;"><i class="fas fa-file-upload"></i></div>
                                            <div>
                                                <h6 class="fw-bold text-danger mb-1">Tahap 2: Upload Ulang Berkas</h6>
                                                <p class="text-muted small mb-0">Terdapat berkas yang buram atau tidak sesuai. Harap unggah ulang.</p>
                                            </div>
                                        </div>
                                        <button class="btn btn-danger rounded-pill px-4 shadow-sm">Upload Ulang</button>
                                    </div>
                                </div>
                            </a>
                        <?php elseif($step1_done && !$step2_done): ?>
                            <a href="dokumen.php" class="text-decoration-none">
                                <div class="card step-card active-warning bg-white shadow-sm hover-card">
                                    <div class="card-body d-flex align-items-center justify-content-between p-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 50px; height: 50px; font-size: 20px;">2</div>
                                            <div>
                                                <h6 class="fw-bold text-warning mb-1" style="color: #d39e00 !important;">Tahap 2: Upload Berkas Dokumen</h6>
                                                <p class="text-muted small mb-0">Unggah foto Ijazah/SKL, Kartu Keluarga, dan Pas Foto.</p>
                                            </div>
                                        </div>
                                        <button class="btn btn-warning text-dark fw-bold rounded-pill px-4 shadow-sm">Lanjutkan</button>
                                    </div>
                                </div>
                            </a>
                        <?php else: ?>
                            <div class="card step-card border-secondary bg-light border-0 shadow-none opacity-75">
                                <div class="card-body d-flex align-items-center justify-content-between p-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; font-size: 20px;"><i class="fas fa-lock"></i></div>
                                        <div>
                                            <h6 class="fw-bold text-secondary mb-1">Tahap 2: Upload Berkas Dokumen</h6>
                                            <p class="text-muted small mb-0">Selesaikan Tahap 1 terlebih dahulu untuk membuka menu ini.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($step2_done): ?>
                            <a href="status.php" class="text-decoration-none">
                                <div class="card step-card active-info bg-white shadow-sm hover-card">
                                    <div class="card-body d-flex align-items-center justify-content-between p-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-info text-dark rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 50px; height: 50px; font-size: 20px;">3</div>
                                            <div>
                                                <h6 class="fw-bold text-info text-dark mb-1">Tahap 3: Cek Pengumuman</h6>
                                                <p class="text-muted small mb-0">Pantau hasil verifikasi berkas dan kelulusan Anda di sini.</p>
                                            </div>
                                        </div>
                                        <button class="btn btn-info text-dark fw-bold rounded-pill px-4 shadow-sm">Cek Status</button>
                                    </div>
                                </div>
                            </a>
                        <?php else: ?>
                            <div class="card step-card border-secondary bg-light border-0 shadow-none opacity-75">
                                <div class="card-body d-flex align-items-center justify-content-between p-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; font-size: 20px;"><i class="fas fa-lock"></i></div>
                                        <div>
                                            <h6 class="fw-bold text-secondary mb-1">Tahap 3: Cek Pengumuman</h6>
                                            <p class="text-muted small mb-0">Selesaikan proses unggah berkas untuk melihat hasil seleksi.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>