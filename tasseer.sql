-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 30, 2022 at 06:23 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tasseer`
--

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

DROP TABLE IF EXISTS `driver`;
CREATE TABLE IF NOT EXISTS `driver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_arb` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `vehicle_type` varchar(255) NOT NULL,
  `vehicle_number` varchar(255) NOT NULL,
  `vehicle_brand_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `about_you` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `uuid`, `name_en`, `name_arb`, `email`, `phone`, `vehicle_type`, `vehicle_number`, `vehicle_brand_name`, `password`, `about_you`) VALUES
(1, '1667143026-635e95725db8d', 'mayur', 'mayur', 'mayur@test.com', '123456789', '2wheeler', 'MH-21 P-1966', 'Activa', '8622f0f69c91819119a8acf60a248d7b36fdb7ccf857ba8f85cf7f2767ff8265', 'Test'),
(2, '1667143175-635e960715c39', 'trupti', 'trupti', 'trupti@test.com', '1234565432', '2wheeler', 'MH-21 P-1966', 'Activa', 'c001fd08c8524ff609f6eda2b34d0bb7e4c560954fcc15fde8d9b46625bc9158', 'Test'),
(3, '1667143264-635e96600ca29', 'trupti', 'trupti', 'trupti5@test.com', '1234565432', '2wheeler', 'MH-21 P-1966', 'Activa', 'bee1c3c1f9df3df656185eb3db4887afef414f3eb292b252ec858c69986b6022', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name_arb` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `token` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uuid`, `name_en`, `name_arb`, `email`, `phone`, `password`, `token`, `otp`) VALUES
(4, '1667120386-635e3d02b3841', 'mayur', 'mayur', 'mayur@test.com', '123456789', '8622f0f69c91819119a8acf60a248d7b36fdb7ccf857ba8f85cf7f2767ff8265', '1667120386-635e3d02b37a0', ''),
(5, '1667121197-635e402d9d7a0', 'mayur', 'mayur', 'mayur1@test.com', '123456789', '8622f0f69c91819119a8acf60a248d7b36fdb7ccf857ba8f85cf7f2767ff8265', '1667121197-635e402d9d73e', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
