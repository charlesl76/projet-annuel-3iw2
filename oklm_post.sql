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
  `post_modified` timestamp NULL DEFAULT NULL,
  `post_modified_gmt` timestamp NULL DEFAULT NULL,
  `post_parent` tinyint(4) DEFAULT NULL,
  `post_type` enum('category','article','page') NOT NULL,
  `comment_count` mediumint(9) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `oklm_post`
--

INSERT INTO `oklm_post` (`id`, `author`, `date`, `date_gmt`, `content`, `title`, `excerpt`, `status`, `post_modified`, `post_modified_gmt`, `post_parent`, `post_type`, `comment_count`) VALUES
(1, 36, '2022-07-20 14:24:01', '2022-06-07 08:44:51', 'Salut, ceci est un test, ça fonctionne ?</br></br><small>Yes !</small>', 'Test fonctionnel', 'Un joli test pour voir si ça fonctionne', 1, NULL, NULL, 0, 'article', 0),
(2, 36, '2022-07-21 18:32:02', '2022-06-10 12:46:54', 'What is the common law about passion?\n<p>Today I am going to be speaking about passion and its interests in basketball. From Bryant to James, how does passion impact this fabulous sport?</p>\n<p><em>Michel Jalinsky, Sported.</em></p>', 'title', 'title', 1, NULL, NULL, 9, 'article', 0),
(4, 36, '2022-07-20 14:48:02', '2022-06-10 12:57:39', '<h1>What is the common law about passion?</h1>\n<p>Today I am going to be speaking about passion and its interests in basketball. From Bryant to James, how does passion impact this fabulous sport?</p>\n<p><em>Michel Jalinsky, Sported.</em></p>', 'How to share basketall passion', 'how-to-share-basketall-passion', 1, NULL, NULL, NULL, 'page', 0),
(5, 36, '2022-07-21 00:20:43', '2022-07-20 23:27:18', '<p>te</p>', 'heelooo', 'heelooo', 1, NULL, NULL, NULL, 'page', 0),
(6, 1, '2022-07-21 16:43:18', '2022-07-21 16:43:18', '<p>bonsoir, page de test</p>', 'page de test', 'page-de-test', 1, NULL, NULL, NULL, 'page', 0),
(7, 36, '2022-07-21 17:51:14', '2022-07-21 17:02:27', '<p>Hello how you doing ?</p>', 'hello', 'hello', 1, NULL, NULL, NULL, 'category', 0),
(8, 36, '2022-07-21 17:29:49', '2022-07-21 17:29:49', '<p>hellooooooo</p>', 'hello', 'hello', 1, NULL, NULL, NULL, 'page', 0),
(9, 36, '2022-07-21 18:07:19', '2022-07-21 18:07:19', '37', 'video-games', 'video-games', 1, NULL, NULL, NULL, 'category', 0),
(10, 36, '2022-07-21 18:31:40', '2022-07-21 18:31:40', '<p>article</p>', 'article1', 'article1', 1, NULL, NULL, 9, 'article', 0),
(11, 36, '2022-07-21 18:32:17', '2022-07-21 18:32:17', '<p>test test</p>', 'test', 'test', 1, NULL, NULL, NULL, 'page', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
