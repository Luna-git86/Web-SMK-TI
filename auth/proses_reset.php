<?php
session_start();
include '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari form dan amankan dari karakter aneh
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password_baru = mysqli_real_escape_string($koneksi, $_POST['password_baru']);

    // 1. Cek apakah username/email tersebut ada di tabel users (siswa)
    $cek_user = mysqli_query($koneksi, "SELECT id_user FROM users WHERE username = '$username'");

    if (mysqli_num_rows($cek_user) > 0) {
        // Jika email ditemukan, acak password barunya
        $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

        // Update database dengan password yang baru
        $update = mysqli_query($koneksi, "UPDATE users SET password = '$password_hash' WHERE username = '$username'");

        if ($update) {
            echo "<script>
                    alert('Berhasil! Password Anda telah diperbarui. Silakan login menggunakan password baru.');
                    window.location.href = 'login.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal memperbarui password karena kesalahan sistem.');
                    window.location.href = 'lupa_password.php';
                  </script>";
        }
    } else {
        // Jika email tidak ditemukan di database
        echo "<script>
                alert('Maaf, Username atau Email tersebut tidak terdaftar di sistem kami!');
                window.location.href = 'lupa_password.php';
              </script>";
    }
} else {
    // Jika ada yang mencoba mengakses file ini langsung dari URL
    header("Location: lupa_password.php");
    exit;
}
?>