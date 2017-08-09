<?php
$bgcolor1 = "#FFFFFF";
$bgcolor2 = "#93BED6";
$bgcolor3 = "#FFFFFF";
$bgcolor4 = "#FFFFFF";
$textcolor1 = "#FFFFFF";
$textcolor2 = "#FFFFFF";

function OpenTable() {
    global $bgcolor1, $bgcolor2;
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$bgcolor2\"><tr><td>\n";
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"8\" bgcolor=\"$bgcolor1\"><tr><td>\n";
}

function CloseTable() {
    echo "</td></tr></table></td></tr></table>\n";
}

function OpenTable2() {
    global $bgcolor1, $bgcolor2;
    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$bgcolor2\" align=\"center\"><tr><td>\n";
    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"8\" bgcolor=\"$bgcolor1\"><tr><td>\n";
}

function CloseTable2() {
    echo "</td></tr></table></td></tr></table>\n";
}

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
	    $boxstuff = "<a href=\"user.php?op=userinfo&amp;uname=$informant\">$informant</a> ";
	} else {
	    $boxstuff = "$anonymous ";
	}
	$boxstuff .= ""._WRITES." <i>\"$thetext\"</i>$notes\n";
	echo "<font class=\"content\">$boxstuff</font>\n";
    }
}

/************************************************************/
/* Function themeheader()                                   */
/************************************************************/

