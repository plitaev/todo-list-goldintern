<?php
require_once "../db.php";
require_once "../api.php";

dbquery("UPDATE todo SET todo_status=1 WHERE todo_id=".$_POST['todo_id']);
$Aresult=["update_status"=>"1"];

echo json_encode($Aresult); 
?>
