<?php 
//---------
				 if ( ! isset($_COOKIE['Phtickets_username']) )
				 {
				        if ($_POST['remember']=='1')
				       {
					   setcookie('Phtickets_username',$_POST['name'],time()+ 31536000);
   					   setcookie('Phtickets_password',$_POST['password'],time()+ 31536000);					   
				       }
								 
				 }
				 else
				 {
				  if ($_POST['remember']=='1')
				       {
					   setcookie('Phtickets_username',$_POST['name'],time()+ 31536000);
   					   setcookie('Phtickets_password',$_POST['password'],time()+ 31536000);					   
				       }
					   else
					   {					
					   setcookie('Phtickets_username','',time() -3600);
   					   setcookie('Phtickets_password','',time() -3600);					   
				       }
				 }
				 //------------------

?>