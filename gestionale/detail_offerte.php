<?php
require_once("mainfile.php");

global $prefix, $db, $admin, $user;
$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$act = $_GET[act];
$id = $_GET[id];
$id_offerte = $_GET[id_offerte];
$field1 = $_GET[field1];
$field2 = $_GET[field2];
$field3 = $_GET[field3];
$field4 = $_GET[field4];

$sql = "SELECT * FROM nuke_offerte WHERE id = '" . $id_offerte . "'";
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);
$numero_offerta = $row[field1]."/".$row[id];
$sql = "SELECT * FROM CLIENTI WHERE COD = '" . $row[field3] . "'";
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);
$nominativo = $row[title]." ".$row[nome]." ".$row[cognome]." (".$row[ragione_sociale].")";

if ($act == 'savnew'){
	$sql = "INSERT INTO nuke_offerte_detail (field1,field2,field3,field4) VALUES ('" . $field1 . "','" . $field2 . "','" . $field3 . "','" . $field4 . "')";
	$db->sql_query($sql);
	$act = 'detail';
}

if ($act == 'del'){
	$sql = "DELETE FROM nuke_offerte_detail WHERE id = '" . $id . "'";
	$db->sql_query($sql);
	$act = 'detail';
}

if ($act == 'savnew1'){
	$sql = "INSERT INTO nuke_offerte_detail1 (field1,field2,field3,field4) VALUES ('" . $field1 . "','" . $field2 . "','" . $field3 . "','" . $field4 . "')";
	$db->sql_query($sql);
	$act = 'detail1';
}

if ($act == 'del1'){
	$sql = "DELETE FROM nuke_offerte_detail1 WHERE id = '" . $id . "'";
	$db->sql_query($sql);
	$act = 'detail1';
}

title("<font face=Verdana size=3><strong>Offerta $numero_offerta, $nominativo</strong></font>");

OpenTable();
echo '<p align=center>';
echo '<font face=Verdana size=3><strong>Entità Assicurate</strong></font>';
echo '</p>';
CloseTable();
OpenTable();
echo '<p>';
echo '<input type=button value="Nuovo Record" onclick="location.href=' . chr(39) . 'gestionale.php?name=detail_offerte&act=new&id_offerte=' . $id_offerte . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '<input type=button value="Mostra tutti i record" onclick="location.href=' . chr(39) . 'gestionale.php?name=detail_offerte&act=detail&id_offerte=' . $id_offerte . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '<input type=button value="Inserisci i campi di default" onclick="location.href=' . chr(39) . 'gestionale.php?name=detail_offerte&act=insertall&id_offerte=' . $id_offerte . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '</p>';
CloseTable();

OpenTable();
echo '<table width=100% border=1 cellpadding=0 cellspacing=0>';
$sql = "SELECT * FROM nuke_offerte_detail WHERE field1 = " . $id_offerte;
$rs = $db->sql_query($sql);
echo '<tr>';
	echo '<th align=center valign=middle width=50%><font face=verdana size=2><strong>Entità Assicurata</strong></font></th>';
	echo '<th align=center valign=middle width=20%><font face=verdana size=2><strong>Somma Assicurata</strong></font></th>';
	echo '<th align=center valign=middle width=20%><font face=verdana size=2><strong>Premio</strong></font></th>';
	echo '<th align=center valign=middle width=10%><font face=verdana size=2 color=blue>Funzionalità</font></th>';
echo '</tr>';

if ($act == 'new') {
	echo '<form action=gestionale.php method=get><input type=hidden name=name value=detail_offerte><input type=hidden name=act value=savnew><input type=hidden name=id_offerte value='.$id_offerte.'>';
	echo '<tr>';
	echo "<td valign=middle align=center><select name=field2><option value=''></option>";
	$sql_entita = "SELECT * FROM nuke_entita";
	$rs_entita = $db->sql_query($sql_entita);
	while ($entita = $db->sql_fetchrow($rs_entita))
	{
		echo "<option value='".$entita[id]."'>".$entita[field2]." / ".$entita[field4]."</option>";
	}
	echo "</select></td>";
	echo "<td valign=middle align=center><input type=text name=field3 size=15></td>";
	echo "<td valign=middle align=center><input type=text name=field4 size=10></td>";
	echo "<td align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
	echo '</tr>';
	echo "<input type=hidden name=field1 value='".$id_offerte."'></form>";
	$act = '';
}

