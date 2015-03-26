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
	$resultxx     = mysql_query($sqlxx);
	$rowxx       = mysql_fetch_assoc($resultxx);
	
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
					$last_eta = mysql_query($query_last_eta);
					$yyy_eta=mysql_fetch_row($last_eta);
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
					$last_r = mysql_query($query_last_response);
					$yyy=mysql_fetch_row($last_r);
					$el_tiempo=$yyy[0];//the time of the last response
					
 $query = "	SELECT   (a.tickets_id), tickets_subject, tickets_timestamp,
                         d.tickets_status,d.assigned_to,tickets_name, tickets_email,
						  tickets_admin,tickets_username,
        		    tickets_child, tickets_question, b.id,
					 b.name,b.color,
					  tickets_categories_id, tickets_categories_name,unread_admin,unread_user

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
			$result	   = mysql_query($query);
			$totaltickets = mysql_num_rows($result);
			$row    = mysql_fetch_array($result);
			?>

<form action="http://www.tgp.be/helpdesk/tickets2.php?ticketid=<?php echo $_GET['ticketid']; ?>" method="post" enctype="multipart/form-data" name="formxxx" id="formxxx">
  <table cellspacing="1" cellpadding="1" class="boxborder" align="<?php echo $maintablealign ?>">
    <tr>
      <td class="boxborder" width="20%" valign="top" style="padding-top:5px">
	  <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" class="report">
          <tr>
            <td  class="boxborder text"><b>ID: <?php echo $_GET['ticketid']; ?>
              <input name="ticketpadre" type="hidden" id="ticketpadre" value="<?php echo $_GET['ticketid'];  ?>"> 
            </b></td>
            <td  class="boxborder text">&nbsp;
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
            <td class="text" width="30%"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=close&ticketid=<?php echo $_GET['ticketid'] ?>"><?php echo $close_ticket;?></a></td>
			<td class="text" width="15%"><a href="#respond"><?php echo $respond;?></a></td>
            <?php
				}
			ELSE
			{
				?>
            <td class="text" width="15%"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=reopen&ticketid=<?php echo $_GET['ticketid'] ?>"><?php echo $reopen_ticket;?></a></td>
            
            <?php

				}
?></tr>
        </table>
          <table width="98%" align="center" cellpadding="0" cellspacing="0" >
            <tr>
              <td width="30%" class="text"><b><?php echo $posted_by; ?></b></td>
              <td colspan="3" class="text"><?php echo htmlentities(stripslashes($row['tickets_name']) ) ; ?>
                <?php
