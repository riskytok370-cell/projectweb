<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../auth/landing.php');
    exit();
}
include "../../config/koneksi.php";

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_mapel = mysqli_real_escape_string($con, trim($_POST['nama_mapel']));
    $deskripsi = mysqli_real_escape_string($con, trim($_POST['deskripsi']));
    $deadline = mysqli_real_escape_string($con, trim($_POST['deadline']));

    if ($nama_mapel == "" || $deskripsi == "" || $deadline == "") {
        $error = "Semua field harus diisi!";
    } else {
        $stmt = mysqli_prepare($con, "INSERT INTO tugas (nama_mapel, deskripsi, deadline) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $nama_mapel, $deskripsi, $deadline);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header("Location: index.php");
            exit;
        } else {
            $error = "Gagal menyimpan: " . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);
    }
}

$mapelOpts = [];
$mr = mysqli_query($con, "SELECT mapel FROM mapel ORDER BY mapel ASC");
if ($mr) {
    while ($m = mysqli_fetch_assoc($mr)) {
        $mapelOpts[] = $m['mapel'];
    }
}
?>
<?php include "../../template/header.php"; ?>
<?php include "../../template/sidebar.php"; ?>
<div class="content">
    

    <div class="card form-card">
        <?php if ($error != ""): ?>
            <p class="alert-error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nama_mapel">Mata Pelajaran</label>
                <select id="nama_mapel" name="nama_mapel" required>
                    <option value="">Pilih Mapel</option>
                    <?php foreach ($mapelOpts as $m): ?>
                        <option value="<?php echo htmlspecialchars($m); ?>"><?php echo htmlspecialchars($m); ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (count($mapelOpts) == 0): ?>
                    <small class="form-hint danger">Belum ada mapel. <a href="../mapel/tambah.php">Tambah mapel dulu</a>.</small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Tugas</label>
                <textarea id="deskripsi" name="deskripsi" rows="4"required></textarea>
            </div>

            <div class="form-group">
                <label for="deadline">Deadline</label>
                <input type="date" id="deadline" name="deadline" required>
            </div>

            <div class="form-action">
                <button type="submit" class="btn-simpan">Simpan</button>
                <a href="index.php" class="btn-batal"> Batal</a>
            </div>
        </form>
    </div>
</div>
<?php include "../../template/footer.php"; ?>
