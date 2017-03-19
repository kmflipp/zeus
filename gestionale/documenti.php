<?php
require_once("mainfile.php");

global $prefix, $db, $admin, $user;
$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';

$azione = $_POST[azione];
$tablename = "nuke_documenti";
$g_BannerPath = "c:/wwwroot/zeus.rvasa.ch/upload/";
$g_BannerPath1 = "c:/wwwroot/zeus.rvasa.ch/";

$iddocumento = $_POST[iddocumento];
$description = $_POST[description];
$type = $_POST[type];
$size = $_POST[size];

$filenametodelete = $_GET[filename];
if (!$id) $id = $_GET[id];
if (!$iddocumento) $iddocumento = $_GET[iddocumento];
if (!$azione) $azione = $_GET[azione];

OpenTable();
		echo '<p>';
		echo '<input type=button value="Nuovo Record" onclick="location.href=' . chr(39) . 'gestionale.php?azione=nuovo&act=explode&name=clienti&id='.$id . '#documenti' . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
		echo '</p>';

			if ($azione=='sav'){
			$sql = "UPDATE " . $tablename . " SET  description='" . $_GET[description] . "' where id = '" . $iddocumento . "'";
			$result = $db->sql_query($sql);
			header("Location: gestionale.php?name=clienti&id=$id&act=explode");
			}
			if ($azione == 'del'){
				$rs_file = $db->sql_query("SELECT * FROM $tablename WHERE id='$_GET[iddocumento]'");
				$row_file = $db->sql_fetchrow($rs_file);
				$filenametodelete = $row_file[filename];
				unlink($g_BannerPath1.$filenametodelete);
				if (!file_exists($g_BannerPath1.$filenametodelete)) {
					$sql = "DELETE FROM $tablename WHERE id=$_GET[iddocumento]";;
					$result = $db->sql_query($sql);
				}else{
					echo "Errore, non è stato possibile eliminare il file ".$filenametodelete.", contattare l'amministratore di sistema.";
				}
			header("Location: gestionale.php?name=clienti&id=$id&act=explode");
			}
			
			if ($azione=='savnew'){
				if ($_FILES["file"]["error"] > 0)
 			  {
    			echo "Non è stato possibile salvare il file ".$_FILES["file"]["name"]. ": ".$_FILES["file"]["error"].". Contattare l'amministratore di sistema.";
   			}
 				else
				{
					$sql = "INSERT INTO " . $tablename . " (filename,idcliente,description,type,size) VALUES ('/upload/" .$_FILES["file"]["name"] . "','" . $id . "','" . $description . "','" . $_FILES["file"]["type"] . "','" . $_FILES["file"]["size"] . "')";
					$result = $db->sql_query($sql);
					move_uploaded_file($_FILES["file"]["tmp_name"],$g_BannerPath.$_FILES["file"]["name"]);
				}
			}
		
			$sql = "SELECT * FROM " . $tablename . " WHERE idcliente='$id' ORDER BY $ord";
			$rs = $db->sql_query($sql);
			$nr = $db->sql_numrows($rs);
			
			echo '<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen>';
			echo '<tr>';
			echo '<th width=25%><font face=verdana size=2>Filename</th>';
			echo '<th width=25%><font face=verdana size=2>Description</th>';
			echo '<th width=10%><font face=verdana size=2>Tipo</th>';
			echo '<th width=10%><font face=verdana size=2>Dimensione</th>';
			echo '<th width=10%><font face=verdana size=2></font></th>';
			echo '</tr>';

			if ($azione == 'nuovo') {
				echo '<form action=gestionale.php method=post enctype="multipart/form-data"><input type=hidden name=azione value=savnew><input type=hidden name=name value=clienti><input type=hidden name=act value=explode>';
				echo "<input type=hidden name=id value=$id>";
				echo '<tr>';
				echo "<td valign=middle align=center><input type=file name=file id=file></td>";
				echo "<td valign=middle align=center><input type=text name=description size=50></td>";
				echo "<td valign=middle align=center>&nbsp;</td>";
				echo "<td valign=middle align=center>&nbsp;</td>";
				echo "<td align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: sol3; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
				echo '</tr>';
				echo '</form>';
				$nr=0;
			}
			if ($nr != 0){
				for($x = 0; $x < $nr; $x++){
					$row = $db->sql_fetchrow($rs);
					echo '<tr>';
					if ($_GET[iddocumento] == $row['id'] && $azione == 'mod'){
						echo '<form action=gestionale.php method=get><input type=hidden name=azione value=sav><input type=hidden name=name value=clienti>';
						echo "<input type=hidden name=act value=explode><input type=hidden name=id value=$_GET[id]><input type=hidden name=iddocumento value=$row[id]>";
						echo '<tr>';
						echo "<td valign=middle align=center><font face=verdana size=2><a href='".$row[filename]."' target=_blank>" . $row[filename] . "</a></td>";
						echo "<td valign=middle align=center><input type=text name=description size=50 value='$row[description]'></td>";
						echo "<td valign=middle align=center>&nbsp;</td>";
						echo "<td valign=middle align=center>&nbsp;</td>";
						echo "<td align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
						echo '</tr>';
						echo '</form>';
					}else{
						echo "<td valign=middle align=center><font face=verdana size=2><a href='".$row[filename]."' target=_blank>" . $row[filename] . "</a></td>";
						echo "<td valign=middle align=center><font face=verdana size=2>" . $row[description] . "</td>";
						echo "<td valign=middle align=center><font face=verdana size=2>" . $row[type] . "</td>";
						echo "<td valign=middle align=center><font face=verdana size=2>" . $row[size] . "</td>";
						echo "<td align=center valign=middle><font face=verdana size=2><a href=gestionale.php?name=clienti&act=explode&azione=mod&iddocumento=$row[id]&id=$id><img border=0 src=immagini/modify.png></a> <a href=gestionale.php?name=clienti&act=explode&azione=del&iddocumento=$row[id]&id=$id $confirm><img border=0 src=immagini/remove.png></a></td>";
						echo '</tr>';
					}
				}
			}
			echo "</table>";
CloseTable();
?>