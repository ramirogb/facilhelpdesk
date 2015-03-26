<?php
if ($authz<>'TRUE') exit;

	function db_size_info($dbsize) { 
$bytes = array('KB', 'KB', 'MB', 'GB', 'TB'); 
if ($dbsize < 1024) $dbsize = 1;             
for ($i = 0; $dbsize > 1024; $i++) $dbsize /= 1024; 
$db_size_info['size'] = ceil($dbsize); 
$db_size_info['type'] = $bytes[$i]; 
return $db_size_info; 
} 

?>
<link href="styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo1 {font-size: x-small}
-->
</style>
<div align="center">
  <table width="80%"  border="0">
    <tr>
      <td width="28%" height="35"><span class="content"><strong>Help Desk Information</strong></span></td>
      <td width="36%"><span class="content"><span class="text">
        <?php 
echo '<p >GD is ';
if (function_exists("gd_info")) {
	echo '<span style="color: #00AA00; ">supported</span> by your server!</p>';
} else {
echo '<span style="color: #EE0000;">not supported</span> by your server!</p>';
}
echo '</div>';	
	?>
      </span></span></td>
      <td width="36%"><div align="center"><a href="./tickets2.php?action=reports" class="comment3">More reports </a></div></td>
    </tr>
  </table>
</div>
<table width="98%"  border="0" align="center">  
      <tr>
        <td  valign="top"><table width="95%"  border="0" cellpadding="0" cellspacing="0" class="tables">
          <tr  valign="top" class="headertable" style="padding:4px">
            <td height="20"><div align="center"><span class="content">Database:</span></div></td>
          </tr>
          <tr  valign="top" style="padding:4px">
            <td><span class="content"><img src="images/database.jpg" width="35" height="40">DB size
            <?php 
			if ($dbms=='mysql')
			{
$sql="SHOW TABLE STATUS"; 
$sale=$db->Execute($sql);

$dbssize = 0; 
while ( !$sale->EOF )
 {
 $row = $sale->fields;  
$sale->MoveNext();
$dbssize += $row['Data_length'] + $row['Index_length']; 
 	if ( $row['Name']=='tickets_atach')
	{
	$adjuntos=$row['Data_length'];
	}
 
} 

print   ceil(($dbssize/1024) );
echo ' KBytes'; 
}
			?></span></td>
          </tr>
          <tr  valign="top" style="padding:4px">
            <td height="44"><span class="content">
              Atachments
              by email: <?php 
		//$b= db_size_info($adjuntos);		 
		 print   ceil(adjuntos/1024)."K Bytes";		 
		 
		  ?>
            </span></td>
          </tr>
        </table>          
        <span class="text">        </span> </td>
        <td colspan="2"  valign="top"><table width="95%"  border="0" cellpadding="0" cellspacing="0" class="tables">
          <tr  valign="top" class="headertable" style="padding:4px">
            <td height="20" colspan="2"><div align="center"><span class="content">Disk used by atachments by web</span></div></td>
          </tr>
          <tr  valign="top" style="padding:4px">
            <td><span class="content"></span></td>
            <td > Folder :
                <?php 
		  function dir_size($dir) 
			{ 
	$handle = opendir($dir); 
	while ($file = readdir($handle)) { 
	if ($file!= '..' && $file!= '.' &&!is_dir($dir.'/'.$file)) { 
	$mas += filesize($dir.'/'.$file); 
	} else if (is_dir($dir.'/'.$file) && $file!= '..' && $file!= '.') { 
	$mas += dir_size($dir.'/'.$file); 
	} 
	} 
	return $mas; 
	} 
		  echo $uploadpath; 
		   
		
		?>
                <span class="text"><?php echo  ceil( dir_size($uploadpath)/1024).' K Bytes';
 ?></span></td>
          </tr>
          <tr  valign="top" style="padding:4px">
            <td height="44" rowspan="2">&nbsp;</td>
            <td class="text" >&nbsp;</td>
          </tr>
          <tr  valign="top" style="padding:4px">
            <td class="text" >&nbsp;</td>
          </tr>
        </table></td>
        <td valign="top"><table width="95%"  border="0" cellpadding="0" cellspacing="0" class="tables">
          <tr class="headertable">
            <td height="21">&nbsp;</td>
            <td colspan="2"><strong>Logging method of tickets</strong></td>
          </tr>
          <?php
	  $n=0;
  ?>
          <tr>
            <td>&nbsp;</td>
            <td><strong>
              <?php
		$query1="SELECT count(a.tickets_child) as suma from
         tickets_tickets a
		  where 
		  a.tickets_child='0'  ";
		   $db->SetFetchMode(ADODB_FETCH_NUM); 
	$request5=$db->Execute($query1);
	$row=$request5->fields;
	 ?>
            </strong></td>
            <td><?php 
		 $total_tickets=$row[0];
		  ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Email &amp; forms<strong><?php
		 $query1="SELECT count(a.tickets_child) as suma from
         tickets_tickets a
		  where 
		  a.tickets_child='0'  and a.tickets_username='Unregistered' ";		 
	$request5=$db->Execute($query1);//assoc
	$row=$request5->fields;
	 ?>
            </strong></td>
            <td><?php 
		 echo $row[0];
		 $tickets_email=$row[0];  ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Web<strong> </strong></td>
            <td><?php 
		echo $total_tickets-$tickets_email; 
		 ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><strong>Total:</strong> </td>
            <td><?php echo $total_tickets; ?></td>
          </tr>
        </table></td>
      </tr>
  <tr>
    <td  valign="top"><table width="95%" border="0" cellpadding="0" cellspacing="0" class="tables" style=" margin-bottom:10px">
      <tr class="headertable">
        <td width="24%" height="22"><?php
	 // $user=$_GET['username'];
	  $query101 = "SELECT  count(*)as total FROM tickets_tickets,tickets_state 
	  WHERE
	   tickets_tickets.tickets_child='0'
	  and tickets_state.id=tickets_tickets.tickets_id
       and tickets_state.tickets_status='1'
	   union all	   
	   SELECT  count(*)as total FROM tickets_tickets,tickets_state 
	  WHERE 	  
	  
	   tickets_child='0'
	  and tickets_state.id=tickets_tickets.tickets_id
       and tickets_state.tickets_status='0'
	   union all
	   	   SELECT  count(*)as total FROM tickets_tickets,tickets_state 
	  WHERE 
 tickets_child='0'
	  and tickets_state.id=tickets_tickets.tickets_id
       and tickets_state.tickets_status='2' ";
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
			
			//echo $open.'&nbsp;'.$closed.'&nbsp;'.$hold;
	   ?>
        </td>
        <td width="69%"><strong> Tickets </strong></td>
        <td width="7%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2"><strong>Total Open</strong>:
            <?php  echo  $open;?>
            <a href="tickets2.php?action=home&order=1"><img src="images/read.gif" width="15" height="12" border="0"></a> </td>
      </tr>
      <tr>
        <td><?php
	 // $user=$_GET['username'];	 
  $query101 = "SELECT  count(unread_admin)as total FROM tickets_tickets,tickets_state,users
	  WHERE unread_admin='1'
	  AND tickets_state.id=tickets_tickets.tickets_id 
	  AND tickets_status='1'	  
	  AND tickets_tickets.tickets_admin=users.username";
			$result101 = $db->Execute($query101);
			$row=$result101->fields;
			
			//echo $open.'&nbsp;'.$closed.'&nbsp;'.$hold;
	   ?>
        </td>
        <td colspan="2"><p><span class="red2">Unread:</span>
                <?php  echo  $row[0];?>
                <img src="images/unread.gif" width="14" height="11"> </p></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2"> <strong>Total Closed:</strong> <?php echo  $closed; ?></td>
      </tr>
      <tr>
        <td><?php
	 // $user=$_GET['username'];	 
  $query101 = "SELECT  count(unread_admin)as total FROM tickets_tickets,tickets_state,users
	  WHERE unread_admin='1'
	  AND tickets_state.id=tickets_tickets.tickets_id 
	  AND tickets_status='0'	  
	  AND tickets_tickets.tickets_admin=users.username";
			$result101 =  $db->Execute($query101);
			$row=$result101->fields;
			
			//echo $open.'&nbsp;'.$closed.'&nbsp;'.$hold;
	   ?></td>
        <td colspan="2"><span class="red2">Unread:</span>
          <?php  echo  $row[0];?>
          <img src="images/unread.gif" width="14" height="11"> <a href="./tickets2.php?action=list_unread_closed">details</a> </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2"> <strong>Total Hold:</strong> <?php echo  $hold;  ?></td>
      </tr>
      <tr>
        <td><?php
	 // $user=$_GET['username'];	 
  $query101 = "SELECT  count(unread_admin)as total FROM tickets_tickets,tickets_state,users
	  WHERE unread_admin='1'
	  AND tickets_state.id=tickets_tickets.tickets_id 
	  AND tickets_status='2'	  
	  AND tickets_tickets.tickets_admin=users.username";
			$result101 = $db->Execute($query101);
			$row=$result101->fields;
			
			//echo $open.'&nbsp;'.$closed.'&nbsp;'.$hold;
	   ?></td>
        <td colspan="2"><span class="red2">Unread:</span>
            <?php  echo  $row[0];?>
            <img src="images/unread.gif" width="14" height="11"> </td>
      </tr>
      <tr>
        <td><?php 
		$query101 = "SELECT  count(*)as total FROM tickets_tickets,tickets_state 
	  WHERE
	   tickets_tickets.tickets_child='0'
	  and tickets_state.`id`=tickets_tickets.`tickets_id`
       and `tickets_state`.`tickets_status` > '2' ";
   			$result101 = $db->Execute($query101);
			$row=$result101->fields;		
		?>          &nbsp;</td>
        <td colspan="2">Spam: <?php $spamd=$row[0]; echo $spamd; ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2"><p><strong>Total:</strong> <?php echo  $open+$closed+$hold+$spamd; ?></p>
            <p>&nbsp;</p></td>
      </tr>
    </table>      
