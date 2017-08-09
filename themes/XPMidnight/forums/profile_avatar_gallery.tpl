
<form action="{S_PROFILE_ACTION}" method="post">
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr>
	<td align="left"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
  </tr>
</table>

<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td bgcolor="#C9D3DE" width="15" height="25"><img src="themes/XPMidnight/forums/images/up-left2.gif" alt="" border="0"></td>
		<td bgcolor="#C9D3DE" background="themes/XPMidnight/forums/images/up2.gif" align="center" width="100%" height="25"><span class="topframe">{L_AVATAR_GALLERY}</span></td>
		
      <td bgcolor="#C9D3DE"><img src="themes/XPMidnight/forums/images/up-right2.gif" alt="" border="0"></td>
	</tr>
	<tr>
		<td bgcolor="#C9D3DE" background="themes/XPMidnight/forums/images/left2.gif" width="15">&nbsp;</td>
		<td bgcolor="#C9D3DE" width="100%" align="center">
        <table border="1" cellpadding="0" cellspacing="0" width="100%" bgcolor="{T_TR_COLOR3}" bordercolor="#F0F1F5">
          <tr>
	  <td bgcolor="#E1E7ED" align="center" valign="middle" colspan="6" height="28"><span class="genmed">{L_CATEGORY}:&nbsp;{S_CATEGORY_SELECT}&nbsp;<input type="submit" class="liteoption" value="{L_GO}" name="avatargallery" /></span></td>
	</tr>
	<!-- BEGIN avatar_row -->
	<tr>
	<!-- BEGIN avatar_column -->
		<td bgcolor="#E1E7ED" align="center"><img src="{avatar_row.avatar_column.AVATAR_IMAGE}" alt="{avatar_row.avatar_column.AVATAR_NAME}" title="{avatar_row.avatar_column.AVATAR_NAME}" /></td>
	<!-- END avatar_column -->
	</tr>
	<tr>
	<!-- BEGIN avatar_option_column -->
		<td bgcolor="#C9D3DE" align="center"><input type="radio" name="avatarselect" value="{avatar_row.avatar_option_column.S_OPTIONS_AVATAR}" /></td>
	<!-- END avatar_option_column -->
	</tr>

	<!-- END avatar_row -->
	<tr>
	  <td bgcolor="#E1E7ED" colspan="{S_COLSPAN}" align="center" height="28">{S_HIDDEN_FIELDS}
		<input type="submit" name="submitavatar" value="{L_SELECT_AVATAR}" class="mainoption" />
		&nbsp;&nbsp;
		<input type="submit" name="cancelavatar" value="{L_RETURN_PROFILE}" class="liteoption" />
	  </td>
	</tr>
  </table>
  		</td>
  		<td bgcolor="#C9D3DE" background="themes/XPMidnight/forums/images/right2.gif">&nbsp;</td>
  	</tr>
  	<tr>
  		
      <td bgcolor="#C9D3DE" width="15" height="15" background="themes/XPMidnight/forums/images/down2.gif"><img src="themes/XPMidnight/forums/images/down-left2.gif" alt="" border="0"></td>
  		<td bgcolor="#C9D3DE" background="themes/XPMidnight/forums/images/down2.gif" align="center" height="15">&nbsp;</td>
  		
      <td bgcolor="#C9D3DE"><img src="themes/XPMidnight/forums/images/down-right2.gif" alt="" border="0"></td>
  	</tr>
</table>
</form>
