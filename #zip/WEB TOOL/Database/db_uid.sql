-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2019 at 12:57 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_uid`
--
CREATE DATABASE IF NOT EXISTS `db_uid` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_uid`;

-- --------------------------------------------------------

--
-- Table structure for table `tb_absen`
--

CREATE TABLE IF NOT EXISTS `tb_absen` (
  `id` varchar(50) NOT NULL,
  `masuk` varchar(15) NOT NULL,
  `keluar` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `Keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_id`
--

CREATE TABLE IF NOT EXISTS `tb_id` (
  `id` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `notifikasi` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE IF NOT EXISTS `tb_pengguna` (
  `no` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(22) NOT NULL,
  `password` varchar(22) NOT NULL,
  `level` int(1) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`no`, `username`, `password`, `level`) VALUES
(2, 'dio', '123', 0),
(6, 'admin', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rfid`
--

CREATE TABLE IF NOT EXISTS `tb_rfid` (
  `id` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_settings`
--

CREATE TABLE IF NOT EXISTS `tb_settings` (
  `masuk_mulai` time NOT NULL,
  `masuk_akhir` time NOT NULL,
  `keluar_mulai` time NOT NULL,
  `keluar_akhir` time NOT NULL,
  `libur1` varchar(10) NOT NULL,
  `libur2` varchar(10) NOT NULL,
  `timezone` varchar(22) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwdemail` varchar(50) NOT NULL,
  `admin_uid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_settings`
--

INSERT INTO `tb_settings` (`masuk_mulai`, `masuk_akhir`, `keluar_mulai`, `keluar_akhir`, `libur1`, `libur2`, `timezone`, `email`, `pwdemail`, `admin_uid`) VALUES
('00:00:00', '08:15:00', '16:00:00', '20:30:00', 'Sabtu', 'Minggu', 'Asia/Jakarta', 'emailpresensi@gmail.com', 'dtproduction', '1749B411');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
