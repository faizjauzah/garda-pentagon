<?php
  include '../config/config.php';
  include '../utils/session.php';

  // =======================================================
  // BAGIAN 1: QUERY UNTUK KARTU STATISTIK (Tidak berubah)
  // =======================================================
  $jumlah_tamu = [
      'Pimpinan' => 0,
      'Kepaniteraan' => 0,
      'Kesekretariatan' => 0
  ];
  $sql_counts = "SELECT 
                  b.nama_bidang, 
                  COUNT(t.tamu_id) AS jumlah
              FROM 
                  tamu t
              JOIN 
                  bidang_tujuan b ON t.bidang_tujuan_id = b.bidang_tujuan_id
              GROUP BY 
                  b.nama_bidang";
  $result_counts = $conn->query($sql_counts);

  if ($result_counts && $result_counts->num_rows > 0) {
    while($row_counts = $result_counts->fetch_assoc()) {
      if (array_key_exists($row_counts['nama_bidang'], $jumlah_tamu)) {
        $jumlah_tamu[$row_counts['nama_bidang']] = $row_counts['jumlah'];
      }
    }
  }

  // =======================================================
  // BAGIAN 2: LOGIKA TABEL (DIMODIFIKASI DENGAN PAGINATION)
  // =======================================================
  
  // --- Variabel Filter & Pencarian (Sama) ---
  $filter_tabel = isset($_GET['filter']) ? $_GET['filter'] : '';
  $search_tabel = isset($_GET['search']) ? trim($_GET['search']) : '';
  $conditions_tabel = []; 
  $params_tabel = [];
  $types_tabel = '';

  // --- Logika Pencarian (Sama) ---
  if (!empty($search_tabel)) {
      $search_term = "%" . $search_tabel . "%";
      $conditions_tabel[] = "(t.nama LIKE ? OR t.instansi_asal LIKE ? OR t.keperluan LIKE ? OR pt.nama_penerima LIKE ? OR b.nama_bidang LIKE ?)";
      array_push($params_tabel, $search_term, $search_term, $search_term, $search_term, $search_term);
      $types_tabel .= 'sssss';
  }

  // --- Logika Filter Tanggal (Sama) ---
  if (!empty($filter_tabel)) {
      // ... (logika switch case Anda tidak berubah) ...
      switch ($filter_tabel) {
          case 'today':
              $conditions_tabel[] = "DATE(t.tanggal_janji) = CURDATE()";
              break;
          case 'week':
              $conditions_tabel[] = "YEARWEEK(t.tanggal_janji, 1) = YEARWEEK(CURDATE(), 1)";
              break;
          case 'month':
              $conditions_tabel[] = "MONTH(t.tanggal_janji) = MONTH(CURDATE()) AND YEAR(t.tanggal_janji) = YEAR(CURDATE())";
              break;
      }
  }

  // --- (BARU) Inisialisasi Paginasi ---
  $limit = 20; // Jumlah data per halaman
  $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $offset = ($current_page - 1) * $limit;

  // --- (BARU) Query 1: Menghitung TOTAL DATA yang Sesuai Filter ---
  $sql_total = "SELECT COUNT(t.tamu_id) as total
                FROM tamu t
                JOIN bidang_tujuan b ON t.bidang_tujuan_id = b.bidang_tujuan_id
                LEFT JOIN penerima_tamu pt ON t.penerima_tamu_id = pt.id_penerima";
  
  if (!empty($conditions_tabel)) {
      $sql_total .= " WHERE " . implode(' AND ', $conditions_tabel);
  }

  $stmt_total = $conn->prepare($sql_total);
  if (!empty($params_tabel)) {
      $stmt_total->bind_param($types_tabel, ...$params_tabel);
  }
  $stmt_total->execute();
  $total_rows = $stmt_total->get_result()->fetch_assoc()['total'];
  $total_pages = ceil($total_rows / $limit);
  $stmt_total->close();


  // --- (DIMODIFIKASI) Query 2: Mengambil DATA UNTUK HALAMAN SAAT INI ---
  $sql_tabel = "SELECT 
              t.tamu_id, t.nama, t.no_telpon, t.instansi_asal, t.alamat,
              b.nama_bidang, 
              pt.nama_penerima, 
              t.keperluan, t.tanggal_janji, t.metode_pertemuan, t.foto
          FROM 
              tamu t
          JOIN 
              bidang_tujuan b ON t.bidang_tujuan_id = b.bidang_tujuan_id
          LEFT JOIN 
              penerima_tamu pt ON t.penerima_tamu_id = pt.id_penerima";

  if (!empty($conditions_tabel)) {
      $sql_tabel .= " WHERE " . implode(' AND ', $conditions_tabel);
  }

  // Tambahkan LIMIT dan OFFSET
  $sql_tabel .= " ORDER BY t.tanggal_janji DESC, t.tamu_id DESC LIMIT ? OFFSET ?";

  // Tambahkan 'ii' (integer, integer) untuk LIMIT dan OFFSET
  $types_tabel_pagination = $types_tabel . 'ii'; 
  // Tambahkan $limit dan $offset ke array parameter
  $params_tabel_pagination = $params_tabel;
  $params_tabel_pagination[] = $limit;
  $params_tabel_pagination[] = $offset;

  $stmt_tabel = $conn->prepare($sql_tabel);
  if (!empty($params_tabel_pagination)) {
      // Gunakan variabel baru untuk bind_param
      $stmt_tabel->bind_param($types_tabel_pagination, ...$params_tabel_pagination);
  }
  $stmt_tabel->execute();
  $result_tabel = $stmt_tabel->get_result();

  // --- (BARU) Buat URL dasar untuk link paginasi (agar filter tetap ada) ---
  $query_params = [];
  if (!empty($search_tabel)) { $query_params['search'] = $search_tabel; }
  if (!empty($filter_tabel)) { $query_params['filter'] = $filter_tabel; }
  $base_url = 'dashboard.php?' . http_build_query($query_params) . '&';

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
    <?php
      include '../includes/sidebar.php';
    ?>

    <main class="flex-1 flex flex-col px-4 py-6 lg:py-10 gap-6 overflow-x-hidden">

      <header class="flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-[#131313]">
          Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!
        </h1>
      </header>

      <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 w-full gap-4">
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
      </section>

      <header class="flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-[#131313]">Riwayat Semua Tamu</h1>
      </header>

      <form action="dashboard.php" method="GET" class="w-full">
         <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
          <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden w-full sm:w-1/2 bg-white">
            <img src="../public/images/search.svg" alt="Search" class="w-5 h-5 mx-2 text-gray-500" />
            <input type="text" name="search" placeholder="Cari nama, instansi, keperluan, penerima, atau bidang..." class="flex-1 p-2 outline-none text-sm" value="<?php echo htmlspecialchars($search_tabel); ?>" />
          </div>
          <div class="flex items-center gap-2">
            <select name="filter" class="border border-gray-300 rounded-lg p-2 text-sm text-gray-700 bg-white">
              <option value="">Semua Tanggal</option>
              <option value="today" <?php if ($filter_tabel == 'today') echo 'selected'; ?>>Hari ini</option>
              <option value="week" <?php if ($filter_tabel == 'week') echo 'selected'; ?>>Minggu ini</option>
              <option value="month" <?php if ($filter_tabel == 'month') echo 'selected'; ?>>Bulan ini</option>
            </select>
            <button type="submit" class="bg-[#1d4c08] hover:bg-[#163805] text-white rounded-lg px-4 py-2 text-sm font-medium">Cari</button>
            <a href="dashboard.php" class="text-sm text-gray-600 hover:text-gray-900 px-3 py-2 bg-gray-200 rounded-lg">Reset</a>
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
                <th class="px-4 py-3">Bidang Tujuan</th> 
                <th class="px-4 py-3">Bertemu Dengan</th>
                <th class="px-4 py-3">Tanggal Janji</th>
                <th class="px-4 py-3">Metode</th>
                <th class="px-4 py-3">Keperluan</th>
                <th class="px-4 py-3">Instansi Asal</th>
                <th class="px-4 py-3">No. Telepon</th>
                <th class="px-4 py-3">Alamat</th>
                <th class="px-4 py-3">Foto</th>
              </tr>
            </thead>
            <tbody class="text-sm text-gray-700">
              <?php
              if ($result_tabel && $result_tabel->num_rows > 0) {
                // (BARU) Sesuaikan nomor urut berdasarkan halaman
                $nomor = $offset + 1; 
                while($row = $result_tabel->fetch_assoc()) {
              ?>
              <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                <td class="px-4 py-3 whitespace-nowrap"><?php echo $nomor++; ?></td>
                <td class="px-4 py-3 whitespace-nowrap"><?php echo htmlspecialchars($row["tamu_id"]); ?></td>
                <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-900"><?php echo htmlspecialchars($row["nama"] ?: 'Belum ditentukan'); ?></td>
                <td class="px-4 py-3 whitespace-nowrap"><?php echo htmlspecialchars($row["nama_bidang"] ?: 'Belum ditentukan'); ?></td>
                <td class="px-4 py-3 whitespace-nowrap">
                  <?php echo htmlspecialchars($row["nama_penerima"] ?: 'Belum ditentukan'); ?>
                </td>
                <td class="px-4 py-3 whitespace-nowrap">
                  <?php echo $row["tanggal_janji"] ? htmlspecialchars(date('d-m-Y', strtotime($row["tanggal_janji"]))) : 'Belum ditentukan'; ?>
                </td>
                <td class="px-4 py-3 whitespace-nowrap">
                  <?php echo $row["metode_pertemuan"] ? htmlspecialchars(ucfirst($row["metode_pertemuan"])) : 'Belum ditentukan'; ?>
                </td>
                <td class="px-4 py-3 max-w-sm break-words whitespace-normal"><?php echo htmlspecialchars($row["keperluan"] ?: 'Belum ditentukan'); ?></td>
                <td class="px-4 py-3 whitespace-nowrap"><?php echo htmlspecialchars($row["instansi_asal"] ?: 'Belum ditentukan'); ?></td>
                <td class="px-4 py-3 whitespace-nowrap"><?php echo htmlspecialchars($row["no_telpon"] ?: 'Belum ditentukan'); ?></td>
                <td class="px-4 py-3 max-w-sm break-words whitespace-normal"><?php echo htmlspecialchars($row["alamat"] ?: 'Belum ditentukan'); ?></td>
                <td class="px-4 py-3 whitespace-nowrap">
                  <?php if (!empty($row["foto"])): ?>
                    <a href="../public/uploads/<?php echo htmlspecialchars($row["foto"]); ?>" 
                       target="_blank" 
                       class="text-blue-600 hover:text-blue-800 hover:underline">
                      Lihat Foto
                    </a>
                  <?php else: ?>
                    <span class="text-gray-500">Belum ditentukan</span>
                  <?php endif; ?>
                </td>
              </tr>
              <?php
                }
              } else {
                echo '<tr><td colspan="12" class="p-4 text-center text-gray-500">Data tamu tidak ditemukan.</td></tr>';
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="flex flex-col lg:flex-row justify-between items-center mt-4 gap-4">
        <p class="text-sm text-gray-500">
          Menampilkan <?php echo $result_tabel->num_rows; ?> data
          (Halaman <?php echo $current_page; ?> dari <?php echo $total_pages; ?>)
          - Total <?php echo $total_rows; ?> data
        </p>

        <?php if ($total_pages > 1): ?>
          <nav class="flex items-center gap-1">
            <a href="<?php echo $base_url . 'page=' . ($current_page - 1); ?>"
               class="px-3 py-1 text-sm rounded-md <?php echo $current_page <= 1 ? 'bg-gray-200 text-gray-400 pointer-events-none' : 'bg-white text-gray-700 hover:bg-gray-100 shadow-sm'; ?>">
              &laquo; Sebelumnya
            </a>

            <?php 
              // Tentukan rentang nomor yang ditampilkan
              $max_links = 5;
              $start = max(1, $current_page - floor($max_links / 2));
              $end = min($total_pages, $start + $max_links - 1);
              // Sesuaikan $start jika $end mencapai batas
              $start = max(1, min($start, $total_pages - $max_links + 1));

              if ($start > 1) {
                  echo '<a href="'.$base_url.'page=1" class="px-3 py-1 text-sm rounded-md bg-white text-gray-700 hover:bg-gray-100 shadow-sm">1</a>';
                  if ($start > 2) {
                      echo '<span class="px-3 py-1 text-sm">...</span>';
                  }
              }

              for ($i = $start; $i <= $end; $i++): 
            ?>
              <a href="<?php echo $base_url . 'page=' . $i; ?>"
                 class="px-3 py-1 text-sm rounded-md <?php echo $i == $current_page ? 'bg-[#1d4c08] text-white' : 'bg-white text-gray-700 hover:bg-gray-100 shadow-sm'; ?>">
                <?php echo $i; ?>
              </a>
            <?php 
              endfor; 

              if ($end < $total_pages) {
                  if ($end < $total_pages - 1) {
                      echo '<span class="px-3 py-1 text-sm">...</span>';
                  }
                  echo '<a href="'.$base_url.'page='.$total_pages.'" class="px-3 py-1 text-sm rounded-md bg-white text-gray-700 hover:bg-gray-100 shadow-sm">'.$total_pages.'</a>';
              }
            ?>

            <a href="<?php echo $base_url . 'page=' . ($current_page + 1); ?>"
               class="px-3 py-1 text-sm rounded-md <?php echo $current_page >= $total_pages ? 'bg-gray-200 text-gray-400 pointer-events-none' : 'bg-white text-gray-700 hover:bg-gray-100 shadow-sm'; ?>">
              Berikutnya &raquo;
            </a>
          </nav>
        <?php endif; ?>
      </div>

    </main> <script>
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

    <?php
      $stmt_tabel->close();
      $conn->close();
    ?>
  </body>
</html>