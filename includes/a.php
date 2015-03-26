<?php
function retroceder($retroceso)
{
	$ahora=time();
	$mes_now=date("m",$ahora);
	$retrocedi=$mes_now -$retroceso;
	
if ( $retrocedi <= 0 )
{
	$mes_base=12;$ano_salida=date("Y")-1;$mes_salida = 12 + $retrocedi;
	if ( $retrocedi==12) $mes_salida=12;
}
else
{
	$ano_salida=date("Y");$mes_salida=$mes_now - $retroceso;
}

$sa=array();
$sa[0]=$ano_salida;$sa[1]=$mes_salida;
return $sa;
}


for ($a=0; a<=10; $a++)
{
print_r( retroceder($a) );
echo '<BR>';
}

?> 