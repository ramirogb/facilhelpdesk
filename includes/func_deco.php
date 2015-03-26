<?php 

function msgbody($msg, $type = 'text/plain')
{
if (is_array($msg)) {
if (array_key_exists('Body', $msg)) {
$tmp = explode(';', $msg['Headers']['content-type:']);
if ($type == trim($tmp[0])) return $msg['Body'];
}
if ((array_key_exists('Parts', $msg)) && (is_array($msg['Parts']))) {
foreach ($msg['Parts'] as $val) {
$res = msgbody($val, $type);
if ($res) return $res; 
}
}
}
}


function arrayFromEmailParts($parts,&$index){
foreach ($parts as $part) 
{
$tmp = explode(';',$part['Headers']['content-type:']);
$type = $tmp[0];
// multipart/alternative
if ($type == 'multipart/alternative')
 {
         if (isset($ret)) {
         $ret = array_merge($ret,arrayFromEmailParts($part['Parts'],$index));
         }
		  else
		   {
           $ret = arrayFromEmailParts($part['Parts'],$index);
           }
}
 else
  {

if ($type == 'text/plain' OR $type == 'text/html')
 {
     $ret[$index]['type'] = $type;
$ret[$index]['content'] = file_get_contents($part['BodyFile']);
}
else{
$ret[$index]['type'] = $type;
$ret[$index]['file'] = $part['BodyFile'];

foreach($tmp as $data)
 {
if (strstr($data,'name'))
{
 $t = explode("=",$data);
 $fileName = $t[1];
 // outlook (and maybe others?) puts "" around the name, so remove if found
 if(substr($fileName,0,1) == '"' AND substr($fileName,strlen($fileName)-1,1) == '"')
 $fileName = substr($fileName,1,strlen($fileName)-2);
 
 $ret[$index]['originalFileName'] = $fileName;
}

} //of for each
}//else 20
$index++;
}
}
return($ret);
}

?>