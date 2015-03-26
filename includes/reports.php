<?php
if ($authz<>'TRUE') exit;
?>
<script src="includes/calendarDateInput.js">
</script>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: xx-small;
}
.Estilo2 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>

<div align="center">
  <p><strong><?php  
  //if (isset($_GET[action])  )
  
  if ($_GET['action']=='reports')
  
  {
   ?>Information
</strong></p>
</div>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC">
  <tr>
    <td width="437"><table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#F5F5F0">
        <tr>
          <td><p  class="text"><strong>Tickets<span > <img src="images/unread.gif" alt="Image for a new, Unread ticket" width="14" height="11" hspace="0" border="0"> <img src="images/read.gif" alt="Image for a new, Unread ticket" width="14" height="11" hspace="3" border="0"></span></strong></p>
            <ul><li><span class="text"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=overview">Overview </a> </span>
              <li class="text"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=daily"> <?php echo $rep1; ?></a>
              <li><span class="text"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=tickets_per_assign"><?php echo $rep2; ?></a> </span>
              <li><span class="text"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=tickets_per_departament"><?php echo $rep3; ?></a> </span>
              <li><span class="text"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=tickets_by_prio_status"><?php echo $rep4; ?></a> </span>
              <li><span class="text"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=ticket_by_month"><?php echo $rep5; ?> </a> </span>
              <li><span class="text">Tickets by Date* </span>
                <table border="0" cellpadding="0" cellspacing="0" >
                  <tr>
                    <td><form method=POST action=<?php echo $_SERVER['PHP_SELF'] ?>?action=ticket_by_date>
                        <table class='box'>
                          <tr>
                            <td  class="text" colspan="3"><?php echo $rep6; ?></td>
                          </tr>
                          <tr>
                            <td width="40" class="text"><?php echo $rep7; ?></td>
                                                      <td width="35" class="text"><?php echo $rep8; ?></td>
                                                      <td width="111"></td>
                          </tr>
                          <tr>
                            <td class="text"><script>DateInput('from_date', true, 'MM/DD/YYYY')</script>
                            </td>
                                                      <td class="text"><script>DateInput('until_date', true, 'MM/DD/YYYY')</script>
                                                      </td>
                            <td class="text"><input type='submit' value='Select'>
                            </td>
                          </tr>
                        </table>
                                              <span class="text">
                                              <input type='hidden' name='report_name' value='tickets_by_assignment'>
                                              <input type='hidden' name='do' value='report'>
                                              <a name="1"></a> </span>
                        </form></td>
                  <tr>
                </table>
              </li>
            </ul></td>
        </tr>
        </table></td>
    <td  class="text" valign="top" width="282"><p><strong>Cron related</strong> </p>
      <table width="100%"  style="border-width:1px; border-color:#3366FF; border-style:solid; " border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="184" class="text"><strong>SLA (for_cron_sl.php) </strong>
            <ul>
              <li> <a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=t1_listing">Failed first answer before t1 </a> </li>
              <li> <a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=t2_listing">Failed to solve ticket before t2</a> </li>
              <li><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=t1_percent">% of total tickets</a></li>
            </ul>
            <p><strong>Email piping (for_cron.php) </strong></p>
            <p><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=empip" class="content">Emails =&gt; ticket</a></p></td>
        </tr>
      </table></td>
    <td valign="top"  class="text"><p><strong>Time used</strong></p>
      <form name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?action=time_used">
Ticket id:
<input name="ticket" type="text" id="ticket" size="5"> 
        <input type='submit' value='Select'>
      </form>      <p>&nbsp;</p>
      </td>
  </tr>
  <tr>
    <td height="107"  valign="top" class="text"><p><strong>Staff
  members <span class="text"><strong><span class="ListView"><img src="./images/users.jpg" alt="Image for a new, Unread ticket" width="25" height="27" hspace="3" border="0"></span></strong></span> </strong> </p>
      <ul>
      <li ><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=tickets_rating">Staff rating and polls</a></li>
      <li ><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=tickets_rating#individual">Polls for  Ticket </a></li>
      <li > <a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=tickets_rating5">Tickets Rating</a></li>
      <li ><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=response_time">Response time</a></li>
      </ul></td>
    <td  class="text" valign="top"><p><strong>Banned/SPAM Tickets</strong></p>
      <ul>
        <li><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=home&order=5" ><?php echo $rep9; ?></a></li>
        <li><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=home&order=4" ><?php echo $rep10; ?></a></li>
    </ul></td>
    <td   class="text"  valign="top"><p><strong>Actions<strong><span class="ListView"><img src="./images/users.jpg" alt="Image for a new, Unread ticket" width="25" height="27" hspace="3" border="0"></span></strong></strong></p>
      <ul>
        <li><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=tracking" >Actions tracking </a></li>
        <li><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=esca" >Scalation</a></li>
    </ul></td>
  </tr>
</table>
<strong>
<?php  }
   ?>
</strong>
<p>
  <?php
if (  isset($report1))
{
 ?>
</p>
<table width="70%"  border="0" align="center" cellpadding="0" cellspacing="1"  class="report">
  <tr  >
    <td class="report1"  >&nbsp;</td>
    <td class="report1"  ><strong>Open</strong></td>
    <td class="report1"  ><strong>Closed(resolved)</strong></td>
    <td class="report1"  ><strong>Hold</strong></td>
  </tr>
  <tr>
    <td>Interval from: <?php echo  '<strong>'.$from.' to: '.$until.'</strong>'; ?></td>
    <td><?php
	 $fila=$result1->fields;
	echo $fila[0];
     ?></td>
    <td><?php $fila=$result2->fields;
	echo $fila[0]; ?></td>
    <td><?php $fila=$result3->fields;
	echo $fila[0]; ?></td>
  </tr>
</table>
<?php 
}
?>
<p>
  <?php
  
  $contador=0;
  function retroceder($retroceso)
{
	$ahora=time();
	$mes_now=date("m",$ahora);
	$retrocedi=$mes_now -$retroceso;
	
if ( $retrocedi <= 0 )
{
	$mes_base=12;$ano_salida=date("Y")-1;$mes_salida = 12 + $retrocedi;
	if ( $retrocedi==12) $mes_salida=12;
}
else
{
	$ano_salida=date("Y");$mes_salida=$mes_now - $retroceso;
}

$sa=array();
$sa[0]=$ano_salida;$sa[1]=$mes_salida;
return $sa;
}

  
  
