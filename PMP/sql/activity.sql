DROP TABLE IF EXISTS activity;
CREATE TABLE activity
(
  id                smallint unsigned NOT NULL auto_increment,
  title             VARCHAR(100) NOT NULL,
  brief_writeup     text NOT NULL,
  detailed_writeup  text NOT NULL,
  status            text NOT NULL,
  tags              VARCHAR(100) NOT NULL,
  overall_budget    int unsigned NOT NULL, 
  utilized_budget   int unsigned NOT NULL, 
  
  PRIMARY KEY     (id)
);
 