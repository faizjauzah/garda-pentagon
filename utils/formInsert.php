<?php
include '../config/config.php';

// Menampilkan error jika ada (untuk debugging)
ini_set('display_errors', 1);
error_reporting(E_ALL);

$nama       = $_POST['nama'];
$telepon    = $_POST['telepon'];
$instansi   = $_POST['instansi'];
$alamat     = $_POST['alamat'];
$keperluan  = $_POST['keperluan'];

// --- PERBAIKAN LOGIKA ---
// Ambil ID departemen (1, 2, atau 3) dari input hidden
$bidang_tujuan_id = $_POST['bidang_id']; 
// Ambil ID orang (misal: 20) dari dropdown
$penerima_tamu_id = $_POST['tujuan']; 
// --- AKHIR PERBAIKAN ---

$tanggal_janji = $_POST['tanggal_janji'];
$metode_pertemuan = $_POST['metode_pertemuan'];
$foto       = $_FILES['foto'];
$base64Foto = $_POST['base64_foto']; 

$namaFile = "";
$targetDir = "../public/uploads/";

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

} elseif (isset($foto) && $foto['error'] == 0) {
  $namaFile = time() . "_" . basename($foto['name']);
  $targetFile = $targetDir . $namaFile;
  move_uploaded_file($foto['tmp_name'], $targetFile);
}

// --- PERBAIKAN QUERY ---
// Tambahkan kolom baru 'penerima_tamu_id' ke query INSERT
$stmt = $conn->prepare("INSERT INTO tamu 
  (nama, no_telpon, instansi_asal, alamat, bidang_tujuan_id, penerima_tamu_id, keperluan, tanggal_janji, metode_pertemuan, foto)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Ubah bind_param menjadi "sssiisssss" (10 parameter)
$stmt->bind_param("ssssiissss", 
  $nama, 
  $telepon, 
  $instansi, 
  $alamat, 
  $bidang_tujuan_id,  // Ini sekarang 1, 2, or 3
  $penerima_tamu_id,  // Ini ID orangnya
  $keperluan, 
  $tanggal_janji, 
  $metode_pertemuan, 
  $namaFile
);
// --- AKHIR PERBAIKAN ---

if ($stmt->execute()) {
  echo "<script>alert('Data tamu berhasil disimpan'); window.location='../index.php';</script>";
} else {
  // Tampilkan error database jika gagal
  echo "Error: " . $stmt->error;
}

$stmt->close();
mysqli_close($conn);
?>