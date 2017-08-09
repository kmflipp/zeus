<?php
global $prefix, $db, $admin, $user;

if ($idpolizza=='') $idpolizza=$_GET[idpolizza];

$sql = "SELECT * FROM nuke_polizze WHERE idpolizza=$idpolizza";
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);

if ($_GET[pag]=='1') {
	include("template/rva_polizza.htm");
}

?>