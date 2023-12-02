--DROP DATABASE IF EXISTS dolphin_crm;
CREATE DATABASE dolphin_crm;
USE dolphin_crm;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `firstname` char(35) NOT NULL default '',
  `lastname` char(35) NOT NULL default '',
  `password` char(20) NOT NULL,
  `email` char(50) NOT NULL default '',
  `role` char(20) NOT NULL default '',
  `create_at` DATETIME,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4080 DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL auto_increment,
  `title` char(35) NOT NULL default '',
  `firstname` char(35) NOT NULL default '',
  `lastname` char(35) NOT NULL default '',
  `email` char(50) NOT NULL default '',
  `telephone` char(15) NOT NULL default '',
  `company` char(50) NOT NULL default '',
  `type` ENUM('slaes','support') NOT NULL,
  `assigned_to` int(11) NOT NULL ,
  'created_by' int(11) NOT NULL ,
  `create_at` DATETIME,
  'updated_at' DATETIME,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4080 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `id` int(11) NOT NULL auto_increment,
  `contact_id` int(15) NOT NULL default '',
  `comment` text(35) NOT NULL default '',
  `created_by` int(11) NOT NULL,
  `create_at` DATETIME,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4080 DEFAULT CHARSET=utf8mb4;

SET @hashed_password=SHA2('password',256);
INSERT INTO users (email, password_hashed,role,create_at) VALUES ('admin@project2.com',@hashed_password,'admin',NOW());
