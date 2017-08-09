 
<table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr> 
    <td class="nav" align="left" colspan="2">
      <p><a class="nav" href="{U_INDEX}">{L_INDEX}</a></p>
      <p>&nbsp;</p>
    </td>
  </tr>
  <tr> 
    <td bgcolor="#E1E7ED" width="15" height="25"><img src="themes/XPMidnight/forums/images/up-left5.gif" alt="" border="0"></td>
    <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/up2.gif" align="center" width="100%" height="25">
      <div align="left"> <b>&nbsp;Who is Online</b></div>
    </td>
    <td bgcolor="#E1E7ED"><img src="themes/XPMidnight/forums/images/up-right2.gif" alt="" border="0"></td>
  </tr>
  <tr> 
    <td bgcolor="#E1E7ED" background="themes/XPMidnight/forums/images/left2.gif" width="15">&nbsp;</td>
    <td bgcolor="#E1E7ED" width="100%" align="center"> 
      <table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
        <tr> 
          <th width="35%" class="thCornerL" height="25">&nbsp;{L_USERNAME}&nbsp;</th>
          <th width="29%" class="thTop">&nbsp;{L_LAST_UPDATE}&nbsp;</th>
          <th width="36%" class="thCornerR">&nbsp;{L_FORUM_LOCATION}&nbsp;</th>
        </tr>
        <tr> 
          <td class="catSides" colspan="3" height="28"><span class="cattitle"><b>{TOTAL_REGISTERED_USERS_ONLINE}</b></span></td>
        </tr>
        <!-- BEGIN reg_user_row -->
        <tr> 
          <td width="35%">&nbsp;<span class="gen"><a href="{reg_user_row.U_USER_PROFILE}" class="gen">{reg_user_row.USERNAME}</a></span>&nbsp;</td>
          <td width="29%" align="center" nowrap>&nbsp;<span class="gen">{reg_user_row.LASTUPDATE}</span>&nbsp;</td>
          <td width="36%">&nbsp;<span class="gen"><a href="{reg_user_row.U_FORUM_LOCATION}" class="gen">{reg_user_row.FORUM_LOCATION}</a></span>&nbsp;</td>
        </tr>
        <!-- END reg_user_row -->
        <tr> 
          <td colspan="3" height="1"><img src="themes/XPMidnight/forums/images/spacer.gif" width="1" height="1" alt="."></td>
        </tr>
        <tr> 
          <td class="catSides" colspan="3" height="28"><span class="cattitle"><b>{TOTAL_GUEST_USERS_ONLINE}</b></span></td>
        </tr>
        <!-- BEGIN guest_user_row -->
        <tr> 
          <td width="35%" class="row1">&nbsp;<span class="gen">{guest_user_row.USERNAME}</span>&nbsp;</td>
          <td width="29%" align="center" nowrap class="row2">&nbsp;<span class="gen">{guest_user_row.LASTUPDATE}</span>&nbsp;</td>
          <td width="36%" class="row1">&nbsp;<span class="gen"><a href="{guest_user_row.U_FORUM_LOCATION}" class="gen">{guest_user_row.FORUM_LOCATION}</a></span>&nbsp;</td>
        </tr>
        <!-- END guest_user_row -->
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
<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
  <tr>
	<td align="left" valign="top"><span class="gensmall">{L_ONLINE_EXPLAIN}</span></td>
	<td align="right" valign="top"><span class="gensmall">{S_TIMEZONE}</span></td>
  </tr>
</table>

<br />

<table width="100%" cellspacing="2" border="0" align="center">
  <tr>
	<td valign="top" align="right">{JUMPBOX}</td>
  </tr>
</table>

