<?php
session_start();
include '../config/koneksi.php';

// Proteksi Admin
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Data | Admin PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger mb-4 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="index.php"><i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard</a>
            <span class="navbar-text text-white">Modul Verifikasi Data Siswa</span>
        </div>
    </nav>

    <div class="container-fluid px-4">
        <div class="card border-0 shadow-sm p-4">
            <h4 class="fw-bold text-danger mb-4">Daftar Pendaftar Masuk</h4>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama Lengkap</th>
                            <th>Asal Sekolah</th>
                            <th>Dokumen</th>
                            <th>Status Saat Ini</th>
                            <th>Aksi Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        // Query JOIN tabel pendaftaran dan dokumen
                        $query = mysqli_query($koneksi, "
                            SELECT p.*, d.file_ijazah, d.file_kk, d.status_dokumen 
                            FROM pendaftaran p 
                            LEFT JOIN dokumen d ON p.id_pendaftaran = d.id_pendaftaran
                            ORDER BY p.id_pendaftaran DESC
                        ");

                        while($row = mysqli_fetch_assoc($query)):
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td><?php echo $row['nisn']; ?></td>
                            <td class="fw-bold"><?php echo $row['nama_lengkap']; ?></td>
                            <td><?php echo $row['asal_sekolah']; ?></td>
                            
                            <td class="text-center">
                                <?php if($row['file_ijazah']): ?>
                                    <a href="../assets/uploads/<?php echo $row['file_ijazah']; ?>" target="_blank" class="btn btn-sm btn-info text-white mb-1"><i class="fas fa-eye"></i> Ijazah</a>
                                    <br>
                                    <a href="../assets/uploads/<?php echo $row['file_kk']; ?>" target="_blank" class="btn btn-sm btn-info text-white"><i class="fas fa-eye"></i> KK</a>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Belum Upload</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-center">
                                <?php 
                                    if($row['status_pendaftaran'] == 'Diterima') echo '<span class="badge bg-success">Diterima</span>';
                                    else if($row['status_pendaftaran'] == 'Ditolak') echo '<span class="badge bg-danger">Ditolak</span>';
                                    else echo '<span class="badge bg-warning text-dark">Diproses</span>';
                                ?>
                            </td>

                            <td class="text-center">
                                <form action="proses_verifikasi.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id_pendaftaran" value="<?php echo $row['id_pendaftaran']; ?>">
                                    <input type="hidden" name="aksi" value="terima">
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Yakin ingin MENERIMA siswa ini?');">Terima</button>
                                </form>
                                
                                <form action="proses_verifikasi.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id_pendaftaran" value="<?php echo $row['id_pendaftaran']; ?>">
                                    <input type="hidden" name="aksi" value="tolak">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin MENOLAK siswa ini?');">Tolak</button>
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>