</td>
    <td height="197" colspan="2"  valign="top">
      <?php
     $query_users="SELECT distinct users.username,users.name from	users,users_staff     where users_staff.userx=users.id";	 
	$result_users  = $db->Execute($query_users);  
 ?>      <table width="95%"  border="0" cellpadding="0" cellspacing="0"  class="tables">
        <tr class="headertable">
          <td height="19"  colspan="3"><p align="center"><strong>Tickets Assigned and Open </strong></p></td>
        </tr>
        <tr>
          <td>Username</td>
          <td>Name</td>
          <td ><span class="ListView"><img src="images/assigned.png" alt="Assigned to individual staff member" width="35" height="20"></span></td>
        </tr>
        <tr>
          <?php
         
         $n=0; 
		
   do { 
   
   $filaff=$result_users->fields;
   $result_users->MoveNext();
   ?>
          <td>&nbsp;
              <?php
	echo $username=$filaff[0];
    $name=$filaff[1];	
     ?>
          </td>
          <td><?php
	echo $filaff[1];
     ?></td>
          <td width="26%"><?php
	 $query1="SELECT  count(c.tickets_status) as suma
		  from	users,  tickets_state c
		  where 
		   		  
 		  c.tickets_status='1'
		  and c.assigned_to='$username'
		  and users.username='$username'";	 	  
	$result1  = $db->Execute($query1); 
	$filatemp1=$result1->fields;
	echo $filatemp1[0];
    ?></td>
        </tr>
        <?php } while (!$result_users->EOF); ?>
    </table>      <p>&nbsp;</p></td>
    <td valign="top"><table width="95%"  border="0" cellpadding="0" cellspacing="0" class="tables">
      <tr class="headertable">
        <td height="22">&nbsp;</td>
        <td colspan="2"><strong>Tickets Submissions by departament:
              <?php
		 $query1="SELECT b.tickets_categories_name,count(a.tickets_child) as suma from
         tickets_tickets a,tickets_categories b,tickets_state c
		  where 
		  a.tickets_child=0         
         and b.tickets_categories_id=a.tickets_category
		 and a.tickets_id=c.id 
      GROUP by b.tickets_categories_name";
	$request5=$db->Execute($query1);

	 ?>
        </strong></td>
      </tr>
      <?php
	  $n=0;
 	    unset( $slice);
       unset($itemName);
 
  do
  {
  	$row=$request5->fields;
	$request5->MoveNext();
	
  $slice[$n]=$row[1];
  $itemName[$n]=$row[0];
    $n +=1;
  ?>
      <tr>
        <td> -</td>
        <td>&nbsp;<?php echo $row[0].': ';  ?></td>
        <td><?php echo $row[1];  ?></td>
      </tr>
      <?php }
