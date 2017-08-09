<?php
require_once("mainfile.php");

global $prefix, $db, $admin, $user;
$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$idcliente = $_GET[idcliente];

OpenTable();
echo '<table width=100% border=1 cellpadding=0 cellspacing=0>';
$sql = "SELECT * FROM nuke_polizze WHERE field3=$id or field4=$id or field5=$id";
$rs = $db->sql_query($sql);
echo '<tr>';
	echo '<th width=15%><font face=verdana size=2>Numero polizza</th>';
	echo '<th width=10%><font face=verdana size=2>Tipo di assicurazione</th>';
	echo '<th width=15%><font face=verdana size=2>Periodo di copertura</th>';
	echo '<th width=10%><font face=verdana size=2>Limiti territoriali</th>';
	echo '<th width=10%><font face=verdana size=2>Rinnovo</th>';
	echo '<th width=15%><font face=verdana size=2>Somma assicurata</th>';
	echo '<th width=15%><font face=verdana size=2>Premio</th>';
	echo '<th width=10%><font face=verdana size=2 color=blue>Funzionalità</font></th>';
echo '</tr>';
$x=1;
while ($row = $db->sql_fetchrow($rs))
{
	echo '<tr>';
		echo "<td align=center valign=middle><font face=calibri size=2>$row[field1]/$row[id]</font></td>";
		echo "<td align=center valign=middle><font face=calibri size=2>";
		$tip = $db->sql_fetchrow($db->sql_query("SELECT * FROM nuke_tipologiepolizze WHERE id=$row[field2]"));
		echo $tip[field2];
		echo "</font></td>";
		echo "<td align=center valign=middle><font face=calibri size=2>$row[field6] - $row[field10]<br>giorni ".number_format($row[field11],0)."</font></td>";
		echo "<td align=center valign=middle><font face=calibri size=2>";
		$limiti = $db->sql_fetchrow($db->sql_query("SELECT * FROM nuke_limititerritoriali WHERE id=$row[field7]"));
		echo $limiti[field1];
		echo "</font></td>";
		echo "<td align=center valign=middle><font face=calibri size=2>";
		if ($row[rinnovo]=='0') echo "No"; if ($row[rinnovo]=='1') echo "Si";
		echo "</font></td>";
		echo "<td align=center valign=middle><font face=calibri size=2>$row[field8]</font></td>";
		echo "<td align=center valign=middle><font face=calibri size=2>$row[field12]</font></td>";
		echo "<td align=center valign=middle><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=polizze&act=explode&id=$row[id]><img border=0 src=immagini/select.png></a></td>";
	echo '</tr>';
}
echo '</table>';
CloseTable();

?>
