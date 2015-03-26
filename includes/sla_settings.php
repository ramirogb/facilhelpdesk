<form name="form1" method="post" action="">
  <p> Notificate to: 
    <select name="select">
      <option value="0">Disabled</option>
      <option value="1">Supervisor</option>
      <option value="2">Administrator</option>
    </select>
  if no answer is provided after customized time interval t1, Repeat after: 
  <select name="rep1" id="rep1">
    <option value="1">1h</option>
    <option value="2">2h</option>
    <option value="3">3h</option>
    <option value="4">4h</option>
    <option value="5">5h</option>
    <option value="8">8h</option>
    <option value="12">12h</option>
    <option value="24">24h</option>    
    </select>
  </p>
  <p> Notificate to:
    <select name="select">
      <option value="0">Disabled</option>
      <option value="1">Supervisor</option>
      <option value="2">Administrator</option>
    </select>
if no solution after customized time t2, Repeat after: 
<select name="rep2" id="rep2">
  <option value="1">1h</option>
  <option value="2">2h</option>
  <option value="3">3h</option>
  <option value="4">4h</option>
  <option value="5">5h</option>
  <option value="8">8h</option>
  <option value="12">12h</option>
  <option value="24">24h</option>
</select>
  </p>
  <p>Apply rules to tickets on Hold State
    <input name="hold" type="checkbox" id="hold" value="1">
    <input type="submit" name="Submit" value="Submit">
  </p>
</form> 
<?php 
if ($authz<>'TRUE') exit;
?>