if (  isset($report2))
{
  
 ?>
</p>
<table width="70%"  border="0" align="center" cellpadding="0" cellspacing="0"  class="report">
  <tr> 
  <td  class="report1" colspan="6"><p align="center"><strong>Tickets created by month (last 12 months) </strong></p></td>
  </tr>
  <tr>
    <td width="13%" bgcolor="#D1F2FC" class="report2" ><strong>Year</strong></td>
    <td width="12%" bgcolor="#D1F2FC" class="report2" ><strong>Month</strong></td>
    <td width="24%" class="report2" ><strong>Open</strong></td>
    <td width="19%" class="report2" ><strong>Closed</strong></td>
    <td width="13%" class="report2" ><strong>Hold</strong></td>
    <td width="19%" class="report2" ><strong>SPAM</strong></td>
  </tr>
  <?php
   do
  {
  ?>   
  <tr class="report"><td bgcolor="#D1F2FC" >&nbsp;<?php
  
  	$hh=retroceder($contador);
		
	$ano=$hh[0];
	$mes=$hh[1];
	echo $ano;
	$contador +=1; 
     ?></td>
    <td bgcolor="#D1F2FC">&nbsp;<?php
	echo $mes;

     ?>
	</td>
    <td>&nbsp;
	<?php
		
	$query1="SELECT YEAR( from_unixtime(a.tickets_timestamp) ) as ano1,
	MONTH( from_unixtime(a.tickets_timestamp) ) as mes1,
	count(a.tickets_child) as suma
	from tickets_tickets a,	tickets_state b
	where	a.tickets_child=0
	and b.tickets_status=1 
		and a.tickets_id=b.id 
		and  YEAR( from_unixtime(a.tickets_timestamp) )='$ano'
		and
		MONTH( from_unixtime(a.tickets_timestamp) )  = '$mes' group by ano1";
		
		if ($dbms=='mssql')
		{	
		$query1="SELECT YEAR(  dateadd(ss, a.tickets_timestamp, '19700101')    ) as ano1,
	 MONTH(  dateadd(ss, a.tickets_timestamp, '19700101')   ) as mes1,
	count(a.tickets_child) as suma
	from tickets_tickets a,	tickets_state b
	where	a.tickets_child=0
	and b.tickets_status=1 
		and a.tickets_id=b.id 
		and   year(    dateadd(ss, a.tickets_timestamp, '19700101')   )  ='$ano'
		and	MONTH(   dateadd(ss, a.tickets_timestamp, '19700101') )  = '$mes' 
		group by YEAR(  dateadd(ss, a.tickets_timestamp, '19700101') ),
     MONTH(  dateadd(ss, a.tickets_timestamp, '19700101') )
      ";		
		}  
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
	$result_u  = $db->Execute($query1); //assoc
     $fila1=$result_u->fields;
	 	echo $fila1['suma']+0; //tickets abiertos

	
    ?>
    </td>
    <td>&nbsp;
	<?php 
	$query1="SELECT YEAR( from_unixtime(a.tickets_timestamp) ) as ano1,
	MONTH( from_unixtime(a.tickets_timestamp) ) as mes1,
	count(a.tickets_child) as suma
	from tickets_tickets a,	tickets_state b
	where	a.tickets_child=0
	and b.tickets_status=0 
		and a.tickets_id=b.id 
		and  YEAR( from_unixtime(a.tickets_timestamp) )='$ano'
		and
		MONTH( from_unixtime(a.tickets_timestamp) )  = '$mes' group by ano1";
		
		
		if ($dbms=='mssql')
		{	
		$query1="SELECT YEAR(  dateadd(ss, a.tickets_timestamp, '19700101')    ) as ano1,
	 MONTH(  dateadd(ss, a.tickets_timestamp, '19700101')   ) as mes1,
	count(a.tickets_child) as suma
	from tickets_tickets a,	tickets_state b
	where	a.tickets_child=0
	and b.tickets_status=0 
		and a.tickets_id=b.id 
		and   year(    dateadd(ss, a.tickets_timestamp, '19700101')   )  ='$ano'
		and	MONTH(   dateadd(ss, a.tickets_timestamp, '19700101') )  = '$mes' 
		group by YEAR(  dateadd(ss, a.tickets_timestamp, '19700101') ),
     MONTH(  dateadd(ss, a.tickets_timestamp, '19700101') )
      ";		
		}  
		
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
	$result_u  =  $db->Execute($query1);
     $fila1=$result_u->fields;
 	echo $fila1['suma']+0; //tickets abiertos	

	?>
	</td>
    <td>&nbsp;<?php 	$query1="SELECT YEAR( from_unixtime(a.tickets_timestamp) ) as ano1,
	MONTH( from_unixtime(a.tickets_timestamp) ) as mes1,
	count(a.tickets_child) as suma
	from tickets_tickets a,	tickets_state b
	where	a.tickets_child=0
	and b.tickets_status=2 
		and a.tickets_id=b.id 
		and  YEAR( from_unixtime(a.tickets_timestamp) )='$ano'
		and
		MONTH( from_unixtime(a.tickets_timestamp) )  = '$mes' group by ano1";	
		
		if ($dbms='mssql')
		{	
		$query1="SELECT YEAR(  dateadd(ss, a.tickets_timestamp, '19700101')    ) as ano1,
	 MONTH(  dateadd(ss, a.tickets_timestamp, '19700101')   ) as mes1,
	count(a.tickets_child) as suma
	from tickets_tickets a,	tickets_state b
	where	a.tickets_child=0
	and b.tickets_status=2 
		and a.tickets_id=b.id 
		and   year(    dateadd(ss, a.tickets_timestamp, '19700101')   )  ='$ano'
		and	MONTH(   dateadd(ss, a.tickets_timestamp, '19700101') )  = '$mes' 
		group by YEAR(  dateadd(ss, a.tickets_timestamp, '19700101') ),
     MONTH(  dateadd(ss, a.tickets_timestamp, '19700101') )
      ";		
		}  
		
	$db->SetFetchMode(ADODB_FETCH_ASSOC);
	$result_u  =  $db->Execute($query1);
     $fila1=$result_u->fields;
 	echo $fila1['suma']+0; //tickets abiertos

	
 ?></td>	
    <td><?php
		
	$query1="SELECT YEAR( from_unixtime(a.tickets_timestamp) ) as ano1,
	MONTH( from_unixtime(a.tickets_timestamp) ) as mes1,
	count(a.tickets_child) as suma
	from tickets_tickets a,	tickets_state b
	where	a.tickets_child=0
	and b.tickets_status>=2 
		and a.tickets_id=b.id 
		and  YEAR( from_unixtime(a.tickets_timestamp) )='$ano'
		and
		MONTH( from_unixtime(a.tickets_timestamp) )  = '$mes' group by ano1";
		
		if ($dbms='mssql')
		{	
		$query1="SELECT YEAR(  dateadd(ss, a.tickets_timestamp, '19700101')    ) as ano1,
	 MONTH(  dateadd(ss, a.tickets_timestamp, '19700101')   ) as mes1,
	count(a.tickets_child) as suma
	from tickets_tickets a,	tickets_state b
	where	a.tickets_child=0
	and b.tickets_status>2 
		and a.tickets_id=b.id 
		and   year(    dateadd(ss, a.tickets_timestamp, '19700101')   )  ='$ano'
		and	MONTH(   dateadd(ss, a.tickets_timestamp, '19700101') )  = '$mes' 
		group by YEAR(  dateadd(ss, a.tickets_timestamp, '19700101') ),
     MONTH(  dateadd(ss, a.tickets_timestamp, '19700101') )
      ";		
		}  
		
$db->SetFetchMode(ADODB_FETCH_ASSOC);
	$result_u  = $db->Execute($query1);
     $fila1=$result_u->fields;
	 	echo $fila1['suma']+0; //tickets abiertos

	
    ?></td>
  </tr>  
  <?php } while ( $contador<=12) ?>
</table>
<?php 
}
?>
<p>
  <?php
  
  $contador=0;

  
  
