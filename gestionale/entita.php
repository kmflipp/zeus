<script>
	function modify(id,scrolltop,ord,pag) {
		window.location='gestionale.php?name=clienti&ord='+ord+'&pag='+pag+'&act=mod&id='+id+'&scrolltop='+scrolltop;
	}
	function remove_cat(id,scrolltop,ord,pag) {
		x=confirm("Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?");
		if (x) window.location='gestionale.php?name=parametri&subname=entita&act=delcategorie&idcategoria='+id+'&scrolltop='+scrolltop;
	}
</script>
<?php
require_once("mainfile.php");
include("header.php");
global $prefix, $db, $admin, $user;

$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$act = $_GET[act];
$id = $_GET[id];
$tablename = "nuke_entita";

$field1 = $_GET[field1];
$field2 = $_GET[field2];
$field3 = $_GET[field3];
$field4 = $_GET[field4];
$field5 = $_GET[field5];
$field6 = $_GET[field6];
$field7 = $_GET[field7];
$field8 = $_GET[field8];
$ordine = $_GET[ordine];

if ($user=='')
{
	header('Location: modules.php?name=Your_Account');
}
title("$sitename: Parametri <i>Entità Assicurate</i>");

?>
	<script>
		if (navigator.appName=='Netscape') {
			if (screen.height>1000) allora=screen.height-340;
			if (screen.height<1000) allora=screen.height-380;
			document.write('<div class="offerte" id="offerte_detail_1" style="position:relative;width:100%;margin-top:0;  _position:absolute;_top:expression(eval(document.body.scrollTop)+58);height:'+allora+'px;overflow:auto;padding:0px;">');
		}
		if (navigator.appName=='Microsoft Internet Explorer') {
			if (window.document.documentElement.offsetHeight>1000) allora=window.document.documentElement.offsetHeight-200;
			if (window.document.documentElement.offsetHeight<1000) allora=window.document.documentElement.offsetHeight-200;
			document.write('<div class="offerte" id="offerte_detail_1" style="position:relative;width:100%;margin-top:100;_position:absolute;_top:expression(eval(document.body.scrollTop)+58);height:'+allora+'px;overflow:auto;padding:0px;">');
		}
	</script>
