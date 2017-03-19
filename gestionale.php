<?php


if ($_GET[name]=="admin") {
	header("Location: admin.php");
}
if ($_GET[name]=="clienti" && $_GET[act]=="explode") {
	if ($_COOKIE["idcliente"]=='') {
		setcookie("idcliente",$_GET[id]);
		header("Location: gestionale.php?name=clienti&act=explode&id=$_GET[id]");
	}
}


require_once("mainfile.php");

global $prefix, $db, $admin, $user;
if ($_GET[nomefile]=='') include("header.php");

//Gestisco le polizze scadute
$sql = "SELECT * FROM nuke_polizze WHERE status='1'";
$rs = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($rs))
{
	$anno = date("Y",strtotime($row[field10]));
	$mese = date("m",strtotime($row[field10]));
	$giorno = date("d",strtotime($row[field10]));
	if ($anno <= date("Y") && $mese < date("m")) {
				$sql = "update nuke_polizze set status='0' where idpolizza=$row[idpolizza]";
				$db->sql_query($sql);
	}
}
//company lloyds
$_SERVER[company]=1;

if ($name=='kiln') {
    $name='lloyds';
    //company kiln
    $_SERVER[company]=2;
}
$modpath .= "gestionale/".$name.".php";
include($modpath);

include("footer.php");
?>


