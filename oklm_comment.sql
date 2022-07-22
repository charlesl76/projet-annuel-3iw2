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
-- Structure de la table `oklm_comment`
--

CREATE TABLE `oklm_comment` (
  `id` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `published_date` datetime NOT NULL,
  `content` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `approved_by` int(11) DEFAULT NULL,
  `comment_parent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `oklm_comment`
--

INSERT INTO `oklm_comment` (`id`, `post`, `author`, `published_date`, `content`, `status`, `approved_by`, `comment_parent`) VALUES
(8, 1, 3, '2022-07-20 21:22:57', '<p>hello, commentaire sur le post 1</p>', 0, NULL, NULL),
(9, 1, 36, '2022-07-20 22:39:58', '<p>commentaire sur le post 1</p>', 0, NULL, NULL),
(10, 2, 36, '2022-07-20 22:56:15', '<p>hello, ajout d\'un commentaire</p>', 0, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `oklm_comment`
--
ALTER TABLE `oklm_comment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `oklm_comment`
--
ALTER TABLE `oklm_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
