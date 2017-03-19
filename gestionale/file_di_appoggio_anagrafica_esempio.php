<?
require_once("mainfile.php");
include("header.php");
global $prefix, $db, $admin, $user;

$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$act = $_GET[act];
$id = $_GET[id];
$pag = $_GET['pag'];
$ord = $_GET['ord'];

$cliente = $_GET[cliente];
$codice = $_GET[codice];
$data = $_GET[data];
$revisione = $_GET[revisione];
$stagione = $_GET[stagione];

if ($user=='')
{
	header('Location: modules.php?name=Your_Account');
}


title("$sitename: Gestione Ordini");

OpenTable();
echo '<p>';
echo '<input type=button value="Nuovo Record" onclick="location.href=' . chr(39) . 'gestionale.php?name=ordini&act=new&ord=' . $ord . '&pag='. $pag . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '<input type=button value="Ricerca" onclick="location.href=' . chr(39) . 'gestionale.php?name=ordini&act=search&ord=' . $ord . '&pag='. $pag . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '<input type=button value="Mostra tutti i record" onclick="location.href=' . chr(39) . 'gestionale.php?name=ordini' . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '</p>';
echo '<p>';
	if ($act=='sav'){
	$sql = "UPDATE nuke_ordini SET  cliente='" . $_GET[cliente] . "' , codice='" . $_GET[codice] . "' , data='" . $_GET[data] . "' , revisione='" . $_GET[revisione] . "' , stagione='" . $_GET[stagione] . "' where id=" . $id;
		$result = $db->sql_query($sql);
		$id = '';
		$act = '';
	}
	if ($act == 'del'){
		$sql = "DELETE FROM nuke_ordini WHERE ID = " . $id;
		$result = $db->sql_query($sql);
		$id = '';
		$act = '';
	}
	if ($act=='savnew'){
		$sql = "INSERT INTO nuke_ordini (cliente,codice,data,revisione,stagione) VALUES ('" . $_GET[cliente] . "','" . $_GET[codice] . "','" . $_GET[data] . "','" . $_GET[revisione] . "','" . $_GET[stagione] . "')";
		$result = $db->sql_query($sql);
		$id = '';
		$act = '';
	}
	
	if ($cliente == '') $cliente = '%';
	if ($codice == '') $codice = '%';
	if ($data == '') $data = '%';
	if ($revisione == '') $revisione = '%';
	if ($stagione == '') $stagione = '%';

	$condizioni = " cliente LIKE '$cliente' AND codice LIKE '$codice' AND data LIKE '$data' AND revisione LIKE '$revisione' AND stagione LIKE '$stagione' ";
	
	$x_pag = 5; //numero massimo di record per pagina
	if ($pag=='') $pag = 1; //prendo il numero di pagina dal query string e se non c'è lo setto a 1
	if ($ord=='') $ord = 'id';
	
	$sql = "SELECT * FROM ".$prefix."_ordini WHERE " . $condizioni;
	$query = $db->sql_query($sql);
	$all_rows = $db->sql_numrows($query);

	$all_pages = ceil($all_rows / $x_pag);
	$first = ($pag - 1) * $x_pag;
	$sql = "SELECT * FROM nuke_ordini WHERE $condizioni ORDER BY $ord LIMIT $first, $x_pag";
	$rs = $db->sql_query($sql);
	$nr = $db->sql_numrows($rs);

	OpenTable();
	echo '<table width=100% border=1 cellspacing=0 cellpadding=0>';
	echo '<tr>';
	echo '<th width=5%><font face=verdana size=2><a href=gestionale.php?name=ordini&ord=id>ID</a></th>';
	echo '<th width=16%><font face=verdana size=2><a href=gestionale.php?name=ordini&ord=cliente>Codice Cliente</a></th>';
	echo '<th width=16%><font face=verdana size=2><a href=gestionale.php?name=ordini&ord=codice>Codice Ordine</a></th>';
	echo '<th width=16%><font face=verdana size=2><a href=gestionale.php?name=ordini&ord=data>Data</a></th>';
	echo '<th width=16%><font face=verdana size=2><a href=gestionale.php?name=ordini&ord=revisione>Revisione</a></th>';
	echo '<th width=16%><font face=verdana size=2><a href=gestionale.php?name=ordini&ord=stagione>Stagione</a></th>';
	echo '<th width=15% colspan=3><font face=verdana size=2 color=blue>Funzionalità</font></th>';
	echo '</tr>';

	if ($act == 'new') {
		echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=name value=ordini><input type=hidden name=pag value=' . $pag . '><input type=hidden name=act value=savnew>';
		echo '<tr>';
		echo "<td valign=middle align=center><font face=verdana size=2><center>[]</center></td>";
		echo "<td valign=middle align=center><input type=text name=cliente size=15></td>";
		echo "<td valign=middle align=center><input type=text name=codice size=15></td>";
		echo "<td valign=middle align=center><input type=text name=data size=15></td>";
		echo "<td valign=middle align=center><input type=text name=revisione size=15></td>";
		echo "<td valign=middle align=center><input type=text name=stagione size=15></td>";
		echo "<td colspan=3 align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
		echo '</tr>';
		echo '</form>';
		$act = '';
	}
	if ($act == 'search') {
		echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=name value=ordini>';
		echo '<input type=hidden name=pag value=' . $pag . '>';
		echo '<input type=hidden name=act value=gosearch>';
		echo '<tr>';
		echo "<td valign=middle align=center><font face=verdana size=2><center>[]</center></td>";
		echo "<td valign=middle align=center><input type=text name=cliente size=15></td>";
		echo "<td valign=middle align=center><input type=text name=codice size=15></td>";
		echo "<td valign=middle align=center><input type=text name=data size=15></td>";
		echo "<td valign=middle align=center><input type=text name=revisione size=15></td>";
		echo "<td valign=middle align=center><input type=text name=stagione size=15></td>";
		echo "<td colspan=3 align=center valign=middle><input type=submit value=Cerca style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
		echo '</tr>';
		echo '</form>';
		$act = '';
	}

	if ($nr != 0){
		while ($row = $db->sql_fetchrow($rs))
		{
		echo '<tr>';
		if ($id == $row['id'] && $act == 'mod'){
			echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=name value=ordine><input type=hidden name=pag value=' . $pag . '><input type=hidden name=act value=sav><input type=hidden name=id value=' . $id . '>';
			echo "<td valign=middle align=center>" . $row[id] . "</td>";
			echo "<td valign=middle align=center><input type=text name=articolo size=15 value='" . $row[cliente] . "'></td>";
			echo "<td valign=middle align=center><input type=text name=articolo size=15 value='" . $row[codice] . "'></td>";
			echo "<td valign=middle align=center><input type=text name=articolo size=15 value='" . $row[data] . "'></td>";
			echo "<td valign=middle align=center><input type=text name=articolo size=15 value='" . $row[revisione] . "'></td>";
			echo "<td valign=middle align=center><input type=text name=articolo size=15 value='" . $row[stagione] . "'></td>";
			echo "<td colspan=3 align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
			echo '</form>';
		}else{
			echo "<td valign=middle align=center><font face=verdana size=2><a href=gestionale.php?name=ordini&id=" . $row[id] . ">" . $row[id] . "</a></td>";
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[cliente] . "</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[codice] . "</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[data] . "</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[revisione] . "</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[stagione] . "</td>";
			echo "<td align=center valign=middle><font face=verdana size=2><a href=gestionale.php?name=ordini&ord=" . $ord . "&pag=" . $pag . "&act=mod&id=" . $row[id] . "><img border=0 src=immagini/mod.ico></a></td>";
			echo "<td align=center valign=middle><font face=verdana size=2><a href=gestionale.php?name=ordini&ord=" . $ord . "&pag=" . $pag . "&act=del&id=" . $row[id] . " " . $confirm . "><img border=0 src=immagini/del.ico></a></td>";
			echo "<td valign=middle align=center><font face=verdana size=2><a href=gestionale.php?act=detail&name=ordini&id_ordine=" . $row[id] . "><img border=0 src=immagini/ok.ico></a></td>";
		}
		echo '</tr>';
		}
	}
	echo "</table>";
