DROP TABLE IF EXISTS users;
CREATE TABLE users
(
  id                smallint unsigned NOT NULL auto_increment,
  username          VARCHAR(50) NOT NULL,
  password          VARCHAR(60) NOT NULL,
  joinDateTime      datetime NOT NULL,
  lastLoginDateTime datetime NULL,
  lastLoginFrom     VARCHAR(50) NULL,
  userType          VARCHAR(50) NOT NULL,
  name              VARCHAR(50) NOT NULL, 
  rollNo            VARCHAR(30) NOT NULL, 
  hostel            VARCHAR(20) NOT NULL, 
  room              VARCHAR(20) NOT NULL, 
  phone             VARCHAR(20) NOT NULL, 
  email             VARCHAR(50) NOT NULL UNIQUE,
  socialMediaUrl    VARCHAR(50) NULL,
  avatarLocation    VARCHAR(50) NOT NULL,
  expertise         text NULL,
  rating            VARCHAR(40) NULL,
  aboutMe           text NULL,
  coreRemark        text NULL,
  membership		text NULL,
 
  PRIMARY KEY     (id)
);
 