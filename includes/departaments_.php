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
    <td height="34"   colspan="12" bgcolor="#EEEEEE" class="text"><strong>Emails of Departments </strong></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="35" bgcolor="#CCFFFF" class="boxborder text">&nbsp;</td>
    <td bgcolor="#CCFFFF" class="boxborder text">&nbsp;</td>
    <td width="4" class="boxborder text">&nbsp;</td>
    <td  colspan="4" bgcolor="#CCFFFF" class="boxborder text"><span class="comment3"><strong>E-Mail Piping requires a new job executed by cron**</strong></span></td>
    <td bgcolor="#EEEEEE" class="boxborder text">&nbsp;</td>
    <td width="165" colspan="2" bgcolor="#CEEFFF" class="comment3">&nbsp;</td>
    <td bgcolor="#EEEEEE" class="boxborder text">&nbsp;</td>
    <td width="158" bgcolor="#CCFFFF" class="comment3">&nbsp;</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="35" rowspan="2" bgcolor="#CCFFFF" class="boxborder text">&nbsp;</td>
    <td rowspan="2" bgcolor="#CCFFFF" class="boxborder text">&nbsp;</td>
    <td rowspan="2" class="boxborder text"><div align="center"><span class="comment3"></span></div></td>
    <td  colspan="4" bgcolor="#CCFFFF" class="boxborder text"><div align="center"><span class="comment3"></span></div></td>
    <td rowspan="2" bgcolor="#EEEEEE" class="boxborder text">&nbsp;</td>
    <td colspan="2" rowspan="2" bgcolor="#CEEFFF" class="comment3"><div align="center"><strong>Emails for internal notificacions </strong></div></td>
    <td rowspan="2" bgcolor="#EEEEEE" class="boxborder text">&nbsp;</td>
    <td rowspan="2" bgcolor="#CCFFFF" class="comment3"><div align="center"><b>Actions</b></div></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td  colspan="4" bgcolor="#CCFFFF" class="boxborder text"><span class="comment3"><a href="<?php  echo $_SERVER['PHP_SELF'] ?>?action=spam">SPAM Filter</a></span></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td width="21" bgcolor="#CCFFFF" class="boxborder text"><b>ID.</b></td>
    <td width="122" bgcolor="#CCFFFF" class="boxborder text"><div align="center"><b>Department</b></div></td>
    <td class="boxborder text">&nbsp;</td>
    <td width="40" bgcolor="#CCFFFF" class="boxborder text"><span class="text boxborder"><strong>enable</strong></span></td>
    <td width="150" bgcolor="#CCFFFF" class="boxborder text"><div align="center"><strong>Incoming e-mail</strong></div></td>
    <td colspan="2" bgcolor="#CCFFFF" class="text boxborder"><span class="boxborder text"><strong>SMTP Password</strong></span></td>
    <td width="5" bgcolor="#EEEEEE" class="boxborder text"><span class="text boxborder"></span></td>
    <td bgcolor="#CEEFFF" class="boxborder text"><div align="center"><span class="text boxborder"><strong>Ticket=&gt; General e-mail* </strong></span></div></td>
    <td bgcolor="#CEEFFF" class="text boxborder">Notificate of assignations to Supervisor***</td>
    <td bgcolor="#EEEEEE" class="boxborder text">&nbsp;</td>
    <td bgcolor="#CCFFFF" class="boxborder text"><div align="center"></div></td>
  </tr>
  <?php
			$query = '	SELECT *
					FROM tickets_categories
					ORDER BY tickets_categories_id ASC';
			$result = mysql_query($query);
			WHILE ($row = mysql_fetch_array($result))
				{
?>
  <form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=edit_dep" Method="post">
    <tr  style="padding:2px" bgcolor="<?php echo UseColor() ?>">
      <td bgcolor="#CCFFFF" class="comment4"><?php echo $row['tickets_categories_id']; ?></td>
      <td bgcolor="#CCFFFF" class="boxborder"><input name="department" value="<?php echo $row['tickets_categories_name'] ?>" size="20" /></td>
      <td class="boxborder">&nbsp;</td>
      <td bgcolor="#CCFFFF" class="boxborder"><input name="epiping" type="checkbox" id="epiping" value="1" <?php if ($row['epiping']=='1') { echo  'checked'; } ?>></td>
      <td bgcolor="#CCFFFF" class="boxborder"><input name="emailpiping" id="emailpiping" value="<?php echo $row['emailpiping'] ?>" size="25" /></td>
      <td width="131" bgcolor="#CCFFFF" class="boxborder"><input name="password" type="password" id="password" value="<?php echo $row['password'] ?>" size="20" />      </td>
      <td width="172" bgcolor="#CCFFFF" class="boxborder"><span class="comment3">Max. Atach.
        <input name="maxfile" id="maxfile" value="<?php echo $row['maxfile'] ?>" size="10" />
Bytes </span></td>
      <td bgcolor="<?php echo UseColor() ?>" class="boxborder">&nbsp;</td>
      <td bgcolor="#CEEFFF" class="boxborder"  style="padding-left:2px">  <input name="email" id="email" value="<?php echo $row['email'] ?>" size="20" /></td>
      <td bgcolor="#CEEFFF" class="boxborder"  style="padding-left:2px"><input name="supervisor" id="supervisor" value="<?php echo $row['supervisor'] ?>" size="20" /></td>
      <td width="4" bgcolor="<?php echo UseColor() ?>" class="text">&nbsp;</td>
      <td  style="padding:4px" bgcolor="#CCFFFF" class="text"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=del_dep&id_dep=<?php echo $row['tickets_categories_id']; ?>">Delete</a>        <input name="id_depart" type="hidden" id="id_depart" value="<?php echo $row['tickets_categories_id']; ?>">
          <input type="submit" name="sub" value="Update" />
      </td>
    </tr>
  </form>
  <?php
				}
