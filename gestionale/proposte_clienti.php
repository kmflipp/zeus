<?php
$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$idcliente = $_GET[idcliente];

OpenTable();
echo "<p><font face=calibri size=2>Legend<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style=background-color:lightgreen; color=black>GREEN</font> blocked & printed offer (converted in polocy)&nbsp;&nbsp;::&nbsp;&nbsp;<font style=background-color:pink; color=black>PINK</font> offer working on";
echo "</p>";
echo "<input type=button value='New Offer' onclick=location.href='gestionale.php?name=lloyds&subname=offerte&act=new&idcliente=$id' style='font-family: Verdana; font-size: 10px'><br><br>";
echo '<table width=100% border=1 cellpadding=2 cellspacing=0 bordercolor=darkgreen>';
$sql = "SELECT * FROM nuke_offerte WHERE field3='$id' or field4='$id' order by id DESC";
$rs = $db->sql_query($sql);
echo '<tr>';
	echo '<th width=15%><font face=verdana size=2>Offer Number</font></th>';
	echo '<th width=10%><font face=verdana size=2>Type</font></th>';
	echo '<th width=25%><font face=verdana size=2>Cover Period</font></th>';
	echo '<th width=5%><font face=verdana size=2>Renwal Clause</font></th>';
	echo '<th width=15%><font face=verdana size=2>Sum Assured</font></th>';
	echo '<th width=10%><font face=verdana size=2>Annual Premium<br>Tax included</font></th>';
	echo '<th width=10%><font face=verdana size=2>Payed Premium</font></th>';
echo '</tr>';
$x=1;
while ($row = $db->sql_fetchrow($rs))
{
	$color='black';
	if ($row[blocca]==1) $color='black';
	$sqla = "SELECT * FROM nuke_polizze WHERE id='$row[id]'";
	$rsa = $db->sql_query($sqla);
	$nra = $db->sql_numrows($rsa);
	if ($nra=='0' ) echo '<tr bgcolor=pink>';
	if ($nra!='0' ) echo '<tr bgcolor=lightgreen>';
		echo "<td align=center valign=middle>";
		echo "<font color=$color face=calibri size=2><a style=text-decoration:underline; href=gestionale.php?name=lloyds&subname=offerte&act=explode&id=$row[id]>$row[field1]/$row[id]</a></font>";
		if ($row[addendum]!='') {
			echo "<br><font color=$color face=calibri size=2>";
			echo "Modified from<br>".str_replace("EUROPLEX_N._B072/BB011440C/","",$row[addendum]);
			echo "</font>";
		}else{
			$sqlp = "SELECT * FROM nuke_polizze where id='$row[id]'";
			$rsp = $db->sql_query($sqlp);
			$rowp = $db->sql_fetchrow($rsp);
			echo "<br><font color=$color face=calibri size=2>";
			echo "Become<br>".str_replace("EUROPLEX N. B072/BB011440C/","",$rowp[numeropolizza]);
			echo "</font>";
		}
		echo "</td>";
		echo "<td align=center valign=middle><font color=$color face=calibri size=2>";
		$tip = $db->sql_fetchrow($db->sql_query("SELECT * FROM nuke_tipologiepolizze WHERE id=$row[field2]"));
		echo $tip[field2];
		echo "</font></td>";
		echo "<td align=center valign=middle><font color=$color face=calibri size=2>From: $row[field6], To: $row[field10]<br>Covered Days ".number_format($row[field11],0)."</font></td>";
		echo "<td align=center valign=middle><font color=$color face=calibri size=2>";
		if ($row[rinnovo]=='0') echo "No"; if ($row[rinnovo]=='1') echo "Yes";
		echo "</font></td>";
		echo "<td align=center valign=middle><font color=$color face=calibri size=2>$row[valuta] ".number_format($row[field8],2,".",chr(180))."</font></td>";
		echo "<td align=center valign=middle><font color=$color face=calibri size=2>$row[valuta] ".number_format(round($row[field15]*20)/20,2,".",chr(180))."</font></td>";
		$ari_totale = round($row[field15]*20)/20;
		if ($row[rimborso]!='') {
			$ari_totale = floatval($ari_totale) + floatval(trim($row[rimborso]));
		}
		if ($row[field11]!='365' || $row[field11]!='366') {
			$ari_totale = $ari_totale/365*$row[field11];
		}
		echo "<td align=center valign=middle><font style=color:$color; face=calibri size=2>$row[valuta] ";
		echo number_format(round($ari_totale*20)/20,"2",".","'");
		echo "</font></td>";
	echo '</tr>';
}
echo '</table>';
CloseTable();

?>
