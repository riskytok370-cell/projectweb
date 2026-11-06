<?php
session_start();
$loggedIn = isset($_SESSION['username']);
$namaUser = $loggedIn ? $_SESSION['username'] : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NoteClass — Kelola Mapel & Tugas Sekolah dalam Satu Tempat</title>
    <meta name="description" content="NoteClass adalah aplikasi web sederhana untuk mencatat mata pelajaran, tugas, dan deadline sekolah agar tidak ada tugas yang terlewat.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/landing.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<header class="navbar">
    <div class="container nav-inner">
        <a href="landing.php" class="brand">
            <span class="brand-mark">
                <i class="bi bi-journal-text"></i>
            </span>
            <span>NoteClass</span>
        </a>

        <div class="nav-actions">
            <?php if ($loggedIn): ?>
                <span class="nav-user">Hai, <?php echo htmlspecialchars($namaUser); ?></span>
                <a href="../dashboard/index.php" class="btn btn-primary">Buka Dashboard</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-ghost">Masuk</a>
                <a href="register.php" class="btn btn-primary">Daftar</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<main>
    <section class="hero">
        <div class="container hero-inner">
            <div class="hero-copy">
                <h1>Semua tugas sekolahmu, <span class="gradient-text">rapi dalam satu tempat.</span></h1>
                <p class="lead">
                    NoteClass membantumu mencatat mata pelajaran, menyimpan detail tugas, dan memantau
                    deadline — supaya tidak ada lagi tugas yang terlewat atau dikerjakan mendadak.
                </p>

                <div class="hero-actions">
                    <?php if ($loggedIn): ?>
                        <a href="../dashboard/index.php" class="btn btn-primary btn-lg">Buka Dashboard Saya</a>
                    <?php else: ?>
                        <a href="register.php" class="btn btn-primary btn-lg">Mulai Sekarang — Gratis</a>
                    <?php endif; ?>
                </div>

                <div class="hero-meta">
                    <span>
                        <i class="bi bi-check-lg"></i>
                        100% gratis
                    </span>
                    <span>
                        <i class="bi bi-check-lg"></i>
                        Tanpa instalasi
                    </span>
                    <span>
                        <i class="bi bi-check-lg"></i>
                        Bisa diakses dari mana saja
                    </span>
                </div>
            </div>

            <div class="mock-wrap">
                <div class="mock">
                    <div class="mock-top">
                        <span class="mock-title">Dashboard NoteClass</span>
                    </div>
                    <div class="mock-body">
                        <div class="mock-stats">
                            <div class="mock-stat">
                                <span>Mapel</span>
                                <strong>6</strong>
                            </div>
                            <div class="mock-stat">
                                <span>Tugas</span>
                                <strong>12</strong>
                            </div>
                            <div class="mock-stat">
                                <span>Mendatang</span>
                                <strong>4</strong>
                            </div>
                        </div>

                        <div class="mock-task">
                            <span class="mock-check">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            <div>
                                <b>pemograman Web - crud</b>
                                <small>Deadline besok</small>
                            </div>
                            <span class="tag">Besok</span>
                        </div>

                        <div class="mock-task">
                            <span class="mock-check">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            <div>
                                <b>Pemograman Mobile - Modul 1</b>
                                <small>Deadline 3 hari lagi</small>
                            </div>
                            <span class="tag">3 hari</span>
                        </div>

                        <div class="mock-task done">
                            <span class="mock-check">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            <div>
                                <b>Kopja soal 1-10  </b>
                                <small>Selesai dikumpulkan</small>
                            </div>
                            <span class="tag ok">Selesai</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    

</body>
</html>
