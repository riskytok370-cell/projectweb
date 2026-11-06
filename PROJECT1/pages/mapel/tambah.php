<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../auth/landing.php');
    exit();
}
include "../../config/koneksi.php";

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mapel = mysqli_real_escape_string($con, trim($_POST['mapel']));
    $guru = mysqli_real_escape_string($con, trim($_POST['guru']));

    if ($mapel == "" || $guru == "") {
        $error = "Semua field harus diisi!";
    } else {
        $stmt = mysqli_prepare($con, "INSERT INTO mapel (mapel, guru) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $mapel, $guru);
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
                <input type="text" id="mapel" name="mapel"  required>
            </div>
            <div class="form-group">
                <label for="guru">Nama Guru</label>
                <input type="text" id="guru" name="guru" required>
            </div>
            <div class="form-action">
                <button type="submit" class="btn-simpan"> Simpan Mapel</button>
                <a href="index.php" class="btn-batal"> Batal</a>
            </div>
        </form>
    </div>
</div>
<?php include "../../template/footer.php"; ?>
