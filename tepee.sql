-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 12 juil. 2021 à 12:48
-- Version du serveur :  8.0.25-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tepee`
--

-- --------------------------------------------------------

--
-- Structure de la table `courses`
--

CREATE TABLE `courses` (
  `id` int NOT NULL,
  `titre` varchar(999) NOT NULL,
  `categorie` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(999) NOT NULL,
  `difficulte` varchar(999) NOT NULL,
  `nb_chap` int NOT NULL,
  `duree` int NOT NULL,
  `id_ens` int NOT NULL,
  `url_cours` varchar(999) NOT NULL,
  `url_image` varchar(999) NOT NULL,
  `est_en_ligne` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `courses`
--

INSERT INTO `courses` (`id`, `titre`, `categorie`, `description`, `difficulte`, `nb_chap`, `duree`, `id_ens`, `url_cours`, `url_image`, `est_en_ligne`) VALUES
(1, 'Animez vos réseaux sociaux', 'informatique', 'Vous rêvez d\'apprendre à créer des sites web ? Débutez avec ce cours qui vous enseignera tout ce qu\'il faut savoir sur le développement de sites web en HTML5 et CSS3 !', 'moyen', 2, 5, 1, '/cours/1/Animez_vos_réseaux_sociaux.php', '/var/www/Tepee.com/html/cours/1/', 0),
(2, 'test', 'marketing', 'test', 'facile', 2, 5, 2, '/cours/2/test.php', '/var/www/Tepee.com/html/cours/2/', 0),
(3, 'yacien', 'informatique', 'test', 'facile', 2, 2, 3, '/cours/3/yacien.php', '/var/www/Tepee.com/html/cours/3/', 0),
(4, 'un cours', 'marketing', 'ceci est un cours de marketing', 'moyen', 2, 2, 4, '/cours/4/un_cours.php', '/var/www/Tepee.com/html/cours/4/', 0);

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id_ens` int NOT NULL,
  `nom_ens` varchar(24) NOT NULL,
  `prenom_ens` varchar(24) NOT NULL,
  `email_ens` varchar(100) NOT NULL,
  `mdp_ens` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id_ens`, `nom_ens`, `prenom_ens`, `email_ens`, `mdp_ens`) VALUES
(1, 'ould amara', 'amine', 'ouldamaraamine@gmail.com', '$2y$10$VB81pZDbncNgY/7OdGhpeeTUIusPpQXrNeWC7uU3Vwar8VsniIfiK'),
(2, 'massi', 'rahem', 'massirahem@gmail.com', '$2y$10$MeoA4OblhOzkXaqv3O08puKs38SHaqSLayzhP98Z9AloGG3Grp4bu'),
(3, 'yacine', 'khorssi', 'yacine@gmail.com', '$2y$10$y8h8FLLoylL4ayLqrzZrv.cAPs1S90nvirYoD6MILwPizWrCrThUW'),
(4, 'test', 'test', 'test@test.com', '$2y$10$D9N87ZMjgCcT79tps.XZBuK9k2AbmLVWyKDmysbpmbNqCMx7lHXIO');

-- --------------------------------------------------------

--
-- Structure de la table `enseignant_cours`
--

CREATE TABLE `enseignant_cours` (
  `id_ens` int NOT NULL,
  `id_cours` int NOT NULL,
  `date_creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `enseignant_cours`
--

INSERT INTO `enseignant_cours` (`id_ens`, `id_cours`, `date_creation`) VALUES
(1, 1, '2021-07-12'),
(2, 2, '2021-07-12'),
(3, 3, '2021-07-12'),
(4, 4, '2021-07-12');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etd` int NOT NULL,
  `nom_etd` varchar(24) NOT NULL,
  `prenom_etd` varchar(24) NOT NULL,
  `email_etd` varchar(100) NOT NULL,
  `mdp_etd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etd`, `nom_etd`, `prenom_etd`, `email_etd`, `mdp_etd`) VALUES
(1, 'amine', 'oa', 'oaaamine@gmail.com', '$2y$10$uF3D3QAgQ7v.BVWH.YMuQumWzlFyG1Rz8fvuT0JZmzM7Kz9inmBPe'),
(2, 'amine', 'amine', 'amine@gmail.com', '$2y$10$Jq7hKJss8sQ0tq9iGINs7.Hx8hwdd8GfkRYioqZEDq4R8pxXF66qS');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant_cours`
--

CREATE TABLE `etudiant_cours` (
  `id_etd` int NOT NULL,
  `id_cours` int NOT NULL,
  `date_inscription` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `etudiant_cours`
--

INSERT INTO `etudiant_cours` (`id_etd`, `id_cours`, `date_inscription`) VALUES
(1, 3, '2021-07-12'),
(2, 3, '2021-07-12');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id_ens`);

--
-- Index pour la table `enseignant_cours`
--
ALTER TABLE `enseignant_cours`
  ADD PRIMARY KEY (`id_ens`,`id_cours`),
  ADD KEY `ens_cours_foreign` (`id_cours`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etd`),
  ADD UNIQUE KEY `email_etd` (`email_etd`);

--
-- Index pour la table `etudiant_cours`
--
ALTER TABLE `etudiant_cours`
  ADD PRIMARY KEY (`id_etd`,`id_cours`),
  ADD KEY `id_cours_foreign` (`id_cours`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id_ens` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id_etd` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
