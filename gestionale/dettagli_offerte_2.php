<?php
$act = $_GET[act];
$act2 = $_GET[act2];
$act3 = $_GET[act3];
$act4 = $_GET[act4];

$id_entita = $_GET[id_entita];

$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$tablename = "nuke_domandeproposta";

if ($blocca==0) {
	if ($azioni=='elimina') {
		$sql = "DELETE FROM nuke_offerte_detail_2 WHERE id = " . $_GET[domandeid];
		$result = $db->sql_query($sql);
	}
	if ($azioni=='aggiungi') {
		$sql = "INSERT INTO nuke_offerte_detail_2 (idofferta,field1,field2) VALUES ('" . $_GET[id] . "','" . $_GET[domandeid] . "','DOMANDA')";
		$result = $db->sql_query($sql);
	}
}

$rs_offerta = $db->sql_query("SELECT * FROM nuke_offerte where id=$_GET[id]");
$row1 = $db->sql_fetchrow($rs_offerta);

OpenTable();
			if ($ord=='') $ord = 'id';
			$sql = "SELECT * FROM " . $tablename . " WHERE tipopolizza = '".$row1[field2]."'";
			$rs = $db->sql_query($sql);
			$nr = $db->sql_numrows($rs);
			
			echo '<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen>';
			echo '<tr>';
			echo '<th width=10% height=10><font face=verdana size=2><a href=banner.php?ord=id>Print</a></th>';
			echo '<th width=30% height=10><font face=verdana size=2><a href=banner.php?ord=description>Description</a></th>';
			echo '<th width=15% height=10><font face=verdana size=2>Operation</font></th>';
			echo '</tr>';

			if ($nr != 0){
				for($x = 0; $x < $nr; $x++){
				$row2 = $db->sql_fetchrow($rs);

				$sql = "SELECT * FROM nuke_offerte_detail_2 WHERE field1 = '".$row2[id]."' and idofferta='$_GET[id]'";
				$rs_domande = $db->sql_query($sql);
				$nr_domande = $db->sql_numrows($rs_domande);
				$domande = $db->sql_fetchrow($rs_domande);
				if ($nr_domande == 0) {
					$checked=' ';
				}else{
					$checked=' checked ';
				}

				echo '<tr>';
				echo "<td valign=middle align=center><font face=verdana size=3>";
				if ($nr_domande != 0) echo "<a href='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&nomefile=$row2[filename]'>Go</a>";
				echo "</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>" . $row2[description] . "</td>";
				echo "<td align=center width=15%>";
				echo "<input style=height:10; $checked type=checkbox name=been1 id=been1$x value='been1' onClick=beenornot1('been1$x',this,'$_GET[id]','$domande[id]','$row2[id]');>";
				echo "</td>";
				echo '</tr>';
				}
			}
			echo "</table>";
CloseTable();


?>