<?php
require_once("mainfile.php");
global $prefix, $db, $admin, $user;

$id = $_GET[id];
$valore = $_GET[valore];
$field = $_GET[field];
$premio = $_GET[premio];

//inserisco il dato
$sql = "UPDATE nuke_offerte_detail_persone SET $field='$valore' WHERE id=$id";
$result = $db->sql_query($sql);

if ($premio!='') {
	$sql = "UPDATE nuke_offerte_detail_persone SET premio='$premio' WHERE id=$id";
	$result = $db->sql_query($sql);
}

echo $sql;
?>