while (	!$request5->EOF)
	?>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>      
    </td>
  </tr>
  <tr>
    <td colspan="2"  valign="top"><?php 
	$slice[0]=$open;
	$itemName[0]='Open';
	
	$slice[1]=$closed;
	$itemName[1]='Closed';
	
	 $slice[2]=$hold;
	$itemName[2]='Hold';
	
	 $slice[3]=$spamd;
	$itemName[3]='SPAM';	
	
     $save_to='images/map1.png';
	 if (function_exists("gd_info"))
	 {
	  include('includes/pieChart.php');
	  $gdyes=TRUE;
	 }
	$tt=mktime();
	?>
    <img src="images/map1.png?<?php echo $tt  ?>" <?php if ($gdyes<>TRUE)
{ echo 'width=\"1\" height=\"1\"';} ?>></td>
    <td colspan="2" valign="top"><?php

	   
     $save_to='images/map2.png';
	 if (function_exists("gd_info"))
	{
	include('includes/pieChart.php');
    $gdyes=TRUE;
	}
	?>
    <img src="images/map2.png?<?php echo $tt  ?>" <?php if ($gdyes<>TRUE)
{ echo 'width=\"1\" height=\"1\"';} ?>></td>
  </tr>
  <tr>
    <td valign="top"><table width="90%" "border="0" cellpadding="0" cellspacing="0" class="tables"    style=" margin-bottom:10px">
      <tr class="headertable">
        <td height="23">&nbsp;</td>
        <td><strong>Total of users </strong></td>
        <td><?php 
		$query101 = "SELECT    count(*) FROM users
		WHERE
		 users.admin='User'
		 UNION ALL		 
		 SELECT    count(*) FROM users
		WHERE
		 users.admin='User' AND status='1'
		 UNION ALL		 
		 SELECT    count(*) FROM users
		WHERE
		 users.admin='User' AND status='0'
		 UNION ALL
		 SELECT    count(*) FROM users
		WHERE
		 users.admin='Mod'
		 UNION ALL
		 SELECT    count(*) FROM users
		WHERE
		 users.admin='Admin'
		 
		 
		 ";
	 	$result101 = $db->Execute($query101);
		$row_result=$result101->fields;		
		?>
