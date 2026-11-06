<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: pages/auth/landing.php');
} else {
    header('Location: pages/dashboard/index.php');
}
exit();
?>
