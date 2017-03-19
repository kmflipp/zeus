<?php
$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$act = $_GET[act];
$id = $_GET[id];
$tablename = "nuke_entita";
$azioni_item=$_GET["azioni_item"];

if ($blocca==0) {
	if ($_GET[action]=='salva') {
		$_GET[valuea]=str_replace("'","&lsquo;",$_GET[valuea]);
		$sql = "update nuke_offerte_detail1 set $_GET[fielda]='$_GET[valuea]',$_GET[fieldb]='$_GET[valueb]',$_GET[fieldc]='$_GET[valuec]',$_GET[fieldd]='$_GET[valued]' where id=$_GET[idriga]";
		$db->sql_query($sql);
		header("Location: gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&view=editavanzato&scrolltop=$_GET[scrolltop]");
	}
	if ($_GET[action]=='salva_franchigia') {
		$sql = "UPDATE nuke_offerte_detail1 SET franchigia='$_GET[franchigia]' WHERE idcategoria ='$_GET[idcategoria]' and idofferta=$_GET[id]";
		$db->sql_query($sql);
		header("Location: gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&view=editavanzato&scrolltop=$_GET[scrolltop]");
	}
	if ($azioni_item=='aggiungiitem') {
			$sql = "INSERT INTO nuke_offerte_detail1 (idcategoria,identita,idofferta,ordine_c,ordine_e) VALUES ('$_GET[idcategoria]','$_GET[identita]','$_GET[id]','$_GET[ordine_c]','$_GET[ordine_e]')";
			$result = $db->sql_query($sql);
			if ($_GET[idcategoria]=='55') {
				if ($row[field2]=='18') { //All Risk
					$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id' AND field1='60'";
					$result = $db->sql_query($sql);			

					$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id' AND field1='100'";
					$result = $db->sql_query($sql);			
					$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('$id','100','CGA')";
					$result = $db->sql_query($sql);
				}
			}
			header("Location: gestionale.php?view=editavanzato&name=lloyds&subname=offerte&act=explode&id=$_GET[id]&idcategoria=$_GET[idcategoria]&scrolltop=$_GET[scrolltop]");
	}
	if ($azioni_item=='eliminaitem') {
			$sql = "DELETE FROM nuke_offerte_detail1 WHERE id = '$_GET[idoffertedetail1]'";
			$result = $db->sql_query($sql);	
			header("Location: gestionale.php?view=editavanzato&name=lloyds&subname=offerte&act=explode&id=$_GET[id]&scrolltop=$_GET[scrolltop]");
	}
	if ($azioni_item=='aggiungicat') {
			$sql = "SELECT * FROM nuke_entita WHERE field1='$_GET[idcategoria]'";
			$rs = $db->sql_query($sql);
			while ($row_addcat = $db->sql_fetchrow($rs))
			{
				$sql = "INSERT INTO nuke_offerte_detail1 (idcategoria,identita,idofferta) VALUES ('$_GET[idcategoria]','$row_addcat[id]','$_GET[id]')";
				$result = $db->sql_query($sql);	
			}
			header("Location: gestionale.php?view=editavanzato&name=lloyds&subname=offerte&act=explode&id=$_GET[id]&idcategoria=$_GET[idcategoria]&scrolltop=$_GET[scrolltop]");
	}
	if ($azioni_item=='eliminacat') {
			$sql = "SELECT * FROM nuke_entita WHERE field1='$_GET[idcategoria]'";
			$rs = $db->sql_query($sql);
			while ($row_elcat = $db->sql_fetchrow($rs))
			{
				$sql = "DELETE FROM nuke_offerte_detail1 WHERE identita = '$row_elcat[id]' and idofferta = '$_GET[id]'";
				$result = $db->sql_query($sql);	
			}
			header("Location: gestionale.php?view=editavanzato&name=lloyds&subname=offerte&act=explode&id=$_GET[id]&scrolltop=$_GET[scrolltop]");
	}
}
$disabled= "";
if ($blocca==1) $disabled= " disabled ";


