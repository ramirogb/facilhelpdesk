
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">AgeCdg:</td>
      <td><?php echo $row_agency['AgeCdg']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AgeDsc:</td>
      <td><input type="text" name="AgeDsc" value="<?php echo $row_agency['AgeDsc']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AgeDscAbr:</td>
      <td><input type="text" name="AgeDscAbr" value="<?php echo $row_agency['AgeDscAbr']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AgeDir:</td>
      <td><input type="text" name="AgeDir" value="<?php echo $row_agency['AgeDir']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AgeFon:</td>
      <td><input type="text" name="AgeFon" value="<?php echo $row_agency['AgeFon']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AgeFax:</td>
      <td><input type="text" name="AgeFax" value="<?php echo $row_agency['AgeFax']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AgeCto:</td>
      <td><input type="text" name="AgeCto" value="<?php echo $row_agency['AgeCto']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AgeUsuAdd:</td>
      <td><input type="text" name="AgeUsuAdd" value="<?php echo $row_agency['AgeUsuAdd']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AgeFecAdd:</td>
      <td><input type="text" name="AgeFecAdd" value="<?php echo $row_agency['AgeFecAdd']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AgeTimAdd:</td>
      <td><input type="text" name="AgeTimAdd" value="<?php echo $row_agency['AgeTimAdd']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AgeUsuChg:</td>
      <td><input type="text" name="AgeUsuChg" value="<?php echo $row_agency['AgeUsuChg']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AgeFecChg:</td>
      <td><input type="text" name="AgeFecChg" value="<?php echo $row_agency['AgeFecChg']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AgeTimChg:</td>
      <td><input type="text" name="AgeTimChg" value="<?php echo $row_agency['AgeTimChg']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AgeRuc:</td>
      <td><input type="text" name="AgeRuc" value="<?php echo $row_agency['AgeRuc']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Color1:</td>
      <td><input type="text" name="Color1" value="<?php echo $row_agency['Color1']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Color2:</td>
      <td><input type="text" name="Color2" value="<?php echo $row_agency['Color2']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AgeFon2:</td>
      <td><input type="text" name="AgeFon2" value="<?php echo $row_agency['AgeFon2']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AgeNex:</td>
      <td><input type="text" name="AgeNex" value="<?php echo $row_agency['AgeNex']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AgeCelMov:</td>
      <td><input type="text" name="AgeCelMov" value="<?php echo $row_agency['AgeCelMov']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AgeCelCla:</td>
      <td><input type="text" name="AgeCelCla" value="<?php echo $row_agency['AgeCelCla']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="AgeCdg" value="<?php echo $row_agency['AgeCdg']; ?>">
</form>
<p>&nbsp;</p>

<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE agencias SET AgeDsc=%s, AgeDscAbr=%s, AgeDir=%s, AgeFon=%s, AgeFax=%s, AgeCto=%s, AgeUsuAdd=%s, AgeFecAdd=%s, AgeTimAdd=%s, AgeUsuChg=%s, AgeFecChg=%s, AgeTimChg=%s, AgeRuc=%s, Color1=%s, Color2=%s, AgeFon2=%s, AgeNex=%s, AgeCelMov=%s, AgeCelCla=%s WHERE AgeCdg=%s",
                       GetSQLValueString($_POST['AgeDsc'], "text"),
                       GetSQLValueString($_POST['AgeDscAbr'], "text"),
                       GetSQLValueString($_POST['AgeDir'], "text"),
                       GetSQLValueString($_POST['AgeFon'], "text"),
                       GetSQLValueString($_POST['AgeFax'], "text"),
                       GetSQLValueString($_POST['AgeCto'], "text"),
                       GetSQLValueString($_POST['AgeUsuAdd'], "text"),
                       GetSQLValueString($_POST['AgeFecAdd'], "date"),
                       GetSQLValueString($_POST['AgeTimAdd'], "text"),
                       GetSQLValueString($_POST['AgeUsuChg'], "text"),
                       GetSQLValueString($_POST['AgeFecChg'], "date"),
                       GetSQLValueString($_POST['AgeTimChg'], "text"),
                       GetSQLValueString($_POST['AgeRuc'], "int"),
                       GetSQLValueString($_POST['Color1'], "int"),
                       GetSQLValueString($_POST['Color2'], "int"),
                       GetSQLValueString($_POST['AgeFon2'], "text"),
                       GetSQLValueString($_POST['AgeNex'], "text"),
                       GetSQLValueString($_POST['AgeCelMov'], "text"),
                       GetSQLValueString($_POST['AgeCelCla'], "text"),
                       GetSQLValueString($_POST['AgeCdg'], "text"));

  mysql_select_db($database_con1);
  $Result1 = mysql_query($updateSQL) or die(mysql_error());
}

mysql_select_db($database_con1);
$query_agency = "SELECT * FROM agencias";
$agency = mysql_query($query_agency) or die(mysql_error());
$row_agency = mysql_fetch_assoc($agency);
$totalRows_agency = mysql_num_rows($agency);

mysql_free_result($agency);
?>
