-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2020 at 05:36 PM
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
-- Database: `e_voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama`) VALUES
('admin', '123', 'janur');

-- --------------------------------------------------------

--
-- Table structure for table `kandidat`
--

CREATE TABLE `kandidat` (
  `id_kandidat` varchar(25) NOT NULL,
  `gambar` varchar(2000) NOT NULL,
  `namaketua` varchar(25) DEFAULT NULL,
  `namawakil` varchar(25) DEFAULT NULL,
  `nokandidat` varchar(10) DEFAULT NULL,
  `visi` varchar(200) DEFAULT NULL,
  `misi` varchar(200) DEFAULT NULL,
  `jml` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kandidat`
--

INSERT INTO `kandidat` (`id_kandidat`, `gambar`, `namaketua`, `namawakil`, `nokandidat`, `visi`, `misi`, `jml`) VALUES
('21202400', '5d1b847eb2760.png', 'Thowaf Fuad Hasan', 'Wachid Iqbal Maulana', '1', 'Cendol', 'Dawett', 4),
('21202500', '5d1b848e69976.png', 'Mohtar Khoiruddin', 'Reynaldi Rio Saputro', '2', 'SIPP gann', 'Iya Silahkannn', 5),
('21202600', '5d1b849d6e36b.png', 'Reyvaldy Alfida', 'Mohammad Aditya', '3', 'IT', 'TELKOM', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pemilih`
--

CREATE TABLE `pemilih` (
  `id_pemilih` varchar(15) NOT NULL,
  `password` varchar(25) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `jenis_kelamin` varchar(15) DEFAULT NULL,
  `votestatus` varchar(11) DEFAULT 'Belum',
  `statusverify` varchar(20) NOT NULL DEFAULT 'Belum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemilih`
--

INSERT INTO `pemilih` (`id_pemilih`, `password`, `nama`, `status`, `jenis_kelamin`, `votestatus`, `statusverify`) VALUES
('12001111333', '123', 'Cahyono', 'Dosen', 'Laki-Laki', 'Belum', 'Belum'),
('12004444989', '123', 'Wita', 'Dosen', 'Perempuan', 'Sudah', 'Terverifikasi'),
('12004445555', '123', 'Cahyo', 'Dosen', 'Laki-Laki', 'Sudah', 'Terverifikasi'),
('17102112', '123', 'Adit', 'Mahasiswa', 'Laki-Laki', 'Sudah', 'Terverifikasi'),
('17102162', '123', 'Aldi', 'Mahasiswa', 'Laki-Laki', 'Sudah', 'Terverifikasi'),
('17102178', '123', 'Janur SP', 'Mahasiswa', 'Laki-Laki', 'Sudah', 'Terverifikasi'),
('17102182', '123', 'Mohtar', 'Mahasiswa', 'Laki-Laki', 'Sudah', 'Terverifikasi'),
('17102184', '123', 'Neomy', 'Mahasiswa', 'Perempuan', 'Sudah', 'Terverifikasi'),
('17102186', '123', 'Reyvaldi', 'Mahasiswa', 'Laki-Laki', 'Sudah', 'Terverifikasi'),
('17102187', '123', 'Rizka', 'Mahasiswa', 'Perempuan', 'Sudah', 'Terverifikasi'),
('17102188', '123', 'Dara', 'Mahasiswa', 'Perempuan', 'Sudah', 'Terverifikasi'),
('17102189', '123', 'Surya', 'Mahasiswa', 'Laki-Laki', 'Sudah', 'Terverifikasi'),
('17102190', '123', 'Thowaf', 'Mahasiswa', 'Laki-Laki', 'Sudah', 'Terverifikasi'),
('17102191', '123', 'Wachid', 'Mahasiswa', 'Laki-Laki', 'Sudah', 'Terverifikasi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `kandidat`
--
ALTER TABLE `kandidat`
  ADD PRIMARY KEY (`id_kandidat`);

--
-- Indexes for table `pemilih`
--
ALTER TABLE `pemilih`
  ADD PRIMARY KEY (`id_pemilih`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
