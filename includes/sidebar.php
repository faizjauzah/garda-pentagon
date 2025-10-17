<aside class="flex lg:inline-flex w-full lg:w-[280px] lg:min-h-screen flex-col bg-white border-b lg:border-r lg:border-b-0 border-solid border-[#a7a6a6] lg:items-start sticky top-0 lg:static z-50">
      <div class="relative w-full lg:w-[280px] h-[70px] lg:h-[106px] flex items-center justify-between lg:justify-start gap-2 px-4 lg:px-0">
        <div class="flex items-center gap-2">
          <img src="../public/images/logo-pengadilan-tinggi-agama-gorontalo-1.png" alt="Logo pengadilan" class="relative lg:absolute lg:top-4 lg:left-7 w-[40px] lg:w-[59px] h-[50px] lg:h-[73px] object-cover" />
          <img src="../public/images/pan-rb-qdw0uf2dup27vg4nbkjrrm75c0xvmz2s0pbnrvyh3o-1.png" alt="Pan RB" class="relative lg:absolute lg:top-4 lg:left-[103px] w-[50px] lg:w-[73px] h-[50px] lg:h-[73px] object-cover" />
        </div>

        <!-- Mobile menu toggle -->
        <button id="menu-btn" class="lg:hidden p-2">
          <img id="menu-icon" src="../public/images/menu.svg" alt="Menu" class="w-6 h-6" />
        </button>
      </div>

      <!-- Navigation -->
      <nav id="nav" class="hidden lg:flex flex-col items-start gap-2 p-2 flex-1 grow w-full">
        <button onclick="window.location.href='dashboard.php'" class="flex w-full items-center gap-3 px-5 py-3 rounded-3xl justify-start hover:bg-gray-100">
          <img src="../public/images/icon--from-tabler-io--9.svg" class="w-4 h-4" alt="Dashboard icon" />
          <span class="font-normal text-[#131313] text-sm">Dashboard</span>
        </button>

        <button onclick="window.location.href='dataTabelTamuPimpinan.php'" class="flex w-full items-center gap-3 px-5 py-3 rounded-3xl justify-start hover:bg-gray-100">
          <img src="../public/images/icon--from-tabler-io--7.svg" class="w-4 h-4" alt="Icon" />
          <span class="font-normal text-[#131313] text-sm">Tamu Pimpinan</span>
        </button>

        <button onclick="window.location.href='dataTabelTamuKepaniteraan.php'" class="flex w-full items-center gap-3 px-5 py-3 rounded-3xl justify-start hover:bg-gray-100">
          <img src="../public/images/icon--from-tabler-io--7.svg" class="w-4 h-4" alt="Icon" />
          <span class="font-normal text-[#131313] text-sm">Tamu Kepaniteraan</span>
        </button>

        <button onclick="window.location.href='dataTabelTamuKesekretariatan.php'" class="flex w-full items-center gap-3 px-5 py-3 rounded-3xl justify-start hover:bg-gray-100">
          <img src="../public/images/icon--from-tabler-io--7.svg" class="w-4 h-4" alt="Icon" />
          <span class="font-normal text-[#131313] text-sm">Tamu Kesekretariatan</span>
        </button>
      </nav>

      <!-- Footer -->
      <footer id="footer" class="hidden lg:flex flex-col items-center justify-end gap-3 pt-4 pb-6 px-2 self-stretch w-full">
        <div class="flex h-10 items-center gap-3 px-5 w-full">
          <div class="flex flex-col items-start justify-center gap-1">
            <div class="font-medium text-sm text-[#131313]">Admin Satu</div>
            <div class="bg-[#ffcc70] rounded-3xl px-1.5 py-0 text-[10px]">Admin</div>
          </div>
        </div>

        <div class="flex flex-col items-start w-full">
          <button onclick="window.location.href='index.php'" class="flex w-full items-center gap-3 px-5 py-3 rounded-3xl justify-start hover:bg-gray-100">
            <img src="../public/images/logout.svg" class="w-4 h-4" alt="Logout" />
            <span class="text-[#b01111] text-sm">Log out</span>
          </button>
        </div>
      </footer>
    </aside>