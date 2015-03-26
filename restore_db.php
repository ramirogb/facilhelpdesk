<?php
		include('configuration.php'); 
  
  include_once("includes/iam_restore.php");
  #####################################################################################################################
  #  Set the parameters: backup_file, hostname, databasename, dbuser and password                                     #
  # (must have SELECT, INSERT, DELETE permission to the mysql DB)                                                     #
  #####################################################################################################################
   $restore = new iam_restore('dump.sql',$host,$data,$user,$pass);
   $restore->perform_restore(); 
   
   
   $conexionxcz1 = mysql_connect($host, $user, $pass) or trigger_error(mysql_error(),E_USER_ERROR); 
   	 mysql_select_db($data,$conexionxcz1) or trigger_error(mysql_error(),E_USER_ERROR); 
	 
   	$sql = "INSERT INTO  users (name,username,password,admin,status)values ('The Administrator','admin','admin','Admin','1')";	
    $result=mysql_query($sql,$conn);
    if( !$result ) 
    echo mysql_error( $result ); 
    else { 
    print "New administrator added : $user\n"; 
    }

   
   echo 'Fin';
   ?>