<?php

if ($_GET[elabora]=='on') {
	$sql = "UPDATE nuke_polizze SET status='$_GET[attiva]' WHERE idpolizza = '$_GET[idpolizza]'";
	$result = $db->sql_query1($sql);
	header("Location: gestionale.php?name=lloyds&subname=polizze&act=$_GET[act]&idpolizza=$_GET[idpolizza]");
}

$sql = "SELECT * FROM nuke_polizze where idpolizza=$_GET[idpolizza]";
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);

//update del numero di polizza se numeropolizza1!=''
if ($row[numeropolizza1]!='') {
	$sql = "UPDATE nuke_polizze SET numeropolizza='$row[numeropolizza1]' WHERE idpolizza = '$row[idpolizza]'";
	$result = $db->sql_query1($sql);
}

if ($row[rinnovo]=='1') {
	if ($row[field14]=='5') $enneyears='3';
	if ($row[field14]=='10') $enneyears='5';
	if ($row[field14]<'8') $enneyears='3';
	if ($row[field14]>'8') $enneyears='5';
	if ($enneyears=='3') $unitldate=strtotime('+3 years',strtotime($row[field6]));
	if ($enneyears=='5') $unitldate=strtotime('+5 years',strtotime($row[field6]));
	if ($row[scad_clausola]!=null) {
		$fromdate=strtotime('-'.$enneyears.' years +1 days',strtotime($row[scad_clausola]));
	}
}

if ($_GET[nomefile]!='') {
	if ($_GET[nomefile]=='/template/lettera_nuova.htm' || $_GET[nomefile]=='/template/lettera_1.htm' || $_GET[nomefile]=='/template/rva_polizza.htm' || $_GET[nomefile]=='/template/rva_polizza_addendum.htm' || $_GET[nomefile]=='/upload/NMA_2242A_ENG_PRE_CONTRACTUAL.rtf' || $_GET[nomefile]=='/upload/NMA_2226_4_ENG_All_risk_CONDITIONS.rtf' || $_GET[nomefile]=='/upload/NMA_1658_4_ENG_RENEWAL_OFFER_CLAUSE.rtf' || $_GET[nomefile]=='/upload/NMA1740A-4_ENG_CGA_INFORTUNI_Form_K_Svizzera.rtf' || $_GET[nomefile]=='/upload/NMA 1612 - EN -  Malattia a complemento di NMA 1740.doc') {
		$nome = strstr($_GET[nomefile],".rtf",true);
		$nome1 = strstr($_GET[nomefile],".rtf",true);
		if ($_GET[nomefile]=='/template/rva_polizza.htm' || $_GET[nomefile]=='/template/rva_polizza_addendum.htm') {
			$nome  = strstr($_GET[nomefile],".htm",true);
			$nome1 = "polizza_$row[numeropolizza]";
		}
		if ($_GET[nomefile]=='/template/lettera_1.htm' || $_GET[nomefile]=='/template/lettera_nuova.htm') {
			$nome  = strstr($_GET[nomefile],".htm",true);
			$nome1 = "invio_contratto_".str_replace("EUROPLEX N. ","",$row[numeropolizza]);
		}
		if ($_GET[nomefile]=='/upload/NMA 1612 - EN -  Malattia a complemento di NMA 1740.doc') {
			$nome  = "/upload/NMA_1612-EN-Malattia_a_complemento_di_NMA_1740";
			$nome1  = "/upload/NMA_1612-EN-Malattia_a_complemento_di_NMA_1740";
		}
		header("Content-Type: application/vnd.ms-word");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=$nome1.doc");
    include("$nome.htm");
	}else{
		$_GET[nomefile]=str_replace("|"," ",$_GET[nomefile]);
		header("Location: $_GET[nomefile]");
	}
die();
}

$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potr� essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$act = $_GET[act];
if ($act=="") $act = 'search';
$idpolizza = $_GET[idpolizza];
$idcliente = $_GET[idcliente];
$pag = $_GET[pag];
$ord = $_GET[ord];
$tablename = "nuke_polizze";

