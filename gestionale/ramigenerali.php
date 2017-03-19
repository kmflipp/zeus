<?php
$subname = $_GET[subname];

if ($subname=='') {
	OpenTable();
		echo '<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen><td>';
		echo "<input type=button value='Exit' onclick=location.href='gestionale.php?name=home' style=font-family: Verdana; font-size: 10px;>";
		echo "</td></table>";
	CloseTable();
	
	OpenTable();
	echo "<center><strong>GENERAL BRANCH<table cellspacing=5 cellpadding=0><tr><td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=ramigenerali&subname=stabili>
				<div class=image style=background-image:url('images/stabili.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Compare: Buildings</font></div>
				</div></a>";
	echo "</td><td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=ramigenerali&subname=mobilia>
				<div class=image style=background-image:url('images/mobilia.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Compare: Forniture</font></div>
				</div></a>";
	echo "</td>";
	echo "<td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=ramigenerali&subname=commercio>
				<div class=image style=background-image:url('images/commercio.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Compare: Business</font></div>
				</div></a>";
	echo "</td></tr></table><table cellspacing=5 cellpadding=0><tr><td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=ramigenerali&subname=rc>
				<div class=image style=background-image:url('images/rc.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Compare: R.C.</font></div>
				</div></a>";
	echo "</td><td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=ramigenerali&subname=veicoli>
				<div class=image style=background-image:url('images/veicoli.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Compare: Vehicles</font></div>
				</div></a>";
	echo "</td></tr></table></center>";
	
	CloseTable();
} else {
	OpenTable();
		echo '<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen><td>';
		echo "<input type=button value='Exit' onclick=location.href='gestionale.php?name=ramigenerali' style=font-family: Verdana; font-size: 10px;>";
		echo "</td></table>";
	CloseTable();

	if (file_exists("gestionale/".$subname.".php")) {
		include("gestionale/".$subname.".php");
	}
}

?>
