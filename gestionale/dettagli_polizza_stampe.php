<script language=JavaScript>
function stampa_cga(valore) {
alert(valore);
	window.location="gestionale.php?name=lloyds&subname=polizze&act=explode&nomefile="+valore+"&idpolizza=<?php echo $_GET[idpolizza]; ?>";
}
function stampa_def(id) {
	window.location='gestionale.php?name=lloyds&subname=polizze&act=explode&nomefile=/template/rva_polizza.htm&idpolizza='+id
}
</script>

<?php

global $prefix, $db, $admin, $user;
$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';

$sql = "SELECT * FROM nuke_polizze_stampe where printed='0' and idpolizza=$_GET[idpolizza]";
$rs = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($rs)) {
	$sql = "UPDATE nuke_polizze_stampe SET printed='1' where filename='$row[filename]' and idpolizza=$_GET[idpolizza]";
	$rs = $db->sql_query($sql);
	echo "<script>window.open('$row[filename]','_blank');</script>";
}
OpenTable();

//stampe cga
$sql = "SELECT * FROM nuke_polizze_detail_cga WHERE idpolizza='$_GET[idpolizza]'";
$rs = $db->sql_query1($sql);
$nr = $db->sql_numrows($rs);
echo '<p align=center><table width=60% border=1 height=100% cellspacing=0 cellpadding=5 bordercolor=darkgreen>';
echo '<tr><td width=35% align=center colspan=2><font face=verdana size=2><strong>Stampe CGA</strong>&nbsp;</td></tr>';
while ($row = $db->sql_fetchrow($rs)) {
	echo '<tr>';
	$row[field2]=str_replace(" ","|",$row[field2]);
		echo "<td width=25% align=right valign=middle><input type=button value='Stampa' onClick=stampa_cga('$row[field2]');></td>";
		echo "<td width=40% valign=middle align=center><font face=calibri size=2>$row[field1]</font></td>";
	echo "</tr>";
}
echo "</table></p>";


//stampe contratto completo
$color='black';
$sql = "select * from nuke_polizze where idpolizza='$_GET[idpolizza]'";
$rs = $db->sql_query1($sql);
$row = $db->sql_fetchrow($rs);
echo "<p align=center><table width=80% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen>";
echo "<tr><td width=35% align=center colspan=2><font face=verdana size=2><strong>Stampa certificato di assicurazione (contratto completo)</strong></td></tr>";
$sqll = "SELECT * FROM nuke_polizze_stampe where filename='/template/rva_polizza.htm' and idpolizza=$_GET[idpolizza] and printed='1'";
$rsl = $db->sql_query($sqll);
$nrl = $db->sql_numrows($rsl);
if ($nrl!=0) $color='green';
echo "<td width=25% align=right valign=middle><input type=button value='Stampa' onclick=stampa_def($_GET[idpolizza]);></td>";
echo "<td width=40% valign=middle align=center><font face=calibri size=2>Polizza n. $row[numeropolizza]</font></td>";
echo "</tr>";
echo "</table></p>";

//stampe certificato
$color='black';
$sql = "select * from nuke_polizze where idpolizza='$_GET[idpolizza]'";
$rs = $db->sql_query1($sql);
$row = $db->sql_fetchrow($rs);
echo "<p align=center><table width=80% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen>";
echo "<tr><td width=35% align=center colspan=2><font face=verdana size=2><strong>Stampa certificato di assicurazione</strong></td></tr>";
$sqll = "SELECT * FROM nuke_polizze_stampe where filename='/template/rva_polizza.htm' and idpolizza=$_GET[idpolizza] and printed='1'";
$rsl = $db->sql_query($sqll);
$nrl = $db->sql_numrows($rsl);
if ($nrl!=0) $color='green';
echo "<td width=25% align=right valign=middle><input type=button value='Stampa' onclick=stampa_def($_GET[idpolizza]);></td>";
echo "<td width=40% valign=middle align=center><font face=calibri size=2>Polizza n. $row[numeropolizza]</font></td>";
echo "</tr>";
echo "</table></p>";

CloseTable();

?>