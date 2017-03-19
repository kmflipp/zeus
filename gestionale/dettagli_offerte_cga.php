<script>
function beenornotcga(id,questo,idofferta,cgaid,aggcgaid) {
	if (document.getElementById(id).checked) {
		window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&id='+idofferta+'&azioni=aggiungicga&cgaid='+aggcgaid+'&scrolltop='+document.getElementById('offerte').scrollTop;
	}else{
		window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&id='+idofferta+'&azioni=eliminacga&cgaid='+cgaid+'&scrolltop='+document.getElementById('offerte').scrollTop;
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

if ($blocca==0) {
	if ($azioni=='eliminacga') {
		$sql = "DELETE FROM nuke_offerte_detail_cga WHERE id = " . $_GET[cgaid];
		$result = $db->sql_query($sql);
	}
	if ($azioni=='aggiungicga') {
		$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $_GET[id] . "','" . $_GET[cgaid] . "','CGA')";
		$result = $db->sql_query($sql);
	}
}

$rs_offerta = $db->sql_query("SELECT * FROM nuke_offerte where id='$_GET[id]'");
$row1 = $db->sql_fetchrow($rs_offerta);

OpenTable();
			$sql = "SELECT * FROM nuke_cga WHERE tipopolizza = '$row1[field2]' and id in (SELECT field1 FROM nuke_offerte_detail_cga WHERE idofferta='$_GET[id]') order by description desc";
			$rs = $db->sql_query($sql);
			$nr = $db->sql_numrows($rs);
			echo '<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen>';
			echo '<tr>';
			echo '<th width=10% height=10><font face=verdana size=2>Print</th>';
			echo '<th width=30% height=10><font face=verdana size=2>Description</th>';
			echo '<th width=15% height=10><font face=verdana size=2>Operation</font></th>';
			echo '</tr>';
			if ($nr != 0){
				for($x = 0; $x < $nr; $x++){
				$row2 = $db->sql_fetchrow($rs);

				$sql = "SELECT * FROM nuke_offerte_detail_cga WHERE field1 = '".$row2[id]."' and idofferta='$_GET[id]'";

				$rs_cga = $db->sql_query($sql);
				$nr_cga = $db->sql_numrows($rs_cga);
				$cga = $db->sql_fetchrow($rs_cga);
				if ($nr_cga == 0) {
					$checked=' ';
				}else{
					$checked=' checked ';
				}

				echo '<tr>';
				echo "<td valign=middle align=center><font face=verdana size=3>";
				if ($nr_cga != 0) echo "<a href='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&nomefile=$row2[filename]'>Go</a>";
				echo "</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>" . $row2[description] . "</td>";
				echo "<td align=center width=15%>";
				echo "<input style=height:10; $checked type=checkbox name=been id=beencga$x value='been' onClick=beenornotcga('beencga$x',this,'$_GET[id]','$cga[id]','$row2[id]');>";
				echo "</td>";
				echo '</tr>';
				}
			}

			$sql = "SELECT * FROM nuke_cga WHERE tipopolizza = '$row1[field2]' and id not in (SELECT field1 FROM nuke_offerte_detail_cga WHERE idofferta='$_GET[id]') order by description desc";
			$rs = $db->sql_query($sql);
			$nr = $db->sql_numrows($rs);
			if ($nr != 0){
				for($x = 0; $x < $nr; $x++){
				$row2 = $db->sql_fetchrow($rs);

				$sql = "SELECT * FROM nuke_offerte_detail_cga WHERE field1 = '".$row2[id]."' and idofferta='$_GET[id]'";

				$rs_cga = $db->sql_query($sql);
				$nr_cga = $db->sql_numrows($rs_cga);
				$cga = $db->sql_fetchrow($rs_cga);
				if ($nr_cga == 0) {
					$checked=' ';
				}else{
					$checked=' checked ';
				}

				echo '<tr>';
				echo "<td valign=middle align=center><font face=verdana size=3>";
				if ($nr_cga != 0) echo "<a href='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&nomefile=$row2[filename]'>Go</a>";
				echo "</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>" . $row2[description] . "</td>";
				echo "<td align=center width=15%>";
				echo "<input style=height:10; $checked type=checkbox name=been id=beencga$x value='been' onClick=beenornotcga('beencga$x',this,'$_GET[id]','$cga[id]','$row2[id]');>";
				echo "</td>";
				echo '</tr>';
				}
			}
			echo "</table>";

CloseTable();


?>