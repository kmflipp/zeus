<?php
global $prefix, $db, $admin, $user;
$act = $_GET[act];
$act2 = $_GET[act2];
$act3 = $_GET[act3];
$act4 = $_GET[act4];
$azioni = $_GET[azioni];
$id_entita = $_GET[id_entita];

$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$tablename = "nuke_domandeproposta";

if ($azioni=='elimina') {
	$sql = "DELETE FROM nuke_offerte_detail_2 WHERE id = " . $_GET[domandaid];
	$result = $db->sql_query($sql);
}
if ($azioni=='aggiungi') {
	$sql = "INSERT INTO nuke_offerte_detail_2 (idofferta,field1,field2) VALUES ('" . $_GET[id] . "','" . $_GET[domandaid] . "','DOMANDA')";
	$result = $db->sql_query($sql);
}


$rs_offerta = $db->sql_query("SELECT * FROM nuke_offerte where id=$_GET[id]");
$row = $db->sql_fetchrow($rs_offerta);

OpenTable();
			if ($ord=='') $ord = 'id';
			$sql = "SELECT * FROM " . $tablename . " WHERE tipopolizza = '".$row[field2]."'";
			$rs = $db->sql_query($sql);
			$nr = $db->sql_numrows($rs);
			
			echo '<table width=100% border=1 cellspacing=0 cellpadding=0>';
			echo '<tr>';
			echo '<th width=10%><font face=verdana size=2><a href=banner.php?ord=id>Stampa</a></th>';
			echo '<th width=30%><font face=verdana size=2><a href=banner.php?ord=filename>Filename</a></th>';
			echo '<th width=15%><font face=verdana size=2><a href=banner.php?ord=tipopolizza>Tipo di Polizza</a></th>';
			echo '<th width=30%><font face=verdana size=2><a href=banner.php?ord=description>Description</a></th>';
			echo '<th width=15%><font face=verdana size=2>Funzionalità</font></th>';
			echo '</tr>';

			if ($nr != 0){
				for($x = 0; $x < $nr; $x++){
				$row = $db->sql_fetchrow($rs);
				echo '<tr>';
				echo "<td valign=middle align=center><font face=verdana size=3><a href='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&view=domande&nomefile=$row[filename]'>Click<br>to<br>Print</a></td>";
				echo "<td valign=middle align=center><font face=verdana size=2><a href='".$row[filename]."' target=_blank>" . $row[filename] . "</a></td>";
				echo "<td valign=middle align=center><font face=verdana size=2>";
				$sql_tipologia = "SELECT * FROM nuke_tipologiepolizze where id='".$row[tipopolizza]."'";
				$rs_tipologia = $db->sql_query($sql_tipologia);
				$tipologia = $db->sql_fetchrow($rs_tipologia);
				echo $tipologia[field2];
				echo "</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>" . $row[description] . "</td>";
				$sql = "SELECT * FROM nuke_offerte_detail_2 WHERE field1 = '".$row[id]."' and idofferta='$_GET[id]'";
				$rs_domande = $db->sql_query($sql);
				$nr_domande = $db->sql_numrows($rs_domande);
				$domande = $db->sql_fetchrow($rs_domande);
				if ($nr_domande == 1) {$img='circle_green.png';$add='0';$remove='1';}
				if ($nr_domande == 0) {$img='circle_red.png';$add='1';$remove='0';}
				echo "<td align=right width=15%>
							<img src=immagini/$img>";
							if ($add=='1') {echo "<a href=$_SERVER[PHP_SELF]?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&azioni=aggiungi&view=domande&domandaid=$row[id]#sonoqui1><img border=0 src=immagini/add.png></a>";}
							if ($add=='0') {echo "<img border=0 src=immagini/add_grey.png>";}
							if ($remove=='1') {echo "<a href=$_SERVER[PHP_SELF]?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&azioni=elimina&view=domande&domandaid=$domande[id]#sonoqui1><img border=0 src=immagini/minus.png></a>";}
							if ($remove=='0') {echo "<img border=0 src=immagini/minus_grey.png>";}
				echo "</td>";
				echo '</tr>';
				}
			}
			echo "</table>";
CloseTable();


?>