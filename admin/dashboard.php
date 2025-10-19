<?php
  include '../config/config.php';
  include '../utils/session.php';
  // --- MENGHITUNG JUMLAH TAMU PER BIDANG ---
  // Inisialisasi variabel jumlah tamu dengan nilai awal 0
  $jumlah_tamu = [
      'Pimpinan' => 0,
      'Kepaniteraan' => 0,
      'Kesekretariatan' => 0
  ];

  // Query tunggal untuk mendapatkan hitungan semua bidang menggunakan GROUP BY
  $sql = "SELECT 
              b.nama_bidang, 
              COUNT(t.tamu_id) AS jumlah
          FROM 
              tamu t
          JOIN 
              bidang_tujuan b ON t.bidang_tujuan_id = b.bidang_tujuan_id
          GROUP BY 
              b.nama_bidang";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Loop melalui hasil query dan masukkan ke dalam array
    while($row = $result->fetch_assoc()) {
      // Cek apakah nama bidang ada di array kita sebelum diisi
      if (array_key_exists($row['nama_bidang'], $jumlah_tamu)) {
        $jumlah_tamu[$row['nama_bidang']] = $row['jumlah'];
      }
    }
  }

?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../public/css/output.css" />
  </head>
  <body class="bg-[#f3f3f3] w-full min-h-screen flex flex-col lg:flex-row">
    <!-- Sidebar -->
    <?php
      include '../includes/sidebar.php';
    ?>

    <div class="w-full flex flex-col">
      <!-- Welcome Bar -->
      <section class="w-full lg:w-auto flex items-center justify-between px-6 py-4 bg-white shadow-sm">
        <h1 class="text-lg font-semibold text-[#131313]">
          Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!
        </h1>
      </section>

      <!-- Main content -->
      <main class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-4 w-full px-4 gap-4 py-4">
        <div class="flex flex-col w-full min-h-[200px] gap-2 p-6 bg-white rounded-2xl shadow-[0px_4px_4px_#00000040]">
          <h2 class="font-semibold text-[#131313] text-lg lg:text-xl">Jumlah Tamu Pimpinan</h2>
          <div class="flex items-baseline gap-2">
            <div class="font-medium text-[#131313] text-4xl lg:text-5xl">
              <?php echo $jumlah_tamu['Pimpinan']; ?>
            </div>
            <img src="../public/images/trending-up.svg" alt="Up" class="w-6 h-6 lg:w-8 lg:h-8 text-green-500" />
          </div>
          <p class="text-[#454545] text-sm">Total tamu yang tercatat</p>
          <div class="pt-4 mt-auto">
            <a href="dataTabelTamuPimpinan.php" class="flex items-center gap-1 text-[#724a00] text-sm hover:underline">
              Lihat detail data
              <img src="../public/images/arrow-up-right.svg" class="w-3.5 h-3.5" alt="Link" />
            </a>
          </div>
        </div>

        <div class="flex flex-col w-full min-h-[200px] gap-2 p-6 bg-white rounded-2xl shadow-[0px_4px_4px_#00000040]">
          <h2 class="font-semibold text-[#131313] text-lg lg:text-xl">Jumlah Tamu Kepaniteraan</h2>
          <div class="flex items-baseline gap-2">
            <div class="font-medium text-[#131313] text-4xl lg:text-5xl">
              <?php echo $jumlah_tamu['Kepaniteraan']; ?>
            </div>
            <img src="../public/images/trending-up.svg" alt="Up" class="w-6 h-6 lg:w-8 lg:h-8 text-green-500" />
          </div>
          <p class="text-[#454545] text-sm">Total tamu yang tercatat</p>
          <div class="pt-4 mt-auto">
            <a href="dataTabelTamuKepaniteraan.php" class="flex items-center gap-1 text-[#724a00] text-sm hover:underline">
              Lihat detail data
              <img src="../public/images/arrow-up-right.svg" class="w-3.5 h-3.5" alt="Link" />
            </a>
          </div>
        </div>

        <div class="flex flex-col w-full min-h-[200px] gap-2 p-6 bg-white rounded-2xl shadow-[0px_4px_4px_#00000040]">
          <h2 class="font-semibold text-[#131313] text-lg lg:text-xl">Jumlah Tamu Kesekretariatan</h2>
          <div class="flex items-baseline gap-2">
            <div class="font-medium text-[#131313] text-4xl lg:text-5xl">
              <?php echo $jumlah_tamu['Kesekretariatan']; ?>
            </div>
            <img src="../public/images/trending-up.svg" alt="Up" class="w-6 h-6 lg:w-8 lg:h-8 text-green-500" />
          </div>
          <p class="text-[#454545] text-sm">Total tamu yang tercatat</p>
          <div class="pt-4 mt-auto">
            <a href="dataTabelTamuKesekretariatan.php" class="flex items-center gap-1 text-[#724a00] text-sm hover:underline">
              Lihat detail data
              <img src="../public/images/arrow-up-right.svg" class="w-3.5 h-3.5" alt="Link" />
            </a>
          </div>
        </div>
      </main>

      <!-- JS for mobile menu -->
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
    </div>
  </body>
</html>
