<?php
require_once("mainfile.php");
global $prefix, $db, $admin, $user;

$idcategoria = $_GET[idcategoria];
$field = $_GET[field];
$valore = $_GET[valore];
$idofferta = $_GET[idofferta];
$id = $_GET[id];
$premio = $_GET[premio];

$valore = str_replace("'","&lsquo;",$valore);
$valore = str_replace('"','&lsquo;',$valore);

//inserisco il dato
if ($id=='') $sql1 = "UPDATE nuke_offerte_detail1 SET $field='$valore' WHERE idcategoria='$idcategoria' AND idofferta='$idofferta'";
if ($id!='') $sql1 = "UPDATE nuke_offerte_detail1 SET $field='$valore' WHERE id='$id'";
$result = $db->sql_query($sql1);
if ($premio!='') {
	if ($id=='') $sql2 = "UPDATE nuke_offerte_detail1 SET premio='$premio' WHERE idcategoria='$idcategoria' AND idofferta='$idofferta'";
	if ($id!='') $sql2 = "UPDATE nuke_offerte_detail1 SET premio='$premio' WHERE id='$id'";
	$result = $db->sql_query($sql2);
}

$sql3 = "update nuke_offerte set field8=(select sum(cast(somma as int)) from nuke_offerte_detail1 where idofferta='$id') where id='$id'";
$result = $db->sql_query1($sql3);

$sql4 = "update nuke_offerte set field12=(select sum(cast(premio as decimal(18,2))) from nuke_offerte_detail1 where idofferta='$id') where id='$id'";
$result = $db->sql_query1($sql4);

$sql = "SELECT * FROM nuke_offerte WHERE id='$idofferta'";
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);
$ribassato = $row[field12]-($row[field12]*$row[field14]/100);
$field15 = $ribassato+($ribassato*$row[field13]/100);

$sql5 = "update nuke_offerte set field15='$field15' where id='$idofferta'";
$result = $db->sql_query($sql5);


//estrapolo il dato per capire se la query è andata a buon fine
$sql = "SELECT $field FROM nuke_offerte_detail1 WHERE id=$id";
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);
$res=0;
if ($row[$field]==$valore) $res=1;

$sql = "SELECT field8 FROM nuke_offerte WHERE id=$idofferta";
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);
$somma = $row[field8];

$sql = "SELECT field12 FROM nuke_offerte WHERE id=$idofferta";
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);
$premio = $row[field12];

echo "$_GET[id],$res,$field,$somma,$premio,$field15";
?>