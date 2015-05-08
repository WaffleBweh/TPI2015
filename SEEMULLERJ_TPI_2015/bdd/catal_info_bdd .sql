-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 08 Mai 2015 à 13:25
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

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
-- Vider la table avant d'insérer `brands`
--

TRUNCATE TABLE `brands`;
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Vider la table avant d'insérer `keywords`
--

TRUNCATE TABLE `keywords`;
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
(15, 'cle usb'),
(16, 'chipset'),
(17, 'alimentation'),
(18, 'gaming');

-- --------------------------------------------------------

--
-- Structure de la table `medias`
--

CREATE TABLE IF NOT EXISTS `medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` varchar(255) NOT NULL,
  `isImage` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Vider la table avant d'insérer `medias`
--

TRUNCATE TABLE `medias`;
--
-- Contenu de la table `medias`
--

INSERT INTO `medias` (`id`, `src`, `isImage`) VALUES
(1, 'up-content/img/gtx770_1.jpg', 1),
(2, 'up-content/img/blackwidow_1.jpg', 1),
(3, 'up-content/img/blackwidow_2.jpg', 1),
(4, 'up-content/img/blackwidow_3.jpg', 1),
(5, 'up-content/other/blackwidow_manual.pdf', 0),
(6, 'up-content/img/razernaga_1.png', 1),
(7, 'up-content/other/blackwidow_quick_start.pdf', 0),
(8, 'up-content/img/Carbide300R_1.jpg', 1),
(9, 'up-content/img/Carbide300R_2.jpg', 1),
(10, 'up-content/img/FORCELS_1.jpg', 1),
(11, 'up-content/img/GT610-SL-1GD3-L_1.jpg', 1),
(12, 'up-content/img/GTX960_1.jpg', 1),
(13, 'up-content/img/IntelXeon_1.jpg', 1),
(14, 'up-content/img/Inteli7_1.jpg', 1),
(15, 'up-content/img/RM650_1.jpg', 1),
(16, 'up-content/img/RM650_2.jpg', 1),
(17, 'up-content/img/RM650_3.jpg', 1),
(18, 'up-content/img/VENGENCE_1.jpg', 1),
(19, 'up-content/img/XMS3_1.jpg', 1),
(20, 'up-content/other/XMS3_2.pdf', 0),
(21, 'up-content/other/02G-P4-2771554c9b0ad059f.pdf', 0),
(22, 'up-content/img/evga_acx_g1554c9b0ad3868.jpg', 1),
(23, 'up-content/other/evga_com1554c9b0ad4420.pdf', 0),
(24, 'up-content/img/evga-gefor1554c9b0ad5b90.jpg', 1),
(25, 'up-content/img/img_84381554c9b0ad6b30.jpg', 1),
(26, 'up-content/img/img_85681554c9b0ad76e8.jpg', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Vider la table avant d'insérer `products`
--

TRUNCATE TABLE `products`;
--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `title`, `short_desc`, `long_desc`, `is_frontpage`, `availability_date`, `expiration_date`, `view_count`, `id_brand`) VALUES
(1, 'GeForce GTX 770', 'NVidia 2048 MB Graphics card', 'The GeForce 700 Series is a family of graphics processing units developed by Nvidia, used in desktop and laptop PCs. It is mainly based on a refresh of the Kepler microarchitecture (GK-codenamed chips) used in the previous GeForce 600 Series, but also includes cards based on the previous Fermi (GF) and later Maxwell (GM) architectures. A number of GeForce 700 series chips were released for mobile devices in April 2013. GeForce 700 series cards were first released in May 2013, starting with the release of the GeForce GTX Titan on February 19, 2013, and the GeForce GTX 780 on May 23, 2013.', 0, '2015-04-29', '2015-05-31', 98, 1),
(2, 'Blackwidow Ultimate', 'Cherry MX Blue mechanical keyboard', 'The Razer BlackWidow uses a PC layout but with 5 macro keys on the left-hand side. The key layout uses 1.5u-sized modifiers on the bottom row, with 1u Windows, Fn and Menu keys, as well as a 6u Space bar. There is also a version with US-ANSI/Macintosh layout but otherwise the same physical keys.\r\n\r\nA unique feature of the BlackWidow is that the function keys are shifted slightly to the right, so that they are parallel to the WASD cluster.', 1, '2015-04-29', '2015-05-31', 21, 16),
(3, 'Naga Epic', '17 Buttons, Optimized Gaming Mouse', 'In any MMO, the more spells you have instant access to, the greater your advantage becomes.	\r\nThe Razer Naga Epic features a total of 19 buttons, including the iconic Razer Naga 12-button thumb grid to maximize the actions at your disposal. Now letting you map and access even more abilities, macros, as well as controls, the Razer Naga Epic makes it easy to hit the right button at the right time.\r\n \r\nThe Razer Naga Epic gaming-grade wireless technology gives you completely unrestricted	\r\nmovement without compromising on mouse control or accuracy. With a response rate of 1ms whether wired or wireless, your Razer Naga Epic delivers peak performance all the time. Furthermore, by plugging in the USB when the battery is running low, your Razer Naga Epic charges while you use it, so you get zero downtime all the time.', 1, '2015-04-29', '2015-05-31', 24, 16),
(4, 'RM650 80 PLUS', 'Alimentation Gold Certified Fully Modular PSU', 'Reliable operation, fully modular cabling, and optimized for silence.\r\nThe Corsair RM650 is fully modular and optimized for silence and high efficiency. Built with low-noise capacitors and transformers, and Zero RPM Fan Mode ensures that the fan does not spin unless the power supply is under heavy load. And with a fan that is custom-designed for low noise operation.\r\n\r\n80 PLUS Gold rated efficiency saves you money on your power bill, and the low-profile black cables are fully modular, so you can enjoy fast, neat builds. And, like all Corsair power supplies, the RM650 is built with high-quality components and is guaranteed to deliver clean, stable, continuous power. Want even more? Connect it to your Corsair Link system (available separately) and you can even monitor fan speed and +12V current directly from your desktop.', 0, '2015-04-29', '2015-05-31', 15, 5),
(5, 'Carbide 300R Black', '( 3 x 5.25 ) Compact PC Gaming Case - No power', 'Everything You Need, Nothing You Don''t.\r\n\r\nA compact expression of Corsair''s gaming philosophy.\r\nGreat systems start with a great case, and Carbide Series 300R provides a remarkable number of features in a compact chassis. Easy access, lots of room for expansion, and superior cooling make the 300R a great choice for building powerful PCs that don''t take up a lot of room.\r\n\r\nSerious cooling potential.\r\nThe 300R is equipped with two fans for intake and exhaust, and the integrated dust filters on the front and bottom intakes are easy removable. There''s room for you to install five more fans, including mounting points for two side panel 120mm fans for drawing cool air directly over your GPUs. If you''re building a multi-GPU gaming rig, proper graphics ventilation is essential.', 0, '2015-04-29', '2015-05-31', 45, 5),
(6, 'Force Series LS', 'SSD Drive 60 GB 2.5', 'With a sequential read speed of up to 560 MB/s, the Force Series LS from Corsair is a force to deal with. This SATA 6 Gbps solid state drive is available in three capacities namely, 60 GB, 120 GB and 240 GB. Each of these variants can reach a maximum sequential write speed of 535 MB/s. The Force Series LS follows a 7 mm form factor and absorbs 4.6 W when active, making it ideal for notebook computers.\r\nThe Phison PS3108-S8 controller inside the Force Series LS is an 8-channel controller capable of supporting up to 1 TB of flash storage capacity. Among its features are AES Encryption, S.M.A.R.T., NCQ/TRIM and DEVSLP mode. Together with this controller are MLC Toggle NAND modules and DRAM caches. The 240 GB model has a DRAM cache of 512 MB while the 120 GB and 60 GB has a DRAM cache of 256 MB.\r\nLike a typical Corsair SSD, the Force Series LS has a three-year warranty and a Mean Time Between Failure (MTBF) of 1,000,000 hours.', 1, '2015-04-29', '2015-05-31', 16, 5),
(7, 'Dual Channel Vengeance', 'DDR3 8GB [2x4GB] DDR1600 (PC3-12800)', 'Speed Rating : PC3-12800 \r\nTested Speed : 1600Mhz \r\nSize : 8GB Kit (2 x 4GB) \r\nTested Latency : 9-9-9-24 \r\nTested Voltage : 1.5 \r\nPerformance Profile : XMP \r\nSPD Speed : 1333Mhz \r\nSPD Latency : 9-9-9-24 \r\nPackage : 240pin DIMM \r\nFan Included : No \r\n\r\nVengeance DDR3 memory modules use high performance RAM, run at 1.5V, and have the aggressive look you want, all at an attractively low price. \r\n\r\nGreat Looking, Great Overclocking Memory at a Great Price\r\nCorsair Vengeance DDR3 memory modules are designed with overclockers in mind. Vengeance DIMMs are built using RAM specially selected for their high-performance potential. Aluminum heat spreaders help dissipate heat, and provide the aggressive look that you want in your gaming rig. As a bonus, the attractive low price of Vengeance memory will also leave lots of room in your system build budget.\r\n\r\nOptimized for Compatibility with the Latest CPUs and Motherboards\r\nVengeance memory is designed specifically for the latest CPUs. The 1.5V VDIMM spec ensures you get the performance you expect, even without increasing memory voltages. Vengeance DDR3 memory is available in single modules, and two or three module kits, making it easy for you to match the DIMM population requirements of your motherboard.\r\n\r\nNext-Generation Density for the Ultimate Power User\r\nMost Vengeance DIMMs are built with two gigabit RAM ICs. These extra-dense memory chips allow you to have 8GB of memory using only two DIMMs, or to populate your triple channel system with up to an insanely large 24GB of system memory for extreme multitasking performance.', 1, '2015-04-29', '2015-05-31', 45, 5),
(8, 'XMS3', 'DDR3 32GB [4x8GB] DDR1600 (PC3-12800)', 'Taille 32GB Kit (4 x 8GB)\r\nProfil des performances XMP\r\nVentilateur compris Non\r\nRï¿½partiteur de chaleur XMS\r\nConfiguration de la mï¿½moire Dual / Quad Channel\r\nType de mï¿½moire DDR3\r\nProduit - Broches de la mï¿½moire 240\r\nProduit - Format de la mï¿½moire DIMM\r\nTension testï¿½e 1.5\r\nTension SPD 1.5\r\nCote de vitesse PC3-12800 (1600MHz)\r\nVitesse SPD 1333MHz\r\nVitesse testï¿½e 1600Mhz\r\nLatence testï¿½e 11-11-11-30\r\nLatence SPD 9-9-9-24', 0, '2015-04-29', '2015-05-31', 23, 5),
(9, 'GeForce GTX 960', 'GeForce GTX960 2048MB DVI HDMI 3xDisplay port', 'The GeForce 900 Series is a family of graphics processing units developed by Nvidia, used in desktop and laptop PCs. It serves as the high-end introduction for the Maxwell architecture (GM-codenamed chips), named after the Scottish theoretical physicist James Clerk Maxwell.\r\n\r\nThe Maxwell microarchitecture, the successor to Kepler microarchitecture, will for the first time feature an integrated ARM CPU of its own. This will make Maxwell GPUs more independent from the main CPU according to Nvidia''s CEO Jen-Hsun Huang. Nvidia expects three major things from the Maxwell architecture: improved graphics capabilities, simplified programming as well as better energy-efficiency compared to the GeForce 700 Series and GeForce 600 Series \r\n\r\nMaxwell was announced in September 2010. The first GeForce consumer-class products based on the Maxwell architecture were released in early 2014.[ Nvidia is expected to release the Maxwell-powered Tesla accelerator cards as well as Quadro professional graphics cards based on this architecture in late 2014. Eventually, Maxwell architecture will be used for mobile application processors that belong to the Erista family of Tegra SoCs.', 1, '2015-04-29', '2015-05-31', 79, 12),
(10, 'GT610-SL-1GD3-L', 'GeForce GT610 1024MB DVI/HDMI ', 'Where the goal of the previous architecture, Fermi, was to increase raw performance (particularly for compute and tessellation), Nvidia''s goal with the Kepler architecture was to increase performance per watt, while still striving for overall performance increases. The primary way Nvidia achieved this goal was through the use of a unified clock. By abandoning the shader clock found in their previous GPU designs, efficiency is increased, even though it requires more cores to achieve similar levels of performance. This is not only because the cores are more power efficient (two Kepler cores using about 90% of the power of one Fermi core, according to Nvidia''s numbers), but also because the reduction in clock speed delivers a 50% reduction in power consumption in that area.', 0, '2015-04-29', '2015-05-31', 10, 2),
(11, 'Quad Core i7-4770S 3.1GHz', '3.1GHz up to 3.90 GHz & HD Graphics 4600', 'Intel Core is a brand name that Intel uses for various mid-range to high-end consumer and business microprocessors. These processors replaced the then-currently mid to high end Pentium processors, making them entry level, and bumping the Celeron series of processors to low end. Similarly, identical or more capable versions of Core processors are also sold as Xeon processors for the server and workstation market.\r\n\r\nAs of 2015 the current lineup of Core processors included the latest Intel Core i7, Intel Core i5, and Intel Core i3', 0, '2015-04-29', '2015-05-31', 27, 11),
(12, 'Xeon Quad Core E3-1276V3', '3.6GHz LGA1150 - 8MB - 22 nm - 84W', 'The Xeon /?zi??n/ is a brand of x86 microprocessors designed and manufactured by Intel Corporation, targeted at the non-consumer workstation, server, and embedded system markets. Primary advantages of the Xeon CPUs, when compared to the majority of Intel''s desktop-grade consumer CPUs, are their multi-socket capabilities, higher core counts, and support for ECC memory.', 0, '2015-04-29', '2015-05-31', 17, 11),
(13, 'GTX770 Superclocked ACX', 'Overclocked graphics card by EVGA', 'Fast just got faster with the next-generation EVGA GeForce GTX 770, a high-performance graphics card designed from the ground up to deliver high-speed, super-smooth gaming.\r\n\r\nEVGA is also introducing a brand new cooling design; the redefining EVGA ACX Cooler. With a 40% increase in heatsink volume, the EVGA ACX is more efficient at dissipating heat, allowing for 15% lower GPU temperatures. A reinforcement baseplate maintains a straight PCB, and helps lower mosfet temperatures by 7% and memory by 15%.', 1, '2015-04-29', '2015-05-31', 16, 1);

