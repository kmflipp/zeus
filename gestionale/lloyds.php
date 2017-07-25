<?php
$subname = $_GET[subname];
if($subname=='') {$subname='offerte';$_GET[subname]='offerte';}

if (file_exists("gestionale/".$subname.".php")) {
	include("gestionale/".$subname.".php");
} else {
	die ("Sorry, such file doesn't exist...");
}

?>