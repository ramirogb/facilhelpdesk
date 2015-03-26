<?php 
session_start();
		$usuario=$_SESSION['xcv_userna'];
        $password=$_SESSION['xcv_passw'];
				 
	echo $query4444 = "	SELECT * FROM users
				WHERE user_username = '$usuario'	
				AND user_status = '1' and user_password='$password' ";
		$result9550 = mysql_query($query4444);
		$totalcvbvc456 = mysql_num_rows($result9550);		
		IF ($totalcvbvc456 < 1)
			{
			print_r($result);
			echo 'invalid login';
			exit;
			}

?>