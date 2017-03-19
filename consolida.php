<?php
require_once("mainfile.php");
include("header.php");
global $prefix, $db, $admin, $user;
$id = $_GET[idofferta];
$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potra essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$esiste='no';
$europlex="B0799/KI022050i";

//verifica se l'offerta $id � gi� stata consolidata
$sql = "SELECT * FROM nuke_polizze where id=$id";
$rs = $db->sql_query($sql);
$nr = $db->sql_numrows($rs);
if ($nr==0) { //se non lo � inserisco i dati e poi mi estraggo l'idpolizza
	//estraggo i dati dalla tabella principale e li inserisco in quella consolidata
	$sql = "insert into nuke_polizze (company,premiominimo,weeks,anno_rinnovo,note,etichetta,rimborso,rinnovato,addendum,idpadre,id,field1,field2,field3,field4,field5,field6,field7,field8,field9,field10,field11,field12,field13,field14,field15,field16,field17,rinnovo,valuta,franchigia,data) SELECT company,premiominimo,weeks,anno_rinnovo,note,etichetta,rimborso,rinnovato,addendum,idpadre,id,field1,field2,field3,field4,field5,field6,field7,field8,field9,field10,field11,field12,field13,field14,field15,field16,field17,rinnovo,valuta,franchigia,data FROM nuke_offerte WHERE id=$id";
	$result = $db->sql_query($sql);
	$sql = "SELECT * FROM nuke_polizze where id=$id";
	$rs = $db->sql_query($sql);
	$row = $db->sql_fetchrow($rs);
	$idpolizza=$row[idpolizza];
	$idpadre=$row[idpadre];
}else{ //se esisteva gi� mi estraggo l'idpolizza
	echo "impossibile continuare, proposta gi� convertita in polizza, chiamare l'assistenza";
	die();
}

//se ho un idpadre vuol dire che � un addendum/modifica per cui imposto lo status della polizza padre a 0
if ($idpadre!='') {
	$sql = "UPDATE nuke_polizze set status='0' where id=$idpadre";
	$rs = $db->sql_query($sql);
	$sql = "update nuke_polizze set status='0' WHERE  idpadre = '$idpadre' AND status = 1 AND idpolizza <> '$idpolizza'";
	$rs = $db->sql_query($sql);
}

//estraggo i dati per fare le query successive
$sql = "SELECT * FROM nuke_polizze where idpolizza='$idpolizza'";
$rs = $db->sql_query($sql);
$nr = $db->sql_numrows($rs);
$row = $db->sql_fetchrow($rs);

