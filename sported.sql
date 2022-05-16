-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : ven. 04 fév. 2022 à 14:04
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.20

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
-- Structure de la table `oklm_user`
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
-- Déchargement des données de la table `oklm_user`
--

INSERT INTO `oklm_user` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `role`, `registered_at`, `updated_at`, `activated`, `token`, `gender`, `blocked`, `blocked_until`, `birth`) VALUES
(1, 'admin', '$2a$12$cOCyEm3z/dmC6YMOexLd2eHl/g0fLUdN2HHSvM1gr7zzN35.a9c/u', 'Admin', 'Istrator', 'admin@sported.com', 'admin', '2022-02-03 11:27:15', NULL, 1, '', 'male', 0, NULL, '1990-02-08');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `oklm_user`
--
ALTER TABLE `oklm_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `oklm_user`
--
ALTER TABLE `oklm_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
