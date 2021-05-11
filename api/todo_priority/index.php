<?php
require_once "../db.php";
require_once "../api.php";

dbquery("UPDATE todo SET todo_priority=".$_POST['todo_priority']." WHERE todo_id=".$_POST['todo_id']);
$Aresult=["update_priority"=>"1","priority"=>$Apriority[$_POST['todo_priority']]];

echo json_encode($Aresult,JSON_UNESCAPED_UNICODE); 
?>
