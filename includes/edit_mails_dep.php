<?php 
if ($authz<>'TRUE') exit;
?>
<style type="text/css">
<!--
.Estilo1 {color: #FF0000}
-->
</style>


<table width="<?php echo $maintablewidth ?>" cellspacing="0" cellpadding="0" class="boxborder" align="<?php echo $maintablealign ?>">
  <tr bgcolor="#EEEEEE">
    <td height="34"   colspan="15" bgcolor="#EEEEEE" class="text"><strong> <?php echo $emails_deps;?></strong></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="35" bgcolor="#CCFFFF" class="boxborder text">&nbsp;</td>
    <td colspan="2" bgcolor="#CCFFFF" class="boxborder text">&nbsp;</td>
    <td width="4" class="boxborder text">&nbsp;</td>
    <td  colspan="4" bgcolor="#CCFFFF" class="boxborder text"><span class="comment3"><strong>E-Mail Piping  (2)</strong></span></td>
    <td bgcolor="#EEEEEE" class="boxborder text">&nbsp;</td>
    <td colspan="4" rowspan="3" bgcolor="#CEEFFF" class="comment3"><strong>Emails for internal notificacions </strong></td>
    <td bgcolor="#EEEEEE" class="boxborder text">&nbsp;</td>
    <td width="211" bgcolor="#CCFFFF" class="comment3">&nbsp;</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="35" rowspan="2" bgcolor="#CCFFFF" class="boxborder text">&nbsp;</td>
    <td colspan="2" rowspan="2" bgcolor="#CCFFFF" class="boxborder text">&nbsp;</td>
    <td rowspan="2" class="boxborder text"><div align="center"><span class="comment3"></span></div></td>
    <td  colspan="4" bgcolor="#CCFFFF" class="boxborder text"><div align="center"><span class="comment3"></span></div></td>
    <td rowspan="2" bgcolor="#EEEEEE" class="boxborder text">&nbsp;</td>
    <td rowspan="2" bgcolor="#EEEEEE" class="boxborder text">&nbsp;</td>
    <td rowspan="2" bgcolor="#CCFFFF" class="comment3"><div align="center"><b>Actions</b></div></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td  colspan="4" bgcolor="#CCFFFF" class="boxborder text"><span class="comment3"><a href="<?php  echo $_SERVER['PHP_SELF'] ?>?action=spam">SPAM Filter</a></span></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td width="22" bgcolor="#CCFFFF" class="boxborder text"><b>ID.</b></td>
    <td width="61" bgcolor="#CCFFFF" class="boxborder text"><div align="center"><b>Department</b></div></td>
    <td width="61" bgcolor="#CCFFFF" class="boxborder text">Level</td>
    <td class="boxborder text">&nbsp;</td>
    <td width="44" bgcolor="#CCFFFF" class="boxborder text"><span class="text boxborder"><strong>enable</strong></span></td>
    <td width="130" bgcolor="#CCFFFF" class="boxborder text"><div align="center"><strong>Incoming e-mail</strong></div></td>
    <td colspan="2" bgcolor="#CCFFFF" class="text boxborder"><span class="boxborder text"><strong>SMTP Password</strong></span></td>
    <td width="15" bgcolor="#EEEEEE" class="boxborder text"><span class="text boxborder"></span></td>
    <td width="163" bgcolor="#CEEFFF" class="boxborder text"><div align="center" class="text boxborder">Ticket=&gt; General e-mail (1)</div></td>
    <td width="130" bgcolor="#CEEFFF" class="boxborder text">N&deg; for incoming SMS notif. (4) </td>
    <td width="4" bgcolor="#CEEFFF" class="boxborder text">&nbsp;</td>
    <td width="94" bgcolor="#CEEFFF" class="text boxborder"> Supervisor (3)</td>
    <td bgcolor="#EEEEEE" class="boxborder text">&nbsp;</td>
    <td bgcolor="#CCFFFF" class="boxborder text"><div align="center"></div></td>
  </tr>
  <?php
			$query = '	SELECT *
					FROM tickets_categories
					ORDER BY tickets_categories_id ASC';
			$result =  $db->Execute($query);
			WHILE (!$result->EOF)
				{
				$row = $result->fields;			
				$result->MoveNext();
?>
  <form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=edit_dep" Method="post">
    <tr  style="padding:2px" bgcolor="<?php echo UseColor() ?>">
      <td bgcolor="#CCFFFF" class="comment4"><?php echo $row['tickets_categories_id']; ?></td>
      <td bgcolor="#CCFFFF" class="boxborder"><input name="department" value="<?php echo $row['tickets_categories_name'] ?>" size="20" /></td>
      <td bgcolor="#CCFFFF" class="boxborder"><select name="level"  id="level">
        <option value="1"<?php  if (!(strcmp("1",$row['level'] ) ) ) {echo "SELECTED"; } ?> >1(Low)</option>
        <option value="2"<?php if (!(strcmp("2",$row['level'] ) ) ) {echo "SELECTED"; } ?> >2</option>
		<option value="3"<?php if (!(strcmp("3",$row['level'] ) ) ) {echo "SELECTED"; } ?> >3</option>
		<option value="4"<?php if (!(strcmp("4",$row['level'] ) ) ) {echo "SELECTED"; } ?> >4</option>
      </select></td>
      <td class="boxborder">&nbsp;</td>
      <td bgcolor="#CCFFFF" class="boxborder"><input name="epiping" type="checkbox" id="epiping" value="1" <?php if ($row['epiping']=='1') { echo  'checked'; } ?>></td>
      <td bgcolor="#CCFFFF" class="boxborder"><input name="emailpiping" id="emailpiping" value="<?php echo $row['emailpiping'] ?>" size="15" /></td>
      <td width="151" bgcolor="#CCFFFF" class="boxborder"><input name="password" type="password" id="password" value="<?php echo $row['password'] ?>" size="15" />      </td>
      <td width="138" bgcolor="#CCFFFF" class="boxborder"><span class="comment3">Max. Atach.
        <input name="maxfile" id="maxfile" value="<?php echo $row['maxfile'] ?>" size="10" />
Bytes </span></td>
      <td bgcolor="<?php echo UseColor() ?>" class="boxborder">&nbsp;</td>
      <td bgcolor="#CEEFFF" class="boxborder"  style="padding-left:2px">  <input name="email" id="email" value="<?php echo $row['email'] ?>" size="15" /></td>
      <td bgcolor="#CEEFFF" class="boxborder"  style="padding-left:2px"><input name="sms" id="sms" value="<?php echo $row['sms'] ?>" size="15" /></td>
      <td bgcolor="#CEEFFF" class="boxborder"  style="padding-left:2px">&nbsp;</td>
      <td bgcolor="#CEEFFF" class="boxborder"  style="padding-left:2px"> <?php
	     $depx=$row['tickets_categories_id'];
$my_members="select DISTINCT users.id,users.name,users.username from users_staff,tickets_categories,users WHERE users_staff.departament='$depx' and users.id=users_staff.userx";
$db->SetFetchMode(ADODB_FETCH_ASSOC);
$result_my_members= $db->Execute($my_members);	

     ?>
        <select name="staffX" id="staffX">
	 <option value="0">&nbsp;</option>
        <?php	
			 do { 	$row_my_members=$result_my_members->fields;
			 $result_my_members->MoveNext();
			 
			 ?>
			 
        <option value="<?php echo $row_my_members['id']; ?>"<?php   if (!(strcmp($row_my_members['id'],$row['supervisor']  ) ) ) {echo "SELECTED"; }?>> <?php echo $row_my_members['username']; ?></option>
        <?php } while (!$result_my_members->EOF); ?>
        
        </select></td>
      <td width="16" bgcolor="<?php echo UseColor() ?>" class="text">&nbsp;</td>
      <td  style="padding:4px" bgcolor="#CCFFFF" class="text"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=del_dep&id_dep=<?php echo $row['tickets_categories_id']; ?>">Delete</a>        <input name="id_depart" type="hidden" id="id_depart" value="<?php echo $row['tickets_categories_id']; ?>">
          <input type="submit" name="sub" value="Update" />
      </td>
    </tr>
  </form>
  <?php
				}
?>
<tr bgcolor="<?php echo UseColor() ?>">
      <td height="60" colspan="15" class="comment3"><p><span class="Estilo1">Be careful about deleting Departments. Deleting them will make inaccessible to tickets of that departament. If that is the case click <a href="<?php  echo $_SERVER['PHP_SELF'] ?>?action=maintenance">here </a></span></p>
        <p><strong>(1) E-mail for notifications:</strong> When a new ticket is created or a response( from end user) is available a notification<span class="Estilo1"> (Enable at Settings=&gt;Email=&gt; Email Department ) </span>will be sent to this email,the ticket is stored but this notification can be sent to an external email,  others  notifications   are sent to  emails of end users from <a href="./tickets2.php?action=settings#email">here</a>. <br>
          <strong> (2) E-Mail Piping</strong>: First you have to create a cron job for   script &quot;<strong>for_cron.php</strong>&quot;, this script will read  POP3  accounts and will create tickets.You can rename for_cron.php  for security. <BR>
          <strong>(3) </strong>When an staff member assigns/transfers a ticket to other member an email notification is sent to supervisor of  new department. <strong><BR>
          </strong>
		  <strong>(4) </strong>When you are away of your computer you can get a short notification(SMS at your phone) of new ticket (only for tickets submited from web interface not by &quot;email piping&quot;), read more and <a href="http://www.cromosoft.com/en/sms-notifications.html" target="_blank">get  an account. </a><strong><BR>
		  </strong>
	    </p>
		  
        <p><span class="Estilo1">Avoid of using the same email for <strong>Incoming e-mail</strong> and <strong>E-mail for notifications</strong> to avoid loops.</span></p>
        <p>&nbsp;</p>
    </td>
  </tr>

</table>
<div class="comment2"></div>
<p>&nbsp;</p>