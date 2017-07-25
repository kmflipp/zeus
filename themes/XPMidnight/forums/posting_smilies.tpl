
<script language="javascript" type="text/javascript">
<!--
function emoticon(text) {
	text = ' ' + text + ' ';
	if (opener.document.forms['post'].message.createTextRange && opener.document.forms['post'].message.caretPos) {
		var caretPos = opener.document.forms['post'].message.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
		opener.document.forms['post'].message.focus();
	} else {
	opener.document.forms['post'].message.value  += text;
	opener.document.forms['post'].message.focus();
	}
}
//-->
</script>
<div align="center">
  <table border="0" cellspacing="0" cellpadding="0" width="50%">
    <tr> 
      <td bgcolor="#E1E7ED" width="26" height="25"><img src="themes/XPMidnight/forums/images/up-left2.gif" alt="" border="0"></td>
      <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" height="25" width="100%"><span  class="nav"><a href="{U_MORE_SMILIES}" onClick="open_window('{U_MORE_SMILIES}', 500, 300);return false" target="_smilies" class="nav">{L_MORE_SMILIES}</a></span></td>
      <td bgcolor="#E1E7ED" width="10"><img src="themes/XPMidnight/forums/images/up-right2.gif" alt="" border="0"></td>
    </tr>
    <tr> 
      <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif" width="26">&nbsp;</td>
      <td width="977"> 
        <div align="center"> 
          <table border="0" cellspacing="0" cellpadding="5">
            <!-- BEGIN smilies_row -->
            <tr align="center" valign="middle"> 
              <!-- BEGIN smilies_col -->
              <td><a href="javascript:emoticon('{smilies_row.smilies_col.SMILEY_CODE}')"><img src="{smilies_row.smilies_col.SMILEY_IMG}" border="0" alt="{smilies_row.smilies_col.SMILEY_DESC}" title="{smilies_row.smilies_col.SMILEY_DESC}" /></a></td>
              <!-- END smilies_col -->
            </tr>
            <!-- END smilies_row -->
            <!-- BEGIN switch_smilies_extra -->
            <tr align="center"> 
              <td colspan="{S_SMILIES_COLSPAN}"><span  class="nav"><a href="{U_MORE_SMILIES}" onClick="open_window('{U_MORE_SMILIES}', 500, 300);return false" target="_smilies" class="nav">{L_MORE_SMILIES}</a></span></td>
            </tr>
            <!-- END switch_smilies_extra -->
          </table>
        </div>
      </td>
      <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/right2.gif" width="10">&nbsp;</td>
    </tr>
    <tr> 
      <td bgcolor="#E1E7ED" width="26" height="2" background="themes/XPMidnight/forums/images/down2.gif"><img src="themes/XPMidnight/forums/images/down-left2.gif" alt="" border="0"></td>
      <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/down2.gif" align="center" height="2" width="100%">&nbsp;</td>
      <td bgcolor="#E1E7ED" width="10" height="2"><img src="themes/XPMidnight/forums/images/down-right2.gif" alt="" border="0"></td>
    </tr>
  </table>
</div>
<div align="center"></div>
<div align="center"><br />
  <span class="genmed"><a href="javascript:window.close();" class="genmed">{L_CLOSE_WINDOW}</a></span></div>