function themeheader() {
    global $banners, $name;  //aggiunto $name per l'hack che elimina i blocchi a sx nei moduli 
    echo "<body background=\"themes/Xelopolis_Iceblue/images/bkg.gif\" bgcolor=\"#FFFFFF\" text=\"#000000\" leftmargin=0 rightmargin=0 topmargin=0><br>\n";//colore testo blocchi
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"#93BED6\" width=\"80\" align=\"center\">\n"//colore sfondo fuori layout (bordo sito)
//inizio menu sopra il logo
    ."<tr><td width=\"100%\" bgcolor=\"#FFFFFF\" height=\"1\" valign=\"bottom\">\n"//sfondo fuori layout sopra logo
    	."<map name=\"FPMap1\">"
	."<area href=\"admin.php\" shape=\"rect\" coords=\"696, 0, 799, 1\">"
	."</map>"
	."<img border=\"0\" src=\"themes/Xelopolis_Iceblue/images/bar_up.gif\" usemap=\"#FPMap1\" width=\"800\" height=\"1\">"
//fine menu sopra il logo

    ."<tr><td width=\"100%\">\n"
	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"800\">\n"
	."<tr><td width=\"100%\">\n"
	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"800\">\n"
	."<tr><td width=\"100%\" height=\"60\" bgcolor=\"#FFFFFF\">\n"//sfondo accanto al logo fuori layout
	."<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\"><tr>\n"
      ."<td width=\50%\"><a href=\"index.php\"><img border=\"0\" src=\"themes/Xelopolis_Iceblue/images/logo.jpg\" alt=\"Xelopolis.com\" hspace=\"0\" height=\"75\" weight=\"150\"></a>\n"
      ."<td width=\50%\">\n";
if ($banners) {
	include("banners.php");
    }
      echo "</td></tr>\n"
         ."</table>\n";    



   echo "</td><td align=\"right\"></td></tr></table></td></tr>\n"
/////////menù sotto il logo
	."<tr><td width=\"100%\" bgcolor=\"#FFFFFF\" height=\"22\" valign=\"bottom\">\n"
	."<map name=\"FPMap0\">"
	."<area href=\"index.php\" shape=\"rect\" coords=\"112, 0, 215, 22\">"
	."<area href=\"modules.php?name=Forums\" shape=\"rect\" coords=\"216, 0, 305, 22\">"
	."<area href=\"modules.php?name=Downloads\" shape=\"rect\" coords=\"307, 0, 399, 22\">"
	."<area href=\"modules.php?name=Web_Links\" shape=\"rect\" coords=\"401, 0, 493, 22\">"
	."<area href=\"modules.php?name=Your_Account\" shape=\"rect\" coords=\"495, 0, 583, 22\">"
	."<area href=\"modules.php?name=Submit_News\" shape=\"rect\" coords=\"585, 0, 689, 22\">"
	."</map>"
	."<img border=\"0\" src=\"themes/Xelopolis_Iceblue/images/bar_down.gif\" usemap=\"#FPMap0\" width=\"800\" height=\"23\">"
/////////

	."</td></tr></table>\n"
	."</td></tr><tr><td width=\"100%\"><table width='100%' cellspacing='0' cellpadding='0' border='0'><tr><td bgcolor='#FFFFFF'>\n"
	."<tr><td bgcolor=\"#FFFFFF\"><img src=\"themes/Xelopolis_Iceblue/images/pixel.gif\" width=\"100%\" height=\"3\"></td></tr>\n";	
    echo "</td></tr></table><table width=\"800\" cellpadding=\"0\" bgcolor=\"#FFFFFF\" cellspacing=\"0\" border=\"0\">\n"
	."<tr valign=\"top\">\n"
	."<td><img src=\"themes/Xelopolis_Iceblue/images/pixel.gif\" width=\"4\" height=\"1\" border=\"0\" alt=\"\"></td>\n"
	."<td width=\"130\" bgcolor=\"#FFFFFF\" valign=\"top\">\n";
	if ($name=='Forums') {}
	else if ($name=='Members_List') {}
	else if ($name=='Private_Messages') {}
   else { 
    blocks(left); 
   }

    echo "</td><td><img src=\"themes/Xelopolis_Iceblue/images/pixel.gif\" width=\"4\" height=\"1\" border=\"0\" alt=\"\"></td><td width=\"100%\">\n";
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
    echo "<br>";
    if ($index == 1) {
	echo "</td><td><img src=\"themes/Xelopolis_Iceblue/images/pixel.gif\" width=\"4\" height=\"1\" border=\"0\" alt=\"\"></td><td valign=\"top\" width=\"130\" bgcolor=\"#FFFFFF\">\n";
	blocks(right);
	echo "<td><img src=\"themes/Xelopolis_Iceblue/images/pixel.gif\" width=\"4\" height=\"1\" border=\"0\" alt=\"\">";
    }
 else {
	echo "</td><td colspan=\"2\"><img src=\"themes/Xelopolis_Iceblue/images/pixel.gif\" width=\"4\" height=\"1\" border=\"0\" alt=\"\">";
    }
    echo "<br><br></td></tr></table>\n"
    ."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"
style=\"border-collapse: collapse\" bordercolor=\"#FBFBFD\" width=\"100%\"
bgcolor=\"#FBFBFD\"><tr><td width=\"100%\">"
	."<br><center>";
    footmsg();
	// DO NOT REMOVE THE FOLLOWING COPYRIGHT LINE. YOU'RE NOT ALLOWED TO REMOVE NOR EDIT THIS.
	echo"<a href=\"http://www.xelopolis.com\" target=\"_blank\"><img src=\"http://www.xelopolis.com/bannieremini.gif\" align=\"right\" width=\"112\" height=\"26\" border=\"0\"></a>";
    echo "</center></table></table></table>";
}


