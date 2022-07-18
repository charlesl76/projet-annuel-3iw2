-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : ven. 15 juil. 2022 à 15:02
-- Version du serveur : 5.7.38
-- Version de PHP : 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sported`
--

-- --------------------------------------------------------

--
-- Structure de la table `oklm_icon`
--

CREATE TABLE `oklm_icon` (
  `id` int(11) NOT NULL COMMENT 'Icon ID',
  `collection` varchar(50) NOT NULL COMMENT 'Collection name as referenced on subfolder icon',
  `name` varchar(50) NOT NULL COMMENT 'Name as referenced in folder',
  `type` enum('PNG','SVG') NOT NULL COMMENT 'Image type, are allowed SVG PNG only'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `oklm_icon`
--

INSERT INTO `oklm_icon` (`id`, `collection`, `name`, `type`) VALUES
(1, 'olympic-sports', 'archery', 'SVG'),
(2, 'olympic-sports', 'artistic_gymnastics', 'SVG'),
(3, 'olympic-sports', 'athletics', 'SVG'),
(4, 'olympic-sports', 'badminton', 'SVG'),
(5, 'olympic-sports', 'basketball', 'SVG'),
(6, 'olympic-sports', 'beach_volleyball', 'SVG'),
(7, 'olympic-sports', 'boxing', 'SVG'),
(8, 'olympic-sports', 'canoe_slalom', 'SVG'),
(9, 'olympic-sports', 'canoe_sprint', 'SVG'),
(10, 'olympic-sports', 'cycling_bmx', 'SVG'),
(11, 'olympic-sports', 'cycling_mountain_bike', 'SVG'),
(12, 'olympic-sports', 'cycling_road', 'SVG'),
(13, 'olympic-sports', 'cycling_track', 'SVG'),
(14, 'olympic-sports', 'diving', 'SVG'),
(15, 'olympic-sports', 'equestrian', 'SVG'),
(16, 'olympic-sports', 'fencing', 'SVG'),
(17, 'olympic-sports', 'football', 'SVG'),
(18, 'olympic-sports', 'golf', 'SVG'),
(19, 'olympic-sports', 'handball', 'SVG'),
(20, 'olympic-sports', 'hockey', 'SVG'),
(21, 'olympic-sports', 'judo', 'SVG'),
(22, 'olympic-sports', 'marathon_swimming', 'SVG'),
(23, 'olympic-sports', 'modern_pentathlon', 'SVG'),
(24, 'olympic-sports', 'olympic_medal_bronze', 'SVG'),
(25, 'olympic-sports', 'olympic_medal_gold', 'SVG'),
(26, 'olympic-sports', 'olympic_medal_silver', 'SVG'),
(27, 'olympic-sports', 'olympic_torch', 'SVG'),
(28, 'olympic-sports', 'rhythmic_gymnastics', 'SVG'),
(29, 'olympic-sports', 'rowing', 'SVG'),
(30, 'olympic-sports', 'rugby_sevens', 'SVG'),
(31, 'olympic-sports', 'sailing', 'SVG'),
(32, 'olympic-sports', 'shooting', 'SVG'),
(33, 'olympic-sports', 'swimming', 'SVG'),
(34, 'olympic-sports', 'synchronised_swimming', 'SVG'),
(35, 'olympic-sports', 'table_tennis', 'SVG'),
(36, 'olympic-sports', 'taekwondo', 'SVG'),
(37, 'olympic-sports', 'tennis', 'SVG'),
(38, 'olympic-sports', 'trampoline_gymnastics', 'SVG'),
(39, 'olympic-sports', 'triathlon', 'SVG'),
(40, 'olympic-sports', 'trophy', 'SVG'),
(41, 'olympic-sports', 'volleyball', 'SVG'),
(42, 'olympic-sports', 'water_polo', 'SVG'),
(43, 'olympic-sports', 'weightlifting', 'SVG'),
(44, 'olympic-sports', 'wrestling', 'SVG');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `oklm_icon`
--
ALTER TABLE `oklm_icon`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `oklm_icon`
--
ALTER TABLE `oklm_icon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Icon ID', AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
