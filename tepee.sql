-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 21, 2021 at 10:13 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tepee`
--

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

CREATE TABLE `cours` (
  `id_cours` int(11) NOT NULL,
  `nom_cours` varchar(70) NOT NULL,
  `cat_cours` varchar(100) NOT NULL,
  `desc_cours` varchar(250) NOT NULL,
  `duree_cours` int(11) NOT NULL,
  `difficulte_cours` int(11) NOT NULL,
  `id_ens` int(11) NOT NULL,
  `url_cours` varchar(200) NOT NULL,
  `url_img_cours` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cours`
--

INSERT INTO `cours` (`id_cours`, `nom_cours`, `cat_cours`, `desc_cours`, `duree_cours`, `difficulte_cours`, `id_ens`, `url_cours`, `url_img_cours`) VALUES
(1, 'Apprenez à créer votre site web avec HTML5 et CSS3', 'informatique', 'Vous rêvez d\'apprendre à créer des sites web ? Débutez avec ce cours qui vous enseignera tout ce qu\'il faut savoir sur le développement de sites web en HTML5 et CSS3 !', 6, 2, 1, '/Apprenez_à_créer_votre_site_web_avec_HTML5_et_CSS3.php', 'html_css.jfif'),
(2, 'Animez vos réseaux sociaux', 'business', 'Endossez le rôle multifacette du community manager : apprenez à appliquer une stratégie social media, à créer des contenus variés, à gérer la modération sur les plateformes et à atteindre vos objec...', 10, 1, 4, '/Animez_vos_réseaux_sociaux.php', 'reseaux_sociaux.jfif'),
(3, 'Initiez-vous au marketing digital', 'marketing', 'Le marketing digital offre un arsenal d’outils et de techniques permettant de mener des actions toujours plus personnalisées, dont la performance est mesurable et donc améliorable.', 5, 1, 8, '/Initiez-vous_au_marketing_digital.php', 'marketing.jpg'),
(5, 'Concevez votre site web avec PHP et MySQL', 'informatique', 'PHP est un langage de création de sites web dynamiques très populaire. Son rôle est de générer des pages web HTML. Il permet de créer des blogs, des forums, des espaces membres... Facebook et Wikip...', 3, 1, 9, '/Concevez_votre_site_web_avec_PHP_et_MySQL.php', 'php.jfif'),
(100, 'test', 'test', 'test', 2, 2, 3, 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

CREATE TABLE `enseignant` (
  `id_ens` int(11) NOT NULL,
  `nom_ens` varchar(24) NOT NULL,
  `prenom_ens` varchar(24) NOT NULL,
  `email_ens` varchar(100) NOT NULL,
  `mdp_ens` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`id_ens`, `nom_ens`, `prenom_ens`, `email_ens`, `mdp_ens`) VALUES
(1, 'j', 'j', 'j@j', '363b122c528f54df4a0446b6bab05515'),
(2, 'ould', 'amine', 'aaa@defe.com', '0cc175b9c0f1b6a831c399e269772661'),
(3, 'hy', 'hy', 'hy@hy', '035ed2311b96d2a65ec6a6fe71046c14');

-- --------------------------------------------------------

--
-- Table structure for table `enseignant_cours`
--

CREATE TABLE `enseignant_cours` (
  `id_ens` int(11) NOT NULL,
  `id_cours` int(11) NOT NULL,
  `date_creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enseignant_cours`
--

INSERT INTO `enseignant_cours` (`id_ens`, `id_cours`, `date_creation`) VALUES
(1, 1, '2021-04-20'),
(1, 2, '2021-04-20'),
(3, 100, '2021-04-15');

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etd` int(11) NOT NULL,
  `nom_etd` varchar(24) NOT NULL,
  `prenom_etd` varchar(24) NOT NULL,
  `email_etd` varchar(100) NOT NULL,
  `mdp_etd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`id_etd`, `nom_etd`, `prenom_etd`, `email_etd`, `mdp_etd`) VALUES
(1, 'a', 'a', 'ouldamaraamine@gmailcom', '0cc175b9c0f1b6a831c399e269772661'),
(2, 'larroum', 'amine', 'larroum@gmail.com', '30d2310007b75bf0180f5ed831f20fdb'),
(3, 'ghanine', 'amayas', 'amayas@gmail.com', '19df62102aae7e47137d8dd711b7be31'),
(5, 'b', 'b', 'b@b', '92eb5ffee6ae2fec3ad71c777531578f'),
(6, 't', 't', 't@t', 'e358efa489f58062f10dd7316b65649e'),
(7, 'y', 'y', 'y@y', '415290769594460e2e485922904f345d'),
(8, 'ggg', 'ggg', 'gg@gg', '73c18c59a39b18382081ec00bb456d43'),
(12, 'a', 'a', 'a@a', '0cc175b9c0f1b6a831c399e269772661'),
(13, 'fff', 'fff', 'fff@fff', '343d9040a671c45832ee5381860e2996'),
(14, 'dz', 'dz', 'dz@dz', '0de7b6a61a70688b26e6eeb3113531a3'),
(15, 'i', 'i', 'i@i', '865c0c0b4ab0e063e5caa3387c1a8741');

-- --------------------------------------------------------

--
-- Table structure for table `etudiant_cours`
--

CREATE TABLE `etudiant_cours` (
  `id_etd` int(11) NOT NULL,
  `id_cours` int(11) NOT NULL,
  `date_inscription` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `etudiant_cours`
--

INSERT INTO `etudiant_cours` (`id_etd`, `id_cours`, `date_inscription`) VALUES
(1, 1, '2021-04-21'),
(1, 3, '2021-04-21'),
(1, 5, '2021-04-21'),
(3, 100, '2021-04-15'),
(13, 1, '2021-04-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id_cours`),
  ADD UNIQUE KEY `url_cours` (`url_cours`);

--
-- Indexes for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id_ens`);

--
-- Indexes for table `enseignant_cours`
--
ALTER TABLE `enseignant_cours`
  ADD PRIMARY KEY (`id_ens`,`id_cours`),
  ADD KEY `ens_cours_foreign` (`id_cours`);

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etd`),
  ADD UNIQUE KEY `email_etd` (`email_etd`);

--
-- Indexes for table `etudiant_cours`
--
ALTER TABLE `etudiant_cours`
  ADD PRIMARY KEY (`id_etd`,`id_cours`),
  ADD KEY `id_cours_foreign` (`id_cours`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id_ens` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id_etd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enseignant_cours`
--
ALTER TABLE `enseignant_cours`
  ADD CONSTRAINT `ens_cours_foreign` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`),
  ADD CONSTRAINT `ens_cours_foreign_2` FOREIGN KEY (`id_ens`) REFERENCES `enseignant` (`id_ens`);

--
-- Constraints for table `etudiant_cours`
--
ALTER TABLE `etudiant_cours`
  ADD CONSTRAINT `id_cours_foreign` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`),
  ADD CONSTRAINT `id_etd_foreign` FOREIGN KEY (`id_etd`) REFERENCES `etudiant` (`id_etd`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
