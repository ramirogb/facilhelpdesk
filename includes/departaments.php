<?php 
if ($authz<>'TRUE') exit;
?>
<style type="text/css">
<!--
.Estilo2 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
<p><a href="<?php  echo $_SERVER['PHP_SELF'] ?>?action=edit_pop3">Edit Departments/ POP3 </a> <img src="./images/email_settings.gif" width="32" height="32">
</p>
<p><strong>Departments by level:</strong></p>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="82"><p class="urglev">Level 4: </p>
        <?php 
				$query = '	SELECT *
					FROM tickets_categories where level=4
					ORDER BY tickets_categories_id ASC';
			$result =  $db->Execute($query);

	?></td>
    <td width="1147"><?php
			WHILE (!$result->EOF)
				{
				$row = $result->fields;			
				$result->MoveNext();
?>
        <table align="left" cellpadding="0" cellspacing="0" class="boxborder">
          <form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=edit_dep" Method="post">
            <tr  style="padding:2px" bgcolor="<?php echo UseColor() ?>">
              <td bgcolor="#CCFFFF" class="comment4"><?php echo $row['tickets_categories_id']; ?></td>
              <td width="100" bgcolor="#CCFFFF" class="boxborder"><span class="comment4"><?php echo $row['tickets_categories_name']; ?></span> </td>
              <td class="boxborder">&nbsp;</td>
            </tr>
          </form>
          <?php
				}
?>
      </table></td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="82"><p class="urglev">Level 3:
      </p>
      <?php 
				$query = '	SELECT *
					FROM tickets_categories where level=3
					ORDER BY tickets_categories_id ASC';
			$result =  $db->Execute($query);

	?></td>
    <td width="1168"><?php
			WHILE (!$result->EOF)
				{
				$row = $result->fields;			
				$result->MoveNext();
?><table align="left" cellpadding="0" cellspacing="0" class="boxborder">      
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=edit_dep" Method="post">
        <tr  style="padding:2px" bgcolor="<?php echo UseColor() ?>">
          <td bgcolor="#CCFFFF" class="comment4"><?php echo $row['tickets_categories_id']; ?></td>
          <td width="100" bgcolor="#CCFFFF" class="boxborder"><span class="comment4"><?php echo $row['tickets_categories_name']; ?></span>            </td>
          <td class="boxborder">&nbsp;</td>
        </tr>
      </form>
      <?php
				}
?>
    </table></td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="82"><p class="urglev">Level 2<span class="Estilo2">:</span> </p>
    <?php 
				$query = '	SELECT *
					FROM tickets_categories where level=2
					ORDER BY tickets_categories_id ASC';
			$result =  $db->Execute($query);

	?></td>
    <td width="1168"><?php
			WHILE (!$result->EOF)
				{
				$row = $result->fields;			
				$result->MoveNext();
?>
        <table align="left" cellpadding="0" cellspacing="0" class="boxborder">
          <form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=edit_dep" Method="post">
            <tr  style="padding:2px" bgcolor="<?php echo UseColor() ?>">
              <td bgcolor="#CCFFFF" class="comment4"><?php echo $row['tickets_categories_id']; ?></td>
              <td width="100" bgcolor="#CCFFFF" class="boxborder"><span class="comment4"><?php echo $row['tickets_categories_name']; ?></span> </td>
              <td class="boxborder">&nbsp;</td>
            </tr>
          </form>
          <?php
				}
?>
      </table></td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="82"><p class="urglev">Level 1<span class="Estilo2">:</span> </p>
    <?php 
				$query = '	SELECT *
					FROM tickets_categories where level=1
					ORDER BY tickets_categories_id ASC';
			$result =  $db->Execute($query);

	?></td>
    <td width="1169"><?php
			WHILE (!$result->EOF)
				{
				$row = $result->fields;			
				$result->MoveNext();
?>
        <table align="left" cellpadding="0" cellspacing="0" class="boxborder">
          <form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=edit_dep" Method="post">
            <tr  style="padding:2px" bgcolor="<?php echo UseColor() ?>">
              <td bgcolor="#CCFFFF" class="comment4"><?php echo $row['tickets_categories_id']; ?></td>
              <td width="100" bgcolor="#CCFFFF" class="boxborder"><span class="comment4"><?php echo $row['tickets_categories_name']; ?></span> </td>
              <td class="boxborder">&nbsp;</td>
            </tr>
          </form>
          <?php
				}
?>
      </table></td>
  </tr>
</table>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=ad_dep" method="post">
  <table border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class="boxborder">
    <tr>
<td class="text"><strong>Create new Department: </strong><br />        
                        <table width="700" cellpadding="0" cellspacing="0" align="center">
                          <tr>
                            <td colspan="5" class="text">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="text">Department Name:</td>
                            <td><input name="name" type="text" id="name"></td>
                            <td>Email:
                            <input name="mail" type="text" id="mail"> </td>
                            <td><?php if (isset($upgraded)) { ?>Level:
                              <select name="level"  id="$emailusercopy">
                                <option value="1">1(Basic)</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <?php  } ?> </td>
                            <td><input type="submit" value="Submit" name="userform" /></td>
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
                            <td class="text" colspan="5">&nbsp;</td>
                          </tr>
                          <?php
				}
?>
        </table>
                        <br />
      </td>
    </tr>
  </table>
</form>
<p><strong><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=asignements">Assignement <strong>Staff Members</strong></a></strong><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=asignements">-<strong><strong>Departments</strong></strong></a></p>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=ad_dep" method="post">
</form>
