DROP TABLE IF EXISTS memberships;
CREATE TABLE memberships
(
  id                smallint unsigned NOT NULL auto_increment,
  userId            smallint NOT NULL,
  activityId        smallint NOT NULL,
  activityType      VARCHAR(100) NULL,
  membershipType    TEXT NOT NULL,
  memberSince		datetime NOT NULL,

  PRIMARY KEY     (id)
);
 