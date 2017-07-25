<?php

/************************************************************/
/* Theme Name: XPMidnight (v0.9)                            */
/* Theme Developer: Rick Bennett                            */
/* Last Updated: 29/09/2001                                 */
/*                                                          */
/************************************************************/

/************************************************************/
/* Theme Colors Definition                                  */
/*                                                          */
/* Define colors for your web site. $bgcolor2 is generaly   */
/* used for the tables border as you can see on OpenTable() */
/* function, $bgcolor1 is for the table background and the  */
/* other two bgcolor variables follows the same criteria.   */
/* $texcolor1 and 2 are for tables internal texts           */
/************************************************************/

$bgcolor1 = "#AFBFCF";
$bgcolor2 = "#AFBFCF";
$bgcolor3 = "#AFBFCF";
$bgcolor4 = "#AFBFCF";
$textcolor1 = "#000000";
$textcolor2 = "#000000";
$textcolor3 = "#000000";

/************************************************************/
/* OpenTable Functions                                      */
/*                                                          */
/* Define the tables look&feel for you whole site. For this */
/* we have two options: OpenTable and OpenTable2 functions. */
/* Then we have CloseTable and CloseTable2 function to      */
/* properly close our tables. The difference is that        */
/* OpenTable has a 100% width and OpenTable2 has a width    */
/* according with the table content                         */
/************************************************************/

include("themes/XPMidnight/tables.php");

/************************************************************/
/* FormatStory                                              */
/*                                                          */
/* Here we'll format the look of the stories in our site.   */
/* If you dig a little on the function you will notice that */
/* we set different stuff for anonymous, admin and users    */
/* when displaying the story.                               */
/************************************************************/

function FormatStory($thetext, $notes, $aid, $informant) {
    global $anonymous;
    if ($notes != "") {
	$notes = "<br><br><b>"._NOTE."</b> <i>$notes</i>\n";
    } else {
	$notes = "";
    }
    if ("$aid" == "$informant") {
	echo "<font class=\"content\">$thetext$notes</font>\n";
    } else {
	if($informant != "") {
	    $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
	} else {
	    $boxstuff = "$anonymous ";
	}
	$boxstuff .= "".translate("writes")." <i>\"$thetext\"</i>$notes\n";
	echo "<font class=\"content\" color=\"#505050\">$boxstuff</font>\n";
    }
}

/************************************************************/
/* Function themeheader()                                   */
/*                                                          */
/* Control the header for your site. You need to define the */
/* BODY tag and in some part of the code call the blocks    */
/* function for left side with: blocks(left);               */
/************************************************************/