$numeropolizza = $_GET[numeropolizza];
$field1 = $_GET[field1];
$field2 = $_GET[field2];
$field3 = $_GET[field3];
$field4 = $_GET[field4];
$field5 = $_GET[field5];
$field6 = $_GET[field6];
$field7 = $_GET[field7];
$field8 = $_GET[field8];
$field9 = $_GET[field9];
$field10 = $_GET[field10];
$field11 = $_GET[field11];
$rinnovo = $_GET[rinnovo];
$valuta = $_GET[valuta];
$franchigia = $_GET[franchigia];
$data = $_GET[data];

if ($act == 'modnumber'){
	$modnumbertext = $_GET[modnumbertext];
	$sql = "UPDATE nuke_polizze SET numeropolizza='$modnumbertext' WHERE idpolizza='$_GET[idpolizza]'";
	$result = $db->sql_query($sql);
	$act='explode';
} 
if ($act == 'del'){
	if ($userinfo['username']=='dpierini') {
		$sql = "SELECT id FROM nuke_polizze WHERE idpolizza='$_GET[idpolizza]'";
		$rs = $db->sql_query($sql);
		$row = $db->sql_fetchrow($rs);
		$idofferta = $row[id];
		
		$sql = "DELETE FROM nuke_polizze WHERE idpolizza='$_GET[idpolizza]'";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_polizze_detail1 where idpolizza='$_GET[idpolizza]'";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_polizze_detail_2 where idpolizza='$_GET[idpolizza]'";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_polizze_detail_cga where idpolizza='$_GET[idpolizza]'";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_polizze_ldr where idpolizza='$_GET[idpolizza]'";
		$result = $db->sql_query($sql);
		$sql = "UPDATE nuke_offerte SET blocca='0' where id='$idofferta'";
		$result = $db->sql_query($sql);
		
	}
	if (isset($_COOKIE[idcliente])) {
		header("Location: gestionale.php?name=clienti&act=explode&id=$_COOKIE[idcliente]");
	}else{
		header("Location: gestionale.php?name=lloyds&subname=polizze");
	}
}
$condizioni = " WHERE status = '1' ";
if ($_GET[status]=='all') $condizioni = " WHERE status like '%' ";

if ($act == 'explode') {
	if ($idpolizza == '') $idpolizza = $_GET[idpolizza];
	$condizioni .= " AND idpolizza = '$idpolizza' ";
}
if ($act != 'explode') {
	$condizioni .= " AND company='$_SERVER[company]' ";
}
if ($act=='gosearch') {
	$condizioni .= " AND ";
	if ($field1 != '') $condizioni .= " field1='$field1' AND ";
	if ($field2 != '') $condizioni .= " field2='$field2' AND ";
	if ($field3 != '') $condizioni .= " field3='$field3' AND ";
	if ($field4 != '') $condizioni .= " field4='$field4' AND ";
	if ($field5 != '') $condizioni .= " field5 like '%$field5%' AND ";
	if ($field6 != '') $condizioni .= " field6='$field6' AND ";
	if ($field7 != '') $condizioni .= " field7='$field7' AND ";
	if ($field10 != '') $condizioni .= " field10='$field10' AND ";
	if ($field17 != '') $condizioni .= " field17='$field17' AND ";
	if ($valuta != '') $condizioni .= "  valuta='$valuta' AND ";
	if ($franchigia != '') $condizioni .= " franchigia='$franchigia' AND ";
	if ($data != '') $condizioni .= " data='$data' AND ";
	if ($rinnovo != '') $condizioni .= " rinnovo='$rinnovo' AND ";
	$condizioni .= " id like '%' ";
	if ($_GET[numeropolizza_y]!='' && $_GET[numeropolizza_id]!='') {
		$condizioni .= " numeropolizza like '%$_GET[polizza_tipo]$_GET[numeropolizza_y]/$_GET[numeropolizza_id]' ";
	}
}

