<?php 
include_once('config.php');
include('includes/check.php');
$ti= trim($_GET['ticket']);
$fi=trim($_GET['file']);
 $query3x3 = "SELECT * FROM   tickets_atach WHERE tickets_id=$ti and atachmen='$fi'";
 $db->SetFetchMode(ADODB_FETCH_ASSOC);
 $result3x3  = $db->Execute($query3x3);
$row3x3=$result3x3->fields;
$fin_=$row3x3['atachmen'];
$ti_=$row3x3['atachmen_new'];
//  header("Content-length: '$size'");
 header("Content-Description: PHP Generated Data"); 
 header("Pragma: public"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Cache-Control: public", false); 
header("Content-Description: file Transfer"); 
header("Accept-Ranges: bytes"); 
//$fin_=$row3x3['atachmen'];
header("Content-Disposition: attachment; filename=\"" .$fin_. "\";"); 
header("Content-Transfer-Encoding: binary"); 
//header("Content-Length: ".strlen($row3x3['archi']) ); 
//header("Content-Length: 1024"); 

  $adjunto= $row3x3['archi'];
  echo $adjunto;
  exit;



//$extension=  strtolower( ( substr(strrchr($atach, '.'), 1)) );
//$size=strlen($ini);

/*if ($fin_<>'')
{//
$fin="$uploadpath$fin_"; //nombre verdadero
 $ini="$uploadpath$ti_"; 
}//
*/

/*
 if (1==2)
 {
 $compatibilidad=true;
  $type=filetype( $ini);
$size= filesize($ini);
 header("Content-length: '$size'");
 header("Content-Description: PHP Generated Data"); 
 header("Pragma: public"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Cache-Control: public", false); 
header("Content-Description: file Transfer"); 
header("Content-Type: " . $type); 
header("Accept-Ranges: bytes"); 
header("Content-Disposition: attachment; filename=\"" .$fin_. "\";"); 
header("Content-Transfer-Encoding: binary"); 
header("Content-Length: " . filesize($ini)); 
		if ($stream = @fopen($ini, 'rb'))
		{ 
			while(!feof($stream) && connection_status() == 0)
			{//reset time limit for big files 
			//set_time_limit(0); 
			echo(fread($stream,1024*8)); 
			//flush(); 
			}
		 	fclose($stream);
			}
		else
		{
		echo 'not found';
		}

 }
 else
 {
 }
 */		
?>