function themeheader() {
    global $user, $banners, $sitename, $slogan, $cookie, $prefix;
    cookiedecode($user);
    $username = $cookie[1];
    if ($username == "") {
        $username = "Anonymous";
    }
    echo "<body bgcolor=\"#ffffff\" topmargin=\"0\" leftmargin=\"0\" marginheight=\"0\" marginwidth=\"0\">\n";
    if ($banners) {
	include("banners.php");
    }
    echo "<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" align=\"center\" bgcolor=\"#F3F4F7\">\n"
        ."<tr>\n"
        ."<td bgcolor=\"#ffffff\" colspan=\"4\"><img src=\"themes/XPMidnight/images/pixel.gif\" width=\"1\" height=\"1\" alt=\"\" border=\"0\" hspace=\"0\"></td>\n"
        ."</tr>\n"
	."<tr valign=\"middle\" bgcolor=\"#E0E2EB\">\n"
    ."<td align=\"left\" valign=\"top\" width=\"8\" height=\"22\"><img src=\"themes/XPMidnight/images/topnav-left.gif\"></td>\n"
	."<td width=\"15%\" background=\"themes/XPMidnight/images/topnav-bg.gif\" nowrap><font class=\"content\" color=\"#363636\">\n";

    if ($username == "Anonymous") {
	echo "<a href=\"modules.php?name=Your_Account\">"._LOGIN."</a> or <a href=\"modules.php?name=Your_Account&op=new_user\">"._BREG."</a>";
    } else {
	echo ""._BWEL." $username! | <a href=\"modules.php?name=Your_Account&op=logout\">"._LOGOUT."</a>";
    }
    echo "</td>\n"
	."<td align=\"center\" height=\"20\" width=\"68%\" background=\"themes/XPMidnight/images/topnav-bg.gif\"><font class=\"content\">\n"
	."&nbsp;&middot;&nbsp;\n"
	."<A href=\"index.php\">Home</a>\n"
	."&nbsp;&middot;&nbsp;\n"
        ."</font>\n"
        ."</td>\n"
        ."<td align=\"left\" valign=\"top\" width=\"8\" height=\"22\"><img src=\"themes/XPMidnight/images/topnav-left.gif\"></td>\n"
        ."<td align=\"right\" width=\"140\" background=\"themes/XPMidnight/images/topnav-bg.gif\"><font class=\"content\">\n"
        ."<script type=\"text/javascript\">\n\n"
        ."<!--   // Array ofmonth Names\n"
        ."var monthNames = new Array( \""._JANUARY."\",\""._FEBRUARY."\",\""._MARCH."\",\""._APRIL."\",\""._MAY."\",\""._JUNE."\",\""._JULY."\",\""._AUGUST."\",\""._SEPTEMBER."\",\""._OCTOBER."\",\""._NOVEMBER."\",\""._DECEMBER."\");\n"
        ."var now = new Date();\n"
        ."thisYear = now.getYear();\n"
        ."if(thisYear < 1900) {thisYear += 1900}; // corrections if Y2K display problem\n"
        ."document.write(monthNames[now.getMonth()] + \" \" + now.getDate() + \", \" + thisYear);\n"
        ."// -->\n\n"
        ."</script></font>&nbsp;</td>\n"
        ."</tr>\n"
        ."<tr>\n"
        ."<td bgcolor=\"#E0E2EB\" colspan=\"5\"><IMG src=\"themes/XPMidnight/images/pixel.gif\" width=\"1\" height=\"3\" alt=\"\" border=\"0\" hspace=\"0\"></td>\n"
        ."</tr>\n"
        ."<tr>\n"
        ."<td bgcolor=\"#ACA899\" colspan=\"5\"><IMG src=\"themes/XPMidnight/images/pixel.gif\" width=\"1\" height=\"1\" alt=\"\" border=\"0\" hspace=\"0\"></td>\n"
        ."</tr>\n"
        ."<tr>\n"
        ."<td bgcolor=\"#716F64\" colspan=\"5\"><IMG src=\"themes/XPMidnight/images/pixel.gif\" width=\"1\" height=\"1\" alt=\"\" border=\"0\" hspace=\"0\"></td>\n"
        ."</tr>\n"
        ."</table>\n"
	."<!----- Begin Main Content Table ----->\n"
	."<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" bgcolor=\"#ffffff\" align=\"center\"><tr valign=\"top\">\n"
	."<td bgcolor=\"#3A70B1\"><img src=\"themes/XPMidnight/images/pixel.gif\" width=\"10\" height=\"1\" border=\"0\" alt=\"\"></td>\n"
	."<td bgcolor=\"#3A70B1\" width=\"175\" valign=\"top\">\n";
    blocks(left);
    echo "</td><td bgcolor=\"#3A70B1\"><img src=\"themes/XPMidnight/images/pixel.gif\" width=\"15\" height=\"1\" border=\"0\" alt=\"\"></td>\n"
        ."<td bgcolor=\"#ffffff\"><img src=\"themes/XPMidnight/images/pixel.gif\" width=\"15\" height=\"1\" border=\"0\" alt=\"\"></td>\n"
        ."<td width=\"100%\">\n";
    $public_msg = public_message();
    echo "<center>$public_msg</center><br>";
 
                $datetime = "<script type=\"text/javascript\">\n\n"
	        ."<!--   // Array ofmonth Names\n"
	        ."var monthNames = new Array( \""._JANUARY."\",\""._FEBRUARY."\",\""._MARCH."\",\""._APRIL."\",\""._MAY."\",\""._JUNE."\",\""._JULY."\",\""._AUGUST."\",\""._SEPTEMBER."\",\""._OCTOBER."\",\""._NOVEMBER."\",\""._DECEMBER."\");\n"
	        ."var now = new Date();\n"
	        ."thisYear = now.getYear();\n"
	        ."if(thisYear < 1900) {thisYear += 1900}; // corrections if Y2K display problem\n"
	        ."document.write(monthNames[now.getMonth()] + \" \" + now.getDate() + \", \" + thisYear);\n"
	        ."// -->\n\n"
	        ."</script>";
}

