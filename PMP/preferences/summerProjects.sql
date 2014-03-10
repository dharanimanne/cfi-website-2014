DROP TABLE IF EXISTS summerProjects;
CREATE TABLE summerProjects(
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
   `description` text NOT NULL,
  `category` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) 