<?php
session_start();
include_once('config.php');
include('includes/check.php');
include_once('includes/functions.php');

if (  isset($_POST['name']) and  isset($_POST['password'] ) )
{

//echo AuthUser($_POST['name'],$_POST['password']);

//autentica e inicia la sesion
                 {
				 $_SESSION['xcv_userna'] = $_POST['name'];
				 $_SESSION['xcv_passw']  = $_POST['password'];
				 
				 check_login();
				 user_level2();
				 setcookie('lang',$_POST['langdefault'],time()+ 31536000);
				 if ($_SESSION['gnulevel']>0)
                 {
				 @include('includes/cookies_unique.php');
				 
				 $jump_here="Location: ".'./tickets2.php';	
 				 if ($_SESSION['gnulevel']>0)
				 $jump_here="Location: ".'./tickets2.php?action=home';	
                 header($jump_here); 				 
                 exit;
				 }
				 else 
				 $jump_here="Location: ".'./';	
                 header($jump_here); 				 
                 exit;
                 }

//echo 'eeeeeeeeee';
}
	
	IF (!isset($_REQUEST['lang']))
		{$_REQUEST['lang'] = $langdefault;}		
	$inc='language/'.$_REQUEST['lang'].'.php';	
	if (file_exists($inc)){	include($inc);}else 
	{$_REQUEST['lang'] = $langdefault;$inc='language/'.$_REQUEST['lang'].'.php';include($inc);	
	
	}
 
?>
<html>
<link href="includes/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--

a:link {
	color: #000000;
}
a:visited {
	color: #000000;
}
-->
</style>
<table width="50%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="50%" style="border-color: #8F97EF; border-width:1px; border-style:solid" align="center" cellpadding="0" cellspacing="0" class="boxborder">
  <tr>
    <td colspan="2" class="text"><?php echo $_GET['action']; ?></td>
  </tr>
  <tr>
    <td width="25%"  valign="top"  bgcolor="#0033CC" class="text" style="padding:8px"><h4><span style="font-family: Arial, Helvetica, sans-serif; color: #FFFFFF"><span style="font-family: Arial, Helvetica, sans-serif; color: #FFFFFF"><img src="images/logo-facil-helpdesk.png" alt="Facil HelpDesk" width="100" height="30"></span></span><strong></strong></h4></td>
    <td width="75%"  valign="top"  bgcolor="#0033CC" class="text" style="padding:8px"><h3><span style="font-family: Arial, Helvetica, sans-serif; color: #FFFFFF">Control Panel Login</span> </h3></td>
    <?php

		IF (isset($allowreg) && $allowreg == 'ON')

			{

?>
    <?php

			}

?>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#F5F5F5" class="mio"  style="padding:5; padding-top:15px"><span class="boxborder list-menu"></span>      <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <p>
          <span class="mio"><span class="text"><?php echo $text_username ?></span></span>:
          <input name="name" type="text" id="name" value="<?php echo $_COOKIE['Phtickets_username']; ?>">
        </p>
        <p>          <span class="text"><?php echo $text_password ?>:</span>
          <input name="password" type="password" id="password" value="<?php echo $_COOKIE['Phtickets_password']; ?>"> 
        </p>        
          <p><span class="text">
	      <input name="remember" type="checkbox" id="remember" value="1"<?php
		   if (  isset( $_COOKIE['Phtickets_username']) )
		   {		   
		   echo 'checked';
		   }
		   ?>> 
        <?php echo $rememberme; ?><span class="content"><BR>Locale:
        <select name="langdefault" id="langdefault">
          <option value="en"<?php if (!(strcmp("en", $langdefault ) ) ) {echo "SELECTED"; } ?> ><?php echo 'English'; ?></option>
		  <option value="es"<?php if (!(strcmp("es", $langdefault ) ) ) {echo "SELECTED"; } ?> ><?php echo 'Espa&ntilde;ol'; ?></option>
		  <option value="fr"<?php if (!(strcmp("fr", $langdefault ) ) ) {echo "SELECTED"; } ?> ><?php echo 'french'; ?></option>
		  <option value="fr"<?php if (!(strcmp("de", $langdefault ) ) ) {echo "SELECTED"; } ?> ><?php echo 'Deutsch'; ?></option>         
        </select>
        </span></span>User (administrator): admin password: admin</p>
          <p>
              <input type="submit" name="Submit" value="Submit">
              <input name="login" type="hidden" id="login" value="1">
    
        </p>
    </form>
      <p class="text"><a href="./index.php?action=send_login"><?php echo $text_resend ?></a></p>
      <p class="text"><a href="index.php?action=register"><?php echo $text_register ?></a></p></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#F5F5F5" class="mio"  style="padding:0">
	<DIV ID="oFilterDIV" STYLE="position: relative; height:30px; padding:1px; font:10pt verdana; background:#0033CC;
	  filter:progid:DXImageTransform.Microsoft.Alpha( Opacity=90, FinishOpacity=30, Style=2, StartX=40,  FinishX=90, StartY=50, FinishY=100);
	   left: 1px;"><span class="text" style="color: #FFFFFF">
	   <a href="http://www.cromosoft.com">&copy; Cromosoft Technologies 2003-2013</a></span></DIV>
	</td>
  </tr>
</table>
<span class="menu56"></span>
</html>