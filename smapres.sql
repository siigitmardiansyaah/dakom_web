-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2023 at 04:05 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smapres`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbabsen`
--

CREATE TABLE `tbabsen` (
  `id_absen` int(11) NOT NULL,
  `id_qr` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `waktu_absen` timestamp NULL DEFAULT NULL,
  `id_jam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbabsen`
--

INSERT INTO `tbabsen` (`id_absen`, `id_qr`, `id_karyawan`, `waktu_absen`, `id_jam`) VALUES
(11, 1, 1, '2023-02-06 03:05:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbdivisi`
--

CREATE TABLE `tbdivisi` (
  `id_divisi` int(11) NOT NULL,
  `kd_divisi` varchar(5) NOT NULL,
  `nama_divisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbdivisi`
--

INSERT INTO `tbdivisi` (`id_divisi`, `kd_divisi`, `nama_divisi`) VALUES
(1, 'MKT', 'Marketing Departement'),
(2, 'IT', 'IT Departement'),
(3, 'SU', 'Super User');

-- --------------------------------------------------------

--
-- Table structure for table `tbjam`
--

CREATE TABLE `tbjam` (
  `id_jam` int(11) NOT NULL,
  `nama_jam` varchar(25) NOT NULL,
  `batas_awal` timestamp NULL DEFAULT NULL,
  `batas_akhir` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbjam`
--

INSERT INTO `tbjam` (`id_jam`, `nama_jam`, `batas_awal`, `batas_akhir`) VALUES
(1, 'Datang', '2023-02-04 23:30:00', '2023-02-05 03:30:00'),
(2, 'Pulang', '2023-02-05 09:00:00', '2023-02-05 16:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbkaryawan`
--

CREATE TABLE `tbkaryawan` (
  `id_karyawan` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `device_id` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbkaryawan`
--

INSERT INTO `tbkaryawan` (`id_karyawan`, `nip`, `nama`, `id_divisi`, `device_id`, `password`) VALUES
(1, 'B0001', 'Sigit Mardiansyah', 2, '8014802f558211ac', '098f6bcd4621d373cade4e832627b4f6'),
(2, 'B0002', 'Andre', 1, '8014802f558211ac', '098f6bcd4621d373cade4e832627b4f6'),
(3, 'admin', 'admin', 3, '', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbqr`
--

CREATE TABLE `tbqr` (
  `id_qr` int(11) NOT NULL,
  `qr` varchar(255) NOT NULL,
  `waktu_buat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbqr`
--

INSERT INTO `tbqr` (`id_qr`, `qr`, `waktu_buat`) VALUES
(1, '1', '2023-02-06 03:02:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbabsen`
--
ALTER TABLE `tbabsen`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `fk_pegawai` (`id_karyawan`),
  ADD KEY `fk_qr` (`id_qr`),
  ADD KEY `fk_jam` (`id_jam`);

--
-- Indexes for table `tbdivisi`
--
ALTER TABLE `tbdivisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `tbjam`
--
ALTER TABLE `tbjam`
  ADD PRIMARY KEY (`id_jam`);

--
-- Indexes for table `tbkaryawan`
--
ALTER TABLE `tbkaryawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `fk_divisi` (`id_divisi`);

--
-- Indexes for table `tbqr`
--
ALTER TABLE `tbqr`
  ADD PRIMARY KEY (`id_qr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbabsen`
--
ALTER TABLE `tbabsen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbdivisi`
--
ALTER TABLE `tbdivisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbjam`
--
ALTER TABLE `tbjam`
  MODIFY `id_jam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbkaryawan`
--
ALTER TABLE `tbkaryawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbqr`
--
ALTER TABLE `tbqr`
  MODIFY `id_qr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbabsen`
--
ALTER TABLE `tbabsen`
  ADD CONSTRAINT `fk_jam` FOREIGN KEY (`id_jam`) REFERENCES `tbjam` (`id_jam`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pegawai` FOREIGN KEY (`id_karyawan`) REFERENCES `tbkaryawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_qr` FOREIGN KEY (`id_qr`) REFERENCES `tbqr` (`id_qr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbkaryawan`
--
ALTER TABLE `tbkaryawan`
  ADD CONSTRAINT `fk_divisi` FOREIGN KEY (`id_divisi`) REFERENCES `tbdivisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
