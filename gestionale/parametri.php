<div class="parametri" id="parametri" style="position:relative;_position:relative;height:100%;overflow:auto;padding:0px;">
<?php

$subname = $_GET[subname];
if (!$subname) $subname=$_POST[subname];

if ($subname=='') {
	OpenTable();
		echo '<table width=100% border=1 bordercolor=darkgreen cellspacing=0 cellpadding=5><td>';
		echo "<input type=button value='Exit' onclick=location.href='gestionale.php?name=home' style=font-family: Verdana; font-size: 10px;>";
		echo "</td></table>";
	CloseTable();

	OpenTable();
	echo "<center><strong>PARAMETERS<table cellspacing=5 cellpadding=0><tr><td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=parametri&subname=utenti>
				<div class=image style=background-image:url('images/utenti.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Users</font></div>
				</div></a>";
	echo "</td><td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=parametri&subname=cga>
				<div class=image style=background-image:url('images/cga.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>General Terms (CGA)</font></div>
				</div></a>";
	echo "</td>";
	echo "<td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=parametri&subname=tipologie>
				<div class=image style=background-image:url('images/tipologie.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Policy Type</font></div>
				</div></a>";
	echo "</td><td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=parametri&subname=entita>
				<div class=image style=background-image:url('images/entita.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Insured Items</font></div>
				</div></a>";
	echo "</td></tr></table><table cellspacing=5 cellpadding=0><tr><td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=parametri&subname=limititerritoriali>
				<div class=image style=background-image:url('images/limititerritoriali.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Territorial Limits</font></div>
				</div></a>";
	echo "</td><td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=parametri&subname=scadenze>
				<div class=image style=background-image:url('images/scadenze.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Deadline</font></div>
				</div></a>";
	echo "</td>";
	echo "<td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=parametri&subname=dettaglipolizza>
				<div class=image style=background-image:url('images/dettaglipolizze.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Offer Questionnaire</font></div>
				</div></a>";
	echo "</td><td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=parametri&subname=bolli>
				<div class=image style=background-image:url('images/bolli.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Stamp Duties</font></div>
				</div></a>";
	echo "</td></tr></table><table cellspacing=5 cellpadding=0><tr><td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=parametri&subname=coperture>
				<div class=image style=background-image:url('images/coperture.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Covers</font></div>
				</div></a>";
	echo "</td><td align=center valign=top>";
	echo "
				<a href=gestionale.php?name=parametri&subname=condizioni>
				<div class=image style=background-image:url('images/condizioni.png');width:256px;height:256px;position:inline-block;>
				<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Terms</font></div>
				</div></a>";
	echo "</td></tr></table></center>";
	
	CloseTable();
} else {
	if (file_exists("gestionale/".$subname.".php")) {
		include("gestionale/".$subname.".php");
	}
}


?>
</div>