<script language=JavaScript>
function modify(id,scrolltop,ord,pag) {
	window.location='gestionale.php?name=lloyds&subname=offerte&ord='+ord+'&pag='+pag+'&act=mod&id='+id+'&scrolltop='+scrolltop;
}
function remove(id,scrolltop,ord,pag) {
	x=confirm("Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?");
	if (x) window.location='gestionale.php?name=lloyds&subname=offerte&ord='+ord+'&pag='+pag+'&act=del&id='+id+'&scrolltop='+scrolltop;
}
function elabora(valore) {
if (valore=='new') location.href='http://rva.dnsd.info/gestionale.php?name=clienti&act=new&torna=offerta'
}	
function elabora1(valore) {
if (valore=='new') location.href='http://rva.dnsd.info/gestionale.php?name=clienti&act=new&torna=modificaofferta&idofferta=<?php echo $_GET[id]; ?>'
}	
</script>

<?php
require_once("mainfile.php");
global $prefix, $db, $admin, $user;

$sql = "SELECT * FROM nuke_offerte where id=$_GET[id]";
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);

if ($_GET[nomefile]!='') {
	if ($_GET[nomefile]=='/upload/NMA_2242A_ENG_PRE_CONTRACTUAL.rtf') {
		$nomefile = strstr($_GET[nomefile],".rtf",true);
		$fcontents = file_get_contents ("http://rva.dnsd.info$nomefile.htm");
		$fcontents = str_replace("QUOTEORPOLICYNUMBER", $row[id]."/".$row[field1], $fcontents);
		header("Content-Type: application/vnd.ms-word");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=$nomefile.doc");		
    echo $fcontents;
		die();
	}elseif ($_GET[nomefile]=='/upload/NMA_2226_4_ENG_All_risk_CONDITIONS.rtf') {
		$nomefile = strstr($_GET[nomefile],".rtf",true);
		$fcontents = file_get_contents ("http://rva.dnsd.info$nomefile.htm");
		$fcontents = str_replace("QUOTEORPOLICYNUMBER", $row[id]."/".$row[field1], $fcontents);
		header("Content-Type: application/vnd.ms-word");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=$nomefile.doc");		
    echo $fcontents;
		die();
	}elseif ($_GET[nomefile]=='/upload/NMA_1658_4_ENG_RENEWAL_OFFER_CLAUSE.rtf') {
		$nomefile = strstr($_GET[nomefile],".rtf",true);
		$fcontents = file_get_contents ("http://rva.dnsd.info$nomefile.htm");
		if ($row[field14]=='5') $enneyears='3';
		if ($row[field14]=='10') $enneyears='5';
		if ($row[field14]<'8') $enneyears='3';
		if ($row[field14]>'8') $enneyears='5';
		if ($enneyears=='3') $unitldate=strtotime('+3 years',strtotime($row[field6]));
		if ($enneyears=='5') $unitldate=strtotime('+5 years',strtotime($row[field6]));
		$fcontents = str_replace("ENNEYEARS", $enneyears, $fcontents);
		$fcontents = str_replace("FROMDATE",  $row[field6], $fcontents);
		$fcontents = str_replace("UNTILDATE", date("d.m.Y",$unitldate), $fcontents);
		header("Content-Type: application/vnd.ms-word");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=$nomefile.doc");		
    echo $fcontents;
		die();
	}else{
		header("Location: $_GET[nomefile]");
		die();
	}
}

include("header.php");

$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$act = $_GET[act];
$id = $_GET[id];
$idcliente = $_GET[idcliente];
$pag = $_GET[pag];
$ord = $_GET[ord];
$tablename = "nuke_offerte";

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
$field12 = $_GET[field12];
$field13 = $_GET[field13];
$field14 = $_GET[field14];
$field15 = $_GET[field15];
$field16 = $_GET[field16];
$field17 = $_GET[field17];
$rinnovo = $_GET[rinnovo];
$valuta = $_GET[valuta];
$franchigia = $_GET[franchigia];
$data = $_GET[data];

$field11 = 1+((strtotime($field10) - strtotime($field6)) / 86400);
if ($act == 'gosearch') $field11='';

//if ($field4=='') { $_GET[field4] = $field3; $field4 = $field3; }
//if ($field5=='') { $_GET[field5] = $field3; $field5 = $field3; }

$sql3 = "update nuke_offerte set field8=(select sum(cast(somma as int)) from nuke_offerte_detail1 where idofferta='$id') where id='$id'";
$result = $db->sql_query($sql3);
$sql4 = "update nuke_offerte set field12=(select sum(cast(premio as int)) from nuke_offerte_detail1 where idofferta='$id') where id='$id'";
$result = $db->sql_query($sql4);

title("$sitename: Gestione <i>proposte</i> LLOYD'S");

