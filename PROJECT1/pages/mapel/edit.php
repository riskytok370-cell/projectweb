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
$res = mysqli_query($con, "SELECT * FROM mapel WHERE id=$id LIMIT 1");
if ($res && mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
} else {
    header("Location: index.php");
    exit;
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mapel = mysqli_real_escape_string($con, trim($_POST['mapel']));
    $guru = mysqli_real_escape_string($con, trim($_POST['guru']));

    if ($mapel == "" || $guru == "") {
        $error = "Semua field harus diisi!";
    } else {
        $stmt = mysqli_prepare($con, "UPDATE mapel SET mapel=?, guru=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "ssi", $mapel, $guru, $id);
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
                <label for="mapel">Nama Mapel</label>
                <input type="text" id="mapel" name="mapel" value="<?php echo htmlspecialchars($row['mapel']); ?>" required>
            </div>
            <div class="form-group">
                <label for="guru">Nama Guru</label>
                <input type="text" id="guru" name="guru" value="<?php echo htmlspecialchars($row['guru']); ?>" required>
            </div>
            <div class="form-action">
                <button type="submit" class="btn-simpan"><i class="bi bi-check-lg"></i> Simpan</button>
                <a href="index.php" class="btn-batal"><i class="bi bi-x-lg"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
<?php include "../../template/footer.php"; ?>
