<script>
	function modify(id,scrolltop,ord,pag) {
		window.location='gestionale.php?name=clienti&ord='+ord+'&pag='+pag+'&act=mod&id='+id+'&scrolltop='+scrolltop;
	}
	function remove(id,scrolltop,ord,pag) {
		x=alert("Attenzione, questa è impossibile in quanto l'anagrafica clienti è presa da una banca dati esterna.");
		//if (x) window.location='gestionale.php?name=clienti&ord='+ord+'&pag='+pag+'&act=del&id='+id+'&scrolltop='+scrolltop;
	}
</script>
<?php
require_once("mainfile.php");
include("header.php");
global $prefix, $db, $admin, $user;

$confirm = 'return ';
$act = $_GET[act];
$id = $_GET[id];
if (!$id) $id = $_POST[id];
$pag = $_GET['pag'];
$ord = $_GET['ord'];

title("$sitename: Gestione Clienti");

?>
	<script>
		if (navigator.appName=='Netscape') {
			if (screen.height>1000) allora=screen.height-260;
			if (screen.height<1000) allora=screen.height-290;
			document.write('<div class="offerte_detail_1" id="offerte_detail_1" style="position:relative;width:100%;margin-top:0;  _position:absolute;_top:expression(eval(document.body.scrollTop)+58);height:'+allora+'px;overflow:auto;padding:0px;">');
		}
		if (navigator.appName=='Microsoft Internet Explorer') {
			if (window.document.documentElement.offsetHeight>1000) allora=window.document.documentElement.offsetHeight-200;
			if (window.document.documentElement.offsetHeight<1000) allora=window.document.documentElement.offsetHeight-200;
			document.write('<div class="offerte_detail_1" id="offerte_detail_1" style="position:relative;width:100%;margin-top:100;_position:absolute;_top:expression(eval(document.body.scrollTop)+58);height:'+allora+'px;overflow:auto;padding:0px;">');
		}
	</script>
<?php


