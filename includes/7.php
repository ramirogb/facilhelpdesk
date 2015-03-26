<?php 

$arch='../upload/2';
   $fp=fopen($arch,'r');
	$tamanio=filesize($arch);
	$mensaje=fread($fp,$tamanio);
	
echo $mensaje.'Fikkn';

?>