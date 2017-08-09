<table width="100%" cellspacing="0" cellpadding="2" border="0" align="center">
  <tr>
	<td align="left" valign="bottom">
	<!-- BEGIN switch_user_logged_in -->
	{LAST_VISIT_DATE}<br />
      <!-- END switch_user_logged_in -->
      {CURRENT_TIME}<br>
      <span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span> </td>
	<td align="right" valign="bottom" class="gensmall">
	<!-- BEGIN switch_user_logged_in -->
	<a href="{U_SEARCH_NEW}" class="gensmall">{L_SEARCH_NEW}</a><br /><a href="{U_SEARCH_SELF}" class="gensmall">{L_SEARCH_SELF}</a><br />
	<!-- END switch_user_logged_in -->
	<a href="{U_SEARCH_UNANSWERED}" class="gensmall">{L_SEARCH_UNANSWERED}</a></td>
  </tr>
</table>

<br>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr> 
    <td class="row1" width="15" height="25"><img src="themes/XPMidnight/forums/images/up-left2.gif" alt="" border="0"></td>
    <td class="row1" background="themes/XPMidnight/forums/images/up2.gif" colspan="2" nowrap><span class="topframe">&nbsp;{L_FORUM}&nbsp;</span> 
    <td class="row2" background="themes/XPMidnight/forums/images/up2.gif" width="50" nowrap> 
      <div align="center"><span class="topframe">&nbsp;{L_TOPICS}&nbsp;</span> 
      </div>
    <td class="row1" background="themes/XPMidnight/forums/images/up2.gif" width="50" nowrap> 
      <div align="center"><span class="topframe">&nbsp;{L_POSTS}&nbsp;</span> 
      </div>
    <td class="row2" background="themes/XPMidnight/forums/images/up2.gif" nowrap> 
      <div align="center"><span class="topframe">&nbsp;{L_LASTPOST}&nbsp;</span> 
      </div>
    <td class="row2"><img src="themes/XPMidnight/forums/images/up-right2.gif" alt="" border="0"></td>
  </tr>
  <!-- BEGIN catrow -->
  <tr>
  <td width="15" background="themes/XPMidnight/forums/images/topnav-bg.gif"><img src="themes/XPMidnight/forums/images/left4.gif" width="26" height="25"></td>
  <td colspan="5" background="themes/XPMidnight/forums/images/topnav-bg.gif"><a href="{catrow.U_VIEWCAT}" class="cattitle">{catrow.CAT_DESC}</a></td>
  <td background="themes/XPMidnight/forums/images/topnav-bg.gif" width="15"><img src="themes/XPMidnight/forums/images/right4.gif" alt="" border="0" width="6" height="25"></td>
  </tr>
  <!-- BEGIN forumrow -->
  <tr> 
    <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif" width="15">&nbsp;</td>
    <td bgcolor="#E1E7ED" align="left" valign="middle" height="50"><img src="{catrow.forumrow.FORUM_FOLDER_IMG}" alt="{catrow.forumrow.L_FORUM_FOLDER_ALT}" title="{catrow.forumrow.L_FORUM_FOLDER_ALT}" /></td>
    <td bgcolor="#E1E7ED" valign="middle" width="100%" height="50"> 
      <a href="{catrow.forumrow.U_VIEWFORUM}"> </a>&nbsp;&nbsp;&nbsp;<a href="{catrow.forumrow.U_VIEWFORUM}">{catrow.forumrow.FORUM_NAME}</a><br />
      <span class="genmed">&nbsp;&nbsp;&nbsp;&nbsp;{catrow.forumrow.FORUM_DESC}<br />
      </span> <span class="gensmall">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{catrow.forumrow.L_MODERATOR}</span> 
      {catrow.forumrow.MODERATORS}</td>
    <td bgcolor="#C9D3DE" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.TOPICS}</span></td>
    <td bgcolor="#E1E7ED" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.POSTS}</span></td>
    <td bgcolor="#C9D3DE" align="center" valign="middle" height="50" nowrap> <span class="gensmall">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{catrow.forumrow.LAST_POST}</span></td>
    <td bgcolor="#C9D3DE" background="themes/XPMidnight/forums/images/right2.gif" width="15">&nbsp;</td>
  </tr>
  <!-- END forumrow -->
  <!-- END catrow -->
  <tr> 
    <td background="themes/XPMidnight/forums/images/up2.gif" width="15"></td>
    <td class="whonline" colspan="5" background="themes/XPMidnight/forums/images/up2.gif"><span class="whonline"><a href="{U_VIEWONLINE}" class="whonline">{L_WHO_IS_ONLINE}</a></span></td>
    <td background="themes/XPMidnight/forums/images/up2.gif" width="15"><img src="themes/XPMidnight/forums/images/right4.gif" alt="" border="0" width="6" height="30"></td>
  </tr>
  <tr> 
    <td background="themes/XPMidnight/forums/images/left2.gif" width="15">&nbsp;</td>
    <td align="center" valign="middle" rowspan="2"><img src="themes/XPMidnight/forums/images/whosonline.gif" alt="{L_WHO_IS_ONLINE}" /></td>
    <td align="left" width="100%" colspan="4"><span class="gensmall">&nbsp; {TOTAL_POSTS}<br />

      &nbsp; {NEWEST_USER}</span></td>
    <td background="themes/XPMidnight/forums/images/right2.gif" width="15">&nbsp;</td>
  </tr>
  <tr> 
    <td background="themes/XPMidnight/forums/images/left2.gif" width="15">&nbsp;</td>
    <td align="left" colspan="4"><span class="gensmall">&nbsp; {TOTAL_USERS_ONLINE} 
      &nbsp; [ {L_WHOSONLINE_ADMIN} ] &nbsp; [ {L_WHOSONLINE_MOD} ]<br />
      &nbsp; {RECORD_USERS}<br />
      &nbsp; {LOGGED_IN_USER_LIST}</span></td>
    <td background="themes/XPMidnight/forums/images/right2.gif" width="15">&nbsp;</td>
  </tr>
  <tr> 
    <td width="15" height="15" background="themes/XPMidnight/forums/images/down2.gif"><img src="themes/XPMidnight/forums/images/down-left2.gif" alt="" border="0"></td>
    <td background="themes/XPMidnight/forums/images/down2.gif" align="center" height="15" colspan="5">&nbsp;</td>
    <td><img src="themes/XPMidnight/forums/images/down-right2.gif" alt="" border="0"></td>
  </tr>