if (  isset($reportT_percent))
{
  
 ?>
</p>
<table width="70%"  border="0" align="center" cellpadding="0" cellspacing="0"  class="report">
  <tr>
    <td  class="report1" colspan="5"><p align="center"><strong>Tickets created and SLA</strong></p></td>
  </tr>
  <tr>
    <td width="13%" bgcolor="#D1F2FC" class="report2" ><strong>Year</strong></td>
    <td width="12%" bgcolor="#D1F2FC" class="report2" ><strong>Month</strong></td>
    <td width="24%" class="report2" ><strong>Created</strong></td>
    <td width="19%" class="report2" ><strong>Failed T1</strong></td>
    <td width="13%" class="report2" ><strong>Failed T2</strong></td>
  </tr>
  <?php
   do
  {
  ?>
  <tr class="report">
    <td bgcolor="#D1F2FC" >&nbsp;
        <?php
  
  	$hh=retroceder($contador);
		
	$ano=$hh[0];
	$mes=$hh[1];
	echo $ano;
	$contador +=1; 
     ?></td>
    <td bgcolor="#D1F2FC">&nbsp;
        <?php
	echo $mes;

     ?>
    </td>
    <td>&nbsp;
        <?php
		
	$query1="SELECT YEAR( from_unixtime(a.tickets_timestamp) ) as ano1,
	MONTH( from_unixtime(a.tickets_timestamp) ) as mes1,
	count(a.tickets_child) as suma
	from tickets_tickets a,	tickets_state b
	where	a.tickets_child=0
	and b.tickets_status=1 
		and a.tickets_id=b.id 
		and  YEAR( from_unixtime(a.tickets_timestamp) )='$ano'
		and
		MONTH( from_unixtime(a.tickets_timestamp) )  = '$mes' group by ano1";
		
		if ($dbms=='mssql')
		{	
		$query1="SELECT YEAR(  dateadd(ss, a.tickets_timestamp, '19700101')    ) as ano1,
	 MONTH(  dateadd(ss, a.tickets_timestamp, '19700101')   ) as mes1,
	count(a.tickets_child) as suma
	from tickets_tickets a,	tickets_state b
	where	a.tickets_child=0
	and b.tickets_status=1 
		and a.tickets_id=b.id 
		and   year(    dateadd(ss, a.tickets_timestamp, '19700101')   )  ='$ano'
		and	MONTH(   dateadd(ss, a.tickets_timestamp, '19700101') )  = '$mes' 
		group by YEAR(  dateadd(ss, a.tickets_timestamp, '19700101') ),
     MONTH(  dateadd(ss, a.tickets_timestamp, '19700101') )
      ";		
		}  
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
	$result_u  = $db->Execute($query1); //assoc
     $fila1=$result_u->fields;
	 	echo $fila1['suma']+0; //tickets abiertos

	
    ?>
    </td>
    <td>&nbsp;
        <?php 
	 $query1="SELECT YEAR( from_unixtime(a.tickets_timestamp) ) as ano1,
	MONTH( from_unixtime(a.tickets_timestamp) ) as mes1,
	count(a.tickets_child) as suma
	from tickets_tickets a,	tickets_state b
	where	a.tickets_child=0
			and a.tickets_id=b.id 
		and  YEAR( from_unixtime(a.tickets_timestamp) )='$ano'
		and
		MONTH( from_unixtime(a.tickets_timestamp) )  = '$mes' group by ano1";
		
		
		if ($dbms=='mssql')
		{	
		 $query1="SELECT YEAR(  dateadd(ss, a.tickets_timestamp, '19700101')    ) as ano1,
	 MONTH(  dateadd(ss, a.tickets_timestamp, '19700101')   ) as mes1,
	count(a.tickets_child) as suma
	from tickets_tickets a,	tickets_state b
	where	a.tickets_child=0
			and a.tickets_id=b.id 
		and   year(    dateadd(ss, a.tickets_timestamp, '19700101')   )  ='$ano'
		and	MONTH(   dateadd(ss, a.tickets_timestamp, '19700101') )  = '$mes' 
		group by YEAR(  dateadd(ss, a.tickets_timestamp, '19700101') ),
     MONTH(  dateadd(ss, a.tickets_timestamp, '19700101') )
      ";		
		}  
		
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
	$result_u  =  $db->Execute($query1);
     $fila1=$result_u->fields;
 	 $total_tickets= $fila1['suma']+0; //tickets abiertos
  	$query_cc="SELECT count(*) FROM sla_t1  where  YEAR( from_unixtime(created) ) ='$ano' and   MONTH( from_unixtime(created) ) = '$mes'  ";	
	$db->SetFetchMode(ADODB_FETCH_NUM);
	$result_cc  =  $db->Execute($query_cc);
	$vbg=$result_cc->fields;
	$nju=$vbg[0];
	$total_tickets=$total_tickets+0.0000001;
	echo  round( ($nju*100)/$total_tickets,2).'%';
	
	?>
    </td>
    <td>&nbsp; <?php 
	 $query1="SELECT YEAR( from_unixtime(a.tickets_timestamp) ) as ano1,
	MONTH( from_unixtime(a.tickets_timestamp) ) as mes1,
	count(a.tickets_child) as suma
	from tickets_tickets a,	tickets_state b
	where	a.tickets_child=0
			and a.tickets_id=b.id 
		and  YEAR( from_unixtime(a.tickets_timestamp) )='$ano'
		and
		MONTH( from_unixtime(a.tickets_timestamp) )  = '$mes' group by ano1";
		
		
		if ($dbms=='mssql')
		{	
		 $query1="SELECT YEAR(  dateadd(ss, a.tickets_timestamp, '19700101')    ) as ano1,
	 MONTH(  dateadd(ss, a.tickets_timestamp, '19700101')   ) as mes1,
	count(a.tickets_child) as suma
	from tickets_tickets a,	tickets_state b
	where	a.tickets_child=0
			and a.tickets_id=b.id 
		and   year(    dateadd(ss, a.tickets_timestamp, '19700101')   )  ='$ano'
		and	MONTH(   dateadd(ss, a.tickets_timestamp, '19700101') )  = '$mes' 
		group by YEAR(  dateadd(ss, a.tickets_timestamp, '19700101') ),
     MONTH(  dateadd(ss, a.tickets_timestamp, '19700101') )
      ";		
		}  
		
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
	$result_u  =  $db->Execute($query1);
     $fila1=$result_u->fields;
 	 $total_tickets= $fila1['suma']+0; //tickets abiertos
  	$query_cc="SELECT count(*) FROM sla_t2  where  YEAR( from_unixtime(created) ) ='$ano' and   MONTH( from_unixtime(created) ) = '$mes'  ";	
	$db->SetFetchMode(ADODB_FETCH_NUM);
	$result_cc  =  $db->Execute($query_cc);
	$vbg=$result_cc->fields;
	$nju=$vbg[0];
	$total_tickets=$total_tickets+0.0000001;
	echo  round( ($nju*100)/$total_tickets,2).'%';
	
	
	?></td>
  </tr>
  <?php } while ( $contador<=12) ?>
</table>
<?php 
}
?>
<p>
  <?php
if (  isset($report3))
{
 $query1="SELECT b.tickets_categories_id, b.tickets_categories_name from	  tickets_categories b";
  $db->SetFetchMode(ADODB_FETCH_NUM);
 $departaments=$db->Execute($query1);	 
  
 ?>
</p>
<table width="70%"  border="0" align="center" cellpadding="0" cellspacing="1"  class="report">
  <tr>
    <td  class="report1" colspan="7"><p align="center"><strong>Tickets by Departament</strong></p></td>
  </tr>
  <tr>
    <td colspan="2" rowspan="2" class="report2"><div align="center"><strong>Departament( N&ordm;  Members)</strong></div></td>
    <td colspan="2" class="report2"><div align="center"><strong>Open</strong></div></td>
    <td  width="23%" rowspan="2" class="report2"><div align="center"><strong>Closed</strong></div></td>
    <td width="9%" rowspan="2"  class="report2"><div align="center"><strong>Hold</strong></div></td>
    <td width="8%" rowspan="2"  class="report2"><div align="center"><strong>Total</strong></div></td>
  </tr>
  <tr>
    <td width="12%" class="report2">Unreaded <span class="ListView"><img src="images/unread.gif" alt="Image for a new, Unread ticket" width="14" height="11" border="0"></span></td>
    <td width="11%" class="report2">Opened<span class="ListView"> <img src="images/read.gif" alt="Image for a new, Unread ticket" width="14" height="11" border="0"></span></td>
  </tr>
   <?php 

   $zz=0;
  do {
     $departamento=$departaments->fields;  
	 $departaments->MoveNext();
     $id_depa=$departamento[0];  
  ?> 
  <tr>
    <td width="23%">&nbsp;<?php
	echo $departamento[1];//dep
     ?> </td>
    <td width="14%">(<?php	
    $query1="SELECT  count(users_staff.userx) as suma from		  
         users_staff  where  departament = $id_depa";
		 	$db->SetFetchMode(ADODB_FETCH_NUM);
	$result1  = $db->Execute($query1);
		$filagg=$result1->fields;
		echo $fila1=$filagg[0];
    ?>)</td>
    <td>&nbsp;<?php	
	  $query1="SELECT  count(a.tickets_child) as suma from		  
         tickets_tickets a,tickets_categories b,tickets_state c
		  where 
		  a.tickets_child=0 
         and c.tickets_status=1 
         and b.tickets_categories_id='$id_depa'
		 and a.tickets_id=c.id
		 and a.tickets_category='$id_depa'
		 and a.unread_admin='1'
		 ";
	$db->SetFetchMode(ADODB_FETCH_NUM);
	$result1  = $db->Execute($query1);
		$filagg=$result1->fields;
		echo $fila1=$filagg[0];
    ?>
    </td>
    <td><?php	
	  $query1="SELECT  count(a.tickets_child) as suma from		  
         tickets_tickets a,tickets_categories b,tickets_state c
		  where 
		  a.tickets_child=0 
         and c.tickets_status=1 
         and b.tickets_categories_id='$id_depa'
		 and a.tickets_id=c.id
		 and a.tickets_category='$id_depa' ";
	$db->SetFetchMode(ADODB_FETCH_NUM);
	$result1  = $db->Execute($query1);
	$filagg=$result1->fields;
		echo $fila1=$filagg[0];
    ?></td>
    <td>&nbsp;
    <?php	
	  $query1="SELECT  count(a.tickets_child) as suma from		  
         tickets_tickets a,tickets_categories b,tickets_state c
		  where 
		  a.tickets_child=0 
         and c.tickets_status=0 
         and b.tickets_categories_id='$id_depa'
		 and a.tickets_id=c.id
		 and a.tickets_category='$id_depa' ";
		 $db->SetFetchMode(ADODB_FETCH_NUM);
	$result1  = $db->Execute($query1);
	$filagg=$result1->fields;
		echo $fila2=$filagg[0];
    ?></td>
    <td>&nbsp;
    <?php	
	  $query1="SELECT  count(a.tickets_child) as suma from		  
         tickets_tickets a,tickets_categories b,tickets_state c
		  where 
		  a.tickets_child=0 
         and c.tickets_status=2 
         and b.tickets_categories_id='$id_depa'
		 and a.tickets_id=c.id
		 and a.tickets_category='$id_depa' ";
		 $db->SetFetchMode(ADODB_FETCH_NUM);
	$result1  = $db->Execute($query1);
	$filagg=$result1->fields;		 
		echo $fila3=$filagg[0];	
    ?></td>
    <td><div align="center"><?php 
	$xx=$fila1+$fila2+$fila3;
	$zz=$zz+1;
	echo $xx; 
	$slice[$zz]=$xx;
    $itemName[$zz]=$departamento[1];
	?>
    </div></td>	
  </tr>
  <?php } while(!$departaments->EOF)  ?>
</table>
<?php 
     $save_to='images/map2.png';
	 if (function_exists("gd_info"))
	 {
	 $anchopng=500;
	include('includes/pieChart.php');
	}
	$tt=mktime();
	?>
<img src="images/map2.png?<?php echo $tt  ?>">
<?php
}
?>
<p>
  <?php
