<div class="offerte" id="offerte" style="position:relative;_position:relative;height:100%;overflow:auto;padding:0px;">
<?php
$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potr� essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$act = $_GET[act];
$id = $_GET[id];
$pag = $_GET['pag'];
$ord = $_GET['ord'];
$tablename = "nuke_bolli";

$field1 = $_GET[field1];
$field2 = $_GET[field2];

OpenTable();
echo '<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen><td>';
echo "<input type=button value='Exit' onclick=location.href='gestionale.php?name=parametri' style=font-family: Verdana; font-size: 10px;>";
echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
echo '<input type=button value="New" onclick="location.href=' . chr(39) . 'gestionale.php?name=parametri&subname=bolli&act=new&ord=' . $ord . '&pag='. $pag . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
echo '<input type=button value="Show all records" onclick="location.href=' . chr(39) . 'gestionale.php?name=parametri&subname=bolli' . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo "</td></table>";
CloseTable();

OpenTable();
	if ($act=='sav'){
	$sql = "UPDATE " . $tablename . " SET  field1='" . $_GET[field1] . "' , field2='" . $_GET[field2] . "' , idtipopolizza='" . $_GET[idtipopolizza] . "' where id = '" . $id . "'";
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
		$sql = "INSERT INTO " . $tablename . " (field1,field2,idtipopolizza) VALUES ('" . $_GET[field1] . "','" . $_GET[field2] . "','" . $_GET[idtipopolizza] . "')";
		$result = $db->sql_query($sql);
		$id = '';
		$act = '';
	}
	
	$sql = "SELECT * FROM ".$tablename;
	$rs = $db->sql_query($sql);
	$nr = $db->sql_numrows($rs);

	echo '<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen>';
	echo '<tr>';
	echo '<th width=35%><font face=verdana size=2>State</a></th>';
	echo '<th width=35%><font face=verdana size=2>Stamp Dutie</a></th>';
	echo '<th width=20%><font face=verdana size=2 color=blue>Policy Type</font></th>';
	echo '<th width=10%><font face=verdana size=2 color=blue>Operation</font></th>';
	echo '</tr>';

	if ($act == 'new') {
		echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=subname value=bolli><input type=hidden name=name value=parametri><input type=hidden name=pag value=' . $pag . '><input type=hidden name=act value=savnew>';
		echo '<tr>';
		echo "<td valign=middle align=center><input type=text name=field1 size=40></td>";
		echo "<td valign=middle align=center><input type=text name=field2 size=40></td>";
		echo "<td valign=middle align=center><select name=idtipopolizza>";
		$sql="SELECT * FROM NUKE_TIPOLOGIEPOLIZZE";
		$rs_tip = $db->sql_query($sql);
		while ($row_tip = $db->sql_fetchrow($rs_tip)) {
			echo "<option value='$row_tip[id]'>$row_tip[field2]</option>";
		}
		echo "</select>";
		echo "</td>";
		echo "<td align=center valign=middle><input type=submit value=Save style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
		echo '</tr>';
		echo '</form>';
		$act = '';
	}

	if ($nr != 0){
		while ($row = $db->sql_fetchrow($rs)) {
			if ($id == $row['id'] && $act == 'mod'){
				echo '<tr>';
				echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=name value=parametri><input type=hidden name=subname value=bolli><input type=hidden name=pag value=' . $pag . '><input type=hidden name=act value=sav><input type=hidden name=id value=' . $id . '>';
				echo "<td valign=middle align=center><input type=text name=field1 size=40 value='" . $row[field1] . "'></td>";
				echo "<td valign=middle align=center><input type=text name=field2 size=40 value='" . $row[field2] . "'></td>";
				echo "<td valign=middle align=center><select name=idtipopolizza>";
				$sql="SELECT * FROM NUKE_TIPOLOGIEPOLIZZE";
				$rs_tip = $db->sql_query($sql);
				while ($row_tip = $db->sql_fetchrow($rs_tip)) {
					if($row[idtipopolizza]==$row_tip[id]) $selected = ' selected ';
					echo "<option $selected value='$row_tip[id]'>$row_tip[field2]</option>";
					$selected = ' ';
				}
				echo "</select>";
				echo "</td>";
				echo "<td align=center valign=middle><input type=submit value=Save style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
				echo '</form>';
				echo '</tr>';
			}
			echo '<tr>';
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[field1] . "</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[field2] . "</td>";
			echo "<td valign=middle align=center>";
			$sql="SELECT * FROM NUKE_TIPOLOGIEPOLIZZE where id='$row[idtipopolizza]'";
			$rs_tip = $db->sql_query($sql);
			$row_tip = $db->sql_fetchrow($rs_tip);
			echo $row_tip[field2];
			echo "</td>";
			echo "<td colspan=2 align=center><input type=button value=MOD onClick=window.location='gestionale.php?name=parametri&subname=bolli&act=mod&id=$row[id]&scrolltop='+document.getElementById('offerte').scrollTop;>&nbsp;";
						?>
						<input type=button value=DEL onClick="if(confirm('Warning: you cannot be able to undo this action. Are you sure to continue?')) window.location='gestionale.php?name=parametri&subname=bolli&act=del&id=<?php echo $row[id]; ?>&scrolltop='+document.getElementById('offerte').scrollTop;">
						<?php
			echo '</td></tr>';
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
