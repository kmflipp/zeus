<table border="0" cellspacing="0" cellpadding="0">
 <tr>
    <td width="100%">&nbsp; </td>
 </tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" width="65%">
  <tr> 
    <td bgcolor="#E1E7ED" width="26" height="29"><img src="themes/XPMidnight/forums/images/up-left2.gif" alt="" border="0"></td>
    <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" height="29" width="100%"><b>Topic 
      Poll</b></td>
    <td bgcolor="#E1E7ED" width="10" height="29"> 
      <div align="right"><img src="themes/XPMidnight/forums/images/up-right2.gif" alt="" border="0"></div>
    </td>
  </tr>
  <tr> 
    <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif" width="26">&nbsp;</td>
    <td bgcolor="#E1E7ED" width="972"> 
      <div align="center"> </div>
      <div align="center">
        <form method="POST" action="{S_POLL_ACTION}">
          <table cellspacing="0" cellpadding="4" border="0" align="center">
            <tr> 
              <td align="center" colspan="2"><span class="gen"><b>{POLL_QUESTION}</b></span></td>
            </tr>
            <!-- BEGIN poll_option -->
            <tr> 
              <td>
                <input type="radio" name="vote_id" value="{poll_option.POLL_OPTION_ID}" />
                &nbsp;</td>
              <td><span class="gen">{poll_option.POLL_OPTION_CAPTION}</span></td>
            </tr>
            <!-- END poll_option -->
            <tr> 
              <td align="center" valign="middle" colspan="2"> 
                <input type="submit" name="submit" value="{L_SUBMIT_VOTE}" class="liteoption" />
              </td>
            </tr>
            <tr> 
              <td align="center" colspan="2"> <span class="gensmall"><b><a href="{U_VIEW_RESULTS}" class="gensmall">{L_VIEW_RESULTS}</a></b></span> 
              </td>
            </tr>
          </table>
          {S_HIDDEN_FIELDS}
        </form>
      </div>
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
