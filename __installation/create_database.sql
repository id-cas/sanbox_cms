CREATE DATABASE `db_sandbox_cms` CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE USER 'usr_sandbox_cms'@'localhost' IDENTIFIED BY '!kl0dOg=FZ3-jx';
GRANT ALL ON `db_sandbox_cms`.* TO 'usr_sandbox_cms'@'localhost';
flush privileges;

CREATE TABLE `cms_objects` (
     `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
     `title` varchar(255) DEFAULT NULL,
     `type` varchar(255) NOT NULL,
     PRIMARY KEY (`id`),
     KEY `Object to type relation_FK` (`type`),
     KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cms_hierarchy` (
     `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
     `parent_id` int(10) unsigned NOT NULL,
     `obj_id` int(10) unsigned NOT NULL,
     `ord` int(11) DEFAULT NULL,
     `is_active` tinyint(1) DEFAULT NULL,
     `updatetime` int(11) DEFAULT NULL,
     `is_default` tinyint(1) DEFAULT '0',
     PRIMARY KEY (`id`),
     KEY `is_default` (`is_default`),
     KEY `is_active` (`is_active`),
     KEY `ord` (`ord`),
     KEY `parent_id` (`parent_id`),
     KEY `updatetime` (`updatetime`),
     CONSTRAINT `FK_hierarchy to plain object` FOREIGN KEY (`obj_id`) REFERENCES `cms_objects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Instead of ORM create NEWS RUBRIC type=news_rubric
CREATE TABLE `cms_object_news_rubric` (
   `obj_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `title` varchar(255) DEFAULT NULL,
   PRIMARY KEY (`obj_id`),
   CONSTRAINT `FK_object_news_rubric to plain object` FOREIGN KEY (`obj_id`) REFERENCES `cms_objects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Instead of ORM create NEWS ITEM type=news_item
CREATE TABLE `cms_object_news_item` (
       `obj_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
       `title` varchar(255) DEFAULT NULL,
       `anons` varchar(1024) DEFAULT NULL,
       `content` text DEFAULT NULL,
       PRIMARY KEY (`obj_id`),
       CONSTRAINT `FK_object_news_item to plain object` FOREIGN KEY (`obj_id`) REFERENCES `cms_objects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE cms_object_news_rubric;
DROP TABLE cms_object_news_item;
DROP TABLE cms_hierarchy;
DROP TABLE cms_objects;