<?php
require_once("mainfile.php");
global $prefix, $db, $admin, $user;

$id = $_GET[id];
$valore = $_GET[valore];

//inserisco il dato
$sql = "UPDATE nuke_offerte_detail2 SET valore='$valore' WHERE id=$id";
$result = $db->sql_query($sql);

//estrapolo il dato per capire se la query è andata a buon fine
$sql = "SELECT valore FROM nuke_offerte_detail2 WHERE id=$id";
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);
$res=0;
if ($row[valore]==$valore) $res=1;


echo "$_GET[id],$res,$sql";
?>