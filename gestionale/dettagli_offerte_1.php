<script language=JavaScript>

function CreateXmlHttpReq(handler) {
  var xmlhttp = null;
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = handler;
  return xmlhttp;
}

function myHandler() {
  if (myRequest.readyState == 4 && myRequest.status == 200) {
   	var n=myRequest.responseText.split(",");
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

function query_now(tabindex,event,idcategoria,field,valore,idofferta,id) {
	var floatobj=document.getElementById("dhtmlfloatie1");
	floatobj.style.display="none";
	var floatobj=document.getElementById("dhtmlfloatie2");
	floatobj.style.display="none";
	if (event.keyCode=='9' || event.keyCode=='13') {
		testopremio='';
		if (field=='tasso') {
			indexsomma=tabindex-1;
			indexpremio=tabindex+1;
			document.getElementById(indexpremio).value=document.getElementById(indexsomma).value*document.getElementById(tabindex).value/100;
			testopremio='&premio='+document.getElementById(indexpremio).value;
		}
		if (event.keyCode=='13') {
			tabindex++;
			if (document.getElementById(tabindex)) document.getElementById(tabindex).focus();
		}
    myRequest = CreateXmlHttpReq(myHandler);
  	myRequest.open('GET','gestionale_query.php?id='+id+'&idcategoria='+idcategoria+'&field='+field+'&valore='+valore+'&idofferta='+idofferta+testopremio);
  	myRequest.send(null);
  }
}

</script>
<?php

global $prefix, $db, $admin, $user;

$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$act = $_GET[act];
$id = $_GET[id];
$tablename = "nuke_entita";

if ($azioni=='aggiungiitem') {
		$sql = "INSERT INTO nuke_offerte_detail1 (idcategoria,identita,idofferta) VALUES ('$_GET[idcategoria]','$_GET[identita]','$_GET[id]')";
		$result = $db->sql_query($sql);	
		header("Location: gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&idcategoria=$_GET[idcategoria]&scrolltop=$_GET[scrolltop]");
}
if ($azioni=='eliminaitem') {
		$sql = "DELETE FROM nuke_offerte_detail1 WHERE id = '$_GET[idoffertedetail1]'";
		$result = $db->sql_query($sql);	
		header("Location: gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&scrolltop=$_GET[scrolltop]");
}
if ($azioni=='aggiungicat') {
		$sql = "SELECT * FROM nuke_entita WHERE field1='$_GET[idcategoria]'";
		$rs = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($rs))
		{
			$sql = "INSERT INTO nuke_offerte_detail1 (idcategoria,identita,idofferta) VALUES ('$_GET[idcategoria]','$row[id]','$_GET[id]')";
			$result = $db->sql_query($sql);	
		}
		header("Location: gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&idcategoria=$_GET[idcategoria]&scrolltop=$_GET[scrolltop]");
}
if ($azioni=='eliminacat') {
		$sql = "SELECT * FROM nuke_entita WHERE field1='$_GET[idcategoria]'";
		$rs = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($rs))
		{
			$sql = "DELETE FROM nuke_offerte_detail1 WHERE identita = '$row[id]' and idofferta = '$_GET[id]'";
			$result = $db->sql_query($sql);	
		}
		header("Location: gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&scrolltop=$_GET[scrolltop]");
}


