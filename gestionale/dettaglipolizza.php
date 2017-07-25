<script language=JavaScript>
function modify(id,scrolltop,ord,pag) {
	window.location='gestionale.php?name=parametri&subname=dettaglipolizza&ord='+ord+'&pag='+pag+'&act=mod&id='+id+'&scrolltop='+scrolltop;
}
function remove(id,scrolltop,ord,pag) {
	x=confirm("Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?");
	if (x) window.location='gestionale.php?name=parametri&subname=dettaglipolizza&ord='+ord+'&pag='+pag+'&act=del&id='+id+'&scrolltop='+scrolltop;
}
</script>
<?php
require_once("mainfile.php");
include("header.php");
global $prefix, $db, $admin, $user;

$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$act = $_POST[act];
$id = $_POST[id];
$pag = $_POST['pag'];
$ord = $_POST['ord'];
$tablename = "nuke_domandeproposta";
$g_BannerPath = "C:/inetpub/rva.ch/upload/";

if (!$act) $act = $_GET[act];
if (!$ord) $ord = $_GET[ord];
if (!$pag) $pag = $_GET[pag];

$id = $_POST[id];
$tipopolizza = $_POST[tipopolizza];
$description = $_POST[description];
$type = $_POST[type];
$size = $_POST[size];

$filenametodelete = $_GET[filename];
if (!$id) $id = $_GET[id];

if ($user=='')
{
	header('Location: modules.php?name=Your_Account');
}


