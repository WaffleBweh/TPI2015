-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 05 Mai 2015 à 16:38
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `catal_info_bdd`
--
CREATE DATABASE IF NOT EXISTS `catal_info_bdd` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `catal_info_bdd`;

-- --------------------------------------------------------

--
-- Structure de la table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'NVidia'),
(2, 'Asus'),
(3, 'MSI'),
(4, 'Gigabyte'),
(5, 'Corsair'),
(6, 'Cooler Master'),
(7, 'Kingston'),
(8, 'HP'),
(9, 'Logitech'),
(10, 'AMD'),
(11, 'Intel'),
(12, 'EVGA'),
(13, 'DELL'),
(14, 'Cyborg'),
(15, 'Mad Catz'),
(16, 'Razer'),
(17, 'Samsung'),
(18, 'Sony'),
(19, 'Phanteks'),
(20, 'BitFenix'),
(21, 'Apple');

-- --------------------------------------------------------

--
-- Structure de la table `keywords`
--

CREATE TABLE IF NOT EXISTS `keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `keywords`
--

INSERT INTO `keywords` (`id`, `name`) VALUES
(1, 'carte graphique'),
(2, 'carte mere'),
(3, 'ram'),
(4, 'boitier'),
(5, 'processeur'),
(6, 'clavier'),
(7, 'souris'),
(8, 'ecran'),
(9, 'carte son'),
(10, 'carte reseau'),
(11, 'disque dur'),
(12, 'lecteur cd'),
(13, 'ventilateur'),
(14, 'graveur cd'),
(15, 'cle usb');

-- --------------------------------------------------------

--
-- Structure de la table `medias`
--

CREATE TABLE IF NOT EXISTS `medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` varchar(255) NOT NULL,
  `isImage` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `medias`
--

INSERT INTO `medias` (`id`, `src`, `isImage`) VALUES
(1, 'up-content/img/gtx770_1.jpg', 1),
(2, 'up-content/img/blackwidow_1.jpg', 1),
(3, 'up-content/img/blackwidow_2.jpg', 1),
(4, 'up-content/img/blackwidow_3.jpg', 1),
(5, 'up-content/other/blackwidow_manual.pdf', 0),
(6, 'up-content/img/apple_watch_1.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `short_desc` varchar(255) NOT NULL,
  `long_desc` text NOT NULL,
  `is_frontpage` tinyint(1) NOT NULL,
  `availability_date` date NOT NULL,
  `expiration_date` date NOT NULL,
  `view_count` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `title`, `short_desc`, `long_desc`, `is_frontpage`, `availability_date`, `expiration_date`, `view_count`, `id_brand`) VALUES
(1, 'NVidia GTX770', 'NVidia 2048MB Gaming graphics card', 'The GeForce 700 Series is a family of graphics processing units developed by Nvidia, used in desktop and laptop PCs. It is mainly based on a refresh of the Kepler microarchitecture (GK-codenamed chips) used in the previous GeForce 600 Series, but also includes cards based on the previous Fermi (GF) and later Maxwell (GM) architectures. A number of GeForce 700 series chips were released for mobile devices in April 2013. GeForce 700 series cards were first released in May 2013, starting with the release of the GeForce GTX Titan on February 19, 2013, and the GeForce GTX 780 on May 23, 2013.', 0, '2015-04-29', '2015-05-31', 90, 1),
(2, 'Razer Blackwidow', 'Cherry MX Blue mechanical keyboard', 'The Razer BlackWidow uses a PC layout but with 5 macro keys on the left-hand side. The key layout uses 1.5u-sized modifiers on the bottom row, with 1u Windows, Fn and Menu keys, as well as a 6u Space bar. There is also a version with US-ANSI/Macintosh layout but otherwise the same physical keys.\n\nA unique feature of the BlackWidow is that the function keys are shifted slightly to the right, so that they are parallel to the WASD cluster.', 1, '2015-04-29', '2015-05-31', 20, 16),
(3, 'Apple Watch', 'Smartwatch developed by Apple Inc.', 'Apple Watch is a smartwatch developed by Apple Inc. It incorporates fitness tracking and health-oriented capabilities as well as integration with iOS and other Apple products and services.\n\nThe device is available in three "collections": Apple Watch Sport, Apple Watch, and Apple Watch Edition. The watch is distinguished by different combinations of cases and interchangeable bands. Apple Watch relies on a wirelessly connected iPhone to perform many of its default functions (e.g. calling and texting).\n\nIt is compatible with the iPhone 5 or later models running iOS 8.2 or later, through the use of Bluetooth or Wi-Fi. Announced by Tim Cook on September 9, 2014, the device was available for pre-order on April 10 and began shipping on April 24, 2015.', 1, '2015-04-29', '2015-05-31', 23, 21);

-- --------------------------------------------------------

--
-- Structure de la table `products_has_keywords`
--

CREATE TABLE IF NOT EXISTS `products_has_keywords` (
  `id_products` int(11) NOT NULL,
  `id_keywords` int(11) NOT NULL,
  PRIMARY KEY (`id_products`,`id_keywords`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `products_has_medias`
--

CREATE TABLE IF NOT EXISTS `products_has_medias` (
  `id_products` int(11) NOT NULL,
  `id_medias` int(11) NOT NULL,
  PRIMARY KEY (`id_products`,`id_medias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `products_has_medias`
--

INSERT INTO `products_has_medias` (`id_products`, `id_medias`) VALUES
(1, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(3, 6);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `is_admin`) VALUES
(1, 'Admin', '43cd17b0b3dc3bfa9d45d6f3e6688cbb73e2b65d', 1),
(2, 'User', '38758f53d77d5217d477433658b49a301f435feb', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users_has_products`
--

CREATE TABLE IF NOT EXISTS `users_has_products` (
  `id_users` int(11) NOT NULL,
  `id_products` int(11) NOT NULL,
  PRIMARY KEY (`id_users`,`id_products`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
