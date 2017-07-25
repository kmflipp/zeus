$sql = "SELECT * FROM nuke_polizze where idpolizza=$_GET[idpolizza]";
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);

if ($_GET[nomefile]!='') {
	if ($_GET[nomefile]=='/upload/NMA_2242A_ENG_PRE_CONTRACTUAL.rtf') {
		$nomefile = strstr($_GET[nomefile],".rtf",true);
		$fcontents = file_get_contents ("http://rva.dnsd.info$nomefile.htm");
		$fcontents = str_replace("QUOTEORPOLICYNUMBER", $row[numeropolizza], $fcontents);
		header("Content-Type: application/vnd.ms-word");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=$nomefile.doc");		
    echo $fcontents;
		die();
	}
	if ($_GET[nomefile]=='/upload/NMA_1658_4_ENG_RENEWAL_OFFER_CLAUSE.rtf') {
		$nomefile = strstr($_GET[nomefile],".rtf",true);
		$fcontents = file_get_contents ("http://rva.dnsd.info$nomefile.htm");
		$fcontents = str_replace("QUOTEORPOLICYNUMBER", $row[numeropolizza], $fcontents);
		header("Content-Type: application/vnd.ms-word");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=$nomefile.doc");		
    echo $fcontents;
		die();
	}
	if ($_GET[nomefile]=='/upload/NMA_2226_4_ENG_All_risk_CONDITIONS.rtf') {
		$nomefile = strstr($_GET[nomefile],".rtf",true);
		$fcontents = file_get_contents ("http://rva.dnsd.info$nomefile.htm");
		if ($row[field14=='5') $enneyears='3';
		if ($row[field14=='10') $enneyears='5';
		if ($row[field14<'8') $enneyears='3';
		if ($row[field14>'8') $enneyears='5';
		if ($enneyears=='3') $unitldate=strtotime('+3 years',$row[field6]);
		if ($enneyears=='5') $unitldate=strtotime('+5 years',$row[field6]);
		$fcontents = str_replace("ENNEYEARS", $enneyears, $fcontents);
		$fcontents = str_replace("FROMDATE",  $row[field6], $fcontents);
		$fcontents = str_replace("UNTILDATE", $unitldate, $fcontents);
		header("Content-Type: application/vnd.ms-word");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=$nomefile.doc");		
    echo $fcontents;
		die();
	}
}
