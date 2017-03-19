<?php
//inizializzo il reordset dell'offerta per i vari calcoli
$sql = "SELECT * FROM nuke_offerte where id='$_GET[id]'";
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);

$act = $_GET[act];
$id = $_GET[id];
$idcliente = $_GET[idcliente];
$pag = $_GET[pag];
$ord = $_GET['ord'];
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
$field11 = round(1+((strtotime($row[field10]) - strtotime($row[field6])) / 86400));
$blocca = $row[blocca];

if ($act=='') $act='search';
if ($row[rinnovo]=='1') {
	if ($row[field14]=='5') $enneyears='3';
	if ($row[field14]=='10') $enneyears='5';
	if ($row[field14]<'8') $enneyears='3';
	if ($row[field14]>'8') $enneyears='5';
	if ($enneyears=='3') $unitldate=strtotime('+3 years',strtotime($row[field6]));
	if ($enneyears=='5') $unitldate=strtotime('+5 years',strtotime($row[field6]));
}
if ($row[rinnovo]=='1' && $row[field2]=='18') {
	$sql1 = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id' AND field1='65'";
	$result = $db->sql_query1($sql1);
	$sql2 = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','65','CGA')";
	$result = $db->sql_query1($sql2);
}
if ($row[rinnovo]=='0' && $row[field2]=='18') {
	$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id' AND field1='65'";
	$result = $db->sql_query($sql);
}
//etichetta e rimborso
if ($_GET[rimborso]!='') {
	$sqlr = "update nuke_offerte set etichetta='".trim($_GET[etichetta])."', rimborso='".trim($_GET[rimborso])."' where id='$id'";
	$result = $db->sql_query1($sqlr);
	if ($_GET[rimborso]=='elimina') {
		$sqlr = "update nuke_offerte set etichetta='', rimborso='' where id='$id'";
		$result = $db->sql_query1($sqlr);
	}
}
//ricalcolo dei campi per sicurezza
$sql2 = "update nuke_offerte set field11='$field11' where id='$id'";
$result = $db->sql_query1($sql2);

//All Risk
if ($row[field2]=='18') {
	$sql3 = "update nuke_offerte set field8=(select sum(cast(somma as int)) from nuke_offerte_detail1 where idofferta='$id') where id='$id'";
	$result = $db->sql_query1($sql3);
	$sql4 = "update nuke_offerte set field12=(select sum(cast(premio as decimal(18,2))) from nuke_offerte_detail1 where idofferta='$id') where id='$id'";
	$result = $db->sql_query1($sql4);
}
//House Content
if ($row[field2]=='21') {
	$sql3 = "update nuke_offerte set field8=(select sum(cast(somma as int)) from nuke_offerte_detail1 where idofferta='$id') where id='$id'";
	$result = $db->sql_query1($sql3);
	$sql4 = "update nuke_offerte set field12=(select sum(cast(premio as decimal(18,2))) from nuke_offerte_detail1 where idofferta='$id' and premio <>'' and premio is not null) where id='$id'";
	$result = $db->sql_query1($sql4);
}

//Malicious Damage
if ($row[field2]=='20') {
	$sql3 = "update nuke_offerte set field8=(select sum(cast(somma as int)) from nuke_offerte_detail1 where idofferta='$id') where id='$id'";
	$result = $db->sql_query1($sql3);
	$sql4 = "update nuke_offerte set field12=(select sum(cast(premio as decimal(18,2))) from nuke_offerte_detail1 where idofferta='$id') where id='$id'";
	$result = $db->sql_query1($sql4);
}

//Personal Accident
if ($row[field2]=='19') {
	//cerco i gruppi registrati
	$sql = "select distinct gruppo from nuke_offerte_detail_coperture where idofferta='$id'";
	$resulta = $db->sql_query1($sql);
	$records = $db->sql_numrows($resulta); 

	for ($x=0;$x<$records;$x++) {
		$rowgruppi = $db->sql_fetchrow($resulta);
		
		//cerco quanti nominativi ci sono in un dato gruppo
		$sqla = "select * from nuke_offerte_detail_persone where idofferta='$id' and gruppo='$rowgruppi[gruppo]'";
		$result = $db->sql_query1($sqla);
		$numbers = $db->sql_numrows($result);

		$sqlimporto = "select sum(cast(importo as int))*$numbers as importo from nuke_offerte_detail_coperture where idofferta='$id' and gruppo='$rowgruppi[gruppo]'";
		$result = $db->sql_query1($sqlimporto);
		$rowimporto=$db->sql_fetchrow($result);
		$importo = $rowimporto[importo];
		
		$sqlpremio = "select sum(cast(premio as float))*$numbers as premio from nuke_offerte_detail_coperture where idofferta='$id' and gruppo='$rowgruppi[gruppo]'";
		$result = $db->sql_query1($sqlpremio);
		$rowpremio=$db->sql_fetchrow($result);
		$premio = $rowpremio[premio];
		
		$importo_totale+=$importo;
		$premio_totale+=$premio;
	}

	//update dei records degli importi in base ai calcoli
	$sql = "update nuke_offerte set field8='$importo_totale' where id='$id'";
	$result = $db->sql_query1($sql);
	$sql = "update nuke_offerte set field12='$premio_totale' where id='$id'";
	$result = $db->sql_query1($sql);
}


//reinizializzo il recordset dopo gli update fatti
$sql = "SELECT * FROM nuke_offerte where id='$id'";
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);

//ulteriore update sui campi calcolati
$ribassato = $row[field12]-($row[field12]*$row[field14]/100);
$row[field13]=str_replace(",",".",$row[field13]);
$field15 = $ribassato+($ribassato*$row[field13]/100);
$sql5 = "update nuke_offerte set field15='$field15' where id='$id'";
$result = $db->sql_query1($sql5);
//reinizializzo il recordset dopo gli update fatti
$sql = "SELECT * FROM nuke_offerte where id='$id'";
$rs = $db->sql_query($sql);
$row = $db->sql_fetchrow($rs);


