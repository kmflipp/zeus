<script language=JavaScript>

function CreateXmlHttpReq(handler) {
  var xmlhttp = null;
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = handler;
  return xmlhttp;
}

function myHandlerldr() {
  if (myRequestldr.readyState == 4 && myRequestldr.status == 200) {
   	var n=myRequestldr.responseText.split(",");
	  if (n[1]=='1') {
			var floatobj=document.getElementById("dhtmlfloatie1");
			floatobj.style.display="block";
	  }
	  if (n[1]=='0') {
			var floatobj=document.getElementById("dhtmlfloatie2");
			floatobj.style.display="block";
	  }
  }
}

function query_now_ldr(tabindex,event,id,field,valore) {
	var floatobj=document.getElementById("dhtmlfloatie1");
	floatobj.style.display="none";
	var floatobj=document.getElementById("dhtmlfloatie2");
	floatobj.style.display="none";
	if (event.keyCode=='13' || event.keyCode=='9') {
	  myRequestldr = CreateXmlHttpReq(myHandlerldr);
		myRequestldr.open('GET','ldr_query.php?field='+field+'&id='+id+'&valore='+valore);
		myRequestldr.send(null);
	}
	if (event.keyCode=='13') {
		tabindex++;
		if (document.getElementById(tabindex)) document.getElementById(tabindex).focus();
	}
}

</script>

<?php
require_once("mainfile.php");

global $prefix, $db, $admin, $user;
$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$azioni = $_GET[azioni];
$idofferta = $_GET[id];
$idldr = $_GET[idldr];
$detail = $_GET[detail];
$value = $_GET[value];

if ($_GET[aggiorna]=='si') {
	//elimino i dati dalla tabella relativamente a questa offerta
	$sql = "DELETE FROM nuke_offerte_ldr WHERE idofferta=$id";
	$db->sql_query($sql);


	//inserisco i luoghi di rischio di default
	$sql = "SELECT * FROM nuke_offerte WHERE id=$id";
	$rs = $db->sql_query($sql);
	$row = $db->sql_fetchrow($rs);
	$stipulante=$row[field3];
	$assicurato=$row[field4];

	$filtra = $stipulante;
	if ($assicurato!='') $filtra=$assicurato;
	$sql = "SELECT * FROM nuke_clienti where id = $filtra";
	$recordset = $db->sql_query($sql);
	$rs = $db->sql_fetchrow($recordset);
	if ($rs[via1]!='') {
		//inserisco il luogo di rischio indirizzo di corrispondenza
		$sql = "INSERT INTO nuke_offerte_ldr (idofferta,detail,value) VALUES ('$id','Indirizzo Principale','$rs[via1]<br>$rs[npa1] $rs[localita1]<br>-$rs[stato1]-')";
		$result = $db->sql_query($sql);
	}
	if ($rs[via2]!='') {
		//inserisco il luogo di rischio LUOGO DI RISCHIO 1
		$sql = "INSERT INTO nuke_offerte_ldr (idofferta,detail,value) VALUES ('$id','Luogo di rischio secondario','$rs[via2]<br>$rs[npa2] $rs[localita2]<br>-$rs[stato2]-')";
		$result = $db->sql_query($sql);
	}
	if ($rs[via3]!='') {
		//inserisco il luogo di rischio LUOGO DI RISCHIO 1
		$sql = "INSERT INTO nuke_offerte_ldr (idofferta,detail,value) VALUES ('$id','Luogo di rischio secondario','$rs[via3]<br>$rs[npa3] $rs[localita3]<br>-$rs[stato3]-')";
		$result = $db->sql_query($sql);
	}
	if ($rs[via4]!='') {
		//inserisco il luogo di rischio LUOGO DI RISCHIO 1
		$sql = "INSERT INTO nuke_offerte_ldr (idofferta,detail,value) VALUES ('$id','Luogo di rischio secondario','$rs[via4]<br>$rs[npa4] $rs[localita4]<br>-$rs[stato4]-')";
		$result = $db->sql_query($sql);
	}
	header("Location: gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id&view=LDR");
}

//verifico la coerenza dei luoghi di rischio
$sql = "SELECT * FROM nuke_offerte WHERE id=$id";
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);
$stipulante=$row[field3];
$assicurato=$row[field4];

