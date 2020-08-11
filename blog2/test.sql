-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 11, 2019 at 03:20 AM
-- Server version: 5.6.37
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(200) CHARACTER SET utf8 NOT NULL,
  `AGE` int(100) NOT NULL,
  `PHONE` int(14) NOT NULL,
  `STREET` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`ID`, `NAME`, `AGE`, `PHONE`, `STREET`) VALUES
(1, 'Vũ Huỳnh Minh', 17, 1238912491, 'Biên Hòa - Tam Hiệp'),
(2, 'Nguyễn Ngô Thế Phong', 17, 914912491, 'Biên Hòa'),
(4, 'Nguyễn Văn A', 17, 211325546, 'Trảng Dài'),
(9, 'Nguyễn Văn D', 16, 1865224910, 'Tam Hòa 2');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(200) CHARACTER SET utf8 NOT NULL,
  `IMAGE` text CHARACTER SET utf8 NOT NULL,
  `PRICE` decimal(11,0) NOT NULL DEFAULT '0',
  `UNIT` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'đ'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `NAME`, `IMAGE`, `PRICE`, `UNIT`) VALUES
(1, 'IPHONE X', 'https://www.melkco.com/wp-content/uploads/2018/09/melkco-air-superlim-tpu-case-for-apple-iphone-x-transparent-grey-1.jpg', '25000000', 'đ'),
(2, 'IPHONE 6', 'https://m.xcite.com/media/catalog/product/cache/1/thumbnail/550x400/9df78eab33525d08d6e5fb8d27136e95/5/1/511216_apple_iphone_6_32gb_phone_-_gold_2_result.jpg', '500000', 'đ'),
(3, 'SAMSUM GALAXY S6', 'https://www.bhphotovideo.com/images/images1000x1000/samsung_g925i_32gb_green_galaxy_s6_edge_g925i_1140484.jpg', '600000', 'đ'),
(4, 'OPPO F1S', 'https://images-na.ssl-images-amazon.com/images/I/61-BmjNwoTL._SX522_.jpg', '1000000', 'đ'),
(5, 'NOKIA 6', 'https://technews.bg/wp-content/uploads/2017/01/nokia_6.jpg', '20000', 'đ'),
(6, 'SONY XPERIAL', 'https://avatars.mds.yandex.net/get-mpic/200316/img_id6353121475849243944/9hq', '800000', 'đ'),
(7, 'OPPO F9', 'https://i0.wp.com/alaneesqatar.qa/wp-content/uploads/2018/09/anees-min-4.png?resize=570%2C706&ssl=1', '25000000', 'đ'),
(8, 'IPHONE 8', 'https://www.cabreet.com/wp-content/uploads/2017/09/iphone8-gold.jpg', '25000000', 'đ'),
(9, 'IPHONE 3', 'https://images-na.ssl-images-amazon.com/images/I/41j-X%2BcTscL.jpg', '2500000', 'đ'),
(10, 'SAMSUNG GALAXY S7', 'https://images-na.ssl-images-amazon.com/images/I/41XZDWyb3dL.jpg', '10000000', 'đ'),
(11, 'BPHONE 3 PRO', 'https://cdn.tgdd.vn/Products/Images/42/193528/bphone-3-pro-15-600x600.jpg', '20000000', 'đ'),
(12, 'OPPO J7', 'http://i1.topgia.vn/nch/images/2016/9/26/so-sanh-oppo-neo-9-voi-samsung-j7-may-nao-choi-game-tot-hon-3.jpg', '20000000', 'đ');

-- --------------------------------------------------------

--
-- Table structure for table `upload_image`
--

CREATE TABLE IF NOT EXISTS `upload_image` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(200) CHARACTER SET utf8 NOT NULL,
  `IMAGE` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upload_image`
--

INSERT INTO `upload_image` (`ID`, `NAME`, `IMAGE`) VALUES
(1, '', './upload/girl.jpg'),
(2, '', './upload/girl.png'),
(3, '', './upload/top-anh-comment-facebook-1.jpg'),
(4, '', './upload/top-anh-comment-facebook-2.jpg'),
(5, '', './upload/top-anh-comment-facebook-5.jpg'),
(6, '', './upload/top-anh-comment-facebook-6.jpg'),
(7, '', './upload/1 - i0candP.jpg'),
(8, '', './upload/34163507_453626175084357_8738231630818181120_o.jpg'),
(9, '', './upload/FB APPOLON.png'),
(10, '', './upload/Taive.vip-Hinh-nen-lien-minh-1.png'),
(11, '', './upload/Taive.vip-Hinh-nen-lien-minh-2.jpg'),
(12, '', './upload/Taive.vip-Hinh-nen-lien-minh-4.png'),
(13, '', './upload/Taive.vip-Hinh-nen-lien-minh-5.png'),
(14, '', './upload/Taive.vip-Hinh-nen-lien-minh-1.png'),
(15, '', './upload/Taive.vip-Hinh-nen-lien-minh-2.jpg'),
(16, '', './upload/Taive.vip-Hinh-nen-lien-minh-4.png'),
(17, '', './upload/Taive.vip-Hinh-nen-lien-minh-5.png'),
(18, '', './upload/Taive.vip-Hinh-nen-lien-minh-1.png'),
(19, '', './upload/Taive.vip-Hinh-nen-lien-minh-2.jpg'),
(20, '', './upload/Taive.vip-Hinh-nen-lien-minh-4.png'),
(21, '', './upload/Taive.vip-Hinh-nen-lien-minh-5.png'),
(22, '', './upload/_mg_0187_27252208532_o.jpg'),
(23, '', './upload/_mg_0236_27074627230_o.jpg'),
(24, '', './upload/_mg_0832_26654552590_o.jpg'),
(25, '', './upload/_mg_0833_26299320703_o.jpg'),
(26, '', './upload/anonymous-1447907195159.jpg'),
(27, '', './upload/hack-813290_1280.jpg'),
(28, '', './upload/hacked.png'),
(29, '', './upload/hinh-nen-desktop-chu-de-cong-nghe-thong-tin-blogchiasekienthuc.com (4).jpg'),
(30, '', './upload/hinh-nen-desktop-chu-de-cong-nghe-thong-tin-blogchiasekienthuc.com (5).jpg'),
(31, '', './upload/Tải hình ảnh nền Hacker đẹp nhất full HD5.jpg'),
(32, '', './upload/Tải hình ảnh nền Hacker đẹp nhất full HD19.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `upload_image`
--
ALTER TABLE `upload_image`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `upload_image`
--
ALTER TABLE `upload_image`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
