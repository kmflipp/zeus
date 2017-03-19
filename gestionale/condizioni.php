<div class="offerte" id="offerte" style="position:relative;_position:relative;height:100%;overflow:auto;padding:0px;">
<?php
$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$act = $_GET[act];
$id = $_GET[id];
$ord = $_GET['ord'];
if ($ord=='') $ord='field0, convert(int, sort)';
$tablename = "nuke_condizioni";

$field0 = $_GET[field0];
$field1 = $_GET[field1];
$field2 = $_GET[field2];
$field3 = $_GET[field3];
$sort = $_GET['sort'];

OpenTable();
echo '<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen><td>';
echo "<input type=button value='Exit' onclick=location.href='gestionale.php?name=parametri' style=font-family: Verdana; font-size: 10px;>";
echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
echo '<input type=button value="New" onclick="location.href=' . chr(39) . 'gestionale.php?name=parametri&subname=condizioni&act=new&ord=' . $ord . '&pag='. $pag . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
echo '<input type=button value="Show all records" onclick="location.href=' . chr(39) . 'gestionale.php?name=parametri&subname=condizioni' . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo "</td></table>";
CloseTable();

OpenTable();

	if ($act=='sav'){
	$sql = "UPDATE " . $tablename . " SET  sort='$_GET[sort]', field3='$_GET[field3]', field0='$_GET[field0]', field1='" . str_replace("&#10;","<br>",str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field1])))))))) . "' , field2='" . str_replace("&#10;","<br>",str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field2])))))))) . "' where id = '" . $id . "'";
		$result = $db->sql_query($sql);
		$act = '';
		header("Location: gestionale.php?name=parametri&subname=condizioni&scrolltop=$_GET[scrolltop]");
	}
	if ($act == 'del'){
		$sql = "DELETE FROM " . $tablename . " WHERE ID = " . $id;
		$result = $db->sql_query($sql);
		$id = '';
		$act = '';
		header("Location: gestionale.php?name=parametri&subname=condizioni&scrolltop=$_GET[scrolltop]");
	}
	if ($act=='savnew'){
		$sql = "INSERT INTO " . $tablename . " (sort,field3,field0,field1,field2) VALUES ('$_GET[sort]','$_GET[field3]','$_GET[field0]','" . str_replace("&#10;","<br>",str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field1])))))))) . "','" . str_replace("&#10;","<br>",str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field2])))))))) . "')";
		$result = $db->sql_query($sql);
		$act = '';
	}
	
	$condizioni = " id LIKE '%' ";
	
	if ($act=='gosearch') {
		if ($field1 == '') $field1 = '%';
		if ($field2 == '') $field2 = '%';
		if ($field3 == '') $field3 = '%';
		if ($sort == '') $sort = '%';
		$condizioni .= " AND field1 LIKE '$field1' AND field2 LIKE '$field2'  AND field3 LIKE '$field3'  AND sort LIKE '$sort'";
	}
	
	$sql = "SELECT * FROM ".$tablename." WHERE $condizioni ORDER BY $ord";
	$rs = $db->sql_query($sql);
	$nr = $db->sql_numrows($rs);

	echo '<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen>';
	echo '<tr>';
	echo '<th width=15%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=condizioni&ord=field0>Plicy Type</a></th>';
	echo '<th width=3%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=condizioni&ord=sort>Sort</a></th>';
	echo '<th width=12%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=condizioni&ord=field3>Paragraph</a></th>';
	echo '<th width=40%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=condizioni&ord=field1>Description -it-</a></th>';
	echo '<th width=40%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=condizioni&ord=field2>Description -en-</a></th>';
	echo '<th width=5%><font face=verdana size=2 color=blue>Operation</font></th>';
	echo '</tr>';

	if ($act == 'new') {
		echo '<form action=gestionale.php method=get><input type=hidden name=subname value=condizioni><input type=hidden name=name value=parametri><input type=hidden name=act value=savnew>';
		echo '<tr>';
		echo "<td valign=middle align=center><select name=field0><option value=''></option>";
		$sql_tipologia = "SELECT * FROM nuke_tipologiepolizze";
		$rs_tipologia = $db->sql_query($sql_tipologia);
		while ($tipologia = $db->sql_fetchrow($rs_tipologia))
		{
			echo "<option value='".$tipologia[id]."'>".$tipologia[field2]."</option>";
		}
		echo "</select></td>";
		echo "<td valign=middle align=center><input type=text size=4 name=sort></td>";
		echo "<td valign=middle align=center><select name=field3><option value=''></option>";
		echo "<option value='CONDIZIONI/Conditions'>CONDITIONS</option>";
		echo "<option value='INTERESSI/Interests'>INTERESTS</option>";
		echo "<option value='CLAUSOLA VALUTA/Currency Clause'>CURRENCY CLAUSE</option>";
		echo "<option value='CLAUSOLA MAGGIOR VALORE/Grater Value Clause'>GRATER VALUE</option>";
		echo "<option value='RESPONSABILITA/Several liability'>LIABILITY</option>";
		echo "<option value='GIURISTIZIONE & LEGGE APPLICATA/Jurisdiction & applicable law'>GIURISDIZIONE</option>";
		echo "<option value='ASSICURATORI/Insures'>INSURES</option>";
		echo "<option value='INFORMAZIONI/Information'>INFORMATION</option>";
		echo "<option value='TRADUZIONE/Traslation'>TRASLATION</option>";
		echo "<option value='NOME E INDIRIZZO DELLA SOCIETA ALLA QUALE L ASSICURATO DOVRA INDIRIZZARE TUTTI I SINISTRI E LE ALTRE COMUNICAZIONI/Name and address to whom insured should direct all claims and other anquiries'>WHOM_DIRECT_COMM</option>";
		echo "</select></td>";
		echo "<td valign=middle align=center><textarea cols=50 rows=5 name=field1></textarea></td>";
		echo "<td valign=middle align=center><textarea cols=50 rows=5 name=field2></textarea></td>";
		echo "<td align=center valign=middle><input type=submit value=Save style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
		echo '</tr>';
		echo '</form>';
		$act = '';
	}
	if ($nr != 0){
		while ($row = $db->sql_fetchrow($rs)) {
			if ($id == $row['id'] && $act == 'mod') {
				echo '<tr>';
					echo "<form action=gestionale.php method=get><input type=hidden name=scrolltop value='$_GET[scrolltop]'><input type=hidden name=name value=parametri><input type=hidden name=subname value=condizioni><input type=hidden name=act value=sav><input type=hidden name=id value='$id'>";
					echo "<td valign=middle align=center><select name=field0 style=width:100px><option value=''></option>";
					$sql_tipologia = "SELECT * FROM nuke_tipologiepolizze";
					$rs_tipologia = $db->sql_query($sql_tipologia);
					while ($tipologia = $db->sql_fetchrow($rs_tipologia))
					{
						if ($tipologia[id]==$row[field0]) $selected=' selected ';
						echo "<option $selected value='".$tipologia[id]."'>".$tipologia[field2]."</option>";
						$selected=' ';
					}
					echo "</select></td>";
					echo "<td valign=middle align=center><input type=text name=sort size=2 value='$row[sort]' id=sort></td>";
					echo "<td valign=middle align=center><select name=field3><option value=''></option>";
					if ($row[field3]=='CONDIZIONI/Conditions') $selected=' selected ';
					echo "<option $selected value='CONDIZIONI/Conditions'>CONDITIONS</option>";
					$selected='';
					if ($row[field3]=='INTERESSI/Interests') $selected=' selected ';
					echo "<option $selected value='INTERESSI/Interests'>INTERESTS</option>";
					$selected='';
					if ($row[field3]=='CLAUSOLA VALUTA/Currency Clause') $selected=' selected ';
					echo "<option $selected value='CLAUSOLA VALUTA/Currency Clause'>CURRENCY CLAUSE</option>";
					$selected='';
					if ($row[field3]=='CLAUSOLA MAGGIOR VALORE/Grater Value Clause') $selected=' selected ';
					echo "<option $selected value='CLAUSOLA MAGGIOR VALORE/Grater Value Clause'>GRATER VALUE</option>";
					$selected='';
					if ($row[field3]=="RESPONSABILITA/Several liability") $selected=' selected ';
					echo "<option $selected value='RESPONSABILITA&lsquo;/Several liability'>LIABILITY</option>";
					$selected='';
					if ($row[field3]=='GIURISTIZIONE & LEGGE APPLICATA/Jurisdiction & applicable law') $selected=' selected ';
					echo "<option $selected value='GIURISTIZIONE & LEGGE APPLICATA/Jurisdiction & applicable law'>GIURISDIZIONE</option>";
					$selected='';
					if ($row[field3]=='ASSICURATORI/Insures') $selected=' selected ';
					echo "<option $selected value='ASSICURATORI/Insures'>INSURES</option>";
					$selected='';
					if ($row[field3]=='INFORMAZIONI/Information') $selected=' selected ';
					echo "<option $selected value='INFORMAZIONI/Information'>INFORMATION</option>";
					$selected='';
					if ($row[field3]=='TRADUZIONE/Traslation') $selected=' selected ';
					echo "<option $selected value='TRADUZIONE/Traslation'>TRASLATION</option>";
					$selected='';
					if ($row[field3]=='NOME E INDIRIZZO DELLA SOCIETA ALLA QUALE L ASSICURATO DOVRA INDIRIZZARE TUTTI I SINISTRI E LE ALTRE COMUNICAZIONI/Name and address to whom insured should direct all claims and other anquiries') $selected=' selected ';
					echo "<option $selected value='NOME E INDIRIZZO DELLA SOCIETA ALLA QUALE L&lsquo;ASSICURATO DOVRA&lsquo; INDIRIZZARE TUTTI I SINISTRI E LE ALTRE COMUNICAZIONI/Name and address to whom insured should direct all claims and other anquiries'>WHOM_DIRECT_COMM</option>";
					$selected='';
					echo "</select></td>";
					echo "<td valign=middle align=center><textarea cols=50 rows=4 name=field1>" . str_replace("<br>","&#10;",$row[field1]) . "</textarea></td>";
					echo "<td valign=middle align=center><textarea cols=50 rows=4 name=field2>" . str_replace("<br>","&#10;",$row[field2]) . "</textarea></td>";
					echo "<td align=center valign=middle><input type=submit value=Save style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
					echo '</form>';
				echo '</tr>';
			}
			echo '<tr>';
				echo "<td valign=middle align=center>($row[id]) ";
				$sql_tipologia = "SELECT * FROM nuke_tipologiepolizze where id='$row[field0]'";
				$rs_tipologia = $db->sql_query($sql_tipologia);
				$tipologia = $db->sql_fetchrow($rs_tipologia);
				echo $tipologia[field2];
				echo "</td>";
				echo "<td valign=middle align=center>$row[sort]</td>";
				echo "<td valign=middle align=center>$row[field3]</td>";
				echo "<td valign=middle align=center><font face=verdana size=2><textarea disabled cols=50 rows=4 name=field1>" . str_replace("<br>","&#10;",$row[field1]) . "</textarea></td>";
				echo "<td valign=middle align=center><font face=verdana size=2><textarea disabled cols=50 rows=4 name=field2>" . str_replace("<br>","&#10;",$row[field2]) . "</textarea></td>";
				echo "<td align=center valign=middle><font face=verdana size=2><input type=button name=mod value='MOD' onClick=location.href='gestionale.php?name=parametri&subname=condizioni&act=mod&id=$row[id]&scrolltop='+document.getElementById('offerte').scrollTop;><input type=button name=del value='DEL' onClick=location.href='gestionale.php?name=parametri&subname=condizioni&act=del&id=$row[id]&scrolltop='+document.getElementById('offerte').scrollTop;></td>";
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
