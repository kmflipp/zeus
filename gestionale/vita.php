<?php
$subname = $_GET[subname];

if ($subname=='') {
	OpenTable();
		echo '<table width=100% border=1 bordercolor=darkgreen cellspacing=0 cellpadding=5><td>';
		echo "<input type=button value='Exit' onclick=location.href='gestionale.php?name=home' style=font-family: Verdana; font-size: 10px;>";
		echo "</td></table>";
	CloseTable();

	OpenTable();
	echo "<center><strong>LIFE<table cellspacing=5 cellpadding=0><tr><td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=vita&subname=vita1>
				<div class=image style=background-image:url('images/vita.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Compare: Life</font></div>
				</div></a>";
	echo "</td><td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=vita&subname=malattia>
				<div class=image style=background-image:url('images/malattia.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Compare: Ilness</font></div>
				</div></a>";
	echo "</td>";
	echo "<td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=vita&subname=lpp>
				<div class=image style=background-image:url('images/lpp.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Compare: LPP</font></div>
				</div></a>";
	echo "</td></tr></table><table cellspacing=5 cellpadding=0><tr><td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=vita&subname=infortuni>
				<div class=image style=background-image:url('images/infortuniu.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Compare: Accident</font></div>
				</div></a>";
	echo "</td><td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=vita&subname=complementari>
				<div class=image style=background-image:url('images/complementare.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Compare: Complementary</font></div>
				</div></a>";
	echo "</td></tr></table></center>";
	
	CloseTable();
} else {
	OpenTable();
		echo '<table width=100% border=1 bordercolor=darkgreen cellspacing=0 cellpadding=5><td>';
		echo "<input type=button value='Exit' onclick=location.href='gestionale.php?name=vita' style=font-family: Verdana; font-size: 10px;>";
		echo "</td></table>";
	CloseTable();
	if (file_exists("gestionale/".$subname.".php")) {
		include("gestionale/".$subname.".php");
	}
}
?>