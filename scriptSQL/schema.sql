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
)