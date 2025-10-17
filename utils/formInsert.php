<?php
include '../config/config.php';

// Ambil data dari form
$nama       = $_POST['nama'];
$telepon    = $_POST['telepon'];
$instansi   = $_POST['instansi'];
$alamat     = $_POST['alamat'];
$keperluan  = $_POST['keperluan'];
$bidang_tujuan_id = $_POST['tujuan']; // ID bidang tujuan
$foto       = $_FILES['foto'];

// Proses upload foto
$namaFile = "";
if ($foto['error'] == 0) {
  $namaFile = time() . "_" . basename($foto['name']);
  $targetDir = "uploads/";
  $targetFile = $targetDir . $namaFile;

  // Pastikan folder ada
  if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
  }

  move_uploaded_file($foto['tmp_name'], $targetFile);
}

// Query insert ke tabel tamu
$sql = "INSERT INTO tamu (nama, no_telpon, instansi_asal, alamat, bidang_tujuan_id, keperluan, foto)
        VALUES ('$nama', '$telepon', '$instansi', '$alamat', '$bidang_tujuan_id', '$keperluan', '$namaFile')";

if (mysqli_query($conn, $sql)) {
  echo "<script>alert('Data tamu berhasil disimpan'); window.location='../index.php';</script>";
} else {
  echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
