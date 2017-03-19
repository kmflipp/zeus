<script>
function vai9(nomegruppo) {
	nomegruppo = nomegruppo.replace('_',' ');
	nuovonome = window.prompt('Type the new name for the group:',nomegruppo);
	location.href='gestionale.php?name=lloyds&subname=offerte&view=editavanzato&act=explode&id=<?php echo $_GET[id]; ?>&scrolltop='+document.getElementById('offerte').scrollTop+'&group='+nomegruppo+'&nuovonome='+nuovonome+'&azione=rinominagruppo';
}	
</script>
<?php
$act = $_GET[act];
$id = $_GET[id];
$tablename = "nuke_offerte_detail_persone";

if ($_GET[action]=='salva') {
	$sql = "update nuke_offerte_detail_coperture set $_GET[fielda]='$_GET[valuea]',$_GET[fieldb]='$_GET[valueb]',$_GET[fieldc]='$_GET[valuec]' where id=$_GET[idriga]";
	$db->sql_query($sql);

	header("Location: gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&view=editavanzato&group=$_GET[group]&scrolltop=$_GET[scrolltop]");
}

if ($_GET[azione]=='add') {
	$sql = "INSERT INTO $tablename (idofferta,nome,cognome,nascita,indirizzo,codfisc,gruppo) VALUES ('$id','$_GET[nome]','$_GET[cognome]','$_GET[nascita]','$_GET[indirizzo]','$_GET[codfisc]','$_GET[selectedgroup]')";
	$rs = $db->sql_query($sql);

	header("Location: gestionale.php?name=lloyds&subname=offerte&view=editavanzato&act=explode&id=$id&scrolltop=$_GET[scrolltop]");
}


if ($_GET[azione]=='deleteall') {
	$sql = "DELETE FROM $tablename WHERE id=$_GET[rowpersid]";
	$rs = $db->sql_query($sql);

	header("Location: gestionale.php?name=lloyds&subname=offerte&view=editavanzato&act=explode&id=$id&scrolltop=$_GET[scrolltop]");
}

if ($_GET[azione]=='modifiyname') {
	$sql = "SELECT * FROM $tablename WHERE id=$_GET[rowpersid]";
	$rs = $db->sql_query($sql);
	$row = $db->sql_fetchrow($rs);
	$saved_name=$row[nome];
	$saved_lastname=$row[cognome];
	$saved_nascita=$row[nascita];
	$saved_indirizzo=$row[indirizzo];
	$saved_codfisc=$row[codfisc];
	$saved_gruppo=$row[gruppo];

	$sql = "DELETE FROM $tablename WHERE id=$_GET[rowpersid]";
	$rs = $db->sql_query($sql);

	header("Location: gestionale.php?name=lloyds&subname=offerte&view=editavanzato&act=explode&id=$id&scrolltop=$_GET[scrolltop]&new_person=1&group_name=$saved_guppo&saved_name=$saved_name&saved_lastname=$saved_lastname&saved_nascita=$saved_nascita&saved_indirizzo=$saved_indirizzo&saved_codfisc=$saved_codfisc");
}

if ($_GET[azione]=='aggiungi_copertura') {
	$sql = "INSERT INTO nuke_offerte_detail_coperture (idofferta,idcopertura,gruppo) VALUES ('$_GET[id]','$_GET[idcopertura]','$_GET[group]')";
	$rs = $db->sql_query($sql);
	header("Location: gestionale.php?name=lloyds&subname=offerte&view=editavanzato&act=explode&id=$id&scrolltop=$_GET[scrolltop]&group=$_GET[group]");
}

if ($_GET[azione]=='delete_copertura') {
	$sql = "DELETE FROM nuke_offerte_detail_coperture WHERE id=$_GET[idcoperturetabellaofferte]";
	$rs = $db->sql_query($sql);

	header("Location: gestionale.php?name=lloyds&subname=offerte&view=editavanzato&act=explode&id=$id&scrolltop=$_GET[scrolltop]&group=$_GET[group]");
}