if ($nr!=0) {
	//aggiorno il campo field2, tipologia polizza
	$sql = "update nuke_polizze set field9=(select field3 from nuke_tipologiepolizze where id = $row[field2]) where idpolizza=$idpolizza";
	$result = $db->sql_query($sql);
	$sql = "update nuke_polizze set field2=(select field2 from nuke_tipologiepolizze where id = $row[field2]) where idpolizza=$idpolizza";
	$result = $db->sql_query($sql);

	//aggiorno il campo field7, limiti territoriali
	$sql = "update nuke_polizze set field7=(select field1 from nuke_limititerritoriali where id = $row[field7]) where idpolizza=$idpolizza";
	$result = $db->sql_query($sql);

	//aggiorno il campo numeropolizza in base allo standard
	$anno=date("y",strtotime($row[field6]));
	$sqltot = "SELECT * from nuke_polizze where field3='$row[field3]' and idpolizza<>'$idpolizza'";
	$rstot = $db->sql_query1($sqltot);
	$nrtot = $db->sql_numrows($rstot);
	$sql0 = "SELECT * from nuke_polizze where field3='$row[field3]' and right(field6,2)='$anno' and idpolizza<>'$idpolizza'";
	$rs0 = $db->sql_query1($sql0);
	$nr = $db->sql_numrows($rs0);
	$numerino = $nr+1;
	if (strlen($numerino)==1) $numerino = '0'.$numerino;
	
	if ($numerino=='01' && $nrtot==0)  {
		$sql1 = "SELECT distinct num from nuke_polizze where num is not null order by num DESC";
		$rs1 = $db->sql_query1($sql1);
		$row1 = $db->sql_fetchrow($rs1);
		$num = trim($row1[num]);
		if ($num=='') {
			$num='100';
		} else {
			$num=$num+1;
		}
	}else{
		$sql1 = "SELECT distinct num from nuke_polizze where num is not null and field3='$row[field3]'";
		$rs1 = $db->sql_query1($sql1);
		$row1 = $db->sql_fetchrow($rs1);
		$num = trim($row1[num]);
	}

	$sql2 = "select * from nuke_tipologiepolizze where id='$row[field2]'";
	$rs2 = $db->sql_query1($sql2);
	$row2 = $db->sql_fetchrow($rs2);
	$tip = $row2[field1];

	$anno=date("y",strtotime($row[field6]));
	$sql = "update nuke_polizze set numeropolizza='EUROPLEX N. $europlex/$tip$anno/$num-$numerino' where idpolizza=$idpolizza and (numeropolizza='' or numeropolizza is null)";
	$result = $db->sql_query1($sql);
	$sql = "update nuke_polizze set num='$num' where idpolizza=$idpolizza";
	$result = $db->sql_query1($sql);
	
	if ($row[rinnovato]!='') {
		$numero = substr($row[rinnovato],33-strlen($row[rinnovato]));
		$sql = "update nuke_polizze set numeropolizza='EUROPLEX N. $europlex/$tip$anno/$numero' where idpolizza=$idpolizza";
		$result = $db->sql_query1($sql);
	}
	
	if ($row[addendum]!='') {
		$numero = substr($row[addendum],33-strlen($row[rinnovato]));
		$sql = "update nuke_polizze set numeropolizza='EUROPLEX N. $europlex/$tip$anno/$numero' where idpolizza=$idpolizza";
		$result = $db->sql_query1($sql);
		//$sql_conteggio_addendum = "select count(*) as conteggio from nuke_polizze where numeropolizza like '".str_replace("_"," ",$row[addendum])."/A%'";
		//$rs_c = $db->sql_query1($sql_conteggio_addendum);
		//$row_c = $db->sql_fetchrow($rs_c);
		//$conteggio = $row_c[conteggio];
		//$valore = $conteggio + 1;
		//$sql = "update nuke_polizze set numeropolizza='".str_replace("_"," ",$row[addendum])."/A$valore' where idpolizza=$idpolizza";
		//$result = $db->sql_query1($sql);
	}
	
	//aggiorno i campi clienti inserendo i dati in una tabella clienti apposita per la polizza
	if ($row[field3]!='') {
		$sql = "insert into nuke_clienti_polizze (idpolizza,id,nome,cognome,via1,npa1,localita1,stato1,nazionalita,nascita) select '$idpolizza',COD,NOME,COGNOME,INDIRIZZO,CAP,CITTA,STATO,NATLUOGO,NATDATA from [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.CLIENTI where COD='$row[field3]'";
		$result = $db->sql_query($sql);
	}
	if ($row[field4]!='') {
		$sql = "insert into nuke_clienti_polizze (idpolizza,id,nome,cognome,via1,npa1,localita1,stato1,nazionalita,nascita) select '$idpolizza',COD,NOME,COGNOME,INDIRIZZO,CAP,CITTA,STATO,NATLUOGO,NATDATA from [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.CLIENTI where COD='$row[field4]'";
		$result = $db->sql_query($sql);
	}

	//aggiorno le tabelle detail_1, detail_2, detail_cga e polizze_ldr con i dati delle tabell offerte relative aggiungendo l'idpolizza	
	//detail_persone, detail_coperture, detail_condizioni
	$sql = "insert into nuke_polizze_detail1 (franchigia,ordine_c,ordine_e,idcategoria,identita,idpolizza,somma,tasso,premio,description) SELECT isnull(a.franchigia,'') as franchigia, b.ordine, c.ordine, b.categoria + '<i>' + b.category as idcategoria, c.field4 + '<i>' + c.field5 as identita, '$idpolizza', isnull(somma,'') as somma, isnull(tasso,'') as tasso, isnull(premio,'') as premio, isnull(description,'') as description FROM nuke_offerte_detail1 a, nuke_categorie b, nuke_entita c WHERE idofferta =$id AND a.idcategoria = b.id AND a.identita = c.id";
	$result = $db->sql_query($sql);
	$sql = "insert into nuke_polizze_detail_2 (idpolizza,field1,field2) SELECT '$idpolizza', b.description, b.filename FROM nuke_offerte_detail_2 a, nuke_domandeproposta b WHERE a.idofferta=$id AND a.field1 = b.id";
	$result = $db->sql_query($sql);
	$sql = "insert into nuke_polizze_detail_cga (idpolizza,field1,field2) SELECT '$idpolizza', b.description, b.filename FROM nuke_offerte_detail_cga a, nuke_cga b WHERE idofferta = '$id' AND a.field1 = b.id";
	$result = $db->sql_query($sql);
	$sql = "insert into nuke_polizze_ldr (idpolizza,detail,value1,value2,value3,value4,value5,active,spedizione) SELECT '$idpolizza', detail, value1, value2, value3, value4, value5, active, spedizione FROM nuke_offerte_ldr WHERE idofferta = '$id'";
	$result = $db->sql_query($sql);

	$sql = "insert into nuke_polizze_detail_condizioni (idpolizza,field1,field2,sort) SELECT '$idpolizza',field1+'|'+field2 as field1,field3 as field2,sort FROM nuke_condizioni WHERE field0='$row[field2]' AND id in (SELECT field1 from nuke_offerte_detail_condizioni where idofferta='$row[id]')";
	$result = $db->sql_query($sql);

	$sql = "insert into nuke_polizze_detail_persone (idorig,idpolizza,idcopertura,idcat,nome,cognome,nascita,importo,tasso,premio,idpadre)
					SELECT     nuke_offerte_detail_persone.id,'$idpolizza' AS idpolizza, a.field1 + '|' + a.field2 AS idcopertura, a.field3 AS idcat, nuke_offerte_detail_persone.nome, nuke_offerte_detail_persone.cognome, nuke_offerte_detail_persone.nascita, 
          nuke_offerte_detail_persone.importo, nuke_offerte_detail_persone.tasso, nuke_offerte_detail_persone.premio, nuke_offerte_detail_persone.idpadre
					FROM         nuke_offerte_detail_persone LEFT OUTER JOIN
          nuke_coperture AS a ON nuke_offerte_detail_persone.idcopertura = a.id
					WHERE     (nuke_offerte_detail_persone.idofferta = '$row[id]')";
	$result = $db->sql_query($sql);



	//blocco l'offerta settando il campo blocca a 1
	$sql = "update nuke_offerte set blocca=1 where id='$id'";
	$rs = $db->sql_query($sql);	
	
	header("Location: gestionale.php?name=lloyds&subname=polizze&act=explode&idpolizza=$idpolizza");
		
}else{
	echo "ID Offerta selezionata: $_GET[idofferta]. Errore nella conversione, chiamare l'assistenza.";
	die();
}
?>