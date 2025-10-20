<?php
include '../config/config.php';

$nama       = $_POST['nama'];
$telepon    = $_POST['telepon'];
$instansi   = $_POST['instansi'];
$alamat     = $_POST['alamat'];
$keperluan  = $_POST['keperluan'];
$bidang_tujuan_id = $_POST['tujuan'];
$tanggal_janji = $_POST['tanggal_janji'];
$metode_pertemuan = $_POST['metode_pertemuan'];
$foto       = $_FILES['foto'];
$base64Foto = $_POST['base64_foto']; 

$namaFile = "";
$targetDir = "uploads/";

// Buat folder upload jika belum ada
if (!is_dir($targetDir)) {
  mkdir($targetDir, 0777, true);
}

// Simpan gambar dari kamera atau upload file biasa
if (!empty($base64Foto)) {
  $imgData = preg_replace('#^data:image/\w+;base64,#i', '', $base64Foto);
  $data = base64_decode($imgData);
  $namaFile = "kamera_" . time() . ".jpg";
  $filePath = $targetDir . $namaFile;
  file_put_contents($filePath, $data);

} elseif ($foto['error'] == 0) {
  $namaFile = time() . "_" . basename($foto['name']);
  $targetFile = $targetDir . $namaFile;
  move_uploaded_file($foto['tmp_name'], $targetFile);
}

// Query insert dengan kolom baru
$sql = "INSERT INTO tamu 
        (nama, no_telpon, instansi_asal, alamat, bidang_tujuan_id, keperluan, tanggal_janji, metode_pertemuan, foto)
        VALUES 
        ('$nama', '$telepon', '$instansi', '$alamat', '$bidang_tujuan_id', '$keperluan', '$tanggal_janji', '$metode_pertemuan', '$namaFile')";

if (mysqli_query($conn, $sql)) {
  echo "<script>alert('Data tamu berhasil disimpan'); window.location='../index.php';</script>";
} else {
  echo 'Error: ' . mysqli_error($conn);
}

mysqli_close($conn);
?>