//lancio le stampe
if ($_GET[nomefile]!='') {
	if ($_GET[nomefile]=='/upload/AR - PROPOSAL FORM.pdf' || $_GET[nomefile]=='template/rva1.htm' || $_GET[nomefile]=='template/rva1_addendum.htm' || $_GET[nomefile]=='/upload/NMA_2242A_ENG_PRE_CONTRACTUAL.rtf' || $_GET[nomefile]=='/upload/NMA_2226_4_ENG_All_risk_CONDITIONS.rtf' || $_GET[nomefile]=='/upload/NMA_1658_4_ENG_RENEWAL_OFFER_CLAUSE.rtf' || $_GET[nomefile]=='/upload/NMA1740A-4_ENG_CGA_INFORTUNI_Form_K_Svizzera.rtf' || $_GET[nomefile]=='/upload/NMA 1612 - EN -  Malattia a complemento di NMA 1740.doc') {
		$nome  = strstr($_GET[nomefile],".rtf",true);
		$nome1 = strstr($_GET[nomefile],".rtf",true);
		if ($_GET[nomefile]=='/upload/AR - PROPOSAL FORM.pdf') {
			$nome  = 'template/PROPOSAL_FORM_AR';
			$nome1 = 'PROPOSAL_FORM_AR';
		}
		if ($_GET[nomefile]=='template/rva1.htm' || $_GET[nomefile]=='template/rva1_addendum.htm' ) {
			$sql = "UPDATE nuke_offerte SET stampa='1' WHERE id='$_GET[id]'";
			$result = $db->sql_query1($sql);
			$nome  = strstr($_GET[nomefile],".htm",true);
			$nome1 = "proposta_$row[field1]_$row[id]";
		}
		if ($_GET[nomefile]=='/upload/NMA 1612 - EN -  Malattia a complemento di NMA 1740.doc') {
			$nome  = "/upload/NMA_1612-EN-Malattia_a_complemento_di_NMA_1740";
			$nome1  = "/upload/NMA_1612-EN-Malattia_a_complemento_di_NMA_1740";
		}
		header("Content-Type: application/vnd.ms-word");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=$nome1.rtf");		
    include("$nome.htm");
	}else{
		header("Location: $_GET[nomefile]");
	}
die();
}

if ($act=='blocca') {
	$sql = "update nuke_offerte set blocca=1 where id='$_GET[id]'";
	$rs = $db->sql_query($sql);	
	header("Location: gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]");
}

if ($act=='duplica') {
	$rinnovato = $_GET[rinnovato];
	$addendum = $_GET[addendum];
	
	//cerco se l'id della proposta che sto duplicando ha un padre, nel caso prendo l'idpadre e lo inserisco come id padre di quella nuova
	$sql = "SELECT * from nuke_offerte where id='$id' ";
	$rs1 = $db->sql_query($sql);
	$row1 = $db->sql_fetchrow($rs1);
	$idpadre = $row1[idpadre];
	$scad_naturale = date("Y",strtotime($row1[field10]));
	if ($idpadre!='') {
		$sql_idpadre="SELECT * FROM nuke_offerte where id='$idpadre'";
		$rs_idpadre = $db->sql_query($sql_idpadre);
		$row_idpadre = $db->sql_fetchrow($rs_idpadre);
		if ($row_idpadre[field14]=='5') $enneyears='3';
		if ($row_idpadre[field14]=='10') $enneyears='5';
		if ($row_idpadre[field14]<'8') $enneyears='3';
		if ($row_idpadre[field14]>'8') $enneyears='5';
		if ($enneyears=='3') $unitldate=strtotime('+3 years',strtotime($row_idpadre[field6]));
		if ($enneyears=='5') $unitldate=strtotime('+5 years',strtotime($row_idpadre[field6]));
		$scad_clausola = date("Y",$unitldate);
	}
	
	if ($scad_clausola==$scad_naturale) {
		// duplico il record della tabella principale senza idpadre, quindi con la clausola rinnovo resettata
		$sql = "INSERT INTO nuke_offerte (company,data,franchigia,valuta,field1,field2,field3,field4,field5,field6,field7,field8,field9,field10,field11,field12,field13,field14,field15,field16,rinnovo,field17) SELECT company,data,franchigia,valuta,'".date("Y")."',field2,field3,field4,field5,field6,field7,field8,field9,field10,field11,field12,field13,field14,field15,field16,rinnovo,field17 FROM nuke_offerte where id=$id";
		$messaggio="La clausola di rinnovo � scaduta, ho creato lo stesso una nuova polizza ma con le impostazioni di default della clausola.";
	} else {
		// duplico il record della tabella principale
		if ($idpadre=='' && $addendum=='1') $idpadre=$id;
		if ($idpadre=='' && $rinnovato=='1') $idpadre=$id;
		$sql = "INSERT INTO nuke_offerte (idpadre,company,data,franchigia,valuta,field1,field2,field3,field4,field5,field6,field7,field8,field9,field10,field11,field12,field13,field14,field15,field16,rinnovo,field17) SELECT $idpadre,company,data,franchigia,valuta,'".date("Y")."',field2,field3,field4,field5,field6,field7,field8,field9,field10,field11,field12,field13,field14,field15,field16,rinnovo,field17 FROM nuke_offerte where id=$id";
	}
	$result = $db->sql_query($sql);
	
	//mi tiro fuori l'ID della nuova offerta
	$sql = "SELECT * from nuke_offerte order by id DESC";
	$rs = $db->sql_query($sql);
	$rowa = $db->sql_fetchrow($rs);
	$idoffertanuova = $rowa[id];

	if ($rinnovato=='1') {
		$da = strtotime('+1 years',strtotime($rowa[field6]));
		$a = strtotime('+1 years',strtotime($rowa[field10]));
		$sql = "UPDATE nuke_offerte SET field6='".date('d.m.Y',$da)."', field10='".date('d.m.Y',$a)."' WHERE id='$idoffertanuova'";
		$result = $db->sql_query($sql);
		$sql = "UPDATE nuke_offerte SET rinnovato='$_GET[numeropolizza]' WHERE id='$idoffertanuova'";
		$result = $db->sql_query($sql);
	}elseif ($addendum=='1') {
		$sql = "UPDATE nuke_offerte SET field6='".date('d.m.Y')."', field10='".$rowa[field10]."' WHERE id='$idoffertanuova'";
		$result = $db->sql_query($sql);
		$sql = "UPDATE nuke_offerte SET addendum='$_GET[numeropolizza]' WHERE id='$idoffertanuova'";
		$result = $db->sql_query($sql);
	}
	
	//duplico i dati dalle altre tabelle
	$sql = "INSERT INTO nuke_offerte_detail1 (idcategoria,identita,idofferta,somma,tasso,premio,description) SELECT idcategoria,identita,'$idoffertanuova',somma,tasso,premio,description FROM nuke_offerte_detail1 where idofferta='$id'";
	$result = $db->sql_query($sql);
	$sql = "INSERT INTO nuke_offerte_detail_2 (idofferta,field1,field2) SELECT '$idoffertanuova',field1,field2 FROM nuke_offerte_detail_2 where idofferta='$id'";
	$result = $db->sql_query($sql);
	$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) SELECT '$idoffertanuova',field1,field2 FROM nuke_offerte_detail_cga where idofferta='$id'";
	$result = $db->sql_query($sql);
	$sql = "INSERT INTO nuke_offerte_ldr (idofferta,detail,value1,value2,value3,value4,active,spedizione) SELECT '$idoffertanuova',detail,value1,value2,value3,value4,active,spedizione FROM nuke_offerte_ldr where idofferta='$id'";
	$result = $db->sql_query($sql);
	$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) SELECT '$idoffertanuova',field1,field2 FROM nuke_offerte_detail_condizioni where idofferta='$id'";
	$result = $db->sql_query($sql);

	//cerco se ci sono degli addendum
	//$sql = "SELECT * from nuke_polizze where addendum like '$_GET[numeropolizza]%'";
	//$rs = $db->sql_query1($sql);
	//while ($row=$db->sql_fetchrow($rs)) {
		//$offerta = $row[id];
		//$sql = "INSERT INTO nuke_offerte_detail1 (idcategoria,identita,idofferta,somma,tasso,premio,description) SELECT idcategoria,identita,'$idoffertanuova',somma,tasso,premio,description FROM nuke_offerte_detail1 where idofferta='$offerta'";
		//$result = $db->sql_query($sql);
	//}


	header("Location: gestionale.php?name=lloyds&subname=offerte&act=explode&addendum=1&id=$idoffertanuova");
}

