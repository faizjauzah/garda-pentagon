<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Presensi Tamu Kesekretariatan</title>
    <link rel="stylesheet" href="../public/css/output.css" />
  </head>
  <body class="bg-[#f3f3f3] w-full min-h-screen flex flex-col lg:flex-row">
    <!-- Sidebar -->
    <?php
      include '../includes/sidebar.php';
    ?>

    <?php
      include '../config/config.php';
      include '../utils/session.php';
      // --- QUERY UNTUK MENGAMBIL DATA TAMU KESEKRETARIATAN ---
      // Memilih semua kolom yang Anda sebutkan
      $sql = "SELECT 
                  t.tamu_id,
                  t.nama,
                  t.no_telpon,
                  t.instansi_asal,
                  t.alamat,
                  b.nama_bidang,
                  t.keperluan,
                  t.foto
              FROM 
                  tamu t
              JOIN 
                  bidang_tujuan b ON t.bidang_tujuan_id = b.bidang_tujuan_id
              WHERE
                  b.nama_bidang = 'Kesekretariatan' 
              ORDER BY 
                  t.tamu_id DESC"; // Mengurutkan berdasarkan ID terbaru

      $result = $conn->query($sql);
    ?>

    <!-- Main Content -->
    <main class="flex flex-col w-full px-4 py-6 lg:py-10 gap-6">
      <header class="flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-[#131313]">Presensi Tamu Kesekretariatan</h1>
        <button class="bg-[#1d4c08] hover:bg-[#163805] text-white rounded-3xl px-4 py-2 text-sm">+ Tambah Data</button>
      </header>

      <!-- Search and Filter -->
      <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden w-full sm:w-1/2">
          <img src="../public/images/search.svg" alt="Search" class="w-5 h-5 mx-2 text-gray-500" />
          <input type="text" placeholder="Cari data tamu..." class="flex-1 p-2 outline-none text-sm" />
        </div>
        <div class="flex items-center gap-2">
          <select class="border border-gray-300 rounded-lg p-2 text-sm text-gray-700">
            <option>Filter Tanggal</option>
            <option>Hari ini</option>
            <option>Minggu ini</option>
            <option>Bulan ini</option>
          </select>
        </div>
      </div>

      <!-- Table Section -->
      <div class="bg-white rounded-xl shadow-md overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead class="bg-[#1d4c08] text-white text-sm">
            <tr>
              <th class="p-3">No.</th>
              <th class="p-3">ID Tamu</th>
              <th class="p-3">Nama</th>
              <th class="p-3">No. Telepon</th>
              <th class="p-3">Instansi Asal</th>
              <th class="p-3">Alamat</th>
              <th class="p-3">Bidang Tujuan</th>
              <th class="p-3">Keperluan</th>
              <th class="p-3">Foto</th>
            </tr>
          </thead>
          <tbody class="text-sm text-[#333333]">
            <?php
            if ($result->num_rows > 0) {
              $nomor = 1; // Variabel untuk penomoran baris
              while($row = $result->fetch_assoc()) {
            ?>
            <tr class="border-b hover:bg-gray-50">
              <td class="p-3"><?php echo $nomor++; ?></td>
              <td class="p-3"><?php echo htmlspecialchars($row["tamu_id"]); ?></td>
              <td class="p-3"><?php echo htmlspecialchars($row["nama"]); ?></td>
              <td class="p-3"><?php echo htmlspecialchars($row["no_telpon"]); ?></td>
              <td class="p-3"><?php echo htmlspecialchars($row["instansi_asal"]); ?></td>
              <td class="p-3"><?php echo htmlspecialchars($row["alamat"]); ?></td>
              <td class="p-3"><?php echo htmlspecialchars($row["nama_bidang"]); ?></td>
              <td class="p-3"><?php echo htmlspecialchars($row["keperluan"]); ?></td>
              <td class="p-3">
                <?php 
                  // Menampilkan nama file foto, atau pesan jika kosong
                  echo htmlspecialchars($row["foto"] ? $row["foto"] : 'Tidak ada foto'); 
                ?>
              </td>
            </tr>
            <?php
              } // Akhir dari while loop
            } else {
              // Pesan jika tidak ada data, colspan disesuaikan menjadi 9
              echo '<tr class="border-b"><td colspan="9" class="p-4 text-center text-gray-500">Belum ada data tamu untuk Pimpinan.</td></tr>';
            }
            ?>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="flex justify-between items-center mt-4">
        <p class="text-sm text-gray-500">Menampilkan <?php echo $result->num_rows; ?> dari <?php echo $result->num_rows; ?> data</p>
        <div class="flex items-center gap-2">
          <button class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-100">&lt;</button>
          <button class="px-3 py-1 border border-gray-300 rounded bg-[#1d4c08] text-white text-sm">1</button>
          <button class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-100">&gt;</button>
        </div>
      </div>
    </main>

    <!-- JS for sidebar toggle -->
    <script>
      const btn = document.getElementById("menu-btn");
      const icon = document.getElementById("menu-icon");
      const nav = document.getElementById("nav");
      const footer = document.getElementById("footer");
      let open = false;

      btn.addEventListener("click", () => {
        open = !open;
        if (open) {
          nav.classList.remove("hidden");
          footer.classList.remove("hidden");
          icon.src = "../public/images/no-x.svg";
        } else {
          nav.classList.add("hidden");
          footer.classList.add("hidden");
          icon.src = "../public/images/menu.svg";
        }
      });
    </script>
  </body>
</html>

<?php
$conn->close();
?>