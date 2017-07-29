SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+03:00";

INSERT INTO `districts` (`id`, `region_id`, `name`, `user`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bagamoyo', 'Kizito', '2017-07-28 13:28:50', NULL),
(2, 1, 'Kibaha', 'Kizito', '2017-07-28 13:28:50', NULL),
(3, 1, 'Kibaha Town', 'Kizito', '2017-07-28 13:28:50', NULL),
(4, 1, 'Kisarawe', 'Kizito', '2017-07-28 13:28:50', NULL),
(5, 1, 'Mafia', 'Kizito', '2017-07-28 13:28:50', NULL),
(6, 1, 'Mkuranga', 'Kizito', '2017-07-28 13:28:50', NULL),
(7, 1, 'Rufiji', 'Kizito', '2017-07-28 13:28:50', NULL);
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
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
