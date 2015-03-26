<?php 
session_start();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Last</title>
</head>

<body>
<?php
if ( !isset($special_var) )
{
echo $_SESSION['reporte'];
}
else
{
echo $special_var;
}
?>
</body>
</html>
