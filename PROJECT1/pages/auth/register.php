<?php
include "../../config/koneksi.php";

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($con, trim($_POST['username']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // cek duplikat
    $cek = mysqli_query($con, "SELECT id FROM user WHERE username='$username' LIMIT 1");
    if ($cek && mysqli_num_rows($cek) > 0) {
        $error = "Username sudah digunakan!";
    } else {
        $stmt = mysqli_prepare($con, "INSERT INTO user (username, password) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header("Location: login.php");
            exit;
        } else {
            $error = "Gagal mendaftar: " . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar · NoteClass</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/auth.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="auth-body">
<div class="auth-shell">
    <aside class="auth-aside">
        <a href="landing.php" class="auth-brand">
            <span class="brand-mark">
                <i class="bi bi-journal-text"></i>
            </span>
            NoteClass
        </a>

        <h2>Satu akun untuk semua catatan sekolahmu.</h2>
        <p>Buat akun gratis dan mulai susun daftar mapel, tugas, serta deadline dalam waktu kurang dari satu menit.</p>

        <ul class="auth-points">
            <li>
                <i class="bi bi-check-lg"></i>
                Gratis, tanpa biaya tersembunyi.
            </li>
            <li>
                <i class="bi bi-check-lg"></i>
                Dashboard langsung siap dipakai.
            </li>
            <li>
                <i class="bi bi-check-lg"></i>
                Bisa dibuka dari HP maupun laptop.
            </li>
        </ul>
    </aside>

    <section class="auth-panel">
        <div class="auth-card">
            <span class="auth-eyebrow">Buat akun baru</span>
            <h1>Mulai rapikan tugasmu</h1>
            <p class="auth-sub">Isi username dan password untuk Daftar</p>

            <?php if (isset($error)): ?>
                <p class="alert-error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-wrap">
                        <i class="bi bi-person"></i>
                        <input type="text" id="username" name="username" placeholder="Pilih username" autocomplete="username" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Buat password" autocomplete="new-password" minlength="6" required>
                    </div>
                </div>

                <button class="btn-login" type="submit" name="submit"><i class="bi bi-person-plus"></i> Daftar Sekarang</button>
            </form>

            <p class="auth-switch">Sudah punya akun? <a href="login.php">Login</a></p>
        </div>
    </section>
</div>
</body>
</html>