?>
<tr bgcolor="<?php echo UseColor() ?>">
      <td height="60" colspan="12" class="comment3"><p>&nbsp;</p>
        <p><strong>* E-mail for notifications:</strong> When a new ticket is created or a response, from end user, is available a notification will be sent to this email, but others  notifications   are sent to  emails of users from <a href="./tickets2.php?action=settings#email">here</a>. <br>
          <strong> ** E-Mail Piping</strong>:The  script &quot;<strong>for_cron.php</strong>&quot; will read  POP3  accounts and will create tickets.You can rename this file for security. <BR>
          <strong>*** When an staff member assign/transfer a ticket to other member a notification is sent to supervisor of dep. </strong></p>
        <p><span class="Estilo1">Avoid of using the same email for <strong>Incoming e-mail</strong> and <strong>E-mail for notifications</strong> to avoid loops.</span></p>
        <p><span class="Estilo1">Be careful about deleting Departments. Deleting them will make inaccessible to tickets of that departament. If that is the case click <a href="<?php  echo $_SERVER['PHP_SELF'] ?>?action=maintenance">here </a></span></p>
        <p>&nbsp;</p></td>
  </tr>

</table>
<div class="comment2"></div>
<table width="<?php echo $maintablewidth ?>" border="1" align="<?php echo $maintablealign ?>" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" class="boxborder">
  <tr>
    <td height="27" colspan="4" bgcolor="#AACCEE" class="boxborder text"><strong>  Assignement of Staff Members/Administrators<strong> and Departaments</strong></strong></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td class="text boxborder"><strong>Username </strong></td>
    <td width="100" class="boxborder text"><strong>Last action </strong></td>
    <td class="boxborder text">
	<?php
	$querystaff = '	SELECT *	FROM tickets_categories ORDER BY tickets_categories_id';
	$resultstaff = mysql_query($querystaff);
	$depa = mysql_fetch_assoc($resultstaff);
    ?>
      <table   border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
        <tr>
          <?php  	do { ?>
          <td  class="minititle" width="100" >&nbsp;<?php echo $depa['tickets_categories_name']; ?>
		  </td>
          <?php } WHILE ($depa = mysql_fetch_array($resultstaff) ); ?>
        </tr>
      </table>
    </td>
    <td width="55" class="boxborder text">&nbsp;</td>    
  </tr>
  <?php
	// LOOP THROUGH ALL USERS IN THE DATABASE WHO ARE MOD in others words, staff members

			$query = "	SELECT  id, name, username,
						password, email, admin,
						status,lastlogin
					FROM users WHERE (admin='Admin')  or  (admin='Mod')	ORDER BY name";
			$result = mysql_query($query);
			$j = '1';

			WHILE ($row = mysql_fetch_array($result))
				{
				IF ($row['status'] == '1')
					{
					$status = 'Active';
					}
				ELSE
					{
					$status = 'Suspended';
					}
?>
  <form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=users_dep_edit" Method="post">
    <tr bgcolor="<?php echo UseColor() ?>">
      <td class="boxborder text"><?php echo $j; ?>

	  <?php echo '&nbsp;<strong>'.$row['username'].'</strong>';
	   $the_user=$row['id']; ?>
      <input name="username" type="hidden" id="username" value="<?php echo $row['username']; $the_user=$row['id']; ?>">
	  </td>
      <td class="boxborder text"><?php 
	  $ggg=$row['lastlogin'];
	  $hhh=mktime();	  
	  if ($hhh-$ggg > 86400) echo date($dformat, $ggg);
	  if ($hhh-$ggg < 86400) 
	  if ($hhh-$ggg > 3600)
	  { 
	  echo ceil(    ( ($hhh-$ggg)/3600) ).'hours ago';
	  }
	  
  	  if ($hhh-$ggg < 3600) echo ceil(    ( ($hhh-$ggg)/60) ).'min ago';;
	  ?></td>
      <td class="boxborder text">
	  <?php //inicio de listas todos los departaments
  	$querydepas = "	SELECT * FROM tickets_categories ORDER BY tickets_categories_id";
	$resultsdepas = mysql_query($querydepas);
	$total_departaments= mysql_num_rows($resultsdepas);
	$depa6 = mysql_fetch_array($resultsdepas);
	$zif=0;
?>
	  <table    border="1" cellpadding="0" cellspacing="0" bordercolor="#E8E8E8">
          <tr>
		  <?php
		  do {
          $deparw=$depa6[0];
          $querystaff = "	SELECT *	FROM users_staff WHERE
          users_staff.user='$the_user' and users_staff.departament='$deparw' ";
		  $result22 = mysql_query($querystaff);
		  $depa = mysql_fetch_array($result22);
		  $is_set = mysql_num_rows($result22);
		   ?>
            <?php
			 	
			  	do {			
			?>
            <td  width="100" >
			<input name="<?php 
			if (   $zif< $total_departaments )
			{
			$zif +=1;
			}
			else 
			$zif=1;
			echo $zif; 
			?>" type="checkbox" id="<?php echo $zif; ?>" value="<?php  $value=$deparw; echo $value; ?>"<?php if ($is_set>0) { echo 'checked';} ?>></td>
            <?php
			 } WHILE ($depa = mysql_fetch_array($result22)); ?>        
		<?php //fin de chequear todos los departamentos para pasar a los usuarios
		}
		WHILE ($depa6 = mysql_fetch_array($resultsdepas));?>
		  </tr>		  
        </table>
		
      <input name="number_deps" type="hidden" id="number_deps" value="<?php echo $total_departaments; ?>"></td>
      <td width="55" class="boxborder">
        <input type="hidden" name="memberid" value="<?php echo $row['id'] ?>">
        <input type="submit" name="sub" value="Update" />
      </td>
    </tr>
  </form>
  <?php
				$j++;
				}
?>
</table>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=ad_dep" method="post">
  <table width="392" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class="boxborder">
    <tr>
      <td class="text"><strong>Create new Departament: </strong><br />        <br />
				        <br />
                        <table width="235" cellpadding="0" cellspacing="0" align="center">
                          <tr>
                            <td colspan="2" class="text">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="text">Department Name:</td>
                            <td><input name="name" type="text" id="name"></td>
                          </tr>
                          <tr>
                            <td class="text">Email: </td>
                            <td>                            <input name="mail" type="text" id="mail">
                            <input type="submit" value="Submit" name="userform" /></td>
                          </tr>
                          <?php

			IF (!isset($error))
				{
				$query = "	INSERT INTO tickets_categories
						SET
						tickets_categories_name = '".$_POST['name']."'";
				        //$result = mysql_query($query);
                        ?>
                          <tr>
                            <td class="text" colspan="2">&nbsp;</td>
                          </tr>
                          <?php
				}
?>
                        </table>
                        <br />
      </td>
    </tr>
  </table>
</form><p>&nbsp;</p>