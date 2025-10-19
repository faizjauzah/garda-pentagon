<?php
// Selalu mulai session di awal
session_start();

// Hapus semua variabel session
$_SESSION = array();

// Hancurkan session
session_destroy();

// Arahkan kembali ke halaman login (sesuaikan path jika perlu)
header("location: ../admin/index.php");
exit;
?>