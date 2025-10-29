<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Garda Pentagon - Pengadilan Agama Gorontalo</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="public/css/output.css" />
  </head>

  <body class="bg-white flex flex-col w-full">
    <div
      style="
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('public/images/gedung-depan.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        z-index: -1;
        pointer-events: none;
      "
    ></div>

    <!-- [MODIFIED] Overlay gradien sekarang 'fixed', 'z-0', dan punya tinggi -->
    <!-- Dia tidak lagi di dalam <section id="home"> -->
    <div class="fixed inset-0 w-full h-full bg-gradient-to-r from-black/70 to-transparent z-0"></div>

    <!-- ============================= -->
    <!-- 🔹 NavigationBarSection -->
    <!-- ============================= -->
    <header
      class="sticky top-0 z-50 w-full min-h-[80px] md:min-h-[100px] lg:h-[115px] flex items-center justify-between gap-4 md:gap-0 py-4 px-4 md:px-8 lg:px-[120px] bg-[#ffffff80] shadow-[0px_4px_9px_#00000040] backdrop-blur-[2px] backdrop-brightness-[110%]"
    >
      <div class="flex items-center justify-center md:justify-start">
        <img src="public/images/logo-semua.png" alt="Logo" class="h-12 w-auto md:h-[73px] md:w-auto ml-0 md:ml-8 lg:ml-[120px]" />
      </div>

      <!-- Desktop Navigation (Hidden on Mobile) -->
      <nav class="hidden md:flex items-center justify-center bg-[#f9f9f9] rounded-[400px] px-6 py-3">
        <ul class="flex items-center gap-8 text-black">
          <li><a href="#home" class="hover:opacity-70 transition-opacity">Home</a></li>
          <li><a href="#presensi" class="hover:opacity-70 transition-opacity">Presensi</a></li>
          <li><a href="#panduan" class="hover:opacity-70 transition-opacity">Panduan</a></li>
        </ul>
      </nav>

      <!-- Hamburger Button (Visible on Mobile) -->
      <div class="md:hidden">
        <button id="hamburger-button" class="p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
      </div>

      <!-- Mobile Menu (Hidden by default) -->
      <div id="mobile-menu" class="hidden md:hidden absolute top-full right-0 w-full bg-white shadow-lg">
        <ul class="flex flex-col gap-4 py-4">
          <li><a href="#home" class="block w-full text-center py-2 hover:bg-gray-100">Home</a></li>
          <li><a href="#presensi" class="block w-full text-center py-2 hover:bg-gray-100">Presensi</a></li>
          <li><a href="#panduan" class="block w-full text-center py-2 hover:bg-gray-100">Panduan</a></li>
        </ul>
      </div>
    </header>

    <!-- ============================= -->
    <!-- 🔹 HeroSection -->
    <!-- ============================= -->
    <!-- [MODIFIED] Section 'home' harus 'relative' -->
    <section id="home" class="relative w-full h-[500px] md:h-[700px] lg:h-[890px] z-10">
      
      <!-- [MODIFIED] Tanggal dipindah ke sini dengan 'absolute' -->
      <!-- 'pt-8' adalah margin dari navbar -->
      <!-- 'px...' adalah margin dari sisi kanan agar sejajar konten -->
      <!-- [MODIFIED] Ditambahkan 'z-10' agar di atas overlay -->
      <div class="absolute z-10 top-0 right-0 w-full pt-8 px-4 md:px-8 lg:px-[120px]">
        <!-- [MODIFIED] Font size diubah dari text-base md:text-lg ke text-lg md:text-xl -->
        <p id="tanggal-dinamis" class="text-white text-lg md:text-xl font-medium text-right">Memuat tanggal...</p>
      </div>

      <!-- [MODIFIED] Konten utama kembali menggunakan 'justify-end' -->
      <!-- [MODIFIED] max-w-710px dan gap dihapus agar bisa memuat grid 2 kolom -->
      <div class="relative flex flex-col justify-end h-full px-4 md:px-8 lg:px-[120px] pb-12 md:pb-20 lg:pb-[130px]">
        
        <!-- (Div tanggal yang lama sudah dipindah ke atas) -->

        <!-- [NEW] Grid 2-kolom (col-6, col-6) untuk teks dan gambar -->
        <!-- [MODIFIED] Ditambahkan 'max-w-7xl' dan 'mx-auto' untuk me-center di layar lebar -->
        <div class="w-full max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 md:gap-16 items-center">

          <!-- [Kolom 1: Teks] -->
          <!-- [MODIFIED] Kelas 'order' dihapus -->
          <div class="flex flex-col gap-8 md:gap-12">
            <p class="text-white text-base md:text-xl lg:text-2xl">Selamat Datang di</p>
            <h1 class="text-white text-4xl md:text-6xl lg:text-8xl font-semibold">GARDA PENTAGON</h1>
            <!-- [MODIFIED] max-w-620px dihapus dari sini -->
            <p class="text-[#d9d9d9] text-base md:text-xl lg:text-2xl">Guest and Administration Pengadilan Agama Gorontalo</p>

            <div class="flex flex-col sm:flex-row gap-4 mt-4">
              <a href="#presensi" class="px-5 py-3 rounded-[100px] bg-gradient-to-b from-[#fbfbfe] to-[#f1f2f9] border border-[#d9dbe9] text-[#170f49] hover:opacity-90 text-sm font-medium">Presensi Tamu</a>
              <a href="#panduan" class="px-5 py-3 rounded-[100px] border border-white text-white hover:bg-white hover:text-[#170f49] transition text-sm font-medium">Panduan Pengisian Presensi</a>
            </div>
          </div>

          <!-- [Kolom 2: Gambar] (BARU) -->
          <!-- Ganti 'src' di bawah ini dengan path gambar Anda -->
          <!-- [MODIFIED] 'hidden lg:block' dipertahankan, ditambah 'flex justify-end items-center' -->
          <div class="w-full hidden lg:block flex justify-end items-center">
            <img 
              src="public/images/ilustrasi-garda-pentagon.png" 
              alt="Ilustrasi Garda Pentagon" 
              class="w-full max-w-xl h-auto rounded-xl object-cover"
            >
          </div>

        </div>
      </div>
    </section>

    <!-- ============================= -->
    <!-- 🔹 Presensi Section (from Desktop.tsx) -->
    <!-- ============================= -->
    <section id="presensi" class="relative w-full flex flex-col items-center py-16 px-4 md:px-8 lg:px-[123px] bg-white z-10">
      <h1 class="text-3xl md:text-5xl lg:text-[64px] font-semibold text-center mb-20">Presensi Tamu</h1>

      <div class="flex justify-center w-full">
        <div class="bg-white rounded-[20px] shadow-[0_0_50px_-5px_#00000040] p-8 flex flex-col items-center w-full max-w-sm">
          <div class="w-[100px] h-[100px] bg-[#1d4c08] rounded-full flex items-center justify-center mb-6">
            <img src="public/images/fa6-solid-landmark.svg" alt="Presensi Tamu" class="w-[50px] h-[50px]" />
          </div>
          <h3 class="font-medium text-black text-lg text-center mb-2">Buku Tamu</h3>
          <p class="text-[#666666] text-sm text-center mb-6">Silakan isi buku tamu digital Pengadilan Agama Gorontalo</p>
          
          <a href="form_tamu.php" class="w-full max-w-[290px] bg-[#1d4c08] hover:bg-[#2a6b0c] text-white py-2 rounded-full flex justify-center items-center gap-2">
            <span>Isi Presensi</span>
            <img src="public/images/arrow-1.svg" alt="Arrow" class="w-[12px] h-[12px]" />
          </a>
        </div>
      </div>
    </section>

    <!-- ============================= -->
    <!-- 🔹 GuestInfoSection -->
    <!-- ============================= -->
    <section id="panduan" class="relative w-full py-16 z-10" style="background-color: #d1dbcd;">
      <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center px-6">
        <div class="flex flex-col gap-6">
          <h2 class="text-3xl md:text-5xl font-semibold text-black">Panduan Pengisian</h2>
          <p class="text-black text-base leading-relaxed text-justify">
            Pengunjung Pengadilan Tinggi Agama Gorontalo diwajibkan mengisi buku tamu digital yang tersedia di area layanan. Silakan pilih kategori kunjungan sesuai keperluan, lalu lengkapi data diri dengan benar.
          </p>
          <a href="#" class="w-full md:w-auto bg-white border border-gray-300 hover:bg-gray-50 rounded-full py-3 px-5 flex justify-between items-center gap-3">
            <span class="text-black text-sm font-medium">Lihat panduan pengisian buku tamu</span>
             <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
          </a>
        </div>

        <div class="flex flex-col gap-6 items-center">
          <!-- This wrapper div controls the shape and size -->
          <div class="w-full aspect-video">
            <iframe 
              class="w-full h-full rounded-[20px]" 
              src="https://www.youtube.com/embed/USNVLKvUMo0?si=YSWDN0PG3fPrjrtR" 
              title="YouTube video player" 
              frameborder="0" 
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
              allowfullscreen>
            </iframe>
          </div>
        </div>
      </div>
    </section>

    <!-- ============================= -->
    <!-- 🔹 FooterSection -->
    <!-- ============================= -->
    <footer class="w-full bg-white py-8 z-10">
      <div class="max-w-6xl mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
          <div class="flex items-center gap-6">
            <img src="public/images/logo-pengadilan-tinggi-agama-gorontalo-1.png" alt="Logo pengadilan" class="w-auto h-12" />
            <img src="public/images/pan-rb-qdw0uf2dup27vg4nbkjrrm75c0xvmz2s0pbnrvyh3o-1.png" alt="Pan RB" class="w-auto h-12" />
            <img src="public/images/logo-berakhlak-1024x390-1.png" alt="Logo berakhlak" class="w-auto h-9" />
          </div>

          <div class="flex gap-4">
            <a href="https://www.facebook.com/pta.gorontalo/" target="_blank"><img src="public/images/facebook.svg" alt="Facebook" class="w-6 h-6" /></a>
            <a href="https://www.youtube.com/@PengadilanTinggiAgamaGorontalo" target="_blank"><img src="public/images/youtube.svg" alt="YouTube" class="w-6 h-6" /></a>
            <a href="https://www.instagram.com/ptagorontalo/" target="_blank"><img src="public/images/instagram.svg" alt="Instagram" class="w-6 h-6" /></a>
            <a href="https://pta-gorontalo.go.id" target="_blank"><img src="public/images/globe.svg" alt="Website" class="w-6 h-6" /></a>
          </div>
        </div>

        <hr class="my-6 border-gray-300" />

        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
          <nav class="flex gap-6 text-sm">
            <a href="#home" class="hover:opacity-70">Home</a>
            <a href="#presensi" class="hover:opacity-70">Presensi</a>
            <a href="#panduan" class="hover:opacity-70">Panduan</a>
          </nav>
          <p class="text-xs text-gray-700">Copyright © 2025. Pengadilan Tinggi Agama Gorontalo.</p>
        </div>
      </div>
    </footer>

    <!-- JavaScript (Tidak ada perubahan di sini) -->
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        // Kode menu hamburger
        const hamburgerButton = document.getElementById('hamburger-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuLinks = mobileMenu.querySelectorAll('a');

        hamburgerButton.addEventListener('click', () => {
          mobileMenu.classList.toggle('hidden');
        });

        menuLinks.forEach(link => {
          link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
          });
        });

        // Kode untuk tanggal dinamis
        const tanggalElement = document.getElementById('tanggal-dinamis');
        if (tanggalElement) { // Cek apakah elemennya ada
          const today = new Date();
          const options = {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
          };
          // Menggunakan locale 'id-ID' untuk Bahasa Indonesia
          const formattedDate = today.toLocaleDateString('id-ID', options);
          
          tanggalElement.textContent = `${formattedDate}`;
        }
      });
    </script>
  </body>
</html>

