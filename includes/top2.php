<?php
if ($authz<>'TRUE') exit;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="includes/autoajax.js"></script>
<LINK href="includes/styles.php" type=text/css rel=stylesheet>
<link href="styles.php" rel="stylesheet" type="text/css">
<script>
function countDown2()
{        try
         { countDown();}
         catch(e) {}
         finally {}
}

function n_order()
{
	var ajaxRequest;  

	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	
	var add_id = document.getElementById('select2').value;
	var queryString ="?order_users=" + add_id;	
	//alert(queryString);
	ajaxRequest.open("GET", "tickets2.php" + queryString, true);
	ajaxRequest.send(null); 

}
</script>
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
</head>
<BODY  onLoad="countDown2()">
<table width="100%" border="0" align="<?php echo $maintablealign ?>" cellpadding="0" cellspacing="0" <?php if ($color_top==0) echo  'background="images/top_light.jpg"';  ?> class="boxbordertop">
  <tr>
    <td height="69" colspan="4" class="boxborder"><form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=home" method="post">
      <span class="text"></span>        
      <table width="100%"  align="right">
          <tr valign="top">
            <td width="29%" rowspan="2"  class="comment2"><span class="text">
              <?php if ($logo_url<>''){ ?>
              <img src="<?php echo $logo_url;  ?>"  longdesc="Facil Help Desk"alt="<?php echo $logo_url; ?>">
              <?php } ?>
            </span><?php echo  $last_msg;?><span class="text"> </span>
            <span class="text">           </span></td>
            <td  align="right" class="comment3"><input name="orden" type="hidden" id="orden" value="<?php echo $_GET['order']; ?>">
              Search  tickets:
                <input name="keywords" size="15" onFocus="javascript:this.value=''" value="Search" />              
              <?php  if ($dbms=='mysql') { ?>
			        <select name="type_search" id="type_search">
					<option value="3">* .</option>
					<option value="0">Body</option>
                  <option value="1">Subjet</option>
                  <option value="2">Username</option>
                    </select>
			  <?php  } ?>
              Or open ticket:
              <input name="the_ticket" id="the_ticket" onFocus="javascript:this.value=''" value="-1" size="5" />
                <input type="submit" value="Search" />
            &nbsp;</td>
          </tr>
          <tr valign="top">
            <td  class="text" > <?php echo '<BR>'.$sitename; ?></td>
          </tr>
        </table>
    </form></td>
    <td   valign="top" style="padding-right:15" width="23%" class="boxborder text44"><span class="comment3">User:
      <?php 
		echo $_SESSION['xcv_userna'];		
		?>
      <a href="./tickets2.php?action=mydaily"><?php echo $performance;?></a> </span>
      <div class="comment4"><?php  user_level(); 
	  echo '<BR>';
	  if ($online=='TRUE')
	   echo 'HelpDesk Enabled';
	   else 
	   echo 'HelpDesk Disabled';
	  ?>
      <span  style="padding-left:20px" ><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=home&amp;action=Logout"><?php echo $text_titlelog ?></a></span></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="<?php echo $bgcolor; ?>">
  <tr>    
    <td class="menu56"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=home&amp;order=1&new=1"><?php echo $text_titleope; ?></a></td>
    <td class="menu56"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=home&amp;order=0&new=1"><?php echo $text_titleclo; ?></a></td>
    <td class="menu56"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=home&amp;order=2"><?php echo 	$text_titlehold; ?></a></td>
	    <td class="menu56"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=create"><?php echo     $newticket; ?></a></td>    
	<td class="menu56"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=home&order=5&new=1"><?php echo $text_titlereq ?></a></td>
	<td class="menu56"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=users"><?php echo $the_users; ?></a></td>
	<?php if (is_admin()===TRUE) { ?>
    <td class="menu56"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=priorities"><?php echo $text_listurg; ?></a></td>
    <td class="menu56"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=control"><?php echo $settings; ?></a></td>
    <td class="menu56"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=reports"><?php echo $reports; ?></a></td>
	<?php } ?>
	 <?php
	 if ($dbms=='mysql')
	 {
	 ?>
    <td class="menu56"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=kb"><?php echo $kb; ?></a></td>
	<?php } ?>
    <td class="menu56"><a href="./includes/FacilHelpDesk.pdf"><?php echo $text_help; ?></a></td>
    <td width="300" class="menu56">&nbsp;</td>
  </tr>
</table>