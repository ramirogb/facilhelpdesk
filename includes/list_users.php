
<?php 
if ($authz<>'TRUE') exit;
$maxRows_Recordset1 =$users_display; //Number of results per page
$pageNum_Recordset1 = 0;
$currentPage = $_SERVER["PHP_SELF"];
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1']; 
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;
$_SESSION['start']=$startRow_Recordset1+1;
$_SESSION['end']= $currentPage*$maxRows_Recordset1  + $totalRows_contenido;
?>
<table width="900" border="0" cellpadding="0" cellspacing="2">
  <tr>
    <td width="410" height="40"><form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?action=users">
        <table border="1" cellpadding="1" cellspacing="1" bordercolor="#F3F3F3">
          <tr>
            <td><select name="selector" id="selector">
                <option value="name">Name</option>
				<option value="username">Username</option>
				<option value="comments">Notes</option>
                <option value="company">Company</option>
                <option value="website">Website</option>
                <option value="email">Email</option>                
              </select>
                <input name="key" type="text" id="key" size="15" maxlength="20">
                <input name="search" type="hidden" id="search" value="1">
                <span class="comment3">4dig.</span>
                <input type="submit" name="Submit" value="Search"></td>
          </tr>
        </table>
      </form>
    <td width="433"><table width="100%" border="0" cellpadding="0" cellspacing="1" bordercolor="#F3F3F3">
        <tr>
          <td><form name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?action=get_users">
              <span class="text">List users: </span>
              <select name="listusers" id="listusers">
			  <option value="1">Active</option>
                <option value="2">Banned</option>                
                <option value="0">Inactive</option>
              </select>
              <select name="arch" id="arch">
                <option value="zip">zip</option>
                <option value="text">text</option>
              </select>
              <span class="comment3">:Separator
              <input name="separator" type="text" id="separator" value="," size="4" maxlength="4">
              <input type="submit" name="Submit2" value="Get file">
</span>
              
              <input name="users" type="hidden" id="users" value="active">
          </form></td>
        </tr>
    </table></td>
  </tr>
</table>
Order by:
<select name="select2" id="select2" onChange="n_order(); javascript:location.reload(true);">
  <option value="Order by">Order by</option>
  <option value="username"<?php if (!(strcmp("username", $_SESSION['ord_usr'] ) ) ) {echo "SELECTED";} ?>>Username</option>
  <option value="id"<?php if (!(strcmp("id", $_SESSION['ord_usr'] ) ) ) {echo "SELECTED";} ?>>Id</option>
  <option value="date"<?php if (!(strcmp("added", $_SESSION['ord_usr'] ) ) ) {echo "SELECTED";} ?>>Date</option>
  
</select>
<table width="<?php echo $maintablewidth ?>" cellspacing="0" cellpadding="0" class="boxborder" align="<?php echo $maintablealign ?>">
  <tr style="padding-bottom:2px">
    <td colspan="2" bgcolor="#AACCEE" class="text boxborder"  style="padding-left:5px"><strong> Users List</strong></td>
    <td colspan="2" bgcolor="#AACCEE" class="text boxborder"  style="padding-left:5px"><span class="text"></span><span class="text"><strong><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=ad_use"><?php echo  $adduser;?><img src="images/add_user.gif" vspace="1" border="0"></a></strong></span></td>
    <td colspan="8" bgcolor="#AACCEE" class="text boxborder"  style="padding-left:5px">To assign a user to a departament, change the type to &quot;Stafff&quot; and go to &quot;<a href="tickets2.php?action=asignements">Assignements</a>&quot; </td>
    <td class="boxborder text" bgcolor="#AACCEE">&nbsp;</td>
  </tr>
  <tr bgcolor="#EEEEEE">
    <td bgcolor="#EEEEEE" class="boxborder text"><b>ID.</b></td>
    <td bgcolor="#EEEEEE" class="boxborder text">N&ordm;</td>
    <td class="boxborder text"><b><b>Username </b></b></td>
    <td class="boxborder text"><b><b>New</b></b></td>
    <td class="boxborder text"><b>Name</b></td>
    <td class="boxborder text"><div align="center"><b>Password</b></div></td>
    <td class="boxborder text"><b>Email</b></td>
    <td class="boxborder text"><div align="center"><b>Type</b></div></td>
    <td class="boxborder text"><div align="right">T1</div></td>
    <td class="boxborder text"><div align="right">T2</div></td>
    <td class="boxborder text"><div align="center"><b>Status</b></div></td>
    <td class="boxborder text"><div align="center"><b>Action</b></div></td>
    <td class="text boxborder"><strong>Reg. Date</strong></td>
  </tr>
