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
-- Structure de la table `oklm_post`
--

CREATE TABLE `oklm_post` (
  `id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_gmt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` longtext NOT NULL,
  `title` tinytext NOT NULL,
  `excerpt` tinytext,
  `status` tinyint(4) NOT NULL,
  `comment_status` tinyint(4) DEFAULT NULL,
  `post_modified` timestamp NULL DEFAULT NULL,
  `post_modified_gmt` timestamp NULL DEFAULT NULL,
  `post_parent` tinyint(4) DEFAULT NULL,
  `post_type` enum('category','article','page') NOT NULL,
  `comment_count` mediumint(9) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `oklm_post`
--

INSERT INTO `oklm_post` (`id`, `author`, `date`, `date_gmt`, `content`, `title`, `excerpt`, `status`, `comment_status`, `post_modified`, `post_modified_gmt`, `post_parent`, `post_type`, `comment_count`) VALUES
(1, 138, '2022-06-07 08:44:51', '2022-06-07 08:44:51', '<h1>Salut, ceci est un test, ça fonctionne ?</h1></br></br><small>Yes !</small>', 'Test fonctionnel', 'Un joli test pour voir si ça fonctionne', 1, 1, NULL, NULL, 0, 'page', 0),
(2, 1, '2022-06-10 12:46:54', '2022-06-10 12:46:54', '<p>content</p>', 'title', 'title', 1, 1, NULL, NULL, NULL, 'page', 0),
(4, 1, '2022-07-14 22:37:28', '2022-06-10 12:57:39', '<h1>What is the common law about passion?</h1>\r\n<p>Today I am going to be speaking about passion and its interests in basketball. From Bryant to James, how does passion impact this fabulous sport?</p>\r\n<p><em>Michel Jalinsky, Sported.</em></p>', 'How to share basketall passion', 'how-to-share-basketall-passion', 1, -1, NULL, NULL, NULL, 'article', 0),
(18, 1, '2022-07-14 22:27:05', '2022-07-14 22:27:05', '<p>La testosterone du testo.</p>', 'Testosterone', 'testosterone', 1, -1, NULL, NULL, 2, 'article', 0),
(19, 1, '2022-07-15 00:55:41', '2022-07-15 00:55:41', '12', 'Biking', 'biking', 1, NULL, NULL, NULL, NULL, 'category', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `oklm_post`
--
ALTER TABLE `oklm_post`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `oklm_post`
--
ALTER TABLE `oklm_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
