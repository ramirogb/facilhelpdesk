<?php
if ($authz<>'TRUE') exit;
?>
<link href="styles.css" rel="stylesheet" type="text/css">
<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>?action=sprofile" method="post">
  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="2">
    <tr>
      <td><table width="100%"  border="0" cellpadding="2" cellspacing="1" bordercolor="#CCCCCC" class="comment3">
        <tr>
          <td rowspan="5"><span class="text">
            <?php
	  $user=$_GET['username'];
	 $query101 = "SELECT  count(*)as total FROM tickets_tickets,tickets_state 
	  WHERE 
	  tickets_username='$user' and tickets_child='0'
	  and tickets_state.id=tickets_tickets.tickets_id
       and tickets_state.tickets_status='1'
	   union all	   
	   SELECT  count(*)as total FROM tickets_tickets,tickets_state 
	  WHERE 
	  tickets_username='$user' and tickets_child='0'
	  and tickets_state.id=tickets_tickets.tickets_id
       and tickets_state.tickets_status='0'
	   union all
	   	   SELECT  count(*)as total FROM tickets_tickets,tickets_state 
	  WHERE 
	  tickets_username='$user' and tickets_child='0'
	  and tickets_state.id=tickets_tickets.tickets_id
       and tickets_state.tickets_status='2'
	  
	  ";
	  
	  		$db->SetFetchMode(ADODB_FETCH_NUM);
			$result101 = $db->Execute($query101);
			$n_of_ticketes=$result101->fields;
			
			$open=$n_of_ticketes[0];
			
			$result101->MoveNext();
			$n_of_ticketes=$result101->fields;
			$closed=$n_of_ticketes[0];
			
			$result101->MoveNext();
			$n_of_ticketes=$result101->fields;
			$hold=$n_of_ticketes[0];
			   ?>
          </span></td>
          <td><strong>Tickets </strong></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Open : </td>
          <td><?php  echo  $open;?>
&nbsp;</td>
        </tr>
        <tr>
          <td>Closed: </td>
          <td><?php echo  $closed; ?></td>
        </tr>
        <tr>
          <td>Hold: </td>
          <td><?php echo  $hold;  ?></td>
        </tr>
        <tr>
          <td>Total: </td>
          <td><?php echo  $open+$closed+$hold; ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><strong>Tickets <a href="./tickets2.php?search_user&username=<?php echo $_GET['username']; ?>">Submissions:</a>              <?php
		$query1="SELECT b.tickets_categories_name,count(a.tickets_child) as suma from
         tickets_tickets a,tickets_categories b,tickets_state c
		  where 
		  a.tickets_child=0 
         and a.tickets_admin='$user' 
         and b.tickets_categories_id=a.tickets_category
		 and a.tickets_id=c.id 
      GROUP by b.tickets_categories_name";
	  $db->SetFetchMode(ADODB_FETCH_NUM);
	$request5= $db->Execute($query1);

	 ?>
          </strong></td>
        </tr>
        <?php 
  do
  {
  	$row=$request5->fields;
	$request5->MoveNext();
  ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;<?php echo $row[0];  ?></td>
          <td><?php echo $row[1];  ?></td>
        </tr>
        <?php }
while (!$request5->EOF)
	?>
      </table></td>
      <td><table cellspacing="1" cellpadding="1" class="boxborder">
        <tr>
          <td colspan="2"   class="text"><strong>Profile</strong></td>
        </tr>
        <tr>
          <td width="16%"  class="text"><b>Username:</b></td>
          <td class="text"><?php  echo $_GET['username']; 
		   $row= $result_con->fields;
		  
		   ?>&nbsp;</td>
        </tr>
        <tr>
          <td  class="text"><b>Name:</b></td>
          <td class="text"><input name="name" size="40" value="<?php echo $row['name'] ?>" /></td>
        </tr>
        <tr>
          <td  class="text"><b>Email:</b></td>
          <td class="text"><input name="email" size="40" value="<?php echo $row['email'] ?>" /></td>
        </tr>
        <tr>
          <td  class="text"><b>Website:</b></td>
          <td class="text"><input name="website" id="website" value="<?php echo $row['email'] ?>" size="40" maxlength="70"

<?php
			IF (isset($_POST['ticketsubject']) && $_POST['ticketsubject'] != '')
				{
				echo ' value="'.$_POST['ticketsubject'].'"';
				}
?>

					></td>
        </tr>
        <tr>
          <td class="text"><b>Company:</b></td>
          <td class="text"><input name="company" id="company" value="<?php echo $row['company'] ?>" size="40"

<?php
			IF (isset($_POST['ticketsubject']) && $_POST['ticketsubject'] != '')
				{
				echo ' value="'.$_POST['ticketsubject'].'"';
				}
?>

					></td>
        </tr>
        <tr>
          <td  class="text">&nbsp;</td>
          <td class="text"><p>&nbsp;
              </p>
            </td>
        </tr>
        <tr>
          <td  class="text"><input name="profile" type="hidden" id="profile" value="1">
            <input name="username" type="hidden" id="username" value="<?php  echo $_GET['username']; ?>"></td>
          <td class="text">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </table>
  <table cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td colspan="2" class="text"><strong>Notes of user</strong></td>
    </tr>
    <tr>
      <td class="text">&nbsp;</td>
      <td><textarea name="comments" cols="100" rows="7" id="mail"><?php
echo  $row['comments'];
?>
  </textarea>
          <input name="username" type="hidden" id="username" value="<?php  echo $_GET['username']; ?>"></td>
    </tr>
    <tr>
      <td  style="padding:5px" colspan="2" class="text"><input type="submit" value="Save" name="userform" /></td>
    </tr>
    <tr>
      <td colspan="2" class="text"><a href="javascript:history.back()">Back </a></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>