-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `Animals`;
CREATE TABLE `Animals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `dateArrived` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `idBreed` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Animals_Breeds1_idx` (`idBreed`),
  CONSTRAINT `Animals_ibfk_2` FOREIGN KEY (`idBreed`) REFERENCES `Breeds` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Animals` (`id`, `name`, `status`, `dateArrived`, `description`, `age`, `idBreed`) VALUES
(2,	'bill',	1,	'2017-03-27',	'poils blanc',	NULL,	1),
(3,	'mysti',	1,	'2017-03-27',	'Court, fin, bien couché sur le corps et satiné',	NULL,	2),
(4,	'blabla',	1,	'2017-04-08',	'moustachue',	10,	1);

DROP TABLE IF EXISTS `Appointments`;
CREATE TABLE `Appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateOfApp` date NOT NULL,
  `timeOfApp` time NOT NULL,
  `status` tinyint(1) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Appointments_Users1_idx` (`idUser`),
  CONSTRAINT `fk_Appointments_Users1` FOREIGN KEY (`idUser`) REFERENCES `Users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Appointments` (`id`, `dateOfApp`, `timeOfApp`, `status`, `idUser`) VALUES
(23,	'2017-04-19',	'07:00:00',	1,	1),
(24,	'2017-04-15',	'07:00:00',	0,	2),
(25,	'2017-04-15',	'10:00:00',	1,	2),
(28,	'2017-04-21',	'08:00:00',	0,	1);

DROP TABLE IF EXISTS `Appointments_Animals`;
CREATE TABLE `Appointments_Animals` (
  `idAppointments` int(11) NOT NULL,
  `idAnimals` int(11) NOT NULL,
  KEY `fk_Appointments_Animals_Appointments1_idx` (`idAppointments`),
  KEY `fk_Appointments_Animals_Animals1_idx` (`idAnimals`),
  CONSTRAINT `Appointments_Animals_ibfk_8` FOREIGN KEY (`idAppointments`) REFERENCES `Appointments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Appointments_Animals_ibfk_9` FOREIGN KEY (`idAnimals`) REFERENCES `Animals` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Appointments_Animals` (`idAppointments`, `idAnimals`) VALUES
(23,	2),
(25,	3),
(28,	2);

DROP TABLE IF EXISTS `Breeds`;
CREATE TABLE `Breeds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `idSpecie` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Breeds_Species1_idx` (`idSpecie`),
  CONSTRAINT `Breeds_ibfk_2` FOREIGN KEY (`idSpecie`) REFERENCES `Species` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Breeds` (`id`, `name`, `idSpecie`) VALUES
(1,	'bichon',	2),
(2,	'Bombay',	4),
(3,	'michel',	2);

DROP TABLE IF EXISTS `Roles`;
CREATE TABLE `Roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Roles` (`id`, `name`) VALUES
(1,	'ROLE_ADMIN'),
(2,	'ROLE_USER');

DROP TABLE IF EXISTS `Species`;
CREATE TABLE `Species` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Species` (`id`, `name`) VALUES
(2,	'chien'),
(4,	'chat'),
(21,	'zzs'),
(25,	'zzd'),
(29,	'szsasa'),
(30,	'mouus'),
(35,	'sas'),
(36,	'dza'),
(37,	'boubou');

DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `idRole` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Users_Role_idx` (`idRole`),
  CONSTRAINT `fk_Users_Role` FOREIGN KEY (`idRole`) REFERENCES `Roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Users` (`id`, `name`, `password`, `email`, `idRole`) VALUES
(1,	'toto',	'toto',	'toto@toto.com',	1),
(2,	'momo',	'momo',	'momo@momo.com',	1);

-- 2017-04-14 21:09:52