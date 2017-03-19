<div class="offerte" id="offerte" style="position:relative;_position:relative;height:100%;overflow:auto;padding:0px;">
<?php
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

	OpenTable();
	echo '<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen><td>';
	echo "<input type=button value='Exit' onclick=location.href='gestionale.php?name=parametri' style=font-family: Verdana; font-size: 10px;>";
	echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
	echo "<input type=button value='Manage Policy Type' onclick=location.href='gestionale.php?name=parametri&subname=tipologie' style=font-family: Verdana; font-size: 10px;>";
	echo "</td></table>";
	CloseTable();

	if ($act=='savecategorie'){
		$_GET[categoria] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[categoria])))))));
		$_GET[category] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[category])))))));
		//$_GET[categoria] = nl2br(htmlentities($_GET[categoria], ENT_QUOTES, 'UTF-8'));
		//$_GET[category] = nl2br(htmlentities($_GET[category], ENT_QUOTES, 'UTF-8'));
		$sql = "INSERT INTO nuke_categorie (categoria,category,idpolizza,ordine) VALUES ('$_GET[categoria]','$_GET[category]','$_GET[idpolizza]','$_GET[ordine]')";
		$result = $db->sql_query($sql);
		$act = '';
		header("Location: gestionale.php?name=parametri&subname=entita&scrolltop=$_GET[scrolltop]&tipopolizza=$_GET[tipopolizza]");
	}
	if ($act=='updatecategorie'){
		$_GET[categoria] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[categoria])))))));
		$_GET[category] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[category])))))));
		//$_GET[categoria] = nl2br(htmlentities($_GET[categoria], ENT_QUOTES, 'UTF-8'));
		//$_GET[category] = nl2br(htmlentities($_GET[category], ENT_QUOTES, 'UTF-8'));
		$sql = "UPDATE nuke_categorie SET categoria='$_GET[categoria]', category='$_GET[category]', ordine='$_GET[ordine]' WHERE id = '$_GET[idcategoria]'";
		$result = $db->sql_query($sql);
		$act = '';
		header("Location: gestionale.php?name=parametri&subname=entita&scrolltop=$_GET[scrolltop]&tipopolizza=$_GET[tipopolizza]");
	}
	if ($act == 'delcategorie'){
		$sql = "SELECT * FROM NUKE_OFFERTE_DETAIL1 WHERE IDENTITA in (SELECT id FROM nuke_entita WHERE field1 = '$_GET[idcategoria]')";
		$rs = $db->sql_query($sql);
		$nr = $db->sql_numrows($rs);
		//messo per evitare che non faccia cancellare le cose usate
		$nr=0;
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
		header("Location: gestionale.php?name=parametri&subname=entita&scrolltop=$_GET[scrolltop]&tipopolizza=$_GET[tipopolizza]");
	}
	if ($act=='savenewitem'){
		$_GET[field4] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field4])))))));
		$_GET[field5] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field5])))))));
		$_GET[field6] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field6])))))));
		$_GET[field7] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field7])))))));
		//$_GET[field4] = nl2br(htmlentities($_GET[field4], ENT_QUOTES, 'UTF-8'));
		//$_GET[field5] = nl2br(htmlentities($_GET[field5], ENT_QUOTES, 'UTF-8'));
		$sql = "INSERT INTO nuke_entita (field1,field4,field5,field6,field7,field8,ordine) VALUES ('$_GET[idcategoria]','$_GET[field4]','$_GET[field5]','$_GET[field6]','$_GET[field7]','$_GET[field8]','$_GET[ordine]')";
		$result = $db->sql_query($sql);
		$act = '';
		if ($_GET[idofferta]!='') {
			header("Location: gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[idofferta]#sonoqui");
		}
		header("Location: gestionale.php?name=parametri&subname=entita&scrolltop=$_GET[scrolltop]&tipopolizza=$_GET[tipopolizza]");
	}
	if ($act=='saveitem'){
		$_GET[field4] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field4])))))));
		$_GET[field5] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field5])))))));
		$_GET[field6] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field6])))))));
		$_GET[field7] = str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field7])))))));
		//$_GET[field4] = nl2br(htmlentities($_GET[field4], ENT_QUOTES, 'UTF-8'));
		//$_GET[field5] = nl2br(htmlentities($_GET[field5], ENT_QUOTES, 'UTF-8'));
		$sql = "UPDATE nuke_entita SET field4='$_GET[field4]', field5='$_GET[field5]', field6='$_GET[field6]', field7='$_GET[field7]', field8='$_GET[field8]', ordine='$_GET[ordine]' WHERE id = '$_GET[iditem]'";
		$result = $db->sql_query($sql);
		$act = '';
		header("Location: gestionale.php?name=parametri&subname=entita&scrolltop=$_GET[scrolltop]&tipopolizza=$_GET[tipopolizza]");
	}
	if ($act == 'delitem'){
		$sql = "SELECT * FROM nuke_offerte_detail1 WHERE identita = '$_GET[iditem]'";
		$rs = $db->sql_query($sql);
		$nr = $db->sql_numrows($rs);
		//messo per evitare che non faccia cancellare le cose utlizzate
		$nr=0;
		if ($nr==0) {
			$sql = "DELETE FROM nuke_entita WHERE id = '$_GET[iditem]'";
			$result = $db->sql_query($sql);
		}else{
			$msg = "Impossibile eliminare item $_GET[iditem] in quanto sono presenti delle offerte registrate che lo contengono.";
			echo "<script>alert('".$msg."');</script>";
		}
		$act = '';
		header("Location: gestionale.php?name=parametri&subname=entita&scrolltop=$_GET[scrolltop]&tipopolizza=$_GET[tipopolizza]");
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
		echo "<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen>";
		$segno=$piu;
		echo "<td valign=middle align=left width=100%>Policy Type: <strong>$tipopolizze[field2]</strong>&nbsp;&nbsp;::&nbsp;&nbsp;";
		?>
		<input type=button value='on/off' onClick="if(document.getElementById('hide<?php echo $tipopolizze[id]; ?>').style.display=='none'){document.getElementById('hide<?php echo $tipopolizze[id]; ?>').style.display='block';}else{document.getElementById('hide<?php echo $tipopolizze[id]; ?>').style.display='none';}">
		<?php
		echo "</td>";
		echo "</table>";
		echo "<div id='hide$tipopolizze[id]'>";
		$rs_categorie = $db->sql_query("SELECT * FROM nuke_categorie WHERE idpolizza=$tipopolizze[id] order by ordine");
		while ($categorie = $db->sql_fetchrow($rs_categorie))
		{
			OpenTable();
			if ($act=='modcategoria' && $_GET[idcategoria]==$categorie[id]) {
				echo '<div id="into_albero" align=right>';
				echo "<table width=95% border=0 cellspacing=0 cellpadding=0 bordercolor=darkgreen>
								<form action=gestionale.php method=get><input type=hidden name=name value=parametri><input type=hidden name=subname value=entita><input type=hidden name=act value=updatecategorie><input type=hidden name=idcategoria value=".$categorie[id].">
								<input type=hidden name=scrolltop value=".$_GET[scrolltop]."><input type=hidden name=tipopolizza value=".$tipopolizze[id].">
								<td width=80% valign=bottom align=left><strong>".$segno."<input type=text size=3 name=ordine value='".$categorie[ordine]."'><br><textarea cols=140 rows=4 name=categoria>".$categorie[categoria]."</textarea><br><textarea cols=140 rows=4 name=category>".$categorie[category]."</textarea></strong></td>
								<td valign=bottom align=right><input type=submit value=Save style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>
							</table>";
				echo "</div>";
			} else {
				echo '<div id="into_albero" align=right>';
				echo "<table width=95% border=0 cellspacing=0 cellpadding=0 bordercolor=darkgreen>
								<td width=10% valign=bottom align=left style='border-bottom: dotted;border-width: 1px;'><strong>".$segno."&nbsp;$categorie[ordine]</td>
								<td width=70% valign=bottom align=left style='border-bottom: dotted;border-width: 1px;'><strong>".nl2br($categorie[categoria])."<br>".nl2br($categorie[category])."</strong></td>
								<td valign=bottom align=right style='border-bottom: dotted;border-width: 1px;'><a href=# onClick=window.location='gestionale.php?name=parametri&subname=entita&act=modcategoria&idcategoria=$categorie[id]&tipopolizza=$tipopolizze[id]&scrolltop='+document.getElementById('offerte').scrollTop;><img border=0 src=immagini/select.png></a>
								&nbsp;
								<a href=# onClick=window.location='gestionale.php?name=parametri&subname=entita&tipopolizza=$tipopolizze[id]&idcategoria=$categorie[id]&act=delcategorie&scrolltop='+document.getElementById('offerte').scrollTop $confirm;><img border=0 src=immagini/remove.png></a></td>
							</table>";
				echo "</div>";
				$ultimoidcat = $categorie[ordine]+1;
			}
			$rs_nomi = $db->sql_query("SELECT * FROM nuke_entita WHERE field1='$categorie[id]' order by ordine");
			while ($nomi = $db->sql_fetchrow($rs_nomi))
			{
				if ($_GET[iditem]==$nomi[id] && $act=='moditem') {
					echo '<div id="into_albero" align=right>';
					echo "<table width=90% border=0 cellspacing=0 cellpadding=0 bordercolor=darkgreen>
									<form action=gestionale.php method=get><input type=hidden name=name value=parametri><input type=hidden name=subname value=entita><input type=hidden name=act value=saveitem><input type=hidden name=iditem value=$nomi[id]>
									<input type=hidden name=field6 value=".$nomi[field6]."><input type=hidden name=field7 value=".$nomi[field7]."><input type=hidden name=tipopolizza value=".$tipopolizze[id].">
									<input type=hidden name=scrolltop value=".$_GET[scrolltop].">
									<td width=10% align=left valign=bottom>
										<input type=text size=3 name=ordine value='".$nomi[ordine]."'>
									</td>
									<td width=70% align=left valign=bottom>
										<textarea cols=120 rows=3 name=field4>$nomi[field4]</textarea>
										<br>
										<textarea cols=120 rows=3 name=field5>$nomi[field5]</textarea>
										<br>Default:
										<select name=field8><option SELECTED value=1>Yes</option><option value=0>No</option></select>
									</td>
									<td valign=bottom align=right><input type=submit value=Save style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>
									</form>
								</table>";
					echo "</div>";
				}
				else {
					echo '<div id="into_albero" align=right>';
					echo "<table width=90% border=0 cellspacing=0 cellpadding=0 bordercolor=darkgreen>";
								echo "<td valign=bottom width=10% align=left valign=top style='border-bottom: dotted;border-width: 1px;'>$nomi[ordine]</td>";
								echo "<td valign=bottom width=70% align=left style='border-bottom: dotted;border-width: 1px;'>".nl2br($nomi[field4])."<br><i>".nl2br($nomi[field5])."</i></td>";
								echo "<td valign=bottom align=right style='border-bottom: dotted;border-width: 1px;'>
									<a href=# onClick=window.location='gestionale.php?name=parametri&subname=entita&act=moditem&iditem=$nomi[id]&tipopolizza=$tipopolizze[id]&scrolltop='+document.getElementById('offerte').scrollTop;><img border=0 src=immagini/select.png></a>
									&nbsp;
									<a href=# onClick=window.location='gestionale.php?name=parametri&subname=entita&act=delitem&iditem=$nomi[id]&tipopolizza=$tipopolizze[id]&scrolltop='+document.getElementById('offerte').scrollTop; $confirm><img border=0 src=immagini/remove.png></a></td>
								</table>";
					echo "</div>";
					$ultimoid = $nomi[ordine]+1;
				}
			}
			if ($act=='newitem' && $_GET[idcategoria]==$categorie[id]) {
				echo '<div id="into_albero" align=right>';
				echo "<table class=bottomBorder width=90% border=0 cellspacing=0 cellpadding=0 bordercolor=darkgreen>
								<form action=gestionale.php method=get><input type=hidden name=name value=parametri><input type=hidden name=subname value=entita><input type=hidden name=act value=savenewitem>
								<input type=hidden name=idpolizza value=$tipopolizze[id]><input type=hidden name=idcategoria value=$categorie[id]><input type=hidden name=tipopolizza value=".$tipopolizze[id].">
								<input type=hidden name=field6><input type=hidden name=field7><input type=hidden name=idofferta value=$_GET[idofferta]>
								<input type=hidden name=scrolltop value=".$_GET[scrolltop].">
								<td valign=bottom width=10% align=left>
									<input type=text size=3 name=ordine value='$ultimoid'>
								</td>
								<td valign=bottom width=70% align=left>
									<textarea cols=120 rows=3 name=field4></textarea>
									<br>
									<textarea cols=120 rows=3 name=field5></textarea>
									<br>Default:
									<select name=field8><option SELECTED value=1>Yes</option><option value=0>No</option></select>
								</td>
								<td valign=bottom align=right><input type=submit value=Save style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>
								</form>
							</table>";
				echo "</div>";
			}
			echo '<div id="into_albero" align=right>';
			echo "<table width=90% border=0 cellspacing=0 cellpadding=0 bordercolor=darkgreen>
							<td valign=bottom width=80% align=left><a href=# onClick=window.location='gestionale.php?name=parametri&subname=entita&act=newitem&idcategoria=$categorie[id]&idpolizza=$tipopolizze[id]&tipopolizza=$tipopolizze[id]&scrolltop='+document.getElementById('offerte').scrollTop;><b>New Item</b></a></td>
							<td align=right></td>
						</table>";
			echo "<table width=90% border=0 cellspacing=0 cellpadding=0 bordercolor=darkgreen>
							<td valign=bottom width=80% align=left><br></td>
							<td align=right></td>
						</table>";
			echo "</div>";
			CloseTable();
		}
		if ($act=='newcategoria' && $_GET[idpolizza]==$tipopolizze[id]) {
			echo '<div id="into_albero" align=right>';
			echo "<table width=95% border=0 cellspacing=0 cellpadding=0 bordercolor=darkgreen>
							<form action=gestionale.php method=get><input type=hidden name=name value=parametri><input type=hidden name=subname value=entita><input type=hidden name=act value=savecategorie><input type=hidden name=idpolizza value=$tipopolizze[id]>
							<input type=hidden name=scrolltop value=".$_GET[scrolltop]."><input type=hidden name=tipopolizza value=".$tipopolizze[id].">
							<td valign=bottom width=80% align=left><strong>$segno</strong>&nbsp;<input type=text size=3 name=ordine value='$ultimoidcat'><br><textarea cols=140 rows=4 name=categoria></textarea><br><textarea cols=140 rows=4 name=category></textarea></td>
							<td valign=bottom align=right><input type=submit value=Save style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>
						</table>";
			echo "</div>";
		}
		echo '<div id="into_albero" align=right><p>';
		echo "<table width=95% border=0 cellspacing=0 cellpadding=0 bordercolor=darkgreen>
						<td width=80% align=left><a href=# onClick=window.location='gestionale.php?name=parametri&subname=entita&act=newcategoria&idpolizza=$tipopolizze[id]&tipopolizza=$tipopolizze[id]&scrolltop='+document.getElementById('offerte').scrollTop;><b>New Category</b></a></td>
						<td align=right></td>
					</table>";
		echo "</p></div>";
		echo "</div>";
		CloseTable();
		if ($_GET[tipopolizza]!=$tipopolizze[id]) {
			?>
			<script>
			document.getElementById('hide<?php echo $tipopolizze[id]; ?>').style.display='none';
			</script>
			<?php
		}
	}
?>
<script language=JavaScript>
	document.getElementById("offerte").scrollTop=<?php echo $_GET[scrolltop]; ?>;
</script>

<?php
echo "</div>";
?>