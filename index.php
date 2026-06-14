<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB | SMK TI Pratama PGRI Samarinda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #5409da;">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
                <img src="assets/img/logo_smk.png" alt="Logo" height="40" class="me-2 bg-white rounded p-1">
                SMK TI PRATAMA PGRI
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#jurusan">Program Keahlian</a></li>
                    <li class="nav-item"><a class="nav-link" href="#informasi">Informasi Pendaftaran</a></li>
                </ul>
                <div class="d-flex ms-lg-3 mt-3 mt-lg-0">
                    <a href="auth/login.php" class="btn btn-outline-light me-2 fw-bold">Masuk</a>
                    <a href="auth/register.php" class="btn btn-warning fw-bold text-dark">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start">
                    <span class="badge bg-primary px-3 py-2 rounded-pill mb-3">Tahun Ajaran 2026/2027</span>
                    <h1 class="display-4 fw-bold text-dark mb-3">
                        Penerimaan Peserta Didik Baru (PPDB)
                    </h1>
                    <h2 class="h4 text-muted mb-4">
                        SMK TI Pratama PGRI Samarinda
                    </h2>
                    <p class="lead mb-5">
                        Siap Kerja, Santun, Mandiri, dan Kreatif! Bergabunglah bersama kami dan jadilah generasi digital
                        yang unggul di bidang Teknologi Informasi dan Desain.
                    </p>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-lg-start">
                        <a href="auth/register.php"
                            class="btn btn-primary btn-lg px-5 py-3 shadow-sm fw-bold rounded-pill">
                            <i class="fas fa-user-plus me-2"></i> Buat Akun Pendaftaran
                        </a>
                        <a href="#jurusan" class="btn btn-outline-secondary btn-lg px-4 py-3 rounded-pill">
                            Lihat Jurusan
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 text-center">
                    <img src="assets/img/banner_ppdb.jpeg" alt="Brosur PPDB SMK TI Pratama"
                        class="img-fluid rounded-4 shadow-lg border border-3 border-white" style="max-height: 650px;">
                </div>

            </div>
        </div>
    </section>

    <section id="jurusan" class="py-5 bg-white">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h3 class="fw-bold text-uppercase" style="color: #5409da;">Kompetensi Keahlian</h3>
                <p class="text-muted">Pilih program keahlian yang sesuai dengan minat dan bakatmu.</p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center card-custom">
                        <div class="card-body p-4">
                            <div class="bg-warning text-dark rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 70px; height: 70px; font-size: 30px;">
                                <i class="fas fa-network-wired"></i>
                            </div>
                            <h4 class="fw-bold text-dark">TJKT</h4>
                            <p class="text-muted small">Teknik Jaringan Komputer dan Telekomunikasi</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center card-custom">
                        <div class="card-body p-4">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 70px; height: 70px; font-size: 30px;">
                                <i class="fas fa-palette"></i>
                            </div>
                            <h4 class="fw-bold text-dark">DKV</h4>
                            <p class="text-muted small">Desain Komunikasi Visual</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center card-custom">
                        <div class="card-body p-4">
                            <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 70px; height: 70px; font-size: 30px;">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <h4 class="fw-bold text-dark">PPLG</h4>
                            <p class="text-muted small">Pengembangan Perangkat Lunak dan Gim</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="informasi" class="py-5" style="background-color: #f8f9fa;">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h3 class="fw-bold text-uppercase" style="color: #5409da;">Informasi Pendaftaran</h3>
                <p class="text-muted">Simak syarat kelengkapan berkas dan jadwal pelaksanaan penerimaan siswa baru.</p>
            </div>

            <div class="row g-4">

                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100 p-4" style="border-radius: 1rem;">
                        <h5 class="fw-bold mb-4 text-dark"><i class="fas fa-file-alt text-primary me-2"></i>Syarat
                            Dokumen Fisik</h5>

                        <div class="d-flex align-items-start mb-3">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width: 35px; height: 35px;"><i class="fas fa-check small"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Scan / Foto Ijazah atau SKL</h6>
                                <p class="text-muted small mb-0">Surat Keterangan Lulus dari jenjang pendidikan
                                    sebelumnya yang asli atau telah dilegalisir.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width: 35px; height: 35px;"><i class="fas fa-check small"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Scan / Foto Kartu Keluarga</h6>
                                <p class="text-muted small mb-0">Kartu Keluarga asli yang memperlihatkan Nomor Induk
                                    Kependudukan (NIK) siswa.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width: 35px; height: 35px;"><i class="fas fa-check small"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Pas Foto Berwarna</h6>
                                <p class="text-muted small mb-0">Foto diri resmi ukuran 3x4 dengan rasio yang sesuai
                                    untuk kebutuhan administrasi sekolah.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100 p-4" style="border-radius: 1rem;">
                        <h5 class="fw-bold mb-4 text-dark"><i class="fas fa-calendar-check text-warning me-2"></i>Jadwal
                            Pelaksanaan 2026</h5>

                        <div class="border-start border-3 border-warning ps-3 mb-4 ms-2">
                            <h6 class="fw-bold mb-0">Pendaftaran Gelombang Utama</h6>
                            <p class="text-muted small mb-3">01 Mei 2026 - 30 Juni 2026</p>

                            <h6 class="fw-bold mb-0">Proses Verifikasi Berkas</h6>
                            <p class="text-muted small mb-3">02 Mei 2026 - 05 Juli 2026</p>

                            <h6 class="fw-bold mb-0">Pengumuman Kelulusan Akhir</h6>
                            <p class="text-muted small">07 Juli 2026</p>
                        </div>

                        <div class="alert alert-info border-0 shadow-sm small mt-auto mb-0"
                            style="border-radius: 0.75rem;">
                            <strong><i class="fas fa-info-circle me-1"></i> Perhatian:</strong> Seluruh pendaftaran
                            dilakukan secara daring. Bukti fisik asli hanya dibawa ke sekolah saat Anda dinyatakan lulus
                            dan melakukan daftar ulang.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container text-center">
            <p class="mb-0 small">&copy; 2026 PPDB SMK TI Pratama PGRI Samarinda. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>