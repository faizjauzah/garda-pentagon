<?php
include 'config/config.php';

// Ambil bidang dari URL
$bidang = $_GET['bidang'] ?? 'pimpinan';

// Tentukan judul dan ID bidang untuk penyimpanan
switch ($bidang) {
  case 'kepaniteraan':
    $judul = 'Buku Presensi Tamu Kepaniteraan';
    $id_bidang = 2;
    break;
  case 'kesekretariatan':
    $judul = 'Buku Presensi Tamu Kesekretariatan';
    $id_bidang = 3;
    break;
  default:
    $judul = 'Buku Presensi Tamu Pimpinan';
    $id_bidang = 1;
    break;
}

// 🔹 Tambahkan query bidang_tujuan di sini
$bidangResult = mysqli_query($conn, "SELECT * FROM penerima_tamu where bidang_tujuan_id = $id_bidang");

if (!$bidangResult) {
  die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Buku Presensi Tamu Pimpinan</title>
    <link rel="stylesheet" href="public/css/output.css">
  </head>
  <body class="bg-white w-full min-h-screen flex flex-col">
    <!-- Header -->
    <header class="w-full h-[115px] flex items-center justify-center bg-white shadow-[0px_4px_9px_#00000040]">
      <div class="flex items-center gap-3 sm:gap-5 px-4">
        <img src="public/images/logo-pengadilan-tinggi-agama-gorontalo-1.png" alt="Logo pengadilan" class="w-[40px] h-[50px] sm:w-[59px] sm:h-[73px] object-cover" />
        <img src="public/images/pan-rb-qdw0uf2dup27vg4nbkjrrm75c0xvmz2s0pbnrvyh3o-1.png" alt="Pan RB" class="w-[50px] h-[50px] sm:w-[73px] sm:h-[73px] object-cover" />
        <img src="public/images/logo-berakhlak-1024x390-1.png" alt="Logo berakhlak" class="w-[100px] h-[38px] sm:w-[142px] sm:h-[54px] object-cover" />
      </div>
    </header>

    <!-- Main -->
    <main class="flex flex-col items-center px-4 sm:px-6 lg:px-8 py-6 sm:py-12">
      <div class="w-full max-w-[1195px]">
        <!-- Back button -->        
        <button onclick="window.location.href='index.php';" class="flex items-center gap-2 sm:gap-[17px] bg-[#1d4c08] hover:bg-[#1d4c08]/90 rounded-full h-9 sm:h-11 px-4 sm:px-[21px] mb-3 sm:mb-4 text-white transition-all duration-200">
          <img src="public/images/arrow-2.svg" alt="Kembali" class="w-4 h-3 sm:w-[21px] sm:h-[14.73px]" />
          <span class="font-medium text-xs sm:text-sm">Kembali</span>
        </button>
        <!-- Title -->
        <h1 class="font-semibold text-black text-2xl sm:text-3xl lg:text-4xl text-center mb-8 sm:mb-12"><?= $judul; ?></h1>

        <!-- <button onclick="window.location.href='index.php';" class="flex items-center gap-[17px] bg-[#1d4c08] hover:bg-[#1d4c08]/90 rounded-[100px] h-11 px-[21px] mb-4 sm:mb-2 text-white">
          <img src="public/images/arrow-2.svg" alt="Kembali" class="w-[21px] h-[14.73px]" />
          <span class="font-medium text-sm">Kembali</span>
        </button> -->
        
        <!-- Form -->
        <form id=formtamu class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-[46px] mb-8 sm:mb-12" enctype="multipart/form-data" method="POST" action="utils/formInsert.php">
          <!-- Left column -->
          <div class="flex flex-col gap-5 sm:gap-6">
            <div class="flex flex-col gap-2.5">
              <label for="nama" class="font-semibold text-[#666666] text-base">Nama</label>
              <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" class="p-3 sm:p-4 bg-white rounded-lg border border-[#cccccc] text-[#666666] text-base" required />
            </div>

            <div class="flex flex-col gap-2.5">
              <label for="telepon" class="font-semibold text-[#666666] text-base">No. Telepon / WhatsApp</label>
              <input type="text" id="telepon" name="telepon" placeholder="Masukkan No. Telepon / WhatsApp" class="p-3 sm:p-4 bg-white rounded-lg border border-[#cccccc] text-[#666666] text-base" required />
              <p class="text-[#666666] text-xs leading-[18px]">Nomor telepon harus diawali dengan kode negara. Contoh: 628123456789</p>
            </div>

            <div class="flex flex-col gap-2.5">
              <label for="instansi" class="font-semibold text-[#666666] text-base">Instansi Asal</label>
              <input type="text" id="instansi" name="instansi" placeholder="Masukkan Instansi" class="p-3 sm:p-4 bg-white rounded-lg border border-[#cccccc] text-[#666666] text-base" required />
            </div>

            <div class="flex flex-col gap-2.5">
              <label for="alamat" class="font-semibold text-[#666666] text-base">Alamat</label>
              <input type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat" class="p-3 sm:p-4 bg-white rounded-lg border border-[#cccccc] text-[#666666] text-base" required />
            </div>

            <div class="flex flex-col gap-2.5">
              <label for="tujuan" class="font-semibold text-[#666666] text-base">Tujuan</label>
              <select id="tujuan" name="tujuan" class="p-3 sm:p-4 bg-white rounded-lg border border-[#cccccc] text-[#666666] text-base" required>
                <option selected disabled>Pilih Tujuan</option>
                <?php while ($b = mysqli_fetch_assoc($bidangResult)) { ?>
                  <option value="<?= $b['id_penerima']; ?>"><?= $b['nama_penerima']; ?></option>
                  <?php } ?>
              </select>
            </div>

            <div class="flex flex-col gap-2.5">
              <label for="keperluan" class="font-semibold text-[#666666] text-base">Keperluan</label>
              <input type="text" id="keperluan" name="keperluan" placeholder="Masukkan Keperluan" class="p-3 sm:p-4 bg-white rounded-lg border border-[#cccccc] text-[#666666] text-base" required />
            </div>
          </div>

          <!-- Right column -->
          <div class="flex flex-col gap-5">
            <label for="foto" class="font-semibold text-[#666666] text-base">Unggah Foto Diri</label>

            <label id="upload-area" class="relative flex flex-col items-center justify-center px-6 sm:px-10 py-6 sm:py-12 bg-white rounded-lg border border-dashed border-neutral-300 cursor-pointer transition hover:bg-gray-50 overflow-hidden min-h-[350px]">
              <img id="upload-icon" src="public/images/ic-round-plus.svg" alt="Upload" class="w-[50px] h-[50px]" />
              <img id="preview-image" class="hidden w-full max-w-[650px] object-contain rounded-lg border border-gray-300 mt-3" alt="Preview Gambar" />
              <p id="upload-text" class="text-[#474747] text-sm sm:text-base text-center max-w-[280px]">Klik atau seret file ke area ini untuk mengunggah gambar</p>
              <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png" class="hidden" />
            </label>

            <p class="text-[#9c9c9c] text-sm">Format yang diterima adalah .jpg, .jpeg, dan .png</p>

            <img src="public/images/divider-line.svg" alt="Divider" class="w-full h-px object-cover" />
            <!-- Alert container -->
            <div id="alert-container" class="fixed top-4 right-4 hidden z-50"></div>
          </div>
        </form>

        <!-- Submit -->
        <button type="submit" form=formtamu class="w-full h-11 bg-[#1d4c08] hover:bg-[#1d4c08]/90 rounded-[100px] text-white font-medium text-sm">Kirim</button>
      </div>
    </main>

    <!-- JS -->
    <script src = "public/js/main.js"></script>
    <!-- <script src="public/js/alert.js"></script> -->
  </body>
</html>
