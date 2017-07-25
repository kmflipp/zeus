<!-- DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" -->
<!-- <html xmlns="http://www.w3.org/1999/xhtml"> -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="{S_CONTENT_DIRECTION}">
<head>
<!-- link rel="stylesheet" href="themes/XPMidnight/forums/forums.css" type="text/css" -->
<body bgcolor="#E1E7ED">
<style>
/*
  XPMidnight Theme
  was created by mikem using
  The original subSilver Theme for phpBB version 2+
  Created by subBlue design
  http://www.subBlue.com
*/
A:link          {BACKGROUND: none; COLOR: #215DC6; FONT-SIZE: 11px; FONT-FAMILY: Tahoma, Verdana, Helvetica; TEXT-DECORATION: underline}
A:active        {BACKGROUND: none; COLOR: #215DC6; FONT-SIZE: 11px; FONT-FAMILY: Tahoma, Verdana, Helvetica; TEXT-DECORATION: underline}
A:visited       {BACKGROUND: none; COLOR: #215DC6; FONT-SIZE: 11px; FONT-FAMILY: Tahoma, Verdana, Helvetica; TEXT-DECORATION: underline}
A:hover         {BACKGROUND: none; COLOR: #CC0000; FONT-SIZE: 11px; FONT-FAMILY: Tahoma, Verdana, Helvetica; TEXT-DECORATION: underline}
/*
  Setting additional nice borders for the main table cells.
  The names indicate which sides the border will be on.
  Don't worry if you don't understand this, just ignore it :-)
*/
TD.catHead,TD.catSides,TD.catLeft,TD.catRight,TD.catBottom { background-color:#8099B3; height: 28px; border: #ffffff; border-style: solid; }  /* Uses Bitmap */
.topframe  { font-size : 11px; letter-spacing: 1px; font-weight : bold; text-decoration : none; color : #FFFFFF}
td.row1	{ background-color: #E1E7ED; }
td.row2	{ background-color: #E1E7ED; }
td.row3	{ background-color: #E1E7ED; }

TD.catHead	 { height: 29px; border-left-width: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px }
TD.catSides  { border-left-width: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px }
TD.catLeft	 { border-left-width: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px }
TD.catRight	 { border-left-width: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px }
TD.catBottom { height: 29px; border-left-width: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px }

TH.thHead,TH.thSides,TH.thBottom,TH.thCornerL,TH.thCornerR { border: #ffffff; border-style: solid; }
TH.thTop,TH.thLeft,TH.thRight,TH.thCornerL,TH.thCornerR { border: #b4a172; }

TH.thHead	 { font-weight : bold; font-size: 12px; height: 25px; border-left-width: 1px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 0px }
TH.thSides	 { border-left-width: 0px; border-top-width: 0px; border-right-width: 1px; border-bottom-width: 0px }
TH.thTop	 { border-left-width: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px }
TH.thLeft	 { border-left-width: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px }
TH.thRight	 { border-left-width: 0px; border-top-width: 0px; border-right-width: 1px; border-bottom-width: 0px }
TH.thBottom  { border-left-width: 0px; border-top-width: 0px; border-right-width: 1px; border-bottom-width: 1px }
TH.thCornerL { border-left-width: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px }
TH.thCornerR { border-left-width: 0px; border-top-width: 0px; border-right-width: 1px; border-bottom-width: 0px }

TD.row3Right	 { background-color: #E1E7ED; border: #D2CEC5; border-style: solid;  border-left-width: 0px; border-top-width: 0px; border-right-width: 1px; border-bottom-width: 0px }


/* The largest text used in the index page title and toptic title etc. */
.maintitle	{ font-family: "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; font-size : 22px; font-weight : bold; text-decoration : none; line-height : 120%; color : #000000;}

a.sitename	{ font-family: "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; font-size : 22px; font-weight : bold; text-decoration : none; line-height : 120%; color : #006699;}
a.sitename:hover	{ font-family: "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; font-size : 22px; font-weight : bold; text-decoration : underline; line-height : 120%; color : #CC0000;}

/* General normal text */
.gen		{ font-size : 12px; color : #000000; }
a.gen		{ color: #006699; text-decoration: underline; }
a.gen:hover	{ color: #CC0000; text-decoration: underline; }


/* General medium text */
.genmed		{ font-size : 11px; color : #000000; }
a.genmed	{ text-decoration: underline; color : #006699; }
a.genmed:hover	{ text-decoration: underline; color : #CC0000; }


/* General small */
.gensmall	{ font-size : 10px; color : #000000; }
a.gensmall	{ color: #006699; text-decoration: underline; }
a.gensmall:hover{ color: #CC0000; text-decoration: underline; }


/* The register, login, search etc links at the top of the page */
.mainmenu		{ font-size : 11px; text-decoration : none; color : #000000 }
a.mainmenu		{ text-decoration: underline; color : #006699;  }
a.mainmenu:hover{ text-decoration: underline; color : #CC0000; }


/* Forum category titles */
.cattitle		{ font-size : 12px; letter-spacing: 1px; font-weight : bold; text-decoration : none; color : #000000}
a.cattitle		{ text-decoration: underline; color : #006699; }
a.cattitle:hover	{ text-decoration: underline; color : #CC0000; }

/* Forum category titles */
.whonline		{ font-size : 12px; letter-spacing: 1px; font-weight : bold; text-decoration : none; color : #FFFFFF}
a.whonline		{ text-decoration: underline; color : #006699; }
a.whonline:hover	{ text-decoration: underline; color : #CC0000; }


/* Forum title: Text and link to the forums used in: index.php */
.forumlink		{ font-size : 12px; font-weight : bold; text-decoration : none; color : #000000; }
a.forumlink		{ text-decoration: underline; color : #006699; }
a.forumlink:hover	{ text-decoration: underline; color : #CC0000; }


/* Used for the navigation text, (Page 1,2,3 etc) and the navigation bar when in a forum */
.nav			{ font-size : 11px; font-weight : bold; text-decoration : none; color : #000000;}
a.nav			{ text-decoration: underline; color : #006699; }
a.nav:hover		{ text-decoration: underline; color : #CC0000; }


/* titles for the topics: could specify viewed link colour too */
.topictitle		{ font-size : 11px; font-weight : bold; text-decoration : none; color : #000000; }
a.topictitle		{ text-decoration: underline; color : #006699; }
a.topictitle:hover	{ text-decoration: underline; color : #CC0000; }


/* Name of poster in viewmsg.php and viewtopic.php and other places */
.name			{ font-size : 11px; text-decoration : none; color : #000000;}
a.name			{ color: #006699; text-decoration: underline;}
a.name:hover	{ color: #CC0000; text-decoration: underline;}


/* Location, number of posts, post date etc */
.postdetails		{ font-size : 10px; color : #000000; }
a.postdetails		{ color: #006699; text-decoration: underline; }
a.postdetails:hover	{ color: #CC0000; text-decoration: underline; }


/* The content of the posts (body of text) */
.postbody { font-size : 12px; line-height: 18px}
a.postlink	{ text-decoration: underline; color : #006699 }
a.postlink:hover { text-decoration: underline; color : #CC0000}


/* Quote Code (currently not used) */
.code { 
	font-family: Courier, "Courier New", sans-serif; font-size: 11px; color: #006600;
	background-color: #f1e1b1; border: #b79067; border-style: solid;
	border-left-width: 1px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px
}

.quote {
	font-family: Verdana, Arial, sans-serif; font-size: 11px; color: #444444; line-height: 125%;
	background-color: #f1e1b1; border: #b79067; border-style: solid;
	border-left-width: 1px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px
}

.editedby { font-size : 10px; line-height : 100%; color : #333333; }

/* Form elements */
input,textarea, select {
	color : #000000;
	font-family : Verdana, Arial, Helvetica, sans-serif;
	font-size : 11px;
	font-weight : normal;
	border-color : #000000;
}

/* The text input fields background colour */
input.post, textarea.post, select {
	background-color : #FFFFFF;
}

input { text-indent : 2px;
	color : #000000;
	font-family : Verdana, Arial, Helvetica, sans-serif;
	font-size : 11px;
	font-weight : normal;
	border-color : #000000; }

/* The buttons used for bbCode styling in message post */
input.button {
	background-color : #C8C2A5;
	color : #000000;
	font-family : Verdana, Arial, Helvetica, sans-serif;
	font-size : 11px;
}

/* The main submit button option */
input.mainoption {
	background-color : #C8C2A5;
	font-weight : bold;
}

/* None-bold submit button */
input.liteoption {
	background-color : #C8C2A5;
	font-weight : normal;
}

/* This is the line in the posting page which shows the rollover
  help line. This is actually a text box, but if set to be the same
  colour as the background no one will know ;)
*/
.helpline { background-color: #E1E7ED; border-style: none; }

/* Copyright and bottom info */
.copyright		{ font-family: Verdana, Arial, Helvetica, sans-serif; color: #444444; font-size: 10px;}
a.copyright		{ color: #333333; text-decoration: none;}
a.copyright:hover { color: #000000; text-decoration: underline;}


/* Import the fancy styles for IE only (NS4.x doesn't use the @import function) */
@import url("formIE.css");
</style>
<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}"  />
<meta http-equiv="Content-Style-Type" content="text/css" />
</head>
