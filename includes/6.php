<?php 


$to = 'r.banda@cromosoft.com';
$subject = 'subject';
$message = 'Mando mediante funcion mail';
$email = 'yo@librosdorados.com';
$headers = 'From: ' . $email . "\r\n" .
            'Reply-To: ' . $email . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
 
mail ($to, $subject, $message, $headers);
//header("Location: thanks.html");
echo 'ok';

echo phpversion();
echo 'ahora viene info';
phpinfo();



?>