if (  isset($report_prior_state))
{
 $queryu="Select c.id,c.name 	from tickets_levels c 	 order BY c.name"; 	   	   
	$resultu  =  $db->Execute($queryu);

 ?>
</p>
<table width="70%"  border="0" align="center" cellpadding="0" cellspacing="0"  class="report">
  <tr>
    <td  class="report1" colspan="5"><p align="center"><strong> Tickets by Priority vs Status</strong></p></td>
  </tr>
  <tr>
    <td class="report2"  width="37%"><div align="center"><strong>Priority</strong></div></td>
    <td class="report2" width="23%"><div align="center"><strong>Open</strong></div></td>
    <td class="report2"  width="23%"><div align="center"><strong>Closed</strong></div></td>
    <td  class="report2" width="9%"><div align="center"><strong>Hold</strong></div></td>
    <td  class="report2" width="8%"><div align="center"><strong>Total</strong></div></td>
  </tr>
  <?php 
  do
  {
  $nivel=$resultu->fields;
  $resultu->MoveNext();
  ?>
  <tr> <td>&nbsp; <?php
	echo $nivel['name'];
	$lev=$nivel['id']; //tiene el ID
     ?>
    </td>
    <td>&nbsp;
        <?php	
 	$query2="Select  count(  (b.id))	from tickets_tickets a ,tickets_state b
	where  b.tickets_status='1'  AND	b.id=a.tickets_id	AND
	a.tickets_child=0	AND 	a.tickets_urgency='$lev' ";
	$db->SetFetchMode(ADODB_FETCH_NUM);
	$result2  = $db->Execute($query2);
	$rr=$result2->fields;
	echo $rr[0];
	$vv1=$rr[0];
 ?>
    </td>
    <td><?php	
 	$query2="Select  count(  (b.id))	from tickets_tickets a ,tickets_state b
	where  b.tickets_status='0'  AND	b.id=a.tickets_id	AND
	a.tickets_child=0	AND 	a.tickets_urgency='$lev' ";
	$db->SetFetchMode(ADODB_FETCH_NUM);
	$result2  = $db->Execute($query2);
	$rr=$result2->fields;
	echo $rr[0];
	$vv2=$rr[0];	
 ?>
    </td>
    <td><?php	
 	$query2="Select  count(  (b.id))	from tickets_tickets a ,tickets_state b
	where  b.tickets_status='2'  AND	b.id=a.tickets_id	AND
	a.tickets_child=0	AND 	a.tickets_urgency='$lev' ";
		$db->SetFetchMode(ADODB_FETCH_NUM);
	$result2  = $db->Execute($query2);
	$rr=$result2->fields;
	echo $rr[0];
	$vv3=$rr[0]; ?></td>
    <td><div align="center"><?php 
	echo 	$vv1+$vv2+$vv3;
	?>
    </div></td>	
  </tr>
  <?php 
	}
  while ( !$resultu->EOF )
	?> 
</table>
<p>
<?php
 }
?>
  <?php
if (  isset($report4))
{
 $query_users="SELECT distinct users.username,users.name from	users,users_staff
        where users_staff.userx=users.id";
		$db->SetFetchMode(ADODB_FETCH_NUM); 
	$result_users  = $db->Execute($query_users);
	
  
 ?>
</p>
<table width="70%"  border="0" align="center" cellpadding="0" cellspacing="0"  class="report">
  <tr>
    <td class="report1" colspan="7"><p align="center"><strong>Tickets attended/waiting by Staff Members </strong></p></td>
  </tr>
  <tr>
    <td width="18%" class="report1">User</td>
    <td width="16%"  class="report2">Name</td>
    <td  class="report2">Open by first time</td>
    <td  class="report2">Assigned and waiting (unread)<span class="ListView"><img src="images/assigned.png" alt="Assigned to individual staff member" width="35" height="20"></span></td>
    <td width="14%"  class="report2">Closed(resolved)</td>
    <td width="8%"  class="report2">Hold</td>
    <td width="9%"  class="report2">Total</td>
  </tr>
  <tr>
  <?php

         $n=-1; 
		
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
    <td width="9%">&nbsp;
      <?php
	 $query1="SELECT  count(c.tickets_status) as suma
		  from	users,  tickets_state c
		  where c.opened_by=users.username  		  
 		  and c.tickets_status='1'
		  and users.username='$username'";	 	  
	$result1  = $db->Execute($query1); 
	$filatemp1=$result1->fields;
	echo $filatemp1[0];
    ?>
</td>
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
    <td>&nbsp;
        <?php 
	 $query2="SELECT  count(c.tickets_status) as suma
		  from	users,
		  tickets_state c
		  where c.closed_by=users.username  		  
 		  and c.tickets_status='0'
		  and users.username='$username'";	 	  
	$result2  = $db->Execute($query2); 
	$filatemp2=$result2->fields;
	echo $filatemp2[0];
	?>
    </td>
    <td>&nbsp;<?php 
	 $query3="SELECT  count(c.tickets_status) as suma
		  from	users,
		  tickets_state c
		  where c.hold_by=users.username  		  
 		  and c.tickets_status='2'
		  and users.username='$username'";	 	  
	$result3  = $db->Execute($query3); 
	$filatemp3=$result3->fields;
	echo $filatemp3[0];	
	$n =$n+1;
   $slice[$n]=$filatemp1[0] + $filatemp2[0] + $filatemp3[0];
   $itemName[$n]='user: '.$username;	
	?>
	</td>
    <td>  <?php echo $slice[$n]; ?>&nbsp;
      <div align="center"></div></td>
  </tr> <?php } while (!$result_users->EOF); ?>
</table>
<?php
	 
	 $save_to='images/map2.png';
	 if (function_exists("gd_info"))
	 {
	 $anchopng=500;
	include('includes/pieChart.php');
	}
	$tt=mktime().'2';
	?>
<span class="Estilo1">Ref image.</span> <img src="images/map2.png?<?php echo $tt  ?>"> <?php
}
?>
<p>
  <?php
