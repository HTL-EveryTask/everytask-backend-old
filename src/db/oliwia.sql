DROP DATABASE IF EXISTS `db`;
CREATE DATABASE IF NOT EXISTS `db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db`;


CREATE TABLE IF NOT EXISTS `kunde` (
  `kartennummer` int(4) NOT NULL PRIMARY KEY,
  `vorname` varchar(30) NOT NULL,
  `nachname` varchar(50) NOT NULL,
  `strasse` varchar(150) NOT NULL,
  `plz` varchar(10) NOT NULL,
  `ort` varchar(80) NOT NULL,
  `telefonnummer` varchar(20) NOT NULL
);


CREATE TABLE IF NOT EXISTS `mitarbeiter` (
  `mitarbeiter_id` int NOT NULL PRIMARY KEY,
  `vorname` varchar(30) NOT NULL,
  `nachname` varchar(50) NOT NULL,
  `strasse` varchar(150) NOT NULL,
  `plz` varchar(10) NOT NULL,
  `ort` varchar(80) NOT NULL,
  `telefonnummer` varchar(20) NOT NULL
);



CREATE TABLE IF NOT EXISTS `buch` (
  `isbn` varchar(13) NOT NULL PRIMARY KEY,
  `fk_mitarbeiter_id` int,
  `beschreibung` varchar(100) NOT NULL,
  `titel` varchar(40) NOT NULL,
  `autor` varchar(40) NOT NULL,
  `kategorie` varchar(30) NOT NULL,
  `sprache` varchar(20) NOT NULL,
  `erscheinungsjahr` int(4) NOT NULL,
  `seiten` int NOT NULL,
  `lagernd` int NOT NULL,
   CONSTRAINT FOREIGN KEY buch_mitarbeiter (fk_mitarbeiter_id) REFERENCES mitarbeiter (mitarbeiter_id)
);

CREATE TABLE IF NOT EXISTS `film` (
  `film_id` varchar(8) NOT NULL PRIMARY KEY,
  `fk_mitarbeiter_id` int,
  `beschreibung` varchar(100) NOT NULL,
  `titel` varchar(40) NOT NULL,
  `kategorie` varchar(30) NOT NULL,
  `dauer` time NOT NULL,
  `sprache` varchar(20) NOT NULL,
  `erscheinungsjahr` int(4) NOT NULL,
  `lagernd` int NOT NULL,
   CONSTRAINT FOREIGN KEY film_mitarbeiter (fk_mitarbeiter_id) REFERENCES mitarbeiter (mitarbeiter_id)
);


CREATE TABLE IF NOT EXISTS `leiht_aus_buch` (
  `pk_fk_kartennummer` int(4) NOT NULL,
  `pk_fk_isbn` varchar(13) NOT NULL,
   PRIMARY KEY (pk_fk_kartennummer, pk_fk_isbn),
  `ausleihdatum` date NOT NULL,
  `rueckgabedatum` date NOT NULL,
  `stueckzahl` int(20) NOT NULL,
   CONSTRAINT FOREIGN KEY fk_kartennummer (pk_fk_kartennummer) REFERENCES kunde (kartennummer),
   CONSTRAINT FOREIGN KEY leiht_buch (pk_fk_isbn) REFERENCES buch (isbn)
);


CREATE TABLE IF NOT EXISTS `leiht_aus_film` (
  `pk_fk_kartennummer` int(4) NOT NULL,
  `pk_fk_film_id` varchar(8) NOT NULL,
   PRIMARY KEY (pk_fk_kartennummer, pk_fk_film_id),
  `ausleihdatum` date NOT NULL,
  `rueckgabedatum` date NOT NULL,
  `stueckzahl` int(20) NOT NULL,
   CONSTRAINT FOREIGN KEY fk_kartennummer_film (pk_fk_kartennummer) REFERENCES kunde (kartennummer),
   CONSTRAINT FOREIGN KEY leiht_film (pk_fk_film_id) REFERENCES film (film_id)
);