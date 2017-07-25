<?php
require_once("mainfile.php");
include("header.php");
global $prefix, $db, $admin, $user;
$id = $_GET[idofferta];
$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$esiste='no';

//verifica se l'offerta $id è già stata consolidata
$sql = "SELECT * FROM nuke_polizze where id=$id";
$rs = $db->sql_query($sql);
$nr = $db->sql_numrows($rs);
if ($nr==0) { //se non lo è inserisco i dati e poi mi estraggo l'idpolizza
	//estraggo i dati dalla tabella principale e li inserisco in quella consolidata
	$sql = "insert into nuke_polizze (id,field1,field2,field3,field4,field5,field6,field7,field8,field9,field10,field11,field12,field13,field14,field15,field16,field17,rinnovo,valuta,franchigia,data) SELECT id,field1,field2,field3,field4,field5,field6,field7,field8,field9,field10,field11,field12,field13,field14,field15,field16,field17,rinnovo,valuta,franchigia,data FROM nuke_offerte WHERE id=$id";
	$result = $db->sql_query($sql);
	$sql = "SELECT * FROM nuke_polizze where id=$id";
	$rs = $db->sql_query($sql);
	$row = $db->sql_fetchrow($rs);
	$idpolizza=$row[idpolizza];
}else{ //se esisteva già mi estraggo l'idpolizza
	$row = $db->sql_fetchrow($rs);
	$idpolizza=$row[idpolizza];
	$esiste='yes';
}

//estraggo i dati per fare le query successive
$sql = "SELECT * FROM nuke_polizze where idpolizza=$idpolizza";
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
	$sql = "SELECT * from nuke_polizze where field3=$row[field3] and idpolizza<>$idpolizza";
	$rs = $db->sql_query($sql);
	$nr = $db->sql_numrows($rs);
	$numerino = $nr+1;
	if (strlen($numerino)==1) $numerino = '0'.$numerino;
	$anno=date('y');
	$sql = "update nuke_polizze set numeropolizza='EUROPLEX N. B072/BB011440C/AR$anno/$idpolizza-$numerino' where idpolizza=$idpolizza and (numeropolizza='' or numeropolizza is null)";
	$result = $db->sql_query($sql);
	
	if ($esiste=='yes') {
		//delete from nuke_clienti_polizze
		$sql = "delete from nuke_clienti_polizze where idpolizza=$idpolizza";
		$result = $db->sql_query($sql);

		//delete from other tables
		$sql = "delete from nuke_polizze_detail1 where idpolizza=$idpolizza";
		$result = $db->sql_query($sql);
		$sql = "delete from nuke_polizze_detail2 where idpolizza=$idpolizza";
		$result = $db->sql_query($sql);
		$sql = "delete from nuke_polizze_cga where idpolizza=$idpolizza";
		$result = $db->sql_query($sql);
		$sql = "delete from nuke_polizze_ldr where idpolizza=$idpolizza";
		$result = $db->sql_query($sql);
	}

	//aggiorno i campi clienti inserendo i dati in una tabella clienti apposita per la polizza
	if ($row[field3]!='') {
		$sql = "insert into nuke_clienti_polizze (idpolizza,id,title,ragione_sociale,nome,cognome,via1,npa1,localita1,stato1,via2,npa2,localita2,stato2,via3,npa3,localita3,stato3,via4,npa4,localita4,stato4,consulente,nazionalita,nascita) select '$idpolizza',id,title,ragione_sociale,nome,cognome,via1,npa1,localita1,stato1,via2,npa2,localita2,stato2,via3,npa3,localita3,stato3,via4,npa4,localita4,stato4,consulente,nazionalita,nascita from nuke_clienti where id=$row[field3]";
		$result = $db->sql_query($sql);
	}
	if ($row[field4]!='') {
		$sql = "insert into nuke_clienti_polizze (idpolizza,id,title,ragione_sociale,nome,cognome,via1,npa1,localita1,stato1,via2,npa2,localita2,stato2,via3,npa3,localita3,stato3,via4,npa4,localita4,stato4,consulente,nazionalita,nascita) select '$idpolizza',id,title,ragione_sociale,nome,cognome,via1,npa1,localita1,stato1,via2,npa2,localita2,stato2,via3,npa3,localita3,stato3,via4,npa4,localita4,stato4,consulente,nazionalita,nascita from nuke_clienti where id=$row[field4]";
		$result = $db->sql_query($sql);
	}

	//aggiorno le tabelle detail_1, detail_2, detail_cga e polizze_ldr con i dati delle tabell offerte relative aggiungendo l'idpolizza	
	$sql = "insert into nuke_polizze_detail1 (idcategoria,identita,idpolizza,somma,tasso,premio,description) SELECT b.categoria + ' / ' + b.category as idcategoria, c.field4 + ' / ' + c.field5 as identita, '$idpolizza', somma, tasso, premio, description FROM nuke_offerte_detail1 a, nuke_categorie b, nuke_entita c WHERE idofferta =$id AND a.idcategoria = b.id AND a.identita = c.id";
	$result = $db->sql_query($sql);
	$sql = "insert into nuke_polizze_detail_2 (idpolizza,field1,field2) SELECT '$idpolizza', b.description, b.filename FROM nuke_offerte_detail_2 a, nuke_domandeproposta b WHERE a.idofferta=$id AND a.field1 = b.id";
	$result = $db->sql_query($sql);
	$sql = "insert into nuke_polizze_detail_cga (idpolizza,field1,field2) SELECT '$idpolizza', b.description, b.filename FROM nuke_offerte_detail_cga a, nuke_cga b WHERE idofferta = $id AND a.field1 = b.id";
	$result = $db->sql_query($sql);
	$sql = "insert into nuke_polizze_ldr (idpolizza,detail,value) SELECT '$idpolizza', detail, value FROM nuke_offerte_ldr WHERE idofferta = $id";
	$result = $db->sql_query($sql);
	
	header("Location: gestionale.php?name=lloyds&subname=polizze&act=explode&idpolizza=$idpolizza");
		
}else{
	echo "ID Offerta selezionata: $_GET[idofferta]. Errore nel consolidamento.";
}
?>