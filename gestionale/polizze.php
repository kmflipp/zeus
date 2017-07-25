<script language=JavaScript>
function modify(idpolizza,scrolltop,ord,pag) {
	window.location='gestionale.php?name=lloyds&subname=polizze&ord=idpolizza&pag=1&act=mod&idpolizza='+idpolizza+'&scrolltop='+scrolltop;
}
function remove(idpolizza,scrolltop,ord,pag) {
	x=alert("Attenzione, questa azione non è consentita.");
	//if (x) window.location='gestionale.php?name=lloyds&subname=polizze&ord=idpolizza&pag=1&act=del&idpolizza='+idpolizza+'&scrolltop='+scrolltop;
}
</script>
<?php

require_once("mainfile.php");
global $prefix, $db, $admin, $user;

$sql = "SELECT * FROM nuke_polizze where idpolizza=$_GET[idpolizza]";
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);

if ($_GET[nomefile]!='') {
	if ($_GET[nomefile]=='/upload/NMA_2242A_ENG_PRE_CONTRACTUAL.rtf') {
		$nomefile = strstr($_GET[nomefile],".rtf",true);
		$fcontents = file_get_contents ("http://rva.dnsd.info$nomefile.htm");
		$fcontents = str_replace("QUOTEORPOLICYNUMBER", $row[numeropolizza], $fcontents);
		header("Content-Type: application/vnd.ms-word");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=$nomefile.doc");		
    echo $fcontents;
		die();
	}
	if ($_GET[nomefile]=='/upload/NMA_2226_4_ENG_All_risk_CONDITIONS.rtf') {
		$nomefile = strstr($_GET[nomefile],".rtf",true);
		$fcontents = file_get_contents ("http://rva.dnsd.info$nomefile.htm");
		$fcontents = str_replace("QUOTEORPOLICYNUMBER", $row[numeropolizza], $fcontents);
		header("Content-Type: application/vnd.ms-word");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=$nomefile.doc");		
    echo $fcontents;
		die();
	}
	if ($_GET[nomefile]=='/upload/NMA_1658_4_ENG_RENEWAL_OFFER_CLAUSE.rtf') {
		$nomefile = strstr($_GET[nomefile],".rtf",true);
		$fcontents = file_get_contents ("http://rva.dnsd.info$nomefile.htm");
		if ($row[field14]=='5') $enneyears='3';
		if ($row[field14]=='10') $enneyears='5';
		if ($row[field14]<'8') $enneyears='3';
		if ($row[field14]>'8') $enneyears='5';
		if ($enneyears=='3') $unitldate=strtotime('+3 years',strtotime($row[field6]));
		if ($enneyears=='5') $unitldate=strtotime('+5 years',strtotime($row[field6]));
		$fcontents = str_replace("ENNEYEARS", $enneyears, $fcontents);
		$fcontents = str_replace("FROMDATE",  $row[field6], $fcontents);
		$fcontents = str_replace("UNTILDATE", date("d.m.Y",$unitldate), $fcontents);
		header("Content-Type: application/vnd.ms-word");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=$nomefile.doc");		
    echo $fcontents;
		die();
	}
}

include("header.php");
$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$act = $_GET[act];
$idpolizza = $_GET[idpolizza];
$idcliente = $_GET[idcliente];
$pag = $_GET[pag];
$ord = $_GET[ord];
$tablename = "nuke_polizze";

$numeropolizza = $_GET[numeropolizza];
$field1 = $_GET[field1];
$field2 = $_GET[field2];
$field3 = $_GET[field3];
$field4 = $_GET[field4];
$field5 = $_GET[field5];
$field6 = $_GET[field6];
$field7 = $_GET[field7];
$field8 = $_GET[field8];
$field9 = $_GET[field9];
$field10 = $_GET[field10];
$field11 = $_GET[field11];
$rinnovo = $_GET[rinnovo];
$valuta = $_GET[valuta];
$franchigia = $_GET[franchigia];
$data = $_GET[data];

title("$sitename: Gestione <i>polizze</i> LLOYD'S");

