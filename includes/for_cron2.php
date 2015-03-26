<?php
require ('includes/pop3.class.php');
include_once('config.php');
include_once('includes/functions.php');
include('includes/encrypt.php');
$crypt = new xcrypt;
$crypt->crypt_key($key_crypto);
//whe we are going to use a loop declare your new objects here to avoid errors

$mensaje='';
function extract_emails_from($string)
 {
 preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $matches);
 return $matches[0];
 }
		  
function parse_email ($email)
 {        // Split header and message
        $header = array();
        $message = array();
        $is_header = true;
        foreach ($email as $line)
		{       if ($line == '<HEADER> ' . "\r\n") continue;
                if ($line == '<MESSAGE> ' . "\r\n") continue;
                if ($line == '</MESSAGE> ' . "\r\n") continue;
                if ($line == '</HEADER> ' . "\r\n") { $is_header = false; continue; }
                if ($is_header == true) {
                    $header[] = $line;}
					 else {
                    $message[] = $line;}
        }
// Parse headers
$headers = array();
foreach ($header as $line) 
     {
        $colon_pos = strpos($line, ':');
        $space_pos = strpos($line, ' ');
        if ($colon_pos === false OR $space_pos < $colon_pos) {
                // attach to previous
        $previous .= "\r\n" . $line;continue;    }
        // Get key
        $key = substr($line, 0, $colon_pos);
        // Get value
        $value = substr($line, $colon_pos+2);
        $headers[$key] = $value;
        $previous =& $headers[$key];
}
		$message = implode('', $message);
		// Return array
        $email = array();
        $email['message'] = $message;
        $email['headers'] = $headers;
        return $email;

     return $email;
}


