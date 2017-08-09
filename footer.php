<?php

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2005 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (stristr(htmlentities($_SERVER['PHP_SELF']), "footer.php")) {
	Header("Location: index.php");
	die();
}

define('NUKE_FOOTER', true);

function footmsg() {
	global $foot1, $foot2, $foot3, $copyright, $total_time, $start_time, $commercial_license, $footmsg;
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$end_time = $mtime;
	$total_time = ($end_time - $start_time);
	$total_time = _PAGEGENERATION." ".substr($total_time,0,4)." "._SECONDS;
	
	//echo "<p><center><font face=verdana size=1 color=darkgrey><strong>ZEUS Copyright by RVA Associati</strong> - developed, manteined and styled by <a href=http://www.infotrek.ch target=_blank><strong>Infotrek</strong></a><br>$total_time</font></center></p>";
}

function foot() {
	global $prefix, $user_prefix, $db, $index, $user, $cookie, $storynum, $user, $cookie, $Default_Theme, $foot1, $foot2, $foot3, $foot4, $home, $name, $admin, $commercial_license;
	if(defined('HOME_FILE')) {
		blocks("Down");
	}
	if (basename($_SERVER['PHP_SELF']) != "index.php" AND defined('MODULE_FILE') AND file_exists("modules/$name/copyright.php") && $commercial_license != 1) {
		$cpname = str_replace("_", " ", $name);
		echo "<div align=\"right\"><a href=\"javascript:openwindow()\">$cpname &copy;</a></div>";
	}
	if (basename($_SERVER['PHP_SELF']) != "index.php" AND defined('MODULE_FILE') AND (file_exists("modules/$name/admin/panel.php") && is_admin($admin))) {
		echo "<br>";
		OpenTable();
		include("modules/$name/admin/panel.php");
		CloseTable();
	}
	themefooter();
	if (file_exists("includes/custom_files/custom_footer.php")) {
		include_once("includes/custom_files/custom_footer.php");
	}
	echo "</body>\n</html>";
        ob_end_flush();
	die();
}

foot();

?>