$sql = "SELECT * FROM $tablename $condizioni order by numeropolizza ASC, idpolizza DESC";
$rs = $db->sql_query($sql);
$nr = $db->sql_numrows($rs);

OpenTable();
$disabled='';
if ($act=='explode') $disabled=' disabled ';
echo '<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen><td>';
echo "<input type=button value='Exit' onclick=location.href='gestionale.php?name=lloyds' style=font-family: Verdana; font-size: 10px;>";
if ($act!='explode') {
	echo '&nbsp;&nbsp;::&nbsp;&nbsp;';
	?>
	<input type=button value='Search' onClick="if(document.getElementById('cerca').style.display=='none'){document.getElementById('cerca').style.display='block';}else{document.getElementById('cerca').style.display='none';}">
	<?php
        if ($_GET[status]=='all') {
            echo "&nbsp;&nbsp;::&nbsp;&nbsp;<input type=button value='Show all records' onClick=window.location='gestionale.php?name=lloyds&subname=polizze' style=font-family: Verdana; font-size: 10px>";
        }else{
            echo "&nbsp;&nbsp;::&nbsp;&nbsp;<input type=button value='Show all records' onClick=window.location='gestionale.php?name=lloyds&subname=polizze&status=all' style=font-family: Verdana; font-size: 10px>";
        }
}
if ($act=='explode') {
	$sqlp = "SELECT * FROM nuke_polizze where idpolizza='$_GET[idpolizza]'";
	$rsp = $db->sql_query($sqlp);
	$nrp = $db->sql_numrows($rsp);
	$rowp = $db->sql_fetchrow($rsp);
	$file = "/template/rva_polizza.htm";
	if ($rowp[addendum]!='') $file = "/template/rva_polizza.htm";
	echo "&nbsp;&nbsp;::&nbsp;&nbsp;<font face=calibri size=2>Back to customer</font>";
	if ($rowp[field3]!='') echo " <input type=button value='$rowp[field3]' onclick=location.href='gestionale.php?name=clienti&act=explode&id=$rowp[field3]' style=font-family: Verdana; font-size: 10px;>";
	if ($rowp[field4]!='') echo " <input type=button value='$rowp[field4]' onclick=location.href='gestionale.php?name=clienti&act=explode&id=$rowp[field4]' style=font-family: Verdana; font-size: 10px;>";
	echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
	echo "<input type=button name=completa value='Back to offer' onClick=javascript:window.location='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$rowp[id]';>";
	echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
	echo "<input type=button value='Print' onClick=window.location='gestionale.php?name=lloyds&subname=polizze&act=explode&nomefile=$file&idpolizza=$_GET[idpolizza]';>";
	if (substr($rowp[numeropolizza],-2,1)!="A") {
		echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
		echo "<input type=button value='Renew' onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=duplica&id=$rowp[id]&numeropolizza=".str_replace(" ","_",$rowp[numeropolizza])."&rinnovato=1';>";
		echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
		echo "<input type=button value='Modify' onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=duplica&id=$rowp[id]&addendum=1&numeropolizza=".str_replace(" ","_",$rowp[numeropolizza])."';>";
	}
	echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
	if ($row[rinnovo]=='0') {
		echo "<input type=button value='Print Letter' onClick=window.location='gestionale.php?name=lloyds&subname=polizze&act=explode&nomefile=/template/lettera_nuova.htm&idpolizza=$_GET[idpolizza]';>";
	} else {
		echo "<input type=button value='Print Letter' onClick=window.location='gestionale.php?name=lloyds&subname=polizze&act=explode&nomefile=/template/lettera_1.htm&idpolizza=$_GET[idpolizza]';>";
	}
	echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
        ?>
        <input type=button value='Delete policy' onClick="if(confirm('Warning!!! Are you really sure to continue?')) location.href='gestionale.php?name=lloyds&subname=polizze&act=del&idpolizza=<?php echo $idpolizza; ?>';">
        <?php
        echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
	echo "<font face=calibri color=black><u><strong>POLICY NUMBER:</u> <input id=8472 size=60 type=text name=numeropolizza value='$rowp[numeropolizza]'></strong></u></font>";
	?>
	<input type=button value='Save number' onClick="if(confirm('Warning!!! Are you really sure to continue changing policy number?')) location.href='gestionale.php?name=lloyds&subname=polizze&act=modnumber&idpolizza=<?php echo $idpolizza; ?>&modnumbertext='+document.getElementById('8472').value+'&1=0';">
	<?php
}
echo '</td></table>';
CloseTable();
?>
<div class="offerte" id="offerte" style="position:relative;_position:relative;height:90%;overflow:auto;padding:0px;">
<?php

