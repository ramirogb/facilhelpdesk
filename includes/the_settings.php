<?php
error_reporting (E_ALL ^ E_NOTICE);
if ($authz<>'TRUE') exit;
?>
<SCRIPT LANGUAGE="Javascript" SRC="includes/ColorPicker2.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
var cp = new ColorPicker('window'); // Popup window
var cp2 = new ColorPicker(); // DIV style
</SCRIPT>
<?php 
include('configuration.php');
?><style type="text/css">
<!--
.Estilo6 {color: #FFFFFF}
-->
</style>
<link href="styles.php" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo7 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: x-small;
}
-->
</style>
<div  class="comment2" align="right">
  <p>&nbsp;</p>
  <p align="center">For your security delete install.php after of installing.</p>
</div>
<table width="800" border="0" align="center" cellpadding="1" cellspacing="0" class="text">
  <tr>
    <td colspan="3" bgcolor="#0033CC"><span style="font-family: Arial, Helvetica, sans-serif; color: #FFFFFF"><a href="http://www.cromosoft.com"><img src="images/logo-facil-helpdesk.png" alt="Facil HelpDesk" width="100" height="30" border="0"></a></span></td>
    <td bgcolor="#0033CC" class="Estilo6">&nbsp;</td>
    <td width="50" bgcolor="#0033CC" class="Estilo6">&nbsp;</td>
    <td width="116" bgcolor="#0033CC" class="Estilo6">&nbsp;</td>
    <td colspan="2" bgcolor="#0033CC" class="Estilo6">Database version:
        <?php 
		if ($dbms=='mysql')
		{
			if ($detenteXS<>TRUE)
			{$sql="select version()";
		     $res = $db->Execute($sql);
			 $r=$res->fields;
			 echo $r[0];
			 }
			 
			 }
			 
			?></td>
  </tr>
  <tr>
    <td width="70" height="25"><div align="center">Settings:</div></td>
    <td width="80"><a href="#basic" class="titulo">Basic</a></td>
    <td width="118"><a href="#database" class="titulo">Database</a></td>
    <td width="120"><a href="#email" class="titulo">Email Settings</a></td>
    <td><a href="#colors" class="titulo">Colors</a>
      <div align="center"></div>
        <div align="center"></div></td>
    <td><a href="#polls">Polls</a></td>
    <td><a href="#sla">SLA</a></td>
    <td width="110"><p align="center">&nbsp;</p></td>
  </tr>
  <tr>
    <td height="32">&nbsp;</td>
    <td><a href="#access" class="titulo">Access</a></td>
    <td><a href="#localization">Localization</a></td>
    <td><a href="#notifications" class="titulo">Email notifications</a></td>
    <td colspan="2"><a href="#sms">SMS notifications </a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p><span class="content">
  <legend></legend>
</span></p>
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?action=settings_save">
  <table  width="800" border="0" align="center">
    <tr>
      <td  style="padding-left:6px "  width="1202"><span class="content">
        <legend><a name="basic"></a>Basic Settings and URLs</legend>
      </span> <p><label for="sitename">Site Title</label>        <input name="sitename" type="text" class="text" id="sitename" value="<?php echo $sitename; ?>" size="40">
