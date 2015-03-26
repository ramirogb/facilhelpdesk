<?php
$verbose=false;
$caracteres=100;//how many chars in notification to user and staff telling them a new ticket about ...
//ver FHD 3.1.1
$inicio=phpTime(); 
require ('includes/pop3.class.php5.inc');// for PHP 4.x use includes/pop3.class_obsolete.php
require_once('includes/mime_parser.php');
require_once('includes/rfc822_addresses.php');
include_once('config.php');
include_once('includes/functions.php');
include('includes/encrypt.php');
$fail_piping=false;
$inject=FALSE;
$crypt = new xcrypt;
$key_crypto='tickets'; //change to other seed
$crypt->crypt_key($key_crypto);
//whe we are going to Enter in a loop, declare your new objects here to avoid errors
$mensaje='';
$body_with_spam=false;

function getDomainFromEmail($email)    
{   
// Get the data after the @ sign   
$domain = substr(strrchr($email, "@"), 1);    
return $domain;   
}   
function phpTime (){
  $tTime = explode( " ", microtime());
  $dMsec = (double)$tTime[0];
  $dSec = (double)$tTime[1];
  return $dSec + $dMsec;
}


function filtro_spam($entrada)
{
global $keywords_spam;
$ww=$keywords_spam;
$rt=str_replace(chr(13),'',$ww);
$rt=str_replace(chr(10),'',$rt);
$lista=explode(',',$rt); //crea un array;
$entrada2=str_ireplace($lista,"",$entrada);
if  (strcmp($entrada2,$entrada)==0) //nada cambio con el reemplazo
   {
   return $entrada;
   }
   else
   {
   global $body_with_spam;
   $body_with_spam=TRUE;
   return '>> SPAM? - '.$entrada;
   }
}


function extract_emails_from($string)
 {
 preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $matches);
 return $matches[0];
 }
	
function array_find($needle, $haystack) //tiene que encontrar pero desde la pos 0, por que busco cabeceras
 {                  //asunto, email
   foreach ($haystack as $item)
   {
   $po=strpos($item, $needle);
      if ($po=== 0)
      {
         return $item;
         break;
      }
   }
}

$bUseSockets = TRUE;
$bUseTLS = FALSE;
$bIPv6 = FALSE;
$arrConnectionTimeout = array( "sec" => 10,"usec" => 500 );
// POP3 Options
$strProtocol= "tcp";
$intPort = 110;
$bAPopAutoDetect = TRUE;
$bHideUsernameAtLog = FALSE;



								//apop detect
//$pop3 = new POP3(FALSE,"log.txt",FALSE);
$pop3 = new POP3('log.txt',$bAPopAutoDetect,$bHideUsernameAtLog,$strProtocol,FALSE);

