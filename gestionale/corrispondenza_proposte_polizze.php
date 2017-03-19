<?php
require_once("mainfile.php");
global $prefix, $db, $admin, $user;
$id = $_GET[id];

OpenTable();
echo '<p>';
	$sql = "SELECT * FROM nuke_offerte where (field3='$id' or field4='$id') order by id DESC";
	$rs = $db->sql_query($sql);
	$nr = $db->sql_numrows($rs);

	echo "<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen>";

	if ($nr != 0){
		while ($row = $db->sql_fetchrow($rs))
		{
			$sql="SELECT * FROM nuke_polizze WHERE id='$row[id]'";
			$recordset = $db->sql_query($sql);
			$riga=$db->sql_fetchrow($recordset);
			echo "<tr>";
			echo "<td valign=middle align=center width=80%><font color=black face=verdana size=2>";
			echo "Proposta n. $row[field1]/$row[id] del $row[data], periodo di copertura $row[field6]-$row[field10]";
			if ($riga[id]!='') {
				echo "<table width=100% >
							<td align=right><font color=black face=Verdana size=2>$riga[numeropolizza] $riga[field2] del $riga[data]</font></td>
							</table>";
			}else{
				echo "<table width=100% >
							<td align=right><font color=black face=Verdana size=2>Nessuna polizza corrispondente</font></td>
							</table>";
			}
			echo "</font></td>";
			echo "<td valign=middle align=right width=20%><font color=black face=verdana size=2>";
			echo "<input type=button value=Vai onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$row[id]';> <input type=button value=Duplica onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=duplica&id=$row[id]';>";
			if ($riga[id]!='') {
				echo "<table border=0 cellspacing=0 cellpadding=0 width=100% >
							<td align=right><input type=button value=Vai onClick=window.location='gestionale.php?name=lloyds&subname=polizze&act=explode&idpolizza=$riga[idpolizza]';> <input type=button value=Rinnova onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=duplica&id=$row[id]';></td>
							</table>";
			}
			echo "</font></td>";
			echo "</tr>";
		}
	}
	echo "</table>";
echo '</p>';
CloseTable();

?>