/************************************************************/
/* Function themefooter()                                   */
/*                                                          */
/* Control the footer for your site. You don't need to      */
/* close BODY and HTML tags at the end. In some part call   */
/* the function for right blocks with: blocks(right);       */
/* Also, $index variable need to be global and is used to   */
/* determine if the page your're viewing is the Homepage or */
/* and internal one.                                        */
/************************************************************/

function themefooter() {
    global $index;
    if ($index == 1) {
	echo "</td><td><img src=\"themes/XPMidnight/images/pixel.gif\" width=\"15\" height=\"1\" border=\"0\" alt=\"\"></td><td valign=\"top\" width=\"175\">\n";
	blocks(right);
    }
    echo "</td><td bgcolor=\"#FFFFFF\"><img src=\"themes/XPMidnight/images/pixel.gif\" width=10 height=1 border=0 alt=\"\">\n"
	."</td></tr></table>\n"
        ."<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" bgcolor=\"#3A7OB1\" align=\"center\">\n"
        ."<tr align=\"center\">\n"
        ."<td width=\"100%\" colspan=\"3\">\n";
    footmsg();
    echo "</td>\n"
        ."</tr></table>\n";
}

/************************************************************/
/* Function themeindex()                                    */
/*                                                          */
/* This function format the stories on the Homepage         */
/************************************************************/

function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
    global $anonymous, $datetime, $tipath;
    echo "<br><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#ffffff\" width=\"100%\">\n"
    ."<tr>\n"
    ."<td>\n"

	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n"
	."<tr>\n"
	."<td align=\"left\" valign=\"top\" width=\"26\" height=\"30\"><img src=\"themes/XPMidnight/images/sidebox-title-left.gif\"></td>\n"
	."<td align=\"left\" valign=\"middle\" background=\"themes/XPMidnight/images/sidebox-title-bg.gif\" width=\"100%\" height=\"30\">\n"
	."<font class=\"storytitle\" color=\"#363636\">&nbsp;&nbsp;<b>$title</b></font>\n"
	."</td>\n"
	."<td align=\"left\" valign=\"top\" width=\"6\" height=\"30\"><img src=\"themes/XPMidnight/images/sidebox-title-right.gif\"></td>\n"
	."</tr>\n"
	."</table>\n"

	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n"
	."<tr>\n"
	."<td>\n"

	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n"
	."<tr>\n"
	."<td align=\"left\" valign=\"top\" width=\"15\" height=\"42\"><img src=\"themes/XPMidnight/images/storybox-left.gif\"></td>\n"
	."<td align=\"left\" valign=\"middle\" background=\"themes/XPMidnight/images/storybox-bg.gif\" width=\"100%\" height=\"42\">\n"
	."<font color=\"#747474\" size=\"1\">"._POSTEDBY." ";
    formatAidHeader($aid);
    echo " "._ON." $time $timezone ($counter "._READS.")</font>\n"
	."<font color=\"#747474\">$morelink</font>\n"
	."</td>\n"
    ."<td width=\"12\" align=\"left\" valign=\"top\"><img src=\"themes/XPMidnight/images/storybox-right.gif\"></td>\n"
	."</tr>\n"
	."</table>\n"

	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n"
	."<tr>\n"
	."<td width=\"4\" align=\"left\" valign=\"top\" background=\"themes/XPMidnight/images/sidebox-bar-left.gif\"><img src=\"themes/XPMidnight/images/sidebox-bar-px.gif\"></td>\n"
	."<td>\n"

	."<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" width=\"100%\">\n"
	."<tr valign=\"top\">\n"
	."<td>\n"
	."<font color=\"#747474\"><b><a href=\"search.php?query=&amp;topic=$topic\"><img src=\"$tipath$topicimage\" border=\"0\" Alt=\"$topictext\" align=\"right\" hspace=\"10\" vspace=\"10\"></a></B></font>\n";
    FormatStory($thetext, $notes, $aid, $informant);
    echo "</td></tr></table>\n"
    ."</td>\n"
    ."<td width=\"13\" align=\"left\" valign=\"top\" background=\"themes/XPMidnight/images/storybox-content-right.gif\"><img src=\"themes/XPMidnight/images/storybox-content-right-px.gif\"></td>\n"
    ."</tr></table>\n"

	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n"
	."<tr valign=\"top\">\n"
	."<td width=\"9\" height=\"29\" align=\"left\" valign=\"top\"><img src=\"themes/XPMidnight/images/storybox-bottom-left.gif\"></td>\n"
	."<td width=\"100%\" height=\"29\" background=\"themes/XPMidnight/images/storybox-bottom-bg.gif\">&nbsp;</td>\n"
	."<td width=\"18\" height=\"29\" align=\"left\" valign=\"top\"><img src=\"themes/XPMidnight/images/storybox-bottom-right.gif\"></td>\n"
    ."</table>\n"

    ."</td></tr></table>\n"

    ."</td></tr></table>\n";
}

