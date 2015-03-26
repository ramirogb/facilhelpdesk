<style type="text/css">
<!--
.Estilo1 {
	color: #FF6600;
	font-weight: bold;
}
.Estilo2 {color: #0066CC}
-->
</style>
<link href="styles.css" rel="stylesheet" type="text/css">
<table width="<?php echo $maintablewidth ?>" border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" class="boxborder">
  <tr>
    <td height="27" colspan="4" bgcolor="#AACCEE" class="boxborder text"><strong> Assignement of Staff Members/Administrators<strong> and Departments</strong></strong></td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td width="89" class="text boxborder"><strong>Username </strong></td>
    <td width="123" class="boxborder text"><strong>Last action </strong></td>
    <td  class="text"><?php
	$querystaff = '	SELECT *	FROM tickets_categories ORDER BY tickets_categories_id';
	$resultstaff =  $db->Execute($querystaff);	
    ?>
        <table border="1" cellpadding="0" cellspacing="0" bordercolor="#E8E8E8">
          <tr>
            <?php  	do {
		  $depa = $resultstaff->fields;
		 // print_r($depa);
		   $resultstaff->MoveNext();
		   ?>
            <td  valign="top" class="comment3"  style=" padding-left:10px "  >&nbsp;<?php echo $depa['tickets_categories_name'].'<BR> Level:'.$depa['level'].'</BR>'; 
			
			?>
            <div align="center"><img src="images/sepa.gif" width="70" height="5"> </div></td>
            <?php } WHILE (!$resultstaff->EOF ); ?>
          </tr>
      </table></td>
    <td >&nbsp;</td>
  </tr>
  <?php
	// LOOP THROUGH ALL USERS IN THE DATABASE WHO ARE MOD in others words, staff members

			$query = "	SELECT  id, name, username,
						password, email, admin,
						status,lastlogin
					FROM users WHERE (admin='Admin')  or  (admin='Mod')	ORDER BY name";
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
  <form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=users_dep_edit" Method="post">
    <tr bgcolor="<?php echo UseColor() ?>">
      <td class="boxborder text"><?php echo $j; ?> <?php echo '&nbsp;<strong>'.$row['username'].'</strong>';
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
      <td bgcolor="<?php echo UseColor() ?>" class="boxborder text"><?php //inicio de listas todos los departaments
  	$querydepas = "	SELECT * FROM tickets_categories ORDER BY tickets_categories_id";
	$resultsdepas =  $db->Execute($querydepas);
	$total_departaments= $resultsdepas->RecordCount();
	
	$zif=0;
?>
          <table    border="1" cellpadding="0" cellspacing="0" bordercolor="#E8E8E8" >
            <tr>
              <?php
			  $co=-1;
		  do { 
		  $depa6 = $resultsdepas->fields;
          $deparw=$depa6['tickets_categories_id'];
		  $resultsdepas->MoveNext();
          $querystaff = "	SELECT users_staff.departament, users_staff_v_level.depart	FROM users_staff  
		 left join users_staff_v_level 
		 on users_staff_v_level.userx = users_staff.userx and users_staff.departament=users_staff_v_level.depart
		 WHERE       users_staff.userx='$the_user' 
		 and users_staff.departament='$deparw'   ";
		 	$db->SetFetchMode(ADODB_FETCH_ASSOC);
		  $result22 = $db->Execute($querystaff);
		 //$is_set = $result22->RecordCount();
		 
		 	 
		 $depa =$result22->fields;

		   ?>
              <?php
			 	do {				
				$result22->MoveNext();
				//echo $deparw.'a';
			?>
              <td width="80"   >
                <input name="<?php if (   $zif< $total_departaments )
			{
			$zif +=1;
			}
			else 
			$zif=1;
			//echo $zif;
			echo $deparw;
			?>" type="checkbox"  id="<?php echo $zif; ?>"     style="margin-left:50px;   background-color:#0066CC " value="<?php  $value=$deparw; echo '1'; ?>"<?php if ( $depa['departament'] <>0) { echo 'checked';} ?>>
                <?php 
								
				
				?>
              <input name="<?php 
				
				$query_level="select users_staff_v_level.depart FROM users_staff_v_level where userx='$the_user' and depart='$deparw'";
		 $db->SetFetchMode(ADODB_FETCH_ASSOC);
		  $result_level = $db->Execute($query_level);
		  $sax=$result_level->fields;
		  $nivel=$sax['depart'];
				if (   $zif< $total_departaments )
			{
			$zif +=1;
			}
			else 
			$zif=1;
			//echo $zif;
			echo 'b['.$deparw.']';
			?>" type="checkbox"  style="margin-left:50px; background-color:#FF6600 "  id="<?php echo $zif; ?>" value="<?php  $value=$deparw; echo '1'; ?>"<?php if ( $nivel <>0) { echo 'checked';} ?>>
              <img src="images/sepa.gif" width="30" height="5"> </td>
              <?php
			$result22->MoveNext();
			 } WHILE (!$result22->EOF); ?>
              <?php //fin de chequear todos los departamentos para pasar a los usuarios
		}
		WHILE (!$resultsdepas->EOF);?>
            </tr>
        </table>
          <input name="number_deps" type="hidden" id="number_deps" value="<?php echo $total_departaments; ?>"></td>
      <td width="56" class="boxborder"><input type="hidden" name="memberid" value="<?php echo $row['id'] ?>">
          <input type="submit" name="sub" value="Update" />
      </td>
    </tr>
  </form>
  <?php
				$j++;
				}
?>
</table>
<p><span class="Estilo1"><span class="Estilo2">Note:</span></span></p>
<ul>
<li><span class="Estilo1"><span class="Estilo2">Permission to open, anwer, close, transfer and assign tickets at the same horizontal level </span></span></li>
<li><span class="Estilo1">Optional Permission to promote vertically a <a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=departaments">ticket</a>(Level 1, Level 2, Level 3) <img src="images/up_down.gif" width="20" height="20"> </span></li>
</ul>
<p>This page requires IE or colors of checkbox won't be visible. </p>
<p>For Firefox users: first check box permission is<span class="Estilo2"><strong> blue</strong></span>, second check box <span class="Estilo1">orange</span>. </p>
<p><span class="Estilo1"></span></p>
<p>  <?php 
?>
</p>