$filtra = $stipulante;
if ($assicurato!='') $filtra=$assicurato;
$sql = "SELECT * FROM nuke_clienti where id = $filtra";
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);
if ($row[via1]!='') {
	//memorizzo il luogo di rischio indirizzo di corrispondenza
	$corrispondenza = "$row[via1]<br>$row[npa1] $row[localita1]<br>-$row[stato1]-";
}
if ($row[via2]!='') {
	//memorizzo il luogo di rischio LUOGO DI RISCHIO 2
	$rischio2="$row[via2]<br>$row[npa2] $row[localita2]<br>-$row[stato2]-'";
}
if ($row[via3]!='') {
	//memorizzo il luogo di rischio LUOGO DI RISCHIO 3
	$rischio3="$row[via3]<br>$row[npa3] $row[localita3]<br>-$row[stato3]-'";
}
if ($row[via4]!='') {
	//memorizzo il luogo di rischio LUOGO DI RISCHIO 4
	$rischio4="$row[via4]<br>$row[npa4] $row[localita4]<br>-$row[stato4]-'";
}


if ($azioni == 'nuovo'){
	$sql = "INSERT INTO nuke_offerte_ldr (idofferta) VALUES ($idofferta)";
	$db->sql_query($sql);
}
if ($azioni == 'del'){
	$sql = "DELETE FROM nuke_offerte_ldr WHERE id=$idldr";
	$db->sql_query($sql);
}

OpenTable();
$sql = "SELECT * FROM nuke_offerte_ldr WHERE idofferta=$id order by id";
$rs = $db->sql_query($sql);
$nr = $db->sql_numrows($rs);
echo "<p>";
if ($nr!=4) {
	echo "<input type=button value='Nuovo Record ( $nr record presenti su 4 )' onclick=location.href='gestionale.php?name=lloyds&subname=offerte&view=LDR&act=explode&azioni=nuovo&id=$id' style='font-family: Verdana; font-size: 10px'>";
} else {
	echo "<input type=button value='Presenti $nr record su 4, non è possibile crearne altri' style='font-family: Verdana; font-size: 10px'>";
}

echo "<div style='display:none;visibility:hidden;' id=8472><strong>Rercord Saved!</strong></div>";
echo "</p>";
echo '<table width=100% border=1 cellpadding=0 cellspacing=0>';
echo '<tr>';
	echo '<th align=center valign=middle width=45%><font face=verdana size=2><strong>Luogo di rischio</strong></font></th>';
	echo '<th align=center valign=middle width=45%><font face=verdana size=2><strong>Descrizione</strong></font></th>';
	echo '<th width=10%><font face=verdana size=2 color=blue>Funzionalità</font></th>';
echo '</tr>';
$x=1;
while ($row = $db->sql_fetchrow($rs))
{
	$been='0';
	if ($row[value]==$corrispondenza) $been='1';
	if ($row[value]==$rischio2) $been='1';
	if ($row[value]==$rischio3) $been='1';
	if ($row[value]==$rischio4) $been='1';
	echo '<tr>';
		echo "<td align=center valign=middle><input type=text size=40 style='font-size:18px' id=$x tabindex=$x onkeydown=javascript:query_now_ldr($x,event,'$row[id]','detail',this.value) value='$row[detail]'></td>";
		$x++;
		echo "<td align=center valign=middle><input type=text size=40 style='font-size:18px' id=$x tabindex=$x onkeydown=javascript:query_now_ldr($x,event,'$row[id]','value',this.value) value='$row[value]'></td>";
		$x++;
		echo "<td align=center valign=middle><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=offerte&act=explode&view=LDR&azioni=del&idldr=$row[id]&id=$id $confirm><img tabindex=$x border=0 src=immagini/remove.png></a></td>";
		$x++;
	echo '</tr>';
	
	if ($been=='0') {
		?>
		<SCRIPT>
		x=confirm("Il luogo di rischio '<?php echo $row[detail]; ?>' differisce dall'anagrafica del cliente, vuoi effettuare un aggiornamento? ATTENZIONE, i dati attuali verranno eliminati.");
		if (x) {
			window.location = "gestionale.php?name=lloyds&subname=offerte&act=explode&id=<?php echo $id; ?>&view=LDR&aggiorna=si";
		}
		</SCRIPT>
		<?php
	}
}
echo '</table>';
CloseTable();

?>
