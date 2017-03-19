<div class="offerte" id="offerte" style="position:relative;_position:relative;height:100%;overflow:auto;padding:0px;">
<?php
$id = $_GET[id];

$margintop = '100';
if ($pippo=='1') $margintop = '680';
OpenTable();
echo '<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen><td>';
echo "<input type=button value='Exit' onclick=location.href='gestionale.php?name=lloyds' style=font-family: Verdana; font-size: 10px;>";
echo '</td></table>';
CloseTable();

OpenTable();
	$anno = $_GET[anno];
	if ($anno=='') $anno='13';
	$sql = "SELECT * FROM nuke_polizze where field6 like '%$anno' order by field6 DESC";
	$rs = $db->sql_query($sql);
	$nr = $db->sql_numrows($rs);

	echo "<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen>";
	echo "<tr>";
	echo "<th width=10%><font face=verdana size=2>Payment deadline</th>";
	echo "<th width=20%><font face=verdana size=2>Customer</th>";
	echo "<th width=10%><font face=verdana size=2>Policy number</th>";
	echo "<th width=10%><font face=verdana size=2>Type</th>";
	echo "<th width=10%><font face=verdana size=2>Currency</th>";
	echo "<th width=15%><font face=verdana size=2>Premium</th>";
	echo "<th width=15%><font face=verdana size=2>Discount</th>";
	echo "<th width=10%><font face=verdana size=2>Stamp</th>";
	echo "<th width=10%><font face=verdana size=2>Net premium</th>";
	echo "</tr>";

	if ($nr != 0){
		while ($row = $db->sql_fetchrow($rs))
		{
			$annorecordprecedente = $annoscadenza;
			$annoscadenza=date("Y",strtotime($row[field10]));
			$annopartenza=date("Y",strtotime($row[field6]));
			if ($annorecordprecedente!=$annoscadenza) {
				echo "<tr>";
					echo "<td colspan=9><font face=calibri style=font-size:13px;color:$color><strong>Polizze $annopartenza/$annoscadenza</td>";
				echo "</tr>";
				$tipologia='';
			}
			$sql="SELECT * FROM nuke_clienti_polizze WHERE id='$row[field3]'";
			$recordset = $db->sql_query($sql);
			$riga=$db->sql_fetchrow($recordset); 
			$premio_lordo = ($row[field12]/365)*round($row[field11]);
			$ribasso = $premio_lordo/100*$row[field14];
			$prezzo_ribassato = $premio_lordo-$ribasso;
			$bollo = $prezzo_ribassato/100*$row[field13];
			$premio_netto = $prezzo_ribassato+$bollo;
			
			$sql_titoli = "
											SELECT     DATA,DTSCA,TIPO, NRTIT, NRPOL, NRIC, NRPN, CLIE, POSIZ, COMP, AGE, DIV, CAMBIO, TLORDO, TDIVLORDO, LORDO, DIVLORDO, TPERCTAX, PERCTAX, TTASSE, 
                      TDIVTASSE, TASSE, DIVTASSE, TIMPONIB, TDIVIMPON, IMPONIB, DIVIMPON, TACCESS, TDIVACCESS, ACCESS, DIVACCESS, TQUOTA, PROVV, TNETTO, TDIVNETTO, 
                      NETTO, DIVNETTO, REGOLAZ, TCAUZIONE, PERCCAU, VIN, MIP, COMMERC, PRODPROVV, RETE, CEV, UTENTE, DTAGG, ANTICI, ASSE, BANCA, LINEA, GEDI, NDIC, 
                      NDOC, NOTA, STATUS, PAGATO, TIT, TITSN, TLOY, AVVI, DOCCLI, DCOMP, DTMOR, DIFF, DIVDIFF, IMPT, DIVIMPT, TIMPT, TDIVIMPT, PATTIVE, DIVPATTIVE, 
                      [TRAN], TECNO, PERCACC, PRVKASKO, DIVKASKO, IMPKASKO, PRVPKASKO, DIVPKASKO, IMPPKASKO, PASCOGE, DTLASTR, TRE, DTPAGCMP, DTINCPRV, DTEFFETT, 
                      PASSIVE, DIVPASSIVE, LordoRC, TasseRC, CourtageRC, LordoCParz, TasseCParz, CourtageCParz, LordoCTot, TasseCTot, CourtageCTot, LordoInfo, TasseInfo, 
                      CourtageInfo, LordoCGrave, TasseCGrave, CourtageCGrave, ContrUffNazAss, PagRateale, TotPagato, CambioPagamento, ContoTemp, PagatoProd, DataPagProd, 
                      TotPagatoProd, CampoVuotoPerPagamento
											FROM         [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.TITOLI
											WHERE     (CLIE = '$row[field3]') AND (NRPOL IN
                      (SELECT     NRPOL
                        FROM          [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.POLIZZE
                        WHERE      (NRCONTR = '".str_replace("EUROPLEX N. B072/BB011440C/","",$row[numeropolizza])."')))";
      $rs_titoli = $db->sql_query1($sql_titoli);
      $nr_titoli = $db->sql_numrows($rs_titoli);
			
			echo '<tr>';
			echo "<td valign=middle align=center><font face=verdana size=2><strong>".date("F Y",strtotime($row[field6]))."</strong></td>";
			echo "<td valign=middle align=center><font face=verdana size=2>$riga[id] $riga[cognome] $riga[nome]</td>";
			echo "<td valign=middle align=center><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=polizze&act=explode&idpolizza=$row[idpolizza]>".str_replace("EUROPLEX N. B072/BB011440C/","",$row[numeropolizza])."</a></td>";
			echo "<td valign=middle align=center><font face=verdana size=2>$row[field2]</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>$row[valuta]</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>";
			if (round($row[field11])=='365' or round($row[field11])=='366') {
				echo "On gg ".round($row[field11])."<br>".number_format((round($premio_lordo*20)/20),2,".",chr(180))."</td>";
			}else{
				echo "<table width=100%><td width=50%><font face=calibri size=2>";
				echo "On gg 365 <br>".number_format((round($row[field12]*20)/20),2,".",chr(180))."</td>";
				echo "<td width=50%><font face=calibri size=2>";
				echo "On gg ".round($row[field11])."<br>".number_format((round($premio_lordo*20)/20),2,".",chr(180))."</td>";
				echo "</table>";
			}
			echo "<td valign=middle align=center><font face=verdana size=2>$row[field14]%<br>(".number_format((round($ribasso*20)/20),2,".",chr(180)).")</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>$row[field13]%<br>(".number_format((round($bollo*20)/20),2,".",chr(180)).")</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>".number_format((round($premio_netto*20)/20),2,".",chr(180))."</td>";
			echo '</tr>';
			
			if ($nr_titoli>0) {
				while ($row_titoli = $db->sql_fetchrow($rs_titoli))
				{
					$checked=' checked ';
					$color='green';
					$fontcolor='white';
					if ($row_titoli[PAGATO]=='N') {$checked=' ';$color="yellow";$fontcolor='black';}
					echo "<tr>";
						echo "<td></td>";
						echo "<td bgcolor=$color align=center><input disabled type=checkbox $checked></td>";
						echo "<td bgcolor=$color colspan=7><font face=calibri style=font-size:12px;color:$fontcolor;>Respect of payment nr <strong>$row_titoli[NRTIT]</strong>&nbsp;&nbsp;::&nbsp;&nbsp;Expiring date <strong>$row[field6]</strong>&nbsp;&nbsp;::&nbsp;&nbsp;Sum <strong>$row_titoli[DIV] $row_titoli[LORDO]</strong></font></td>";
					echo "</tr>";
				}
				echo "<tr>";
					echo "<td colspan=9></td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td colspan=9></td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td colspan=9></td>";
				echo "</tr>";
			}
		}
	}
	echo "</table>";
CloseTable();

?>

<script language=JavaScript>
	document.getElementById("offerte").scrollTop=<?php echo $_GET[scrolltop]; ?>;
</script>
</div>