if ($act=='sav'){
	if ($blocca==1) {
		header("Location: gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id");
		exit;
	}
	$field=$_GET[field];
	$value=$_GET[value];
	$sql = "UPDATE nuke_offerte SET  $field='$value' where id='$id'";
	$result = $db->sql_query($sql);

	//se ho variato la tipologia di polizza elimino tutte le cga inserite che sono relative ad una polizza specificia
	if ($field=='field2') {
		$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id'";
		$result = $db->sql_query($sql);
	}
	//se ho variato la tipologia di polizza elimino tutti beni configurati
	if ($field=='field2') {
		$sql = "DELETE FROM nuke_offerte_detail1 WHERE idofferta='$id'";
		$result = $db->sql_query($sql);
	}
	//se ho variato la tipologia di polizza elimino tutti le persone configurate o le condizioni o le coperture
	if ($field=='field2') {
		$sql = "DELETE FROM nuke_offerte_detail_persone WHERE idofferta='$id'";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id'";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_detail_coperture WHERE idofferta='$id'";
		$result = $db->sql_query($sql);
	}

	$sql_a = "SELECT * FROM nuke_offerte WHERE id='$id'";
	$rs_a = $db->sql_query($sql_a);
	$row_a = $db->sql_fetchrow($rs_a);
	$valuta = $row_a[valuta];
	$idpolizza = $row_a[field2];
	$cliente_a = $row_a[field3];
	$cliente_b = $row_a[field4];
	$rinnovo = $row_a[rinnovo];
	$bollo = $row_a[field13];

	//clausola rinnovo update del campo field14
	if ($rinnovo=='0') {
	$sql_field14 = "update nuke_offerte set field14='' where id='$id'";
	$result = $db->sql_query1($sql_field14);	
	}
	if ($rinnovo=='1') {
	$sql_field14 = "update nuke_offerte set field14='10' where id='$id'";
	$result = $db->sql_query1($sql_field14);	
	}

	//inserisco la domanda di default
	if ($idpolizza=='18') {
		$sql = "DELETE FROM nuke_offerte_detail_2 WHERE idofferta='$id' AND field1='9'";
		$result = $db->sql_query1($sql);			
		$sql = "INSERT INTO nuke_offerte_detail_2 (idofferta,field1,field2) VALUES ('" . $id . "','9','PROPOSAL FORM')";
		$result = $db->sql_query1($sql);			
	}
	//inserisco il bollo di default a seconda della tipologia di polizza se non � gi� stato impostato
	if ($bollo=='') {
		if ($valuta=='CHF') {
			if ($idpolizza=='18') $bollo='5';
			if ($idpolizza=='21') $bollo='5';
			if ($idpolizza=='19') $bollo='0';
		}
		$sql = "UPDATE nuke_offerte set field13='$bollo' where id='$id'";
		$result = $db->sql_query($sql);
	}

	//inserisco le CGA di default
	if ($idpolizza=='18') { //All Risk
		$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id' AND field1='60'";
		$result = $db->sql_query($sql);			
		$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('$id','60','CGA')";
		$result = $db->sql_query($sql);

		$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id' AND field1='61'";
		$result = $db->sql_query($sql);			
		$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('$id','61','CGA')";
		$result = $db->sql_query($sql);

		if ($rinnovo=='1') {
			$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id' AND field1='65'";
			$result = $db->sql_query1($sql);			
			$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('$id','65','CGA')";
			$result = $db->sql_query1($sql);
		}
	}elseif ($idpolizza=='19') { //Personal Accident
		$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id' AND field1='63'";
		$result = $db->sql_query($sql);			
		$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','63','CGA')";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id' AND field1='75'";
		$result = $db->sql_query($sql);			
		$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','75','CGA')";
		$result = $db->sql_query($sql);
	}elseif ($idpolizza=='21') { //Building & Content
		$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id' AND field1='71'";
		$result = $db->sql_query($sql);			
		$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','71','CGA')";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id' AND field1='78'";
		$result = $db->sql_query($sql);			
		$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','78','CGA')";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id' AND field1='83'";
		$result = $db->sql_query($sql);			
		$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','83','CGA')";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id' AND field1='80'";
		$result = $db->sql_query($sql);			
		$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','80','CGA')";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id' AND field1='81'";
		$result = $db->sql_query($sql);			
		$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','81','CGA')";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id' AND field1='76'";
		$result = $db->sql_query($sql);			
		$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','76','CGA')";
		$result = $db->sql_query($sql);
		if ($rinnovo=='1') {
			$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id' AND field1='82'";
			$result = $db->sql_query($sql);			
			$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','82','CGA')";
			$result = $db->sql_query($sql);
		}else{
			$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id' AND field1='82'";
			$result = $db->sql_query($sql);			
		}
	}else{
		$sql = "DELETE FROM nuke_offerte_detail_cga WHERE idofferta='$id'";
		$result = $db->sql_query($sql);			
	}

	// Verifico il paese di attinenza della polizza
	$sql_bollo = "SELECT * FROM nuke_bolli where field2='$row[field13]%' and idtipopolizza='$row[field2]'";
	$rs_bollo = $db->sql_query($sql_bollo);
	$nr_bollo = $db->sql_numrows($rs_bollo);
	$stato = $db->sql_fetchrow($rs_bollo);
	$paese = $stato[field1];
	//inserisco le condizioni di default
	if ($idpolizza=='18') { //All Risk
		$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id' AND field1='47'";
		$result = $db->sql_query($sql);
		$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','47','CONDIZIONE')";
		$result = $db->sql_query($sql);
		if ($cliente_a=='R4779' || $cliente_b=='R4779') {
			$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id' AND field1='72'";
			$result = $db->sql_query($sql);
			$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','72','CONDIZIONE')";
			$result = $db->sql_query($sql);
		} else {
			$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id' AND field1='35'";
			$result = $db->sql_query($sql);
			$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','35','CONDIZIONE')";
			$result = $db->sql_query($sql);
		}
		$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id' AND field1='41'";
		$result = $db->sql_query($sql);
		$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','41','CONDIZIONE')";
		$result = $db->sql_query($sql);
		if ($paese=="Svizzera" || $paese=='') {
			$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id' AND field1='22'";
			$result = $db->sql_query($sql);
			$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','22','CONDIZIONE')";
			$result = $db->sql_query($sql);
		}
		$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id' AND field1='28'";
		$result = $db->sql_query($sql);
		$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','28','CONDIZIONE')";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id' AND field1='14'";
		$result = $db->sql_query($sql);
		$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','14','CONDIZIONE')";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id' AND field1='60'";
		$result = $db->sql_query($sql);
		$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','60','CONDIZIONE')";
		$result = $db->sql_query($sql);
	}
	if ($idpolizza=='19') { //Personal Accident
		$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id' AND field1='48'";
		$result = $db->sql_query($sql);
		$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','48','CONDIZIONE')";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id' AND field1='42'";
		$result = $db->sql_query($sql);
		$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','42','CONDIZIONE')";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id' AND field1='29'";
		$result = $db->sql_query($sql);
		$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','29','CONDIZIONE')";
		$result = $db->sql_query($sql);
		if ($paese=="Svizzera" || $paese=='') {
			$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id' AND field1='23'";
			$result = $db->sql_query($sql);
			$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','23','CONDIZIONE')";
			$result = $db->sql_query($sql);
		}
		$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id' AND field1='15'";
		$result = $db->sql_query($sql);
		$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','15','CONDIZIONE')";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id' AND field1='61'";
		$result = $db->sql_query($sql);
		$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','61','CONDIZIONE')";
		$result = $db->sql_query($sql);
	}
	if ($idpolizza=='21') { //Building & Content
		$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id' AND field1 in ('50','38','44','31','25','17','63')";
		$result = $db->sql_query($sql);
		$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','50','CONDIZIONE')";
		$result = $db->sql_query($sql);
		$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','38','CONDIZIONE')";
		$result = $db->sql_query($sql);
		$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','44','CONDIZIONE')";
		$result = $db->sql_query($sql);
		$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','31','CONDIZIONE')";
		$result = $db->sql_query($sql);
		$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','25','CONDIZIONE')";
		$result = $db->sql_query($sql);
		$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','17','CONDIZIONE')";
		$result = $db->sql_query($sql);
		$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','63','CONDIZIONE')";
		$result = $db->sql_query($sql);

		$sql = "DELETE FROM nuke_offerte_detail_condizioni WHERE idofferta='$id' AND field1 in ('25','70','71')";
		$result = $db->sql_query($sql);
		if ($paese=='Italia') $sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','71','CONDIZIONE')";
		if ($paese=='Francia') $sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','70','CONDIZIONE')";
		if ($paese=='Svizzera') $sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','25','CONDIZIONE')";
		$result = $db->sql_query($sql);
	}

	//$sql = "INSERT INTO nuke_offerte_detail_condizioni (idofferta,field1,field2) VALUES ('" . $id . "','" . $_GET[condizioneid] . "','CONDIZIONE')";
	//$result = $db->sql_query($sql);
	
	//inserisco i luoghi di rischio di default
	$filtra = $row_a[field3];
	if ($row_a[field4]!='') $filtra=$row_a[field4];
	if ($filtra=='') {
		$sql = "DELETE FROM nuke_offerte_ldr WHERE idofferta='$id'";
		$result = $db->sql_query($sql);
	}else{
		$sql = "SELECT * FROM [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.CLIENTI where COD = '$filtra'";
		$rss = $db->sql_query($sql);
		$rows = $db->sql_fetchrow($rss);
		//inserisco il luogo di rischio indirizzo di corrispondenza
		$sql = "SELECT * FROM nuke_offerte_ldr WHERE idofferta='$id' AND value1='$rows[INDIRIZZO]' AND value2='$rows[CAP]' AND value3='$rows[CITTA]' AND value4='$rows[STATO]' ";
		$nr = $db->sql_numrows($db->sql_query($sql));
		if ($nr==0) {
			$sql = "INSERT INTO nuke_offerte_ldr (idofferta,detail,value1,value2,value3,value4,active,spedizione) VALUES ('$id','Rischio Principale','$rows[INDIRIZZO]','$rows[CAP]','$rows[CITTA]','$rows[STATO]','1','1')";
			$result = $db->sql_query($sql);
		}

		$sql = "SELECT * FROM [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.RUBRICA where CLIE = '$filtra'";
		$rss = $db->sql_query($sql);
		while ($rows = $db->sql_fetchrow($rss)) {
			//inserisco il luogo di rischio indirizzo di corrispondenza
			if ($rows[DESC]!='') {$ind="$rows[DESC]/n$rows[INDIRIZZO]";}else{$ind="$rows[INDIRIZZO]";}
			if ($rows[CA]!='') {$cap="$rows[CA]/n$rows[CAP]";}else{$cap="$rows[CAP]";}
			$sql = "SELECT * FROM nuke_offerte_ldr WHERE idofferta='$id' AND value1='$ind' AND value2='$cap' AND value3='$rows[CITTA]' AND value4='$rows[STATO]' ";
			$nr = $db->sql_numrows($db->sql_query($sql));
			if ($nr==0) {
				$sql = "INSERT INTO nuke_offerte_ldr (idofferta,detail,value1,value2,value3,value4,active,spedizione) VALUES ('$id','Rischio Secondario','$ind','$cap','$rows[CITTA]','$rows[STATO]','1','0')";
				$result = $db->sql_query($sql);
			}
		}
	}
	header("Location: gestionale.php?name=lloyds&subname=offerte&act=explode&id=$id&next=$_GET[next]&view=$_GET[view]&scrolltop=$_GET[scrolltop]");
}

