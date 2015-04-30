-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 30 Avril 2015 à 16:41
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
(20, 'BitFenix');

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

--
-- Contenu de la table `medias`
--

INSERT INTO `medias` (`id`, `src`) VALUES
(1, 'sound/cheval.mp3');

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `title`, `short_desc`, `long_desc`, `is_frontpage`, `availability_date`, `expiration_date`, `view_count`, `id_brand`) VALUES
(1, 'NVidia GTX770', 'NVidia 2048MB Gaming graphics card', 'The GeForce 700 Series is a family of graphics processing units developed by Nvidia, used in desktop and laptop PCs. It is mainly based on a refresh of the Kepler microarchitecture (GK-codenamed chips) used in the previous GeForce 600 Series, but also includes cards based on the previous Fermi (GF) and later Maxwell (GM) architectures. A number of GeForce 700 series chips were released for mobile devices in April 2013. GeForce 700 series cards were first released in May 2013, starting with the release of the GeForce GTX Titan on February 19, 2013, and the GeForce GTX 780 on May 23, 2013.', 0, '2015-04-29', '2015-05-31', 90, 1),
(2, 'Razer Blackwidow', 'Cherry MX Blue mechanical keyboard', 'The Razer BlackWidow uses a PC layout but with 5 macro keys on the left-hand side. The key layout uses 1.5u-sized modifiers on the bottom row, with 1u Windows, Fn and Menu keys, as well as a 6u Space bar. There is also a version with US-ANSI/Macintosh layout but otherwise the same physical keys.\r\n\r\nA unique feature of the BlackWidow is that the function keys are shifted slightly to the right, so that they are parallel to the WASD cluster.', 1, '2015-04-29', '2015-05-31', 20, 16);

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `is_admin`) VALUES
(1, 'Admin', '43cd17b0b3dc3bfa9d45d6f3e6688cbb73e2b65d', 1),
(2, 'User', '38758f53d77d5217d477433658b49a301f435feb', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
