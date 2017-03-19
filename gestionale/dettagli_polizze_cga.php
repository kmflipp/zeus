<?php
global $prefix, $db, $admin, $user;
$nomefile = $_GET[nomefile];

$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$tablename = "nuke_polizze_detail_cga";

OpenTable();
	$sql = "SELECT * FROM $tablename WHERE idpolizza = $_GET[idpolizza]";
	$rs = $db->sql_query($sql);
	$nr = $db->sql_numrows($rs);
	echo '<table width=100% border=1 cellspacing=5 cellpadding=5>';
		echo '<tr>';
		echo '<th width=20%><font face=verdana size=2><a href=banner.php?ord=id>Stampa</a></th>';
		echo '<th width=40%><font face=verdana size=2><a href=banner.php?ord=filename>Filename</a></th>';
		echo '<th width=40%><font face=verdana size=2><a href=banner.php?ord=description>Description</a></th>';
		echo '</tr>';
	
		if ($nr != 0){
			for($x = 0; $x < $nr; $x++){
				$row = $db->sql_fetchrow($rs);
				echo '<tr>';
				echo "<td valign=middle align=center><font face=verdana size=3><a href='gestionale.php?name=lloyds&subname=polizze&act=explode&idpolizza=$_GET[idpolizza]&view=CGA&nomefile=$row[field2]'>Click<br>to<br>Print</a></td>";
				echo "<td valign=middle align=center><font face=verdana size=3><a href='".$row[field2]."' target=_blank>" . $row[field2] . "</a></td>";
				echo "<td valign=middle align=center><font face=verdana size=3>" . $row[field1] . "</td>";
				echo "</td>";
				echo '</tr>';
			}
		}
	echo "</table>";
CloseTable();


?>