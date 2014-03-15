DROP TABLE IF EXISTS passwordResets;
CREATE TABLE passwordResets
(
  id                smallint unsigned NOT NULL auto_increment,
  resetDateTime      datetime NOT NULL,
  email             VARCHAR(50) NOT NULL UNIQUE,
  token              VARCHAR(100) NOT NULL,   
  PRIMARY KEY     (id)
);
 