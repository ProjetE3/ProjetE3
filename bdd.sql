-- |  ||
-- || |_

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
--
-- Base de données: `HestiaDB`
--
DROP DATABASE IF EXISTS HestiaDB;
CREATE DATABASE HestiaDB;
USE HestiaDB;


-- Drop Table Section-----------------------------------------


DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS Maison;
DROP TABLE IF EXISTS Pièce;
DROP TABLE IF EXISTS Electroménager;
DROP TABLE IF EXISTS Lumière;
DROP TABLE IF EXISTS Chauffage;
DROP TABLE IF EXISTS Energie;
DROP TABLE IF EXISTS Minuteur;


-- Tables Structure Section-----------------------------------------


-- Maison
CREATE TABLE Maison(
  IdMaison smallint AUTO_INCREMENT,
  Surface smallint UNSIGNED NOT NULL,
  PRIMARY KEY (IdMaison)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Utilisateur
CREATE TABLE Utilisateur(
  Identifiant varchar(16) NOT NULL,
  Mdp varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  ScoreUtil tinyint(1) UNSIGNED DEFAULT 50 NOT NULL,
  IdMaison smallint NOT NULL,
  PRIMARY KEY (Identifiant),
  FOREIGN KEY (IdMaison) REFERENCES Maison (IdMaison) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Pièce
CREATE TABLE Pièce(
  IdPièce smallint AUTO_INCREMENT,
  NomPièce varchar(16) NOT NULL,
  Surface smallint UNSIGNED NOT NULL,
  TempPièce tinyint DEFAULT 0 NOT NULL,
  ScorePièce tinyint UNSIGNED DEFAULT 50 NOT NULL,
  IdMaison smallint NOT NULL,
  PRIMARY KEY (IdPièce),
  FOREIGN KEY (IdMaison) REFERENCES Maison (IdMaison) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Minuteur
CREATE TABLE Minuteur (
  IdMinuteur smallint AUTO_INCREMENT,
  HeureDeb TIME DEFAULT '000000' NOT NULL,
  HeureFin TIME DEFAULT '000000' NOT NULL,
  PRIMARY KEY (IdMinuteur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Electroménager
CREATE TABLE Electroménager (
  IdElectro smallint AUTO_INCREMENT,
  NomElectro char(16) NOT NULL,
  Etat tinyint DEFAULT 0 NOT NULL,
  IdPièce smallint NOT NULL,
  IdMinuteur smallint,
  PRIMARY KEY (IdElectro),
  FOREIGN KEY (IdPièce) REFERENCES Pièce (IdPièce),
  FOREIGN KEY (IdMinuteur) REFERENCES Minuteur (IdMinuteur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Lumière
CREATE TABLE Lumière (
  IdLumière smallint AUTO_INCREMENT,
  Etat tinyint DEFAULT 0 NOT NULL,
  IdPièce smallint NOT NULL,
  IdMinuteur smallint,
  PRIMARY KEY (IdLumière),
  FOREIGN KEY (IdPièce) REFERENCES Pièce (IdPièce),
  FOREIGN KEY (IdMinuteur) REFERENCES Minuteur (IdMinuteur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Chauffage
CREATE TABLE Chauffage (
  IdChauffage smallint AUTO_INCREMENT,
  TempChauff tinyint DEFAULT 15 NOT NULL,
  TempExt tinyint DEFAULT 0 NOT NULL,
  Etat tinyint DEFAULT 0 NOT NULL,
  IdPièce smallint NOT NULL,
  IdMinuteur smallint,
  PRIMARY KEY (IdChauffage),
  FOREIGN KEY (IdPièce) REFERENCES Pièce (IdPièce),
  FOREIGN KEY (IdMinuteur) REFERENCES Minuteur (IdMinuteur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Energie
CREATE TABLE Energie (
  EnerCons smallint UNSIGNED DEFAULT 0 NOT NULL,
  DateHeureMinute DATETIME DEFAULT CURRENT_TIMESTAMP() NOT NULL,
  IdLumière smallint,
  IdChauffage smallint,
  IdElectro smallint,
  FOREIGN KEY (IdLumière) REFERENCES Lumière (IdLumière),
  FOREIGN KEY (IdChauffage) REFERENCES Chauffage (Chauffage),
  FOREIGN KEY (IdElectro) REFERENCES Electroménager (IdElectro)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- Données Maison defaut------------------------------------------------

INSERT INTO Maison (Surface) VALUES
  (100);
  
INSERT INTO Utilisateur (Identifiant, Mdp, IdMaison) VALUES
  ('admin','admin',0);

INSERT INTO Pièce (NomPièce, Surface, IdMaison) VALUES
  (Salon, 50, 0),
  (Chambre, 25, 0),
  (Cuisine, 25, 0);

--INSERT INTO Electroménager (IdElectro, IdPièce) VALUES

INSERT INTO Lumière (IdPièce) VALUES
  (0),
  (1),
  (2);

INSERT INTO Chauffage (IdPièce) VALUES
  (0),
  (1),
  (2);
