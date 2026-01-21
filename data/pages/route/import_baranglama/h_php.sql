-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Apr 2024 pada 13.58
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
-- Database: `h_php`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `title` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`title`, `description`) VALUES
('ttile', 'description'),
('aaaa', 'kfkdfjsdl fsdhf hsd fhksdj fhsd fhksd hf sdhfkhsdk fksdjhfdshfsd'),
('ttile', 'description'),
('bbbb', 'fsdfadfsdafsadfsd  fgsdgsag sfgsdsd'),
('ttile', 'description'),
('aaaa', 'kfkdfjsdl fsdhf hsd fhksdj fhsd fhksd hf sdhfkhsdk fksdjhfdshfsd'),
('ttile', 'description'),
('aaaa', 'kfkdfjsdl fsdhf hsd fhksdj fhsd fhksd hf sdhfkhsdk fksdjhfdshfsd'),
('ttile', 'description'),
('bbbb', 'fsdfadfsdafsadfsd  fgsdgsag sfgsdsd'),
('ttile', 'description'),
('aaaa', 'kfkdfjsdl fsdhf hsd fhksdj fhsd fhksd hf sdhfkhsdk fksdjhfdshfsd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mutasi`
--

CREATE TABLE `mutasi` (
  `tgl` date NOT NULL,
  `regional` int(2) NOT NULL,
  `kd_cus` int(4) NOT NULL,
  `nama_outlet` varchar(50) NOT NULL,
  `kd_sage` varchar(12) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `satuan` varchar(12) NOT NULL,
  `qty_awal` double NOT NULL,
  `nilai_awal` double NOT NULL,
  `qty_beli` double NOT NULL,
  `nilai_beli` double NOT NULL,
  `qt_produksi` double NOT NULL,
  `nilai_produksi` double NOT NULL,
  `qt_terima_int` double NOT NULL,
  `nilai_terima_int` double NOT NULL,
  `qt_tersedia` double NOT NULL,
  `nilai_tersedia` double NOT NULL,
  `harga_rata` double NOT NULL,
  `qt_kirim_int` double NOT NULL,
  `nilai_kirim_int` double NOT NULL,
  `qt_pake` double NOT NULL,
  `nilai_pake` double NOT NULL,
  `qt_jual` double NOT NULL,
  `nilai_jual` double NOT NULL,
  `hpp_jual` double NOT NULL,
  `qt_akhir` double NOT NULL,
  `nilai_akhir` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mutasi_a`
--

CREATE TABLE `mutasi_a` (
  `id` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `regional` int(2) DEFAULT 0,
  `kd_cus` int(4) DEFAULT 0,
  `nama_outlet` varchar(50) DEFAULT NULL,
  `kd_sage` varchar(12) DEFAULT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `satuan` varchar(12) DEFAULT NULL,
  `qty_awal` double NOT NULL DEFAULT 0,
  `nilai_awal` double NOT NULL DEFAULT 0,
  `qty_beli` double NOT NULL DEFAULT 0,
  `nilai_beli` double NOT NULL DEFAULT 0,
  `qt_produksi` double NOT NULL DEFAULT 0,
  `nilai_produksi` double NOT NULL DEFAULT 0,
  `qt_terima_int` double NOT NULL DEFAULT 0,
  `nilai_terima_int` double NOT NULL DEFAULT 0,
  `qt_tersedia` double NOT NULL DEFAULT 0,
  `nilai_tersedia` double NOT NULL DEFAULT 0,
  `harga_rata` double NOT NULL DEFAULT 0,
  `qt_kirim_int` double NOT NULL DEFAULT 0,
  `nilai_kirim_int` double NOT NULL DEFAULT 0,
  `qt_pake` double NOT NULL DEFAULT 0,
  `nilai_pake` double NOT NULL DEFAULT 0,
  `qt_jual` double NOT NULL DEFAULT 0,
  `nilai_jual` double NOT NULL DEFAULT 0,
  `hpp_jual` double NOT NULL DEFAULT 0,
  `qt_akhir` double NOT NULL DEFAULT 0,
  `nilai_akhir` double NOT NULL DEFAULT 0,
  `harga_patokan_hpp` double NOT NULL DEFAULT 0,
  `nilai_qty_hpp` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mutasi_a`
--
ALTER TABLE `mutasi_a`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mutasi_a`
--
ALTER TABLE `mutasi_a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103995;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
