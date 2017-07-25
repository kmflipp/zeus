
<br />
<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td bgcolor="#E1E7ED" width="15" height="25"><img src="themes/XPMidnight/forums/images/up-left2.gif" alt="" border="0"></td>
		<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" width="100%" height="25"><span class="topframe">{L_ADD_A_POLL}</span></td>
		
    <td bgcolor="#E1E7ED"><img src="themes/XPMidnight/forums/images/up-right2.gif" alt="" border="0"></td>
	</tr>
	<tr>
		<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif">&nbsp;</td>
		<td>
			<table border="1" cellspacing="3" cellpadding="3" width="100%">
				<tr>
					<td bgcolor="#E1E7ED" colspan="2"><span class="gensmall">{L_ADD_POLL_EXPLAIN}</span></td>
				</tr>
				<tr>
					<td bgcolor="#E1E7ED"><span class="gen"><b>{L_POLL_QUESTION}</b></span></td>
					<td bgcolor="#E1E7ED"><span class="genmed"><input type="text" name="poll_title" size="50" maxlength="255" class="post" value="{POLL_TITLE}" /></span></td>
				</tr>
				<!-- BEGIN poll_option_rows -->
				<tr>
					<td bgcolor="#E1E7ED"><span class="gen"><b>{L_POLL_OPTION}</b></span></td>
					<td bgcolor="#E1E7ED"><span class="genmed"><input type="text" name="poll_option_text[{poll_option_rows.S_POLL_OPTION_NUM}]" size="50" class="post" maxlength="255" value="{poll_option_rows.POLL_OPTION}" /></span> &nbsp;<input type="submit" name="edit_poll_option" value="{L_UPDATE_OPTION}" class="liteoption" /> <input type="submit" name="del_poll_option[{poll_option_rows.S_POLL_OPTION_NUM}]" value="{L_DELETE_OPTION}" class="liteoption" /></td>
				</tr>
				<!-- END poll_option_rows -->
				<tr>
					<td bgcolor="#E1E7ED"><span class="gen"><b>{L_POLL_OPTION}</b></span></td>
					<td bgcolor="#E1E7ED"><span class="genmed"><input type="text" name="add_poll_option_text" size="50" maxlength="255" class="post" value="{ADD_POLL_OPTION}" /></span> &nbsp;<input type="submit" name="add_poll_option" value="{L_ADD_OPTION}" class="liteoption" /></td>
				</tr>
				<tr>
					<td bgcolor="#E1E7ED"><span class="gen"><b>{L_POLL_LENGTH}</b></span></td>
					<td bgcolor="#E1E7ED"><span class="genmed"><input type="text" name="poll_length" size="3" maxlength="3" class="post" value="{POLL_LENGTH}" /></span>&nbsp;<span class="gen"><b>{L_DAYS}</b></span> &nbsp; <span class="gensmall">{L_POLL_LENGTH_EXPLAIN}</span></td>
				</tr>
				<!-- BEGIN switch_poll_delete_toggle -->
				<tr>
					<td bgcolor="#E1E7ED"><span class="gen"><b>{L_POLL_DELETE}</b></span></td>
					<td bgcolor="#E1E7ED"><input type="checkbox" name="poll_delete" /></td>
				</tr>
				<!-- END switch_poll_delete_toggle -->
			</table>

		</td>
		<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/right2.gif">&nbsp;</td>
	</tr>
	<tr>
		
    <td bgcolor="#E1E7ED" width="15" height="15" background="themes/XPMidnight/forums/images/down2.gif"><img src="themes/XPMidnight/forums/images/down-left2.gif" alt="" border="0"></td>
		<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/down2.gif" align="center" height="15">&nbsp;</td>
		
    <td bgcolor="#E1E7ED"><img src="themes/XPMidnight/forums/images/down-right2.gif" alt="" border="0"></td>
	</tr>
</table>
