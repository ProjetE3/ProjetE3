-- |  ||
-- || |_

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
--
-- Base de donnees: `HestiaDB`
--
DROP DATABASE IF EXISTS HestiaDB;
CREATE DATABASE HestiaDB;
USE HestiaDB;


-- Drop Table Section-----------------------------------------


DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS Maison;
DROP TABLE IF EXISTS Piece;
DROP TABLE IF EXISTS Electromenager;
DROP TABLE IF EXISTS Lumiere;
DROP TABLE IF EXISTS Chauffage;
DROP TABLE IF EXISTS Energie;
DROP TABLE IF EXISTS Minuteur;
DROP TABLE IF EXISTS Scores;


-- Tables Structure Section-----------------------------------------


-- Maison
CREATE TABLE Maison(
  IdMaison smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  Surface smallint UNSIGNED NOT NULL,
  TempExt tinyint DEFAULT 0 NOT NULL,
  PRIMARY KEY (IdMaison)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Utilisateur
CREATE TABLE Utilisateur(
  Identifiant varchar(16) NOT NULL,
  Mdp varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  IdMaison smallint UNSIGNED NOT NULL,
  ScoreUtil  INT UNSIGNED DEFAULT 0 NOT NULL,
  PRIMARY KEY (Identifiant),
  FOREIGN KEY (IdMaison) REFERENCES Maison (IdMaison) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Piece
CREATE TABLE Piece(
  IdPiece smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  NomPiece varchar(16) NOT NULL,
  Surface smallint UNSIGNED NOT NULL,
  TempPiece tinyint DEFAULT 0 NOT NULL,
  IdMaison smallint UNSIGNED NOT NULL,
  PRIMARY KEY (IdPiece),
  FOREIGN KEY (IdMaison) REFERENCES Maison (IdMaison) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Minuteur
CREATE TABLE Minuteur (
  IdMinuteur smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  HeureDeb TIME DEFAULT '000000' NOT NULL,
  HeureFin TIME DEFAULT '000000' NOT NULL,
  PRIMARY KEY (IdMinuteur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Electromenager
CREATE TABLE Electromenager (
  IdElectro smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  NomElectro char(16) NOT NULL,
  Etat tinyint DEFAULT 0 NOT NULL,
  IdPiece smallint UNSIGNED NOT NULL,
  IdMinuteur smallint UNSIGNED,
  PRIMARY KEY (IdElectro),
  FOREIGN KEY (IdPiece) REFERENCES Piece (IdPiece),
  FOREIGN KEY (IdMinuteur) REFERENCES Minuteur (IdMinuteur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Lumiere
CREATE TABLE Lumiere (
  IdLumiere smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  Etat tinyint DEFAULT 0 NOT NULL,
  IdPiece smallint UNSIGNED NOT NULL,
  IdMinuteur smallint UNSIGNED,
  PRIMARY KEY (IdLumiere),
  FOREIGN KEY (IdPiece) REFERENCES Piece (IdPiece),
  FOREIGN KEY (IdMinuteur) REFERENCES Minuteur (IdMinuteur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Chauffage
CREATE TABLE Chauffage (
  IdChauffage smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  TempChauff tinyint DEFAULT 15 NOT NULL,
  Etat tinyint DEFAULT 0 NOT NULL,
  IdPiece smallint UNSIGNED NOT NULL,
  IdMinuteur smallint UNSIGNED,
  PRIMARY KEY (IdChauffage),
  FOREIGN KEY (IdPiece) REFERENCES Piece (IdPiece),
  FOREIGN KEY (IdMinuteur) REFERENCES Minuteur (IdMinuteur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Energie
CREATE TABLE Energie (
  IdEner INT UNSIGNED NOT NULL AUTO_INCREMENT,
  EnerCons FLOAT(8,8) UNSIGNED DEFAULT 0 NOT NULL,
  DateHeureMinute DATETIME DEFAULT CURRENT_TIMESTAMP() NOT NULL,
  IdLumiere smallint,
  IdChauffage smallint,
  IdElectro smallint,
  PRIMARY KEY (IdEner)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Scores
CREATE TABLE Scores (
  IdScore INT UNSIGNED NOT NULL AUTO_INCREMENT,
  Score INT UNSIGNED DEFAULT 50 NOT NULL,
  DateHeureMinute DATETIME DEFAULT CURRENT_TIMESTAMP() NOT NULL,
  IdUtil varchar(16) NOT NULL,
  IdPiece smallint UNSIGNED NOT NULL,
  IdMaison smallint UNSIGNED NOT NULL,
  PRIMARY KEY (IdScore),
  FOREIGN KEY (IdUtil) REFERENCES Utilisateur (Identifiant),
  FOREIGN KEY (IdPiece) REFERENCES Piece (IdPiece),
  FOREIGN KEY (IdMaison) REFERENCES Maison (IdMaison)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- EnergieStock

CREATE TABLE EnergieStock (
  DateHeureMinute DATETIME DEFAULT CURRENT_TIMESTAMP() NOT NULL,
  PRIMARY KEY (DateHeureMinute)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- Donnees Maison defaut------------------------------------------------

INSERT INTO Maison (Surface) VALUES
  (100);

INSERT INTO Utilisateur (Identifiant, Mdp, IdMaison) VALUES
  ('admin','admin',1);

INSERT INTO Piece (NomPiece, Surface, IdMaison) VALUES
  ('Salon', 50, 1),
  ('Chambre', 25, 1),
  ('Cuisine', 25, 1);

INSERT INTO Lumiere (IdPiece) VALUES
  (1),
  (2),
  (3);

INSERT INTO Chauffage (IdPiece) VALUES
  (1),
  (2),
  (3);