-- --------------------------------------------------------

--
-- Structure de la table `products_has_keywords`
--

CREATE TABLE IF NOT EXISTS `products_has_keywords` (
  `id_products` int(11) NOT NULL,
  `id_keywords` int(11) NOT NULL,
  PRIMARY KEY (`id_products`,`id_keywords`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vider la table avant d'insérer `products_has_keywords`
--

TRUNCATE TABLE `products_has_keywords`;
--
-- Contenu de la table `products_has_keywords`
--

INSERT INTO `products_has_keywords` (`id_products`, `id_keywords`) VALUES
(1, 1),
(2, 6),
(3, 7),
(4, 17),
(4, 18),
(5, 4),
(5, 18),
(6, 11),
(7, 3),
(7, 18),
(8, 3),
(9, 1),
(9, 18),
(10, 1),
(11, 5),
(12, 5),
(13, 1),
(13, 18);

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
-- Vider la table avant d'insérer `products_has_medias`
--

TRUNCATE TABLE `products_has_medias`;
--
-- Contenu de la table `products_has_medias`
--

INSERT INTO `products_has_medias` (`id_products`, `id_medias`) VALUES
(1, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 7),
(3, 6),
(4, 15),
(4, 16),
(4, 17),
(5, 8),
(5, 9),
(6, 10),
(7, 18),
(8, 19),
(8, 20),
(9, 12),
(10, 11),
(11, 14),
(12, 13),
(13, 21),
(13, 22),
(13, 23),
(13, 24),
(13, 25),
(13, 26);

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
-- Vider la table avant d'insérer `users`
--

TRUNCATE TABLE `users`;
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

--
-- Vider la table avant d'insérer `users_has_products`
--

TRUNCATE TABLE `users_has_products`;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
