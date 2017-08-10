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
-- Table structure for table `districts`
--

-- CREATE TABLE `districts` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `region_id` int(10) UNSIGNED NOT NULL,
--   `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Kizito',
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `region_id`, `name`, `user`, `created_at`, `updated_at`) VALUES
(1, 1, 'Meru', 'Kizito', '2017-07-28 13:28:50', NULL),
(2, 1, 'Arusha City', 'Kizito', '2017-07-28 13:28:50', NULL),
(3, 1, 'Arusha', 'Kizito', '2017-07-28 13:28:50', NULL),
(4, 1, 'Karatu', 'Kizito', '2017-07-28 13:28:50', NULL),
(5, 1, 'Longido', 'Kizito', '2017-07-28 13:28:50', NULL),
(6, 1, 'Monduli', 'Kizito', '2017-07-28 13:28:50', NULL),
(7, 1, 'Ngorongoro', 'Kizito', '2017-07-28 13:28:50', NULL),
(9, 2, 'Ilala Municipal', 'Kizito', '2017-07-28 13:28:50', NULL),
(10, 2, 'Kinondoni Municipal', 'Kizito', '2017-07-28 13:28:50', NULL),
(11, 2, 'Temeke Municipal', 'Kizito', '2017-07-28 13:28:50', NULL),
(12, 2, 'Kigamboni Municipal', 'Kizito', '2017-07-28 13:28:50', NULL),
(13, 2, 'Ubungo Municipal', 'Kizito', '2017-07-28 13:28:50', NULL),
(14, 3, 'Bahi', 'Kizito', '2017-07-28 13:28:50', NULL),
(15, 3, 'Chamwino', 'Kizito', '2017-07-28 13:28:50', NULL),
(16, 3, 'Chemba', 'Kizito', '2017-07-28 13:28:50', NULL),
(17, 3, 'Dodoma Municipal', 'Kizito', '2017-07-28 13:28:50', NULL),
(18, 3, 'Kondoa', 'Kizito', '2017-07-28 13:28:50', NULL),
(19, 3, 'Kongwa', 'Kizito', '2017-07-28 13:28:50', NULL),
(20, 3, 'Mpwapwa', 'Kizito', '2017-07-28 13:28:50', NULL),
(21, 3, 'Geita Region', 'Kizito', '2017-07-28 13:28:50', NULL),
(22, 4, 'Bukombe', 'Kizito', '2017-07-28 13:28:50', NULL),
(23, 4, 'Chato', 'Kizito', '2017-07-28 13:28:50', NULL),
(24, 4, 'Geita Town', 'Kizito', '2017-07-28 13:28:50', NULL),
(25, 4, 'Mbogwe', 'Kizito', '2017-07-28 13:28:50', NULL),
(26, 4, 'Nyang\'hwale', 'Kizito', '2017-07-28 13:28:50', NULL),
(28, 5, 'Iringa', 'Kizito', '2017-07-28 13:28:50', NULL),
(29, 5, 'Iringa Municipal', 'Kizito', '2017-07-28 13:28:50', NULL),
(30, 5, 'Kilolo', 'Kizito', '2017-07-28 13:28:50', NULL),
(31, 5, 'Mafinga Town', 'Kizito', '2017-07-28 13:28:50', NULL),
(32, 5, 'Mufindi', 'Kizito', '2017-07-28 13:28:50', NULL),
(33, 6, 'Biharamulo', 'Kizito', '2017-07-28 13:28:50', NULL),
(34, 6, 'Bukoba', 'Kizito', '2017-07-28 13:28:50', NULL),
(35, 6, 'Bukoba Municipal', 'Kizito', '2017-07-28 13:28:50', NULL),
(36, 6, 'Karagwe', 'Kizito', '2017-07-28 13:28:50', NULL),
(37, 6, 'Kyerwa', 'Kizito', '2017-07-28 13:28:50', NULL),
(38, 6, 'Missenyi', 'Kizito', '2017-07-28 13:28:50', NULL),
(39, 6, 'Muleba', 'Kizito', '2017-07-28 13:28:50', NULL),
(40, 6, 'Ngara', 'Kizito', '2017-07-28 13:28:50', NULL),
(41, 7, 'Micheweni', 'Kizito', '2017-07-28 13:28:50', NULL),
(42, 7, 'Wete', 'Kizito', '2017-07-28 13:28:50', NULL),
(43, 8, 'Kaskazini A', 'Kizito', '2017-07-28 13:28:50', NULL),
(44, 8, 'Kaskazini B', 'Kizito', '2017-07-28 13:28:50', NULL),
(45, 9, 'Mlele', 'Kizito', '2017-07-28 13:28:50', NULL),
(46, 9, 'Mpanda', 'Kizito', '2017-07-28 13:28:50', NULL),
(47, 9, 'Mpanda Town', 'Kizito', '2017-07-28 13:28:50', NULL),
(48, 10, 'Buhigwe', 'Kizito', '2017-07-28 13:28:50', NULL),
(49, 10, 'Kakonko', 'Kizito', '2017-07-28 13:28:50', NULL),
(50, 10, 'Kasulu', 'Kizito', '2017-07-28 13:28:50', NULL),
(51, 10, 'Kasulu Town', 'Kizito', '2017-07-28 13:28:50', NULL),
(52, 10, 'Kibondo', 'Kizito', '2017-07-28 13:28:50', NULL),
(53, 10, 'Kigoma', 'Kizito', '2017-07-28 13:28:50', NULL),
(54, 10, 'Kigoma-Ujiji Municipal', 'Kizito', '2017-07-28 13:28:50', NULL),
(55, 10, 'Uvinza', 'Kizito', '2017-07-28 13:28:50', NULL),
(56, 11, 'Hai', 'Kizito', '2017-07-28 13:28:50', NULL),
(57, 11, 'Moshi', 'Kizito', '2017-07-28 13:28:50', NULL),
(58, 11, 'Moshi Municipal Council 184,292', 'Kizito', '2017-07-28 13:28:50', NULL),
(59, 11, 'Mwanga', 'Kizito', '2017-07-28 13:28:50', NULL),
(60, 11, 'Rombo', 'Kizito', '2017-07-28 13:28:50', NULL),
(61, 11, 'Same', 'Kizito', '2017-07-28 13:28:50', NULL),
(62, 11, 'Siha', 'Kizito', '2017-07-28 13:28:50', NULL),
(63, 12, 'Chake Chake', 'Kizito', '2017-07-28 13:28:50', NULL),
(64, 12, 'Mkoani', 'Kizito', '2017-07-28 13:28:50', NULL),
(65, 13, 'Kati', 'Kizito', '2017-07-28 13:28:50', NULL),
(66, 13, 'Kusini', 'Kizito', '2017-07-28 13:28:50', NULL),
(67, 14, 'Kilwa', 'Kizito', '2017-07-28 13:28:50', NULL),
(68, 14, 'Lindi', 'Kizito', '2017-07-28 13:28:50', NULL),
(69, 14, 'Lindi Municipal', 'Kizito', '2017-07-28 13:28:50', NULL),
(70, 14, 'Liwale District', 'Kizito', '2017-07-28 13:28:50', NULL),
(71, 14, 'Nachingwea District', 'Kizito', '2017-07-28 13:28:50', NULL),
(72, 14, 'Ruangwa', 'Kizito', '2017-07-28 13:28:50', NULL),
(73, 15, 'Babati Town', 'Kizito', '2017-07-28 13:28:50', NULL),
(74, 15, 'Babati', 'Kizito', '2017-07-28 13:28:50', NULL),
(75, 15, 'Hanang', 'Kizito', '2017-07-28 13:28:50', NULL),
(76, 15, 'Kiteto', 'Kizito', '2017-07-28 13:28:50', NULL),
(77, 15, 'Mbulu', 'Kizito', '2017-07-28 13:28:50', NULL),
(78, 15, 'Simanjiro', 'Kizito', '2017-07-28 13:28:50', NULL),
(79, 16, 'Bunda', 'Kizito', '2017-07-28 13:28:50', NULL),
(80, 16, 'Butiama', 'Kizito', '2017-07-28 13:28:50', NULL),
(81, 16, 'Musoma', 'Kizito', '2017-07-28 13:28:50', NULL),
(82, 16, 'Musoma Municipal', 'Kizito', '2017-07-28 13:28:50', NULL),
(83, 16, 'Rorya', 'Kizito', '2017-07-28 13:28:50', NULL),
(84, 16, 'Serengeti', 'Kizito', '2017-07-28 13:28:50', NULL),
(85, 16, 'Tarime', 'Kizito', '2017-07-28 13:28:50', NULL),
(86, 17, 'Busokelo', 'Kizito', '2017-07-28 13:28:50', NULL),
(87, 17, 'Chunya', 'Kizito', '2017-07-28 13:28:50', NULL),
(88, 17, 'Kyela', 'Kizito', '2017-07-28 13:28:50', NULL),
(89, 17, 'Mbarali', 'Kizito', '2017-07-28 13:28:50', NULL),
(90, 17, 'Mbeya City', 'Kizito', '2017-07-28 13:28:50', NULL),
(91, 17, 'Mbeya', 'Kizito', '2017-07-28 13:28:50', NULL),
(92, 17, 'Rungwe', 'Kizito', '2017-07-28 13:28:50', NULL),
(93, 18, 'Magharibi', 'Kizito', '2017-07-28 13:28:50', NULL),
(94, 18, 'Mjini', 'Kizito', '2017-07-28 13:28:50', NULL),
(95, 19, 'Gairo District', 'Kizito', '2017-07-28 13:28:50', NULL),
(96, 19, 'Kilombero District', 'Kizito', '2017-07-28 13:28:50', NULL),
(97, 19, 'Kilosa District', 'Kizito', '2017-07-28 13:28:50', NULL),
(98, 19, 'Morogoro District', 'Kizito', '2017-07-28 13:28:50', NULL),
(99, 19, 'Morogoro Municipal', 'Kizito', '2017-07-28 13:28:50', NULL),
(100, 19, 'Mvomero', 'Kizito', '2017-07-28 13:28:50', NULL),
(101, 19, 'Ulanga', 'Kizito', '2017-07-28 13:28:50', NULL),
(102, 20, 'Masasi', 'Kizito', '2017-07-28 13:28:50', NULL),
(103, 20, 'Masasi Town', 'Kizito', '2017-07-28 13:28:50', NULL),
(104, 20, 'Mtwara', 'Kizito', '2017-07-28 13:28:50', NULL),
(105, 20, 'Mtwara Municipal', 'Kizito', '2017-07-28 13:28:50', NULL),
(106, 20, 'Nanyumbu', 'Kizito', '2017-07-28 13:28:50', NULL),
(107, 20, 'Tandahimba', 'Kizito', '2017-07-28 13:28:50', NULL),
(108, 21, 'Ilemela Municipal', 'Kizito', '2017-07-28 13:28:50', NULL),
(109, 21, 'Kwimba', 'Kizito', '2017-07-28 13:28:50', NULL),
(110, 21, 'Magu', 'Kizito', '2017-07-28 13:28:50', NULL),
(111, 21, 'Misungwi', 'Kizito', '2017-07-28 13:28:50', NULL),
(112, 21, 'Nyamagana Municipal', 'Kizito', '2017-07-28 13:28:50', NULL),
(113, 21, 'Sengerema', 'Kizito', '2017-07-28 13:28:50', NULL),
(114, 21, 'Ukerewe', 'Kizito', '2017-07-28 13:28:50', NULL),
(116, 22, 'Ludewa', 'Kizito', '2017-07-28 13:28:50', NULL),
(117, 22, 'Makambako Town', 'Kizito', '2017-07-28 13:28:50', NULL),
(118, 22, 'Makete', 'Kizito', '2017-07-28 13:28:50', NULL),
(119, 22, 'Njombe', 'Kizito', '2017-07-28 13:28:50', NULL),
(120, 22, 'Njombe Town', 'Kizito', '2017-07-28 13:28:50', NULL),
(121, 22, 'Wanging\'ombe', 'Kizito', '2017-07-28 13:28:50', NULL),
(122, 23, 'Bagamoyo', 'Kizito', '2017-07-28 13:28:50', NULL),
(123, 23, 'Kibaha', 'Kizito', '2017-07-28 13:28:50', NULL),
(124, 23, 'Kibaha Town', 'Kizito', '2017-07-28 13:28:50', NULL),
(125, 23, 'Kisarawe', 'Kizito', '2017-07-28 13:28:50', NULL),
(126, 23, 'Mafia', 'Kizito', '2017-07-28 13:28:50', NULL),
(127, 23, 'Mkuranga', 'Kizito', '2017-07-28 13:28:50', NULL),
(128, 23, 'Rufiji', 'Kizito', '2017-07-28 13:28:50', NULL),
(129, 24, 'Kalambo', 'Kizito', '2017-07-28 13:28:50', NULL),
(130, 24, 'Nkasi', 'Kizito', '2017-07-28 13:28:50', NULL),
(131, 24, 'Sumbawanga urban', 'Kizito', '2017-07-28 13:28:50', NULL),
(132, 24, 'Sumbawanga Municipal Council 209,793', 'Kizito', '2017-07-28 13:28:50', NULL),
(133, 25, 'Mbinga', 'Kizito', '2017-07-28 13:28:50', NULL),
(134, 25, 'Songea', 'Kizito', '2017-07-28 13:28:50', NULL),
(135, 25, 'Songea Municipal', 'Kizito', '2017-07-28 13:28:50', NULL),
(136, 25, 'Tunduru', 'Kizito', '2017-07-28 13:28:50', NULL),
(137, 25, 'Namtumbo', 'Kizito', '2017-07-28 13:28:50', NULL),
(138, 25, 'Nyasa', 'Kizito', '2017-07-28 13:28:50', NULL),
(139, 26, 'Kahama Town', 'Kizito', '2017-07-28 13:28:50', NULL),
(140, 26, 'Kahama', 'Kizito', '2017-07-28 13:28:50', NULL),
(141, 26, 'Kishapu', 'Kizito', '2017-07-28 13:28:50', NULL),
(142, 26, 'Shinyanga', 'Kizito', '2017-07-28 13:28:50', NULL),
(143, 26, 'Shinyanga Municipal Council 161,391', 'Kizito', '2017-07-28 13:28:50', NULL),
(144, 27, 'Bariadi', 'Kizito', '2017-07-28 13:28:50', NULL),
(145, 27, 'Busega', 'Kizito', '2017-07-28 13:28:50', NULL),
(146, 27, 'Itilima', 'Kizito', '2017-07-28 13:28:50', NULL),
(147, 27, 'Maswa', 'Kizito', '2017-07-28 13:28:50', NULL),
(148, 27, 'Meatu', 'Kizito', '2017-07-28 13:28:50', NULL),
(149, 28, 'Ikungi', 'Kizito', '2017-07-28 13:28:50', NULL),
(150, 28, 'Iramba', 'Kizito', '2017-07-28 13:28:50', NULL),
(151, 28, 'Manyoni', 'Kizito', '2017-07-28 13:28:50', NULL),
(152, 28, 'Mkalama', 'Kizito', '2017-07-28 13:28:50', NULL),
(153, 28, 'Singida hubanr', 'Kizito', '2017-07-28 13:28:50', NULL),
(154, 28, 'Singida Municipal', 'Kizito', '2017-07-28 13:28:50', NULL),
(155, 29, 'Igunga', 'Kizito', '2017-07-28 13:28:50', NULL),
(156, 29, 'Kaliua', 'Kizito', '2017-07-28 13:28:50', NULL),
(157, 29, 'Nzega', 'Kizito', '2017-07-28 13:28:50', NULL),
(158, 29, 'Sikonge', 'Kizito', '2017-07-28 13:28:50', NULL),
(159, 29, 'Tabora', 'Kizito', '2017-07-28 13:28:50', NULL),
(160, 29, 'Urambo', 'Kizito', '2017-07-28 13:28:50', NULL),
(161, 29, 'Uyui', 'Kizito', '2017-07-28 13:28:50', NULL),
(162, 30, 'Handeni', 'Kizito', '2017-07-28 13:28:50', NULL),
(163, 30, 'Handeni', 'Kizito', '2017-07-28 13:28:50', NULL),
(164, 30, 'Kilindi', 'Kizito', '2017-07-28 13:28:50', NULL),
(165, 30, 'Korogwe', 'Kizito', '2017-07-28 13:28:50', NULL),
(166, 30, 'Korogwe', 'Kizito', '2017-07-28 13:28:50', NULL),
(167, 30, 'Lushoto', 'Kizito', '2017-07-28 13:28:50', NULL),
(168, 30, 'Muheza', 'Kizito', '2017-07-28 13:28:50', NULL),
(169, 30, 'Mkinga', 'Kizito', '2017-07-28 13:28:50', NULL),
(170, 30, 'Pangani', 'Kizito', '2017-07-28 13:28:50', NULL),
(171, 30, 'Tanga', 'Kizito', '2017-07-28 13:28:50', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districts_region_id_foreign` (`region_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
