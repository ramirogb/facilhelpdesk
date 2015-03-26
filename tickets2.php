<?php
$demoxx=false;
session_start();
date_default_timezone_set('America/Lima');

$last_msg='';
include('config.php');
include('includes/check.php');
$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],$phpself)) . $phpself;
$rtcv=$_SERVER['PHP_SELF'];
include_once('includes/functions.php');include_once('includes/encrypt.php');$key_crypto='tickets'; //change to other seed

user_level2(); //detect the user level
//$_GET['order']='1'; //by default opened tickets	
//======CLOSE SESSION============================
function mysqlToUnix ($datetime) {
    if ($datetime) $parts = explode(' ', $datetime);
    $datebits = explode('-', $parts[0]);
    if (3 != count($datebits)) return -1;
    if (isset($parts[1])) {
        $timebits = explode(':', $parts[1]);
        if (3 != count($timebits)) return -1;
        return mktime($timebits[0], $timebits[1], $timebits[2], $datebits[1], $datebits[2], $datebits[0]);
    }
    return mktime (0, 0, 0, $datebits[1], $datebits[2], $datebits[0]);
     }  


IF (isset($_GET['action']) && $_GET['action'] == 'Logout')
		{unset($_SESSION['stu_username']);
		unset($_SESSION['stu_password']);
		//algo pasa aqui que no puedo matar la sesion
		session_destroy();
		$jump_here="Location: ".'./index_admin.php?action=login';	
	    header($jump_here); }
//==CLOSE TICKETS=======
IF (!isset($_GET['action']))
		{ $_GET['action'] = 'Login';}		
		
	IF (!isset($_REQUEST['lang']))
		{$_REQUEST['lang'] = $langdefault;}		
	$inc='language/'.$_REQUEST['lang'].'.php';	
	if (file_exists($inc)){	include($inc);}else 
	{$_REQUEST['lang'] = $langdefault;$inc='language/'.$_REQUEST['lang'].'.php';include($inc);	}
$status=array(0=>$clo, 1=>$opn,2=>$hol);
if (check_login2()==false)
{ include('includes/timeout.php');exit;}
if (user_level2()==0) //to avoid end users.
{ include('includes/timeout.php');exit;}

if (isset($_GET['order_users']))
{
if ($_GET['order_users']=='id') {$_SESSION['ord_usr']='id';}
if ($_GET['order_users']=='username') {$_SESSION['ord_usr']='username';}
if ($_GET['order_users']=='date') {$_SESSION['ord_usr']='added';}
}

