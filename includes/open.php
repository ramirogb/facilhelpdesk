<script src="includes/datetimepicker.js">
</script>
<SCRIPT language=JavaScript>
function getXMLHttpObj(){
	if(typeof(XMLHttpRequest)!='undefined')
		return new XMLHttpRequest();

	var axO=['Msxml2.XMLHTTP.6.0', 'Msxml2.XMLHTTP.4.0',
		'Msxml2.XMLHTTP.3.0', 'Msxml2.XMLHTTP', 'Microsoft.XMLHTTP'], i;
	for(i=0;i<axO.length;i++)
		try{
			return new ActiveXObject(axO[i]);
		}catch(e){}
	return null;
}
function reload(form){
var val=form.departament.options[form.departament.options.selectedIndex].value;
var va2=form.ticketpadre.value;  
self.location='tickets2.php?action=open&ticketid='+ va2+'&cat=' + val;
}
function showUser(str)
{
var
contador=0;
// var oldContent = formxxx.message.value;
 /*
//document.formxxx.message.value=  response.comment + "\n" + oldContent;
*/
//alert('HOLA');

	var oXML = getXMLHttpObj();
	var laurl="tickets.php?canned="+ str;
	oXML.open('GET',laurl, false);
	oXML.send('');
	salidaj=oXML.responseText;
	document.formxxx.message.value=salidaj;
//la variable esta seteada pero no se puede setear

if ( document.formxxx.message.id != 'messagesimple')//coz is FCKeditor
{
//alert('FCK');
var va2=document.formxxx.ticketpadre.value;  
self.location='tickets2.php?action=open&ticketid='+ va2+  '&canned='+ str+'&editor=html';
}


}
</script>
<?php
if ($authz<>'TRUE') exit;

			  /*
			  if (	isset($_GET['editor'] ) )
			  {	  			$vvvvx=$_SESSION['type_edit'];						
					  	if ($vvvvx=='text') { $_SESSION['type_edit']='html'; }
					  	if ($vvvvx=='html') { $_SESSION['type_edit']='text'; }
			  }
			  else
			  {
			  $_SESSION['type_edit']='text'; //by default use the basic
			  }
			  */
//==================THIS IS CONDITIONAL===========================
 $sqlxx="select * from users where username='". $_SESSION['xcv_userna']."'";
  $db->SetFetchMode(ADODB_FETCH_ASSOC);
	$resultxx     =  $db->Execute($sqlxx);
	$rowxx       =$resultxx->fields;
	$the_user=$rowxx['id'];
	$el_ticket=$_GET['ticketid'];
	
		if  ( ($rowxx['admin']<>'Admin') and ($rowxx['admin']<>'Mod') )	
		{}
		else
		{ //=V
	  $sqlxx="select tickets_category from tickets_tickets,users_staff 
	 where users_staff.userx='$the_user' 
	 and users_staff.departament=tickets_tickets.tickets_category 
	 and tickets_tickets.tickets_id='$el_ticket'";
   $db->SetFetchMode(ADODB_FETCH_ASSOC);
   $resultx_permi =  $db->Execute($sqlxx);   
  $abres=$resultx_permi->RecordCount();
  if ($abres <>0)
  {}
  else
  	{
	echo 'Denied, you are not allowed to open it';
	include('includes/bottom.php');
	exit;
	}
	
         }//=V
	
	$limitation=''; //a los usuarios comunes los limita, pero no a los administradores
	//o moderadores, en este caso no está limitando los permisos del moderador, basta que se haya 
	//pasado correctamente el id del ticket,no estamos verificando si tiene permisos
   $simple_user=false;//by default the user is an Admin, this variable is used later
   
	if  ( ($rowxx['admin']<>'Admin') and ($rowxx['admin']<>'Mod') )	
	{
	$limitation=" AND tickets_username = '"       .$_SESSION['xcv_userna'].  "'";
	$simple_user=true;
	
	}
					
