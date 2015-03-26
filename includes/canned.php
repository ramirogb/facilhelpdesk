<?php 
if ($authz<>'TRUE') exit;
?><SCRIPT LANGUAGE="Javascript" SRC="includes/ColorPicker2.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
var cp = new ColorPicker('window'); // Popup window
var cp2 = new ColorPicker(); // DIV style
</SCRIPT>
<table width="<?php echo $maintablewidth ?>" cellspacing="0" cellpadding="0" class="boxborder" align="<?php echo $maintablealign ?>">
  <tr>
    <td class="boxborder text" colspan="5" bgcolor="#AACCEE">&nbsp;</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td class="boxborder text"><b>ID</b></td>
    <td class="boxborder text"><?php  echo $subx; ?>&nbsp;</td>
    <td class="boxborder text"><?php  echo $cannedreply; ?></td>
    <td class="boxborder text"><?php  echo $categorie_article; ?></td>
    <td class="boxborder text"><b>Action</b></td>
  </tr>
  <?php  
			 $query = '	SELECT *	FROM canned_replies,tickets_categories where tickets_categories.tickets_categories_id=canned_replies.dep		ORDER BY tickets_categories_id ASC';
			 $result = $db->Execute($query);
			 $counter=0;
			WHILE (!$result->EOF)
				{
				$counter +=1;
				$row=$result->fields;	
				@$result->MoveNext();
?>
  <form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=update_canned" Method="post">
    <tr bgcolor="<?php echo UseColor() ?>">
      <td class="boxborder text"><?php echo $row['id'] ?></td>
      <td class="boxborder"><input name="status" value="<?php echo $row['subjet'] ?>" size="15" /></td>
      <td class="boxborder"><textarea name="body" cols="90" rows="2" id="body"><?php echo $row['body'] ?></textarea></td>
      <td class="boxborder text"  style="padding:3px"><?php echo $row['tickets_categories_name'] ?></td>
      <td  style="padding:2px" class="boxborder"><input name="acc2" type="submit" id="acc2"  value="Delete" />
          <input type="hidden" name="depid" value="<?php echo $row['id'] ?>">
          <input name="acc2" type="submit" id="acc2" value="Update" />
      </td>
    </tr>
  </form>
  <?php				}
?>
</table>
<SCRIPT LANGUAGE="JavaScript">cp.writeDiv()</SCRIPT>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=update_canned" Method="post">
<table width="<?php echo $maintablewidth ?>" cellpadding="0" cellspacing="4">
  <tr>
    <td colspan="4" class="text"><span class="boxborder text">
      <?php  echo $newcannedreply; ?>
    </span></td>
  </tr>
  <tr>
    <td><span class="boxborder text">
      <?php  echo $subx; ?>
      </span>
        <input name="name" type="text" id="name" size="15"></td>
    <td><span class="boxborder text">
      <?php  echo $subx; ?>
      </span>:
      <textarea name="body" cols="90" rows="2" id="body"></textarea>
    </td>
    <td><select name="departament"  id="departament">
        <?php			
	 $query57 = "	SELECT * from tickets_categories ";	 
	$db->SetFetchMode(ADODB_FETCH_ASSOC);
	 $result57 = $db->Execute($query57);

			 do { 
			  $row3=$result57->fields; 
			  $result57->MoveNext();
			 ?>
        <option value="<?php  echo $row3['tickets_categories_id']; ?>" <?php
				 if ( !(strcmp($row3['tickets_categories_id'],$cat) ) )
			    {
				 echo "SELECTED";
				 $depa=$row3['tickets_categories_id'];
				 $super=$row3['supervisor'];
				 $depaX=$row3['tickets_categories_name'];
				}
				 ?>
				><?php echo $row3['tickets_categories_name'];  ?></option>
        <?php }
				 while ( !$result57->EOF ); ?>
    </select></td>
    <td><span class="text">
      <input type="submit" name="Submit" value="Submit">
    </span></td>
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
    <td class="text" colspan="4">&nbsp;</td>
  </tr>
  <?php
				}
?>
</table>  
<input name="insertlevel" type="hidden" id="insertlevel" value="1">
</form>
