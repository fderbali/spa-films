-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 02, 2021 at 12:47 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a20bdfilms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(3, 'Action'),
(6, 'Drame'),
(7, 'ComÃ©die'),
(8, 'Horreur'),
(14, 'Sciences-Fiction'),
(15, 'Animation'),
(16, 'Aventure'),
(17, 'ComÃ©die'),
(18, 'Crime'),
(19, 'Histoire'),
(20, 'Familial'),
(21, 'Fantastique'),
(22, 'Thriller'),
(23, 'Guerre');

-- --------------------------------------------------------

--
-- Table structure for table `connexions`
--

CREATE TABLE `connexions` (
  `courriel` varchar(75) NOT NULL,
  `mot_de_passe` varchar(45) NOT NULL,
  `status` enum('A','I') NOT NULL,
  `date_derniere_connexion` datetime DEFAULT NULL,
  `is_admin` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `connexions`
--

INSERT INTO `connexions` (`courriel`, `mot_de_passe`, `status`, `date_derniere_connexion`, `is_admin`) VALUES
('admin@dfilms.com', '*3D3B92F242033365AE5BC6A8E6FC3E1679F4140A', 'A', '2021-01-10 16:04:33', 'Y'),
('derbali@dfilm.com', '*3D3B92F242033365AE5BC6A8E6FC3E1679F4140A', 'A', '2021-01-31 21:55:53', 'N'),
('fahmi@dfilm.com', '*3D3B92F242033365AE5BC6A8E6FC3E1679F4140A', 'A', '2021-02-02 12:09:52', 'N'),
('fahmiderbali@dfilms.com', '*3D3B92F242033365AE5BC6A8E6FC3E1679F4140A', 'A', '2021-01-20 22:18:20', 'N'),
('fderbali@dfilms.com', '*3D3B92F242033365AE5BC6A8E6FC3E1679F4140A', 'A', '2021-01-10 15:36:45', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `detail_location`
--

CREATE TABLE `detail_location` (
  `id` int(11) NOT NULL,
  `id_film` int(10) UNSIGNED NOT NULL,
  `id_location` int(10) UNSIGNED NOT NULL,
  `prix` float NOT NULL,
  `expire_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_location`
--

INSERT INTO `detail_location` (`id`, `id_film`, `id_location`, `prix`, `expire_at`) VALUES
(1, 18, 14, 5.1, '2021-02-03 12:32:56'),
(2, 25, 14, 4.15, '2021-02-03 02:50:19'),
(7, 26, 22, 3.25, '2021-02-05 04:32:01'),
(8, 33, 23, 5.21, '2021-02-01 12:27:09');

-- --------------------------------------------------------

--
-- Table structure for table `detail_panier`
--

CREATE TABLE `detail_panier` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_film` int(10) UNSIGNED NOT NULL,
  `id_panier` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE `films` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(45) NOT NULL,
  `realisateur` varchar(75) NOT NULL,
  `duree` time NOT NULL,
  `langue` char(2) NOT NULL,
  `date` date NOT NULL,
  `pochette` varchar(75) NOT NULL,
  `en_vedette` tinyint(1) NOT NULL,
  `pochette_grand_format` varchar(75) DEFAULT NULL,
  `url_bande_annonce` varchar(75) NOT NULL,
  `prix` float NOT NULL,
  `score` int(11) NOT NULL,
  `definition` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`id`, `nom`, `realisateur`, `duree`, `langue`, `date`, `pochette`, `en_vedette`, `pochette_grand_format`, `url_bande_annonce`, `prix`, `score`, `definition`) VALUES
(18, 'Breach       ', 'John Suits', '02:44:00', 'fr', '2020-12-18', '36a2842e01c60a3bcdc9d906c61db1ca6367eea8.jpg', 1, '', 'https://www.youtube.com/watch?v=OR_ce_9NRks', 5.1, 60, '1080'),
(25, 'Terminator ', 'James Cameron', '01:48:00', 'en', '2015-01-19', '8f86cf2df2b22eb395fedd9c7609e9acd19e87c0.jpg', 1, '', 'https://www.youtube.com/watch?v=buZzcTOnLL4', 4.15, 60, '1080'),
(26, 'Zone hostile ', 'Rob Yescombe', '00:10:00', '', '2021-01-05', '4cf509c68d3ae74fabe66d2103b8de02c9e546c1.jpg', 1, '', 'https://www.youtube.com/watch?v=isj7LPta2_U', 3.25, 75, '720'),
(29, 'Destruction Finale ', 'Lee Hae-jun', '02:10:00', 'fr', '2019-12-19', '9a3101fda3dbb48d3a6e1a4ccf655830da3bfa05.jpg', 1, '', 'https://www.youtube.com/watch?v=i6_9ZX-87hc', 4.2, 70, '1080'),
(30, 'Peninsula', 'Yeon Sang-ho', '01:56:00', 'fr', '2020-07-15', '72f68d2eedeac591b4fbccef292e229aa78303d9.jpg', 0, '', 'https://www.youtube.com/watch?v=P5lLoEagvr4', 2.78, 69, '1400'),
(31, 'The good criminal ', 'Steve Allrich', '01:38:00', 'en', '2020-10-09', '1f85bf3db41f2826cea7c10e478a95b8d3e0d48c.jpg', 1, '', 'https://www.youtube.com/watch?v=GVZ61q4b5vQ', 2.75, 66, '2000'),
(32, 'Les Aventures d\'Olaf  ', 'Trent Correy', '01:08:00', 'fr', '2020-10-23', '7550b2c9b7f099f916819403e3f5b19b4587c807.jpg', 0, '', 'https://www.youtube.com/watch?v=J2jkriC2O7Y', 1.68, 68, '2000'),
(33, 'Ã‡a - Chapitre 2 ', 'Stephen King', '02:49:00', 'fr', '2019-09-06', '06bf5473fe3db8e76050ea648e70264d53b73bcb.jpg', 0, '', 'https://www.youtube.com/watch?v=UHfCq3n54Js', 5.21, 69, '2000'),
(34, 'Horse soldiers  ', 'Peter Craig', '02:10:00', 'en', '2018-01-19', 'fb0a0d9dd3fc4698019146c194dc63f23bf413f2.jpg', 0, '', 'https://www.youtube.com/watch?v=B23YpLKcI20', 4.33, 61, '1080'),
(35, 'Soul ', 'Mike Jones', '01:40:00', 'en', '2020-12-25', 'be68b4bca05bee338bf712cbdf8b819107c4beb3.jpg', 0, '', 'https://www.youtube.com/watch?v=gIDww8LMBts', 2.78, 83, '4K'),
(36, 'Tenet ', 'Christopher Nolan', '02:30:00', 'de', '2020-08-27', '4c9292477afcb30d9788674a91e7b6e6a229309f.jpg', 0, '', 'https://www.youtube.com/watch?v=6UG5LJQNjts', 3.56, 73, '4K'),
(37, 'HÃ¼rkuÅŸ: GÃ¶klerdeki Kahraman ', 'Savas Korkmaz', '02:06:00', 'de', '2018-05-25', 'ab3f85a6d3db4adb603e48571710d6746277d8f2.jpg', 0, '', 'https://www.youtube.com/watch?v=5EFM18YFsWI', 4.79, 45, '800'),
(43, 'Batman: Soul of the Dragon', 'Sam Liu', '01:23:00', 'fr', '2021-01-12', '3c33d97e92ac0256e6dd82728023b9f97ee6e004.jpg', 0, '', 'https://www.youtube.com/watch?v=eHCAgSuLog4', 3.86, 75, '2000'),
(44, 'Joker ', 'Todd Phillips', '02:02:00', 'fr', '2019-10-04', '485918db5867482e49cf2b7f1dc9f90f7f41afd5.jpg', 0, '', 'https://www.youtube.com/watch?v=RumjcP_9vuo', 4.8, 82, '2000'),
(45, 'Le tigre blanc ', 'Ramin Bahrani', '02:11:00', 'fr', '2021-01-13', 'e36a3b624cea7b02ff9f76d490ed996447e6e554.jpg', 0, '', 'https://www.youtube.com/watch?v=CEimecAA5eE', 1.3, 59, '750');

-- --------------------------------------------------------

--
-- Table structure for table `film_categorie`
--

CREATE TABLE `film_categorie` (
  `films_id` int(10) UNSIGNED NOT NULL,
  `categorie_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `film_categorie`
--

INSERT INTO `film_categorie` (`films_id`, `categorie_id`) VALUES
(18, 3),
(25, 3),
(26, 3),
(29, 3),
(30, 3),
(31, 3),
(34, 3),
(36, 3),
(43, 3),
(31, 6),
(34, 6),
(44, 6),
(45, 6),
(35, 7),
(33, 8),
(18, 14),
(25, 14),
(26, 14),
(36, 14),
(32, 15),
(35, 15),
(43, 15),
(29, 16),
(30, 16),
(43, 16),
(32, 17),
(31, 18),
(43, 18),
(44, 18),
(34, 19),
(37, 19),
(32, 20),
(32, 21),
(33, 21),
(35, 21),
(43, 21),
(25, 22),
(26, 22),
(29, 22),
(30, 22),
(31, 22),
(36, 22),
(44, 22),
(34, 23),
(37, 23);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_membre` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `paiements_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `id_membre`, `created_at`, `paiements_id`) VALUES
(14, 16, '2021-02-01 21:50:19', 22),
(21, 13, '2021-02-01 23:29:14', 29),
(22, 13, '2021-02-01 23:32:01', 30),
(23, 35, '2021-02-02 12:27:09', 31);

-- --------------------------------------------------------

--
-- Table structure for table `membres`
--

CREATE TABLE `membres` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `courriel` varchar(75) NOT NULL,
  `sexe` enum('M','F') NOT NULL,
  `date_de_naissance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membres`
--

INSERT INTO `membres` (`id`, `nom`, `prenom`, `courriel`, `sexe`, `date_de_naissance`) VALUES
(13, 'Derbali', 'Fahmi', 'admin@dfilms.com', 'M', '2020-08-03'),
(14, 'Derbali', 'Fahmi', 'fderbali@dfilms.com', 'M', '2020-05-04'),
(16, 'Derbali', 'Fahmi', 'derbali@dfilm.com', 'M', '2021-01-19'),
(17, 'Derbali', 'Fahmi', 'fahmiderbali@dfilms.com', 'M', '2020-09-27'),
(35, 'Fahmi', 'Derbali', 'fahmi@dfilm.com', 'M', '2020-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(10) UNSIGNED NOT NULL,
  `courriel` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `courriel`) VALUES
(3, 'fderbali@dfilm.com'),
(4, 'fderbali@dfilm.com'),
(5, 'fderbali@dfilm.com'),
(6, 'fderbali@softvoyage.com'),
(7, 'sihem@dfilm.com'),
(8, 'fahmi@dfilm.com');

-- --------------------------------------------------------

--
-- Table structure for table `paiements`
--

CREATE TABLE `paiements` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_membre` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `montant` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paiements`
--

INSERT INTO `paiements` (`id`, `id_membre`, `created_at`, `montant`) VALUES
(1, 16, '2021-02-01 21:19:41', 5.1),
(2, 16, '2021-02-01 21:20:48', 5.1),
(3, 16, '2021-02-01 21:21:25', 5.1),
(4, 16, '2021-02-01 21:21:46', 5.1),
(5, 16, '2021-02-01 21:23:22', 9.25),
(6, 16, '2021-02-01 21:25:35', 9.25),
(7, 16, '2021-02-01 21:25:56', 9.25),
(8, 16, '2021-02-01 21:26:58', 9.25),
(9, 16, '2021-02-01 21:27:32', 9.25),
(10, 16, '2021-02-01 21:28:57', 9.25),
(11, 16, '2021-02-01 21:44:48', 9.25),
(12, 16, '2021-02-01 21:46:01', 9.25),
(13, 16, '2021-02-01 21:46:24', 9.25),
(14, 16, '2021-02-01 21:46:59', 9.25),
(15, 16, '2021-02-01 21:47:25', 9.25),
(16, 16, '2021-02-01 21:47:49', 9.25),
(17, 16, '2021-02-01 21:48:08', 9.25),
(18, 16, '2021-02-01 21:48:34', 9.25),
(19, 16, '2021-02-01 21:49:05', 9.25),
(20, 16, '2021-02-01 21:49:29', 9.25),
(21, 16, '2021-02-01 21:49:57', 9.25),
(22, 16, '2021-02-01 21:50:19', 9.25),
(23, 16, '2021-02-01 22:33:42', 7.57),
(26, 16, '2021-02-01 22:39:40', 1.68),
(27, 16, '2021-02-01 22:39:58', 1.68),
(28, 16, '2021-02-01 22:40:10', 0),
(29, 13, '2021-02-01 23:29:14', 0),
(30, 13, '2021-02-01 23:32:01', 3.25),
(31, 35, '2021-02-02 12:27:09', 5.21);

-- --------------------------------------------------------

--
-- Table structure for table `paniers`
--

CREATE TABLE `paniers` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_membre` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `connexions`
--
ALTER TABLE `connexions`
  ADD UNIQUE KEY `courriel_UNIQUE` (`courriel`);

--
-- Indexes for table `detail_location`
--
ALTER TABLE `detail_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_datails_location_locations_idx` (`id_location`),
  ADD KEY `fk_datails_location_films1_idx` (`id_film`);

--
-- Indexes for table `detail_panier`
--
ALTER TABLE `detail_panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_details_panier_panier1_idx` (`id_panier`),
  ADD KEY `fk_details_panier_films1_idx` (`id_film`);

--
-- Indexes for table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `film_categorie`
--
ALTER TABLE `film_categorie`
  ADD PRIMARY KEY (`films_id`,`categorie_id`),
  ADD KEY `fk_films_has_categorie_categorie1_idx` (`categorie_id`),
  ADD KEY `fk_films_has_categorie_films1_idx` (`films_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_locations_membres1_idx` (`id_membre`),
  ADD KEY `fk_locations_paiements1_idx` (`paiements_id`);

--
-- Indexes for table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courriel_UNIQUE` (`courriel`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paiements`
--
ALTER TABLE `paiements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_paiements_membres1_idx` (`id_membre`);

--
-- Indexes for table `paniers`
--
ALTER TABLE `paniers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_panier_membres1_idx` (`id_membre`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `detail_location`
--
ALTER TABLE `detail_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `detail_panier`
--
ALTER TABLE `detail_panier`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `films`
--
ALTER TABLE `films`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `paiements`
--
ALTER TABLE `paiements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `paniers`
--
ALTER TABLE `paniers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_location`
--
ALTER TABLE `detail_location`
  ADD CONSTRAINT `fk_datails_location_films1` FOREIGN KEY (`id_film`) REFERENCES `films` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_datails_location_locations` FOREIGN KEY (`id_location`) REFERENCES `locations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detail_panier`
--
ALTER TABLE `detail_panier`
  ADD CONSTRAINT `fk_details_panier_films1` FOREIGN KEY (`id_film`) REFERENCES `films` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_details_panier_panier1` FOREIGN KEY (`id_panier`) REFERENCES `paniers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `film_categorie`
--
ALTER TABLE `film_categorie`
  ADD CONSTRAINT `fk_films_has_categorie_categorie1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_films_has_categorie_films1` FOREIGN KEY (`films_id`) REFERENCES `films` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `fk_locations_membres1` FOREIGN KEY (`id_membre`) REFERENCES `membres` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_locations_paiements1` FOREIGN KEY (`paiements_id`) REFERENCES `paiements` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `paiements`
--
ALTER TABLE `paiements`
  ADD CONSTRAINT `fk_paiements_membres1` FOREIGN KEY (`id_membre`) REFERENCES `membres` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `paniers`
--
ALTER TABLE `paniers`
  ADD CONSTRAINT `fk_panier_membres1` FOREIGN KEY (`id_membre`) REFERENCES `membres` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
