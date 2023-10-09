<?
/* 
File Name: SwipeLog.php
----------------------------------------------------------------------
Purpose of this file: 
Swipe login file
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: July 20, 2003
----------------------------------------------------------------------
Copyright Notice:
Copyright (C) 2003 by the Department of Science and Technology
----------------------------------------------------------------------
LICENSE:
This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License (GPL) as published 
by the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version. This program is distributed in the 
hope that it will be useful, but WITHOUT ANY WARRANTY; without even the 
implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
See the GNU General Public License for more details.
To read the license please visit http://www.gnu.org/copyleft/gpl.html
 ----------------------------------------------------------------------
*/
require("../hrmis/class/LoginDTR.php");
//include("../hrmis/class/IP_authentication.php");
$objLog = new LoginDTR;
$dtmDate = date("Y-m-d"); 
if ($txtEmpNmbr != "")
{
	$strLogMsg = $objLog->logDTR($txtEmpNmbr, $txtPsswrd, $txtTime, $dtmDate, 1);
	$strMsg = $strLogMsg;
}
?>
<?php
/*** Clock -- beginning of server-side support code
by Andrew Shearer, http://www.shearersoftware.com/
v2.1.2-PHP, 2003-08-07. For updates and explanations, see
<http://www.shearersoftware.com/software/web-tools/clock/>. ***/

/* Prevent this page from being cached (though some browsers still
   cache the page anyway, which is why we use cookies). This is
   only important if the cookie is deleted while the page is still
   cached (and for ancient browsers that don't know about Cache-Control).
   If that's not an issue, you may be able to get away with
   "Cache-Control: private" instead. */
header("Pragma: no-cache");

/* Grab the current server time. */
$gDate = time();
/* Are the seconds shown by default? When changing this, also change the
   JavaScript client code's definition of clockShowsSeconds below to match. */

function getServerDateItems($inDate) {
	return date('Y,n,j,G,',$inDate).intval(date('i',$inDate)).','.intval(date('s',$inDate));
	// year (4-digit),month,day,hours (0-23),minutes,seconds
	// use intval to strip leading zero from minutes and seconds
	//   so JavaScript won't try to interpret them in octal
	//   (use intval instead of ltrim, which translates '00' to '')
}

function clockDateString($inDate) {
    return date('l, F j, Y',$inDate);    // eg "Monday, January 1, 2002"
}

function clockTimeString($inDate) {
    return date('g:i:s A',$inDate).' ';
}
/*** Clock -- end of server-side support code ***/
?>

<html>
<head>
<title>Daily Time Record Login</title>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
<style type="text/css">
<!--
.background {
	background-color: #6699CC;
	background-image: url(images/bluebg.jpg);
}
-->
</style>
<style>
.barcode {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 1px;
	color: #0055FF;
	background-color: #0055FF;
	border: none #0055FF;
}

</style>
<style type="text/css">
<!--
.date {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 50pt;
	color: #000A6A;
	font-weight: bolder;
}

.name {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 35pt;
	color: #000A6A;
	font-weight: bolder;
}
-->
</style>
<style type="text/css">
<!--
.textbox {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 30pt;
	font-weight: bold;
	color: #000A6A;	
}
-->
</style>
<style type="text/css">
<!--
.txtlabel {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 20pt;
	font-weight: bolder;	
	color: #000A6A;
}
.time {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 50pt;
	font-weight: bolder;
	color: #000A6A;
}

.link {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 8pt;
	font-weight: bolder;
	color: #FF0000;
	text-decoration: none;
}
-->
</style>
<script language="JavaScript" type="text/javascript">
<!--
/* set up variables used to init clock in BODY's onLoad handler;
   should be done as early as possible */
var clockLocalStartTime = new Date();
var clockServerStartTime = new Date(<?php echo(getServerDateItems($gDate))?>);

/* stub functions for older browsers;
   will be overridden by next JavaScript1.2 block */
