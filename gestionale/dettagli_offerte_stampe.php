<script language=JavaScript>
function query_reload() {
	window.location="gestionale.php?name=lloyds&subname=offerte&act=explode&id=<?php echo $_GET[id]; ?>&view=stampe";
}
function check(totale_cga,totale_domande) {
	if (document.getElementById("check").checked) {
		for (x=1;x<totale_cga+1;x++) {
			document.getElementById("cga"+x).checked=true;
		}
		for (x=1;x<totale_domande+1;x++) {
			document.getElementById("domande"+x).checked=true;
		}
		document.getElementById("proposta").checked=true;
	}else{
		for (x=1;x<totale_cga+1;x++) {
			document.getElementById("cga"+x).checked=false;
		}
		for (x=1;x<totale_domande+1;x++) {
			document.getElementById("domande"+x).checked=false;
		}
		document.getElementById("proposta").checked=false;
	}
}
function stampa_tutto_cga(valore) {
	res="";
	for (x=1;x<valore+1;x++) {
		if (x!=1) res += ",";
		res += document.getElementById("cga"+x).value;
	}
	if (res!='') window.location="gestionale.php?name=lloyds&subname=offerte&act=explode&view=stampe&multiple=yes&nomefile="+res+"&id=<?php echo $_GET[id]; ?>";
}
function stampa_selezionate_cga(valore) {
	res="";
	y=1;
	for (x=1;x<valore+1;x++) {
		if (document.getElementById("cga"+x).checked) {
			if (y!=1) res += ",";
			y++;
			res += document.getElementById("cga"+x).value;
		}
	}
	if (res!='') window.location="gestionale.php?name=lloyds&subname=offerte&act=explode&view=stampe&multiple=yes&nomefile="+res+"&id=<?php echo $_GET[id]; ?>";
}

function stampa_tutto_domande(valore) {
	res="";
	for (x=1;x<valore+1;x++) {
		if (x!=1) res += ",";
		res += document.getElementById("domande"+x).value;
	}
	if (res!='') window.location="gestionale.php?name=lloyds&subname=offerte&act=explode&view=stampe&multiple=yes&nomefile="+res+"&id=<?php echo $_GET[id]; ?>";
}
function stampa_selezionate_domande(valore) {
	res="";
	y=1;
	for (x=1;x<valore+1;x++) {
		if (document.getElementById("domande"+x).checked) {
			if (y!=1) res += ",";
			y++;
			res += document.getElementById("domande"+x).value;
		}
	}
	if (res!='') window.location="gestionale.php?name=lloyds&subname=offerte&act=explode&view=stampe&multiple=yes&nomefile="+res+"&id=<?php echo $_GET[id]; ?>";
}

function stampa_tutto(valore1,valore2) {
	res="";
	for (x=1;x<valore1+1;x++) {
		if (x!=1) res += ",";
		res += document.getElementById("cga"+x).value;
	}
	for (x=1;x<valore2+1;x++) {
		if (res!='') res += ",";
		res += document.getElementById("domande"+x).value;
	}
	res += ',/template/rva1.htm';
	if (res!='') window.location="gestionale.php?name=lloyds&subname=offerte&act=explode&view=stampe&multiple=yes&nomefile="+res+"&id=<?php echo $_GET[id]; ?>";
}
function stampa_selezionate(valore1,valore2) {
	res="";
	y=1;
	for (x=1;x<valore1+1;x++) {
		if (document.getElementById("cga"+x).checked) {
			if (y!=1) res += ",";
			y++;
			res += document.getElementById("cga"+x).value;
		}
	}
	y=1;
	for (x=1;x<valore2+1;x++) {
		if (document.getElementById("domande"+x).checked) {
			if (y!=1) res += ",";
			y++;
			res += document.getElementById("domande"+x).value;
		}
	}
	if (document.getElementById("proposta").checked) {
		res += ',/template/rva1.htm';
	}
	
	if (res!='') window.location="gestionale.php?name=lloyds&subname=offerte&act=explode&view=stampe&multiple=yes&nomefile="+res+"&id=<?php echo $_GET[id]; ?>";
}
function stampa_def(id) {
	window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&view=stampe&multiple=yes&nomefile=/template/rva1.htm&id='+id
}
function blocca(id) {
	x=confirm("Attenzione, selezionando questa opzione l'offerta numero "+id+" verrà bloccata e non sarà più possibile modificarla. Si desidera continuare?");
	if (x) window.location="gestionale.php?name=lloyds&subname=offerte&act=blocca&id="+id;
}

</script>

<?php

global $prefix, $db, $admin, $user;
$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';

$sql = "SELECT * FROM nuke_offerte_stampe where printed='0' and idofferta=$_GET[id]";
$rs = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($rs)) {
	$sql = "UPDATE nuke_offerte_stampe SET printed='1' where filename='$row[filename]' and idofferta=$_GET[id]";
	$rs = $db->sql_query($sql);
	echo "<script>window.open('$row[filename]','_blank');</script>";
}
OpenTable();
echo "<p>";

