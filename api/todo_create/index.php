<?php
require_once "../db.php";
require_once "../api.php";

$todo_datetime=$_POST['todo_date']." ".$_POST['todo_time'];

dbquery("INSERT INTO todo(user_id,todo_name,todo_datetime,todo_priority,todo_status,todo_creation) VALUES(".$_POST['user_id'].",'".$_POST['todo_name']."','".$todo_datetime."',".$_POST['todo_priority'].",".$_POST['todo_status'].",'".date("Y-m-d H:i:s")."')");
$Aresult=["todo_id"=>dbinsertid()];
echo json_encode($Aresult); 
?>
