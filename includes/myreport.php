<?php
if ($authz<>'TRUE') exit;
?>
<script src="includes/calendarDateInput.js">
</script>
<div align="center">
  <p>&nbsp;</p>
  Daily tickets for user <?php if (  isset($reportA))
{
 $username=$_SESSION['xcv_userna'];
 echo  $username;
 ?> (last 30 days)
</div>
<?php
for ($ww=0;$ww <=30; $ww=$ww+1)
{
 ?>
<table width="635"  border="0" align="center" cellpadding="0" cellspacing="1"  class="report">
  <tr>
    <td class="report1" colspan="4"><p align="center"><strong>
        <?php 
	$sql="select DATE_ADD(CURDATE(), INTERVAL -$ww DAY)";
	$resultd = $db->Execute($sql);
	$e=$resultd->fields;
	echo $e[0];
	$lafecha=$e[0];
	
	?>
    </strong></p></td>
  </tr>
  <tr>
    <td  class="report2">Opened</td>
    <td  class="report2">Closed(resolved) </td>
    <td  class="report2">Hold</td>
    <td  class="report2">  Tickets created &amp; waiting response:(<img src="./images/unread.gif" width="14" height="11">+<img src="./images/read.gif" width="15" height="12">):<strong> 
      <?php
	  $query1=" SELECT   count(DISTINCT(tickets_tickets.tickets_id) )
from users,
 tickets_state, tickets_tickets
where tickets_tickets.tickets_id=tickets_state.id
and tickets_state.tickets_status='1'
and tickets_tickets.tickets_child='0'
and tickets_tickets.tickets_timestamp
BETWEEN UNIX_TIMESTAMP('$lafecha' )  AND (   UNIX_TIMESTAMP( '$lafecha'   ) +86400)";	 	  
	$result1  = $db->Execute($query1); 
	$filatemp1=$result1->fields;
	echo $filatemp1[0];
	
    ?>
    </strong></td>
  </tr>
  <tr>
    <?php
	
         $n=-1; 
		
    ?>
    <td>&nbsp;
        <?php  $query1=" SELECT   count(DISTINCT(tickets_tickets.tickets_id) )
from users,
 tickets_state, tickets_tickets
where tickets_state.opened_by=users.username
and tickets_tickets.tickets_id=tickets_state.id
and tickets_state.tickets_status='1'
and tickets_tickets.tickets_child='0'
and users.username= '$username'
and tickets_tickets.tickets_timestamp
BETWEEN UNIX_TIMESTAMP( '$lafecha')  AND (   UNIX_TIMESTAMP( '$lafecha'   ) +86400)";	 	  
	$result1  = $db->Execute($query1); 
	$filatemp1=$result1->fields;
	echo $filatemp1[0];
    ?>
    </td>
    <td>&nbsp; <?php  $query1=" SELECT   count(DISTINCT(tickets_tickets.tickets_id) )
from users,
 tickets_state, tickets_tickets
where tickets_state.opened_by=users.username
and tickets_tickets.tickets_id=tickets_state.id
and tickets_state.tickets_status='0'
and tickets_tickets.tickets_child='0'
and users.username= '$username'
and tickets_tickets.tickets_timestamp
BETWEEN UNIX_TIMESTAMP( '$lafecha')  AND (   UNIX_TIMESTAMP( '$lafecha'   ) +86400)";	 	  
	$result1  = $db->Execute($query1); 
	$filatemp1=$result1->fields;
	echo $filatemp1[0];
    ?></td>
    <td>&nbsp;        <?php  $query1=" SELECT   count(DISTINCT(tickets_tickets.tickets_id) )
from users,
 tickets_state, tickets_tickets
where tickets_state.opened_by=users.username
and tickets_tickets.tickets_id=tickets_state.id
and tickets_state.tickets_status='2'
and tickets_tickets.tickets_child='0'
and users.username= '$username'
and tickets_tickets.tickets_timestamp
BETWEEN UNIX_TIMESTAMP( '$lafecha')  AND (   UNIX_TIMESTAMP( '$lafecha'   ) +86400)";	 	  
	$result1  = $db->Execute($query1); 
	$filatemp1=$result1->fields;
	echo $filatemp1[0];
    ?></td>
    <td>&nbsp;
        <div align="center"></div></td>
  </tr>
  <?php  ?>
</table>
<?php } ?>
<?php
}
?>