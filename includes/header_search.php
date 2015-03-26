<?php
if ($authz<>'TRUE') exit;
?>
<SCRIPT LANGUAGE="Javascript" SRC="includes/ColorPicker2.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
var cp = new ColorPicker('window'); // Popup window
var cp2 = new ColorPicker(); // DIV style
</SCRIPT>
<?php 
include('configuration.php');
?>
<style type="text/css">
<!--
.Estilo2 {color: <?php echo $menu1; ?>}
.Estilo3 {color: <?php echo $menu2; ?>}
.Estilo4 {color: <?php echo $menu3; ?>}
.Estilo5 {color: <?php echo $menu4; ?>}
-->
</style>

<link href="styles.php" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo6 {color: #FFFFFF}
-->
</style>
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?action=settings"">
  <div  class="comment2" align="right">For your security delete install.php after of using </div>
  <table width="70%"  border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><span class="text">
      <p>&nbsp;</p>
      </span>
        <table width="700" border="0" cellpadding="1" cellspacing="0" class="text">
          <tr>
            <td colspan="4" bgcolor="#0033CC"><span style="font-family: Arial, Helvetica, sans-serif; color: #FFFFFF"><img src="images/logo-facil-helpdesk.png" alt="Facil HelpDesk" width="100" height="30"></span>
			<?php			
			echo $my_version;
			
			?></td>
            <td bgcolor="#0033CC" class="Estilo6">&nbsp;</td>
            <td bgcolor="#0033CC" class="Estilo6">&nbsp;</td>
            <td bgcolor="#0033CC" class="Estilo6">&nbsp;</td>
            <td colspan="2" bgcolor="#0033CC" class="Estilo6">Mysql version:
                <?php 
			$sql="select version()";
		     $res = @mysql_query($sql);
			 $r=@mysql_fetch_row($res);
			 echo $r[0];
			 
			?></td>
          </tr>
          <tr>
            <td width="70" height="25"><div align="center">Settings:</div></td>
            <td width="80"><div align="center"><a href="#basic" class="titulo">Basic</a></div></td>
            <td colspan="2"><div align="center"><a href="#database" class="titulo">Database</a></div></td>
            <td width="114"><div align="center"><a href="#email" class="titulo">Email Settings</a></div></td>
            <td width="94"><div align="center"><a href="#colors" class="titulo">Colors</a></div></td>
            <td width="116"><div align="center"><a href="#notifications" class="titulo">Notifications</a></div></td>
            <td width="152"><div align="center"><a href="#localization">Localization</a></div></td>
            <td width="80"><p align="center"><a href="#access" class="titulo">Access</a></p></td>
          </tr>
          <tr>
            <td height="32">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <div>
<fieldset>
            <span class="content">
            <legend><a name="basic"></a>Basic Settings and URLs</legend>
            </span>            
            <label for="title">Site Title</label>
            <input name="sitename" type="text" class="text" id="sitename" value="<?php echo $sitename; ?>" size="40">
            <label for="online">Online or under maintenance?</label>
            <select name="online"  id="online">
              <option value="TRUE"<?php  if (!(strcmp("TRUE", $online ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
              <option value="FALSE"<?php if (!(strcmp("FALSE", $online ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
            </select>
            <br>
            <label for="baseurl">URL Base of Installation</label>
            <p>
              <input type="text" class="text" name="siteurl" id="siteurl" value="<?php echo $siteurl; ?>" size="40">
            </p><BR><BR>
            <p><span class="comment3" >Example: http://www.site.com/helpdesk/&nbsp; This url will be used for email notifications and others.</span>
            </p>
            <p><span class="comment3" >Knowledge Base (end user): <a href="<?php echo $siteurl; ?>kbase/kbase.php"><?php echo $siteurl; ?>kbase/kbase.php</a>
</span></p>
            <p><span class="comment3" >
            </span></p>
            <label for="allowattachments">Allow attachments</label>
			<select name="allowattachments"  id="allowattachments">
              <option value="TRUE"<?php  if (!(strcmp("TRUE", $allowattachments ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
              <option value="FALSE"<?php if (!(strcmp("FALSE", $allowattachments ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
            </select>
			<label for="uploaddir">Upload Directory ( example: upload/ ) </label>			
			<input type="text" class="text" name="uploadpath" id="siteurl" value="<?php  echo $uploadpath; ?>" size="40">
            <label  for="file_path">Max filesize(in bytes)</label>
           <input name="maxfilesize" type="text" class="text" id="maxfilesize" value="<?php echo $maxfilesize; ?>" size="40">
            <br>            
			<label for="logo_url">Logo Image URL(left-top position )</label>			
            </span>
            <p class="text"><input type="text" class="text" name="logo_url" id="logo_url" value="<?php echo $logo_url; ?>" size="50">
              <label for="logo_url"></label>
            </p>
			</p>	        
		</fieldset>
            <fieldset>
            <span class="content">
            <legend><a name="colors"></a>Colors, style</legend>
            </span>			
                <label for="bgcolor">Background(Hex.)</label>
                <p>
                <input name="bgcolor" TYPE="text" id="bgcolor"  value="<?php echo $bgcolor; ?>" size="20">
                <A HREF="#" NAME="pick1" class="comment4" ID="pick1" onClick="cp2.select(document.forms[1].bgcolor,'pick1');return false;">Pick</A> <span class="comment3">default: #DAEAFD</span></p>
                <div class="comment4"><p>Gradients:</div>
                <p>
                  <label for="menu1">Menu <span class="Estilo2">color1</span>(Hex.) </label>
                </p>
              <input name="menu1" TYPE="text" id="menu1"  value="<?php echo $menu1; ?>" size="20">
            <A HREF="#" NAME="pick2" class="comment4" ID="pick2" onClick="cp2.select(document.forms[1].menu1,'pick2');return false;">Pick</A>
              <label for="menu2">Menu<span class="Estilo3"> Color2</span>(Hex.)</label>
              <p>
                <input name="menu2" TYPE="text" id="menu2"  value="<?php echo $menu2; ?>" size="20">
            <A HREF="#" NAME="pick3" class="comment4" ID="pick3" onClick="cp2.select(document.forms[1].menu2,'pick3');return false;">Pick</A></p>
              <label for="menu3">Menu <span class="Estilo4">color1b</span>(Hex.)</label>
               <input name="menu3" TYPE="text" id="menu3"  value="<?php echo $menu3; ?>" size="20">
              <A HREF="#" NAME="pick4" class="comment4" ID="pick4" onClick="cp2.select(document.forms[1].menu3,'pick4');return false;">Pick</A>
			    <label for="menu4">Menu<span class="Estilo5"> Color2-b</span>(Hex.)</label>
                <p>
                <input name="menu4" TYPE="text" id="menu4"  value="<?php echo $menu4; ?>" size="20">
              <A HREF="#" NAME="pick5" class="comment4" ID="pick5" onClick="cp2.select(document.forms[1].menu4,'pick5');return false;">Pick</A></p>
				<p>
			    <label for="fontc">Text Color(Hex.)</label>
                <input name="fontc" TYPE="text" id="fontc"  value="<?php echo $fontc; ?>" size="20">
                <A HREF="#" NAME="pick6" class="comment4" ID="pick6" onClick="cp2.select(document.forms[1].fontc,'pick6');return false;">Pick</A></p>
                <label for="border">show border</label>
                  <select name="border"  id="border">
                    <option value="1"<?php    if (!(strcmp("1", $border ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
                    <option value="0"<?php if (!(strcmp("0", $border ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
                  </select>
                <p>
			      <input type="submit" name="Submit" value="Save all">			  
              </p>
            </fieldset>			
            <fieldset>
            <span class="content">
			<a name="localization" id="localization"></a>
            <legend>Localization</legend>
            </span>
            <label for="langdefault"><span class="content"></span>Default User Language</label>
            <select name="langdefault" id="langdefault">
              <option value="en"<?php if (!(strcmp("en", $langdefault ) ) ) {echo "SELECTED"; } ?> ><?php echo 'en'; ?></option>
			  <option value="no"<?php if (!(strcmp("no", $langdefault ) ) ) {echo "SELECTED"; } ?> ><?php echo 'no'; ?></option>
			  <option value="es"<?php if (!(strcmp("es", $langdefault ) ) ) {echo "SELECTED"; } ?> ><?php echo 'es'; ?></option>
			  <option value="fr"<?php if (!(strcmp("fr", $langdefault ) ) ) {echo "SELECTED"; } ?> ><?php echo 'fr'; ?></option>
			  <option value="gm"<?php if (!(strcmp("gm", $langdefault ) ) ) {echo "SELECTED"; } ?> ><?php echo 'gm'; ?></option>
            </select>
            <p class="content">
              <label for="date_format"></label>
              <label for="date_format">Date Format</label>              
            <select name="dformat" id="dformat">
			  <option value="d-m-Y"<?php if (!(strcmp("d-m-Y", $dformat ) ) ) {echo "SELECTED"; } ?> ><?php echo 'day month Year'; ?></option>
		  <option value="m-d-Y"<?php if (!(strcmp("m-d-Y", $dformat ) ) ) {echo "SELECTED"; } ?> ><?php echo 'month day Y'; ?></option>              
            </select>
            <br><br>
        </p>
            </fieldset>			
          <p><a name="database"></a>		    
        <div>
			<fieldset>
			<span class="content">			
			<legend>Mysql database</legend></span>			
			<p class="text">If you alter these setting<span class="red2">*</span> the system could stop of working! , if it happens execute install.php </p>
			<label for="host">Host</label>          
            <input type="text"  class="red" name="host" id="host" value="<?php echo $host; ?>" size="40">
            <label for="username">Username</label>
			<input name="user" type="text" class="red" id="user" value="<?php echo $user; ?>" size="40">            
            <label for="password">Password</label>
			<input name="pass" type="password" class="red" id="pass" value="<?php echo $pass; ?>" size="40">
            <label for="database">Database</label>
			<input name="data" type="text" class="red" id="data" value="<?php echo $data; ?>" size="40">
			</p>             
		  </fieldset>		  
		  <fieldset>
			 <span class="content">
			 <legend>Acces<a name="access"></a>s</legend>
			 </span>
			<label for="delete_tickets">Allow Moderators to Delete Tickets</label>
		    <select name="delete_tickets"  id="delete_tickets">
			<option value="TRUE"<?php    if (!(strcmp("TRUE", $delete_tickets ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
              <option value="FALSE"<?php if (!(strcmp("FALSE", $delete_tickets ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
            </select>			
			<label for="rate_responses">Users can rate responses</label>
                <select name="rate_responses"  id="rate_responses">
			    <option value="TRUE"<?php     if (!(strcmp("TRUE", $rate_responses ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
                <option value="FALSE"<?php if (!(strcmp("FALSE", $rate_responses ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
                </select>
				<label for="limit_staff">Reports visible only for administrators</label>
                <select name="limit_staff"  id="limit_staff">
			    <option value="TRUE"<?php     if (!(strcmp("TRUE", $limit_staff ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
                <option value="FALSE"<?php if (!(strcmp("FALSE", $limit_staff ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
                </select>
            <label for="limit_tickets">Limit tickets created by user</label>            
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
          <span class="comment3">(time between tickets including responses)</span>     
			  <label for="include_responses">Include previous responses</label>
		    <select name="include_responses"  id="include_responses">
			<option value="TRUE"<?php     if (!(strcmp("TRUE", $include_responses ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
              <option value="FALSE"<?php if (!(strcmp("FALSE", $include_responses ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
            </select>
			<label for="open_responses">Users can open responses clicking a url</label>
		    <p>
		      <select name="open_responses"  id="open_responses">
			    <option value="TRUE"<?php     if (!(strcmp("TRUE", $open_responses ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
                <option value="FALSE"<?php if (!(strcmp("FALSE", $open_responses ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
             </select>
	      </p>
		    <p>&nbsp;</p>
		    <label for="tickets_display">Number of tickets per page</label>
            <select name="tickets_display"  id="tickets_display">
                  <option value="10"<?php if (!(strcmp("10", $tickets_display ) ) ) {echo "SELECTED"; } ?> ><?php echo '10'; ?></option>
		          <option value="20"<?php if (!(strcmp("20", $tickets_display ) ) ) {echo "SELECTED"; } ?> ><?php echo '20'; ?></option>
                  <option value="50"<?php if (!(strcmp("50", $tickets_display ) ) ) {echo "SELECTED"; } ?> ><?php echo '50'; ?></option>
                  <option value="100"<?php if (!(strcmp("100",$tickets_display ) ) ) {echo "SELECTED"; } ?> ><?php echo '100'; ?></option>
          </select>
		  <p>&nbsp;</p>
			  <p>
			    <label for="users_display"></label>
		  </p>
			  <p>
			    <label for="users_display"></label>
		  </p>
			  <p>
			    <label for="users_display">Number of users per page</label>
	                  </p>
			  <select name="users_display"  id="users_display">
                <option value="10"<?php if (!(strcmp("10", $users_display ) ) ) {echo "SELECTED"; } ?> ><?php echo '10'; ?></option>
			    <option value="20"<?php if (!(strcmp("20", $users_display ) ) ) {echo "SELECTED"; } ?> ><?php echo '20'; ?></option>
                <option value="50"<?php if (!(strcmp("50", $users_display ) ) ) {echo "SELECTED"; } ?> ><?php echo '50'; ?></option>
                <option value="100"<?php if (!(strcmp("100",$users_display ) ) ) {echo "SELECTED"; } ?> ><?php echo '100'; ?></option>
              </select>			  
		  <p>
			    <label for="showkb"></label>
			    <label for="showkb"></label>
                <label for="showkb">Everybody can access Knowledge base(without password)</label>
                <select name="showkb"  id="showkb">
			      <option value="TRUE"<?php     if (!(strcmp("TRUE", $showkb ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
                  <option value="FALSE"<?php if (!(strcmp("FALSE", $showkb ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
                </select>
		  </p>
			  <p>&nbsp;</p>
			  <p>
             <label for="addcomments_kb"></label></p>
			  <p>&nbsp;</p>
			  <p>
                  <label for="addcomments_kb">Users can add comments to   articles</label>
                <select name="addcomments_kb"  id="addcomments_kb">
                  <option value="FALSE"<?php if (!(strcmp("FALSE", $addcomments_kb ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
		          <option value="TRUE"<?php     if (!(strcmp("TRUE", $addcomments_kb ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>                  
                    </select>                
		        <label for="add_websites">Enable comments (email and  site)</label>
                <select name="add_websites"  id="add_websites">
                  <option value="TRUE"<?php     if (!(strcmp("TRUE", $add_websites ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
                  <option value="FALSE"<?php if (!(strcmp("FALSE", $add_websites ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
		          <option value="USERS"<?php if (!(strcmp("USERS", $add_websites ) ) ) {echo "SELECTED"; } ?> ><?php echo 'Only Registered'; ?></option>
                </select>
		  </p>
			  <p>&nbsp;              </p>
			  <p><br>
	                  </p>
			  <p>&nbsp;</p>
	    </fieldset>
			 <fieldset>
			 <span class="content"><legend><a name="email"></a>E-mail options</legend>
			 </span>
            <label for="sendmethod">Send method(PHP mailer)</label>
		    <select name="sendmethod"  id="sendmethod">
              <option value="mail"<?php if (!(strcmp("mail", $sendmethod ) ) ) {echo "SELECTED"; } ?> ><?php echo 'mail'; ?></option>
			  <option value="sendmail"<?php if (!(strcmp("sendmail", $sendmethod ) ) ) {echo "SELECTED"; } ?> ><?php echo 'Sendmail'; ?></option>
              <option value="smtp"<?php if (!(strcmp("smtp", $sendmethod ) ) ) {echo "SELECTED"; } ?> ><?php echo 'smtp'; ?></option>
              <option value="qmail"<?php if (!(strcmp("qmail",$sendmethod ) ) ) {echo "SELECTED"; } ?> ><?php echo 'qmail'; ?></option>
            </select>
			<br>
			<label for="smtpauth">SMTP Authentication</label>			
			<select name="smtpauth"  id="smtpauth">
              <option value="TRUE"<?php if (!(strcmp("TRUE", $smtpauth ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
              <option value="FALSE"<?php if (!(strcmp("FALSE", $smtpauth ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
            </select>
            <label for="activa_by_email">Enable email verification</label>
            <select name="activa_by_email"  id="activa_by_email">
              <option value="TRUE"<?php if (!(strcmp("TRUE", $activa_by_email ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
              <option value="FALSE"<?php if (!(strcmp("FALSE",$activa_by_email ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
            </select>
            <span class="comment3" >To activate an end user account for self registration.
			</span>
            <p>
		    <br>
		    </p>		    
		    <label for="socketfrom">Outgoing Email(reply to)</label>  
		    <input name="socketfrom" type="text" class="text" id="socketfrom" value="<?php echo $socketfrom; ?>" size="40">
			<label for="socketfromname">From name</label>
			<input name="socketfromname" type="text" class="text" id="socketfromname" value="<?php echo $socketfromname; ?>" size="40">
			<label for="smtpauthuser">smtp account</label>
			<p>
			<input name="smtpauthuser" type="text" class="text" id="smtpauthuser" value="<?php echo $smtpauthuser; ?>" size="40">
			</p>
			<label for="smtpauthpass">smtp password</label>
			<input name="smtpauthpass" type="password" class="text" id="smtpauthpass" value="<?php echo $smtpauthpass; ?>" size="40">			
			<BR><BR><BR>
			<label for="emailfortest">Enter an email for testing delivery</label>
			<p><input type="submit" name="Submit"  value="test now" >
			</p>
			<input name="emailfortest" type="text" class="text" id="emailfortest" size="30">
			<label for="emailclose"></label>
			<p>&nbsp;</p>
			</fieldset>
			<fieldset>
            <span class="content"><legend><a name="notifications"></a>Notifications by E-mail</legend></span>
            <label for="emailclose">The user receives an email if staff  closes a ticket</label>
            <select name="emailclose"  id="emailclose">
            <option value="TRUE"<?php  if (!(strcmp("TRUE", $emailclose ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
            <option value="FALSE"<?php if (!(strcmp("FALSE", $emailclose ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>            
		    </select>
			<p>
			  <label for="emailuser1"></label>
			</p>
			<BR>
			  <label for="emailuser1">Email the user if there is a new response</label>	       
			  <p>
			    <select name="emailuser1"  id="emailuser1">
                  <option value="TRUE"<?php  if (!(strcmp("TRUE",$emailuser1 ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
                  <option value="FALSE"<?php if (!(strcmp("FALSE",$emailuser1 ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
                </select>
			</p>
			  <p>&nbsp;</p>
			  <p>&nbsp;</p>
			  <p>
			    <label for="emailusercopy">Send a copy of his ticket to the user</label>
			    <select name="emailusercopy"  id="$emailusercopy">
                  <option value="TRUE"<?php  if (!(strcmp("TRUE",$emailusercopy ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
                  <option value="FALSE"<?php if (!(strcmp("FALSE",$emailusercopy ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
                </select>
			</p>
			  <p>&nbsp;</p>
			<label for="emailasigned">Email staff user(individual)  if a new ticket was assigned</label>
			<p>
			  <select name="emailasigned"  id="emailasigned">
                <option value="TRUE"<?php  if (!(strcmp("TRUE",$emailasigned ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
                <option value="FALSE"<?php if (!(strcmp("FALSE",$emailasigned ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
              </select>
			</p>
			<p>		      
			  <label for="emailstaff">Email Departament  if there is a new ticket</label>
	        </p>
			<select name="emailstaff"  id="emailstaff">
            <option value="TRUE"<?php  if (!(strcmp("TRUE",$emailstaff ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
            <option value="FALSE"<?php if (!(strcmp("FALSE",$emailstaff ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
            </select>
			<BR>
			<p>
			  <label for="sendhtml">Send notifications as html</label>
              <select name="sendhtml"  id="sendhtml">
                <option value="TRUE"<?php  if (!(strcmp("TRUE",$sendhtml ) ) ) {echo "SELECTED"; } ?> ><?php echo 'TRUE'; ?></option>
                <option value="FALSE"<?php if (!(strcmp("FALSE",$sendhtml ) ) ) {echo "SELECTED"; } ?> ><?php echo 'FALSE'; ?></option>
              </select>
			</p>
			<p>&nbsp;			  </p>
			<p>
		  <label for="retries">N of Retries for notifications</label>
			  <select name="retries"  id="retries">
			  <option value="0"<?php if (!(strcmp("0",$retries ) ) ) {echo "SELECTED"; } ?> ><?php echo '0'; ?></option>
  			  <option value="1"<?php if (!(strcmp("1",$retries ) ) ) {echo "SELECTED"; } ?> ><?php echo '1'; ?></option>
  			  <option value="2"<?php if (!(strcmp("2",$retries ) ) ) {echo "SELECTED"; } ?> ><?php echo '2'; ?></option>
  			  <option value="3"<?php if (!(strcmp("3",$retries ) ) ) {echo "SELECTED"; } ?> ><?php echo '3'; ?></option>			  
               </select>
			   </p>
			<label for="footer">Footer*</label>			  
			    <textarea name="footer" cols="60" rows="4" class="text" id="footer"><?php echo $footer; ?></textarea>		      
			  <p align="center"><span class="comment2">*If you want you can add a footer to all outgoing notifications by emails.</span></p>
			 <div align="center">
			 <input name="save5" type="hidden" id="save5" value="1">
			 <br>
			 <input type="submit" name="Submit" value="Save all">			 
	         </div>
        </fieldset>	
      </td>
    </tr>
  </table>
</form>
<SCRIPT LANGUAGE="JavaScript">cp.writeDiv()</SCRIPT>
