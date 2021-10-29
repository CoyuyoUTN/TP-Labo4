CREATE TABLE `Admin` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Email_UN` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- proyecto4.Career definition

CREATE TABLE `Career` (
  `careerId` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`careerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- proyecto4.Company definition

CREATE TABLE `Company` (
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cuil` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `img` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortDesc` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ranking` int(20) DEFAULT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jobOffers` int(11) DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `webpage` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unq_name` (`name`),
  UNIQUE KEY `unq_cuil` (`cuil`),
  UNIQUE KEY `unq_email` (`email`),
  UNIQUE KEY `unq_web` (`webpage`),
  UNIQUE KEY `unq_face` (`facebook`),
  UNIQUE KEY `unq_linkedin` (`linkedin`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- proyecto4.JobsOffer definition

CREATE TABLE `JobsOffer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CompanyId` int(11) NOT NULL,
  `JobPositionId` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `JobsOffer_FK` (`CompanyId`),
  CONSTRAINT `JobsOffer_FK` FOREIGN KEY (`CompanyId`) REFERENCES `Company` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- proyecto4.Student definition

CREATE TABLE `Student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `apiId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- proyecto4.Student_x_JobOffer definition

CREATE TABLE `Student_x_JobOffer` (
  `StudentId` int(11) NOT NULL,
  `JobOfferId` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`StudentId`,`JobOfferId`),
  KEY `Student_x_JobOffer_FK_1` (`JobOfferId`),
  CONSTRAINT `Student_x_JobOffer_FK` FOREIGN KEY (`StudentId`) REFERENCES `Student` (`id`),
  CONSTRAINT `Student_x_JobOffer_FK_1` FOREIGN KEY (`JobOfferId`) REFERENCES `JobsOffer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
