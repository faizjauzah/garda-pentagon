-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 30, 2025 at 02:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `garda_pentagon`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun_admin`
--

CREATE TABLE `akun_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun_admin`
--

INSERT INTO `akun_admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$W15FctU2qAOEmfm4b../eOP57FHSgiS1BAzuJEuLGjbM4O.mYSdWG'),
(2, 'admin_garda', '$2y$10$IJlsdbq5G26WQzagEABi1eABqFulNZ47QfMegm8m/kMlw9v3hs0Ba');

-- --------------------------------------------------------

--
-- Table structure for table `bidang_tujuan`
--

CREATE TABLE `bidang_tujuan` (
  `bidang_tujuan_id` int(11) NOT NULL,
  `nama_bidang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bidang_tujuan`
--

INSERT INTO `bidang_tujuan` (`bidang_tujuan_id`, `nama_bidang`) VALUES
(1, 'Pimpinan'),
(2, 'Kepaniteraan'),
(3, 'Kesekretariatan');

-- --------------------------------------------------------

--
-- Table structure for table `penerima_tamu`
--

CREATE TABLE `penerima_tamu` (
  `id_penerima` int(11) NOT NULL,
  `nama_penerima` varchar(100) NOT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `bidang_tujuan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penerima_tamu`
--

INSERT INTO `penerima_tamu` (`id_penerima`, `nama_penerima`, `jabatan`, `bidang_tujuan_id`) VALUES
(1, 'Dra. Nia Nurhamidah Romli, M.H.', 'Ketua Pengadilan', 1),
(2, 'Drs. Mohamad Yamin, S.H., M.H.', 'Wakil Ketua Pengadilan', 1),
(3, 'Drs. Mohammad H. Daud, M.H.', 'Hakim Tinggi', 1),
(4, 'Drs. Makmur, M.H.', 'Hakim Tinggi', 1),
(5, 'Drs. Mohd. Abdu A. Ramly,', 'Hakim Tinggi', 1),
(6, 'Dra. Sitti Nurdaliah, M.H.', 'Hakim Tinggi', 1),
(7, 'Drs. Kharis', 'Hakim Tinggi', 1),
(8, 'Drs. Rahmading, M.H.', 'Panitera Tingkat Banding', 2),
(9, 'Fahrurosyid, S.H., M.H.', 'Sekretaris', 3),
(10, 'Drs. Taufik Hasan Ngadi, M.H.', 'Panitera Muda Banding', 2),
(11, 'Harsono Pulu Rahman, S.H.I., M.H.', 'Kepala Bagian Perencanaan dan Kepegawaian', 3),
(12, 'Rahmanto Bilondatu, S.H., M.M.', 'Kepala Bagian Umum dan Keuangan', 3),
(13, 'Dra. Nibras A. Ahmad,', 'Panitera Muda Hukum', 2),
(14, 'Drs. Siswanto Supandi, S.H., M.H.', 'Panitera Pengganti', 2),
(15, 'Drs Halim A.R. Molou, M.H.', 'Panitera Pengganti', 2),
(16, 'Dra. Siti Rahmah Limonu, M.H.', 'Panitera Pengganti', 2),
(17, 'Arlin Abdullah Albakir, S.H., M.H.', 'Panitera Pengganti', 2),
(18, 'Yusra N. Paramata, S.H.I., M.H.', 'Panitera Pengganti', 2),
(19, 'Dra. Cindrawati S. Pakaya', 'Panitera Pengganti', 2),
(20, 'Dra. Martin Umar, S.H.', 'Panitera Pengganti', 2),
(21, 'Miranda Moki, S.Ag.', 'Panitera Pengganti', 2),
(22, 'Taufiq Maksum Gobel, S.H.I.', 'Panitera Pengganti', 2),
(23, 'Drs. Harnan Podungge, S.H.', 'Panitera Pengganti', 2),
(24, 'Lukman Alan Tomayahu, S.E.,M.M.', 'Kepala Subbagian Rencana Program dan Anggaran', 3),
(25, 'Irvan Umar, S.Kom.,M.H', 'Kepala Subbagian Kepegawaian dan Teknologi Informasi', 3),
(26, 'Anita Ma`Ruf, S.E.,M.M', 'Kepala Subbagian Keuangan dan Pelaporan', 3),
(27, 'Januar Hadi, A.Md.,S.H.', 'Kepala Subbagian Tata Usaha dan Rumah Tangga', 3),
(28, 'Dedi Bakari, S.A.P.', 'Arsiparis Ahli Pertama', 3),
(29, 'Sabri, S.Sos.', 'Perencana Ahli Pertama', 3),
(30, 'Sitti Rahmi Antuli, S.S.I.,M.H', 'Analis Pengelolaan Keuangan APBN Ahli Muda', 3),
(31, 'Agung Prayitno Lahati, A.Md.', 'Pranata Keuangan APBN Penyelia', 3),
(32, 'Sri Hartaty Arif Suleman, A.Md., S.E., M.H.', 'Operator - Penata Layanan Operasional', 3),
(33, 'Poni Katili, S.Kom', 'Operator - Penata Layanan Operasional', 3),
(34, 'Laila Nutfatun Ni\'mah, A.Md.Ak., S.Ak.', 'Klerek - Penelaah Teknis Kebijakan', 3),
(35, 'Dicky Indra Rusmana, A.Md., S.S.', 'Operator - Penata Layanan Operasional', 3),
(36, 'Chandra Hakinis, A.Md., S.E.', 'Operator - Penata Layanan Operasional', 3),
(37, 'Devi Amelia, S.E.', 'Klerek - Penelaah Teknis Kebijakan', 3),
(38, 'Rina Fauziah, S.E.', 'Operator - Penata Layanan Operasional', 3),
(39, 'Maryam Tapulu, S.H.', 'Klerek - Analis Perkara Peradilan', 2),
(40, 'Dedeh Novitasari, S.H.', 'Klerek - Analis Perkara Peradilan', 2),
(41, 'Firman Al Kautsar, S.H.', 'Klerek - Analis Perkara Peradilan', 2),
(42, 'Rafika Riniptasari, S.I.Kom.', 'Klerek - Penata Keprotokolan', 3),
(43, 'Ramadhan Yudha Pratama, S.Kom.', 'Penata Kelola Sistem dan Teknologi Informasi', 3),
(44, 'Mukharis, S.T.', 'Teknisi Sarana dan Prasarana', 3),
(45, 'Aliffudin Ilham Ata, A.Md.T.', 'Operator - Teknisi Sarana dan Prasarana', 3),
(46, 'Ayuk Candra Wardani, A.Md.A.B.', 'Klerek - Pengolah Data dan Informasi', 3),
(47, 'Eneng Haltini, A.Md.', 'Klerek - Pengolah Data dan Informasi', 3),
(48, 'Siti Mariah Kibtiah, A.Md', 'Klerek - Pengolah Data dan Informasi', 3),
(49, 'Kasyifatul Mawaddah, A.Md', 'Klerek - Pengelola Penanganan Perkara', 2),
(50, 'Apriliani, A.Md', 'Klerek - Pengelola Penanganan Perkara', 2),
(51, 'Mivan Destian Dehi Meli, S.T.', 'Operator - Penata Layanan Operasional', 3),
(52, 'Rahmat Danupoyo, S.H.', 'Operator - Penata Layanan Operasional', 3),
(53, 'Musyaril Harun', 'Operator Layanan Operasional', 3),
(54, 'Ridwan Paramani', 'Operator Layanan Operasional', 3),
(55, 'Andris I. Gaib', 'Operator Layanan Operasional', 3),
(56, 'Jois Bakari', 'Operator Layanan Operasional', 3),
(57, 'Noval Husain', 'Operator Layanan Operasional', 3),
(58, 'Wahyu Saputra Kariem', 'Operator Layanan Operasional', 3),
(59, 'Raflin Paputungan', 'Operator Layanan Operasional', 3),
(60, 'Rahman Pomalingo', 'Operator Layanan Operasional', 2),
(61, 'Udin Podungge', 'Operator Layanan Operasional', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tamu`
--

CREATE TABLE `tamu` (
  `tamu_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telpon` varchar(20) DEFAULT NULL,
  `instansi_asal` varchar(150) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `bidang_tujuan_id` int(11) DEFAULT NULL,
  `penerima_tamu_id` int(11) DEFAULT NULL,
  `keperluan` text DEFAULT NULL,
  `tanggal_janji` date DEFAULT NULL,
  `metode_pertemuan` enum('online','offline') DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_admin`
--
ALTER TABLE `akun_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `bidang_tujuan`
--
ALTER TABLE `bidang_tujuan`
  ADD PRIMARY KEY (`bidang_tujuan_id`);

--
-- Indexes for table `penerima_tamu`
--
ALTER TABLE `penerima_tamu`
  ADD PRIMARY KEY (`id_penerima`),
  ADD KEY `bidang_tujuan_id` (`bidang_tujuan_id`);

--
-- Indexes for table `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`tamu_id`),
  ADD KEY `bidang_tujuan_id` (`bidang_tujuan_id`),
  ADD KEY `fk_tamu_penerima` (`penerima_tamu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun_admin`
--
ALTER TABLE `akun_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bidang_tujuan`
--
ALTER TABLE `bidang_tujuan`
  MODIFY `bidang_tujuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penerima_tamu`
--
ALTER TABLE `penerima_tamu`
  MODIFY `id_penerima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tamu`
--
ALTER TABLE `tamu`
  MODIFY `tamu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penerima_tamu`
--
ALTER TABLE `penerima_tamu`
  ADD CONSTRAINT `penerima_tamu_ibfk_1` FOREIGN KEY (`bidang_tujuan_id`) REFERENCES `bidang_tujuan` (`bidang_tujuan_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tamu`
--
ALTER TABLE `tamu`
  ADD CONSTRAINT `fk_tamu_penerima` FOREIGN KEY (`penerima_tamu_id`) REFERENCES `penerima_tamu` (`id_penerima`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tamu_ibfk_1` FOREIGN KEY (`bidang_tujuan_id`) REFERENCES `bidang_tujuan` (`bidang_tujuan_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
