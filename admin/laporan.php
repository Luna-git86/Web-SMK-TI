<?php
session_start();
include '../config/koneksi.php';

// Proteksi Admin
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

// Mengambil tanggal hari ini untuk dicetak di laporan
$tanggal_cetak = date('d F Y');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Rekapitulasi PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Desain Khusus untuk Tampilan Print / PDF */
        @media print {
            body { background-color: #fff !important; font-size: 12px; }
            .no-print { display: none !important; } /* Sembunyikan tombol saat diprint */
            .card { border: none !important; box-shadow: none !important; }
            .kop-surat { border-bottom: 3px solid #000; padding-bottom: 15px; margin-bottom: 20px; text-align: center; }
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 1px solid #000 !important; padding: 5px; }
            .badge { border: none; color: #000; font-weight: bold; background: none !important; }
        }
        
        /* Desain untuk Layar Monitor */
        .kop-surat { display: none; } /* Sembunyikan kop surat di monitor, hanya muncul saat print */
        @media screen {
            .kop-surat-screen { text-align: center; margin-bottom: 20px; }
        }
    </style>
</head>
<body class="bg-light pb-5">

    <div class="container mt-4 mb-3 no-print">
        <div class="d-flex justify-content-between align-items-center">
            <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
            <div>
                <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print me-2"></i>Cetak Laporan / PDF</button>
            </div>
        </div>
    </div>

    <div class="container-fluid px-md-5">
        <div class="card border-0 shadow-sm p-4">
            
            <div class="kop-surat">
                <h3 class="mb-0 fw-bold">PANITIA PENERIMAAN PESERTA DIDIK BARU</h3>
                <h2 class="mb-0 fw-bold">SMK TI PRATAMA PGRI SAMARINDA</h2>
                <p class="mb-0">Tahun Ajaran 2026/2027</p>
                <p class="small">Jl. Pahlawan No. 1, Kota Samarinda, Kalimantan Timur</p>
            </div>

            <div class="kop-surat-screen no-print">
                <h4 class="fw-bold text-dark">Rekapitulasi Data Pendaftaran PPDB</h4>
                <p class="text-muted">Total data seluruh pendaftar yang masuk ke sistem.</p>
            </div>

            <h5 class="text-center fw-bold mb-4 print-only-title" style="display:none;">LAPORAN DATA PENDAFTAR MASUK</h5>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">No. Registrasi</th>
                            <th width="20%">Nama Lengkap</th>
                            <th width="15%">NISN</th>
                            <th width="20%">Asal Sekolah</th>
                            <th width="15%">Pilihan Jurusan</th>
                            <th width="10%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        // Ambil data pendaftaran dan hubungkan dengan nama jurusan
                        $query = mysqli_query($koneksi, "
                            SELECT p.*, j.nama_jurusan 
                            FROM pendaftaran p 
                            LEFT JOIN jurusan j ON p.id_jurusan = j.id_jurusan
                            ORDER BY p.id_pendaftaran ASC
                        ");

                        if(mysqli_num_rows($query) > 0) {
                            while($row = mysqli_fetch_assoc($query)) {
                                // Format Nomor Registrasi (Contoh: REG-20260001)
                                $no_reg = "REG-" . date('Y') . sprintf("%04d", $row['id_pendaftaran']);
                                
                                // Pewarnaan Status
                                $badge_color = 'bg-warning text-dark';
                                if($row['status_pendaftaran'] == 'Diterima') $badge_color = 'bg-success';
                                if($row['status_pendaftaran'] == 'Ditolak') $badge_color = 'bg-danger';

                                echo "<tr>";
                                echo "<td>{$no}</td>";
                                echo "<td class='fw-bold'>{$no_reg}</td>";
                                echo "<td class='text-start'>{$row['nama_lengkap']}</td>";
                                echo "<td>{$row['nisn']}</td>";
                                echo "<td>{$row['asal_sekolah']}</td>";
                                echo "<td>" . ($row['nama_jurusan'] ?? 'Belum Pilih') . "</td>";
                                echo "<td><span class='badge {$badge_color}'>{$row['status_pendaftaran']}</span></td>";
                                echo "</tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center text-muted py-4'>Belum ada data pendaftar masuk.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-5 text-end pe-5" style="display: none;" id="area-ttd">
                <p class="mb-1">Samarinda, <?php echo $tanggal_cetak; ?></p>
                <p class="mb-5">Ketua Panitia PPDB,</p>
                <p class="fw-bold mb-0">( ____________________ )</p>
                <p>NIP. .........................</p>
            </div>

        </div>
    </div>

    <script>
        window.onbeforeprint = function() {
            document.getElementById('area-ttd').style.display = 'block';
            document.querySelector('.print-only-title').style.display = 'block';
        };
        window.onafterprint = function() {
            document.getElementById('area-ttd').style.display = 'none';
            document.querySelector('.print-only-title').style.display = 'none';
        };
    </script>
</body>
</html>