<?php

$db_host="MYSQL_SERVER_ADDRESS";
$db_user="MYSQL_USER_LOGIN";
$db_pass="MYSQL_USER_PASSWORD";
$db_name="todo";

$dblink_common=false;
dbconnect($db_host, $db_user, $db_pass, $db_name);
dbquery("SET NAMES utf8mb4");

//БАЗА ДАННЫХ-------------------------------------------------------------------
function dbquery($query,&$result='') {
global $query_count,$dblink_common;
 $query_count++;
 if (!$query = mysqli_query($dblink_common,$query)) echo mysqli_error();
 return $query;
}


function mysqli_result($result, $row, $field = 0) {
 $result->data_seek($row);
 $data = $result->fetch_array();
 return $data[$field];
}

//------------------------------------------------------------------------------
function dbcount($field,$table,$where='',$add='') {
global $query_count,$dblink_common;
 $query_count++;
 $where=join_where($where);
 if (!$query = mysqli_query($dblink_common,"SELECT Count".$field." FROM ".$table." ".$where." ".$add)) {
  echo mysqli_error();
 } else {
  return mysqli_result($query,0);
 }
}
//------------------------------------------------------------------------------
function dbresult($query, $row) {
 if (!$query = mysqli_result($query, $row)) echo mysqli_error($dblink_common);
 return $query;
}
//------------------------------------------------------------------------------
function dbrows($query) {
	global $dblink_common;
	if (!$query = mysqli_num_rows($query)) echo mysqli_error($dblink_common);
	return $query;
}
//------------------------------------------------------------------------------
function dbarray($query) {
 global $dblink_common;
 if (!$query = mysqli_fetch_assoc($query)) echo mysqli_error($dblink_common);
 return $query;
}
//------------------------------------------------------------------------------
function dbarraynum($query) {
 if (!$query = mysqli_fetch_row($query)) echo mysqli_error($dblink_common);
 return $query;
}
//------------------------------------------------------------------------------
function dbconnect($db_host, $db_user, $db_pass, $db_name) {
global $dblink_common;
 $dblink_common=mysqli_connect($db_host, $db_user, $db_pass) or die("Can't connect to MySQL Server!");
 mysqli_select_db($dblink_common,$db_name) or die("Can't select database!");
}
//------------------------------------------------------------------------------
function dbinsertid() {
 global $dblink_common;
 return mysqli_insert_id($dblink_common);
}
//------------------------------------------------------------------------------
function dbselect($query) {
 return dbquery("SELECT ".$query);
}
//------------------------------------------------------------------------------
function db_tree_elements($tablename,$idname,$parentidname,$startid,&$A) {
 $res=dbquery("SELECT ".$idname." FROM ".$tablename." WHERE ".$parentidname.(is_array($startid)?" IN (".implode(',',$startid).")":"=".$startid));
 $locA=array();
 while ($data=dbarray($res)) {
  $locA[]=$data[$idname];
  $A[]=$data[$idname];
 }
 if (count($locA)>0) db_tree_elements($tablename,$idname,$parentidname,$locA,$A);
}
//------------------------------------------------------------------------------
function join_where() {
 $CA = array("WHERE"=>" ");
 $A=array();
 for ($i=0; $i<func_num_args(); $i++) {
  $usl=func_get_arg($i);
  if ($usl!='') $A[]=$usl;
 }
 $where=implode(" AND ",$A);
 $where=strtr($where,$CA);
 if ($where!="") $where=" WHERE ".$where;
 return $where;
}
?>