//Visualizzazione ad albero
	OpenTable();
	$tabindex=1000;
	echo "<table width=100% border=1 cellspacing=0 cellpadding=0>
				<td width=45% align=center><strong>Beni</strong></td>
				<td width=35% align=center><strong>Somma/Tasso/Premio</strong><br>Valuta $valuta</td>
				<td width=20% align=center><strong>Azioni</strong></td>
				</table>";

	$rs_categorie = $db->sql_query("SELECT * FROM nuke_categorie WHERE idpolizza=$row[field2] order by ordine");
	while ($categorie = $db->sql_fetchrow($rs_categorie))
	{
		$nra = $db->sql_numrows($db->sql_query("SELECT distinct * FROM nuke_offerte_detail1 WHERE idcategoria ='$categorie[id]' and idofferta=$_GET[id]"));
		$a = $db->sql_fetchrow($db->sql_query("SELECT distinct * FROM nuke_offerte_detail1 WHERE idcategoria ='$categorie[id]' and idofferta=$_GET[id]"));
		OpenTable();
		echo "<p id=categoria$categorie[id]><a name=categoria$categorie[id]></a>";
		echo '<div id="into_albero" align=center>';
		echo "<table width=100% border=0 cellspacing=0 cellpadding=0>";
		echo "<td width=45% align=left>($categorie[ordine])&nbsp;$categorie[categoria]&nbsp;(<i>$categorie[category]</i>)";
		echo "<a href=gestionale.php?name=parametri&subname=entita&act=newitem&idcategoria=$categorie[id]&idpolizza=$row[field2]&idofferta=$_GET[id]#categoria$categorie[id]>";
		echo " <font size=1><u>- Inserisci nuovo item -</u></font>";
		echo "</a>";
		echo "</td>";
		if ($nra > 0) {$img='circle_green.png';$add='0';$remove='1';$trafficlight='green';}
		if ($nra == 0) {$img='circle_red.png';$add='1';$remove='0';$trafficlight='red';}
		echo "</td>";
		echo "<td align=center width=35%>";
		//if ($trafficlight=='green') {
			//echo "<input tabindex=$tabindex style='font-size:17px' size=6 type=text id=$tabindex value='$a[somma]'  onkeyup=javascript:query_now_dettagli_offerte_1($tabindex,event,'$categorie[id]','somma',this.value,$_GET[id],'')>";
			//$tabindex=$tabindex+1;
			//echo "<input tabindex=$tabindex style='font-size:17px' size=3 type=text id=$tabindex value='$a[tasso]' onkeyup=javascript:query_now_dettagli_offerte_1($tabindex,event,'$categorie[id]','tasso',this.value,$_GET[id],'')>";
			//$tabindex=$tabindex+1;
			//echo "<input tabindex=$tabindex style='font-size:17px' size=6 type=text id=$tabindex value='$a[premio]' onkeyup=javascript:query_now_dettagli_offerte_1($tabindex,event,'$categorie[id]','premio',this.value,$_GET[id],'') onchange=javascript:query_now_dettagli_offerte_1($tabindex,event,'$categorie[id]','premio',this.value,$_GET[id],'')>";
			//$tabindex=$tabindex+1;
			//echo "<input type=hidden name=idoffertedetail1 value=$a[id]>";
		//}
		echo "</td>";
		echo "<td width=20% align=center>";
		echo "<img src=immagini/$img>";
		if ($add=='1') {echo "<a href=# onClick=window.location='$_SERVER[PHP_SELF]?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&azioni=aggiungicat&idcategoria=$categorie[id]&scrolltop='+document.getElementById('offerte_detail_1').scrollTop;><img border=0 src=immagini/add.png></a>";}
		if ($add=='0') {echo "<img border=0 src=immagini/add_grey.png>";}
		if ($remove=='1') {echo "<a href=# onClick=window.location='$_SERVER[PHP_SELF]?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&azioni=eliminacat&idcategoria=$categorie[id]&scrolltop='+document.getElementById('offerte_detail_1').scrollTop;><img border=0 src=immagini/minus.png></a>";}
		if ($remove=='0') {echo "<img border=0 src=immagini/minus_grey.png>";}
		echo "</td></table>";
		echo "</div></p>";

		
		echo '<p><div id="into_albero" align=center>';
		echo "<table width=100% border=0 cellspacing=0 cellpadding=0>";
		$rs_nomi = $db->sql_query("SELECT * FROM nuke_entita WHERE field1='$categorie[id]' order by ordine");
		$nr_nomi = $db->sql_numrows($rs_nomi);
		while ($nomi = $db->sql_fetchrow($rs_nomi))
		{
			$rsb = $db->sql_query("SELECT * FROM nuke_offerte_detail1 WHERE idcategoria='$nomi[field1]' and identita='$nomi[id]' and idofferta='$_GET[id]' order by id");
			$nrb = $db->sql_numrows($rsb);
			if ($nrb==0)
			{
				$b = $db->sql_fetchrow($rsb);
				echo "<tr>";
				echo "<td width=5%></td>";
				echo "<td width=40% align=left>($nomi[ordine])&nbsp;".$nomi[field4]." (<i>".$nomi[field5]."</i>)";
				if ($nrb > 0) {$img='circle_green.png';$add='1';$remove='1';$trafficlight='green';echo "<br><input tabindex=$tabindex style='font-size:12px' size=50 type=text id=$tabindex value='$b[description]'  onkeydown=javascript:query_now($tabindex,event,'$nomi[field1]','description',this.value,$_GET[id],$b[id]);>";$tabindex++;}
				if ($nrb == 0) {$img='circle_red.png';$add='1';$remove='0';$trafficlight='red';}
				echo "</td>";
				echo "<td align=center width=35% valign=middle>&nbsp;";
				if ($trafficlight=='green') {
					echo "<input tabindex=$tabindex style='font-size:17px' size=6 type=text id=$tabindex value='$b[somma]'  onkeydown=".chr(34)."javascript:query_now($tabindex,event,'$nomi[field1]','somma',this.value,$_GET[id],$b[id]);".chr(34).">";
					$tabindex=$tabindex+1;
					echo "<input tabindex=$tabindex style='font-size:17px' size=3 type=text id=$tabindex value='$b[tasso]' onkeydown=".chr(34)."javascript:query_now($tabindex,event,'$nomi[field1]','tasso',this.value,$_GET[id],$b[id]);".chr(34).">";
					$tabindex=$tabindex+1;
					echo "<input tabindex=$tabindex style='font-size:17px' size=6 type=text id=$tabindex value='$b[premio]' onkeydown=".chr(34)."javascript:query_now($tabindex,event,'$nomi[field1]','premio',this.value,$_GET[id],$b[id]);".chr(34).">";
					$tabindex=$tabindex+1;
					echo "<input type=hidden name=idoffertedetail1 value=$b[id]>";
				}
				echo "</td>";
				echo "<td width=20% align=center>";
				echo "<img src=immagini/$img>";
				if ($add=='1') {echo "<a href=# onClick=window.location='$_SERVER[PHP_SELF]?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&azioni=aggiungiitem&identita=$nomi[id]&idcategoria=$categorie[id]&scrolltop='+document.getElementById('offerte_detail_1').scrollTop;><img border=0 src=immagini/add.png></a>";}
				if ($add=='0') {echo "<img border=0 src=immagini/add_grey.png>";}
				if ($remove=='1') {echo "<a href=# onClick=window.location='$_SERVER[PHP_SELF]?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&azioni=eliminaitem&idoffertedetail1=$b[id]&scrolltop='+document.getElementById('offerte_detail_1').scrollTop;><img border=0 src=immagini/minus.png></a>";}
				if ($remove=='0') {echo "<img border=0 src=immagini/minus_grey.png>";}
				echo "</td></tr>";
			}
			for ($h=0;$h<$nrb;$h++)
			{
				$b = $db->sql_fetchrow($rsb);
				echo "<tr>";
				echo "<td width=5%>&nbsp;</td>";
				echo "<td width=40% align=left valign=middle>";
				if ($h==0) echo "($nomi[ordine])&nbsp;".$nomi[field4]." (<i>".$nomi[field5]."</i>)";
				if ($nrb > 0) {$img='circle_green.png';$add='1';$remove='1';$trafficlight='green';echo "<br><input tabindex=$tabindex style='font-size:12px' size=50 type=text id=$tabindex value='$b[description]'  onkeydown=javascript:query_now($tabindex,event,'$nomi[field1]','description',this.value,$_GET[id],$b[id]);>";$tabindex++;}
				if ($nrb == 0) {$img='circle_red.png';$add='1';$remove='0';$trafficlight='red';}
				echo "</td>";
				echo "<td align=center width=35% valign=middle>&nbsp;";
				if ($trafficlight=='green') {
					echo "<input tabindex=$tabindex style='font-size:17px' size=6 type=text id=$tabindex value='$b[somma]'  onkeydown=".chr(34)."javascript:query_now($tabindex,event,'$nomi[field1]','somma',this.value,$_GET[id],$b[id]);".chr(34).">";
					$tabindex=$tabindex+1;
					echo "<input tabindex=$tabindex style='font-size:17px' size=3 type=text id=$tabindex value='$b[tasso]' onkeydown=".chr(34)."javascript:query_now($tabindex,event,'$nomi[field1]','tasso',this.value,$_GET[id],$b[id]);".chr(34).">";
					$tabindex=$tabindex+1;
					echo "<input tabindex=$tabindex style='font-size:17px' size=6 type=text id=$tabindex value='$b[premio]' onkeydown=".chr(34)."javascript:query_now($tabindex,event,'$nomi[field1]','premio',this.value,$_GET[id],$b[id]);".chr(34).">";
					$tabindex=$tabindex+1;
					echo "<input type=hidden name=idoffertedetail1 value=$b[id]>";
				}
				echo "</td>";
				echo "<td width=20% align=center>";
				echo "<img src=immagini/$img>";
				if ($add=='1') {echo "<a href=# onClick=window.location='$_SERVER[PHP_SELF]?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&azioni=aggiungiitem&identita=$nomi[id]&idcategoria=$categorie[id]&scrolltop='+document.getElementById('offerte_detail_1').scrollTop;><img border=0 src=immagini/add.png></a>";}
				if ($add=='0') {echo "<img border=0 src=immagini/add_grey.png>";}
				if ($remove=='1') {echo "<a href=# onClick=window.location='$_SERVER[PHP_SELF]?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&azioni=eliminaitem&idoffertedetail1=$b[id]&scrolltop='+document.getElementById('offerte_detail_1').scrollTop;><img border=0 src=immagini/minus.png></a>";}
				if ($remove=='0') {echo "<img border=0 src=immagini/minus_grey.png>";}
				echo "</td></tr>";
			}
			echo "<tr><td colspan=4><hr size=1></td></tr>";
		}
		echo "</table></div></p>";
		CloseTable();
	}
	CloseTable();
?>