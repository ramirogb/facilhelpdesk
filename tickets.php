<?php
session_start();
date_default_timezone_set('America/Lima');

include('config.php');
$key_crypto='tickets'; //change to other seed
if ($online=='FALSE')
 {
 exit;
 }
include('includes/check.php');

$phpself = basename(__FILE__);
//Get everything from start of PHP_SELF to where $phpself begins
//Cut that part out, and place $phpself after it
$_SERVER['PHP_SELF'] = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'],$phpself)) . $phpself;
$rtcv=$_SERVER['PHP_SELF'];


include_once('includes/functions.php');
//==
if (  isset($_GET['canned']) )
{
   $id=$_GET['canned'];
	$query57c = "	SELECT body from canned_replies where id='$id'  ";	 
	$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	 $result57c = $db->Execute($query57c);	
	 $row3c=$result57c->fields; //assoc
	 echo $body=trim($row3c['body']);
	exit;
	}
//==

	IF (!isset($_GET['action']))
		{$_GET['action'] = 'Login';}

//$_REQUEST['lang'];IF (!isset($_REQUEST['lang']))	{$_REQUEST['lang'] = $langdefault;}	include('language/'.$_REQUEST['lang'].'.php');	
	
	
	IF ($_REQUEST['lang']=='')
		{
			$_REQUEST['lang'] = $langdefault;
			if ($_GET['lang']<>''){ $_REQUEST['lang']=$_GET['lang']; }
			if ($_POST['lang']<>''){ $_REQUEST['lang']=$_POST['lang']; }		
			
			}
			
					
	$inc='language/'.$_REQUEST['lang'].'.php';	
	if (file_exists($inc)){	include($inc);}else 
	{$_REQUEST['lang'] = $langdefault;$inc='language/'.$_REQUEST['lang'].'.php';include($inc);	
	
	}
	