OpenTable();
echo '<p>';
echo '<input type=button value="Nuovo Record" onclick="location.href=' . chr(39) . 'gestionale.php?name=clienti&act=new&ord=' . $ord . '&pag='. $pag . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '<input type=button value="Ricerca" onclick="location.href=' . chr(39) . 'gestionale.php?name=clienti&act=search&ord=' . $ord . '&pag='. $pag . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '<input type=button value="Mostra tutti i record" onclick="location.href=' . chr(39) . 'gestionale.php?name=clienti' . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '</p>';
echo '<p>';
	if ($act=='sav'){
	$sql = "UPDATE nuke_clienti SET  ragione_sociale='" . $_GET[ragione_sociale] . "' ,
					title='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[title])))))))."' ,
					nome='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[nome])))))))."' ,
					cognome='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[cognome])))))))."' ,
					via1='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[via1])))))))."' ,
					npa1='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[npa1])))))))."' ,
					localita1='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[localita1])))))))."' ,
					via2='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[via2])))))))."' ,
					npa2='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[npa2])))))))."' ,
					localita2='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[localita2])))))))."' ,
					via3='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[via3])))))))."' ,
					npa3='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[npa3])))))))."' ,
					localita3='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[localita3])))))))."' ,
					via4='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[via4])))))))."' ,
					npa4='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[npa4])))))))."' ,
					localita4='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[localita4])))))))."' ,
					consulente='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[consulente])))))))."' ,
					nazionalita='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[nazionalita])))))))."' ,
					stato1='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[stato1])))))))."' ,
					stato2='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[stato2])))))))."' ,
					stato3='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[stato3])))))))."' ,
					stato4='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[stato4])))))))."' ,
					nascita='".str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[nascita])))))))."'
					where id=" . $id;
		$result = $db->sql_query($sql);
		$act = "explode";
	}
	if ($act == 'del'){
		$sql = "DELETE FROM nuke_clienti WHERE ID = " . $id;
		$result = $db->sql_query($sql);
		$id = '';
		$act = '';
	}
	if ($act=='savnew'){
		$sql = "INSERT INTO nuke_clienti (
																			title,
																			ragione_sociale,
																			nome,
																			cognome,
																			via1,
																			npa1,
																			localita1,
																			via2,
																			npa2,
																			localita2,
																			via3,
																			npa3,
																			localita3,
																			via4,
																			npa4,
																			localita4,
																			consulente,
																			nazionalita,
																			stato1,
																			stato2,
																			stato3,
																			stato4,
																			nascita
																			) VALUES (
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[title]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[ragione_sociale]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[nome]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[cognome]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[via1]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[npa1]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[localita1]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[via2]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[npa2]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[localita2]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[via3]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[npa3]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[localita3]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[via4]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[npa4]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[localita4]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[consulente]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[nazionalita]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[stato1]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[stato2]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[stato3]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[stato4]))))))) . "',
																			'" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[nascita]))))))) . "'
																			)";
		$result = $db->sql_query($sql);
		$id = $db->sql_fetchrow($db->sql_query("SELECT id FROM nuke_clienti order by id DESC"));
		$id = $id[id];
		$act = "explode";
		if ($_GET[torna]=='offerta') header("Location: gestionale.php?name=lloyds&subname=offerte&act=new&ord=id&pag=1");
		if ($_GET[torna]=='modificaofferta') header("Location: gestionale.php?name=lloyds&subname=offerte&ord=id&pag=1&act=mod&id=$_GET[idofferta]");
		header("Location: gestionale.php?name=clienti&act=explode&id=$id");
	}
	if ($act == 'explode') $condizioni = " WHERE id=$id ";
	if ($act == 'gosearch') {
		if ($title == '') $title = '%';
		if ($ragione_sociale == '') $ragione_sociale = '%';
		if ($nome == '') $nome = '%';
		if ($cognome == '') $cognome = '%';
		if ($via1 == '') $via1 = '%';
		if ($npa1 == '') $npa1 = '%';
		if ($localita1 == '') $localita1 = '%';
		if ($via2 == '') $via2 = '%';
		if ($npa2 == '') $npa2 = '%';
		if ($localita2 == '') $localita2 = '%';
		if ($via3 == '') $via3 = '%';
		if ($npa3 == '') $npa3 = '%';
		if ($localita3 == '') $localita3 = '%';
		if ($via4 == '') $via4 = '%';
		if ($npa4 == '') $npa4 = '%';
		if ($localita4 == '') $localita4 = '%';
		if ($consulente == '') $consulente = '%';
		if ($nazionalita == '') $nazionalita = '%';
		if ($stato1 == '') $stato1 = '%';
		if ($stato2 == '') $stato2 = '%';
		if ($stato3 == '') $stato3 = '%';
		if ($stato4 == '') $stato4 = '%';
		if ($nascita == '') $nascita = '%';
	
		$condizioni = "  WHERE
										title LIKE '$title' AND
										ragione_sociale LIKE '$ragione_sociale' AND
										nome LIKE '$nome' AND
										cognome LIKE '$cognome' AND
										via1 LIKE '$via1' AND
										npa1 LIKE '$npa1' AND
										localita1 LIKE '$localita1' AND
										via2 LIKE '$via2' AND
										npa2 LIKE '$npa2' AND
										localita2 LIKE '$localita2' AND
										via3 LIKE '$via3' AND
										npa3 LIKE '$npa3' AND
										localita3 LIKE '$localita3' AND
										via4 LIKE '$via4' AND
										npa4 LIKE '$npa4' AND
										localita4 LIKE '$localita4' AND
										consulente LIKE '$consulente' AND
										nazionalita LIKE '$nazionalita' AND
										stato1 LIKE '$stato1' AND
										stato2 LIKE '$stato2' AND
										stato3 LIKE '$stato3' AND
										stato4 LIKE '$stato4' AND
										nascita LIKE '$nascita'
									";
	}	
	$x_pag = 1000; //numero massimo di record per pagina
	if ($pag=='') $pag = 1; //prendo il numero di pagina dal query string e se non c'è lo setto a 1
	if ($act=='mod') $pag=1;
	if ($ord=='') $ord = 'id';
	
	$sql = "SELECT * FROM ".$prefix."_clienti " . $condizioni;
	$rs = $db->sql_query($sql);
	$nr = $db->sql_numrows($rs);

	$all_pages = ceil($all_rows / $x_pag);
	$first = ($pag - 1) * $x_pag;
	$sql = "SELECT * FROM nuke_clienti $condizioni ORDER BY $ord LIMIT $first, $x_pag";
	$rs = $db->sql_query($sql);
	$nr = $db->sql_numrows($rs);

	echo '<table width=100% border=1 cellspacing=0 cellpadding=0>';
	echo '<tr>';
	echo '<th width=2%><font face=verdana size=2><a href=gestionale.php?name=clienti&ord=id>Id</a></th>';
	echo '<th width=10%><font face=verdana size=2><a href=gestionale.php?name=clienti&ord=ragione_sociale>Nominativo</a></th>';
	echo '<th width=10%><font face=verdana size=2><a href=gestionale.php?name=clienti>Indirizzo</a></th>';
	echo '<th width=10%><font face=verdana size=2><a href=gestionale.php?name=clienti>Luogo assicurato</a></th>';
	echo '<th width=10%><font face=verdana size=2><a href=gestionale.php?name=clienti>Luogo assicurato</a></th>';
	echo '<th width=10%><font face=verdana size=2><a href=gestionale.php?name=clienti>Luogo assicurato</a></th>';
	echo '<th width=10%><font face=verdana size=2><a href=gestionale.php?name=clienti&ord=consulente>Consulente</a></th>';
	echo '<th width=8% colspan=3><font face=verdana size=2 color=blue>Funzionalità</font></th>';
	echo '</tr>';

	if ($act == 'new') {
		echo '<form action=gestionale.php method=get><input type=hidden name=idofferta value='.$_GET[idofferta].'><input type=hidden name=torna value='.$_GET[torna].'><input type=hidden name=ord value=' . $ord . '><input type=hidden name=name value=clienti><input type=hidden name=pag value=' . $pag . '><input type=hidden name=act value=savnew>';
		echo '<tr>';
		echo "<td valign=middle align=center><font face=verdana size=2></td>";
		echo "<td valign=top align=center><font face=verdana size=2>Azienda<br><input autofocus size=20 type=text name=ragione_sociale value=''><br><br>
																																		Titolo<br><input size=10 type=text name=title value=''><br>
																																		Nome<br><input size=20 type=text name=nome value=''><br>
																																		Cognome<br><input size=20 type=text name=cognome value=''><br><br>
																																		Data di nascita<br><input size=15 type=text name=nascita value=''><br><br>
																																		Nazionalit&agrave;<br><input size=20 type=text name=nazionalita value=''>
																																		</td>";
		echo "<td valign=top align=center><font face=verdana size=2>Via, n. civico<br><input size=20 type=text name=via1 value=''><br><br>
																																		NPA<br><input size=10 type=text name=npa1 value=''><br>
																																		Comune<br><input size=15 type=text name=localita1 value=''><br><br>
																																		Stato<br><input size=20 type=text name=stato1 value=''>
																																		</td>";
		echo "<td valign=top align=center><font face=verdana size=2>Via, n. civico<br><input size=20 type=text name=via2 value=''><br><br>
																																		NPA<br><input size=10 type=text name=npa2 value=''><br>
																																		Comune<br><input size=15 type=text name=localita2 value=''><br><br>
																																		Stato<br><input size=20 type=text name=stato2 value=''>
																																		</td>";
		echo "<td valign=top align=center><font face=verdana size=2>Via, n. civico<br><input size=20 type=text name=via3 value=''><br><br>
																																		NPA<br><input size=10 type=text name=npa3 value=''><br>
																																		Comune<br><input size=15 type=text name=localita3 value=''><br><br>
																																		Stato<br><input size=20 type=text name=stato3 value=''>
																																		</td>";
		echo "<td valign=top align=center><font face=verdana size=2>Via, n. civico<br><input size=20 type=text name=via4 value=''><br><br>
																																		NPA<br><input size=10 type=text name=npa4 value=''><br>
																																		Comune<br><input size=15 type=text name=localita4 value=''><br><br>
																																		Stato<br><input size=20 type=text name=stato4 value=''>
																																		</td>";
		echo "<td valign=middle align=center><font face=verdana size=2><input size=20 type=text name=consulente value=''></td>";
		echo "<td colspan=3 align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
		echo '</tr>';
		echo '</form>';
		$act = '';
	}
	if ($act == 'search') {
		echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=name value=clienti>';
		echo '<input type=hidden name=pag value=' . $pag . '>';
		echo '<input type=hidden name=act value=gosearch>';
		echo '<tr>';
		echo "<td valign=middle align=center><font face=verdana size=2></td>";
		echo "<td valign=top align=center><font face=verdana size=2>Azienda<br><input autofocus size=20 type=text name=ragione_sociale value=''><br><br>
																																		Titolo<br><input size=10 type=text name=title value=''><br>
																																		Nome<br><input size=20 type=text name=nome value=''><br>
																																		Cognome<br><input size=20 type=text name=cognome value=''><br><br>
																																		Data di nascita<br><input size=15 type=text name=nascita value=''><br><br>
																																		Nazionalit&agrave;<br><input size=20 type=text name=nazionalita value=''>
																																		</td>";
		echo "<td valign=top align=center><font face=verdana size=2>Via, n. civico<br><input size=20 type=text name=via1 value=''><br><br>
																																		NPA<br><input size=10 type=text name=npa1 value=''><br>
																																		Comune<br><input size=15 type=text name=localita1 value=''><br><br>
																																		Stato<br><input size=20 type=text name=stato1 value=''>
																																		</td>";
		echo "<td valign=top align=center><font face=verdana size=2>Via, n. civico<br><input size=20 type=text name=via2 value=''><br><br>
																																		NPA<br><input size=10 type=text name=npa2 value=''><br>
																																		Comune<br><input size=15 type=text name=localita2 value=''><br><br>
																																		Stato<br><input size=20 type=text name=stato2 value=''>
																																		</td>";
		echo "<td valign=top align=center><font face=verdana size=2>Via, n. civico<br><input size=20 type=text name=via3 value=''><br><br>
																																		NPA<br><input size=10 type=text name=npa3 value=''><br>
																																		Comune<br><input size=15 type=text name=localita3 value=''><br><br>
																																		Stato<br><input size=20 type=text name=stato3 value=''>
																																		</td>";
		echo "<td valign=top align=center><font face=verdana size=2>Via, n. civico<br><input size=20 type=text name=via4 value=''><br><br>
																																		NPA<br><input size=10 type=text name=npa4 value=''><br>
																																		Comune<br><input size=15 type=text name=localita4 value=''><br><br>
																																		Stato<br><input size=20 type=text name=stato4 value=''>
																																		</td>";
		echo "<td valign=middle align=center><font face=verdana size=2><input size=20 type=text name=consulente value=''></td>";
		echo "<td colspan=3 align=center valign=middle><input type=submit value=Cerca style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
		echo '</tr>';
		echo '</form>';
		$act = '';
	}

	if ($nr != 0){
		while ($row = $db->sql_fetchrow($rs))
		{
			if ($id == $row['id'] && $act == 'mod'){
				echo '<tr>';
				echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=name value=clienti><input type=hidden name=pag value=' . $pag . '><input type=hidden name=act value=sav><input type=hidden name=id value=' . $id . '>';
				echo "<td valign=middle align=center><font face=verdana size=2>" . $row[id] . "</td>";
				echo "<td valign=top align=center><font face=verdana size=2>Azienda<br><input autofocus size=20 type=text name=ragione_sociale value='$row[ragione_sociale]'><br><br>
																																				Titolo<br><input size=10 type=text name=title value='$row[title]'><br>
																																				Nome<br><input size=20 type=text name=nome value='$row[nome]'><br>
																																				Cognome<br><input size=20 type=text name=cognome value='$row[cognome]'><br><br>
																																				Data di nascita<br><input size=15 type=text name=nascita value='$row[nascita]'><br><br>
																																				Nazionalit&agrave;<br><input size=20 type=text name=nazionalita value='$row[nazionalita]'>
																																				</td>";
				echo "<td valign=top align=center><font face=verdana size=2>Via, n. civico<br><input size=20 type=text name=via1 value='$row[via1]'><br><br>
																																				NPA<br><input size=10 type=text name=npa1 value='$row[npa1]'><br>
																																				Comune<br><input size=15 type=text name=localita1 value='$row[localita1]'><br><br>
																																				Stato<br><input size=20 type=text name=stato1 value='$row[stato1]'>
																																				</td>";
				echo "<td valign=top align=center><font face=verdana size=2>Via, n. civico<br><input size=20 type=text name=via2 value='$row[via2]'><br><br>
																																				NPA<br><input size=10 type=text name=npa2 value='$row[npa2]'><br>
																																				Comune<br><input size=15 type=text name=localita2 value='$row[localita2]'><br><br>
																																				Stato<br><input size=20 type=text name=stato2 value='$row[stato2]'>
																																				</td>";
				echo "<td valign=top align=center><font face=verdana size=2>Via, n. civico<br><input size=20 type=text name=via3 value='$row[via3]'><br><br>
																																				NPA<br><input size=10 type=text name=npa3 value='$row[npa3]'><br>
																																				Comune<br><input size=15 type=text name=localita3 value='$row[localita3]'><br><br>
																																				Stato<br><input size=20 type=text name=stato3 value='$row[stato3]'>
																																				</td>";
				echo "<td valign=top align=center><font face=verdana size=2>Via, n. civico<br><input size=20 type=text name=via4 value='$row[via4]'><br><br>
																																				NPA<br><input size=10 type=text name=npa4 value='$row[npa4]'><br>
																																				Comune<br><input size=15 type=text name=localita4 value='$row[localita4]'><br><br>
																																				Stato<br><input size=20 type=text name=stato4 value='$row[stato4]'>
																																				</td>";
				echo "<td valign=middle align=center><font face=verdana size=2><input size=20 type=text name=consulente value='$row[consulente]'></td>";
				echo "<td colspan=3 align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
				echo '</form>';
				echo "</tr>";
			}
			echo '<tr>';
			echo "<td valign=middle align=center><font face=verdana size=2><a href=gestionale.php?name=clienti&id=" . $row[id] . ">" . $row[id] . "</a></td>";
			echo "<td valign=middle align=center><font face=verdana size=2>". $row[ragione_sociale] . "<br>
																																			".$row[title]." ".$row[nome]." ".$row[cognome]."<br>
																																			".$row[nascita]." ".$row[nazionalita]."
																																			</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>". $row[via1] . "<br>
																																			".$row[npa1]." ".$row[localita1]."<br>
																																			".$row[stato1]."
																																			</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>". $row[via2] . "<br>
																																			".$row[npa2]." ".$row[localita2]."<br>
																																			".$row[stato2]."
																																			</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>". $row[via3] . "<br>
																																			".$row[npa3]." ".$row[localita3]."<br>
																																			".$row[stato3]."
																																			</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>". $row[via4] . "<br>
																																			".$row[npa4]." ".$row[localita4]."<br>
																																			".$row[stato4]."
																																			</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>". $row[consulente] . "</td>";
			echo "<td align=center valign=middle><font face=verdana size=2><a href=# onClick=modify($row[id],document.getElementById('offerte_detail_1').scrollTop,$ord,$pag);><img border=0 src=immagini/modify.png></a></td>";
			echo "<td align=center valign=middle><font face=verdana size=2><a href=# onClick=remove($row[id],document.getElementById('offerte_detail_1').scrollTop,$ord,$pag);><img border=0 src=immagini/remove.png></a></td>";
			echo "<td align=center valign=middle><font face=verdana size=2><a href=gestionale.php?name=clienti&act=explode&id=$row[id]><img border=0 src=immagini/select.png></a></td>";
			echo '</tr>';
			
			if (!$act) $act=$_POST[act];
			if ($act=='explode') {
				echo "</table>";
				CloseTable();
				echo "<br><br><br>";
				if ($_GET[toggledettagli]) $datodettagli="&toggledettagli=$_GET[toggledettagli]";
				if ($_GET[toggleproposte]) $datoproposte="&toggleproposte=$_GET[toggleproposte]";
				if ($_GET[togglepolizze]) $datopolizze="&togglepolizze=$_GET[togglepolizze]";
				if ($_GET[toggledocumenti]) $datodocumenti="&toggledocumenti=$_GET[toggledocumenti]";
	
				$response='yes';
				$toggle = "<img src=immagini/collapse.png border=0>";
				if ($_GET[toggledettagli]=='yes') $response='no';
				echo "<a name='dettagli'></a>";
				echo "<a href=$_SERVER[PHP_SELF]?name=$_GET[name]&act=$_GET[act]&id=$_GET[id]$datoproposte$datopolizze$datodocumenti&toggledettagli=$response#dettagli>";
				title("<table width=100%><td width=90% align=center><strong>Dettagli cliente</strong></td><td width=10% align=right>$toggle</td></table>");
				echo "</a>";
				if ($_GET[toggledettagli]=='') include('detail_clienti.php');
				if ($_GET[toggledettagli]=='no') include('detail_clienti.php');

				echo "<br><br><br>";
				$response='yes';
				$toggle = "<img src=immagini/collapse.png border=0>";
				if ($_GET[toggleproposte]=='yes') $response='no';
				echo "<a name='proposte'></a>";
				echo "<a href=$_SERVER[PHP_SELF]?name=$_GET[name]&act=$_GET[act]&id=$_GET[id]$datodettagli$datopolizze$datodocumenti&toggleproposte=$response#proposte>";
				title("<table width=100%><td width=90% align=center><strong>Proposte cliente</strong></td><td width=10% align=right>$toggle</td></table>");
				echo "</a>";
				if ($_GET[toggleproposte]=='') include('proposte_clienti.php');
				if ($_GET[toggleproposte]=='no') include('proposte_clienti.php');
	
				echo "<br><br><br>";
				$response='yes';
				$toggle = "<img src=immagini/collapse.png border=0>";
				if ($_GET[togglepolizze]=='yes') $response='no';
				echo "<a name='polizze'></a>";
				echo "<a href=$_SERVER[PHP_SELF]?name=$_GET[name]&act=$_GET[act]&id=$_GET[id]$datodettagli$datoproposte$datodocumenti&togglepolizze=$response#polizze>";
				title("<table width=100%><td width=90% align=center><strong>Polizze cliente</strong></td><td width=10% align=right>$toggle</td></table>");
				echo "</a>";
				if ($_GET[togglepolizze]=='') include('polizze_clienti.php');
				if ($_GET[togglepolizze]=='no') include('polizze_clienti.php');
	
				echo "<br><br><br>";
				$response='yes';
				$toggle = "<img src=immagini/collapse.png border=0>";
				if ($_GET[toggledocumenti]=='yes') $response='no';
				echo "<a name='documenti'></a>";
				echo "<a href=$_SERVER[PHP_SELF]?name=$_GET[name]&act=$_GET[act]&id=$_GET[id]$datodettagli$datoproposte$datopolizze&toggledocumenti=$response#documenti>";
				title("<table width=100%><td width=90% align=center><strong>Gestione documentale</strong></td><td width=10% align=right>$toggle</td></table>");
				echo "</a>";
				if ($_GET[toggledocumenti]=='') include('documenti.php');
				if ($_GET[toggledocumenti]=='no') include('documenti.php');
			}
		}
	}
echo '</p>';
CloseTable();
?>
<script language=JavaScript>
	document.getElementById("offerte_detail_1").scrollTop=<?php echo $_GET[scrolltop]; ?>;
</script>
<?php
echo "</div>";

?>