//stampe cga
$sql = "select * from nuke_cga where id in (SELECT field1 FROM nuke_offerte_detail_cga WHERE idofferta='$_GET[id]')";
$rs = $db->sql_query1($sql);
$nr = $db->sql_numrows($rs);
echo '<table width=100% border=0 height=100% cellspacing=0 cellpadding=0>';
echo '<tr>';
echo '<td width=35% align=right><font face=verdana size=2><strong>Stampe CGA</strong>&nbsp;</td>';
echo "<td width=25% align=left valign=middle><input type=button value='Stampa' onClick=stampa_tutto_cga($nr);><input type=button value='Stampa selezionati' onClick=stampa_selezionate_cga($nr);></td>";
echo "<td width=40% valign=top align=left>";
$x=0;
while ($row = $db->sql_fetchrow($rs)) {
	$color='black';
	$x++;
	$sqll = "SELECT * FROM nuke_offerte_stampe where filename='$row[filename]' and idofferta=$_GET[id] and printed='1'";
	$rsl = $db->sql_query($sqll);
	$nrl = $db->sql_numrows($rsl);
	if ($nrl!=0) $color='green';
	echo "<p><input type=checkbox id=cga$x value='$row[filename]'><font color=$color>$row[description]</font></p>";
	$totale_cga=$x;
}
echo "</td>";
echo "</tr>";
echo "</table><hr>";

//stampe domande proposta
$color='black';
$sql = "select * from nuke_domandeproposta where id in (SELECT field1 FROM nuke_offerte_detail_2 WHERE idofferta='$_GET[id]')";
$rs = $db->sql_query1($sql);
$nr = $db->sql_numrows($rs);
echo '<table width=100% border=0 cellspacing=0 cellpadding=0>';
echo '<tr>';
echo '<td width=35% align=right><font face=verdana size=2><strong>Stampe Domande Proposta</strong>&nbsp;</td>';
echo "<td width=25% align=left valign=middle><input type=button value='Stampa' onClick=stampa_tutto_domande($nr);><input type=button value='Stampa selezionati' onClick=stampa_selezionate_domande($nr);></td>";
echo "<td width=40% valign=top align=left>";
$x=0;
while ($row = $db->sql_fetchrow($rs)) {
	$x++;
	$sqll = "SELECT * FROM nuke_offerte_stampe where filename='$row[filename]' and idofferta=$_GET[id] and printed='1'";
	$rsl = $db->sql_query($sqll);
	$nrl = $db->sql_numrows($rsl);
	if ($nrl!=0) $color='green';
	echo "<p><input type=checkbox id=domande$x value='$row[filename]'><font color=$color>$row[description]</font></p>";
	$totale_domande=$x;
}
echo "</td>";
echo "</tr>";
echo "</table><hr>";

//stampe proposta
$color='black';
$sql = "select * from nuke_offerte where id='$_GET[id]'";
$rs = $db->sql_query1($sql);
$row = $db->sql_fetchrow($rs);
echo '<table width=100% border=0 cellspacing=0 cellpadding=0>';
echo '<tr>';
echo '<td width=35% align=right><font face=verdana size=2><strong>Stampe Proposta</strong>&nbsp;</td>';
echo "<td width=25% align=left valign=middle><input type=button value='Stampa' onclick=stampa_def($_GET[id]);></td>";
echo "<td width=40% valign=top align=left>";
$sqll = "SELECT * FROM nuke_offerte_stampe where filename='/template/rva1.htm' and idofferta=$_GET[id] and printed='1'";
$rsl = $db->sql_query($sqll);
$nrl = $db->sql_numrows($rsl);
if ($nrl!=0) $color='green';
echo "<p><input type=checkbox id=proposta><font color=$color>Proposta n. $row[field1]/$row[id]</font></p>";
echo "</td>";
echo "</tr>";
echo "</table><hr>";

/*
echo '<table width=100% border=0 cellspacing=0 cellpadding=0>';
echo '<tr>';
echo '<td width=35% align=right><font face=verdana size=2><strong>Raccolta Stampe</strong>&nbsp;</td>';
echo "<td width=25% align=left valign=middle><input type=button value='Stampa tutto' onClick=stampa_tutto($totale_cga,$totale_domande);><input type=button value='Stampa selezionati' onClick=stampa_selezionate($totale_cga,$totale_domande);></td>";
echo "<td width=40% valign=top align=left>";
echo "<p><input type=checkbox id=check onClick=check($totale_cga,$totale_domande);><font color=black>Seleziona/Deseleziona tutto</font></p>";
echo "</td>";
echo "</tr>";
echo "</table><hr>";
*/

echo "<table width=100% height=100 border=0 cellspacing=0 cellpadding=0>";
echo "<td>&nbsp;</td>";
echo "</table>";

echo '<table width=100% border=0 cellspacing=0 cellpadding=0>';
echo '<tr>';
echo '<td width=35% align=right><font face=verdana size=2><strong>BLOCCA OFFERTA</strong>&nbsp;</td>';
if ($row[blocca]==0) echo "<td width=25% align=center valign=middle><input type=button value=' -> BLOCCA <- ' onClick=blocca('$_GET[id]');></td>";
if ($row[blocca]==1) echo "<td width=25% align=center valign=middle><input type=button value='Offerta già bloccata' disabled></td>";
echo "<td width=40% valign=top align=left></td>";
echo "</tr>";
echo "</table>";


echo "</p>";
CloseTable();

?>