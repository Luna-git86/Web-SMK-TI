<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pendaftaran | PPDB SMK TI Pratama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-custom mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Dashboard Siswa</a>
            <span class="text-white small">PPDB SMK TI Pratama PGRI</span>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-custom shadow-sm p-4">
                    <h3 class="fw-bold text-custom-dark mb-4 text-center">Formulir Pendaftaran Siswa Baru</h3>
                    
                    <form action="proses_siswa.php" method="POST">
                        
                        <h5 class="border-bottom border-2 border-primary pb-2 mb-3 text-custom-primary">A. Data Diri</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NISN</label>
                                <input type="text" name="nisn" class="form-control" placeholder="10 Digit NISN" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <h5 class="border-bottom border-2 border-primary pb-2 mt-4 mb-3 text-custom-primary">B. Asal Sekolah & Kontak</h5>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control" rows="2" placeholder="Nama Jalan, RT/RW, Kelurahan..." required></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Asal Sekolah (SMP/MTs)</label>
                                <input type="text" name="asal_sekolah" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor HP Siswa / Wali</label>
                                <input type="text" name="no_hp" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Aktif</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>

                        <h5 class="border-bottom border-2 border-primary pb-2 mt-4 mb-3 text-custom-primary">C. Pemilihan Jurusan</h5>
                        <div class="mb-4">
                            <label class="form-label">Pilih Program Keahlian / Jurusan</label>
                            <select name="id_jurusan" class="form-select border-primary" required>
                                <option value="">-- Silakan Pilih Jurusan --</option>
                                <option value="1">Teknik Jaringan Komputer dan Telekomunikasi (TJKT)</option>
                                <option value="2">Desain Komunikasi Visual (DKV)</option>
                                <option value="3">Pengembangan Perangkat Lunak dan GIM (PPLG)</option>
                            </select>
                            <div class="form-text">Pastikan jurusan yang dipilih sudah sesuai dengan minatmu.</div>
                        </div>

                        <button type="submit" class="btn btn-custom w-100 py-3 fw-bold fs-5 shadow-sm">Simpan Data Pendaftaran</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

</body>
</html>