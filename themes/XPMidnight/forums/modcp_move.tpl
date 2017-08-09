
<form action="{S_MODCP_ACTION}" method="post">
  <table width="95%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr>
	  <td class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
	</tr>
  </table>
  <table border="0" cellspacing="0" cellpadding="0" width="100%">
    <tr> 
      <td bgcolor="#E1E7ED" width="26" height="29"><img src="themes/XPMidnight/forums/images/up-left2.gif" alt="" border="0"></td>
      <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" height="29" width="100%"><span class="topframe">{MESSAGE_TITLE}</span></td>
      <td bgcolor="#E1E7ED" width="10" height="29"> 
        <div align="right"><img src="themes/XPMidnight/forums/images/up-right2.gif" alt="" border="0"></div>
      </td>
    </tr>
    <tr> 
      <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif" width="26">&nbsp;</td>
      <td bgcolor="#E1E7ED" width="972"> 
        <div align="center">
          <table width="95%" border="0" cellspacing="0" cellpadding="1">
            <tr> 
              <td>&nbsp;</td>
            </tr>
            <tr> 
              <td align="center"><span class="gen">{L_MOVE_TO_FORUM} &nbsp; {S_FORUM_SELECT}<br />
                <br />
                <input type="checkbox" name="move_leave_shadow" checked />
                {L_LEAVESHADOW}<br />
                <br />
                {MESSAGE_TEXT}</span><br />
                <br />
                {S_HIDDEN_FIELDS} 
                <input class="mainoption" type="submit" name="confirm" value="{L_YES}" />
                &nbsp;&nbsp; 
                <input class="liteoption" type="submit" name="cancel" value="{L_NO}" />
              </td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
            </tr>
          </table>
        </div>
        <div align="center"></div>
      </td>
      <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/right2.gif" width="10">&nbsp;</td>
    </tr>
    <tr> 
      <td bgcolor="#E1E7ED" width="26" height="15" background="themes/XPMidnight/forums/images/down2.gif"><img src="themes/XPMidnight/forums/images/down-left2.gif" alt="" border="0"></td>
      <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/down2.gif" align="center" height="15" width="100%">&nbsp;</td>
      <td bgcolor="#E1E7ED" width="10" height="15" background="themes/XPMidnight/forums/images/down2.gif"> 
        <div align="right"><img src="themes/XPMidnight/forums/images/down-right2.gif" alt="" border="0"></div>
      </td>
    </tr>
  </table>
</form>
