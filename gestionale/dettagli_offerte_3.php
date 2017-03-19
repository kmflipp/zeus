<script language=JavaScript>
var myRequest3 = null;

function CreateXmlHttpReq3(handler) {
  var xmlhttp = null;
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = handler;
  return xmlhttp;
}

function myHandler3() {
  if (myRequest3.readyState == 4 && myRequest3.status == 200) {
  	var n = myRequest3.responseText.split(",");
	  if (n[1]=='1') {
			var floatobj=document.getElementById("dhtmlfloatie1");
			floatobj.style.display="block";
    	if (n[2]!='') document.getElementById(3005).value=n[2];
    	if (n[3]!='') document.getElementById(3006).value=n[3];
	  }
	  if (n[1]=='0') {
			var floatobj=document.getElementById("dhtmlfloatie2");
			floatobj.style.display="block";
	  }
  }
}

function query_now3(tabindex,event,id,field,valore) {
	var floatobj=document.getElementById("dhtmlfloatie1");
	floatobj.style.display="none";
	var floatobj=document.getElementById("dhtmlfloatie2");
	floatobj.style.display="none";

  myRequest3 = CreateXmlHttpReq3(myHandler3);
	myRequest3.open('GET','gestionale_query3.php?field='+field+'&id='+id+'&valore='+valore);
	myRequest3.send(null);

	if (event.keyCode=='13') {
		tabindex++;
		document.getElementById(tabindex).focus();
	}
}

</script>

<?php
global $prefix, $db, $admin, $user;
$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
if ($blocca==1) $disabled = " disabled ";

$rs_offerta = $db->sql_query("SELECT * FROM nuke_offerte where id=$_GET[id]");
$row = $db->sql_fetchrow($rs_offerta);
OpenTable();

$somma_totale = number_format(($row[field8]*20)/20,2,'.',chr(180));
$premio_lordo = number_format(($row[field12]*20)/20,2,".",chr(180));
if ($row[field14]=='5') $selected5=" selected ";
if ($row[field14]=='10') $selected10=" selected ";
$prezzo_ribassato = $row[field12]-($row[field12]*$row[field14]/100);
$bollo = $prezzo_ribassato*$row[field13]/100;
$premio_netto = $prezzo_ribassato+$bollo;

$bollo = number_format(round($bollo*20)/20,2,".",chr(180));
$prezzo_ribassato=number_format(round($prezzo_ribassato*20)/20,2,".",chr(180));
$premio_netto=number_format(round($premio_netto*20)/20,2,".",chr(180));


echo "<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen>";
echo "<tr>";
echo "<td align=left><font face=calibri size=2><strong>Somma Assicurata</strong>: <input readonly style=text-align:center;color:black; type=text size=25 id=3001 tabindex=3001 value='$somma_totale'>&nbsp;$row[valuta]</font></td>";
echo "<td align=left><font face=calibri size=2><strong>Premio Lordo</strong>: <input readonly type=text style=text-align:center; size=25 id=3002 tabindex=3002 value='$premio_lordo'>&nbsp;$row[valuta]</font></td>";
echo "</tr>";
echo "<tr>";
echo "<td valign=middle colspan=2 align=left><font face=verdana size=2><strong>Ribasso</strong>: ";
	echo "<select $disabled id=seleziona onChange=document.getElementById(3005).value=this.value;query_now3(3005,event,'$_GET[id]','field14',this.value);><option selected value=''></option><option $selected5 value=5>3 anni</option><option $selected10 value=10>5 anni</option></select>";
	echo "&nbsp;&nbsp;&nbsp;<input $disabled type=text style=text-align:right; size=10 id=3005 tabindex=3005 onkeyup=javascript:query_now3(3005,event,'$_GET[id]','field14',this.value) value='$row[field14]'>%";
	echo "<strong>&nbsp;&nbsp;&nbsp;".$risultato."</strong> $row[valuta]";
echo "</tr>";
echo "<tr>";
echo "<td valign=middle colspan=2 align=left><font face=verdana size=2><strong>Bollo</strong>: ";
	echo "<select $disabled id=3004 tabindex=3004 onchange=javascript:query_now3(3004,event,'$_GET[id]','field13',this.value)>";
	echo "<option value=''></option>";
	$rs_tassi = $db->sql_query("SELECT * FROM nuke_bolli");
	while ($row_tassi = $db->sql_fetchrow($rs_tassi))
	{
		$selected=" ";
		if (trim(str_replace("%","",$row_tassi[field2]))==$row[field13]) $selected=" SELECTED ";
		echo "<option".$selected."value=".trim(str_replace("%","",$row_tassi[field2])).">$row_tassi[field2]</option>";
		$selected=" ";
	}
	echo "</select>";
	echo "<strong>&nbsp;&nbsp;".$bollo."</strong> $row[valuta]";
echo "</tr>";
echo "<tr>";
echo "<td valign=middle align=left><font face=verdana size=2><strong>Premio Netto</strong>: ";
echo "<input readonly type=text size=25 style=text-align:center; id=3006 tabindex=3006 value='$premio_netto'>&nbsp;$row[valuta]</td>";
echo "<td valign=middle align=left><input type=button value=Ricalcola onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id'></td>";
echo "</tr>";
echo "<tr>";
echo "<td valign=middle align=left><font face=verdana size=2><strong>Rimborsi / Ristorni</strong>:<br>";
echo "<input type=text size=25 style=text-align:center; id=3007 tabindex=3007 value='".trim($row[etichetta])."'>";
echo "<input type=text size=25 style=text-align:center; id=3008 tabindex=3008 value='".trim($row[rimborso])."'>&nbsp;$row[valuta]</td>";
echo "<td valign=middle align=left><input type=button value=Salva onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id&rimborso='+document.getElementById(3008).value+'&etichetta='+document.getElementById(3007).value;><input type=button value=Cancella onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id&rimborso=elimina';></td>";
echo "</tr>";
echo "</table>";
CloseTable();

?>