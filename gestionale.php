<?php

require_once("mainfile.php");

if ($user=='')
{
	header('Location: modules.php?name=Your_Account');
}

$name = trim($name);

$modpath .= "gestionale/".$name.".php";
if (file_exists($modpath)) {
	include($modpath);
} else {
	die ("Sorry, such file doesn't exist...");
}
if ($name!='stampa_polizza' || $name!='stampa_offerta') {
	include("footer.php");
}
?>


