<?php
include '../config/config.php';

$nama       = $_POST['nama'];
$telepon    = $_POST['telepon'];
$instansi   = $_POST['instansi'];
$alamat     = $_POST['alamat'];
$keperluan  = $_POST['keperluan'];
$bidang_tujuan_id = $_POST['tujuan'];
$foto       = $_FILES['foto'];
$base64Foto = $_POST['base64_foto']; 

$namaFile = "";
$targetDir = "uploads/";

if (!is_dir($targetDir)) {
  mkdir($targetDir, 0777, true);
}

if (!empty($base64Foto)) {
  $imgData = str_replace('data:image/jpeg;base64,', '', $base64Foto);
  $imgData = str_replace(' ', '+', $imgData);
  $data = base64_decode($imgData);

  $namaFile = "kamera_" . time() . ".jpg";
  $filePath = $targetDir . $namaFile;
  file_put_contents($filePath, $data);

} elseif ($foto['error'] == 0) {
  $namaFile = time() . "_" . basename($foto['name']);
  $targetFile = $targetDir . $namaFile;
  move_uploaded_file($foto['tmp_name'], $targetFile);
}

$sql = "INSERT INTO tamu (nama, no_telpon, instansi_asal, alamat, bidang_tujuan_id, keperluan, foto)
        VALUES ('$nama', '$telepon', '$instansi', '$alamat', '$bidang_tujuan_id', '$keperluan', '$namaFile')";

if (mysqli_query($conn, $sql)) {
  echo "<script>alert('Data tamu berhasil disimpan'); window.location='../index.php';</script>";
} else {
  echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
