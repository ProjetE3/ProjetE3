-- |  ||
-- || |_

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
--
-- Base de données: `HestiaDB`
--
CREATE DATABASE 'HestiaDB';
USE 'HestiaDB';


-- Drop Table Section-----------------------------------------


DROP TABLE IF EXISTS 'Utilisateur';
DROP TABLE IF EXISTS 'Maison';
DROP TABLE IF EXISTS 'Pièce';
DROP TABLE IF EXISTS 'Electroménager';
DROP TABLE IF EXISTS 'Lumière';
DROP TABLE IF EXISTS 'Chauffage';
DROP TABLE IF EXISTS 'Energie';
DROP TABLE IF EXISTS 'Minuteur';


-- Tables Structure Section-----------------------------------------


-- Utilisateur
CREATE TABLE 'Utilisateur'(
  'Identifiant' varchar(16) NOT NULL,
  'Mdp' varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  'ScoreUtil' tinyint(1) UNSIGNED DEFAULT '50' NOT NULL,
  'IdMaison' char(8) NOT NULL,
  PRIMARY KEY ('Identifiant'),
  FOREIGN KEY ('IdMaison') REFERENCES 'Maison' ('IdMaison') ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Maison
CREATE TABLE 'Maison'(
  'IdMaison' char(8) NOT NULL,
  'Surface' smallint(1) UNSIGNED NOT NULL,
  PRIMARY KEY ('IdMaison')
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Pièce
CREATE TABLE 'Pièce'(
  'IdPièce' char(8) NOT NULL,
  'NomPièce' varchar(16) NOT NULL,
  'Surface' smallint(1) UNSIGNED NOT NULL,
  'TempPièce' tinyint(1) DEFAULT '0' NOT NULL,
  'ScorePièce' tinyint(1) UNSIGNED DEFAULT '50' NOT NULL,
  'IdMaison' char(8) NOT NULL,
  PRIMARY KEY ('IdPièce'),
  FOREIGN KEY ('IdMaison') REFERENCES 'Maison' ('IdMaison') ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Electroménager
CREATE TABLE 'Electroménager' (
  'IdElectro' char(8) NOT NULL,
  'Etat' tinyint(1) DEFAULT '0' NOT NULL,
  'IdPièce' char(8) NOT NULL,
  'IdMinuteur' char(8),
  PRIMARY KEY ('IdElectro'),
  FOREIGN KEY ('IdPièce') REFERENCES 'Pièce' ('IdPièce'),
  FOREIGN KEY ('IdMinuteur') REFERENCES 'Minuteur' ('IdMinuteur')
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Lumière
CREATE TABLE 'Lumière' (
  'IdLumière' char(8) NOT NULL,
  'Etat' tinyint(1) DEFAULT '0' NOT NULL,
  'IdPièce' char(8) NOT NULL,
  'IdMinuteur' char(8),
  PRIMARY KEY ('IdLumière'),
  FOREIGN KEY ('IdPièce') REFERENCES 'Pièce' ('IdPièce'),
  FOREIGN KEY ('IdMinuteur') REFERENCES 'Minuteur' ('IdMinuteur')
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Chauffage
CREATE TABLE 'Chauffage' (
  'IdChauffage' char(8) NOT NULL,
  'TempChauff' tinyint(1) DEFAULT '15' NOT NULL,
  'TempExt' tinyint(1) DEFAULT '0' NOT NULL,
  'Etat' tinyint(1) DEFAULT '0' NOT NULL,
  'IdPièce' char(8) NOT NULL,
  'IdMinuteur' char(8),
  PRIMARY KEY ('IdChauffage'),
  FOREIGN KEY ('IdPièce') REFERENCES 'Pièce' ('IdPièce'),
  FOREIGN KEY ('IdMinuteur') REFERENCES 'Minuteur' ('IdMinuteur')
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Energie
CREATE TABLE 'Energie' (
  'EnerCons' smallint(1) UNSIGNED DEFAULT '0' NOT NULL,
  'DateHeureMinute' DATETIME DEFAULT CURRENT_TIMESTAMP() NOT NULL,
  'IdLumière' char(8),
  'IdChauffage' char(8),
  'IdElectro' char(8),
  FOREIGN KEY ('IdLumière') REFERENCES 'Lumière' ('IdLumière'),
  FOREIGN KEY ('IdChauffage') REFERENCES 'Chauffage' ('Chauffage'),
  FOREIGN KEY ('IdElectro') REFERENCES 'Electroménager' ('IdElectro')
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Minuteur
CREATE TABLE 'Minuteur' (
  'IdMinuteur' char(8) NOT NULL
  'HeureDeb' TIME DEFAULT '000000' NOT NULL,
  'HeureFin' TIME DEFAULT '000000' NOT NULL,
  PRIMARY KEY ('IdMinuteur')
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- Données Maison defaut------------------------------------------------

INSERT INTO 'Utilisateur' ('Identifiant', 'Mdp', 'IdMaison') VALUES
  ('admin','admin','00000000');

INSERT INTO 'Maison' ('IdMaison', 'Surface') VALUES
  ('00000000', '100');

INSERT INTO 'Pièce' ('IdPièce', 'NomPièce', 'Surface', 'IdMaison') VALUES
  ('00000000', 'Salon', '50', '00000000'),
  ('00000001', 'Chambre', '25', '00000000'),
  ('00000002', 'Cuisine', '25', '00000000');

--INSERT INTO 'Electroménager' ('IdElectro', 'IdPièce') VALUES

INSERT INTO 'Lumière' ('IdLumière', 'IdPièce') VALUES
  ('00000000','00000000'),
  ('00000001','00000001'),
  ('00000002','00000002');

INSERT INTO 'Chauffage' ('IdChauffage','IdPièce') VALUES
  ('00000000','00000000'),
  ('00000001','00000001'),
  ('00000002','00000002');
