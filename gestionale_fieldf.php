<?php
require_once("mainfile.php");
global $prefix, $db, $admin, $user;

$field = $_GET[field];
$id = $_GET[id];
$valore = $_GET[valore];
$valore = str_replace("'","&lsquo;",$valore);

//eseguo la query
$sql = "UPDATE nuke_offerte SET $field='$valore' WHERE id='$id'";
$rs = $db->sql_query1($sql);

echo $sql;

?>