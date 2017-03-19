<div class="offerte" id="offerte" style="position:relative;_position:relative;height:100%;overflow:auto;padding:0px;">
<?php
$confirm = 'return ';
$act = $_GET[act];
if (!$act) $act=$_POST[act];
$id = $_GET[id];
if (!$id) $id = $_POST[id];
$pag = $_GET['pag'];
$ord = $_GET['ord'];
if ($act=='') $act='search';
$number=$_GET[number];
if ($number!='') $act='';

if ($act == 'explode') $condizioni = " WHERE COD='$id' ";

if ($act == 'gosearch') {
	if ($id=='') {
		$condizioni = " WHERE COD like '%' ";
	}else{
		$condizioni = " WHERE COD = '$id' ";
	}
	if ($nome != '') $condizioni .= " AND NOME LIKE '%$nome%' ";
	if ($cognome != '') $condizioni .= " AND COGNOME LIKE '%$cognome%' ";
	if ($via1 != '') $condizioni .= " AND INDIRIZZO LIKE '%$via1%' ";
	if ($npa1 != '') $condizioni .= " AND CAP LIKE '%$npa1%' ";
	if ($localita1 != '') $condizioni .= " AND CITTA LIKE '%$localita1%' ";
	if ($nazionalita != '') $condizioni .= " AND NATLUOGO LIKE '%$nazionalita%' ";
	if ($stato1 != '') $condizioni .= " AND STATO LIKE '%$stato1%' ";
	if ($nascita != '') $condizioni .= " AND NATDATA LIKE '%$nascita%' ";
	if ($rifer != '') $condizioni .= " AND RIFER LIKE '%$rifer%' ";
}	

if ($pag=='') $pag = 1; //prendo il numero di pagina dal query string e se non c'è lo setto a 1
if ($act=='mod') $pag=1;
if ($ord=='') $ord = 'id';
if ($number=='') $number='200';
if ($act=='gosearch') $number='20000';

