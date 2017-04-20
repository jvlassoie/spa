-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 20 Avril 2017 à 15:39
-- Version du serveur :  5.7.17-0ubuntu0.16.04.1
-- Version de PHP :  7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `spa`
--

-- --------------------------------------------------------

--
-- Structure de la table `Animals`
--

CREATE TABLE `Animals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `dateArrived` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `idBreed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Animals`
--

INSERT INTO `Animals` (`id`, `name`, `status`, `dateArrived`, `description`, `age`, `idBreed`) VALUES
(2, 'bill', 1, '2017-03-27', 'poils blanc', NULL, 1),
(3, 'mysti', 1, '2017-03-27', 'Court, fin, bien couché sur le corps et satiné', NULL, 2),
(4, 'blabla', 1, '2017-04-08', 'moustachue', 10, 1),
(5, 'felix', 1, '2017-04-14', 'chouette', 5, 2),
(6, 'monster', 1, '2017-04-22', 'dangereux', 5, 4);

--
-- Déclencheurs `Animals`
--
DELIMITER $$
CREATE TRIGGER `Animals_ai` AFTER INSERT ON `Animals` FOR EACH ROW BEGIN

DECLARE VarBreed VARCHAR(255);
DECLARE VarSpecie VARCHAR(255);

SET VarBreed = (SELECT name FROM Breeds WHERE NEW.idBreed = Breeds.id);
SET VarSpecie = (SELECT Species.name FROM Breeds inner join Species on Breeds.idSpecie = Species.id where NEW.idBreed = Breeds.id);

INSERT INTO Historic_Animals (id,name,dateArrived,description,age,Breed,Specie) VALUES (NEW.id,NEW.name,NEW.dateArrived,NEW.description,NEW.age,VarBreed,VarSpecie);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `Appointments`
--

CREATE TABLE `Appointments` (
  `id` int(11) NOT NULL,
  `dateOfApp` date NOT NULL,
  `timeOfApp` time NOT NULL,
  `status` tinyint(1) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Appointments`
--

INSERT INTO `Appointments` (`id`, `dateOfApp`, `timeOfApp`, `status`, `idUser`) VALUES
(23, '2017-04-19', '07:00:00', 1, 1),
(24, '2017-04-15', '07:00:00', 0, 2),
(25, '2017-04-15', '10:00:00', 1, 2),
(28, '2017-04-21', '08:00:00', 0, 1),
(29, '2017-04-08', '07:45:00', 0, 14),
(30, '2017-04-20', '07:45:00', 0, 14);

-- --------------------------------------------------------

--
-- Structure de la table `Appointments_Animals`
--

