<?php
// Sertakan file konfigurasi database Anda
include 'config/config.php';

// Ambil bidang_id dari parameter URL (hasil kiriman JavaScript)
// Pastikan itu adalah angka
$bidang_id = isset($_GET['bidang_id']) ? (int)$_GET['bidang_id'] : 0;

$penerima = []; // Siapkan array kosong

if ($bidang_id > 0) {
  // Lakukan query ke database berdasarkan bidang_id
  $query = "SELECT id_penerima, jabatan, nama_penerima FROM penerima_tamu WHERE bidang_tujuan_id = $bidang_id";
  $result = mysqli_query($conn, $query);

  if ($result) {
    // Ambil semua hasil dan masukkan ke array $penerima
    while ($row = mysqli_fetch_assoc($result)) {
      $penerima[] = $row;
    }
  }
}

// Set header bahwa konten yang dikirim adalah JSON
header('Content-Type: application/json');

// Cetak data sebagai JSON
echo json_encode($penerima);

exit; // Akhiri script
?>