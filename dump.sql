DROP TABLE IF EXISTS `ban_emails`;
CREATE TABLE `ban_emails` (
  `id` bigint(10) unsigned NOT NULL auto_increment,
  `email` varchar(100) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `ban_emails`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canned_replies`
--

DROP TABLE IF EXISTS `canned_replies`;
CREATE TABLE `canned_replies` (
  `id` tinyint(10) NOT NULL auto_increment,
  `dep` tinyint(5) default NULL,
  `subjet` varchar(40) default NULL,
  `body` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `canned_replies`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalog`
--

DROP TABLE IF EXISTS `catalog`;
CREATE TABLE `catalog` (
  `catalogid` bigint(32) NOT NULL auto_increment,
  `catalogname` varchar(255) NOT NULL default '',
  `description` text,
  `parentid` bigint(32) NOT NULL default '0',
  PRIMARY KEY  (`catalogid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcar la base de datos para la tabla `catalog`
--

INSERT INTO `catalog` (`catalogid`, `catalogname`, `description`, `parentid`) VALUES
(9, 'segunda con tercera', 'description', 0),
(10, 'tercera', 'description', 0),
(12, 'j2', 'description', 0),
(13, 'j3', 'description', 0),
(11, 'j1', 'description', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `categoryid` int(11) NOT NULL auto_increment,
  `categoryname` varchar(100) NOT NULL default '',
  `entrydate` datetime default NULL,
  `keyview` varchar(6) default NULL,
  PRIMARY KEY  (`categoryid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `category`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments_articles`
--

DROP TABLE IF EXISTS `comments_articles`;
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `comments_articles`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenidos`
--

DROP TABLE IF EXISTS `contenidos`;
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcar la base de datos para la tabla `contenidos`
--

INSERT INTO `contenidos` (`newsid`, `catalogid`, `es_principal`, `title`, `descripcion`, `tipo_texto1`, `content1`, `picture1`, `alineado1`, `viewnum`, `adddate`, `rating`, `ratenum`, `sourceurl`, `isdisplay`, `adelante`, `atras`, `source`, `autor`, `source_main`, `leidas`, `keywords`, `isphp`, `blockip`) VALUES
(9, 2, 0, 'kk', 'fdf', 'html', '<p>fffffffffffffff</p>', '', '', 0, '2010-03-24 13:14:12', 0, 1, 'fdfd', 1, '', '', NULL, NULL, '', NULL, 'Keywords', 0, 0),
(8, 1, 0, 'mi casa', '', 'html', '<p>este es mi hogar ok?</p>', '', '', 0, '2010-03-24 12:41:28', 0, 1, '1269448888', 1, '', '', NULL, NULL, '', 3, 'Keywords', 0, 0),
(7, 2, 0, 'Este es el titulo', 'dsds', 'html', '<p>el texco completo viene aqui y lo modifico.</p>', NULL, NULL, NULL, '2010-03-24 13:04:46', 0, 1, 'iden', 1, NULL, NULL, NULL, NULL, NULL, 4, 'Keywords', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_headers_tickets`
--

DROP TABLE IF EXISTS `email_headers_tickets`;
CREATE TABLE `email_headers_tickets` (
  `tickets_id` int(10) unsigned NOT NULL,
  `tickets_header` varchar(1500) NOT NULL,
  PRIMARY KEY  (`tickets_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `email_headers_tickets`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_queue`
--

DROP TABLE IF EXISTS `email_queue`;
CREATE TABLE `email_queue` (
  `id` bigint(11) NOT NULL auto_increment,
  `subject` varchar(50) default NULL,
  `body` text,
  `el_email` varchar(100) default NULL,
  `name` varchar(100) default NULL,
  `timestamp` bigint(10) default NULL,
  `reply_to` varchar(100) default NULL,
  `sended_from` varchar(100) default NULL,
  `sended_from_name` varchar(100) default NULL,
  `retries` tinyint(4) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Volcar la base de datos para la tabla `email_queue`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `error_log`
--

DROP TABLE IF EXISTS `error_log`;
CREATE TABLE `error_log` (
  `id` int(11) NOT NULL auto_increment,
  `action` varchar(100) default NULL,
  `timestamp` bigint(10) default NULL,
  `delay` varchar(16) default NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `error_log`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `spam`
--

DROP TABLE IF EXISTS `spam`;
CREATE TABLE `spam` (
  `id` bigint(10) NOT NULL,
  `spa` text,
  `filter` varchar(1) default NULL,
  `deletespam` varchar(1) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `spam`
--

INSERT INTO `spam` (`id`, `spa`, `filter`, `deletespam`) VALUES
(0, 'ddddddccccccccc', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets_atach`
--

DROP TABLE IF EXISTS `tickets_atach`;
CREATE TABLE `tickets_atach` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tickets_id` int(10) unsigned NOT NULL default '0',
  `atachmen` varchar(100) default '',
  `atachmen_new` varchar(100) default NULL,
  `archi` mediumblob,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `tickets_atach`
--

INSERT INTO `tickets_atach` (`tickets_id`, `atachmen`, `atachmen_new`, `archi`) VALUES
(108, 'fhd_full.gif', NULL, NULL),
(104, 'fhd_full.gif', NULL, NULL),
(103, 'laptop.jpg', NULL, NULL),
(109, '600px_Wbs.png', 'upload/109.Sk(Ai9T57aqTdFaiAm@@', NULL),
(110, 'IMG_1273.JPG', '110.hck5S#Sk0EoyPvxhyshx', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets_categories`
--

DROP TABLE IF EXISTS `tickets_categories`;
CREATE TABLE `tickets_categories` (
  `tickets_categories_id` smallint(10) unsigned NOT NULL auto_increment,
  `tickets_categories_name` varchar(20) NOT NULL default '',
  `tickets_categories_order` tinyint(3) unsigned NOT NULL default '1',
  `email` varchar(100) default NULL,
  `password` varchar(30) default NULL,
  `epiping` varchar(1) default NULL,
  `emailpiping` varchar(100) default NULL,
  `maxfile` int(6) default NULL,
  `sms` varchar(15) default NULL,
  `supervisor` varchar(100) NOT NULL,
  `level` smallint(10) NOT NULL,
  PRIMARY KEY  (`tickets_categories_id`),
  UNIQUE KEY `tickets_categories_name` (`tickets_categories_name`),
  KEY `tickets_categories_order` (`tickets_categories_order`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `tickets_categories`
--

INSERT INTO `tickets_categories` (`tickets_categories_id`, `tickets_categories_name`, `tickets_categories_order`, `email`, `password`, `epiping`, `emailpiping`, `maxfile`, `sms`, `supervisor`,level) VALUES
(1, 'General Support', 1, '', 'dddddddddddddd', '', 'd', 0, '', '0',1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets_levels`
--

DROP TABLE IF EXISTS `tickets_levels`;
CREATE TABLE `tickets_levels` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL default '',
  `orderx` tinyint(3) unsigned NOT NULL default '1',
  `color` varchar(6) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `tickets_status_name` (`name`),
  KEY `tickets_status_order` (`orderx`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `tickets_levels`
--

INSERT INTO `tickets_levels` (`id`, `name`, `orderx`, `color`) VALUES
(1, 'Low', 1, '00CCFF'),
(2, 'Medium', 2, '0000FF'),
(3, 'Urgent', 3, 'FF9900'),
(4, 'Critical', 4, 'FF3333');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets_poll`
--

DROP TABLE IF EXISTS `tickets_poll`;
CREATE TABLE `tickets_poll` (
  `id` int(11) default NULL,
  `a` char(1) default NULL,
  `b` char(1) default NULL,
  `c` char(1) default NULL,
  `d` char(1) default NULL,
  `e` char(1) default NULL,
  `timestamp` bigint(10) default NULL,
  `comment` tinytext,
  `staff` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `tickets_poll`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets_state`
--

DROP TABLE IF EXISTS `tickets_state`;
CREATE TABLE `tickets_state` (
  `id` int(11) default NULL,
  `closed_by` varchar(16) default NULL,
  `opened_by` varchar(16) default NULL,
  `hold_by` varchar(16) default NULL,
  `tickets_status` char(1) default '1',
  `assigned` varchar(1) default NULL,
  `assigned_to` varchar(20) default NULL,
  `keyview` varchar(6) default NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `tickets_state`
--

INSERT INTO `tickets_state` (`id`, `closed_by`, `opened_by`, `hold_by`, `tickets_status`, `assigned`, `assigned_to`, `keyview`) VALUES
(161, NULL, 'admin', NULL, '1', NULL, NULL, NULL),
(157, NULL, '10', NULL, '1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets_tickets`
--

DROP TABLE IF EXISTS `tickets_tickets`;
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
  `previous` bigint(10) default NULL,
  `eta` bigint(10) default NULL,
  `reserved` varchar(1) NOT NULL default '',
  PRIMARY KEY  (`tickets_id`),
  KEY `tickets_username` (`tickets_username`),
  KEY `tickets_urgency` (`tickets_urgency`),
  KEY `tickets_category` (`tickets_category`),
  KEY `tickets_child` (`tickets_child`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=163 ;

--
-- Volcar la base de datos para la tabla `tickets_tickets`
--

INSERT INTO `tickets_tickets` (`tickets_id`, `tickets_username`, `tickets_subject`, `tickets_timestamp`, `tickets_name`, `tickets_email`, `tickets_urgency`, `tickets_category`, `tickets_admin`, `tickets_child`, `tickets_question`, `unread_admin`, `unread_user`, `previous`, `eta`, `reserved`) VALUES
(161, 'admin', 'This is for testing', 1272948429, '', 'email@site.com', 1, 1, 'admin', 0, 'Hello Staff, this is a new ticket', 0, 1, 0, 0, ''),
(162, 'admin', 'This is for testing', 1272948449, '', 'email@site.com', 1, 1, 'admin', 161, 'You can delete this ticket.', 1, NULL, 0, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tracking`
--

DROP TABLE IF EXISTS `tracking`;
CREATE TABLE `tracking` (
  `id` bigint(20) NOT NULL auto_increment,
  `ticket_id` bigint(20) default NULL,
  `staff` varchar(16) default NULL,
  `action` varchar(40) default NULL,
  `tdate` int(10) unsigned default NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=595 ;

--
-- Volcar la base de datos para la tabla `tracking`
--

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
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
  `comments` text,
  `company` varchar(50) default NULL,
  `website` varchar(70) default NULL,
  `t1` tinyint(4) default 24,
  `t2` tinyint(4) default 24,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `tickets_users_username` (`username`),
  KEY `tickets_users_admin` (`admin`),
  KEY `tickets_users_status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcar la base de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `lastlogin`, `newlogin`, `admin`, `status`, `added`, `comments`, `company`, `website`) VALUES
(1, 'Unregistered', 'Unregistered', '', 'dd@este.com', NULL, NULL, 'User', 1, NULL, '  salvadores', 'salvador', 'dd@este.com'),
(8, 'The Administrator', 'admin', 'admin', '', 1273076629, NULL, 'Admin', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_staff`
--

DROP TABLE IF EXISTS `users_staff`;
CREATE TABLE `users_staff` (
  `userx` int(11) default NULL,
  `departament` tinyint(4) default NULL,
  `departament_visible` tinyint(4) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `users_staff`
--
INSERT INTO `users_staff` (`userx`, `departament`, `departament_visible`) VALUES
(9, 1, 1);


CREATE TABLE `users_staff_v_level` (
  `userx` int(11) default NULL,
  `depart` tinyint(4) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `users_staff_v_level` (`userx`, `depart`) VALUES
(9, 1);


CREATE TABLE `sca` (
  `id` bigint(20) NOT NULL auto_increment,
  `ticket_id` bigint(20) default NULL,
  `staff` varchar(16) default NULL,
  `tdate` int(10) unsigned default NULL,
  `oldd` int(11) default NULL,
  `newd` int(11) default NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `sla_t1` (
  `ticket` int(11) NOT NULL default '0',
  `created` bigint(10) default NULL,
  `t1_to_fix` bigint(10) default NULL,
  `t1_execute` bigint(10) default NULL,
  PRIMARY KEY  (`ticket`),
  UNIQUE KEY `ticket` (`ticket`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `sla_t2` (
  `ticket` int(11) NOT NULL default '0',
  `created` bigint(10) default NULL,
  `t1_to_fix` bigint(10) default NULL,
   `t1_execute` bigint(10) default NULL,
  PRIMARY KEY  (`ticket`),
  UNIQUE KEY `ticket` (`ticket`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `time_used` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket` int(11) DEFAULT NULL,
  `min` smallint(6) DEFAULT NULL,
  `tiem` int(11) DEFAULT NULL,
  `usua` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
