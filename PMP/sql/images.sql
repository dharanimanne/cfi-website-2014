DROP TABLE IF EXISTS files;
CREATE TABLE images
(
  id            smallint unsigned NOT NULL auto_increment,
  imageName      VARCHAR(100) NOT NULL,
  imageType      text NOT NULL,
  imageLocation  text NOT NULL,
  uploadedBy    text NOT NULL,
  uploadedOn    datetime NOT NULL,

  PRIMARY KEY     (id)
);
 