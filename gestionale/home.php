<?php
if ($_GET[cookie]=='reset') setcookie("idcliente", "", time()-3600);
header("Location: /modules.php?name=Your_Account");

?>