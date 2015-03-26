<?php
$verbose=true;
//ver FHD 3.1 SLA
$inicio=phpTime(); 
require ('includes/pop3.class.php');
include_once('config.php');
include_once('includes/functions.php');

	IF (!isset($_REQUEST['lang']))
		{$_REQUEST['lang'] = $langdefault;}		
	$inc='language/'.$_REQUEST['lang'].'.php';	
	if (file_exists($inc)){	include($inc);}else 
	{$_REQUEST['lang'] = $langdefault;$inc='language/'.$_REQUEST['lang'].'.php';include($inc);	}



function phpTime (){
  $tTime = explode( " ", microtime());
  $dMsec = (double)$tTime[0];
  $dSec = (double)$tTime[1];
  return $dSec + $dMsec;
}
//echo 'inicio';
//busco tickets: padres abiertos o en hold, que no se haya seteado reserved
   $queryf = "SELECT tickets_tickets.tickets_id, tickets_tickets.tickets_timestamp,
                     tickets_tickets.tickets_category,tickets_tickets.tickets_username, users.username,users.t1,users.t2,tickets_state.tickets_status
   FROM tickets_tickets, users,tickets_state where tickets_tickets.tickets_username= users.username 
   and tickets_state.id=tickets_tickets.tickets_id
   and (tickets_state.tickets_status=1 or tickets_state.tickets_status=2) and tickets_tickets.tickets_child=0 and tickets_tickets.reserved='' 
      ORDER BY tickets_tickets.tickets_id DESC";
	$db->SetFetchMode(ADODB_FETCH_ASSOC);
	$resultf= $db->Execute($queryf );	
	//echo 'pase primera consulta' ;
while (	 $rowf=$resultf->fields )
	{
	$time_origin=$rowf['tickets_timestamp'];
	 $t1=$rowf['t1'];
	 $t2=$rowf['t2'];
	 $ticket5=$rowf['tickets_id'];
	 $user_o=$rowf['tickets_username'];
	  $queryfg="select tickets_tickets.tickets_id,tickets_tickets.tickets_timestamp,tickets_categories.supervisor from tickets_tickets,tickets_categories where 
	  tickets_categories.tickets_categories_id=tickets_tickets.tickets_category 
	  and (tickets_child='$ticket5' or tickets_tickets.tickets_id='$ticket5')
	  and tickets_username ='$user_o' order  by tickets_tickets.tickets_timestamp DESC"; //primero el mas reciente del usuario en base a este calculamos
	 $db->SetFetchMode(ADODB_FETCH_ASSOC);
	 $resultfg= $db->Execute($queryfg);
	 $rowfg=$resultfg->fields;
	 $time_user_last=$rowfg['tickets_timestamp'];
	  $super=$rowfg['supervisor'];
	 //hallo la mas reciente respuesta staff si existe
	$queryfg="select tickets_tickets.tickets_id,tickets_tickets.tickets_timestamp  from tickets_tickets,tickets_categories where 
	  tickets_categories.tickets_categories_id=tickets_tickets.tickets_category 
	  and (tickets_child='$ticket5' or tickets_tickets.tickets_id='$ticket5')
	  and tickets_admin <>'$user_o' 
	  and  ( (tickets_tickets.tickets_timestamp >= $time_user_last) and (tickets_tickets.tickets_timestamp<= $max_time_close)  )
	  order  by tickets_tickets.tickets_timestamp DESC"; //primero el mas ultimo del staff
	 $db->SetFetchMode(ADODB_FETCH_ASSOC);
	 $resultf2= $db->Execute($queryfg);
	 $row2=$resultf2->fields;
	  $time_staff_last=$row2['tickets_timestamp'];
	  $time_now=mktime();	  
	 
  	 	 $un_sql="	SELECT email,name FROM users where id= '$super' ";//if notif==1
		 if ($notifi1==2) $un_sql="	SELECT email,name FROM users where admin= 'Admin' ";
		 
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
		$result_xz =  $db->Execute( $un_sql );
		$filaxz = $result_xz->fields; //this notificates that he has  a new ticket

	  //T1 inicio
	  if (  ($time_user_last +($t1*3600)) <= $time_now )
	 {
	 	if ( ($notifi1==0) or ($notifi1==1)or ($notifi1==2)  )
	 	{//&&&
	 	//echo $t1_expired;	 	
		//echo 'notif'.$notifi1;
		$filaxz = $result_xz->fields; //this notificates that he has  a new ticket
		$message_write="Ticket: $ticket5";
		$time_fix=$time_user_last +($t1*3600);
		$querymensaje ="INSERT INTO sla_t1 (ticket,created,t1_to_fix) values('".$ticket5."','".$time_origin."','$time_fix')";
		$resultmesaje =$db->Execute($querymensaje);
		 $queryss = "	UPDATE tickets_tickets	SET reserved = 1 WHERE tickets_id   = '".$ticket5."'";		
		$resultss =$db->Execute($queryss);
		if($notifi1<>'0') 	 SendMail($filaxz['email'],$filaxz['name'],$t1_expired,$message_write );
	 	}//&&
	 }
//end of t1

if ( $time_now-$time_origin >= ($t2*3600) )
	 {
	 	if ( ($notifi2==0) or ($notifi2==1) or ($notifi2==2) )
	 	{//&&&
	 	//echo $t2_expired;	 	
		$message_write="Ticket: $ticket5";
		$time_fix=$time_origin+($t2*3600);
		 $querymensaje ="INSERT INTO sla_t2 (ticket,created,t1_to_fix) values('".$ticket5."','".$time_origin."','$time_fix')";
 		$resultmesaje =$db->Execute($querymensaje);		 		
		 $queryss = "	UPDATE tickets_tickets	SET reserved = 2 WHERE tickets_id   = '".$ticket5."'";		
		$resultss =$db->Execute($queryss);		
	 	if($notifi2<>'0') SendMail($filaxz['email'],$filaxz['name'],$t2_expired,$message_write );
	 	}//&&
	 }
//end t2
	 	//echo $mi; 
		//$mi++;
	  $resultf->MoveNext();
} //of while
		
echo 'finished';
?>