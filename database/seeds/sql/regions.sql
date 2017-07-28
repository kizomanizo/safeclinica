-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2017 at 03:29 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safefocus`
--

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

-- CREATE TABLE `regions` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Kizito',
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `user`, `created_at`, `updated_at`) VALUES
(1, 'Arusha', 'Kizito', '2017-07-28 13:28:50', NULL),
(2, 'Dar es Salaam', 'Kizito', '2017-07-28 13:28:50', NULL),
(3, 'Dodoma', 'Kizito', '2017-07-28 13:28:50', NULL),
(4, 'Geita', 'Kizito', '2017-07-28 13:28:50', NULL),
(5, 'Iringa', 'Kizito', '2017-07-28 13:28:50', NULL),
(6, 'Kagera', 'Kizito', '2017-07-28 13:28:50', NULL),
(7, 'Kaskazini Pemba- Zanzibar', 'Kizito', '2017-07-28 13:28:50', NULL),
(8, 'Kaskazini Unguja- Zanzibar', 'Kizito', '2017-07-28 13:28:50', NULL),
(9, 'Katavi', 'Kizito', '2017-07-28 13:28:50', NULL),
(10, 'Kigoma', 'Kizito', '2017-07-28 13:28:50', NULL),
(11, 'Kilimanjaro', 'Kizito', '2017-07-28 13:28:50', NULL),
(12, 'Kusini Pemba-Zanzibar', 'Kizito', '2017-07-28 13:28:50', NULL),
(13, 'Kusini Unguja-Zanzibar', 'Kizito', '2017-07-28 13:28:50', NULL),
(14, 'Lindi', 'Kizito', '2017-07-28 13:28:50', NULL),
(15, 'Manyara', 'Kizito', '2017-07-28 13:28:50', NULL),
(16, 'Mara', 'Kizito', '2017-07-28 13:28:50', NULL),
(17, 'Mbeya', 'Kizito', '2017-07-28 13:28:50', NULL),
(18, 'Mjini Magharibi-Zanzibar', 'Kizito', '2017-07-28 13:28:50', NULL),
(19, 'Morogoro', 'Kizito', '2017-07-28 13:28:50', NULL),
(20, 'Mtwara', 'Kizito', '2017-07-28 13:28:50', NULL),
(21, 'Mwanza', 'Kizito', '2017-07-28 13:28:50', NULL),
(22, 'Njombe', 'Kizito', '2017-07-28 13:28:50', NULL),
(23, 'Pwani', 'Kizito', '2017-07-28 13:28:50', NULL),
(24, 'Rukwa', 'Kizito', '2017-07-28 13:28:50', NULL),
(25, 'Ruvuma', 'Kizito', '2017-07-28 13:28:50', NULL),
(26, 'Shinyanga', 'Kizito', '2017-07-28 13:28:50', NULL),
(27, 'Simiyu', 'Kizito', '2017-07-28 13:28:50', NULL),
(28, 'Singida', 'Kizito', '2017-07-28 13:28:50', NULL),
(29, 'Tabora', 'Kizito', '2017-07-28 13:28:50', NULL),
(30, 'Tanga', 'Kizito', '2017-07-28 13:28:50', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
