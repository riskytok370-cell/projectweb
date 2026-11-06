<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../auth/landing.php');
    exit();
}
include "../../config/koneksi.php";
include "../../template/header.php";
include "../../template/sidebar.php";

// Ambil ringkasan data
$cMapel = 0;
$cTugas = 0;
$cUpcoming = 0;
$cLate = 0;

$r = mysqli_query($con, "SELECT COUNT(*) AS c FROM mapel");
if ($r) {
    $row = mysqli_fetch_assoc($r);
    $cMapel = (int) $row['c'];
}

$r = mysqli_query($con, "SELECT COUNT(*) AS c FROM tugas");
if ($r) {
    $row = mysqli_fetch_assoc($r);
    $cTugas = (int) $row['c'];
}

$r = mysqli_query($con, "SELECT COUNT(*) AS c FROM tugas WHERE deadline >= CURDATE()");
if ($r) {
    $row = mysqli_fetch_assoc($r);
    $cUpcoming = (int) $row['c'];
}

$r = mysqli_query($con, "SELECT COUNT(*) AS c FROM tugas WHERE deadline < CURDATE()");
if ($r) {
    $row = mysqli_fetch_assoc($r);
    $cLate = (int) $row['c'];
}

$username = $_SESSION['username'];
?>
<div class="content">
    <section class="hero-panel">

        <div class="hero-copy">
            <h1>Halo, <?php echo htmlspecialchars($username); ?></h1>
            <p>Kamu punya <strong><?php echo $cUpcoming; ?> tugas mendatang</strong>. </p>
        </div>

    </section>

    <div class="stats-grid">
        <article class="stat-card">
            <span class="stat-icon indigo">
                <i class="bi bi-book"></i>
            </span>
            <span>Total Mapel</span>
            <strong><?php echo $cMapel; ?></strong>
        </article>

        <article class="stat-card">
            <span class="stat-icon violet">
                <i class="bi bi-clipboard-check"></i>
            </span>
            <span>Total Tugas</span>
            <strong><?php echo $cTugas; ?></strong>
        </article>

        <article class="stat-card">
            <span class="stat-icon amber">
                <i class="bi bi-clock"></i>
            </span>
            <span>Tugas Mendatang</span>
            <strong><?php echo $cUpcoming; ?></strong>
        </article>

        <article class="stat-card">
            <span class="stat-icon rose">
                <i class="bi bi-exclamation-triangle"></i>
            </span>
            <span>Terlewat</span>
            <strong><?php echo $cLate; ?></strong>
        </article>
    </div>

    <section class="card">
        <div class="card-head">
            <div>
                <h2>Tugas</h2>
            </div>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th style="width:60px;">No</th>
                    <th>Mapel</th>
                    <th>Deskripsi</th>
                    <th>Deadline</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $res = mysqli_query($con, "SELECT * FROM tugas ORDER BY deadline ASC LIMIT 10");
                if ($res && mysqli_num_rows($res) > 0) {
                    while ($t = mysqli_fetch_assoc($res)) {
                        echo "<tr>";
                        echo "<td style='text-align:center;'>" . $no++ . "</td>";
                        echo "<td><strong>" . htmlspecialchars($t['nama_mapel']) . "</strong></td>";
                        echo "<td>" . htmlspecialchars($t['deskripsi']) . "</td>";
                        echo "<td><div class='deadline'><span>" . htmlspecialchars(tanggal_id($t['deadline'])) . "</span>" . deadline_badge($t['deadline']) . "</div></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='empty'>Belum ada tugas. <a href='../tugas/tambah.php'>Tambah tugas pertama</a>.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
<?php include "../../template/footer.php"; ?>