if ($_GET[azione]=='eliminagruppo') {
	$sql = "DELETE FROM nuke_offerte_detail_coperture WHERE gruppo='$_GET[group]' and idofferta='$_GET[id]'";
	$rs = $db->sql_query($sql);
	$sql = "DELETE FROM nuke_offerte_detail_persone WHERE gruppo='$_GET[group]' and idofferta='$_GET[id]'";
	$rs = $db->sql_query($sql);

	header("Location: gestionale.php?name=lloyds&subname=offerte&view=editavanzato&act=explode&id=$id&scrolltop=$_GET[scrolltop]");
}

if ($_GET[azione]=='rinominagruppo') {
	$sql = "UPDATE nuke_offerte_detail_coperture SET gruppo='$_GET[nuovonome]' WHERE gruppo='$_GET[group]' and idofferta='$_GET[id]'";
	$rs = $db->sql_query($sql);

	header("Location: gestionale.php?name=lloyds&subname=offerte&view=editavanzato&act=explode&id=$id&scrolltop=$_GET[scrolltop]");
}

if ($_GET[azione]=='aggiungi') {
	//imposto una franchigia di default se serve in base alle specifiche
	if ($_GET[idcopertura]=='15' || $_GET[idcopertura]=='16' || $_GET[idcopertura]=='17' || $_GET[idcopertura]=='29' || $_GET[idcopertura]=='20' || $_GET[idcopertura]=='13') {
		$valore = str_replace("'","&lsquo;",$_GET[franchigia]);
		if ($valore!='') {
			$sql = "UPDATE nuke_offerte SET franchigia='$valore' WHERE id='$id'";
			$rs = $db->sql_query1($sql);
		}
	}
	$sql = "INSERT INTO $tablename (idofferta,nome,cognome,nascita,idcopertura,importo,tasso,premio) VALUES ('$id','$_GET[nome]','$_GET[cognome]','$_GET[nascita]','$_GET[idcopertura]','','','')";
	$rs = $db->sql_query($sql);
	if ($_GET[idcopertura]=='19') { //se ho selezionato PDB SCALA A solo infortuni butto su di default il solo malattia
		$sql = "INSERT INTO $tablename (idofferta,nome,cognome,nascita,idcopertura,importo,tasso,premio) VALUES ('$id','$_GET[nome]','$_GET[cognome]','$_GET[nascita]','18','','','')";
		$rs = $db->sql_query($sql);
	}
	if ($_GET[idcopertura]=='18') { //se ho selezionato PDB SCALA A solo malattia butto su di default il solo infortuni
		$sql = "INSERT INTO $tablename (idofferta,nome,cognome,nascita,idcopertura,importo,tasso,premio) VALUES ('$id','$_GET[nome]','$_GET[cognome]','$_GET[nascita]','19','','','')";
		$rs = $db->sql_query($sql);
	}
	if ($_GET[idcopertura]=='31') { //se ho selezionato PDB SCALA B solo infortuni butto su di default il solo malattia
		$sql = "INSERT INTO $tablename (idofferta,nome,cognome,nascita,idcopertura,importo,tasso,premio) VALUES ('$id','$_GET[nome]','$_GET[cognome]','$_GET[nascita]','18','','','')";
		$rs = $db->sql_query($sql);
	}
	if ($_GET[idcopertura]=='18') { //se ho selezionato PDB SCALA B solo malattia butto su di default il solo infortuni
		$sql = "INSERT INTO $tablename (idofferta,nome,cognome,nascita,idcopertura,importo,tasso,premio) VALUES ('$id','$_GET[nome]','$_GET[cognome]','$_GET[nascita]','31','','','')";
		$rs = $db->sql_query($sql);
	}
	if ($_GET[idcopertura]=='16') { //se ho selezionato TTD solo infortuni butto su di default il solo malattia
		$sql = "INSERT INTO $tablename (idofferta,nome,cognome,nascita,idcopertura,importo,tasso,premio) VALUES ('$id','$_GET[nome]','$_GET[cognome]','$_GET[nascita]','15','','','')";
		$rs = $db->sql_query($sql);
	}
	if ($_GET[idcopertura]=='15') { //se ho selezionato TTD solo malattia butto su di default il solo infortuni
		$sql = "INSERT INTO $tablename (idofferta,nome,cognome,nascita,idcopertura,importo,tasso,premio) VALUES ('$id','$_GET[nome]','$_GET[cognome]','$_GET[nascita]','16','','','')";
		$rs = $db->sql_query($sql);
	}
	if ($_GET[idcopertura]=='20') { //se ho selezionato spese mediche solo infortuni butto su di default il solo malattia
		$sql = "INSERT INTO $tablename (idofferta,nome,cognome,nascita,idcopertura,importo,tasso,premio) VALUES ('$id','$_GET[nome]','$_GET[cognome]','$_GET[nascita]','13','','','')";
		$rs = $db->sql_query($sql);
	}
	if ($_GET[idcopertura]=='13') { //se ho selezionato spese mediche solo malattia butto su di default il solo infortuni
		$sql = "INSERT INTO $tablename (idofferta,nome,cognome,nascita,idcopertura,importo,tasso,premio) VALUES ('$id','$_GET[nome]','$_GET[cognome]','$_GET[nascita]','20','','','')";
		$rs = $db->sql_query($sql);
	}

	//imposto le CGA di degfault quando seleziono PTD o TTD
	if ($_GET[idcopertura]!='6' || $_GET[idcopertura]!='13' || $_GET[idcopertura]!='20' || $_GET[idcopertura]!='29') { 
		$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id' AND field1='69'";
		$result = $db->sql_query($sql);			
		$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','69','CGA')";
		$result = $db->sql_query($sql);
	}
	header("Location: gestionale.php?name=lloyds&subname=offerte&view=editavanzato&act=explode&id=$id&scrolltop=$_GET[scrolltop]");
}