?>
	<script>
		if (navigator.appName=='Netscape') {
			if (screen.height>1000) allora=screen.height-260;
			if (screen.height<1000) allora=screen.height-290;
			document.write('<div class="offerte" id="offerte" style="position:relative;width:100%;margin-top:0;  _position:absolute;_top:expression(eval(document.body.scrollTop)+58);height:'+allora+'px;overflow:auto;padding:0px;">');
		}
		if (navigator.appName=='Microsoft Internet Explorer') {
			if (window.document.documentElement.offsetHeight>1000) allora=window.document.documentElement.offsetHeight-200;
			if (window.document.documentElement.offsetHeight<1000) allora=window.document.documentElement.offsetHeight-200;
			document.write('<div class="offerte" id="offerte" style="position:relative;width:100%;margin-top:100;_position:absolute;_top:expression(eval(document.body.scrollTop)+58);height:'+allora+'px;overflow:auto;padding:0px;">');
		}
	</script>
<?php

	if ($act=='sav'){
	$sql = "UPDATE " . $tablename . " SET  data='" . $_GET[data] . "', franchigia='" . $_GET[franchigia] . "', valuta='" . $_GET[valuta] . "' , field1='" . $_GET[field1] . "' , field2='" . $_GET[field2] . "' , field3='" . $_GET[field3] . "' , field4='" . $_GET[field4] . "' , field5='" . $_GET[field5] . "' , field6='" . $_GET[field6] . "' , field7='" . $_GET[field7] . "' , field8='" . $_GET[field8] . "' , field9='" . $_GET[field9] . "' , field10='" . $_GET[field10] . "' , field11='" . $field11 . "' , field17='" . $field17 . "', rinnovo='" . $rinnovo . "' where id = '" . $id . "'";
		$result = $db->sql_query($sql);
		$act = 'explode';
	}
	if ($act == 'del'){
		$sql = "SELECT * FROM nuke_polizze where id=$id";
		$rs = $db->sql_query($sql);
		$nr = $db->sql_numrows($rs);
		if ($nr==0) {
			$sql = "DELETE FROM " . $tablename . " WHERE ID = " . $id;
			$result = $db->sql_query($sql);
			$id = '';
			$act = '';
		}else{
			$msg='Non è possibile eliminare questa offerta perchè esiste una polizza associata';
			echo "
			<script>
			alert('$msg');
			</script>
			";
		}
	}
	if ($act=='savnew'){
		$sql = "INSERT INTO " . $tablename . " (data,franchigia,valuta,field1,field2,field3,field4,field5,field6,field7,field8,field9,field10,field11,rinnovo,field17) VALUES ('" . $_GET[data] . "','" . $_GET[franchigia] . "','" . $_GET[valuta] . "','" . $_GET[field1] . "','" . $_GET[field2] . "','" . $_GET[field3] . "','" . $_GET[field4] . "','" . $_GET[field5] . "','" . $_GET[field6] . "','" . $_GET[field7] . "','" . $_GET[field8] . "','" . $_GET[field9] . "','" . $_GET[field10] . "','" . $field11 . "','" . $rinnovo. "','" . $_GET[field17] . "')";
		$result = $db->sql_query($sql);
		$rs = $db->sql_fetchrow($db->sql_query("SELECT id,field2,field3,field4 FROM nuke_offerte order by id DESC"));
		$id = $rs[id];
		$idpolizza = $rs[field2];
		$stipulante = $rs[field3];
		$assicurato = $rs[field4];
		$act = "explode";
		//inserisco le CGA di default
		if ($idpolizza=='18') {
			$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','36','CGA')";
			$result = $db->sql_query($sql);
			$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','39','CGA')";
			$result = $db->sql_query($sql);
		}
		if ($idpolizza=='19') {
			$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','44','CGA')";
			$result = $db->sql_query($sql);
		}
		if ($idpolizza=='21') {
			$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','51','CGA')";
			$result = $db->sql_query($sql);
		}
		//inserisco i luoghi di rischio di default
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
		
		header("Location: gestionale.php?name=lloyds&subname=offerte&act=$act&id=$id");
	}
	if ($act == 'new') $id='err';
	if ($act == 'explode') {
		if ($id != '') $condizioni = " WHERE id='$id' ";
	}
	
	if ($act=='gosearch') {
		$condizioni = " WHERE 1 ";
		if ($field1 != '') $condizioni .= " AND field1='$field1' ";
		if ($field2 != '') $condizioni .= " AND field2='$field2' ";
		if ($field3 != '') $condizioni .= " AND field3='$field3' ";
		if ($field4 != '') $condizioni .= " AND field4='$field4' ";
		if ($field5 != '') $condizioni .= " AND field5='$field5' ";
		if ($field6 != '') $condizioni .= " AND field6='$field6' ";
		if ($field7 != '') $condizioni .= " AND field7='$field7' ";
		if ($field8 != '') $condizioni .= " AND field8='$field8' ";
		if ($field9 != '') $condizioni .= " AND field9='$field9' ";
		if ($field10 != '') $condizioni .= " AND field10='$field10' ";
		if ($field11 != '') $condizioni .= " AND field11='$field11' ";
		if ($field17 != '') $condizioni .= " AND field17='$field17' ";
		if ($valuta != '') $condizioni .= " AND valuta='$valuta' ";
		if ($franchigia != '') $condizioni .= " AND franchigia='$franchigia' ";
		if ($data != '') $condizioni .= " AND data='$data' ";
		if ($rinnovo != '') $condizioni .= " AND rinnovo='$rinnovo' ";
	}
	$x_pag = 100000; //numero massimo di record per pagina
	if ($pag=='') $pag = 1; //prendo il numero di pagina dal query string e se non c'è lo setto a 1
	if ($act=='mod') $pag=1;
	if ($act=='explode') $pag=1;
	if ($ord=='') $ord = 'id';
	
	$sql = "SELECT * FROM $tablename $condizioni";
	$query = $db->sql_query($sql);
	$all_rows = $db->sql_numrows($query);

	$all_pages = ceil($all_rows / $x_pag);
	$first = ($pag - 1) * $x_pag;
	$sql = "SELECT * FROM $tablename $condizioni ORDER BY $ord DESC LIMIT $first, $x_pag";
	//echo $sql;
	$rs = $db->sql_query($sql);
	$nr = $db->sql_numrows($rs);

	OpenTable();
	echo '<p>';
	echo '<input type=button value="Nuovo Record" onclick="location.href=' . chr(39) . 'gestionale.php?name=lloyds&subname=offerte&act=new&ord=' . $ord . '&pag='. $pag . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
	echo '<input type=button value="Ricerca" onclick="location.href=' . chr(39) . 'gestionale.php?name=lloyds&subname=offerte&act=search&ord=' . $ord . '&pag='. $pag . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
	echo '<input type=button value="Mostra tutti i record" onclick="location.href=' . chr(39) . 'gestionale.php?name=lloyds&subname=offerte' . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
	if ($act=='explode') {
		echo "<input onClick=javascript:ricalcola(); type=button name=refresh value=Ricalcola>";
		echo "<input onClick=javascript:stampa($_GET[id]) type=button name=stampa value=Stampa>";
		echo "<input type=button name=completa value=Consolida onClick=javascript:consolida($_GET[id]);>";
	}
	echo '</p>';

	echo '<p align=center><table width=100% border=1 cellspacing=0 cellpadding=0>';
	echo '<tr>';
	echo "<th width=10%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=offerte&ord=field1>Numero proposta</a><br><select name=field1_ric onChange=location.href='gestionale.php?name=lloyds&subname=offerte&act=gosearch&field1='+this.value><option value='2012'>2012</option><option selected value='2013'>2013</option><option value='2014'>2014</option>";
	if ($field1!='' && $act=='gosearch') echo "<option selected value=$field1>$field1</option>";
	echo "</select></th>";
	echo '<th width=15%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=offerte&ord=field2>Tipo di assicurazione</a></th>';
	echo '<th width=20%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=offerte&ord=field3>Nominativo</a></th>';
	echo '<th width=10%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=offerte&ord=field6>Periodo di copertura</a></th>';
	echo '<th width=10%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=offerte&ord=field7>Limiti territoriali</a></th>';
	echo '<th width=5%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=offerte&ord=valuta>Valuta</a></th>';
	echo '<th width=5%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=offerte&ord=franchigia>Franchigia</a></th>';
	echo '<th width=10%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=offerte&ord=rinnovo>Rinnovo</a></th>';
	echo '<th width=10%><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=offerte&ord=data>Firma proposta</a></th>';
	echo '<th width=10% colspan=3><font face=verdana size=2 color=blue>Funzionalità</font></th>';
	echo '</tr>';

	if ($act == 'new') {
		echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=subname value=offerte><input type=hidden name=name value=lloyds><input type=hidden name=pag value=' . $pag . '><input type=hidden name=act value=savnew>';
		echo '<tr>';
		echo "<td valign=middle align=center><input type=hidden name=field1 value='".date('Y')."'>".date(Y)."/...</td>";
		echo "<td valign=middle align=center><select name=field2><option value=''></option>";
		$sql_polizze = "SELECT * FROM nuke_tipologiepolizze";
		$rs_polizze = $db->sql_query($sql_polizze);
		while ($polizze = $db->sql_fetchrow($rs_polizze))
		{
			echo "<option value='".$polizze[id]."'>".$polizze[field2]."</option>";
		}
		echo "</select></td>";
		echo "<td valign=middle align=center><font face=verdana size=2>Stipulante:<br><select name=field3 onchange=elabora(this.value);><option value=''></option>";
		echo "<option value='new'>NUOVO NOMINATIVO</option>";
		echo "<option value='-'>-------------------</option>";
		$sql_customer = "SELECT * FROM nuke_clienti where ragione_sociale<>'' order by ragione_sociale";
		$rs_customer = $db->sql_query($sql_customer);
		while ($customer = $db->sql_fetchrow($rs_customer))
		{
			if ($_GET[idcliente]==$customer[id]) $selected=" SELECTED ";
			if ($customer[ragione_sociale]=='') $testo = $customer[cognome]." ".$customer[nome];
			if ($customer[ragione_sociale]!='') $testo = $customer[ragione_sociale];
			echo "<option $selected value='".$customer[id]."'>".$testo."</option>";
			$selected='';
		}
		echo "<option value='-'>-------------------</option>";
		$sql_customer = "SELECT * FROM nuke_clienti where ragione_sociale='' order by cognome";
		$rs_customer = $db->sql_query($sql_customer);
		while ($customer = $db->sql_fetchrow($rs_customer))
		{
			if ($_GET[idcliente]==$customer[id]) $selected=" SELECTED ";
			if ($customer[ragione_sociale]=='') $testo = $customer[cognome]." ".$customer[nome];
			if ($customer[ragione_sociale]!='') $testo = $customer[ragione_sociale];
			echo "<option $selected value='".$customer[id]."'>".$testo."</option>";
			$selected='';
		}
		echo "</select><br>";
		echo "<font face=verdana size=2>Assicurato:<br><select name=field4 onchange=elabora(this.value);><option value=''></option>";
		echo "<option value='new'>NUOVO NOMINATIVO</option>";
		echo "<option value='-'>-------------------</option>";
		$sql_customer = "SELECT * FROM nuke_clienti where ragione_sociale<>'' order by ragione_sociale";
		$rs_customer = $db->sql_query($sql_customer);
		while ($customer = $db->sql_fetchrow($rs_customer))
		{
			if ($idcliente==$customer[id]) $selected=" SELECTED ";
			if ($customer[ragione_sociale]=='') $testo = $customer[cognome]." ".$customer[nome];
			if ($customer[ragione_sociale]!='') $testo = $customer[ragione_sociale];
			echo "<option $selected value='".$customer[id]."'>".$testo."</option>";
			$selected='';
		}
		echo "<option value='-'>-------------------</option>";
		$sql_customer = "SELECT * FROM nuke_clienti where ragione_sociale='' order by cognome";
		$rs_customer = $db->sql_query($sql_customer);
		while ($customer = $db->sql_fetchrow($rs_customer))
		{
			if ($idcliente==$customer[id]) $selected=" SELECTED ";
			if ($customer[ragione_sociale]=='') $testo = $customer[cognome]." ".$customer[nome];
			if ($customer[ragione_sociale]!='') $testo = $customer[ragione_sociale];
			echo "<option $selected value='".$customer[id]."'>".$testo."</option>";
			$selected='';
		}
		echo "</select><br>";
		echo "<font face=verdana size=2>Assicurato:<br><input type=text name=field5 size=30>";
		//$sql_customer = "SELECT * FROM nuke_clienti";
		//$rs_customer = $db->sql_query($sql_customer);
		//while ($customer = $db->sql_fetchrow($rs_customer))
		//{
			//if ($idcliente==$customer[id]) $selected=" SELECTED ";
			//echo "<option $selected value='".$customer[id]."'>".$customer[ragione_sociale]." - ".$customer[cognome]." ".$customer[nome]."</option>";
			//$selected="";
		//}
		//echo "</select>";
		echo "</td>";
		echo "<td valign=middle align=center>";
		echo "Da:<br><input type=text name=field6 id=sel3 size=11><input type=reset value='.'";
		?> onclick="return showCalendar('sel3', '%d.%m.%Y');" <?php echo ">";
		echo "<br>";
		echo "A:<br><input type=text name=field10 id=sel4 size=11><input type=reset value='.'";
		?> onclick="return showCalendar('sel4', '%d.%m.%Y');" <?php echo ">";
		echo "</td>";
		echo "<td valign=middle align=center><select name=field7><option value=''></option>";
		$sql_limititerritoriali = "SELECT * FROM nuke_limititerritoriali";
		$rs_limititerritoriali = $db->sql_query($sql_limititerritoriali);
		while ($limititerritoriali = $db->sql_fetchrow($rs_limititerritoriali))
		{
			echo "<option value='".$limititerritoriali[id]."'>".$limititerritoriali[field1]."</option>";
		}
		echo "</select><br><input type=text name=field17 size=20></td>";
		echo "<td valign=middle align=center><select name=valuta><option selected value='CHF'>CHF</option><option value='EUR'>EUR</option><option value='USD'>USD</option><option value='GBP'>GBP</option></td>";
		echo "<td valign=middle align=center><input type=text name=franchigia size=5></td>";
		echo "<td valign=middle align=center><select name=rinnovo><option value=1>Si</option><option value=0>No</option></td>";
		echo "<td valign=middle align=center>";
		echo "<input type=text name=data id=sel5 size=11><input type=reset value='.'";
		?> onclick="return showCalendar('sel5', '%d.%m.%Y');" <?php echo ">";
		echo "</td>";
		echo "<td colspan=3 align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><br><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
		echo '</tr>';
		echo '</form>';
		$act = '';
	}
	if ($act == 'search') {
		echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=name value=lloyds><input type=hidden name=subname value=offerte>';
		echo '<input type=hidden name=pag value=' . $pag . '>';
		echo '<input type=hidden name=act value=gosearch>';
		echo '<tr>';
		echo "<td valign=middle align=center><input size=4 type=text name=field1>/<input size=3 type=text name=id></td>";
		echo "<td valign=middle align=center><select name=field2><option value=''></option>";
		$sql_polizze = "SELECT * FROM nuke_tipologiepolizze";
		$rs_polizze = $db->sql_query($sql_polizze);
		while ($polizze = $db->sql_fetchrow($rs_polizze))
		{
			echo "<option value='".$polizze[id]."'>".$polizze[field2]."</option>";
		}
		echo "</select></td>";
		echo "<td valign=middle align=center><font face=verdana size=2>Stipulante:<br><select name=field3><option value=''></option>";
		echo "<option value='-'>-------------------</option>";
		$sql_customer = "SELECT * FROM nuke_clienti where ragione_sociale<>'' order by ragione_sociale";
		$rs_customer = $db->sql_query($sql_customer);
		while ($customer = $db->sql_fetchrow($rs_customer))
		{
			if ($customer[ragione_sociale]=='') $testo = $customer[cognome]." ".$customer[nome];
			if ($customer[ragione_sociale]!='') $testo = $customer[ragione_sociale];
			echo "<option value='".$customer[id]."'>".$testo."</option>";
		}
		echo "<option value='-'>-------------------</option>";
		$sql_customer = "SELECT * FROM nuke_clienti where ragione_sociale='' order by cognome";
		$rs_customer = $db->sql_query($sql_customer);
		while ($customer = $db->sql_fetchrow($rs_customer))
		{
			if ($customer[ragione_sociale]=='') $testo = $customer[cognome]." ".$customer[nome];
			if ($customer[ragione_sociale]!='') $testo = $customer[ragione_sociale];
			echo "<option value='".$customer[id]."'>".$testo."</option>";
		}
		echo "</select><br>";
		echo "<font face=verdana size=2>Assicurato:<br><select name=field4><option value=''></option>";
		echo "<option value='-'>-------------------</option>";
		$sql_customer = "SELECT * FROM nuke_clienti where ragione_sociale<>'' order by ragione_sociale";
		$rs_customer = $db->sql_query($sql_customer);
		while ($customer = $db->sql_fetchrow($rs_customer))
		{
			if ($customer[ragione_sociale]=='') $testo = $customer[cognome]." ".$customer[nome];
			if ($customer[ragione_sociale]!='') $testo = $customer[ragione_sociale];
			echo "<option value='".$customer[id]."'>".$testo."</option>";
		}
		echo "<option value='-'>-------------------</option>";
		$sql_customer = "SELECT * FROM nuke_clienti where ragione_sociale='' order by cognome";
		$rs_customer = $db->sql_query($sql_customer);
		while ($customer = $db->sql_fetchrow($rs_customer))
		{
			if ($customer[ragione_sociale]=='') $testo = $customer[cognome]." ".$customer[nome];
			if ($customer[ragione_sociale]!='') $testo = $customer[ragione_sociale];
			echo "<option value='".$customer[id]."'>".$testo."</option>";
		}
		echo "</select><br>";
		echo "<font face=verdana size=2>Assicurato:<br><input type=text size=30 name=field5>";
		//$sql_customer = "SELECT * FROM nuke_clienti";
		//$rs_customer = $db->sql_query($sql_customer);
		//while ($customer = $db->sql_fetchrow($rs_customer))
		//{
			//echo "<option value='".$customer[id]."'>".$customer[ragione_sociale]." - ".$customer[cognome]." ".$customer[nome]."</option>";
		//}
		//echo "</select>";
		echo "</td>";
		echo "<td valign=middle align=center>";
		echo "Da:<br><input type=text name=field6 id=sel3 size=11><input type=reset value='.'";
		?> onclick="return showCalendar('sel3', '%d.%m.%Y');" <?php echo ">";
		echo "<br>";
		echo "A:<br><input type=text name=field10 id=sel4 size=11><input type=reset value='.'";
		?> onclick="return showCalendar('sel4', '%d.%m.%Y');" <?php echo ">";
		echo "</td>";
		echo "<td valign=middle align=center><select name=field7><option value=''></option>";
		$sql_limititerritoriali = "SELECT * FROM nuke_limititerritoriali";
		$rs_limititerritoriali = $db->sql_query($sql_limititerritoriali);
		while ($limititerritoriali = $db->sql_fetchrow($rs_limititerritoriali))
		{
			echo "<option value='".$limititerritoriali[id]."'>".$limititerritoriali[field1]."</option>";
		}
		echo "</select><br><input type=text name=field17 size=20></td>";
		echo "<td valign=middle align=center><select name=valuta><option selected value='CHF'>CHF</option><option value='EUR'>EUR</option><option value='USD'>USD</option><option value='GBP'>GBP</option></td>";
		echo "<td valign=middle align=center><input type=text name=franchigia size=5></td>";
		echo "<td valign=middle align=center><select name=rinnovo><option value=1>Si</option><option value=0>No</option></td>";
		echo "<td valign=middle align=center>";
		echo "<input type=text name=data id=sel5 size=11><input type=reset value='.'";
		?> onclick="return showCalendar('sel5', '%d.%m.%Y');" <?php echo ">";
		echo "</td>";
		echo "<td colspan=3 align=center valign=middle><input type=submit value=Cerca style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><br><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
		echo '</tr>';
		echo '</form>';
		$act = '';
	}

	if ($nr != 0){
		while ($row = $db->sql_fetchrow($rs))
		{
			echo '<tr>';
			if ($id == $row['id'] && $act == 'mod'){
			echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=name value=lloyds><input type=hidden name=subname value=offerte><input type=hidden name=pag value=' . $pag . '><input type=hidden name=act value=sav><input type=hidden name=id value=' . $id . '>';
				echo "<input type=hidden name=field1 value=$row[field1]>";
				echo "<td valign=middle align=center>$row[field1]/$row[id]</td>";
				echo "<td valign=middle align=center><select name=field2><option value=''></option>";
				$sql_polizze = "SELECT * FROM nuke_tipologiepolizze";
				$rs_polizze = $db->sql_query($sql_polizze);
				while ($polizze = $db->sql_fetchrow($rs_polizze))
				{
					if ($row[field2]==$polizze[id]) $selected = 'SELECTED';
					echo "<option $selected value='".$polizze[id]."'>".$polizze[field2]."</option>";
					$selected='';
				}
				echo "</select></td>";
				echo "<td valign=middle align=center><font face=verdana size=2>Stipulante:<br><select name=field3 onchange=elabora(this.value);><option value=''></option>";
				echo "<option value='new'>NUOVO NOMINATIVO</option>";
				echo "<option value='-'>-------------------</option>";
				$sql_customer = "SELECT * FROM nuke_clienti where ragione_sociale<>'' order by ragione_sociale";
				$rs_customer = $db->sql_query($sql_customer);
				while ($customer = $db->sql_fetchrow($rs_customer))
				{
					if ($row[field3]==$customer[id]) $selected=" SELECTED ";
					if ($customer[ragione_sociale]=='') $testo = $customer[cognome]." ".$customer[nome];
					if ($customer[ragione_sociale]!='') $testo = $customer[ragione_sociale];
					echo "<option $selected value='".$customer[id]."'>".$testo."</option>";
					$selected='';
				}
				echo "<option value='-'>-------------------</option>";
				$sql_customer = "SELECT * FROM nuke_clienti where ragione_sociale='' order by cognome";
				$rs_customer = $db->sql_query($sql_customer);
				while ($customer = $db->sql_fetchrow($rs_customer))
				{
					if ($row[field3]==$customer[id]) $selected=" SELECTED ";
					if ($customer[ragione_sociale]=='') $testo = $customer[cognome]." ".$customer[nome];
					if ($customer[ragione_sociale]!='') $testo = $customer[ragione_sociale];
					echo "<option $selected value='".$customer[id]."'>".$testo."</option>";
					$selected='';
				}
				echo "</select><br>";
				echo "<font face=verdana size=2>Assicurato:<br><select name=field4 onchange=elabora(this.value);><option value=''></option>";
				echo "<option value='new'>NUOVO NOMINATIVO</option>";
				echo "<option value='-'>-------------------</option>";
				$sql_customer = "SELECT * FROM nuke_clienti where ragione_sociale<>'' order by ragione_sociale";
				$rs_customer = $db->sql_query($sql_customer);
				while ($customer = $db->sql_fetchrow($rs_customer))
				{
					if ($row[field4]==$customer[id]) $selected=" SELECTED ";
					if ($customer[ragione_sociale]=='') $testo = $customer[cognome]." ".$customer[nome];
					if ($customer[ragione_sociale]!='') $testo = $customer[ragione_sociale];
					echo "<option $selected value='".$customer[id]."'>".$testo."</option>";
					$selected='';
				}
				echo "<option value='-'>-------------------</option>";
				$sql_customer = "SELECT * FROM nuke_clienti where ragione_sociale='' order by cognome";
				$rs_customer = $db->sql_query($sql_customer);
				while ($customer = $db->sql_fetchrow($rs_customer))
				{
					if ($row[field4]==$customer[id]) $selected=" SELECTED ";
					if ($customer[ragione_sociale]=='') $testo = $customer[cognome]." ".$customer[nome];
					if ($customer[ragione_sociale]!='') $testo = $customer[ragione_sociale];
					echo "<option $selected value='".$customer[id]."'>".$testo."</option>";
					$selected='';
				}
				echo "</select><br>";
				echo "<font face=verdana size=2>Assicurato:<br><input type=text name=field5 value='$row[field5]'>";
				//$sql_customer = "SELECT * FROM nuke_clienti";
				//$rs_customer = $db->sql_query($sql_customer);
				//while ($customer = $db->sql_fetchrow($rs_customer))
				//{
					//if ($row[field5]==$customer[id]) $selected = 'SELECTED';
					//echo "<option $selected value='".$customer[id]."'>".$customer[ragione_sociale]." - ".$customer[cognome]." ".$customer[nome]."</option>";
					//$selected='';
				//}
				//echo "</select>";
				echo "</td>";
				echo "<td valign=middle align=center>";
				echo "Da:<br><input type=text name=field6 value='$row[field6]' id='sel3' size=11><input type=reset value='.'";
				?> onclick="return showCalendar('sel3', '%d.%m.%Y');" <?php echo ">";
				echo "<br>";
				echo "A:<br><input type=text name=field10 value='$row[field10]' id='sel4' size=11><input type=reset value='.'";
				?> onclick="return showCalendar('sel4', '%d.%m.%Y');" <?php echo ">";
				echo "</td>";
				echo "<td valign=middle align=center><select name=field7><option value=''></option>";
				$sql_limititerritoriali = "SELECT * FROM nuke_limititerritoriali";
				$rs_limititerritoriali = $db->sql_query($sql_limititerritoriali);
				while ($limititerritoriali = $db->sql_fetchrow($rs_limititerritoriali))
				{
					if ($row[field7]==$limititerritoriali[id]) $selected = 'SELECTED';
					echo "<option $selected value='".$limititerritoriali[id]."'>".$limititerritoriali[field1]."</option>";
					$selected='';
				}
				echo "</select><br><input type=text name=field17 size=20 value='$row[field17]'></td>";
				echo "<td valign=middle align=center><select name=valuta><option selected value='$row[valuta]'>$row[valuta]</option><option value='CHF'>CHF</option><option value='EUR'>EUR</option><option value='USD'>USD</option><option value='GBP'>GBP</option></td>";
				echo "<td valign=middle align=center><input type=text name=franchigia size=5 value='$row[franchigia]'></td>";
				echo "<td valign=middle align=center><select name=rinnovo><option ";
				if ($row[rinnovo]=='1') echo "SELECTED";
				echo " value=1>Si</option><option ";
				if ($row[rinnovo]=='0') echo "SELECTED";
				echo " value=0>No</option></td>";
				echo "<td valign=middle align=center>";
				echo "<input type=text name=data value='$row[data]' id=sel5 size=11><input type=reset value='.'";
				?> onclick="return showCalendar('sel5', '%d.%m.%Y');" <?php echo ">";
				echo "</td>";
				echo "<td colspan=3 align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><br><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
			echo '</form>';
			}else{
				echo "<td valign=middle align=center><font face=verdana size=2>" . $row[field1] . "/" . $row[id] . "</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>";
				$sql_polizze = "SELECT * FROM nuke_tipologiepolizze where id='". $row[field2] ."'";
				$rs_polizze = $db->sql_query($sql_polizze);
				$polizze = $db->sql_fetchrow($rs_polizze);
				echo $polizze[field2];
				echo "</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>";
				$sql_nominativo = "SELECT * FROM nuke_clienti where id='".$row[field3]."'";
				$rs_nominativo = $db->sql_query($sql_nominativo);
				$nominativo = $db->sql_fetchrow($rs_nominativo);
				if ($row[field3]!='') {
					echo "Stipulante: <strong>";
					if ($nominativo[ragione_sociale]!='') echo $nominativo[ragione_sociale]." - ";
					echo $nominativo[cognome]." ".$nominativo[nome]."</strong>";
				}
				$sql_nominativo = "SELECT * FROM nuke_clienti where id='".$row[field4]."'";
				$rs_nominativo = $db->sql_query($sql_nominativo);
				$nominativo = $db->sql_fetchrow($rs_nominativo);
				if ($row[field4]!='') {
					echo "<hr>";
					echo "Assicurato: <strong>";
					if ($nominativo[ragione_sociale]!='') echo $nominativo[ragione_sociale]." - ";
					echo $nominativo[cognome]." ".$nominativo[nome]."</strong>";
				}
				if ($row[field5]!='') {
					echo "<hr>";
					echo "Assicurato: ";
					echo "<strong>".$row[field5]."</strong>";
				}
				echo "</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>Da: " . $row[field6] . "<br>A: " . $row[field10] . "<br>Differenza gg: " . number_format($row[field11],0,'','') . "</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>";
				$sql_limititerritoriali = "SELECT * FROM nuke_limititerritoriali where id='". $row[field7] ."'";
				$rs_limititerritoriali = $db->sql_query($sql_limititerritoriali);
				$limititerritoriali = $db->sql_fetchrow($rs_limititerritoriali);
				echo $limititerritoriali[field1];
				echo "<br>$row[field17]</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>$row[valuta]</font></td>";
				echo "<td valign=middle align=center><font face=verdana size=2>$row[franchigia]</font></td>";
				echo "<td valign=middle align=center><font face=verdana size=2>";
				if ($row[rinnovo]=='1') echo "Si"; if ($row[rinnovo]=='0') echo "No";
				echo "</td>";
				echo "<td valign=middle align=center><font face=verdana size=2>$row[data]</font></td>";
				echo "<td align=center valign=middle><font face=verdana size=2><a href=# onClick=modify($row[id],eval(document.getElementById('offerte').scrollTop),$ord,$pag);><img border=0 src=immagini/modify.png></a></td>";
				echo "<td align=center valign=middle><font face=verdana size=2><a href=# onClick=remove($row[id],eval(document.getElementById('offerte').scrollTop),$ord,$pag);><img border=0 src=immagini/remove.png></a></td>";
				echo "<td align=center valign=middle><font face=verdana size=2><a href=gestionale.php?name=lloyds&subname=offerte&ord=" . $ord . "&pag=" . $pag . "&act=explode&id=" . $row[id] . "#sonoqui><img border=0 src=immagini/select.png></a></td>";
				if ($row[rinnovo]=='1') {
					$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta=$id AND field1='41'";
					$result = $db->sql_query($sql);
					$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','41','CGA')";
					$result = $db->sql_query($sql);
				}
				if ($row[rinnovo]=='0') {
					$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta=$id AND field1='41'";
					$result = $db->sql_query($sql);
				}
			}
			echo '</tr>';
			if ($act=='explode') {
				$valuta = $row[valuta];
				echo "</table>";
				CloseTable();
				if ($_GET[view]=='') $_GET[view]='beni';
				if ($_GET[view]=='CGA') $strong1='<font color=black><strong>->';
				if ($_GET[view]=='beni') $strong2='<font color=black><strong>->';
				if ($_GET[view]=='domande') $strong3='<font color=black><strong>->';
				if ($_GET[view]=='cifre') $strong4='<font color=black><strong>->';
				if ($_GET[view]=='LDR') $strong0='<font color=black><strong>->';
				
				if ($_GET[view]=='stampa') {
					$pag='';
					title("<center>
								<input type=button value=Indietro onclick=location.href='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]'>
								<input type=button value=Stampa onclick=location.href='gestionale.php?name=stampa_offerte&id=$_GET[id]&pag=1'>
								</center>
								");
				} else {
					title("
					<table width=100% cellspacing=0 cellpadding=0 border=0 bgcolor=#FFA200>
						<td width=20% align=center valign=middle>
							<a href=gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id&view=CGA#sonoqui>$strong1 CONDIZIONI GENERALI</strong></a>
						</td>
						<td width=20% align=center valign=middle><font size=3 face=verdana>
							<a href=gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id&view=LDR#sonoqui>$strong0 LUOGHI DI RISCHIO</strong></a>
						</td>
						<td width=20% align=center valign=middle><font size=3 face=verdana>
							<a href=gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id&view=beni#sonoqui>$strong2 BENI ASSICURATI</strong></a>
						</td>
						<td width=20% align=center valign=middle><font size=3 face=verdana>
							<a href=gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id&view=domande#sonoqui>$strong3 DOMANDE PROPOSTA</strong></a>
						</td>
						<td width=20% align=center valign=middle><font size=3 face=verdana>
							<a href=gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id&view=cifre#sonoqui><font size=3>$strong4 RIEPILOGO CIFRE</strong></a>
						</td>
					</table>
					");
				}
				?>
				<script>
					if (navigator.appName=='Netscape') {
						if (screen.height>1000) allora=screen.height-480;
						if (screen.height<1000) allora=screen.height-500;
						document.write('<div class="offerte_detail_1" id="offerte_detail_1" style="position:relative;width:100%;margin-top:0;  _position:absolute;_top:expression(eval(document.body.scrollTop)+58);height:'+allora+'px;overflow:auto;padding:0px;">');
					}
					if (navigator.appName=='Microsoft Internet Explorer') {
						if (window.document.documentElement.offsetHeight>1000) allora=window.document.documentElement.offsetHeight-400;
						if (window.document.documentElement.offsetHeight<1000) allora=window.document.documentElement.offsetHeight-400;
						document.write('<div class="offerte_detail_1" id="offerte_detail_1" style="position:relative;width:100%;margin-top:130;_position:absolute;_top:expression(eval(document.body.scrollTop)+58);height:'+allora+'px;overflow:auto;padding:0px;">');
					}
				</script>
				<?php
				if ($_GET[view]=='LDR') include('detail_luoghidirischio.php');
				if ($_GET[view]=='CGA') include('dettagli_offerte_cga.php');
				if ($_GET[view]=='beni') include('dettagli_offerte_1.php');
				if ($_GET[view]=='domande') include('dettagli_offerte_2.php');		
				if ($_GET[view]=='cifre') include('dettagli_offerte_3.php');
				if ($_GET[view]=='stampa') {
					echo "<center><table width=100% border=0><td bgcolor=white>";
					include("/template/rva1.htm");
					echo "</td></table></center>";
				}
				?>
				<script language=JavaScript>
					document.getElementById("offerte_detail_1").scrollTop=<?php echo $_GET[scrolltop]; ?>;
				</script>
				<?php
				echo "</div>";
			}
		}
	}
echo '</p>';

?>

<script language=JavaScript>
	document.getElementById("offerte").scrollTop=<?php echo $_GET[scrolltop]; ?>;
</script>

<?php
echo "</div>";
?>