</p>
      <p><label for="online">Online or under maintenance?</label><select name="online"  id="online">
          <option value="TRUE"<?php  if (!(strcmp("TRUE",$online ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
          <option value="FALSE"<?php if (!(strcmp("FALSE",$online ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
        </select>
      </p>
      <p><label for="siteurl">URL Base of Installation</label><input type="text" class="text" name="siteurl" id="siteurl" value="<?php echo $siteurl; ?>" size="30">
      </p>
      <p><span class="comment3" >Example: http://www.site.com/helpdesk/&nbsp; This url will be used for email notifications , k</span><span class="comment3" >nowledge Base : <a href="<?php echo $siteurl; ?>kbase/kbase.php"><?php echo $siteurl; ?>kbase/kbase.php</a> ,etc. 
        <input name="upgraded" type="hidden" id="upgraded" value="<?php echo $upgraded; ?>">
      </span></p>
      <p><label for="allowattachments">Allow attachments</label>        
        <select name="allowattachments"  id="allowattachments">
                <option value="TRUE"<?php  if (!(strcmp("TRUE", $allowattachments ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
                <option value="FALSE"<?php if (!(strcmp("FALSE", $allowattachments ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
          </select>
	<p><label for="allowrar">Allow binary attachments exe, rar, etc.(be carefull)</label>        
        <select name="allowrar"  id="allowrar">
                <option value="TRUE"<?php  if (!(strcmp("TRUE", $allowrar ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
                <option value="FALSE"<?php if (!(strcmp("FALSE", $allowrar ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
          </select>	  
</p>
      <p>
        <label for="uploadpath"><label>Upload Directory ( example: upload/ )</label> </label><input type="text" class="text" name="uploadpath" id="siteurl" value="<?php  echo $uploadpath; ?>" size="40">
      </p>
      <p><label for="maxfilesize">Max filesize(in bytes)</label><input name="maxfilesize" type="text" class="text" id="maxfilesize" value="<?php echo $maxfilesize; ?>" size="20">
    </p>
	  <p>
	    <label>Logo Image URL(left-top position ) </label>	      
	    <input type="text" class="text" name="logo_url" id="logo_url" value="<?php echo $logo_url; ?>" size="30">
	  </p>
	  <p><span class="content">
	    <legend> Style, colors: <a name="colors"></a></legend>
	  </span></p>
	  <p>
	    <label for="color_top">show top theme</label>
        <select name="color_top"  id="border">
          <option value="1"<?php    if (!(strcmp("1", $color_top ) ) ) {echo "SELECTED"; } ?> ><?php echo 'Only Background'; ?></option>
          <option value="0"<?php if (!(strcmp("0", $color_top) ) ) {echo "SELECTED"; } ?> ><?php echo 'Cool-color'; ?></option>
        </select> 
        <span class="comment3">Upload your own background at images/top_light.jpg</span></p>
	  <p>
	      <label for="bgcolor">Background(Hex.)</label> 	    
	      <input name="bgcolor" TYPE="text" id="bgcolor"  value="<?php echo $bgcolor; ?>" size="20"> 
	      <A HREF="#" NAME="pick1" class="comment4" ID="pick1" onClick="cp2.select(document.forms[1].bgcolor,'pick1');return false;">Pick</A> <span class="comment3">default: #DAEAFD</span></p>
	  <p class="textoconf">Gradients: </p>
	  <p>
	      <label for="menu1">Menu color1(Hex.)</label>
	      <input name="menu1" TYPE="text" id="menu1"  value="<?php echo $menu1; ?>" size="20"> 
	      <A HREF="#" NAME="pick2" class="comment4" ID="pick2" onClick="cp2.select(document.forms[1].menu1,'pick2');return false;">Pick</A>
	      <label for="menu2"></label>
	   </p>
	  <p>
	    <label for="menu2">Menu color2(Hex.)</label>
<input name="menu2" TYPE="text" id="menu2"  value="<?php echo $menu2; ?>" size="20">
	    <A HREF="#" NAME="pick3" class="comment4" ID="pick3" onClick="cp2.select(document.forms[1].menu2,'pick3');return false;">Pick</A>
	  </p>
	  <p><label for="menu3">Menu color1b(Hex.)</label>	    
	    <input name="menu3" TYPE="text" id="menu3"  value="<?php echo $menu3; ?>" size="20"> 
	    <A HREF="#" NAME="pick4" class="comment4" ID="pick4" onClick="cp2.select(document.forms[1].menu3,'pick4');return false;">Pick</A></p>
	  <p><label for="menu4">Menu Color2-b(Hex.)</label>	    
	    <input name="menu4" TYPE="text" id="menu4"  value="<?php echo $menu4; ?>" size="20"> 
	    <A HREF="#" NAME="pick5" class="comment4" ID="pick5" onClick="cp2.select(document.forms[1].menu4,'pick5');return false;">Pick</A></p>
	  <p><label for="fontc">Text Color(Hex.)</label>	    
	    <input name="fontc" TYPE="text" id="fontc"  value="<?php echo $fontc; ?>" size="20"> 
	    <A HREF="#" NAME="pick6" class="comment4" ID="pick6" onClick="cp2.select(document.forms[1].fontc,'pick6');return false;">Pick</A></p>
	  <p><label for="border">show border</label>	    <select name="border"  id="border">
          <option value="1"<?php    if (!(strcmp("1", $border ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
          <option value="0"<?php if (!(strcmp("0", $border ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
        </select>
	  </p>
	  <p>
	    <input type="submit" name="Submit" value="Save all">
	  </p>
	  <p><span class="content"><a name="localization" id="localization"></a>
          <legend></legend>
	  </span><span class="content">
	  <legend>Localization</legend>
	  </span> </p>
	  <p><label for="langdefault">Default User Language</label>	    <select name="langdefault" id="langdefault">
          <option value="en"<?php if (!(strcmp("en", $langdefault ) ) ) {echo "SELECTED"; } ?> ><?php echo 'en'; ?></option>
          <option value="no"<?php if (!(strcmp("no", $langdefault ) ) ) {echo "SELECTED"; } ?> ><?php echo 'no'; ?></option>
          <option value="es"<?php if (!(strcmp("es", $langdefault ) ) ) {echo "SELECTED"; } ?> ><?php echo 'es'; ?></option>
          <option value="fr"<?php if (!(strcmp("fr", $langdefault ) ) ) {echo "SELECTED"; } ?> ><?php echo 'fr'; ?></option>
          <option value="gm"<?php if (!(strcmp("gm", $langdefault ) ) ) {echo "SELECTED"; } ?> ><?php echo 'gm'; ?></option>
        </select>
	  </p>
	  <p><label for="content">Date Format</label> <span class="content">
	    <select name="dformat" id="dformat">
          <option value="d-m-Y"<?php if (!(strcmp("d-m-Y", $dformat ) ) ) {echo "SELECTED"; } ?> ><?php echo 'day month Year'; ?></option>
          <option value="m-d-Y"<?php if (!(strcmp("m-d-Y", $dformat ) ) ) {echo "SELECTED"; } ?> ><?php echo 'month day Y'; ?></option>
        </select>
	  </span></p>
	  <p><span class="content">
	    <legend>Database</legend>
	  </span> <a name="database"></a><span class="Estilo7">To change advanced settings edit <span class="red2">config.php</span> Lines 19 to 33, Databases Supported: MySql and  SQLServer 2008(only FHD 2.9) </span>        </p>

	  <label for="dbms">DBMS: </label>
          <select name="dbms" id="dbms">
            <option value="mssql"<?php if (!(strcmp("mssql", $dbms ) ) ) {echo "SELECTED"; } ?> ><?php echo 'MSSql'; ?></option>
            <option value="mysql"<?php if (!(strcmp("mysql", $dbms ) ) ) {echo "SELECTED"; } ?> ><?php echo 'MySql'; ?></option>
        </select>
	  <p>
        <label for="host">Host DBMS</label><input type="text"  class="red" name="host" id="host" value="<?php echo $host; ?>" size="20">
</p>
	  <p>
	    <label for="user">Username</label>
        <input name="user" type="text" class="red" id="user" value="<?php echo $user; ?>" size="20">
        <label for="pass"></label>
      </p>
	  <p>
        <label for="pass">Password</label>
        <input name="pass" type="password" class="red" id="pass" value="<?php echo $pass; ?>" size="20">
      </p>
	  <label for="data">Database</label>
      <input name="data" type="text" class="red" id="data" value="<?php echo $data; ?>" size="20">
      <p>&nbsp;</p>
      <p>
	    <legend><span class="content">Polls<a name="polls" id="polls"></a></span> </legend>
	  </p> 
	  <p>
        <label for="delete_tickets">Users can rate responses by email</label>
        <select name="rate_responses"  id="rate_responses">
          <option value="TRUE"<?php     if (!(strcmp("TRUE", $rate_responses ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
          <option value="FALSE"<?php if (!(strcmp("FALSE", $rate_responses ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
          <option value="ATCLOSE"<?php if (!(strcmp("ATCLOSE", $rate_responses ) ) ) {echo "SELECTED"; } ?> ><?php echo 'IF_CLOSE_TICKET'; ?></option>
        </select>
      </p>
	  <label  for="rate_responsest">Show link for polls when open tickets</label>	 
	    <select name="rate_responsest"  id="rate_responsest">
              <option value="TRUE"<?php     if (!(strcmp("TRUE", $rate_responsest ) ) ) {echo "SELECTED"; } ?> ><?php echo 'OPEN_TICKETS'; ?></option>
              <option value="FALSE"<?php if (!(strcmp("FALSE", $rate_responsest ) ) ) {echo "SELECTED"; } ?> ><?php echo 'CLOSED_TICKETS'; ?></option>
              <option value="BOTH"<?php if (!(strcmp("BOTH", $rate_responsest ) ) ) {echo "SELECTED"; } ?> ><?php echo 'ALL_TICKETS'; ?></option>
        </select>
	   
	  <p>
	  <label  for="npolls">Max.  responses per Polls</label>
	      <select name="res_polls"  id="npolls">
            <option value="1"<?php if (!(strcmp("1",$res_polls ) ) ) {echo "SELECTED"; } ?> ><?php echo '1'; ?></option>
            <option value="2"<?php if (!(strcmp("2",$res_polls) ) ) {echo "SELECTED"; } ?> ><?php echo '2'; ?></option>
            <option value="3"<?php if (!(strcmp("3",$res_polls ) ) ) {echo "SELECTED"; } ?> ><?php echo '3'; ?></option>
            <option value="5"<?php if (!(strcmp("5",$res_polls ) ) ) {echo "SELECTED"; } ?> ><?php echo '5'; ?></option>
          </select>
        </p>
	  <p><span class="content">
        
          <legend>Acces<a name="access"></a>s</legend>
	      </span> </p>
	  <p><label for="delete_tickets">Allow Moderators to Delete Tickets</label>	    
	    <select name="delete_tickets"  id="delete_tickets">
          <option value="TRUE"<?php    if (!(strcmp("TRUE", $delete_tickets ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
          <option value="FALSE"<?php if (!(strcmp("FALSE", $delete_tickets ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
        </select>
	  </p>
	  <p><label for="formticket">Allow form to ticket</label>	    
	    <select name="formticket"  id="formticket">
          <option value="TRUE"<?php    if (!(strcmp("TRUE", $formticket ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
          <option value="FALSE"<?php if (!(strcmp("FALSE", $formticket ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
		  <option value="TRUE_POP"<?php if (!(strcmp("TRUE_POP", $formticket ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE_POP'; ?></option>
        </select>
        <span class="comment3">Link at if enabled: <a href="./tickets.php?action=create_form">tickets.php?action=create_form</a> <a href="./includes/g.htm" target="_blank">Pop Up</a> </span></p>
	  <p>
	  <legend></legend>
	    
	    </p>
	  <p><label for="limit_staff">Reports visible only for administrators</label>	    
	    <select name="limit_staff"  id="limit_staff">
          <option value="TRUE"<?php     if (!(strcmp("TRUE", $limit_staff ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
          <option value="FALSE"<?php if (!(strcmp("FALSE", $limit_staff ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
        </select>
	  </p>
	  <p><label for="limit_tickets">Limit tickets created by user</label>	    
	    <select name="limit_tickets"  id="limit_tickets">
          <option value="30"<?php     if (!(strcmp("30", $limit_tickets ) ) ) {echo "SELECTED"; } ?> ><?php echo '30s'; ?></option>
          <option value="120"<?php     if (!(strcmp("120", $limit_tickets ) ) ) {echo "SELECTED"; } ?> ><?php echo '120s'; ?></option>
          <option value="240"<?php     if (!(strcmp("240", $limit_tickets ) ) ) {echo "SELECTED"; } ?> ><?php echo '240s'; ?></option>
          <option value="300"<?php     if (!(strcmp("300", $limit_tickets ) ) ) {echo "SELECTED"; } ?> ><?php echo '300s'; ?></option>
          <option value="600"<?php     if (!(strcmp("600", $limit_tickets ) ) ) {echo "SELECTED"; } ?> ><?php echo '10min'; ?></option>
          <option value="1800"<?php     if (!(strcmp("1800", $limit_tickets ) ) ) {echo "SELECTED"; } ?> ><?php echo '30min'; ?></option>
          <option value="7200"<?php     if (!(strcmp("7200", $limit_tickets ) ) ) {echo "SELECTED"; } ?> ><?php echo '2h'; ?></option>
          <option value="36000"<?php     if (!(strcmp("36000", $limit_tickets ) ) ) {echo "SELECTED"; } ?> ><?php echo '10h'; ?></option>
          <option value="UNLIMITED"<?php if (!(strcmp("UNLIMITED", $limit_tickets ) ) ) {echo "SELECTED"; } ?> ><?php echo 'UNLIMITED'; ?></option>
        </select> 
	    <span class="comment3">(time between tickets including responses)</span></p>
	  <p><label for="include_responses">Include previous responses</label>	    
	    <select name="include_responses"  id="include_responses">
			        <option value="TRUE"<?php     if (!(strcmp("TRUE", $include_responses ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
                    <option value="FALSE"<?php if (!(strcmp("FALSE", $include_responses ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
          </select>
</p>
	  <p><label for="open_responses">Users can open responses clicking a url</label>
	    <select name="open_responses"  id="open_responses">
			      <option value="TRUE"<?php     if (!(strcmp("TRUE", $open_responses ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
                  <option value="FALSE"<?php if (!(strcmp("FALSE", $open_responses ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
          </select>
</p>
	  <p><label for="tickets_display">Number of tickets per page</label>	    
	    <select name="tickets_display"  id="tickets_display">
          <option value="10"<?php if (!(strcmp("10", $tickets_display ) ) ) {echo "SELECTED"; } ?> ><?php echo '10'; ?></option>
          <option value="20"<?php if (!(strcmp("20", $tickets_display ) ) ) {echo "SELECTED"; } ?> ><?php echo '20'; ?></option>
          <option value="50"<?php if (!(strcmp("50", $tickets_display ) ) ) {echo "SELECTED"; } ?> ><?php echo '50'; ?></option>
          <option value="100"<?php if (!(strcmp("100",$tickets_display ) ) ) {echo "SELECTED"; } ?> ><?php echo '100'; ?></option>
        </select>
	  </p>
	  <p><label for="users_display">Number of users per page</label>	    
	    <select name="users_display"  id="users_display">
          <option value="10"<?php if (!(strcmp("10", $users_display ) ) ) {echo "SELECTED"; } ?> ><?php echo '10'; ?></option>
          <option value="20"<?php if (!(strcmp("20", $users_display ) ) ) {echo "SELECTED"; } ?> ><?php echo '20'; ?></option>
          <option value="50"<?php if (!(strcmp("50", $users_display ) ) ) {echo "SELECTED"; } ?> ><?php echo '50'; ?></option>
          <option value="100"<?php if (!(strcmp("100",$users_display ) ) ) {echo "SELECTED"; } ?> ><?php echo '100'; ?></option>
        </select>
	  </p>
	  <p><label for="showkb">Everybody can access Knowledge base(without password)</label> 
	    <select name="showkb"  id="showkb">
			      <option value="TRUE"<?php     if (!(strcmp("TRUE", $showkb ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
                  <option value="FALSE"<?php if (!(strcmp("FALSE", $showkb ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
          </select>
</p>
	  <p><label for="addcomments_kb">Users can add comments to articles</label>	    <select name="addcomments_kb"  id="addcomments_kb">
                  <option value="FALSE"<?php if (!(strcmp("FALSE", $addcomments_kb ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
		          <option value="TRUE"<?php     if (!(strcmp("TRUE", $addcomments_kb ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>                  
                </select> 
	  </p>
	  <p><label for="add_websites">Enable comments (email and site)</label>
	    <select name="add_websites"  id="add_websites">
                  <option value="TRUE"<?php     if (!(strcmp("TRUE", $add_websites ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
                  <option value="FALSE"<?php if (!(strcmp("FALSE", $add_websites ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
		          <option value="USERS"<?php if (!(strcmp("USERS", $add_websites ) ) ) {echo "SELECTED"; } ?> ><?php echo 'Only Registered'; ?></option>
          </select>
</p>
	  <p>
	    <label for="activa_by_email">Enable email verification </label>
	    <select name="activa_by_email"  id="activa_by_email">
          <option value="TRUE"<?php if (!(strcmp("TRUE", $activa_by_email ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
          <option value="FALSE"<?php if (!(strcmp("FALSE",$activa_by_email ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
        </select>
        <span class="comment3" >To activate an end user account for self registration</span></p>
	  <p>
	    <label for="activa_by_email">Disable end user registering</label>
        <select name="disable_registering"  id="disable_registering">
          <option value="TRUE"<?php if (!(strcmp("TRUE", $disable_registering ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
          <option value="FALSE"<?php if (!(strcmp("FALSE",$disable_registering ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
        </select>
        <span class="comment3" >Only Admin/staff will be able to add end users.</span></p>
	  <p><span class="content">
	    <legend><a name="email"></a>E-mail options</legend>
	  </span> <span class="comment4">(originates notifications)
	  <label for="sendmethod"></label>
	  </span>
	  <label for="sendmethod"></label>
	  </p>
	  <p>
	    <label for="sendmethod">Send method(PHP mailer)	</label>  
	    <select name="sendmethod"  id="sendmethod">
            <option value="mail"<?php if (!(strcmp("mail", $sendmethod ) ) ) {echo "SELECTED"; } ?> ><?php echo 'mail'; ?></option>
            <option value="sendmail"<?php if (!(strcmp("sendmail", $sendmethod ) ) ) {echo "SELECTED"; } ?> ><?php echo 'Sendmail'; ?></option>
            <option value="smtp"<?php if (!(strcmp("smtp", $sendmethod ) ) ) {echo "SELECTED"; } ?> ><?php echo 'smtp'; ?></option>
            <option value="qmail"<?php if (!(strcmp("qmail",$sendmethod ) ) ) {echo "SELECTED"; } ?> ><?php echo 'qmail'; ?></option>
			<option value="smtpTLS"<?php if (!(strcmp("smtpTLS", $sendmethod ) ) ) {echo "SELECTED"; } ?> ><?php echo 'smtpTLS'; ?></option>
          </select>
</p>
	  <p>
	    <label for="smtpserver">smtp Server (only for 2 methods: smtp/smtpTLS)</label>
        <input name="smtpserver" type="text" class="text" id="smtpserver" value="<?php echo $smtpserver; ?>" size="40">
</p>
	  <p><label for="smtpauth">SMTP Authentication</label> 
	    <select name="smtpauth"  id="smtpauth">
          <option value="TRUE"<?php if (!(strcmp("TRUE", $smtpauth ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
          <option value="FALSE"<?php if (!(strcmp("FALSE", $smtpauth ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
        </select>
</p>
	  <p>
	    <label for="socketfrom">Port</label>
	    <input name="portSMTP" type="text" class="text" id="portSMTP" value="<?php echo $portSMTP; ?>" size="3"> 
	    <span class="comment3">default 25, for TLS 465 </span></p>
	  <p><label for="socketfrom">Outgoing Email(reply to)	    </label><input name="socketfrom" type="text" class="text" id="socketfrom" value="<?php echo $socketfrom; ?>" size="40"> 
	  </p>
	  <p><label for="socketfromname">From name</label><input name="socketfromname" type="text" class="text" id="socketfromname" value="<?php echo $socketfromname; ?>" size="40">
	  </p>
	  <p><label for="smtpauthuser">smtp account</label>
	    <input name="smtpauthuser" type="text" class="text" id="smtpauthuser" value="<?php echo $smtpauthuser; ?>" size="40">
<label for="smtpserver"></label>
	  </p>
	  <p><label for="smtpauthpass">smtp password</label><input name="smtpauthpass" type="password" class="text" id="smtpauthpass" value="<?php echo $smtpauthpass; ?>" size="40">
<label for="activa_by_email"></label>
	  </p>
	  
	  <p class="textoconf">Enter an email for testing delivery  </p>
	  <p>
        <input type="submit" name="Submit"  value="test now" >
        <span class="comment3">First save settings</span> 
        <input name="emailfortest" type="text" class="text" id="emailfortest" size="30">
	  </p>
	  <p><span class="content">
	    <legend><a name="notifications"></a>Notifications by E-mail</legend>
	  </span> </p>
	  <p><label for="emailclose">The user receives an email if staff closes a ticket</label><select name="emailclose"  id="emailclose">
          <option value="TRUE"<?php  if (!(strcmp("TRUE", $emailclose ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
          <option value="FALSE"<?php if (!(strcmp("FALSE", $emailclose ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
        </select>
</p>
	  <p><label for="emailuser1">Email the user if there is a new response</label>	    <select name="emailuser1"  id="emailuser1">
          <option value="TRUE"<?php  if (!(strcmp("TRUE",$emailuser1 ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
          <option value="FALSE"<?php if (!(strcmp("FALSE",$emailuser1 ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
        </select>
	  </p>
	  <p><label for="emailusercopy">Send a copy of his ticket to the user	    </label><select name="emailusercopy"  id="$emailusercopy">
                  <option value="TRUE"<?php  if (!(strcmp("TRUE",$emailusercopy ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
                  <option value="FALSE"<?php if (!(strcmp("FALSE",$emailusercopy ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
                </select>
        <label for="emailusercopy"></label>
	  </p>
	  <p>
          <label for="disableresponses">Disable notif.  for every response from end user</label>
          <select name="disableresponses"  id="$disableresponses">
            <option value="TRUE"<?php  if (!(strcmp("TRUE",$disableresponses ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
            <option value="FALSE"<?php if (!(strcmp("FALSE",$disableresponses ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
          </select>
      </p>
	  <p><label for="emailasigned">Email staff user(individual) if a new ticket was assigned	    </label><select name="emailasigned"  id="emailasigned">
                <option value="TRUE"<?php  if (!(strcmp("TRUE",$emailasigned ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
                <option value="FALSE"<?php if (!(strcmp("FALSE",$emailasigned ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
              </select>
</p>
	  <p>
	    <label for="emailstaff">Email Department if there is a new ticket	    </label>
	    <select name="emailstaff"  id="emailstaff">
          <option value="TRUE"<?php  if (!(strcmp("TRUE",$emailstaff ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
          <option value="FALSE"<?php if (!(strcmp("FALSE",$emailstaff ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
        </select>
	  </p>
	  <p><label for="sendhtml">Send notifications as html	    </label><select name="sendhtml"  id="sendhtml">
                <option value="TRUE"<?php  if (!(strcmp("TRUE",$sendhtml ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
                <option value="FALSE"<?php if (!(strcmp("FALSE",$sendhtml ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
              </select>
</p>
	  <p><label for="retries">N of Retries for notifications	    </label><select name="retries"  id="retries">
			    <option value="0"<?php if (!(strcmp("0",$retries ) ) ) {echo "SELECTED"; } ?> ><?php echo '0'; ?></option>
  			    <option value="1"<?php if (!(strcmp("1",$retries ) ) ) {echo "SELECTED"; } ?> ><?php echo '1'; ?></option>
  			    <option value="2"<?php if (!(strcmp("2",$retries ) ) ) {echo "SELECTED"; } ?> ><?php echo '2'; ?></option>
  			    <option value="3"<?php if (!(strcmp("3",$retries ) ) ) {echo "SELECTED"; } ?> ><?php echo '3'; ?></option>			  
          </select>
</p>
	  <p><span class="content">
	    <legend><a name="sms" id="sms"></a>International notifications by SMS (requires <a href="https://www.clickatell.com/central/user/client/step1_new.php?prod_id=2">clickatel account</a>)</legend>
	  </span> </p>
	  <p>
	    	    <label for="emailclose">Send SMS when user submits ticket(using web interface)</label>
	    <select name="enablesms"  id="enablesms">
          <option value="TRUE"<?php  if (!(strcmp("TRUE", $enablesms ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
          <option value="FALSE"<?php if (!(strcmp("FALSE", $enablesms ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
        </select>
	  </p>
	  <p>
          <label for="smtpserver">API ID: </label>
          <input name="idsms" type="text" class="text" id="idsms" value="<?php echo $idsms; ?>" size="10">
          <label for="smtpserver"></label>
	    </p>
	  <p>
          <label for="smtpserver">Username:</label>
          <input name="usersms" type="text" class="text" id="usersms" value="<?php echo $usersms; ?>" size="10">

	    <label for="smtpserver"></label>
	  </p>
	  <p>
	    <label for="smtpserver">Password</label>
        <input name="smspass" type="password" class="text" id="smspass" value="<?php echo $smspass; ?>" size="10"> 
	  </p>
	  <p><span class="content">
	    <legend><a name="sla" id="sla"></a>SLA Settings(Will work only if you have licence to use SLA, an aditional cron job is required)</legend>
	  </span> </p>
	  <p>
	    <label for="notifi1">If your staff don't provide an answer to ticket after time interval t1, notificate to</label>
	    :
          <select name="notifi1" id="notifi1">
	  	    <option value="0"<?php if (!(strcmp("0",$notifi1 ) ) ) {echo "SELECTED"; } ?> ><?php echo 'Disabled'; ?></option>
	  	    <option value="1"<?php if (!(strcmp("1",$notifi1 ) ) ) {echo "SELECTED"; } ?> ><?php echo 'Supervisor'; ?></option>			
	  	    <option value="2"<?php if (!(strcmp("2",$notifi1 ) ) ) {echo "SELECTED"; } ?> ><?php echo 'Administrator'; ?></option>			
          </select>
              
	  </p>
	  <p>
    <label for="notifi1">If no solution is provided after  t2,Notificate to</label>
  :
  <select name="notifi2" id="notifi2">
    <option value="0"<?php if (!(strcmp("0",$notifi2 ) ) ) {echo "SELECTED"; } ?> ><?php echo 'Disabled'; ?></option>
    <option value="1"<?php if (!(strcmp("1",$notifi2 ) ) ) {echo "SELECTED"; } ?> ><?php echo 'Supervisor'; ?></option>
    <option value="2"<?php if (!(strcmp("2",$notifi2 ) ) ) {echo "SELECTED"; } ?> ><?php echo 'Administrator'; ?></option>
  </select>
	  </p>
	  <p>&nbsp;</p><p></p>
	  <p>&nbsp;</p>
	  <p><span class="textoconf">Footer*</span>	    <textarea name="footer" cols="60" rows="4" class="text" id="footer"><?php echo $footer; ?></textarea> 
	    </p>
	  <p>&nbsp;</p>
	  <p><span class="comment2">*If you want you can add a footer to all outgoing notifications by emails not for SMS.</span> 
	    <input name="save5" type="hidden" id="save5" value="1">
	  </p>
	  <p>
	    <input type="submit" name="Submit" value="Save all">
	  </p>
	  <p>&nbsp;	    </p>
	  <p>&nbsp;</p></td>
    </tr>
  </table>
</form>
<SCRIPT LANGUAGE="JavaScript">cp.writeDiv()</SCRIPT>