echo '</p>';

echo '<p align=center>';
echo '<table width=100%><tr>';
if ($pag > 1){
	$minus = $pag - 1;
	echo '<td width=30% valign=top align=left><font face=verdana size=2><a href=gallerie.php?name=gallerie&ord=' . $ord . '&pag=' . $minus . '&login=' . $login . '&utenza=' . $utenza . '>';
	echo 'Pagina Indietro</a></font></td>';
}else {
	echo '<td width=30% valign=top align=left><font face=verdana size=2>Pagina indietro</font></td>';
}
echo '<td width=40% valign=middle align=center><font face=verdana size=1>';
echo 'Pagina ' . $pag . ' di ' . $all_pages;
echo ' ( ';
for($k = 1; $k < $all_pages+1; $k++){
	echo '<a href=gallerie.php?name=gallerie&ord=' . $ord . '&pag=' . $k . '&login=' . $login . '&utenza=' . $utenza . '>'.$k.'</a> ';
}
echo ')</font></td>';
if ($all_pages > $pag) {
	$major = $pag + 1;
	echo '<td width=30% valign=top align=right><font face=verdana size=2><a href=gallerie.php?name=gallerie&ord=' . $ord . '&pag=' . $major . '&login=' . $login . '&utenza=' . $utenza . '>';
	echo 'Pagina Avanti</a></font></td>';
}else {
	echo '<td width=30% valign=top align=right><font face=verdana size=2>Pagina avanti</font></td>';
}
echo '</tr></table>';
echo '</p>';
CloseTable();
CloseTable();

echo '
<br>
<br>
<br>
<br>
';

$subact = $_GET[subact];
$id_ordine = $_GET[id_ordine];
$act = $_GET[act];