function clockInit() {
}
//-->
</script>
<script language="JavaScript1.2" type="text/javascript">
<!--
/*** simpleFindObj, by Andrew Shearer

Efficiently finds an object by name/id, using whichever of the IE,
classic Netscape, or Netscape 6/W3C DOM methods is available.
The optional inLayer argument helps Netscape 4 find objects in
the named layer or floating DIV. */
function simpleFindObj(name, inLayer) {
	return document[name] || (document.all && document.all[name])
		|| (document.getElementById && document.getElementById(name))
		|| (document.layers && inLayer && document.layers[inLayer].document[name]);
}

/*** Beginning of Clock 2.1.2, by Andrew Shearer
See: http://www.shearersoftware.com/software/web-tools/clock/
Redistribution is permitted with the above notice intact.

Client-side clock, based on computed time differential between browser &
server. The server time is inserted by server-side JavaScript, and local
time is subtracted from it by client-side JavaScript while the page is
loading.

Cookies: The local and remote times are saved in cookies named
localClock and remoteClock, so that when the page is loaded from local
cache (e.g. by the Back button) the clock will know that the embedded
server time is stale compared to the local time, since it already
matches its cookie. It can then base the calculations on both cookies,
without reloading the page from the server. (IE 4 & 5 for Windows didn't
respect Response.Expires = 0, so if cookies weren't used, the clock
would be wrong after going to another page then clicking Back. Netscape
& Mac IE were OK.)

Every so often (by default, one hour) the clock will reload the page, to
make sure the clock is in sync (as well as to update the rest of the
page content).

Compatibility: IE 4.x and 5.0, Netscape 4.x and 6.0, Mozilla 1.0. Mac & Windows.

History:  1.0   2000-05-09 GIF-image digits
          2.0   2000-06-29 Uses text DIV layers (so 4.0 browsers req'd), &
                         cookies to work around Win IE stale-time bug
		  2.1   2002-10-12 Noted Mozilla 1.0 compatibility; released PHP version.
		  2.1.1 2002-10-20 Fixed octal bug in the PHP translation; the number of
		  				minutes & seconds were misinterpretes when less than 10
		  2.1.2 2003-08-07 The previous fix had introduced a bug when the
		                minutes or seconds were exactly 0. Thanks to Man Bui
		                for reporting the bug.
*/
var clockIncrementMillis = 60000;
var localTime;
var clockOffset;
var clockExpirationLocal;
var clockShowsSeconds = false;
var clockTimerID = null;

function clockInit(localDateObject, serverDateObject)
{
    var origRemoteClock = parseInt(clockGetCookieData("remoteClock"));
    var origLocalClock = parseInt(clockGetCookieData("localClock"));
    var newRemoteClock = serverDateObject.getTime();
    // May be stale (WinIE); will check against cookie later
    // Can't use the millisec. ctor here because of client inconsistencies.
    var newLocalClock = localDateObject.getTime();
    var maxClockAge = 60 * 60 * 1000;   // get new time from server every 1hr

    if (newRemoteClock != origRemoteClock) {
        // new clocks are up-to-date (newer than any cookies)
        document.cookie = "remoteClock=" + newRemoteClock;
        document.cookie = "localClock=" + newLocalClock;
        clockOffset = newRemoteClock - newLocalClock;
        clockExpirationLocal = newLocalClock + maxClockAge;
        localTime = newLocalClock;  // to keep clockUpdate() happy
    }
    else if (origLocalClock != origLocalClock) {
        // error; localClock cookie is invalid (parsed as NaN)
        clockOffset = null;
        clockExpirationLocal = null;
    }
    else {
        // fall back to clocks in cookies
        clockOffset = origRemoteClock - origLocalClock;
        clockExpirationLocal = origLocalClock + maxClockAge;
        localTime = origLocalClock;
        // so clockUpdate() will reload if newLocalClock
        // is earlier (clock was reset)
    }
    /* Reload page at server midnight to display the new date,
       by expiring the clock then */
    var nextDayLocal = (new Date(serverDateObject.getFullYear(),
            serverDateObject.getMonth(),
            serverDateObject.getDate() + 1)).getTime() - clockOffset;
    if (nextDayLocal < clockExpirationLocal) {
        clockExpirationLocal = nextDayLocal;
    }
}

