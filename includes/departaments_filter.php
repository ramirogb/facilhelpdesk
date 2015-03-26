<?php 
if ($authz<>'TRUE') exit;
?>
<div class="comment2"></div>
<table width="<?php echo $maintablewidth ?>" border="1" align="<?php echo $maintablealign ?>" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" class="boxborder">
  <tr>
    <td height="27" colspan="4" bgcolor="#AACCEE" class="boxborder text"><strong>  My filter of <strong> Departments</strong></strong></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td class="text boxborder"><strong>Username </strong></td>
    <td width="100" class="boxborder text">&nbsp;</td>
    <td class="boxborder text">
	<?php
	$querystaff = '	SELECT *	FROM tickets_categories ORDER BY tickets_categories_id';
	$db->SetFetchMode(ADODB_FETCH_ASSOC);
	$resultstaff =  $db->Execute($querystaff);

    ?>
      <table   border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
        <tr>          
		  <?php  	do {
		  	$depa = $resultstaff->fields;
			$resultstaff->MoveNext();
		   ?>
          <td  class="minititle" width="100" >&nbsp;<?php echo $depa['tickets_categories_name']; ?>
		  </td>
          <?php } WHILE (!$resultstaff->EOF); ?>
        </tr>
      </table>
    </td>
    <td width="55" class="boxborder text">&nbsp;</td>    
  </tr>
  <?php
	// LOOP THROUGH ALL USERS IN THE DATABASE WHO ARE MOD in others words, staff members
$mysel=$_SESSION['xcv_userna'];
			$query = "	SELECT  id, name, username,
						password, email, admin,
						status,lastlogin
					FROM users WHERE users.username='$mysel'";
							$db->SetFetchMode(ADODB_FETCH_ASSOC);
			$result = $db->Execute($query);
			$j = '1';

			WHILE (!$result->EOF)
				{
				$row =$result->fields;
				$result->MoveNext();
				IF ($row['status'] == '1')
					{
					$status = 'Active';
					}
				ELSE
					{
					$status = 'Suspended';
					}
?>
  <form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=users_dep_edit_visible" Method="post">
    <tr bgcolor="<?php echo UseColor() ?>">
      <td class="boxborder text"><?php echo $j; ?>

	  <?php echo '&nbsp;<strong>'.$row['username'].'</strong>';
	   $the_user=$row['id']; ?>
      <input name="username" type="hidden" id="username" value="<?php echo $row['username']; $the_user=$row['id']; ?>">
	  </td>
      <td class="boxborder text"><strong><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=departaments">Assigned by Admin:</a></strong></td>
      <td class="boxborder text">
	  <?php //inicio de listas todos los departaments
  	 $querydepas = "	SELECT * FROM tickets_categories ORDER BY tickets_categories_id";
			$db->SetFetchMode(ADODB_FETCH_ASSOC);
	$resultsdepas = $db->Execute($querydepas);
	$total_departaments= $resultsdepas->RecordCount();
	
	$zif=0;
?>
	  <table    border="1" cellpadding="0" cellspacing="0" bordercolor="#E8E8E8">
          <tr>
		  <?php
		  do {
		  $depa6 = $resultsdepas->fields;
		   $resultsdepas->MoveNext();
          $deparw=$depa6['tickets_categories_id'];
          $querystaff = "	SELECT *	FROM users_staff WHERE         users_staff.userx='$the_user' and users_staff.departament='$deparw' ";
		  		$db->SetFetchMode(ADODB_FETCH_ASSOC);
		  $result22 =  $db->Execute($querystaff);
		  $depa = $result22->fields;
		  $is_set = $result22->RecordCount();;
		   ?>
            <?php
			 	
			  	do {
				 $depa =$result22->fields;
				 $result22->MoveNext();
			?>
            <td  width="100" >
			<input  disabled name="<?php if (   $zif< $total_departaments ){$zif +=1;}else 
			$zif=1;
			echo $zif; 
			?>" type="checkbox" id="<?php echo $zif; ?>"   value="<?php  $value=$deparw; echo $value; ?>"<?php if ($is_set>0) { echo 'checked';} ?>>
			<input name="a<?php echo $zif; ?>" type="hidden" id="a<?php echo $zif; ?>" value="<?php  if ($is_set>0) echo $deparw; ?>">      
			</td>
            <?php
			  } WHILE (!$result22->EOF); ?>            
		<?php //fin de chequear todos los departamentos para pasar a los usuarios
		}
		WHILE (!$resultsdepas->EOF);?>		
		  </tr>		  
        </table>
		
      
      <input name="number_deps" type="hidden" id="number_deps" value="<?php echo $total_departaments; ?>">      </td>
      <td width="55" class="boxborder">
        <input type="hidden" name="memberid" value="<?php echo $row['id'] ?>">
      </td>
    </tr>
    <tr bgcolor="<?php echo UseColor() ?>">
      <td class="boxborder text">&nbsp;</td>
      <td class="text boxborder"><strong>Visible:</strong></td>
      <td class="boxborder text"><?php //inicio de listas todos los departaments
  	 $querydepas = "	SELECT * FROM tickets_categories ORDER BY tickets_categories_id";
			$db->SetFetchMode(ADODB_FETCH_ASSOC);
	$resultsdepas = $db->Execute($querydepas);
	$total_departaments= $resultsdepas->RecordCount();
	
	$zif=0;
?>
          <table    border="1" cellpadding="0" cellspacing="0" bordercolor="#E8E8E8">
            <tr>
              <?php
		  do {
		  $depa6 =$resultsdepas->fields;
		  $resultsdepas->MoveNext();
          $deparw=$depa6['tickets_categories_id'];
		   
		  
           $querystaff = "	SELECT *	FROM users_staff WHERE     users_staff.userx='$the_user' and users_staff.departament_visible='$deparw' ";
		  $result22 = $db->Execute($querystaff);
		  
		  $is_set = $result22->RecordCount();
		   ?>
              <?php
			 	
			  	do {
				$depa = $result22->fields;
				 $result22->MoveNext();
			?>
              <td  width="100" ><input name="v<?php echo $deparw; 
		?>" type="checkbox" id="<?php echo $deparw; ?>" value="<?php echo $deparw; ?>"<?php if ($is_set>0) { echo 'checked';} ?>>
              <input name="ex<?php echo $deparw;  ?>" type="hidden" id="e" value="<?php echo $deparw; ?>"></td>
              <?php
			 } WHILE (!$result22->EOF); ?>
              <?php //fin de chequear todos los departamentos para pasar a los usuarios
		}
		WHILE (!$resultsdepas->EOF);?>
            </tr>
          </table>
          <input name="number_deps" type="hidden" id="number_deps" value="<?php echo $total_departaments; ?>"></td>
      <td class="boxborder"><input type="hidden" name="memberid" value="<?php echo $row['id'] ?>">
          <input type="submit" name="sub" value="Update" />
      </td>
    </tr>
  </form>
  <?php
				$j++;
				}
?>
</table>
<p>&nbsp;</p>