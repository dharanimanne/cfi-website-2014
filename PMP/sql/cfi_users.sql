DROP TABLE IF EXISTS users;
CREATE TABLE users
(
  id                smallint unsigned NOT NULL auto_increment,
  username          VARCHAR(50) NOT NULL,
  password          VARCHAR(50) NOT NULL,
  joinDateTime      date NOT NULL,
  lastLoginDateTime date NOT NULL,
  lastLoginFrom     VARCHAR(50) NOT NULL,
  userType          VARCHAR(50) NOT NULL,
  name              VARCHAR(50) NOT NULL, 
  rollNo            VARCHAR(30) NOT NULL, 
  hostel            VARCHAR(20) NOT NULL, 
  room              VARCHAR(20) NOT NULL, 
  phone             VARCHAR(20) NOT NULL, 
  email             VARCHAR(50) NOT NULL UNIQUE,
  socialMediaUrl    VARCHAR(50) NOT NULL,
  avatarLocation    VARCHAR(50) NOT NULL,
  expertise         text NOT NULL,
  rating            VARCHAR(40) NOT NULL,
  aboutMe           text NOT NULL,
  coreRemark        text NOT NULL,
 
  PRIMARY KEY     (id)
);
 