function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
    global $anonymous, $tipath;
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"><tr><td>\n"
	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\"><tr><td bgcolor=\"#FFFFFF\">\n"
	."<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" width=\"100%\"><tr>\n"
	."<td background=\"themes/Xelopolis_Iceblue/images/header_news.gif\" width=\"100%\" height=\"24\"><font class=\"option\"><b><CENTER>$title</CENTER></b></font></td></tr>\n"//barretta sopra accanto icona
	."<tr><td colspan=\"2\" bgcolor=\"#93BED6\">\n"
	."<table border=\"0\" width=\"100%\" bgcolor=\"#FBFBFD\" align=\"center\"><tr><td>\n"
	."<a href=\"modules.php?name=News&new_topic=$topic\"><img src=\"$tipath$topicimage\" alt=\"$topictext\" border=\"0\" align=\"right\"></a>";
    FormatStory($thetext, $notes, $aid, $informant);
    echo "</td></tr></table>\n"
	."</td></tr></table>\n"
	."</td></tr><tr><td bgcolor=\"#F0F1F9\" align=\"left\">\n"
    ."&nbsp"
	."<b><font class=\"tiny\">"._POSTEDBY." ";
    formatAidHeader($aid);
    echo " "._ON." $time $timezone <br>&nbsp($counter "._READS.")</font>\n"
	."<font class=\"content\">$morelink</font></center>\n"
	."<img src=\"themes/Xelopolis_Iceblue/images/pixel.gif\" border=\"0\" height=\"1\">"
	."</td></tr></table>\n"
	."</td></tr><tr><td background=\"themes/Xelopolis_Iceblue/images/header_news_down.gif\" width=\"100%\" height=\"4\"></tr>"
	."<tr><td bgcolor=\"#FFFFFF\"><img src=\"themes/Xelopolis_Iceblue/images/pixel.gif\" width=\"100%\" height=\"4\"></td></tr></table>\n";
}

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext) {
    global $admin, $sid, $tipath;
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"><tr><td>\n"
	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\"><tr><td bgcolor=\"#FFFFFF\">\n"
	."<table border=\"0\" cellpadding=\"4\" cellspacing=\"0\" width=\"100%\">"
	."<tr><td background=\"themes/Xelopolis_Iceblue/images/header_news_article.gif\" width=\"100%\" height=\"10\"><font class=\"option\"><b><center>$title</center></b></font></td></tr>\n"
	."<tr><td colspan=\"2\" bgcolor=\"#FFFFFF\"><br>\n"
	."<table border=\"0\" width=\"98%\" bgcolor=\"#FFFFFF\" align=\"center\"><tr><td>\n"
	."<a href=\"modules.php?name=News&new_topic=$topic\"><img src=\"$tipath$topicimage\" alt=\"$topictext\" border=\"0\" align=\"right\"></a>";
    FormatStory($thetext, $notes="", $aid, $informant);
    echo "</td></tr></table>\n"
	."</td></tr></table><br>\n"
	."</td></tr>\n"
	."</table></td></tr>\n"
	."<tr><td background=\"themes/Xelopolis_Iceblue/images/header_news_down_article.gif\" width=\"100%\" height=\"15\"></tr>"
	."<tr><td><br><div align=\"center\"><a href=\"http://www.xelopolis.com\" target=\"_blank\"><img src=\"http://www.xelopolis.com/banniere.gif\" alt=\"Xelopolis.com\" width=\"468\" height=\"60\" border=\"0\"></a></div></td></tr>\n"//banner in articoli
	."<tr><td bgcolor=\"#FFFFFF\"><img src=\"themes/Xelopolis_Iceblue/images/pixel.gif\" width=\"100%\" height=\"4\"></td></tr></table>\n";
}

function themesidebox($title, $content) {
    echo "<table border=\"0\" align=\"center\" width=\"150\" cellpadding=\"0\" cellspacing=\"0\">"
	."<tr><td background=\"themes/Xelopolis_Iceblue/images/header.gif\" width=\"150\" height=\"25\">"
	."&nbsp;<font color=\"#000000\"><b>$title</b></font>"
	."</td></tr><tr><td><img src=\"themes/Xelopolis_Iceblue/images/pixel.gif\" width=\"100%\" height=\"1\"></td></tr></table>\n"
	."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"150\">\n"
	."<tr><td width=\"150\" bgcolor=\"#FFFFFF\">\n"
	."<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" width=\"150\">\n"
	."<tr><td background=\"themes/Xelopolis_Iceblue/images/back1.gif\" width=\"150\" bgcolor=\"#FFFFFF\">\n"
	."$content"
	."</td></tr></table></td></tr><td background=\"themes/Xelopolis_Iceblue/images/header_down.gif\" width=\"150\" height=\"4\"></td><tr><td><img src=\"themes/Xelopolis_Iceblue/images/pixel.gif\" width=\"150\" height=\"4\"></td></tr></table>";
}

?>
