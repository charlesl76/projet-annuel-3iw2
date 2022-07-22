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
  `gender` enum('male','female') CHARACTER SET latin1 DEFAULT NULL,
  `blocked` tinyint(4) DEFAULT '0',
  `blocked_until` datetime DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `oklm_user`
--

INSERT INTO `oklm_user` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `role`, `registered_at`, `updated_at`, `activated`, `gender`, `blocked`, `blocked_until`, `birth`, `token`) VALUES
(1, 'admin', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'Admin', 'Istrator', 'admin@sported.com', 'admin', '2022-02-03 11:27:15', NULL, 1, 'male', 0, NULL, '1990-02-08', ''),
(3, 'charles2', 'test3', 'Charles', 'Lefebvre', 'test3@test3.fr', 'admin', '2022-05-10 10:35:26', NULL, 0, 'female', 0, NULL, '2022-05-03', ''),
(36, 'charles', '17c1fcd006f4c15649c1bec040496723a2e7d1c8758df435d084fbb2ea9ce940c86e2c368b7f9113e91f788d6e3b19143456919288cecf76a9bbf00247d609f1', 'charles', 'lefebvre', 'c.lefebvre76000@gmail.co', 'admin', '2022-07-20 08:32:08', NULL, 0, NULL, 0, NULL, NULL, '6d54ae4d8e24767ffcf4fc20a37cc2372d141a879122a9473a734c56fa342aad'),
(38, 'charlesl', '17c1fcd006f4c15649c1bec040496723a2e7d1c8758df435d084fbb2ea9ce940c86e2c368b7f9113e91f788d6e3b19143456919288cecf76a9bbf00247d609f1', 'Charles', 'Lefebvre', 'c.lefebvre76000@gmail.com', 'user', '2022-07-21 16:36:30', NULL, 1, NULL, 0, NULL, NULL, '826ac3996f06c361ba3579821945e7f09e72b1ab0b152e129b984d4cb499f3f8');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
