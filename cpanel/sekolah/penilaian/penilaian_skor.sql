-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 06, 2021 at 06:39 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppdkluang`
--

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_perkara`
--

CREATE TABLE `penilaian_perkara` (
  `ID` int(11) NOT NULL,
  `tajuk` text NOT NULL,
  `data` varchar(20) NOT NULL,
  `radio` int(11) NOT NULL,
  `kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian_perkara`
--

INSERT INTO `penilaian_perkara` (`ID`, `tajuk`, `data`, `radio`, `kategori`) VALUES
(1, 'Keselamatan', 'radio', 5, 1),
(2, 'Kebersihan', 'radio', 2, 1),
(3, 'Catatan', 'text', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_skor`
--

CREATE TABLE `penilaian_skor` (
  `ID` int(11) NOT NULL,
  `kodsekolah` varchar(10) NOT NULL,
  `tajuk_id` int(11) NOT NULL,
  `value` int(11) DEFAULT NULL,
  `catatan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penilaian_perkara`
--
ALTER TABLE `penilaian_perkara`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `penilaian_skor`
--
ALTER TABLE `penilaian_skor`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penilaian_perkara`
--
ALTER TABLE `penilaian_perkara`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penilaian_skor`
--
ALTER TABLE `penilaian_skor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
