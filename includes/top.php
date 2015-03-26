<?php
if ($authz<>'TRUE') exit;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<table width="100%" border="0" align="<?php echo $maintablealign ?>" cellpadding="0" cellspacing="0" <?php if ($color_top==0) echo  'background="images/top_light.jpg"';  ?> class="boxbordertop">
  <tr>
    <td width="83%"  valign="top" class="boxborder">
    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="52"><form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=home" method="post">
          <table width="100%" align="right" cellpadding="1" cellspacing="1">
            <tr>
              <td rowspan="2"  class="text"><span class="comment2"><?php if ($logo_url<>''){ ?><img src="<?php echo $logo_url;  ?>"  longdesc="Facil Help Desk"alt="<?php echo $logo_url; ?>"><?php } echo $last_msg;?></span>                  </td>
              <td width="435" align="right" valign="bottom" class="text" style="padding:2px">Search your tickets:
                  <input name="keywords" size="24" onFocus="javascript:this.value=''" value="Search Ticket Subject, question" />
                  <input type="submit" value="Search" />
              </td>
            </tr>
            <tr>
              <td  class="text" style="padding:2px"><?php	echo '<BR>'.$sitename; ?></td>
            </tr>
          </table>
        </form></td>
      </tr>
    </table>	
    </td>
    <td width="17%"  style="padding-right:15" class="boxborder text"><div align="right"><span class="text">User:
            <?php 
		echo $_SESSION['xcv_userna'];
		?>
    </span></div></td>
  </tr>
</table>
<?php if ( $userww<>'Unregistered'){ ?>
<table width="100%" cellspacing="0" cellpadding="0" class="menu56">
  <tr>
    <td width="20%" bgcolor="<?php echo $background ?>"  class="menu57" >&nbsp;</td>
    <td bgcolor="<?php echo $background ?>" ><span class="menu56"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=home"><?php echo $index_; ?></a></span></td>
    <td class="menu56"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=create"><?php echo $newticket; ?></a></td>
    <td class="menu56"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=home&amp;order=1"><?php echo $text_titleope ?></a></td>
    <td class="menu56"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=home&amp;order=0"><?php echo $text_titleclo ?></a></td>
    <?php
	 if ($dbms=='mysql')
	 {
	 ?>	 
	<td class="menu56" width="6%"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=kb"><?php echo  $kb; ?></a></td>
	<?php } ?>
    <td class="menu56" width="7%"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=profile"><?php echo $profile; ?></a></td>
    <td class="menu56" width="10%"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=home&amp;action=Logout"><?php echo $text_titlelog ?></a></td>
  </tr>
</table>

<?php } ?>