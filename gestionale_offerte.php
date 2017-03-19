<?php
require_once("mainfile.php");
global $prefix, $db, $admin, $user;

$ricerca = $_GET[ricerca];
$field = $_GET[field];

if (strlen($ricerca)>2) {
	//eseguo la query
	$sql = "SELECT RIFER, OLDCOD, NPROG, NRSIN, COD as id, TIT, COGNOME as cognome, NOME as nome, REPLACE(REPLACE(REPLACE(SEX, 'G', '1'), 'M', '2'), 'F', '3') AS SEX, CF, PIVA, INDIRIZZO as via1, CAP as npa1,              CITTA as localita1, PROV, STATO as stato1, RUB, PRESSO, NATLUOGO as nazionalita, NATPROV, NATDATA as nascita, TEL, CELLULARE, FAX, TELEX, TELCASA, RIFER, ORIG, ZONA, BANCA, LINEA, NOTA, SME, LOBBY, RETE, PRODUTT, CEV, DTMAND, DTREVOCA, COMMERC, STATUS, NUMDIP, FATTUR, ATTESERC, ATTESTERE, COGE, DIV, MEMO, IMP, SIC, POT, INTRODUCER, GRP, SGR, ANTIC, SALDOI, CEE, ALLEGATI, PRIVACY, DTAGG, UTENTE, ATTIVO, NR_DOSSIER, NOTE_DOSSIER, INIZIO_LETTERA
					FROM [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.CLIENTI
					WHERE COGNOME like '$ricerca%'
					order by SEX,COGNOME";
	if ($field!='') {
	$sql = "SELECT RIFER, OLDCOD, NPROG, NRSIN, COD as id, TIT, COGNOME as cognome, NOME as nome, REPLACE(REPLACE(REPLACE(SEX, 'G', '1'), 'M', '2'), 'F', '3') AS SEX, CF, PIVA, INDIRIZZO as via1, CAP as npa1,              CITTA as localita1, PROV, STATO as stato1, RUB, PRESSO, NATLUOGO as nazionalita, NATPROV, NATDATA as nascita, TEL, CELLULARE, FAX, TELEX, TELCASA, RIFER, ORIG, ZONA, BANCA, LINEA, NOTA, SME, LOBBY, RETE, PRODUTT, CEV, DTMAND, DTREVOCA, COMMERC, STATUS, NUMDIP, FATTUR, ATTESERC, ATTESTERE, COGE, DIV, MEMO, IMP, SIC, POT, INTRODUCER, GRP, SGR, ANTIC, SALDOI, CEE, ALLEGATI, PRIVACY, DTAGG, UTENTE, ATTIVO, NR_DOSSIER, NOTE_DOSSIER, INIZIO_LETTERA
					FROM [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.CLIENTI
					WHERE COGNOME like '$ricerca%' AND COD in (select distinct $field from nuke_offerte)
					order by SEX,COGNOME";
	}
	$rs = $db->sql_query1($sql);
	while ($row = $db->sql_fetchrow($rs))
	{
		if ($row[SEX]=='1') {
			echo "<option value='$row[id]'>$row[cognome] $row[RIFER]</option>";
		}else{
			echo "<option value='$row[id]'>$row[cognome] $row[nome] $row[RIFER]</option>";
		}
	}
}
?>