?>
	<script>
		if (navigator.appName=='Netscape') {
			if (screen.height>1000) allora=screen.height-260;
			if (screen.height<1000) allora=screen.height-290;
			document.write('<div class="offerte" id="offerte" style="position:relative;width:100%;margin-top:0;  _position:absolute;_top:expression(eval(document.body.scrollTop)+58);height:'+allora+'px;overflow:auto;padding:0px;">');
		}
		if (navigator.appName=='Microsoft Internet Explorer') {
			if (window.document.documentElement.offsetHeight>1000) allora=window.document.documentElement.offsetHeight-200;
			if (window.document.documentElement.offsetHeight<1000) allora=window.document.documentElement.offsetHeight-200;
			document.write('<div class="offerte" id="offerte" style="position:relative;width:100%;margin-top:100;_position:absolute;_top:expression(eval(document.body.scrollTop)+58);height:'+allora+'px;overflow:auto;padding:0px;">');
		}
	</script>
<?php

	if ($act=='sav'){
		$sql = "UPDATE $tablename SET  data='$_GET[data]' where idpolizza='$idpolizza'";
		$result = $db->sql_query($sql);
		header("Location: gestionale.php?name=lloyds&subname=polizze&act=explode&idpolizza=$idpolizza");
	}
	if ($act == 'del'){
		$sql = "DELETE FROM $tablename WHERE idpolizza=$idpolizza";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_clienti_polizze WHERE idpolizza=$idpolizza";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_polizze_detail1 WHERE idpolizza=$idpolizza";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_polizze_detail2 WHERE idpolizza=$idpolizza";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_polizze_detail_cga WHERE idpolizza=$idpolizza";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_polizze_ldr WHERE idpolizza=$idpolizza";
		$result = $db->sql_query($sql);

		header("Location: gestionale.php?name=lloyds&subname=polizze");
	}

	if ($idpolizza == '') $idpolizza = '%';
	if ($act == 'explode') {
		if ($id     == '') $id = '%';
		$condizioni = " WHERE id LIKE '$id' ";
	}
	
	if ($act=='gosearch') {
		if ($field1 == '') $field1 = '%';
		if ($field2 == '') $field2 = '%';
		if ($field3 == '') $field3 = '%';
		if ($field4 == '') $field4 = '%';
		if ($field5 == '') $field5 = '%';
		if ($field6 == '') $field6 = '%';
		if ($field7 == '') $field7 = '%';
		if ($field8 == '') $field8 = '%';
		if ($field9 == '') $field9 = '%';
		if ($field10 == '') $field10 = '%';
		if ($field11 == '') $field11 = '%';
		if ($rinnovo == '') $rinnovo = '%';
		if ($valuta == '') $valuta = '%';
		if ($franchigia == '') $franchigia = '%';
		if ($data == '') $data = '%';
		if ($numeropolizza == '') $numeropolizza = '%';

		$condizioni .= " WHERE data LIKE '$data' AND franchigia LIKE '$franchigia' AND valuta LIKE '$valuta' AND field1 LIKE '$field1' AND field2 LIKE '$field2' AND field3 LIKE '$field3' AND field4 LIKE '$field4' AND field5 LIKE '$field5' AND field6 LIKE '$field6' AND field7 LIKE '$field7' AND field8 LIKE '$field8' AND field9 LIKE '$field9' AND field10 LIKE '$field10' AND field11 LIKE '$field11' AND rinnovo LIKE '$rinnovo' ";
	}
	$x_pag = 2500; //numero massimo di record per pagina
	if ($pag=='') $pag = 1; //prendo il numero di pagina dal query string e se non c'è lo setto a 1
	if ($act=='mod') $pag=1;
	if ($act=='explode') $pag=1;
	if ($ord=='') $ord = 'idpolizza';
	
	$sql = "SELECT * FROM $tablename $condizioni";
	$query = $db->sql_query($sql);
	$all_rows = $db->sql_numrows($query);

	$all_pages = ceil($all_rows / $x_pag);
	$first = ($pag - 1) * $x_pag;
	$sql = "SELECT * FROM $tablename $condizioni ORDER BY $ord LIMIT $first, $x_pag";
	$rs = $db->sql_query($sql);
	$nr = $db->sql_numrows($rs);

	OpenTable();
	echo '<p>';
	echo '<input type=button value="Ricerca" onclick="location.href=' . chr(39) . 'gestionale.php?name=lloyds&subname=polizze&act=search&ord=' . $ord . '&pag='. $pag . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
	echo '<input type=button value="Mostra tutti i record" onclick="location.href=' . chr(39) . 'gestionale.php?name=lloyds&subname=polizze' . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
	echo '</p>';

	echo '<p align=center><table width=99% border=1 cellspacing=0 cellpadding=0>';
	echo '<tr>';
	echo '<th width=10%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=polizze&ord=field1>Numero polizza</a></th>';
	echo '<th width=15%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=polizze&ord=field2>Tipo di assicurazione</a></th>';
	echo '<th width=20%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=polizze&ord=field3>Nominativo</a></th>';
	echo '<th width=10%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=polizze&ord=field6>Periodo di copertura</a></th>';
	echo '<th width=10%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=polizze&ord=field7>Limiti territoriali</a></th>';
	echo '<th width=5%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=polizze&ord=valuta>Valuta</a></th>';
	echo '<th width=5%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=polizze&ord=franchigia>Franchigia</a></th>';
	echo '<th width=10%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=polizze&ord=rinnovo>Rinnovo</a></th>';
	echo '<th width=10%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=polizze&ord=data>Data polizza</a></th>';
	echo '<th width=10% colspan=3><font face=verdana size=2 color=blue>Funzionalità</font></th>';
	echo '</tr>';

	if ($act == 'search') {
		echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=name value=lloyds><input type=hidden name=subname value=polizze>';
		echo '<input type=hidden name=pag value=' . $pag . '>';
		echo '<input type=hidden name=act value=gosearch>';
		echo '<tr>';
		echo "<td valign=middle align=center><input size=4 type=text name=idpolizza></td>";
		echo "<td valign=middle align=center><select name=field2><option value=''></option>";
		$sql_polizze = "SELECT distinct field2 FROM nuke_polizze";
		$rs_polizze = $db->sql_query($sql_polizze);
		while ($polizze = $db->sql_fetchrow($rs_polizze))
		{
			echo "<option value='".$polizze[field2]."'>".$polizze[field2]."</option>";
		}
		echo "</select></td>";
		echo "<td valign=middle align=center><font face=verdana size=2>Stipulante:<br><select name=field3><option value=''></option>";
		$sql_customer = "SELECT * FROM nuke_clienti_polizze";
		$rs_customer = $db->sql_query($sql_customer);
		while ($customer = $db->sql_fetchrow($rs_customer))
		{
			if ($customer[ragione_sociale]=='') {$testo = $customer[cognome]." ".$customer[nome];}
			else{ $testo = $customer[ragione_sociale]; }
			echo "<option value='".$customer[id]."'>".$testo."</option>";
		}
		echo "</select><br>";
		echo "<font face=verdana size=2>Assicurato:<br><select name=field4><option value=''></option>";
		$sql_customer = "SELECT * FROM nuke_clienti_polizze";
		$rs_customer = $db->sql_query($sql_customer);
		while ($customer = $db->sql_fetchrow($rs_customer))
		{
			if ($customer[ragione_sociale]=='') {$testo = $customer[cognome]." ".$customer[nome];}
			else{ $testo = $customer[ragione_sociale]; }
			echo "<option value='".$customer[id]."'>".$testo."</option>";
		}
		echo "</select><br>";
		echo "<font face=verdana size=2>Assicurato:<br><input type=text size=30 name=field5>";
		//$sql_customer = "SELECT * FROM nuke_clienti";
		//$rs_customer = $db->sql_query($sql_customer);
		//while ($customer = $db->sql_fetchrow($rs_customer))
		//{
			//echo "<option value='".$customer[id]."'>".$customer[ragione_sociale]." - ".$customer[cognome]." ".$customer[nome]."</option>";
		//}
		//echo "</select>";
		echo "</td>";
		echo "<td valign=middle align=center>";
		echo "Da:<br><input type=text name=field6 id=sel3 size=11><input type=reset value='.'";
		?> onclick="return showCalendar('sel3', '%d.%m.%Y');" <?php echo ">";
		echo "<br>";
		echo "A:<br><input type=text name=field10 id=sel4 size=11><input type=reset value='.'";
		?> onclick="return showCalendar('sel4', '%d.%m.%Y');" <?php echo ">";
		echo "</td>";
		echo "<td valign=middle align=center><select name=field7><option value=''></option>";
		$sql_limititerritoriali = "SELECT distinct field7 FROM nuke_polizze";
		$rs_limititerritoriali = $db->sql_query($sql_limititerritoriali);
		while ($limititerritoriali = $db->sql_fetchrow($rs_limititerritoriali))
		{
			echo "<option value='".$limititerritoriali[id]."'>".$limititerritoriali[field1]."</option>";
		}
		echo "</select></td>";
		echo "<td valign=middle align=center><select name=valuta><option selected value='CHF'>CHF</option><option value='EUR'>EUR</option><option value='USD'>USD</option><option value='GBP'>GBP</option></td>";
		echo "<td valign=middle align=center><input type=text name=franchigia size=5></td>";
		echo "<td valign=middle align=center><select name=rinnovo><option value=1>Si</option><option value=0>No</option></td>";
		echo "<td valign=middle align=center>";
		echo "<input type=text name=data id=sel5 size=11><input type=reset value='.'";
		?> onclick="return showCalendar('sel5', '%d.%m.%Y');" <?php echo ">";
		echo "</td>";
		echo "<td colspan=3 align=center valign=middle><input type=submit value=Cerca style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
		echo '</tr>';
		echo '</form>';
		$act = '';
	}
	if ($nr != 0){
		while ($row = $db->sql_fetchrow($rs))
		{
			if ($idpolizza == $row['idpolizza'] && $act == 'mod'){
				echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=name value=lloyds><input type=hidden name=subname value=polizze><input type=hidden name=pag value=' . $pag . '><input type=hidden name=act value=sav><input type=hidden name=idpolizza value=' . $idpolizza . '>';
				echo "<input type=hidden name=field1 value=$row[field1]>";
				echo '<tr>';
				echo "<td valign=middle align=center><font face=verdana size=2>$row[numeropolizza]</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>$row[field2]</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>";
				$sql_nominativo = "SELECT * FROM nuke_clienti_polizze where id=$row[field3] and idpolizza=$idpolizza";
				$rs_nominativo = $db->sql_query($sql_nominativo);
				$nominativo = $db->sql_fetchrow($rs_nominativo);
				if ($row[field3]!='') {
					echo "Stipulante: <strong>";
					if ($nominativo[ragione_sociale]=='') {$testo = $nominativo[cognome]." ".$nominativo[nome];}
					else{ $testo = $nominativo[ragione_sociale]; }
					echo $testo;
				}
				$sql_nominativo = "SELECT * FROM nuke_clienti_polizze where id=$row[field4] and idpolizza=$idpolizza";
				$rs_nominativo = $db->sql_query($sql_nominativo);
				$nominativo = $db->sql_fetchrow($rs_nominativo);
				if ($row[field4]!='') {
					echo "<hr>";
					echo "Assicurato: <strong>";
					if ($nominativo[ragione_sociale]=='') {$testo = $nominativo[cognome]." ".$nominativo[nome];}
					else{ $testo = $nominativo[ragione_sociale]; }
					echo $testo;
				}
				if ($row[field5]!='') {
					echo "<hr>";
					echo "Assicurato: ";
					echo "<strong>".$row[field5]."</strong>";
				}
				echo "</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>Da: " . $row[field6] . "<br>A: " . $row[field10] . "<br>Differenza gg: " . number_format($row[field11],0,'','') . "</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>$row[field7]</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>$row[valuta]</font></td>";
				echo "<td valign=middle align=center><font face=verdana size=2>$row[franchigia]</font></td>";
				echo "<td valign=middle align=center><font face=verdana size=2>";
				if ($row[rinnovo]=='1') echo "Si"; if ($row[rinnovo]=='0') echo "No";
				echo "</td>";
				echo "<td valign=middle align=center>";
				echo "<input type=text name=data value='$row[data]' id=sel5 size=11><input type=reset value='.'";
				?> onclick="return showCalendar('sel5', '%d.%m.%Y');" <?php echo ">";
				echo "</td>";
				echo "<td colspan=3 align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
				echo '</tr>';
				echo '</form>';
			}else{
				echo '<tr>';
				echo "<td valign=middle align=center><font face=verdana size=2>$row[numeropolizza]</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>$row[field2]</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>";
				$sql_nominativo = "SELECT * FROM nuke_clienti_polizze where id='".$row[field3]."'";
				$rs_nominativo = $db->sql_query($sql_nominativo);
				$nominativo = $db->sql_fetchrow($rs_nominativo);
				if ($row[field3]!='') {
					echo "Stipulante: <strong>";
					if ($nominativo[ragione_sociale]!='') echo $nominativo[ragione_sociale]." - ";
					echo $nominativo[cognome]." ".$nominativo[nome]."</strong>";
				}
				$sql_nominativo = "SELECT * FROM nuke_clienti_polizze where id='".$row[field4]."'";
				$rs_nominativo = $db->sql_query($sql_nominativo);
				$nominativo = $db->sql_fetchrow($rs_nominativo);
				if ($row[field4]!='') {
					echo "<hr>";
					echo "Assicurato: <strong>";
					if ($nominativo[ragione_sociale]!='') echo $nominativo[ragione_sociale]." - ";
					echo $nominativo[cognome]." ".$nominativo[nome]."</strong>";
				}
				if ($row[field5]!='') {
					echo "<hr>";
					echo "Assicurato: ";
					echo "<strong>".$row[field5]."</strong>";
				}
				echo "</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>Da: " . $row[field6] . "<br>A: " . $row[field10] . "<br>Differenza gg: " . number_format($row[field11],0,'','') . "</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>$row[field7]</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>$row[valuta]</font></td>";
				echo "<td valign=middle align=center><font face=verdana size=2>$row[franchigia]</font></td>";
				echo "<td valign=middle align=center><font face=verdana size=2>";
				if ($row[rinnovo]=='1') echo "Si"; if ($row[rinnovo]=='0') echo "No";
				echo "</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>$row[data]</font></td>";
				echo "<td align=center valign=middle><font face=verdana size=2><a href=# onClick=modify($row[idpolizza],eval(document.getElementById('offerte').scrollTop),'idpolizze','1');><img border=0 src=immagini/modify.png></a></td>";
				echo "<td align=center valign=middle><font face=verdana size=2><a href=# onClick=remove($row[idpolizza],eval(document.getElementById('offerte').scrollTop),'idpolizze','1');><img border=0 src=immagini/remove.png></a></td>";
				echo "<td align=center valign=middle><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=polizze&act=explode&idpolizza=" . $row[idpolizza] . "#sonoqui><img border=0 src=immagini/select.png></a></td>";
				echo '</tr>';
			}
			if ($act=='explode') {
				$valuta = $row[valuta];
				echo "</table>";
				CloseTable();
				if ($_GET[view]=='CGA') {
				title("<center>
							<input type=button value=Chiudi onclick=location.href='gestionale.php?name=lloyds&subname=polizze'>
							<input type=button value=Stampa onclick=location.href='gestionale.php?name=stampa_polizza&idpolizza=$idpolizza&pag=1'>
							<input type=button value='Anteprima di Stampa Polizza' onclick=location.href='gestionale.php?name=lloyds&subname=polizze&act=explode&idpolizza=$idpolizza'>
							");
				}else{
				title("<center>
							<input type=button value=Chiudi onclick=location.href='gestionale.php?name=lloyds&subname=polizze'>
							<input type=button value=Stampa onclick=location.href='gestionale.php?name=stampa_polizza&idpolizza=$idpolizza&pag=1'>
							<input type=button value='Stampa CGA' onclick=location.href='gestionale.php?name=lloyds&subname=polizze&act=explode&idpolizza=$idpolizza&view=CGA'>
							");
				}
				?>
				<script>
					if (navigator.appName=='Netscape') {
						if (screen.height>1000) allora=screen.height-440;
						if (screen.height<1000) allora=screen.height-470;
						document.write('<div class="offerte_detail_1" id="offerte_detail_1" style="position:relative;width:100%;margin-top:0;  _position:absolute;_top:expression(eval(document.body.scrollTop)+58);height:'+allora+'px;overflow:auto;padding:0px;">');
					}
					if (navigator.appName=='Microsoft Internet Explorer') {
						if (window.document.documentElement.offsetHeight>1000) allora=window.document.documentElement.offsetHeight-380;
						if (window.document.documentElement.offsetHeight<1000) allora=window.document.documentElement.offsetHeight-380;
						document.write('<div class="offerte_detail_1" id="offerte_detail_1" style="position:relative;width:100%;margin-top:120;_position:absolute;_top:expression(eval(document.body.scrollTop)+58);height:'+allora+'px;overflow:auto;padding:0px;">');
					}
				</script>
				<?php
				if ($_GET[view]=='CGA') {
					include('dettagli_polizze_cga.php');
				}else{
					echo "<center><table width=100% border=0><td bgcolor=white>";
					$anteprima="1";
					include("/template/rva_polizza.htm");
					echo "</td></table></center>";
				}
				?>
				<script language=JavaScript>
					document.getElementById("offerte_detail_1").scrollTop=<?php echo $_GET[scrolltop]; ?>;
				</script>
				<?php
				echo "</div>";
				break 2;
			}
		}
	}
echo '</p>';
?>
<script language=JavaScript>
	document.getElementById("offerte").scrollTop=<?php echo $_GET[scrolltop]; ?>;
</script>
<?php
echo "</div>";
?>