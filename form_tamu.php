<?php
include 'config/config.php';

// Logika $_GET['bidang'] tidak lagi diperlukan karena akan dipilih di form
// Judul sekarang statis
$judul = 'Buku Presensi Tamu';

// Query $bidangResult juga tidak diperlukan di sini,
// karena akan diambil melalui AJAX
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Buku Presensi Tamu</title>
    <link rel="stylesheet" href="public/css/output.css">
  </head>
  <body class="bg-white w-full min-h-screen flex flex-col">
    <header class="w-full h-[115px] flex items-center justify-center bg-white shadow-[0px_4px_9px_#00000040]">
      <div class="flex items-center gap-3 sm:gap-5 px-4">
        <img src="public/images/logo-semua.png" alt="Logo" class="h-12 w-auto md:h-[73px] md:w-auto ml-0 md:ml-8 lg:ml-[120px]" />
      </div>
    </header>

    <main class="flex flex-col items-center px-4 sm:px-6 lg:px-8 py-6 sm:py-12">
      <div class="w-full max-w-[1195px]">
        <button onclick="window.location.href='index.php';" class="flex items-center gap-2 sm:gap-[17px] bg-[#1d4c08] hover:bg-[#256a10] rounded-full h-9 sm:h-11 px-4 sm:px-[21px] mb-3 sm:mb-4 text-white transition-all duration-200">
          <img src="public/images/arrow-2.svg" alt="Kembali" class="w-4 h-3 sm:w-[21px] sm:h-[14.73px]" />
          <span class="font-medium text-xs sm:text-sm">Kembali</span>
        </button>
        <h1 class="font-semibold text-black text-2xl sm:text-3xl lg:text-4xl text-center mb-8 sm:mb-12"><?= $judul; ?></h1>
        
        <form id="formtamu" class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-[46px] mb-8 sm:mb-12" enctype="multipart/form-data" method="POST" action="utils/formInsert.php">
          <div class="flex flex-col gap-5 sm:gap-6">
            <div class="flex flex-col gap-2.5">
              <label for="nama" class="font-semibold text-[#666666] text-base">Nama</label>
              <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" class="p-3 sm:p-4 bg-white rounded-lg border border-[#cccccc] text-[#666666] text-base" required />
            </div>

            <div class="flex flex-col gap-2.5">
              <label for="telepon" class="font-semibold text-[#666666] text-base">No. Telepon / WhatsApp</label>
              <input type="text" id="telepon" name="telepon" placeholder="Masukkan No. Telepon / WhatsApp" class="p-3 sm:p-4 bg-white rounded-lg border border-[#cccccc] text-[#666666] text-base" inputmode="numeric" pattern="^62\d{6,13}$"oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />
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
              <label for="bidang" class="font-semibold text-[#666666] text-base">Bidang Tujuan</label>
              <select id="bidang" name="bidang_id" class="p-3 sm:p-4 bg-white rounded-lg border border-[#cccccc] text-[#666666] text-base" required>
                <option value="" selected disabled>Pilih Bidang Tujuan</option>
                <option value="1">Pimpinan</option>
                <option value="2">Kepaniteraan</option>
                <option value="3">Kesekretariatan</option>
              </select>
            </div>

            <div class="flex flex-col gap-2.5">
              <label for="tujuan" class="font-semibold text-[#666666] text-base">Tujuan (Orang yang Ditemui)</label>
              <select id="tujuan" name="tujuan" class="p-3 sm:p-4 bg-white rounded-lg border border-[#cccccc] text-[#666666] text-base" required disabled>
                <option selected disabled>Pilih Bidang Terlebih Dahulu</option>
                </select>
            </div>

            <div class="flex flex-col gap-2.5">
              <label for="keperluan" class="font-semibold text-[#666666] text-base">Keperluan</label>
              <input type="text" id="keperluan" name="keperluan" placeholder="Masukkan Keperluan" class="p-3 sm:p-4 bg-white rounded-lg border border-[#cccccc] text-[#666666] text-base" required />
            </div>
          </div>

          <div class="flex flex-col gap-5">
            <div class="flex flex-col gap-2.5">
              <label for="tanggal_janji" class="font-semibold text-[#666666] text-base">Tanggal & Waktu Janji Temu</label>
              <input type="date" id="tanggal_janji" name="tanggal_janji"
                class="p-3 sm:p-4 bg-white rounded-lg border border-[#cccccc] text-[#666666] text-base" required />
            </div>

            <div class="flex flex-col gap-2.5">
              <label class="font-semibold text-[#666666] text-base">Metode Pertemuan</label>
              <div class="flex items-center gap-6">
                <label class="flex items-center gap-2">
                  <input type="radio" name="metode_pertemuan" value="online" class="w-4 h-4 text-[#1d4c08]" required />
                  <span class="text-[#666666] text-base">Online</span>
                </label>
                <label class="flex items-center gap-2">
                  <input type="radio" name="metode_pertemuan" value="offline" class="w-4 h-4 text-[#1d4c08]" required />
                  <span class="text-[#666666] text-base">Offline</span>
                </label>
              </div>
            </div>

            <label for="foto" class="font-semibold text-[#666666] text-base">Unggah Foto Diri</label>

            <label id="upload-area" class="relative flex flex-col items-center justify-center px-6 sm:px-10 py-6 sm:py-12 bg-white rounded-lg border border-dashed border-neutral-300 cursor-pointer transition hover:bg-gray-50 overflow-hidden min-h-[350px]">
              <img id="upload-icon" src="public/images/ic-round-plus.svg" alt="Upload" class="w-[50px] h-[50px]" />
              <img id="preview-image" class="hidden w-full max-w-[650px] object-contain rounded-lg border border-gray-300 mt-3" alt="Preview Gambar" />
              <p id="upload-text" class="text-[#474747] text-sm sm:text-base text-center max-w-[280px]">Klik atau seret file ke area ini untuk mengunggah gambar</p>
              <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png" class="hidden" />
            </label>
            <input type="hidden" name="base64_foto" id="base64_foto">
            <p class="text-[#9c9c9c] text-sm">Format yang diterima adalah .jpg, .jpeg, dan .png</p>

            <div class="mt-3 text-center">
              <button type="button" onclick="openCamera()" class="bg-[#1d4c08] hover:bg-[#256a10] text-white px-5 py-2 rounded-full text-sm transition">Ambil dari Kamera</button>
            </div>


            <img src="public/images/divider-line.svg" alt="Divider" class="w-full h-px object-cover" />
            <div id="alert-container" class="fixed top-4 right-4 hidden z-50"></div>
          </div>
        </form>

        <button type="submit" form=formtamu class="w-full h-11 bg-[#1d4c08] hover:bg-[#256a10] rounded-[100px] text-white font-medium text-sm">Kirim</button>
      </div>
    </main>
    
    <div id="modalCamera" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
      <div class="bg-white rounded-xl shadow-xl p-6 w-[90%] max-w-md relative">
        <h2 class="text-xl font-semibold mb-4 text-center text-gray-800">Ambil Foto Diri</h2>

        <div class="flex justify-center w-full">
          <div id="my_camera"
            class="rounded-xl overflow-hidden mb-4 border border-gray-200 outline outline-1 outline-[#1d4c08] outline-offset-0 w-full h-[240px]">
          </div>
        </div>

        <div class="flex justify-between mt-4 w-full">
          <button onclick="closeCamera()" 
            class="bg-gray-100 text-[#1d4c08] px-4 py-2 rounded-full border border-[#1d4c08] hover:bg-[#1d4c08] hover:text-white transition w-[48%]">
            Batal
          </button>
          <button onclick="takeSnapshot()" 
            class="bg-[#1d4c08] hover:bg-[#163b06] text-white px-4 py-2 rounded-full transition w-[48%]">
            Ambil Foto
          </button>
        </div>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <script src="public/js/main.js"></script>

    <script>
      // Pastikan script ini dijalankan setelah DOM selesai dimuat
      document.addEventListener('DOMContentLoaded', () => {
        
        // Ambil elemen dropdown
        const bidangDropdown = document.getElementById('bidang');
        const tujuanDropdown = document.getElementById('tujuan');

        // Tambahkan event listener ke dropdown bidang
        bidangDropdown.addEventListener('change', function() {
          const bidangId = this.value; // Ambil ID bidang yang dipilih (misal: 1, 2, atau 3)
          
          // Kosongkan dan nonaktifkan dropdown tujuan saat sedang memuat
          tujuanDropdown.innerHTML = '<option value="" selected disabled>Memuat...</option>';
          tujuanDropdown.disabled = true;

          // Jika bidangId ada (bukan "Pilih Bidang")
          if (bidangId) {
            // Lakukan 'fetch' ke file PHP baru
            fetch(`get_penerima.php?bidang_id=${bidangId}`)
              .then(response => {
                // Pastikan respons-nya OK
                if (!response.ok) {
                  throw new Error('Network response was not ok');
                }
                return response.json(); // Ubah respons menjadi JSON
              })
              .then(data => {
                // Aktifkan kembali dropdown tujuan
                tujuanDropdown.disabled = false;
                
                // Hapus opsi "Memuat..."
                tujuanDropdown.innerHTML = ''; 

                // Cek apakah data (penerima tamu) ditemukan
                if (data.length > 0) {
                  // Tambahkan opsi default
                  tujuanDropdown.innerHTML = '<option value="" selected disabled>Pilih Tujuan</option>';
                  
                  // Loop data JSON dan tambahkan sebagai <option>
                  data.forEach(penerima => {
                    const option = document.createElement('option');
                    option.value = penerima.id_penerima;
                    option.textContent = `${penerima.jabatan} - ${penerima.nama_penerima}`;
                    tujuanDropdown.appendChild(option);
                  });
                } else {
                  // Jika tidak ada data
                  tujuanDropdown.innerHTML = '<option value="" selected disabled>Tidak ada data penerima</option>';
                }
              })
              .catch(error => {
                // Tangani error
                console.error('Error fetching data:', error);
                tujuanDropdown.innerHTML = '<option value="" selected disabled>Gagal memuat data</option>';
              });
          } else {
            // Jika pengguna memilih "Pilih Bidang" (value kosong)
            tujuanDropdown.innerHTML = '<option value="" selected disabled>Pilih Bidang Terlebih Dahulu</option>';
            tujuanDropdown.disabled = true;
          }
        });
      });
    </script>
    
  </body>
</html>