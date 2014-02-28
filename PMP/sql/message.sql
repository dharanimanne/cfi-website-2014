DROP TABLE IF EXISTS messages;
CREATE TABLE messages
(
  id                smallint unsigned NOT NULL auto_increment,
  from_username        VARCHAR(50) NOT NULL,
  to_username          VARCHAR(50) NOT NULL,
  message              text NOT NULL,
  messageSentTime      datetime NOT NULL  ,
  isReceived           tinyint(1) NOT NULL DEFAULT '0',
  isRead           tinyint(1) NOT NULL DEFAULT '0',
  tags                  VARCHAR(50) NOT NULL,
 
  
 
  PRIMARY KEY     (id)
);