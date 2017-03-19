<?php

if ( !defined('BLOCK_FILE') ) {
	Header("Location: ../index.php");
	die();
}

global $prefix, $db, $admin, $language, $currentlang, $name, $user;

		$content .= "<p>";
    $result3 = $db->sql_query("SELECT title, custom_title FROM " . $prefix . "_gestionale WHERE active='1' AND inmenu='1' ORDER BY mid ASC");
    while ($row3 = $db->sql_fetchrow($result3)) {
	    $result33 = $db->sql_query("SELECT title, custom_title FROM " . $prefix . "_gestionale_submenu WHERE active='1' AND parent_title='".$row3['title']."'");
			$title = $row3['title'];
			$custom_title = $row3['custom_title'];
			if ($name=='Your_Account') $name='home';	
			if (strtoupper($title) == strtoupper($name)){
				$content .= "<strong><big>&middot;</big>&nbsp;<a href=\"gestionale.php?name=$title\">".strtoupper($custom_title)."</a></strong><br>\n";
				while ($row33 = $db->sql_fetchrow($result33)) {
					$title33 = $row33['title'];
					$custom_title33 = $row33['custom_title'];
					if (strtoupper($title33) == strtoupper($_GET[subname])){
						$content .= "&nbsp;&nbsp;<strong><big>&middot;</big>&nbsp;<a href=\"gestionale.php?name=$title&subname=$title33\">".strtoupper($custom_title33)."</a></strong><br>\n";
					}else{
						$content .= "&nbsp;&nbsp;<strong><big>&middot;</big></strong>&nbsp;<a href=\"gestionale.php?name=$title&subname=$title33\">".strtoupper($custom_title33)."</a></strong><br>\n";
					}
				}
			}else{
				$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"gestionale.php?name=$title\">".strtoupper($custom_title)."</a><br>\n";
	    }
	  }
		$content .= "</p>";

		if (isset($_COOKIE["idcliente"])) {
			$sql = "SELECT OLDCOD, NPROG, NRSIN, COD as id, TIT, COGNOME as cognome, NOME as nome, REPLACE(REPLACE(REPLACE(SEX, 'G', '1'), 'M', '2'), 'F', '3') AS SEX, CF, PIVA, INDIRIZZO as via1, CAP as npa1, 
		                      CITTA as localita1, PROV, STATO as stato1, RUB, PRESSO, NATLUOGO as nazionalita, NATPROV, NATDATA as nascita, TEL, CELLULARE, FAX, TELEX, TELCASA, RIFER, ORIG, ZONA, BANCA, LINEA, NOTA, SME, 
		                      LOBBY, RETE, PRODUTT, CEV, DTMAND, DTREVOCA, COMMERC, STATUS, NUMDIP, FATTUR, ATTESERC, ATTESTERE, COGE, DIV, MEMO, IMP, SIC, POT, 
		                      INTRODUCER, GRP, SGR, ANTIC, SALDOI, CEE, ALLEGATI, PRIVACY, DTAGG, UTENTE, ATTIVO, NR_DOSSIER, NOTE_DOSSIER, INIZIO_LETTERA
							FROM [RASINI-APP".chr(92)."RVA_DB].RVA_PROD.dbo.CLIENTI WHERE COD = '$_COOKIE[idcliente]'";
			$rs = $db->sql_query1($sql);
			$nr = $db->sql_numrows($rs);
			$row = $db->sql_fetchrow($rs);
			$content_b .= "<strong><big>&middot;</big>&nbsp;$row[cognome]</strong> $row[nome] $row[RIFER]<br>";
			$content_b .= "&nbsp;&nbsp;<a style=text-decoration:underline;color:red; href=gestionale.php?name=clienti&act=explode&id=$_COOKIE[idcliente]>Vai</a>&nbsp;&nbsp;::&nbsp;&nbsp;<a style=text-decoration:underline;color:red; href=gestionale.php?name=home&cookie=reset>Esci</a>";
	  }else{
	  	if ($_GET[name]=='clienti') {
				$content_b .= "<strong><big>&middot;</big>&nbsp;<a href=gestionale.php?name=clienti&act=search>RICERCA CLIENTI</a></strong>";
			}else{
				$content_b .= "<strong><big>&middot;</big></strong>&nbsp;<a href=gestionale.php?name=clienti&act=search>RICERCA CLIENTI</a>";
			}
	  }

		$sql = "SELECT * FROM nuke_polizze order by id DESC";
		$rs = $db->sql_query($sql);
		$nr = $db->sql_numrows($rs);
		$x=0;
		while ($row = $db->sql_fetchrow($rs))
		{
			$sql = "SELECT * FROM nuke_clienti_polizze where id='$row[field3]'";
			$rs1 = $db->sql_query($sql);
			$row1 = $db->sql_fetchrow($rs1);
			
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
			while ($row_titoli = $db->sql_fetchrow($rs_titoli))
			{
				if ($row_titoli[PAGATO]=='N') {
					$x++;
					$content_a .= "<tr>";
						$content_a .= "<td><font face=calibri style=font-size:9px>";
						$content_a .= $row1[cognome]. " " . date("m.y",strtotime($row[field6]));
						$content_a .= ": $row_titoli[DIV]$row_titoli[LORDO]";
						$content_a .= "</font></td>";
			    $content_a .= "</tr>";
			  }
		    if ($x==2) {
	    		$content_a .= "<tr><td><a href=gestionale.php?name=lloyds&subname=scadenze>Specchietto Scadenze...</a></td></tr>";
	    		break(2);
	    	}
			}
		}
$content='';
$content_a='';
$content_b='';

?>