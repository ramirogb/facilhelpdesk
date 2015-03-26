<?php 

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
  <span class="mio">
  </span>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=ad_user" method="post"><span class="mio"><table width="700" cellpadding="1" cellspacing="1" align="center">
    <tr>
      <td class="text"><strong><span class="text boxborder"><strong><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=ad_use"><?php echo  $adduser;?></a></strong></span></strong></td>
    </tr>
    <tr>
      <td class="text"><label for="name">Name:</label>
<input name="name" size="30"/>
  <p>
             <label for="username">Username:</label>
             <input name="username" id="username" size="30">	  	   
	  	   </p>
           <p>
	  	     
	  	     <label for="password">Password:</label>
<input name="password" type="password" size="30">
        </p>
	  	   <label for="email">Email:</label>
<input name="email" size="30">
        <p>
             <label for="website">Website(optional) :</label>        
             <input name="website" type="text" id="website" size="30">
	    </p>
           <p>
			   <label for="company">Company(optional) :</label>
<input name="company" type="text" id="company" size="30">
	    </p>
			  <p>
			  <label for="comments">Notes for internal use(optional,phone,etc.):</label>
			  <textarea name="comments" cols="50" rows="2" id="mail"></textarea>
      </td>
    </tr>
	  <tr>
      <td align="center"  class="text">	    
	    <p> Select type: <label>
	      <input name="type" type="radio" value="User" checked>
            User</label>
          <label><input type="radio" name="type" value="Mod">
          Staff member*
          <select name="departament" id="departament">
            <?php			
	$query55 = "	SELECT * from tickets_categories";
	$result55 = $db->Execute($query55);	

			 do { 
			 	$row=$result55->fields;
				$result55->MoveNext();
			 ?>
            <option value="<?php echo $row['tickets_categories_id']; ?>"> <?php echo $row['tickets_categories_name']; ?></option>
            <?php } while (!$result55->EOF); ?>
            <option value="-100" selected>&nbsp;Select for Staff</option>
          </select>
          </label>
          <label><input type="radio" name="type" value="Admin">Admin</label>
        </p>
	    </td>	 
    </tr><tr>	 
      <td align="center"><span class="comment">
        *Select the default departament if the user is a member of staff   </span>
		            
      </td>
    </tr>
    <tr>
      <td  class="comment" align="center"> <input name="newuser" type="hidden" id="newuser" value="1">
      Admin users can open tickets of every departament without restrictions. </td>
    </tr>

    <tr>
      <td>
        <input type="submit" name="userform" value="Submit" />
      <br></td>
    </tr>
  </table>
  </span>  
</form>
<p>&nbsp;</p>