</table>
<table width="<?php echo $maintablewidth ?>" cellspacing="0" cellpadding="0" class="boxborder" align="<?php echo $maintablealign ?>"><?php
//if $_GET[
if (isset($_SESSION['ord_usr']) )
{
if( $_SESSION['ord_usr'] =='id' ){ $ord='id';}
if( $_SESSION['ord_usr'] =='username' ){ $ord='username';}
if( $_SESSION['ord_usr'] == 'added' ) { $ord='added';}
//echo $_SESSION['ord_usr'];

//echo $ordx;
}
else
{$ord='username';
}

  //$ord=username
  //to create pages select this
			 $query = "	SELECT  * FROM users	ORDER BY '$ord' ";
				
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
		$result = $db->Execute($query);			
		 if (is_object($result))
	 { $totalRows_Recordset1 =  $result->RecordCount();
	 }
	
if (isset($_POST['search']))
{
$key=$_POST['key'];
$selector=$_POST['selector'];

	if ($dbms=='mysql')
	{	 $query = "	SELECT  * FROM users WHERE 	MATCH($selector) against ('$key' in boolean mode) ORDER BY username"; 	
	}
	$add_sql= "where $selector like '%$key%' " ;
			 
}

if ($dbms=='mysql')
{$query_limit = sprintf("%s LIMIT %d, %d",$query, $startRow_Recordset1, $maxRows_Recordset1);}

  	 if ($dbms=='mssql')				 
 	{//begin sqlserver
	$query_mssql="	SELECT  top _yy_ * FROM users $add_sql  ";
	
	
	 $query_mssql = "select top $users_display  * from (select top _xx_  * from
	     ($query_mssql  ORDER BY $ord DESC) as foo  ORDER BY $ord ASC)
	    as bar order by $ord DESC";
	
	 $rr= ($pageNum_Recordset1+1)*$users_display;
	          //10 >8
			if ($rr >= $totalRows_Recordset1) //ultima pagina
			{ $rr=$totalRows_Recordset1; //por evitar posibles errores 4		 
			
			//2 situations < user_display
			 //mas de una paginna  $users_display2=  ceil($totalRows_Recordset1/$users_display)+1;
			 			$users_display2= ($totalRows_Recordset1 % $users_display);						
		                   if (	$totalRows_Recordset1 ==$users_display) $users_display2=$users_display;//parche caso limite
						
			 $query_mssql=str_replace( '_xx_',$users_display2, $query_mssql );			
			 }
	 				else
	 		{					
			$query_mssql=str_replace( '_xx_',$users_display, $query_mssql );
			 }

 $query_mssql=str_replace( '_yy_',$rr, $query_mssql );	  
 $query_limit =   $query_mssql;
		
	}//end sqlserver

		$db->SetFetchMode(ADODB_FETCH_ASSOC);
		//echo $query_limit;
		$resultA = $db->Execute($query_limit);

		
	 $totalRows_contenido =  $resultA->RecordCount();		
  //to create pages select this			
			$j =$_SESSION['start'];
			$row = $resultA->fields;			
			WHILE (!$resultA->EOF  )

				{
					
				$row=$resultA->fields;	
				@$resultA->MoveNext();				
				
				IF ($row['status'] == '1')
					{
					$status = 'Active';
					}
				IF ($row['status'] == '0')
					{
					$status = 'Suspened';
					}	
				IF ($row['status'] == '2')
					{
					$status = 'Banned';
					}
?>                                           
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=us" Method="post">
    <tr bgcolor="<?php echo UseColor() ?>">
      <td class="boxborder text"><?php 
	  echo $row['id'];
	  //echo $j; 
	  ?></td>
      <td class="boxborder text"><?php 
	  echo $j; 
	  ?></td>
      <td  style="padding-right:3px" class="boxborder"><div align="right"><span class="boxborder text"><?php echo $row['username'] ?>
            <a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=comments&username=<?php echo $row['username']; ?>"><img src="images/comments.gif" alt="Profile &amp; History" width="15" height="12" border="0"></a>
          <input name="username" type="hidden" id="username" value="<?php echo $row['username']; ?>">
</span>
        </div></td>
      <td  style="padding-right:3px" class="boxborder"><span class="boxborder text">
        <input name="Create" type="submit" class="comment4" id="Create" value="ticket">
      </span></td>
      <td class="boxborder text"><input name="name" value="<?php echo $row['name'] ?>" size="15" /></td>
      <td class="boxborder"><input name="password" type="password" value="<?php echo $row['password'] ?>" size="12" /></td>
      <td class="boxborder"><input name="email" value="<?php echo $row['email'] ?>" size="15" /></td>
      <td class="boxborder">          <select name="type" id="type">
          <option value="User" <?php if (!(strcmp("User", $row['admin'] ) ) ) {echo "SELECTED";} ?>><?php echo 'User'; ?></option>
          <option value="Mod" <?php if (!(strcmp("Mod", $row['admin'] ) ) ) {echo "SELECTED";} ?>><?php echo 'Staff'; ?></option>
		  <option value="Admin" <?php if (!(strcmp("Admin", $row['admin'] ) ) ) {echo "SELECTED";} ?>><?php echo 'Admin'; ?></option>
        </select>
	  </td>
      <td class="boxborder"><input name="t1" type="text"   <?php if ($upgraded <> '345fh') echo  "disabled"; ?> id="t1" value="<?php echo $row['t1'] ?>" size="3" maxlength="4" /></td>
      <td class="boxborder"><input name="t2" type="text" <?php if ($upgraded <> '345fh') echo  "disabled"; ?>  id="t2" value="<?php echo $row['t2'] ?>" size="3" maxlength="4" /></td>
      <td class="boxborder text"><?php echo $status ?>
      <input name="edituser" type="hidden" id="edituser" value="1"></td>
      <td class="text"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=chang&<?php IF ($row['status'] == '1') {     ?>memberid=<?php echo $row['id'] ?>"><img src="./images/suspend.gif" alt="Suspend user" width="16" height="16" border="0"><?php
					}
				ELSE
					{
                    ?>sub_act=1&amp;memberid=<?php echo $row['id']; ?>"><img src="./images/activate.gif" alt="Activate user" width="16" height="16" border="0"><?php
					}
?>
</a>&nbsp;<a href="./tickets2.php?action=deleteuser&memberid=<?php echo $row['id'] ?>&username=<?php echo $row['username']; ?>"><img src="./images/delete.gif" alt="Delete user" width="16" height="16" border="0"></a>
<input type="hidden" name="memberid" value="<?php echo $row['id']; ?>">
          <input type="submit" name="sub" value="Save" />
      </td>
      <td bgcolor="<?php echo UseColor() ?>" class="text"><span class="boxborder text">
	  <?php 
	    if  ($row['added']<>0)
			  {
			  	  echo date($dformat, $row['added']);
			  }
	   ?>
	  </span></td>
    </tr>
  </form>
  <?php				
				$j++;				
				}
