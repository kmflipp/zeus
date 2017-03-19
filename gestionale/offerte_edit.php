<?php
if ($blocca==0 && $_GET[azioni_anagrafica]=='salva') {
		$_GET[value]=str_replace("'","&lsquo;",$_GET[value]);
		$sql = "update nuke_offerte set $_GET[field]='$_GET[value]' where id='$_GET[id]'";
		$db->sql_query($sql);
		header("Location: gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&view=editavanzato&scrolltop=$_GET[scrolltop]");
}
if ($blocca==0 && $_GET[azioni_infogenerali]=='salva') {
		$sql = "update nuke_offerte set $_GET[fielda]='$_GET[valuea]',$_GET[fieldb]='$_GET[valueb]',$_GET[fieldc]='$_GET[valuec]',$_GET[fieldd]='$_GET[valued]',$_GET[fielde]='$_GET[valuee]' where id=$_GET[id]";
		$db->sql_query($sql);
		header("Location: gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&view=editavanzato&scrolltop=$_GET[scrolltop]");
}
if ($blocca==0 && $_GET[azioni_cifre]=='salva') {
		$sql = "update nuke_offerte set $_GET[field]='$_GET[value]' where id='$_GET[id]'";
		$db->sql_query($sql);
		if ($_GET[field]=='field13') {
			//mi estrapolo la percentuale del bollo in base all'id
			$sql_bollo = "SELECT * FROM nuke_bolli where id=$_GET[value]";
			$rs_bollo = $db->sql_query($sql_bollo);
			$row_bollo = $db->sql_fetchrow($rs_bollo);

			$sql = "update nuke_offerte set field13='".str_replace("%","",$row_bollo[field2])."' where id='$_GET[id]'";
			$db->sql_query($sql);
			$sql = "update nuke_offerte set field13a='$_GET[value]' where id='$_GET[id]'";
			$db->sql_query($sql);
			
			// imposta la giurisdizione in base al paese e tipologia di polizza
			// Verifico il paese di attinenza della polizza
			$sql_bollo = "SELECT * FROM nuke_bolli where id='$_GET[value]'";
			$rs_bollo = $db->sql_query($sql_bollo);
			$nr_bollo = $db->sql_numrows($rs_bollo);
			$stato = $db->sql_fetchrow($rs_bollo);
			$paese = $stato[field1];

			if ($row[field2]=='21') { //Building & Content
				$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id' AND field1='25'";
				$result = $db->sql_query($sql);
				$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id' AND field1='71'";
				$result = $db->sql_query($sql);
				$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id' AND field1='70'";
				$result = $db->sql_query($sql);
				if ($paese=="Svizzera" || $paese=='') {
					$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','25','CONDIZIONE')";
					$result = $db->sql_query($sql);
				}
				if ($paese=="Francia") {
					$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','70','CONDIZIONE')";
					$result = $db->sql_query($sql);
				}
				if ($paese=="Italia") {
					$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','71','CONDIZIONE')";
					$result = $db->sql_query($sql);
				}
			}
		}
		header("Location: gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&view=editavanzato&scrolltop=$_GET[scrolltop]");
}
if ($blocca==0 && $_GET[azioni_cifre1]=='salva') {
		$sql = "update nuke_offerte set $_GET[fielda]='$_GET[valuea]',$_GET[fieldb]='$_GET[valueb]' where id=$_GET[id]";
		$db->sql_query($sql);
		header("Location: gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&view=editavanzato&scrolltop=$_GET[scrolltop]");
}

