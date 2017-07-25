
<form action="{S_SEARCH_ACTION}" method="POST">
  <table width="95%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr>
		<td align="left"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
	</tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		
      <td bgcolor="#E1E7ED" width="26" height="25"><img src="themes/XPMidnight/forums/images/up-left4.gif" alt="" border="0" width="26" height="30"></td>
		
      <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" height="25" width="100%"><span class="topframe">{L_SEARCH_QUERY}</span></td>
		
      <td bgcolor="#E1E7ED" width="10"><img src="themes/XPMidnight/forums/images/up-right2.gif" alt="" border="0"></td>
	</tr>
	<tr>
		
      <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif" width="26">&nbsp;</td>
		
      <td width="960"> 
        <table width="100%" cellpadding="4" cellspacing="1" border="0" bgcolor="{T_TR_COLOR3}">
				<tr>
					<td bgcolor="#E1E7ED" colspan="2" width="50%"><span class="gen">{L_SEARCH_KEYWORDS}:</span><br /><span class="gensmall">{L_SEARCH_KEYWORDS_EXPLAIN}</span></td>
					<td bgcolor="#C9D3DE" colspan="2" valign="top"><span class="genmed"><input type="text" style="width: 300px" class="post" name="search_keywords" size="30" /><br /><input type="radio" name="search_terms" value="any" checked /> {L_SEARCH_ANY_TERMS}<br /><input type="radio" name="search_terms" value="all" /> {L_SEARCH_ALL_TERMS}</span></td>
				</tr>
				<tr>
					<td bgcolor="#E1E7ED" colspan="2"><span class="gen">{L_SEARCH_AUTHOR}:</span><br /><span class="gensmall">{L_SEARCH_AUTHOR_EXPLAIN}</span></td>
					<td bgcolor="#C9D3DE" colspan="2" valign="middle"><span class="genmed"><input type="text" style="width: 300px" class="post" name="search_author" size="30" /></span></td>
				</tr>
			</table>
		</td>
		
      <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/right2.gif" width="10">&nbsp;</td>
	</tr>
	<tr>
		
      <td bgcolor="#E1E7ED" width="26" height="15" background="themes/XPMidnight/forums/images/down2.gif"><img src="themes/XPMidnight/forums/images/down-left2.gif" alt="" border="0"></td>
		
      <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/down2.gif" align="center" height="15" width="960">&nbsp;</td>
		
      <td bgcolor="#E1E7ED" width="10" height="15"><img src="themes/XPMidnight/forums/images/down-right2.gif" alt="" border="0"></td>
	</tr>
</table>
<br />
<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		
      <td bgcolor="#E1E7ED" width="26" height="25"><img src="themes/XPMidnight/forums/images/up-left4.gif" alt="" border="0" width="26" height="30"></td>
		
      <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" height="25" width="100%">{L_SEARCH_OPTIONS}</td>
		
      <td bgcolor="#E1E7ED" width="10"><img src="themes/XPMidnight/forums/images/up-right2.gif" alt="" border="0"></td>
	</tr>
	<tr>
		
      <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif" width="26">&nbsp;</td>
		
      <td width="960"> 
        <table width="100%" cellpadding="4" cellspacing="1" border="0" bgcolor="{T_TR_COLOR3}">
				<tr>
					<td bgcolor="#E1E7ED" align="right"><span class="gen">{L_FORUM}:&nbsp;</span></td>
					<td bgcolor="#C9D3DE"><span class="genmed"><select class="post" name="search_forum">{S_FORUM_OPTIONS}</select></span></td>
					<td bgcolor="#E1E7ED" align="right" nowrap><span class="gen">{L_SEARCH_PREVIOUS}:&nbsp;</span></td>
					<td bgcolor="#C9D3DE" valign="middle"><span class="genmed"><select class="post" name="search_time">{S_TIME_OPTIONS}</select><br /><input type="radio" name="search_fields" value="all" checked /> {L_SEARCH_MESSAGE_TITLE}<br /><input type="radio" name="search_fields" value="msgonly" /> {L_SEARCH_MESSAGE_ONLY}</span></td>
				</tr>
				<tr>
					<td bgcolor="#E1E7ED" align="right"><span class="gen">{L_CATEGORY}:&nbsp;</span></td>
					<td bgcolor="#C9D3DE"><span class="genmed"><select class="post" name="search_cat">{S_CATEGORY_OPTIONS}
					</select></span></td>
					<td bgcolor="#E1E7ED" align="right"><span class="gen">{L_SORT_BY}:&nbsp;</span></td>
					<td bgcolor="#C9D3DE" valign="middle" nowrap><span class="genmed"><select class="post" name="sort_by">{S_SORT_OPTIONS}</select><br /><input type="radio" name="sort_dir" value="ASC" /> {L_SORT_ASCENDING}<br /><input type="radio" name="sort_dir" value="DESC" checked /> {L_SORT_DESCENDING}</span>&nbsp;</td>
				</tr>
				<tr>
					<td bgcolor="#E1E7ED" align="right" nowrap><span class="gen">{L_DISPLAY_RESULTS}:&nbsp;</span></td>
					<td bgcolor="#C9D3DE" nowrap><input type="radio" name="show_results" value="posts" /><span class="genmed">{L_POSTS}<input type="radio" name="show_results" value="topics" checked />{L_TOPICS}</span></td>
					<td bgcolor="#E1E7ED" align="right"><span class="gen">{L_RETURN_FIRST}</span></td>
					<td bgcolor="#C9D3DE"><span class="genmed"><select class="post" name="return_chars">{S_CHARACTER_OPTIONS}</select> {L_CHARACTERS}</span></td>
				</tr>
				<tr>
					<td class="catBottom" colspan="4" align="center" height="28">{S_HIDDEN_FIELDS}<input class="liteoption" type="submit" value="{L_SEARCH}" /></td>
				</tr>
			</table>
		</td>
		
      <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/right2.gif" width="10">&nbsp;</td>
	</tr>
	<tr>
		
      <td bgcolor="#E1E7ED" width="26" height="15" background="themes/XPMidnight/forums/images/down2.gif"><img src="themes/XPMidnight/forums/images/down-left2.gif" alt="" border="0"></td>
		
      <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/down2.gif" align="center" height="15" width="960">&nbsp;</td>
		
      <td bgcolor="#E1E7ED" width="10" height="15"><img src="themes/XPMidnight/forums/images/down-right2.gif" alt="" border="0"></td>
	</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr>
		<td align="right" valign="middle"><span class="gensmall">{S_TIMEZONE}</span></td>
	</tr>
</table></form>

<table width="95%" border="0">
  <tr>
		<td align="right" valign="top">{JUMPBOX}</td>
	</tr>
</table>
