<p>Facil HelpDesk Diagnostico</p>
<p>&nbsp;</p>
<p><a href="test_conection.php?action=1">Test Connection &amp; run  SQL </a></p>
<p><a href="test_conection.php?action=2">Watch privileges of user</a> </p>
<p><a href="test_conection.php?action=3">Show table users</a></p>
<p><a href="test_conection.php?action=4">Describe tables</a> </p>
<p><a href="test_conection.php?action=5">PHP Info</a> </p>
<p>&nbsp; </p>
<?php
include('configuration.php');
echo 'Paso comun crear la conexion:  mysql_connect host, user, pass<BR>';
$conexionxcz1 = mysql_connect($host, $user, $pass) or trigger_error(mysql_error(),E_USER_ERROR); 
if ($_GET['action']==1)
{
	echo "Ejecutaremos una instruccion SQL en la base Mysql , si no llega a step 2 verificar.<BR>";
	echo 'Step 1 seleccionare la Base de datos '.$data.'<BR>';
	 mysql_select_db($data,$conexionxcz1) or trigger_error(mysql_error(),E_USER_ERROR); 
	 echo 'Step  1 OK <BR>El usuario fue aceptado para conectarse a la base de datos<BR>';
	//$sql= "SELECT * FROM `information_schema`. USER_PRIVILEGES";
	//$sql="SHOW GRANTS FOR CURRENT_USER";
	$sql="step 2 show tables sera ejecutado, se listaran las tablas existentes en la base de datos configurada $data";
	$sql="show tables";
	$result = mysql_query($sql); 
	  while ($rowchi=mysql_fetch_row( $result)  )
	  {print_r($rowchi).'<BR>'; }  
	  echo '<p>---</p>';echo 'Step 2 OK Si llego a esta parte Facil HelpDesk puede ejecutar un select';
	exit;
}
if ($_GET['action']==2)
{
	$data='mysql';
	echo 'step 1 seleccionare la Base de datos del sistema '.$data.' Son dos pasos:<BR><BR>';
	 mysql_select_db($data,$conexionxcz1) or trigger_error(mysql_error(),E_USER_ERROR); 
	echo $sql="SELECT host,user,select_priv,insert_priv,update_priv,delete_priv      FROM user";
	  $result = mysql_query($sql);   
	  while ( list($a,$b,$c,$d,$e,$f,$g ) =mysql_fetch_row( $result)  )
	  {  echo "$a  $b  $c  $d  $e $f $g <BR>";  }  echo '<p>---</p>'; 
	echo 'Step 2 OK si puede leer se mostraron los privilegios  basicos del usuario sobre el sistema' ;
}

if ($_GET['action']==3)
{
	echo "Ejecutaremos SELECT  username FROM USERS , si no llega a step 2 verificar.<BR>";
	 mysql_select_db($data,$conexionxcz1) or trigger_error(mysql_error(),E_USER_ERROR); 
	$sql="select username from users";
	$result = mysql_query($sql); 
	  while (list($a)=mysql_fetch_row( $result)  )
	  {echo "$a<BR>"; }  
	  echo '<p>---</p>';echo 'Step 2 OK Si llego a esta parte Facil HelpDesk puede ejecutar un select';



}

if ($_GET['action']==4)
{
	echo "Ejecutaremos SELECT  username FROM USERS , si no llega a step 2 verificar.<BR>";
	 mysql_select_db($data,$conexionxcz1) or trigger_error(mysql_error(),E_USER_ERROR); 
	
	$res = mysql_query('DESCRIBE  users');
    while($row = mysql_fetch_array($res)) 
	{ echo "{$row['Field']} - {$row['Type']}\n";}

    echo '<BR> viene ticket_tickets';
	$res = mysql_query('DESCRIBE  tickets_tickets');
    while($row = mysql_fetch_array($res)) 
	{ echo "{$row['Field']} - {$row['Type']}\n";}

    echo '<BR> viene tickets_state <BR> ';
	
	$res = mysql_query('DESCRIBE  tickets_state');
    while($row = mysql_fetch_array($res)) 
	{ echo "{$row['Field']} - {$row['Type']}\n";}
	
	    echo '<BR> viene tickets_levels <BR> ';

	$res = mysql_query('DESCRIBE  tickets_levels');
    while($row = mysql_fetch_array($res)) 
	{ echo "{$row['Field']} - {$row['Type']}\n";}

	    echo '<BR> tickets_categories <BR> ';
		
	$res = mysql_query('DESCRIBE  tickets_categories');
    while($row = mysql_fetch_array($res)) 
	{ echo "{$row['Field']} - {$row['Type']}\n";}

	  
	  
	   echo '<p>---</p>';echo 'Step 2 OK Si llego a esta parte Facil HelpDesk puede ejecutar un select';



}


if ($_GET['action']==5)
{
echo phpinfo();
}


?>