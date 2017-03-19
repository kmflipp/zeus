<?php

if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$userpage = 1;
if(isset($_GET['redirect'])) $redirect = substr($_SERVER['QUERY_STRING'], strpos($_SERVER['QUERY_STRING'], "redirect=") + strlen("redirect="), strlen($_SERVER['QUERY_STRING']));


if (!isset($hid)) { $hid = ""; }
if (!isset($url)) { $url = ""; }
if (!isset($bypass)) { $bypass = ""; }

switch($op) {

	case "logout":
	logout();
	break;

	case "userinfo":
	userinfo($username, $bypass, $hid, $url);
	break;

	case "login":
	login($username, $user_password, $redirect, $mode, $f, $t, $random_num, $gfx_check);
	break;
	
	default:
	main($user);
	break;
}


function userinfo($username, $bypass=0, $hid=0, $url=0) {
	global $articlecomm, $user, $cookie, $sitename, $prefix, $user_prefix, $db, $admin, $broadcast_msg, $my_headlines, $module_name, $subscription_url, $admin_file;
	$username = filter($username, "nohtml", 1);
	$username = substr("$username", 0,25);
	$sql = "SELECT * FROM ".$prefix."_bbconfig";
	$result = $db->sql_query($sql);
	while ( $row = $db->sql_fetchrow($result) )
	{
		$board_config[$row['config_name']] = $row['config_value'];
	}
	$sql2 = "SELECT * FROM ".$user_prefix."_users WHERE username='$username'";
	$result2 = $db->sql_query($sql2);
	$num = $db->sql_numrows($result2);
	if ($num != 1) {
		Header("Location: modules.php?name=$module_name");
		die();
	}
	$userinfo = $db->sql_fetchrow($result2);
	if(!$bypass) cookiedecode($user);

	include("header.php");

	title("Welcome on ZEUS, <i>".$userinfo[name]."</i>");
	
	OpenTable();
	echo "<center><table>";
	echo "<tr>";
		echo "<td align=center valign=middle><a href=gestionale.php?name=clienti>
		<div class=image style=background-image:url('images/clienti.png');width:256px;height:256px;position:inline-block;>
			<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Customer</div>
		</div></a>
		</td>";
		echo "<td align=center valign=middle><a href=gestionale.php?name=lloyds>
		<div class=image style=background-image:url('images/lloyds.png');width:256px;height:256px;position:inline-block;>
			<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>LLoyd'S</div>
		</div></a>
		</td>";
		echo "<td align=center valign=middle><a href=gestionale.php?name=kiln>
		<div class=image style=background-image:url('images/proposte.png');width:256px;height:256px;position:inline-block;>
			<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Kiln</font></div>
		</div></a>
		</td>";
	echo "</tr>";
	echo "</table></center>";				
	echo "<center><table>";				
	echo "<tr>";
		echo "<td align=center valign=middle><a href=gestionale.php?name=vita>
		<div class=image style=background-image:url('images/vita.png');width:256px;height:256px;position:inline-block;>
			<div class=title style=position: static; bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Life</div>
		</div></a>
		</td>";
		echo "<td align=center valign=middle><a href=gestionale.php?name=ramigenerali>
		<div class=image style=background-image:url('images/ramigenerali.png');width:256px;height:256px;position:inline-block;>
			<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>General Branch</div>
		</div></a>
		</td>";
		echo "<td align=center valign=middle><a href=gestionale.php?name=parametri>
		<div class=image style=background-image:url('images/parametri.png');width:256px;height:256px;position:inline-block;>
			<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Parameters</div>
		</div></a>
		</td>";
		echo "<td align=center valign=middle><a href=modules.php?name=Your_Account&op=logout>
		<div class=image style=background-image:url('images/logout.png');width:256px;height:256px;position:inline-block;>
			<div class=title style=position: static;bottom: 0px;width: 100%;overflow: none;><font style=color:white;font-size:15px;>Exit</div>
		</div></a>
		</td>";
	echo "</tr>";
	echo "</table></center>";
	CloseTable();
	$pippo='1';
	include("footer.php");
}

function main($user) {
	global $stop, $module_name, $redirect, $mode, $t, $f, $gfx_chk;
	if(!is_user($user)) {
		include("header.php");
		if ($stop) {
			OpenTable();
			echo "<center><font class=\"title\"><b>ZEUS: Incorrect Login</b></font></center>\n";
			CloseTable();
		} else {
			OpenTable();
			echo "<center><font class=\"title\"><b>ZEUS: User Login</b></font></center>\n";
			CloseTable();
		}
		if (!is_user($user)) {
			OpenTable();
			mt_srand ((double)microtime()*1000000);
			$maxran = 1000000;
			$random_num = mt_rand(0, $maxran);
			echo "<form action=\"modules.php?name=$module_name\" method=\"post\">\n"
			."<p align=center>
					<table border=0 width=80%>
						<tr><td align=center><font face=verdana style=font-size:16px;color:darkgreen><strong>Enter information<br>to access the system</font></td></tr>
						<tr><td width=100% align=center><img src=images/users.png></td></tr>
					</table>
				</p>"
			."<p align=center><table width=40% border=1 cellspacing=0 cellpadding=4 bordercolor=darkgreen><tr><td align=center>\n"
			."<font face=verdana style=font-size:16px;color:darkgreen>Username:&nbsp;&nbsp;<input type=\"text\" name=\"username\" size=\"15\" maxlength=\"25\">\n"
			."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password:&nbsp;&nbsp;<input type=\"password\" name=\"user_password\" size=\"15\" maxlength=\"20\">\n";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"hidden\" name=\"redirect\" value=\"$redirect\">\n"
			."<input type=\"hidden\" name=\"mode\" value=$mode>\n"
			."<input type=\"hidden\" name=\"f\" value=$f>\n"
			."<input type=\"hidden\" name=\"t\" value=$t>\n"
			."<input type=\"hidden\" name=\"op\" value=\"login\">\n";
			echo "<br><br><center><img src=images/captcha.jpg><br><input type=text name=captcha>";
			if ($_GET[error]=='captcha') echo "<br><font style=color:red;font-size:12px;>Error captcha code, please write what in above image.</font>";
			echo "<br><br>";
			echo "<input type=\"submit\" value=Login></td></tr></table></p></form>\n\n";
			CloseTable();
		}
		include("footer.php");
	} elseif (is_user($user)) {
		global $cookie;
		cookiedecode($user);
		userinfo($cookie[1]);
	}
}