if ($act == 'del'){
	$sql = "SELECT * FROM nuke_polizze where id=$id";
	$rs = $db->sql_query($sql);
	$nr = $db->sql_numrows($rs);
	if ($nr==0) {
		$sql = "DELETE FROM nuke_offerte WHERE ID = '$id'";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_detail1 where idofferta='$id'";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_detail_2 where idofferta='$id'";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_detail_cga where idofferta='$id'";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_ldr where idofferta='$id'";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_detail_condizioni where idofferta='$id'";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_detail_coperture where idofferta='$id'";
		$result = $db->sql_query($sql);
		$sql = "DELETE FROM nuke_offerte_detail_persone where idofferta='$id'";
		$result = $db->sql_query($sql);
		if (isset($_COOKIE[idcliente])) {
			header("Location: gestionale.php?name=clienti&act=explode&id=$_COOKIE[idcliente]");
		}else{
			header("Location: gestionale.php?name=lloyds&subname=offerte");
		}
	}else{
		$msg='You cannot delete this item because there is an emitted policy.';
		echo "
		<script>
		alert('$msg');
		</script>
		";
	}
}

if ($act=='new'){
	$sql = "INSERT INTO nuke_offerte (company,field7,data,valuta,field1,field6,field10,rinnovo,franchigia) VALUES (".$_SERVER[company].",'6','".date('d.m.Y')."','CHF','".date('Y')."','01.06.".date('Y')."','31.05.".(date('Y')+1)."','1','come da condizioni allegate / as attached conditions')";
	$result = $db->sql_query($sql);
	$rsq = $db->sql_query("SELECT id,field2,field3,field4,rinnovo,valuta FROM nuke_offerte order by id DESC");
	$rowq = $db->sql_fetchrow($rsq);
	$id = $rowq[id];
	$idpolizza = $rowq[field2];
	$stipulante = $rowq[field3];
	$assicurato = $rowq[field4];
	$rinnovo = $rowq[rinnovo];
	$valuta = $rowq[valuta];
	$act = "explode";

	//inserisco il cliente se � valorizzato idcliente
	if ($_GET[idcliente]!='') {
		$sql = "UPDATE nuke_offerte set field3='$_GET[idcliente]' where id='$id'";
		$result = $db->sql_query($sql);
	}

	//inserisco lo sconto e il bollo di default
	$sql = "UPDATE nuke_offerte set field14='10' where id='$id'";
	$result = $db->sql_query($sql);

	if ($valuta=='CHF') {
		if ($idpolizza=='18') $bollo='5';
		if ($idpolizza=='19') $bollo='0';
	}
	$sql = "UPDATE nuke_offerte set field13='$bollo' where id='$id'";
	$result = $db->sql_query($sql);
	
	//inserisco la domanda di default
	if ($idpolizza=='18') {
		$sql = "INSERT INTO nuke_offerte_detail_2 (idofferta,field1,field2) VALUES ('" . $id . "','6','DOMANDA')";
		$result = $db->sql_query($sql);			
	}
	
	//inserisco le CGA di default
	if ($idpolizza=='18') {
		$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','60','CGA')";
		$result = $db->sql_query($sql);
		$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','61','CGA')";
		$result = $db->sql_query($sql);
		if ($rinnovo=='1') {
			$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','65','CGA')";
			$result = $db->sql_query($sql);
		}
	}
	if ($idpolizza=='19') {
		$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','69','CGA')";
		$result = $db->sql_query($sql);
	}
	if ($idpolizza=='21') {
		$sql = "INSERT INTO nuke_offerte_detail_cga (idofferta,field1,field2) VALUES ('" . $id . "','51','CGA')";
		$result = $db->sql_query($sql);
	}
	//inserisco i luoghi di rischio di default
	$filtra = $stipulante;
	if ($assicurato!='') $filtra=$assicurato;
	$sql = "SELECT * FROM [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.CLIENTI where COD = '$filtra'";
	$rss = $db->sql_query($sql);
	$rows = $db->sql_fetchrow($rss);
	if ($rows[INDIRIZZO]!='') {
		//inserisco il luogo di rischio indirizzo di corrispondenza
		$sql = "INSERT INTO nuke_offerte_ldr (idofferta,detail,value1,value2,value3,value4) VALUES ('$id','Rischio Principale','$rows[INDIRIZZO]','$rows[CAP]','$rows[CITTA]','$rows[STATO]')";
		$result = $db->sql_query($sql);
	}
	header("Location: gestionale.php?name=lloyds&subname=offerte&act=$act&id=$id");
}