//===============================================================
 $query_last_eta="SELECT a.eta
        			FROM tickets_tickets a,
				    tickets_levels b,
				    tickets_categories c,
					tickets_state d,users
					WHERE (a.tickets_id = '".$_GET['ticketid']."'
					OR tickets_child = '".$_GET['ticketid']."')
					AND a.tickets_urgency = b.id
					AND a.tickets_category = c.tickets_categories_id
					AND a.tickets_admin=users.username
					AND a.eta<>0
					
					 
					ORDER BY tickets_id DESC Limit 1"; 
					//will be used to insert the time of response.
 if ($dbms=='mssql')				 
 	{
	$query_last_eta="SELECT TOP 1 a.eta
        			FROM tickets_tickets a,
				    tickets_levels b,
				    tickets_categories c,
					tickets_state d,users
					WHERE (a.tickets_id = '".$_GET['ticketid']."'
					OR tickets_child = '".$_GET['ticketid']."')
					AND a.tickets_urgency = b.id
					AND a.tickets_category = c.tickets_categories_id
					AND a.tickets_admin=users.username
					AND a.eta<>0 ORDER BY tickets_id DESC"; 
	
	}					
					$db->SetFetchMode(ADODB_FETCH_ASSOC);
					$last_eta =  $db->Execute($query_last_eta);
					$yyy_eta=$last_eta->fields;
					 $el_eta=$yyy_eta[0];
					
//xhexa esti 
              $query_last_response="SELECT a.tickets_timestamp,a.eta
        			FROM tickets_tickets a,
				    tickets_levels b,
				    tickets_categories c,
					tickets_state d,users
					WHERE (a.tickets_id = '".$_GET['ticketid']."'
					OR tickets_child = '".$_GET['ticketid']."')
					AND a.tickets_urgency = b.id
					AND a.tickets_category = c.tickets_categories_id
					AND a.tickets_admin=users.username
					and users.admin='User'
					 AND d.id =  '".$_GET['ticketid']."'			
					$limitation
					ORDER BY tickets_id DESC Limit 1"; //we get the last response from user that time
					//will be used to insert the time of response.

			//will be used to insert the time of response.
 if ($dbms=='mssql')				 
 	{
	          $query_last_response="SELECT TOP 1 a.tickets_timestamp,a.eta
        			FROM tickets_tickets a,
				    tickets_levels b,
				    tickets_categories c,
					tickets_state d,users
					WHERE (a.tickets_id = '".$_GET['ticketid']."'
					OR tickets_child = '".$_GET['ticketid']."')
					AND a.tickets_urgency = b.id
					AND a.tickets_category = c.tickets_categories_id
					AND a.tickets_admin=users.username
					and users.admin='User'
					 AND d.id =  '".$_GET['ticketid']."'			
					$limitation
					ORDER BY tickets_id DESC";
}
					 $db->SetFetchMode(ADODB_FETCH_NUM);	
					$last_r =  $db->Execute($query_last_response);
					$yyy=$last_r->fields;
					$el_tiempo=$yyy[0];//the time of the last response for stats purpuses
//gets answers to ticket mysql sqlserver					
 $query = "	SELECT   (a.tickets_id), tickets_subject, tickets_timestamp,
                         d.tickets_status,d.assigned_to,tickets_name, tickets_email,
						  tickets_admin,tickets_username,
        		    tickets_child, tickets_question, b.id,
					 b.name,b.color,
					  tickets_categories_id, tickets_categories_name,unread_admin,unread_user,tickets_categories_name,a.reserved
					FROM tickets_tickets a,
					 tickets_levels b,
					  tickets_categories c,
					  tickets_state d
					WHERE (a.tickets_id = '".$_GET['ticketid']."'
					OR tickets_child = '".$_GET['ticketid']."')
					AND a.tickets_urgency = b.id
					AND a.tickets_category = c.tickets_categories_id
					 AND d.id =  '".$_GET['ticketid']."'
					$limitation 					
					ORDER BY tickets_id ASC";
					$db->SetFetchMode(ADODB_FETCH_ASSOC);
			$result	   =  $db->Execute($query);
			$totaltickets = $result->RecordCount();
			$row    = $result->fields;
			
			?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>?ticketid=<?php echo $_GET['ticketid']; ?>" method="post" enctype="multipart/form-data" name="formxxx" id="formxxx">
  <table cellspacing="1" cellpadding="1" class="boxborder" align="<?php echo $maintablealign ?>">
    <tr>
      <td class="boxborder" width="20%" valign="top" style="padding-top:5px">
	  <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" class="report">
          <tr>
            <td width="20%"  class="boxborder text"><b>ID: <?php echo $_GET['ticketid']; ?>
              <input name="ticketpadre" type="hidden" id="ticketpadre" value="<?php echo $_GET['ticketid'];  ?>"> 
            </b></td>
            <td width="15%"  class="boxborder text">&nbsp;
             <?php if (	  ($simple_user==false) and  ($row['tickets_status'] <>'2') ) 
			
			 { ?>
			<a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=hold&ticketid=<?php echo $_GET['ticketid'] ?>"><?php echo $hold_ticket;?></a>
			
			<?php }
			 ?>
			</td>
            <?php

			IF ($row['tickets_status'] == '1')
				{
?>
            <td class="text" width="11%"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=close&ticketid=<?php echo $_GET['ticketid'] ?>"><?php echo $close_ticket;?></a></td>
			<td class="text" width="11%"><a href="#respond"><?php echo $respond;?></a></td>
            <?php
				}
			ELSE
			{
				?>
            <td class="text" width="27%"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=reopen&ticketid=<?php echo $_GET['ticketid'] ?>"><?php echo $reopen_ticket; ?></a> <?php
			if ($rate_responsest==TRUE)
			{
			
			}
			
			 ?>
			<?php ?></td>
            
            <?php

				}
