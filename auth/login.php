<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem | PPDB SMK TI Pratama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="bg-light d-flex align-items-center py-4" style="min-height: 100vh;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="card border-0 shadow-lg" style="border-radius: 1rem;">
                    <div class="row g-0">

                        <div class="col-md-5 d-none d-md-block">
                            <img src="../assets/img/banner_ppdb.jpeg" alt="Banner PPDB" class="img-fluid"
                                style="height: 100%; width: 100%; object-fit: cover; border-top-left-radius: 1rem; border-bottom-left-radius: 1rem;">
                        </div>

                        <div class="col-md-7">
                            <div class="card-body p-4 p-lg-5">
                                <div class="text-center mb-4 d-md-none">
                                    <img src="../assets/img/logo_smk.png" width="70" class="mb-2" alt="Logo">
                                </div>

                                <h4 class="fw-bold mb-1 text-custom-dark text-center text-md-start">Selamat Datang
                                    Kembali</h4>
                                <p class="text-muted small mb-4 text-center text-md-start">Silakan login untuk mengakses
                                    akun pendaftaran Anda.</p>

                                <form action="proses_login.php" method="POST">

                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-secondary">Username / Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-muted border-end-0"><i
                                                    class="fas fa-user"></i></span>
                                            <input type="text" name="username"
                                                class="form-control border-start-0 ps-0 bg-light"
                                                placeholder="Masukkan username" required>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <label class="form-label small fw-bold text-secondary mb-0">Password</label>
                                            <a href="lupa_password.php" class="small text-decoration-none fw-bold"
                                                style="color: #5409da;">Lupa Password?</a>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-muted border-end-0"><i
                                                    class="fas fa-lock"></i></span>
                                            <input type="password" name="password"
                                                class="form-control border-start-0 ps-0 bg-light"
                                                placeholder="Masukkan password" required>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn w-100 py-2 fw-bold shadow-sm"
                                        style="background-color: #5409da; color: white;">Masuk ke Sistem</button>
                                </form>

                                <hr class="my-4 text-muted">

                                <div class="text-center">
                                    <p class="small mb-0 text-muted">Belum memiliki akun?</p>
                                    <a href="register.php" class="text-decoration-none fw-bold"
                                        style="color: #5409da;">Daftar Akun Baru</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="../index.php" class="text-muted small text-decoration-none">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>

            </div>
        </div>
    </div>

</body>

</html>