-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2023 at 09:55 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_sabong`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_area` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `meron_position` varchar(50) NOT NULL,
  `wala_position` varchar(50) NOT NULL,
  `liamado_plasada` decimal(10,0) UNSIGNED NOT NULL,
  `dehado_plasada` decimal(10,0) UNSIGNED NOT NULL,
  `total_event_fights` int(50) UNSIGNED NOT NULL,
  `expected_event_fights` int(50) UNSIGNED NOT NULL,
  `event_status` varchar(288) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_area`, `event_date`, `meron_position`, `wala_position`, `liamado_plasada`, `dehado_plasada`, `total_event_fights`, `expected_event_fights`, `event_status`) VALUES
(12, 'bulacan-1', 'San Ildenfonso', '2023-07-01', 'kaliwa', 'kanan', '12', '6', 20, 304, 'Close'),
(13, '2-hits', 'San Ildenfonso', '2023-07-19', 'Kaliwa', 'Kanan', '10', '10', 0, 10, 'Close'),
(14, 'bulacan-1', 'San Ildenfonso', '2023-07-19', 'Kaliwa', 'Kanan', '5', '5', 0, 10, 'Open'),
(17, 'bulacan-1', 'San Ildenfonso', '2025-10-01', 'kaliwa', 'kanan', '8', '9', 0, 304, 'Open');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
