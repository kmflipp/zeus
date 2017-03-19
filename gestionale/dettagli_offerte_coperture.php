<script>
function beenornot(id,questo,idofferta,cgaid,aggcgaid) {
	if (document.getElementById(id).checked) {
		window.location='gestionale.php?name=lloyds&subname=offerte&view=condizioni&act=explode&id='+idofferta+'&azioni=aggiungicondizione&copertureid='+aggcgaid;
	}else{
		window.location='gestionale.php?name=lloyds&subname=offerte&view=condizioni&act=explode&id='+idofferta+'&azioni=eliminacondizione&copertureid='+cgaid;
	}
}
</script>

<?php
global $prefix, $db, $admin, $user;
$act = $_GET[act];
$act2 = $_GET[act2];
$act3 = $_GET[act3];
$act4 = $_GET[act4];
$azioni = $_GET[azioni];
$id_entita = $_GET[id_entita];

$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$tablename = "nuke_coperture";

if ($blocca==0) {
	if ($azioni=='eliminacondizione') {
		$sql = "DELETE FROM nuke_offerte_detail_coperture WHERE id = " . $_GET[copertureid];
		$result = $db->sql_query($sql);
	}
	if ($azioni=='aggiungicondizione') {
		$sql = "INSERT INTO nuke_offerte_detail_coperture (idofferta,field1,field2) VALUES ('" . $_GET[id] . "','" . $_GET[copertureid] . "','COPERTURA')";
		$result = $db->sql_query($sql);
	}
}

$rs_offerta = $db->sql_query("SELECT * FROM nuke_offerte where id='$_GET[id]'");
$row = $db->sql_fetchrow($rs_offerta);

OpenTable();
			if ($ord=='') $ord = 'id';
			$sql = "SELECT * FROM " . $tablename;
			$rs = $db->sql_query($sql);
			$nr = $db->sql_numrows($rs);
			
			echo '<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen>';
			echo '<tr>';
			echo '<th width=80% height=10><font face=verdana size=2>Description</th>';
			echo '<th width=20% height=10><font face=verdana size=2>Funzionalità</font></th>';
			echo '</tr>';

			if ($nr != 0){
				for($x = 0; $x < $nr; $x++){
				$row = $db->sql_fetchrow($rs);

				$sql = "SELECT * FROM nuke_offerte_detail_coperture WHERE field1 = '".$row[id]."' and idofferta='$_GET[id]'";
				$rs_cga = $db->sql_query($sql);
				$nr_cga = $db->sql_numrows($rs_cga);
				$cga = $db->sql_fetchrow($rs_cga);
				if ($nr_cga == 0) {
					$checked=' ';
				}else{
					$checked=' checked ';
				}

				echo '<tr>';
				echo "<td valign=middle align=left><table width=100%><td width=50%>";
				echo "<textarea cols=80 rows=4 readonly>".str_replace("<br>","&#10;",$row[field1])."</textarea>";
				echo "</td><td width=50%>";
				echo "<textarea cols=80 rows=4 readonly>".str_replace("<br>","&#10;",$row[field2])."</textarea>";
				echo "</td></table></td>";
				echo "<td align=center width=15%>";
				echo "<input style=height:10; $checked type=checkbox name=been id=been$x value='been' onClick=beenornot('been$x',this,'$_GET[id]','$cga[id]','$row[id]');>";
				echo "</td>";
				echo '</tr>';
				}
			}
			echo "</table>";
CloseTable();


?>