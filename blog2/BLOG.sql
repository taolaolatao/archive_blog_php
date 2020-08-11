-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 06, 2019 at 05:15 PM
-- Server version: 5.6.37
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BLOG`
--

-- --------------------------------------------------------

--
-- Table structure for table `IMAGES`
--

CREATE TABLE IF NOT EXISTS `IMAGES` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(200) NOT NULL,
  `LINK` text NOT NULL,
  `ORDER` int(11) NOT NULL,
  `STATUS` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `IMAGES`
--

INSERT INTO `IMAGES` (`ID`, `TITLE`, `LINK`, `ORDER`, `STATUS`) VALUES
(1, 'Taolaolataom', 'https://www.mobafire.com/images/champion/skins/landscape/riven-pulsefire.jpg', 2, 1),
(2, 'Hot Girl 1', 'http://vhmblog2.com/uploads/sn2.png', 2, 1),
(9, 'Hot Girl 2', 'http://vhmblog2.com/uploads/sn1.png', 3, 1),
(11, 'Hot Girl 4', 'http://vhmblog2.com/uploads/36704643_241784793219699_7572767069360357376_n.jpg', 5, 1),
(12, 'Hot Girl 3', 'http://vhmblog2.com/uploads/38917953_2231967313697733_4123465562493812736_n.jpg', 4, 1),
(13, 'Hot Girl 5', 'https://lienminh.garena.vn/images/champions/skin/64_LeeSin/1.jpg', 5, 1),
(14, 'Hot Girl 6', 'http://vhmblog2.com/uploads/16649283_1679191452381408_8873043273259781587_n.jpg', 6, 1),
(15, 'Hot Girl 7', 'http://vhmblog2.com/uploads/16998822_623398341202033_362434331503793315_n.jpg', 7, 0),
(16, 'Hot Girl 8', 'http://vhmblog2.com/uploads/16797508_946578085472784_4778101336287770519_o.jpg', 8, 1),
(18, 'Hot Girl 9', 'http://vhmblog2.com/uploads/ca2c3f2e9e.jpg', 9, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `IMAGES`
--
ALTER TABLE `IMAGES`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `IMAGES`
--
ALTER TABLE `IMAGES`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
