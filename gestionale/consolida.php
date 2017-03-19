<?php
require_once("../mainfile.php");
include("../header.php");
global $prefix, $db, $admin, $user;
$id = $_GET[idofferta];
$confirm = 'onclick="return confirm(' . chr(39) . 'Attenzione, questa azione non potrà essere annullata. Sei veramente sicuro di continuare?' . chr(39) . ')"';

//estraggo i dati dalla tabella principale e li inserisco in quella consolidata
$sql = "insert into nuke_polizze (SELECT * FROM nuke_offerte WHERE id=$_GET[id])";
$result = $db->sql_query($sql);


echo "ID Offerta selezionata: $_GET[idofferta], procedura di consolidamento in preparazione";

?>