if (  isset($report55))
{
 
  
 ?>
</p>
<table width="70%"  border="1" align="center" cellpadding="0" cellspacing="1"  class="ListView">
  <tr>
    <td colspan="7"><p align="center"><strong>votes (max 5 votes/response), your poll <a href="./includes/polls.php?action=ssertfdgtgh5467hgfgd5434" target="_blank">is:</a> </strong></p></td>
  </tr>
  <tr>
    <td width="10%">Ticket</td>
    <td width="7%">Question 1</td>
    <td width="7%">Question 2 </td>
    <td width="7%">Question 3 </td>
    <td width="7%">Question 4 </td>
    <td width="7%">Question 5 </td>
    <td width="55%">Text</td>
  </tr>
  <?php  
  do   
   { 

   $fila1=$result1->fields;
       $result1->MoveNext();
    ?>
  <tr>
    <td>&nbsp;<?php	echo $fila1['id'];   ?></td>
    <td>&nbsp; <?php echo $fila1['a'];  ?></td>
    <td>&nbsp;   <?php	echo $fila1['b'];  ?>    </td>
    <td>&nbsp;<?php echo $fila1['c']; 	?>
    </td>
    <td>&nbsp; <?php echo $fila1['d'];	?></td>
    <td>&nbsp; <?php 	echo $fila1['e']; ?></td>
    <td>&nbsp;<?php 	echo $fila1['comment'];	?></td>
  </tr><?php  } while (!$result1->EOF) ?>
</table>
<p>  
  <?php
}
?>
  <?php
if (  isset($report5))
{
 $fila1=$result1->fields;
  
 ?>
</p>
<table width="70%"  border="1" align="center" cellpadding="0" cellspacing="1"  class="ListView">
  <tr>
    <td colspan="5"><p align="center"><strong>General Rating of 
      <?php 	echo $fila1[5];?> 
    votes (max 5 votes/response), your  poll <a href="./includes/polls.php?action=ssertfdgtgh5467hgfgd5434" target="_blank">is:</a> </strong></p></td>
  </tr>
  <tr>
    <td>Question 1</td>
    <td>Question 2 </td>
    <td>Question 3 </td>
    <td>Question 4 </td>
    <td>Question 5 </td>
  </tr> 
  <tr>
    <td>&nbsp;      <?php
	echo $fila1[0];
     ?></td>
    <td>&nbsp;
        <?php
	echo $fila1[1]; 
    ?>
    </td>
    <td>&nbsp;
        <?php 
	echo $fila1[2]; 
	?>
    </td>
    <td>&nbsp;
        <?php echo $fila1[3];	?></td>
    <td>&nbsp;<?php 
	echo $fila1[4];
	?></td>
  </tr>
</table>
<br>
<table width="70%"  border="1" align="center" cellpadding="0" cellspacing="1"  class="ListView">
  <tr>
    <td colspan="6"><p align="center"><strong>Rating per Departament of the total of votes. </strong></p></td>
  </tr>
  <tr>
    <td width="18%">Departament</td>
    <td>Question 1</td>
    <td>Question 2 </td>
    <td>Question 3 </td>
    <td>Question 4 </td>
    <td>Question 5 </td>
  </tr>    
  <?php
	do
	{
	$fila1=$result2_rating->fields;
	$result2_rating->MoveNext();
  ?>
  <tr>
    <td>&nbsp;<?php	echo $fila1[0]; ?> </td>
    <td>&nbsp;<?php echo $fila1[1]; ?></td>
    <td>&nbsp;<?php	echo $fila1[2]; ?></td>
    <td>&nbsp;<?php echo $fila1[3]; ?></td>
    <td>&nbsp;<?php echo $fila1[4];	?></td>
    <td>&nbsp;<?php echo $fila1[5]; 	?></td>
  </tr>
  <?php 
	
	}
	while (!$result2_rating->EOF)
	 ?>
</table>
<br>
<table width="70%"  border="1" align="center" cellpadding="0" cellspacing="1"  class="ListView">
  <tr>
    <td colspan="6"><p align="center"><strong>Rating per  Staff Members </strong></p></td>
  </tr>
  <tr>
    <td width="18%">User</td>
    <td>Question 1</td>
    <td>Question 2 </td>
    <td>Question 3 </td>
    <td>Question 4 </td>
    <td>Question 5 </td>
  </tr>
  <?php
   do   
  {
    @$fila1=$result3_rating->fields;
	$result3_rating->MoveNext();
	
  echo '<tr>';
  ?>
  <tr>
    <td>&nbsp;
        <?php
	echo $fila1[0];
     ?>
    </td>
    <td>&nbsp;<?php
	echo $fila1[1];
     ?></td>
    <td>&nbsp;
        <?php
	echo $fila1[2];
    ?>
    </td>
    <td>&nbsp;
        <?php 
	echo $fila1[3];
	?>
    </td>
    <td>&nbsp;
        <?php 
	echo $fila1[4];
	?></td>
    <td>&nbsp;<?php 
	echo $fila1[5];
	?></td>
  </tr>
  <?php 
	
	}
	while ( !$result3_rating->EOF)
	 ?>
</table>
<br>
<table width="90%"  border="1" align="center" cellpadding="0" cellspacing="1"  class="ListView">
  <tr>
    <td colspan="8"><p>Rating per Ticket <?php 
	
	if (   isset($result4_rating) )
	{	
  $fila1=@$result4_rating->fields;
	}	
	?>
	<?php echo $el_ticket; ?><a name="individual"></a></p>
      <form name="form1" method="post" 
	  action="<?php echo $_SERVER['PHP_SELF'] ?>?action=tickets_rating">
Insert Ticket ID
<input name="ticket" type="text" id="ticket">        
<input type="submit" name="Submit" value="Submit">
        <input name="by_ticket" type="hidden" id="by_ticket" value="1">
      </form></td>
  </tr>
  <tr>
    <td width="9%">User</td>
    <td width="9%">Time</td>
    <td>Quest. 1</td>
    <td>Quest. 2 </td>
    <td>Quest. 3 </td>
    <td>Quest. 4 </td>
    <td>Quest. 5 </td>
    <td>Comments</td>
  </tr>  
  <tr>
    <td>&nbsp;
        <?php	
		
	echo $fila1[0]; ?> </td>
    <td><strong><?php echo $average; ?></strong></td>
    <td>&nbsp;<?php	echo $fila1[1]; ?></td>
    <td>&nbsp;  <?php	echo $fila1[2];  ?> </td>
    <td>&nbsp;  <?php 	echo $fila1[3];	?></td>
    <td>&nbsp;  <?php 	echo $fila1[4];	?></td>
    <td>&nbsp;<?php echo $fila1[5];	?></td>
    <td><?php echo $fila1[5];	?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong><?php echo $details; ?>&nbsp;</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php 
  do  
  {
  $registros=$detalle_ticket->fields;   
 ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;<?php echo  date($dformat.' H:i:s',$registros['timestamp'])  ?>&nbsp;</td>
    <td>&nbsp;<?php	echo $registros['a']; ?></td>
	<td> &nbsp; <?php	echo $registros['b']; ?></td>
	<td>&nbsp; <?php	echo $registros['c']; ?></td>
	<td>&nbsp; <?php	echo $registros['d']; ?></td>
	<td>&nbsp; <?php	echo $registros['e']; ?></td>
    <td>&nbsp;<?php echo $registros['comment'];	?></td>
  </tr>
   <?php 
   $detalle_ticket->MoveNext();
   } while (!$detalle_ticket->EOF )
   ?> 
</table>
<?php
}
?>
<p>
  <?php
