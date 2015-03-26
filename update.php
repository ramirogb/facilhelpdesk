<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: small;
}
.Estilo1 {color: #FF0000}
-->
</style></head>

<body>
<p align="center"><strong>Updating  Facil HelpDesk to the version 3.2 .Executing update.php
(Mysql Database)</strong></p>
<p align="center"><strong>Configuration:  config.php</strong></p>
<p>Read It:</p>
<p>Ignore warnings of this type: &quot;Duplicate column...&quot;, Except of this type: <span class="Estilo1">&quot;<strong>You have an error in your SQL syntax;</strong></span><strong>..</strong></p>
<p><strong>If you get errors, request help at <a href="cromosoft.com">cromosoft.com</a></strong></p>
</body>
</html>
<?php

echo "Starting changes in the Database, new fields will be added...";
echo '<BR>';
echo '<BR>';
echo "altering table: tickets_state";
echo '<BR>';
$last_msg='';
include_once('config.php');
include_once('check.php');
include_once('includes/functions.php');
$sql="ALTER TABLE tickets_state ADD COLUMN assigned varchar(1) AFTER tickets_status";
$result84 = mysql_query($sql)or print( mysql_error() );
echo '<BR>';
$sql="ALTER TABLE tickets_state ADD COLUMN assigned_to varchar(20) AFTER assigned";
$result84 = mysql_query($sql)or print( mysql_error() );
echo '<BR>';
$sql="ALTER TABLE tickets_tickets ADD COLUMN eta bigint(10) unsigned AFTER previous";
$result84 = mysql_query($sql)or print( mysql_error() );
echo '<BR>';

echo "altering table: tickets_categories";
echo '<BR>';

$sql="ALTER TABLE `tickets_categories` ADD `emailpiping` VARCHAR( 100 ) NOT NULL";
$result84 = mysql_query($sql)or print( mysql_error() );
echo '<BR>';

$sql="ALTER TABLE `tickets_categories` ADD `epiping` VARCHAR( 1) NOT NULL";
$result84 = mysql_query($sql)or print( mysql_error() );
echo '<BR>';


$sql="ALTER TABLE `tickets_categories` ADD `maxfile` int(6) default '1000000' ";
$result84 = mysql_query($sql)or print( mysql_error() );
echo '<BR>';

$sql="ALTER TABLE `tickets_categories` ADD `supervisor` VARCHAR(100)  NOT NULL";
$result84 = mysql_query($sql)or print( mysql_error() );
echo '<BR>';

$sql="ALTER TABLE `tickets_categories` ADD `sms` VARCHAR(15)  NOT NULL";
$result84 = mysql_query($sql)or print( mysql_error() );
echo '<BR>';

$sql="ALTER TABLE `tickets_categories` ADD `level` smallint(10)  NOT NULL";
$result84 = mysql_query($sql)or print( mysql_error() );
echo '<BR>';


$sql="ALTER TABLE `tickets_state` ADD `keyview` VARCHAR( 6 )" ;
$result84 = mysql_query($sql)or print( mysql_error() );
echo '<BR>';
echo "altering table: tickets_state";
echo '<BR>';
echo "creating tickets_atach:";
echo '<BR>';
$sql="CREATE TABLE `tickets_atach` (tickets_id int(10) unsigned,atachmen varchar(100) ) TYPE=MyISAM";
$result84 = mysql_query($sql)or print( mysql_error() );
echo '<BR>';
$sql="ALTER TABLE `tickets_atach` ADD `archi` MEDIUMBLOB";
$result84 = mysql_query($sql)or print( mysql_error() );

$sql="ALTER TABLE `tickets_atach` ADD `atachmen` VARCHAR( 100 )";
$result84 = mysql_query($sql)or print( mysql_error() );

$sql="ALTER TABLE tickets_atach ADD atachmen_new VARCHAR( 100 )";
$result84 = mysql_query($sql)or print( mysql_error() );

echo "creating SPAM:";
echo '<BR>';

$sql="CREATE TABLE `spam` (id bigint(10) NOT NULL,`spa` text,
  `filter` varchar(1) default NULL,
  `deletespam` varchar(1) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`) ) TYPE=MyISAM";
$result84 = mysql_query($sql)or print( mysql_error() );

echo "altering table error_log:";
echo '<BR>';
$sql="ALTER TABLE `error_log` ADD `delay` varchar(16) default NULL" ;
$result84 = mysql_query($sql)or print( mysql_error() );
echo '<BR>';

echo "altering table users adding SLA fields(works only  for Facil HelpDesk Full Edition)";
echo '<BR>';
$sql="ALTER TABLE `users` ADD `t1` tinyint(4) default NULL" ;
$result84 = mysql_query($sql)or print( mysql_error() );

$sql="ALTER TABLE `users` ADD `t1` tinyint(4) default NULL" ;
$result84 = mysql_query($sql)or print( mysql_error() );

echo '<BR>';



echo "altering table users_staff maps departments and staff members";
echo '<BR>';
$sql="ALTER TABLE `users_staff` ADD `departament_visible` tinyint(4) default NULL" ;
$result84 = mysql_query($sql)or print( mysql_error() );
echo '<BR>';


$sql="CREATE TABLE `email_queue` (
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
) TYPE=MyISAM";
$result84 = mysql_query($sql)or print( mysql_error() );
echo '<BR>';
$sql="CREATE TABLE `canned_replies` (
  `id` tinyint(10) NOT NULL auto_increment,
  `dep` tinyint(5) default NULL,
  `subjet` varchar(35) default NULL,
  `body` text,
  PRIMARY KEY  (`id`)) ENGINE=MyISAM AUTO_INCREMENT=12";
$result84 = mysql_query($sql)or print( mysql_error() );
echo '<BR>';
$sql="CREATE TABLE `email_headers_tickets` (
  `tickets_id` int(10) unsigned NOT NULL,
  `tickets_header` varchar(1500) NOT NULL,
  PRIMARY KEY  (`tickets_id`)
) ENGINE=MyISAM";
$result84 = mysql_query($sql)or print( mysql_error() );

$sql="CREATE TABLE `tracking` (
  `id` bigint(20) NOT NULL auto_increment,
  `ticket_id` bigint(20) default NULL,
  `staff` varchar(16) default NULL,
  `action` varchar(40) default NULL,
  `tdate` int(10) unsigned default NULL,
  UNIQUE KEY `id` (`id`)) ENGINE=MyISAM";
  $result84 = mysql_query($sql)or print( mysql_error() );
echo '<BR>';
$sql="ALTER TABLE tickets_tickets ADD COLUMN reserved varchar(1)";
$result84 = mysql_query($sql)or print( mysql_error() );
echo '<BR>';
$sql="ALTER TABLE tickets_poll ADD COLUMN comment TINYTEXT";
$result84 = mysql_query($sql)or print( mysql_error() );
echo '<BR>';
 
echo 'creating permissions to scalate tickets';
$sql="CREATE TABLE `users_staff_v_level` (
  `userx` int(11) default 24,
  `depart` tinyint(4) default 24
) ENGINE=MyISAM";
  $result84 = mysql_query($sql)or print( mysql_error() );
  
  $sql='CREATE TABLE `sca` (
  `id` bigint(20) NOT NULL auto_increment,
  `ticket_id` bigint(20) default NULL,
  `staff` varchar(16) default NULL,
  `tdate` int(10) unsigned default NULL,
  `oldd` int(11) default NULL,
  `newd` int(11) default NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1';
  $result84 = mysql_query($sql)or print( mysql_error() );
  //esto no existe en la version SQLServer
  $sql=  "ALTER TABLE `tickets_atach` ADD `id` INT NOT NULL AUTO_INCREMENT FIRST ,
ADD PRIMARY KEY ( `id` )";
  $result84 = mysql_query($sql)or print( mysql_error() );
  
echo '______________________________';

  $sql=  "ALTER TABLE `sla_t1` ADD `t1_execut`  bigint(10) DEFAULT NULL";
  $result84 = mysql_query($sql)or print( mysql_error() );
  
echo '______________________________';

  $sql=  "ALTER TABLE `sla_t2` ADD `t2_execut`  bigint(10) DEFAULT NULL";
  $result84 = mysql_query($sql)or print( mysql_error() );
  
echo '______________________________';


$sql="CREATE TABLE `time_used` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket` int(11) DEFAULT NULL,
  `min` smallint(6) DEFAULT NULL,
  `tiem` int(11) DEFAULT NULL,
  `usua` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1";
  $result84 = mysql_query($sql)or print( mysql_error() );


echo '<BR>';
echo '<BR>';
echo "Database update completed. Now copy new files";
?>