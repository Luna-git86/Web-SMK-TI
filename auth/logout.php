<?php
// Mulai atau panggil session yang sedang berjalan
session_start();

// Hapus semua data session
session_unset();
session_destroy();

// Arahkan kembali pengguna ke halaman login
echo "<script>alert('Anda telah berhasil keluar dari sistem.'); window.location='login.php';</script>";
exit;
?>