CREATE TABLE `Appointments_Animals` (
  `idAppointments` int(11) NOT NULL,
  `idAnimals` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Appointments_Animals`
--

INSERT INTO `Appointments_Animals` (`idAppointments`, `idAnimals`) VALUES
(23, 2),
(25, 3),
(28, 2),
(29, 3),
(30, 2),
(30, 4),
(30, 3);

-- --------------------------------------------------------

--
-- Structure de la table `Breeds`
--

CREATE TABLE `Breeds` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `idSpecie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Breeds`
--

INSERT INTO `Breeds` (`id`, `name`, `idSpecie`) VALUES
(1, 'bichon', 2),
(2, 'bombay', 4),
(4, 'husky', 2),
(5, 'tigr&eacute; europ&eacute;en', 4);

-- --------------------------------------------------------

--
-- Structure de la table `Historic_Animals`
--

CREATE TABLE `Historic_Animals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dateArrived` date NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `Breed` varchar(255) DEFAULT NULL,
  `Specie` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Historic_Animals`
--

INSERT INTO `Historic_Animals` (`id`, `name`, `dateArrived`, `description`, `age`, `Breed`, `Specie`) VALUES
(6, 'monster', '2017-04-22', 'dangereux', 5, 'husky', 'chien');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `listAppAni`
--
CREATE TABLE `listAppAni` (
`Appointments_AnimalsIdAppointments` int(11)
,`Appointments_AnimalsIdAnimals` int(11)
,`UsersId` int(11)
,`UsersUsername` varchar(150)
,`UsersLastname` varchar(150)
,`UsersFirstname` varchar(150)
,`UsersPassword` varchar(255)
,`UsersEmail` varchar(255)
,`UsersIdRole` int(11)
,`AppointmentsId` int(11)
,`AppointmentsDateOfApp` date
,`AppointmentsTimeOfApp` time
,`AppointmentsStatus` tinyint(1)
,`AppointmentsIdUser` int(11)
,`AnimalsId` int(11)
,`AnimalsName` varchar(255)
,`AnimalsStatus` tinyint(1)
,`AnimalsDateArrived` date
,`AnimalsDescription` varchar(255)
,`AnimalsAge` int(11)
,`AnimalsIdBreed` int(11)
);

-- --------------------------------------------------------

--
-- Structure de la table `Roles`
--

CREATE TABLE `Roles` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Roles`
--

INSERT INTO `Roles` (`id`, `name`) VALUES
(1, 'ROLE_ADMIN'),
(2, 'ROLE_USER');

-- --------------------------------------------------------

--
-- Structure de la table `Species`
--

CREATE TABLE `Species` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Species`
--

INSERT INTO `Species` (`id`, `name`) VALUES
(2, 'chien'),
(4, 'chat');

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `username` varchar(150) DEFAULT NULL,
  `lastname` varchar(150) DEFAULT NULL,
  `firstname` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `idRole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Users`
--

INSERT INTO `Users` (`id`, `username`, `lastname`, `firstname`, `password`, `email`, `idRole`) VALUES
(1, 'toto', 'totoman', 'toto', '$2y$10$ujcUN6P2KGjBHbIepIwh/O510dnaQ/n6T20deRLoDexg17QL5g/wu', 'toto@toto.com', 1),
(2, 'momo', 'momoman', 'momo', '$2y$10$sVcd6d5.OzMvdn50k.INeO.MLfyI2fZymjYTZOQVVOEhgxkeqgCVC', 'momo@momo.com', 1),
(4, 'lo', 'loloman', 'lo', '$2y$10$V.DkL4NYacxM71rXVG5WXunfE.AL9EwugpD0YGAoEfqQI2BwdF5Ea', 'lo@lo.com', 2),
(5, 'q', 'qman', 'q', '$2y$10$D9DPhOQ7k3sqwBWyBLZ.Fe4SzB6LYI3DszGrfnzYCJ8rcFnQsPx86', 'q@q.com', 2),
(6, 'ko', 'ko', 'ko', '$2y$10$eXmDeAkQMG.bfgNtWTINPuTaHZulvxVLmsm5PJHjGIdQLa60UbIMS', 'ko@ko.com', 2),
(10, 'koli', 'ko', 'ko', '$2y$10$mlt9beDhzS67rbwXZvYFWOGAxY7H6HVemU9pDaJ55IWKx4kRUs8ea', 'koli@ko.com', 2),
(11, 'mi', 'mi', 'mi', '$2y$10$qHm3wTUzP1KwQs4O4nPSM.14FugejjrJ7RiuPzKjDe5RQEuSkzwLy', 'mi@mi.fr', 2),
(12, 'mio', 'mi', 'mi', '$2y$10$e8Q6aFzSWMwUp33WQzC2/.N7Yf78IEQbywjI8/ctHEKFz9LTdnxDi', 'mio@mi.fr', 2),
(14, 'polo', 'polet', 'pleti', '$2y$10$hEcxk3QJF/su0O4s79nHOum9qZd/WF6WUxZryMs8fMAFbYZy3zmg.', 'pooo@p.fr', 2),
(15, 'admin', 'admin', 'admin', '$2y$10$3eDT6GNHJL483NZTpNrAkOIMflosWZiTTHwsizkGlnpTzwI170XfS', 'admin@admin.com', 1);

-- --------------------------------------------------------

--
-- Structure de la vue `listAppAni`
--
DROP TABLE IF EXISTS `listAppAni`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listAppAni`  AS  select `Appointments_Animals`.`idAppointments` AS `Appointments_AnimalsIdAppointments`,`Appointments_Animals`.`idAnimals` AS `Appointments_AnimalsIdAnimals`,`Users`.`id` AS `UsersId`,`Users`.`username` AS `UsersUsername`,`Users`.`lastname` AS `UsersLastname`,`Users`.`firstname` AS `UsersFirstname`,`Users`.`password` AS `UsersPassword`,`Users`.`email` AS `UsersEmail`,`Users`.`idRole` AS `UsersIdRole`,`Appointments`.`id` AS `AppointmentsId`,`Appointments`.`dateOfApp` AS `AppointmentsDateOfApp`,`Appointments`.`timeOfApp` AS `AppointmentsTimeOfApp`,`Appointments`.`status` AS `AppointmentsStatus`,`Appointments`.`idUser` AS `AppointmentsIdUser`,`Animals`.`id` AS `AnimalsId`,`Animals`.`name` AS `AnimalsName`,`Animals`.`status` AS `AnimalsStatus`,`Animals`.`dateArrived` AS `AnimalsDateArrived`,`Animals`.`description` AS `AnimalsDescription`,`Animals`.`age` AS `AnimalsAge`,`Animals`.`idBreed` AS `AnimalsIdBreed` from (((`Appointments_Animals` join `Appointments` on((`Appointments_Animals`.`idAppointments` = `Appointments`.`id`))) join `Animals` on((`Appointments_Animals`.`idAnimals` = `Animals`.`id`))) join `Users` on((`Appointments`.`idUser` = `Users`.`id`))) ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Animals`
--
ALTER TABLE `Animals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Animals_Breeds1_idx` (`idBreed`);

--
-- Index pour la table `Appointments`
--
ALTER TABLE `Appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Appointments_Users1_idx` (`idUser`);

--
-- Index pour la table `Appointments_Animals`
--
ALTER TABLE `Appointments_Animals`
  ADD KEY `fk_Appointments_Animals_Appointments1_idx` (`idAppointments`),
  ADD KEY `fk_Appointments_Animals_Animals1_idx` (`idAnimals`);

--
-- Index pour la table `Breeds`
--
ALTER TABLE `Breeds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Breeds_Species1_idx` (`idSpecie`);

--
-- Index pour la table `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Species`
--
ALTER TABLE `Species`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Users_Role_idx` (`idRole`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Animals`
--
ALTER TABLE `Animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `Appointments`
--
ALTER TABLE `Appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pour la table `Breeds`
--
ALTER TABLE `Breeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `Roles`
--
ALTER TABLE `Roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `Species`
--
ALTER TABLE `Species`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Animals`
--
ALTER TABLE `Animals`
  ADD CONSTRAINT `Animals_ibfk_2` FOREIGN KEY (`idBreed`) REFERENCES `Breeds` (`id`);

--
-- Contraintes pour la table `Appointments`
--
ALTER TABLE `Appointments`
  ADD CONSTRAINT `Appointments_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `Users` (`id`);

--
-- Contraintes pour la table `Appointments_Animals`
--
ALTER TABLE `Appointments_Animals`
  ADD CONSTRAINT `Appointments_Animals_ibfk_10` FOREIGN KEY (`idAppointments`) REFERENCES `Appointments` (`id`),
  ADD CONSTRAINT `Appointments_Animals_ibfk_11` FOREIGN KEY (`idAnimals`) REFERENCES `Animals` (`id`);

--
-- Contraintes pour la table `Breeds`
--
ALTER TABLE `Breeds`
  ADD CONSTRAINT `Breeds_ibfk_3` FOREIGN KEY (`idSpecie`) REFERENCES `Species` (`id`);

--
-- Contraintes pour la table `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `Roles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