$articolo = $_GET[articolo];
$quantita = $_GET[quantita];
$um = $_GET[um];
$id = $_GET[id];

if ($act == 'detail')
{
	if ($subact == 'del'){
		$sql = "DELETE FROM nuke_ordini_detail WHERE id = " . $id;
		$result = $db->sql_query($sql);
		$act = 'detail';
	}
	if ($subact == 'savenew'){
		$sql = "INSERT INTO nuke_ordini_detail (id_ordine,articolo,quantita,um) VALUES ('" . $_GET[id_ordine] . "','" . $_GET[articolo] . "','" . $_GET[quantita] . "','" . $_GET[um] . "')";
		$result = $db->sql_query($sql);
		$act = 'detail';
	}

	$sql_t = "SELECT * FROM nuke_ordini WHERE id=".$id_ordine;
	$rs_t = $db->sql_query($sql_t);
	while ($row_t = $db->sql_fetchrow($rs_t))
	{
		$codice = $row_t[codice];
	}
	$sql = "SELECT * FROM nuke_ordini_detail WHERE id_ordine=".$id_ordine;
	$rs = $db->sql_query($sql);
	
	title("<strong>Codice Ordine ".$codice."</strong>");
	OpenTable();
		OpenTable();
		echo '<p>';
		echo '<input type=button value="Nuova riga d'."'".'ordine" onclick="location.href=' . chr(39) . 'gestionale.php?name=ordini&act=detail&subact=new&id_ordine=' . $id_ordine . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
		echo '</p>';
		CloseTable();
		
		OpenTable();
		echo '<table width=100% border=1 cellpadding=0 cellspacing=0>';
		echo '<tr>';
		echo '<th align=center valign=middle width=10%><font face=verdana size=2><strong>Ordine</strong></font></th>';
		echo '<th align=center valign=middle width=20%><font face=verdana size=2><strong>Articolo</strong></font></th>';
		echo '<th align=center valign=middle width=30%><font face=verdana size=2><strong>Quantità</strong></font></th>';
		echo '<th align=center valign=middle width=30%><font face=verdana size=2><strong>Unità di misura</strong></font></th>';
		echo '<th width=10% colspan=2><font face=verdana size=2 color=blue>Funzionalità</font></th>';
		echo '</tr>';
		
		if ($subact == 'new') {
		echo '<form action=gestionale.php method=get>
					<input type=hidden name=name value=ordini>
					<input type=hidden name=act value=detail>
					<input type=hidden name=id value='.$id_ordine.'>
					<input type=hidden name=id_ordine value='.$id_ordine.'>
					<input type=hidden name=subact value=savenew>
					';
		echo '<tr>';
		echo "<td valign=middle align=center><font face=verdana size=2>".$codice."</font></td>";
		echo "<td valign=middle align=center>";
			$sql_materiali = "SELECT * FROM nuke_magazzino";
			$rs_materiali = $db->sql_query($sql_materiali);
			echo "<select name=articolo>";
			while ($row_materiali = $db->sql_fetchrow($rs_materiali))
			{
				echo '<option value='.$row_materiali[id].'>'.$row_materiali[articolo].'</option>';
			}
			echo "</select>";
		echo "</td>";
		echo "<td valign=middle align=center><input type=text name=quantita size=10></td>";
		echo "<td valign=middle align=center><input type=text name=um size=15></td>";
		echo "<td align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
		echo '</tr>';
		echo '</form>';
		$act = 'detail';
		}
		while ($row = $db->sql_fetchrow($rs))
			{
				echo '<tr>';
					echo '<td align=center valign=middle><font face=verdana size=2>'.$codice.'</font></td>';
					echo '<td align=center valign=middle><font face=verdana size=2>';
					$sql_materiali = "SELECT * FROM nuke_magazzino where id=" . $row[articolo];
					$rs_materiali = $db->sql_query($sql_materiali);
					while ($row_materiali = $db->sql_fetchrow($rs_materiali))
					{
						echo "<a href=gestionale.php?name=magazzino&id=".$row[articolo].">".$row_materiali[articolo]."</a>";
					}
					echo '</font></td>';
					echo '<td align=center valign=middle><font face=verdana size=2>'.$row[quantita].'</font></td>';
					echo '<td align=center valign=middle><font face=verdana size=2>'.$row[um].'</font></td>';
					echo "<td align=center valign=middle><font face=verdana size=2><a href=gestionale.php?name=ordini&act=detail&subact=del&id=".$row[id]."&id_ordine=" . $row[id_ordine] . " " . $confirm . "><img border=0 src=immagini/del.ico></a></td>";
					echo "<td valign=middle align=center><font face=verdana size=2><a href=gestionale.php?name=ordini&act=detail&subact=flusso&id=".$row[id]."&id_ordine=" . $row[id_ordine] . "><img border=0 src=immagini/ok.ico></a></td>";
			echo '</tr>';
			}

		echo "</table>";
		CloseTable();
	CloseTable();
}



?>