function clockOnLoad()
{
    clockUpdate();
}

function clockOnUnload() {
    clockClearTimeout();
}

function clockClearTimeout() {
    if (clockTimerID) {
        clearTimeout(clockTimerID);
        clockTimerID = null;
    }
}

function clockToggleSeconds()
{
    clockClearTimeout();
    if (clockShowsSeconds) {
        clockShowsSeconds = false;
        clockIncrementMillis = 60000;
    }
    else {
        clockShowsSeconds = true;
        clockIncrementMillis = 1000;
    }
    clockUpdate();
}

function clockTimeString(inHours, inMinutes, inSeconds) {
    return inHours == null ? "-:--" : ((inHours == 0
                   ? "12" : (inHours <= 12 ? inHours : inHours - 12))
                + (inMinutes < 10 ? ":0" : ":") + inMinutes
                + (clockShowsSeconds
                   ? ((inSeconds < 10 ? ":0" : ":") + inSeconds) : "")
                + (inHours < 12 ? " AM" : " PM"));
}

function clockDisplayTime(inHours, inMinutes, inSeconds) {
    
    clockWriteToDiv("ClockTime", clockTimeString(inHours, inMinutes, inSeconds));
}

function clockWriteToDiv(divName, newValue) // APS 6/29/00
{
    var divObject = simpleFindObj(divName);
    newValue = '<p>' + newValue + '<' + '/p>';
    if (divObject && divObject.innerHTML) {
        divObject.innerHTML = newValue;
    }
    else if (divObject && divObject.document) {
        divObject.document.writeln(newValue);
        divObject.document.close();
    }
    // else divObject wasn't found; it's only a clock, so don't bother complaining
}

function clockGetCookieData(label) {
    /* find the value of the specified cookie in the document's
    semicolon-delimited collection. For IE Win98 compatibility, search
    from the end of the string (to find most specific host/path) and
    don't require "=" between cookie name & empty cookie values. Returns
    null if cookie not found. One remaining problem: Under IE 5 [Win98],
    setting a cookie with no equals sign creates a cookie with no name,
    just data, which is indistinguishable from a cookie with that name
    but no data but can't be overwritten by any cookie with an equals
    sign. */
    var c = document.cookie;
    if (c) {
        var labelLen = label.length, cEnd = c.length;
        while (cEnd > 0) {
            var cStart = c.lastIndexOf(';',cEnd-1) + 1;
            /* bug fix to Danny Goodman's code: calculate cEnd, to
            prevent walking the string char-by-char & finding cookie
            labels that contained the desired label as suffixes */
            // skip leading spaces
            while (cStart < cEnd && c.charAt(cStart)==" ") cStart++;
            if (cStart + labelLen <= cEnd && c.substr(cStart,labelLen) == label) {
                if (cStart + labelLen == cEnd) {                
                    return ""; // empty cookie value, no "="
                }
                else if (c.charAt(cStart+labelLen) == "=") {
                    // has "=" after label
                    return unescape(c.substring(cStart + labelLen + 1,cEnd));
                }
            }
            cEnd = cStart - 1;  // skip semicolon
        }
    }
    return null;

}

/* Called regularly to update the clock display as well as onLoad (user
   may have clicked the Back button to arrive here, so the clock would need
   an immediate update) */
function clockUpdate()
{
    var lastLocalTime = localTime;
    localTime = (new Date()).getTime();
    
    /* Sanity-check the diff. in local time between successive calls;
       reload if user has reset system clock */
    if (clockOffset == null) {
        clockDisplayTime(null, null, null);
    }
    else if (localTime < lastLocalTime || clockExpirationLocal < localTime) {
        /* Clock expired, or time appeared to go backward (user reset
           the clock). Reset cookies to prevent infinite reload loop if
           server doesn't give a new time. */
        document.cookie = 'remoteClock=-';
        document.cookie = 'localClock=-';
        location.reload();      // will refresh time values in cookies
    }
    else {
        // Compute what time would be on server 
        var serverTime = new Date(localTime + clockOffset);
        clockDisplayTime(serverTime.getHours(), serverTime.getMinutes(),
            serverTime.getSeconds());
        
        // Reschedule this func to run on next even clockIncrementMillis boundary
        clockTimerID = setTimeout("clockUpdate()",
            clockIncrementMillis - (serverTime.getTime() % clockIncrementMillis));
    }
}

