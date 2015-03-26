<?php
if ($authz<>'TRUE') exit;
?>
<html>
<head>
<link href="includes/styles.php" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
<table align="center" cellpadding="0" cellspacing="0" bgcolor="<?php echo $bgcolor; ?>" class="boxbordertopn"  width="600"center">
  <tr>
    <td width="83%"  valign="top" bgcolor="<?php echo $bgcolor; ?>" class="boxborder text">
      <table width="50%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="52"><form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=home" method="post">
            <table width="100%" align="right" cellpadding="1" cellspacing="1">
              <tr>
                <td rowspan="2"  class="text"><span class="comment2"><?php if ($logo_url<>''){ ?><img src="<?php echo $logo_url;  ?>"  longdesc="Facil Help Desk"alt="<?php echo $logo_url; ?>"><?php } echo $last_msg;?></span>                  </td>
                <td width="435" align="right" valign="bottom" class="text" style="padding:2px">&nbsp;</td>
                </tr>
              <tr>
                <td  class="text" style="padding:2px"><?php	echo '<BR>'.$sitename; ?></td>
                </tr>
              </table>
          </form></td>
        </tr>
      </table>	
    </td>
  </tr>
</table>
<?php if ( $userww<>'Unregistered'){ ?>
<?php } ?>
