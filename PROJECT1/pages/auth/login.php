<?php
include '../../config/koneksi.php';
session_start();

if (isset($_SESSION['username'])) {
    header('Location: ../dashboard/index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username='$username' LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            header('Location: ../dashboard/index.php');
            exit();
        } else {
            $error = "Username atau password salah!";
        }
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk · NoteClass</title>
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

        <h2>Belajar lebih tenang, tanpa takut lupa deadline.</h2>
        <p>NoteClass merapikan mata pelajaran, tugas, dan tenggat waktu dalam satu dashboard yang sederhana.</p>

        <ul class="auth-points">
            <li>
                <i class="bi bi-check-lg"></i>
                Catat mapel beserta guru pengampunya.
            </li>
            <li>
                <i class="bi bi-check-lg"></i>
                Simpan detail tugas lengkap dengan deadline.
            </li>
            <li>
                <i class="bi bi-check-lg"></i>
                Pantau semuanya dari satu dashboard.
            </li>
        </ul>
    </aside>

    <section class="auth-panel">
        <div class="auth-card">
            <span class="auth-eyebrow">Selamat datang kembali</span>
            <h1>Masuk ke akunmu</h1>
            <p class="auth-sub">Lanjutkan mengelola tugas dan jadwal belajarmu.</p>

            <?php if (isset($error)): ?>
                <p class="alert-error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-wrap">
                        <input type="text" id="username" name="username" placeholder="Masukkan username" autocomplete="username" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <input type="password" id="password" name="password" placeholder="Masukkan password" autocomplete="current-password" required>
                    </div>
                </div>

                <button type="submit" class="btn-login"> Masuk</button>
            </form>

            <p class="auth-switch">Belum punya akun? <a href="register.php">Daftar gratis</a></p>
        </div>
    </section>
</div>
</body>
</html>
