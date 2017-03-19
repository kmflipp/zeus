<?php
$act = $_GET[act];
$act2 = $_GET[act2];
$act3 = $_GET[act3];
$act4 = $_GET[act4];
$azioni = $_GET[azioni];
$id_entita = $_GET[id_entita];

$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$tablename = "nuke_condizioni";

if ($blocca==0) {
	if ($azioni=='eliminacondizione') {
		$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE id = " . $_GET[condizioneid];
		$result = $db->sql_query($sql);
	}
	if ($azioni=='aggiungicondizione') {
		$sql = "SELECT * FROM nuke_offerte_detail_condizioni WHERE idofferta='$_GET[id]' AND field1='$_GET[condizioneid]' and field2='CONDIZIONE'";
		$rs = $db->sql_query($sql);
		$nr = $db->sql_numrows($rs);
		if ($nr=='0') {
			$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $_GET[id] . "','" . $_GET[condizioneid] . "','CONDIZIONE')";
			$result = $db->sql_query($sql);
		}
	}
}

OpenTable();
			$sql = "SELECT * FROM $tablename WHERE field0='$row[field2]' and id in (SELECT field1 FROM nuke_offerte_detail_condizioni WHERE idofferta='$_GET[id]') order by convert(int, sort)";
			$rs = $db->sql_query($sql);
			$nr = $db->sql_numrows($rs);
			echo '<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen>';
			echo '<tr>';
			echo '<th width=2% height=10><font face=verdana size=2>Check</th>';
			echo '<th width=98% height=10><font face=verdana size=2>Terms</font></th>';
			echo '</tr>';
			if ($nr != 0){
				for($x = 0; $x < $nr; $x++){
				$row2 = $db->sql_fetchrow($rs);
				$checked=' ';
				$sql = "SELECT * FROM nuke_offerte_detail_condizioni WHERE field1 = '".$row2[id]."' and idofferta='$_GET[id]'";
				$rs_cga = $db->sql_query($sql);
				$nr_cga = $db->sql_numrows($rs_cga);
				$cga = $db->sql_fetchrow($rs_cga);
				if ($nr_cga == 0) {
					$checked=' ';
				}else{
					$checked=' checked ';
				}
				echo '<tr>';
				echo "<td align=center width=1%>";
				echo "<input style=height:10; $checked type=checkbox name=been id=beens$x value='been' onClick=beensornot('beens$x',this,'$_GET[id]','$cga[id]','$row2[id]');>";
				echo "</td>";
				echo "<td valign=middle align=left><font face=verdana size=2>sort order: $row2[sort]<br>$row2[field3]<br>";
				echo "<i>-&nbsp;&nbsp;&nbsp;$row2[field1]</i>";
				echo "</td>";
				echo '</tr>';
				}
			}

			$sql = "SELECT * FROM $tablename WHERE field0='$row[field2]' and id not in (SELECT field1 FROM nuke_offerte_detail_condizioni WHERE idofferta='$_GET[id]') order by convert(int, sort)";
			$rs = $db->sql_query($sql);
			$nr = $db->sql_numrows($rs);
			if ($nr != 0){
				for($x = 0; $x < $nr; $x++){
				$row2 = $db->sql_fetchrow($rs);
				$checked=' ';
				$sql = "SELECT * FROM nuke_offerte_detail_condizioni WHERE field1 = '".$row2[id]."' and idofferta='$_GET[id]'";
				$rs_cga = $db->sql_query($sql);
				$nr_cga = $db->sql_numrows($rs_cga);
				$cga = $db->sql_fetchrow($rs_cga);
				if ($nr_cga == 0) {
					$checked=' ';
				}else{
					$checked=' checked ';
				}
				echo '<tr>';
				echo "<td align=center width=1%>";
				echo "<input style=height:10; $checked type=checkbox name=been id=beens$x value='been' onClick=beensornot('beens$x',this,'$_GET[id]','$cga[id]','$row2[id]');>";
				echo "</td>";
				echo "<td valign=middle align=left><font face=verdana size=2>sort order: $row2[sort]<br>$row2[field3]<br>";
				echo "<i>-&nbsp;&nbsp;&nbsp;$row2[field1]</i>";
				echo "</td>";
				echo '</tr>';
				}
			}
			echo "</table>";

CloseTable();


?>