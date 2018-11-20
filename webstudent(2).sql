-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 20 nov. 2018 à 11:00
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `webstudent`
--

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

DROP TABLE IF EXISTS `competences`;
CREATE TABLE IF NOT EXISTS `competences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_etudiants_max` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `competences`
--

INSERT INTO `competences` (`id`, `code`, `libelle`, `nb_etudiants_max`) VALUES
(1, 0, 'Potiens', 12),
(2, 0, 'Potiens', 12);

-- --------------------------------------------------------

--
-- Structure de la table `competences_professeur`
--

DROP TABLE IF EXISTS `competences_professeur`;
CREATE TABLE IF NOT EXISTS `competences_professeur` (
  `competences_id` int(11) NOT NULL,
  `professeur_id` int(11) NOT NULL,
  PRIMARY KEY (`competences_id`,`professeur_id`),
  KEY `IDX_4A22D39FA660B158` (`competences_id`),
  KEY `IDX_4A22D39FBAB22EE9` (`professeur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `competences_professeur`
--

INSERT INTO `competences_professeur` (`competences_id`, `professeur_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `maison_id` int(11) DEFAULT NULL,
  `rue` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numrue` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copos` int(11) DEFAULT NULL,
  `surnom` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_717E22E39D67D8AF` (`maison_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id`, `nom`, `prenom`, `ville`, `date_naissance`, `maison_id`, `rue`, `numrue`, `copos`, `surnom`) VALUES
(1, 'Potter', 'Harry', 'Surrey', '1980-05-12', 1, '45', 'se', 50260, 'le ballafret'),
(2, 'Ranger', 'Hermione', 'Surrey', '1900-01-01', 1, 'dd', '1', 5620, 'momone'),
(3, 'Wisley', 'Ronald', '', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Malfoy', 'Drago', '', NULL, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `maison`
--

DROP TABLE IF EXISTS `maison`;
CREATE TABLE IF NOT EXISTS `maison` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `maison`
--

INSERT INTO `maison` (`id`, `code`, `libelle`) VALUES
(1, 'GFD', 'Griffondor'),
(2, 'SPT', 'Serpentard');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20181106065738'),
('20181113083251'),
('20181113085742'),
('20181113095230'),
('20181113095630'),
('20181113102129'),
('20181113110142');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etudiant_id` int(11) DEFAULT NULL,
  `competence_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CFBDFA14DDEAB1A3` (`etudiant_id`),
  KEY `IDX_CFBDFA1415761DAB` (`competence_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_naiss` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`id`, `nom`, `prenom`, `date_naiss`) VALUES
(1, 'prof1', NULL, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `competences_professeur`
--
ALTER TABLE `competences_professeur`
  ADD CONSTRAINT `FK_4A22D39FA660B158` FOREIGN KEY (`competences_id`) REFERENCES `competences` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4A22D39FBAB22EE9` FOREIGN KEY (`professeur_id`) REFERENCES `professeur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `FK_717E22E39D67D8AF` FOREIGN KEY (`maison_id`) REFERENCES `maison` (`id`);

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `FK_CFBDFA1415761DAB` FOREIGN KEY (`competence_id`) REFERENCES `competences` (`id`),
  ADD CONSTRAINT `FK_CFBDFA14DDEAB1A3` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiant` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
