CREATE TABLE `tickets_categories` (
  `tickets_categories_id` smallint(10) unsigned NOT NULL auto_increment,
  `tickets_categories_name` varchar(20) NOT NULL default '',
  `tickets_categories_order` tinyint(3) unsigned NOT NULL default '1',
  `email` varchar(100) default NULL,
  PRIMARY KEY  (`tickets_categories_id`),
  UNIQUE KEY `tickets_categories_name` (`tickets_categories_name`),
  KEY `tickets_categories_order` (`tickets_categories_order`)
) TYPE=MyISAM;

CREATE TABLE `tickets_levels` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL default '',
  `order` tinyint(3) unsigned NOT NULL default '1',
  `color` varchar(6) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `tickets_status_name` (`name`),
  KEY `tickets_status_order` (`order`)
) TYPE=MyISAM;



CREATE TABLE `tickets_poll` (
  `id` int(11) default NULL,
  `a` char(1) default NULL,
  `b` char(1) default NULL,
  `c` char(1) default NULL,
  `d` char(1) default NULL,
  `e` char(1) default NULL,
  `timestamp` bigint(10) default NULL,
  `staff` int(11) default NULL
) ENGINE=MyISAM;



CREATE TABLE `tickets_state` (
  `id` int(11) default NULL,
  `closed_by` varchar(16) default NULL,
  `opened_by` varchar(16) default NULL,
  `hold_by` varchar(16) default NULL,
  `tickets_status` char(1) default '1',
  UNIQUE KEY `id` (`id`)
) TYPE=MyISAM;


CREATE TABLE `tickets_tickets` (
  `tickets_id` int(10) unsigned NOT NULL auto_increment,
  `tickets_username` varchar(16) NOT NULL default '',
  `tickets_subject` varchar(50) NOT NULL default '',
  `tickets_timestamp` bigint(10) unsigned NOT NULL default '0',
  `tickets_name` varchar(50) NOT NULL default '',
  `tickets_email` varchar(50) NOT NULL default '',
  `tickets_urgency` tinyint(3) unsigned NOT NULL default '1',
  `tickets_category` tinyint(3) unsigned NOT NULL default '1',
  `tickets_admin` varchar(20) NOT NULL default 'Client',
  `tickets_child` int(10) unsigned NOT NULL default '0',
  `tickets_question` text NOT NULL,
  `unread_admin` tinyint(2) default '1',
  `unread_user` tinyint(2) default NULL,
  PRIMARY KEY  (`tickets_id`),
  KEY `tickets_username` (`tickets_username`),
  KEY `tickets_urgency` (`tickets_urgency`),
  KEY `tickets_category` (`tickets_category`),
  KEY `tickets_child` (`tickets_child`)
) TYPE=MyISAM;


CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `username` varchar(16) NOT NULL default '',
  `password` varchar(16) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `lastlogin` bigint(10) default NULL,
  `newlogin` bigint(10) default NULL,
  `admin` varchar(5) NOT NULL default '',
  `status` tinyint(1) unsigned NOT NULL default '0',
  `added` bigint(10) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `tickets_users_username` (`username`),
  KEY `tickets_users_admin` (`admin`),
  KEY `tickets_users_status` (`status`)
) TYPE=MyISAM;


CREATE TABLE `users_staff` (
  `user` int(11) default NULL,
  `departament` tinyint(4) default NULL
) TYPE=MyISAM;


CREATE TABLE `category` (
  `categoryid` int(11) NOT NULL auto_increment,
  `categoryname` varchar(100) NOT NULL default '',
  `entrydate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`categoryid`)
) TYPE=MyISAM;

CREATE TABLE `comments_articles` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(20) default NULL,
  `child_article` int(11) default NULL,
  `area` text,
  `moment` int(11) default NULL,
  `ip` varchar(15) default NULL,
  `email` varchar(50) default NULL,
  `website` varchar(40) default NULL,
  UNIQUE KEY `id` (`id`)
) TYPE=MyISAM;

CREATE TABLE `contenidos` (
  `newsid` bigint(32) NOT NULL auto_increment,
  `catalogid` bigint(32) default NULL,
  `es_principal` tinyint(4) default NULL,
  `title` varchar(255) NOT NULL default '',
  `descripcion` text,
  `tipo_texto1` varchar(5) default NULL,
  `content1` mediumtext,
  `picture1` varchar(255) default NULL,
  `alineado1` varchar(6) default NULL,
  `viewnum` bigint(32) default NULL,
  `adddate` datetime default NULL,
  `rating` float default NULL,
  `ratenum` bigint(32) default NULL,
  `sourceurl` varchar(100) default NULL,
  `isdisplay` tinyint(4) NOT NULL default '0',
  `adelante` varchar(255) default NULL,
  `atras` varchar(255) default NULL,
  `source` varchar(50) default NULL,
  `autor` varchar(63) default NULL,
  `source_main` varchar(100) default NULL,
  `leidas` bigint(32) default NULL,
  `keywords` varchar(255) default NULL,
  `isphp` tinyint(4) default NULL,
  `blockip` tinyint(4) default NULL,
  PRIMARY KEY  (`newsid`),
  KEY `catalogid` (`catalogid`)
) TYPE=MyISAM;


CREATE TABLE `catalog` (
  `catalogid` bigint(32) NOT NULL auto_increment,
  `catalogname` varchar(255) NOT NULL default '',
  `description` text,
  `parentid` bigint(32) NOT NULL default '0',
  PRIMARY KEY  (`catalogid`)
) TYPE=MyISAM;



INSERT INTO `tickets_categories` (`tickets_categories_id`, `tickets_categories_name`, `tickets_categories_order`, `email`) VALUES 
  (1,'General Support',1,'');

COMMIT;

INSERT INTO `tickets_levels` (`id`, `name`, `order`, `color`) VALUES 
  (1,'Low',1,'00CCFF'),
  (2,'Medium',2,'0000FF'),
  (3,'Urgent',3,'FF9900'),
  (4,'Critical',4,'FF3333');

COMMIT;