//=======CHANGE STATE OF TICKETS===============
$var_tem=0;
if (  ($_GET['action']=='close')or ($_GET['action']=='hold') or ($_GET['action']=='unhold')or ($_GET['action']=='reopen') or isset($_POST['change_state'])  )
{
$ticketid=$_GET['ticketid'];
if ($_GET['action']=='hold') $reten=1;

		$query556 = "	INSERT INTO tracking 	(ticket_id,staff,action,tdate) values ('".$ticketid."','".$_SESSION['xcv_userna']."','".$_GET['action']."','".mktime()."')";
		if ($_GET['action']<>'home')
		{ 
		$resultxx5 = $db->Execute( $query556 );
		}
		$cerrare=false;
if ( $_GET['action']=='close')
{$cerrare=true;}
              if (  $_GET['action']=='close' )
              { //--
              $action='0'; //set this ticket state (closed)
              $_GET['action']=home;
              $var_tem=1; //lo que graba en la DB
			 $tickedid=$_GET['ticketid'];			 
			 
			 if ($emailclose=='TRUE') //email user if staff closes a ticket
			 {
			$query84="SELECT * from tickets_tickets WHERE tickets_tickets.tickets_id ='$tickedid'";
			$db->SetFetchMode(ADODB_FETCH_ASSOC);
			$result84 = $db->Execute($query84 );
			$fila84=$result84->fields;
			$the_email=$fila84['tickets_email'];
			$user84= htmlentities( $fila84['tickets_name']);
			$message=" $dear "." ".$user84.", $theticket "."$tickedid. $wasclosed "." ".$sitename;
		    $last_msg .=' '.SendMail($the_email,$user84,$ticketclosed, $message);
			}			  
              } //---
              if (  $_GET['action']=='reopen')
              {              $action='1';
              $_GET['action']=home;
              $var_tem=1;
  			  $opcional= ", hold_by=''"; }
              if (  $_GET['action']=='hold')
              {   $action='2';
              $_GET['action']=home;
              $var_tem=1; //esto es simplemente para ques e autorize el cambio
			  $opcional= ", hold_by='".$_SESSION['xcv_userna']."' ";  }


              if (  $_GET['action']=='unhold')
              {
              $action='1';
              $_GET['action']=home;
              $var_tem=1; //esto es simplemente para ques e autorize el cambio
			  $opcional= ", hold_by=''";
              }

             if (  isset($_GET['ticketid']) and ($var_tem==1) )
              {//==000
			   $ticketid=$_GET['ticketid'];
                $query = "	UPDATE tickets_state	SET tickets_status = '".$action."'$opcional
                WHERE id   = '".$ticketid."'";
				
              if (  $cerrare===true) 
			  {
		$query = " UPDATE tickets_state	SET tickets_status = '".$action."'
			  , closed_by='".$_SESSION['xcv_userna']."'
              WHERE id   = '".$ticketid."'";
			  }				
			    IF (! $db->Execute($query)){$message='Was not posible to change status of ticket';}
				//if ($reten==1)
				{				
				 						
							
							 $query = "	INSERT INTO tickets_tickets
							(tickets_username,tickets_subject,tickets_timestamp,tickets_urgency,tickets_category,
							tickets_child,tickets_admin,tickets_email,eta,previous,reserved ,tickets_question)
							values 
							('".''
							."','".''
							."','".mktime()
							."','".''
							."','".''
							."','".''
							."','".$_SESSION['xcv_userna']
							."','".''
							."','".$eta_
							."','".''
							."','".'1'
							."','".''.")";				
							
							$db->Execute($query);
					}
			   
               }//==00000000

 if (     isset($_POST['ticket'])   )  FOREACH ( $_POST['ticket'] AS $ticketid)
{
        $action=$_POST['change_state'];
		$wwe=$status[$action];			   

		$queryas = "	INSERT INTO tracking 	(ticket_id,staff,action,tdate) values ('".$ticketid."','".$_SESSION['xcv_userna']."','".$wwe."','".mktime()."')";
        { $resultxx5 = $db->Execute( $queryas ); }
			   
              if  ($action==2) 
			  {//11
			  $delete_tickets=TRUE;			  
			    if ($delete_tickets=='TRUE')
			       {
			//==files deleting
		   $query3x4 = "DELETE FROM   tickets_atach WHERE tickets_id=$ticketid ";
		   $result3x4 = $db->Execute($query3x4);   	       
			
		   $query3x3x = "SELECT tickets_id FROM   tickets_tickets WHERE tickets_child=$ticketid";
 	       $resultabc = $db->Execute($query3x3x);

		  while (!$resultabc->EOF)
		   {
			//deleting of the main ticket	
		   $rowchi= $resultabc->fields;
		   $padre=$rowchi[0]; $query3x4 = "DELETE FROM   tickets_atach WHERE tickets_id=$padre ";  $result3x4 = $db->Execute($query3x4);
		   $resultabc->MoveNext();
		   }
				//files deleting end	   
			       $query = "DELETE FROM tickets_tickets
			       WHERE tickets_id='$ticketid' 
			       OR tickets_child='$ticketid'
				   AND tickets_id <>0";
			        $db->Execute($query);		  			  	  			  
			       $query = "DELETE FROM tickets_state  WHERE id='$ticketid' ";
			        $db->Execute($query);
				   $query = "DELETE FROM tickets_poll  WHERE id='$ticketid' ";
			        $db->Execute($query);
			       }
				   else
				   $last_msg='Denied not Admin or Demo';
			  }//11 
              else
			  {//00
			  if ($action=='0') //closes a group of ticket
			  {
   $query = "UPDATE tickets_state SET tickets_status = '".$action."', closed_by='".$_SESSION['xcv_userna']."'"."WHERE id   = '".$ticketid."'";
			  }
			  if ($action=='1') //reopen a group of ticket
			  {
  $query = "UPDATE tickets_state	SET tickets_status = '".$action."', opened_by='".$_SESSION['xcv_userna']."'"."WHERE id   = '".$ticketid."'";
			  }
			  if ($action=='5') //mark as SPAM
			  {  $query = "UPDATE tickets_state	SET tickets_status = '".$action."', opened_by='".$_SESSION['xcv_userna']."'"."WHERE id   = '".$ticketid."'"; }		  
		   
		   $ok=$db->Execute($query);
			   IF (!$ok)
			   { $message='Was not posible to change status of ticket';
			   }
			   	   
			   }//00 of the else
								
}


}

if (     $_GET['action']=='header' )
{
$authz='TRUE';
$ticket=$_GET['ticketid'];
 $query84="SELECT * from email_headers_tickets WHERE tickets_id ='$ticket'";
 	$db->SetFetchMode(ADODB_FETCH_ASSOC);
			$result84 = $db->Execute( $query84 );
			$fila84=$result84->fields;
			echo $the_email=$fila84['tickets_header'];
//include('./includes/top2.php');
//include('./includes/maintenance.php');
include('includes/bottom.php');
exit;
}
//=======ASSIGNEMENT OF TICKET -CHANGED==============================
if (      isset($_POST['sca'])  )
{$el_id=$_GET['ticketid'];
 $query556 = "	INSERT INTO sca	(ticket_id,staff,oldd,newd,tdate) 
values ('".$el_id."','".$_SESSION['xcv_userna']."',".$_POST['departament'].','. $_POST['departamentL'].','.mktime().")";
        $resultxx5 = $db->Execute( $query556 );
}

if (      isset($_POST['registernow'])  )
{

if(  isset( $_POST['Change']) )//the submit button changed it's caption
{//ONLY CHANGE DEPARTAMENT
    $el_id=$_GET['ticketid'];
	$newcat=$_POST['departament'];	
	
		if (isset($_POST['departamentL'] ))
		$newcat=$_POST['departamentL'];
		
			if (   $_POST['old_urgency'] <> $_POST['new_urgency'])
			{
			$new_urg=$_POST['new_urgency'];
			 $query56 = " UPDATE tickets_tickets	SET tickets_urgency = '$new_urg' WHERE tickets_id   = '".$el_id."'";
			 $resultxx5 =  $db->Execute( $query56 );	}			 
		   $query56 = " UPDATE tickets_tickets	SET tickets_category = '$newcat',unread_admin='1' WHERE tickets_id   = '".$el_id."'";
		   $resultxx5 =  $db->Execute( $query56 );  
		   $the_staff=$_POST['assigned'];//gets the id username
		   $was_assigned_ticket=FALSE;   
		   if ($the_staff<>'-1')
		   { //only if was assigned the ticket
		   $query56 = " UPDATE tickets_state SET assigned_to = '$the_staff',assigned='1',opened_by='' WHERE id   = '".$el_id."'";
		   $resultxx5 =  $db->Execute( $query56 );
		   //it makes appears the ticket as new
		   $query56 = " UPDATE tickets_tickets	SET unread_admin='1' WHERE tickets_id   = '".$el_id."'";
		   $resultxx5 =  $db->Execute($query56);
		   $was_assigned_ticket=TRUE;   
  			 }
		   else
		   {		   $query56 = " UPDATE tickets_state SET assigned_to = '',assigned='' WHERE id   = '".$el_id."'";
		   $resultxx5 =  $db->Execute($query56 );
		   }
     $was_assigned_ticket=TRUE;  //something changed dep or staff asig,always 
   if ($emailasigned=='TRUE' ) //email to the assigned staff member and his supervisor,it comes from configuration
                  {				
                   if ($was_assigned_ticket== true ) //1 mail to the staff
					{ 				
		            	$un_sql="	SELECT email,name FROM users where username= '$the_staff' ";
							$db->SetFetchMode(ADODB_FETCH_ASSOC);
			        	$result_xz =  $db->Execute( $un_sql );
						$filaxz = $result_xz->fields; //this notificates that he has  a new ticket
								if ( $sendhtml=='TRUE' )
                				{	$separator='<BR>';}
     							else
								{$separator= chr(13).chr(10); // '\n\t'; 
								}						    			
				$message=urldecode( $_POST['ticketquestion'][1] );					
				$message_write= 'Ticket ID: '
				.$_POST['ticketpadre']
				.$separator.substr($message,0,150).'...';
     			$last_msg .=' '.SendMail($filaxz['email'],$filaxz['name'],$the_subjetqq,$message_write );				
				$supervisoremail=    $_POST['supervisorZA'];
				$un_sql="	SELECT email,name FROM users where id='$supervisoremail' ";
					$db->SetFetchMode(ADODB_FETCH_ASSOC);
     			$result_xz =  $db->Execute($un_sql);
					$filaxz = $result_xz->fields;
					$his_email=$filaxz['email'];$supervisor=$filaxz['name']; 
				$message_write2='Ticket '.$_POST['ticketpadre'].' : '.$_SESSION['xcv_userna'].' ==> '.$the_staff.'  '.$message_write;
				$the_subjet_trans=$the_subjet_trans.' To: '.$_POST['namedepa']; //2 mail to superv.
				SendMail($his_email,$supervisor,$the_subjet_trans,$message_write2 );				
				$message_write3='Assign '.$_POST['ticketpadre'].' '.$_SESSION['xcv_userna'].' ==> '.$the_staff;
				$ticketid=$_POST['ticketpadre'];
				$query556 = "	INSERT INTO tracking 	(ticket_id,staff,action,tdate) values ('".$ticketid."','".$_SESSION['xcv_userna']."','".$message_write3."','".mktime()."')";
				
        		$resultxx5 =  $db->Execute($query556 );				
				}
			 }

} //fin de change dep.
else	
{
$urgency  = explode('|', $_POST['urgency']);
if (   $_SESSION['body10'] <> substr(addslashes($_POST['message']),1,10)  )
{ //To detect reloading
		 $category = explode('|', $_POST['category']);	
	     $process67=addslashes($_POST['message']).'<BR>';	
	 $etax=$_POST['eta'];
	//$eta=substr($etax,6,4).'-'.substr($etax,0,2).'-'.substr($etax,3,2);
  $year = substr($etax,6,4);$mon  = substr($etax,3,2);	 $day  = substr($etax,0,2);	$hour = substr($etax,11,2);	 $min  = substr($etax,14,2);$sec  = substr($etax,17,2);
	if ($etax<>'') 
	{ $eta_=mktime($hour,$min,$sec,$mon,$day,$year);}else $eta_='';      
	 	$el_ticket=$_GET['ticketid'];
		$query556 = "	INSERT INTO tracking 	(ticket_id,staff,action,tdate) values ('".$el_ticket."','".$_SESSION['xcv_userna']."','".$wwe."','".mktime()."')";
        $resultxx5 =  $db->Execute( $query556 );
		
		$tim= ceil( (time()-$_POST['tiemp']  )/60 );
		$ti=time();
		$usua=$_SESSION['xcv_userna'];
		 $query556 = "	INSERT INTO time_used(ticket,min,tiem,usua) values ($el_ticket,$tim,$ti,'$usua')";
        $resultxx5 =  $db->Execute( $query556 );
							
							
							//here inserts answers
							 $query = "	INSERT INTO tickets_tickets
							(tickets_username,tickets_subject,tickets_timestamp,tickets_urgency,tickets_category,
							tickets_child,tickets_admin,tickets_email,eta,previous,reserved ,tickets_question)
							values ('".$_POST['admin']
							."','".addslashes($_POST['ticketsubject'])
							."','".mktime()
							."','".$urgency['0']
							."','".$category['0']
							."','".$_GET['ticketid']
							."','".$_SESSION['xcv_userna']
							."','".$_POST['email']
							."','".$eta_
							."','".$_POST['previous']
							."','".$_POST['reserved']
							."','".addslashes($_POST['message'])
							."')";							
							$_SESSION['subjetzxc']=$_POST['ticketsubject'];
							$_SESSION['body10']=substr(addslashes($_POST['message']),1,10);							
// ticket_admin, contiene quien manda, username quien es el receptor 

					IF ($result =  $db->Execute($query))
			{
			   
			     
				 if ($dbms=='mssql') //used for storing uploaded file 				   
				   { $db->SetFetchMode(ADODB_FETCH_NUM);
					$resul_id = $db->Execute("select @@IDENTITY");
				   $el_idx=$resul_id->fields;				      
				   $id_ticket=$el_idx[0]; 
				   }
				   else
				   {	$id_ticket=  $db->Insert_ID( );//if ticket child=0 entonces es un ticket nuevo entonces seteo unread_user   
				   }
			   
			   
           $number_of_response='';
		   $el_id=$_GET['ticketid'];		   
			//echo 'punto 00';
          if ( $el_id <>0) 
            {//Estoy poniendo una respuesta para el user
			if ($_POST['close_t']==1 )
			{
			$queryzzz1= " UPDATE tickets_state SET tickets_status = '0' WHERE id   = '".$el_id."'";
		   $resultxx5 =  $db->Execute( $queryzzz1);
		   }
			
            $query56 = " UPDATE tickets_tickets	SET unread_user = '1' WHERE tickets_id   = '".$el_id."'";
            $resultxx5 =  $db->Execute( $query56 );
			$usuario=$_SESSION['xcv_userna'];
            $un_sql="	SELECT id FROM users where username='$usuario'";
			$result_un =  $db->Execute( $un_sql );
			$ggg= $result_un->fields;
			$number_of_response='&mdxr='.$ggg[0];			
            }
		    else
		    { //IF is a new ticket the we update using insert_id			
			
			
			   if ($dbms=='mssql')  
				   
				   {  $db->SetFetchMode(ADODB_FETCH_NUM);
					$resul_id = $db->Execute("select @@IDENTITY");
				   $el_idx=$resul_id->fields;				      
				   $el_id=$el_idx[0]; 
				   }
				   else
				   {
				   $el_id=$db->Insert_ID( ); //mysql_insert_id(); no funca con sqlserver
				   }
			
			
			$query56 = " UPDATE tickets_tickets	SET unread_user = '1' WHERE tickets_id   = '".$el_id."'  ";
            $resultxx5 = $db->Execute( $query56 );
			 //new ticket then a new entry is created
		 	$query556 = "	INSERT INTO tickets_state (id) VALUES ('".$el_id."')";
           $resultxx5 = $db->Execute( $query556 );

		    }		 
	 if ($_POST['record_response']==1)//creates a canned reply 
	 { $query = "INSERT INTO canned_replies (dep,subjet,body) values ('".$category['0']."','".$_POST['subjetcan']."','".addslashes($_POST['message'])."')";													
					        $result = $db->Execute($query);
		}	
			
						IF ($allowattachments == 'TRUE')
							{							
							FileUploadsVerification("$_FILES(userfile)", $id_ticket);
							}
	// EMAIL ADMINISTRATOR THE TICKET NOTIFICATION				
                $_GET['ticketid']=$el_id;
				$rate='';
				if ( $sendhtml=='TRUE' )
                {         $separator='<BR>';
				$template = 'templates/email_notification.php';   
				}
     			else
				{  $separator= chr(13).chr(10); // '\n\t'; 
				$template = 'templates/email_notification.txt';   
				}

		        if ( ($rate_responses=='TRUE') and ($_GET['ticketid']<>''))
                {								
                $case_number=($_GET['ticketid']);
				include('includes/EnDecryptText.php'); //encrypt.php	
				 $EnDecryptText = new EnDecryptText();
                 $verifc= $EnDecryptText->Encrypt_Text($case_number);				
               $la_url=$siteurl.'tickets.php'.'?action=poll1&case='.$case_number.'&tix='.urlencode($verifc).'&tif=56';
               $rate=$to_rate_responses.$separator.'<a href="'  .$la_url. '">'.'Link:'.'</a>'.$separator;
		        }
				if ( ($rate_responses=='ATCLOSE') and ($_GET['ticketid']<>'') and ($_POST['close_t']==1 )   )
                {
                $case_number=($_GET['ticketid']);
				include('includes/EnDecryptText.php'); //encrypt.php	
				 $EnDecryptText = new EnDecryptText();
                $verifc= $EnDecryptText->Encrypt_Text($case_number);				
                $la_url=$siteurl.'tickets.php'.'?action=poll1&case='.$case_number.'&tix='.urlencode($verifc).'&tif=56';
               $rate=$to_rate_responses.$separator.'<a href="'  .$la_url. '">'.'Link:'.'</a>'.$separator;			   
		        }
												
				if ($emailuser1 == 'TRUE')
				{ //email user every time a new response is available				
				//===============				 
				if ($open_responses == 'TRUE')
				{ //Open tickets clicking a url withour login
				//include('includes/encrypt.php');				
				$el_user=$_POST['admin'];
			 	$queryxx = " SELECT * FROM users WHERE username='$el_user'";
					$db->SetFetchMode(ADODB_FETCH_ASSOC);
                $resultxx = $db->Execute( $queryxx );
				$filaxx= $resultxx->fields;				
		       //produce caracteres raros $key= ENCRYPT_DECRYPT( $el_user );				
				//$key=urlencode($key); //we must use urldecode in the other side con el hot mail no pasa
				/*
				$crypt1 = new xcrypt;
                $crypt1->crypt_key($key_crypto); //assigns an encryption key
                $key= $crypt1->encrypt($el_user);
				*/				
				include_once('includes/EnDecryptText.php'); //encrypt.php				
                $EnDecryptText = new EnDecryptText();
                $key = $EnDecryptText->Encrypt_Text($el_user );				
                $fvbgzxcd= MD5($filaxx['password']);				
				$watch_you_ticket0=$siteurl.'tickets.php'
		        .'?action=open&ticketid='.$el_id.'&key2='.urlencode( $key)
		        .'&fvbgzxcd='.$fvbgzxcd.'&gty5='.substr( md5(time()),2,2) ;				
				$watch_you_ticketClose=$siteurl.'tickets.php'
		        .'?action=close&ticketid='.$el_id.'&key2='.$key
		        .'&fvbgzxcd='.$fvbgzxcd.'&gty5='.substr( md5(time()),2,2) ;				
	            $watch_you_ticket	='<a href="'.$watch_you_ticket0."\">$openticket</a>".
				                     $separator.'<a href="'.$watch_you_ticketClose."\">$closeticket</a>"; 
				 if ($_POST['admin']=='Unregistered') 
				 {
				 //key= compatible with versions 1.2
				 //key2 version 1.4
				 //key3 for Unregistered users open/responses only a ticket
		 	     $query556x = "	SELECT keyview FROM tickets_state WHERE id='$el_id'";
	 		    $db->SetFetchMode(ADODB_FETCH_NUM);
                 $resultxx5 = $db->Execute( $query556x );
				 $thekey=$resultxx5->fields;				 
				 $watch_you_ticket0=$siteurl.'tickets.php'
		        .'?action=open&ticketid='.$el_id.'&key3='.$thekey[0]
		        .'&fvbgzxcd='.substr( md5(time()),2,2) ;
				
	            $watch_you_ticket	='<a href="'.$watch_you_ticket0."\">$openticket</a>";				
				 }
				 
	             }
				 //=========END OF OPEN TICKETS WITH A CLICK WITHOUT PASSWORD												
						$message = stripslashes($_POST['message']).$separator;						
	// LOOP THROUGH THE PREVIOUS MESSAGES AND ADD DATA REGARDING QUESTION TIME AND ATTACHMENT
						if ($include_responses=='TRUE')
						{
						  $message .= $separator." $previosmesages $separator";
						$message .= "$separator_______________________________________$separator";
						
						//echo 'respuestas: '.COUNT($_POST['ticketquestion']);
						
						FOR ($i = COUNT($_POST['ticketquestion']); $i >= '1'; $i--)
						
							 {
							 if ( isset($_POST[ticketquestion][$i] ) ){
							  $message .= $_POST['postedby'][$i]." :: ".$_POST['postdate'][$i].$separator;						  
						      $recuperado=urldecode( stripslashes($_POST['ticketquestion'][$i]) );							  
						    if (@strpos($recuperado,'<BR>',strlen($recuperado)-5) == true)
							{$recuperado=substr($recuperado,0,strlen($recuperado)-4);}			  
							  $message .=$recuperado;
							  $message .="$separator___________________________________$separator";
							    IF (isset($_POST['attachment'][$i]) && $_POST['attachment'][$i] != '')
								{$message .= "$separatorAttachment - ".$_POST['attachment'][$i];}
					          $message .= "$separator_____________________________$separator";
							}
						}
						}// LOOP						
                        if(!($fp= fopen ($template, "r"))) die ("Can't open");
                        $dataText = fread($fp, 2000000);
                        fclose ($fp); 	   
                        $dataText = str_replace ('$rate_response',$rate, $dataText);
                        $dataText = str_replace ('$id',$el_id, $dataText);
                        $dataText = str_replace ('$subjet',$_POST['ticketsubject'], $dataText);
                        $dataText = str_replace ('$urgency',$urgency['1'], $dataText);
                        $dataText = str_replace ('$departament',$category['1'], $dataText);						
                        $dataText = str_replace ('$date',date($dformatemail), $dataText);
                        $dataText = str_replace ('$name','', $dataText);
                        $dataText = str_replace ('$message',$message, $dataText);
						$dataText = str_replace ('$footer',$footer, $dataText);
						$dataText = str_replace ('$open_ticket',$watch_you_ticket, $dataText);
						$dataText = str_replace ('$siteurl',$siteurl, $dataText);
				
					if ( $sendhtml=='TRUE' ){ $dataText=nl2br($dataText);}
					 $addd='';
					 if ($_POST['admin']=='Unregistered') //is a ticket coming from email
					 {
		             $cate=$category['0'];
                     $querycc = "SELECT emailpiping FROM tickets_categories WHERE tickets_categories_id='$cate'";
		             $resultcc = $db->Execute($querycc);
		             $the_email=$resultcc->fields;
		             $la_casilla = $the_email[0]; //the response will directed to this address read functions.php
					 $addd=$_POST['ticketsubject']; 					
					 }
					$crypt1 = new xcrypt; //you should not uncomment it,check your settings if you get an error!
                    $crypt1->crypt_key($key_crypto);					
					$verif= $crypt1->encrypt($_POST['ticketpadre']);						
					$the_subjet='Re: '.' {{'.$_POST['ticketpadre'].'-'.$verif.'}}'.$addd;
					$del_con=TRUE;//set to true if customization of email is required,at functions.php					
					$dataText=str_replace('</form>','</formxx>', $dataText);					
     			    if ($_POST['reserved']<>'1')//internal response
					{  $last_msg .=' '.SendMail($_POST['email'],$_POST['name'],$the_subjet, $dataText); }					
									
                   } //End of email user

}
} //END OF DETECTING A PAGE RELOAD

} //END OF ELSE of change departamente
              if (  isset($_POST['close']) )//you answered, but also want to close ticket 18/4/2008
			  {		echo $query = " UPDATE tickets_state	SET tickets_status = '".$action."'
			  , closed_by='".$_SESSION['xcv_userna']."' WHERE id   = '".$ticketid."'";
			  $me=$db->Execute($query);
			    IF (!$me) { $message='Was not posible to change status of ticket';  }              
			    }	  

}//end of creating a new ticket
//=========================================
IF (  ($_GET['action']=='kb') )
{
$jump_here="Location: ".'./kbase/zadminxx/generator_contents.php';	
	    header($jump_here); 
}

//=============END KB ======

if (  ($_GET['action']=='maintenance') )
{
$repara=$_POST['reparation']; //can take two values repair or check
$authz='TRUE';
include('./includes/top2.php');include('./includes/maintenance.php');include('includes/bottom.php');
exit;
}	
//=============SLA
if (  ($_GET['action']=='sla') )
{
$repara=$_POST['reparation']; //can take two values repair or check
$authz='TRUE';
include('./includes/top2.php');include('./includes/sla_settings.php');include('includes/bottom.php');
exit;
}	

//========INSERT USER IN STAFF==========
IF (      ($_GET['action']=='ad_user')   )
{
if (  isset($_POST['newuser'] )  )
{//inserts only if we really need to add a new user

       $query = "SELECT * FROM users WHERE username='".$_POST['username']."'";	   
		$result = $db->Execute($query);
		$cortar = explode(")",$result); //instead of split changed 7-12-2013
		$minumero = $cortar[1];
		
	if (  $minumero<1)
{//
						
          if ($_POST['username']<>'')
          {
		   $query = "	INSERT INTO users
						(name,username,password,email,company,website,comments,status,added ,admin) values('".$_POST['name']
						."','".$_POST['username']
						."','".$_POST['password']
						."','".$_POST['email']
						."','".$_POST['company']
						."','".$_POST['website']
						."','".$_POST['comments']
						."','". '1'
						."','".mktime()
						."','".$_POST['type']."')";
						                        
						$last_msg='Inserting the user...';
          }

if ($_POST['type']<>'User') 
{
  if (is_admin()=== true)//only admin adds staff or admins
  {
  $result = $db->Execute($query);
  }

}

if ($_POST['type']=='User') //staff adds only users
{					   						   
$result = $db->Execute($query);
  if ($result<>TRUE) echo 'Error inserting';
  
}
                       if ($_POST['type']<>'User')
						{ //**
						   if (is_admin()=== true)
						   {					   						   
						   
						      if ($dbms=='mssql')  
				   
				   {  $db->SetFetchMode(ADODB_FETCH_NUM);
					$resul_id = $db->Execute("select @@IDENTITY");
				   $el_idx=$resul_id->fields;				      
				   $el_id=$el_idx[0]; 
				   }
				   else
				   {
				   $el_id=$db->Insert_ID( ); //mysql_insert_id(); no funca con sqlserver
				   }
						   
						   if ($_POST['type']<>'User')
						   {
						  $query = "	INSERT INTO users_staff
						  (userx,departament,departament_visible) values
						  ('".$el_id
						  ."','".$_POST['departament']
						  ."','".$_POST['departament']
						  ."')";
						   $result = $db->Execute($query);
						   }        				   
						 } //**
						   else
						   $last_msg= 'Only administrator adds staff/admins members';						   
						  } 
				
}
else
$last_msg= 'Username exists,duplicated  insertion failed';

//} //of detecting an invalid username=''

}//=================end of isset newuser

//IF the insertion proceeds

 $query556 = "	INSERT INTO tracking 	(ticket_id,staff,action,tdate) values ('".$el_ticket."','".$_SESSION['xcv_userna']."','".'Add user'."','".mktime()."')";
 
        $resultxx5 = $db->Execute( $query556 );

$authz='TRUE';include('./includes/top2.php');include('./includes/add_users.php');//instead of list users
include('includes/bottom.php');
exit;
}
//=======================
	if ( $_GET['action']=='update_canned')
	{
	 if (       $_POST['acc2']=='Delete' )
             	{ $query = "	DELETE FROM canned_replies	WHERE id = '".$_POST['depid']."'";	}
				
			if ( $_POST['acc2']=='Update' ){             	
				$the_color=$_POST['color'];
				if (     substr($the_color,0,1)=='#' )
				{$the_color=substr($the_color,1);}				
				 $query = "	UPDATE canned_replies	SET	subjet     = '".$_POST['status']."',body        = '".$_POST['body']."'	WHERE id = '".$_POST['depid']."'";
             	}			

           	if (     isset( $_POST['insertlevel'] ) )
          	{ 	$name=$_POST['name'];$body=$_POST['body'];$dep=$_POST['departament'];
			$query = "	INSERT INTO canned_replies  (subjet, body,dep) values ('$name','$body',$dep)"; } 
	     $result = $db->Execute($query);
		 

	$authz='TRUE';
	include('./includes/top2.php');
	include('./includes/canned.php');
	include('includes/bottom.php');
	exit;
	}
	
//===========LIST USERS
IF ( $_GET['action']=='canned_responses'  )
{$authz='TRUE';
	include('./includes/top2.php');
	include('./includes/canned_responses.php');
	include('includes/bottom.php');
	exit;
}
//==================

//===========LIST USERS
IF ( $_GET['action']=='canned'  )
{$authz='TRUE';
	include('./includes/top2.php');
	include('./includes/canned.php');
	include('includes/bottom.php');
	exit;
}
//==================


//===========LIST USERS
IF ( $_GET['action']=='users'  )
{
	$authz='TRUE';
	include('./includes/top2.php');
	include('./includes/list_users.php');
	include('includes/bottom.php');
	exit;
}
//==================

//===========DELETE USER
IF ( $_GET['action']=='deleteuser'  )
{
            if  ( (is_admin()=== true) and ($demoxx==false))
			{
			$query = "	DELETE FROM users
			WHERE id = '".$_GET['memberid']."'";
			$result = $db->Execute($query);			
			$query = "	DELETE FROM users_staff	WHERE user = '".$_GET['memberid']."'";
			$result = $db->Execute($query);			
			
			$query556 = "	INSERT INTO tracking 	(ticket_id,staff,action,tdate) values ('".$ticketid."','".$_SESSION['xcv_userna']."','".$_GET['action'].$_GET['username']."','".mktime()."')";
         $resultxx5 = $db->Execute( $query556 );
			}
			else
			$last_msg='Denied not Admin or Demo';

	$authz='TRUE';
	include('./includes/top2.php');
	include('./includes/list_users.php');
	include('includes/bottom.php');
	exit;
}
//HERE was the polls

//========LIST DEPARTAMENTS==========
IF (  ($_GET['action']=='departaments') )
{
		if (is_admin()===TRUE )
		{
		$authz='TRUE';
		include('./includes/top2.php');
		include('./includes/departaments.php');
		include('includes/bottom.php');
		exit;
		}
}
//=======================

//========Filter DEPARTAMENTS==========
IF (  ($_GET['action']=='filter') )
{
$authz='TRUE';
include('./includes/top2.php');include('./includes/departaments_filter.php');include('includes/bottom.php');exit;
}
//=======================
//========DEL DEPARTAMENTS==========
IF (  ($_GET['action']=='del_dep') )
{
        if (  (is_admin()===TRUE)   and ($demoxx==false)   )
        {
 			$query = "	DELETE FROM tickets_categories
			WHERE tickets_categories_id = '".$_GET['id_dep']."'";
			$result = $db->Execute($query);
}
 else
 {$last_msg='Denied not Admin or Demo';}

$authz='TRUE';
include('./includes/top2.php');
include('./includes/departaments.php');
include('includes/bottom.php');
exit;
}
//=======================

//========EDIT DEPARTAMENTS==========

IF (  ($_GET['action']=='edit_dep') )
{

        if (   (is_admin()===TRUE)  and ($demoxx==false) )
        {
						   $query = "	UPDATE tickets_categories
							SET
							tickets_categories_name     = '".$_POST['department']."',
							password     = '".$_POST['password']."',
							email     = '".$_POST['email']."',
							emailpiping    = '".$_POST['emailpiping']."',
							maxfile    = '".$_POST['maxfile']."',
							epiping     = '".$_POST['epiping']."',
							sms     = '".$_POST['sms']."',
							level = '".$_POST['level']."',
							supervisor   = '".$_POST['staffX']."'
							WHERE tickets_categories_id = '".$_POST['id_depart']."'";
	$result = $db->Execute($query);
	}
 else
 {$last_msg='Denied not Admin or Demo';}
		

$authz='TRUE';
include('./includes/top2.php');
include('./includes/edit_mails_dep.php');
include('includes/bottom.php');
exit;
}
//=======================
IF (  ($_GET['action']=='edit_pop3') )
{
$authz='TRUE';
include('./includes/top2.php');
include('./includes/edit_mails_dep.php');
include('includes/bottom.php');
exit;

}

IF (  ($_GET['action']=='edit_spam') )
{

        if (is_admin()===TRUE )
        {
		$query = "	DELETE FROM spam  ";  
		$result = $db->Execute($query);
		$query = "	INSERT INTO spam
		(spa,filter,deletespam)
		values ('".$_POST['spa']
		        ."','".$_POST['enable']
				."','".$_POST['delete']."')";
							 ";//WHERE tickets_categories_id = '".$_POST['id_depart']."'";
$result = $db->Execute($query);
}
 else
       {$last_msg='Denied not Admin or Demo';}


$authz='TRUE';
include('./includes/top2.php');
include('./includes/departaments.php');
include('includes/bottom.php');
exit;
}
//=======================

IF (  ($_GET['action']=='get_upd') )
{
	$ccccc=$_POST['xzpwd'];
	if ($licence<>$ccccc){
	include('includes/config.lib.php');
	$c = new config();
	$c->config_setNewFile('configuration.php');
	$c->config_openFile();
	$c->config_set('licence',$ccccc);
    $c->config_closeFile();}
	
	$tyty=$_SERVER['SERVER_ADDR'];
	
	$file = @fopen ("http://www.cromosoft.com/services/fhd.php?user=$ccccc&bot=$tyty/", "r");
	//$file = @fopen ("http://localhost/spp/fhd.php?user=$ccccc&bot=$tyty/", "r");	
	if (!$file) 
	{
    echo "<p>Unable to open remote file.\n";
	}
    $line = fgets ($file, 1024);
	$_SESSION['gthy']=$line;	
	fclose($file);
	
//000	
		$url=$_SESSION['gthy'];
		$file = @fopen ($url, "rb");//to avoid the error <br>
	if (!$file)
	{       $_SESSION['gthy2']="Failed 'fopen',imposible to get the update or your free updates expired.";     }
	else
	 { 
	        $filename = basename($url); 
	       	$fc = fopen($uploadpath."$filename", "wb"); 
			if ($fc<>true)
			{ touch($uploadpath."$filename");
				$fc = fopen($uploadpath."$filename", "wb"); 
			}
    	    while (!feof ($file)) 
			{ $line = fread ($file, 1028); 
	           fwrite($fc,$line);

	        }
		 fclose($fc);
		$_SESSION['gthy2']='The update was downloaded is ready for installing'; 
	}

//000
$authz='TRUE';
include('./includes/top2.php');
include('./includes/maintenance.php');
include('includes/bottom.php');
exit;
}
//===
IF (  ($_GET['action']=='get_upd2') )
{
$authz='TRUE';
 $filename=$uploadpath.basename($_SESSION['gthy']);
require_once "includes/dUnzip2.inc.php";
require_once "includes/dZip.inc.php";
$zip = new dUnzip2($filename);
$zip->getList();
$zip->unzipAll('');

include('update.php');

include('./includes/top2.php');
include('./includes/maintenance.php');
include('includes/bottom.php');
exit;
}	
//===========assignements
IF (  ($_GET['action']=='asignements') )
{$authz='TRUE';
include('./includes/top2.php');
include('./includes/assigns.php');
include('includes/bottom.php');
exit;
}
//==asignements end;
//========ADD DEPARTAMENTS==========
IF (  ($_GET['action']=='ad_dep') )
{
	if ( (is_admin()===TRUE) and ($demoxx==false) )
        {
       $query = "INSERT INTO tickets_categories (tickets_categories_name,email,supervisor,level)
	  values ('".$_POST['name']."','".$_POST['mail']
	  ."','"
	  ."','".$_POST['level']
	  . "')";
	  
	}
 else
 {$last_msg='Denied not Admin or Demo';}
						

     $result = $db->Execute($query);
	 $authz='TRUE';
     include('./includes/top2.php');
     include('./includes/departaments.php');
	 include('includes/bottom.php');
     exit;
}
//===EDIT STAFF MEMBERS OF DEPARTAMENT====================
IF (  ($_GET['action']=='users_dep_edit') )
{
         $contador=100; //$_POST['number_deps'];
        $user_id=$_POST['memberid'];

        if (  (is_admin()===TRUE) and ($demoxx==false) )
        {
         $query_users_staff="delete from users_staff where userx='$user_id'";
        $result = $db->Execute($query_users_staff);
		
		 $query_users_staff="delete from users_staff_v_level where userx='$user_id'";
        $result = $db->Execute($query_users_staff);
		
        }
        else
       {$last_msg='Denied not Admin or Demo';}


if ($contador>0)
{
for ($aa=1; $aa<=$contador; $aa=$aa+1 )
{ 
 if(isset($_POST[$aa])) { $depax=$aa; }//recupero el id del depa, solo existe el valor si está chekeado
     
            if ($_POST[$aa]=='1')
           {
		  $query_inse5ins = "INSERT INTO users_staff	(userx,departament,departament_visible)
		   values ('".$user_id."','".$depax."','".$depax."')";
			   if (is_admin()=== true)
			   {$result5ins = $db->Execute($query_inse5ins);}
				else $last_msg='Denied not Admin or Demo';
			}
           else{}
		  

 if(isset($_POST['b'][$aa])) { $depax=$aa; }//recupero el id del depa, solo existe el valor si está chekeado
 
            if ($_POST['b'][$aa]=='1')
           {
		 $query_inse5ins = "INSERT INTO users_staff_v_level(userx,depart)
		   values ('".$user_id."','".$depax."')";
			   if (is_admin()=== true)
			   {$result5ins = $db->Execute($query_inse5ins);}
				else $last_msg='Denied not Admin or Demo';
			}
           else{}




} //del for $a

}//del if contador >0
$authz='TRUE';
include('./includes/top2.php');
include('./includes/assigns.php');
include('includes/bottom.php');
exit;
}

//departments visible
IF (  ($_GET['action']=='users_dep_edit_visible') )
{
         $contador=10; //    $_POST['number_deps'];
        $user_id=$_POST['memberid'];    
        //$query_users_staff="delete  users_staff  set departament_visible='' where userx='$user_id'";
        //$result = $db->Execute($query_users_staff);
    
if ($contador>0)
{
for ($a=1; $a<=$contador;$a +=1 )
{
        
			//if (isset($_POST["v$a"]) )
			{
				if (isset($_POST["v$a"]) )
				$depaxv=$_POST["v$a"]; //recupero el id del depa, solo existe el valor si está chekeado
				else
				$depaxv=0;
				
				$depa=$_POST["ex$a"];
				$query_inse5ins = "update users_staff	 SET userx='$user_id', departament='$depa',departament_visible='$depaxv'
				  WHERE userx='$user_id' and departament='$depa' ";
				 
			   	$result5ins = $db->Execute($query_inse5ins);
			}
						
    
} //del for $a

}//del if contador >0
$authz='TRUE';
include('./includes/top2.php');
include('./includes/departaments_filter.php');
include('includes/bottom.php');
exit;
}

//end of departments visible
//SPAM list
	if ( $_GET['action']=='spam')
	{
	$authz='TRUE';
	include('./includes/top2.php');
	include('./includes/add_spam.php');
	include('includes/bottom.php');
	exit;
	}
//===========
//============LIST URGENCY LEVELS========================
	if ( $_GET['action']=='priorities')
	{		if ( (is_admin()===TRUE)   )
		{
		$authz='TRUE';
		include('./includes/top2.php');
		include('./includes/levels_urg.php');
		include('includes/bottom.php');
		exit;
		}
	}
//======================================================	

//============EDIT URGENCY LEVELS========================

	if ( $_GET['action']=='update_levels')
	{
	   
	   if (  (is_admin()=== true) and ($demoxx==false) )
  { //ONLY ADMIN
	
	         if (       $_POST['acc2']=='Delete' )
             	{
             	 $query = "	DELETE FROM tickets_levels
             	WHERE id = '".$_POST['depid']."'";						
             	}
				
			if (       $_POST['acc2']=='Update' ){
             	
				$the_color=$_POST['color'];
				if (     substr($the_color,0,1)=='#' )
				{				
				$the_color=substr($the_color,1);				
				}
				
				$query = "	UPDATE tickets_levels
							SET
							tickets_levels.name     = '".$_POST['status']."',
							tickets_levels.orderx    = '".$_POST['order']."',
							tickets_levels.color    = '".$the_color."'
							WHERE id = '".$_POST['depid']."'";
             	}
				

           	if (     isset( $_POST['insertlevel'] ) )
          	{			
         	$query = "	INSERT INTO tickets_levels  (name) values ('".$_POST['name_level']."')";
	        } 
	     $result = $db->Execute($query);
		 
} //END OF ONLY ADMIN FOR SECURITY
else
{
 $last_msg= 'Only admin change Urgency levels';   
}						
	$authz='TRUE';
	include('./includes/top2.php');
	include('./includes/levels_urg.php');
	include('includes/bottom.php');
	exit;
	}
//======================================================	

IF (  ($_GET['action']=='control') )
{
	if ( (is_admin()===TRUE)  )
	{
	$authz='TRUE';
	include('./includes/top2.php');
	include('./includes/control.php');
	include('includes/bottom.php');
	exit;
	}
}
//===========SETTINGS========================
IF (  ($_GET['action']=='settings') )
{

	   if (  (is_admin()=== true) 
	   //and ($demoxx==false) 
	    )
	   {
	   $authz='TRUE';
	include('./includes/top2.php');
	@include('./includes/the_settings.php');
	include('includes/bottom.php');
	exit;
	   }
}
//===
IF (  ($_GET['action']=='settings_save') )
{
	   if (  (is_admin()=== true) and ($demoxx==false)  )
  { //ONLY ADMIN	
	if ( isset($_POST['save5']) )
	{
	include('includes/config.lib.php');
	$c = new config();
	@unlink('configuration.php');
	$c->config_setNewFile('configuration.php');
	$c->config_openFile();
	$c->config_set('sitename',$_POST['sitename']);
	$c->config_set('siteurl',$_POST['siteurl']);
	$c->config_set('allowattachments',$_POST['allowattachments']);
	$c->config_set('uploadpath',$_POST['uploadpath']);
    $c->config_set('maxfilesize',$_POST['maxfilesize']);
    $c->config_set('logo_url',$_POST['logo_url']);
    $c->config_set('langdefault',$_POST['langdefault']);  
	$c->config_set('dformat',$_POST['dformat']);
    $c->config_set('host',$_POST['host']);
    $c->config_set('user',$_POST['user']);
    $c->config_set('pass',$_POST['pass']);
    $c->config_set('data',$_POST['data']);
    $c->config_set('delete_tickets',$_POST['delete_tickets']);
    $c->config_set('rate_responses',$_POST['rate_responses']);
    $c->config_set('open_responses',$_POST['open_responses']);	
    $c->config_set('include_responses',$_POST['include_responses']);		
    $c->config_set('users_display',$_POST['users_display']);
    $c->config_set('tickets_display',$_POST['tickets_display']);	
    $c->config_set('sendmethod',$_POST['sendmethod']);
    $c->config_set('smtpauth',$_POST['smtpauth']);	
	$c->config_set('portSMTP',$_POST['portSMTP']);
	$c->config_set('smtpserver',$_POST['smtpserver']);	
    $c->config_set('socketfrom',$_POST['socketfrom']);
    $c->config_set('socketfromname',$_POST['socketfromname']);
    $c->config_set('smtpauthuser',$_POST['smtpauthuser']);
    $c->config_set('smtpauthpass',$_POST['smtpauthpass']);
    $c->config_set('footer',$_POST['footer']);
    $c->config_set('emailclose',$_POST['emailclose']);
    $c->config_set('emailuser1',$_POST['emailuser1']);
    $c->config_set('emailstaff',$_POST['emailstaff']);
	$c->config_set('emailasigned',$_POST['emailasigned']);	
    $c->config_set('emailusercopy',$_POST['emailusercopy']);
    $c->config_set('nada',$_POST['nada']);
    $c->config_set('sendhtml',$_POST['sendhtml']);
	$c->config_set('showkb',$_POST['showkb']);
	$c->config_set('addcomments_kb',$_POST['addcomments_kb']);
	$c->config_set('activa_by_email',$_POST['activa_by_email']);
	$c->config_set('add_websites',$_POST['add_websites']);
	$c->config_set('limit_tickets',$_POST['limit_tickets']);
	$c->config_set('bgcolor',$_POST['bgcolor']);
	$c->config_set('menu1',$_POST['menu1']);
	$c->config_set('menu2',$_POST['menu2']);	
	$c->config_set('menu3',$_POST['menu3']);
	$c->config_set('menu4',$_POST['menu4']);	
	$c->config_set('border',$_POST['border']);
	$c->config_set('online',$_POST['online']);
	$c->config_set('fontc',$_POST['fontc']);
	$c->config_set('limit_staff',$_POST['limit_staff']);
   $c->config_set('autoresponse',$_POST['autoresponse']);
   $c->config_set('retries',$_POST['retries']);   
    $c->config_set('usersms',$_POST['usersms']);
	$c->config_set('idsms',$_POST['idsms']);
	$c->config_set('smspass',$_POST['smspass']);
	$c->config_set('enablesms',$_POST['enablesms']);
	$c->config_set('formticket',$_POST['formticket']);
	$c->config_set('rate_responsest',$_POST['rate_responsest']);
	$c->config_set('disable_registering',$_POST['disable_registering']);
	$c->config_set('res_polls',$_POST['res_polls']);
	$c->config_set('disableresponses',$_POST['disableresponses']);
	$c->config_set('dbms',$_POST['dbms']);	
	$c->config_set('notifi1',$_POST['notifi1']);
	$c->config_set('rep1',$_POST['rep1']);
	$c->config_set('notifi2',$_POST['notifi2']);
	$c->config_set('rep2',$_POST['rep2']);
	$c->config_set('color_top',$_POST['color_top']);
	$c->config_set('allowrar',$_POST['allowrar']);
	$c->config_set('upgraded',$_POST['upgraded']);
	

	
   #write changes to file
  $c->config_closeFile();  
if (function_exists("gd_info"))
 {
  require('includes/gradient.php');
  $la_imagen;
  $image = new gd_gradient_fill(5,32,'vertical',$_POST['menu1'],$_POST['menu2'],1);
  imagepng($la_imagen,'images/bg_blu.png'); 
  $la_imagen;
  $image = new gd_gradient_fill(5,32,'vertical',$_POST['menu3'],$_POST['menu4'],1);
  imagepng($la_imagen,'images/bg_blu2.png'); 
} //gd support
  
	}
  }
else 
{
$last_msg='Denied not Admin or Demo';
}	
	   if ( $_POST['emailfortest']<>'')
       {
       $dataText= $msg1;
       $for_staff=$msg2;
       $el_from=$socketfromname;
       $el_email=$_POST['emailfortest'];
       $last_msg .=' '.SendMail($el_email,$el_from,$for_staff,$dataText);	   
       }
	
	$authz='TRUE';
	include('./includes/top2.php');
	@include('./includes/the_settings.php');
	include('includes/bottom.php');
	exit;
}
//======================

//===========SETTINGS========================
IF (  ($_GET['action']=='reports') )
{
	if ($limit_staff=='TRUE')
	{
	       if (  (is_admin()=== true) )
			{	$authz='TRUE';
	            @include('./includes/top2.php');
             	@include('./includes/reports.php');
             	include('includes/bottom.php');
            	exit;
			} else
			{
			$last_msg='Denied not Admin or Demo';
			}
			
	}
	else
	{
	$authz='TRUE';
	@include('./includes/top2.php');
	@include('./includes/reports.php');
	include('includes/bottom.php');
	exit;
	}
}
//======================
//===========SUSPEND USER
IF (  ($_GET['action']=='ban') )
{
//users with status 2 were banned, 1 active 0 inactive
$username=$_GET['username'];
$query = " UPDATE users SET users.status = '".'2'."' 
			WHERE users.username  = '".$username."'";
		    $result = $db->Execute($query);
 $query = "	UPDATE tickets_state,tickets_tickets
	SET tickets_status = (tickets_state.tickets_status | 4)  
	WHERE
	tickets_state.id=tickets_tickets.tickets_id
	AND
	tickets_tickets.tickets_username  ='$username'";
    $result = $db->Execute($query);
			
}

IF (  ($_GET['action']=='chang') )
{
$new_sta=$_GET['sub_act'];
if  ( ($new_sta==0) or ($new_sta==1)  )
{
            if (  (is_admin()=== true) and ($demoxx==false) )
			{
			$query = " UPDATE users SET users.status = '".$new_sta."'
			WHERE users.id   = '".$_GET['memberid']."'";
		    $result = $db->Execute($query);
			}
			else
			$last_msg='Denied not Admin or Demo';
}	

	$authz='TRUE';
	include('./includes/top2.php');
	include('./includes/list_users.php');
	include('includes/bottom.php');
	exit;
}
//==================

if (   isset($_POST['edituser'])  )
{
if(   isset($_POST['Create'])   )
{
$userm=$_POST['username'];
$jump_here="Location: ".   "./tickets2.php?action=create2&username=$userm";	
	    header($jump_here); 
}

 $query = "	UPDATE users
			SET
			name     = '".$_POST['name']."',
    		password = '".$_POST['password']."',
			email    = '".$_POST['email']."',
			admin    = '".$_POST['type']."',
			t1       = '".$_POST['t1']."',
			t2       = '".$_POST['t2']."'
			WHERE id = '".$_POST['memberid']."'";

   if ( (is_admin()=== true) and ($demoxx==false) )
   {
	$result = $db->Execute($query);
  }else
$last_msg='Denied not Admin or Demo';	
	
	$authz='TRUE';
	include('./includes/top2.php');
	include('./includes/list_users.php');
	include('includes/bottom.php');
	exit;
}
//============OPEN TICKET========================

	if ( $_GET['action']=='open')
	{	$authz='TRUE';
	include('./includes/top2.php');
	$el_ticket=$_GET['ticketid'];
	
	 $query44="SELECT opened_by FROM tickets_state WHERE id ='$el_ticket'";
	 	$db->SetFetchMode(ADODB_FETCH_NUM);
	 $result1  = $db->Execute($query44);
	 $rett= $result1->fields[0];
	 if  ( $rett[0]=='')
	 {	 
	  $query44="UPDATE tickets_state
	  SET opened_by='".$_SESSION['xcv_userna']."' WHERE id = '$el_ticket'";	 
	  $result1  = $db->Execute($query44);
	 }
	 $authz='TRUE';	

		$query556 = "	INSERT INTO tracking 	(ticket_id,staff,action,tdate) values ('".$el_ticket."','".$_SESSION['xcv_userna']."','".'Open'."','".mktime()."')";
        $resultxx5 = $db->Execute( $query556 );
	include('./includes/open.php');
	include('includes/bottom.php');
	exit;
	}
//===========CREATES TICKET========================	
	if ( $_GET['action']=='create')
	{	$authz='TRUE';	include('./includes/top2.php');	include('./includes/select_users.php');	include('includes/bottom.php');
	exit;
	}
//================================
	if ( $_GET['action']=='create2')
	{
	$authz='TRUE';
	include('./includes/top2.php');
	include('./includes/create_ticket2.php');
	include('includes/bottom.php');
	exit;
	}
//======================
//============CREATING REPORTS==================
	if ( $_GET['action']=='ticket_by_date')
	{
	$from0=$_POST['from_date'];
	$until0=$_POST['until_date'];
	$from=substr($from0,6,4).'-'.substr($from0,0,2).'-'.substr($from0,3,2);
	$until=substr($until0,6,4).'-'.substr($until0,0,2).'-'.substr($until0,3,2);
	
	
	

	 $query1="Select count(  (a.tickets_child))
	from tickets_tickets a,tickets_state b
	where  b.tickets_status='1'  AND
	b.id=a.tickets_id
	AND
	a.tickets_child=0
	AND
	  a.tickets_timestamp BETWEEN UNIX_TIMESTAMP('$from')   AND   (UNIX_TIMESTAMP('$until') +86400) "; 
	  
	  if ($dbms=='mssql')
	  {
	  $from1=    mysqlToUnix($from); 
	  $until1=  mysqlToUnix($until); 	  
	$query1="Select count(  (a.tickets_child))
	from tickets_tickets a,tickets_state b
	where  b.tickets_status='1'  AND
	b.id=a.tickets_id
	AND
	a.tickets_child=0
	AND
	  a.tickets_timestamp BETWEEN $from1   AND   ($until1   +86400) "; 	  
	  }
	$db->SetFetchMode(ADODB_FETCH_NUM);
	$result1  = $db->Execute($query1);
	
		
	$totaltickets1=$result1->RecordCount();
	if ($totaltickets1=='' )
	{	
	$cortar = split(")",$result1);
	$totaltickets1 = $cortar[1];
	}
	
	$query2="Select count(  (a.tickets_child))
	from tickets_tickets a,tickets_state b
	where  b.tickets_status='0'  AND
	b.id=a.tickets_id
	AND
	a.tickets_child=0
	AND
	  a.tickets_timestamp BETWEEN UNIX_TIMESTAMP('$from')
	   AND   (UNIX_TIMESTAMP('$until') +86400) "; 
	   
	   	  if ($dbms=='mssql')
	  {
	   
	$query2="Select count(  (a.tickets_child))
	from tickets_tickets a,tickets_state b
	where  b.tickets_status='0'  AND
	b.id=a.tickets_id
	AND
	a.tickets_child=0
	AND
	  a.tickets_timestamp BETWEEN $from1   AND   ($until1   +86400) "; 	  
	  }

	   
	$result2  = $db->Execute($query2);	
	$totaltickets2=$result2->RecordCount();
	if ($totaltickets2=='' )
	{	
	$cortar = split(")",$result2);
	$totaltickets2 = $cortar[1];
	}
	
	 $query3="Select count(  (a.tickets_child))
	from tickets_tickets a,tickets_state b
	where  b.tickets_status='2'  AND
	b.id=a.tickets_id
	AND
	a.tickets_child=0
	AND
	  a.tickets_timestamp BETWEEN UNIX_TIMESTAMP('$from')
	   AND   (UNIX_TIMESTAMP('$until') +86400) "; 
	   	  if ($dbms=='mssql')
	  {
	  
	$query3="Select count(  (a.tickets_child))
	from tickets_tickets a,tickets_state b
	where  b.tickets_status='2'  AND
	b.id=a.tickets_id
	AND
	a.tickets_child=0
	AND
	  a.tickets_timestamp BETWEEN $from1   AND   ($until1   +86400) "; 	  
	  }

	   $result3  = $db->Execute($query3);	
	   
	$totaltickets3=$result3->RecordCount();
	if ($totaltickets3=='' )
	{	
	$cortar = split(")",$result3);
	$totaltickets1 = $cortar[1];
	}
	   
	$report1=true;
	$authz='TRUE';
	include('./includes/top2.php');
	include('./includes/reports.php');
	include('includes/bottom.php');
	exit;
	}

//============Tickets by prioritie vs state========================
	if ( $_GET['action']=='tickets_by_prio_status')
	{
	
	
	$report_prior_state=true;
	$authz='TRUE';
	include('./includes/top2.php');
	include('./includes/reports.php');
	include('includes/bottom.php');
	exit;
	}
//====================================
//===TICKETS BY MONTH=============
	if ( $_GET['action']=='ticket_by_month')
	{	
	$report2=true;
	$authz='TRUE';
	include('./includes/top2.php');
	include('./includes/reports.php');
	include('includes/bottom.php');
	exit;
	}
//==FIN DE TICKETS BY MONTH==============================
//======tickets by day
	if ( $_GET['action']=='daily')
	{	          //tickets OPEN	
	$reportA=true;
	$authz='TRUE';
	include('./includes/top2.php');
	include('./includes/reports.php');
	include('includes/bottom.php');
	exit;

	}
//end tickets by day

//======tickets by day
	if ( $_GET['action']=='mydaily')
	{	          //tickets OPEN	
	$reportA=true;	$authz='TRUE';	include('./includes/top2.php');	include('./includes/myreport.php');	include('includes/bottom.php');	exit;
	}
//end tickets by day

//===TICKETS BY DEPARTAMENT=============
	if ( $_GET['action']=='tickets_per_departament')
	{	          //tickets OPEN	
	$report3=true;	$authz='TRUE';	include('./includes/top2.php');	include('./includes/reports.php');	include('includes/bottom.php');	exit;
	}
//==TICKETS BY DEPARTAMENT==============================

//===TICKETS BY ASSIGNEMENT=============
//todo esto tengo que editar
	if ( $_GET['action']=='tickets_per_assign')
	{	$report4=true;	$authz='TRUE';	include('./includes/top2.php');	include('./includes/reports.php');	include('includes/bottom.php');	exit;	}
//==FIN DE TICKETS BY ASSIGNEMENT==============
	if ( $_GET['action']=='delete')
	{
     @unlink('report.txt');
	@unlink('report.zip');
    }

//===Banned users=============
	if ( $_GET['action']=='get_users')
	{	          //tickets OPEN		
	$t=trim($_POST['separator']);
	$gg=trim($_POST['listusers']);
    $query1="SELECT *  FROM	users WHERE status='$gg' ";
	$db->SetFetchMode(ADODB_FETCH_ASSOC);
	$resulta  = $db->Execute($query1);
	
	       $your_data = "";
         do {
	 $row_Recordsetx = $resulta->fields;
     $f0 = $row_Recordsetx['name'];
     $f1 = $row_Recordsetx['username'];
     $f2 =$row_Recordsetx['email'];
     $f3 =$row_Recordsetx['website'];
     $bbbb= $f0.$t   .$f1.$t.  $f2.$t.  $f3.chr(13).chr(10);
	 $your_data = $your_data.$bbbb;
	 
	 @$resulta->MoveNext();
   }
 WHILE (!$resulta->EOF);
 
 		
 
	     $ghgh='report.txt';
         touch($ghgh);
         $archivo = fopen($ghgh, "w")or die("can't open file");                 
		 fwrite($archivo, $your_data);
         fclose($archivo);		 
		 if ($_POST['arch']=='text')
		 {		 $f=$ghgh;		}
		else
		{	require('includes/zip.inc.php');
        $zipfile = new zipfile();
        $zipfile -> add_file($your_data, "report.txt");
        $filename = "report.zip";
        $fd = fopen ($filename, "wb");
        $out = fwrite ($fd, $zipfile -> file() );
        fclose ($fd);
		$f=$filename;}
         $r_code  =  file_get_contents($f);  //  Get  file  your  want  user  to  download 
         $com  =  substr($f,  strrpos($f,  '.')  +  1);    //  Get  extension  
		 header("Pragma:  public"); 
         header("Cache-control:  public");    
         header("Content-disposition:attachment;  filename=$f"); 
         header("Content-Type:  text/"  .  $com  .  ";  charset=utf-8"); 
         header("Content-Transfer-Encoding:  binary"); 
         header("Content-Length:  "  .  strlen($r_code));	
		 echo  $r_code;  
         @unlink('report.txt');
         @unlink('report.zip');		
        exit;
	}
//time used
if ( $_GET['action']=='time_used')
{
	$reportused=true;$authz='TRUE';
	include('./includes/top2.php');
	include('./includes/reports.php');
	include('includes/bottom.php');
	exit;		

}
	
//time used end
	
//==========RATING OF TICKETS=======
	if ( $_GET['action']=='tickets_rating5')
	{
    $report55=true;	$query1="SELECT *  FROM tickets_poll order by id DESC LIMIT 600";
	if ($dbms=='mssql')
	{
	 $query1="SELECT TOP 600 *  FROM tickets_poll order by id DESC";
	}
	$db->SetFetchMode(ADODB_FETCH_ASSOC);
	$result1  = $db->Execute( $query1);
	$authz='TRUE';	include('./includes/top2.php');	include('./includes/reports.php');	include('includes/bottom.php');	exit;
}
//==
	if ( $_GET['action']=='tickets_rating')
	{
    $report5=true;	
	
	 $query1="SELECT avg(a),avg(b),
	                     avg(c), avg(d),
			             avg(e), count(id)
						 FROM tickets_poll";
	if ($dbms=='mssql')					 
	{
		 $query1="SELECT avg( CAST(a AS INT) ),avg(  CAST(b AS INT) ),
	                     avg( CAST(c AS INT)), avg( CAST(d AS INT)  ),
			             avg(  CAST(e AS INT) ), count(id)
						 FROM tickets_poll";
	
	}
	$db->SetFetchMode(ADODB_FETCH_NUM);					  
	$result1  = $db->Execute($query1);	
	  $query2="SELECT ca.tickets_categories_name as nom, avg(a), avg(b),
	                     avg(c), avg(d),
			             avg(e), count(id)
						 FROM tickets_poll, tickets_tickets as ti,
						 tickets_categories as ca
						 WHERE
		  ca.tickets_categories_id=ti.tickets_category
		  and tickets_poll.id=ti.tickets_id		  
		   group by nom ";	 
		if ($dbms=='mssql')					 
	{
		  $query2="SELECT ca.tickets_categories_name as nom, avg( CAST(a AS INT)  ), avg( CAST(b AS INT) ),
	                     avg(  CAST(c AS INT) ), avg(  CAST(d AS INT)  ),
			             avg( CAST(e AS INT)), count(id)
						 FROM tickets_poll, tickets_tickets as ti,
						 tickets_categories as ca
						 WHERE
		  ca.tickets_categories_id=ti.tickets_category
		  and tickets_poll.id=ti.tickets_id		  
		   group by ca.tickets_categories_name ";	 

	}   
  $db->SetFetchMode(ADODB_FETCH_NUM);		   
$result2_rating  = $db->Execute($query2);
	  $query3="SELECT  users.username, avg(a), avg(b),
          avg(c), avg(d),avg(e), count(tickets_poll.id)
		  FROM users,tickets_poll,users_staff
		  WHERE		  		  
		  users.id=tickets_poll.staff
		  group by users.username ";
		  
		  		if ($dbms=='mssql')					 
	{  $query3="SELECT  users.username, avg(CAST(a AS INT)), avg( CAST(b AS INT) ),
          avg( CAST(c AS INT)), avg(  CAST(d AS INT) ),avg( CAST(e AS INT)  ), count(tickets_poll.id)
		  FROM users,tickets_poll,users_staff
		  WHERE		  		  
		  users.id=tickets_poll.staff
		  group by users.username ";	  

	}   
  $db->SetFetchMode(ADODB_FETCH_NUM);		  
$result3_rating  = $db->Execute($query3);

       //results of a special tickets
	 $el_ticket=$_POST['ticket'];
	 $query4="SELECT ti.tickets_username, avg(a), avg(b),
	                     avg(c), avg(d),
			             avg(e)
						 FROM tickets_tickets as ti,tickets_poll as po
						 WHERE	
		po.id=$el_ticket
		AND
        ti.tickets_id=po.id		
		 group by ti.tickets_username";
		 
	if ($dbms=='mssql')					 
	{
	 $query4="SELECT ti.tickets_username, avg( CAST(a AS INT) ), avg(  CAST(b AS INT) ),
	                     avg(  CAST(c AS INT) ), avg( CAST(d AS INT) ),
			             avg( CAST(e AS INT) )
						 FROM tickets_tickets as ti,tickets_poll as po
						 WHERE	
		po.id=$el_ticket AND ti.tickets_id=po.id  group by ti.tickets_username";
		
	
	}
		   $db->SetFetchMode(ADODB_FETCH_NUM);
         $result4_rating  = $db->Execute($query4);$authz='TRUE';
		 
		 $query5="SELECT * FROM tickets_poll where  id= '$el_ticket'";
		 $db->SetFetchMode(ADODB_FETCH_ASSOC);
		 $detalle_ticket=$db->Execute($query5);
	include('./includes/top2.php');
	include('./includes/reports.php');
	include('includes/bottom.php');
	exit;		
	}
//========END OF RATING OF TICKETS=======
	if ( $_GET['action']=='deletelog1')	
	{
	$query1="delete from error_log ";
	$result1  = $db->Execute($query1);
	$_GET['action']='empip';//Keep it to avoid jumps!	
	}

if ( $_GET['action']=='deletelog2')	
	{$q12=$_GET['user'];
	$query1="delete from tracking  WHERE staff='$q12'";
	$result1  = $db->Execute($query1);
	$_GET['action']='empip';}

	if ( $_GET['action']=='empip')
	{
    $report20=true;	
	$query1="SELECT * FROM error_log ORDER BY timestamp DESC LIMIT 600";
	if( $dbms=='mssql')
	{		
	$query1="SELECT TOP 600 * FROM error_log ORDER BY timestamp";
	}
	
	$db->SetFetchMode(ADODB_FETCH_NUM);
	$result1  = $db->Execute($query1);$authz='TRUE';
	include('./includes/top2.php');	include('./includes/reports.php');include('includes/bottom.php');exit;
    }
	
	//===T1, t2
	if ( $_GET['action']=='t1_listing')
	{
    $reportT1=true;	
	$query1="SELECT * FROM sla_t1 ORDER BY ticket DESC LIMIT 600";
	if( $dbms=='mssql')
	{		
	$query1="SELECT TOP 600 * FROM sla_t1 ORDER BY ticket";
	}

$db->SetFetchMode(ADODB_FETCH_NUM);
	$result1  = $db->Execute($query1);$authz='TRUE';
	include('./includes/top2.php');	include('./includes/reports.php');include('includes/bottom.php');exit;	
}

	if ( $_GET['action']=='t2_listing')
	{
    $reportT2=true;	
	$query1="SELECT * FROM sla_t2 ORDER BY ticket DESC LIMIT 600";
	if( $dbms=='mssql')
	{		
	$query1="SELECT TOP 600 * FROM sla_t2 ORDER BY ticket";
	}
	$db->SetFetchMode(ADODB_FETCH_NUM);
	$result1  = $db->Execute($query1);$authz='TRUE';
	include('./includes/top2.php');	include('./includes/reports.php');include('includes/bottom.php');exit;	
	}   
	
//===

	if ( $_GET['action']=='t1_percent')
	{
    $reportT_percent=true;	
	$query1="SELECT count(*) FROM sla_t1 ORDER BY ticket where (created between and  )  DESC LIMIT 600";
	if( $dbms=='mssql')
	{		
	$query1="SELECT TOP 600 * FROM sla_t1 ORDER BY ticket";
	}
$db->SetFetchMode(ADODB_FETCH_NUM);
	$result1  = $db->Execute($query1);$authz='TRUE';
	
	
	
	
	include('./includes/top2.php');	include('./includes/reports.php');include('includes/bottom.php');exit;	
}


//==========TRACKING OF TICKETS 2=======
	if ( $_GET['action']=='details_tracking')
	{    
	$tt=mktime();
	$authz='TRUE';
		$report_tracking2='TRUE';
		$el_user=$_GET['user'];
		
	include('./includes/top2.php');
	include('./includes/reports.php');
	include('includes/bottom.php');
	exit;
}
//==========SCALATION OF TICKETS =======
	if ( $_GET['action']=='esca')
	{    
	$tt=mktime();
	$authz='TRUE';
	$report_es='TRUE';include('./includes/top2.php');	include('./includes/reports.php');	include('includes/bottom.php');	exit;
}

//==========TRACKING OF TICKETS 1=======
	if ( $_GET['action']=='tracking')
	{    
	$tt=mktime();
	$authz='TRUE';
	$report_tracking='TRUE';include('./includes/top2.php');	include('./includes/reports.php');	include('includes/bottom.php');	exit;
}
//==========RATING OF TICKETS=======
	if ( $_GET['action']=='response_time')
	{
    $report6=true;
	$tt=mktime();
	if ($dbms=='mysql')
	{
	 $query1="SELECT username, name,avg(tickets_timestamp - previous) 
             FROM users left join tickets_tickets
			 on
             tickets_admin=users.username 
            and users.admin<>'User'
	        where previous <> 0
			group by username";	
	}		
	if ($dbms=='mssql')
	{
	  $query1="SELECT username, name,avg(tickets_timestamp - previous) 
             FROM users left join         tickets_tickets
			 on
             tickets_admin=users.username 
            and users.admin<>'User'
	        where previous <> 0
			group by username,name";	
	}
	$db->SetFetchMode(ADODB_FETCH_NUM); $db->SetFetchMode(ADODB_FETCH_NUM); 
	$result1  = $db->Execute($query1);	

            
		$authz='TRUE';
	include('./includes/top2.php');
	include('./includes/reports.php');
	include('includes/bottom.php');
	exit;
}
//==END OF RESPONSE TIME

//add or delete your comments about users
	if ( $_GET['action']=='comments')
	{
   $query_con="select * from users where username='".$_GET['username']."'";
	$db->SetFetchMode(ADODB_FETCH_ASSOC);
    $result_con  = $db->Execute($query_con);	
	$authz='TRUE';
	include('./includes/top2.php');
	include('./includes/users_history.php');
	include('includes/bottom.php');
	exit;
}
//===========
		
IF (  ($_GET['action']=='sprofile') and ($_POST['username']<>'') )
{
$name=$_POST['name'];
$email=$_POST['email'];
$website=$_POST['website'];
$company=$_POST['company'];
$comments=$_POST['comments'];

$query56 = " UPDATE users SET name='$name',email='$email',website='$website',
   company='$company', comments='$comments'   WHERE username  = '".$_POST['username']."'";			  
    $resultxx5 = $db->Execute( $query56 );
$authz='TRUE';
	include('./includes/top2.php');	include('./includes/list_users.php');	include('includes/bottom.php');	exit;
}
//============

//=============
	if ( $_GET['action']=='ad_use')
	{	$authz='TRUE';	include('./includes/top2.php');	include('./includes/add_users.php');include('includes/bottom.php');	exit;	}
//=============
//=============
	if ( $_GET['action']=='overview')
	{	$authz='TRUE';
	include('./includes/top2.php');	include('./includes/overview.php');	include('includes/bottom.php');	exit;	}
//=============

//===DEFAULT ACTION LIST TICKETS home ================
$nombrer=$_SESSION['xcv_userna'];
 $query_permits= "SELECT users_staff.departament_visible,users.admin FROM users_staff,users
 where users_staff.userx=users.id  and users.username='$nombrer'";
//if you are using the free version only tickets of the first dep are shown 
//$query_permits= "SELECT users_staff.departament_visible,users.admin FROM users_staff,users
//where users_staff.user=users.id  and users.username='$nombrer' order by users_staff.departament_visible desc limit 1"; 
$db->SetFetchMode(ADODB_FETCH_NUM);
$result_permits  = $db->Execute($query_permits);$fil='';
$permisos='(';
while (!$result_permits->EOF)
{
$fil=$result_permits->fields;
                     if ($fil[0] <>'')
                     {	 $permisos=$permisos.$fil[0].',';	 }
@$result_permits->MoveNext();
}


  $permisos =   $permisos.'-100)';

//no entiendo el este bucle while ( $fil=mysql_fetch_row($result_permits) );
//echo $permisos;
$query="SELECT admin from users where username='$nombrer'";
$result= $db->Execute($query);
$fila=$result->fields;
$tipo_user=$fila[0];
$tipo_user='Admin';
 if ( $_SESSION['gnulevel']==1) //staff
 {  //in $permisos
 $query = "SELECT distinct tickets_id,unread_admin,unread_user,tickets_username,
                  tickets_subject,tickets_question,tickets_email,
                  tickets_timestamp,
                  d.tickets_status,d.assigned, b.name,
                  color, tickets_categories_name,reserved
                  FROM tickets_tickets a, tickets_levels b, tickets_categories c,tickets_state d
				   WHERE
         (  a.tickets_category in $permisos)
			    AND a.tickets_child = '0' AND  (a.tickets_urgency = b.id) 
			  AND  (a.tickets_category = c.tickets_categories_id)
		  AND d.id=a.tickets_id 
		  and (
	     ((d.assigned_to='$nombrer') and (d.assigned='1')) or   (   (d.assigned != '1') or (d.assigned is null)  )
			  )";
  if ($dbms=='mssql')
 {
  $query_mssql= "SELECT distinct tickets_id,unread_admin,unread_user,tickets_username,
                  tickets_subject,tickets_question,tickets_email,
                  tickets_timestamp,
                  d.tickets_status,d.assigned, b.name,
                  color, tickets_categories_name,reserved
                  FROM tickets_tickets a, tickets_levels b, tickets_categories c,tickets_state d
				   WHERE
         (  a.tickets_category in $permisos)
			    AND a.tickets_child = '0' AND  (a.tickets_urgency = b.id) 
			  AND  (a.tickets_category = c.tickets_categories_id)
		  AND d.id=a.tickets_id 
		  and (
	     ((d.assigned_to='$nombrer') and (d.assigned='1')) or   (   (d.assigned != '1') or (d.assigned is null)  )
			  )";
 
 }
			  
}
else

{ //admin
//  this was wrong>      (  a.tickets_category & $permisos = a.tickets_category)
 $query = "SELECT distinct a.tickets_id, a.unread_admin,a.unread_user,a.tickets_username,
                  a.tickets_subject,a.tickets_question,a.tickets_email,
                  a.tickets_timestamp,
                  d.tickets_status,d.assigned, b.name,
                  color, tickets_categories_name,reserved
                  FROM tickets_tickets a, tickets_levels b, tickets_categories c,tickets_state d
				   WHERE

		(  a.tickets_category in $permisos)
		  AND a.tickets_child = '0' AND  (a.tickets_urgency = b.id) 
		  AND  (a.tickets_category = c.tickets_categories_id)
		  AND d.id=a.tickets_id";
		  
if ($dbms=='mssql')
 {
   $query_mssql = "SELECT DISTINCT top _yy_ a.tickets_id, a.unread_admin,a.unread_user,a.tickets_username,
                  a.tickets_subject,a.tickets_question,a.tickets_email,
                  a.tickets_timestamp,
                  d.tickets_status,d.assigned, b.name,
                  color, tickets_categories_name,reserved
                  FROM tickets_tickets a, tickets_levels b, tickets_categories c,tickets_state d
				   WHERE
		(  a.tickets_category in $permisos)
		  AND a.tickets_child = '0' AND  (a.tickets_urgency = b.id) 
		  AND  (a.tickets_category = c.tickets_categories_id)
		  AND d.id=a.tickets_id";

 }//if mssql		  
		  
}
	  //debo considerar users_admin que puede ser User, Mod o Admin	
	  //		para crear el correcto tipo de SQL
	  //si es moderador comparamos sus permisos con los que tienen los tickets de la tabla tickes  
			IF (!isset($_GET['order']))
			{
			$_GET['order']='1';
			}
			
			IF (isset($_GET['order']))
				{
				$query .= " AND d.tickets_status = '".$_GET['order']."'";
				 $query_mssql .=" AND d.tickets_status = '".$_POST['orden']."'  d.id=a.tickets_id";
				
				$addon  = '&amp;order='.$_GET['order'];
				}
			
				//New Query BOOLEAN MODE IF REQUIRED
 			IF (isset($_POST['keywords']))
			{
				
				 if ( $_SESSION['gnulevel']==1)
               {  
				$query = "SELECT distinct tickets_id,unread_admin,unread_user,tickets_username,
                  tickets_subject,tickets_question,tickets_email,
                  tickets_timestamp,tickets_child,
                  d.tickets_status,d.assigned, b.name,
                  color, tickets_categories_name,reserved
                  FROM tickets_tickets a, tickets_levels b, tickets_categories c, tickets_state d
				   WHERE
        (  a.tickets_category in $permisos )
		
			  AND  (a.tickets_urgency = b.id) 
			  AND  (a.tickets_category = c.tickets_categories_id)			  
			  AND 
			  (
	     ((d.assigned_to='$nombrer') and (d.assigned='1')) or   (   (d.assigned != '1') or (d.assigned is null)  )
			  )";
			   $query_mssql =$query;
			  }
			  else
			  {
			   $query = "SELECT distinct tickets_id,unread_admin,unread_user,tickets_username,
                  tickets_subject,tickets_question,tickets_email,
                  tickets_timestamp,tickets_child,
                  d.tickets_status,d.assigned, b.name,
                  color, tickets_categories_name,reserved
                  FROM tickets_tickets a, tickets_levels b, tickets_categories c,tickets_state d
				   WHERE			 
			  (a.tickets_urgency = b.id) 
			  AND  (a.tickets_category = c.tickets_categories_id) ";		  
			  
			 $query_mssql= $query;
			  }
			  
			  			IF (!isset($_GET['order']))
	             		{
	         		    $_GET['order']='1';
						}			
			            IF (isset($_GET['order']))
				        {
				       $query .= " AND d.tickets_status = '".$_POST['orden']."'  ";
					   $query_mssql .=" AND d.tickets_status = '".$_POST['orden'].    "'  ";
					   
					   
				        $addon  = '&amp;order='.$_GET['order'];
				       }

					   
  			IF (isset($_POST['keywords']))
			{//33
		   $keywords=$_POST['keywords'];
	       $query .= " AND MATCH(a.tickets_subject,a.tickets_question,
		   a.tickets_admin,tickets_email)
		   against ('$keywords' in boolean mode)  ";
		   
		   $query_mssql .=" AND  ( FREETEXT(a.tickets_subject, '$keywords')  or FREETEXT(a.tickets_question, '$keywords')  ) " ;

		   
		   $addon  = '';
		   
 if ($dbms=='mssql')
 {
$query=$query_mssql;
}

   			$result_preliminar   = $db->Execute($query);			
			//eliminado no sirve 10/11/10 $cortar = split(")",$result_preliminar);$total_ticket_search_in_parent = $cortar[1];
			//$total_ticket_search_in_parent=$result_preliminar->RecordCount();
			//echo $total_ticket_search_in_parent;
			
			if ($total_ticket_search_in_parent>0)//If exists any results
			{  //######3
		   	//$tickets_childs='(12)';
           $filvvv=$result_preliminar->fields;
		   $filvvv['tickets_child'];		   
           $tickets_childs='(';
		   
           do
          {
           if ($filvvv['tickets_child'] <>0) $agrego=$filvvv['tickets_child'];
		   
		   		if ($filvvv['tickets_child'] ==0) $agrego=$filvvv['tickets_id'];		   
           		{
		    	$tickets_childs=$tickets_childs.$agrego.',';
				}
         $result_preliminar->MoveNext();
		 }
         while ( ! $result_preliminar->EOF );
		 
           $tickets_childs = $tickets_childs.'-100)';	
			
			 if ( $_SESSION['gnulevel']==1) //staff
            { //%%
			$query = "SELECT  distinct tickets_id,unread_admin,
			unread_user,tickets_username,
            tickets_subject,tickets_question,tickets_timestamp,
            d.tickets_status,d.assigned, b.name,color,
			tickets_categories_name,reserved
            FROM tickets_tickets a,tickets_levels b,
			tickets_categories c,users,tickets_state d
			WHERE
			a.tickets_id IN $tickets_childs 
		    AND a.tickets_id=d.id
            AND b.id=a.tickets_urgency
		   AND a.tickets_category=tickets_categories_id 
		   AND 
			  (
	     ((d.assigned_to='$nombrer') and (d.assigned='1')) or   (   (d.assigned != '1') or (d.assigned is null)  )
			  )";
			  
			   if ($dbms=='mssql')
               {
			   		  $query_mssql=$query;
				}	  
		   }
		   else //admin
		   {
		    $query = "SELECT  distinct tickets_id,unread_admin,
			unread_user,tickets_username,
            tickets_subject,tickets_question,tickets_timestamp,
            d.tickets_status,d.assigned, b.name,color,
			tickets_categories_name,reserved
            FROM tickets_tickets a,tickets_levels b,
			tickets_categories c,users,tickets_state d
			WHERE
			a.tickets_id IN $tickets_childs 
		    AND a.tickets_id=d.id
            AND b.id=a.tickets_urgency
		   AND a.tickets_category=tickets_categories_id";
		   
		    if ($dbms=='mssql')
               {
			   		  $query_mssql= "SELECT DISTINCT top _yy_ tickets_id,unread_admin,
						unread_user,tickets_username,
            			tickets_subject,tickets_question,tickets_timestamp,
            			d.tickets_status,d.assigned, b.name,color,
						tickets_categories_name,reserved
            			FROM tickets_tickets a,tickets_levels b,
						tickets_categories c,users,tickets_state d
						WHERE
						a.tickets_id IN $tickets_childs 
		    			AND a.tickets_id=d.id
            			AND b.id=a.tickets_urgency
		   				AND a.tickets_category=tickets_categories_id"; 
			   }
		   
		   }//%%
			
			} //##### 
			
			}//33

				}
				//End New Query				
				if ( isset($_GET['sort']) )
				{
				$col=$_GET['col'];
				if ($col=='dat') $a11='a.tickets_timestamp';
				if ($col=='urg') $a11='a.tickets_urgency';
				if ($col=='sub') $a11='a.tickets_subject';
				if ($col=='id') $a11='a.tickets_id';
				//if ($col=='id') $a11='a.tickets_id';
				
				if ( $_GET['sort']=='1') { $b11='ASC';} else { $b11='DESC'; }
				
				$query .= "	ORDER BY  $a11 $b11";
				$query_mssql .="	ORDER BY  $a11 $b11";
				}
				else
				{
				$query .= '	ORDER BY a.tickets_id DESC, a.tickets_timestamp DESC';
				$query_mssql .='	ORDER BY a.tickets_id DESC';
				}
				
			//$query="SELECT MONTH('2003-12-31 01:02:03')";
//$q1=time();
//echo $query;
		$result       = $db->Execute($query);//for mysql & SQL server

		
		/*//$totaltickets1=$result->RecordCount();//no veo utilidad del contador tickets				
		$cortar = split(")",$result);	$totaltickets = $cortar[1]; //remov 10/11/10 not req
		print_r($cortar[1]);*/

	 $query_old=$query;		
	include('includes/functions_php.php');
//$q2=time()-$q1;
//echo $q2;	
	if ($dbms=='mysql')
	{
    $query_new = sprintf("%s LIMIT %d, %d",$query, $startRow_Recordset1, $maxRows_Recordset1);
 }
 
 	 if ($dbms=='mssql')				 
 	{//begin sqlserver	
	 $query_mssql;
	 
	 	 
 	 $query_mssql = "select top $tickets_display  * from (select top _xx_  * from
	     ( $query_mssql ) as foo order by foo.tickets_id ASC)  as bar order by bar.tickets_id DESC  ";
		 //difiere de tickets.php en que esta clausula no añade un order by ya que se agrego en la linea 1875
		 IF (isset($_POST['keywords']))
			{//33ee Para evitar errores debo filtrar esto, viene de un search
			$query_mssql=str_replace( 'ORDER BY a.tickets_id DESC ','', $query_mssql );
			}//33ee
		 
	
		 $rr= ($pageNum_Recordset1+1)*$tickets_display;	 
		if ($rr >= $totalRows_Recordset1) //ultima pagina
		{
		 $rr=$totalRows_Recordset1; //por evitar posibles errores
		 
						 $tickets_display2= ($totalRows_Recordset1 % $tickets_display);						
		                   if (	$totalRows_Recordset1 ==$tickets_display) $tickets_display2=$tickets_display;//parche caso limite
		 
		$query_mssql=str_replace( '_xx_',$tickets_display2, $query_mssql );
	 	}
	 	else
	 	{	$query_mssql=str_replace( '_xx_',$tickets_display, $query_mssql ); }
	
 $query_mssql=str_replace( '_yy_',$rr, $query_mssql );	  
 $query_new =   $query_mssql;
		
	}//end sqlserver   
//echo   $query_new;
 $db->SetFetchMode(ADODB_FETCH_ASSOC);
	$result = $db->Execute($query_new);
	$totalRows_contenido = $result->RecordCount();
$q3=time();
 ?>
 <?php 
function set_class()
{
global $theclass;$class1='even';$class2='odd';   IF($theclass == $class1)
			{$theclass = $class2;}
		    ELSE
			{	$theclass = $class1;}echo $theclass;
}
$authz='TRUE';
include('includes/top2.php');
?>
<script type="text/javascript">
function sele(id)
{
//alert( id );
    var container_id='tables';
	var rows = document.getElementById(container_id).getElementsByTagName('tr');
	var checkbox;
  
    for ( var i = 0; i < rows.length; i++ ) 
	
	{
          checkbox = rows[i].getElementsByTagName( 'input' )[0];
           if ( checkbox && checkbox.type == 'checkbox' )	  
	       {
     	      if (checkbox.value==id)
			  {
			      if ( checkbox.checked==true)
		          {
	              rows[i].className='seleven';
		          }
		          if ( checkbox.checked==false)
		          {
	              rows[i].className='even';
		          }
			   }
		  
     	  } 
	}
return false;
}
function check(  )
 {
    var container_id='tables';
	var rows = document.getElementById(container_id).getElementsByTagName('tr');
    var unique_id;
    var checkbox;
  //alert( rows.length );

    for ( var i = 0; i < rows.length; i++ ) {

        checkbox = rows[i].getElementsByTagName( 'input' )[0];

        if ( checkbox && checkbox.type == 'checkbox' ) {
            unique_id = checkbox.name + checkbox.value;
            checkbox.checked = !(checkbox.checked);
            //rows[i].className = rows[i].className.replace(' marked', '');
            //marked_row[unique_id] = false;
        }//fin de if checkbox&&
    }
    return false;
}
</script>
<?php
$refresh_page=true;$authz='TRUE';include('includes/list.php');include('includes/bottom.php'); ?>