<?php
if ($authz<>'TRUE') exit;
?>
<SCRIPT LANGUAGE="Javascript" SRC="includes/ColorPicker2.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
var cp = new ColorPicker('window'); // Popup window
var cp2 = new ColorPicker(); // DIV style
</SCRIPT>
<?php 
//include('configuration.php');
?>
<link href="styles.php" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo6 {color: #FFFFFF}
-->
</style>

<table width="800" height="68" border="0" align="center" cellpadding="2" cellspacing="0" bordercolor="#66CCCC" class="report">
  <tr>
    <td height="66" colspan="3" bgcolor="#0033CC"><span style="font-family: Arial, Helvetica, sans-serif; color: #FFFFFF"><a href="http://www.cromosoft.com"><img src="images/logo-facil-helpdesk.png" alt="Facil HelpDesk" width="100" height="30" border="0" align="absmiddle"></a></span><span class="Estilo6">Version 3.2 (2013) running at: <?php echo $_SERVER['SERVER_NAME'];?><?php echo " DBMS: $dbms" ?></span></td>
    <td width="382" colspan="2" bgcolor="#0033CC" class="Estilo6"><p>
            <?php 
			$sql="select version()";
		     $res = @$db->Execute($sql);
			 $r=$res->fields;
			 echo "$r[0]";
			 
			?>
      </p>
        <p>
		<span class="content">
              <?php

 if ($dbms=='mysql')
 {			   
$sql="SHOW TABLE STATUS"; 
$sale=$db->Execute($sql);
$dbssize = 0; 
while ( !$sale->EOF)
 {
 $row = $sale->fields; 
 $sale->MoveNext();
$dbssize += $row['Data_length'] + $row['Index_length']; 
 	if ( $row['Name']=='tickets_atach')
	{
	$adjuntos=$row['Data_length'];
	}
 
} 

print  'DB size Mysql: '.ceil(($dbssize/1024) ).'K bytes reported by Table Status'; 
}//end if mysql

			?></span></p></td>
  </tr>
</table>
<table width="800" height="269" border="0" align="center" cellpadding="0" cellspacing="3" class="report">
  <tr>
    <td width="41" rowspan="2"><strong>Basic Settings</strong></td>
    <td width="72"><a href="tickets2.php?action=settings" class="text">Basic</a> <img src="./images/setup.gif" width="32" height="32" border="0"></td>
    <td width="120"><a href="tickets2.php?action=settings#database" class="text">Database</a> <img src="./images/database.jpg" width="32" height="32"></td>
    <td width="1"><a href="tickets2.php?action=settings#access" class="text">Access</a><img src="./images/access.jpg" width="31" height="32" border="0"></td>
    <td width="199"><a href="tickets2.php?action=settings#colors" class="text">Colors<img src="./images/colors.jpg" width="30" height="32" hspace="2" vspace="2" border="0"></a></td>
  </tr>
  <tr>
    <td><a href="tickets2.php?action=settings#localization" class="text">Localization<img src="./images/en.gif" width="16" height="10" border="0"><img src="./images/es.gif" width="16" height="10" hspace="2" border="0"></a></td>
    <td><a href="tickets2.php?action=settings#email" class="text">Email Setting</a><img src="./images/email_settings.gif" width="32" height="32" border="0"></td>
    <td><a href="tickets2.php?action=settings#notifications" class="text">Email Notifications <img src="./images/notification.gif" width="32" height="32" border="0"></a></td>
    <td><a href="tickets2.php?action=settings#sms" class="text">SMS Notifications <img src="./images/sms.jpg" width="32" height="32" border="0"></a></td>
  </tr>
  <tr>
    <td><strong>Tickets</strong></td>
    <td><a href="tickets2.php?action=canned" class="text">Canned responses <img src="./images/comments.gif" width="15" height="12" border="0"></a></td>
    <td><a href="tickets2.php?action=settings#polls">Polls</a><img src="./images/polls.jpeg" width="32" height="33"></td>
    <td><a href="tickets2.php?action=departaments" class="text"><?php echo $departaments; ?></a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="55"><strong>Maintenance</strong></td>
    <td><a href="tickets2.php?action=maintenance">Tickets reparation</a> <img src="./images/repair.jpg" width="32" height="32"><br></td>
    <td><a href="tickets2.php?action=maintenance#notifications">Update</a><img src="./images/getupdate.png" width="35" height="32"></td>
    <td><a href="http://www.cromosoft.com/helpdesk/tickets.php?action=create_form">Request Feature<img src="./images/request.gif" width="34" height="32" border="0"></a> </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="55"><strong>SLA</strong></td>
    <td><a href="tickets2.php?action=settings#sla">SLA settings</a></td>
    <td>&nbsp;</td>
    <td class="comment4">Rec. Firefox 3.x </td>
    <td class="comment3">&nbsp;</td>
  </tr>
</table>

<td>&nbsp;</td>
    <td>&nbsp;</td>
<td>
<div align="center"></div></td>
<p><SCRIPT LANGUAGE="JavaScript">cp.writeDiv()</SCRIPT>
</p>