/************************************************************/
/* Function themeindex()                                    */
/*                                                          */
/* This function format the stories on the story page, when */
/* you click on that "Read More..." link in the home        */
/************************************************************/

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext) {
    global $admin, $datetime, $sid, $tipath;        
    echo "<br><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#ffffff\" width=\"100%\">\n"
    ."<tr>\n"
    ."<td>\n"

	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n"
	."<tr>\n"
	."<td align=\"left\" valign=\"top\" width=\"26\" height=\"30\"><img src=\"themes/XPMidnight/images/sidebox-title-left.gif\"></td>\n"
	."<td align=\"left\" valign=\"middle\" background=\"themes/XPMidnight/images/sidebox-title-bg.gif\" width=\"100%\" height=\"30\">\n"
	."<font class=\"storytitle\" color=\"#363636\">&nbsp;&nbsp;<b>$title</b></font>\n"
	."</td>\n"
	."<td align=\"left\" valign=\"top\" width=\"6\" height=\"30\"><img src=\"themes/XPMidnight/images/sidebox-title-right.gif\"></td>\n"
	."</tr>\n"
	."</table>\n"

	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n"
	."<tr>\n"
	."<td>\n"

	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n"
	."<tr>\n"
	."<td align=\"left\" valign=\"top\" width=\"15\" height=\"42\"><img src=\"themes/XPMidnight/images/storybox-left.gif\"></td>\n"
	."<td align=\"left\" valign=\"middle\" background=\"themes/XPMidnight/images/storybox-bg.gif\" width=\"100%\" height=\"42\">\n"
	."<font class=\"content\">"._POSTEDON." $datetime "._BY." ";
    formatAidHeader($aid);
    if (is_admin($admin)) {
	echo "<br>[ <a href=\"admin.php?op=EditStory&amp;sid=$sid\">"._EDIT."</a> | <a href=\"admin.php?op=RemoveStory&amp;sid=$sid\">"._DELETE."</a> ]\n";
    }
    echo "</font>\n"
	."\n"
	."</td>\n"
    ."<td width=\"12\" align=\"left\" valign=\"top\"><img src=\"themes/XPMidnight/images/storybox-right.gif\"></td>\n"
	."</tr>\n"
	."</table>\n"

	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n"
	."<tr>\n"
	."<td width=\"4\" align=\"left\" valign=\"top\" background=\"themes/XPMidnight/images/sidebox-bar-left.gif\"><img src=\"themes/XPMidnight/images/sidebox-bar-px.gif\"></td>\n"
	."<td>\n"

	."<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" width=\"100%\">\n"
	."<tr valign=\"top\">\n"
	."<td>\n"
	."<font color=\"#747474\"><b><a href=\"search.php?query=&amp;topic=$topic\"><img src=\"$tipath$topicimage\" border=\"0\" Alt=\"$topictext\" align=\"right\" hspace=\"10\" vspace=\"10\"></a></B></font>\n";
    FormatStory($thetext, $notes="", $aid, $informant);
        echo "</td></tr></table>\n"
    ."</td>\n"
    ."<td width=\"13\" align=\"left\" valign=\"top\" background=\"themes/XPMidnight/images/storybox-content-right.gif\"><img src=\"themes/XPMidnight/images/storybox-content-right-px.gif\"></td>\n"
    ."</tr></table>\n"

	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n"
	."<tr valign=\"top\">\n"
	."<td width=\"9\" height=\"29\" align=\"left\" valign=\"top\"><img src=\"themes/XPMidnight/images/storybox-bottom-left.gif\"></td>\n"
	."<td width=\"100%\" height=\"29\" background=\"themes/XPMidnight/images/storybox-bottom-bg.gif\">&nbsp;</td>\n"
	."<td width=\"18\" height=\"29\" align=\"left\" valign=\"top\"><img src=\"themes/XPMidnight/images/storybox-bottom-right.gif\"></td>\n"
    ."</table>\n"

    ."</td></tr></table>\n"

    ."</td></tr></table>\n";
}

