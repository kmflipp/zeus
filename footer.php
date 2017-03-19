<?php
if (stristr(htmlentities($_SERVER['PHP_SELF']), "footer.php")) {
	Header("Location: index.php");
	die();
}

function footmsg() {
	global $foot1, $foot2, $foot3, $copyright, $total_time, $start_time, $commercial_license, $footmsg;
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$end_time = $mtime;
	$total_time = ($end_time - $start_time);
	$total_time = "Page generation time: ".substr($total_time,0,4)." seconds.";
	
	echo "<center><font face=verdana size=1 color=black><strong>ZEUS</strong>, Copyright by RVA Associati SA, Lugano - powered by <a href=http://www.infotrek.ch target=_blank><strong>Infotrek</strong></a><br>$total_time</font></center>";
}

function foot() {
	global $prefix, $user_prefix, $db, $index, $user, $cookie, $storynum, $user, $cookie, $Default_Theme, $foot1, $foot2, $foot3, $foot4, $home, $name, $admin, $commercial_license;

	echo "</td></tr>";
	echo "<tr height=1 align=top><td bgcolor=lightgrey>";
	OpenTable();
	footmsg();
	CloseTable();

	themefooter();
	echo "</body>\n</html>";
  
  ob_end_flush();
}

foot();

?>