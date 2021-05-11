<?php
$check_token=0;
require_once "../db.php";
require_once "../api.php";

function gen_token() {
 if (function_exists('com_create_guid')===true) {
  return trim(com_create_guid(),'{}');
 }

 return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X',mt_rand(0,65535),mt_rand(0,65535),mt_rand(0,65535),mt_rand(16384,20479),mt_rand(32768,49151),mt_rand(0,65535),mt_rand(0,65535),mt_rand(0,65535));
}


$res=dbquery("SELECT user_id FROM user WHERE user_login='".$_POST['user_login']."' AND user_password='".md5($_POST['user_password'])."'");
$Aresult=[];

if (dbrows($res)>0) {
 $data=dbarray($res);
 
 $token=gen_token();
 $token_exp=date('Y-m-d H:i:s',time()+86400); 
 
 dbquery("UPDATE user SET user_token='".$token."',user_token_expired='".$token_exp."' WHERE user_id=".$data['user_id']);
 
 $Aresult["user_id"]=$data["user_id"];
 $Aresult["user_token"]=$token;
 $Aresult["user_token_expired"]=$token_exp;
  
} else {
 $Aresult["user_id"]=0;
 $Aresult["user_token"]=NULL;
 $Aresult["user_token_expired"]=NULL;
}
 
echo json_encode($Aresult);
?>