function logout() {
	global $prefix, $db, $user, $cookie, $redirect;
	cookiedecode($user);
	$r_uid = $cookie[0];
	$r_username = $cookie[1];
	setcookie("user", false);
	$db->sql_query("DELETE FROM ".$prefix."_session WHERE uname='$r_username'");
	$db->sql_query("DELETE FROM ".$prefix."_bbsessions WHERE session_user_id='$r_uid'");
	$user = "";
	include("header.php");
	OpenTable();
	if (!empty($redirect)) {
		echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=modules.php?name=$redirect\">";
	} else {
		echo "<META HTTP-EQUIV=\"refresh\" content=\"3;URL=index.php\">";
	}
	echo "<center><font class=\"option\"><b>You are logged out</b></font></center>";
	CloseTable();
	include("footer.php");
}


function docookie($setuid, $setusername, $setpass, $setstorynum, $setumode, $setuorder, $setthold, $setnoscore, $setublockon, $settheme, $setcommentmax) {
	$info = base64_encode("$setuid:$setusername:$setpass:$setstorynum:$setumode:$setuorder:$setthold:$setnoscore:$setublockon:$settheme:$setcommentmax");
	setcookie("user","$info",time()+2592000);
}

function login($username, $user_password, $redirect, $mode, $f, $t, $random_num, $gfx_check) {
	global $setinfo, $user_prefix, $db, $module_name, $pm_login, $prefix;
	$user_password = htmlspecialchars(stripslashes($user_password));
	include("config.php");
	if ($_POST[captcha]!='xmqki') {
		header("Location: index.php?error=captcha");
		die();
	}
	$sql = "SELECT user_password, user_id, storynum, umode, uorder, thold, noscore, ublockon, theme, commentmax FROM ".$user_prefix."_users WHERE username='$username'";
	$result = $db->sql_query($sql);
	$setinfo = $db->sql_fetchrow($result);
	$forward = ereg_replace("redirect=", "", "$redirect");
	if (ereg("privmsg", $forward)) {
		$pm_login = "active";
	}
	if (($db->sql_numrows($result)==1) AND ($setinfo['user_id'] != 1) AND (!empty($setinfo['user_password']))) {
		$dbpass=$setinfo['user_password'];
		$non_crypt_pass = $user_password;
		$old_crypt_pass = crypt($user_password,substr($dbpass,0,2));
		$new_pass = md5($user_password);
		if (($dbpass == $non_crypt_pass) OR ($dbpass == $old_crypt_pass)) {
			$db->sql_query("UPDATE ".$user_prefix."_users SET user_password='$new_pass' WHERE username='$username'");
			$sql = "SELECT user_password FROM ".$user_prefix."_users WHERE username='$username'";
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$dbpass = $row['user_password'];
		}
		if ($dbpass != $new_pass) {
			Header("Location: modules.php?name=$module_name&stop=1");
			return;
		}
		$datekey = date("F j");
		$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $random_num . $datekey));
		$code = substr($rcode, 2, 6);
		if (extension_loaded("gd") AND $code != $gfx_check AND ($gfx_chk == 2 OR $gfx_chk == 4 OR $gfx_chk == 5 OR $gfx_chk == 7)) {
			Header("Location: modules.php?name=$module_name&stop=1");
			die();
		} else {
			docookie($setinfo['user_id'], $username, $new_pass, $setinfo['storynum'], $setinfo['umode'], $setinfo['uorder'], $setinfo['thold'], $setinfo['noscore'], $setinfo['ublockon'], $setinfo['theme'], $setinfo['commentmax']);
			$uname = $_SERVER['REMOTE_ADDR'];
			$db->sql_query("DELETE FROM ".$prefix."_session WHERE uname='$uname' AND guest='1'");
			$db->sql_query("UPDATE ".$prefix."_users SET last_ip='$uname' WHERE username='$username'");
		}
		if (!empty($pm_login)) {
			Header("Location: modules.php?name=Private_Messages&file=index&folder=inbox");
			exit;
		}
		if (empty($redirect)) {
			Header("Location: modules.php?name=Your_Account&op=userinfo&bypass=1&username=$username");
		} else if (empty($mode)) {
			Header("Location: modules.php?name=Forums&file=$forward");
		} else if (!empty($t)) {
			Header("Location: modules.php?name=Forums&file=$forward&mode=$mode&t=$t");
		} else {
			Header("Location: modules.php?name=Forums&file=$forward&mode=$mode&f=$f");
		}
	} else {
		Header("Location: modules.php?name=$module_name&stop=1");
	}
}

?>