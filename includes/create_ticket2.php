<?php
include_once('config.php');
include_once('includes/functions.php');
	IF (!isset($_REQUEST['lang']))
		{
		$_REQUEST['lang'] = $langdefault;
		}
	IF (!isset($_GET['action']))
		{
		$_GET['action'] = 'Login';
		}
	include('language/'.$_REQUEST['lang'].'.php');


$the_user=$_POST['username'];
if ($the_user==''){ $the_user=$_GET['username'];}

$query = "	SELECT * FROM users	WHERE username = '".$the_user."'";

			$result	      = $db->Execute($query);
			$totaltickets = $result->RecordCount();
			$row	      = $result->fields;

include_once('includes/top2.php');
?>
<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
  <table  class="encuadro" width="<?php echo $maintablewidth ?>" cellspacing="1" cellpadding="1"  align="<?php echo $maintablealign ?>">
    <tr>
      <td class="boxborder" width="50%" valign="top" style="padding-top:5px"><table  width="97%" cellspacing="1" cellpadding="1" class="boxborder" align="center">
          <tr>
            <td   class="boxborder text" colspan="2"><b><strong><?php echo $new_ticket1; ?></strong></b></td>
          </tr>
          <tr>
            <td bgcolor="#EEEEEE" class="boxborder text"><b>Account:</b></td>
            <td class="boxborder text"><?php echo $_SESSION['xcv_userna'] ?></td>
          </tr>
          <tr>
            <td bgcolor="#EEEEEE" class="boxborder text"><b>Name of user:</b></td>
            <td class="boxborder text"><input name="name" size="40" value="<?php echo $row['name'] ?>" /></td>
          </tr>
          <tr>
            <td bgcolor="#EEEEEE" class="boxborder text"><b>Email:</b></td>
            <td class="boxborder text"><input name="email" size="40" value="<?php echo $row['email'] ?>" />
            <input name="admin" type="hidden" id="admin" value="<?php echo $row['username'] ?>"></td>
          </tr>
          <tr>
            <td bgcolor="#EEEEEE" class="boxborder text"><b><span class="text"><?php echo $subx; ?></span>:</b></td>
            <td class="boxborder text"><input name="ticketsubject" size="40"

<?php
			IF (isset($_POST['ticketsubject']) && $_POST['ticketsubject'] != '')
				{
				echo ' value="'.$_POST['ticketsubject'].'"';
				}
?>

					></td>
          </tr>
          <tr>
            <td bgcolor="#EEEEEE" ><span class="text"><?php echo $departament; ?></span><strong>:</strong></td>
            <td class="boxborder text"><select name="category">
                <?php

			$query = "	SELECT tickets_categories_id, tickets_categories_name

					FROM tickets_categories

					ORDER BY tickets_categories_name ASC";
$db->SetFetchMode(ADODB_FETCH_ASSOC);
			$result = $db->Execute($query);

			WHILE (!$result->EOF)
				{
				$row =$result->fields;
				$result->MoveNext();

				echo '<option value="'.$row['tickets_categories_id'].'|'.$row['tickets_categories_name'].'">'.$row['tickets_categories_name'].'</option>';

				}

?>
              </select>
            </td>
          </tr>
          <tr>
            <td bgcolor="#EEEEEE" class="boxborder text"><span class="text"><?php echo $text_listurg; ?>:</span></td>
            <td class="boxborder text"><span class="text">
              <select name="urgency">
                <?php
               $query = "	SELECT b.color,b.id,b.orderx,b.name
					FROM tickets_levels	as b ORDER BY b.orderx ASC";
					$db->SetFetchMode(ADODB_FETCH_ASSOC);
			$result =  $db->Execute($query);
			WHILE (!$result->EOF)
				{
				$row =$result->fields;
				$result->MoveNext();
				echo '<option style="background-color:#'.$row['color'].'" value="'.$row['id'].'|'.$row['name'].'">'.$row['name'].'</option>';
				}
?>
              </select>
            </span></td>
          </tr>
        </table>
          <div style="padding-top:5px"></div>
          <table width="97%" cellspacing="1" cellpadding="1" class="boxborder" align="center">
            <tr>
              <td align="center"><textarea name="message" cols="80" rows="10">
<?php
			IF (isset($_POST['message']) && $_POST['message'] != '')
				{
				echo $_POST['message'].'</textarea>';
				}
			ELSE
				{
				echo '</textarea>';
				}
                ?>
					</textarea></td>
            </tr>
            <tr>
              <td align="right"><input type="submit" value="Submit" /></td>
            </tr>
          </table>
          <div style="padding-top:5px"></div>
          <?php
	// ALLOW THE USERS TO ATTACH A FILE TO THE TICKET
			IF ($allowattachments == 'TRUE')
				{
				FileUploadForm();
				}
?>
          <span class="comment3">
          <?php
					FOR ($i = '0'; $i <= COUNT($allowedtypes) - 1; $i++)
					{
					echo $allowedtypes_[$i].' , ';
					}
					echo '<BR>';				
				
				?>
          </span><br /></td>
      <td class="boxborder" width="50%" valign="top" style="padding-top:5px"><table width="97%" cellspacing="1" cellpadding="1" class="boxborder" align="center">
          <tr>
            <td class="text"><br /></td>
          </tr>
          <?php
	// IF ATTACHMENTS ARE TRUE THEN SHOW ALLOWED FILETYPES
			IF ($allowattachments == 'TRUE')
				{
?>
          <tr>
            <td class="text"><br />
            </td>
          </tr>
          <tr>
            <td class="text">&nbsp;</td>
          </tr>
          <tr>
            <td class="text">&nbsp;</td>
          </tr>
          <?php

				}

?>
        </table>
          <br />
          <input name="registernow" type="hidden" id="registernow" value="1">
      </td>
    </tr>
  </table>
</form>