-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 08, 2026 at 10:40 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pwd2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_biodata_mahasiswa`
--

CREATE TABLE `tbl_biodata_mahasiswa` (
  `cid` int(11) NOT NULL,
  `cnim` int(20) NOT NULL,
  `cnama_lengkap` varchar(100) NOT NULL,
  `ctempat_lahir` varchar(50) NOT NULL,
  `ctanggal_lahir` date NOT NULL,
  `chobi` varchar(100) DEFAULT NULL,
  `cpasangan` varchar(100) DEFAULT NULL,
  `cpekerjaan` varchar(50) DEFAULT NULL,
  `cnama_orang_tua` varchar(100) DEFAULT NULL,
  `cnama_kakak` varchar(100) DEFAULT NULL,
  `cnama_adik` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_biodata_mahasiswa`
--

INSERT INTO `tbl_biodata_mahasiswa` (`cid`, `cnim`, `cnama_lengkap`, `ctempat_lahir`, `ctanggal_lahir`, `chobi`, `cpasangan`, `cpekerjaan`, `cnama_orang_tua`, `cnama_kakak`, `cnama_adik`) VALUES
(1, 252170020, 'James', 'Inggris', '2000-01-03', 'Tennis', '', 'Wiraswasta', 'Bun', 'Ben', 'Bin'),
(6, 1234567, 'Diana roz', 'Kanda', '2026-01-09', 'Traveling', '-', 'Software engineer', 'Roz', '-', '-'),
(7, 1237978, 'Lora Laurenz', 'Paris', '2026-01-16', 'Main Game', 'Ada', 'Pengacara', 'Laurenz', 'Kenzo', '-'),
(11, 2967420, 'Maudy', 'Surabaya', '2002-05-15', 'Renang', '-', 'Dokter', 'Mina', '-', '-'),
(12, 57922841, 'Sifa', 'Belitung', '1998-02-26', 'Makan', 'Ada', 'Gamer', 'Sufa', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tamu`
--

CREATE TABLE `tbl_tamu` (
  `cid` int(11) NOT NULL,
  `cnama` varchar(100) DEFAULT NULL,
  `cemail` varchar(100) DEFAULT NULL,
  `cpesan` text,
  `dcreated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tamu`
--

INSERT INTO `tbl_tamu` (`cid`, `cnama`, `cemail`, `cpesan`, `dcreated_at`) VALUES
(1, 'Yohanes Setiawan Japriadi', 'ysetiawanj@atmaluhur.ac.id', 'Ayo yang teliti belajar pemrograman web dasarnya, jangan membiasakan typo', '2025-12-16 11:00:25'),
(2, 'Gracella Edrea Japriadi', 'cellajapriadi@gmail.com', 'ayo kakak-kakak yang semangat belajarnya', '2025-12-16 11:00:25'),
(3, 'Wulan Dari Belinyu', 'wulanbly@gmail.com', 'aku pasti menang', '2025-12-16 11:00:25'),
(4, 'Melvyn Hadi Santo M.Kom.', 'hadi.melvyn@gmail.com', 'Maju tak gentar membela yang benar, pendaftaran selalu di awal, tetapi penyesalan selalu di akhir', '2025-12-16 11:00:25'),
(5, 'Nabila Saskia Gotik', 'nabila@gotik.com', 'Adit rambut bagus banget, dikuncir lagi', '2025-12-16 11:00:25'),
(7, 'Junaidi Hadiwijaya', 'juned@gmail.com', 'Saya mau jadi dosen di atma luhur', '2025-12-16 11:00:25'),
(8, 'Nurfadilah', 'nur@cantil.ocm', 'Nur kadang-kadang berdansa', '2025-12-16 11:00:25'),
(9, 'Adit Ganteng Banget', 'adit@goku.com', 'Adit mirip son goku sebelum gunting rambut', '2025-12-16 11:00:25'),
(11, 'Cat don', 'catdiony@gmail.com', 'diony hari ini tampak bersinar teramg', '2025-12-16 11:00:25'),
(12, 'Fransiska Meily Lolowang', 'meilylolowang@gmail.com', 'Selamat natal dan tahun baru', '2025-12-16 11:00:25'),
(13, 'Ari Amir Alkodri (AAA)', 'aaabat@gmail.com', 'apakah berhasil coba timestamp hore', '2025-12-16 11:00:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_biodata_mahasiswa`
--
ALTER TABLE `tbl_biodata_mahasiswa`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_tamu`
--
ALTER TABLE `tbl_tamu`
  ADD PRIMARY KEY (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_biodata_mahasiswa`
--
ALTER TABLE `tbl_biodata_mahasiswa`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_tamu`
--
ALTER TABLE `tbl_tamu`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
