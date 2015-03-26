<?php 
// So, username is your POP3 $username, password is your $password  
	function delete_mail($username,$password,$server);
	{
    $cmd = array();
    $cmd[]  = "USER $username\r\n";
    $cmd[]  = "PASS $password\r\n";
    $cmd[]  = "STAT\r\n";
    $cmd[]  = "QUIT\r\n";
// Server is your POP3 server, ie pop3.server.com
// Port is the port number ( should be 110 )
    $port = 110;

    $fp  = fsockopen($server, $port);
    if(!$fp)
    {print("Error connecting to server $server"); }
    else
    {   $ret = fgets($fp, 1024);
        foreach($cmd as $ret)
        {
            fputs($fp,$ret);
            $line = fgets($fp, 1024);
            print($line."<br>");
            if($ret=="STAT\r\n")
            {   $fields = explode(" ",$line);
                $num_mails = $fields[1];
                for($i=1;$i<=$num_mails;$i++)
                { fputs($fp,"DELE $i\r\n"); $line = fgets($fp, 1024); }  }
        }    }
}//end function		
?>
 