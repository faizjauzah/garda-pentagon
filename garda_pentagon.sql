-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Okt 2025 pada 18.02
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `bidang_tujuan`
--

CREATE TABLE `bidang_tujuan` (
  `bidang_tujuan_id` int(11) NOT NULL,
  `nama_bidang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bidang_tujuan`
--

INSERT INTO `bidang_tujuan` (`bidang_tujuan_id`, `nama_bidang`) VALUES
(1, 'Pimpinan'),
(2, 'Kepaniteraan'),
(3, 'Kesekretariatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerima_tamu`
--

CREATE TABLE `penerima_tamu` (
  `id_penerima` int(11) NOT NULL,
  `nama_penerima` varchar(100) NOT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `bidang_tujuan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tamu`
--

CREATE TABLE `tamu` (
  `tamu_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telpon` varchar(20) DEFAULT NULL,
  `instansi_asal` varchar(150) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `bidang_tujuan_id` int(11) DEFAULT NULL,
  `keperluan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bidang_tujuan`
--
ALTER TABLE `bidang_tujuan`
  ADD PRIMARY KEY (`bidang_tujuan_id`);

--
-- Indeks untuk tabel `penerima_tamu`
--
ALTER TABLE `penerima_tamu`
  ADD PRIMARY KEY (`id_penerima`),
  ADD KEY `bidang_tujuan_id` (`bidang_tujuan_id`);

--
-- Indeks untuk tabel `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`tamu_id`),
  ADD KEY `bidang_tujuan_id` (`bidang_tujuan_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bidang_tujuan`
--
ALTER TABLE `bidang_tujuan`
  MODIFY `bidang_tujuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `penerima_tamu`
--
ALTER TABLE `penerima_tamu`
  MODIFY `id_penerima` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tamu`
--
ALTER TABLE `tamu`
  MODIFY `tamu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `penerima_tamu`
--
ALTER TABLE `penerima_tamu`
  ADD CONSTRAINT `penerima_tamu_ibfk_1` FOREIGN KEY (`bidang_tujuan_id`) REFERENCES `bidang_tujuan` (`bidang_tujuan_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tamu`
--
ALTER TABLE `tamu`
  ADD CONSTRAINT `tamu_ibfk_1` FOREIGN KEY (`bidang_tujuan_id`) REFERENCES `bidang_tujuan` (`bidang_tujuan_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
