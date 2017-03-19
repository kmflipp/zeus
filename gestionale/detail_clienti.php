<script language=JavaScript>
var myRequest3 = null;

function CreateXmlHttpReq(handler) {
  var xmlhttp = null;
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = handler;
  return xmlhttp;
}

function myHandler() {
   	var n = myRequest.responseText.split(",");
	  var e = document.getElementById(8472);
    if (myRequest.readyState == 4 && myRequest.status == 200 && n[1]=='1') {
		 	e.style.visibility = 'visible';
		 	e.style.display = 'block';
		 	e.innerHTML = '<strong>Record Saved!</strong>';
    }
    else
    {
    	if (n[1]=='0') {
     		e.style.visibility = 'visible';
     		e.style.display = 'block';
     		e.innerHTML = '<strong><font color=red>Error Saving Record!!</font></strong>';
    	}
    }
}

function query_now(tabindex,event,id,field,valore) {
			if (event.keyCode=='13') {
				tabindex++;
				document.getElementById(tabindex).focus();
			}
	    myRequest = CreateXmlHttpReq(myHandler);
    	myRequest.open('GET','clienti_query.php?field='+field+'&id='+id+'&valore='+valore);
    	myRequest.send(null);
}

</script>

<?php
$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$azioni = $_GET[azioni];
$idcliente = $_GET[idcliente];
$iddetail = $_GET[iddetail];
$detail = $_GET[detail];
$value = $_GET[value];

if ($azioni == 'nuovo'){
	$sql = "INSERT INTO nuke_clienti_detail (idcliente) VALUES ('$idcliente')";
	$db->sql_query($sql);
}
if ($azioni == 'del'){
	$sql = "DELETE FROM nuke_clienti_detail WHERE id='$iddetail'";
	$db->sql_query($sql);
}

OpenTable();
echo "<input type=button value='New Detail' onclick=location.href='gestionale.php?name=clienti&act=explode&azioni=nuovo&idcliente=$id&id=$id' style='font-family: Verdana; font-size: 10px'><br><br>";
echo '<table width=100% border=1 cellpadding=5 cellspacing=0 bordercolor=darkgreen>';
$sql = "SELECT * FROM nuke_clienti_detail WHERE idcliente='$id' order by id";
$rs = $db->sql_query($sql);
$x=1;
while ($row = $db->sql_fetchrow($rs))
{
	echo '<tr>';
		echo "<td valign=bottom align=left>";
			echo "<font face=calibri style=font-size:24px;><strong>Label</strong>: <input type=text size=40 style=font-size:24px; id=$x tabindex=$x onkeyup=javascript:query_now($x,event,'$row[id]','detail',this.value) value='$row[detail]'>&nbsp;&nbsp;&nbsp;";
			$x++;
			echo "<font face=calibri style=font-size:24px;><strong>Value</strong>: <input type=text size=50 style=font-size:24px; id=$x tabindex=$x onkeyup=javascript:query_now($x,event,'$row[id]','value',this.value) value='$row[value]'>";
			$x++;
		echo "</td>";
		echo "<td align=center valign=middle><a href=gestionale.php?name=clienti&act=explode&azioni=del&iddetail=$row[id]&id=$id $confirm><img border=0 src=immagini/remove.png></a></td>";
	echo '</tr>';
}
echo '</table>';
CloseTable();

?>