OpenTable();
echo "<center><strong>Covers and People</strong></center>";
echo "<p><input type=button value='New Group' onClick=location.href='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id&new_group=1&scrolltop='+document.getElementById('offerte').scrollTop;> <input type=button value='New Assured Person' onClick=location.href='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id&new_person=1&scrolltop='+document.getElementById('offerte').scrollTop;></p>";
$gruppo_salvato = '';
$thereis=0;
$sql = "SELECT distinct gruppo FROM nuke_offerte_detail_coperture where idofferta='$_GET[id]'";
$rsgruppi = $db->sql_query($sql);
$nrgruppi = $db->sql_numrows($rsgruppi);
while ($rowgruppi = $db->sql_fetchrow($rsgruppi)) {
	if ($_GET[group]==$rowgruppi[gruppo]) $thereis=1;
}
if ($_GET[group]!='') {
	if ($thereis==0) {
		$gruppo_salvato=$_GET[group];
		$_GET[group]='';
		$_GET[new_group]='1';
		if ($gruppo_salvato=='') $gruppo_savlato="{insert UNIQUE name}";
	}
}
if ($_GET[new_group]=='1' || $_GET[group]!='') {
OpenTable();
	if ($_GET[group]!='') {
		echo "<font face=calibri style=font-size:16px;>Covers group: $_GET[group]</font>";
		echo "<input type=hidden id=group value='$_GET[group]'>";
	}else{
		$_GET[group]=$gruppo_salvato;
		echo "<font face=calibri style=font-size:16px;>Covers group name: <input type=text id=group size=50 value='$gruppo_salvato'></strong></font>";
	}
	echo "<table width=60% border=1 cellspacing=0 cellpadding=2 bordercolor=darkgreen bgcolor=pink>";
	$sql = "SELECT * FROM nuke_coperture where new=1 order by field3";
	$rscoperture = $db->sql_query($sql);
	while ($rowcoperture = $db->sql_fetchrow($rscoperture)) {
		//form per inserimento nuovo gruppo o modifica gruppo esistente
		$cateprecedente = $cate;
		$cate=$rowcoperture[field3];
		if ($cateprecedente!=$cate) {
			echo "<tr>";
				echo "<td colspan=4><font face=calibri style=font-size:10px;color:$color><strong>$rowcoperture[field3]</td>";
			echo "</tr>";
		}
		echo "<tr>";
		$sql = "SELECT * FROM nuke_offerte_detail_coperture where idofferta='$_GET[id]' and idcopertura='$rowcoperture[id]' and gruppo='$_GET[group]'";
		$rscoperture1 = $db->sql_query($sql);
		$nrcoperture1 = $db->sql_numrows($rscoperture1);
		$rowcoperture1 = $db->sql_fetchrow($rscoperture1);
		if ($nrcoperture1>0) $checked=' checked ';
		echo "<td align=center width=5%></td>";
		echo "<td align=center width=1%><input style=height:10; $checked type=checkbox name=been id=$rowcoperture[id] onClick=".chr(34)."beenornot_coperture('$rowcoperture[id]','$id','$rowcoperture1[id]','$_GET[group]');".chr(34)."></td>";
		echo "<td align=left width=34%><font face=calibri>".$rowcoperture[field1]."</td>";
		echo "<td align=center width=60%>";
		if ($rowcoperture[field1]=='SCALA A') $checked=' ';
		if ($rowcoperture[field1]=='SCALA B') $checked=' ';
		if ($checked==' checked ') {
			echo "<input type=text size=18 id=text$x value='$rowcoperture1[importo]'>";
			$importo_x=$x;
			$x++;
			echo "<input type=text size=10 id=text$x value='$rowcoperture1[tasso]' onKeyUp=calcola1('$x');>";
			$tasso_x=$x;
			$x++;
			echo "<input type=text size=18 id=text$x value='$rowcoperture1[premio]'>";
			$premio_x=$x;
			$x++;
			echo "&nbsp;";
			echo "<input type=button value=Upd onClick=\"window.location='gestionale.php?name=lloyds&subname=offerte&action=salva&view=editavanzato&act=explode&id=$id&scrolltop='+document.getElementById('offerte').scrollTop+'&fielda=importo&fieldb=tasso&fieldc=premio&valuea='+document.getElementById('text$importo_x').value+'&valueb='+document.getElementById('text$tasso_x').value+'&valuec='+document.getElementById('text$premio_x').value+'&group=$_GET[group]&idriga=$rowcoperture1[id]';\">";
		}
		$x++;
		echo "</td>";
		echo "</tr>";
		$checked=' ';
	}
	echo "</table><br>";
	echo "<center><input type=button value=Close onClick=location.href='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id&view=editavanzato&scrolltop=$_GET[scrolltop]'></center>";
CloseTable();
}
if ($nrgruppi==0 && $_GET[new_person]=='1') {
	$_GET[new_person]=0;
	echo "
				<script>alert('Warning, before insert assured people, create a group.');</script>
				";
}
if ($_GET[new_person]=='1') {
OpenTable();
	echo "<table width=60% border=1 cellspacing=0 cellpadding=2 bordercolor=darkgreen bgcolor=pink>";
	echo "<tr>
					<th width=25% align=center><font face=calibri style=font-size:12px;>Name</font></td>
					<th width=25% align=center><font face=calibri style=font-size:12px;>Last name</font></td>
					<th width=12% align=center><font face=calibri style=font-size:12px;>Date of birth</font></td>
					<th width=30% align=center><font face=calibri style=font-size:12px;>Residence</font></td>
					<th width=8% align=center></td>
				</tr>";
	echo "<tr>
					<td align=center><input type=text name=nome value='$_GET[saved_name]' id=nome size=25></td>
					<td align=center><input type=text name=cognome value='$_GET[saved_lastname]' id=cognome size=25></td>
					<td align=center><input type=text name=nascita value='$_GET[saved_nascita]' id=nascita size=15></td>
					<td align=center><input type=text name=indirizzo value='$_GET[saved_indirizzo]' id=indirizzo size=30></td>
					<td></td>
				</tr>";
	echo "<tr>
					<td colspan=3 align=center><input type=text name=codfisc value='$_GET[saved_codfisc]' id=codfisc size=80></td>
					<td colspan=1 align=center><select name=selectedgroup id=selectedgroup>";
					$sql = "SELECT distinct gruppo FROM nuke_offerte_detail_coperture where idofferta=$_GET[id]";
					$rsgruppi = $db->sql_query($sql);
					while ($rowgruppi = $db->sql_fetchrow($rsgruppi)) {
						if ($_GET[group_name]==$rowgruppi[gruppo]) $selected = ' selected ';
						echo "<option $selected value='$rowgruppi[gruppo]'>$rowgruppi[gruppo]</option>";
						$selected = '';
					}
				echo "</select></td>";
				echo "<td align=center><input type=button name=add id=add value=Add onClick=".chr(34)."location.href='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id&view=editavanzato&azione=add&view=editavanzato&nome='+document.getElementById('nome').value+'&cognome='+document.getElementById('cognome').value+'&nascita='+document.getElementById('nascita').value+'&indirizzo='+document.getElementById('indirizzo').value+'&codfisc='+document.getElementById('codfisc').value+'&selectedgroup='+document.getElementById('selectedgroup').value+'&scrolltop='+document.getElementById('offerte').scrollTop;".chr(34)."></td>
				</tr>";
	echo "</table><br>";
	echo "<center><input type=button value=Close onClick=location.href='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id&view=editavanzato&scrolltop=$_GET[scrolltop]'></center>";
CloseTable();
}

