<?php 

	if 	(	$retries>0)
	{	
		$querymensaje ="SELECT * FROM email_queue";		
		$rrrr=@mysql_query( $querymensaje);
		$filazz=mysql_fetch_assoc($rrrr);		
		$el_email=$filazz['el_email'];
		$el_from=$filazz['sended_from_name'];
		$for_staff=$filazz['subject'];
		$dataText=stripslashes( $filazz['body']);		
		$idn=$filazz['id'];		
		do 
		{		
			$reintentos=$filazz['retries']+1;		
			$iam_reintentando=true;
			SendMail($el_email,$el_from,$for_staff,$dataText);			
			$querymensaje ="UPDATE email_queue SET retries='$reintentos' WHERE id='$idn' ";
			@mysql_query( $querymensaje);
			

		}
		while (  $filazz=mysql_fetch_assoc($rrrr) );		
		$querymensaje ="DELETE FROM email_queue WHERE retries >= '$retries' ";		
		@mysql_query( $querymensaje);		
}		

?>