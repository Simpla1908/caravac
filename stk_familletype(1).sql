-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 21 avr. 2026 à 13:31
-- Version du serveur :  5.7.36
-- Version de PHP : 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `caravacdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `stk_familletype`
--

DROP TABLE IF EXISTS `stk_familletype`;
CREATE TABLE IF NOT EXISTS `stk_familletype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `priority` int(11) DEFAULT '0',
  `sup` int(10) DEFAULT '0',
  `syn` int(11) DEFAULT '0',
  `designation` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stk_familletype`
--

INSERT INTO `stk_familletype` (`id`, `nom`, `priority`, `sup`, `syn`, `designation`) VALUES
(1, 'BOISSONS', 1, 0, 1, 'BAR'),
(2, 'CUISINE', 3, 0, 1, 'CUISINE EUROPEENNE'),
(3, 'SANDWICHERIE', 100, 0, 1, 'SANDWICHERIE'),
(4, 'EXTRA', 101, 0, 1, 'EXTRA'),
(5, '', 0, 0, 1, '0'),
(6, 'CUISINE CONGOLAISE', 2, 0, 1, 'CUISINE CONGOLAISE'),
(7, 'PIZZARIA', 4, 0, 1, 'PIZZARIA'),
(8, 'SUCRERIE', 5, 0, 1, 'SUCRERIE'),
(9, 'BILLARD', 6, 0, 1, 'BILLARD');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
