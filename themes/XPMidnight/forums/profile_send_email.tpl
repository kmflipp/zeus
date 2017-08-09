
<script language="JavaScript" type="text/javascript">
<!--
function checkForm(formObj) {

	formErrors = false;

	if (formObj.message.value.length < 2) {
		formErrors = "{L_EMPTY_MESSAGE_EMAIL}";
	}
	else if ( formObj.subject.value.length < 2)
	{
		formErrors = "{L_EMPTY_SUBJECT_EMAIL}";
	}

	if (formErrors) {
		alert(formErrors);
		return false;
	}
}
//-->
</script>

<form action="{S_POST_ACTION}" method="post" name="post" onSubmit="return checkForm(this)">

{ERROR_BOX}

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr>
		<td align="left"><span  class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
	</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
    <tr>
    	<td bgcolor="#E1E7ED" width="15" height="25"><img src="themes/XPMidnight/forums/images/up-left2.gif" alt="" border="0"></td>
    	<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" width="100%" height="25" colspan="2"><span class="topframe">{L_SEND_EMAIL_MSG}</span></td>
   		
      <td bgcolor="#E1E7ED"><img src="themes/XPMidnight/forums/images/up-right2.gif" alt="" border="0"></td>
   	</tr>
    <tr>
    	<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif" width="15">&nbsp;</td>
		<td bgcolor="#E1E7ED" width="22%" align="right"><span class="gen">&nbsp;<b>{L_RECIPIENT}</b>&nbsp;</span></td>
		<td bgcolor="#E1E7ED" width="78%" align="left"><span class="gen">&nbsp;<b>{USERNAME}</b>&nbsp;</span> </td>
		<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/right2.gif" width="15">&nbsp;</td>
	</tr>
	<tr>
		<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif" width="15">&nbsp;</td>
		<td bgcolor="#E1E7ED" width="22%" align="right"><span class="gen">&nbsp;<b>{L_SUBJECT}</b>&nbsp;</span></td>
		<td bgcolor="#E1E7ED" width="78%" align="left"><span class="gen">&nbsp;<input type="text" name="subject" size="45" maxlength="100" style="width:500px" tabindex="2" class="post" value="{SUBJECT}" /></span>&nbsp;</td>
		<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/right2.gif" width="15">&nbsp;</td>
	</tr>
	<tr>
		<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif" width="15">&nbsp;</td>
		<td bgcolor="#E1E7ED" align="right" valign="top"><span class="gen">&nbsp;<b>{L_MESSAGE_BODY}</b>&nbsp;</span><br /><span class="gensmall">&nbsp;{L_MESSAGE_BODY_DESC}&nbsp;</span></td>
		<td bgcolor="#E1E7ED" align="left"><span class="gen">&nbsp;<textarea name="message" rows="25" cols="40" wrap="virtual" style="width:500px" tabindex="3" class="post">{MESSAGE}</textarea>&nbsp;</span></td>
		<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/right2.gif" width="15">&nbsp;</td>
	</tr>
	<tr>
		<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif" width="15">&nbsp;</td>
		<td bgcolor="#E1E7ED" align="right" valign="top"><span class="gen">&nbsp;<b>{L_OPTIONS}</b>&nbsp;</span></td>
		<td bgcolor="#E1E7ED" align="left">
		  <table cellspacing="0" cellpadding="1" border="0">
			<tr>
				<td><input type="checkbox" name="cc_email"  value="1" checked /></td>
				<td>&nbsp;<span class="gen">{L_CC_EMAIL}</span>&nbsp;</td>
			</tr>
		  </table>
		</td>
		<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/right2.gif" width="15">&nbsp;</td>
	</tr>
	<tr>
		<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif" width="15">&nbsp;</td>
		<td bgcolor="#E1E7ED" colspan="2" align="center" height="28"><input type="submit" tabindex="6" name="submit" class="mainoption" value="{L_SEND_EMAIL}" /></td>
		<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/right2.gif" width="15">&nbsp;</td>
	</tr>
	<tr>
		
      <td bgcolor="#E1E7ED" width="15" height="15" background="themes/XPMidnight/forums/images/down2.gif"><img src="themes/XPMidnight/forums/images/down-left2.gif" alt="" border="0"></td>
		<td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/down2.gif" align="center" height="15" colspan="2">&nbsp;</td>
   		
      <td bgcolor="#E1E7ED"><img src="themes/XPMidnight/forums/images/down-right2.gif" alt="" border="0"></td>
   	</tr>
</table>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
	<tr>
		<td align="right" valign="top"><span class="gensmall">{S_TIMEZONE}</span></td>
	</tr>
</table></form>

<table width="100%" cellspacing="2" border="0" align="center">
	<tr>
		<td valign="top" align="right">{JUMPBOX}</td>
	</tr>
</table>
