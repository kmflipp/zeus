<?php
require_once("mainfile.php");
include("header.php");
global $prefix, $db, $admin, $user;

$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$act = $_GET[act];
$user_id = $_GET[user_id];
$pag = $_GET['pag'];
$ord = $_GET['ord'];
$tablename = "nuke_users";

$name1 = $_GET[name1];
$username = $_GET[username];
$user_email = $_GET[user_email];
$user_password = $_GET[user_password];


if ($user=='')
{
	header('Location: modules.php?name=Your_Account');
}


title("$sitename: Parametri <i>utenti</i>");
?>
	<script>
		if (navigator.appName=='Netscape') {
			if (screen.height>1000) allora=screen.height-340;
			if (screen.height<1000) allora=screen.height-380;
			document.write('<div class="offerte" id="offerte" style="position:relative;width:100%;margin-top:0;  _position:absolute;_top:expression(eval(document.body.scrollTop)+58);height:'+allora+'px;overflow:auto;padding:0px;">');
		}
		if (navigator.appName=='Microsoft Internet Explorer') {
			if (window.document.documentElement.offsetHeight>1000) allora=window.document.documentElement.offsetHeight-200;
			if (window.document.documentElement.offsetHeight<1000) allora=window.document.documentElement.offsetHeight-200;
			document.write('<div class="offerte" id="offerte" style="position:relative;width:100%;margin-top:100;_position:absolute;_top:expression(eval(document.body.scrollTop)+58);height:'+allora+'px;overflow:auto;padding:0px;">');
		}
	</script>