$sql = "SELECT OLDCOD, NPROG, NRSIN, COD as id, TIT, COGNOME as cognome, NOME as nome, REPLACE(REPLACE(REPLACE(SEX, 'G', '1'), 'M', '2'), 'F', '3') AS SEX, CF, PIVA, INDIRIZZO as via1, CAP as npa1, 
                    CITTA as localita1, PROV, STATO as stato1, RUB, PRESSO, NATLUOGO as nazionalita, NATPROV, NATDATA as nascita, TEL, CELLULARE, FAX, TELEX, TELCASA, RIFER, ORIG, ZONA, BANCA, LINEA, NOTA, SME, 
                    LOBBY, RETE, PRODUTT, CEV, DTMAND, DTREVOCA, COMMERC, STATUS, NUMDIP, FATTUR, ATTESERC, ATTESTERE, COGE, DIV, MEMO, IMP, SIC, POT, 
                    INTRODUCER, GRP, SGR, ANTIC, SALDOI, CEE, ALLEGATI, PRIVACY, DTAGG, UTENTE, ATTIVO, NR_DOSSIER, NOTE_DOSSIER, INIZIO_LETTERA
				FROM [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.CLIENTI";
$rs = $db->sql_query1($sql);
$nr_tot = $db->sql_numrows($rs);

$sql = "SELECT TOP $number OLDCOD, NPROG, NRSIN, COD as id, TIT, COGNOME as cognome, NOME as nome, REPLACE(REPLACE(REPLACE(SEX, 'G', '1'), 'M', '2'), 'F', '3') AS SEX, CF, PIVA, INDIRIZZO as via1, CAP as npa1, 
                    CITTA as localita1, PROV, STATO as stato1, RUB, PRESSO, NATLUOGO as nazionalita, NATPROV, NATDATA as nascita, TEL, CELLULARE, FAX, TELEX, TELCASA, RIFER, ORIG, ZONA, BANCA, LINEA, NOTA, SME, 
                    LOBBY, RETE, PRODUTT, CEV, DTMAND, DTREVOCA, COMMERC, STATUS, NUMDIP, FATTUR, ATTESERC, ATTESTERE, COGE, DIV, MEMO, IMP, SIC, POT, 
                    INTRODUCER, GRP, SGR, ANTIC, SALDOI, CEE, ALLEGATI, PRIVACY, DTAGG, UTENTE, ATTIVO, NR_DOSSIER, NOTE_DOSSIER, INIZIO_LETTERA
				FROM [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.CLIENTI $condizioni ORDER BY SEX,cognome";
$rs = $db->sql_query1($sql);
$nr = $db->sql_numrows($rs);

OpenTable();
echo '<p>';
echo "<form name=form_mostra action=gestionale.php><input type=hidden name=name value=clienti>";
echo "<input type=button value='Exit' onclick=location.href='gestionale.php?name=home' style=font-family: Verdana; font-size: 10px;>";
if ($act!='search') {
	echo "<font size=2 face=calibri>&nbsp;&nbsp;::&nbsp;&nbsp;</font>";
	echo "<input type=button value='Search' onclick=location.href='gestionale.php?name=clienti&act=search&cookie=reset' style=font-family: Verdana; font-size: 10px>";
}
if ($act!='explode') {
	echo "<font size=2 face=calibri>&nbsp;&nbsp;::&nbsp;&nbsp;</font>";
	$testo="Show the list";
	echo "<input type=submit value='$testo' style=font-family: Verdana; font-size: 10px>";
	echo " <input type=text size=5 name=number value=$number style=text-align:center;> <font size=2 face=calibri>on $nr_tot</font>";
}
echo "</form>";
echo "</p>";

echo "<p align=center>";
echo "<table width=80% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen>";
echo '<tr>';
echo '<th width=10%><font face=verdana size=2><a href=gestionale.php?name=clienti&ord=id>Code</a></th>';
echo '<th width=40%><font face=verdana size=2>Name<br>
				<table width=100%>
					<tr>
						<th width=35% align=left valign=top><font face=verdana size=2 color=black>Business Name/Last Name</th>
						<th width=25% align=left valign=top><font face=verdana size=2 color=black>Name</th>
						<th width=25% align=left valign=top><font face=verdana size=2 color=black>Ref./Note</th>
						<th width=15% align=left valign=top><font face=verdana size=2 color=black>Sex</th>
					</tr>
				</table>
			</th>';
echo '<th width=40%><font face=verdana size=2>Address<br>
				<table width=100%>
					<tr>
						<th width=40% align=left valign=top><font face=verdana size=2 color=black>Street/Place</th>
						<th width=10% align=left valign=top><font face=verdana size=2 color=black>NPA</th>
						<th width=20% align=left valign=top><font face=verdana size=2 color=black>City</th>
						<th width=30% align=left valign=top><font face=verdana size=2 color=black>State</th>
					</tr>
				</table>
			</th>';
echo '</tr>';

if ($act == 'search') {
	if ($_GET[cookie]=='reset') {
		setcookie("idcliente", "", time()-3600);
		header("Location: gestionale.php?name=clienti");
		die();
	}
	if (isset($_COOKIE["idcliente"])) header("Location: gestionale.php?name=clienti&act=explode&id=$_COOKIE[idcliente]");
	$nr=0;
	echo "<form action=gestionale.php method=get><input type=hidden name=name value=clienti><input type=hidden name=act value=gosearch>";
	echo '<tr>';
		echo "<td valign=middle align=center><font face=verdana size=2><input type=text name=id size=10></td>";
		echo "<td valign=top align=center><font face=verdana size=2>
			<table width=100%><td><font face=verdana size=2>
				Business Name/Last Name<br><input size=35 type=text id=cognome name=cognome value=''><br><br>
				Name<br><input size=35 type=text name=nome value=''>
			</td><td valign=top><font face=verdana size=2>
				Ref./Note<br><input size=35 type=text name=rifer value=''><br><br>
			</td></table>";
		echo "</td>";
		echo "<td valign=top align=center><font face=verdana size=2>
			<table width=100%><td><font face=verdana size=2>
				Street/Place<br><input size=40 type=text name=via1 value=''><br><br>
				NPA<br><input size=10 type=text name=npa1 value=''>
			</td><td><font face=verdana size=2>
				City<br><input size=15 type=text name=localita1 value=''><br><br>
				State<br><input size=20 type=text name=stato1 value=''>
			</td></table>";
		echo "</td>";
	echo '</tr>';
	echo "<tr><td align=center colspan=3><input type=submit value=Go></td></tr>";
	echo '</form>';
	echo "<script>document.getElementById('cognome').focus();</script>";
	$act = '';
}

$xa=0;
if ($nr != 0){
	while ($row = $db->sql_fetchrow($rs))
	{
		$xa++;
		echo '<tr>';
		echo "<td valign=middle align=center><font face=verdana size=2><a href=gestionale.php?name=clienti&id=$row[id]&act=explode>$row[id]</a></td>";
		echo "<td valign=middle align=center>
						<table width=100% border=0>
						<tr>
							<td width=35% align=left valign=top><font face=verdana size=2 color=black>$row[cognome]</td>
							<td width=25% align=left valign=top><font face=verdana size=2 color=black>$row[nome]</td>
							<td width=25% align=left valign=top><font face=verdana size=2 color=black>$row[RIFER]</td>
							<td width=15% align=left valign=top><font face=verdana size=2 color=black>";
							if ($row[SEX]=='1') echo "G";
							if ($row[SEX]=='2') echo "M";
							if ($row[SEX]=='3') echo "F";
							echo "</td>
						</tr>
						</table>
					</td>";
					$ragione_sociale="";$congome="";
		echo "<td valign=middle align=center><font face=verdana size=2>
						<table width=100% border=0>
						<tr>
							<td width=40% align=left valign=top><font face=verdana size=2 color=black>$row[via1]</td>
							<td width=10% align=left valign=top><font face=verdana size=2 color=black>$row[npa1]</td>
							<td width=20% align=left valign=top><font face=verdana size=2 color=black>$row[localita1]</td>
							<td width=30% align=left valign=top><font face=verdana size=2 color=black>$row[stato1]</td>
						</tr>
						</table>
					</td>";
		echo '</tr>';

		if ($act=='explode') {
			echo "</table>";
			CloseTable();

			OpenTable();
			echo "<table>";
				echo "<table height=400 width=100% border=1 bordercolor=black cellspacing=0 cellpadding=0>";
				echo "<tr><td bgcolor=#90AFF6 valign=top width=50% align=center>";
				echo "<font face=Calibri style=font-size:14px color=white><strong>Policy</strong></font>";
				include('polizze_clienti.php');
			echo "</td>";
			echo "<td width=50% valign=top bgcolor=#205AD0 align=center>";
				echo "<font face=Calibri style=font-size:14px color=white><strong>Offers</strong></font>";
				include('proposte_clienti.php');
			echo "</td></tr></table>";
			CloseTable();
			
			OpenTable();
			echo "<table width=100% border=1 bordercolor=darkgreen cellspacing=0 cellpadding=0><tr bgcolor=#16B016><td valign=top align=center>";
				echo "<font face=Calibri style=font-size:14px color=white><strong>Details</strong></font>";
				include('detail_clienti.php');
			echo "</td></tr></table>";
		}
	}
}
if ($act!='explode') echo "</table></p>";
CloseTable();
?>
</div>