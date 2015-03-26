<?php
include_once('func_deco.php');
/* @(#) $Header: /home/mlemos/cvsroot/mimeparser/test_message_decoder.php,v 1.5 2007/01/05 21:31:26 mlemos Exp $
 */	  
	/* Set to 0 for parsing a single message file
	 * Set to 1 for parsing multiple messages in a single file in the mbox format */
	$mime->mbox = 1;	
	/*	 * Set to 0 for not decoding the message bodies	 */
	$mime->decode_bodies = 1;
	/*	 * Set to 0 to make syntax errors make the decoding fail	 */
	$mime->ignore_syntax_errors = 1;	
	global $uploadpath;
	global $para_dec;
	//echo $para_dec;
	$szEml=$para_dec;	
	$parameters=array('Data'=>$szEml,
		/* Read a message from a string instead of a file */
		/* 'Data'=>'My message data string',              */
		/* Save the message body parts to a directory     */
		 'SaveBody'=>'upload',
		/* Do not retrieve or save message body parts     */
		'SkipBody'=>0,
	);

	if(!$mime->Decode($parameters, $decoded))
		echo 'MIME message decoding error: '.$mime->error.' at position '.$mime->error_position."\n";
	else
	{
		//echo 'MIME message decoding successful.'."\n";
		//echo (count($decoded)==1 ? '1 message was found.' : count($decoded).' messages were found.'),"\n";

$decodedN = $decoded[0];
$index = 0;
$parts = $decodedN['Parts'];

if (  count($decodedN['Parts']==0) )
{$arch=$decoded[0]['BodyFile'];
$mensaje='';
if ($arch<>'') $mensaje=file_get_contents($arch);}

$resulta = arrayFromEmailParts($parts,$index);
$las_partes=array();
$las_partes=$resulta;
$aprueba=false;

  for($renombrador = 0; $renombrador < count($resulta); $renombrador++)
  { 
  $mensaje=$resulta[$renombrador]['content']; 
     if     ( $resulta[$renombrador]['type'] == 'text/plain')
	  {//save to the database
	  $mensaje=$resulta[$renombrador]['content'];	$str_me=true;break;
	  $aprueba=true;
	  }
  }  

//no tiene texto solo html entonces pondre html
if ($aprueba==false)
{
 	 for($renombrador = 0; $renombrador < count($resulta); $renombrador++)
 	 	{ 

    	 if(     ( $resulta[$renombrador]['type'] == 'text/html') and ($aprueba==false) )
	  	{//save to the database
	  	$mensaje=$resulta[$renombrador]['content'];	$str_me=true;break;
		  $aprueba=true;
	  	}
  	}  
}	

		
		/*
		for($message = 0; $message < count($decoded); $message++)
		{
			echo 'Message ',($message+1),':',"\n".'<BR><BR>';
			print_r($decoded[$message]).'<BR>';
		}
		*/
		
		/*
		for($warning = 0, Reset($mime->warnings); $warning < count($mime->warnings); Next($mime->warnings), $warning++)
		{$w = Key($mime->warnings);
			echo 'Warning: ', $mime->warnings[$w], ' at position ', $w, "\n";
		}
		*/
	}
?>