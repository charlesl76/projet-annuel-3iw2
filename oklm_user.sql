-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: database
-- Generation Time: Jun 09, 2022 at 08:28 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sported`
--

-- --------------------------------------------------------

--
-- Table structure for table `oklm_user`
--

CREATE TABLE `oklm_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `first_name` varchar(45) CHARACTER SET latin1 NOT NULL,
  `last_name` varchar(60) CHARACTER SET latin1 NOT NULL,
  `email` varchar(254) CHARACTER SET latin1 NOT NULL,
  `role` enum('user','editor','admin') CHARACTER SET latin1 NOT NULL DEFAULT 'user',
  `registered_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `activated` tinyint(4) DEFAULT '0',
  `token` varchar(255) CHARACTER SET latin1 NOT NULL,
  `gender` enum('male','female') CHARACTER SET latin1 NOT NULL,
  `blocked` tinyint(4) DEFAULT '0',
  `blocked_until` datetime DEFAULT NULL,
  `birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `oklm_user`
--

INSERT INTO `oklm_user` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `role`, `registered_at`, `updated_at`, `activated`, `token`, `gender`, `blocked`, `blocked_until`, `birth`) VALUES
(1, 'admin', '$2a$12$cOCyEm3z/dmC6YMOexLd2eHl/g0fLUdN2HHSvM1gr7zzN35.a9c/u', 'Admin', 'Istrator', 'admin@sported.com', 'admin', '2022-02-03 11:27:15', NULL, 1, '', 'male', 0, NULL, '1990-02-08'),
(2, 'test2', 'test2', 'test2-1', 'test2-2', 'test2@test.fr', 'user', '2022-05-24 10:35:26', NULL, 0, '', 'male', 0, NULL, '2022-05-10'),
(3, 'test3', 'test3', 'test3-1', 'test3-2', 'test3@test3.fr', 'user', '2022-05-10 10:35:26', NULL, 0, '', 'female', 0, NULL, '2022-05-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oklm_user`
--
ALTER TABLE `oklm_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `oklm_user`
--
ALTER TABLE `oklm_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