$sql = "SELECT distinct gruppo FROM nuke_offerte_detail_coperture where idofferta='$_GET[id]'";
$rsgruppi = $db->sql_query($sql);
while ($rowgruppi = $db->sql_fetchrow($rsgruppi)) {
	$sql = "SELECT     nuke_offerte_detail_coperture.id, nuke_offerte_detail_coperture.gruppo, nuke_offerte_detail_coperture.idcopertura, nuke_offerte_detail_coperture.idofferta, 
                     nuke_offerte_detail_coperture.importo, nuke_offerte_detail_coperture.tasso, nuke_offerte_detail_coperture.premio, nuke_offerte_detail_coperture.note, 
                     nuke_coperture.field3, nuke_coperture.field1, nuke_coperture.field2
					FROM       nuke_offerte_detail_coperture INNER JOIN
                     nuke_coperture ON nuke_offerte_detail_coperture.idcopertura = nuke_coperture.id
					WHERE     (nuke_offerte_detail_coperture.gruppo = '$rowgruppi[gruppo]')";
	$rsgruppi1 = $db->sql_query($sql);
	opentable();
	echo "<p><font face=calibri style=font-size:16px;>Covers group: $rowgruppi[gruppo]</font>&nbsp;&nbsp;::&nbsp;&nbsp;<input type=button value=Delete onclick=\"location.href='gestionale.php?name=lloyds&subname=offerte&view=editavanzato&act=explode&id=$id&scrolltop='+document.getElementById('offerte').scrollTop+'&group=$rowgruppi[gruppo]&azione=eliminagruppo';\">&nbsp;&nbsp;::&nbsp;&nbsp;<input type=button value=Rename onclick=vai9('".str_replace(" ","_",$rowgruppi[gruppo])."');></p>";
	echo "<table width=100% bgcolor=white bordercolor=darkgrey cellspacing=0 cellpadding=3 border=1>";
	echo "<tr><td width=50% align=center valign=top>Selected Covers<br><span style=float:left;><input type=button value=Change onclick=\"location.href='gestionale.php?name=lloyds&subname=offerte&view=editavanzato&act=explode&id=$id&group=$rowgruppi[gruppo]&scrolltop='+document.getElementById('offerte').scrollTop;\"></td><td width=50% align=center valign=top>People<br><span style=float:left;><input type=button value='New...' onClick=\"location.href='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id&new_person=1&group_name=$rowgruppi[gruppo]&scrolltop='+document.getElementById('offerte').scrollTop;\"></td></tr>";
	echo "<td width=50% align=left valign=top>";
	echo "<table width=100% cellspacing=0 cellpadding=0 border=0>";
	while ($rowgruppi1 = $db->sql_fetchrow($rsgruppi1)) {
		$cateprecedente=$cate;
		$cate=$rowgruppi1[field3];
		if ($cateprecedente!=$cate) echo "<tr><td colspan=5 width=100%><font face=calibri><strong>$rowgruppi1[field3]</strong></font></td></tr>";
		if ($rowgruppi1[importo]!='') $rowgruppi1[importo]=$row[valuta]." ".number_format($rowgruppi1[importo],2,".","'");
		if ($rowgruppi1[premio]!='') $rowgruppi1[premio]=number_format($rowgruppi1[premio],2,".","'")." ".$row[valuta];
		if ($rowgruppi1[tasso]!='') $rowgruppi1[tasso]=$rowgruppi1[tasso]."%";
		echo "<tr><td width=5%></td><td width=30%><font face=calibri>$rowgruppi1[field1]/$rowgruppi1[field2]</font></td><td width=25% align=right><font face=calibri>$rowgruppi1[importo]</font></td><td width=10% align=center><font face=calibri>$rowgruppi1[tasso]</font></td><td width=20% align=left><font face=calibri>$rowgruppi1[premio]</font></td></tr>";
	}
	echo "</table>";
	echo "</td><td width=50% align=left valign=top>";
	$sql = "SELECT * FROM nuke_offerte_detail_persone where idofferta='$id' and gruppo='$rowgruppi[gruppo]' order by id";
	$rs = $db->sql_query($sql);
	$nr = $db->sql_numrows($rs);
	$rigasopra=0;
	while ($row_pers = $db->sql_fetchrow($rs)) {
	if ($rigasopra==1) {
		echo "<hr>";
	}
	$rigasopra=1;
	echo "<center><table width=98% cellspacing=0 cellpadding=2 border=1>";
		echo "<tr>";
			echo "<td width=23% align=center><font face=calibri style=font-size:10px;><strong>$row_pers[nome]</font></td>";
			echo "<td width=23% align=center><font face=calibri style=font-size:10px;><strong>$row_pers[cognome]</font></td>";
			echo "<td width=23% align=center><font face=calibri style=font-size:10px;>$row_pers[nascita]</font></td>";
			echo "<td width=21% align=center><font face=calibri style=font-size:10px;>$row_pers[indirizzo]</font></td>";
			echo "<td rowspan=2 width=10% valign=middle align=center>
						<input type=button name=del id=del value=Del onClick=".chr(34)."location.href='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id&view=editavanzato&azione=deleteall&view=editavanzato&rowpersid=$row_pers[id]&scrolltop='+document.getElementById('offerte').scrollTop;".chr(34).">
						<input type=button name=ren id=ren value=Ren onClick=".chr(34)."location.href='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id&view=editavanzato&azione=modifiyname&view=editavanzato&rowpersid=$row_pers[id]&scrolltop='+document.getElementById('offerte').scrollTop;".chr(34).">
						</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td colspan=3 align=center><font face=calibri style=font-size:10px;>$row_pers[codfisc]</font></td>";
			echo "<td colspan=1 align=center><font face=calibri style=font-size:10px;><strong>$row_pers[gruppo]</strong></font></td>";
		echo "</tr>";
	echo "</table></center>";
	}
	echo "</td></tr></table>";
	echo "</p>";
	closetable();
}
CloseTable();
?>