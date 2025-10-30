<?php
include '../config/config.php';

// PENTING: Matikan 'display_errors' agar tidak mengganggu 'header()' redirect
// Menampilkan error akan menyebabkan error "Headers already sent"
ini_set('display_errors', 0); // Ubah dari 1 ke 0
error_reporting(0); // Matikan reporting
// Anda bisa nyalakan lagi jika butuh debugging

$nama       = $_POST['nama'];
$telepon    = $_POST['telepon'];
$instansi   = $_POST['instansi'];
$alamat     = $_POST['alamat'];
$keperluan  = $_POST['keperluan'];
$bidang_tujuan_id = $_POST['bidang_id']; 
$penerima_tamu_id = $_POST['tujuan']; 
$tanggal_janji = $_POST['tanggal_janji'];
$metode_pertemuan = $_POST['metode_pertemuan'];
$foto       = $_FILES['foto'];
$base64Foto = $_POST['base64_foto']; 

$namaFile = "";
$targetDir = "../public/uploads/";

if (!is_dir($targetDir)) {
  mkdir($targetDir, 0777, true);
}

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

$stmt = $conn->prepare("INSERT INTO tamu 
  (nama, no_telpon, instansi_asal, alamat, bidang_tujuan_id, penerima_tamu_id, keperluan, tanggal_janji, metode_pertemuan, foto)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssiissss", 
  $nama, 
  $telepon, 
  $instansi, 
  $alamat, 
  $bidang_tujuan_id,
  $penerima_tamu_id,
  $keperluan, 
  $tanggal_janji, 
  $metode_pertemuan, 
  $namaFile
);

// ========================================================
// 🔹 MODIFIKASI DIMULAI DI SINI 🔹
// ========================================================
if ($stmt->execute()) {
  // Data berhasil disimpan. Sekarang siapkan redirect WA.

  // 1. Tentukan Nomor Admin
  $nomor_admin_wa = '6282322217627'; // Sesuai permintaan Anda

  // 2. Dapatkan NAMA BIDANG berdasarkan ID
  $nama_bidang = 'Tidak diketahui';
  if ($bidang_tujuan_id == 1) {
      $nama_bidang = 'Pimpinan';
  } elseif ($bidang_tujuan_id == 2) {
      $nama_bidang = 'Kepaniteraan';
  } elseif ($bidang_tujuan_id == 3) {
      $nama_bidang = 'Kesekretariatan';
  }

  // 3. Dapatkan NAMA TUJUAN (Penerima) berdasarkan ID
  $nama_tujuan = 'Tidak diketahui';
  $stmt_tujuan = $conn->prepare("SELECT nama_penerima, jabatan FROM penerima_tamu WHERE id_penerima = ?");
  $stmt_tujuan->bind_param("i", $penerima_tamu_id);
  $stmt_tujuan->execute();
  $result_tujuan = $stmt_tujuan->get_result();
  
  if ($row_tujuan = $result_tujuan->fetch_assoc()) {
      $nama_tujuan = $row_tujuan['jabatan'] . ' - ' . $row_tujuan['nama_penerima'];
  }
  $stmt_tujuan->close();

  // 4. Format data lain
  $metode = ucwords($metode_pertemuan); // Jadi 'Online' or 'Offline'
  
  // 5. Buat template pesan (\n = baris baru di WA)
  $pesan_template = "
*Konfirmasi Janji Temu Tamu*

Mohon izin, saya telah mengisi buku tamu digital dengan data sebagai berikut:

*Nama:* $nama
*No. Telepon/WA:* $telepon
*Instansi Asal:* $instansi

*Bidang Tujuan:* $nama_bidang
*Bertemu dengan:* $nama_tujuan
*Keperluan:* $keperluan
*Tanggal Janji:* $tanggal_janji
*Metode:* $metode

Mohon untuk dapat diteruskan kepada yang bersangkutan.
Terima kasih.
";
  
  // ========================================================
  // 🔹 PERBAIKAN DIMULAI DI SINI 🔹
  // ========================================================

  // 6. Rapikan pesan (HANYA hapus spasi/tab di awal baris, BUKAN \n)
  // Pola diubah dari /^\s+/m menjadi /^[ \t]+/m
  $pesan_clean_indent = trim(preg_replace('/^[ \t]+/m', '', $pesan_template));

  // 7. GANTI semua \n (baik yg diketik \n atau dari enter) menjadi \r\n
  // Ini adalah kunci agar WhatsApp mau memberi 'enter'
  $pesan_wa_ready = str_replace("\n", "\r\n", $pesan_clean_indent);

  // 8. Buat URL WhatsApp (sekarang gunakan $pesan_wa_ready)
  $wa_url = 'https://wa.me/' . $nomor_admin_wa . '?text=' . urlencode($pesan_wa_ready);
  
  // ========================================================
  // 🔹 PERBAIKAN SELESAI 🔹
  // ========================================================

  // 9. Redirect pengguna ke URL WhatsApp
  // PERHATIAN: Pastikan tidak ada 'echo' atau HTML sebelum baris ini
  header('Location: ' . $wa_url);
  
  // 10. Wajib ada exit; setelah header location
  exit;

} else {
  // Jika GAGAL, baru tampilkan error
  ini_set('display_errors', 1); // Nyalakan error lagi untuk debugging
  error_reporting(E_ALL);
  echo "Error: " . $stmt->error;
}
// ========================================================
// 🔹 MODIFIKASI SELESAI 🔹
// ========================================================

$stmt->close();
mysqli_close($conn);
?>