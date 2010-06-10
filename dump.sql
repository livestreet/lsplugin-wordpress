CREATE TABLE `prefix_wp_content` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `title` varchar(250) NOT NULL,
  `is_php` tinyint(1) NOT NULL default '0',
  `content` text NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `is_php` (`is_php`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;


INSERT INTO `prefix_wp_content` VALUES (1, 'test', 'тестовый блок', 1, 'echo("bugaga");\r\nif (1) {\r\necho("ok!");\r\n}');   

CREATE TABLE `prefix_wp_topic` (
  `id` int(11) NOT NULL,
  `title_lat` varchar(500) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `date` (`date`,`title_lat`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;