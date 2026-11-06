<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/helpers.php';

$currentPage = basename(dirname($_SERVER['PHP_SELF'])) . '/' . basename($_SERVER['PHP_SELF']);
$pageTitles = [
    'dashboard/index.php' => 'Dashboard',
    'mapel/index.php'     => 'Data Mapel',
    'tugas/index.php'     => 'Data Tugas',
    'mapel/tambah.php'    => 'Tambah Mapel',
    'mapel/edit.php'      => 'Edit Mapel',
    'tugas/tambah.php'    => 'Tambah Tugas',
    'tugas/edit.php'      => 'Edit Tugas',
];
$pageSubtitles = [
    'dashboard/index.php' => 'Ringkasan belajar hari ini',
    'mapel/index.php'     => 'Kelola mata pelajaran dan guru',
    'tugas/index.php'     => 'Pantau semua tugas dan deadline',
    'mapel/tambah.php'    => 'Simpan mata pelajaran baru',
    'mapel/edit.php'      => 'Perbarui data mata pelajaran',
    'tugas/tambah.php'    => 'Catat tugas baru beserta tenggatnya',
    'tugas/edit.php'      => 'Perbarui detail tugas',
];
$pageTitle = $pageTitles[$currentPage] ?? 'NoteClass';
$pageSubtitle = $pageSubtitles[$currentPage] ?? 'Study Planner';
$username = $_SESSION['username'] ?? 'Pengguna';
$initial = inisial_nama($username);

$bulanSingkat = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
$tanggalHariIni = date('d') . ' ' . $bulanSingkat[(int) date('n')] . ' ' . date('Y');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> · NoteClass</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<div class="app">
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <header class="topbar">
        <div class="topbar-left">
            <button type="button" class="icon-btn menu-btn" id="menuToggle" aria-label="Buka menu navigasi" aria-controls="sidebar">
                <i class="bi bi-list"></i>
            </button>
            <div>
                <span class="topbar-eyebrow"><?php echo htmlspecialchars($pageSubtitle); ?></span>
                <h1 class="topbar-title"><?php echo htmlspecialchars($pageTitle); ?></h1>
            </div>
        </div>

        <div class="topbar-right">
            <span class="date-chip">
                <i class="bi bi-calendar3"></i>
                <?php echo htmlspecialchars($tanggalHariIni); ?>
            </span>
            <div class="user-chip">
                <span class="avatar"><?php echo htmlspecialchars($initial); ?></span>
                <span class="user-meta">
                    <strong><?php echo htmlspecialchars($username); ?></strong>
                    <small>Pelajar</small>
                </span>
            </div>
        </div>
    </header>
