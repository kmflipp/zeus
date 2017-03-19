<?php
$bgcolor1 = "#FFFFFF";
$bgcolor2 = "#FFFFFF";
$bgcolor3 = "#A395BA";
$bgcolor4 = "#A395BA";
$textcolor1 = "#B1A1C9";
$textcolor2 = "#B1A1C9";

include("themes/PurpleDaze/tables.php");

function themeheader() {
    global $user, $banners, $sitename, $slogan, $cookie, $prefix, $dbi, $db;
    cookiedecode($user);
    $username = $cookie[1];
    if ($username == "") {
        $username = "Anonymous";
    }
    if ($_GET[scrolltop]=='') $_GET[scrolltop]='0';
    $onload = "document.getElementById('offerte').scrollTop=$_GET[scrolltop]";
    echo "<body onload=$onload; text=\"#655D74\" leftmargin=\"10\" topmargin=\"10\" marginwidth=\"10\" marginheight=\"10\">";
    include("themes/PurpleDaze/header.html");
}

function themefooter() {
    global $index, $foot1, $foot2, $foot3, $foot4, $copyright, $totaltime, $footer_message;
    include("themes/PurpleDaze/footer.html");
}

?>
