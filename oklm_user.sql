-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : ven. 15 juil. 2022 à 15:03
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
-- Structure de la table `oklm_user`
--

CREATE TABLE `oklm_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `email` varchar(254) NOT NULL,
  `role` enum('user','editor','admin') NOT NULL DEFAULT 'user',
  `registered_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `activated` tinyint(4) DEFAULT '0',
  `token` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `blocked` tinyint(4) DEFAULT '0',
  `blocked_until` datetime DEFAULT NULL,
  `birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `oklm_user`
--

INSERT INTO `oklm_user` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `role`, `registered_at`, `updated_at`, `activated`, `token`, `gender`, `blocked`, `blocked_until`, `birth`) VALUES
(1, 'admin', '$2a$12$didHxpKpO9N1c7ZGsuk07OkCd7YvSaE8vVQ.jAsOXLOGMDWsTkbbi', 'Admin', 'Istrator', 'yassine.bekioui@gmail.com', 'admin', '2022-02-03 11:27:15', NULL, 1, 'WmoySV0Lu7MpGFDGkO9GicB60bDoC756xWh%2FFEkpngI%3D', 'male', 0, NULL, '1990-02-08');

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
