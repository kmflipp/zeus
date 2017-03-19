<script language=JavaScript>
function button(x,id) {
	window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&view=editavanzato&azioni=aggiorna&idldr='+id+'&id=<?php echo $_GET[id]; ?>&detail='+document.getElementById(x).value+'&value1='+document.getElementById(x+1).value+'&value5='+document.getElementById(x+2).value+'&value2='+document.getElementById(x+3).value+'&value3='+document.getElementById(x+4).value+'&value4='+document.getElementById(x+5).value+'&scrolltop='+document.getElementById('offerte').scrollTop;
}
</script>

<?php
$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$azioni = $_GET[azioni];
$idofferta = $_GET[id];
$idldr = $_GET[idldr];
$detail = $_GET[detail];
$value = $_GET[value];
if ($blocca==1) $disabled = " disabled ";

if ($blocca==0 && $azioni!='') {
	if ($azioni == 'nuovo'){
		$sql = "INSERT INTO nuke_offerte_ldr (idofferta) VALUES ($idofferta)";
		$db->sql_query($sql);
	}
	if ($azioni == 'del'){
		$sql = "DELETE FROM nuke_offerte_ldr WHERE id=$idldr";
		$db->sql_query($sql);
	}
	if ($azioni == 'aggiorna'){
		$_GET[detail]=str_replace("'","&lsquo;",$_GET[detail]);
		$_GET[value1]=str_replace("'","&lsquo;",$_GET[value1]);
		$_GET[value2]=str_replace("'","&lsquo;",$_GET[value2]);
		$_GET[value3]=str_replace("'","&lsquo;",$_GET[value3]);
		$_GET[value4]=str_replace("'","&lsquo;",$_GET[value4]);
		$_GET[value5]=str_replace("'","&lsquo;",$_GET[value5]);
		$sql = "UPDATE nuke_offerte_ldr set detail='$_GET[detail]', value1='$_GET[value1]', value2='$_GET[value2]', value3='$_GET[value3]', value4='$_GET[value4]', value5='$_GET[value5]' WHERE id=$idldr";
		$db->sql_query($sql);
	}
	if ($azioni == 'active_yes'){
		$sql = "UPDATE nuke_offerte_ldr set active='1' WHERE id=$idldr";
		$db->sql_query($sql);
	}
	if ($azioni == 'active_no'){
		$sql = "UPDATE nuke_offerte_ldr set active='0' WHERE id=$idldr";
		$db->sql_query($sql);
	}
	if ($azioni == 'sped_yes'){
		$sql = "UPDATE nuke_offerte_ldr set spedizione='0' WHERE idofferta=$id";
		$db->sql_query($sql);
		$sql = "UPDATE nuke_offerte_ldr set spedizione='1' WHERE id=$idldr";
		$db->sql_query($sql);
	}
	if ($azioni == 'sped_no'){
		$sql = "UPDATE nuke_offerte_ldr set spedizione='0' WHERE id=$idldr";
		$db->sql_query($sql);
	}
	header("Location: gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&view=editavanzato&scrolltop=$_GET[scrolltop]");
}

OpenTable();
$sql = "SELECT * FROM nuke_offerte_ldr WHERE idofferta=$id order by id";
$rs = $db->sql_query($sql);
$nr = $db->sql_numrows($rs);
echo "<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen>";
echo "<tr>";
echo "<td align=center><font face=calibri size=1>&nbsp;</td>";
echo "<td align=center><font face=calibri size=1>Risk</td>";
echo "<td align=center><font face=calibri size=1>Shipping</td>";
echo "<td align=center><font face=calibri size=1>&nbsp;</td>";
echo "</tr>";
$x=0;
while ($row1 = $db->sql_fetchrow($rs))
{
	$been='0';
	$disabled=' ';
	$disabled1=' ';
	$check=' ';
	$check1=' ';
	if ($row1[value]==$corrispondenza) $been='1';
	if ($row1[value]==$rischio2) $been='1';
	if ($row1[value]==$rischio3) $been='1';
	if ($row1[value]==$rischio4) $been='1';
	if ($nr==3) $disabled1=' disabled ';
	if ($blocca==1) $disabled=' disabled ';
	$active = $row1[active];
	$sped = $row1[spedizione];
	if (trim($active)=='1') $check=' checked ';
	if (trim($sped)=='1') $check1=' checked ';
	echo '<tr>';
		echo "<td align=left valign=middle>";
			$x++;
			echo "<font face=calibri size=2><strong>Label</strong>: <input name=detail $disabled type=text size=40 id=$x tabindex=$x value='$row1[detail]'><br>";
			$x++;
			echo "<font face=calibri size=2><strong>Address&nbsp;</strong>: <input name=value1 $disabled type=text size=40 id=$x tabindex=$x value='$row1[value1]'><br>";
			$x++;
			echo "<font face=calibri size=2><strong>Address&nbsp;</strong>: <input name=value5 $disabled type=text size=40 id=$x tabindex=$x value='$row1[value5]'><br>";
			$x++;
			echo "<font face=calibri size=2><strong>NPA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>: <input name=value2 $disabled type=text size=30 id=$x tabindex=$x value='$row1[value2]'><br>";
			$x++;
			echo "<font face=calibri size=2><strong>City&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>: <input name=value3 $disabled type=text size=20 id=$x tabindex=$x value='$row1[value3]'><br>";
			$x++;
			echo "<font face=calibri size=2><strong>State&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>: <input name=value4 $disabled type=text size=15 id=$x tabindex=$x value='$row1[value4]'>";
			$xx = $x-5;
			echo "&nbsp;<input type=button value=Update onClick=button($xx,'$row1[id]');>";
		echo "</td>";
		echo "<td align=center valign=middle>";
			$x++;
			echo "<input id=$x tabindex=$id $check type=checkbox onClick=if(this.checked){window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&azioni=active_yes&idldr=$row1[id]&id=$id&scrolltop='+document.getElementById('offerte').scrollTop;}else{window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&view=editavanzato&azioni=active_no&idldr=$row1[id]&id=$id&scrolltop='+document.getElementById('offerte').scrollTop;} >";
		echo "</td>";
		echo "<td align=center valign=middle>";
			$x++;
			echo "<input id=$x tabindex=$id $check1 type=checkbox onClick=if(this.checked){window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&azioni=sped_yes&idldr=$row1[id]&id=$id&scrolltop='+document.getElementById('offerte').scrollTop;}else{window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&view=editavanzato&azioni=sped_no&idldr=$row1[id]&id=$id&scrolltop='+document.getElementById('offerte').scrollTop;} >";
		echo "</td>";
		echo "<td align=center valign=middle>";
			$x++;
			echo "<input id=$x tabindex=$id type=button value=Del onClick=window.location='gestionale.php?name=lloyds&subname=offerte&view=editavanzato&act=explode&azioni=del&idldr=$row1[id]&id=$id&scrolltop='+document.getElementById('offerte').scrollTop;>";
		echo "</td>";
	echo '</tr>';
}
echo "<tr>";
	echo "<td align=left>";
	echo "<font face=calibri size=3><strong>Additional address</strong></font>";
	echo "</td>";
	echo "<td align=center colspan=3>";
	$x++;
	echo "<input id=$x tabindex=$id $disabled1 type=checkbox onclick=location.href='gestionale.php?name=lloyds&subname=offerte&act=explode&azioni=nuovo&view=editavanzato&id=$id&scrolltop='+document.getElementById('offerte').scrollTop;>";
	echo "</td>";
echo "</tr>";

echo '</table>';
CloseTable();

?>
