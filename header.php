<?php
if (stristr(htmlentities($_SERVER['PHP_SELF']), "header.php")) {
	Header("Location: index.php");
	die();
}
require_once("mainfile.php");

function head() {
	global $slogan, $sitename, $banners, $nukeurl, $Version_Num, $artpage, $topic, $hlpfile, $user, $hr, $theme, $cookie, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $textcolor1, $textcolor2, $forumpage, $adminpage, $userpage, $pagetitle;
	$ThemeSel = get_theme();
	include_once("themes/PurpleDaze/theme.php");
	echo "<html>\n";
	echo "<head>\n";
	echo "<title>$sitename $pagetitle</title>\n";
	echo '<link rel="stylesheet" type="text/css" href="includes/popupmenu.css">';
	echo '<link rel="shortcut icon" href="images/icona.png">';
	echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS\" href=\"backend.php\">\n";
	echo "<LINK REL=\"StyleSheet\" HREF=\"themes/$ThemeSel/style/style.css\" TYPE=\"text/css\">\n\n\n";
	echo '<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>';
	echo '<script type="text/javascript" src="includes/popupmenu.js"></script>';
	include("includes/meta.php");
	include("includes/javascript.php");
	include("includes/styles.htm");
	include("includes/javascript.htm");
	echo "\n\n\n</head>\n\n";
        themeheader();
}
 
head();
?>