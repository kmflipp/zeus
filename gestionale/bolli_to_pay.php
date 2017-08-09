<?php
require_once("mainfile.php");
include("header.php");
global $prefix, $db, $admin, $user;

$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$act = $_GET[act];
$id = $_GET[id];
$pag = $_GET['pag'];
$ord = $_GET['ord'];
$tablename = "nuke_polizze";

$numeropolizza = $_GET[numeropolizza];
$field8 = $_GET[field8];
$field10 = $_GET[field10];
$field11 = $_GET[field11];
$field12 = $_GET[field12];
$field13 = $_GET[field13];

if ($user=='')
{
	header('Location: modules.php?name=Your_Account');
}


title("$sitename: Gestione <i>bolli</i> LLOYD'S");
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
OpenTable();
echo '<p>';
echo '<input type=button value="Ricerca" onclick="location.href=' . chr(39) . 'gestionale.php?name=lloyds&subname=bolli_to_pay&act=search&ord=' . $ord . '&pag='. $pag . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '<input type=button value="Mostra tutti i record" onclick="location.href=' . chr(39) . 'gestionale.php?name=lloyds&subname=bolli_to_pay' . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '</p>';
echo '<p>';

	if ($act=='sav'){
	$sql = "UPDATE " . $tablename . " SET  field1='" . $_GET[field1] . "' , field2='" . $_GET[field2] . "' where id = '" . $id . "'";
		$result = $db->sql_query($sql);
		$id = '';
		$act = '';
	}
	
	if ($numeropolizza == '') $numeropolizza = '%';
	if ($field8 == '') $field8 = '%';
	if ($field10 == '') $field10 = '%';
	if ($field11 == '') $field11 = '%';
	if ($field12 == '') $field12 = '%';
	if ($field13 == '') $field13 = '%';

	$condizioni = " numeropolizza LIKE '$numeropolizza' AND field8 LIKE '$field8' AND field10 LIKE '$field10' AND field11 LIKE '$field11' AND field12 LIKE '$field12' AND field13 LIKE '$field13' ";
	
	$x_pag = 10000; //numero massimo di record per pagina
	if ($pag=='') $pag = 1; //prendo il numero di pagina dal query string e se non c'è lo setto a 1
	if ($ord=='') $ord = 'id';
	
	$sql = "SELECT * FROM ".$tablename." WHERE " . $condizioni;
	$query = $db->sql_query($sql);
	$all_rows = $db->sql_numrows($query);

	$all_pages = ceil($all_rows / $x_pag);
	$first = ($pag - 1) * $x_pag;
	$sql = "SELECT * FROM ".$tablename." WHERE $condizioni ORDER BY $ord LIMIT $first, $x_pag";
	$rs = $db->sql_query($sql);
	$nr = $db->sql_numrows($rs);

	echo "<table width=100% border=1 cellspacing=0 cellpadding=0>";
	echo "<tr>";
	echo "<th width=25%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=bolli_to_pay&ord=numeropolizza>Numero polizza</a></th>";
	echo "<th width=7%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=bolli_to_pay&ord=field10>Scadenza</a></th>";
	echo "<th width=4%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=bolli_to_pay&ord=field13>Tasso</a></th>";
	echo "<th width=10%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=bolli_to_pay&ord=field11>Copertura (gg)</a></th>";
	echo "<th width=14%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=bolli_to_pay&ord=field18>Somma assicurata</a></th>";
	echo "<th width=10%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=bolli_to_pay&ord=field12>Premio lordo</a></th>";
	echo "<th width=15%><font face=verdana size=2>Premio prorata</th>";
	echo "<th width=10%><font face=verdana size=2>Bollo</th>";
	echo "<th width=5%>&nbsp;</th>";
	echo "</tr>";

	if ($act == 'search') {
		echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=name value=lloyds><input type=hidden name=subname value=bolli_to_pay><input type=hidden name=pag value=' . $pag . '><input type=hidden name=act value=gosearch>';
		echo '<tr>';
		echo "<td valign=middle align=center><input type=text name=numeropolizza size=10></td>";
		echo "<td valign=middle align=center><input type=text name=field10 size=10></td>";
		echo "<td valign=middle align=center><input type=text name=field13 size=10></td>";
		echo "<td valign=middle align=center><input type=text name=field11 size=10></td>";
		echo "<td valign=middle align=center><input type=text name=field8 size=10></td>";
		echo "<td valign=middle align=center><input type=text name=field12 size=10></td>";
		echo "<td valign=middle align=center></td>";
		echo "<td valign=middle align=center></td>";
		echo "<td align=center valign=middle><input type=submit value=Cerca style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
		echo '</tr>';
		echo '</form>';
		$act = '';
	}

	if ($nr != 0){
		while ($row = $db->sql_fetchrow($rs))
		{
		echo '<tr>';
		echo "<td valign=middle align=center><font face=verdana size=2>$row[numeropolizza]</td>";
		echo "<td valign=middle align=center><font face=verdana size=2>$row[field10]</td>";
		echo "<td valign=middle align=center><font face=verdana size=2>$row[field13]%</td>";
		echo "<td valign=middle align=center><font face=verdana size=2>".round($row[field11])."</td>";
		echo "<td valign=middle align=center><font face=verdana size=2>$row[valuta] $row[field8]</td>";
		echo "<td valign=middle align=center><font face=verdana size=2>$row[valuta] $row[field12]</td>";
		$prorata = round(($row[field12]/365)*round($row[field11]));
		echo "<td valign=middle align=center><font face=verdana size=2>$row[valuta] $prorata</td>";
		$bollo = round($prorata/100*$row[field13],2);
		echo "<td valign=middle align=center><font face=verdana size=2>$row[valuta] $bollo</td>";
		echo "<td align=center valign=middle><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=bolli_to_pay&act=mod&idpolizza=" . $row[idpolizza] . "><img border=0 src=immagini/modify.png></a></td>";
		echo '</tr>';
		}
	}
	echo "</table>";
echo '</p>';
CloseTable();
?>

<script language=JavaScript>
	document.getElementById("offerte").scrollTop=<?php echo $_GET[scrolltop]; ?>;
</script>

<?php
echo "</div>";
?>