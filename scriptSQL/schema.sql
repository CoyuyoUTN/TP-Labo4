CREATE TABLE company (
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

CREATE TABLE proyecto4.Admin (
	Id INT auto_increment NOT NULL,
	Email varchar(50) NOT NULL,
	Password varchar(15) NOT NULL,
	Name varchar(30) NOT NULL,
	CONSTRAINT Id_PK PRIMARY KEY (Id),
	CONSTRAINT Email_UN UNIQUE KEY (Email)
)
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
