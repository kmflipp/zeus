<?php
global $prefix, $db, $admin, $user;

if ($id=='') $id=$_GET[id];

$sql = "SELECT * FROM nuke_offerte WHERE id=$id";
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);

if ($_GET[pag]=='1') {
	include("template/rva1.htm");
}

?>