if ($act!='explode') {
	OpenTable();
	echo "<table border=0 cellspcing=0 cellpadding=2><td><font face=calibri size=2>Legend:
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style=background-color:red; color=white>RED</font> policy canceled or replaced&nbsp;&nbsp;::&nbsp;&nbsp;<font style=background-color:lightgreen; color=black>GREEN</font> policy active&nbsp;&nbsp;::&nbsp;&nbsp;<font style=background-color:yellow; color=black>YELLOW</font> policy expiring</font>";
	echo "</td></table>";
	
	if ($act == 'search' || $act=='gosearch') {
	echo "<div id=cerca><table width=100% cellspacing=0 cellpadding=5 border=1 bordercolor=darkgreen>";
		$ricerca = str_replace(" ","%20","&field1=$field1&field2=$field2&field3=$field3&field4=$field4&field5=$field5&field6=$field6&field10=$field10&field7=$field7&field17=$field17&rinnovo=$rinnovo&data=$data&franchigia=$franchigia&valuta=$valuta");
		echo "<tr><td colspan=9>EUROPLEX N. xxxx/xxxxxxxxx/<select id=polizza_tipo>";
		$sql_num = "SELECT distinct field1 FROM nuke_tipologiepolizze";
		$rs_num = $db->sql_query($sql_num);
		while ($num = $db->sql_fetchrow($rs_num)) {
			echo "<option value=$num[field1]>$num[field1]</option>";
		}
		echo "</select>";
		echo "<select id=numeropolizza_y><option value=12>12</option><option value=13>13</option><option value=14>14</option><option value=15>15</option><option selected value=16>16</option><option value=17>17</option><option value=18>18</option></select>";
		echo "/";
		echo "<input type=text name=numeropolizza_id id=numeropolizza_id>&nbsp;&nbsp;";
		echo "&nbsp;<input type=button value=Go onclick=window.location='gestionale.php?name=lloyds&subname=polizze&act=gosearch&polizza_tipo='+document.getElementById('polizza_tipo').value+'&numeropolizza_y='+document.getElementById('numeropolizza_y').value+'&numeropolizza_id='+document.getElementById('numeropolizza_id').value; >";
		echo "</td></tr>";
		echo '<tr>';
		echo "<td></td>";
		echo "<td valign=top align=center><font face=verdana size=2>";
		$sql_polizze = "SELECT distinct field2 FROM nuke_polizze";
		$rs_polizze = $db->sql_query($sql_polizze);
		$nr_polizze = $db->sql_numrows($rs_polizze);
		if ($field2=='') $ricerca = str_replace("&field2=$field2","",$ricerca);
		echo "<select name=field2 style=width:100px; size=5 multiple=multiple onClick=window.location='gestionale.php?name=lloyds&subname=polizze&act=gosearch$ricerca&field2='+this.value>";
		echo "<option value=''>All</option>";
		while ($polizze = $db->sql_fetchrow($rs_polizze)) {
			if ($polizze[field2]==$_GET[field2]) $selected=' selected ';
			echo "<option $selected value='$polizze[field2]'>$polizze[field2]</option>";
			$selected="";
		}
		echo "</select></td>";
		echo "<td valign=middle align=center><table><td align=center>";
		$testo="";
		$sql= "SELECT COD, COGNOME, NOME, RIFER, REPLACE(REPLACE(REPLACE(SEX, 'G', '1'), 'M', '2'), 'F', '3') AS SEX  FROM [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.CLIENTI WHERE COD = '$field3'";
		$rs_customer = $db->sql_query1($sql);
		$row_customer = $db->sql_fetchrow($rs_customer);
		if ($row_customer[SEX]=='1') $testo = "<strong>$row_customer[COD]: $row_customer[COGNOME] $row_customer[RIFER]</strong>";
		if ($row_customer[SEX]=='2') $testo = "<strong>$row_customer[COD]: $row_customer[COGNOME] $row_customer[NOME] $row_customer[RIFER]</strong>";
		if ($row_customer[SEX]=='3') $testo = "<strong>$row_customer[COD]: $row_customer[COGNOME] $row_customer[NOME] $row_customer[RIFER]</strong>";
		if ($field3=='') $ricerca = str_replace("&field3=$field3","",$ricerca);
		echo "<font face=verdana size=2>Owner<br>
					<input style='text-align:center' size=20 type=text id=field3 onKeyUp=javascript:query_now_field3('field3');><br>
					<select id=field3_select onClick=window.location='gestionale.php?name=lloyds&subname=polizze&act=gosearch$ricerca&field3='+this.value; style=width:120px; name=field3 multiple=multiple size=4><option value=''>All</option><option selected value='$row_customer[COD]'>$testo</option>";
		echo "</select></td><td align=center>";
		$testo="";
		$tooltip="";
		$sql= "SELECT COD, COGNOME, NOME, RIFER, REPLACE(REPLACE(REPLACE(SEX, 'G', '1'), 'M', '2'), 'F', '3') AS SEX  FROM [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.CLIENTI WHERE COD = '$field4'";
		$rs_customer = $db->sql_query1($sql);
		$row_customer = $db->sql_fetchrow($rs_customer);
		if ($row_customer[SEX]=='1') $testo = "<strong>$row_customer[COD]: $row_customer[COGNOME] $row_customer[RIFER]</strong>";
		if ($row_customer[SEX]=='2') $testo = "<strong>$row_customer[COD]: $row_customer[COGNOME] $row_customer[NOME] $row_customer[RIFER]</strong>";
		if ($row_customer[SEX]=='3') $testo = "<strong>$row_customer[COD]: $row_customer[COGNOME] $row_customer[NOME] $row_customer[RIFER]</strong>";
		$tooltip=str_replace("<strong>","",str_replace("</strong>","",str_replace(" ","_",$testo)));
		if ($field4=='') $ricerca = str_replace("&field4=$field4","",$ricerca);
		echo "<font face=verdana size=2>Assured<br>
					<input style='text-align:center' size=20 type=text id=field4 onKeyUp=javascript:query_now_field4('field4');><br>
					<select onMouseOver=showTooltip(this,'$tooltip'); onMouseOut=hideTooltip(); onClick=window.location='gestionale.php?name=lloyds&subname=polizze&act=gosearch$ricerca&field4='+this.value; style=width:120px; id=field4_select name=field4 multiple=multiple size=4><option value=''>All</option><option selected value='$row_customer[COD]'>$testo</option>";
		echo "</select></td></table>";
		$ricerca = str_replace("&field5=$field5","",$ricerca);
		echo "<font face=verdana size=2>Assured<br><input type=text name=field5 id=field5 size=25 value='$field5'>";
		echo "<input type=button value=Cerca onClick=window.location='gestionale.php?name=lloyds&subname=polizze&act=gosearch$ricerca&field5='+document.getElementById('field5').value;>";
		echo "</td>";
		echo "<td valign=top align=center><font face=calibri size=2>";
		if ($field6=='') $ricerca = str_replace("&field6=$field6","",$ricerca);
		echo "From<br><input type=text name=field6 value='$field6' id='sel3' size=11><input type=reset value='.'";
		?> onClick="return showCalendar('sel3', '%d.%m.%Y');" <?php echo ">";
		echo "<br>";
		if ($field10=='') $ricerca = str_replace("&field10=$field10","",$ricerca);
		echo "To<br><input type=text name=field10 value='$field10' id='sel4' size=11><input type=reset value='.'";
		?> onclick="return showCalendar('sel4', '%d.%m.%Y');" <?php echo ">";
		echo "<br><input type=button value=Go onClick=window.location='gestionale.php?name=lloyds&subname=polizze&act=gosearch$ricerca&field6='+document.getElementById('sel3').value+'&field10='+document.getElementById('sel4').value;>";
		echo "</td>";
		echo "<td valign=top align=center><font face=verdana size=2>Territorial Limits<br>";
		if ($field7=='') $ricerca = str_replace("&field7=$field7","",$ricerca);
		$sql_limititerritoriali = "SELECT distinct field7 FROM nuke_polizze";
		$rs_limititerritoriali = $db->sql_query($sql_limititerritoriali);
		$nr_limititerritoriali = $db->sql_numrows($rs_limititerritoriali);
		echo "<select name=field7 style=width:100px; size=5 multiple=multiple onClick=window.location='gestionale.php?name=lloyds&subname=polizze&act=gosearch$ricerca&field7='+this.value;>";
		echo "<option value=''>All</option>";
		while ($limititerritoriali = $db->sql_fetchrow($rs_limititerritoriali)) {
			if ($limititerritoriali[field7]==$field7) $selected=' selected ';
			echo "<option $selected value='$limititerritoriali[field7]'>$limititerritoriali[field7]</option>";
			$selected="";
		}
		echo "</select></td>";
		echo "<td valign=top align=center><font face=verdana size=2>Currency<br>";
		if ($valuta=='') $ricerca = str_replace("&valuta=$valuta","",$ricerca);
		echo "<select name=valuta style=width:50px; size=5 multiple=multiple onClick=window.location='gestionale.php?name=lloyds&subname=polizze&act=gosearch$ricerca&valuta='+this.value;>";
		echo "<option value=''>All</option>";
		echo "<option ";if($valuta=='CHF') echo " selected ";echo " value='CHF'>CHF</option>";
		echo "<option ";if($valuta=='EUR') echo " selected ";echo " value='EUR'>EUR</option>";
		echo "<option ";if($valuta=='USD') echo " selected ";echo " value='USD'>USD</option>";
		echo "<option ";if($valuta=='GBP') echo " selected ";echo " value='GBP'>GBP</option>";
		echo "</select></td>";
		echo "<td valign=top colspan=3 align=left>
					<font face=verdana size=2>Excess<br>";
		if ($franchigia=='') $ricerca = str_replace("&franchigia=$franchigia","",$ricerca);
		$sql_franchigia = "SELECT distinct franchigia FROM nuke_polizze where franchigia is not null";
		$rs_franchigia = $db->sql_query($sql_franchigia);
		$nr_franchigia = $db->sql_numrows($rs_franchigia);
		echo "<select name=franchigia style=width:100px; size=5 multiple=multiple onClick=window.location='gestionale.php?name=lloyds&subname=polizze&act=gosearch$ricerca&franchigia='+this.value;>";
		echo "<option value=''>All</option>";
		while ($franc = $db->sql_fetchrow($rs_franchigia)) {
			if ($franc[franchigia]==$franchigia) $selected=' selected ';
			echo "<option $selected value='$franc[franchigia]'>$franc[franchigia]</option>";
			$selected="";
		}
		echo "</select></font><br>";
		if ($rinnovo=='') $ricerca = str_replace("&rinnovo=$rinnovo","",$ricerca);
		echo "<font face=verdana size=2>Renewal clause<br>";
		echo "<select name=rinnovo style=width:80px; size=3 multiple onClick=window.location='gestionale.php?name=lloyds&subname=polizze&act=gosearch$ricerca&rinnovo='+this.value;>";
		if ($rinnovo=='1') $selected1=" selected ";
		if ($rinnovo=='0') $selected0=" selected ";
		echo "<option value=''>All</option><option $selected1 value='1'>Yes</option><option $selected0 value='0'>No</option>";
		echo "</select><br>";
		if ($data=='') $ricerca = str_replace("&data=$data","",$ricerca);
		echo "<font face=verdana size=2>Sign date<br>";
		echo "<input type=text name=data value='$data' id='sel5' size=11><input type=reset value='.'";
		?> onClick="return showCalendar('sel5', '%d.%m.%Y');" <?php echo "><br><br>";
		echo "<input type=button value=Search onClick=onClick=window.location='gestionale.php?name=lloyds&subname=polizze&act=gosearch$ricerca&data='+document.getElementById('sel5').value;></td>";
		echo '</tr>';
	echo "</table></div><br>";
	}
	
	echo '<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen>';
	echo '<tr>';
		echo '<th colspan=2 width=5%><font face=verdana size=2>Status</th>';
		echo '<th width=10%><font face=verdana size=2>Policy Number</th>';
		echo '<th width=20%><font face=verdana size=2>Name</th>';
		echo '<th width=10%><font face=verdana size=2>Type</th>';
		echo '<th width=20%><font face=verdana size=2>Covered period</th>';
		echo '<th width=10%><font face=verdana size=2>Renewal Clause</th>';
		echo '<th width=12%><font face=verdana size=2>Sum Assured</th>';
		echo '<th width=13%><font face=verdana size=2>Total<br>Annual Premium</th>';
	echo '</tr>';
}