if (  isset($report6))
{

 ?>
</p>
<table width="70%"  border="0" align="center" cellpadding="0" cellspacing="0"  class="report">
  <tr>
    <td class="report1" colspan="3"><p align="center"><strong>Global  response time of staff members and administrators </strong> </p></td>
  </tr>
  <tr>
    <td class="report1" width="18%">User</td>
    <td  class="report2" width="19%">Name</td>
    <td width="23%"  class="report2">Average Time(minutes)</td>
  </tr>
  <?php 
  do
  {
    $fila1=$result1->fields;  
	$result1->MoveNext();
  ?>
  <tr>
    <td>&nbsp;  <?php	echo $fila1[0];     ?>
    </td>
    <td><?php	echo $fila1[1]; ?></td>
    <td>&nbsp; <?php  printf("%1\$.2f", ($fila1[2]/60)) ;?>
    </td>
  </tr>
  <?php 
	}
while (!$result1->EOF)
	 ?>
</table>
<p>
  <?php
  				
			if ($dbms=='mssql')
			{
			$sql="select CURDATE()";$resultd = $db->Execute($sql); $db->SetFetchMode(ADODB_FETCH_NUM); $e=$resultd->fields;	echo $e[0];			
			} 
  
for ($ww=0;$ww <=30; $ww=$ww+1)
{
 ?>
</p>
<table width="70%"  border="0" align="center" cellpadding="0" cellspacing="0"  class="report">
  <tr>
    <td class="report1" colspan="3"><p align="center"><strong>
        <?php
	if ($dbms=='mysql')
	{
	$sql="select DATE_ADD(CURDATE(), INTERVAL -$ww DAY)";
	$db->SetFetchMode(ADODB_FETCH_NUM);
	$resultd = $db->Execute($sql);
	$e=$resultd->fields;
	$lafecha=$e[0];
	
$query2="SELECT username, name,avg(tickets_timestamp - previous) 
             FROM users left join         tickets_tickets
			 on
             tickets_admin=users.username 
            and users.admin<>'User'
	        where previous <> 0
			and  tickets_tickets.tickets_timestamp BETWEEN UNIX_TIMESTAMP('$lafecha' )  AND (   UNIX_TIMESTAMP( '$lafecha'   ) +86400)  group by username";			
	}
	if ($dbms=='mssql')
	{ //2010-04-29
	$sql=" select CONVERT(CHAR(10), (SELECT DATEADD(dd, -$ww,  GETDATE()  )  )    ,120)   ";	
	$db->SetFetchMode(ADODB_FETCH_NUM);	$resultd = $db->Execute($sql);
		$e=$resultd->fields;
	echo $e[0];
	$lafecha=$e[0]; //debo pasarla a timestamp	
	 $qr="SELECT DATEDIFF(s, '19700101', '$lafecha'  ) ";  $db->SetFetchMode(ADODB_FETCH_NUM);$res  = $db->Execute($qr); 
    $tixx=$res->fields[0];//la tengo en timestamp la usa en la sig	
	
	$query2="SELECT username, name,avg(tickets_timestamp - previous) 
             FROM users left join         tickets_tickets
			 on
             tickets_admin=users.username 
            and users.admin<>'User'
	        where previous <> 0
			and  tickets_tickets.tickets_timestamp BETWEEN  $tixx and ($tixx +86400) group by username,name";  
	}//if mssql	
   
 $db->SetFetchMode(ADODB_FETCH_NUM);
 
 	$result2 = $db->Execute(	$query2);
		
	?>
    </strong></p></td>
  </tr>
  <tr>
    <td width="18%" class="report1">User</td>
    <td width="11%"  class="report2">Name</td>
    <td  class="report2"> Average Time (minutes) </td>
  </tr>
  <tr>
    <?php
	
	//$result_users->MoveFirst(); dont work at sqlserver!
	     $n=-1; 
		
   do {
            $filaff=$result2->fields;			
		   $result2->MoveNext();
    ?>
    <td>&nbsp;
      <?php	echo $filaff[0];     ?>
    </td>
    <td><?php	echo $filaff[1]; ?></td>
    <td width="36%">&nbsp;
      <?php  printf("%1\$.2f", ($filaff[2]/60)) ;?>        
    <div align="center"></div></td>
  </tr>
  <?php } while (!$result2->EOF); ?>
</table>
<?php } ?>
<p></p>
Only who responds to tickets is shown.
<?php
}
?>
<p> <?php

if (  isset($report20))
{
 ?> Last 600 actions/errors <a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=deletelog1">delete</a> entire log</p>
<table width="98%"  border="0" align="center" cellpadding="0" cellspacing="1"  class="report">
  <tr  >
    <td width="6%" class="report1"  >ID</td>
    <td width="65%" class="report1"  >Action/error</td>
    <td width="15%" class="report1"  > Time</td>
    <td width="14%" class="report1"  >Processing time(s) </td>
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
    <td><span class="comment3"> <?php echo date($dformat, $fila1[2]).' '.date('H:i:s', $fila1[2]) ?></span></td>
    <td><span class="text"><?php echo $fila1[3] ?></span></td>
  </tr>
  <?php 
  }
  while (!$result1->EOF);
  ?>
</table>
<?php 
}
?>
<p>
  <?php
if (  isset($report_tracking))
{
$query_users="SELECT distinct users.username,users.name from	users,users_staff
        where users_staff.userx=users.id";	 
	$db->SetFetchMode(ADODB_FETCH_NUM);
	$result_users  = $db->Execute($query_users);
	
  
 ?>
</p>
<table width="70%"  border="0" align="center" cellpadding="0" cellspacing="0"  class="report">
  <tr>
    <td class="report1" colspan="3"><p align="center"><strong>Staff tracking</strong></p></td>
  </tr>
  <tr>
    <td width="18%" class="report1">User</td>
    <td width="16%"  class="report2">Name</td>
    <td  class="report2">Actions</td>
  </tr>
  <tr>
    <td>*</td>
    <td>All</td>
    <td>	<a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=details_tracking&user=all">All<?php echo $filatemp1[0];
	 
    ?></a></td>
  </tr>
  <tr>
    <?php
	       $n=-1; 
		
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
	$query1="SELECT  count(id) as suma  from	 tracking  where tracking.staff='$username'";
	$db->SetFetchMode(ADODB_FETCH_NUM);
	$result_tt  = $db->Execute($query1);
	$filatemp1=$result_tt->fields;	
     ?></td>
    <td width="9%">&nbsp;
 <a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=details_tracking&user=<?php echo $username;?>"><?php echo $filatemp1[0]; ?></a> <a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=deletelog2&user=<?php echo $filaff[0]; ?>">Delete</a></td>
  </tr>
  <?php } while (!$result_users->EOF); ?>
</table>
<?php
}
?>
<p>
  <?php