$el_id=	$_GET['ticketid'];//for two SQLs is used
if ($simple_user==false)
{
        if ($row['unread_admin']==1)
        {
         $query56 = " UPDATE tickets_tickets	SET unread_admin = '0'
         WHERE tickets_id   = '".$el_id."'";
         $resultxx5 = mysql_query( $query56 );
         }
}
else
{ //single users
        if ($row['unread_user']==1)
        {
         $query56 = " UPDATE tickets_tickets	SET unread_user = '0'
         WHERE tickets_id   = '".$el_id."'";
         $resultxx5 = mysql_query( $query56 );
         }

}
 
 $sqlxxxx="select users.username,users.comments FROM
               users,tickets_tickets
                where  (tickets_tickets.tickets_id='$el_id')
                and (tickets_tickets.tickets_child=0)
				 and tickets_tickets.tickets_username = users.username";
		$resultxxxx = mysql_query( $sqlxxxx);
		$ttt=mysql_fetch_row($resultxxxx);		  
		
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
					
 $queryC = "	SELECT b.color,b.id,b.order,b.name
					FROM tickets_levels	as b ORDER BY b.order ASC";					
					
			$resultC = mysql_query($queryC);
			WHILE ($rowC = mysql_fetch_array($resultC))
				{
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
              <td class="text"><span class="boxborder text">
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
              <td width="48"><?php echo $edit; ?></td>
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
            <td><span class="text" ><strong>Assign to: </strong></span>
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
	 $query57 = "	SELECT * from tickets_categories";	 
	 $result57 = mysql_query($query57);	
	 $row3=mysql_fetch_assoc( $result57); 

			 do { ?>
                <option value="<?php  echo $row3['tickets_categories_id']; ?>" <?php
				 if ( !(strcmp($row3['tickets_categories_id'],$cat) ) )
			    {
				 echo "SELECTED";
				 $depa=$row3['tickets_categories_id'];
				}
				 ?>
				><?php echo $row3['tickets_categories_name']; ?></option>
                <?php }
				 while ($row3=mysql_fetch_assoc(	$result57)); ?>
              </select>
              <span class="boxborder text"><b>
              </b></span></td>
            <td><span class="text" ><strong>Staff: </strong></span>
              <select name="assigned" id="assigned">
			  <option value="-1"selected >&nbsp;</option>
              <?php
			if (isset($_GET['cat']) )
			{
			$cat=trim($_GET['cat']);
	 $query577 = "	SELECT DISTINCT(users.username), users.name from users,users_staff WHERE
	  users_staff.user=users.id and departament='$cat'
	 order by users.username";
	 }
	 else
	 {
	 $query577 = "	SELECT DISTINCT(users.username), users.name from users,users_staff WHERE
	  users_staff.user=users.id order by users.username";
	 }
	 
	 
	 	$result577 = mysql_query($query577);	
	$row3x=mysql_fetch_assoc( $result577);				
			 do { ?>
              <option value="<?php  echo $row3x['username']; ?>" <?php if (!(strcmp($row3x['username'], $row['assigned_to'] ) ) ) {echo "SELECTED";} ?>><?php echo $row3x['name']; ?></option>
              <?php } while ($row3x=mysql_fetch_assoc(	$result577)); ?>		  
            </select>
              <input name="changedep" type="hidden" id="changedep" value="1">              </td>
            <td><input name="Change" type="submit" id="Change" value="Change"></td>
          </tr>
        </table>
		
		
        <?php 
		}
		
		?>
        <br /></td>
      <td width="70%" valign="top"     style="padding-top:3px"><?php
			$counter_responses = '0';
			$result = mysql_query($query);
	// LOOP THROUGH THE QUESTIOSN AND RESPONSES TO THIS QUESTION
			WHILE ($row2 = mysql_fetch_array($result))
				{
              ?>
        <table  width="97%" cellspacing="0"   class="encuadro" cellpadding="1"  align="center">
        <span class="boxborder text">
        <?php if (  $row2['tickets_username']==Unregistered )
			  {
			  ?>
        <span class="text"><strong><a href="./tickets2.php?action=header&ticketid=<?php  echo $row2['tickets_id']; ?>" target="_blank"  onclick="window.open('./tickets2.php?action=header&ticketid=<?php  echo $row2['tickets_id']; ?>','popup','width=500,height=500,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=0,top=0'); return false" >Headers</a></strong> </span>
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
					echo "$response_ $counter_responses:";
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
			
			
			$search = array ("'<script[^>]*?>.*?</script>'si") ;			
            $replace = array ('');
			$to_display = preg_replace($search, $replace, $to_display);
			
						
			$search = array ("<script");			
            $replace = array ("&lt;script");			
			$to_display =str_replace($search, $replace, $to_display);
			
			
			/*
			$search = array ('>') ;			
            $replace = array ('&gt;');
			$to_display =str_replace($search, $replace, $to_display);
			*/
			
//$to_display = preg_replace('/<form action(.*)<\/</form>/','', $to_display);
			$to_display =str_replace('<form action','<formxx action', $to_display);
			$to_display =str_replace('</form>','</formxx>', $to_display);

			//html_entity_decode  htmlentities( nl2br
		   echo ( nl2br( stripslashes( $to_display ) ) );
		    ?>
			  </td>
            </tr>
            <tr bgcolor="<?php echo $bgcolor ?>">
              <td class="text">Posted By: <?php echo $row2['tickets_admin']; ?></td>
              <td class="text"><?php

	// SCAN THE UPLOAD DIRECTORY FOR ATTACHMENTS TO THIS POST IF ATTACHMENTS ARE OFF THEN THIS WONT DO IT
				IF ($allowattachments == 'TRUE')
					{
					$d = dir($uploadpath);
					
					WHILE (false !== ($files = $d -> read()))
						{
						$files = explode('.', $files);
						IF ($files['0'] == $row2['tickets_id'])
							{
?>
                  <?php echo $files['1'] ?> attachment: <a href="<?php echo $siteurl.$uploadpath.$files['0'] ?>.<?php echo $files['1'] ?>" target="_blank"> <img src="images/attach.gif" width="13" height="12" border="0" align="absmiddle" /></a>
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
		$ti = $row2['tickets_id'];
	 $query3x3 = "SELECT atachmen,archi FROM   tickets_atach WHERE tickets_id=$ti ";		 
 	$result3x3 = mysql_query($query3x3);	
	$row3x3=mysql_fetch_assoc( $result3x3);				
			do
			{
			if ($row3x3['atachmen']<>'')
			     {
			     ?>
			<span class="text"><?php
			 ?>
			 <a href="./get_file.php?ticket=<?php echo $ti.'&_file='.urlencode($row3x3['atachmen']); ?><?php echo $files['1'] ?>" target="_blank"><img src="images/attach.gif" width="13" height="12" border="0" align="absmiddle" /></a></a></span>
			    <?php
			     }
			 
			 }
			 while ( $row3x3=mysql_fetch_assoc( $result3x3) )			 
			 ?> 
              </td>
            </tr>            
        </table>
          <div style="padding-top:5px"></div>
          <?php
				$counter_responses ++;
?>
          <input type="hidden" name="ticketquestion[<?php 
		  echo $counter_responses;?>]" value="<?php
		    echo urlencode($row2['tickets_question']);
			 ?>" />
          <input type="hidden" name="postedby[<?php echo $counter_responses; ?>]" value="<?php echo $row2['tickets_admin'] ?>" />
          <input type="hidden" name="postdate[<?php echo $counter_responses; ?>]" value="<?php echo date($dformat.' H:i:s', $row2['tickets_timestamp']) ?>" />
          <?php
				}

?>
          <input name="previous" type="hidden" id="previous" value="<?php echo $el_tiempo; ?>">
</td>
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
				?>#respond">Editor</a>
			    <?php 

		if( $simple_user ==false)
		{ 
		echo $cannedreply;		
		?>
                <select name="canned"       onChange="showUser(this.value)" id="canned">
			        <option value="0">Select canned reply</option>
                  <?php			
	$query57c = "	SELECT * from canned_replies where dep='$depa'";	 
	 $result57c = mysql_query($query57c);	
	 $row3c=mysql_fetch_assoc( $result57c); 

			 do { ?>			 
                  <option value="<?php  echo $row3c['id']; ?>"><?php echo $row3c['subjet']; ?></option>
                  <?php }
				 while ($row3c=mysql_fetch_assoc(	$result57c)); ?>
                </select>
                </span></p>
              <p><span class="text">	             <?php  echo 	   $store_reply; ?>
                <input name="record_response" type="checkbox" id="record_response" value="1">
                <?php echo $subjetcanned ?>
                <input name="subjetcan" type="text" id="subjetcan" maxlength="35">
                <a href="kbase/zadminxx/catadmin.php?action=canned">edit</a>
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
	 $result57c = mysql_query($query57c);	
	 $row3c=mysql_fetch_assoc( $result57c); 
$oFCKeditor->Value =trim($row3c['body']);
	}	
	$oFCKeditor->Create() ;
}
else 
{
echo "<textarea name=\"message\" cols=\"90\"  id=\"messagesimple\"  rows=\"10\"></textarea>";
}
	
?>
                </span>
              </p></td>
          </tr>
          <tr>
            <td align="right"><input name="key3" type="hidden" id="key3" value="<?php echo trim($_GET['key3']); ?>">
            <input type="hidden" name="name" value="<?php echo htmlentities($row['tickets_name']); ?>" />
                <input type="hidden" name="email" value="<?php echo $row['tickets_email'] ?>" />
                <input name="ticketsubject" type="hidden" id="ticketsubject" value="<?php echo $row['tickets_subject'] ?>" />
                <input name="urgency" type="hidden" id="urgency" value="<?php echo $row['id'] ?>|<?php echo $row['name'] ?>" />
                <input name="category" type="hidden" id="category" value="<?php echo $row['tickets_categories_id'] ?>|<?php echo $row['tickets_categories_name'] ?>" />
                <input type="submit" value="Submit" />
            </td>
          </tr>
        </table>
        <div  class="comment3" style="padding-left:15px">
      <?php				IF ($allowattachments == 'TRUE' )
					{
					FileUploadForm();
						?><b>Allowed attachments: </b><?php

					FOR ($i = '0'; $i <= COUNT($allowedtypes) - 1; $i++)
					{
					echo $allowedtypes[$i].' , ';
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