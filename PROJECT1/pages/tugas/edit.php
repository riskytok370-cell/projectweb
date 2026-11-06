<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../auth/landing.php');
    exit();
}
include "../../config/koneksi.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    header("Location: index.php");
    exit;
}

$row = null;
$res = mysqli_query($con, "SELECT * FROM tugas WHERE id=$id LIMIT 1");
if ($res && mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
} else {
    header("Location: index.php");
    exit;
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_mapel = mysqli_real_escape_string($con, trim($_POST['nama_mapel']));
    $deskripsi = mysqli_real_escape_string($con, trim($_POST['deskripsi']));
    $deadline = mysqli_real_escape_string($con, trim($_POST['deadline']));

    if ($nama_mapel == "" || $deskripsi == "" || $deadline == "") {
        $error = "Semua field harus diisi!";
    } else {
        $stmt = mysqli_prepare($con, "UPDATE tugas SET nama_mapel=?, deskripsi=?, deadline=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "sssi", $nama_mapel, $deskripsi, $deadline, $id);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header("Location: index.php");
            exit;
        } else {
            $error = "Gagal mengupdate: " . mysqli_error($con);
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
                    <option value="">— Pilih Mapel —</option>
                    <?php foreach ($mapelOpts as $m): ?>
                        <option value="<?php echo htmlspecialchars($m); ?>" <?php echo ($m == $row['nama_mapel']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($m); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Tugas</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" required><?php echo htmlspecialchars($row['deskripsi']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="deadline">Deadline</label>
                <input type="date" id="deadline" name="deadline" value="<?php echo htmlspecialchars($row['deadline']); ?>" required>
            </div>

            <div class="form-action">
                <button type="submit" class="btn-simpan"><i class="bi bi-check-lg"></i> Simpan Perubahan</button>
                <a href="index.php" class="btn-batal"><i class="bi bi-x-lg"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
<?php include "../../template/footer.php"; ?>
