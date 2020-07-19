-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2020 at 01:50 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_karyawan`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `id_ketua_divisi` int(11) NOT NULL,
  `nm_divisi` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `id_ketua_divisi`, `nm_divisi`, `status`) VALUES
(1, 1, 'Front Office', 1),
(2, 2, 'House Keeping', 1),
(3, 3, 'Food and Beverage Service', 1),
(4, 4, 'Food and Beverage Product', 1),
(5, 5, 'Security', 1);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `umur` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jns_kelamin` char(1) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `umur`, `id_divisi`, `alamat`, `tgl_lahir`, `jns_kelamin`, `no_hp`, `status`) VALUES
(1, 'Ai', 21, 1, 'Tongas Kulon', '1999-02-13', 'p', '098766', 1),
(2, 'Indri', 22, 2, 'Situbondo', '1998-09-08', 'p', '87654', 1),
(3, 'Gadiecha', 21, 3, 'Probolinggo', '1999-02-02', 'p', '09888', 1),
(4, 'Riski', 23, 5, 'Tongas', '1997-08-07', 'l', '89765', 1),
(5, 'Anggry', 21, 4, 'bwi', '1998-08-04', 'p', '9876', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ketua_divisi`
--

CREATE TABLE `ketua_divisi` (
  `id_ketua_divisi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nohp` varchar(13) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ketua_divisi`
--

INSERT INTO `ketua_divisi` (`id_ketua_divisi`, `id_user`, `nohp`, `alamat`) VALUES
(1, 5, '09876555', 'Lumbang'),
(2, 6, '098765', 'Tongas'),
(3, 7, '09876578', 'Branggah'),
(4, 8, '08764789', 'Bayeman'),
(5, 9, '0876543', 'Jaringan');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `nm_kriteria` varchar(60) NOT NULL,
  `bobot` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `id_periode`, `nm_kriteria`, `bobot`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kepemimpinan', 10, 1, '2020-07-19 06:13:49', NULL),
(2, 1, 'Perilaku', 30, 1, '2020-07-19 06:14:08', NULL),
(3, 1, 'Kerjasama', 20, 1, '2020-07-19 06:14:27', NULL),
(4, 1, 'Penguasaan', 15, 1, '2020-07-19 06:14:45', NULL),
(5, 1, 'Penampilan', 5, 1, '2020-07-19 06:15:15', NULL),
(6, 1, 'Tanggung Jawab', 20, 1, '2020-07-19 06:15:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parameter`
--

CREATE TABLE `parameter` (
  `id_parameter` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nm_parameter` varchar(250) NOT NULL,
  `nilai` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parameter`
--

INSERT INTO `parameter` (`id_parameter`, `id_kriteria`, `nm_parameter`, `nilai`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sangat Baik', 100, 1, '2020-07-19 06:16:13', NULL),
(2, 1, 'Baik', 60, 1, '2020-07-19 06:16:29', NULL),
(3, 1, 'Cukup Baik', 30, 1, '2020-07-19 06:16:47', NULL),
(4, 2, 'Sangat Baik', 100, 1, '2020-07-19 06:17:07', NULL),
(5, 2, 'Baik', 80, 1, '2020-07-19 06:17:30', NULL),
(6, 2, 'Cukup', 60, 1, '2020-07-19 06:17:52', NULL),
(7, 2, 'Kurang', 40, 1, '2020-07-19 06:18:15', NULL),
(8, 2, 'Sangat Kurang', 20, 1, '2020-07-19 06:18:43', NULL),
(9, 3, 'Sangat Baik', 100, 1, '2020-07-19 06:19:14', NULL),
(10, 3, 'Baik', 80, 1, '2020-07-19 06:19:35', NULL),
(11, 3, 'Cukup', 60, 1, '2020-07-19 06:20:00', NULL),
(12, 3, 'Kurang', 40, 1, '2020-07-19 06:20:35', NULL),
(13, 3, 'Sangat Kurang', 20, 1, '2020-07-19 06:20:57', NULL),
(14, 4, 'Sangat Terampil', 100, 1, '2020-07-19 06:21:33', NULL),
(15, 4, 'Terampil', 70, 1, '2020-07-19 06:22:00', NULL),
(16, 4, 'Cukup Terampil', 50, 1, '2020-07-19 06:22:33', NULL),
(17, 4, 'Kurang Terampil', 30, 1, '2020-07-19 06:23:07', NULL),
(18, 5, 'Sangat Baik', 100, 1, '2020-07-19 06:23:38', NULL),
(19, 5, 'Baik', 80, 1, '2020-07-19 06:24:18', NULL),
(20, 5, 'Cukup', 60, 1, '2020-07-19 06:24:51', NULL),
(21, 5, 'Kurang', 40, 1, '2020-07-19 06:25:23', NULL),
(22, 5, 'Sangat Kurang', 20, 1, '2020-07-19 06:25:47', NULL),
(23, 6, 'Ya', 100, 1, '2020-07-19 06:26:08', NULL),
(24, 6, 'Cukup', 50, 1, '2020-07-19 06:26:37', NULL),
(25, 6, 'Tidak', 30, 1, '2020-07-19 06:26:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_detail`
--

CREATE TABLE `penilaian_detail` (
  `id_pnl_detail` int(11) NOT NULL,
  `id_penilaian` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `periode_kriteria`
--

CREATE TABLE `periode_kriteria` (
  `id_periode` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `periode` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `periode_kriteria`
--

INSERT INTO `periode_kriteria` (`id_periode`, `tahun`, `periode`, `status`) VALUES
(1, 2020, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_role` tinyint(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_role`, `nama`, `username`, `password`, `status`) VALUES
(1, 1, 'niko wahyu fitrianto', 'nikowahyu', '$2y$10$Dh5La1Ms3qkSzSvplIhQ3.rvF3yD2SqM7Wbb3jDAVME.8iTDaZ3kC', 1),
(2, 2, 'nurul aini', 'nuraini', '$2y$10$Dh5La1Ms3qkSzSvplIhQ3.rvF3yD2SqM7Wbb3jDAVME.8iTDaZ3kC', 1),
(5, 3, 'Herman', 'Herman', '$2y$10$GpqiPsQ6EuKlPfubfVrFcO7dMSn/Q6oubaLZs4wBq2Gf6ojF0tjbC', 0),
(6, 3, 'Nurul Aini', 'Aini', '$2y$10$LutSOzcH9cAXEHC5bMprpOmC31XaqAQRvdXjKVFym5myPVazS2KPe', 0),
(7, 3, 'Meta GW', 'Meta', '$2y$10$YmN5QZyXhG8bzsRjU6dTo.O5uu4jYyrgQF9N1gEPMArpNtBOlOpXC', 0),
(8, 3, 'Rosalia Wahyu', 'Rosalia', '$2y$10$NKslltFDl4gB.7bjOdXBx.v.3FzSHQ6yXuvFu.WoXPWb1eGeIVLh2', 0),
(9, 3, 'Septian Felany', 'Septian', '$2y$10$GDs5EOgcOxgARY2SRcuuFesqerocTlsXct5K2mh3mp9mduUXOAT6u', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `ketua_divisi`
--
ALTER TABLE `ketua_divisi`
  ADD PRIMARY KEY (`id_ketua_divisi`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `parameter`
--
ALTER TABLE `parameter`
  ADD PRIMARY KEY (`id_parameter`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indexes for table `penilaian_detail`
--
ALTER TABLE `penilaian_detail`
  ADD PRIMARY KEY (`id_pnl_detail`);

--
-- Indexes for table `periode_kriteria`
--
ALTER TABLE `periode_kriteria`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ketua_divisi`
--
ALTER TABLE `ketua_divisi`
  MODIFY `id_ketua_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `parameter`
--
ALTER TABLE `parameter`
  MODIFY `id_parameter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penilaian_detail`
--
ALTER TABLE `penilaian_detail`
  MODIFY `id_pnl_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `periode_kriteria`
--
ALTER TABLE `periode_kriteria`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
