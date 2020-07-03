-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2020 at 05:51 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `nm_divisi` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nm_divisi`, `status`) VALUES
(1, 'keamanan', 1),
(2, 'kebersihan', 1),
(3, 'kantor', 1);

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
(1, 'ahmad', 21, 1, 'panji permai', '1999-01-22', 'l', '0895380894476', 1),
(2, 'nurul ni', 21, 2, 'probolinggo', '1988-12-10', 'p', '0895380894453', 1),
(3, 'bagas purwanto', 20, 3, 'jember', '2020-07-22', 'l', '0895380894476', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nm_kriteria` varchar(60) NOT NULL,
  `bobot` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nm_kriteria`, `bobot`, `status`, `created_at`, `updated_at`) VALUES
(1, 'kepemimpinan', 10, 1, '0000-00-00 00:00:00', NULL),
(2, 'perilaku', 1000, 1, '0000-00-00 00:00:00', '2020-07-03 08:42:39'),
(3, 'kerja sama', 20, 1, '0000-00-00 00:00:00', '2020-07-03 09:56:06'),
(4, 'penguasaan', 15, 1, '0000-00-00 00:00:00', NULL),
(5, 'penampilan', 5, 1, '0000-00-00 00:00:00', NULL),
(6, 'tanggung jawab', 20, 1, '0000-00-00 00:00:00', NULL);

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
(1, 1, 'sangat baik', 100, 1, '2020-07-03 09:32:46', NULL),
(2, 1, 'cukup baik', 60, 1, '2020-07-03 09:33:11', NULL),
(3, 1, 'sangat baik', 30, 1, '2020-07-03 09:33:19', '2020-07-03 10:08:09'),
(4, 2, 'sangat baik', 100, 1, '2020-07-03 09:49:15', NULL),
(5, 2, 'baik', 80, 1, '2020-07-03 09:49:27', NULL),
(6, 2, 'cukup', 60, 1, '2020-07-03 09:49:36', NULL),
(7, 2, 'kurang', 40, 1, '2020-07-03 09:49:44', '2020-07-03 10:08:28'),
(8, 2, 'sangat kurang', 20, 1, '2020-07-03 09:49:55', NULL),
(9, 3, 'sangat baik', 100, 1, '2020-07-03 09:51:14', NULL),
(10, 3, 'baik', 80, 1, '2020-07-03 09:51:28', NULL),
(11, 3, 'cukup', 60, 1, '2020-07-03 09:51:42', NULL),
(12, 3, 'kurang', 40, 1, '2020-07-03 09:51:55', NULL),
(13, 3, 'sangat kurang', 20, 1, '2020-07-03 09:52:05', NULL),
(14, 4, 'sangat terampil', 100, 1, '2020-07-03 09:52:17', NULL),
(15, 4, 'terampil', 70, 1, '2020-07-03 09:52:30', NULL),
(16, 4, 'cukup terampil', 50, 1, '2020-07-03 09:52:45', NULL),
(17, 4, 'kurang terampil', 30, 1, '2020-07-03 09:53:01', NULL),
(18, 5, 'sangat baik', 100, 1, '2020-07-03 09:53:16', NULL),
(19, 5, 'baik', 80, 1, '2020-07-03 09:53:26', NULL),
(20, 5, 'cukup', 60, 1, '2020-07-03 09:53:36', NULL),
(21, 5, 'kurang', 40, 1, '2020-07-03 09:53:47', NULL),
(22, 5, 'sangat kurang', 20, 1, '2020-07-03 09:54:06', NULL),
(23, 6, 'ya', 100, 1, '2020-07-03 09:54:19', NULL),
(24, 6, 'cukup', 50, 1, '2020-07-03 09:54:26', NULL),
(25, 6, 'tidak', 30, 1, '2020-07-03 09:54:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `periode` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_detail`
--

CREATE TABLE `penilaian_detail` (
  `id_pnl_detail` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_role` tinyint(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_role`, `nama`, `username`, `password`) VALUES
(1, 1, 'niko wahyu fitrianto', 'nikowahyu', '$2y$10$Dh5La1Ms3qkSzSvplIhQ3.rvF3yD2SqM7Wbb3jDAVME.8iTDaZ3kC'),
(2, 2, 'nurul aini', 'nuraini', '$2y$10$Dh5La1Ms3qkSzSvplIhQ3.rvF3yD2SqM7Wbb3jDAVME.8iTDaZ3kC');

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
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
