<?php
if ($subname!='') {
	include("gestionale/".$subname.".php");
} else {
	OpenTable();
		echo '<p>';
		echo '<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen><td>';
		echo "<input type=button value='Exit' onclick=location.href='gestionale.php?name=home' style=font-family: Verdana; font-size: 10px;>";
		echo "</td></table>";
		echo '</p>';
	CloseTable();
	
	OpenTable();
	$title="LLOYD'S";
	if ($_SERVER[company]==2) $title='KILN';
	
	echo "<center><strong>$title<table cellspacing=5 cellpadding=0><tr><td align=center valign=top>";
	echo "<a href=gestionale.php?name=clienti>
				<div class=image style=background-image:url('images/clienti.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Customers</div>
				</div></a>";
	echo "</td><td align=center valign=top>";
	$name='lloyds';
	if ($_SERVER[company]==2) $name='kiln';
	echo "
				<a href=gestionale.php?name=$name&subname=polizze>
				<div class=image style=background-image:url('images/polizze.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Policy</font></div>
				</div></a>";
	echo "</td><td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=$name&subname=offerte>
				<div class=image style=background-image:url('images/proposte.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Offers</font></div>
				</div></a>";
	echo "</td></tr></table></center>";
	echo "<center><table cellspacing=5 cellpadding=0><tr><td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=lloyds&subname=scadenze>
				<div class=image style=background-image:url('images/scadenze.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Deadlines</font></div>
				</div></a>";
	echo "</td><td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=lloyds&subname=bolli_to_pay>
				<div class=image style=background-image:url('images/bolli.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Stamp Duties</font></div>
				</div></a>";
	echo "</td></tr></table></center>";
	
	CloseTable();
}
?>

