<?php
if ($authz<>'TRUE') exit;
$coo=trim($sitename);

     $query = "	SELECT * FROM users
						WHERE  username = '".$_SESSION['xcv_userna']."'	";
						 $db->SetFetchMode(ADODB_FETCH_ASSOC);
			$result	      = $db->Execute($query);
			if( is_object($result->RecordCount()) )
			{
			$totaltickets = $result->RecordCount();
			}	else 'There is a temporal error please submit your request at keylogger@cromosoft.com';
			
			$row	      = $result->fields;
?>
<script src="includes/jquery.js"></script>
<script src="includes/jquery.validate.js"></script>

  <script> 
$(document).ready(function(){
    $("#creat").validate({
    
    rules: {
    	category: {
    		required: true,
    		minlength: 1
    	       }
		,ticketsubject: {
			required: true
		         }
        ,email: {
		        required: true,
                email: true
		         }
		
	},
    messages: {
	
    	category: {
    		required: "*** Error",	minlength: jQuery.format("You need to select {0}.")
    	      }
		      ,ticketsubject: "Subjet Error."
			  ,email:" Email Error"
		
              }
    
    });
});
 
</script>
  <script>
  $(document).ready(function(){
    $("#creat").validate();
  });
  </script>
<style type="text/css">
body {
	background-color: #333;
}
</style>


<form action="./tickets.php" method="post" enctype="multipart/form-data"  id="creat" >
  <table  width="600" border="0" align="center">
    <tr>
      <td width="71%" height="40%"><table width="<?php   if ($_GET['action']<>'create_form')  {echo $maintablewidth;} else {echo ceil($maintablewidth);}
	  ?>" align="<?php echo $maintablealign ?>" cellspacing="0" bgcolor="#D7F2FF" class="encuadro"    style="margin-left:0px; a  ">
        <tr>
          <td  width="50%" valign="top" style="padding-top:5px"><table    width="100%" cellspacing="2" cellpadding="0"  >
              <tr>
                <td colspan="3"   "class="text"><div align="center"><strong><?php echo $new_ticket1; ?></strong></div></td>
                </tr>
              <tr>
                <td width="16%"  style="padding-left:10px " class="text"><b>
                </b></td>
                <td colspan="2" class="text" style="padding-left:10px "><div align="center"><b>
                    <?php if ($_GET['action']<>'create_form') echo "$namex:"; ?>
                  </b> <?php echo $_SESSION['xcv_userna'] ?></div></td>
              </tr>
              <tr>
                <td rowspan="3" class="text" style="padding-left:10px "></td>
                <td class="text"><?php echo $company; ?></td>
              <td class="text"><input name="company" id="company" size="30" /></td>
</tr>
<tr>
<td class="text"><label id="name"><?php echo $namey; ?>:</label></td>
<td class="text"><input name="name" size="30" value="<?php echo $row['name'] ?>" /></td>
</tr>
<tr>
<td class="text"><?php echo $countri; ?></td>
<td class="text"><input name="country" id="country" size="30" /></td>
</tr>
              <tr>
                <td rowspan="2" class="text"  style="padding-left:10px "></td>
                <td class="text"><label  id="email" >Email:</label>                    </td>
              <td class="text"><input   name="email"    id="email" size="30" value="<?php echo $row['email'] ?>" /></td>
</tr>
<tr>
<td class="text">Telef.</td>
<td class="text"><input   name="telef" id="telef" size="30" /></td>
</tr>
              <tr>
                <td  style="padding-left:10px " class="text"><?php 
			  if ($_GET['action']=='create_formd'){
			  ?>
                </td>
                <td class="text"><label id="txtNumber">Retype Email:</label>
                </td>
              <td class="text"><input id="txtNumber" size="30" name="txtNumber" /></td>
</tr>
              <?php } ?>
              <?php
			IF (isset($_POST['ticketsubject']) && $_POST['ticketsubject'] != '')
				{
				echo ' value="'.$_POST['ticketsubject'].'"';
				}
echo        '<tr>';				
?>
        <tr><td  style="padding-left:10px " class="text"><?php 
			  if ($_GET['action']=='create_form')
			  {
			  ?>
          <input name="fromform" type="hidden" id="fromform" value="1"> <?php } ?></td>
            <td class="text"><label id="ticketsubject"><?php echo $subx; ?>:</label>                </td>
        <td class="text"><input name="ticketsubject" size="30"></td>
</tr>
        <tr>
          <td  style="padding-left:10px " class="text"></td>
          <td class="text" style="padding-left:10px "><label id="category"><?php echo $departament; 
		  
		 
		  ?>:</label>
          </td>
        <td class="text" style="padding-left:1px "><select id="category" name="category">
<option  value=""></option>
<?php
			 $query = "SELECT tickets_categories_id, epiping,tickets_categories_name
					FROM tickets_categories where level=1
					ORDER BY tickets_categories_name ASC";
					$db->SetFetchMode(ADODB_FETCH_ASSOC);
			$result = $db->Execute($query);

			$wss=1;			
			if (  $_GET['action'] <>'create_form') 
			{$wss=0;}
			
			WHILE (!$result->EOF)
				{
				$row =$result->fields;
			//print_r($row );				
				$result->MoveNext();
				
				if ($wss==0) echo '<option value="'.$row['tickets_categories_id'].'|'.$row['tickets_categories_name'].'">'.$row['tickets_categories_name'].'</option>';
				if    ($wss==1) 
				{
				if ($row['epiping']=='1') echo '<option value="'.$row['tickets_categories_id'].'|'.$row['tickets_categories_name'].'">'.$row['tickets_categories_name'].'</option>';
				}
				
				
				}
?>
</select></td>
</tr>
        <tr>
          <td style="padding-left:10px "  class="text"></td>
          <td class="text"><label id="category"><?php echo $text_listurg; ?>:</label>            </td>
        <td class="text"><select name="urgency">
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
</select></td>
</tr>
            </table>
              <div style="padding-top:5px"></div>
              <table width="100%" cellspacing="1" cellpadding="1"  align="center">
                <tr>
                  <td  style=" padding-left:10px " ><textarea name="message" cols="<?php
				  
				  	  if ($_GET['action']<>'create_form')  {echo 100;} else echo 70;
				   ?>" rows="10">
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
                  <td align="right"  class="text"><span class="comment3"><?php echo $label_limit_tickets;?>&nbsp;<?php echo $limit_tickets.' seconds';?></span>                    <?php	
			IF ($allowattachments == 'TRUE')
				{
				FileUploadForm();
				}
?></td>
                </tr>
              </table>
              <div   class="comment3" style="padding-top:5px; padding-left:5px"> <b>Allowed attachments: </b>
                  <?php
					FOR ($i = '0'; $i <= COUNT($allowedtypes) - 1; $i++)
					{
					echo $allowedtypes_[$i].' , ';
					}
					echo '<BR>';				
				
				?>
              </div>
              <div align="center">
                <input type="submit"  value="Submit" />
                <input name="registernow" type="hidden" id="registernow" value="1">
                <input name="helpdesk" type="hidden" id="helpdesk" value="Facil HelpDesk">
                <input name="sec" type="hidden" id="sec" value="<?php echo $_SESSION['asdfg']; ?>">
                <input name="hoas" type="hidden" id="hoas" value="1">
                <input name="hoas2" type="hidden" id="lang" value="<?php echo $_REQUEST['lang']; ?>" />
                <br />
            </div></td>
        </tr>
      </table>
oo</td>
    </tr>
  </table>
</form>