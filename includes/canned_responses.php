<?php
session_start();
if (check_login2()==false)
{
include('../includes/timeout.php');
exit;
}


	IF (!isset($_REQUEST['lang']))
		{$_REQUEST['lang'] = $langdefault;}		
	$inc='language/'.$_REQUEST['lang'].'.php';	
	if (file_exists($inc)){	include($inc);}else 
	{$_REQUEST['lang'] = $langdefault;$inc='language/'.$_REQUEST['lang'].'.php';include($inc);	
	
	}


if (  isset($_GET['close'])  )
{
session_destroy ();
//print "$closed";
$hgf="<html><style type=\"text/css\"><!--
body {	background-color: #FFFFFF;} .Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: x-small;
-->
</style><span class=\"Estilo1\">$closed</span></body></html>";
echo $hgf; 
exit;
}

$PicturePath = "../contenidos/";



if (  isset($_POST['ahora'] )  ) 
{
 $insertSQL="select * from contenidos";
 mysql_select_db($database_conexion1);
 $Resu5 = mysql_query($insertSQL); //para ignorar errores
 $totalRows_Recordset1 = mysql_num_rows( $Resu5 );

 $row_Recordset1 = mysql_fetch_assoc($Resu5);
 chdir('../'); //voy al directorio raiz
       do
          {
          $sourceurl=$row_Recordset1['sourceurl'];		  
            echo $destino_cms=$sourceurl."<br>";
			$destino_cms=$sourceurl;            
			}
			while (    $row_Recordset1 = mysql_fetch_assoc($Resu5)  );

}

if (empty($page)){
$page = 0;
}
$record =$admin_listpages_main;

if (!empty($addnews)) 
{
$categoria= $_POST['catego'];
$ttt=str_replace("\\",'\\\\',$sourceurl); 
{ //tengo que extraer de la base de datos info sobre anterior enlace
mysql_select_db($database_conexion1, $conexionxcz1);
$query_contenido = "SELECT * FROM contenidos WHERE sourceurl like '$ttt%' ";
$contenido = mysql_query($query_contenido) or die(mysql_error());
 $totalRows_contenido = mysql_num_rows($contenido);
} 
 $sourceurlsql=$sourceurl;
$_SESSION['sourceurl']=$sourceurl;
$url_fuente=$sourceurl;
if ($_POST['primera'] ==si) {$es_principal=1; } else {$es_principal=0;}
 $prefix = time(); 
$picture1=$prefix.$_FILES['userfile1']['name'];
$newsid = $db->addpage($catalogid,$es_principal,$isphp,$title,$descripcion,$tipo_texto1,$content1,$picture1,$alineado1,
$viewnum,$addate,$rating,$ratenum,$sourceurlg,$isdisplay,
$adelante,$atras,$autor,$keywords,$blockip);
   {   
   $userfile_name1 ='';$userfile_name2 ='';$userfile_name3 ='';
   if ( strlen($_FILES['userfile1']['name'] )  >3 ) { $userfile_name1 = $prefix.$_FILES['userfile1']['name']; }   
   
   //echo "-----1----";
   $dest1 = $PicturePath.$userfile_name1;   
   
  if (!empty(  $_FILES['userfile1'] )) 
  { 
  copy($_FILES['userfile1']['tmp_name'], $dest1);
  } 
$sourceurl=stripslashes($sourceurl).($totalRows_contenido+1).'.php';;
$destino_cms=$sourceurl;
 $db->add_Picture($newsid,$userfile_name1,$dest1,$userfile_name2,$dest2,$userfile_name3,$dest3);
 }
 
}
if (!empty($editnews)) {
   if ((!empty($_FILES['userfile']['name'])) && (!empty( $_FILES['userfile']['name']       ))) {   
   $prefix = time();
   $userfile_name2 = $prefix.$_FILES['userfile']['name'];
   $dest1 = $PicturePath.$userfile_name2;
   copy($userfile, $dest1);
   $db->add_Picture($newsid,$userfile_name2,$PicturePath);
   }
$db->editnews($catalogid,$title,$content,$viewnum,$rating,$ratenum,$source,$sourceurl,$isdisplay,$newsid);   
}
if (!empty($DP1)) {
   $db->del_Picture($newsid,$PicturePath);
}
//print_r($result);
?>
<html><head><title><?php print "$admin_newsadmin"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../includes/styles.php" type="text/css">
<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head><body bgcolor="#FFFFFF" text="#000000"><?php include('top.php'); ?>
        <div align="right"></div>
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#B3D6F2">
          <tr bgcolor="#B3D6F2">
            <td width="4%" class="bottom">N&ordm;</td>
            <td width="11%" class="bottom">Identifier of  url</td>
            <td width="5%" class="bottom">Link</td>
            <td width="49%" bgcolor="#B3D6F2" class="bottom"><?php print "$admin_title"; ?> </td>
            <td width="12%" class="bottom"><?php print "$last_update"; ?></td>
            <td width="8%" class="bottom"><?php print "$admin_catalog"; ?></td>
            <td width="3%" class="bottom"><?php print "$esta_visible"; ?></td>
            <td colspan="2" class="bottom"><?php print "$admin_opreation"; ?></td>
          </tr>
          <?php
              if (!empty($result)) {
	        while ( list($key,$val)=each($result) ) {
	        $newsid = stripslashes($val["newsid"]);
	        $catalogid = stripslashes($val["catalogid"]);
	        $title = stripslashes($val["title"]);
			$fechaxx = stripslashes($val["adddate"]);
			if ($fechaxx=='') $fechaxx=0;
			$tiempoff=strtotime( $fechaxx );			
			$fechaxx =date("d m Y H:i:s", $tiempoff);			
			$isdisplay = stripslashes($val["isdisplay"]);
			if ( $isdisplay==1) {$mostrar=$admin_yes; } else { $mostrar=$admin_no; } 
			$url = $val["sourceurl"];	        
	        $cataname = $db->getcatalognamebyid($catalogid);
              ?>
          <tr bgcolor="#FFFFFF">
            <td class="boxborder text"><?php print "$newsid"; ?></td>
            <td class="boxborder text" <?php if ($url=='main') 
				  {
				  print "class=\"Estiloazul\"";
				 //print 'hola';
				  }?>
				  ><?php print "$url"; ?></td>
            <td><a href="../?<?php echo $var_url;?>=<?php print "$url"; ?>" class="ListView"><?php print "$link"; ?></a></td>
            <td class="boxborder text"><?php print "$title"; ?></td>
            <td class="boxborder text"><?php print "$fechaxx"; ?></td>
            <td><?php print "$cataname"; ?></td>
            <td class="boxborder text"><?php print "$mostrar"; ?></td>
            <td width="3%"><a href="./edit_WYSWYG.php?newsid=<?php print "$newsid"; ?>" class="comment3"><?php print "$admin_edit"; ?></a></td>
            <td width="5%"><a href="./del_paginas.php?newsid=<?php print "$newsid"; ?>" class="comment3"><?php print "$admin_del"; ?></a></td>
          </tr>
          <?php
              }
              }
              ?>
          <tr bgcolor="#FFFFFF">
            <td align="right" colspan="9"><?php
              $pagenext = $page+1;

		if ($page!=0)
		{
		$pagepre = $page-1;		
		print "<a href=\"$PHP_SELF?page=$pagepre\"><font color=\"#FF0000\">$admin_previouspage</font></a>&nbsp;&nbsp;&nbsp;";
		}
		if (!empty($result1))
		{
		print "<a href=\"$PHP_SELF?page=$pagenext\"><font color=\"#FF0000\">$admin_nextpage</font></a>&nbsp;";
		}
		?>
            </td>
          </tr>
</table>
        <table width="80%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F2F2F2">
          <tr bgcolor="#FFFFFF">
            <td width="83"><?php print "$admin_name"; ?> :</td>
            <td width="198"><input type="text" name="catalogname"></td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td><?php print "$admin_description"; ?> :</td>
            <td><textarea name="description" cols="60" rows="5"></textarea></td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td><?php print "$admin_parentcatalog"; ?> :</td>
            <td><select name="parentid">
                <option value="0" selected><?php print "$admin_none"; ?></option>
                <?php
                $nameinfo = $db->getallcatalogname(); 
                if (!empty($nameinfo)){
	            while (list($key,$val)=each($nameinfo)) {
		    $catalogid = stripslashes($val["catalogid"]);
		    $catalogname = stripslashes($val["catalogname"]);
		    print "<option value=\"$catalogid\">$catalogname</option>";
		 }
		}
                ?>
              </select>
            </td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td>&nbsp;</td>
            <td><input type="submit" name="addcatalog" value="<?php print "$admin_add"; ?>"></td>
          </tr>
        </table>
        <form action="<?php print "$PHP_SELF"; ?>" method="POST" ENCTYPE="multipart/form-data">
          <table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
        <p>&nbsp;</p>
        </form></body>
</html>