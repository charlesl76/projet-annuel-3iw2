-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : jeu. 21 juil. 2022 à 18:33
-- Version du serveur : 5.7.37
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
-- Structure de la table `oklm_session`
--

CREATE TABLE `oklm_session` (
  `id` int(10) NOT NULL,
  `token` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expiration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `oklm_session`
--

INSERT INTO `oklm_session` (`id`, `token`, `user_id`, `expiration_date`) VALUES
(28, '3598345567a146bb69bc224d8060061ca7663482e3149b68ceb87adad1a9a6c0', 36, '2022-08-05 16:48:52'),
(29, '0634f40469f95b9c541206abde482333b9f8855361023d4703899286b89549fb', 36, '2022-08-05 18:01:55');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `oklm_session`
--
ALTER TABLE `oklm_session`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `oklm_session`
--
ALTER TABLE `oklm_session`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