<?php


	if ($act=='savecategorie'){
		$_GET[categoria] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[categoria])))))));
		$_GET[category] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[category])))))));
		$sql = "INSERT INTO nuke_categorie (categoria,category,idpolizza,ordine) VALUES ('$_GET[categoria]','$_GET[category]','$_GET[idpolizza]','$_GET[ordine]')";
		$result = $db->sql_query($sql);
		$act = '';
	}
	if ($act=='updatecategorie'){
		$_GET[categoria] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[categoria])))))));
		$_GET[category] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[category])))))));
		$sql = "UPDATE nuke_categorie SET categoria='$_GET[categoria]', category='$_GET[category]', ordine='$_GET[ordine]' WHERE id = '$_GET[idcategoria]'";
		$result = $db->sql_query($sql);
		$act = '';
	}
	if ($act == 'delcategorie'){
		$sql = "SELECT * FROM NUKE_OFFERTE_DETAIL1 WHERE IDENTITA in (SELECT id FROM nuke_entita WHERE field1 = '$_GET[idcategoria]')";
		$rs = $db->sql_query($sql);
		$nr = $db->sql_numrows($rs);
		if ($nr==0) {
			$sql = "DELETE FROM nuke_categorie WHERE id = '$_GET[idcategoria]'";
			$result = $db->sql_query($sql);
			$sql = "DELETE FROM nuke_entita WHERE field1 = '$_GET[idcategoria]'";
			$result = $db->sql_query($sql);
		}else{
			$msg = "Non è possibile elimare la categoria $_GET[idcategoria] in quanto sono presenti degli item collegati a delle offerte registrate.";
			echo "<script>alert('".$msg."');</script>";
		}
		$act = '';
	}
	if ($act=='savenewitem'){
		$_GET[field4] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field4])))))));
		$_GET[field5] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field5])))))));
		$_GET[field6] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field6])))))));
		$_GET[field7] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field7])))))));
		$sql = "INSERT INTO nuke_entita (field1,field4,field5,field6,field7,field8,ordine) VALUES ('$_GET[idcategoria]','$_GET[field4]','$_GET[field5]','$_GET[field6]','$_GET[field7]','$_GET[field8]','$_GET[ordine]')";
		$result = $db->sql_query($sql);
		$act = '';
		if ($_GET[idofferta]!='') {
			header("Location: gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[idofferta]#sonoqui");
		}
	}
	if ($act=='saveitem'){
		$_GET[field4] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field4])))))));
		$_GET[field5] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field5])))))));
		$_GET[field6] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field6])))))));
		$_GET[field7] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field7])))))));
		$sql = "UPDATE nuke_entita SET field4='$_GET[field4]', field5='$_GET[field5]', field6='$_GET[field6]', field7='$_GET[field7]', field8='$_GET[field8]', ordine='$_GET[ordine]' WHERE id = '$_GET[iditem]'";
		$result = $db->sql_query($sql);
		$act = '';
	}
	if ($act == 'delitem'){
		$sql = "SELECT * FROM nuke_offerte_detail1 WHERE identita = '$_GET[iditem]'";
		$rs = $db->sql_query($sql);
		$nr = $db->sql_numrows($rs);
		if ($nr==0) {
			$sql = "DELETE FROM nuke_entita WHERE id = '$_GET[iditem]'";
			$result = $db->sql_query($sql);
		}else{
			$msg = "Impossibile eliminare item $_GET[iditem] in quanto sono presenti delle offerte registrate che lo contengono.";
			echo "<script>alert('".$msg."');</script>";
		}
		$act = '';
	}
	
	if ($field1 == '') $field1 = '%';
	if ($field2 == '') $field2 = '%';
	if ($field3 == '') $field3 = '%';
	if ($field4 == '') $field4 = '%';
	if ($field5 == '') $field5 = '%';
	if ($field6 == '') $field6 = '%';
	if ($field7 == '') $field7 = '%';
	if ($field8 == '') $field8 = '%';
	if ($ordine == '') $ordine = '%';

	//Visualizzazione ad albero
	$rs_tipopolizze = $db->sql_query("SELECT * FROM nuke_tipologiepolizze ");
	while ($tipopolizze = $db->sql_fetchrow($rs_tipopolizze))
	{
		OpenTable();
		echo '<div id="albero">';
		echo "<table width=100% border=0 cellspacing=0 cellpadding=0>";
		$segno=$piu;
		echo "<td align=left width=90%><strong><u>Tipo di polizza: $tipopolizze[field2]</u></td>";
		echo "<td align=right width=10%></td>";
		echo "</table>";
		echo "</div><br>";
		$rs_categorie = $db->sql_query("SELECT * FROM nuke_categorie WHERE idpolizza=$tipopolizze[id] order by ordine");
		while ($categorie = $db->sql_fetchrow($rs_categorie))
		{
			if ($act=='modcategoria' && $_GET[idcategoria]==$categorie[id]) {
				echo '<div id="into_albero" align=right>';
				echo "<table width=95% border=0 cellspacing=0 cellpadding=0>
								<form action=gestionale.php method=get><input type=hidden name=name value=parametri><input type=hidden name=subname value=entita><input type=hidden name=act value=updatecategorie><input type=hidden name=idcategoria value=".$categorie[id].">
								<input type=hidden name=scrolltop value=".$_GET[scrolltop].">
								<td width=80% align=left><strong>".$segno."<input type=text size=3 name=ordine value='".$categorie[ordine]."'>&nbsp;<input type=text size=70 name=categoria value='".$categorie[categoria]."'>&nbsp;<input size=70 type=text name=category value='".$categorie[category]."'></strong></td>
								<td align=right><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>
							</table>";
				echo "</div>";
			} else {
				echo '<div id="into_albero" align=right>';
				echo "<table width=95% border=0 cellspacing=0 cellpadding=0>
								<td width=80% align=left style='border-bottom: dotted;border-width: 1px;'><strong>".$segno."&nbsp;$categorie[ordine]&nbsp;".$categorie[categoria]." (<i>".$categorie[category]."</i>)</strong></td>
								<td align=right style='border-bottom: dotted;border-width: 1px;'><a href=# onClick=window.location='gestionale.php?name=parametri&subname=entita&act=modcategoria&idcategoria=$categorie[id]&scrolltop='+document.getElementById('offerte_detail_1').scrollTop;><img border=0 src=immagini/modify.png></a>
								&nbsp;
								<a href=# onClick=remove('$categorie[id]',document.getElementById('offerte_detail_1').scrollTop,'','');><img border=0 src=immagini/remove.png></a></td>
							</table>";
				echo "</div>";
				$ultimoidcat = $categorie[ordine]+1;
			}
			$rs_nomi = $db->sql_query("SELECT * FROM nuke_entita WHERE field1='$categorie[id]' order by ordine");
			while ($nomi = $db->sql_fetchrow($rs_nomi))
			{
				if ($_GET[iditem]==$nomi[id] && $act=='moditem') {
					echo '<div id="into_albero" align=right>';
					echo "<table width=85% border=0 cellspacing=0 cellpadding=0>
									<form action=gestionale.php method=get><input type=hidden name=name value=parametri><input type=hidden name=subname value=entita><input type=hidden name=act value=saveitem><input type=hidden name=iditem value=$nomi[id]>
									<input type=hidden name=field6 value=".$nomi[field6]."><input type=hidden name=field7 value=".$nomi[field7].">
									<input type=hidden name=scrolltop value=".$_GET[scrolltop].">
									<td width=80% align=left>
										<input type=text size=3 name=ordine value='".$nomi[ordine]."'>
										&nbsp;
										<input type=text size=60 name=field4 value='".$nomi[field4]."'>
										&nbsp;
										<input type=text size=60 name=field5 value='".$nomi[field5]."'>
										&nbsp;Default:
										<select name=field8><option SELECTED value=1>Sì</option><option value=0>No</option></select>
									</td>
									<td align=right><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>
									</form>
								</table>";
					echo "</div>";
				}
				else {
					echo '<div id="into_albero" align=right>';
					echo "<table width=85% border=0 cellspacing=0 cellpadding=0>
									<td width=80% align=left style='border-bottom: dotted;border-width: 1px;'>$nomi[ordine]&nbsp;".$nomi[field4]." (<i>".$nomi[field5]."</i>)</td>
									<td align=right style='border-bottom: dotted;border-width: 1px;'>
									<a href=# onClick=window.location='gestionale.php?name=parametri&subname=entita&act=moditem&iditem=$nomi[id]&scrolltop='+document.getElementById('offerte_detail_1').scrollTop;><img border=0 src=immagini/modify.png></a>
									&nbsp;
									<a href=# onClick=window.location='gestionale.php?name=parametri&subname=entita&act=delitem&iditem=$nomi[id]&scrolltop='+document.getElementById('offerte_detail_1').scrollTop; $confirm><img border=0 src=immagini/remove.png></a></td>
								</table>";
					echo "</div>";
					$ultimoid = $nomi[ordine]+1;
				}
			}
			if ($act=='newitem' && $_GET[idcategoria]==$categorie[id]) {
				echo '<div id="into_albero" align=right>';
				echo "<table class=bottomBorder width=85% border=0 cellspacing=0 cellpadding=0>
								<form action=gestionale.php method=get><input type=hidden name=name value=parametri><input type=hidden name=subname value=entita><input type=hidden name=act value=savenewitem>
								<input type=hidden name=idpolizza value=$tipopolizze[id]><input type=hidden name=idcategoria value=$categorie[id]>
								<input type=hidden name=field6><input type=hidden name=field7><input type=hidden name=idofferta value=$_GET[idofferta]>
								<input type=hidden name=scrolltop value=".$_GET[scrolltop].">
								<td width=80% align=left>
									<input type=text size=3 name=ordine value='$ultimoid'>
									&nbsp;
									<input type=text size=60 name=field4>
									&nbsp;
									<input type=text size=60 name=field5>
									&nbsp;Default:
									<select name=field8><option SELECTED value=1>Sì</option><option value=0>No</option></select>
								</td>
								<td align=right><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>
								</form>
							</table>";
				echo "</div>";
			}
			echo '<div id="into_albero" align=right><p>';
			echo "<table width=85% border=0 cellspacing=0 cellpadding=0>
							<td width=80% align=left><a href=# onClick=window.location='gestionale.php?name=parametri&subname=entita&act=newitem&idcategoria=$categorie[id]&idpolizza=$tipopolizze[id]&scrolltop='+document.getElementById('offerte_detail_1').scrollTop;><b>Nuovo...</b></a></td>
							<td align=right></td>
						</table>";
			echo "</p></div>";
			echo "<p align=right><table width=85% border=0 cellspacing=0 cellpadding=0>
							<td><hr></td>
						</table></p>";
		}
		if ($act=='newcategoria' && $_GET[idpolizza]==$tipopolizze[id]) {
			echo '<div id="into_albero" align=right>';
			echo "<table width=95% border=0 cellspacing=0 cellpadding=0>
							<form action=gestionale.php method=get><input type=hidden name=name value=parametri><input type=hidden name=subname value=entita><input type=hidden name=act value=savecategorie><input type=hidden name=idpolizza value=$tipopolizze[id]>
							<input type=hidden name=scrolltop value=".$_GET[scrolltop].">
							<td width=80% align=left><strong>$segno</strong>&nbsp;<input type=text size=3 name=ordine value='$ultimoidcat'>&nbsp;<input type=text size=70 name=categoria>&nbsp;<input size=70 type=text name=category></td>
							<td align=right><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>
						</table>";
			echo "</div>";
		}
		echo '<div id="into_albero" align=right><p>';
		echo "<table width=95% border=0 cellspacing=0 cellpadding=0>
						<td width=80% align=left><a href=# onClick=window.location='gestionale.php?name=parametri&subname=entita&act=newcategoria&idpolizza=$tipopolizze[id]&scrolltop='+document.getElementById('offerte_detail_1').scrollTop;><b>Nuova categoria...</b></a></td>
						<td align=right></td>
					</table>";
		echo "</p></div>";
		CloseTable();
	}
?>
<script language=JavaScript>
	document.getElementById("offerte_detail_1").scrollTop=<?php echo $_GET[scrolltop]; ?>;
</script>
<?php
echo "</div>";
?>