title("$sitename: Parametri <i>Domande Proposta</i>");
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
	echo '<input type=button value="Nuovo Record" onclick="location.href=' . chr(39) . 'gestionale.php?act=new&name=parametri&subname=dettaglipolizza&ord=' . $ord . '&pag='. $pag . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
	echo '<input type=button value="Mostra tutti i record" onclick="location.href=' . chr(39) . 'gestionale.php?name=parametri&subname=dettaglipolizza' . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
	echo '</p>';

	if ($act=='sav'){
	$sql = "UPDATE " . $tablename . " SET  tipopolizza='" . $_GET[tipopolizza] . "' , description='" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[description]))))))) . "' where id = '" . $id . "'";
		$result = $db->sql_query($sql);
		$act = '';
	}
	if ($act == 'del'){
		//unlink($filenametodelete);
		//if (!file_exists($filenametodelete)) {
			$sql = "DELETE FROM " . $tablename . " WHERE ID = " . $id;
			$result = $db->sql_query($sql);
			$id = '';
			$act = '';
		//}else{
			//echo "Errore, non è stato possibile eliminare il file ".$filenametodelete.", contattare l'amministratore di sistema.";
		//}
	}
	
	if ($act=='savnew'){
		if ($_FILES["file"]["error"] > 0)
	  {
			echo "Non è stato possibile salvare il file ".$_FILES["file"]["name"]. ": ".$_FILES["file"]["error"].". Contattare l'amministratore di sistema.";
		}
		else
		{
			$sql = "INSERT INTO " . $tablename . " (filename,tipopolizza,description,type,size) VALUES ('/upload/" .$_FILES["file"]["name"] . "','" . $tipopolizza . "','" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$description))))))) . "','" . $_FILES["file"]["type"] . "','" . $_FILES["file"]["size"] . "')";
			$result = $db->sql_query($sql);
			move_uploaded_file($_FILES["file"]["tmp_name"],$g_BannerPath.$_FILES["file"]["name"]);
		}
		header("Location: gestionale.php?name=parametri&subname=dettaglipolizza");
		$act = '';
	}

	
	if ($act == 'gosearch') {
		if ($filename == '') $filename = '%';
		if ($tipopolizza == '') $tipopolizza = '%';
		if ($description == '') $description = '%';
		if ($type == '') $type = '%';
		if ($size == '') $size = '%';
		$condizioni .= " WHERE filename LIKE '$filename' AND tipopolizza LIKE '$tipopolizza' AND description LIKE '$description' ";
	}
			
	$x_pag = 20000; //numero massimo di record per pagina
	if ($pag=='') $pag = 1; //prendo il numero di pagina dal query string e se non c'è lo setto a 1
	if ($ord=='') $ord = 'id';
	$sql = "SELECT * FROM  $tablename $condizioni";
	$query = $db->sql_query($sql);
	$all_rows = $db->sql_numrows($query);

	$all_pages = ceil($all_rows / $x_pag);
	$first = ($pag - 1) * $x_pag;
	$sql = "SELECT * FROM $tablename $condizioni ORDER BY $ord LIMIT $first, $x_pag";
	$rs = $db->sql_query($sql);
	$nr = $db->sql_numrows($rs);
	
	echo '<table width=100% border=1 cellspacing=0 cellpadding=0>';
	echo '<tr>';
	echo '<th width=5%><font face=verdana size=2><a href=banner.php?ord=id>ID</a></th>';
	echo '<th width=25%><font face=verdana size=2><a href=banner.php?ord=filename>Filename</a></th>';
	echo '<th width=10%><font face=verdana size=2><a href=banner.php?ord=tipopolizza>Tipo di Polizza</a></th>';
	echo '<th width=25%><font face=verdana size=2><a href=banner.php?ord=description>Description</a></th>';
	echo '<th width=10%><font face=verdana size=2><a href=banner.php?ord=type>Tipo</a></th>';
	echo '<th width=10%><font face=verdana size=2><a href=banner.php?ord=size>Dimensione</a></th>';
	echo '<th width=10%><font face=verdana size=2>Funzionalità</font></th>';
	echo '</tr>';

	if ($act == 'new') {
		echo '<form action=gestionale.php method=post enctype="multipart/form-data"><input type=hidden name=ord value=' . $ord . '><input type=hidden name=pag value=' . $pag . '><input type=hidden name=act value=savnew><input type=hidden name=name value=parametri><input type=hidden name=subname value=dettaglipolizza>';
		echo '<tr>';
		echo "<td valign=middle align=center>&nbsp;</td>";
		echo "<td valign=middle align=center><input type=file name=file id=file></td>";
		echo "<td valign=middle align=center><select name=tipopolizza><option value=''></option>";
		$sql_tipologia = "SELECT * FROM nuke_tipologiepolizze";
		$rs_tipologia = $db->sql_query($sql_tipologia);
		while ($tipologia = $db->sql_fetchrow($rs_tipologia))
		{
			echo "<option value='".$tipologia[id]."'>".$tipologia[field2]."</option>";
		}
		echo "</select></td>";
		echo "<td valign=middle align=center><input type=text name=description size=50></td>";
		echo "<td valign=middle align=center>&nbsp;</td>";
		echo "<td valign=middle align=center>&nbsp;</td>";
		echo "<td align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
		echo '</tr>';
		echo '</form>';
		$act = '';
	}

	if ($nr != 0){
		for($x = 0; $x < $nr; $x++){
		$row = $db->sql_fetchrow($rs);
		if ($id == $row['id'] && $act == 'mod'){
			echo '<tr>';
			echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=pag value=' . $pag . '><input type=hidden name=act value=sav><input type=hidden name=id value=' . $id . '><input type=hidden name=name value=parametri><input type=hidden name=subname value=dettaglipolizza>';
			echo '<tr>';
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[id] . "</td>";
			echo "<td valign=middle align=center><font face=verdana size=2><a href='".$row[filename]."' target=_blank>" . $row[filename] . "</a></td>";
			echo "<td valign=middle align=center><select name=tipopolizza>";
			$sql_tipologia = "SELECT * FROM nuke_tipologiepolizze";
			$rs_tipologia = $db->sql_query($sql_tipologia);
			while ($tipologia = $db->sql_fetchrow($rs_tipologia))
			{
				if ($tipologia[id]==$row[tipopolizza]) $selected = ' SELECTED';
				echo "<option".$selected." value='".$tipologia[id]."'>".$tipologia[field2]."</option>";
				$selected='';
			}
			echo "</select></td>";
			echo "<td valign=middle align=center><input type=text name=description size=50 value='$row[description]'></td>";
			echo "<td valign=middle align=center>&nbsp;</td>";
			echo "<td valign=middle align=center>&nbsp;</td>";
			echo "<td align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
			echo '</form>';
			echo '</tr>';
		}
		echo '<tr>';
		echo "<td valign=middle align=center><font face=verdana size=2>" . $row[id] . "</td>";
		echo "<td valign=middle align=center><font face=verdana size=2><a href='".$row[filename]."' target=_blank>" . $row[filename] . "</a></td>";
		echo "<td valign=middle align=center><font face=verdana size=2>";
		$sql_tipologia = "SELECT * FROM nuke_tipologiepolizze where id='".$row[tipopolizza]."'";
		$rs_tipologia = $db->sql_query($sql_tipologia);
		$tipologia = $db->sql_fetchrow($rs_tipologia);
		echo "aaa".$tipologia[field2];
		echo "</td>";
		echo "<td valign=middle align=center><font face=verdana size=2>" . $row[description] . "</td>";
		echo "<td valign=middle align=center><font face=verdana size=2>" . $row[type] . "</td>";
		echo "<td valign=middle align=center><font face=verdana size=2>" . $row[size] . "</td>";
		echo "<td align=center valign=middle><font face=verdana size=2>
					<a href=# onClick=modify($row[id],eval(document.getElementById('offerte').scrollTop),$ord,$pag);><img border=0 src=immagini/modify.png></a>
					<a href=# onClick=remove($row[id],eval(document.getElementById('offerte').scrollTop),$ord,$pag);><img border=0 src=immagini/remove.png></a></td>";
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
