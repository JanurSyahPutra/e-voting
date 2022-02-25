-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2021 at 05:49 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

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
  `id` int(11) NOT NULL,
  `id_kandidat` int(25) NOT NULL,
  `gambar` varchar(2000) NOT NULL,
  `namaketua` varchar(25) DEFAULT NULL,
  `namawakil` varchar(25) DEFAULT NULL,
  `visi` varchar(200) DEFAULT NULL,
  `misi` varchar(200) DEFAULT NULL,
  `jml` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kandidat`
--

INSERT INTO `kandidat` (`id`, `id_kandidat`, `gambar`, `namaketua`, `namawakil`, `visi`, `misi`, `jml`) VALUES
(1, 1, '6072465e25d7a.jpg', 'Joni', 'Jeni', 'Test', 'Test', 3),
(2, 2, '6072467da8e16.jpg', 'Jine', 'Jena', 'Test', 'Test', 3),
(3, 3, '6072488ad0e44.jpg', 'Jene', 'Jini', 'Test', 'Test', 3);

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
('123', '1234567', 'Agi Prasetiadi', 'Dosen', 'Laki-Laki', 'Sudah', 'Terverifikasi'),
('1234', '1234567', 'Auliya Burhanudin', 'Dosen', 'Laki-Laki', 'Sudah', 'Terverifikasi'),
('12345', '1234567', 'Apri Junaidi', 'Dosen', 'Laki-Laki', 'Sudah', 'Terverifikasi'),
('1234567', '1234567', 'Rima Dias Ramadhani', 'Dosen', 'Perempuan', 'Sudah', 'Terverifikasi'),
('17102155', '1234567', 'Khurun', 'Mahasiswa', 'Perempuan', 'Sudah', 'Terverifikasi'),
('17102162', '1234567', 'Reynaldi Rio Saputro', 'Mahasiswa', 'Laki-Laki', 'Sudah', 'Terverifikasi'),
('17102167', '1234567', 'Vidia Syahputri', 'Mahasiswa', 'Laki-Laki', 'Sudah', 'Terverifikasi'),
('17102178', '1234567', 'Janur Syahputra', 'Mahasiswa', 'Laki-Laki', 'Sudah', 'Terverifikasi'),
('2131', '123123', 'wqeqwe', 'Pilih Status...', 'Pilih Jenis Kel', 'Belum', 'Belum'),
('321', '1234567', 'Nur Elsa Saputri', 'Mahasiswa', 'Perempuan', 'Sudah', 'Terverifikasi');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT 'Tutup'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'Buka');

-- --------------------------------------------------------

--
-- Table structure for table `waktu`
--

CREATE TABLE `waktu` (
  `id` int(11) NOT NULL,
  `mulai` date DEFAULT NULL,
  `selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waktu`
--

INSERT INTO `waktu` (`id`, `mulai`, `selesai`) VALUES
(2, '2021-04-11', '2021-04-12');

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemilih`
--
ALTER TABLE `pemilih`
  ADD PRIMARY KEY (`id_pemilih`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waktu`
--
ALTER TABLE `waktu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kandidat`
--
ALTER TABLE `kandidat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `waktu`
--
ALTER TABLE `waktu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