try{

    $queryf = 'SELECT * FROM spam ORDER BY id DESC';
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
	$resultf= $db->Execute($queryf );	 
	$rowf=$resultf->fields;
	$filtras=$rowf['filter'];
	
	$borras=$rowf['deletespam'];
	$keywords_spam=$rowf['spa']; //used in a function


 $query = 'SELECT * FROM tickets_categories ORDER BY tickets_categories_id ASC';
 	$db->SetFetchMode(ADODB_FETCH_ASSOC);
	  $resultvv = $db->Execute($query);
	 WHILE (!$resultvv->EOF)
  {   
 $rowvv=$resultvv->fields;
 $resultvv->MoveNext();
       	 //************
	 $email_depa=$rowvv['email'];

	 $la_casilla=$rowvv['emailpiping'];//from this address a notification will be sent used in functions.php
	  $domain =getDomainFromEmail($la_casilla);
	 //***********
	
if ($rowvv['epiping']=='1') //email piping enabled for this account
{
       $tamanofile=$rowvv['maxfile'];   
       //$do = $pop3->connect ($domain); for PHP <5.3
	    $pop3->connect($domain,$intPort,$arrConnectionTimeout,$bIPv6);//$domain
	   //connect( &$strHostname , $intPort = 110, $arrConnectionTimeout = array("sec" => 10, "usec" => 0) ,$bIPv6 = FALSE )
	     $pop3->login ($rowvv['emailpiping'],$rowvv['password']);
		 	 //echo "piping:".$rowvv['emailpiping'];
	   
	    if (1 == 2)
	   {
	   
	   }
       else
       { //do==TRUE
        //$status = $pop3->get_office_status(); commented prior to version 3, why?, i don't know
		//$status = $pop3->simple_list();//obsolete for new version of pop3
		$arrOfficeStatus = $pop3->getOfficeStatus();		
        $count = $arrOfficeStatus['count'];
		
        if ($verbose) echo  $count . ' new e-mails waiting for you!';
			
        for ($i = 1; $i <= $count; $i++)
        {		
		 //$email = $pop3->get_mail($i); obsolete from nov 2010
		 $email = $pop3->getMsg2($i);  //getMsg($i);		 
		            
          $para_dec='';
		  //var_dump($email);
		  
		 //echo "count tiene tantas lineas ".count($email); 
		 for ($ii = 1; $ii <= count($email) ; $ii++)
		 { $para_dec=$para_dec.$email[$ii]; } //aqui esta en array numerico todo
		 //$email = parse_email ($email);
		 //debo crear un array headers para sacar subject y otros y otro array numerico para luego decodificar
		 //asi evitare errores con yahoo 
		 //print_r($para_dec);
		 $el_asuntoX = array_find('Subject',$email);reset($email); //debo eliminar subject
		 $el_asunto=substr($el_asuntoX,9);		 
		 $val_x_origin = array_find('X-Originating-Email', $email);reset($email);		 
		 $val_x_origin =substr($val_x_origin,21);		 
		 $wwwa=trim($val_x_origin); $dfr=strlen($wwwa);		 
		 $el_origen=  substr($wwwa, 1, $dfr - 2);		 
		  $val_from = array_find('From', $email); reset($email);
		  $el_emailx=extract_emails_from($val_from);//el from no siempre tiene un email		 
		 $el_email=htmlentities(addslashes($el_emailx[0]) );		 		 
		 if  ( strlen( $el_email) <5 ) {$el_email=$el_origen;}	 
		 //$mensaje=  quoted_printable_decode(  strip_tags( $email['message'],'<html></html>') );		 
		   // Remove from mail server			  
        $pop3->deleteMsg ($i); 
				 
		 if (  trim(strtolower($el_email) ) == trim(strtolower($rowvv['emailpiping'])) )//para evitar un bucle,no puede venir un ticket de la misma cuenta que estamos leyendo
		 {
		 $inject=TRUE;
		 }else $inject=FALSE;
		 
		 if ($inject<>TRUE)
		 {		 
		     $el_asunto_temp = imap_mime_header_decode($el_asunto);
			  $verif ='';
			  $el_asunto=$el_asunto_temp[0]->text;//esarray
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
			  $ticket_original=$tickets_child;
			  }
			  else
			  { //new ticket will be created
			  $tickets_child=0; //this will be overwriten
			  }
			  
			  //=====Verification for avoid tickets injection==0 not email inject	  			  
  			  $first_ticket=FALSE;
			  if ( ($verif=='')and  ($tickets_child==0) )
			  {  $tickets_child=0; //new ticket
			  $first_ticket=TRUE; }
			  			  
			  $isresponse=FALSE;
			  if  (  ( $verif==$tickets_child )and ($verif<>''))
			  {
			  $isresponse=TRUE;
			  //echo 'es una respuesta';
			  $query56x = " UPDATE tickets_tickets	SET unread_admin='1' WHERE tickets_id   = '".$el_ticket."'";
			$resultzz =$db->Execute($query56x);
			
			 $query556 = "	UPDATE tickets_state SET tickets_status='1' WHERE  id='$el_ticket'";
			$resultzz =$db->Execute($query556);			
			  }
		  //========0
		//it works on the var $para_dec
		$mime=new mime_parser_class;
		include('includes/message_decoder.php'); //save the atachments		
		unset($mime);//fixed errors with several incoming		
    	//la variable tambien fue seteada $mensaje
		   $mensaje=addslashes($mensaje); //was created at message_decoder.php el cuerpo del correo
		   
			$categoria=$rowvv['tickets_categories_id'];			
			$filtroTi=false;$borroTi=false;			
			if ($filtras=='1')
			{$el_asunto=filtro_spam($el_asunto);}
			
			$queryzz = 'SELECT * FROM tickets_levels ORDER BY tickets_levels.orderx ASC';
			$db->SetFetchMode(ADODB_FETCH_ASSOC);
			$resultzz = $db->Execute($queryzz);
			$ghgh=  $resultzz->fields;
			$valorxx=$ghgh['id'];			
										
							$query = "	INSERT INTO tickets_tickets
							(tickets_username,tickets_subject,tickets_timestamp,tickets_urgency,tickets_category,
							tickets_child,tickets_admin,tickets_email,tickets_name,tickets_question)
							values ('".'Unregistered'
							."','".addslashes($el_asunto)
							."','".mktime()
							."','".$valorxx
							."','".$categoria
							."','".$tickets_child
							."','".'Unregistered'
							."','".$el_email
							."','".$el_from
							."','".$mensaje
							."')";							
							$db->Execute($query);			
						$msg_preview=substr(addslashes($mensaje),0,$caracteres).' ...';	
						$_SESSION['body10']=substr(addslashes($mensaje),1,10);                        

						
							 if ($dbms=='mssql') //used for storing uploaded file 				   
				   			{ $db->SetFetchMode(ADODB_FETCH_NUM);
							$resul_id = $db->Execute("select @@IDENTITY");
				   			$el_idx=$resul_id->fields;				      
				   			$var_tempox=$el_idx[0]; 
				   			}
				   			else
				   		{	$var_tempox=  $db->Insert_ID( );//if ticket child=0 entonces es un ticket nuevo entonces seteo unread_user   
				   		}					
						
						if ($tickets_child==0)
						{ //new ticket then we insert it in the subjet of the email
						
						    if ($dbms=='mssql')
				   			{ $db->SetFetchMode(ADODB_FETCH_NUM);
							$resul_id = $db->Execute("select @@IDENTITY");
				   			$el_idx=$resul_id->fields;				      
				   			$el_id=$el_idx[0]; 
				   			} else {$el_id=  $db->Insert_ID( );}
						
						
						$for_subjet=$el_id;	$clav=md5($el_email); 
						$w1= (rand()%31);$w2= (rand()%31);$w3= (rand()%31);$w4= (rand()%31);$w5= (rand()%31);
						$w6= (rand()%31);$clave=$clav[$w1].$clav[$w2].$clav[$w3].$clav[$w4].$clav[$w5].$clav[$w6];
						$query556 = "	INSERT INTO tickets_state (id,keyview) VALUES ('".$el_id."','".$clave."')";
					 	if ($verbose==TRUE) echo $query556;
												
							if ($filtras=='1')
							{  
							if( $body_with_spam==TRUE )
							{	 $query556 = "	INSERT INTO tickets_state (id,keyview,tickets_status) VALUES ('".$el_id."','".$clave."',".'5'."')";	 }
							}						
                    	 
				           $resultxx5 = $db->Execute( $query556 );
						   $el_ticket=$el_id;
						   //echo 'entre 1';
						} //end of new ticket
						else //ticket existente
						{
						$el_ticket=$var_tempox;
						//echo 'entre 2';
					}
				
			//now we store the atachemtnes
			//print_r($las_partes);
			$gtgt=addslashes($para_dec); //email with all headers las cabeceras tienen que tener autoinc por eso $var_tempox
			$query556A = "	INSERT INTO email_headers_tickets (tickets_id,tickets_header) values ('".$var_tempox."','".$gtgt."')";
			$resultxx5A = $db->Execute($query556A);			
			
		  for($renombrador = 0; $renombrador < count($las_partes); $renombrador++)
  {
    $wwww=$renombrador+1;
		
	 if(  	isset($las_partes[$renombrador][originalFileName]) )
     {	    
	  $the_name=$las_partes[$renombrador]['originalFileName'];	  	  
	  $rutami=addslashes( $the_name);	    
		$fp=fopen("upload/$wwww",'rb');	$tamanio=filesize("upload/$wwww");	
		//echo $tamanio;
		if (  $tamanio< $tamanofile )
		{$contenido=@fread($fp,$tamanio);}
		else
	{$rutami='File_was_deleted_too_big';$ggg=' Your File attachment was deleted, it exceded:'.$tamanofile.' Bytes';	}	
	$archi=addslashes($contenido);  fclose($fp);
	$query3x3 = "INSERT INTO tickets_atach(tickets_id ,atachmen,archi)  values($el_ticket,'$rutami', '$archi')";
	$result3x3=$db->Execute($query3x3);
     }	 
//	echo "borrando archivo $wwww";
@unlink("upload/$wwww");	
  }
													
						if ( $sendhtml=='TRUE' )
                        { $separator='<BR>'; }
     			        else      { $separator= chr(13).chr(10); // '\n\t'; 
				        }												
						$verif= $crypt->encrypt($el_ticket);						
						if ($first_ticket==TRUE) //first ticket then we insert the ID
						{$for_staff= '{{'. $el_ticket.'-'.$verif.'}}'.$el_asunto; //inserte ahora//echo 'primer ticket';
						}
						else	{//es una respuesta						
						$for_staff= $el_asunto;//echo 'Uso el mismo asunto';
						}
						
			
			if ($isresponse==TRUE) 
			{
				$el_ti= $ticket_original;
			}
			else
			{
				$el_ti= $var_tempox; //last id
				}
				
			
			
			$name='Unregistered';
			$dataText='Hello,'.$separator.'your ticket was stored, 						
			please wait for an answer of our staff members, '.$separator.$separator.'ticket ID: '.$el_ti.$separator
			.$separator.$ggg.'Ticket Key : '.$clave.$separator.'  IMPORTANT: If you respond this ticket do not change the subject line'
			.$separator.$siteurl;			
			$del_con=TRUE;//set to true if customization of email is required,at functions.php			
			$last_msg .=' '.SendMail($el_email,$el_from,$for_staff,$dataText);//to customer
			
			if ($emailstaff=='TRUE') {
			$for_staff='Staff New Ticket '.$el_ti;
			$last_msg .=' '.SendMail($email_depa,$el_from,$for_staff,$msg_preview); 
			}
		    //disabled 10/6/2009 if ($fail_piping==true){SendMail($el_email,$el_from,$error_msg2,$error_msg1);	}
		   
}//endif inject =true
} //of for

$pop3->quit();

} //of if=false no connection

} //of checking if email piping is enabled for this account

}//of the while



//if ($borras=='1')
{ //borr SPAM
//Misql 4.1
$sql3="select c.tickets_id from tickets_tickets as c WHERE
c.tickets_id in
(SELECT 
a.tickets_id from tickets_tickets as a, tickets_state as b
where  b.tickets_status = 5 and a.tickets_id=b.id and ( UNIX_TIMESTAMP()-  a.tickets_timestamp > 604800)
)";

  if ($dbms=='mssql')
  {

		    $qr="SELECT DATEDIFF(s, '19700101',     (select CONVERT(CHAR(10),GETDATE(),120) as e)        ) ";
	   $db->SetFetchMode(ADODB_FETCH_NUM);
	$res  = $db->Execute($qr); 
	$tiem=$res->fields[0];
	$sql3="select c.tickets_id from tickets_tickets as c WHERE
	c.tickets_id in
	(SELECT 
	a.tickets_id from tickets_tickets as a, tickets_state as b
	where  b.tickets_status = 5 and a.tickets_id=b.id and ( $tiem-  a.tickets_timestamp > 604800) )";
  
		  
 }
$db->SetFetchMode(ADODB_FETCH_NUM);
$resultxx5 =$db->Execute($sql3); 
$fff=$resultxx5->fields;

	do
	{
	$ticketid=$fff[0];
	
	 $query3x4 = "DELETE FROM   tickets_atach WHERE tickets_id=$ticketid ";
		   $result3x4 = $db->Execute($query3x4);
		   if ( $ticketid <>0 and $ticketid<>'')
		   {
		   $query = "DELETE FROM tickets_tickets
			WHERE tickets_id='$ticketid' 
			OR tickets_child='$ticketid' ";
			$db->Execute($query);
			}
			$query = "DELETE FROM tickets_state  WHERE id='$ticketid' ";
			$db->Execute($query);
			$query = "DELETE FROM tickets_poll  WHERE id='$ticketid' ";
			$db->Execute($query);
		$fff=$resultxx5->fields;
		 $resultxx5->MoveNext();
	}
	while (!$resultxx5->EOF);

}

} //try end
catch( POP3_Exception $e )
{
 $mensaje = addslashes("POP3 Error :$e  ").$rowvv['emailpiping']; 
        $querymensaje ="INSERT INTO error_log  (action,timestamp) values('".$mensaje."','".mktime()."')";
		$resultmesaje =$db->Execute($querymensaje);

  }

$fin=phpTime();
$resta=$fin-$inicio; //number to string
$resta=substr($resta,0,7);
$querymensaje ="INSERT INTO error_log (action,timestamp,delay) values ('Run ok','".mktime()."','".$resta."')";
$db->Execute($querymensaje);
include('includes/00.php');
echo '...Finished';
?>