if ($nr != 0){
	while ($row = $db->sql_fetchrow($rs))
	{
		if ($act!='explode') {
			$color='black';
			$sfondo='bgcolor=lightgreen';
			$checked=' checked ';
	
			$annorecordprecedente = $annoscadenza;
			$annoscadenza=date("Y",strtotime($row[field10]));
			if ($annorecordprecedente!=$annoscadenza) {
				echo "<tr>";
					echo "<td colspan=9><font face=calibri style=font-size:13px;color:$color>$annoscadenza</td>";
				echo "</tr>";
			}
	
			if (date("Y",strtotime($row[field10]))==date("Y")) {
				$color="black";
				$sfondo='bgcolor=yellow';
			}
			if (trim($row[status])=='0') {
				$color='white';
				$sfondo='bgcolor=red';
				$checked=' ';
			}

			if ($status_precedente=='0' && $row[status]=='1') {
				echo "<tr><td height=10 colspan=9></td></tr>";
			}
			if ($status_precedente=='1' && $row[status]=='1') {
				echo "<tr><td height=5 colspan=9></td></tr>";
			}

			echo "<tr $sfondo>";
			if ($row[status]=='0') {
				echo "<td align=center valign=middle style=border-bottom:0px;border-left:0px; bgcolor=lightgrey>&nbsp;&nbsp;</td>";
				echo "<td align=center valign=middle><font style=color:$color; face=calibri size=2>";
			}
			else{
				echo "<td colspan=2 align=center valign=middle><font style=color:$color; face=calibri size=2>";
			}
			echo "<input type=checkbox $checked onClick=attiva(this,'$id','$row[idpolizza]','$act');>
			</font></td>";
			echo "<td align=center valign=middle><font style=color:$color; face=calibri size=2><a style=color:$color;text-decoration:underline; href=gestionale.php?name=lloyds&subname=polizze&act=explode&idpolizza=$row[idpolizza]>".str_replace("EUROPLEX N. ","",$row[numeropolizza])."</a> ($row[data])<br>Offer: <a style=color:$color;text-decoration:underline; href=gestionale.php?name=lloyds&subname=offerte&act=explode&id=$row[id]>$row[field1]/$row[id]</a></font></td>";
			echo "<td valign=middle align=center><font style=color:$color; face=verdana size=2>";
			$sql_nominativo = "SELECT * FROM nuke_clienti_polizze where id='".$row[field3]."'";
			$rs_nominativo = $db->sql_query($sql_nominativo);
			$nominativo = $db->sql_fetchrow($rs_nominativo);
			if ($row[field3]!='') {
				echo "Owner: <strong>";
				echo $row[field3]." ".$nominativo[cognome]." ".$nominativo[nome]."</strong>";
			}
			$sql_nominativo = "SELECT * FROM nuke_clienti_polizze where id='".$row[field4]."'";
			$rs_nominativo = $db->sql_query($sql_nominativo);
			$nominativo = $db->sql_fetchrow($rs_nominativo);
			if ($row[field4]!='') {
				echo "<br>";
				echo "Assured: <strong>";
				echo $row[field4]." ".$nominativo[cognome]." ".$nominativo[nome]."</strong>";
			}
			if ($row[field5]!='') {
				echo "<br>";
				echo "Assured: ";
				echo "<strong>".$row[field5]."</strong>";
			}
			echo "</td>";
			echo "<td align=center valign=middle><font style=color:$color; face=calibri size=2>$row[field2]<br>$row[field7]</font></td>";
			echo "<td align=center valign=middle><font style=color:$color; face=calibri size=2>From: $row[field6], To: $row[field10]<br>Covered Days ".number_format($row[field11],0)."</font></td>";
			echo "<td valign=middle align=center><font style=color:$color; face=verdana size=2>";
			if ($row[rinnovo]=='1') echo "Yes"; if ($row[rinnovo]=='0') echo "No";
			echo "</td>";
			echo "<td align=center valign=middle><font style=color:$color; face=calibri size=2>$row[valuta] ".number_format($row[field8],2,".",chr(180))."</font></td>";
			$ari_totale = $row[field15];
			if ($row[rimborso]!='') {
				//$ari_totale = floatval($row[field15]) + floatval(trim($row[rimborso]));
			}
			echo "<td align=center valign=middle><font style=color:$color; face=calibri size=2>$row[valuta] ".number_format(round($ari_totale*20)/20,"2",".","'")."</font></td>";
			echo '</tr>';
			$status_precedente = $row[status];
		}

		if ($act=='explode') {
			$valuta = $row[valuta];
			//echo "</table>";
			//CloseTable();
			if ($_GET[view]=='') $_GET[view]='generale';
			if ($_GET[view]=='generale') $strong1='<font color=black><strong>->';
			if ($_GET[view]=='beni') $strong3='<font color=black><strong>->';
			if ($_GET[view]=='generale') {
				if ($_GET[pagina]=='') {$pagina='1';}else{$pagina=$_GET[pagina];}
				if ($pagina=='1') {$succ='2';$pre='';}
				if ($pagina=='2') {$succ='object';$pre='1';}
				if ($pagina=='object') {$succ='ultima';$pre='2';}
				if ($pagina=='ultima') {$succ='';$pre='object';}
				echo "<center><table width=60% cellspacing=0 cellpadding=5 border=0 bgcolor=white>";
					echo "<tr>";
						echo "<td width=1 valign=top align=center><a href=gestionale.php?name=lloyds&subname=polizze&act=explode&idpolizza=$idpolizza&pagina=$pre><img border=0 width=128 src=images/Shortcuts_left.png></a></td>";
						echo "<td width=100% valign=middle align=center>";
						include('template/rva_polizza_view1.htm');				
 						echo "</td>";
						echo "<td width=1 valign=top align=center><a href=gestionale.php?name=lloyds&subname=polizze&act=explode&idpolizza=$idpolizza&pagina=$succ><img border=0 width=128 src=images/Shortcuts_right.png></a></td>";
					echo "</tr>";
				echo "</table>";
			}
		}
	}
}
if ($act!='explode') {
	echo '</table>';
	CloseTable();
}
?>
<script language=JavaScript>
document.getElementById("offerte").scrollTop=<?php echo $_GET[scrolltop]; ?>;
</script>
<?php
echo "<script language=JavaScript>";
echo "
			document.getElementById('Cerca').style.display='none';
			";
echo "</script>";
echo "</div>";

?>