-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 07, 2022 at 11:21 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloodbank`
--

-- --------------------------------------------------------

--
-- Table structure for table `receivers`
--

CREATE TABLE `receivers` (
  `rid` int(11) NOT NULL,
  `rname_2` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `remail` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rpassward` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rphone` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rbr` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rcity` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `receivers`
--

INSERT INTO `receivers` (`rid`, `rname_2`, `remail`, `rpassward`, `rphone`, `rbr`, `rcity`) VALUES
(1, 'A', 'A@gmail.com', 'A', '0879468465', 'A', 'nu'),
(2, 'B', 'B@gmail.com', 'B', '0987456874', 'B', 'nu'),
(3, 'C', 'C@hotmail.com', 'C', '0946314990', 'O', 'nu'),
(4, 'D', 'D@gmail.com', 'D', '0842054632', 'AB', 'nu');

-- --------------------------------------------------------

--
-- Table structure for table `vaccineinfo`
--

CREATE TABLE `vaccineinfo` (
  `bin` int(11) NOT NULL,
  `hid` int(11) DEFAULT NULL,
  `br` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vaccineinfo`
--

INSERT INTO `vaccineinfo` (`bin`, `hid`, `br`) VALUES
(5, 1, 'A'),
(6, 2, 'B'),
(7, 3, 'O'),
(8, 4, 'AB');

-- --------------------------------------------------------

--
-- Table structure for table `vaccinereqest`
--

CREATE TABLE `vaccinereqest` (
  `reqid` int(11) NOT NULL,
  `warehouseid` int(11) NOT NULL,
  `rid` int(11) DEFAULT NULL,
  `hid` int(11) DEFAULT NULL,
  `br` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_2` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vaccinereqest`
--

INSERT INTO `vaccinereqest` (`reqid`, `warehouseid`, `rid`, `hid`, `br`, `status_2`) VALUES
(5, 1, 2, 1, 'A', '');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `warehouseid` int(11) NOT NULL,
  `bin` int(11) NOT NULL,
  `whname` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `whemail` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `whpassward` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `whphone` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `whcity` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`warehouseid`, `bin`, `whname`, `whemail`, `whpassward`, `whphone`, `whcity`) VALUES
(1, 5, '1', '1', '1', '1', '1'),
(2156, 5, 'E', 'E@gmail.com', '123456', '0842056563', 'nu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `receivers`
--
ALTER TABLE `receivers`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `vaccineinfo`
--
ALTER TABLE `vaccineinfo`
  ADD PRIMARY KEY (`bin`);

--
-- Indexes for table `vaccinereqest`
--
ALTER TABLE `vaccinereqest`
  ADD PRIMARY KEY (`reqid`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`warehouseid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vaccinereqest`
--
ALTER TABLE `vaccinereqest`
  MODIFY `reqid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
