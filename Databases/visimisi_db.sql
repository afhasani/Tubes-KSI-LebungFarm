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
-- Database: `visimisi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `visimisi_db`
--

CREATE TABLE `visimisi_db` (
  `id` int(11) NOT NULL,
  `visi_misi` varchar(1500) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('''aktif''','''nonaktif''') NOT NULL DEFAULT '''aktif'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visimisi_db`
--

INSERT INTO `visimisi_db` (`id`, `visi_misi`, `created_at`, `updated_at`, `status`) VALUES
(1, 'VISI<br />\r\n“Terwujudnya Masyarakat Desa Lebung Sari Yang Berakhlak Mulia, Sehat, Cerdas, Mandiri dan Sejahtera”<br />\r\n<br />\r\nMISI<br />\r\n1). Mewujudkan Pemerintahan Desa yang Tertib dan Berwibawa<br />\r\n- Terwujudnya Kegiatan Pemerintahan Desa Lebung Sari tertib & lancar<br />\r\n- Terwujudnya tata perencanaan Desa yang lebih baiK<br />\r\n2). Mewujudkan Sarana Prasarana Desa yang Memadai<br />\r\n- Terwujudnya sarana Jalan desa yang dapat mendukung perekonomian Desa<br />\r\n- Terwujudnya sarana sanitasi lingkungan Desa yang baik<br />\r\n3). Mewujudkan Perekonomian dan Kesejahteraan Warga<br />\r\n- Meningkatkan usaha ekonomi produktif warga Desa<br />\r\n- Meningkatkan sistem Ketertiban dan Keamanan Masyarakat', '2024-11-13 16:51:38', '2024-11-13 23:41:10', '\'aktif\'');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `visimisi_db`
--
ALTER TABLE `visimisi_db`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `visimisi_db`
--
ALTER TABLE `visimisi_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
