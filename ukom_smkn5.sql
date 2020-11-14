-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 14, 2020 at 12:45 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukom_smkn5`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nama_guru` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `nama_mapel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama_guru`, `alamat`, `nama_mapel`) VALUES
(1, 'Indah Anggraini', 'Jln. Melati', 'PKN'),
(4, 'Yuyus Purnama', 'Jln. Melati', 'Basis Data');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `indonesia` int(11) NOT NULL,
  `inggris` int(11) NOT NULL,
  `mtk` int(11) NOT NULL,
  `kejuruan` int(11) NOT NULL,
  `rata_rata` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `nis`, `indonesia`, `inggris`, `mtk`, `kejuruan`, `rata_rata`) VALUES
(1, 127001, 96, 89, 80, 94, 90),
(4, 1830091, 60, 67, 62, 61, 63);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `nama_siswa` varchar(25) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jurusan` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `username`, `nama_siswa`, `jk`, `tempat_lahir`, `tanggal_lahir`, `jurusan`, `alamat`, `email`, `hp`) VALUES
(127001, 'Zami', 'Zamzam Saputra', 'L', 'Bekasi', '2003-01-31', 'RPL', 'Jln. KH Muchtar Tabrani', 'zamsyh.work@gmail.com', '08199298911'),
(1830091, 'Ardii', 'Ardiansyah', 'L', 'Bekasi', '2020-11-20', 'TEI', 'Jln. Melati', 'ardi@gmail.com', '0890109021');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `level`) VALUES
(1, 'admin', '$2y$10$1VXgF6mEA63aXnLBXMLq.e/HKvlfb1XW7fn9aaIfqm/z/e6V6zQHO', 'Admin', 'admin'),
(2, 'zami', '$2y$10$31MeiQV2xAmznxLJ6gdKpetDd481JlEUeCRxfktKiBC6r/GiwYQfK', 'Zamzam', 'siswa'),
(3, 'zamzam', '$2y$10$9px6DiHgsiNSS6pM1Pt/EeeP0JtiEMlgE6e3M9wZgdmrx61m8h0na', 'Zamzam Saputra', 'siswa'),
(4, 'ardi', '$2y$10$zHBBC5QRIqRxVOC5TDq/9uhugmS6UwKQtbMmkckpo1TSCe9Rza5m6', 'Ardiansyah', 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis_id` (`nis`),
  ADD KEY `id_siswa` (`nis`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
