SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Base de données :  gestioneleve


-- CREATE DATABASE gestioneleve;

-- --------------------------------------------------------

-- Structure de la table absence

-- CREATE TABLE absence (
--  id_absence int(11) NOT NULL AUTO_INCREMENT,
--  ine varchar(13) NOT NULL,
--  id_cours int(11) NOT NULL,
--  PRIMARY KEY (id_absence)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- Structure de la table administrateur

CREATE TABLE administrateur (
  id_administrateur int(11) NOT NULL,
  PRIMARY KEY (id_administrateur)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- Structure de la table administratif

CREATE TABLE administratif (
  id_administratif int(11) NOT NULL,
  id_filiere int(11) UNIQUE,
  PRIMARY KEY (id_administratif)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- Structure de la table cours

CREATE TABLE cours (
  id_matiere int(11) NOT NULL,
  id_groupe int(11) NOT NULL,
  id_professeur int(11) NOT NULL,
  numero_salle varchar(30) NOT NULL,
  heur_debut time NOT NULL,
  heur_fin time NOT NULL,
  PRIMARY KEY (id_matiere, id_groupe, id_professeur, numero_salle, heur_debut, heur_fin)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- Structure de la table departement

CREATE TABLE departement (
  id_departement int(11) NOT NULL AUTO_INCREMENT,
  libelle varchar(100) NOT NULL UNIQUE,
  PRIMARY KEY (id_departement)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- Structure de la table etudiant

CREATE TABLE etudiant (
  ine varchar(13) NOT NULL,
  id_groupe int(11) NOT NULL,
  nom varchar(30) DEFAULT NULL,
  prenom varchar(30) DEFAULT NULL,
  PRIMARY KEY (ine)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- Structure de la table filiere

CREATE TABLE filiere (
  id_filiere int(11) NOT NULL AUTO_INCREMENT,
  id_departement int(11) NOT NULL,
  libelle varchar(100) NOT NULL UNIQUE,
  PRIMARY KEY (id_filiere)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- Structure de la table groupe_etudiant

CREATE TABLE groupe_etudiant (
  id_groupe int(11) NOT NULL AUTO_INCREMENT,
  id_filiere int(11) NOT NULL,
  libelle varchar(100) NOT NULL UNIQUE,
  PRIMARY KEY (id_groupe)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- Structure de la table heur debut

CREATE TABLE heur_debut (
	heur_debut time NOT NULL,
	PRIMARY KEY (heur_debut)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- Structure de la table Localisation

CREATE TABLE heur_fin (
	heur_fin time NOT NULL,
	PRIMARY KEY (heur_fin)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Structure de la table matiere

CREATE TABLE matiere (
  id_matiere int(11) NOT NULL AUTO_INCREMENT,
  libelle varchar(100) NOT NULL UNIQUE,
  PRIMARY KEY (id_matiere)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- Structure de la table personnel

CREATE TABLE personnel (
  numeropersonnel int(11) NOT NULL AUTO_INCREMENT,
  identifiant varchar(60) NOT NULL UNIQUE,
  mdp varchar(256) DEFAULT NULL,
  nom varchar(30) DEFAULT NULL,
  prenom varchar(30) DEFAULT NULL,
  PRIMARY KEY (numeropersonnel)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- Structure de la table professeur

CREATE TABLE professeur (
  id_professeur int(11) NOT NULL,
  PRIMARY KEY (id_professeur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- Structure de la table salle

CREATE TABLE salle (
  numero_salle varchar(30) NOT NULL,
  PRIMARY KEY (numero_salle)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- --------------------------------------------------------
-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table absence
--
-- ALTER TABLE absence
--   ADD CONSTRAINT fk_absence_cours FOREIGN KEY (id_cours) REFERENCES cours (id_cours),
--   ADD CONSTRAINT fk_absence_etudiant FOREIGN KEY (ine) REFERENCES etudiant (ine);

--
-- Contraintes pour la table administrateur
--
ALTER TABLE administrateur
  ADD CONSTRAINT fk_Administrateur_personnel FOREIGN KEY (id_administrateur) REFERENCES personnel (numeropersonnel);

--
-- Contraintes pour la table administratif
--
ALTER TABLE administratif
  ADD CONSTRAINT fk_administratif_personnel FOREIGN KEY (id_administratif) REFERENCES personnel (numeropersonnel),
  ADD CONSTRAINT fk_administratif_filiere FOREIGN KEY (id_filiere) REFERENCES filiere (id_filiere);

--
-- Contraintes pour la table professeur
--
ALTER TABLE professeur
  ADD CONSTRAINT fk_prof_personnel FOREIGN KEY (id_professeur) REFERENCES personnel (numeropersonnel);

--
-- Contraintes pour la table cours
--
 ALTER TABLE cours
    ADD CONSTRAINT fk_cours_matiere FOREIGN KEY (id_matiere) REFERENCES matiere (id_matiere),
    ADD CONSTRAINT fk_cours_professeur FOREIGN KEY (id_professeur) REFERENCES professeur (id_professeur),
    ADD CONSTRAINT fk_cours_groupe FOREIGN KEY (id_groupe) REFERENCES groupe_etudiant (id_groupe),
    ADD CONSTRAINT fk_cours_numero_salle FOREIGN KEY (numero_salle) REFERENCES salle (numero_salle),
    ADD CONSTRAINT fk_cours_heur_fin FOREIGN KEY (heur_fin) REFERENCES heur_fin (heur_fin),
    ADD CONSTRAINT fk_cours_heur_debut FOREIGN KEY (heur_debut) REFERENCES heur_debut (heur_debut);

--
-- Contraintes pour la table etudiant
--
ALTER TABLE etudiant
  ADD CONSTRAINT fk_etudiant_groupe_etudiant FOREIGN KEY (id_groupe) REFERENCES groupe_etudiant (id_groupe);

--
-- Contraintes pour la table filiere
--
ALTER TABLE filiere
  ADD CONSTRAINT fk_filiere_departement FOREIGN KEY (id_departement) REFERENCES departement (id_departement);

--
-- Contraintes pour la table groupe_etudiant
--
ALTER TABLE groupe_etudiant
  ADD CONSTRAINT fk_groupe_etudiant_filiere FOREIGN KEY (id_filiere) REFERENCES filiere (id_filiere);
