-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2021 at 07:30 AM
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
-- Database: `stf`
--

-- --------------------------------------------------------

--
-- Table structure for table `coffee`
--

CREATE TABLE `coffee` (
  `id` int(10) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coffee`
--

INSERT INTO `coffee` (`id`, `name`, `price`, `image`) VALUES
(1, 'Latte T1', 50, 'coffee1.png'),
(2, 'Latte T2', 60, 'coffee1.png'),
(3, 'Latte T3', 70, 'coffee1.png'),
(4, 'Latte T4', 80, 'coffee1.png'),
(5, 'Latte T5', 90, 'coffee1.png'),
(6, 'Latte T6', 100, 'coffee1.png'),
(7, 'Latte T7', 110, 'coffee1.png'),
(8, 'Latte T8', 120, 'coffee1.png');

-- --------------------------------------------------------

--
-- Table structure for table `mhorder`
--

CREATE TABLE `mhorder` (
  `id` int(10) NOT NULL,
  `invoice` int(50) NOT NULL,
  `user` varchar(100) NOT NULL,
  `item_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `total` int(10) NOT NULL,
  `paymentId` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mhorder`
--

INSERT INTO `mhorder` (`id`, `invoice`, `user`, `item_id`, `quantity`, `total`, `paymentId`) VALUES
(60, 42908, 'mehedi@mail.com', 2, 1, 130, ''),
(61, 42908, 'mehedi@mail.com', 3, 1, 130, ''),
(62, 36866, 'mehedi@mail.com', 2, 1, 130, 'SSLCZ_TEST_60c708bdc3ed9'),
(63, 36866, 'mehedi@mail.com', 3, 1, 130, 'SSLCZ_TEST_60c708bdc3ed9'),
(64, 8149, 'mehedi@mail.com', 2, 1, 370, ''),
(65, 8149, 'mehedi@mail.com', 3, 1, 370, ''),
(66, 8149, 'mehedi@mail.com', 8, 2, 370, ''),
(67, 95525, 'mehedi@mail.com', 2, 1, 130, 'SSLCZ_TEST_60c7980a1ef2b'),
(68, 95525, 'mehedi@mail.com', 3, 1, 130, 'SSLCZ_TEST_60c7980a1ef2b'),
(69, 25603, 'mehedi@mail.com', 2, 2, 260, 'SSLCZ_TEST_60c798322c028'),
(70, 25603, 'mehedi@mail.com', 3, 2, 260, 'SSLCZ_TEST_60c798322c028'),
(71, 87517, 'mehedi@mail.com', 2, 2, 120, 'SSLCZ_TEST_60c798541007b'),
(72, 80464, 'mehedi@mail.com', 2, 2, 330, 'SSLCZ_TEST_60c7986c55b56'),
(73, 80464, 'mehedi@mail.com', 7, 1, 330, 'SSLCZ_TEST_60c7986c55b56'),
(74, 80464, 'mehedi@mail.com', 6, 1, 330, 'SSLCZ_TEST_60c7986c55b56'),
(75, 60377, 'mehedi@mail.com', 2, 1, 110, 'SSLCZ_TEST_60c79c19a9406'),
(76, 60377, 'mehedi@mail.com', 1, 1, 110, 'SSLCZ_TEST_60c79c19a9406'),
(77, 64330, 'mehedi@mail.com', 2, 1, 110, 'SSLCZ_TEST_60c79c299bf0c'),
(78, 64330, 'mehedi@mail.com', 1, 1, 110, 'SSLCZ_TEST_60c79c299bf0c');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(50) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `pass`) VALUES
('mehedi@mail.com', '123456'),
('mhhasan@gmail.com', 'asdf12'),
('mhhasan@mail.com', 'qwe123'),
('rakib@mail.com', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coffee`
--
ALTER TABLE `coffee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mhorder`
--
ALTER TABLE `mhorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coffee`
--
ALTER TABLE `coffee`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mhorder`
--
ALTER TABLE `mhorder`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
