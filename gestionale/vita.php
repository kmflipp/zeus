<?php
$subname = $_GET[subname];
if($subname=='') {$subname='niente';$_GET[subname]='niente';}
if($subname=='vita') {$subname='niente';$_GET[subname]='niente';}

if (file_exists("gestionale/".$subname.".php")) {
	include("gestionale/".$subname.".php");
} else {

require_once("mainfile.php");
include("header.php");
global $prefix, $db, $admin, $user;

$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';
$act = $_GET[act];
$id = $_GET[id];
$pag = $_GET['pag'];
$ord = $_GET['ord'];

title("$sitename: Ramo <i>vita</i>");
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
OpenTable();

CloseTable();

?>

<script language=JavaScript>
	document.getElementById("offerte").scrollTop=<?php echo $_GET[scrolltop]; ?>;
</script>

<?php
echo "</div>";
}
?>
