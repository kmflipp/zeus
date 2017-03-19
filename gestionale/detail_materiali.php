<?php
require_once("mainfile.php");

global $prefix, $db, $admin, $user;
$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$act = $_GET[act];
$id = $_GET[id];
$detail = $_GET[detail];
$value = $_GET[value];
$um = $_GET[um];

if ($act == 'savnew'){
	$sql = "INSERT INTO nuke_materiali_detail (id,detail,value,um) VALUES (" . $id . ",'" . $detail . "','" . $value . "','" . $um . "')";
	$db->sql_query($sql);
	$act = 'detail';
}

if ($act == 'del'){
	$sql = "DELETE FROM nuke_materiali_detail WHERE id = " . $id . " AND detail = '" . $detail . "' AND value = '" . $value . "'";
	$db->sql_query($sql);
	$act = 'detail';
}
$sql = "SELECT * FROM nuke_materiali WHERE id = " . $id;
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);

title("<strong>$row[articolo]</strong>");

OpenTable();
echo '<p>';
echo '<input type=button value="Nuovo Record" onclick="location.href=' . chr(39) . 'gestionale.php?name=detail_materiali&act=new&id=' . $id . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '<input type=button value="Mostra tutti i record" onclick="location.href=' . chr(39) . 'gestionale.php?name=detail_materiali&id=' . $id . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '</p>';
CloseTable();

OpenTable();
echo '<table width=100% border=1 cellpadding=0 cellspacing=0>';
$sql = "SELECT * FROM nuke_materiali_detail WHERE id = " . $id;
$rs = $db->sql_query($sql);
echo '<tr>';
	echo '<th align=center valign=middle width=30%><font face=verdana size=2><strong>Dettaglio</strong></font></th>';
	echo '<th align=center valign=middle width=30%><font face=verdana size=2><strong>Valore</strong></font></th>';
	echo '<th align=center valign=middle width=30%><font face=verdana size=2><strong>Unità di misura</strong></font></th>';
	echo '<th width=10%><font face=verdana size=2 color=blue>Funzionalità</font></th>';
echo '</tr>';

if ($act == 'new') {
	echo '<form action=gestionale.php method=get><input type=hidden name=name value=detail_materiali><input type=hidden name=act value=savnew><input type=hidden name=id value='.$id.'>';
	echo '<tr>';
	echo "<td valign=middle align=center><input type=text name=detail size=30></td>";
	echo "<td valign=middle align=center><input type=text name=value size=30></td>";
	echo "<td valign=middle align=center><input type=text name=um size=30></td>";
	echo "<td align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
	echo '</tr>';
	echo '</form>';
	$act = '';
}

while ($row = $db->sql_fetchrow($rs))
{
	echo '<tr>';
		echo '<td align=center valign=middle><font face=verdana size=2>'.$row[detail].'</font></td>';
		echo '<td align=center valign=middle><font face=verdana size=2>'.$row[value].'</font></td>';
		echo '<td align=center valign=middle><font face=verdana size=2>'.$row[um].'</font></td>';
		echo "<td align=center valign=middle><font face=verdana size=2><a href=gestionale.php?name=detail_materiali&act=del&id=" . $row[id] . "&detail=" . $row[detail] . "&value=" . $row[value] . "&um=" . $row[um] . " " . $confirm . "><img border=0 src=immagini/del.ico></a></td>";
	echo '</tr>';
}
echo '</table>';
CloseTable();

?>

<p align=center>
<input type=button onclick=javascript:window.close() value=Chiudi style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'>
</p>

</body>
</html>