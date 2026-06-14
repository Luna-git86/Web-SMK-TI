<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
// Ambil data (asumsi tabel jurusan sudah dibuat, jika belum tampilkan ID saja)
$query = mysqli_query($koneksi, "
    SELECT p.*, j.nama_jurusan 
    FROM pendaftaran p 
    LEFT JOIN jurusan j ON p.id_jurusan = j.id_jurusan 
    WHERE p.id_user = '$id_user' AND p.status_pendaftaran = 'Diterima'
");

$data = mysqli_fetch_assoc($query);

// Jika mencoba nge-cheat print padahal belum lulus
if (!$data) {
    echo "<script>alert('Akses Ditolak! Anda belum dinyatakan Lulus.'); window.close();</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Bukti Kelulusan - <?php echo $data['nama_lengkap']; ?></title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; color: #000; line-height: 1.5; }
        .kertas-print { width: 800px; margin: 0 auto; padding: 20px; border: 1px solid #fff; }
        .kop-surat { text-align: center; border-bottom: 3px solid #000; padding-bottom: 15px; margin-bottom: 20px; }
        .kop-surat img { width: 80px; float: left; margin-top: 10px; }
        .kop-surat h2, .kop-surat h3, .kop-surat p { margin: 0; }
        .tabel-data { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 16px; }
        .tabel-data td { padding: 8px; vertical-align: top; }
        .td-label { width: 30%; font-weight: bold; }
        .td-titik { width: 2%; }
        .tanda-tangan { float: right; width: 250px; text-align: center; margin-top: 50px; }
        
        /* Hilangkan elemen tidak penting saat diprint betulan */
        @media print {
            body { background: #fff; }
            .kertas-print { border: none; width: 100%; }
        }
    </style>
</head>
<body onload="window.print()"> <div class="kertas-print">
        <div class="kop-surat">
            <img src="../assets/img/logo_smk.png" alt="Logo Sekolah">
            <h2>PANITIA PPDB TAHUN AJARAN 2026/2027</h2>
            <h3>SMK TI PRATAMA PGRI SAMARINDA</h3>
            <p>Jl. Komplek Pelita 3, Kota Samarinda, Kalimantan Timur</p>
            <p>Website: www.smktipratama.sch.id | Email: info@smktipratama.sch.id</p>
            <div style="clear: both;"></div>
        </div>

        <h3 style="text-align: center; text-decoration: underline;">BUKTI KELULUSAN SISWA BARU</h3>
        <p style="text-align: center; margin-top: -10px;">Nomor Registrasi: REG-<?php echo date('Y') . sprintf("%04d", $data['id_pendaftaran']); ?></p>

        <p>Berdasarkan hasil seleksi dan verifikasi dokumen, Panitia Penerimaan Peserta Didik Baru (PPDB) SMK TI Pratama PGRI Samarinda menyatakan bahwa:</p>

        <table class="tabel-data">
            <tr>
                <td class="td-label">NISN</td>
                <td class="td-titik">:</td>
                <td><?php echo $data['nisn']; ?></td>
            </tr>
            <tr>
                <td class="td-label">Nama Lengkap</td>
                <td class="td-titik">:</td>
                <td><strong><?php echo strtoupper($data['nama_lengkap']); ?></strong></td>
            </tr>
            <tr>
                <td class="td-label">Tempat, Tgl Lahir</td>
                <td class="td-titik">:</td>
                <td><?php echo $data['tempat_lahir'] . ', ' . date('d-m-Y', strtotime($data['tanggal_lahir'])); ?></td>
            </tr>
            <tr>
                <td class="td-label">Asal Sekolah</td>
                <td class="td-titik">:</td>
                <td><?php echo $data['asal_sekolah']; ?></td>
            </tr>
            <tr>
                <td class="td-label">Jurusan Diterima</td>
                <td class="td-titik">:</td>
                <td><strong><?php echo $data['nama_jurusan'] ?? 'Jurusan ' . $data['id_jurusan']; ?></strong></td>
            </tr>
        </table>

        <p style="margin-top: 20px;">Dinyatakan <strong>LULUS / DITERIMA</strong>.</p>
        <p>Surat ini merupakan bukti sah kelulusan. Harap dibawa beserta berkas persyaratan asli lainnya (Ijazah/SKL, KK, dan Pas Foto) pada saat proses Daftar Ulang ke sekolah.</p>

        <div class="tanda-tangan">
            <p>Samarinda, <?php echo date('d F Y'); ?></p>
            <p>Ketua Panitia PPDB,</p>
            <br><br><br>
            <p><strong>( ____________________ )</strong></p>
            <p>NIP. .........................</p>
        </div>
    </div>

</body>
</html>