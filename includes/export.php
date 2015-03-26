<?php

include_once('../config.php');
//include('check.php');
include_once('functions.php');

$query='select `tickets_tickets`.`tickets_id`,tickets_tickets.tickets_question from `tickets_tickets` WHERE `tickets_tickets`.`tickets_child`=0';
$result	   =  $db->Execute($query);
			$totaltickets =$result->RecordCount();			
			
			WHILE (!result->EOF)
				{
				$row = $result->fields;
				$result->MoveNext();
				$tic=$row[0];
			$query2="select tickets_id,tickets_question from tickets_tickets WHERE tickets_child='$tic' order by tickets_id asc";
			$result2 = $db->Execute($query2);
			
			
			$texto =$row[1];
			
			
			WHILE (!$result2->EOF)
				{$row2=$result2->fields;
				$result2->MoveNext();
				$stringData = $texto."\n";
				$texto = $texto.$row2[1];
						
				}				
				$myFile = "reportes\\".$tic.".txt";
				$fh = fopen($myFile, 'w') or die("can't open file");
				$stringData = $texto."\n";
				fwrite($fh, $stringData);			
				fclose($fh);			
		}						
				
				

?>
