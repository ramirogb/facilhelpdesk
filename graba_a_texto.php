<?php
   session_start();
   include_once('config.php');
   include_once('includes/functions.php');	
   $query_con="select * from tickets_tickets where tickets_child='0'";
   $result_con  = mysql_query($query_con);	
   
   $separador= chr(10);
   
   //$tic=mysql_fetch_assoc($result_con);   
   WHILE (   $tic=mysql_fetch_assoc($result_con)      )
		{
		$el_ti=$tic['tickets_id'];
		//echo $el_ti.'<BR>';
		 $query_last_eta="SELECT a.eta,a.tickets_question
        			FROM tickets_tickets a WHERE (a.tickets_id = '".$el_ti."'
					OR tickets_child = '".$el_ti."') ORDER BY tickets_id ASC"; 
					//will be used to insert the time of response.
					$last_eta = mysql_query($query_last_eta);
					
					$yyy_eta=mysql_fetch_assoc($last_eta);
					$tickets_question=''.$separador;
					do
					{
					$tickets_question= $tickets_question.$separador.stripslashes( $yyy_eta['tickets_question']).$separador;
					
					}
					while (  $yyy_eta=mysql_fetch_assoc($last_eta) );
					
					 $search = array ("'<script[^>]*?>or .*?</script>'si",  // Strip out javascript 
                 "'<[/!]*?[^<>]*?>'si",          // Strip out HTML tags 
                 "'([rn])[s]+'",                // Strip out white space 
                 "'&(quot|#34);'i",                // Replace HTML entities 
                 "'&(amp|#38);'i", 
                 "'&(lt|#60);'i", 
                 "'&(gt|#62);'i", 
                 "'&(nbsp|#160);'i", 
                 "'&(iexcl|#161);'i", 
                 "'&(cent|#162);'i", 
                 "'&(pound|#163);'i" 
                 
                );                    // evaluate as php 

$replace = array ("", 
                 "", 
                 "\1", 
                 "\"", 
                 "&", 
                 "<", 
                 ">", 
                 " ", 
                 chr(161), 
                 chr(162), 
                 chr(163) 
                 
                 ); 

//$tickets_question = preg_replace($search, $replace, $tickets_question); 

					
					
					echo $tickets_question;
					$filename='tickets/'.$el_ti.'.txt';
					$fc = fopen("$filename", "wb"); 
					fwrite($fc,$tickets_question);
		
		
		}
		


?>