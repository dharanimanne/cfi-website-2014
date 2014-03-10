DROP TABLE IF EXISTS preferences;
CREATE TABLE preferences
(
  id                smallint unsigned NOT NULL auto_increment,
  preference1       VARCHAR(100) NOT NULL,
  preference2       VARCHAR(100) NOT NULL,
  uploadedOn        datetime NULL,
  name              VARCHAR(50) NOT NULL, 
  rollNo            VARCHAR(30) NOT NULL, 
  hostel            VARCHAR(20) NOT NULL, 
  room              VARCHAR(20) NOT NULL, 
  phone             VARCHAR(20) NOT NULL, 
  email             VARCHAR(50) NOT NULL UNIQUE,
  aboutMe           text NULL;

  PRIMARY KEY     (id)
);