<div class="offerte" id="offerte" style="position:relative;_position:relative;height:100%;overflow:auto;padding:0px;">
<?php
$act = $_GET[act];
$id = $_GET[id];
$ord = $_GET['ord'];
if ($ord=='') $ord='field4';
$tablename = "nuke_coperture";

$field1 = $_GET[field1];
$field2 = $_GET[field2];
$field3 = $_GET[field3];
$field4 = $_GET[field4];

OpenTable();
echo '<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen><td>';
echo "<input type=button value='Exit' onclick=location.href='gestionale.php?name=parametri' style=font-family: Verdana; font-size: 10px;>";
echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
echo '<input type=button value="New" onclick="location.href=' . chr(39) . 'gestionale.php?name=parametri&subname=coperture&act=new&ord=' . $ord . '&pag='. $pag . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
echo '<input type=button value="Show all records" onclick="location.href=' . chr(39) . 'gestionale.php?name=parametri&subname=coperture' . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo "</td></table>";
CloseTable();

OpenTable();

	if ($act=='sav'){
	$sql = "UPDATE " . $tablename . " SET  field1='" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field1]))))))) . "' , field2='" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field2]))))))) . "', field3='" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field3]))))))) . "' , field4='" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field4]))))))) . "' where id = '" . $id . "'";
		$result = $db->sql_query($sql);
		$id = '';
		$act = '';
	}
	if ($act == 'del'){
		$sql = "DELETE FROM " . $tablename . " WHERE ID = " . $id;
		$result = $db->sql_query($sql);
		$id = '';
		$act = '';
	}
	if ($act=='savnew'){
		$sql = "INSERT INTO " . $tablename . " (field3,field4,field1,field2) VALUES ('" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field3]))))))) . "','" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field4]))))))) . "','" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field1]))))))) . "','" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[field2]))))))) . "')";
		$result = $db->sql_query($sql);
		$id = '';
		$act = '';
	}
	
	$sql = "SELECT * FROM ".$tablename." ORDER BY field3,field1";
	$rs = $db->sql_query($sql);
	$nr = $db->sql_numrows($rs);

	echo '<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen>';
	echo '<tr>';
	echo '<th width=1%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=coperture&ord=id>id</a></th>';
	echo '<th width=30%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=coperture&ord=field1>Description -it-</a></th>';
	echo '<th width=30%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=coperture&ord=field2>Description -en-</a></th>';
	echo '<th width=30%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=coperture&ord=field3>Category</a></th>';
	echo '<th width=9%><font face=verdana size=2 color=blue>Operation</font></th>';
	echo '</tr>';

	if ($act == 'new') {
		echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=subname value=coperture><input type=hidden name=name value=parametri><input type=hidden name=pag value=' . $pag . '><input type=hidden name=act value=savnew>';
		echo '<tr>';
		echo "<td valign=middle align=center><font face=verdana size=2><center>[]</center></td>";
		echo "<td valign=middle align=center><input type=text name=field1 size=60></td>";
		echo "<td valign=middle align=center><input type=text name=field2 size=60></td>";
		echo "<td valign=middle align=center><input type=text name=field3 size=20></td>";
		echo "<td align=center valign=middle><input type=submit value=Save style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
		echo '</tr>';
		echo '</form>';
		$act = '';
	}

	if ($nr != 0){
		while ($row = $db->sql_fetchrow($rs)) {
			if ($id == $row['id'] && $act == 'mod'){
				echo '<tr>';
				echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=name value=parametri><input type=hidden name=subname value=coperture><input type=hidden name=act value=sav><input type=hidden name=id value=' . $id . '>';
				echo "<td valign=middle align=center>" . $row[id] . "</td>";
				echo "<td valign=middle align=center><input type=text name=field1 size=60 value='$row[field1]'></td>";
				echo "<td valign=middle align=center><input type=text name=field2 size=60 value='$row[field2]'></td>";
				echo "<td valign=middle align=center><input type=text name=field3 size=20 value='" . $row[field3] . "'></td>";
				echo "<td align=center valign=middle><input type=submit value=Save style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
				echo '</form>';
				echo '</tr>';
			}
			echo '<tr>';
			echo "<td valign=middle align=center><font face=verdana><a href=gestionale.php?name=parametri&subname=coperture&id=" . $row[id] . ">" . $row[id] . "</a></td>";
			echo "<td valign=middle align=left><font face=verdana style=font-size:14px;>$row[field1]</td>";
			echo "<td valign=middle align=left><font face=verdana style=font-size:14px;>$row[field2]</td>";
			echo "<td valign=middle align=center><font face=verdana style=font-size:14px;>$row[field3]</td>";
			echo "<td align=center valign=middle><font face=verdana style=font-size:14px;><input type=button value='MOD' onClick=location.href='gestionale.php?name=parametri&subname=coperture&ord=$ord&act=mod&id=$row[id]'>&nbsp;<input type=button value='DEL' onClick=\"if(confirm('Warning: You will not be able to undo this action. Are you sure to continue?'))location.href='gestionale.php?name=parametri&subname=coperture&ord=$ord&act=del&id=$row[id]'\"></td>";
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