$condizioni = " WHERE blocca like '%' ";

if ($id!='') {
	$condizioni = " WHERE id='$id' ";
}else{
	$condizioni = " WHERE company='".$_SERVER[company]."' ";
}

if ($act=='gosearch') {
	$condizioni = " WHERE ";
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
}

if ($_GET[stampa]!='1') {
	if ($row[blocca]==1) {
		echo "
					<script>
					alert('This offer is blocked, no possibility to modify.');
					</script>
					";
	}
}
if ($_GET[duplica]==1) {
	echo "
				<script>
				alert('La proposta � stata duplicata.');
				</script>
				";
}

//query principale
if ($ord=='') $ord = 'id';
$sql = "SELECT * FROM $tablename $condizioni ORDER BY id DESC";
$rs = $db->sql_query($sql);
$nr = $db->sql_numrows($rs);
//fine query principale

//men� in alto, operazioni varie
OpenTable();
$sqlf = "SELECT * FROM nuke_offerte where id='$_GET[id]'";
$rsf = $db->sql_query($sqlf);
$rowf = $db->sql_fetchrow($rsf);
echo '<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=darkgreen><td>';
echo "<input type=button value='Exit' onclick=location.href='gestionale.php?name=lloyds' style=font-family: Verdana; font-size: 10px;>";
echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
echo "<input type=button value='New Offer' onClick=nuova_p('$rowf[field3]','$rowf[field4]','$_SERVER[company]'); style=font-family: Verdana; font-size: 10px;>";
if ($act!='explode') {
	echo '&nbsp;&nbsp;::&nbsp;&nbsp;';
	?>
	<input type=button value='Search' onClick="if(document.getElementById('cerca').style.display=='none'){document.getElementById('cerca').style.display='block';}else{document.getElementById('cerca').style.display='none';}">
	<?php
	echo "&nbsp;&nbsp;::&nbsp;&nbsp;<input type=button value='Show all records' onClick=window.location='gestionale.php?name=lloyds&subname=offerte' style=font-family: Verdana; font-size: 10px>";
}
if ($act=='explode') {
	echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
	echo "<font face=calibri size=2 color=black>Back to customer</font>";
	if ($rowf[field3]!='') echo " <input type=button value='$rowf[field3]' onclick=location.href='gestionale.php?name=clienti&act=explode&id=$rowf[field3]' style=font-family: Verdana; font-size: 10px;>";
	if ($rowf[field4]!='') echo " <input type=button value='$rowf[field4]' onclick=location.href='gestionale.php?name=clienti&act=explode&id=$rowf[field4]' style=font-family: Verdana; font-size: 10px;>";
	echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
	if ($_GET[view]=='anteprimadistampa') {
		echo "<input type=button value=Edit onClick=location.href='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&view=editavanzato';>";
	}else{
		echo "<input type=button value='Print Preview' onClick=location.href='gestionale.php?name=lloyds&subname=offerte&act=explode&id=$_GET[id]&view=anteprimadistampa';>";
	}
	echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
	echo "<input type=button value='Print' onClick=stampa_proposta('$id');>";
	echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
	//verifico se esiste gia la polizza
	$sqlp = "SELECT * FROM nuke_polizze where id='$_GET[id]'";
	$rsp = $db->sql_query($sqlp);
	$nrp = $db->sql_numrows($rsp);
	$rowp = $db->sql_fetchrow($rsp);
	if ($nrp!=0) {
		echo "<input type=button name=completa value='Go to polocy' onClick=javascript:window.location='gestionale.php?name=lloyds&subname=polizze&act=explode&idpolizza=$rowp[idpolizza]';>";
	}else{
		echo "<input type=button name=completa value='Create policy' onClick=javascript:consolida($_GET[id]);>";
		echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
		?>
		<input type=button value='Delete offer' onClick="if(confirm('Warning, you will not be able to undo this action, are you really sure to continue?')) location.href='gestionale.php?name=lloyds&subname=offerte&act=del&id=<?php echo $id; ?>';">
		<?php
	}
	echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;::&nbsp;&nbsp;";
	if ($row[addendum]!='') $testo_da_aggiungere=" modified from ".str_replace("EUROPLEX_N._","",$row[addendum]);
	if ($rowf[blocca]==0) echo "<font face=calibri color=black><u><strong>OFFER NUMBER $rowf[field1]/$id $testo_da_aggiungere</strong></u></font>";
	if ($rowf[blocca]==1) echo "<font face=calibri color=black><u><strong>OFFER NUMBER $rowf[field1]/$id BLOCCATA $testo_da_aggiungere</strong></u></font>";
}
echo "</td></table>";
CloseTable();
//fine del men� in alto, operazioni varie
?>
<div class="offerte" id="offerte" style="position:relative;_position:relative;height:90%;overflow:auto;padding:0px;">
<?php
//men� ricerca
if ($act == 'search' || $act=='gosearch') {
	echo "<div id=cerca>";
	OpenTable();
	echo '<table width=100% border=1 cellspacing=0 cellpadding=2 bordercolor=darkgreen>';
	echo '<tr>';
	echo '<th width=25%><font face=verdana size=2>Name</th>';
	echo '<th width=10%><font face=verdana size=2>Type</th>';
	echo '<th width=15%><font face=verdana size=2>Covered period</th>';
	echo '<th width=10%><font face=verdana size=2>Territorial limits</th>';
	echo '<th width=10%><font face=verdana size=2>Currency</th>';
	echo '<th width=35% colspan=2><font face=verdana size=2>Other data</th>';
	echo '</tr>';
	$ricerca = "&field1=$field1&field2=$field2&field3=$field3&field4=$field4&field5=$field5&field6=$field6&field10=$field10&field7=$field7&field17=$field17&rinnovo=$rinnovo&data=$data&franchigia=$franchigia&valuta=$valuta";
	echo '<tr>';
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
				<select onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=gosearch$ricerca&field3='+this.value; style=width:140px; id=field3_select name=field3 multiple=multiple size=4><option value=''>All</option><option selected value='$row_customer[COD]'>$testo</option>";
	echo "</select></td><td align=center>";
	$testo="";
	$sql= "SELECT COD, COGNOME, NOME, RIFER, REPLACE(REPLACE(REPLACE(SEX, 'G', '1'), 'M', '2'), 'F', '3') AS SEX  FROM [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.CLIENTI WHERE COD = '$field4'";
	$rs_customer = $db->sql_query1($sql);
	$row_customer = $db->sql_fetchrow($rs_customer);
	if ($row_customer[SEX]=='1') $testo = "<strong>$row_customer[COD]: $row_customer[COGNOME] $row_customer[RIFER]</strong>";
	if ($row_customer[SEX]=='2') $testo = "<strong>$row_customer[COD]: $row_customer[COGNOME] $row_customer[NOME] $row_customer[RIFER]</strong>";
	if ($row_customer[SEX]=='3') $testo = "<strong>$row_customer[COD]: $row_customer[COGNOME] $row_customer[NOME] $row_customer[RIFER]</strong>";
	if ($field4=='') $ricerca = str_replace("&field4=$field4","",$ricerca);
	echo "<font face=verdana size=2>Assured<br>
				<input style='text-align:center' size=20 type=text id=field4 onKeyUp=javascript:query_now_field4('field4');><br>
				<select onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=gosearch$ricerca&field4='+this.value; style=width:140px; id=field4_select name=field4 multiple=multiple size=4><option value=''>All</option><option selected value='$row_customer[COD]'>$testo</option>";
	echo "</select></td></table>";
	$ricerca = str_replace("&field5=$field5","",$ricerca);
	echo "<font face=verdana size=2>Assured<br><input type=text name=field5 id=field5 size=25 value='$field5'>";
	echo "<input type=button value=Cerca onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=gosearch$ricerca&field5='+document.getElementById('field5').value;>";
	echo "</td>";
	echo "<td valign=top align=center><font face=verdana size=2>";
	$sql_polizze = "SELECT * FROM nuke_tipologiepolizze";
	$rs_polizze = $db->sql_query($sql_polizze);
	$nr_polizze = $db->sql_numrows($rs_polizze);
	if ($field2=='') $ricerca = str_replace("&field2=$field2","",$ricerca);
	echo "<select name=field2 style=width:140px; size=$nr_polizze multiple=multiple onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=gosearch$ricerca&field2='+this.value>";
	echo "<option value=''>All</option>";
	while ($polizze = $db->sql_fetchrow($rs_polizze)) {
		if ($polizze[id]==$_GET[field2]) $selected=' selected ';
		echo "<option $selected value=$polizze[id]>$polizze[field2]</option>";
		$selected="";
	}
	echo "</select></td>";
	echo "<td valign=top align=center><font face=calibri size=2>";
	if ($field6=='') $ricerca = str_replace("&field6=$field6","",$ricerca);
	echo "From:<br><input type=text name=field6 value='$field6' id='sel3' size=11><input type=reset value='.'";
	?> onClick="return showCalendar('sel3', '%d.%m.%Y');" <?php echo ">";
	echo "<br>";
	if ($field10=='') $ricerca = str_replace("&field10=$field10","",$ricerca);
	echo "To:<br><input type=text name=field10 value='$field10' id='sel4' size=11><input type=reset value='.'";
	?> onclick="return showCalendar('sel4', '%d.%m.%Y');" <?php echo ">";
	echo "<br><input type=button value=Go onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=gosearch$ricerca&field6='+document.getElementById('sel3').value+'&field10='+document.getElementById('sel4').value;>";
	echo "</td>";
	echo "<td valign=top align=center><font face=verdana size=2>";
	if ($field7=='') $ricerca = str_replace("&field7=$field7","",$ricerca);
	$sql_limititerritoriali = "SELECT * FROM nuke_limititerritoriali";
	$rs_limititerritoriali = $db->sql_query($sql_limititerritoriali);
	$nr_limititerritoriali = $db->sql_numrows($rs_limititerritoriali);
	echo "<select name=field7 style=width:140px; size=$nr_limititerritoriali multiple=multiple onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=gosearch$ricerca&field7='+this.value;>";
	echo "<option value=''>All</option>";
	while ($limititerritoriali = $db->sql_fetchrow($rs_limititerritoriali)) {
		if ($limititerritoriali[id]==$field7) $selected=' selected ';
		echo "<option $selected value=$limititerritoriali[id]>$limititerritoriali[field2]</option>";
		$selected="";
	}
	echo "</select></td>";
	echo "<td valign=top align=center><font face=verdana size=2>";
	if ($valuta=='') $ricerca = str_replace("&valuta=$valuta","",$ricerca);
	echo "<select name=valuta style=width:70px; size=5 multiple=multiple onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=gosearch$ricerca&valuta='+this.value;>";
	echo "<option value=''>All</option>";
	echo "<option ";if($valuta=='CHF') echo " selected ";echo " value='CHF'>CHF</option>";
	echo "<option ";if($valuta=='EUR') echo " selected ";echo " value='EUR'>EUR</option>";
	echo "<option ";if($valuta=='USD') echo " selected ";echo " value='USD'>USD</option>";
	echo "<option ";if($valuta=='GBP') echo " selected ";echo " value='GBP'>GBP</option>";
	echo "</select></td>";
	echo "<td colspan=2 valign=top align=left>
				<font face=verdana size=2><strong>Excess:</strong>&nbsp;";
	if ($franchigia=='') $ricerca = str_replace("&franchigia=$franchigia","",$ricerca);
	$sql_franchigia = "SELECT distinct franchigia FROM nuke_offerte where franchigia is not null";
	$rs_franchigia = $db->sql_query($sql_franchigia);
	$nr_franchigia = $db->sql_numrows($rs_franchigia);
	echo "<select name=franchigia style=width:100px; size=5 multiple=multiple onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=gosearch$ricerca&franchigia='+this.value;>";
	echo "<option value=''>All</option>";
	while ($franc = $db->sql_fetchrow($rs_franchigia)) {
		if ($franc[franchigia]==$franchigia) $selected=' selected ';
		echo "<option $selected value='$franc[franchigia]'>$franc[franchigia]</option>";
		$selected="";
	}
	echo "</select></font><br>";
	if ($rinnovo=='') $ricerca = str_replace("&rinnovo=$rinnovo","",$ricerca);
	echo "<font face=verdana size=2><strong>Renewale Clause: </strong>";
	echo "<select name=rinnovo style=width:80px; size=3 multiple onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=gosearch$ricerca&rinnovo='+this.value;>";
	if ($rinnovo=='1') $selected1=" selected ";
	if ($rinnovo=='0') $selected0=" selected ";
	echo "<option value=''>All</option><option $selected1 value='1'>S�</option><option $selected0 value='0'>No</option>";
	if ($data=='') $ricerca = str_replace("&data=$data","",$ricerca);
	echo "</select><br><font face=verdana size=2><strong>Sign date: </strong>";
	echo "<input type=text name=data value='$data' id='sel5' size=11><input type=reset value='.'";
	?> onClick="return showCalendar('sel5', '%d.%m.%Y');" <?php echo "><br>";
	echo "<input type=button value=Go onClick=onClick=window.location='gestionale.php?name=lloyds&subname=offerte&act=gosearch$ricerca&data='+document.getElementById('sel5').value;></td>";

	echo '</tr>';
	echo "<tr><td colspan=7>";
	echo "Offer number: <input type=text name=id id=numero_offerta> <input type=button name=Go value=Cerca onClick=window.location='gestionale.php?name=lloyds&subname=offerte&id='+document.getElementById('numero_offerta').value>&nbsp;&nbsp;::&nbsp;&nbsp;<input type=button name=Cerca value='Reset' onClick=window.location='gestionale.php?name=lloyds&subname=offerte'>";
	echo "</td></tr>";
	echo "</table>";
	CloseTable();
	echo "</div>";
}
//fine del men� ricerca