if (  isset($report_tracking2))
{ 
 $query_users=" SELECT * from	tracking   where staff='".$el_user."'";
 if ( $el_user=='all')
{ $query_users="SELECT * from	tracking   order by id desc ";}

	$db->SetFetchMode(ADODB_FETCH_NUM);
$result_users  = $db->Execute($query_users);  
 ?>
</p>
<table width="70%"  border="0" align="center" cellpadding="0" cellspacing="0"  class="report">
  <tr>
    <td class="report1" colspan="5"><p align="center"><strong>Staff tracking</strong></p></td>
  </tr>
  <tr>
    <td width="9%" class="report1">Id</td>
    <td width="9%" class="report1">User</td>
    <td width="8%"  class="report2">Ticket</td>
    <td width="8%"  class="report2">Action</td>
    <td  class="report2">Time</td>
  </tr>
  <tr>
    <?php

         $n=-1; 
		
   do { 
          $filaff=$result_users->fields;
		  $result_users->MoveNext();
   ?>
    <td><?php
	echo $filaff[0];//id
     ?></td>
    <td><?php
	echo $filaff[2];//user
     ?></td>
    <td><?php
	echo $filaff[1];//ticket	
     ?></td>
    <td><?php
	echo $filaff[3];	
     ?>  </td>
    <td width="9%">&nbsp; <?php	
	$este=$filaff[4];
	
	echo date('H:i:s', $este) .' '.date($dformat, $este);
     ?> </td>
  </tr>
  <?php } while (!$result_users->EOF); ?>
</table>
<?php
}
?>
<p>
  <?php if (  isset($reportA))
{
  $query_users="SELECT distinct users.username,users.name from	users,users_staff
        where users_staff.userx=users.id";
		 $db->SetFetchMode(ADODB_FETCH_NUM);
	$result_usersT  = $db->Execute($query_users); ?>
</p>
<table width="70%"  border="0" align="center" cellpadding="0" cellspacing="0"  class="report">
  <tr>
    <td class="report1" colspan="6"><p align="center"><strong><a name="start"></a>
      <?php 
	  
	if ($dmbs='mssql')
	{
	$sql="select CURDATE()";
	}
	$resultd = $db->Execute($sql);
	 $db->SetFetchMode(ADODB_FETCH_NUM);
	$e=$resultd->fields;
	echo $e[0];
	
	?> 
    </strong></p></td>
  </tr>
  <tr>
    <td width="18%" class="report1">User</td>
    <td width="11%"  class="report2">Name</td>
    <td  class="report2">Opened</td>
    <td width="17%"  class="report2">Closed(resolved) </td>
    <td  class="report2">Hold</td>
    <td  class="report2">      Tickets created &amp; waiting response:(<img src="./images/unread.gif" width="14" height="11">+<img src="./images/read.gif" width="15" height="12">):<strong> 
      <?php
	  
	 if ($dbms=='mysql') 
 {
  $query1=" SELECT   count(DISTINCT(tickets_tickets.tickets_id) )
from users,
 tickets_state, tickets_tickets
where tickets_tickets.tickets_id=tickets_state.id
and tickets_state.tickets_status='1'
and tickets_tickets.tickets_child='0'
and tickets_tickets.tickets_timestamp
BETWEEN UNIX_TIMESTAMP( CURDATE() )  AND (   UNIX_TIMESTAMP( CURDATE()   ) +86400)";
}
if($dbms=='mssql')
{//today as timestamps, previous to use query1
  $qr="SELECT DATEDIFF(s, '19700101',     (select CONVERT(CHAR(10),GETDATE(),120) as e)        ) ";
   $db->SetFetchMode(ADODB_FETCH_NUM);
$res  = $db->Execute($qr); 
$tiem=$res->fields[0];

 $query1=" SELECT   count(DISTINCT(tickets_tickets.tickets_id) )
from users,
 tickets_state, tickets_tickets
where tickets_tickets.tickets_id=tickets_state.id
and tickets_state.tickets_status='1'
and tickets_tickets.tickets_child='0'
and tickets_tickets.tickets_timestamp
BETWEEN   $tiem   AND  ($tiem  +86400)";	 	  


}
  $db->SetFetchMode(ADODB_FETCH_NUM);
	$result1  = $db->Execute($query1); 
	$filatemp1=$result1->fields;
	echo $filatemp1[0];
    ?>
            </strong></td>
  </tr>
  <tr>
    <?php
         
         $n=-1; 
		
   do { 
   $filaff=$result_usersT->fields;
   $result_usersT->MoveNext();
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
    <td width="10%">&nbsp;
        <?php
	  $query1=" SELECT   count(DISTINCT(tickets_tickets.tickets_id) )
from users,
 tickets_state, tickets_tickets
where tickets_state.opened_by=users.username
and tickets_tickets.tickets_id=tickets_state.id
and tickets_state.tickets_status='1'
and tickets_tickets.tickets_child='0'
and users.username= '$username'
and tickets_tickets.tickets_timestamp
BETWEEN UNIX_TIMESTAMP( CURDATE() )  AND (   UNIX_TIMESTAMP( CURDATE()   ) +86400)";	 	  

if($dbms=='mssql')
{
	  $query1=" SELECT   count(DISTINCT(tickets_tickets.tickets_id) )
from users,
 tickets_state, tickets_tickets
where tickets_state.opened_by=users.username
and tickets_tickets.tickets_id=tickets_state.id
and tickets_state.tickets_status='1'
and tickets_tickets.tickets_child='0'
and users.username= '$username'
and tickets_tickets.tickets_timestamp  BETWEEN   $tiem   AND  ($tiem  +86400)";
}
  $db->SetFetchMode(ADODB_FETCH_NUM);
	$result1  = $db->Execute($query1); 
	$filatemp1=$result1->fields;
	echo $filatemp1[0];
    ?>
    </td>
    <td>&nbsp;      <?php
	 $query1=" SELECT   count(DISTINCT(tickets_tickets.tickets_id) )
from users,
 tickets_state, tickets_tickets
where tickets_state.opened_by=users.username
and tickets_tickets.tickets_id=tickets_state.id
and tickets_state.tickets_status='0'
and tickets_tickets.tickets_child='0'
and users.username= '$username'
and tickets_tickets.tickets_timestamp
BETWEEN UNIX_TIMESTAMP( CURDATE() )  AND (   UNIX_TIMESTAMP( CURDATE()   ) +86400)";
if($dbms=='mssql')
{
	 $query1=" SELECT   count(DISTINCT(tickets_tickets.tickets_id) )
from users,
 tickets_state, tickets_tickets
where tickets_state.opened_by=users.username
and tickets_tickets.tickets_id=tickets_state.id
and tickets_state.tickets_status='0'
and tickets_tickets.tickets_child='0'
and users.username= '$username'
and tickets_tickets.tickets_timestamp
BETWEEN   $tiem   AND  ($tiem  +86400)";
}

	  $db->SetFetchMode(ADODB_FETCH_NUM);
	  $result1  = $db->Execute($query1); 
	$filatemp1=$result1->fields;
	echo $filatemp1[0];
    ?></td>
    <td width="8%">&nbsp;      <?php
	 $query1=" SELECT   count(DISTINCT(tickets_tickets.tickets_id) )
from users,
 tickets_state, tickets_tickets
where tickets_state.opened_by=users.username
and tickets_tickets.tickets_id=tickets_state.id
and tickets_state.tickets_status='2'
and tickets_tickets.tickets_child='0'
and users.username= '$username'
and tickets_tickets.tickets_timestamp
BETWEEN UNIX_TIMESTAMP( CURDATE() )  AND (   UNIX_TIMESTAMP( CURDATE()   ) +86400)";

if($dbms=='mssql')
{
	 $query1=" SELECT   count(DISTINCT(tickets_tickets.tickets_id) )
from users,
 tickets_state, tickets_tickets
where tickets_state.opened_by=users.username
and tickets_tickets.tickets_id=tickets_state.id
and tickets_state.tickets_status='2'
and tickets_tickets.tickets_child='0'
and users.username= '$username'
and tickets_tickets.tickets_timestamp
BETWEEN   $tiem   AND  ($tiem  +86400)";

}
    $db->SetFetchMode(ADODB_FETCH_NUM);
	$result1  = $db->Execute($query1); 
	$filatemp1=$result1->fields;
	echo $filatemp1[0];
    ?></td>
    <td width="36%">&nbsp;
        <div align="center"></div></td>
  </tr>
  <?php } while (!$result_usersT->EOF); ?>
</table>
<?php
for ($ww=1;$ww <=30; $ww=$ww+1)
{
 ?><table width="70%"  border="0" align="center" cellpadding="0" cellspacing="0"  class="report">
  <tr>
    <td class="report1" colspan="6"><p align="center"><strong>
    <?php
	if ($dbms=='mysql')
	{ 
	 $sql="select DATE_ADD(CURDATE(), INTERVAL -$ww DAY)";
	}
	if ($dbms=='mssql')
	{ //2010-04-29
	$sql=" select CONVERT(CHAR(10), (SELECT DATEADD(dd, -$ww,  GETDATE()  )  )    ,120)   ";
	}
	$db->SetFetchMode(ADODB_FETCH_NUM);
	$resultd = $db->Execute($sql);
	$e=$resultd->fields;
	echo $e[0];
	$lafecha=$e[0];
	
	?>
    </strong></p></td>
  </tr>
  <tr>
    <td width="18%" class="report1">User</td>
    <td width="11%"  class="report2">Name</td>
    <td  class="report2">Opened</td>
    <td width="17%"  class="report2">Closed(resolved) </td>
    <td  class="report2">Hold</td>
    <td  class="report2"> Tickets created &amp; waiting response:(<img src="./images/unread.gif" width="14" height="11">+<img src="./images/read.gif" width="15" height="12">):<span class="Estilo2">
      <?php
	  
	  
	  $query1=" SELECT   count(DISTINCT(tickets_tickets.tickets_id) )
from users,
 tickets_state, tickets_tickets
where tickets_tickets.tickets_id=tickets_state.id
and tickets_state.tickets_status='1'
and tickets_tickets.tickets_child='0'
and tickets_tickets.tickets_timestamp
BETWEEN UNIX_TIMESTAMP('$lafecha' )  AND (   UNIX_TIMESTAMP( '$lafecha'   ) +86400)";

if($dbms=='mssql')
{//==
 $qr="SELECT DATEDIFF(s, '19700101', '$lafecha'  ) ";
   $db->SetFetchMode(ADODB_FETCH_NUM);
$res  = $db->Execute($qr); 
$tixx=$res->fields[0];

 $query1=" SELECT   count(DISTINCT(tickets_tickets.tickets_id) )
from users,
 tickets_state, tickets_tickets
where tickets_tickets.tickets_id=tickets_state.id
and tickets_state.tickets_status='1'
and tickets_tickets.tickets_child='0'
and tickets_tickets.tickets_timestamp
BETWEEN  $tixx and ($tixx +86400)";



}//==
   $db->SetFetchMode(ADODB_FETCH_NUM);
	$result1  = $db->Execute($query1); 
	$filatemp1=$result1->fields;
	echo $filatemp1[0];
	
    ?>
    </span></td>
  </tr>
  <tr>
    <?php
	
	$query_users="SELECT distinct users.username,users.name from	users,users_staff
        where users_staff.userx=users.id";
		 $db->SetFetchMode(ADODB_FETCH_NUM);
	$result_users  = $db->Execute($query_users);	
	//$result_users->MoveFirst(); dont work at sqlserver!


         $n=-1; 
		
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
    <td width="10%">&nbsp;
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

if($dbms=='mssql')
{//==
 $query1=" SELECT   count(DISTINCT(tickets_tickets.tickets_id) )
from users,
 tickets_state, tickets_tickets
where tickets_state.opened_by=users.username
and tickets_tickets.tickets_id=tickets_state.id
and tickets_state.tickets_status='1'
and tickets_tickets.tickets_child='0'
and users.username= '$username'
and tickets_tickets.tickets_timestamp
BETWEEN  $tixx and ($tixx +86400)";

}//==

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

if($dbms=='mssql')
{//==2
$query1=" SELECT   count(DISTINCT(tickets_tickets.tickets_id) )
from users,
 tickets_state, tickets_tickets
where tickets_state.opened_by=users.username
and tickets_tickets.tickets_id=tickets_state.id
and tickets_state.tickets_status='0'
and tickets_tickets.tickets_child='0'
and users.username= '$username'
and tickets_tickets.tickets_timestamp
BETWEEN  $tixx and ($tixx +86400)";
}//==2

	$result1  = $db->Execute($query1); 
	$filatemp1=$result1->fields;
	echo $filatemp1[0];
    ?></td>
    <td width="8%">&nbsp;        <?php  $query1=" SELECT   count(DISTINCT(tickets_tickets.tickets_id) )
from users,
 tickets_state, tickets_tickets
where tickets_state.opened_by=users.username
and tickets_tickets.tickets_id=tickets_state.id
and tickets_state.tickets_status='2'
and tickets_tickets.tickets_child='0'
and users.username= '$username'
and tickets_tickets.tickets_timestamp
BETWEEN UNIX_TIMESTAMP( '$lafecha')  AND (   UNIX_TIMESTAMP( '$lafecha'   ) +86400)";	 	  
if($dbms=='mssql')
{//==32

$query1=" SELECT   count(DISTINCT(tickets_tickets.tickets_id) )
from users,
 tickets_state, tickets_tickets
where tickets_state.opened_by=users.username
and tickets_tickets.tickets_id=tickets_state.id
and tickets_state.tickets_status='2'
and tickets_tickets.tickets_child='0'
and users.username= '$username'
and tickets_tickets.tickets_timestamp
BETWEEN  $tixx and ($tixx +86400)";
}//==32
	$result1  = $db->Execute($query1); 
	$filatemp1=$result1->fields;
	echo $filatemp1[0];
    ?></td>
    <td width="36%">&nbsp;
    <div align="center"></div></td>
  </tr>
  <?php } while (!$result_users->EOF); ?>
</table>
<?php } ?>
<?php
}
?>
<p><?php