?></tr>
        </table>
          <table width="98%" align="center" cellpadding="0" cellspacing="0" >
            <tr>
              <td width="30%" class="text"><b><?php echo $posted_by; ?></b></td>
              <td colspan="3" class="text"><?php echo htmlentities(stripslashes($row['tickets_username']) ) ; ?>
                <?php
$el_id=	$_GET['ticketid'];//for two SQLs is used
if ($simple_user==false)
{
        if ($row['unread_admin']==1)
        {
         $query56 = " UPDATE tickets_tickets	SET unread_admin = '0'
         WHERE tickets_id   = '".$el_id."'";
         $resultxx5 =  $db->Execute( $query56 );
         }
}
else
{ //single users
        if ($row['unread_user']==1)
        {
         $query56 = " UPDATE tickets_tickets	SET unread_user = '0'
         WHERE tickets_id   = '".$el_id."'";
         $resultxx5 =  $db->Execute( $query56 );
         }

}
 
 $sqlxxxx="select users.username,users.comments FROM
               users,tickets_tickets
                where  (tickets_tickets.tickets_id='$el_id')
                and (tickets_tickets.tickets_child=0)
				 and tickets_tickets.tickets_username = users.username";
	 	$db->SetFetchMode(ADODB_FETCH_NUM);
		$resultxxxx =  $db->Execute( $sqlxxxx);
		$ttt=$resultxxxx->fields;		  
		
		$details = substr( $ttt[1],0,150);
        $sale=rawurlencode($details);             
			  ?>
                <input name="admin" type="hidden" id="admin" value="<?php echo $ttt[0]; ?>">
                <div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
                <script src="includes/over/overlibmws.js" type="text/javascript">
			    </script>
                <span class="boxborder text"><a
			  onMouseOut="return nd()";
           onMouseOver="return overlib('<?php echo $sale; ?>',DECODE,AUTOSTATUS)" 
			   href="<?php echo $_SERVER['PHP_SELF'] ?>?action=comments&username=<?php echo  $ttt[0]; ?>">
                <?php if ($simple_user==false){ ?>
                <img src="images/comments.gif" width="15" height="12" border="0"></a></span>
              <?php echo '<BR>'.$banuser;?><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=ban&username=<?php echo   $ttt[0]; ?>"><img src="images/ban_user.png" alt="Ban User" width="28" height="30" border="0"></a><?php } ?> </td>
            </tr>
            <tr>
              <td colspan="4" class="text">&nbsp;</td>
            </tr>
            <tr>
              <td class="text"><b>Email:</b></td>
              <td colspan="3" class="text"><?php echo $row['tickets_email'] ?>
              <input name="email" type="hidden" id="email" value="<?php  echo $row['tickets_email']; ?>"></td>
            </tr>
            <tr>
              <td class="text"><b>Subject:</b></td>
              <td colspan="3" class="text"><?php echo  htmlentities( $row['tickets_subject']); ?></td>
            </tr>
            <tr>
              <td class="text"><b><?php echo $departament; ?>:</b></td>
              <td colspan="3" class="text"><?php echo $row['tickets_categories_name'] ?></td>
            </tr>
            <tr>
              <td class="text"><b><?php echo $text_listurg ?>:</b></td>
              <td  align="left" bgcolor="#<?php  if (isset($row['color'])) { echo $row['color']; } else echo 'FFFFFF'; ?>" class="boxborder text"><b><?php echo $row['name']; ?>
                <?php 

		if( $simple_user ==false)
		{ 
		?>
              </b></td>
              <td bgcolor="#<?php  if (isset($row['color'])) { echo $row['color']; } else echo 'FFFFFF'; ?>" class="boxborder text"><span class="text"><strong>
                <select name="new_urgency" id="new_urgency">
                  <?php

  $queryC = "	SELECT b.color,b.id,b.orderx,b.name
					FROM tickets_levels	as b ORDER BY b.orderx ASC";					
					$db->SetFetchMode(ADODB_FETCH_ASSOC);			
			$resultC =  $db->Execute($queryC);
						
			WHILE (!$resultC->EOF)
			{ 
			$rowC = $resultC->fields;
			$resultC->MoveNext();
			echo '<option style="background-color:#'.$rowC['color'].'" value="'.$rowC['id'].'"';
				 
				 if ( !(strcmp($rowC['name'], $row['name']) ) )
			    {
				 echo "SELECTED";
				// $depa=$row3['tickets_categories_id'];
				}
				echo'>'.$rowC['name'].'</option>';				
				}
				?>
              </select>
                <input name="old_urgency" type="hidden" id="old_urgency" value="<?php echo  $row['name']; ?>">
              </strong></span></td>
              <td width="40%" class="text"><strong><span class="boxborder text">
                <input name="Change" type="submit" id="Change" value="Change">
                <?php 
		}
		
		?>
</span></strong></td>
            </tr>
            <tr>
              <td class="text">&nbsp;</td>
              <td colspan="3" class="text"><?php

			IF ($row['tickets_status'] == 'Closed')

				{

				echo '<span style="color:#FF0000">';

				}

			ELSE

				{

				echo '<span style="color:#000000">';

				}
			//echo$row['tickets_status'];
?>
              </td>
            </tr>
        </table>
          <table width="300" border="0">
            <?php
			  if  ($el_eta<>0)
			  {
			  ?>
			<tr>
              <td class="text"><?php echo $eta; ?></td>
              <td width="172" class="text"><span class="boxborder text">
			  <?php			  
			  echo date($dformat, $el_eta).' '.date('H:i:s', $el_eta);			  
			   ?>
			  </span>&nbsp;</td>
            </tr>
			<?php }  ?>
			<?php 

		if( $simple_user ==false)
		{ 
		?>
            <tr>
              <td   class="text" width="72"><?php echo $eta; ?></td>
              <td class="text"><input name="eta" type="text" id="eta" size="20">
              <a href="javascript:NewCal('eta','ddmmyyyy',true,24)"><img src="includes/calendar.jpg" width="16" height="15" border="0" alt="Pick a date"></a></td>
            </tr>
			<?php } ?>
        </table>
          <div style="padding-top:3px"></div>
        <?php 

		if( $simple_user ==false)
		{ 
		?>
        <table width="300" class="report" border="0" cellpadding="0" cellspacing="2">
          <tr>
            <td width="96"><span class="text" ><strong>Assign to: </strong></span>
			<?php 
			if (isset($_GET['cat']) )
			{
			$cat=trim($_GET['cat']);
			}
			else
			{
			$cat= $row['tickets_categories_id']; 
			}			
			?>
            <select name="departament"  onChange="reload(this.form)" id="departament">
                <?php			
	 $query57 = "	SELECT * from tickets_categories, users_staff where tickets_categories_id=users_staff.departament and   users_staff.userx='$the_user' ";	 
	$db->SetFetchMode(ADODB_FETCH_ASSOC);
	 $result57 = $db->Execute($query57);

			 do { 
			  $row3=$result57->fields; 
			  $result57->MoveNext();
			 ?>
                <option value="<?php  echo $row3['tickets_categories_id']; ?>" <?php
				 if ( !(strcmp($row3['tickets_categories_id'],$cat) ) )
			    {
				 echo "SELECTED";
				 $depa=$row3['tickets_categories_id'];
				 $super=$row3['supervisor'];
				 $depaX=$row3['tickets_categories_name'];
				}
				 ?>
				><?php echo $row3['tickets_categories_name'];  ?></option>
                <?php }
				 while ( !$result57->EOF ); ?>
              </select>
              <span class="boxborder text"><b>
              </b></span></td>
            <td width="136"><span class="text" ><strong>Staff: </strong></span>
              <select name="assigned" id="assigned">
			  <option value="-1"selected >&nbsp;</option>
              <?php
			if (isset($_GET['cat']) )
			{
			$cat=trim($_GET['cat']);
	$query577 = "	SELECT DISTINCT(users.username), users.name from users,users_staff WHERE
	  users_staff.userx=users.id and departament='$cat'
	 order by users.username";
	 }
	 else
	 {
	 $cat=$row['tickets_categories_id'];
	 $query577 = "	SELECT DISTINCT(users.username), users.name from users,users_staff WHERE	  users_staff.userx=users.id and departament='$cat'
	  order by users.username";
	 }

	 $db->SetFetchMode(ADODB_FETCH_ASSOC);
	 
	 	$result577 = $db->Execute($query577);	

			 do { 
			 	$row3x=$result577->fields;//assoc required				
				$result577->MoveNext();

			 ?>
              <option value="<?php  echo $row3x['username']; ?>" <?php if (!(strcmp($row3x['username'], $row['assigned_to'] ) ) ) {echo "SELECTED";} ?>><?php echo $row3x['name']; ?></option>
              <?php } while (!$result577->EOF); ?>		  
            </select>
              <input name="supervisorZA" type="hidden" id="supervisorZA" value="<?php echo $super;  ?>">              
              <input name="namedepa" type="hidden" id="namedepa" value="<?php echo $depaX; ?>">              </td>
            <td width="60"><input name="Change" type="submit" id="Change" value="Ok">
            </td>
          </tr>
        </table>
		
		
        <?php   if ($upgraded=='345fh') { ?><table width="300" class="report" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="93"><p><span class="text" ><strong><strong>Escalate to:</strong></strong></span><span class="boxborder text"><b> 
              <input name="sca" type="hidden" id="sca" value="1">
            </b></span></p>
            </td>
            <td width="113"><?php 
			if (isset($_GET['cat']) )
			{
			$cat=trim($_GET['cat']);
			}
			else
			{
			$cat= $row['tickets_categories_id']; 
			}			
			?>
              <select name="departamentL"   id="departamentL">
                <?php			
	 $query57 = "	SELECT * from tickets_categories";
 	 $query57 = "	SELECT * from tickets_categories, users_staff_v_level where tickets_categories_id=users_staff_v_level.depart and   users_staff_v_level.userx='$the_user' ";	 
	 $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;		
	 $result57 = $db->Execute($query57);	
	

			 do { 
			  $row3=$result57->fields; 
			  $result57->MoveNext();
			 ?>
                <option value="<?php  echo $row3['tickets_categories_id']; ?>" <?php
				 if ( !(strcmp($row3['tickets_categories_id'],$cat) ) )
			    {
				 echo "SELECTED";
				 $depa=$row3['tickets_categories_id'];
				 $super=$row3['supervisor'];
				 $depaX=$row3['tickets_categories_name'];
				}
				 ?>
				><?php echo $row3['tickets_categories_name'];  ?></option>
                <?php }
				 while ( !$result57->EOF ); ?>
              </select></td>
            <td width="86"><input name="Change" type="submit" id="Change" value="Ok">             </td>
          </tr>
        </table>
        <table    style="border-width:1px; border-color:#FF0066; border-style:solid; "  width="300" border="0" align="right" cellspacing="0" bordercolor="#FF0000">
          <?php
			  if  ($el_eta<>0)
			  {
			  ?>
          <?php }  ?>
          <?php 

		if( $simple_user ==false)
		{ 
		?>
          <tr>
            <td   class="text"><?php echo  $answer_before; ?></td>
            <td class="text"><?php 
			  $el_id=$row['tickets_id'];
	       $queryf = "SELECT * FROM tickets_tickets, users,tickets_state where tickets_tickets.tickets_username= users.username 
   and tickets_state.id=tickets_tickets.tickets_id
   and (tickets_state.tickets_status=1 or tickets_state.tickets_status=2) and tickets_tickets.tickets_id='$el_id'
      ORDER BY tickets_tickets.tickets_id DESC";
	$db->SetFetchMode(ADODB_FETCH_ASSOC);
	$resultf= $db->Execute($queryf );
	$rowf=$resultf->fields;	 $t1=$rowf['t1'];$t2=$rowf['t2'];
	$expi_ans=$rowf['tickets_timestamp']+$t1*3600;
	$expi_solution=$rowf['tickets_timestamp']+$t2*3600;
	
echo date($dformat,$expi_ans).' '.date('H:i',$expi_ans );?></td>
          </tr>
          <tr>
            <td   class="text"><?php echo  $fix_before; ?></td>
            <td class="text"><span class="boxborder text"><span class="urglev"></span></span>
                <?php 
			  
echo date($dformat,$expi_solution ).' '.date('H:i',$expi_solution);?>
                <span class="boxborder text"><span class="urglev"><span class="ListView"><img src="images/alert<?php echo $row['reserved']; if  ($row['reserved']=='') echo '1'; ?>.png" alt="Alert Level" width="10" height="10" align="absmiddle"></span></span></span></td>
          </tr>
          <?php } ?>
        </table>
        <?php } ?>
        <?php 
		}
		
		?>
        <br /></td>
      <td width="70%" valign="top"     class="text" style="padding-top:3px">       <?php	  
	
	  IF    (    $rate_responses=='TRUE' )

	  {//==
	 if(     ($row['tickets_status'] == '1' and  $rate_responsest=='TRUE' ) or ($row['tickets_status'] == '0' and  $rate_responsest=='FALSE' or $rate_responsest=='BOTH')  )
	 {
	  $case_number= trim($_GET['ticketid']);	  $querybb4 = "	SELECT id FROM tickets_poll WHERE id='$case_number'";
	    $result88 = $db->Execute($querybb4);
	
	  	if (   $result88->RecordCount < $res_polls )
	  	{
		include('includes/EnDecryptText.php'); //encrypt.php				
        $EnDecryptText = new EnDecryptText();
        $verifc= $EnDecryptText->Encrypt_Text($case_number);												
	  	$la_url=$siteurl.'tickets.php'.'?action=poll1&case='.$case_number.'&tix='.urlencode($verifc).'&tif=56';
       	echo $rate=$to_rate_responses.$separator.'<a href="'  .$la_url. '">'.'Link:'.'</a>'.$separator.'<img src="./images/survey.gif" width="18" height="16">' ;
	   	}
		}
	   }//==			   
			$counter_responses = '-1';
			$db->SetFetchMode(ADODB_FETCH_ASSOC);
			$result = $db->Execute($query);
              ?>
        <?php 
		
	// LOOP THROUGH THE QUESTIOSN AND RESPONSES TO THIS QUESTION
		WHILE (!$result->EOF)			
				{
				$row2 = $result->fields;
			$result->MoveNext();
			  $oculto=false;
			  $nn='encuadro';
			  if ( $row2['reserved']=='1' )  
			  { $nn='report';$oculto=true;
			  			  
			   }
			   else
			   {
			     $counter_responses ++;	
			   
			   }
			  
			  if ( ( $row2['reserved']=='1' ) and  ($simple_user == true)  ) {
			  $nn='encuadro'; 

			  }
			  else
			  {
			  
			  
			   ?>
        <table  width="97%" cellspacing="0"   class="<?php  echo $nn ?>" cellpadding="1"  align="center">
        <span class="boxborder text">
        <?php if (  $row2['tickets_username']==Unregistered )
			  {
			  ?>
        <span ><strong><a href="./tickets2.php?action=header&ticketid=<?php  echo $row2['tickets_id']; ?>" target="_blank"  onclick="window.open('./tickets2.php?action=header&ticketid=<?php  echo $row2['tickets_id']; ?>','popup','width=500,height=500,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=0,top=0'); return false" >Headers</a></strong> </span>
        <?php 
			  }
			  ?>
        </span>            <tr >
              <td width="79%" class="boxborder text"><b>
                <?php

				IF ($counter_responses == '0')
					{
					echo $question_;
					}
				ELSE
					{
					if ($nn=='report') {echo $internal;} else { echo "$response_ $counter_responses:";}
					}
?>
              </b></td>
        <td class="boxborder text" bgcolor="#EBF5FE" width="21%" align="right">
			  <?php
			  echo date($dformat.' H:i:s', $row2['tickets_timestamp']);
			   ?>
		  </td>
            </tr>
            <?php
				IF ($row['tickets_admin'] == 'Admin')
					{
					$bgcolor = '#FFFFB7';
					}
				ELSE
					{
					$bgcolor = '#DAEAFD';
					}
?>
            <tr>
              <td class="text" colspan="2"><?php			  
  		    $to_display= $row2['tickets_question'];
	  //$to_display = preg_replace('/<form action(.*)<\/</form>/','', $to_display);
			$to_display =str_replace('<form action','<formxx action', $to_display);
			$to_display =str_replace('</form>','</formxx>', $to_display);
			//html_entity_decode  htmlentities( nl2br			
			echo ( nl2br( stripslashes( $to_display ) ) );	   
		    ?></td></tr>
            <tr bgcolor="<?php echo $bgcolor ?>">
              <td class="text">Posted By: <?php echo $row2['tickets_admin']; ?></td>
              <td class="text"><?php
	// SCAN THE UPLOAD DIRECTORY FOR ATTACHMENTS FOR COMPATIBILITY OLDER VERSIONS
				IF ($allowattachments == 'TRUE')
					{
					$d = dir($uploadpath);					
					WHILE (false !== ($files = $d -> read()))
						{
						$files = explode('.', $files);
						IF(  ($files['0'] == $row2['tickets_id']) 
						//and (strlen($files['1'])<10)
						 )
							{ ?>
                  <?php echo $files['1'] ?> attachment: <a href="<?php 
				  echo $siteurl.$uploadpath.$files['0']
				   ?>.<?php 
				   echo $files['1']
				    ?>" target="_blank"> <img src="images/attach.gif" width="13" height="12" border="0" align="absmiddle" /></a>
                  <?php
							$filename = $files['0'].'.'.$files['1'];
?>
                  <input type="hidden" name="attachment[<?php echo $_GET['ticketid'] - 1 ?>]" value="<?php echo $filename ?>" />
                  <?php
							}
						ELSE
							{
							$filename = '';
							}
						}
					$d -> close();
					}
?>
               <?php 
		$ti = $row2['tickets_id']; //NEW METHOD
	 $query3x3 = "SELECT * FROM   tickets_atach WHERE tickets_id=$ti ";		 
 	$result3x3 = $db->Execute($query3x3);	
	
			do
			{$row3x3= $result3x3->fields;				//assoc
			$result3x3->MoveNext();
					if ($row3x3['atachmen']<>'')
			     {
			     ?>
				<span class="text"><?php
				echo $row3x3['atachmen'];
				 ?>
				 <a href="./get_file2.php?ticket=<?php echo $ti ?>
				 <?php 
				 echo $files['1'].'&file='.$row3x3['atachmen'];  ?>" 
				 target="_blank"><img src="images/attach.gif" width="13" height="12" border="0" align="absmiddle" />
				 </a>
				 </a></span>
				    <?php
				     }
			 
				 } //rep table?
			 while ( !$result3x3->EOF )			 
			 ?> 
              </td>
            </tr>            
        </table><?php } ?>
          <div style="padding-top:5px"></div>
          <?php
		  if ($oculto==false) 
		  {	   
		  
				//$counter_responses ++;
?>
          <input type="hidden" name="ticketquestion[<?php 
		  echo $counter_responses;?>]" value="<?php
		    echo urlencode($row2['tickets_question']);
			 ?>" />
          <input type="hidden" name="postedby[<?php echo $counter_responses; ?>]" value="<?php echo $row2['tickets_admin'] ?>" />
          <input type="hidden" name="postdate[<?php echo $counter_responses; ?>]" value="<?php echo date($dformat.' H:i:s', $row2['tickets_timestamp']) ?>" />
          <?php
		  
		  } 
				}//while2?

