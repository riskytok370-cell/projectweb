<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../auth/login.php');
    exit();
}
include "../../config/koneksi.php";
?>
<?php include "../../template/header.php"; ?>
<?php include "../../template/sidebar.php"; ?>
<div class="content">
    <div class="page-head">

        <a href="tambah.php" class="btn-tambah">+ Tambah Mapel</a>
    </div>

    <section class="card">
        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th style="width:60px;">No</th>
                    <th>Mata Pelajaran</th>
                    <th>Guru</th>
                    <th style="width:170px; text-align:center;">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $res = mysqli_query($con, "SELECT * FROM mapel ORDER BY id DESC");
                if ($res && mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<tr>";
                        echo "<td style='text-align:center;'>" . $no++ . "</td>";
                        echo "<td><strong>" . htmlspecialchars($row['mapel']) . "</strong></td>";
                        echo "<td>" . htmlspecialchars($row['guru']) . "</td>";
                        echo "<td style='text-align:center; white-space:nowrap;'>";
                        echo "<a href='edit.php?id=" . (int) $row['id'] . "' class='btn-edit'>Edit</a> ";
                        echo "<a href='hapus.php?id=" . (int) $row['id'] . "' class='btn-hapus' onclick=\"return confirm('Hapus mapel ini?');\">Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='empty'>Belum ada data mapel. <a href='tambah.php'>Tambah mapel pertama</a>.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
<?php include "../../template/footer.php"; ?>
