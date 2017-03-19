<?php
$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$idcliente = $_GET[idcliente];

if ($_GET[elabora]=='on') {
	$sql = "UPDATE nuke_polizze SET status='$_GET[attiva]' WHERE idpolizza = '$_GET[idpolizza]'";
	$result = $db->sql_query1($sql);
	header("Location: gestionale.php?name=clienti&act=explode&id=$id");
}

OpenTable();
echo "<p><font face=calibri size=2>Legend<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style=background-color:red; color=white>RED</font> policy canceled or replaced&nbsp;&nbsp;::&nbsp;&nbsp;<font style=background-color:lightgreen; color=black>GREEN</font> policy active&nbsp;&nbsp;::&nbsp;&nbsp;<font style=background-color:yellow; color=black>YELLOW</font> expiry policy</font>";
echo "</p>";
for ($x=0;$x<2;$x++) {
	if ($x==0) {$sql = "SELECT * FROM nuke_polizze WHERE field3='$id' order by right(numeropolizza,6) DESC, idpolizza DESC";$aswhat='As Owner';}
	if ($x==1) {$sql = "SELECT * FROM nuke_polizze WHERE field4='$id' order by right(numeropolizza,6) DESC, idpolizza DESC";$aswhat='As Assured';}
	$rs = $db->sql_query($sql);
	if ($x==1) {
		echo "<br><br><hr>";
	}
	echo "<center><font face=calibri style=font-size:12px;color=black;><strong>$aswhat</font></center>";
	echo '<p align=right><table width=100% border=1 cellpadding=2 cellspacing=0 bordercolor=darkgreen>';
	echo '<tr>';
		echo '<td align=center width=6% colspan=2><font face=verdana size=2><strong>Status</td>';
		echo '<td align=center width=12%><font face=verdana size=2><strong>Policy Number</td>';
		echo '<td align=center width=12%><font face=verdana size=2><strong>Offer Number</td>';
		echo '<td align=center width=10%><font face=verdana size=2><strong>Type</td>';
		echo '<td align=center width=25%><font face=verdana size=2><strong>Cover Period</td>';
		echo '<td align=center width=10%><font face=verdana size=2><strong>Renwal Clause</td>';
		echo '<td align=center width=12%><font face=verdana size=2><strong>Sum Assured</td>';
		echo '<td align=center width=13%><font face=verdana size=2><strong>Annual Premium<br>Tax included</td>';
		echo '<td align=center width=13%><font face=verdana size=2><strong>Payed Premium</td>';
	echo '</tr>';
	while ($row = $db->sql_fetchrow($rs))
	{
		$color='black';
		$sfondo='bgcolor=lightgreen';
		$checked=' checked ';

		$annorecordprecedente = $annoscadenza;
		$annoscadenza=date("Y",strtotime($row[field10]));

		if (date("Y",strtotime($row[field10]))==date("Y")) {
			$color="black";
			$sfondo='bgcolor=yellow';
		}
		if (trim($row[status])=='0') {
			$color='white';
			$sfondo='bgcolor=red';
			$checked=' ';
		}

		if ($status_precedente=='0' && $row[status]=='1') {
			echo "<tr><td height=10 colspan=9></td></tr>";
		}
		if ($status_precedente=='1' && $row[status]=='1') {
			echo "<tr><td height=5 colspan=9></td></tr>";
		}
				
		echo "<tr $sfondo>";
			$disabled=' ';
			if ($x==1) $disabled=' disabled ';
			if ($row[status]=='0') {
				echo "<td align=center valign=middle style=border-bottom:0px;border-left:0px; bgcolor=lightgrey>&nbsp;&nbsp;</td>";
				echo "<td align=center valign=middle><font style=color:$color; face=calibri size=2>";
			}
			else{
				echo "<td colspan=2 align=center valign=middle><font style=color:$color; face=calibri size=2>";
			}
			echo "<input $disabled type=checkbox $checked onClick=attiva(this,'$id','$row[idpolizza]');>
			</font></td>";
			echo "<td align=center valign=middle><font style=color:$color; face=calibri size=2><a style=color:$color;text-decoration:underline; href=gestionale.php?name=lloyds&subname=polizze&act=explode&idpolizza=$row[idpolizza]>";
			echo $row[numeropolizza];
			echo "</a></font></td>";
			echo "<td align=center valign=middle><font style=color:$color; face=calibri size=2><a style=color:$color;text-decoration:underline; href=gestionale.php?name=lloyds&subname=offerte&act=explode&id=$row[id]>$row[field1]/$row[id]</a></font></td>";
			echo "<td align=center valign=middle><font style=color:$color; face=calibri size=2>$row[field2]</font></td>";
			echo "<td align=center valign=middle><font style=color:$color; face=calibri size=2>From: $row[field6], To: $row[field10]<br>Covered Days ".number_format($row[field11],0)."</font></td>";
			echo "<td align=center valign=middle><font style=color:$color; face=calibri size=2>";
			if ($row[rinnovo]=='0') echo "No"; if ($row[rinnovo]=='1') echo "Yes";
			echo "</font></td>";
			echo "<td align=center valign=middle><font style=color:$color; face=calibri size=2>$row[valuta] ".number_format($row[field8],2,".",chr(180))."</font></td>";
			echo "<td align=center valign=middle><font style=color:$color; face=calibri size=2>$row[valuta] ".number_format($row[field15],2,".",chr(180))."</font></td>";
			$ari_totale = $row[field15];
			if ($row[rimborso]!='') {
				$ari_totale = floatval($row[field15]) + floatval(trim($row[rimborso]));
			}
			if ($row[field11]!='365' || $row[field11]!='366') {
				$ari_totale = $ari_totale/365*$row[field11];
			}
			echo "<td align=center valign=middle><font style=color:$color; face=calibri size=2>$row[valuta] ".number_format($ari_totale,2,".",chr(180))."</font></td>";
		echo '</tr>';
		$status_precedente = $row[status];
	}
	echo '</table>';
	echo "<br>";
}
CloseTable();

?>
