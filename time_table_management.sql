-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2025 at 08:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `time_table_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `F_ID` int(30) NOT NULL,
  `catagory` varchar(200) NOT NULL,
  `name` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(2000) NOT NULL,
  `short_description` varchar(200) NOT NULL,
  `R_ID` date NOT NULL DEFAULT current_timestamp(),
  `options` varchar(10) NOT NULL DEFAULT 'ENABLE',
  `p_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`F_ID`, `catagory`, `name`, `date`, `description`, `short_description`, `R_ID`, `options`, `p_image`) VALUES
(141, 'event', 'Christmas Program', '2024-12-06', 'Christmas Song', 'Christmas Program', '0000-00-00', '', 'WhatsApp Image 2025-01-21 at 4.21.24 PM.jpeg'),
(144, 'event', 'Christmas program', '2024-12-06', 'Correpondent and Headmaster  Honour our Guest', 'Honour our Guest', '0000-00-00', '', 'christ 2.jpeg'),
(145, 'event', 'Christmas program', '2024-12-06', ' Presented Joyful Dance ', 'Dance', '0000-00-00', '', 'dance 1.jpeg'),
(146, 'event', 'Christmas program', '2024-12-06', ' Welcome and Christmas Speech', 'Speech', '0000-00-00', '', 'christ 3.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`F_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `F_ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
