<?php
if ($row[field14]=='5') $enneyears='3';
if ($row[field14]=='10') $enneyears='5';
if ($row[field14]<'8') $enneyears='3';
if ($row[field14]>'8') $enneyears='5';
if ($enneyears=='3') $unitldate=strtotime('+3 years',strtotime($row[field6]));
if ($enneyears=='5') $unitldate=strtotime('+5 years',strtotime($row[field6]));
$nomefile=explode(",",$_GET[nomefile]);
$printed=0;
$yii=0;
$var=1;
for ($d=0;$d<10;$d++) {
	if ($nomefile[$d]!='') {
		$yi++;
		if ($nomefile[$d]=='/template/rva1.htm' || $nomefile[$d]=='/upload/NMA_2242A_ENG_PRE_CONTRACTUAL.rtf' || $nomefile[$d]=='/upload/NMA_2226_4_ENG_All_risk_CONDITIONS.rtf' || $nomefile[$d]=='/upload/NMA_1658_4_ENG_RENEWAL_OFFER_CLAUSE.rtf') {
			$printed=1;
			$nome = strstr($nomefile[$d],".rtf",true);
			if ($nomefile[$d]=='/template/rva1.htm') $nome='/template/rva1';
			if ($yi!=1) echo "<br clear=all style='mso-special-character:line-break;page-break-before:always'>";
			echo '';
			include("$nome.htm");
			$sql = "SELECT * FROM nuke_offerte_stampe where filename='$nomefile[$d]' and idofferta=$_GET[id]";
			$rs = $db->sql_query($sql);
			$nr = $db->sql_numrows($rs);
			if ($nr=='0') {
				$sql = "INSERT INTO nuke_offerte_stampe (filename,printed,idofferta) VALUES ('$nomefile[$d]','1',$_GET[id])";
				$rs = $db->sql_query($sql);
			}else{
				$sql = "UPDATE nuke_offerte_stampe SET printed='1' where filename='$nomefile[$d]' and idofferta=$_GET[id]";
				$rs = $db->sql_query($sql);
			}
			if ($nomefile[$d]=='/template/rva1.htm') $nome="proposta_$row[field1]-$row[id]";
		}else{
			$nome = $nomefile[$d];
			$sql = "SELECT * FROM nuke_offerte_stampe where filename='$nomefile[$d]' and idofferta=$_GET[id]";
			$rs = $db->sql_query($sql);
			$nr = $db->sql_numrows($rs);
			if ($nr=='0') {
				$sql = "INSERT INTO nuke_offerte_stampe (filename,printed,idofferta) VALUES ('$nomefile[$d]','0',$_GET[id])";
				$rs = $db->sql_query($sql);
			}else{
				$sql = "UPDATE nuke_offerte_stampe SET printed='0' where filename='$nomefile[$d]' and idofferta=$_GET[id]";
				$rs = $db->sql_query($sql);
			}
		}
	}
}

if ($printed==1) {
	if ($yi!=1) $nome='ALL';
	header("Content-Type: application/msword");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=$nome.doc");
	die();
}else{
	$_GET[nomefile]='';
}
?>