?>
          <input name="previous" type="hidden" id="previous" value="<?php echo $el_tiempo; ?>">
          <input name="tiemp" type="hidden" id="tiemp" value="<?php echo  time(); ?>"></td>
    </tr>
  </table>
  <table width="95%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="85%"><?php

			IF ($row['tickets_status'] != '0')

				{

?>
        <table width="100%" cellspacing="1" cellpadding="1" class="boxborder" align="center">
          <tr >
            <td class="boxborder text"><b><?php echo $respond; ?>
              <input name="registernow" type="hidden" id="registernow" value="1">
                  <a name="respond"></a> </b></td>
          </tr>
          <tr>
            <td align="center"><p><span class="text">
                <a href="<?php echo $_SERVER['PHP_SELF'] ?>?ticketid=<?php echo $_GET['ticketid']; ?>&action=<?php echo $_GET['action'];  ?>&editor=<?php   
				if ( !isset($_GET['editor'] ) ) { echo 'html';}
				else
				{
							if ($_GET['editor']=='html') { echo 'txt'; }
							else
							{
							echo 'html';
							}
				} 
				?>#respond">Switch Edit.</a>
</span></p>
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><span class="text">
                    <?php 

		if( $simple_user ==false)
		{ 
		echo $cannedreply;		
		?>
                    <select name="canned"       onChange="showUser(this.value)" id="canned">
                      <option value="0">Select canned reply</option>
                      <?php			
	$query57c = "	SELECT * from canned_replies where dep='$depa'";
			$db->SetFetchMode(ADODB_FETCH_ASSOC);
	 $result57c = $db->Execute($query57c);	//assoc
	 
			 do { 
			 $row3c= $result57c->fields; 
			  $result57c->MoveNext();
			 ?>
                      <option value="<?php  echo $row3c['id']; ?>"><?php echo $row3c['subjet']; ?></option>
                      <?php }
				 while (!$result57c->EOF); ?>
                    </select>
                    </span></td>
                  <td><span class="text">
                    <?php  echo 	   $store_reply; ?>
                    <input name="record_response" type="checkbox" id="record_response" value="1">
                    <?php echo $subjetcanned ?>
                    <input name="subjetcan" type="text" id="subjetcan" maxlength="35">
                    <a href="tickets2.php?action=canned">edit</a> </span></td>
                </tr>
              </table>
              <p><span  class="text">
                <?php 
		}
		
		?>  
                <?php

if ( $_GET['editor']=='html')
{			 
	
	include("kbase/zadminxx/FCKeditor/fckeditor.php") ;			  
	$oFCKeditor = new FCKeditor('message') ; //the name
	//$oFCKeditor->BasePath = "./kbase/zadminxx/FCKeditor/";
	$oFCKeditor->BasePath = "$siteurl/kbase/zadminxx/FCKeditor/";
	$oFCKeditor->Value = '';
	
	if ( isset($_GET['canned'] )	  )
	{
	   $id=$_GET['canned'];
		$query57c = "	SELECT body from canned_replies where id='$id'  ";	 
	 $result57c = $db->Execute($query57c);	//assoc
	 $row3c=$result57c->fields; 
$oFCKeditor->Value =trim($row3c['body']);
	}	
	$oFCKeditor->Create() ;
}
else 
{
echo "<textarea name=\"message\" cols=\"90\"  id=\"messagesimple\"  rows=\"10\"></textarea>";
}
	
?>
              </span>              </p>
            </td>
          </tr>
          <tr>
            <td align="right"><div align="center">
              <input name="key3" type="hidden" id="key3" value="<?php echo trim($_GET['key3']); ?>">
              <input type="hidden" name="name" value="<?php echo htmlentities($row['tickets_name']); ?>" />
                  <input type="hidden" name="email" value="<?php echo $row['tickets_email'] ?>" />
                  <input name="ticketsubject" type="hidden" id="ticketsubject" value="<?php echo $row['tickets_subject'] ?>" />
                  <input name="urgency" type="hidden" id="urgency" value="<?php echo $row['id'] ?>|<?php echo $row['name'] ?>" />
                  <input name="category" type="hidden" id="category" value="<?php echo $row['tickets_categories_id'] ?>|<?php echo $row['tickets_categories_name'] ?>" />
                  <span class="text">
                  <?php 

		if( $simple_user ==false)
		{ 
		?>
                  Internal use                
                  <input name="reserved" type="checkbox" id="reserved" value="1">
                  Close
                  <input name="close_t" type="checkbox" id="close_t" value="1">
                  <?php 
		}
		
		?>
                  </span>                  <input type="submit" value="Submit" />
            </div></td>
          </tr>
        </table>
        <div  class="comment3" style="padding-left:15px">
      <?php				IF ($allowattachments == 'TRUE' )
					{
					FileUploadForm();
						?><b>Allowed attachments: </b><?php

					FOR ($i = '0'; $i <= COUNT($allowedtypes_) - 1; $i++)
					{
					echo $allowedtypes_[$i].' , ';							
					
					
					}
					echo '<BR>';
					}

				}
?>
        </div>
</td>
      <td  valign="top" width="15%"><span class="text">
      </span> </td>
    </tr>
</table>
</form>  