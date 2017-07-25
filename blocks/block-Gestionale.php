<?php

if ( !defined('BLOCK_FILE') ) {
	Header("Location: ../index.php");
	die();
}

global $prefix, $db, $admin, $language, $currentlang, $name;

		$content .= "<p>";
    $result3 = $db->sql_query("SELECT title, custom_title FROM " . $prefix . "_gestionale WHERE active='1' AND inmenu='1' ORDER BY mid ASC");
    while ($row3 = $db->sql_fetchrow($result3)) {
	    $result33 = $db->sql_query("SELECT title, custom_title FROM " . $prefix . "_gestionale_submenu WHERE active='1' AND parent_title='".$row3['title']."'");
			$title = $row3['title'];
			$custom_title = $row3['custom_title'];
			if ($name=='Your_Account') $name='home';	
			if (strtoupper($title) == strtoupper($name)){
				$content .= "<strong><big>&middot;</big>&nbsp;<a href=\"gestionale.php?name=$title\">".strtoupper($custom_title)."</a></strong><br>\n";
				while ($row33 = $db->sql_fetchrow($result33)) {
					$title33 = $row33['title'];
					$custom_title33 = $row33['custom_title'];
					if (strtoupper($title33) == strtoupper($_GET[subname])){
						$content .= "&nbsp;&nbsp;<strong><big>&middot;</big>&nbsp;<a href=\"gestionale.php?name=$title&subname=$title33\">".strtoupper($custom_title33)."</a></strong><br>\n";
					}else{
						$content .= "&nbsp;&nbsp;<strong><big>&middot;</big></strong>&nbsp;<a href=\"gestionale.php?name=$title&subname=$title33\">".strtoupper($custom_title33)."</a></strong><br>\n";
					}
				}
			}else{
				$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"gestionale.php?name=$title\">".strtoupper($custom_title)."</a><br>\n";
	    }
	  }
    $content .= "<br><br>";
		$content .= "</p>";


?>