while ($row = $db->sql_fetchrow($rs))
{
	echo '<tr>';
		echo '<td align=center valign=middle><font face=verdana size=2>';
		$sql_entita = "SELECT * FROM nuke_entita where id='".$row[field2]."'";
		$rs_entita = $db->sql_query($sql_entita);
		$entita = $db->sql_fetchrow($rs_entita);
		echo $entita[field2]." / ".$entita[field4];
		echo '</font></td>';
 		echo '<td align=center valign=middle><font face=verdana size=2>CHF '.number_format($row[field3],2,",",".").'</font></td>';
		echo '<td align=center valign=middle><font face=verdana size=2>CHF '.number_format($row[field4],2,",",".").'</font></td>';
		echo "<td align=center valign=middle><font face=verdana size=2><a href=gestionale.php?name=detail_offerte&act=del&id_offerte=" . $row[field1] . "&id=" . $row[id] . " " . $confirm . "><img border=0 src=immagini/del.ico></a></td>";
	echo '</tr>';
}
echo '</table>';
CloseTable();

echo "<br><br>";

OpenTable();
echo '<p align=center>';
echo '<font face=Verdana size=3><strong>Dettagli Offerta</strong></font>';
echo '</p>';
CloseTable();
OpenTable();
echo '<p>';
echo '<input type=button value="Nuovo Record" onclick="location.href=' . chr(39) . 'gestionale.php?name=detail_offerte&act=new1&id_offerte=' . $id_offerte . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '<input type=button value="Mostra tutti i record" onclick="location.href=' . chr(39) . 'gestionale.php?name=detail_offerte&act=detail1&id_offerte=' . $id_offerte . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '<input type=button value="Inserisci i campi di default" onclick="location.href=' . chr(39) . 'gestionale.php?name=detail_offerte&act=insertall1&id_offerte=' . $id_offerte . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '</p>';
CloseTable();

OpenTable();
echo '<table width=100% border=1 cellpadding=0 cellspacing=0>';
$sql = "SELECT * FROM nuke_offerte_detail1 WHERE field1 = " . $id_offerte;
$rs = $db->sql_query($sql);
echo '<tr>';
	echo '<th align=center valign=middle width=50%><font face=verdana size=2><strong>Dettaglio</strong></font></th>';
	echo '<th align=center valign=middle width=20%><font face=verdana size=2><strong>Valore</strong></font></th>';
	echo '<th align=center valign=middle width=20%><font face=verdana size=2><strong>Si/No</strong></font></th>';
	echo '<th align=center valign=middle width=10%><font face=verdana size=2 color=blue>Funzionalità</font></th>';
echo '</tr>';

if ($act == 'new1') {
	echo '<form action=gestionale.php method=get><input type=hidden name=name value=detail_offerte><input type=hidden name=act value=savnew1><input type=hidden name=id_offerte value='.$id_offerte.'>';
	echo '<tr>';
	echo "<td valign=middle align=center><select name=field2><option value=''></option>";
	$sql_entita = "SELECT * FROM nuke_dettaglipolizza";
	$rs_entita = $db->sql_query($sql_entita);
	while ($entita = $db->sql_fetchrow($rs_entita))
	{
		echo "<option value='".$entita[id]."'>".$entita[field2]." / ".$entita[field4]."</option>";
	}
	echo "</select></td>";
	echo "<td valign=middle align=center><input type=text name=field3 size=15></td>";
	echo "<td valign=middle align=center><input type=text name=field4 size=10></td>";
	echo "<td align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
	echo '</tr>';
	echo "<input type=hidden name=field1 value='".$id_offerte."'></form>";
	$act = '';
}

while ($row = $db->sql_fetchrow($rs))
{
	echo '<tr>';
		echo '<td align=center valign=middle><font face=verdana size=2>';
		$sql_entita = "SELECT * FROM nuke_dettaglipolizza where id='".$row[field2]."'";
		$rs_entita = $db->sql_query($sql_entita);
		$entita = $db->sql_fetchrow($rs_entita);
		echo $entita[field2]." / ".$entita[field4];
		echo '</font></td>';
		echo '<td align=center valign=middle><font face=verdana size=2>CHF '.number_format($row[field3],2,",",".").'</font></td>';
		echo '<td align=center valign=middle><font face=verdana size=2>CHF '.number_format($row[field4],2,",",".").'</font></td>';
		echo "<td align=center valign=middle><font face=verdana size=2><a href=gestionale.php?name=detail_offerte&act=del1&id_offerte=" . $row[field1] . "&id=" . $row[id] . " " . $confirm . "><img border=0 src=immagini/del.ico></a></td>";
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