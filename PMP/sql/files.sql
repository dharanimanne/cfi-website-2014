DROP TABLE IF EXISTS files;
CREATE TABLE files
(
  id            smallint unsigned NOT NULL auto_increment,
  fileName      VARCHAR(100) NOT NULL,
  fileType      text NOT NULL,
  fileLocation  text NOT NULL,
  uploadedBy    text NOT NULL,
  uploadedOn    datetime NOT NULL,

  PRIMARY KEY     (id)
);
 