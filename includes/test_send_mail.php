<?php 
echo 'antes';
 $fd = popen("/usr/sbin/sendmail","w") or die("Couldn't Open Sendmail"); 
    fputs($fd, "To: rbanda72@cromosoft.com\n"); 
    fputs($fd, "From: \"Your Name\" <r.banda@cromosoft.com> \n"); 
    fputs($fd, "Subject: Test message from my web site \n"); 
    fputs($fd, "X-Mailer: PHP3 \n\n"); 
    fputs($fd, "Testing. \n"); 
    pclose($fd); 
	
  echo 'al final';


?>