/************************************************************/
/* Function themesidebox()                                  */
/*                                                          */
/* Control look of your blocks. Just simple.                */
/************************************************************/

function themesidebox($title, $content) {
    echo "<br><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"175\"><tr><td>\n"
	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n"
	."<tr>\n"
	."<td align=\"left\" valign=\"top\" width=\"26\" height=\"30\"><img src=\"themes/XPMidnight/images/sidebox-title-left.gif\"></td>\n"
	."<td align=\"left\" valign=\"middle\" background=\"themes/XPMidnight/images/sidebox-title-bg.gif\" width=\"143\" height=\"30\">\n"
	."<font class=\"boxtitle\">&nbsp;&nbsp;<b>$title</b></font></td>\n"
	."<td align=\"left\" valign=\"top\" width=\"6\" height=\"30\"><img src=\"themes/XPMidnight/images/sidebox-title-right.gif\"></td>\n"
	."</tr>\n"
	."</table>\n"
	."</td>\n"
	."</tr>\n"
	."</table>\n\n"
	."<!----- Side Box Content ----->\n"
	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"175\">\n"
	."<tr valign=\"top\">\n"
	."<td width=\"4\" align=\"left\" valign=\"top\" background=\"themes/XPMidnight/images/sidebox-bar-left.gif\"><img src=\"themes/XPMidnight/images/sidebox-bar-px.gif\"></td>\n"

	."<td bgcolor=\"#E1E7ED\" width=\"166\" align=\"left\" valign=\"top\">\n"
	."<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" width=\"166\">\n"
	."<tr>\n"
	."<td>\n"
	."$content\n"
	."</td>\n"
	."</tr>\n"
	."</table>\n"
	."</td>\n"
    ."<td width=\"4\" align=\"left\" valign=\"top\" background=\"themes/XPMidnight/images/sidebox-bar-right.gif\"><img src=\"themes/XPMidnight/images/sidebox-bar-px.gif\"></td>\n"
	."</tr></table>\n"

	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"175\">\n"
	."<tr>\n"
	."<td align=\"left\" valign=\"top\" width=\"175\" height=\"29\">\n"
	."<img src=\"themes/XPMidnight/images/sidebox-bottom.gif\">\n"
	."</td>\n"
	."</tr>\n"
	."</table>\n\n\n";
}

?>