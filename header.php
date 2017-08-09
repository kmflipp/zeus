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

if (stristr(htmlentities($_SERVER['PHP_SELF']), "header.php")) {
	Header("Location: index.php");
	die();
}

define('NUKE_HEADER', true);
require_once("mainfile.php");

##################################################
# Include some common header for HTML generation #
##################################################


function head() {
	global $slogan, $sitename, $banners, $nukeurl, $Version_Num, $artpage, $topic, $hlpfile, $user, $hr, $theme, $cookie, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $textcolor1, $textcolor2, $forumpage, $adminpage, $userpage, $pagetitle;
	$ThemeSel = get_theme();
	include_once("themes/PurpleDaze/theme.php");
	echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n";
	echo "<html>\n";
	echo "<head>\n";
	echo "<title>$sitename $pagetitle</title>\n";
	echo '<link rel="shortcut icon" href="images/icona.gif">';

	include("includes/meta.php");
	include("includes/javascript.php");

	echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS\" href=\"backend.php\">\n";
	echo "<LINK REL=\"StyleSheet\" HREF=\"themes/$ThemeSel/style/style.css\" TYPE=\"text/css\">\n\n\n";
	if (file_exists("includes/custom_files/custom_head.php")) {
		include_once("includes/custom_files/custom_head.php");
	}
	?>
	<link rel="stylesheet" type="text/css" media="all" href="includes/skins/aqua/theme.css" title="Aqua" />
	<style type="text/css">
		body { 
			background:url(/images/sfumaturaSfondo.png) 0 0 repeat-x; margin:0;
		}
		#dhtmlfloatie1{
			display: none;
		}
		#dhtmlfloatie2{
			display: none;
		}
	</style>

	<script type="text/javascript" src="includes/calendar.js"></script>
	<script type="text/javascript" src="includes/calendar-it.js"></script>
	<script type="text/javascript">
	
	var oldLink = null;
	function setActiveStyleSheet(link, title) {
	  var i, a, main;
	  for(i=0; (a = document.getElementsByTagName("link")[i]); i++) {
	    if(a.getAttribute("rel").indexOf("style") != -1 && a.getAttribute("title")) {
	      a.disabled = true;
	      if(a.getAttribute("title") == title) a.disabled = false;
	    }
	  }
	  if (oldLink) oldLink.style.fontWeight = 'normal';
	  oldLink = link;
	  link.style.fontWeight = 'bold';
	  return false;
	}
	
	// This function gets called when the end-user clicks on some date.
	function selected(cal, date) {
	  cal.sel.value = date; // just update the date in the input field.
	  if (cal.dateClicked && (cal.sel.id == "sel1" || cal.sel.id == "sel3"))
	    cal.callCloseHandler();
	}
	
	function closeHandler(cal) {
	  cal.hide();                        // hide the calendar
	//  cal.destroy();
	  _dynarch_popupCalendar = null;
	}
	
	function showCalendar(id, format, showsTime, showsOtherMonths) {
	  var el = document.getElementById(id);
	  if (_dynarch_popupCalendar != null) {
	    // we already have some calendar created
	    _dynarch_popupCalendar.hide();                 // so we hide it first.
	  } else {
	    // first-time call, create the calendar.
	    var cal = new Calendar(1, null, selected, closeHandler);
	    // uncomment the following line to hide the week numbers
	    // cal.weekNumbers = false;
	    if (typeof showsTime == "string") {
	      cal.showsTime = true;
	      cal.time24 = (showsTime == "24");
	    }
	    if (showsOtherMonths) {
	      cal.showsOtherMonths = true;
	    }
	    _dynarch_popupCalendar = cal;                  // remember it in the global var
	    cal.setRange(1900, 2070);        // min/max year allowed.
	    cal.create();
	  }
	  _dynarch_popupCalendar.setDateFormat(format);    // set the specified date format
	  _dynarch_popupCalendar.parseDate(el.value);      // try to parse the text in field
	  _dynarch_popupCalendar.sel = el;                 // inform it what input field we use
	
	  _dynarch_popupCalendar.showAtElement(el.nextSibling, "Br");        // show the calendar
	
	  return false;
	}
	
	var MINUTE = 60 * 1000;
	var HOUR = 60 * MINUTE;
	var DAY = 24 * HOUR;
	var WEEK = 7 * DAY;
	
	function isDisabled(date) {
	  var today = new Date();
	  return (Math.abs(date.getTime() - today.getTime()) / DAY) > 10;
	}
	
	function flatSelected(cal, date) {
	  var el = document.getElementById("preview");
	  el.innerHTML = date;
	}
	
	function showFlatCalendar() {
	  var parent = document.getElementById("display");
	
	  var cal = new Calendar(0, null, flatSelected);
	
	  cal.weekNumbers = false;
	
	  cal.setDisabledHandler(isDisabled);
	  cal.setDateFormat("%A, %B %e");
	
	  cal.create(parent);
	
	  cal.show();
	}
	
	function stampa(id) {
		window.location = "gestionale.php?name=lloyds&subname=offerte&act=explode&view=stampa&id="+id
	}

	function ricalcola() {
		window.location.reload();
	}

	function consolida(id) {
		window.location = "/consolida.php?idofferta="+id
	}
	
	</script>

	<?php
	echo "\n\n\n</head>\n\n";

	if (file_exists("includes/custom_files/custom_header.php")) {
		include_once("includes/custom_files/custom_header.php");
	}
	themeheader();
}

online();
head();
if(defined('HOME_FILE')) {
	message_box();
	blocks("Center");
}

?>