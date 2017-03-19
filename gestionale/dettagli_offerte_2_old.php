<script language=JavaScript>
var myRequest = null;

function CreateXmlHttpReq(handler) {
  var xmlhttp = null;
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = handler;
  return xmlhttp;
}

function myHandler() {
    if (myRequest.readyState == 4 && myRequest.status == 200) {
    	var n=myRequest.responseText.split(",");
      var e = document.getElementById('200'+n[0]);
     	e.style.visibility = 'visible';
     	e.style.display = 'block';
     	if (n[1]=='1') {
     	e.innerHTML = '<strong>Record Saved!</strong>';
    	}
     	if (n[1]=='0') {
     	e.innerHTML = '<strong><font color=red>Error Saving Record!!</font></strong>';
    	}
    }
    else
    {
    	var n=myRequest.responseText.split(",");
      var e = document.getElementById('200'+n[0]);
     	e.style.visibility = 'visible';
     	e.style.display = 'block';
     	if (n[1]=='1') {
     	e.innerHTML = '<strong>Record Saved!</strong>';
    	}
     	if (n[1]=='0') {
     	e.innerHTML = '<strong><font color=red>Error Saving Record!!</font></strong>';
    	}
    }
}

function query_now(tabindex,event,id,valore) {
		//if (event.keyCode=='9' || event.keyCode=='13') {
			if (event.keyCode=='13') {
				tabindex++;
				document.getElementById(tabindex).focus();
			}
	    myRequest = CreateXmlHttpReq(myHandler);
    	myRequest.open('GET','gestionale_query2.php?id='+id+'&valore='+valore);
    	myRequest.send(null);
    //}
}

</script>

<?php

global $prefix, $db, $admin, $user;

$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$act = $_GET[act];
$id = $_GET[id];
$tablename = "nuke_dettaglipolizza";

if ($azioni=='aggiungiitem2') {
		$sql = "INSERT INTO nuke_offerte_detail2 (iddettaglio,idofferta) VALUES ('$_GET[iddettaglio]','$_GET[id]')";
		$result = $db->sql_query($sql);	
}
if ($azioni=='eliminaitem2') {
		$sql = "DELETE FROM nuke_offerte_detail2 WHERE id = '$_GET[idoffertedetail2]'";
		$result = $db->sql_query($sql);	
}
if ($azioni=='aggiungicat2') {
		$sql = "SELECT * FROM nuke_dettaglipolizza WHERE field1='$_GET[idcategoria]'";
		$rs = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($rs))
		{
			$sql = "INSERT INTO nuke_offerte_detail2 (iddettaglio,idofferta) VALUES ('$row[id]','$_GET[id]')";
			$result = $db->sql_query($sql);	
		}
}
if ($azioni=='eliminacat2') {
		$sql = "SELECT * FROM nuke_dettaglipolizza WHERE field1='$_GET[idcategoria]'";
		$rs = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($rs))
		{
			$sql = "DELETE FROM nuke_offerte_detail2 WHERE iddettaglio = '$row[id]' and idofferta = '$_GET[id]'";
			$result = $db->sql_query($sql);	
		}
}


