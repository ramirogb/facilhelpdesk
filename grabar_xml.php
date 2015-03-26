<?php
$lang_obj='en'; //can be en es
$filtra=true;
$consulta='refund';

$all_anwers=true;
$max_leng=200;

function xmlentities ( $string )
{
    return str_replace ( array ( '&', '"', "'", '<', '>' ), array ( '&amp;' , '&quot;', '&apos;' , '&lt;' , '&gt;' ), $string );
}

   session_start();
   
   
   
    $search = array ("'<script[^>]*?>or .*?</script>'si",  // Strip out javascript 
                 "'<[/!]*?[^<>]*?>'si"       // Strip out HTML tags 
              
                 
                );                    // evaluate as php 

$replace = array ("", 
                 ""
              
                 
                 ); 
   
   include_once('config.php');

   $query_con="select * from tickets_tickets where tickets_child='0'";
   $db->SetFetchMode(ADODB_FETCH_ASSOC);
   $result_con = $db->Execute($query_con);	

   
   $separador= chr(10);
$documento='';   
  
 $start_head =  '<?xml version="1.0" encoding="UTF-8" ?>'.chr(13).'<searchresult>'.chr(13).'<query>'.$consulta.'</query>';
 $end_head  ='</searchresult>';
 $ruta_ticket_full= 'http://localhost/tesis/'; //por ahora no interesa visualizar esto
   $documento='';
   WHILE (! $result_con->EOF)
   {
   //tomo el listado de todos los tickets padres que ya tengo y les busco la respuesta		
		$tic=$result_con->fields; //assoc
		$el_ti=$tic['tickets_id'];
		$titulo=$tic['tickets_subject'];
		//echo $el_ti.'<BR>';
		 $query_last_eta="SELECT tickets_question
        			FROM tickets_tickets  WHERE (tickets_id = '".$el_ti."'
					OR tickets_child = '".$el_ti."') ORDER BY tickets_id ASC"; 
					//will be used to insert the time of response.
					
					
					$quer="SET NAMES utf8"; $db->Execute($quer);					
					
					   $db->SetFetchMode(ADODB_FETCH_ASSOC);
					$last_eta = $db->Execute($query_last_eta);					
					
					$tickets_question=''.$separador;
					do
					{
					$yyy_eta=$last_eta->fields;
					
					 $tickets_question= $tickets_question.$separador.stripslashes( $yyy_eta['tickets_question']).$separador;
					//echo $yyy_eta['tickets_question'];
					//if ($el_ti==4) exit;
					$last_eta->MoveNext();
					}
					while (  !$last_eta->EOF);
					
					//$yyy_eta=mysql_fetch_assoc($last_eta) );
					
					
$search2= array('<br/>','<BR>','<br>','');
$replace2 = array('','','','');
//$tickets_question =str_replace($search2,$replace2,$tickets_question);
$titulo=str_replace($search,$replace,$titulo);
$titulo=str_replace('<script>','',$titulo);$titulo=str_replace('</script>','',$titulo);
$titulo=str_replace('<script','',$titulo);$titulo=str_replace('</script>','',$titulo);




 $tickets_question = preg_replace($search, $replace, $tickets_question); 
$tickets_question =preg_replace ("/<a.*>/i","",$tickets_question); 
$tickets_question =preg_replace ("/<a.*>/sm","",$tickets_question); 
$tickets_question =preg_replace ("/<\/a/s","",$tickets_question); //</a corrige rastervector una etiqueta de cierre que no se por que quedo
//$tickets_question =preg_replace (" ",$tickets_question);





//filtro tickets que no sirven para soporte vienen de respuestas automaticas
//==========================
$suma=true;
if ($filtra==true)
{
$busca=array('Dear Developer,','Dear author','Dear Author,'
,'Dear Cromosoft Technologies','Dear Cromosoft,','Dear cromosoft.com','Hello Sir/madam',
'daemon-noreply@coredownload.com','Content-Trafer-Encoding: base64','Dear Sir or Madam',
'Content-Disposition: inline;',
'--------------Boundary-00');
$tickets_question = str_replace($busca,'judio',$tickets_question,$contad);
	if ($contad>0)
	{
	$suma=false;
	//echo 'mama';
	}
	else
	{
	$suma=true;
	}

}
//========================

$tickets_question = str_replace('','', $tickets_question);
//$tickets_question = str_replace('/<br>\/i','', $tickets_question);


					//echo $tickets_question;
	if ($el_ti>0)
	{
	

//languaje detection begin	 

	   $repla = array('hola','gracias','favor','soporte','ayuda','usted','dias'); //palabras claves que identifican el castellano
        $lengua='en';
		foreach($repla AS $tr)
			{ 
                $pos = strpos ($tickets_question, $tr); 
                if ($pos !== false)
				 {
				 $lengua='es';
				 //echo $tickets_question;
				 //break;
				 
				 } 
        	} 
//languaje detection end
//($suma==true) and			
//echo $suma;
	 if ( ($suma==true) and  ($lengua==$lang_obj) )
	  	{
		$tickets_question=htmlentities (xmlentities($tickets_question));
		$titulo=htmlentities( xmlentities($titulo));
		$la_url='http://localhost/tickets/tickets.php/';	
		/* para carrot2 workbenk esta ok
		$docu=chr(13)
		.'<document id="'.$el_ti.'">'
		.'<title>'.$titulo.'</title>'.chr(13)
		.'<url>'.$la_url.'</url>'.chr(13)
		.'<snippet>'
		.$tickets_question
		.'</snippet>'.chr(13)
		.'</document>';
		*/
		
//compatible para carrot2 API
$docu=   '<document>'.'<title>'.$titulo.'</title>'.'<url>'.$la_url.'</url>'.'<snippet>'.$tickets_question.'</snippet>'.'</document>';		
		$documento= $documento.$docu;
		echo ok;
		}
	}
	
	$result_con->MoveNext();
					
		}
		$filename='prueba.xml';
		echo 'antes';
		
		echo $documento;
		$documento=$start_head.$documento.$end_head;
		
					$fc = fopen("$filename", "wb"); 
					fwrite($fc,$documento);		
?>