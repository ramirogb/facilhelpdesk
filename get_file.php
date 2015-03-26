<?php 
include_once('config.php');
include('check.php');
include_once('includes/functions.php');

$ti= trim($_GET['ticket']);
$atach= urldecode(trim($_GET['_file']));
$query3x3 = "SELECT archi FROM   tickets_atach WHERE tickets_id=$ti AND atachmen='$atach'";
$result3x3 = mysql_query($query3x3);
$row3x3=mysql_fetch_assoc( $result3x3);
//$extension=  strtolower( ( substr(strrchr($atach, '.'), 1)) );
//$type=filetype( $atach );
$size=strlen($row3x3['archi']);
//header("Content-type: $type");

 header("Content-length: $size");
 header("Content-Disposition: attachment; filename=$atach"); 
 header("Content-Description: PHP Generated Data"); 
 echo $row3x3['archi'];

?>