<?php
OpenTable();
echo '<p>';
echo '<input type=button value="Nuovo Record" onclick="location.href=' . chr(39) . 'gestionale.php?name=parametri&subname=utenti&act=new&ord=' . $ord . '&pag='. $pag . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '<input type=button value="Ricerca" onclick="location.href=' . chr(39) . 'gestionale.php?name=parametri&subname=utenti&act=search&ord=' . $ord . '&pag='. $pag . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '<input type=button value="Mostra tutti i record" onclick="location.href=' . chr(39) . 'gestionale.php?name=parametri&subname=utenti' . chr(39) . '" style="font-family: Verdana; font-size: 10px">';
echo '</p>';

	if ($act=='sav'){
	$sql = "UPDATE " . $tablename . " SET  name='" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[name1]))))))) . "' ,  username='" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[username]))))))) . "' ,  user_email='" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[user_email]))))))) . "' ,  user_password='" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[user_password]))))))) . "' where user_id = '" . $user_id . "'";
		$result = $db->sql_query($sql);
		$act = '';
	}
	if ($act == 'del'){
		$sql = "DELETE FROM " . $tablename . " WHERE user_id = " . $user_id;
		$result = $db->sql_query($sql);
		$user_id = '';
		$act = '';
	}
	if ($act=='savnew'){
		$sql = "INSERT INTO " . $tablename . " (name,username,user_email,user_password,bio,ublock) VALUES ('" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[name1]))))))) . "','" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[username]))))))) . "','" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[user_email]))))))) . "','" . str_replace("à","&agrave;",str_replace("è","&egrave;",str_replace("é","&egrave;",str_replace("ù","&ugrave;",str_replace("ò","&ograve;",str_replace("ì","&igrave;",str_replace("'","&lsquo;",$_GET[user_password]))))))) . "','','')";
		$result = $db->sql_query($sql);
		$act = '';
	}
	
	if ($user_id=='') $user_id='%';
	$condizioni = " (username<>'Anonymous' and username<>'administrator') and user_id LIKE '$user_id' ";
	
	if ($act=='gosearch') {
		if ($name1 == '') $name1 = '%';
		if ($username == '') $username = '%';
		if ($user_email == '') $user_email = '%';
		if ($user_password == '') $user_password = '%';
		$condizioni .= " AND name LIKE '$name1' AND username LIKE '$username'  AND user_email LIKE '$user_email'  AND user_password LIKE '$user_password'  ";
	}
	
	$x_pag = 10000; //numero massimo di record per pagina
	if ($pag=='') $pag = 1; //prendo il numero di pagina dal query string e se non c'è lo setto a 1
	if ($ord=='') $ord = 'user_id';
	
	$sql = "SELECT user_id,name,username,user_email,user_password FROM ".$tablename." WHERE " . $condizioni;
	$query = $db->sql_query($sql);
	$all_rows = $db->sql_numrows($query);

	$all_pages = ceil($all_rows / $x_pag);
	$first = ($pag - 1) * $x_pag;
	$sql = "SELECT user_id,name,username,user_email,user_password FROM ".$tablename." WHERE $condizioni ORDER BY $ord LIMIT $first, $x_pag";
	$rs = $db->sql_query($sql);
	$nr = $db->sql_numrows($rs);

	echo '<table width=100% border=1 cellspacing=0 cellpadding=0>';
	echo '<tr>';
	echo '<th width=10%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=utenti&ord=user_id>user_id</a></th>';
	echo '<th width=20%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=utenti&ord=name>Nome</a></th>';
	echo '<th width=20%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=utenti&ord=username>username</a></th>';
	echo '<th width=20%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=utenti&ord=user_email>e-mail</a></th>';
	echo '<th width=20%><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=utenti&ord=user_password>password</a></th>';
	echo '<th width=10% colspan=3><font face=verdana size=2 color=blue>Funzionalità</font></th>';
	echo '</tr>';

	if ($act == 'new') {
		echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=subname value=utenti><input type=hidden name=name value=parametri><input type=hidden name=pag value=' . $pag . '><input type=hidden name=act value=savnew>';
		echo '<tr>';
		echo "<td valign=middle align=center><font face=verdana size=2><center>[]</center></td>";
		echo "<td valign=middle align=center><input type=text name=name1 size=25></td>";
		echo "<td valign=middle align=center><input type=text name=username size=25></td>";
		echo "<td valign=middle align=center><input type=text name=user_email size=25></td>";
		echo "<td valign=middle align=center><input type=text name=user_password size=25></td>";
		echo "<td colspan=3 align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
		echo '</tr>';
		echo '</form>';
		$act = '';
	}
	if ($act == 'search') {
		echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=name value=parametri><input type=hidden name=subname value=utenti>';
		echo '<input type=hidden name=pag value=' . $pag . '>';
		echo '<input type=hidden name=act value=gosearch>';
		echo '<tr>';
		echo "<td valign=middle align=center></td>";
		echo "<td valign=middle align=center><input type=text name=name1 size=40></td>";
		echo "<td valign=middle align=center><input type=text name=username size=40></td>";
		echo "<td valign=middle align=center><input type=text name=user_email size=40></td>";
		echo "<td valign=middle align=center><input type=text name=user_password size=40></td>";
		echo "<td colspan=3 align=center valign=middle><input type=submit value=Cerca style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
		echo '</tr>';
		echo '</form>';
		$act = '';
	}

	if ($nr != 0){
		while ($row = $db->sql_fetchrow($rs))
		{
		echo '<tr>';
		if ($user_id == $row['user_id'] && $act == 'mod'){
			echo '<form action=gestionale.php method=get><input type=hidden name=ord value=' . $ord . '><input type=hidden name=name value=parametri><input type=hidden name=subname value=utenti><input type=hidden name=pag value=' . $pag . '><input type=hidden name=act value=sav><input type=hidden name=user_id value=' . $user_id . '>';
			echo "<td valign=middle align=center>" . $row[user_id] . "</td>";
			echo "<td valign=middle align=center><input type=text name=name1 size=40 value='" . $row[name] . "'></td>";
			echo "<td valign=middle align=center><input type=text name=username size=40 value='" . $row[username] . "'></td>";
			echo "<td valign=middle align=center><input type=text name=user_email size=40 value='" . $row[user_email] . "'></td>";
			echo "<td valign=middle align=center><input type=text name=user_password size=40 value='" . $row[user_password] . "'></td>";
			echo "<td colspan=3 align=center valign=middle><input type=submit value=Salva style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'><input type=reset value=Reset style='font-family: verdana; font-size: 8pt; border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px'></td>";
			echo '</form>';
		}else{
			echo "<td valign=middle align=center><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=utenti&user_id=" . $row[user_id] . ">" . $row[user_id] . "</a></td>";
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[name] . "</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[username] . "</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[user_email] . "</td>";
			echo "<td valign=middle align=center><font face=verdana size=2>" . $row[user_password] . "</td>";
			echo "<td align=center valign=middle><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=utenti&ord=" . $ord . "&pag=" . $pag . "&act=mod&user_id=" . $row[user_id] . "><img border=0 src=immagini/modify.png></a></td>";
			echo "<td align=center valign=middle><font face=verdana size=2><a href=gestionale.php?name=parametri&subname=utenti&ord=" . $ord . "&pag=" . $pag . "&act=del&user_id=" . $row[user_id] . " " . $confirm . "><img border=0 src=immagini/remove.png></a></td>";
		}
		echo '</tr>';
		}
	}
	echo "</table>";
CloseTable();
?>

<script language=JavaScript>
	document.getElementById("offerte").scrollTop=<?php echo $_GET[scrolltop]; ?>;
</script>

<?php
echo "</div>";
?>