?>
</table>
<p> <?php

$_SESSION['end']= $currentPage*$maxRows_Recordset1  + $totalRows_contenido;

/*
if (isset($_GET['totalRows_Recordset1']))
 {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else
 {
  $all_Recordset1 = mysql_query($query);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
  
  $_SESSION['total']=$totalRows_Recordset1;
}
*/
  $_SESSION['total']=$totalRows_Recordset1;
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
 $totalRows_contenido=$totalPages_Recordset1; 

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);

 ?>
<?php echo $_SESSION['total'].' users'; ?></p>
<p>T1: Hours to provide first answer to ticket, T2: hours to complete solution of ticket acording with SLA </p>
<p><span class="testo Estilo2">
<a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">&laquo;&laquo;</a> 

<a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">&laquo;</a>

 <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">&raquo;</a> <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">&raquo;&raquo;</a>
</span>
  <?php
   $qas= ceil(  ($_SESSION['total']/$maxRows_Recordset1) );
   echo 'Result page: ';   
   $time = round($endtime*100)/100;   
   for ($zz=0;  $zz < $qas; $zz +=1)
   { //for
   ?>
  <span class="testo">
  <a href="<?php printf("%s?pageNum_Recordset1=%d%s",$currentPage,$zz,$queryString_Recordset1); ?>"><?php echo $zz; ?></a>
  </span>
  <?php
   } //of the for
   ?>
</p>
<p><span class="text"></span></p>
<div align="right"></div>