if ($act=='explode') {
	if ($_GET[view]=='') $_GET[view]='editavanzato';
	//comandi sulle opzioni della pagina
	//spostati su header.html
} else {
	OpenTable();
	echo '<table width=100% border=0 cellspacing=0 cellpadding=2 bordercolor=darkgreen><td>';
	echo "<font face=calibri size=2>Legend<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style=background-color:lightgreen; color=black>GREEN</font> blocked & printed offer (converted in polocy)&nbsp;&nbsp;::&nbsp;&nbsp;<font style=background-color:pink; color=black>PINK</font> offer working on";
	echo "</td></table>";
	echo '<table width=100% border=1 cellspacing=0 cellpadding=2 bordercolor=darkgreen>';
		echo '<tr>';
		echo '<td align=center><font face=verdana size=2 color=black>Offer Number</th>';
		echo '<td align=center><font face=verdana size=2 color=black>Name</th>';
		echo '<td align=center><font face=verdana size=2 color=black>Type</th>';
		echo '<td align=center><font face=verdana size=2 color=black>Covered Period</th>';
		echo '<td align=center><font face=verdana size=2 color=black>Renewal Clause</th>';
		echo '<td align=center><font face=verdana size=2 color=black>Sum Assured</th>';
		echo '<td align=center><font face=verdana size=2 color=black>Premium</th>';
		echo '</tr>';
}

