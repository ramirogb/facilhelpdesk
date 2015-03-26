<?php

if (  isset($_GET['canned']) )
{
   $id=$_GET['canned'];
	$query57c = "	SELECT body from canned_replies where id='$id'  ";	 
	 $result57c = mysql_query($query57c);	
	 $row3c=mysql_fetch_assoc( $result57c); 
	 $esto='HOLAS';


echo "<SCRIPT language=JavaScript>
var salida='';";
echo 'salida= '.$row3c['body'].'</script>';

}
?>
