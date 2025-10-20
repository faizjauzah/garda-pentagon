<?php
  include '../config/config.php';
  include '../utils/session.php';

  // --- LOGIKA UNTUK FILTER DAN PENCARIAN ---
  $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
  $search = isset($_GET['search']) ? trim($_GET['search']) : ''; // trim() untuk menghapus spasi di awal/akhir

  $conditions = ["b.nama_bidang = 'Kepaniteraan'"];
  $params = [];
  $types = '';

  // --- Logika Pencarian ---
  if (!empty($search)) {
      $search_term = "%" . $search . "%";
      // Menambahkan kondisi pencarian pada beberapa kolom
      $conditions[] = "(t.nama LIKE ? OR t.instansi_asal LIKE ? OR t.keperluan LIKE ?)";
      // Menambahkan parameter untuk binding
      array_push($params, $search_term, $search_term, $search_term);
      $types .= 'sss'; // s = string, untuk setiap parameter
  }

  // --- Logika Filter Tanggal ---
  if (!empty($filter)) {
      switch ($filter) {
          case 'today':
              $conditions[] = "DATE(t.tanggal_janji) = CURDATE()";
              break;
          case 'week':
              $conditions[] = "YEARWEEK(t.tanggal_janji, 1) = YEARWEEK(CURDATE(), 1)";
              break;
          case 'month':
              $conditions[] = "MONTH(t.tanggal_janji) = MONTH(CURDATE()) AND YEAR(t.tanggal_janji) = YEAR(CURDATE())";
              break;
      }
  }

  // --- MEMBUAT QUERY SQL AKHIR ---
  $sql = "SELECT 
              t.tamu_id, t.nama, t.no_telpon, t.instansi_asal, t.alamat,
              b.nama_bidang, t.keperluan, t.tanggal_janji, t.metode_pertemuan, t.foto
          FROM 
              tamu t
          JOIN 
              bidang_tujuan b ON t.bidang_tujuan_id = b.bidang_tujuan_id";

  // Menggabungkan semua kondisi dengan 'AND'
  if (!empty($conditions)) {
      $sql .= " WHERE " . implode(' AND ', $conditions);
  }

  $sql .= " ORDER BY t.tanggal_janji DESC, t.tamu_id DESC";

  // --- EKSEKUSI QUERY DENGAN PREPARED STATEMENT (LEBIH AMAN) ---
  $stmt = $conn->prepare($sql);

  // Bind parameter jika ada (untuk pencarian)
  if (!empty($params)) {
      $stmt->bind_param($types, ...$params);
  }

  $stmt->execute();
  $result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Presensi Tamu Kepaniteraan</title>
    <link rel="stylesheet" href="../public/css/output.css" />
  </head>
  <body class="bg-[#f3f3f3] w-full min-h-screen flex flex-col lg:flex-row">
    <?php include '../includes/sidebar.php'; ?>

    <main class="flex-1 flex flex-col px-4 py-6 lg:py-10 gap-6 overflow-x-hidden">
      <header class="flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-[#131313]">Presensi Tamu Kepaniteraan</h1>
      </header>

      <form action="" method="GET" class="w-full">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
          <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden w-full sm:w-1/2 bg-white">
            <img src="../public/images/search.svg" alt="Search" class="w-5 h-5 mx-2 text-gray-500" />
            <input type="text" name="search" placeholder="Cari nama, instansi, atau keperluan..." class="flex-1 p-2 outline-none text-sm" value="<?php echo htmlspecialchars($search); ?>" />
          </div>
          <div class="flex items-center gap-2">
            <select name="filter" class="border border-gray-300 rounded-lg p-2 text-sm text-gray-700 bg-white">
              <option value="">Semua Tanggal</option>
              <option value="today" <?php if ($filter == 'today') echo 'selected'; ?>>Hari ini</option>
              <option value="week" <?php if ($filter == 'week') echo 'selected'; ?>>Minggu ini</option>
              <option value="month" <?php if ($filter == 'month') echo 'selected'; ?>>Bulan ini</option>
            </select>
            <button type="submit" class="bg-[#1d4c08] hover:bg-[#163805] text-white rounded-lg px-4 py-2 text-sm font-medium">Cari</button>
            <a href="dataTabelTamuKepaniteraan.php" class="text-sm text-gray-600 hover:text-gray-900 px-3 py-2 bg-gray-200 rounded-lg">Reset</a>
          </div>
        </div>
      </form>

      <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-left">
             <thead class="bg-[#1d4c08] text-white text-xs uppercase tracking-wider">
              <tr>
                <th class="px-4 py-3">No.</th>
                <th class="px-4 py-3">ID Tamu</th>
                <th class="px-4 py-3">Nama</th>
                <th class="px-4 py-3">Tanggal Janji</th>
                <th class="px-4 py-3">Metode Pertemuan</th>
                <th class="px-4 py-3">Keperluan</th>
                <th class="px-4 py-3">Instansi Asal</th>
                <th class="px-4 py-3">No. Telepon</th>
                <th class="px-4 py-3">Alamat</th>
                <th class="px-4 py-3">Foto</th>
              </tr>
            </thead>
            <tbody class="text-sm text-gray-700">
              <?php
              if ($result && $result->num_rows > 0) {
                $nomor = 1;
                while($row = $result->fetch_assoc()) {
              ?>
              <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                <td class="px-4 py-3 whitespace-nowrap"><?php echo $nomor++; ?></td>
                <td class="px-4 py-3 whitespace-nowrap"><?php echo htmlspecialchars($row["tamu_id"]); ?></td>
                <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-900"><?php echo htmlspecialchars($row["nama"]); ?></td>
                <td class="px-4 py-3 whitespace-nowrap">
                  <?php echo htmlspecialchars($row["tanggal_janji"] ? date('d-m-Y', strtotime($row["tanggal_janji"])) : 'Belum ditentukan'); ?>
                </td>
                <td class="px-4 py-3 whitespace-nowrap">
                  <?php echo htmlspecialchars($row["metode_pertemuan"] ? ucfirst($row["metode_pertemuan"]) : 'Belum ditentukan'); ?>
                </td>
                <td class="px-4 py-3 max-w-sm break-words whitespace-normal"><?php echo htmlspecialchars($row["keperluan"]); ?></td>
                <td class="px-4 py-3 whitespace-nowrap"><?php echo htmlspecialchars($row["instansi_asal"]); ?></td>
                <td class="px-4 py-3 whitespace-nowrap"><?php echo htmlspecialchars($row["no_telpon"]); ?></td>
                <td class="px-4 py-3 max-w-sm break-words whitespace-normal"><?php echo htmlspecialchars($row["alamat"]); ?></td>
                <td class="px-4 py-3 whitespace-nowrap">
                  <?php echo htmlspecialchars($row["foto"] ? $row["foto"] : 'Tidak ada foto'); ?>
                </td>
              </tr>
              <?php
                }
              } else {
                echo '<tr><td colspan="10" class="p-4 text-center text-gray-500">Data tamu tidak ditemukan.</td></tr>';
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
       <div class="flex justify-between items-center mt-4">
        <p class="text-sm text-gray-500">Menampilkan <?php echo $result->num_rows; ?> data</p>
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
  </body>
</html>

<?php
// Selalu tutup statement dan koneksi setelah selesai
$stmt->close();
$conn->close();
?>