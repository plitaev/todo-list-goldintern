<?php
require_once "../db.php";
require_once "../api.php";

$order="ORDER BY todo_datetime";
if ($_POST['sort']==1) $order="ORDER BY FIELD(todo_priority,1,0,2)";
if ($_POST['sort']==2) $order="ORDER BY FIELD(todo_priority,2,0,1)";

$res=dbquery("SELECT * FROM todo WHERE todo_status=0 ".$order);
$Aresult=[];
while ($data=dbarray($res)) {
 $data['todo_priority']=$Apriority[$data['todo_priority']];
 $Aresult[]=$data;
}

echo json_encode($Aresult); 
?>
