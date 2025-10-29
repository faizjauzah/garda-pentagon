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
        background-image: url('public/images/rectangle-8.svg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        z-index: -1;
        pointer-events: none;
      "
    ></div>
    <!-- ============================= -->
    <!-- 🔹 NavigationBarSection -->
    <!-- ============================= -->
    <header
      class="sticky top-0 z-50 w-full min-h-[80px] md:min-h-[100px] lg:h-[115px] flex items-center justify-between gap-4 md:gap-0 py-4 px-4 md:px-8 lg:px-[120px] bg-[#ffffff80] shadow-[0px_4px_9px_#00000040] backdrop-blur-[2px] backdrop-brightness-[110%]"
    >
      <div class="flex items-center justify-center md:justify-start">
        <img src="public/images/logo-pengadilan-tinggi-agama-gorontalo-1.png" alt="Logo pengadilan" class="w-10 h-12 md:w-[59px] md:h-[73px] ml-0 md:ml-8 lg:ml-[120px]" />
        <img src="public/images/pan-rb-qdw0uf2dup27vg4nbkjrrm75c0xvmz2s0pbnrvyh3o-1.png" alt="Pan RB" class="w-12 h-12 md:w-[73px] md:h-[73px] ml-3 md:ml-5" />
        <img src="public/images/logo-berakhlak-1024x390-1.png" alt="Logo berakhlak" class="w-24 h-9 md:w-[142px] md:h-[54px] ml-2 md:ml-[13px]" />
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
    <section id="home" class="relative w-full h-[500px] md:h-[700px] lg:h-[890px]">
      <div class="relative flex flex-col justify-end h-full px-4 md:px-8 lg:px-[120px] pb-12 md:pb-20 lg:pb-[130px] max-w-[710px] gap-8 md:gap-12">
        <h1 class="text-white text-4xl md:text-6xl lg:text-8xl font-semibold">GARDA PENTAGON</h1>
        <p class="text-[#d9d9d9] text-base md:text-xl lg:text-2xl max-w-[620px]">Guest and Administration Pengadilan Agama Gorontalo</p>

        <div class="flex flex-col sm:flex-row gap-4 mt-4">
          <a href="#presensi" class="px-5 py-3 rounded-[100px] bg-gradient-to-b from-[#fbfbfe] to-[#f1f2f9] border border-[#d9dbe9] text-[#170f49] hover:opacity-90 text-sm font-medium">Presensi Tamu</a>
          <a href="#panduan" class="px-5 py-3 rounded-[100px] border border-white text-white hover:bg-white hover:text-[#170f49] transition text-sm font-medium">Panduan Pengisian Presensi</a>
        </div>
      </div>
    </section>

    <!-- ============================= -->
    <!-- 🔹 Presensi Section (from Desktop.tsx) -->
    <!-- ============================= -->
    <section id="presensi" class="relative w-full flex flex-col items-center py-16 px-4 md:px-8 lg:px-[123px] bg-white">
      <h1 class="text-3xl md:text-5xl lg:text-[64px] font-semibold text-center mb-20">Presensi Tamu</h1>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 max-w-[1195px]">
        <!-- Card Template -->
        <div class="bg-white rounded-[20px] shadow-[0_0_50px_-5px_#00000040] p-8 flex flex-col items-center">
          <div class="w-[100px] h-[100px] bg-[#1d4c08] rounded-full flex items-center justify-center mb-6">
            <img src="public/images/fa6-solid-landmark.svg" alt="Tamu Pimpinan" class="w-[50px] h-[50px]" />
          </div>
          <h3 class="font-medium text-black text-lg text-center mb-2">Tamu Pimpinan</h3>
          <p class="text-[#666666] text-sm text-center mb-6">Presensi bagi tamu-tamu pimpinan Pengadilan Agama Gorontalo</p>
          <a href="form_tamu.php?bidang=pimpinan" class="w-full max-w-[290px] bg-[#1d4c08] hover:bg-[#2a6b0c] text-white py-2 rounded-full flex justify-center items-center gap-2">
            <span>Presensi</span>
            <img src="public/images/arrow-1.svg" alt="Arrow" class="w-[12px] h-[12px]" />
          </a>
        </div>

        <div class="bg-white rounded-[20px] shadow-[0_0_50px_-5px_#00000040] p-8 flex flex-col items-center">
          <div class="w-[100px] h-[100px] bg-[#1d4c08] rounded-full flex items-center justify-center mb-6">
            <img src="public/images/material-symbols-balance-rounded.svg" alt="Tamu Kepaniteraan" class="w-[50px] h-[50px]" />
          </div>
          <h3 class="font-medium text-black text-lg text-center mb-2">Tamu Kepaniteraan</h3>
          <p class="text-[#666666] text-sm text-center mb-6">Presensi bagi tamu-tamu kepaniteraan Pengadilan Agama Gorontalo</p>
          <a href="form_tamu.php?bidang=kepaniteraan" class="w-full max-w-[290px] bg-[#1d4c08] hover:bg-[#2a6b0c] text-white py-2 rounded-full flex justify-center items-center gap-2">
            <span>Presensi</span>
            <img src="public/images/arrow-1.svg" alt="Arrow" class="w-[12px] h-[12px]" />
          </a>
        </div>

        <div class="bg-white rounded-[20px] shadow-[0_0_50px_-5px_#00000040] p-8 flex flex-col items-center">
          <div class="w-[100px] h-[100px] bg-[#1d4c08] rounded-full flex items-center justify-center mb-6">
            <img src="public/images/vector.svg" alt="Tamu Kesekretariatan" class="w-[50px] h-[50px]" />
          </div>
          <h3 class="font-medium text-black text-lg text-center mb-2">Tamu Kesekretariatan</h3>
          <p class="text-[#666666] text-sm text-center mb-6">Presensi bagi tamu-tamu kesekretariatan Pengadilan Agama Gorontalo</p>
          <a href="form_tamu.php?bidang=kesekretariatan" class="w-full max-w-[290px] bg-[#1d4c08] hover:bg-[#2a6b0c] text-white py-2 rounded-full flex justify-center items-center gap-2">
            <span>Presensi</span>
            <img src="public/images/arrow-1.svg" alt="Arrow" class="w-[12px] h-[12px]" />
          </a>
        </div>
      </div>
    </section>

    <!-- ============================= -->
    <!-- 🔹 GuestInfoSection -->
    <!-- ============================= -->
    <section id="panduan" class="relative w-full py-16" style="background-color: #d1dbcd;">
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
            <img src="public/images/logo-pengadilan-tinggi-agama-gorontalo-1.png" alt="Logo pengadilan" class="w-10 h-12" />
            <img src="public/images/pan-rb-qdw0uf2dup27vg4nbkjrrm75c0xvmz2s0pbnrvyh3o-1.png" alt="Pan RB" class="w-12 h-12" />
            <img src="public/images/logo-berakhlak-1024x390-1.png" alt="Logo berakhlak" class="w-24 h-9" />
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
          <p class="text-xs text-gray-700">© 2025. All rights reserved.</p>
        </div>
      </div>
    </footer>

    <!-- JavaScript for Hamburger Menu -->
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const hamburgerButton = document.getElementById('hamburger-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuLinks = mobileMenu.querySelectorAll('a');

        // Toggle menu visibility
        hamburgerButton.addEventListener('click', () => {
          mobileMenu.classList.toggle('hidden');
        });

        // Close menu when a link is clicked
        menuLinks.forEach(link => {
          link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
          });
        });
      });
    </script>
  </body>
</html>
