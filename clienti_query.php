<?php
require_once("mainfile.php");
global $prefix, $db, $admin, $user;

$id = $_GET[id];
$field = $_GET[field];
$valore = $_GET[valore];

//inserisco il dato
$sql = "UPDATE nuke_clienti_detail SET $field='$valore' WHERE id=$id";
$result = $db->sql_query($sql);

//estrapolo il dato per capire se la query è andata a buon fine
$sql = "SELECT $field FROM nuke_clienti_detail WHERE id=$id";
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);
$res=0;
if ($row[$field]==$valore) $res=1;


echo "$_GET[id],$res";
?>