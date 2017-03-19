<?php
require_once("mainfile.php");
global $prefix, $db, $admin, $user;

$id = $_GET[id];
$field = $_GET[field];
$valore = $_GET[valore];

//inserisco il dato
$sql = "UPDATE nuke_offerte SET $field='$valore' WHERE id='$id'";
$result = $db->sql_query1($sql);

if ($field=='field14') $field14=$valore;
if ($field=='field16') $field16=$valore;

$sql = "SELECT * FROM nuke_offerte WHERE id='$id'";
$rs = $db->sql_query1($sql);
$row = $db->sql_fetchrow($rs);
$ribassato = $row[field12]-($row[field12]*$row[field14]/100);
$field15 = $ribassato+($ribassato*$row[field13]/100);
$field1 = $row[field1];

$sql = "UPDATE nuke_offerte SET field15='$field15' WHERE id='$id'";
$result = $db->sql_query1($sql);


if ($field14=='10') {
	$dato = $field1+5;
	$sql = "UPDATE nuke_offerte SET field16='$dato' WHERE id='$id' and field16=''";
	$result = $db->sql_query1($sql);
}elseif ($field14=='5') {
	$dato = $field1+3;
	$sql = "UPDATE nuke_offerte SET field16='$dato' WHERE id='$id' and field16=''";
	$result = $db->sql_query1($sql);
}else{
	$sql = "UPDATE nuke_offerte SET field16='' WHERE id='$id'";
	$result = $db->sql_query1($sql);
}

//estrapolo il dato per capire se la query è andata a buon fine
$sql = "SELECT $field FROM nuke_offerte WHERE id='$id'";
$rs = $db->sql_query1($sql);
$row = $db->sql_fetchrow($rs);
$res=0;
if ($row[$field]==$valore) $res=1;


echo "$_GET[id],$res,$field14,$field15";
?>