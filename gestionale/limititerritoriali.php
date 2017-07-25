<script language=JavaScript>
function modify(id,scrolltop,ord,pag) {
	window.location='gestionale.php?name=parametri&subname=tipologie&ord='+ord+'&pag='+pag+'&act=mod&id='+id+'&scrolltop='+scrolltop;
}
function remove(id,scrolltop,ord,pag) {
	x=confirm("Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?");
	if (x) window.location='gestionale.php?name=parametri&subname=tipologie&ord='+ord+'&pag='+pag+'&act=del&id='+id+'&scrolltop='+scrolltop;
}
</script>
<?php
require_once("mainfile.php");
include("header.php");
global $prefix, $db, $admin, $user;

$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$act = $_GET[act];
$id = $_GET[id];
$pag = $_GET['pag'];
$ord = $_GET['ord'];
$tablename = "nuke_limititerritoriali";

$field1 = $_GET[field1];
$field2 = $_GET[field2];

if ($user=='')
{
	header('Location: modules.php?name=Your_Account');
}


title("$sitename: Parametri <i>limiti territoriali</i>");
?>
	<script>
		if (navigator.appName=='Netscape') {
			if (screen.height>1000) allora=screen.height-340;
			if (screen.height<1000) allora=screen.height-380;
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
echo '<input type=button value="Nuovo Record" onclick="location.href=' . chr(39) . 'gestionale.php?name=parametri&subname=limititerritoriali&act=new&ord=' . $ord . '&pag='. $pag . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '<input type=button value="Ricerca" onclick="location.href=' . chr(39) . 'gestionale.php?name=parametri&subname=limititerritoriali&act=search&ord=' . $ord . '&pag='. $pag . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '<input type=button value="Mostra tutti i record" onclick="location.href=' . chr(39) . 'gestionale.php?name=parametri&subname=limititerritoriali' . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '</p>';

	if ($act=='sav'){
	$sql = "UPDATE " . $tablename . " SET  field1='" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field1]))))))) . "' , field2='" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field2]))))))) . "' where id = '" . $id . "'";
		$result = $db->sql_query($sql);
		$act = '';
	}
	if ($act == 'del'){
		$sql = "DELETE FROM " . $tablename . " WHERE ID = " . $id;
		$result = $db->sql_query($sql);
		$id = '';
		$act = '';
	}
	if ($act=='savnew'){
		$sql = "INSERT INTO " . $tablename . " (field1,field2) VALUES ('" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field1]))))))) . "','" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field2]))))))) . "')";
		$result = $db->sql_query($sql);
		$act = '';
	}
	
	if ($id=='') $id='%';
	$condizioni = " id LIKE '$id' ";
	
	if ($act=='gosearch') {
		if ($field1 == '') $field1 = '%';
		if ($field2 == '') $field2 = '%';
		$condizioni .= " AND field1 LIKE '$field1' AND field2 LIKE '$field2' ";
	}
	
	$x_pag = 10; //numero massimo di record per pagina
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

	echo '<table width=100% border=1 cellspacing=0 cellpadding=0>';
	echo '<tr>';
	echo '<th width=10%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=limititerritoriali&ord=id>ID</a></th>';
	echo '<th width=35%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=limititerritoriali&ord=field1>Descrizione -it-</a></th>';
	echo '<th width=35%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=limititerritoriali&ord=field2>Description -en-</a></th>';
	echo '<th width=20% colspan=3><font face=verdana size=2 color=blue>Funzionalità</font></th>';
	echo '</tr>';

	if ($act == 'new') {
		echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=subname value=limititerritoriali><input type=hidden name=name value=parametri><input type=hidden name=pag value=' . $pag . '><input type=hidden name=act value=savnew>';
		echo '<tr>';
		echo "<td valign=middle align=center><font face=verdana size=2><center>[]</center></td>";
		echo "<td valign=middle align=center><input type=text name=field1 size=40></td>";
		echo "<td valign=middle align=center><input type=text name=field2 size=40></td>";
		echo "<td colspan=3 align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
		echo '</tr>';
		echo '</form>';
		$act = '';
	}
	if ($act == 'search') {
		echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=name value=parametri><input type=hidden name=subname value=limititerritoriali>';
		echo '<input type=hidden name=pag value=' . $pag . '>';
		echo '<input type=hidden name=act value=gosearch>';
		echo '<tr>';
		echo "<td valign=middle align=center></td>";
		echo "<td valign=middle align=center><input type=text name=field1 size=40></td>";
		echo "<td valign=middle align=center><input type=text name=field2 size=40></td>";
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
			echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=name value=parametri><input type=hidden name=subname value=limititerritoriali><input type=hidden name=pag value=' . $pag . '><input type=hidden name=act value=sav><input type=hidden name=id value=' . $id . '>';
			echo "<td valign=middle align=center>" . $row[id] . "</td>";
			echo "<td valign=middle align=center><input type=text name=field1 size=40 value='" . $row[field1] . "'></td>";
			echo "<td valign=middle align=center><input type=text name=field2 size=40 value='" . $row[field2] . "'></td>";
			echo "<td colspan=3 align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
			echo '</form>';
		}else{
			echo "<td valign=middle align=center><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=limititerritoriali&id=" . $row[id] . ">" . $row[id] . "</a></td>";
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[field1] . "</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[field2] . "</td>";
			echo "<td align=center valign=middle><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=limititerritoriali&ord=" . $ord . "&pag=" . $pag . "&act=mod&id=" . $row[id] . "><img border=0 src=immagini/modify.png></a></td>";
			echo "<td align=center valign=middle><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=limititerritoriali&ord=" . $ord . "&pag=" . $pag . "&act=del&id=" . $row[id] . " " . $confirm . "><img border=0 src=immagini/remove.png></a></td>";
		}
		echo '</tr>';
		}
	}
	echo "</table>";

CloseTable();
?>

<script language=JavaScript>
	document.getElementById("offerte").scrollTop=<?php echo $_GET[scrolltop]; ?>;
</script>

<?php
echo "</div>";
?>