$status=array(0=>$clo, 1=>$opn);
//inserts form from anonimous ticket

	if    (isset ( $_POST['fromform']) and (   ($formticket=='TRUE') or ($formticket=='TRUE_POP') ) )
	{$coo=trim($sitename);
$waitx5='FALSE';
	if (  isset ($_COOKIE[$coo]) ) {$waitx5='TRUE';} 
else {$waitx5='FALSE';
}



//echo 'post'.$_POST['sec'].'<BR>';
//echo 'sesion'.$_SESSION['asdfg'].'<BR>';

if  ($_POST['sec'] <> $_SESSION['asdfg'] )
{ $waitx5='TRUE';}//SPAM or reload happens
$_SESSION['asdfg']=rand(100,2);


if ($waitx5=='FALSE')	{

	//if (          (  ($_POST['txtNumber'])==( $_POST['email'])) and ( strpos($_POST['email'],'@' )  >0 )  )
	if (   strpos($_POST['email'],'@' )  >0 )	
	{
	$dataText=$_POST['message'];
	if ( isset($_POST['hoas']))
					{
					$dataText=$dataText.' Company:'.$_POST['company'].' Telef.: '. $_POST['telef'].' Country: '.$_POST['country'];
					

					}
	
	
	$el_from=$_POST['name'];$urgency  = explode('|', $_POST['urgency']);
	$el_email=$_POST['email'];$el_asunto=$_POST['ticketsubject'];$category = explode('|', $_POST['category']);
 $query = "	INSERT INTO tickets_tickets
							(tickets_username,tickets_subject ,tickets_timestamp,tickets_urgency,tickets_category,tickets_child,tickets_admin , tickets_email,tickets_name,tickets_question )
							VALUES
							
							('".'Unregistered'
							."','".addslashes($el_asunto)
							."','".mktime()
							."','".$urgency[0]
							."','".$category[0]
							."','".$tickets_child
							."','".'Unregistered'
							."','".$el_email
							."','".$el_from
							."','".$dataText."')";							
                        $resultxx5 = $db->Execute( $query);
						
						
					 if ($dbms=='mssql')  				   
				   { $db->SetFetchMode(ADODB_FETCH_NUM);
					 $resul_id = $db->Execute("select @@IDENTITY");
				     $el_idx=$resul_id->fields;				      
				     $el_id=$el_idx[0];}
				     else
				     { 
					 $el_id=  $db->Insert_ID( );
					
					 }
						
						$for_subjet=$el_id;	$clav=md5($el_email); 
						
						$el_ticket=$el_id;
						$w1= (rand()%31);$w2= (rand()%31);$w3= (rand()%31);$w4= (rand()%31);$w5= (rand()%31);
						$w6= (rand()%31);$clave=$clav[$w1].$clav[$w2].$clav[$w3].$clav[$w4].$clav[$w5].$clav[$w6];						
						$query556 = "	INSERT INTO tickets_state (id,keyview) values ('".$el_id."','".$clave."')";
						$resultxx5 =$db->Execute( $query556);
						
						
						
						$name='Unregistered';
						include('includes/encrypt.php');$crypt = new xcrypt;
						$verif= $crypt->encrypt($el_ticket);
						$for_staff= '{{'. $el_id.'-'.$verif.'}}'.$el_asunto; //inserte ahora//echo 'primer ticket';
						
						IF ($allowattachments == 'TRUE')
							{ 
							//echo 'entra';
							FileUploadsVerification("$_FILES(userfile)", $el_id);
							}
			
			if ( $sendhtml=='TRUE' )
                        { $separator='<BR>';
						 }
     			        else      { $separator= chr(13).chr(10); } 
			$dataText="$el_from, ".$separator.'your ticket was stored, 						
			please wait for an answer of our staff members, '.$separator.$separator.'ticket ID: '.$el_ticket.$separator
			.$separator.$ggg.'Ticket Key : '.$clave.$separator.'  IMPORTANT: If you respond this ticket do not change the subject line'
			.$separator.$separator.$siteurl;
			;			
			$del_con=TRUE;//set to true if customization of email is required,at functions.php
			if ($emailusercopy=='TRUE'){
			//echo 'xx1';
			$last_msg .=' '.SendMail($el_email,$el_from,$for_staff,$dataText);//to customer
			}
	$authz='TRUE';
	
	$coo=trim($sitename);
	if ($limit_tickets <>'UNLIMITED') 
	{
	
	$coo='cromosoft.com';
	if ( !setcookie($coo,'1',time()+$limit_tickets) ) echo 'warning setting cookie but data stored.';
	 }

	include('./includes/top3.php');
	include('./includes/thanks.php');
	include('includes/bottom.php');
	exit;						
} //iffloo
}
else //error with captcha difs emails
{
$authz='TRUE';include('./includes/top3.php');
	include('./includes/error_captcha.php');
	include('includes/bottom.php');
	exit;}

    }
//============create anonimous ticket================
	if (  ($_GET['action']=='create_form') and  (  ($formticket=='TRUE') or ($formticket=='TRUE_POP') ))
	{

$_SESSION['referido']=$_SERVER['HTTP_REFERER'];

	if(  ($limit_tickets <>'UNLIMITED') and ($limit_tickets<>'') )
					   {
					   $xc=mktime();
					  $count_tick="SELECT count(*) FROM tickets_tickets where tickets_admin='".$_SESSION['xcv_userna'].
					  "' AND ($xc- tickets_timestamp < $limit_tickets)  ";
					   $vvv=$db->Execute($count_tick);
					   $c=$vvv->fields;
					   $quedan=$limit_tickets-$c[0];					   
					   if (  $c[0]> 0) //was exceded the number of tickets
					          {
						  $authz='TRUE';
				          include('./includes/top.php');						
                          include('./includes/not_create_ticket.php');
						  	exit;
					          }
					   
					   }
	
	$authz='TRUE';	
//if ( !setcookie('2','1',time()+20) ) {echo 'Cookies required';exit; }	
	$_SESSION['asdfg']=rand(1000,2);	
	if ($formticket=='TRUE_POP') //pop up form
	{	
	include('./includes/top4.php');	
	echo '<BR />';	
	include('./includes/create_ticket.php');	}	
	else
	{	
	include('./includes/top3.php');
	
	include('./includes/create_ticketb.php');
	include('includes/bottom.php');	}
	exit;
	}
//================================



//========Send link for Poll First Step==========
IF (  ($_GET['action']=='poll1') )
{
$authz='TRUE';
include('./includes/top.php');

$lk=$_REQUEST['lang'];
$inc=('./language/polls/polls_'.$lk.'php');
   if ( file_exists($inc))
   { 
   include($inc);
   }
   else {
   $lk= $langdefault;
    $inc=('language/polls/polls_'.$lk.'.php');
   if ( file_exists($inc))
   {    include($inc);  }
   
   }

include('includes/bottom.php');
exit;
}
//=======================
//here was nos required authentication with 

//========Save results of current  Poll, Final Step==========
IF (  ($_GET['action']=='poll2') )
{
$authz='TRUE';
include('./includes/top.php');
 $caseq=  ($_POST['tix']);
$f=$_GET['case'];
		include('includes/EnDecryptText.php'); //encrypt.php				
        $EnDecryptText = new EnDecryptText();
        $verifc= $EnDecryptText->Decrypt_Text( $caseq);  

 $query = "	SELECT id FROM tickets_poll WHERE id='$f'"; 
  $result88 = $db->Execute($query);  
  if ($result88->RecordCount( )< $res_polls ) //mysql_num_rows($result88)
  					{  $query = "	INSERT INTO tickets_poll
						(id,a,b,c,d,e,comment,staff,timestamp)
						values('"
						.$_GET['case']
						."','".$_POST['1']
						."','".$_POST['2']
						."','".$_POST['3']
						."','".$_POST['4']
						."','".$_POST['5']
						."','".$_POST['comment']
						."','".$_POST['staff']
						."','".mktime()
						."')";					
						
										 
                  if ( $verifc==$f)	$result = $db->Execute($query);
 }
 else
{ echo '<br>'.'<br>'.'<br>'.$npolls.'<br>';}
//print_r($result);
if  (!$result === false) 
{ include('./includes/poll2.php');}
else
{
echo '<br>'.$errorpoll;
}
include('includes/bottom.php');
exit;
}
//=======================

//======CLOSE SESSION============================
IF (isset($_GET['action']) && $_GET['action'] == 'Logout')
		{
		unset($_SESSION['stu_username']);
		unset($_SESSION['stu_password']);
		//$_GET['action'] = 'Login';
		session_destroy();
		$jump_here="Location: ".'./index.php';	
	    header($jump_here); 
		}
//==CLOSE TICKETS=======

IF (  ($_GET['action']=='kb') )
{
$jump_here="Location: ".'./kbase/kbase.php';	
	    header($jump_here); 
}
//


if ( isset($_GET['key'])   )//login by url por compatibilidad lo dejamos pero es inseguro
{
      include('includes/encrypt.php'); //debo descartar esta funcion por que agrega + en la url
	  $a= urldecode( $_GET['key'] );
	  $crypt = new xcrypt;
       $crypt->crypt_key($key_crypto); //esta libreria se queda por compatibilidad solamente
       $b= $crypt->decrypt($a);
       $_SESSION['xcv_userna']=$b;  
       $uss=$_SESSION['xcv_userna'];	   
      $_SESSION['xcv_passw']='';	   
      $pass_sended=$_GET['fvbgzxcd'];	   
     $query = "	SELECT * FROM users WHERE username='$uss'";
       $resust= $db->Execute($query);//assoc
       $fila88=$resust->fields;	   
	  $a= md5($fila88['password']);
      if ($a ==$pass_sended  )
      {$_SESSION['xcv_passw']=$fila88['password'];}

} //end of key

if ( isset($_GET['key2'])   )//login by url por compatibilidad lo dejamos pero es inseguro
{
	   $a= urldecode( $_GET['key2'] );
	   include('includes/EnDecryptText.php'); //encrypt.php
       $EnDecryptText = new EnDecryptText();
       $b = $EnDecryptText->Decrypt_Text($a);	  
       $_SESSION['xcv_userna']=$b;  
       $uss=$_SESSION['xcv_userna'];	   
      $_SESSION['xcv_passw']='';	   
      $pass_sended=$_GET['fvbgzxcd'];	   
     $query = "	SELECT * FROM users WHERE username='$uss'";
       $resust= $db->Execute($query);
       $fila88=$resust->fields;	   //assoc
	  $a= md5($fila88['password']);
      if ($a ==$pass_sended  )
      {$_SESSION['xcv_passw']=$fila88['password'];}

} //end of key2



$view_ticket=false;


if ( isset($_GET['key3']) or isset($_POST['key3'])   )//login by url
{
   if ( isset($_GET['key3']) )   $a= trim( $_GET['key3']); //keyview   
   if ( isset($_POST['key3']) )  $a= trim( $_POST['key3']); //keyview   firsy byt Get , next by post

	  $ticketid=trim($_GET['ticketid'] );
       if ($a<>'')
	   {
	   		$_SESSION['xcv_userna']='Unregistered';
			$_SESSION['xcv_passw']=md5(time() );
			$query = "	SELECT keyview FROM tickets_state WHERE id='$ticketid' ";	 
			$resust= $db->Execute($query);
			$fila88=$resust->fields;//assoc
			if ( strcmp($fila88['keyview'],$a)==0  )
			{ $view_ticket=true; }	   
			$userww='Unregistered';  //if set,list is invisible
	   }

} //end of key 3

//===========LOGIN
//after of this line real authentication exists=================
if ($view_ticket==false)
{
        if (check_login2()==false)
        { include('includes/timeout.php'); exit;}
}
//==================
IF (  ($_GET['action']=='profile') )
{
$authz='TRUE';
include('./includes/top.php');
include('./includes/profile.php');
include('includes/bottom.php');
exit;
}
//=======================

IF (  ($_GET['action']=='sprofile') )
{
$name=$_POST['name'];
$email=$_POST['email'];
$website=$_POST['website'];
$company=$_POST['company'];
$password=$_POST['password_mnb'];

 $query56 = " UPDATE users SET name='$name',email='$email',website='$website',
   company='$company',password='$password'   WHERE username  = '".$_SESSION['xcv_userna']."'";			  
    $resultxx5 =  $db->Execute( $query56 );
$authz='TRUE';
include('./includes/top.php');
include('./includes/profile.php');
include('includes/bottom.php');
exit;
}



//=======CHANGE STATE OF TICKETS===============
$var_tem=0;
if (  ($_GET['action']=='close') or ($_GET['action']=='reopen') or isset($_POST['change_state'])  )
{

              if (  $_GET['action']=='close' )
              {
              $action='0'; //set this ticket state (closed)
              $_GET['action']=home;
              $var_tem=1; //lo que graba en la DB
              }

              if (  $_GET['action']=='reopen')
              {
              $action='1';
              $_GET['action']=home;
              $var_tem=1;
              }

             if (  isset($_GET['ticketid']) and ($var_tem==1) )
              {//==000
			   $ticketid=$_GET['ticketid'];
				  $query = "	UPDATE tickets_state	SET tickets_status = '".$action."'
                WHERE id   = '".$ticketid."'";
			    IF (! $db->Execute($query))
			    {
			    $message= $errorchangingticket;
			   }
               }//==00000000

 if (     isset($_POST['ticket'])   )  FOREACH ( $_POST['ticket'] AS $ticketid)
{
               $action=$_POST['change_state' ];                
                $query = "	UPDATE tickets_state	SET tickets_status = '".$action."'
               WHERE id   = '".$ticketid."'";
			   IF (! $db->Execute($query))
			   {
			   $message=$errorchangingticket;
			   }								

}


}

//=======INSERT TICKET -NEW OR AN ANSWER==============================

if (  isset($_POST['registernow'] ) )
{

$urgency  = explode('|', $_POST['urgency']);
if (  $_SESSION['body10']<> substr(addslashes($_POST['message']),1,10)  ) 
 { //To detect reloading
          //to avoif tickets spoofing  
  		if(  ($limit_tickets <>'UNLIMITED') and ($limit_tickets<>'') )
					   {					   
				      $xc=mktime();
				     $count_tick="SELECT count(*) FROM tickets_tickets where tickets_admin='".$_SESSION['xcv_userna'].
					  "' AND ($xc- tickets_timestamp < $limit_tickets)  ";
					  $vvv= $db->Execute($count_tick);
					  $c=$vvv->fields;
					  if (  $c[0]> 0) //was exceded the number of tickets
					     { $authz='TRUE';
						 include('./includes/top.php');
                         include('./includes/not_create_ticket.php');
					 	exit;  }
				      }
          //to avoif tickets spoofing   
 $db->StartTrans();
					$category = explode('|', $_POST['category']);
					
					
					
			 $query = "	INSERT INTO tickets_tickets
							(tickets_username,tickets_subject,tickets_timestamp,tickets_urgency,tickets_category,tickets_child,tickets_admin,tickets_email,tickets_name ,tickets_question)
							values ('".$_SESSION['xcv_userna']
							."','".addslashes($_POST['ticketsubject'])
							."','".mktime()
							."','".$urgency['0']
							."','".$category['0']
							."','".$_GET['ticketid']
							."','".$_SESSION['xcv_userna']
							."','".$_POST['email']
							."','".$_POST['name']
							."','".addslashes($_POST['message'])
							."')";
							$_SESSION['subjetzxc']=$_POST['ticketsubject'];
							$_SESSION['body10']=substr(addslashes($_POST['message']),1,10);
							
					IF ($result =  $db->Execute($query))
			{  	   
			   //if ticket child=0 entonces es un ticket nuevo entonces seteo unread_user
               $el_id=trim($_GET['ticketid']);
			   $el_id_get=$el_id;
                 if ( $el_id <>0) //o sea estoy poniendo una respuesta para el user
			     { //###
				 $is_new=FALSE;
                 $query56 = " UPDATE tickets_tickets	SET unread_admin = '1'
                 WHERE tickets_id   = '".$el_id."'";			  
                 $resultxx5 = $db->Execute( $query56 );
 			     $for_staff='New Respose';
   			     $for_user= $your_responseq;
				 $new_ticketx=FALSE;				 
				 
				 		if ($dbms=='mssql')  				   
				   		{  $db->SetFetchMode(ADODB_FETCH_NUM);
						$resul_id = $db->Execute("select @@IDENTITY");
				   		$el_idx=$resul_id->fields;				      
				   		$el_id=$el_idx[0]; 
				   		}
				   		else
				   		{$el_id=$db->Insert_ID( ); //mysql_insert_id(); no funca con sqlserver				
				   		}
				 
				 
			     }//###
				 else
				 {//))  //new ticket then a new entry is created			      
				  		$is_new=TRUE;
				   		if ($dbms=='mssql')  				   
				   		{  $db->SetFetchMode(ADODB_FETCH_NUM);
						$resul_id = $db->Execute("select @@IDENTITY");
				   		$el_idx=$resul_id->fields;				      
				   		$el_id=$el_idx[0]; 
						
				   		}
				   		else
				   		{$el_id=$db->Insert_ID( ); //mysql_insert_id(); no funca con sqlserver				
				   		}
						$el_id_get=$el_id; //new ticket, then get=0, but we need the number of the new
		 	      		$query556 = "	INSERT INTO tickets_state (id) values('".$el_id."')";
                  		$resultxx5 = $db->Execute( $query556 );
			      		$for_staff='New Ticket';
   			      		$for_user=$new_tic;
  				  		$new_ticketx=TRUE;
				 }//))

$db->CompleteTrans();




			
						IF ($allowattachments == 'TRUE')
							{							
							//echo "entrados $el_id ";
							FileUploadsVerification("$_FILES(userfile)",$el_id);
							}
	// EMAIL 
												
						$message = stripslashes($_POST['message']).$separator;												
						if ( $sendhtml=='TRUE' )
                        { 
                        $separator='<BR>';
						$template = 'templates/email_notification.php';   
						 }
						else
						{
						$separator= chr(13).chr(10); // '\n\t'; 
						$template = 'templates/email_notification.txt';   
						}
												
					if ($include_responses=='TRUE')
						{						
						$message .= "$separator_______________________________________$separator";
						$message .= "$previosmesages $separator";
						$message .= "$separator";
	                    
						
						FOR ($i = COUNT($_POST['ticketquestion']); $i >= '1'; $i--)
							{
							    $message .= $_POST['postedby'][$i]." :: ".$_POST['postdate'][$i].$separator;							
								
							$recuperado=urldecode( stripslashes($_POST['ticketquestion'][$i]) );
						     if (@strpos($recuperado,'<BR>',strlen($recuperado)-5) == true)
							{ 							
							$recuperado=substr($recuperado,0,strlen($recuperado)-4);
							}			  
							  $message .=$recuperado;
								
								$message .="$separator___________________________________$separator";
								
							     IF (isset($_POST['attachment'][$i]) && $_POST['attachment'][$i] != '')
								   {
								   $message .= "$separator Attachment - ".$_POST['attachment'][$i];
								   }
								   
							   $message .= "$separator_______________________$separator";
							}
						
						
						} //If include_responses.
						
						//==========
						if ($open_responses == 'TRUE')
				        { //Open tickets clicking a url withour login
        				include('includes/encrypt.php');				
				        $el_user=$_SESSION['xcv_userna'];
			 	        $queryxx = " SELECT * FROM users WHERE username='$el_user'";
                        $resultxx = $db->Execute( $queryxx );
				        $filaxx=$resultxx->fields;//assoc
						$user_namexx=$filaxx['name'];			
						
						/*
						$crypt = new xcrypt;
                       $crypt->crypt_key('tickets'); //assigns an encryption key
                       $key= $crypt->encrypt($el_user);						
                        $fvbgzxcd= MD5($filaxx['password']);         		
				        $watch_you_ticket0=$siteurl.'tickets.php'
		                .'?action=open&ticketid='.$el_id.'&key='.$key
		                .'&fvbgzxcd='.$fvbgzxcd.'&gty5='.substr( md5(time()),2,5) ;
						$watch_you_ticket	='<a href="'.$watch_you_ticket0.'">Check Ticket</a>'.$separator;
						*/
						
						$query556x = "	SELECT keyview FROM tickets_state WHERE id='$el_id'";
                 		$resultxx5 = $db->Execute( $query556x );
				 		$thekey=$resultxx5->fields;				 
				 		$watch_you_ticket0=$siteurl.'tickets.php'
		        		.'?action=open&ticketid='.$el_id.'&key3='.$thekey[0]
		        		.'&fvbgzxcd='.substr( md5(time()),2,2) ;				
	            $watch_you_ticket	='<a href="'.$watch_you_ticket0."\">$openticket</a>";
						
						
						}
						//=============
						
						
						if ($new_ticketx==TRUE){
						$template ='templates/email_new_ticket_from_user.php';
						 }
						
						if ( $sendhtml=='TRUE' )
                        { 
						$template ='templates/email_new_ticket_from_user.php';
						$template_notif_staff='templates/notificate_response_staff.php';
						}
						else
						{
						$template ='templates/email_new_ticket_from_user.txt';
     					$template_notif_staff='templates/notificate_response_staff.txt';
						}
						
                        if(!($fp= fopen ($template, "r"))) die ("Can't open");
                        $dataText = fread($fp, 2000000);
                        fclose ($fp); 	   
                        $dataText = str_replace ('$rate_response','', $dataText);
                        $dataText = str_replace ('$id',$el_id_get, $dataText);
                        $dataText = str_replace ('$subjet',$_POST['ticketsubject'], $dataText);
                        $dataText = str_replace ('$urgency',$urgency['1'], $dataText);
						$dataText = str_replace ('$departament',$category['1'], $dataText);						
                        $dataText = str_replace ('$date',date($dformatemail), $dataText);
						$dataText = str_replace ('$username',$el_user, $dataText);
                        $dataText = str_replace ('$name',$user_namexx, $dataText);
						$dataText = str_replace ('$footer',$footer, $dataText);
						$dataText = str_replace ('$open_ticket',$watch_you_ticket, $dataText);                       
                        $dataText = str_replace ('$message',$message, $dataText);
						$dataText = str_replace ('$siteurl',$siteurl, $dataText);
                        
						$dataText =urldecode($dataText);
						if ($emailusercopy=='TRUE')
						{
						//echo 'xx2'; $dataText;
						if ($is_new==TRUE) { $last_msg .=' '.SendMail($_POST['email'],$_POST['name'],$for_user, $dataText);
						
						}
						if (  ($is_new==FALSE) and ($disableresponses<>'TRUE') ) {
						//echo 'xx3';		echo $dataText;
						$last_msg .=' '.SendMail($_POST['email'],$_POST['name'],$for_user, $dataText);
						}
												
						
						}
						
						if ($emailstaff=='TRUE')
						{
						$sqlCat="SELECT * FROM tickets_categories WHERE tickets_categories_id='$category[0]'";
						$resultCat=$db->Execute($sqlCat);
						$rowCat=$resultCat->fields;						
						//Email Staff			
						
						if(!($fp2= fopen ($template_notif_staff, "r"))) die ("Can't open");
                        $dataText2 = fread($fp2, 2000000);
                        fclose ($fp2);
					    $message_write= substr($_POST['message'],0,100).'...';						
						$dataText2 = str_replace ('$id',$el_id_get, $dataText2);$dataText2 = str_replace ('$message',addslashes( $message_write ), $dataText2);
						$dataText2 = str_replace ('$departament',$category['1'], $dataText2);$dataText2 = str_replace ('$date',date($dformatemail), $dataText2);
						$dataText2 = str_replace ('$subjet',$_POST['ticketsubject'], $dataText2);$dataText2 = str_replace ('$siteurl',$siteurl, $dataText2);						
						$for_staff=$for_staff." of $user_namexx";
					$dataText2 =urldecode($dataText2);
					//echo 'xx4';	//echo $dataText2;
						$last_msg .=' '.SendMail($rowCat['email'],$_POST['name'],$for_staff,$dataText2);
					}
					
					if ($enablesms=='TRUE')
						{
						
						$sep_sms_= chr(13).chr(10);
						$sqlCat="SELECT * FROM tickets_categories WHERE tickets_categories_id='$category[0]'";
						$resultCat=$db->Execute($sqlCat);
						$rowCat=$resultCat->fields;
						//SMS to depart.						
						if(!($fp2= fopen ('templates/notificate_sms.txt', "r"))) die ("Can't open");
                        $dataText2 = fread($fp2, 2000);
                        fclose ($fp2);
					    $message_write= substr($_POST['message'],0,100).'...';						
						$dataText2 = str_replace ('$id',$el_id_get, $dataText2);
						$dataText2 = str_replace ('$message',addslashes( $message_write ), $dataText2);
						$dataText2 = str_replace ('$departament',$category['1'], $dataText2);
						$dataText2 = str_replace ('$date',date($dformatemail), $dataText2);
						$dataText2 = str_replace ('$subjet',$_POST['ticketsubject'], $dataText2);						
						$nro=$rowCat['sms']	;						
						$for_sms=	"api_id:$idsms$sep_sms_
						user:$usersms$sep_sms_
						password:$smspass$sep_sms_
						to:$nro$sep_sms_
						text:$dataText2";										
					$sendhtml='FALSE';//8bit encoding but text					
					$last_msg .=' '.SendMail('sms@messaging.clickatell.com','clickatell','SMS notification',$for_sms);
					
					}
					

}
} //end of detecting a ticket reloading

}//end of creating a new ticket
//=========================================

//============OPEN TICKET========================

	if ( $_GET['action']=='open')
	{	
	$authz='TRUE';
	include('./includes/top.php');
	include('./includes/open.php');
	include('includes/bottom.php');
	exit;
	}

//===========CREATES TICKET========================	

	if ( $_GET['action']=='create')
	{
	
	if(  ($limit_tickets <>'UNLIMITED') and ($limit_tickets<>'') )
					   {
					   $xc=mktime();
					  $count_tick="SELECT count(*) FROM tickets_tickets where tickets_admin='".$_SESSION['xcv_userna']					   
					   .
					   "' AND ($xc- tickets_timestamp < $limit_tickets)  ";
					   $vvv=$db->Execute($count_tick);
					   $c=$vvv->fields;
					   $quedan=$limit_tickets-$c[0];					   
					   if (  $c[0]> 0) //was exceded the number of tickets
					          {
						  $authz='TRUE';
				          include('./includes/top.php');						
                          include('./includes/not_create_ticket.php');
						  	exit;
					          }
					   
					   }
	
	$authz='TRUE';
	include('./includes/top.php');
	include('./includes/create_ticket.php');
	include('includes/bottom.php');
	exit;
	}
//================================

//===DEFAULT ACTION LIST TICKETS================
 	 $query = "	SELECT distinct tickets_id,unread_admin,unread_user,
	            tickets_subject,tickets_question,
				tickets_timestamp,
				d.tickets_status, b.name,
				b.color, tickets_categories_name
				FROM tickets_tickets a, tickets_levels b, tickets_categories c, users,tickets_state d
				WHERE a.tickets_username = '".$_SESSION['xcv_userna']."'
				AND a.tickets_child = '0' AND  (a.tickets_urgency = b.id) 
			  AND  (a.tickets_category = c.tickets_categories_id)
			  AND d.id=a.tickets_id ";
			  
 if ($dbms=='mssql')
 {
 	 $query_mssql = "	 SELECT  DISTINCT top _yy_ tickets_id,unread_admin,unread_user,
	            tickets_subject,tickets_question,
				tickets_timestamp,
				d.tickets_status, b.name,
				b.color, tickets_categories_name
				FROM tickets_tickets a, tickets_levels b, tickets_categories c, users,tickets_state d
				WHERE a.tickets_username = '".$_SESSION['xcv_userna']."'
				AND a.tickets_child = '0' AND  (a.tickets_urgency = b.id) 
			  AND  (a.tickets_category = c.tickets_categories_id)
			  AND d.id=a.tickets_id ";
 }
 
			IF (!isset($_GET['order']))
			{
			$_GET['order']='1';
			}
			
			IF (isset($_GET['order']))
				{
				$query .= " AND d.tickets_status = '".$_GET['order']."'";
				$query_mssql .=" AND d.tickets_status = '".$_GET['order']."'";
				$addon  = '&amp;order='.$_GET['order'];
				}
			IF (isset($_POST['keywords']))
				{//33 8888				
				
				$query = "SELECT distinct tickets_id,unread_admin,unread_user,tickets_username,
                  tickets_subject,tickets_question,
                  tickets_timestamp,tickets_child,
                  d.tickets_status, b.name,
                  color, tickets_categories_name
                  FROM tickets_tickets a, tickets_levels b, tickets_categories c, users,tickets_state d
				   WHERE
                  a.tickets_username = '".$_SESSION['xcv_userna']."'
			     AND  (a.tickets_urgency = b.id) 
			  AND  (a.tickets_category = c.tickets_categories_id)	  ";
			  
			  			IF (!isset($_GET['order']))
	             		{
	         		    $_GET['order']='1';
						}			
			            IF (isset($_GET['order']))
				        {
				       $query .= " AND d.tickets_status = '".$_GET['order']."'";
				        $addon  = '&amp;order='.$_GET['order'];
				       }
					   
					   
  			IF (isset($_POST['keywords']))
			{//33
			$keywords=$_POST['keywords'];
	        $query .= " AND MATCH(a.tickets_subject,a.tickets_question)
		   against ('$keywords' in boolean mode) ";//esta consulta devuelve a todos los tickets que contienen la keyword tickets padres a hijos
		   $addon  = '';
		    $db->SetFetchMode(ADODB_FETCH_ASSOC);
			//echo $query;
            $result_preliminar   = $db->Execute($query);
			/* not required, =devuelve tickets
			$cortar = split(")",$result_preliminar);
			$total_ticket_search_in_parent = $cortar[1];
			echo $total_ticket_search_in_parent;
			*/
			if ($total_ticket_search_in_parent>0)//If exists any results, tampoco se ej
			{  //######3
            //echo 'mama';
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
         
		   while ( ! $result_preliminar->EOF ); //nunca llega aqui
           $tickets_childs = $tickets_childs.'-100)';	
			//busca los padres
			$query = "SELECT distinct tickets_id,unread_admin,
			unread_user,tickets_username,
            tickets_subject,tickets_question,tickets_timestamp,
            d.tickets_status, b.name,color,
			tickets_categories_name
            FROM tickets_tickets a,tickets_levels b,
			tickets_categories c,users,tickets_state d
			WHERE
			a.tickets_id IN $tickets_childs 
		    AND a.tickets_id=d.id
            AND b.id=a.tickets_urgency
		   AND a.tickets_category=tickets_categories_id	";
			
			} //##### 
			
			}//33

				}
				//End New Query
				$query .= '	ORDER BY a.tickets_id DESC, a.tickets_timestamp DESC';
				
				//$tickets_display=22;
				
				 if ($dbms=='mssql')				 
 				{
				 $query_mssql;

 	  $query_mssql = "select top $tickets_display  * from (select top _xx_  * from
	     ($query_mssql order by a.tickets_id DESC) as foo order by foo.tickets_id ASC)
	    as bar order by bar.tickets_id DESC";
 				}
				
			//$query="SELECT MONTH('2003-12-31 01:02:03')";	
			//echo $query;
			 $db->SetFetchMode(ADODB_FETCH_ASSOC);
			 //echo $query;
			$result       = $db->Execute($query);
			//$fi=$result->$fields;
			//print_r($fi);
		
		/*print_r($result);
		$cortar = split(")mmmm",$result);
		$totaltickets = $cortar[1];
		echo $totaltickets;*/
		
		$query_old=$query;
	include('includes/functions_php.php');
	if ($dbms=='mysql'){
	$query = sprintf("%s LIMIT %d, %d",$query, $startRow_Recordset1, $maxRows_Recordset1);
	}
	 if ($dbms=='mssql')				 
 	{//begin sqlserver	
		 $rr= ($pageNum_Recordset1+1)*$tickets_display;//esto era mejor o no? 5:06pm dia 22, luego de 2horas, 6:13pm por agotamiento, ensayo y error salio!	
	 
		if ($rr >= $totalRows_Recordset1) //ultima pagina
		{
		 $rr=$totalRows_Recordset1; //por evitar posibles errores
		//$bb=(   (ceil(($totalRows_Recordset1/$tickets_display))     -$pageNum_Recordset1-1)*$tickets_display);
		//$rr_=   $totalRows_Recordset1- $bb;		
		$tickets_display2=ceil($totalRows_Recordset1/$tickets_display) ;		
		$query_mssql=str_replace( '_xx_',$tickets_display2, $query_mssql );
	 	}
	 	else
	 	{	$query_mssql=str_replace( '_xx_',$tickets_display, $query_mssql ); }
	
 $query_mssql=str_replace( '_yy_',$rr, $query_mssql );	  
 $query =   $query_mssql;
		
	}//end sqlserver
	
	$db->SetFetchMode(ADODB_FETCH_ASSOC);
	
	$result = $result = $db->Execute($query);

	$totalRows_contenido = 0;
	 if (is_object($result))
	 {$totalRows_contenido =  $result->RecordCount();
	 }
function set_class()
{
global $theclass;

$class1='even';
$class2='odd';
             IF($theclass == $class1)
			{
			$theclass = $class2;
			}
		    ELSE
			{
			$theclass = $class1;
			}


echo $theclass;

}
$authz='TRUE';
include('includes/top.php');
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
     	  if ( checkbox.checked==true){
	      rows[i].className='seleven';}
		  //if ( checkbox.checked==false){
	      //rows[i].className='even';}
		  
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
$authz='TRUE';
include('includes/list.php');
include('includes/bottom.php');
?>