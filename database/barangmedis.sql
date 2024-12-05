-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2024 at 09:13 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barangmedis`
--

-- --------------------------------------------------------

--
-- Table structure for table `baranggigi`
--

CREATE TABLE `baranggigi` (
  `idbaranggigi` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kategori` text NOT NULL,
  `jumlah` text NOT NULL,
  `tanggalmasuk` date NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `baranggigi`
--

INSERT INTO `baranggigi` (`idbaranggigi`, `nama`, `kategori`, `jumlah`, `tanggalmasuk`, `keterangan`) VALUES
(32, 'Sikat Gigi 1', 'Alat Pembersih Gigi', '10', '2024-11-27', '<p>tes 1</p>\r\n'),
(36, 'Sikat Gigi 2', 'Alat Pembersih Gigi', '5', '2024-11-27', '-');

-- --------------------------------------------------------

--
-- Table structure for table `barangumum`
--

CREATE TABLE `barangumum` (
  `idbarangumum` int(11) NOT NULL,
  `nama` text NOT NULL,
  `kategori` text NOT NULL,
  `jumlah` text NOT NULL,
  `tanggalmasuk` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barangumum`
--

INSERT INTO `barangumum` (`idbarangumum`, `nama`, `kategori`, `jumlah`, `tanggalmasuk`, `keterangan`) VALUES
(2, 'Kursi Roda', 'Alat Rumah Sakit', '55', '2024-11-27', '<p>tes</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `idpengguna` int(11) NOT NULL,
  `namapengguna` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`idpengguna`, `namapengguna`, `email`, `password`, `level`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', 'Admin'),
(2, 'Dian Purwanti', 'dian@gmail.com', 'dian', 'Perawat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baranggigi`
--
ALTER TABLE `baranggigi`
  ADD PRIMARY KEY (`idbaranggigi`);

--
-- Indexes for table `barangumum`
--
ALTER TABLE `barangumum`
  ADD PRIMARY KEY (`idbarangumum`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`idpengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baranggigi`
--
ALTER TABLE `baranggigi`
  MODIFY `idbaranggigi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `barangumum`
--
ALTER TABLE `barangumum`
  MODIFY `idbarangumum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `idpengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
