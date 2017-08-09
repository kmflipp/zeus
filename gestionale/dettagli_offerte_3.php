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


$rs_offerta = $db->sql_query("SELECT * FROM nuke_offerte where id=$_GET[id]");
$row = $db->sql_fetchrow($rs_offerta);
OpenTable();
//somma assicurata e premio annuolordo
echo '<table width=100% border=0 cellspacing=0 cellpadding=0>';
echo '<tr>';
echo '<td width=50% align=right><font face=verdana size=2><strong>Somma Assicurata</strong>&nbsp;</td>';
echo "<td width=10%>&nbsp;</td>";
echo "<td width=40% valign=middle align=left><input disabled type=text size=10 style='font-size:18px' id=3001 tabindex=3001 onkeyup=javascript:query_now3(3001,event,'$_GET[id]','field8',this.value) value='$row[field8]'>&nbsp;$row[valuta]</td>";
echo '</tr>';
echo "</table><hr>";
echo '<table width=100% border=0 cellspacing=0 cellpadding=0>';
echo '<tr>';
echo '<td width=50% align=right><font face=verdana size=2><strong>Premio annuo lordo</strong>&nbsp;</td>';
echo "<td width=10%>&nbsp;</td>";
echo "<td width=40% valign=middle align=left><input type=text size=8 style='font-size:18px' id=3003 tabindex=3003 onkeyup=javascript:query_now3(3003,event,'$_GET[id]','field12',this.value) value='$row[field12]'>&nbsp;$row[valuta]</td>";
echo "</tr>";
echo '<tr>';
echo "<td valign=middle align=right><font face=verdana size=2><strong>Ribasso</strong>&nbsp;</td>";
if ($row[field14]=='5') $selected5=" selected ";
if ($row[field14]=='10') $selected10=" selected ";
echo "<td valign=middle align=left>
			<select id=seleziona onChange=document.getElementById(3005).value=this.value;query_now3(3005,event,'$_GET[id]','field14',this.value);><option selected value=''></option><option $selected5 value=5>3 anni</option><option $selected10 value=10>5 anni</option></select>
			<input type=text size=3 style='font-size:18px' id=3005 tabindex=3005 onkeyup=javascript:query_now3(3005,event,'$_GET[id]','field14',this.value) value='$row[field14]'>%
			</td>";
echo "<td>";
			$risultato = $row[field12]*$row[field14]/100;
			$prezzo_ribassato = $row[field12]-($row[field12]*$row[field14]/100);
			$res = number_format(round($risultato*20)/20,2,".","'");
			echo "<strong>-&nbsp; ".str_replace('.00','.-',$res)." $row[valuta]</strong>";
echo "</td>";
echo '</tr>';
echo '<tr>';
echo "<td valign=middle align=right><font face=verdana size=2><strong>Premio parziale</strong>&nbsp;</td>";
echo "<td valign=middle align=left></td>";
$res = number_format(round($prezzo_ribassato*20)/20,2,".","'");
echo "<td><strong>=&nbsp; ".str_replace('.00','.-',$res)." $row[valuta]</strong></td>";
echo '</tr>';
echo "</table><hr>";
echo '<table width=100% border=0 cellspacing=0 cellpadding=0>';
echo '<tr>';
echo "<td width=50% valign=middle align=right><font face=verdana size=3><strong>Bollo</strong>&nbsp;</td>";
echo "<td width=10% valign=middle align=left>";
echo "<select style='font-size:18px;width:80' id=3004 tabindex=3004 onchange=javascript:query_now3(3004,event,'$_GET[id]','field13',this.value)>";
echo "<option value=''></option>";
$rs_tassi = $db->sql_query("SELECT * FROM nuke_bolli");
while ($row_tassi = $db->sql_fetchrow($rs_tassi))
	{
	$selected=" ";
	if (trim(str_replace("%","",$row_tassi[field2]))==$row[field13]) $selected=" SELECTED ";
	echo "<option".$selected."value=".trim(str_replace("%","",$row_tassi[field2])).">$row_tassi[field2]</option>";
	$selected=" ";
	}
echo "</select></td>";
echo "<td width=40%>";
			$risultato = number_format(round($prezzo_ribassato*$row[field13]/100*20)/20,2,".","'");
			echo "<strong>+&nbsp;".str_replace(".00",".-",$risultato)." $row[valuta]</strong>";
echo "</td>";
echo '</tr>';
echo '<tr>';
echo "<td width=50% valign=middle align=right><font face=verdana size=2><strong>Premio totale netto</strong>&nbsp;</td>";
echo "<td width=10%>&nbsp;</td>";
$res = round($row[field15]*20)/20;
echo "<td width=40% valign=middle align=left>
			<input type=text size=9 style='font-size:18px' id=3006 tabindex=3006 onkeyup=javascript:query_now3(3006,event,'$_GET[id]','field15',this.value) value='$res'>&nbsp;$row[valuta]
			</td>";
echo '</tr>';
echo "</table>";
echo "</p>";

CloseTable();

?>