//Visualizzazione ad albero
	OpenTable();
	$tabindex=1000;
	echo "<table width=100% border=0 cellspacing=0 cellpadding=0>
				<tr>
					<td width=20% align=center>&nbsp;</td>
					<td width=45% align=center><strong>Items</strong></td>
					<td width=35% align=center><strong>Sum/Stamp/Premium</strong><br>Currency $valuta</td>
				</tr>
				<tr><td colspan=2 align=center><br>";
				$rs_categorie = $db->sql_query("SELECT * FROM nuke_categorie WHERE idpolizza=$row[field2] order by ordine");
				echo "<select name=categorie id=categorie onChange=window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id&view=editavanzato&idcategoria='+this.value+'&scrolltop='+document.getElementById('offerte').scrollTop; style=width:150px;font-size:12px;><option></option>";
				while ($categorie = $db->sql_fetchrow($rs_categorie))
				{
					echo "<option value='$categorie[id]'>$categorie[categoria]</option>";
				}
				echo "</select>";
	echo "</td><td align=center><br>Select a category</td></tr>
				</table>";
	echo '<style type="text/css">';
	echo 'table.bottomBorder { border-collapse:collapse; }';
	echo 'table.bottomBorder td, table.bottomBorder th { border-bottom:1px dotted black;padding:5px; }';
	echo '</style>';

	$rs_categorie = $db->sql_query("SELECT * FROM nuke_categorie WHERE idpolizza=$row[field2] and (id='$_GET[idcategoria]' or id in (SELECT distinct idcategoria FROM nuke_offerte_detail1 WHERE idofferta=$_GET[id])) order by ordine");
	while ($categorie = $db->sql_fetchrow($rs_categorie))
	{
		$nra = $db->sql_numrows($db->sql_query("SELECT distinct * FROM nuke_offerte_detail1 WHERE idcategoria ='$categorie[id]' and idofferta=$_GET[id]"));
		$a = $db->sql_fetchrow($db->sql_query("SELECT distinct * FROM nuke_offerte_detail1 WHERE idcategoria ='$categorie[id]' and idofferta=$_GET[id]"));
		if ($nra > 0) {$checked=' checked ';}
		if ($nra == 0) {$checked='';}
		$disabled=' ';

		echo "<br><hr width=100% size=3 color=darkgreen>";
		echo "<table class=bottomBorder width=100% border=0 cellspacing=2 cellpadding=2>";

		echo "<tr>";
			echo "<td width=10% align=center>";
			?>
			<input type=checkbox <?php echo $checked; ?> onClick="if(this.checked){window.location='gestionale.php?view=editavanzato&name=lloyds&subname=offerte&act=explode&id=<?php echo $_GET[id]; ?>&azioni_item=aggiungicat&idcategoria=<?php echo $categorie[id]; ?>&scrolltop='+document.getElementById('offerte').scrollTop;}else{window.location='gestionale.php?view=editavanzato&name=lloyds&subname=offerte&act=explode&id=<?php echo $_GET[id]; ?>&azioni_item=eliminacat&idcategoria=<?php echo $categorie[id]; ?>&scrolltop='+document.getElementById('offerte').scrollTop;}">
			<?php
			echo "</td>";
			echo "<td width=10% align=center>";
			echo "</td>";
			echo "<td colspan=3 width=50% align=left>";
				echo "($categorie[ordine])&nbsp;".nl2br($categorie[categoria])."<br><i>".nl2br($categorie[category])."</i>)&nbsp;";
				if ($checked=='') $disabled=' disabled ';
				echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
				echo "<input $disabled tabindex=$tabindex style='font-size:12px' size=6 type=text id=$tabindex value='$a[franchigia]'>";
				echo "&nbsp;<input type=button value=Upd onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id&view=editavanzato&idcategoria=$categorie[id]&action=salva_franchigia&scrolltop='+document.getElementById('offerte').scrollTop+'&franchigia='+document.getElementById('$tabindex').value;>";
				echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
				echo "<a href=gestionale.php?name=parametri&subname=entita&act=newitem&idcategoria=$categorie[id]&idpolizza=$row[field2]&idofferta=$_GET[id]#categoria$categorie[id]><font size=1><u>- Insert new item -</u></font></a>";
			echo "</td>";
		echo "</tr>";
		$tabindex++;
		$rs_nomi = $db->sql_query("SELECT * FROM nuke_entita WHERE field1='$categorie[id]' order by ordine");
		$nr_nomi = $db->sql_numrows($rs_nomi);
		while ($nomi = $db->sql_fetchrow($rs_nomi))
		{
			$rsb = $db->sql_query("SELECT * FROM nuke_offerte_detail1 WHERE idcategoria='$nomi[field1]' and identita='$nomi[id]' and idofferta='$_GET[id]' order by id");
			$nrb = $db->sql_numrows($rsb);
			$checked=' checked ';
			$trafficlight='green';
			if ($nrb==0) {
				$b = $db->sql_fetchrow($rsb);
				$checked=' ';
				echo "<tr>";
					echo "<td width=10%>&nbsp;</td>";
					echo "<td width=10% align=left>";
						echo "<input type=checkbox $checked onClick=if(this.checked){window.location='$_SERVER[PHP_SELF]?view=editavanzato&name=lloyds&subname=offerte&act=explode&id=$_GET[id]&azioni_item=aggiungiitem&identita=$nomi[id]&idcategoria=$categorie[id]&ordine_e=$nomi[ordine]&ordine_c=$categorie[ordine]&scrolltop='+document.getElementById('offerte').scrollTop;}else{window.location='$_SERVER[PHP_SELF]?view=editavanzato&name=lloyds&subname=offerte&act=explode&id=$_GET[id]&azioni_item=eliminaitem&idoffertedetail1=$b[id]&scrolltop='+document.getElementById('offerte').scrollTop;};>";
					echo "</td>";
					echo "<td width=1% align=left>";
					echo "</td>";
					echo "<td width=49% align=left>";
						echo "($nomi[ordine])&nbsp;".nl2br($nomi[field4])."<br><i>".nl2br($nomi[field5])."</i>";
					echo "</td>";
					echo "<td align=center width=30% valign=middle>";
					echo "</td>";
				echo "</tr>";
			}
			for ($h=0;$h<$nrb;$h++)
			{
				$b = $db->sql_fetchrow($rsb);
				echo "<tr>";
					echo "<td width=10%>&nbsp;</td>";
					echo "<td width=10% align=left>";
						echo "<input type=checkbox $checked onClick=if(this.checked){window.location='$_SERVER[PHP_SELF]?view=editavanzato&name=lloyds&subname=offerte&act=explode&id=$_GET[id]&azioni_item=aggiungiitem&identita=$nomi[id]&ordine_e=$nomi[ordine]&idcategoria=$categorie[id]&ordine_c=$categorie[ordine]&scrolltop='+document.getElementById('offerte').scrollTop;}else{window.location='$_SERVER[PHP_SELF]?view=editavanzato&name=lloyds&subname=offerte&act=explode&id=$_GET[id]&azioni_item=eliminaitem&idoffertedetail1=$b[id]&scrolltop='+document.getElementById('offerte').scrollTop;};>";
						echo "<a href=# onClick=window.location='$_SERVER[PHP_SELF]?view=editavanzato&name=lloyds&subname=offerte&act=explode&id=$_GET[id]&azioni_item=aggiungiitem&identita=$nomi[id]&idcategoria=$categorie[id]&ordine_e=$nomi[ordine]&ordine_c=$categorie[ordine]&scrolltop='+document.getElementById('offerte').scrollTop;><img src=images/add_line.png border=0></a>";
					echo "</td>";
					echo "<td width=1% align=left>";
					echo "</td>";
					echo "<td width=49% align=left valign=middle>";
					echo "<form name=form$tabindex id=form$tabindex method=get action=gestionale.php>
								<input type=hidden name=name value=lloyds><input type=hidden name=subname value=offerte><input type=hidden name=act value=explode><input type=hidden name=view value=editavanzato>
								<input type=hidden name=action value=salva><input type=hidden name=fielda value=description><input type=hidden name=fieldb value=somma><input type=hidden name=fieldc value=tasso><input type=hidden name=fieldd value=premio>
								<input type=hidden name=id value=$_GET[id]>";
						$formid = "form$tabindex";
						if ($h==0) echo "($nomi[ordine])&nbsp;".nl2br($nomi[field4])."<br><i>".nl2br($nomi[field5])."</i>";
						if ($nrb > 0) {
							echo "<br>";
							$savedtabindex=$tabindex;
							echo "<textarea name=valuea tabindex=$tabindex $readonly style='font-size:12px' id=$tabindex rows=4 cols=60>$b[description]</textarea>";
							$tabindex++;
						}
						if ($nrb == 0) $checked='';
					echo "</td>";
					echo "<td align=right width=30% valign=bottom>";
						echo "<input name=valueb $disabled tabindex=$tabindex style='font-size:17px' size=8 type=text id=$tabindex value='$b[somma]'>";
						$tabindex=$tabindex+1;
						echo "<input name=valuec $disabled tabindex=$tabindex style='font-size:17px' size=4 type=text id=$tabindex value='$b[tasso]' onKeyUp=calcola('$tabindex');>";
						$tabindex=$tabindex+1;
						echo "<input name=valued $disabled tabindex=$tabindex style='font-size:17px' size=8 type=text id=$tabindex value='$b[premio]'>";
						$tabindex=$tabindex+1;
						echo "<input type=hidden name=idoffertedetail1 value=$b[id]>";
						echo "<input type=hidden name=idriga value=$b[id]>";
						$tabdescription = $tabindex-4;
						$tabsomma = $tabindex-3;
						$tabtasso = $tabindex-2;
						$tabpremio = $tabindex-1;
						echo "<br><input type=button name=update value=Update tabindex=$tabindex onClick=vai('$formid');>";
						$tabindex=$tabindex+1;
						echo "</form>";
					echo "</td>";
				echo "</tr>";
			}
			$sql = "SELECT * FROM nuke_offerte_detail1 WHERE idcategoria='$categorie[id]' and identita='9999' and idofferta='$_GET[id]' and ordine_e=$nomi[ordine]";
			$rsbr = $db->sql_query($sql);
			$nrbr = $db->sql_numrows($rsbr);
			$br = $db->sql_fetchrow($rsbr);
			echo "<tr>";
				$checked=' ';
				if ($nrbr!='') $checked=' checked ';
				echo "<td width=10%></td>";
				echo "<td width=10% align=left>";
					echo "<input type=checkbox $checked onClick=if(this.checked){window.location='$_SERVER[PHP_SELF]?view=editavanzato&name=lloyds&subname=offerte&act=explode&id=$_GET[id]&azioni_item=aggiungiitem&ordine_e=$nomi[ordine]&identita=9999&idcategoria=$categorie[id]&ordine_c=$categorie[ordine]&scrolltop='+document.getElementById('offerte').scrollTop;}else{window.location='$_SERVER[PHP_SELF]?view=editavanzato&name=lloyds&subname=offerte&act=explode&id=$_GET[id]&azioni_item=eliminaitem&idoffertedetail1=$br[id]&scrolltop='+document.getElementById('offerte').scrollTop;};>";
				echo "</td>";
				echo "<td width=1% align=left></td>";
				echo "<td width=49% align=left valign=middle>";
				if ($nrbr!='') {
					echo "<font color=red size=3><u><strong>PAGE BREAK INSERTED</strong></u></font>";
				}else{
					echo "<font color=black size=3><strong>INSERT PAGE BREAK</strong></font>";
				}
				echo "</td>";
				echo "<td align=right width=30% valign=bottom></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	CloseTable();
?>