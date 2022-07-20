-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : mer. 20 juil. 2022 à 08:02
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
(2, 'test2', 'test2', 'test2-1', 'test2-2', 'test2@test.fr', 'user', '2022-05-24 10:35:26', NULL, 0, 'male', 0, NULL, '2022-05-10', ''),
(3, 'charles2', 'test3', 'Charles', 'Lefebvre', 'test3@test3.fr', 'admin', '2022-05-10 10:35:26', NULL, 0, 'female', 0, NULL, '2022-05-03', ''),
(33, 'charles', 'aa3498599fc696288dc878f93ac4bcac9d501dcda2978cfc3024d7bb7d8223768ccc94382f3415758fb668c24e05a9566958ac2857fbc9d9e1c8d50f2a4a3433', 'charles', 'lefebvre', 'c.lefebvre76000@gmail.com', 'user', '2022-07-19 23:52:23', '2022-07-20 00:01:25', 1, NULL, 0, NULL, NULL, '934f1ec674e58b353ad77fd0466ea0b514ed8c4374a2072aaa4761aad64ede8c');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
