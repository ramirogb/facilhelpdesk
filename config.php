<?php
error_reporting(E_ALL ^ E_NOTICE);

$allowreg = 'ON';
@include('configuration.php');
@include('../configuration.php');
//Used by KB
 $DBName = $data;
$DBUser = $user;
 $DBPassword = $pass;
 $DBHost = stripslashes( $host);

 
$hostname_conexion1=$DBHost;
$database_conexion1=$DBName;
$username_conexion1=$DBUser;
$password_conexion1=$DBPassword;

//==========CHANGE DATABASE====
include("includes/adodb510/adodb.inc.php");
//$dbms='mssql'; //or mysql

 if ($dbms=='mysql')
{
$db = NewADOConnection('mysql');
 $db->PConnect($hostname_conexion1, $username_conexion1,$password_conexion1, $database_conexion1);
 }
 if ($dbms=='mssql')
 {  $db =& ADONewConnection('odbc_mssql');
      $dsn = "Driver={SQL Server};
	  Server=$hostname_conexion1; 
	  Database=$database_conexion1;";//helpdesk
	  	 $db->Connect($dsn,$username_conexion1,$password_conexion1);
         //$db->Connect($dsn,'sa','$A234dAS');
		 //server  RAMIRO1\SQLEXPRESS;
		 $ADODB_COUNTRECS = true;
}		 
//============================= 

    $maintablewidth = '100%';
    $maintablealign = 'center';
    // MAIN TITLE BAR
    $background =  '#E0EBF5'; 
    $backover   = '#AABBDD';  
    $backout    =   '#057BFE'; 
    // DATE FORMATS
    $dformatemail   = 'D d M Y H:i:s';          // CHANGES THE DATE FORMAT WITHIN THE EMAILS
	
	
	
	 // ALLOWED TYPES COPY THE RELEVANT ITEM TO THIS STRING
				    $filetypes =    array (
                'image/pjpeg'       => '.jpg',
                'image/jpeg'        => '.jpg',
               'image/gif'     => '.gif',
               'image/x-png'     => '.png',
              'application/msword'    => '.doc',
              'application/pdf'   => '.pdf',
	      'application/x-zip-compressed' => '.zip',
		  'application/vnd.openxmlformats-officedocument.wordprocessingml.document'    => '.docx',
		  'application/vnd.openxmlformats-officedocument.presentationml.presentation'    => '.pptx',
		  'application/vnd.openxmlformats-officedocument.presentationml.slide'    => '.sldx',
		  'application/vnd.openxmlformats-officedocument.presentationml.slideshow'    => '.ppsx',
		  'application/vnd.openxmlformats-officedocument.presentationml.template'     => '.potx',
		  'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'         => '.xlsx',
		  'application/vnd.openxmlformats-officedocument.spreadsheetml.template'    => '.xltx',
		  'application/vnd.openxmlformats-officedocument.wordprocessingml.template'    => '.dotx',
                );
		
			
				
   $allowedtypes_ = array('jpg','gif','png','doc','pdf','zip','docx','pptx','sldx','ppsx','potx','xlsx','xltr','xltx','dotx');			
				
    $allowedtypes = array(
               'image/pjpeg',         
               'image/jpeg',
               'image/gif',
               'image/x-png',
               'application/msword',
               'application/pdf',
               'application/x-zip-compressed',
			   'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			   'application/vnd.openxmlformats-officedocument.presentationml.presentation',
		  		'application/vnd.openxmlformats-officedocument.presentationml.slide',
		  		'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
		  		'application/vnd.openxmlformats-officedocument.presentationml.template',
		  		'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		  		'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
		  		'application/vnd.openxmlformats-officedocument.wordprocessingml.template',			   
                );
				
		
		if ($allowrar=='TRUE' )
	{
	$el_rar=array('application/octet-stream' => 'rar');
	
	$filetypes[]= $el_rar;	
	$allowedtypes_[]='rar';
	$allowedtypes[]='application/octet-stream';
	}		

   	   $my_version='3.1';				
?>