if (  isset($reportT1))
{
 ?>
Last 600 tickets where your staff failed to provide a fast answer<a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=deleteT1">delete</a> entire log</p>
<table width="40%"  border="0" align="center" cellpadding="0" cellspacing="1"  class="report">
  <tr  >
    <td width="6%" class="report1"  >Ticket</td>
    <td width="17%" class="report1"  >Creation date </td>
    <td width="30%" class="report1"  >  T1 Expiration</td>
  </tr>
  <tr><?php 
	do
	{
	  $fila1=$result1->fields;
	  $result1->MoveNext();
	?>
    <td><a href="tickets2.php?action=open&ticketid=<?php echo $fila1[0]; ?>"><?php echo $fila1[0]; ?></a></td>
    <td><?php echo date($dformat, $fila1[1]).' '.date('H:i:s', $fila1[1]) ?></td>
    <td><span class="comment3"> <?php echo date($dformat, $fila1[2]).' '.date('H:i:s', $fila1[2]) ?></span></td>
  </tr>
  <?php 
  }
  while (!$result1->EOF);
  ?>
</table>
<?php 
}
?>
<p>
  <?php

if (  isset($reportT2))
{
 ?>
Last 600 tickets where your staff failed to provide a fast answer<a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=deleteT2">delete</a> entire log</p>
<table width="40%"  border="0" align="center" cellpadding="0" cellspacing="1"  class="report">
  <tr  >
    <td width="6%" class="report1"  >Ticket</td>
    <td width="17%" class="report1"  >Creation date </td>
    <td width="30%" class="report1"  >  T2 Expiration </td>
  </tr>
  <tr>
    <?php 
	do
	{
	  $fila1=$result1->fields;
	  $result1->MoveNext();
	?>
    <td><a href="tickets2.php?action=open&ticketid=<?php echo $fila1[0]; ?>"><?php echo $fila1[0]; ?></a></td>
    <td><?php echo date($dformat, $fila1[1]).' '.date('H:i:s', $fila1[1]) ?></td>
    <td><span class="comment3"> <?php echo date($dformat, $fila1[2]).' '.date('H:i:s', $fila1[2]) ?></span></td>
  </tr>
  <?php 
  }
  while (!$result1->EOF);
  ?>
</table>
<?php 
}
?>
<?php
if (  isset($report_es))
{
$query_users="SELECT *  from sca   order by id ASC ";	 
	$db->SetFetchMode(ADODB_FETCH_NUM);
	$result_users  = $db->Execute($query_users);
	
  
 ?>
<table width="70%"  border="0" align="center" cellpadding="0" cellspacing="0"  class="report">
  <tr>
    <td class="report1" colspan="6"><p align="center"><strong>Staff tracking</strong></p></td>
  </tr>
  <tr>
    <td width="9%" class="report1">Ticket</td>
    <td width="13%" class="report1">Staff</td>
    <td width="16%"  class="report2">Old Department</td>
    <td width="16%"  class="report2">New Department</td>
    <td width="33%"  class="report2">Date</td>
    <td  class="report2">Actions</td>
  </tr>
  <tr>
    <?php
	       $n=-1; 
		
   do {
        $filaff=$result_users->fields;
		$result_users->MoveNext();
    ?>
    <td>&nbsp;
        <?php echo $filaff[0];     ?>
    </td>
    <td><?php echo $filaff[2];     ?></td>
    <td><?php echo $filaff[4];     ?></td>
    <td><?php echo $filaff[5];     ?></td>
    <td><?php echo    date($dformat, $filaff[3]) ;     ?></td>
    <td width="13%">&nbsp; <a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=details_tracking&user=<?php echo $username;?>"><?php echo $filatemp1[0]; ?></a> <a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=delete_esca&user=<?php echo $filaff[0]; ?>">Delete</a></td>
  </tr>
  <?php } while (!$result_users->EOF); ?>
</table>
<?php
}
?>
<p>&nbsp;
  <?php
	   if ($reportused==TRUE) 
	   {
	   $id=$_POST['ticket'];
	   $query1="select * from time_used where ticket='$id'";
	   $db->SetFetchMode(ADODB_FETCH_ASSOC);
	$result_u  =  $db->Execute($query1);
	   
	  ?>
</p>
<table width="100%"  class="text" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Staff</strong></td>
    <td><strong>Time (min) </strong></td>
    <td><strong>Date</strong></td>
  </tr>
  <?php do { 
		$fila=$result_u->fields;
		$result_u->MoveNext();
		?>
  <tr>
    <td><?php echo $fila['usua'];  ?>&nbsp;</td>
    <td><?php echo $fila['min'];  ?>&nbsp;</td>
    <td><?php echo date($dformat.' H:i:s', $fila['tiem']);  ?> &nbsp;</td>
  </tr>
  <?php  
		}
		while(!$result_u->EOF);
		   ?>
</table>
<p>&nbsp; </p>
<p>
  <?php 
		}
		?>
</p>
<p>&nbsp;</p>
<p></p>