$pop3 = new POP3;
 $query = 'SELECT * FROM tickets_categories ORDER BY tickets_categories_id ASC';
		  $resultvv = mysql_query($query);
 WHILE ($rowvv = mysql_fetch_array($resultvv))
{   
     $arr = explode('@',$smtpauthuser);
     $domain = $arr[1];
   	 //************
	 $la_casilla=$rowvv['emailpiping'];//from this address a notification will be sent used in functions.php	  
	 //***********
if ($rowvv['epiping']=='1') //email piping enabled for this account
{

      $do = $pop3->connect ($domain);
               if ($do == false)
	           {
		       $mensaje = addslashes('Error connecting at:'.$domain.' '.$pop3->error);
        echo $querymensaje ="INSERT INTO error_log SET action='$mensaje', timestamp='".mktime()."'";
               $resultmesaje = mysql_query( $querymensaje);
		       echo $mensaje;
	           die($pop3->error);
	           }
       $do = $pop3->login ($rowvv['emailpiping'],$rowvv['password']);
	   
       if ($do == false)
	   {
	   $mensaje =addslashes('login error with '.$rowvv['email'].' '.$pop3->error);
	   $querymensaje ="INSERT INTO error_log SET action='$mensaje', timestamp='".mktime()."'";
       $resultmesaje = mysql_query( $querymensaje);
	   echo $mensaje;
	   }
       else
       { //do==TRUE
        $status = $pop3->get_office_status();
        if ($status == false)
		  {
		  $mensaje=addslashes('Error getting status '.$pop3->error);
          $querymensaje ="INSERT INTO error_log SET action='$mensaje', timestamp='".mktime()."'";
          $resultmesaje = mysql_query( $querymensaje);
		  echo $mensaje;		
		  }
        $count = $status['count_mails'];
         //echo 'There are ' . $count . ' new e-mails waiting for you!';		 

        for ($i = 1; $i <= $count; $i++)
        {
		 $email = $pop3->get_mail($i);
                    if ($email == false) {
		            $mensaje= addslashes('error: '.$pop3->error);
		            $querymensaje ="INSERT INTO error_log SET action='$mensaje', timestamp='".mktime()."'";
                    $resultmesaje = mysql_query( $querymensaje);
		            echo $mensaje;
		            continue;
		            } 

         // echo 'estoy en el correo'.$i;		 
		 
		// print_r($email);

         $para_dec='';
		 for ($ii = 1; $ii <= count($email) ; $ii++)
		 {
		 $para_dec=$para_dec.$email[$ii].chr(13).chr(10);
		 }
		 //print $para_dec;
		 
		 
		 $email = parse_email ($email);		 
		 
		 $el_from= trim(     ($email['headers']['From']) );
		 $el_asunto= ($email['headers']['Subject']);
		 //$mensaje=  quoted_printable_decode(  strip_tags( $email['message'],'<html></html>') );
		 
		 //$inix=strpos($mensaje,'Content-Type: text/plain;',0);
		 //$finx=strpos($mensaje,'------=_NextPart',$inix);
		 
		 /*
		 if ($inix==FALSE)
		 { //search FIRST for text version of our email body else for the html 
		 $inix=strpos($mensaje,'Content-Type: text/html;',0);		 
		 }
		 else
		 {	 
		 //nothing to do
		 } //if still was imposible to find the beginning of the email we use everything		
		 
		 if ($inix==FALSE)
		 {		 
         $mensaje=addslashes( $mensaje);
		 }
		 else
		 {
		 $mensaje=addslashes(  substr($mensaje,$inix,$finx-$inix) );
		 }
		 */
		 		 		 
		 $el_email=extract_emails_from($el_from);		 
		 $el_email=htmlentities(addslashes($el_email[0]) );
			  // Remove from mail server			  
              $do = $pop3->delete_mail ($i);		  
			  
              if ($do == false) 
              {  
			  $mensaje =addslashes('error deleting mail: '.$i.' '.$pop3->error);
              $querymensaje ="INSERT INTO error_log SET action='$mensaje', timestamp='".mktime()."'";
              $resultmesaje = mysql_query( $querymensaje);
			  echo $mensaje;
			   }
			   
			   
			 $el_asunto_temp = imap_mime_header_decode($el_asunto) ;
			 //print_r($el_asunto_temp);
			  $verif ='';
			  $el_asunto=$el_asunto_temp[0]->text;			 
			  $inicio=strpos($el_asunto,'{{');
			  $fin=strpos($el_asunto,'}}');
			  $allvar=substr($el_asunto,$inicio+2,$fin-$inicio-2); //we separate this var			  			  
		  

			  if ( ($inicio>0) and ($fin>0)  )
			  {
			  $inicio=strpos($allvar,'-');
			  $largo=strlen($allvar);			  
			  $tickets_child =substr($allvar,0,$inicio);
  			  $verif =substr($allvar,$inicio+1,$largo-$inicio);			  
              $verif= $crypt->decrypt($verif);
			  }
			  //echo 'verif antes de nada='.$verif.'</BR>';			  		
              			  			  
			  if (is_numeric($tickets_child) )
			  {
			  $for_subjet=$tickets_child;
			  $el_ticket=$tickets_child;
			  }
			  else
			  { //new ticket will be created
			  $tickets_child=0; //this will be overwriten
			  }		  			  
			  
			  //=====Verification for avoid tickets injection==0
			 // echo 'verif='.$verif.'</BR>';
			 // echo '$tickets_child='.$tickets_child.'</BR>';
			  			  
  			  $first_ticket=FALSE;
			  if ( ($verif=='')and  ($tickets_child==0) )
			  {
  			  $tickets_child=0; //new ticket
			  $first_ticket=TRUE;
			  }
			  			  
			  $isresponse=FALSE;
			  if  (  ( $verif==$tickets_child )and ($verif<>''))
			  {
			  $isresponse=TRUE;
			  //echo 'es una respuesta';
			  }
			  //========0
		
		echo 'antes de decoder.php'; 
		//it works on the var $para_dec
        include('message_decoder.php'); //save the atachments
    	//la variable tambien fue seteada $mensaje
			  
		  $mensaje=addslashes($mensaje); //was stored at message_decoder.php
			$categoria=$rowvv['tickets_categories_id'];
			  $query = "	INSERT INTO tickets_tickets
							SET
							tickets_username  = '".'Unregistered'."',
							tickets_subject   = '".addslashes($el_asunto)."', 
							tickets_timestamp = '".mktime()."',
							tickets_urgency   = '1',
							tickets_category  = '".$categoria."',
							tickets_child 	  = '".$tickets_child."',
							tickets_admin 	  = '".'Unregistered'."',
                            tickets_email 	  = '".$el_email."',
                            tickets_name 	  = '".$el_from."',														
							tickets_question  = '".$mensaje."'";
						$msg_preview=substr(addslashes($mensaje),0,100).' ...';	
						$_SESSION['body10']=substr(addslashes($mensaje),1,10);
							
                        $resultxx5 = mysql_query( $query);
						
						if ($tickets_child==0)
						{ //new ticket then we insert it in the subjet of the email						
		 				$el_id=mysql_insert_id();
						$for_subjet=$el_id;
						$clave=md5($el_email);
						$query556 = "	INSERT INTO tickets_state SET id='$el_id',keyview='$clave'";
                        $resultxx5 = mysql_query( $query556 );
					   $el_ticket=$el_id;
						
						} //end of new ticket						
								
						//now we store the atachemtnes
		  for($renombrador = 0; $renombrador < count($result); $renombrador++)
  {
     if(  ($result[$renombrador]['type'] <> 'text/html') and  ($result[$renombrador]['type'] <> 'text/plain')  )
     {
	  $newname=$result[$renombrador]['originalFileName'];
	  rename($result[$renombrador]['file'],$newname);	
	 $query3x3 = "INSERT INTO atachmen values($el_ticket,$newname)";
 	 $result3x3 = mysql_query($query3x3);	 
     }
	
  }

				
						 
													
						if ( $sendhtml=='TRUE' )
                        { $separator='<BR>'; }
     			        else
				        { $separator= chr(13).chr(10); // '\n\t'; 
				        }
												
						$verif= $crypt->encrypt($el_ticket);
						
						if ($first_ticket==TRUE) //first ticket then we insert the ID
						{
						$for_staff= '{{'. $el_ticket.'-'.$verif.'}}'.$el_asunto; //inserte ahora
						//echo 'primer ticket';
						}
						else
						{//es una respuesta						
						$for_staff= $el_asunto;						
						//echo 'Uso el mismo asunto';
						}
						
			$name='Unregistered';
			$dataText='Hello,'.$separator.'your ticket was stored, 						
			please wait for an answer of our staff members, ticket ID: '
			.$el_ticket.$separator.' IMPORTANT: If you respond this ticket do not change the subject line';
			//.$separator.$msg_preview;
			$del_con=TRUE;//set to true if customization of email is required,at functions.php
			$last_msg .=' '.SendMail($el_email,$el_from,$for_staff,$dataText);
} //of for
$pop3->close();

} //of if=false no connection

} //of checking if email piping is enabled for this account

}//of the while

?>