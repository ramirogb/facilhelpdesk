<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<?php
$v="Ramiro Copyright 2004";
//echo preg_replace("/([Cc]opyright) 200(3|4|5|6)/", "$2 2010", $v);

 $string = "is FOOb  child!";
 
 $string = "<a  
  href=\"ff\">gg</ag";
  
 $string ="  <a href=\"  
http://seoprofessional1.wordpress.com/   \"> Professional SEO Company.";

    if (preg_match("/<a.*\">/s", $string)) {
        // we will not get here
		echo 'si';
    }

?>
<p><a href="ff">gg</a>g</p>
</body>
</html>
