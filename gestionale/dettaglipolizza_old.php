<?php
require_once("mainfile.php");
include("header.php");
global $prefix, $db, $admin, $user;

$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$act = $_GET[act];
$id = $_GET[id];
$tablename = "nuke_dettaglipolizza";

$field1 = $_GET[field1];
$field2 = $_GET[field2];
$field3 = $_GET[field3];
$field4 = $_GET[field4];
$field5 = $_GET[field5];
$field6 = $_GET[field6];
$field7 = $_GET[field7];
$field8 = $_GET[field8];

if ($user=='')
{
	header('Location: modules.php?name=Your_Account');
}


title("$sitename: Parametri <i>Entità Assicurate</i>");

echo '<a name="sonoqui"></a>';

	if ($act=='savecategorie'){
		$_GET[categoria] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[categoria])))))));
		$_GET[category] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[category])))))));
		$sql = "INSERT INTO nuke_categoriedettagli (categoria,category,idpolizza) VALUES ('$_GET[categoria]','$_GET[category]','$_GET[idpolizza]')";
		$result = $db->sql_query($sql);
		$act = '';
	}
	if ($act=='updatecategorie'){
		$_GET[categoria] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[categoria])))))));
		$_GET[category] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[category])))))));
		$sql = "UPDATE nuke_categoriedettagli SET categoria='$_GET[categoria]', category='$_GET[category]' WHERE id = '$_GET[idcategoria]'";
		$result = $db->sql_query($sql);
		$act = '';
	}
	if ($act == 'delcategorie'){
		$sql = "DELETE FROM nuke_categoriedettagli WHERE id = '$_GET[idcategoria]'";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_dettaglipolizza WHERE field1 = '$_GET[idcategoria]'";
		$result = $db->sql_query($sql);
		$act = '';
	}
	if ($act=='savenewitem'){
		$_GET[field4] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field4])))))));
		$_GET[field5] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field5])))))));
		$_GET[field6] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field6])))))));
		$_GET[field7] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field7])))))));
		$sql = "INSERT INTO nuke_dettaglipolizza (field1,field4,field5,field6,field7,field8) VALUES ('$_GET[idcategoria]','$_GET[field4]','$_GET[field5]','$_GET[field6]','$_GET[field7]','$_GET[field8]')";
		$result = $db->sql_query($sql);
		$act = '';
	}
	if ($act=='saveitem'){
		$_GET[field4] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field4])))))));
		$_GET[field5] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field5])))))));
		$_GET[field6] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field6])))))));
		$_GET[field7] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field7])))))));
		$sql = "UPDATE nuke_dettaglipolizza SET field4='$_GET[field4]', field5='$_GET[field5]', field6='$_GET[field6]', field7='$_GET[field7]', field8='$_GET[field8]' WHERE id = '$_GET[iditem]'";
		$result = $db->sql_query($sql);
		$act = '';
	}
	if ($act == 'delitem'){
		$sql = "DELETE FROM nuke_dettaglipolizza WHERE id = '$_GET[iditem]'";
		$result = $db->sql_query($sql);
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

	//Visualizzazione ad albero
	$piu="+";
	$meno="-";
	OpenTable();
	$rs_tipopolizze = $db->sql_query("SELECT * FROM nuke_tipologiepolizze ");
	while ($tipopolizze = $db->sql_fetchrow($rs_tipopolizze))
	{
		OpenTable();
		echo "<a name=$tipopolizze[id]>";
		echo '<div id="albero">';
		echo "<table width=100% border=0 cellspacing=0 cellpadding=0>";
		$segno=$piu;
		echo "<td align=left width=90%><strong>".$segno."&nbsp;[$tipopolizze[id]] $tipopolizze[field2]</td>";
		echo "<td align=right width=10%></td>";
		echo "</table>";
		echo "</div>";
		if ($act=='newcategoria' && $_GET[idpolizza]==$tipopolizze[id]) {
			echo '<div id="into_albero" align=right>';
			echo "<table width=95% border=0 cellspacing=0 cellpadding=0>
							<form action=gestionale.php#$tipopolizze[id] method=get><input type=hidden name=name value=parametri><input type=hidden name=subname value=dettaglipolizza><input type=hidden name=act value=savecategorie><input type=hidden name=idpolizza value=$tipopolizze[id]>
							<td width=80% align=left><strong>$segno</strong><input type=text size=70 name=categoria>&nbsp;<input size=70 type=text name=category></td>
							<td align=right><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>
						</table>";
			echo "</div>";
		}
		$rs_categorie = $db->sql_query("SELECT * FROM nuke_categoriedettagli WHERE idpolizza=$tipopolizze[id]");
		while ($categorie = $db->sql_fetchrow($rs_categorie))
		{
			$segno=$piu;
			echo "<a name=categoria$categorie[id]></a>";
			if ($act=='modcategoria' && $_GET[idcategoria]==$categorie[id]) {
				echo '<div id="into_albero" align=right>';
				echo "<table width=95% border=0 cellspacing=0 cellpadding=0>
								<form action=gestionale.php#categoria$categorie[id] method=get><input type=hidden name=name value=parametri><input type=hidden name=subname value=dettaglipolizza><input type=hidden name=act value=updatecategorie><input type=hidden name=idcategoria value=".$categorie[id].">
								<td width=80% align=left><strong>".$segno."</strong><input type=text size=70 name=categoria value='".$categorie[categoria]."'>&nbsp;<input size=70 type=text name=category value='".$categorie[category]."'></td>
								<td align=right><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>
							</table>";
				echo "</div>";
			} else {
				echo '<div id="into_albero" align=right>';
				echo "<table width=95% border=0 cellspacing=0 cellpadding=0>
								<td width=80% align=left><strong>".$segno."</strong>&nbsp;".$categorie[categoria]." (<i>".$categorie[category]."</i>)</td>
								<td align=right><a href=gestionale.php?name=parametri&subname=dettaglipolizza&act=modcategoria&idcategoria=$categorie[id]#categoria$categorie[id]><img border=0 src=immagini/modify.png></a>
								&nbsp;
								<a href=gestionale.php?name=parametri&subname=dettaglipolizza&act=delcategorie&idcategoria=$categorie[id]#$tipopolizze[id] $confirm><img border=0 src=immagini/remove.png></a></td>
							</table>";
				echo "</div>";
			}
			if ($act=='newitem' && $_GET[idcategoria]==$categorie[id]) {
				echo '<div id="into_albero" align=right>';
				echo "<table class=bottomBorder width=85% border=0 cellspacing=0 cellpadding=0>
								<form action=gestionale.php#categoria$idcategoria method=get><input type=hidden name=name value=parametri><input type=hidden name=subname value=dettaglipolizza><input type=hidden name=act value=savenewitem>
								<input type=hidden name=idpolizza value=$tipopolizze[id]><input type=hidden name=idcategoria value=$categorie[id]>
								<input type=hidden name=field6><input type=hidden name=field7>
								<td width=80% align=left>
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
			$rs_nomi = $db->sql_query("SELECT * FROM nuke_dettaglipolizza WHERE field1='$categorie[id]'");
			while ($nomi = $db->sql_fetchrow($rs_nomi))
			{
				echo "<a name=item$nomi[id]></a>";
				if ($_GET[iditem]==$nomi[id] && $act=='moditem') {
					echo '<div id="into_albero" align=right>';
					echo "<table width=85% border=0 cellspacing=0 cellpadding=0>
									<form action=gestionale.php#item$nomi[id] method=get><input type=hidden name=name value=parametri><input type=hidden name=subname value=dettaglipolizza><input type=hidden name=act value=saveitem><input type=hidden name=iditem value=$nomi[id]>
									<input type=hidden name=field6 value=".$nomi[field6]."><input type=hidden name=field7 value=".$nomi[field7].">
									<td width=80% align=left>
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
									<td width=80% align=left>".$nomi[field4]." (<i>".$nomi[field5]."</i>)</td>
									<td align=right><a href=gestionale.php?name=parametri&subname=dettaglipolizza&act=moditem&iditem=$nomi[id]#item$nomi[id]><img border=0 src=immagini/modify.png></a>
									&nbsp;
									<a href=gestionale.php?name=parametri&subname=dettaglipolizza&act=delitem&iditem=$nomi[id]#categoria$categorie[id] $confirm><img border=0 src=immagini/remove.png></a></td>
								</table>";
					echo "</div>";
				}
			}
			echo '<div id="into_albero" align=right><p>';
			echo "<table width=85% border=0 cellspacing=0 cellpadding=0>
							<td width=80% align=left><a href=gestionale.php?name=parametri&subname=dettaglipolizza&act=newitem&idcategoria=$categorie[id]&idpolizza=$tipopolizze[id]#categoria$categorie[id]><b>Nuovo...</b></a></td>
							<td align=right></td>
						</table>";
			echo "</p></div>";		
		}
		echo '<div id="into_albero" align=right><p>';
		echo "<table width=95% border=0 cellspacing=0 cellpadding=0>
						<td width=80% align=left><a href=gestionale.php?name=parametri&subname=dettaglipolizza&act=newcategoria&idpolizza=$tipopolizze[id]#$tipopolizze[id]><b>Nuova categoria...</b></a></td>
						<td align=right></td>
					</table>";
		echo "</p></div>";
		CloseTable();
	}
CloseTable();

	
	//fine della visuazlizzazione ad albero
	
	/*
	OpenTable();
	echo '<table width=100% border=1 cellspacing=0 cellpadding=0>';
	echo '<tr>';
	echo '<th width=5%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=dettaglipolizza&ord=id>ID</a></th>';
	echo '<th width=13%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=dettaglipolizza&ord=field1>Tipo di assicurazione</a></th>';
	echo '<th width=11%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=dettaglipolizza&ord=field2>Categoria -it-</a></th>';
	echo '<th width=11%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=dettaglipolizza&ord=field3>Categoria -en-</a></th>';
	echo '<th width=11%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=dettaglipolizza&ord=field4>Nome -it-</a></th>';
	echo '<th width=11%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=dettaglipolizza&ord=field5>Nome -en-</a></th>';
	echo '<th width=13%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=dettaglipolizza&ord=field6>Descrizione -it-</a></th>';
	echo '<th width=13%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=dettaglipolizza&ord=field7>Descrizione -en-</a></th>';
	echo '<th width=3%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=dettaglipolizza&ord=field8>Default</a></th>';
	echo '<th width=9% colspan=3><font face=verdana size=2 color=blue>Funzionalità</font></th>';
	echo '</tr>';

	if ($act == 'new') {
		echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=subname value=dettaglipolizza><input type=hidden name=name value=parametri><input type=hidden name=pag value=' . $pag . '><input type=hidden name=act value=savnew>';
		echo '<tr>';
		echo "<td valign=middle align=center><font face=verdana size=2><center>[]</center></td>";
		echo "<td valign=middle align=center><select name=field1><option value=''></option>";
		$sql_tipologia = "SELECT * FROM nuke_tipologiepolizze";
		$rs_tipologia = $db->sql_query($sql_tipologia);
		while ($tipologia = $db->sql_fetchrow($rs_tipologia))
		{
			echo "<option value='".$tipologia[id]."'>".$tipologia[field2]."</option>";
		}
		echo "</select></td>";
		echo "<td valign=middle align=center><input type=text name=field2 size=13></td>";
		echo "<td valign=middle align=center><input type=text name=field3 size=13></td>";
		echo "<td valign=middle align=center><input type=text name=field4 size=13></td>";
		echo "<td valign=middle align=center><input type=text name=field5 size=13></td>";
		echo "<td valign=middle align=center></td>";
		echo "<td valign=middle align=center></td>";
		echo "<td valign=middle align=center></td>";
		echo "<td colspan=3 valign=middle align=center></td>";
		echo "</tr><tr>";
		echo "<td colspan=4 valign=middle align=center><textarea rows=10 cols=50 name=field6></textarea></td>";
		echo "<td colspan=4 valign=middle align=center><textarea rows=10 cols=50 name=field7></textarea></td>";
		echo "<td valign=middle align=center><select name=field8><option SELECTED value=1>1</option><option value=0>0</option></select></td>";
		echo "<td colspan=3 align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
		echo '</tr>';
		echo '</form>';
		$act = '';
	}
	if ($act == 'search') {
		echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=name value=parametri><input type=hidden name=subname value=dettaglipolizza>';
		echo '<input type=hidden name=pag value=' . $pag . '>';
		echo '<input type=hidden name=act value=gosearch>';
		echo '<tr>';
		echo "<td valign=middle align=center></td>";
		echo "<td valign=middle align=center><select name=field1><option value=''></option>";
		$sql_tipologia = "SELECT * FROM nuke_tipologiepolizze";
		$rs_tipologia = $db->sql_query($sql_tipologia);
		while ($tipologia = $db->sql_fetchrow($rs_tipologia))
		{
			echo "<option value='".$tipologia[id]."'>".$tipologia[field2]."</option>";
		}
		echo "</select></td>";
		echo "<td valign=middle align=center><input type=text name=field2 size=13></td>";
		echo "<td valign=middle align=center><input type=text name=field3 size=13></td>";
		echo "<td valign=middle align=center><input type=text name=field4 size=13></td>";
		echo "<td valign=middle align=center><input type=text name=field5 size=13></td>";
		echo "<td valign=middle align=center><input type=text name=field6 size=23></td>";
		echo "<td valign=middle align=center><input type=text name=field7 size=23></td>";
		echo "<td valign=middle align=center><select name=field8><option SELECTED value=1>1</option><option value=0>0</option></select></td>";
		echo "<td colspan=3 align=center valign=middle><input type=submit value=Cerca style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
		echo '</tr>';
		echo '</form>';
		$act = '';
	}

	if ($nr != 0){
		while ($row = $db->sql_fetchrow($rs))
		{
		echo '<tr>';
		if ($act=='mod') {
			if ($id == $row['id'] && $act == 'mod'){
				echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=name value=parametri><input type=hidden name=subname value=dettaglipolizza><input type=hidden name=pag value=' . $pag . '><input type=hidden name=act value=sav><input type=hidden name=id value=' . $id . '>';
				echo "<td valign=middle align=center>" . $row[id] . "</td>";
				echo "<td valign=middle align=center><select name=field1><option value=''></option>";
				$sql_tipologia = "SELECT * FROM nuke_tipologiepolizze";
				$rs_tipologia = $db->sql_query($sql_tipologia);
				while ($tipologia = $db->sql_fetchrow($rs_tipologia))
				{
					if ($tipologia[id]==$row[field1]) $selected=" SELECTED";
					echo "<option".$selected." value='".$tipologia[id]."'>".$tipologia[field2]."</option>";
					$selected="";
				}
				echo "</select></td>";
				echo "<td valign=middle align=center><input type=text name=field2 size=13 value='" . $row[field2] . "'></td>";
				echo "<td valign=middle align=center><input type=text name=field3 size=13 value='" . $row[field3] . "'></td>";
				echo "<td valign=middle align=center><input type=text name=field4 size=13 value='" . $row[field4] . "'></td>";
				echo "<td valign=middle align=center><input type=text name=field5 size=13 value='" . $row[field5] . "'></td>";
				echo "<td valign=middle align=center></td>";
				echo "<td valign=middle align=center></td>";
				echo "<td valign=middle align=center></td>";
				echo "<td colspan=3 valign=middle align=center></td>";
				echo "</tr><tr>";
				echo "<td colspan=4 valign=middle align=center><textarea rows=10 cols=50 name=field6>".$row[field6]."</textarea></td>";
				echo "<td colspan=4 valign=middle align=center><textarea rows=10 cols=50 name=field7>".$row[field7]."</textarea></td>";
				echo "<td valign=middle align=center><select name=field8><option SELECTED value=".$row[field8].">".$row[field8]."</option><option value=1>1</option><option value=0>0</option></select></td>";
				echo "<td colspan=3 align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
				echo '</form>';
			}
		}else{
			echo "<td valign=middle align=center><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=dettaglipolizza&id=" . $row[id] . ">" . $row[id] . "</a></td>";
			echo "<td valign=middle align=center><font face=verdana size=2>";
			$sql_tipologia = "SELECT * FROM nuke_tipologiepolizze";
			$rs_tipologia = $db->sql_query($sql_tipologia);
			while ($tipologia = $db->sql_fetchrow($rs_tipologia))
			{
				if ($tipologia[id]==$row[field1]) echo $tipologia[field2];
			}
			echo "</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[field2] . "</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[field3] . "</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[field4] . "</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[field5] . "</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[field6] . "</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[field7] . "</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>";
			if ($row[field8]=='1') echo "Sì"; if ($row[field8]=='0') echo "No";
			echo "</td>";
			echo "<td align=center valign=middle><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=dettaglipolizza&ord=" . $ord . "&pag=" . $pag . "&act=mod&id=" . $row[id] . "><img border=0 src=immagini/modify.png></a></td>";
			echo "<td align=center valign=middle><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=dettaglipolizza&ord=" . $ord . "&pag=" . $pag . "&act=del&id=" . $row[id] . " " . $confirm . "><img border=0 src=immagini/remove.png></a></td>";
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
	echo '<td width=30% valign=top align=left><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=dettaglipolizza&ord=' . $ord . '&pag=' . $minus . '&login=' . $login . '&utenza=' . $utenza . '>';
	echo 'Pagina Indietro</a></font></td>';
}else {
	echo '<td width=30% valign=top align=left><font face=verdana size=2>Pagina indietro</font></td>';
}
echo '<td width=40% valign=middle align=center><font face=verdana size=1>';
echo 'Pagina ' . $pag . ' di ' . $all_pages;
echo ' ( ';
for($k = 1; $k < $all_pages+1; $k++){
	echo '<a href=gestionale.php?name=parametri&subname=dettaglipolizza&ord=' . $ord . '&pag=' . $k . '&login=' . $login . '&utenza=' . $utenza . '>'.$k.'</a> ';
}
echo ')</font></td>';
if ($all_pages > $pag) {
	$major = $pag + 1;
	echo '<td width=30% valign=top align=right><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=dettaglipolizza&ord=' . $ord . '&pag=' . $major . '&login=' . $login . '&utenza=' . $utenza . '>';
	echo 'Pagina Avanti</a></font></td>';
}else {
	echo '<td width=30% valign=top align=right><font face=verdana size=2>Pagina avanti</font></td>';
}
echo '</tr></table>';
echo '</p>';
CloseTable();
CloseTable();
*/

?>