&nbsp;</td>
      </tr>
      <tr>
        <td rowspan="3">&nbsp;</td>
        <td colspan="2">End Users :
            <?php 
		echo $row_result[0];
		?></td>
      </tr>
      <tr>
        <td colspan="2">Active users :
            <?php 
			$result101->MoveNext();
		$row_result=$result101->fields;
		echo $row_result[0];
		?></td>
      </tr>
      <tr>
        <td colspan="2">Suspended users :
            <?php 
			$result101->MoveNext();
		$row_result=$result101->fields;
		echo $row_result[0];
		?></td>
      </tr>
      <tr>
        <td rowspan="2">&nbsp;</td>
        <td colspan="2">Sfaff members :
            <?php 
			$result101->MoveNext();
		$row_result=$result101->fields;
		echo $row_result[0];
		?></td>
      </tr>
      <tr>
        <td colspan="2">Administrators:
            <?php 
			$result101->MoveNext();
		$row_result=$result101->fields;
		echo $row_result[0];
		?></td>
      </tr>
    </table></td>
    <td colspan="2" valign="top"><table width="95%" border="0" cellpadding="0" cellspacing="0" class="tables">
        <tr class="headertable">
          <td width="65%" colspan="2"><span class="Estilo1"><strong>Users with more tickets</strong>
            <?php
    $query101 = "SELECT username,name, count(*)as total FROM tickets_tickets,users
     WHERE    tickets_tickets.tickets_username=users.username
	   and tickets_tickets.tickets_child=0
	    group by username
      order by total desc limit 100 ";
	 //decia users.admin='User'  AND
	  if ($dbms=='mssql')
	 {
	     $query101 = "SELECT top 100 username,name, count(*)as total FROM tickets_tickets,users
     WHERE    tickets_tickets.tickets_username=users.username
	   and tickets_tickets.tickets_child=0
	    group by username,name   order by total desc ";

	 }
			   $db->SetFetchMode(ADODB_FETCH_NUM);
			   
			$result101 = $db->Execute($query101);
			
	   ?>
          </span></td>
          <td width="35%"><span class="comment3">(Limit 100)</span></td>
        </tr>
        <tr>
          <td class="text">Username</td>
          <td>Name</td>
          <td><span class="Estilo1">Total</span></td>
        </tr>
        <?php do
		{$row=$result101->fields;
		$result101->MoveNext();
		?>
        <tr class="text">
          <td ><?php echo $row[0]; ?>&nbsp;</td>
          <td><?php echo $row[1]; ?></td>
          <td><div align="right"><a href="./tickets2.php?search_user&username=<?php echo $row[0]; ?>"><?php echo $row[2];  ?></a>&nbsp;</div></td>
        </tr>
        <?php 
		}
		while(!$result101->EOF)
		?>
    </table></td>
    <td valign="top"><table width="95%" border="0" cellpadding="0" cellspacing="0" bordercolor="#F4F4F4" class="tables">
      <tr class="headertable">
        <td height="23" colspan="2"><span class="Estilo1"><strong>Users with more posts</strong>          <?php
    if ($dbms=='mysql')
	{
	$query101 = "SELECT username,name, count(*)as total FROM tickets_tickets,users
     WHERE 	   tickets_tickets.tickets_admin=users.username group by username  order by total desc limit 100 ";
	 }
	 if ($dbms=='mssql')
	 {
	 $query101 = "SELECT top 100 username,name, count(*)as total FROM tickets_tickets,users    WHERE 
		   tickets_tickets.tickets_admin=users.username group by username,name  order by total desc";
	 }
	 
			  $db->SetFetchMode(ADODB_FETCH_NUM);
			$result101 = $db->Execute($query101);

	   ?>
        </span></td>
        <td width="17%"><span class="comment3">(Limit 40)</span></td>
      </tr>
      <tr>
        <td width="34%" class="text">Username</td>
        <td width="49%">Name</td>
        <td><span class="Estilo1">Total</span></td>
      </tr>
      <?php do
		{
		$row=$result101->fields;
		$result101->MoveNext();
		?>
      <tr class="text">
        <td ><?php echo $row[0]; ?>&nbsp;</td>
        <td><?php echo $row[1]; ?></td>
        <td><div align="right"><a href="./tickets2.php?search_user&username=<?php echo $row[0]; ?>"><?php echo $row[2];  ?></a>&nbsp;
          </div>
          <div align="right"></div></td>
      </tr>
      <?php 
		}
		while( !$result101->EOF)
		?>
    </table></td>
  </tr>
  <tr>
    <td colspan="4"><table  class="report" width="98%"  border="0" cellspacing="1" cellpadding="0">
      <tr  >
        <td colspan="4"  ><strong><img src="images/timer.gif" width="30" height="27">Last Cron job operation</strong> (email=&gt; tickets) <?php 
			$query1="SELECT * FROM error_log ORDER BY timestamp DESC LIMIT 10";
			if ($dbms=='mssql')
			{
			$query1="SELECT top 100 * FROM error_log ORDER BY timestamp DESC";
			}
			
	$result1  = $db->Execute($query1);

		?> last 10 actions </td>
        </tr>
      <tr  >
        <td width="10%" class="report1"  >ID</td>
        <td width="57%" class="report1"  >Action/error</td>
        <td width="15%" class="report1"  >Time</td>
        <td width="18%" class="report1"  >Processing time (s) </td>
      </tr>
      <tr>
        <?php 

	do
	{
	  $fila1=$result1->fields;
	  $result1->MoveNext();
	?>
        <td><?php echo $fila1[0]; ?></td>
        <td><?php echo $fila1[1]; ?></td>
        <td><span class="boxborder text"><?php echo date($dformat, $fila1[2]).' '.date('H:i:s', $fila1[2]) ?></span></td>
        <td><span class="boxborder text"><?php echo $fila1[3] ?></span></td>
      </tr>
    <?php 
  }
  while ( !$result1->EOF);
  ?> <tr>
        <td><a href="tickets2.php?action=empip">more</a></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>