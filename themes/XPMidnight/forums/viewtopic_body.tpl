<br>
<table width="95%" cellspacing="2" cellpadding="2" border="0">
  <tr>
	<td align="left" valign="bottom"><span class="nav"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" align="middle" /></a>&nbsp;&nbsp;&nbsp;<a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" align="middle" /></a></span></td>
  </tr>
</table>
<br>
<span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a> 
-> <a class="nav" href="{U_VIEW_TOPIC}">{TOPIC_TITLE}</a></span><br>
<br>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr> 
    <td align="left" width="26"><img src="themes/XPMidnight/forums/images/up-left18.gif" alt="" border="0" width="26" height="30"></td>
    <td background="themes/XPMidnight/forums/images/up2.gif" width="140" nowrap>
      <div align="left"><span class="topframe"> &nbsp;{L_AUTHOR}</span></div>
    </td>
    <td background="themes/XPMidnight/forums/images/up2.gif"><span class="topframe">{L_MESSAGE}</span></td>
    <td background="themes/XPMidnight/forums/images/up2.gif" nowrap align="right"><span class="nav"><a href="{U_VIEW_OLDER_TOPIC}" class="nav">{L_VIEW_PREVIOUS_TOPIC}</a> 
      :: <a href="{U_VIEW_NEWER_TOPIC}" class="nav">{L_VIEW_NEXT_TOPIC}</a> &nbsp;</span></td>
    <td><img src="themes/XPMidnight/forums/images/up-right2.gif" alt="" border="0"></td>
  </tr>
  <tr> 
    <td background="themes/XPMidnight/forums/images/left2.gif" width="26"> 
    <td colspan="2" valign="bottom"> 
      <div align="right">{POLL_DISPLAY}</div>
    </td>
    <td> 
      <div align="center"></div>
    </td>
    <td background="themes/XPMidnight/forums/images/right2.gif"> 
  </tr>
  <tr> 
    <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif">&nbsp;</td>
    <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/middle-down.gif" valign="top" height="15" colspan="3">&nbsp;</td>
    <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/right2.gif">&nbsp;</td>
  </tr>
  <!-- BEGIN postrow -->
  <tr> 
    <td background="themes/XPMidnight/forums/images/left2.gif" width="26">&nbsp;</td>
    <td align="left" valign="top" width="150"><span class="name"><a name="{postrow.U_POST_ID}">&nbsp;</a><b>{postrow.POSTER_NAME}</b></span><br />
      <span class="postdetails">&nbsp;{postrow.POSTER_RANK}<br />
      &nbsp;{postrow.RANK_IMAGE}{postrow.POSTER_AVATAR}<br />
      <br />
      &nbsp;{postrow.POSTER_JOINED}<br />
      &nbsp;{postrow.POSTER_POSTS}<br />
      &nbsp;{postrow.POSTER_FROM}</span><br />
    </td>
    <td  valign="top" colspan="2"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td valign="top" width="100%"><a href="{postrow.U_MINI_POST}"><img src="{postrow.MINI_POST_IMG}" width="12" height="9" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" border="0" /></a><span class="postdetails">{L_POSTED}: 
            {postrow.POST_DATE}<span class="gen">&nbsp;</span>&nbsp;<br>
            &nbsp;{L_POST_SUBJECT}: {postrow.POST_SUBJECT}</span></td>
          <td valign="top" align="right" nowrap>{postrow.QUOTE_IMG} {postrow.EDIT_IMG} 
            {postrow.DELETE_IMG} {postrow.IP_IMG}</td>
        </tr>
        <tr valign="top"> 
          <td colspan="2" height="5">
            <hr width="95%" align="left">
          </td>
        </tr>
        <tr valign="middle"> 
          <td colspan="2"><span class="postbody">{postrow.MESSAGE}{postrow.SIGNATURE}</span><span class="gensmall">{postrow.EDITED_MESSAGE}</span></td>
        </tr>
        <tr valign="bottom"> 
          <td colspan="2"> 
            <div align="left"></div>
            
          </td>
        </tr>
      </table>
    </td>
    <td  background="themes/XPMidnight/forums/images/right2.gif">&nbsp;</td>
  </tr>
  <tr> 
    <td  background="themes/XPMidnight/forums/images/left2.gif">&nbsp;</td>
    <td  align="left" valign="middle">&nbsp;</td>
    <td  valign="bottom" nowrap>
      <table cellspacing="0" cellpadding="0" border="0" height="18" width="18">
        <tr> 
          <td valign="middle" nowrap>{postrow.PROFILE_IMG} {postrow.PM_IMG} {postrow.EMAIL_IMG} 
            {postrow.WWW_IMG} {postrow.AIM_IMG} {postrow.YIM_IMG} {postrow.MSN_IMG}
            <script language="JavaScript" type="text/javascript"><!-- 

	if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 )
		document.write(' {postrow.ICQ_IMG}');
	else
		document.write('</td><td>&nbsp;</td><td valign="top" nowrap="nowrap"><div style="position:relative"><div style="position:absolute">{postrow.ICQ_IMG}</div><div style="position:absolute;left:3px;top:-1px">{postrow.ICQ_STATUS_IMG}</div></div>');
				
				//--></script>
            <noscript>{postrow.ICQ_IMG}</noscript></td>
        </tr>
      </table>
    </td>
    <td >&nbsp;</td>
    <td  background="themes/XPMidnight/forums/images/right2.gif">&nbsp;</td>
  </tr>
  <tr> 
    <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif">&nbsp;</td>
    <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/middle-down.gif" valign="bottom" colspan="3">&nbsp;</td>
    <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/right2.gif">&nbsp;</td>
  </tr>
  <!-- END postrow -->
  <tr> 
    <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif" align="center">&nbsp;</td>
    <td bgcolor="#E1E7ED" colspan="2" align="left" valign="middle"><span class="nav"><a href="#top" class="nav">{L_BACK_TO_TOP}</a></span></td>
    <td bgcolor="#E1E7ED" align="center"> 
      <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr> 
          <form method="post" action="{S_POST_DAYS_ACTION}">
            <td align="center"><span class="gensmall">{L_DISPLAY_POSTS}: {S_SELECT_POST_DAYS}&nbsp;{S_SELECT_POST_ORDER}&nbsp; 
              <input type="submit" value="{L_GO}" class="liteoption" name="submit" />
              </span></td>
          </form>
        </tr>
      </table>
    </td>
    <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/right2.gif" align="center">&nbsp;</td>
  </tr>
  <tr> 
    <td bgcolor="#E1E7ED" height="15" background="themes/XPMidnight/forums/images/down2.gif"><img src="themes/XPMidnight/forums/images/down-left2.gif" alt="" border="0"></td>
    <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/down2.gif" align="center" colspan="3">&nbsp;</td>
    <td bgcolor="#E1E7ED"><img src="themes/XPMidnight/forums/images/down-right2.gif" alt="" border="0"></td>
  </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
	<td align="left" valign="middle">
	<br><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a> 
-> <a class="nav" href="{U_VIEW_TOPIC}">{TOPIC_TITLE}</a></span><br><br>
	<span class="nav"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" align="middle" /></a>
	&nbsp;&nbsp;&nbsp;<a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" align="middle" /></a></span>
	</td>
	<td align="right" valign="top"><span class="gensmall">{S_TIMEZONE}</span><br />
      <span class="nav">{PAGINATION}</span>
	  </td>
  </tr>
  <tr>
	<td align="left" colspan="3"><span class="nav">{PAGE_NUMBER}</span></td>
  </tr>
</table>

<table width="100%" cellspacing="2" border="0">
  <tr>
	<td width="40%" valign="top" align="left"><span class="gensmall">{S_WATCH_TOPIC}</span><br />
      &nbsp;<br />
	  {S_TOPIC_ADMIN}</td>
	<td align="right" valign="top">{JUMPBOX}<span class="gensmall">{S_AUTH_LIST}</span></td>
  </tr>
</table>