//Visualizzazione ad albero
	$piu="+";
	$meno="-";
	//$idpolizza = $db->sql_fetchrow($db->sql_query("SELECT field2 FROM nuke_offerte where id=$_GET[id]"));
	$rs_tipopolizze = $db->sql_query("SELECT * FROM nuke_tipologiepolizze where id in(SELECT field2 FROM nuke_offerte where id=$_GET[id])");
	while ($tipopolizze = $db->sql_fetchrow($rs_tipopolizze))
	{
		OpenTable();
		$segno=$piu;
		echo "<a name=$tipopolizze[id]>";
		echo '<div id="albero">';
		echo "<table width=100% border=0 cellspacing=0 cellpadding=0>";
		echo "<td align=left width=90%><strong>".$segno."&nbsp;[$tipopolizze[id]] $tipopolizze[field2]</td>";
		echo "<td align=right width=10%></td>";
		echo "</table>";
		echo "</div>";
		$tabindex=1;
		$rs_categorie = $db->sql_query("SELECT * FROM nuke_categoriedettagli WHERE idpolizza=$tipopolizze[id]");
		while ($categorie = $db->sql_fetchrow($rs_categorie))
		{
			$segno=$piu;
			echo "<a name=categoria$categorie[id]></a>";
			echo '<div id="into_albero" align=right>';
			echo "<table width=95% border=0 cellspacing=0 cellpadding=0>
			<td width=80% align=left><strong>".$segno."</strong>&nbsp;".utf8_decode($categorie[categoria])." (<i>".utf8_decode($categorie[category])."</i>)</td>
			<td align=right>";
			$sqla = "SELECT * FROM nuke_offerte_detail2 WHERE iddettaglio in (SELECT id from nuke_dettaglipolizza where field1='$categorie[id]') and idofferta=$_GET[id]";
			$rsa = $db->sql_query($sqla);
			$nra = $db->sql_numrows($rsa);
			$a = mysql_fetch_assoc($rsa);
			if ($nra > 0) {$img='circle_green.png';$add='0';$remove='1';}
			if ($nra == 0) {$img='circle_red.png';$add='1';$remove='0';}
			echo "<img src=immagini/$img>";
			if ($add=='1') {echo "<a href=$_SERVER[PHP_SELF]?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&azioni=aggiungicat2&idcategoria=$categorie[id]&view=domande#categoria$categorie[id]><img border=0 src=immagini/add.png></a>";}
			if ($add=='0') {echo "<img border=0 src=immagini/add_grey.png>";}
			if ($remove=='1') {echo "<a href=$_SERVER[PHP_SELF]?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&azioni=eliminacat2&idcategoria=$categorie[id]&view=domande#categoria$categorie[id]><img border=0 src=immagini/minus.png></a>";}
			if ($remove=='0') {echo "<img border=0 src=immagini/minus_grey.png>";}
			echo "</td></table>";
			echo "</div><p>";
			$rs_nomi = $db->sql_query("SELECT * FROM nuke_dettaglipolizza WHERE field1='$categorie[id]'");
			while ($nomi = $db->sql_fetchrow($rs_nomi))
			{
				$sqlb = "SELECT * FROM nuke_offerte_detail2 WHERE iddettaglio='$nomi[id]' and idofferta='$_GET[id]'";
				$rsb = $db->sql_query($sqlb);
				$nrb = $db->sql_numrows($rsb);
				while ($b = $db->sql_fetchrow($rsb))
				{
					echo "<a name=item$nomi[id]></a>";
					echo '<div id="into_albero" align=right>';
					echo "<table width=85% border=0 cellspacing=0 cellpadding=0 style='border-collapse:collapse;border-bottom:1px dotted black;padding:5px;'>
					<td width=40% align=left>".utf8_decode($nomi[field4])." (<i>".utf8_decode($nomi[field5])."</i>)";
					if ($nrb > 0) {$img='circle_green.png';$add='1';$remove='1';$trafficlight='green';}
					if ($nrb == 0) {$img='circle_red.png';$add='1';$remove='0';$trafficlight='red';}
					echo "<div style='display:none;visibility:hidden;' id=200$b[id]><strong>Rercord Saved!</strong></div></td>";
					echo "<td align=center width=45%>";
					if ($trafficlight=='green') {
						echo "<input type=text size=40 style='font-size:18px' id=200$tabindex tabindex=200$tabindex onkeydown=javascript:query_now('200$tabindex',event,'$b[id]',this.value) value='$b[valore]'>";
						$tabindex=$tabindex+1;
						echo "<input type=hidden name=idoffertedetail2 value=$b[id]>";
					}
					
					echo "</td>";
					echo "<td width=15% align=right>";
					echo "<img src=immagini/$img>";
					if ($add=='1') {echo "<a href=$_SERVER[PHP_SELF]?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&azioni=aggiungiitem2&iddettaglio=$nomi[id]&view=domande#categoria$categorie[id]><img border=0 src=immagini/add.png></a>";}
					if ($add=='0') {echo "<img border=0 src=immagini/add_grey.png>";}
					if ($remove=='1') {echo "<a href=$_SERVER[PHP_SELF]?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&azioni=eliminaitem2&idoffertedetail2=$b[id]&view=domande#categoria$categorie[id]><img border=0 src=immagini/minus.png></a>";}
					if ($remove=='0') {echo "<img border=0 src=immagini/minus_grey.png>";}
					echo "</td></table>";
					echo "</div>";
				}
			}
			echo "</p>";
		}
		CloseTable();
	}
?>