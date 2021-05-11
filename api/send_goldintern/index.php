<?php
$data=["user"=>$_POST["user_id"],"action"=>$_POST["action"]];
$data=json_encode($data,JSON_UNESCAPED_UNICODE);
$curl=curl_init("https://todo.goldintern.space/action/");
curl_setopt($curl,CURLOPT_CUSTOMREQUEST,"POST");
curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json','Content-Length: '.strlen($data_string)));
$result=curl_exec($curl);
echo curl_getinfo($curl,CURLINFO_HTTP_CODE);
curl_close($curl);
?>
