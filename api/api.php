<?php
date_default_timezone_set('UTC');
if (!isset($check_token)) $check_token=1;

if ($check_token==1) {
 $validres=dbquery("SELECT COUNT(*) AS cc FROM user WHERE user_id=".$_POST['user_id']." AND user_token='".$_POST['user_token']."' AND user_token_expired>'".date('Y-m-d H:i:s',time())."'");
 $validdata=dbarray($validres);
 
 if ($validdata['cc']==0) {
  $Astop=["error"=>"invalid_token"];
  die(json_encode($Astop));
 } 
}

$Apriority=['Обычный','Низкий','Высокий'];
?>