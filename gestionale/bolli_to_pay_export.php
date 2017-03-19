<?php
$id = $_GET[id];
$tablename = "nuke_polizze";

$sql = "SELECT * FROM ".$tablename." order by field10 ASC, field2 ASC, field13 ASC, numeropolizza ASC ";
$rs = $db->sql_query($sql);
$nr = $db->sql_numrows($rs);
echo "<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen bgcolor=white>";
echo "<tr>";
echo "<th width=10%><font face=verdana size=2>From</th>";
echo "<th width=10%><font face=verdana size=2>To</th>";
echo "<th width=20%><font face=verdana size=2>Policy number</th>";
echo "<th width=20%><font face=verdana size=2>Insured</th>";
echo "<th width=16%><font face=verdana size=2>Premium</th>";
echo "<th width=7%><font face=verdana size=2>Tax</th>";
echo "<th width=5%><font face=verdana size=2>Broker Commission</th>";
echo "<th width=7%><font face=verdana size=2>Amount</th>";
echo "<th width=5%><font face=verdana size=2>UY</th>";
echo "</tr>";

if ($nr != 0){
	while ($row = $db->sql_fetchrow($rs))
	{
	
	$annorecordprecedente = $annoscadenza;
	$annoscadenza=date("Y",strtotime($row[field10]));
	$annopartenza=date("Y",strtotime($row[field6]));
	$UY=date("y",strtotime($row[field6]));
	if ($annorecordprecedente!=$annoscadenza) {
		echo "<tr>";
			echo "<td colspan=9><font face=calibri style=font-size:13px;color:$color><strong>Policies $annopartenza/$annoscadenza</td>";
		echo "</tr>";
		$tipologia='';
	}
	$tipologiaprecedente = $tipologia;
	$tipologia=$row[field2];
	if ($tipologiaprecedente!=$tipologia) {
		echo "<tr>";
			echo "<td colspan=9><font face=calibri style=font-size:13px;color:$color><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Policy type: $tipologia</td>";
		echo "</tr>";
	}
	$sql_bollo = "SELECT * FROM nuke_bolli where field2='$row[field13]%'";
	$rs_bollo = $db->sql_query($sql_bollo);
	$stato = $db->sql_fetchrow($rs_bollo);
	$statoprecedente = $state;
	$state=$stato[field1];
	if ($statoprecedente!=$state) {
		echo "<tr>";
			echo "<td colspan=9><font face=calibri style=font-size:13px;color:$color><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;State: $state</td>";
		echo "</tr>";
	}

	echo '<tr>';
	echo "<td valign=middle align=center><font color=black face=verdana size=2>$row[field6]</td>";
	echo "<td valign=middle align=center><font color=black face=verdana size=2>$row[field10]</td>";
	echo "<td valign=middle align=center><font color=black face=verdana size=2><strong>".str_replace("EUROPLEX N. B072/BB011440C/","",$row[numeropolizza])."</td>";
	echo "<td valign=middle align=center><font color=black face=verdana size=2>";
	$sql="SELECT * FROM [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.CLIENTI WHERE COD='$row[field3]'";
	$rscli = $db->sql_query($sql);
	$rowcli = $db->sql_fetchrow($rscli);
	if ($rowcli[SEX]=='G') {
		echo "$rowcli[COGNOME] ($row[field3])";
	}else{
		echo "$rowcli[COGNOME] $rowcli[NOME] ($row[field3])";
	}
	echo "</td>";
	if ($row[rimborso]!='') {
		$row[field15] = floatval($row[field15]) + floatval(trim($row[rimborso]));
		$row[field12] = $row[field15]/(1+($row[field13]/100));
	}
	$prorata = ($row[field12]/365)*$row[field11];
	$prorata_con_ribasso = $prorata - ($prorata/100*$row[field14]);
	echo "<td valign=middle align=left><font color=black face=verdana size=2>$row[valuta]<center>".number_format(round($prorata_con_ribasso*20)/20,2,".",chr(180))."</td>";
	$bollo = ($prorata_con_ribasso/100)*$row[field13];
	echo "<td valign=middle align=left><font color=black face=verdana size=2>$row[valuta]<center>".number_format(round($bollo*20)/20,2,".",chr(180))."</td>";
	echo "<td valign=middle align=center><font color=black face=verdana size=2>25%</td>";
	echo "<td valign=middle align=left><font color=black face=verdana size=2>";
	$amount=number_format(round($prorata_con_ribasso/100*25*20)/20,2,'.',chr(180));
	echo "$row[valuta]<center>$amount";
	echo "</td>";
	echo "<td valign=middle align=center><font color=black face=verdana size=2>$UY</td>";
	echo '</tr>';
	}
}
echo "</table>";
?>