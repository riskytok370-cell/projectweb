<?php
$current = basename(dirname($_SERVER['PHP_SELF']));
function aktif($folder)
{
    global $current;
    return $current === $folder ? 'aktif' : '';
}
$navUser = $_SESSION['username'] ?? 'Pengguna';
$navInitial = function_exists('inisial_nama') ? inisial_nama($navUser) : strtoupper(substr($navUser, 0, 1));
?>
<aside class="sidebar" id="sidebar">
    <a href="../dashboard/index.php" class="sidebar-brand">
        <span class="brand-mark">
            <i class="bi bi-journal-text"></i>
        </span>
        <span>
            <strong>NoteClass</strong>
        </span>
    </a>

    <span class="nav-label">Menu Utama</span>
    <nav class="sidebar-nav">
        <a href="../dashboard/index.php" class="<?php echo aktif('dashboard'); ?>">
            <i class="bi bi-grid-1x2"></i>
            Dashboard
        </a>
        <a href="../mapel/index.php" class="<?php echo aktif('mapel'); ?>">
            <i class="bi bi-book"></i>
            Mapel
        </a>
        <a href="../tugas/index.php" class="<?php echo aktif('tugas'); ?>">
            <i class="bi bi-clipboard-check"></i>
            Tugas
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="../auth/logout.php" class="logout">
            <i class="bi bi-box-arrow-right"></i>
            Keluar
        </a>
    </div>
</aside>