while ($row = $db->sql_fetchrow($rs)) {
	if ($act=='explode' && $_GET[view]=='editavanzato') {
			OpenTable();
			include('offerte_edit.php');
			CloseTable();
	} elseif ($act=='explode' && $_GET[view]=='anteprimadistampa') {
		if ($_GET[pagina]=='') {$pagina='1';}else{$pagina=$_GET[pagina];}
		if ($pagina=='1') {$succ='2';$pre='';}
		if ($pagina=='2') {$succ='object';$pre='1';}
		if ($pagina=='object') {$succ='ultima';$pre='2';}
		if ($pagina=='ultima') {$succ='';$pre='object';}
		echo "<center><table width=70% cellspacing=0 cellpadding=5 border=0 bgcolor=white>";
			echo "<tr>";
				echo "<td width=1 valign=top align=center><a href=gestionale.php?view=anteprimadistampa&name=lloyds&subname=offerte&act=explode&id=$_GET[id]&pagina=$pre><img border=0 width=128 src=images/Shortcuts_left.png></a></td>";
				echo "<td width=100% valign=top align=center>";
				include('/template/rva1_preview.htm');
				echo "</td>";
				echo "<td width=1 valign=top align=center><a href=gestionale.php?view=anteprimadistampa&name=lloyds&subname=offerte&act=explode&id=$_GET[id]&pagina=$succ><img border=0 width=128 src=images/Shortcuts_right.png></a></td>";
			echo "</tr>";
		echo "</table></center>";
	} else {
		if ($row[blocca]=='0') {echo "<tr bgcolor=pink>";$color='black';}
		if ($row[blocca]=='1') {echo "<tr bgcolor=lightgreen>";$color='black';}
		echo "<td align=center valign=middle><font face=verdana size=2><a style=color:$color; href=gestionale.php?name=lloyds&subname=offerte&act=explode&id=$row[id]><strong><u>$row[field1]/$row[id]</u></strong></a>";
		if ($row[addendum]!='') {
			echo "<br>modif. from ".str_replace("EUROPLEX_N._","",$row[addendum]);
		}
		echo "</font></td>";
		echo "<td valign=middle align=center>";
		if ($row[field3]!='') {
			$sql= "SELECT COD, COGNOME, NOME, REPLACE(REPLACE(REPLACE(SEX, 'G', '1'), 'M', '2'), 'F', '3') AS SEX  FROM [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.CLIENTI WHERE COD = '$row[field3]'";
			$rs_customer = $db->sql_query1($sql);
			$row_customer = $db->sql_fetchrow($rs_customer);
			if ($row_customer[SEX]=='1') $testo = "</strong>".$row_customer[COGNOME]."</strong>";
			if ($row_customer[SEX]=='2') $testo = "</strong>".$row_customer[COGNOME]." ".$row_customer[NOME]."</strong>";
			if ($row_customer[SEX]=='3') $testo = "</strong>".$row_customer[COGNOME]." ".$row_customer[NOME]."</strong>";
			echo "<font face=verdana size=2 color=$color>Owner: $testo</font><br>";
		}
		$testo="";
		if ($row[field4]!='') {
			$sql= "SELECT COD, COGNOME, NOME, REPLACE(REPLACE(REPLACE(SEX, 'G', '1'), 'M', '2'), 'F', '3') AS SEX  FROM [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.CLIENTI WHERE COD = '$row[field4]'";
			$rs_customer = $db->sql_query1($sql);
			$row_customer = $db->sql_fetchrow($rs_customer);
			if ($row_customer[SEX]=='1') $testo = "</strong>".$row_customer[COGNOME]."</strong>";
			if ($row_customer[SEX]=='2') $testo = "</strong>".$row_customer[COGNOME]." ".$row_customer[NOME]."</strong>";
			if ($row_customer[SEX]=='3') $testo = "</strong>".$row_customer[COGNOME]." ".$row_customer[NOME]."</strong>";
			echo "<font face=verdana size=2 color=$color>Assured: $testo</font><br>";
		}
		if ($row[field5]!='') echo "<font face=verdana size=2 color=$color>Assured: $row[field5]";
		echo "</td>";
		echo "<td align=center valign=middle><font face=verdana size=2 color=$color>";
		$sql_polizze = "SELECT * FROM nuke_tipologiepolizze where id=$row[field2]";
		$rs_polizze = $db->sql_query($sql_polizze);
		$polizze = $db->sql_fetchrow($rs_polizze);
		echo "$polizze[field2]</td>";
		echo "<td valign=top valign=middle align=center><font face=calibri size=2 color=$color>";
		echo "From: $row[field6] To: $row[field10]<br>Covered Days ".number_format($row[field11],0);
		echo "</td>";
		echo "<td align=center valign=middle><font color=$color face=calibri size=2>";
		if ($row[rinnovo]=='0') echo "No"; if ($row[rinnovo]=='1') echo "Yes";
		echo "</font></td>";
		echo "<td align=center valign=middle><font color=$color face=calibri size=2>$row[valuta] ".number_format($row[field8],2,".",chr(180))."</font></td>";
		echo "<td align=center valign=middle><font color=$color face=calibri size=2>$row[valuta] ".number_format($row[field12],2,".",chr(180))."</font></td>";
		echo "</tr>";
	}
}
if ($act!='explode') {
	echo "</table>";
	CloseTable();
}

echo "<script language=JavaScript>";
echo "
			document.getElementById('offerte').scrollTop=$_GET[scrolltop];
			";	
echo "</script>";

echo "<script language=JavaScript>";
echo "
			document.getElementById('Cerca').style.display='none';
			";
echo "</script>";

echo "</div>";
?>