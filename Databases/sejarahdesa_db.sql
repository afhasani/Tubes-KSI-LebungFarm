-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 07:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sejarahdesa_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `sejarahdesa`
--

CREATE TABLE `sejarahdesa` (
  `id` int(11) NOT NULL,
  `deskripsi_sejarah` varchar(10000) NOT NULL,
  `tanggal_pembaruan` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sejarahdesa`
--

INSERT INTO `sejarahdesa` (`id`, `deskripsi_sejarah`, `tanggal_pembaruan`) VALUES
(1, 'Dahulu Desa Lebung Sari adalah hutan belantara. Konon menurut cerita penduduk, desa ini berasal dari Desa Talang Jawa. Sebagian masyarakat berasal dari Desa Talang Jawa dan sebagian ada yang berasal dari Jawa Tengah, Jawa Timur, Banten, Sumatera Barat, Sumatera Timur, dan Pribumi. Desa ini sudah mulai dihuni kurang lebih sejak tahun 1965. Mulanya mayoritas penduduk bersuku Jawa, Sunda, Lampung, dan Palembang. Kemudian datang para pendatang bersuku Batak, Bali, dan Padang.<br />\r\nPada tahun 1986 dimasa pemerintahan Sastro Sarmanto, Desa Talang Jawa terjadi pemekaran lima (5) desa yaitu Desa Lebung Sari, Puji Rahayu, Batu Agung, Sinar Karya, dan Tanjung Harapan. Desa Lebung Sari berdiri pada tanggal 09 Juli 1986 dan Pejabat Sementara adalah Sutarjo. Desa Lebung Sari menjadi definitif pada tanggal 14 November 1991.', '2024-11-07 10:28:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sejarahdesa`
--
ALTER TABLE `sejarahdesa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sejarahdesa`
--
ALTER TABLE `sejarahdesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
