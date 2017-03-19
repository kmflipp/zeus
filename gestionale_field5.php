<?php
require_once("mainfile.php");
global $prefix, $db, $admin, $user;

$valore = $_GET[valore];
$id = $_GET[id];

//eseguo la query
$sql = "UPDATE nuke_offerte SET field5='$valore' WHERE id='$id'";
$rs = $db->sql_query1($sql);

?>