<?php
session_start();

// Hapus semua data sesi
session_destroy();

// Redirect pengguna ke halaman login atau halaman lain (misalnya index.php)
header("location: ../views/index.php");
exit;
?>
