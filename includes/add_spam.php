<?php 
if ($authz<>'TRUE') exit;
			$query = '	SELECT *
					FROM spam ORDER BY id ASC';
			$result = $db->Execute($query);
			$row = $result->fields;			

?>
  <form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=edit_spam" Method="post">
<table style="padding-left:0px" width="<?php echo $maintablewidth ?>" cellspacing="0" cellpadding="0" class="boxborder" align="<?php echo $maintablealign ?>">
  <tr bgcolor="#EEEEEE">
    <td height="34" colspan="4" bgcolor="#EEEEEE" class="boxborder text">&nbsp;</td>
    <td height="34" bgcolor="#EEEEEE" class="boxborder text"><strong>List of keywords considered as SPAM</strong></td>
    <td height="34" bgcolor="#EEEEEE" class="boxborder text"><table width="100%" border="1" cellpadding="0" cellspacing="2" bordercolor="#F5F5F0">
      <tr class="minititle">
        <td><div align="center">Tickets with SPAM</div></td>
      </tr>
      <tr>
        <td><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=home&order=5" class="content">Opened</a></td>
      </tr>
      <tr>
        <td><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=home&order=4" class="content">Closed</a></td>
      </tr>
    </table></td>
    <td height="34" bgcolor="#EEEEEE" class="boxborder text">&nbsp;</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td height="35" bgcolor="#EEEEEE" class="boxborder text"  style="padding-left:10px">&nbsp;</td>
    <td height="35" bgcolor="#CCFFFF" class="boxborder text"  style="padding-left:10px">&nbsp;</td>
    <td height="35" bgcolor="#CCFFFF" class="boxborder text"  style="padding-left:10px">&nbsp;</td>
    <td height="35" bgcolor="#CCFFFF" class="boxborder text"  style="padding-left:10px">&nbsp;</td>
    <td width="504" bgcolor="#CCFFFF" class="boxborder text"  style="padding-left:10px"><strong>Enable SPAM filter
        <input name="enable" type="checkbox" id="enable" value="1" <?php if ($row['filter']=='1') { echo  'checked'; } ?>>
(ticket's subjet will be labeled as SPAM ) </strong></td>
    <td width="252" bgcolor="#CCFFFF" class="boxborder text"  style="padding-left:10px"><strong>Delete SPAM older than 7 days*</strong>
      <input name="delete" type="checkbox" id="delete" value="1" <?php if ($row['deletespam']=='1') { echo  'checked'; } ?>></td>
    <td width="91" bgcolor="#EEEEEE" class="comment3">&nbsp;</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td width="24" bgcolor="#EEEEEE" class="boxborder text">&nbsp;</td>
    <td width="24" bgcolor="#CCFFFF" class="boxborder text">&nbsp;</td>
    <td colspan="4" bgcolor="#CCFFFF" class="boxborder text"><div align="center"><span class="comment3"><strong>Write keywords separed with , </strong></span></div></td>
    <td bgcolor="#EEEEEE" class="boxborder text"><div align="center"></div></td>
  </tr>
  <?php
				{
?>

    <tr  style="padding:2px" bgcolor="<?php echo UseColor() ?>">
      <td bgcolor="<?php echo UseColor() ?>" class="boxborder">&nbsp;</td>
      <td bgcolor="#CCFFFF" class="boxborder">&nbsp;</td>
      <td colspan="4" bgcolor="#CCFFFF" class="boxborder"><textarea name="spa" cols="100" rows="20" id="spa"><?php echo $row['spa'] ?></textarea></td>
      <td  valign="top" bgcolor="<?php echo UseColor() ?>" class="text"   style="padding:4px">          <input type="submit" name="sub" value="Update" />
      </td>
    </tr>
  <?php
				}
?>
<tr bgcolor="<?php echo UseColor() ?>">
      <td height="60" colspan="7" class="comment3"><p>&nbsp;</p>
        <p>*Requires Cron </p>
        </td>
  </tr>
</table>
  </form>
<div class="comment2"></div>
<p>&nbsp;</p>