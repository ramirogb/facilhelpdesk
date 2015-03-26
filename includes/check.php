<?php 

function check_login()//simple check users exists or not
{ global $db;
		$usuario=$_SESSION['xcv_userna'];$password=$_SESSION['xcv_passw'];
		 $query4444 = "	SELECT * FROM users WHERE username = '$usuario'	AND status = '1' and password='$password' ";		 
		$result9550 = $db->Execute($query4444);		
		$totalcvbvc456 = $result9550->RecordCount();
			IF ($totalcvbvc456 < 1)
			{
			$_SESSION['stavv']='Invalid login';$_SESSION['hlast_state']='Invalid login';$query4444 = "	SELECT * FROM users WHERE username = '$usuario'	
				        AND status = '0' and password='$password' ";
		$result9550 = $db->Execute($query4444);		
		$totalcvbvc456 = $result9550->RecordCount(); 
		IF ($totalcvbvc456 ==1)
			// echo ', Your account was disabled or was not activated.';
			{$_SESSION['stavv']='Disabled or not activated account';
	        $_SESSION['hlast_state']='Disabled or not activated account';			}			
			$jump_here="Location: ".'./index.php'; header($jump_here); exit;}
}
function check_login2()//are you active?
{ global $db;

		$usuario=$_SESSION['xcv_userna'];  $password=$_SESSION['xcv_passw'];				 
	  $query4444 = "	SELECT * FROM users
				        WHERE username = '$usuario'	
				        AND status = '1' and password='$password' ";
		$result9550 = $db->Execute($query4444);		
         $totalcvbvc456 =-1;//def
		  if (is_object($result9550))
		  {
		 $totalcvbvc456 = $result9550->RecordCount();
		 }
		 
		
		IF ($totalcvbvc456 < 1)
			{
			return false;
			}
			else
			return true;
}

function is_admin()
{ global $db;
		$usuario=$_SESSION['xcv_userna'];
	   $query4444 = "	SELECT admin FROM users where username='$usuario'";
	   $db->SetFetchMode(ADODB_FETCH_ASSOC);
   		$result9550 = $db->Execute($query4444);
		$fila=$result9550->fields;		
		if ($fila['admin']=='Admin')
		{
		return true;
		}
		else
		{
		return false;		
		}


}

function user_level()
{ global $db;
		$usuario=$_SESSION['xcv_userna'];
	   $query4444 = "	SELECT admin FROM users where username='$usuario'";
   		$result9550 = $db->Execute($query4444);
		$rr=$result9550->fields;
		if ($rr[0]=='Admin')
		echo 'Level Administrator';
				if ($rr[0]=='User')
		echo 'Level User';

		if ($rr[0]=='Mod')
		{
		echo 'Level Staff Member';
		$_SESSION['mxdfrtg65']='ZXSE';
		}

}

function user_level2()
{ global $db;
		$_SESSION['gnulevel']= -100; //user without login
		
		$usuario=$_SESSION['xcv_userna'];
	    $query4444 = "	SELECT admin FROM users where username='$usuario'";
		 $db->SetFetchMode(ADODB_FETCH_ASSOC);
   		$result9550 = $db->Execute($query4444);
		$rr=$result9550->fields;		
		if ($rr['admin']=='Admin')		$_SESSION['gnulevel']=2;		
		if ($rr['admin']=='Mod')		$_SESSION['gnulevel']=1;		
	    $query4444 = "	UPDATE users SET lastlogin='".mktime()."' WHERE username='$usuario'";
		$result9550 = $db->Execute($query4444);
		if ($rr['admin']=='User')
		$_SESSION['gnulevel']=0;
       return $_SESSION['gnulevel'];
}
function confHtmlEnt($data)
{   return htmlentities($data, ENT_QUOTES, 'UTF-8');}
 $cleanPost = array_map('confHtmlEnt', $_GET); 
$_GET=$cleanPost;
?>