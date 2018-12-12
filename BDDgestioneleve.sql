-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 21 Novembre 2018 à 12:59
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestioneleve`
--

-- CREATE DATABASE gestioneleve;
-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

CREATE TABLE `absence` (
  `id_absence` int(11) NOT NULL,
  `ine` varchar(13) NOT NULL,
  `id_cours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id_administrateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `administratif`
--

CREATE TABLE `administratif` (
  `id_administratif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id_prof` int(11) NOT NULL,
  `id_cours` int(11) NOT NULL,
  `id_matiere` int(11) NOT NULL,
  `numero_salle` varchar(30) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `horaire_debut` date DEFAULT NULL,
  `horaire_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id_departement` int(11) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `ine` varchar(13) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `id_filiere` int(11) NOT NULL,
  `id_departement` int(11) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `groupe_etudiant`
--

CREATE TABLE `groupe_etudiant` (
  `id_groupe` int(11) NOT NULL,
  `id_filiere` int(11) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `id_matiere` int(11) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

CREATE TABLE `personnel` (
  `numeropersonnel` int(11) NOT NULL,
  `identifiant` varchar(30) NOT NULL,
  `mdp` varchar(256) DEFAULT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `id_professeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `numero` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `absence`
--
ALTER TABLE `absence`
  ADD PRIMARY KEY (`id_absence`);

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id_administrateur`);

--
-- Index pour la table `administratif`
--
ALTER TABLE `administratif`
  ADD PRIMARY KEY (`id_administratif`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id_cours`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id_departement`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`ine`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id_filiere`);

--
-- Index pour la table `groupe_etudiant`
--
ALTER TABLE `groupe_etudiant`
  ADD PRIMARY KEY (`id_groupe`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id_matiere`);

--
-- Index pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`numeropersonnel`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`id_professeur`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`numero`);

--
-- Contraintes pour les tables exportées
--

ALTER TABLE `personnel`
  MODIFY `numeropersonnel` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `groupe_etudiant`
  MODIFY `id_groupe` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `absence`
  MODIFY `id_absence` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `filiere`
  MODIFY `id_filiere` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `departement`
  MODIFY `id_departement` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `cours`
  MODIFY `id_cours` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `matiere`
  MODIFY `id_matiere` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD CONSTRAINT `fk_prof_personnel` FOREIGN KEY (`id_professeur`) REFERENCES `personnel` (`numeropersonnel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `absence`
--
ALTER TABLE `absence`
  ADD CONSTRAINT `absence_cours_fk` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`),
  ADD CONSTRAINT `absence_etudiant_fk` FOREIGN KEY (`ine`) REFERENCES `etudiant` (`ine`);

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `fk_Administrateur_personnel` FOREIGN KEY (`id_administrateur`) REFERENCES `personnel` (`numeropersonnel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `administratif`
--
ALTER TABLE `administratif`
  ADD CONSTRAINT `fk_Administratif_personnel` FOREIGN KEY (`id_administratif`) REFERENCES `personnel` (`numeropersonnel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_groupe_etudiant_fk` FOREIGN KEY (`id_groupe`) REFERENCES `groupe_etudiant` (`id_groupe`),
  ADD CONSTRAINT `cours_matiere_fk` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`),
  ADD CONSTRAINT `cours_salle_fk` FOREIGN KEY (`numero_salle`) REFERENCES `salle` (`numero`),
  ADD CONSTRAINT `cours_prof_fk` FOREIGN KEY (`id_prof`) REFERENCES `professeur` (`id_professeur`);

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_groupe_etudiant_fk` FOREIGN KEY (`id_groupe`) REFERENCES `groupe_etudiant` (`id_groupe`);

--
-- Contraintes pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `filiere_departement_fk` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id_departement`);

--
-- Contraintes pour la table `groupe_etudiant`
--
ALTER TABLE `groupe_etudiant`
  ADD CONSTRAINT `groupe_etudiant_filiere_fk` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id_filiere`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
