
<form method="post" action="{S_SPLIT_ACTION}">
  <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr>
	  <td align="left" class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a><span class="nav">
		-> <a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a></span></td>
	</tr>
  </table>
  <table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td bgcolor="#E1E7ED" width="15" height="25"><img src="themes/XPMidnight/forums/images/up-left2.gif" alt="" border="0"></td>
		<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" height="25" colspan="3"><span class="topframe">&nbsp;{L_SPLIT_TOPIC}&nbsp;</span></td>
		
      <td bgcolor="#E1E7ED"><img src="themes/XPMidnight/forums/images/up-right2.gif" alt="" border="0"></td>
	</tr>
	<tr>
	  <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif" width="15">&nbsp;</td>
	  <td bgcolor="#E1E7ED" colspan="3" align="center"><span class="gensmall">{L_SPLIT_TOPIC_EXPLAIN}</span></td>
	  <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/right2.gif" width="15">&nbsp;</td>
	</tr>
	<tr>
	  <td bgcolor="#C9D3DE" background="themes/XPMidnight/forums/images/left2.gif" width="15">&nbsp;</td>
	  <td bgcolor="#C9D3DE" align="right" nowrap><span class="gen">{L_SPLIT_SUBJECT}</span></td>
	  <td bgcolor="#C9D3DE" align="left"><span class="courier">
		<input type="text" size="35" style="width: 350px" maxlength="100" name="subject" class="post" />
		</span></td>
	  <td bgcolor="#C9D3DE">&nbsp;</td>
	  <td bgcolor="#C9D3DE" background="themes/XPMidnight/forums/images/right2.gif" width="15">&nbsp;</td>
	</tr>
	<tr>
	  <td bgcolor="#C9D3DE" background="themes/XPMidnight/forums/images/left2.gif" width="15">&nbsp;</td>
	  <td bgcolor="#C9D3DE" align="right" nowrap><span class="gen">{L_SPLIT_FORUM}</span></td>
	  <td bgcolor="#C9D3DE" align="left"><span class="courier">{S_FORUM_SELECT}</span></td>
	  <td bgcolor="#C9D3DE">&nbsp;</td>
	  <td bgcolor="#C9D3DE" background="themes/XPMidnight/forums/images/right2.gif" width="15">&nbsp;</td>
	</tr>
	<tr>
	  <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif" width="15">&nbsp;</td>
	  <td bgcolor="#E1E7ED" colspan="3" height="28">
		<table width="60%" cellspacing="0" cellpadding="0" border="0" align="center">
		  <tr>
			<td width="50%" align="center">
			  <input class="liteoption" type="submit" name="split_type_all" value="{L_SPLIT_POSTS}" />
			</td>
			<td width="50%" align="center">
			  <input class="liteoption" type="submit" name="split_type_beyond" value="{L_SPLIT_AFTER}" />
			</td>
		  </tr>
		</table>
	  </td>
	  <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/right2.gif" width="15">&nbsp;</td>
	</tr>
    <tr>
      <td bgcolor="#E1E7ED" width="15" height="15" background="themes/XPMidnight/forums/images/down2.gif"><img src="themes/XPMidnight/forums/images/down-left2.gif" alt="" border="0"></td>
	  <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/down2.gif" align="center" height="15" colspan="3">&nbsp;</td>
	  <td bgcolor="#E1E7ED" width="15" height="15"><img src="themes/XPMidnight/forums/images/down-right2.gif" alt="" border="0"></td>
    </tr>
	<tr height="10">
	  <td colspan="5"></td>
	</tr>
	<tr>
		<td bgcolor="#E1E7ED" width="15" height="25"><img src="themes/XPMidnight/forums/images/up-left2.gif" alt="" border="0"></td>
		<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" height="25"><span class="topframe">&nbsp;{L_AUTHOR}&nbsp;</span></td>
		<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" height="25"><span class="topframe">&nbsp;{L_MESSAGE}&nbsp;</span></td>
		<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" height="25"><span class="topframe">&nbsp;{L_SELECT}&nbsp;</span></td>
		
      <td bgcolor="#E1E7ED"><img src="themes/XPMidnight/forums/images/up-right2.gif" alt="" border="0"></td>
	</tr>
	<!-- BEGIN postrow -->
	<tr>
	  <td class="{postrow.ROW_CLASS}" background="themes/XPMidnight/forums/images/left2.gif" width="15">&nbsp;</td>
	  <td align="left" valign="top" class="{postrow.ROW_CLASS}"><span class="name"><a name="{postrow.U_POST_ID}"></a>{postrow.POSTER_NAME}</span></td>
	  <td width="100%" valign="top" class="{postrow.ROW_CLASS}">
		<table width="100%" cellspacing="0" cellpadding="3" border="0">
		  <tr>
			<td valign="middle"><img src="themes/XPMidnight/forums/images/icon_minipost.gif" alt="{L_POST}"><span class="postdetails">{L_POSTED}:
			  {postrow.POST_DATE}&nbsp;&nbsp;&nbsp;&nbsp;{L_POST_SUBJECT}: {postrow.POST_SUBJECT}</span></td>
		  </tr>
		  <tr>
			<td valign="top">
			  <hr size="1" />
			  <span class="postbody">{postrow.MESSAGE}</span></td>
		  </tr>
		</table>
	  </td>
	  <td width="5%" align="center" class="{postrow.ROW_CLASS}">{postrow.S_SPLIT_CHECKBOX}</td>
	  <td class="{postrow.ROW_CLASS}" background="themes/XPMidnight/forums/images/right2.gif" width="15">&nbsp;</td>
	</tr>
	<tr height="1">
	  <td bgcolor="#19254D" background="themes/XPMidnight/forums/images/left2.gif" width="15"></td>
	  <td colspan="3" bgcolor="#19254D"></td>
	  <td bgcolor="#19254D" background="themes/XPMidnight/forums/images/right2.gif" width="15"></td>
	</tr>
	<!-- END postrow -->
	<tr>
	  <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif" width="15">&nbsp;</td>
	  <td bgcolor="#E1E7ED" colspan="3" height="28">
		<table width="60%" cellspacing="0" cellpadding="0" border="0" align="center">
		  <tr>
			<td width="50%" align="center">
			  <input class="liteoption" type="submit" name="split_type_all" value="{L_SPLIT_POSTS}" />
			</td>
			<td width="50%" align="center">
			  <input class="liteoption" type="submit" name="split_type_beyond" value="{L_SPLIT_AFTER}" />
			  {S_HIDDEN_FIELDS} </td>
		  </tr>
		</table>
	  </td>
	  <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/right2.gif" width="15">&nbsp;</td>
	</tr>
    <tr>
      <td bgcolor="#E1E7ED" width="15" height="15" background="themes/XPMidnight/forums/images/down2.gif"><img src="themes/XPMidnight/forums/images/down-left2.gif" alt="" border="0"></td>
	  <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/down2.gif" align="center" height="15" colspan="3">&nbsp;</td>
	  <td bgcolor="#E1E7ED" width="15" height="15"><img src="themes/XPMidnight/forums/images/down-right2.gif" alt="" border="0"></td>
    </tr>
  </table>


  <table width="95%" cellspacing="2" border="0" align="center" cellpadding="2">
    <tr>
	  <td align="right" valign="top"><span class="gensmall">{S_TIMEZONE}</span></td>
	</tr>
  </table>
</form>
