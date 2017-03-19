<script>
function blocca(id) {
	x=confirm("Attenzione, selezionando questa opzione l'offerta numero "+id+" verrà bloccata e non sarà più possibile modificarla. Si desidera continuare?");
	if (x) window.location="gestionale.php?name=lloyds&subname=offerte&act=blocca&id="+id;
}
</script>
<?php
global $prefix, $db, $admin, $user;
$sql = "SELECT * FROM nuke_offerte where id='$_GET[id]'";
$rs = $db->sql_query1($sql);
$riga = $db->sql_fetchrow($rs);
$stampa=$riga[stampa];
$blocca=$riga[blocca];

if ($stampa==1 && $blocca==0) {
	echo "Informazioni importanti";
	OpenTable();
	echo "<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=red>";
		echo "<tr>";
			echo "<td align=center><font face=calibri size=2><strong>ATTENZIONE: la proposta è già stata stampata almeno una volta, se si è sicuri della stampa effettuata bloccare la proposta tramite il pulsante qui sotto</strong></font></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td align=center valign=middle><input type=button value=' -> BLOCCA <- ' onClick=blocca('$_GET[id]');></td>";
		echo "</tr>";
	echo "</table>";
	CloseTable();
} elseif ($stampa==1 && $blocca==1) {
	echo "Informazioni importanti";
	OpenTable();
	echo "<table width=100% border=1 cellspacing=0 cellpadding=5 bordercolor=red>";
		echo "<tr>";
			echo "<td align=center><font face=calibri size=2><strong>ATTENZIONE: la proposta è stata stampata e bloccata, per modificarla creare una copia figlio e lavorare su quella</strong></font></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td align=center valign=middle><input type=button value='PROPOSTA BLOCCATA' disabled></td>";
		echo "</tr>";
	echo "</table>";
	CloseTable();
}
?>