/*** End of Clock ***/
//-->
</script>
<script language="JavaScript">
function getClockTime()
{	
	document.frmLog.txtTime.value = "<? echo clockTimeString($gDate)?>";
} // function getClockTime()

function checkEmpNmbr()
{
	window.location=("DTRLog.php?txtEmpNmbr="+document.frmLog.txtEmpNmbr.value);
}

function pageBehave()
{
	var strLogMsg = "<? echo $strLogMsg?>";
	var strNoEmpNmbr = "<? echo $txtEmpNmbr?>";
	
	if(strLogMsg)
	{		
		setTimeout("window.location=('SwipeLog.php')", 3000);   //invalid login and login confirmation
	}
	else if(!strNoEmpNmbr)
	{
		document.frmLog.txtEmpNmbr.focus();   //no employee number the cursor focus on txtEmpNmbr
	}
}
</script>
<style type="text/css">
<!--
.errmsg {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18pt;
	font-weight: bold;
	color: #FF0000;
}
-->
</style>
</head>
<body 
onLoad="pageBehave();history.forward();clockInit(clockLocalStartTime, clockServerStartTime);clockOnLoad();clockToggleSeconds();" scroll=no onContextMenu="return false"
onunload="clockOnUnload()">
<div align="center">
  <table height="550" width="750" border="0" cellpadding="0" cellspacing="0" class="background">
    <!--DWLayoutTable-->
    <tr> 
	<td width="60" height="550" rowspan="7" valign="top"><img src="images/sidebar.jpg"></td>
      <td align="center" valign="middle" height="50" class="date"><? echo date("F d, Y");?></td>
    </tr>
    <tr> 
      <td align="center" valign="middle" height="50" class="time">
	  <div id="ClockTime">
	  <? echo(clockTimeString($gDate));?>
	  </div>
	  </td>
    </tr>
	<tr><td align="center" valign="middle" height="50" class="errmsg"><? echo $strMsg;?></td></tr>
    <tr> 
      <td valign="middle" align="center" height="150">
	  <img src="EmployeeImage.php?strEmpNmbr=<? echo $txtEmpNmbr;?>" width="192" height="192"><br>
	  </td>
    </tr>
	<tr><td height="100" align="center" valign="top" class="name">
	<? $strName = $objLog->getName($txtEmpNmbr);
		echo $strName;?></td></tr>
	<tr><td valign="top" height="50">&nbsp;&nbsp;
	<input type="image" src="images/dtrpresent.jpg" onClick="document.frmLog.txtEmpNmbr.focus();window.open('EmployeeIn.php','_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=600,height=400');">
	<input type="image" src="images/dtrabsent.jpg" onClick="document.frmLog.txtEmpNmbr.focus();window.open('EmployeeAbsent.php','_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=600,height=400');">
	<input type="image" src="images/dtrleave.jpg" onClick="document.frmLog.txtEmpNmbr.focus();window.open('EmployeeOnLeave.php','_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=600,height=400');">
	<input type="image" src="images/dtrob.jpg" onClick="document.frmLog.txtEmpNmbr.focus();window.open('EmployeeOBTOTT.php','_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=600,height=400');">
	</td></tr>
  <form action="SwipeLog.php" method="get" name="frmLog" onSubmit="checkEmpNmbr();getClockTime();">
  <tr><td height="50" valign="top">
	  	<input name="txtEmpNmbr" type="password" size="1" class="barcode">
          <input type="hidden" name="txtTime">
	</td>
	</tr>
  </form>	
  </table>
</div>
</body>
</html>