</table>

<table width="100%" cellpadding="1" cellspacing="1" border="0">
	<td align="left" valign="top">{L_ONLINE_EXPLAIN}</td>
</table>

<br clear="all" />

    <table border="0" cellspacing="0" cellpadding="0" width="100%">
    <tr><td bgcolor="#E1E7ED" width="15" height="25"><img src="themes/XPMidnight/forums/images/up-left2.gif" alt="" border="0"></td>
    <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" width="100%" height="25">&nbsp;</td>
    <td bgcolor="#E1E7ED"><img src="themes/XPMidnight/forums/images/up-right2.gif" alt="" border="0"></td>
  </tr>
    <tr><td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif" width="15">&nbsp;</td><td bgcolor="#E1E7ED" align="center" width="100%">
     <table>
       <tr>
        <td><a href="{U_MARK_READ}" class="gensmall">{L_MARK_FORUMS_READ}</a></td>
        <td width="100">&nbsp;</td>
	<td width="20" align="center"><img src="themes/XPMidnight/forums/images/folder_new.gif" alt="{L_NEW_POSTS}"/></td>
	<td>{L_NEW_POSTS}</td>
	<td>&nbsp;&nbsp;</td>
	<td width="20" align="center"><img src="themes/XPMidnight/forums/images/folder.gif" alt="{L_NO_NEW_POSTS}" /></td>
	<td>{L_NO_NEW_POSTS}</td>
	<td>&nbsp;&nbsp;</td>
	<td width="20" align="center"><img src="themes/XPMidnight/forums/images/folder_lock.gif" alt="{L_FORUM_LOCKED}" /></td>
	<td>{L_FORUM_LOCKED}</td>
	<td width="100">&nbsp;</td>
	<td>{S_TIMEZONE}</td>
       </tr>
      </table>
    </td><td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/right2.gif">&nbsp;</td></tr>
    <tr>
    <td bgcolor="#E1E7ED" width="15" height="15" background="themes/XPMidnight/forums/images/down2.gif"><img src="themes/XPMidnight/forums/images/down-left2.gif" alt="" border="0"></td>
    <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/down2.gif" align="center" height="15">&nbsp;</td>
    <td bgcolor="#E1E7ED"><img src="themes/XPMidnight/forums/images/down-right2.gif" alt="" border="0"></td>
  </tr></table>