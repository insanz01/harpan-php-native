-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Agu 2023 pada 15.27
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `harga_pangan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `inflasi`
--

CREATE TABLE `inflasi` (
  `id` int(11) NOT NULL,
  `id_komoditas` int(11) NOT NULL,
  `nominal` int(11) DEFAULT NULL,
  `nilai` varchar(20) DEFAULT NULL,
  `approved_at` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `inflasi`
--

INSERT INTO `inflasi` (`id`, `id_komoditas`, `nominal`, `nilai`, `approved_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 1, 5, 'Naik Rendah', '2023-07-06 20:09:11', '2023-07-06 20:09:11', '2023-07-30 00:00:00', NULL),
(5, 2, 2, 'Naik Rendah', '2023-08-04 08:53:31', '2023-08-04 08:53:31', '2023-08-04 08:53:31', NULL),
(6, 2, 8, 'Naik Rendah', '2023-08-04 11:26:31', '2023-08-04 11:26:31', '2023-08-04 11:26:31', NULL),
(7, 2, 2, 'Naik Rendah', '2023-08-08 19:45:50', '2023-08-08 00:00:00', '2023-08-08 19:45:50', NULL),
(12, 6, 5, 'Naik Rendah', '2023-08-08 20:09:52', '2023-08-08 00:00:00', '2023-08-08 20:09:52', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `inflasi`
--
ALTER TABLE `inflasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `inflasi`
--
ALTER TABLE `inflasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
