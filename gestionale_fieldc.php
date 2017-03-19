<?php
require_once("mainfile.php");
global $prefix, $db, $admin, $user;

$field6 = $_GET[field6];
$id = $_GET[id];
$field10 = $_GET[field10];
$data = $_GET[data];

//eseguo la query
$sql = "UPDATE nuke_offerte SET field6='$field6', field10='$field10', data='$data' WHERE id='$id'";
$result=$db->sql_query1($sql);

echo "risultato: $result";

?>