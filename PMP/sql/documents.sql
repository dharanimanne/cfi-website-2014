DROP TABLE IF EXISTS documents;
CREATE TABLE documents
(
  id                smallint unsigned NOT NULL auto_increment,
  DocName           VARCHAR(50) NOT NULL,
  uploadedOn        datetime NULL,
  uploadedBy        VARCHAR(50) NULL,
  tags              VARCHAR(50) NOT NULL,
  activityId        smallint NOT NULL, 
  docLocation       VARCHAR(100) NOT NULL, 
  
  PRIMARY KEY     (id)
);
 