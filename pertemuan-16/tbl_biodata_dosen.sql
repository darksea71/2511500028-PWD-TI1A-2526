-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 28, 2026 at 05:05 AM
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
-- Table structure for table `tbl_biodata_dosen`
--

CREATE TABLE `tbl_biodata_dosen` (
  `ckode_dosen` varchar(10) NOT NULL,
  `cnama_dosen` varchar(100) NOT NULL,
  `calamat_rumah` text NOT NULL,
  `ctanggal_jadi_dosen` date NOT NULL,
  `cjja_dosen` varchar(50) NOT NULL,
  `chomebase_prodi` varchar(100) NOT NULL,
  `cnomor_hp` varchar(15) NOT NULL,
  `cnama_pasangan` varchar(100) DEFAULT NULL,
  `cnama_anak` varchar(100) DEFAULT NULL,
  `cbidang_ilmu_dosen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_biodata_dosen`
--

INSERT INTO `tbl_biodata_dosen` (`ckode_dosen`, `cnama_dosen`, `calamat_rumah`, `ctanggal_jadi_dosen`, `cjja_dosen`, `chomebase_prodi`, `cnomor_hp`, `cnama_pasangan`, `cnama_anak`, `cbidang_ilmu_dosen`) VALUES
('12111', 'dfaffafa', 'pangkalpinang', '2026-01-09', '2020', 'Teknik', 'sasasa', 'ada', '', 'teknik informatika');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_biodata_dosen`
--
ALTER TABLE `tbl_biodata_dosen`
  ADD PRIMARY KEY (`ckode_dosen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
