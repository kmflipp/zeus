<br>
<form method="post" action="{S_MODE_ACTION}">
  <table border="0" cellspacing="0" cellpadding="0" align="center" width="95%">
    <tr>
	  <td align="left"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
	  <td align="right" nowrap><span class="genmed">{L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;&nbsp;{L_ORDER}&nbsp;{S_ORDER_SELECT}&nbsp;&nbsp;
		<input type="submit" name="submit" value="{L_SUBMIT}" class="liteoption" />
		</span>
	  </td>
	</tr>
  </table>
  <br>
  <table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
    <tr>
	  <td bgcolor="#E1E7ED" width="26" height="25"><img src="themes/XPMidnight/forums/images/up-left5.gif" alt="" border="0" width="26" height="30"></td>
	  <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" height="25" width="211"><span class="topframe">&nbsp;#&nbsp;</span></td>
	  <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" height="25" width="161"><span class="topframe">{L_PM}&nbsp;</span></td>
	  <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" height="25" width="177"><span class="topframe">&nbsp;{L_USERNAME}&nbsp;</span></td>
	  <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" height="25" width="186"><span class="topframe">&nbsp;{L_EMAIL}&nbsp;</span></td>
	  <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" height="25" width="137"><span class="topframe">&nbsp;{L_FROM}&nbsp;</span></td>
	  <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" height="25" width="147"><span class="topframe">&nbsp;{L_JOINED}&nbsp;</span></td>
	  <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" height="25" width="140"><span class="topframe">&nbsp;{L_POSTS}&nbsp;</span></td>
	  <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" height="25" width="179"><span class="topframe">&nbsp;{L_WEBSITE}&nbsp;</span></td>
	  <td bgcolor="#E1E7ED" width="6" height="25"><img src="themes/XPMidnight/forums/images/up-right2.gif" alt="" border="0"></td>
    </tr>
	<!-- BEGIN memberrow -->
	<tr>
	  <td class="{memberrow.ROW_CLASS}" background="themes/XPMidnight/forums/images/left2.gif">&nbsp;</td>
	  <td class="{memberrow.ROW_CLASS}" align="center" width="211"><span class="gen">&nbsp;{memberrow.ROW_NUMBER}&nbsp;</span></td>
	  <td class="{memberrow.ROW_CLASS}" align="center" width="161">&nbsp;{memberrow.PM_IMG}&nbsp;</td>
	  <td class="{memberrow.ROW_CLASS}" align="center" width="177"><span class="gen"><a href="{memberrow.U_VIEWPROFILE}" class="gen"><font size="1">{memberrow.USERNAME}</font></a></span></td>
	  <td class="{memberrow.ROW_CLASS}" align="center" valign="middle" width="186">&nbsp;{memberrow.EMAIL_IMG}&nbsp;</td>
	  <td class="{memberrow.ROW_CLASS}" align="center" valign="middle" width="137"><span class="gen">{memberrow.FROM}</span></td>
	  <td class="{memberrow.ROW_CLASS}" align="center" valign="middle" width="147"><span class="gensmall">{memberrow.JOINED}</span></td>
	  <td class="{memberrow.ROW_CLASS}" align="center" valign="middle" width="140"><span class="gen">{memberrow.POSTS}</span></td>
	  <td class="{memberrow.ROW_CLASS}" align="center" width="179">&nbsp;{memberrow.WWW_IMG}</td>
	  <td class="{memberrow.ROW_CLASS}" background="themes/XPMidnight/forums/images/right2.gif" width="6"></td>
	</tr>
	<!-- END memberrow -->
	<tr>
	  <td bgcolor="#E1E7ED" width="26" height="15" background="themes/XPMidnight/forums/images/down2.gif"><img src="themes/XPMidnight/forums/images/down-left2.gif" alt="" border="0"></td>
      <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/down2.gif" align="center" height="15" colspan="8">&nbsp;</td>
	  <td bgcolor="#E1E7ED" width="6" height="15"><img src="themes/XPMidnight/forums/images/down-right2.gif" alt="" border="0"></td>
    </tr>
  </table>
  <table border="0" cellspacing="0" cellpadding="0" align="center" width="95%">
    <tr>
	  <td align="left" colspan="5"><span class="nav">{PAGE_NUMBER}</span></td>
	  <td align="right" nowrap colspan="4"><span class="gensmall">{S_TIMEZONE}</span><br /><span class="nav">{PAGINATION}</span></td>

	</tr>
  </table>
</form>

<table width="95%" cellspacing="2" border="0" align="center">
  <tr>
	<td valign="top" align="right">{JUMPBOX}</td>
  </tr>
</table>
