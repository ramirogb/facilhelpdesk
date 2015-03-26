<?php
if ($authz<>'TRUE') exit;
	include_once('config.php');
	include_once('includes/functions.php');
?>
<span class="boxborder text"></span>
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>?action=create2">
  <p class="boxborder text"><?php echo $select_a_user;?>&nbsp; </p>
  <p class="boxborder text">
    <select name="username" id="username">
      <?php
			$query = "	SELECT name, username, email FROM users";
			$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;			
			$result = $db->Execute($query);
			WHILE (!$result->EOF) //$row = mysql_fetch_array($result))
				{				echo '<option value="'.$result->fields['username'].'">'.$result->fields['username'].' =>'.$result->fields['name'].' =>'.$result->fields['email'].'</option>';
				$result->MoveNext();
				}
?>
    </select><input type="submit" name="Submit" value="Select">
      
</p>
</form>
