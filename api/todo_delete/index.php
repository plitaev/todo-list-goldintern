<?php
require_once "../db.php";
require_once "../api.php";
dbquery("DELETE FROM todo WHERE todo_id=".$_POST['todo_id']);
$Aresult=["delete_status"=>"1"];
echo json_encode($Aresult); 
?>
