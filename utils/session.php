<?php
// Mulai session
session_start();

// Cek apakah pengguna sudah login atau belum
// Jika session 'loggedin' tidak ada atau tidak bernilai true
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Arahkan paksa ke halaman login
    header("Location: ../admin/index.php");
    exit; // Pastikan script berhenti setelah redirect
}
?>