CREATE TABLE proyecto4.Company (
  name varchar(30) NOT NULL,
  cuil int(20) NOT NULL,
  id int(20) NOT NULL,
  img tinytext DEFAULT NULL,
  shortDesc int(30) NOT NULL,
  ranking int(20) NOT NULL,
  email varchar(40) NOT NULL,
  phone int(20) NOT NULL,
  city varchar(40) NOT NULL,
  address varchar(40) NOT NULL,
  jobOfffers varchar(20) DEFAULT NULL,
  bio text DEFAULT NULL,
  linked varchar(20) DEFAULT NULL,
  webpage varchar(30) NOT NULL,
  facebook varchar(30) NOT NULL
),
CREATE TABLE proyecto4.JobsOffer (
	id INT auto_increment NOT NULL,
	Description varchar(100) NOT NULL,
	CompanyId INT NOT NULL,
	JobPositionId INT NOT NULL,
	CONSTRAINT JobsOffer_PK PRIMARY KEY (id),
	CONSTRAINT JobsOffer_FK FOREIGN KEY (CompanyId) REFERENCES proyecto4.Company(id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci
AUTO_INCREMENT=1;
CREATE TABLE Career (
  careerId int(11) NOT NULL AUTO_INCREMENT,
  description varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  active tinyint(1) NOT NULL,
  PRIMARY KEY (careerId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE Student (
  id int(11) NOT NULL AUTO_INCREMENT,
  Password varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  CareerId varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE proyecto4.Admin (
	Id INT auto_increment NOT NULL,
	Email varchar(50) NOT NULL,
	Password varchar(15) NOT NULL,
	Name varchar(30) NOT NULL,
	CONSTRAINT Id_PK PRIMARY KEY (Id),
	CONSTRAINT Email_UN UNIQUE KEY (Email)
) 
CREATE TABLE proyecto4.Student_x_JobOffer (
	StudentId INT NOT NULL,
	JobOfferId INT NOT NULL,
	CONSTRAINT Student_x_JobOffer_PK PRIMARY KEY (StudentId,JobOfferId),
	CONSTRAINT Student_x_JobOffer_FK FOREIGN KEY (StudentId) REFERENCES proyecto4.Student(id),
	CONSTRAINT Student_x_JobOffer_FK_1 FOREIGN KEY (JobOfferId) REFERENCES proyecto4.JobsOffer(id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

CREATE TABLE proyecto4.Career (
	careerId INT auto_increment NOT NULL,
	description varchar(100) NOT NULL,
	active BOOL NOT NULL,
	CONSTRAINT Career_PK PRIMARY KEY (careerId)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;