?>
<p><input type=button value='Synoptic 1 :: on/off' onClick="if(document.getElementById('sopra').style.display=='none'){document.getElementById('sopra').style.display='block';}else{document.getElementById('sopra').style.display='none';}"></p>
<div id=sopra>
<table width=100% border=1 bordercolor=darkblue cellspacing=0 cellpadding=5 bgcolor=#90AFF6>
	<tr>
		<td width=30% valign=top>
			<input type=button value='Registry :: on/off' onClick="if(document.getElementById('stipulante').style.display=='none'){document.getElementById('stipulante').style.display='block';}else{document.getElementById('stipulante').style.display='none';}">
			<div id=stipulante>
				<table border=1 width=100% cellspacing=0 cellpadding=5>
					<?php
					$trovato=0;
					$sql="SELECT * FROM nuke_offerte_ldr where idofferta='$row[id]'";
					$rsldr = $db->sql_query($sql);
					while ($rowldr = $db->sql_fetchrow($rsldr))
					{
						if (trim($rowldr[spedizione])=='1') {
							$indirizzo = str_replace("/n","<br>",$rowldr[value1]);
							if ($rowldr[value5]!='') $indirizzo .= "<br>".str_replace("/n","<br>",$rowldr[value5]);
							$cap = str_replace("/n","<br>",$rowldr[value2]);
							$citta = $rowldr[value3];
							$stato = $rowldr[value4];
							$trovato=1;
						}
					}
					$sql="SELECT * FROM [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.CLIENTI WHERE COD='$row[field3]'";
					$rscli = $db->sql_query($sql);
					$rowcli = $db->sql_fetchrow($rscli);
					echo "<tr>
						<td width=50% valign=top align=center><font face='Calibri' style=font-size:16px;>Holder<br>";
						if ($rowcli[SEX]=='G') {
							$testo1="$rowcli[COGNOME]";
						}else{
							$testo1="$rowcli[COGNOME] $rowcli[NOME]";
						}
						echo "<input size=15 type=text id=field3><input type=button value=Search onClick=query_now_field3('');><br>";
						echo "<select size=3 onChange=\"if(confirm('Warning, selecting this option, data about customer into thi offer will be deleted! Are you sure?')) location.href='gestionale.php?name=lloyds&subname=offerte&act=sav&id=$id&next=field4&field=field3&view=editavanzato&value='+this.value+'&scrolltop='+document.getElementById('offerte').scrollTop;\" style=font-size:12px;width:150px; id=field3_select name=field3><option value=''></option><option selected value='$row_customer[COD]'>$testo1</option></select><br>";
						if ($trovato==0) {
							echo $rowcli[INDIRIZZO]."<br>";
							echo $rowcli[CAP]." ".$rowcli[CITTA]."<br>".$rowcli[STATO]."<br>";
						}else{
							echo $indirizzo."<br>";
							echo $cap." ".$citta."<br>".$stato."<br>";
						}
						echo "</strong></font></td>
					";
					?>
					<?php
					$sql="SELECT * FROM [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.CLIENTI WHERE COD='$row[field4]'";
					$rscli = $db->sql_query($sql);
					$rowcli = $db->sql_fetchrow($rscli);
					echo "
						<td width=50% valign=top align=center><font face='Calibri' style=font-size:16px;>Assured<br>";
						if ($rowcli[SEX]=='G') {
							$testo1="$rowcli[COGNOME]";
						}else{
							$testo1="$rowcli[COGNOME] $rowcli[NOME]";
						}
						echo "<input size=15 type=text id=field4><input type=button value=Search onClick=query_now_field4('');><br>";
						echo "<select size=3 onChange=\"if(confirm('Warning, selecting this option, data about customer into thi offer will be deleted! Are you sure?')) location.href='gestionale.php?name=lloyds&subname=offerte&act=sav&id=$id&next=field5&field=field4&view=editavanzato&value='+this.value+'&scrolltop='+document.getElementById('offerte').scrollTop;\" style=font-size:12px;width:150px; id=field4_select name=field4><option value=''></option><option selected value='$row_customer[COD]'>$testo1</option></select><br>";
						echo $rowcli[INDIRIZZO]."<br>";
						echo $rowcli[CAP]." ".$rowcli[CITTA]." - ".$rowcli[STATO]."<br>";
						echo "</strong></font></td>
					</tr>";
					?>
					<?php
					echo "<tr>
						<td colspan=4 valign=top><i><font face='Calibri' size=3>Assured</font></i><br>
						<input type=text name=field5 id=field5 size=40 value='$row[field5]'>&nbsp;<input type=button name=Update value=Update onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&view=editavanzato&field=field5&azioni_anagrafica=salva&value='+document.getElementById('field5').value+'&scrolltop='+document.getElementById('offerte').scrollTop;>
						</td>
					</tr>";
					?>
				</table>
			</div>
			<hr size=2 color=darkgreen>
			
			<input type=button value='Places of risk and addresses :: on/off' onClick="if(document.getElementById('ldr').style.display=='none'){document.getElementById('ldr').style.display='block';}else{document.getElementById('ldr').style.display='none';}">
			<div id=ldr>
				<?php include('detail_luoghidirischio.php'); ?>
			</div>
		</td>
	
		<td width=30% valign=top>
			<input type=button value='General information on/off' onClick="if(document.getElementById('infogenerali').style.display=='none'){document.getElementById('infogenerali').style.display='block';}else{document.getElementById('infogenerali').style.display='none';}">
			<div id=infogenerali>	
				<table border="0" width="100%">
					<tr>
						<td valign=top><font face='Calibri' size=3 color=white></font></td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td valign=top><font face='Calibri' style="font-size:0.90em">Policy type<br></font></td>
						<td width=60%><font face="Calibri" style="font-size:0.90em">
						<?php
						$sql_polizze = "SELECT * FROM nuke_tipologiepolizze";
						$rs_polizze = $db->sql_query($sql_polizze);
						$nr_polizze = $db->sql_numrows($rs_polizze);
						?>
						<select name=field2 onChange="if(confirm('Changing policy type will delete all insured items previusly inserted into this offer. Are you sure?')) {window.location='gestionale.php?name=lloyds&subname=offerte&act=sav&view=editavanzato&field=field2&next=field7&id=<?php echo $id; ?>&value='+this.value+'&scrolltop='+document.getElementById('offerte').scrollTop;}else{window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&id=<?php echo $id; ?>&view=editavanzato&scrolltop='+document.getElementById('offerte').scrollTop;}"><option></option>
						<?php
						while ($polizze = $db->sql_fetchrow($rs_polizze)) {
							if ($polizze[id]==$row[field2]) $selected=' selected ';
							echo "<option $selected value=$polizze[id]>$polizze[field2]</option>";
							$selected="";
						}
						echo "</select>";
						?>
						</center></font></td>
					</tr>
					<tr>
						<td valign=top><font face='Calibri' size=3 color=white></font></td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td valign=top><font face="Calibri" style="font-size:0.90em">Contract start</font></td>
						<td width=60%><font face="Calibri" style="font-size:0.90em">
						<?php echo "<strong>From&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To</strong><br>
												<input type=text style=text-align:center; name=field6 id=field6 value='$row[field6]'>&nbsp;&nbsp;&nbsp;&nbsp;<input type=text style=text-align:center; name=field10 id=field10 value='$row[field10]'>
												";
						?>
						</font></td>
					</tr>
					<tr>
						<td valign=top><font face='Calibri' size=3 color=white></font></td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td><font face="Calibri" style="font-size:0.90em">Contract end</font></td>
						<td width=60%><font face="Calibri" style="font-size:0.90em">
						<?php echo $row[field10];?></center></font></td>
					</tr>
					<tr>
						<td valign=top><font face='Calibri' size=3 color=white></font></td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td><font face="Calibri" style="font-size:0.90em">Proposal date</font></td>
						<td width=60%>
						<input type=text style=text-align:center; name=data id=data value='<?php echo $row[data]; ?>'>
						</td>
					</tr>
					<tr>
						<td valign=top><font face='Calibri' size=3 color=white></font></td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td><font face="Calibri" style="font-size:0.90em">Renewal clause</font></td>
						<td width=60%><font face="Calibri" style="font-size:0.90em">
						<?php 
							if ($row[rinnovo]=='1') {
								if ($row[idpadre]=='') {
									if ($row[field14]=='5') $enneyears='3';
									if ($row[field14]=='10') $enneyears='5';
									if ($row[field14]<'8') $enneyears='3';
									if ($row[field14]>'8') $enneyears='5';
									if ($enneyears=='3') $unitldate=strtotime('+3 years',strtotime($row[field6]));
									if ($enneyears=='5') $unitldate=strtotime('+5 years',strtotime($row[field6]));
									$anno_rinnovo=date("Y",$unitldate);
									if ($row[anno_rinnovo]!='') $anno_rinnovo=$row[anno_rinnovo];
									$checked = " checked ";
									$testo_scadenza="Deadline <input type=text size=4 name=anno_rinnovo id=anno_rinnovo value='$anno_rinnovo'>";
							}else{
									$sql_idpadre="SELECT * FROM nuke_offerte where id='$row[idpadre]'";
									$rs_idpadre = $db->sql_query($sql_idpadre);
									$row_idpadre = $db->sql_fetchrow($rs_idpadre);
									if ($row_idpadre[field14]=='5') $enneyears='3';
									if ($row_idpadre[field14]=='10') $enneyears='5';
									if ($row_idpadre[field14]<'8') $enneyears='3';
									if ($row_idpadre[field14]>'8') $enneyears='5';
									if ($enneyears=='3') $unitldate=strtotime('+3 years',strtotime($row_idpadre[field6]));
									if ($enneyears=='5') $unitldate=strtotime('+5 years',strtotime($row_idpadre[field6]));
									$anno_rinnovo=date("Y",$unitldate);
									if ($row[anno_rinnovo]!='') $anno_rinnovo=$row[anno_rinnovo];
									$checked = " checked ";
									$testo_scadenza="Deadline <input type=text size=4 name=anno_rinnovo id=anno_rinnovo value='$anno_rinnovo'>";
								}
							}else{
								$checked = "  ";
								$testo_scadenza="<input type=hidden name=anno_rinnovo id=anno_rinnovo value=''>";
							}
							echo "<input $checked type=checkbox id=rinnovo name=rinnovo onClick=rinnovi('$id','editavanzato',document.getElementById('offerte').scrollTop);>$testo_scadenza</font><br>";
						?>
						</center></font></td>
					</tr>
					<tr>
						<td valign=top><font face='Calibri' size=3 color=white></font></td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td><font face="Calibri" style="font-size:0.90em">Covered days</font></td>
						<td width=60%><font face="Calibri" style="font-size:0.90em">
						<?php echo number_format($row[field11],0,".","'");?></center></font></td>
					</tr>
					<tr>
						<td valign=top><font face='Calibri' size=3 color=white></font></td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td valign=top><font face="Calibri" style="font-size:0.90em"><strong>Territorial limits</strong></font></td>
						<td width=60%><font face="Calibri" style="font-size:0.90em">
						<?php
						$sql_limititerritoriali = "SELECT * FROM nuke_limititerritoriali";
						$rs_limititerritoriali = $db->sql_query($sql_limititerritoriali);
						$nr_limititerritoriali = $db->sql_numrows($rs_limititerritoriali);
						echo "<select name=field7 style=width:140px; onChange=window.location='gestionale.php?name=lloyds&subname=offerte&act=sav&next=field17&field=field7&id=$id&value='+this.value+'&view=editavanzato&scrolltop='+document.getElementById('offerte').scrollTop;>";
						while ($limititerritoriali = $db->sql_fetchrow($rs_limititerritoriali)) {
							if ($limititerritoriali[id]==$row[field7]) $selected=' selected ';
							echo "<option $selected value=$limititerritoriali[id]>$limititerritoriali[field2]</option>";
							$selected="";
						}
						echo "</select><br><input $readonly style='text-align:center' size=20 type=text id=field17 name=field17 value='$row[field17]'>";
						?>
						</td>
					</tr>
					<tr>
						<td valign=top><font face='Calibri' size=3 color=white></font></td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td><font face="Calibri" style="font-size:0.90em"><strong>State</font></td>
						<td><font face="Calibri" style="font-size:0.90em">
						<?php
						echo "<select $disabled id=3004 tabindex=3004 onChange=window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&azioni_cifre=salva&field=field13&id=$id&value='+this.value+'&view=editavanzato&scrolltop='+document.getElementById('offerte').scrollTop;>";
						echo "<option value=''></option>";
						$rs_tassi = $db->sql_query("SELECT * FROM nuke_bolli where idtipopolizza='$row[field2]'");
						while ($row_tassi = $db->sql_fetchrow($rs_tassi))
						{
							$selected=" ";
							if ($row_tassi[id]==$row[field13a]) {$selected=" SELECTED ";$stato=$row_tassi[field1];}
							echo "<option".$selected." value=".$row_tassi[id].">$row_tassi[field1]</option>";
							$selected=" ";
						}
						echo "</select>";
						?>
						</font></td>
					</tr>
					<tr>
						<td colspan=99 align=right><input type=button name=Update value=Update onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&id=<?php echo $_GET[id]; ?>&view=editavanzato&fielda=field6&fieldb=field10&fieldc=anno_rinnovo&fieldd=field17&fielde=data&azioni_infogenerali=salva&valuea='+document.getElementById('field6').value+'&valueb='+document.getElementById('field10').value+'&valuec='+document.getElementById('anno_rinnovo').value+'&valued='+document.getElementById('field17').value+'&valuee='+document.getElementById('data').value+'&scrolltop='+document.getElementById('offerte').scrollTop;></td>
					</tr>
				</table>
			</div>
			<hr size=2 color=darkgreen>
			
			<input type=button value='General Terms (CGA) :: on/off' onClick="if(document.getElementById('cga').style.display=='none'){document.getElementById('cga').style.display='block';}else{document.getElementById('cga').style.display='none';}">
			<div id=cga>
				<?php include('dettagli_offerte_cga.php'); ?>
			</div>
			<hr size=2 color=darkgreen>
			
			<input type=button value='Questionnaire :: on/off' onClick="if(document.getElementById('quest').style.display=='none'){document.getElementById('quest').style.display='block';}else{document.getElementById('quest').style.display='none';}">
			<div id=quest>
				<?php include('dettagli_offerte_2.php'); ?>
			</div>
		</td>
	
		<td width=30% valign=top align=center>
			<table border="0" width="95%">
				<tr>
					<td colspan=4 align=center><font face="Calibri" style="font-size:0.90em"><strong>Summary</strong></font></td>
				</tr>
				<tr>
					<td width=30% align=left><font face="Calibri" style="font-size:0.90em"><strong>Currency</strong></font></td>
					<td width=40%><font face="Calibri" style="font-size:0.90em"></td>
					<td width=30% align=right><font face="Calibri" style="font-size:0.90em">
						<?php
						echo "<select name=valuta style=width:70px; onChange=window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&azioni_anagrafica=salva&field=valuta&id=$id&value='+this.value+'&view=editavanzato&scrolltop='+document.getElementById('offerte').scrollTop;>";
						echo "<option ";if($row[valuta]=='CHF') echo " selected ";echo " value='CHF'>CHF</option>";
						echo "<option ";if($row[valuta]=='EUR') echo " selected ";echo " value='EUR'>EUR</option>";
						echo "<option ";if($row[valuta]=='USD') echo " selected ";echo " value='USD'>USD</option>";
						echo "<option ";if($row[valuta]=='GBP') echo " selected ";echo " value='GBP'>GBP</option>";
						echo "</select>";
						?>
					</td>
				</tr>
				<tr>
					<td><font face="Calibri" style="font-size:0.90em"><strong><u>Sum insured</u></strong></font></td>
					<td><font face="Calibri" style="font-size:0.90em"></font></td>
					<td align=right><font face="Calibri" style="font-size:0.90em"><strong><?php echo number_format(round($row[field8]*20)/20,"2",".","'"); ?></strong></font></td>
				</tr>
				<tr>
					<td><font face="Calibri" style="font-size:0.90em">Annual premium</font></td>
					<td><font face="Calibri" style="font-size:0.90em"></font></td>
					<td align=right><font face="Calibri" style="font-size:0.90em"><?php echo number_format(round($row[field12]*20)/20,"2",".","'"); ?></font></td>
				</tr>
				<tr>
					<td><font face="Calibri" style="font-size:0.90em">Discount</font></td>
					<td><font face="Calibri" style="font-size:0.90em">
					<?php
					$selected5=' ';
					$selected10=' ';
					if ($row[field14]=='5') $selected5=' selected ';
					if ($row[field14]=='10') $selected10=' selected ';
					echo "<select $disabled id=seleziona onChange=document.getElementById(3005).value=this.value;window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&azioni_cifre=salva&field=field14&id=$id&value='+this.value+'&view=editavanzato&scrolltop='+document.getElementById('offerte').scrollTop;><option selected value=''></option><option $selected5 value='5'>3 anni</option><option $selected10 value='10'>5 anni</option></select>";
					echo "&nbsp;<input $disabled type=text style=text-align:right; size=3 id=3005 tabindex=3005 value='$row[field14]'>%&nbsp;<input type=button value=Upd onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&azioni_cifre=salva&field=field14&id=$id&value='+document.getElementById('3005').value+'&view=editavanzato&scrolltop='+document.getElementById('offerte').scrollTop;>";
					?>
					</font></td>
					<td align=right><font face="Calibri" style="font-size:0.90em"><?php
						$risultato = $row[field12]*$row[field14]/100;
						$prezzo_ribassato = $row[field12]-($row[field12]*$row[field14]/100);
						echo number_format(round($risultato*20)/20,"2",".","'");
						?>
						</font></td>
				</tr>
				<tr>
					<td><font face="Calibri" style="font-size:0.90em">Stamp</font></td>
					<td><font face="Calibri" style="font-size:0.90em">
					<?php
					echo "<select $disabled id=3004 tabindex=3004 onChange=window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&azioni_cifre=salva&field=field13&id=$id&value='+this.value+'&view=editavanzato&scrolltop='+document.getElementById('offerte').scrollTop;>";
					echo "<option value=''></option>";
					$rs_tassi = $db->sql_query("SELECT * FROM nuke_bolli  where idtipopolizza='$row[field2]'");
					while ($row_tassi = $db->sql_fetchrow($rs_tassi))
					{
						$selected=" ";
						if ($row_tassi[id]==$row[field13a]) {$selected=" SELECTED ";$stato=$row_tassi[field1];}
						echo "<option $selected value='$row_tassi[id]'>$row_tassi[field2] $row_tassi[field1]</option>";
						$selected=" ";
					}
					echo "</select> $stato";
					?>
					</font></td>
					<td align=right><font face="Calibri" style="font-size:0.90em"><?php
						$pippo = str_replace(",",".",$row[field13]);	
						$risultato = $prezzo_ribassato*$pippo/100;
						echo number_format(round($risultato*20)/20,"2",".","'");
						?></font></td>
				</tr>
				<tr>
					<td><font face="Calibri" style="font-size:0.90em"><?php if ($row[field11]==366 || $row[field11]==365)  echo "<strong>"; ?>Total annual premium</strong></font></td>
					<td><font face="Calibri" style="font-size:0.90em"></font></td>
					<td align=right><font face="Calibri" style="font-size:0.90em"><?php if ($row[rimborso]==''){ if ($row[field11]<366)  echo "<strong>";} ?> <?php echo number_format(round($row[field15]*20)/20,"2",".","'"); ?></strong></font></td>
				</tr>
					<tr>
						<td><font face="Calibri" style="font-size:0.90em">Refund / Drawback<br><?php echo "<input type=text size=20 id=etichetta name=etichetta value='".trim($row[etichetta])."'>"; ?></font></td>
						<td valign=bottom align=right><font face="Calibri" style="font-size:0.90em"><?php echo "<input type=text size=20 name=rimborso id=rimborso value='".trim($row[rimborso])."'>"; ?></font></td>
						<td valign=bottom align=right><font face="Calibri" style="font-size:0.90em"><?php echo "<input type=button value=Update onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&azioni_cifre1=salva&fielda=etichetta&fieldb=rimborso&id=$id&valuea='+document.getElementById('etichetta').value+'&valueb='+document.getElementById('rimborso').value+'&view=editavanzato&scrolltop='+document.getElementById('offerte').scrollTop;>"; ?></font></td>
					</tr>
				<?php 
						// mi salvo field12 e 15
						$true_field15 = $row[field15];
						$true_field12 = $row[field12];
						// sottraggo il rimborso
						$row[field15] = floatval($row[field15]) + floatval(trim($row[rimborso]));
						//scorporo il bollo
						$pippo = str_replace(",",".",$row[field13]);
						$row[field12] = $row[field15]/(1+($pippo/100));
						// scorporto da field12 lo sconto per calcolare il prorata senza scontarlo due volte
						if ($row[field14]!='') $row[field12]=$row[field12]/(100-$row[field14])*100;
				?>
				<tr>
					<td><font face="Calibri" style="font-size:0.90em">Minimum premium<br></font></td>
					<td valign=bottom align=right><font face="Calibri" style="font-size:0.90em"><?php echo "<input type=text size=20 name=premiominimo id=premiominimo value='".trim($row[premiominimo])."'>"; ?></font></td>
					<td valign=bottom align=right><font face="Calibri" style="font-size:0.90em"><?php echo "<input type=button value=Update onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&azioni_cifre=salva&field=premiominimo&id=$id&value='+document.getElementById('premiominimo').value+'&view=editavanzato&scrolltop='+document.getElementById('offerte').scrollTop;>"; ?></font></td>
				</tr>
				<tr>
					<td colspan=4><hr></td>
				</tr>
				<?php if ($row[field11]==366 || $row[field11]==365)  { ?>
					<tr>
						<td><font face="Calibri" size=2>&nbsp;</font></td>
						<td><font face="Calibri" size=2>&nbsp;</font></td>
						<td><font face="Calibri" size=2>&nbsp;</font></td>
					</tr>
					<tr>
						<td><font face="Calibri" size=2>&nbsp;</font></td>
						<td><font face="Calibri" size=2>&nbsp;</font></td>
						<td><font face="Calibri" size=2>&nbsp;</font></td>
					</tr>
					<tr>
						<td><font face="Calibri" size=2>&nbsp;</font></td>
						<td><font face="Calibri" size=2>&nbsp;</font></td>
						<td><font face="Calibri" size=2>&nbsp;</font></td>
					</tr>
					<tr>
						<td><font face="Calibri" size=2>&nbsp;</font></td>
						<td><font face="Calibri" size=2>&nbsp;</font></td>
						<td><font face="Calibri" size=2>&nbsp;</font></td>
					</tr>
					<tr>
						<td colspan=4><font size=2>&nbsp;</font></td>
					</tr>
					<tr>
						<td><font face="Calibri" size=2>&nbsp;</font></td>
						<td><font face="Calibri" size=2>&nbsp;</font></td>
						<td><font face="Calibri" size=2>&nbsp;</font></td>
					</tr>
					<tr>
						<td><font face="Calibri" size=2>&nbsp;</font></td>
						<td><font face="Calibri" size=2>&nbsp;</font></td>
						<td><font face="Calibri" size=2>&nbsp;</font></td>
					</tr>
				<?php } else { 
				?>
					<tr>
						<td><font face="Calibri" style="font-size:0.90em">Prorata days</font></td>
						<td><font face="Calibri" style="font-size:0.90em"></font></td>
						<td align=left><font face="Calibri" style="font-size:0.90em"><?php echo round($row[field11]); ?></font></td>
					</tr>
					<tr>
						<td><font face="Calibri" style="font-size:0.90em">Prorata premium</font></td>
						<td><font face="Calibri" style="font-size:0.90em"></font></td>
						<td align=right><font face="Calibri" style="font-size:0.90em"><?php	echo number_format(round($row[field12]/365*round($row[field11])*20)/20,2,".","'"); ?></font></td>
					</tr>
					<tr>
						<td><font face="Calibri" style="font-size:0.90em">Minimum premium</font></td>
						<td><font face="Calibri" style="font-size:0.90em"></font></td>
						<td align=right><font face="Calibri" style="font-size:0.90em"><?php echo number_format(round($row[premiominimo]*20)/20,2,".","'"); ?></font></td>
					</tr>
					<?php
					if ($row[field14]!='') {
					?>
					<tr>
						<td><font face="Calibri" style="font-size:0.90em">Discount &nbsp;&nbsp;&nbsp;<?php echo "($row[field14]%)"; ?></font></td>
						<td><font face="Calibri" style="font-size:0.90em"></font></td>
						<td align=right><font face="Calibri" style="font-size:0.90em"><?php
							$risultato = ($row[field12]/365*$row[field11])*$row[field14]/100;
							$prezzo_ribassato = ($row[field12]/365*round($row[field11]))-(($row[field12]/365*round($row[field11]))*$row[field14]/100);
							echo number_format(round($risultato*20)/20,"2",".","'");
							?>
							</font></td>
					</tr>
					<?php
					}else{
					?>
					<tr>
						<td><font face="Calibri" style="font-size:0.90em">&nbsp;</font></td>
						<td><font face="Calibri" style="font-size:0.90em">&nbsp;</font></td>
						<td align=right><font face="Calibri" style="font-size:0.90em"><?php
							$risultato = ($row[field12]/365*$row[field11])*$row[field14]/100;
							$prezzo_ribassato = ($row[field12]/365*round($row[field11]))-(($row[field12]/365*round($row[field11]))*$row[field14]/100);
							echo "&nbsp;";
							?>
							</font></td>
					</tr>
					<?php
					}
					?>
					<?php
						if ($row[premiominimo]!='') {
							$prezzo_ribassato=$row[premiominimo];
						}
					?>
					<tr>
						<td><font face="Calibri" style="font-size:0.90em">Stamp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "($row[field13]%)"; ?></font></td>
					<td><font face="Calibri" style="font-size:0.90em"></font></td>
						<td align=right><font face="Calibri" style="font-size:0.90em"><?php
							$pippo = str_replace(",",".",$row[field13]);
							$risultato = $prezzo_ribassato*$pippo/100;
							$prezzo_totale = $prezzo_ribassato+$risultato;
							echo number_format(round($risultato*20)/20,"2",".","'");
							?></font></td>
					</tr>
					<tr>
						<td><font face="Calibri" style="font-size:0.90em"><?php echo "<strong>"; ?>Total net premium</strong></font></td>
						<td><font face="Calibri" style="font-size:0.90em"></font></td>
						<td align=right><b><font face="Calibri" style="font-size:0.90em"><?php echo "<strong>"; echo number_format(round($prezzo_totale*20)/20,"2",".","'")."</strong>"; ?></font></b></td>
					</tr>
				<?php }  ?>
				<tr>
					<td><font face="Calibri" style="font-size:0.90em"><strong>Total to pay</strong></font></td>
					<td><font face="Calibri" style="font-size:0.90em"></font></td>
					<?php if ($prezzo_totale=='') $prezzo_totale=$row[field15]; ?>
					<td align=right><font face="Calibri" style="font-size:0.90em"><?php echo "<strong>".number_format(round($prezzo_totale*20)/20,"2",".","'"); ?></font></td>
				</tr>
				<tr>
					<td colspan=4><hr></td>
				</tr>
				<tr>
					<td><font face="Calibri" style="font-size:0.90em">Deadline</font></td>
					<td><font face="Calibri" style="font-size:0.90em"></font></td>
					<td align=right><font face="Calibri" style="font-size:0.90em"><?php echo $row[field10]; ?></font></td>
				</tr>
				<tr>
					<td><font face="Calibri" style="font-size:0.90em">Payment</font></td>
					<td><font face="Calibri" style="font-size:0.90em"></font></td>
					<td align=right><font face="Calibri" style="font-size:0.90em">Annual</font></td>
				</tr>
				<tr>
					<td colspan=4><hr></td>
				</tr>
				<tr>
					<td valign=top><font face="Calibri" style="font-size:0.90em">Excess</font></td>
					<td colspan=2 align=center><font face="Calibri" style="font-size:0.90em">
						<form name=47 id=47 method=get action=gestionale.php>
							<input type=hidden name=name value=lloyds><input type=hidden name=subname value=offerte><input type=hidden name=act value=explode><input type=hidden name=view value=editavanzato><input type=hidden name=azioni_anagrafica value=salva><input type=hidden name=field value=franchigia>
							<input type=hidden name=id value=<?php echo $_GET[id]; ?>>
							<textarea $readonly name=value id=franchigia rows=5 cols=55><?php echo $row[franchigia]; ?></textarea><input type=submit name=submit value=Update>
						</form>
					</font></td>
				</tr>
				<?php
				if ($row[field2]=='19') {
				?>
				<tr>
					<td valign=top><font face="Calibri" style="font-size:0.90em">TTD Illness of any kind: excluded weeks</font></td>
					<td colspan=2 align=center><font face="Calibri" style="font-size:0.90em">
						<form name=47 id=47 method=get action=gestionale.php>
							<input type=hidden name=name value=lloyds><input type=hidden name=subname value=offerte><input type=hidden name=act value=explode><input type=hidden name=view value=editavanzato><input type=hidden name=azioni_anagrafica value=salva><input type=hidden name=field value=weeks>
							<input type=hidden name=id value=<?php echo $_GET[id]; ?>>
							<select name=value id=weeks>
							<?php
							if ($row[weeks]=='') $row[weeks]='4';
							for ($xn=1;$xn<104;$xn++) {
								if ($row[weeks]==$xn) $selected = ' selected ';
								echo "<option $selected value='$xn'>$xn</option>";
								$selected = '';
							}
							?>
						</select>&nbsp;<input type=submit name=submit value=Update>
						</form>
					</font></td>
				</tr>
				<?php
				}
				?>
				<tr>
					<td colspan=4><hr></td>
				</tr>
				<tr>
					<td valign=top><font face="Calibri" style="font-size:0.90em">Note</font></td>
					<td colspan=2 align=center>
						<form name=74 id=74 method=get action=gestionale.php>
							<input type=hidden name=name value=lloyds><input type=hidden name=subname value=offerte><input type=hidden name=act value=explode><input type=hidden name=view value=editavanzato><input type=hidden name=azioni_anagrafica value=salva><input type=hidden name=field value=note>
							<input type=hidden name=id value=<?php echo $_GET[id]; ?>>
							<textarea $readonly name=value id=note rows=5 cols=55><?php echo $row[note]; ?></textarea><input type=submit name=submit value=Update>
						</form>
					</font></td>
				</tr>
			</table>
		</td>
	</tr>
</table></div>

<p><input type=button value='Synoptic 2 :: on/off' onClick="if(document.getElementById('sotto').style.display=='none'){document.getElementById('sotto').style.display='block';}else{document.getElementById('sotto').style.display='none';}"></p>
<div id=sotto>
<table width=100% border=1 bordercolor=darkblue cellspacing=0 cellpadding=5 bgcolor=#90AFF6>
	<tr>
		<td valign=top width=45%>
			<?php include("dettagli_offerte_condizioni.php"); ?>
		</td>
		<td valign=top width=55%>
			<?php
				if ($row[field2]=='19') {
					include('dettagli_offerte_persone.php');
				}else{
					include("dettagli_offerte_1.php"); 
				}
			?>
		</td>
	</tr>
</table>
</div>