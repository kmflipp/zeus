<?php

$subname = $_GET[subname];
if($subname=='') $subname = $_POST[subname];
if($subname=='') {$subname='tipologie';$_GET[subname]='tipologie';}

if (file_exists("gestionale/".$subname.".php")) {
	include("gestionale/".$subname.".php");
} else {
	die ("Sorry, such file doesn't exist...");
}

echo "
<br>
<br>
<br>
<br>
<br>
<br>
";
?>