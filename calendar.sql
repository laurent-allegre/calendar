-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 25 mars 2021 à 16:15
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `calendar`
--

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `start`, `end`) VALUES
(1, 'evenement', 'evenement special', '2021-03-21 11:49:26', '2021-03-21 15:49:26'),
(2, 'test du 24', 'essai', '2021-03-24 11:00:42', '2021-03-24 12:00:42'),
(3, 'special printemps', '    youpi', '2021-03-18 09:37:00', '2021-03-18 22:37:00'),
(4, 'demo', '        ', '2021-03-05 03:00:00', '2021-03-05 13:56:00'),
(5, 'demo', '        ', '2021-03-05 03:00:00', '2021-03-05 13:56:00'),
(6, 'aie aie', '  dur dur   ', '2021-03-16 13:40:00', '2021-03-16 19:40:00'),
(7, 'la merde yaouh', '      ', '2021-03-09 16:32:00', '2021-03-09 17:32:00'),
(8, 'majuscule tu connais', '  ', '2021-03-11 07:39:00', '2021-03-11 16:39:00'),
(9, 'demo', '  lolo', '2021-03-02 15:46:00', '2021-03-02 16:46:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
