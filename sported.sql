-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : jeu. 07 juil. 2022 à 12:11
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
(4, 1, '2022-06-10 12:57:39', '2022-06-10 12:57:39', '<h1>What is the common law about passion?</h1>\r\n<p>Today I am going to be speaking about passion and its interests in basketball. From Bryant to James, how does passion impact this fabulous sport?</p>\r\n<p><em>Michel Jalinsky, Sported.</em></p>', 'How to share basketall passion', 'how-to-share-basketall-passion', 1, -1, NULL, NULL, NULL, 'page', 0),
(18, 1, '2022-07-07 12:11:36', '2022-07-07 12:11:36', '<h1>Where do you put the ball?</h1>\r\n<p>&nbsp;</p>\r\n<pre>In the goal!</pre>', 'Where to put the ball?', 'where-to-put-the-ball?', 1, NULL, NULL, NULL, 2, 'article', 0);

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
(1, 'admin', '$2a$12$cOCyEm3z/dmC6YMOexLd2eHl/g0fLUdN2HHSvM1gr7zzN35.a9c/u', 'Admin', 'Istrator', 'admin@sported.com', 'admin', '2022-02-03 11:27:15', NULL, 1, '', 'male', 0, NULL, '1990-02-08'),
(2, 'test2', 'test2', 'test2-1', 'test2-2', 'test2@test.fr', 'user', '2022-05-24 10:35:26', NULL, 0, '', 'male', 0, NULL, '2022-05-10'),
(3, 'test3', 'test3', 'test3-1', 'test3-2', 'test3@test3.fr', 'user', '2022-05-10 10:35:26', NULL, 0, '', 'female', 0, NULL, '2022-05-03');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `oklm_post`
--
ALTER TABLE `oklm_post`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT pour la table `oklm_post`
--
ALTER TABLE `oklm_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `oklm_user`
--
ALTER TABLE `oklm_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
