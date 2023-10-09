<?
/* 
File Name: Override.php 
----------------------------------------------------------------------
Purpose of this file: 
Override DTR of each employee
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: July 15, 2004
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

include("../hrmis/class/Security.php");
session_register('dayTo');
session_register('dayFrom');
session_register('arrDay');
session_register('sesPrcdPg');
require("../hrmis/class/Attendance.php");
$objAttendance = new Attendance;
$objAttendance->setvar(array('strEmpNmbr'=>$strEmpNmbr, 'txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>$cboMonth, 'cboYear'=>$cboYear, 'strLetter'=>$strLetter, 'p'=>$p)); //for maintain state
$arrEmpPersonal = $objAttendance->getEmpInfo($strEmpBrwsNmbr);

if($blnRemove == 1)
{
	$objAttendance->removeFromTable($strEmpBrwsNmbr, $cboMonth, $cboYear, $cboDay);
}

if($chkDate != 0)
{
	$_SESSION['arrDay'] = $chkDate;
	$objAttendance->trapCmpltTime($strEmpBrwsNmbr, $cboMonth, $cboYear, $chkDate, $btnOverride);
	if(strlen($_SESSION['ovrdErrMsg']) == 0)
	{
		switch($btnOverride)
		{
			case "OB":
				$objAttendance->trapHolidayWeekend($cboMonth, $cboYear, $chkDate);
				break;
		
			case "LEAVE":
				$objAttendance->trapHolidayWeekend($cboMonth, $cboYear, $chkDate);
				break;
			
			case "TRIP TICKET":
				$objAttendance->trapHolidayWeekend($cboMonth, $cboYear, $chkDate);
				break;
	
			case "TRAVEL ORDER":
				$objAttendance->trapHolidayWeekend($cboMonth, $cboYear, $chkDate);
				break;
				
			case "MEETING":
				$objAttendance->trapHolidayWeekend($cboMonth, $cboYear, $chkDate);
				break;
		
			case "ABSENT":
				$objAttendance->trapUncheckDay($chkDate);
				if(strlen($_SESSION['ovrdErrMsg']) == 0)
					$objAttendance->trapHolidayWeekend($cboMonth, $cboYear, $chkDate);
				if(strlen($_SESSION['ovrdErrMsg']) == 0)
					$objAttendance->trapAheadPresentDay($cboMonth, $cboYear, $chkDate);
				break;
		
			case "FLAG CEREMONY":
				$objAttendance->trapUncheckDay($chkDate);
				if(strlen($_SESSION['ovrdErrMsg']) == 0)
					$objAttendance->trapHolidayWeekend($cboMonth, $cboYear, $chkDate);
				if(strlen($_SESSION['ovrdErrMsg']) == 0)
					$objAttendance->trapNotMonday($cboMonth, $cboYear, $chkDate);
				if(strlen($_SESSION['ovrdErrMsg']) == 0)
					$objAttendance->trapAheadPresentDay($cboMonth, $cboYear, $chkDate);
				break;
			
			case "TIME":
				$objAttendance->trapUncheckDay($chkDate);
				
			/*	$blnAllowEdit = $objAttendance->permitOvertime($strEmpBrwsNmbr, $cboMonth, $cboYear, $chkDate);
				
				if($blnAllowEdit)
				{
					//allow the edit, dont pass on error trapping
				}
				else
				{   //no overtime so error trapping is needed 
					if(strlen($_SESSION['ovrdErrMsg']) == 0)
						$objAttendance->trapHolidayWeekend($cboMonth, $cboYear, $chkDate); */
					if(strlen($_SESSION['ovrdErrMsg']) == 0)
						$objAttendance->trapAheadPresentDay($cboMonth, $cboYear, $chkDate);
				//}
				break;
		}
	}
}

if(strlen($_SESSION['ovrdErrMsg']) == 0)
{
	switch($btnOverride)
	{
		case "FLAG CEREMONY":
			$objAttendance->overrideFlagCrmny($arrEmpPersonal["empNumber"], $cboMonth, $cboYear, $chkDate);
			break;

		case "ABSENT":
			$objAttendance->overrideAbsent($arrEmpPersonal["empNumber"], $cboMonth, $cboYear, $chkDate);
			break;

		case "TIME":
			$arrTime = $objAttendance->getDTRTime($arrEmpPersonal["empNumber"], $cboMonth, $cboYear, $chkDate);
			break;

		case "OVERRIDE TIME":
			$dtmTimeInAM = $objAttendance->combineHrMnSc($cboHourInAM, $cboMinInAM, $cboSecInAM);
			$dtmTimeOutAM = $objAttendance->combineHrMnSc($cboHourOutAM, $cboMinOutAM, $cboSecOutAM);
			$dtmTimeInPM = $objAttendance->combineHrMnSc($cboHourInPM, $cboMinInPM, $cboSecInPM);
			$dtmTimeOutPM = $objAttendance->combineHrMnSc($cboHourOutPM, $cboMinOutPM, $cboSecOutPM);
			$dtmTimeInOT = $objAttendance->combineHrMnSc($cboHourInOT, $cboMinInOT, $cboSecInOT);
			$dtmTimeOutOT = $objAttendance->combineHrMnSc($cboHourOutOT, $cboMinOutOT, $cboSecOutOT);
	
			$objAttendance->overrideTime($arrEmpPersonal["empNumber"], $cboMonth, $cboYear, $chkDate, $dtmTimeInAM, $dtmTimeOutAM, $dtmTimeInPM, $dtmTimeOutPM, $dtmTimeInOT, $dtmTimeOutOT);
			break;

		case "OVERRIDE OB":
			$dtmTimeFrom = $objAttendance->combineHrMnSc($cboHourFrom, $cboMinFrom, $cboSecFrom);
			$dtmTimeTo = $objAttendance->combineHrMnSc($cboHourTo, $cboMinTo, $cboSecTo);
			$objAttendance->overrideOB($arrEmpPersonal["empNumber"], $cboYearFrom, $cboMonthFrom, $cboDayFrom, $cboYearTo, $cboMonthTo, $cboDayTo, $dtmTimeFrom, $cboTimeFrom, $dtmTimeTo, $cboTimeTo, $txtPlace, $txtPurpose, $optOB);
			break;

		case "OVERRIDE LEAVE":
			if(strlen($cboYearTo) == 0 && strlen($cboMonthTo) == 0 && strlen($cboDayTo) == 0)
			{
				$cboYearTo = $cboYearFrom;
				$cboMonthTo = $cboMonthFrom;
				$cboDayTo = $cboDayFrom;
			}
			$objAttendance->overrideLeave($arrEmpPersonal["empNumber"], $cboLeaveType, $cboSpecifyLeave, $cboYearFrom, $cboMonthFrom, $cboDayFrom, $cboYearTo, $cboMonthTo, $cboDayTo, $txtReason, $optLeaveDay);
			break;

		case "OVERRIDE OVERTIME":
			$dtmTimeFrom = $objAttendance->combineHrMnSc($cboHourFrom, $cboMinFrom, $cboSecFrom);
			$dtmTimeTo = $objAttendance->combineHrMnSc($cboHourTo, $cboMinTo, $cboSecTo);		
			$objAttendance->overrideOvertime($arrEmpPersonal["empNumber"], $cboYearFrom, $cboMonthFrom, $cboDayFrom, $cboYearTo, $cboMonthTo, $cboDayTo, $dtmTimeFrom, $cboTimeFrom, $dtmTimeTo, $cboTimeTo, $txtPurpose, $txtOutput, $txtDocNmbr);
			break;
			
		case "OVERRIDE TRAVEL ORDER":
			$objAttendance->travelOrder($arrEmpPersonal["empNumber"], $txtDestination, $cboYearFrom, $cboMonthFrom, $cboDayFrom, $cboYearTo, $cboMonthTo, $cboDayTo, $txtPurpose, $cboFund, $cboTranspo, $optPerdiem);
			break;

		case "OVERRIDE TRIP TICKET":
			$objAttendance->tripTicket($arrEmpPersonal["empNumber"], $txtDestination, $cboYearFrom, $cboMonthFrom, $cboDayFrom, $cboYearTo, $cboMonthTo, $cboDayTo, $txtPurpose, $optPerdiem);
			break;

		case "OVERRIDE MEETING":
			$objAttendance->meeting($arrEmpPersonal["empNumber"], $txtMeeting, $cboYear, $cboMonth, $cboDay);
			break;
	}
	
	$objAttendance->getDayFromAndTo($_SESSION['arrDay']);

?>								  
<html><!-- InstanceBegin template="/Templates/Attendancetmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" --> 
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/class/JSgeneral.php");
include("../hrmis/javascript/Attendance.js");
?>

<script language="JavaScript">
var dtmAMPMOut

function changeSpecific()
{
	var strSearch = "<? echo $txtSearch?>";
	var strField = "<? echo $optField?>";
	var strEmpBrwsNmbr = "<? echo $strEmpBrwsNmbr?>";
	var strMonth = "<? echo $cboMonth?>";
	var strYear = "<? echo $cboYear?>";
	var strPage = "<? echo $btnOverride?>";
	var p = "<? echo $p?>";
	var strLetter = "<? echo $strLetter?>";
	var arrDay = "<? echo $_SESSION['arrDay']?>";
	var strLeave = document.frmOverride.cboLeaveType.value;
	var strEmpNmbr = "<? echo $strEmpNmbr?>"
	try
	{
		var strSpecify = document.frmOverride.cboSpecifyLeave.value;
	}
	catch(error)
	{
		var strSpecify = "";
	}
	
	window.location = "Override.php?strEmpBrwsNmbr="+strEmpBrwsNmbr+"&p="+p+"&strLetter="+strLetter+"&txtSearch="+strSearch+"&optField="+strField+"&cboMonth="+strMonth+"&cboYear="+strYear+"&cboLeaveType="+strLeave+"&cboSpecifyLeave="+strSpecify+"&btnOverride="+strPage+"&chkDate="+arrDay+"&strEmpNmbr="+strEmpNmbr;
}

function trapEntryLeave()
{
	var intMonthFrom, intMonthTo, intDayFrom, intDayTo, intYearFrom, intYearTo
	var intHourFrom, intHourTo, intMinFrom, intMinTo, intSecFrom, intSecTo, intTimeFrom, intTimeTo
	var dtmDateToday = new Date(<?php echo($objAttendance->getDateToday())?>);
	var strReason = document.all.txtReason.value 

	intMonthFrom = document.all.cboMonthFrom.value;
	try
	{
		intMonthTo = document.all.cboMonthTo.value;
	}
	catch(error)
	{
		intMonthTo = document.all.cboMonthFrom.value;
	}
	
	intDayFrom = document.all.cboDayFrom.value;	
	try
	{		
		intDayTo = document.all.cboDayTo.value;
	}
	catch(error)
	{
		intDayTo = document.all.cboDayFrom.value;
	}
	
	intYearFrom = document.all.cboYearFrom.value;
	try
	{
		intYearTo = document.all.cboYearTo.value;
	}
	catch(error)
	{
		intYearTo = document.all.cboYearFrom.value;
	}
	
	if(strReason.length == 0)
	{
		alert("Please enter a reason!");
		document.all.txtReason.focus();
		event.returnValue=false;
	}
	else if(intYearFrom > intYearTo)
	{
		alert("Please enter correct year from!");
		document.all.cboYearFrom.focus();
		event.returnValue=false;
	}
	else if(intYearFrom == intYearTo)
	{
		if(intMonthFrom == intMonthTo)
		{	
			if(intDayFrom > intDayTo)
			{
				alert("Please enter correct day from!");
				document.all.cboDayFrom.focus();
				event.returnValue=false;
			}				
		}
		else if(intMonthFrom > intMonthTo)
		{
			alert("Please enter correct month from!");
			document.all.cboMonthFrom.focus();
			event.returnValue=false;
		}
	}			
}

function trapEntryOB(t_strPlace, t_strErrorMsg, t_strPurpose, t_intMonthFrom, t_intMonthTo, t_intDayFrom, t_intDayTo, t_intYearFrom, t_intYearTo, t_intHourFrom, t_intHourTo, t_intMinFrom, t_intMinTo, t_intSecFrom, t_intSecTo, t_intTimeFrom, t_intTimeTo)
{
	var dtmDateToday = new Date(<?php echo($objAttendance->getDateToday())?>);
	
	var intMonthFrom = t_intMonthFrom.value;
	var intMonthTo = t_intMonthTo.value;		
	var intDayFrom = t_intDayFrom.value;
	var intDayTo = t_intDayTo.value;		
	var intYearFrom = t_intYearFrom.value;
	var intYearTo = t_intYearTo.value;

	var strPlace = t_strPlace.value;
	var strPurpose = t_strPurpose.value;
	
	var intHourFrom = t_intHourFrom.value;
	var intHourTo = t_intHourTo.value;		
	var intMinFrom = t_intMinFrom.value;
	var intMinTo = t_intMinTo.value;		
	var intSecFrom = t_intSecFrom.value;
	var intSecTo = t_intSecTo.value;
	var intTimeFrom = t_intTimeFrom.value;
	var intTimeTo = t_intTimeTo.value;
	if(strPlace.length == 0)
	{
		alert("Please enter "+t_strErrorMsg+"!");
		t_strPlace.focus();
		event.returnValue=false;
	}
	else if(strPurpose.length == 0)
	{
		alert("Please enter purpose!");
		t_strPurpose.focus();
		event.returnValue=false;
	}
	else if(intYearFrom > intYearTo || intYearFrom < dtmDateToday.getFullYear())
	{
		alert("Please enter correct year from!");
		document.all.cboYearFrom.focus();
		event.returnValue=false;
	}
	else if(intYearFrom == intYearTo)
	{
		if(intMonthFrom == intMonthTo)
		{	
			if(intDayFrom > intDayTo)
			{
				alert("Please enter correct day from!");
				document.all.cboDayFrom.focus();
				event.returnValue=false;
			}
			else
			{
				if (intTimeFrom == "PM" && intTimeTo == "AM")
				{
					alert("Please enter correct time from!");
					t_intTimeFrom.focus();
					event.returnValue=false;			
					
				}
				else if(intTimeFrom == intTimeTo)
				{
					if(intHourFrom == "00")
					{
						alert("Please enter correct time from!");
						t_intHourFrom.focus();
						event.returnValue=false;
					}
					else if(intHourTo == "00")
					{
						alert("Please enter correct time to!");
						t_intHourTo.focus();
						event.returnValue=false;
					}
					else if(intHourFrom == intHourTo)
					{
						if(intMinFrom == intMinTo)
						{
							if(intSecFrom >= intSecTo)
							{
								alert("Please enter correct time from!");
								t_intSecFrom.focus();
								event.returnValue=false;
							}
						}
						else if(intMinFrom > intMinTo)
						{
							alert("Please enter correct time from!");
							t_intMinFrom.focus();
							event.returnValue=false;
						}
					}
					else if((intHourFrom > intHourTo && intHourFrom != '12') || (intHourFrom < intHourTo && intHourTo == '12'))
					{
						alert("Please enter correct time from!");
						t_intHourFrom.focus();
						event.returnValue=false;
					}
				}
			}			
		}
		else if(intMonthFrom > intMonthTo || intMonthFrom < (dtmDateToday.getMonth()+1))
		{
			alert("Please enter correct month from!");
			document.all.cboMonthFrom.focus();
			event.returnValue=false;
		}
		else
		{		
			if (intTimeFrom == "PM" && intTimeTo == "AM")
			{
				alert("Please enter correct time from!");
				t_strTimeFrom.focus();
				event.returnValue=false;			
				
			}
			else if(intTimeFrom == intTimeTo)
			{
				if(intHourFrom == "00")
				{
					alert("Please enter correct time from!");
					t_intHourFrom.focus();
					event.returnValue=false;
				}
				else if(intHourTo == "00")
				{
					alert("Please enter correct time to!");
					t_intHourTo.focus();
					event.returnValue=false;
				}
				else if(intHourFrom == intHourTo)
				{
					if(intMinFrom == intMinTo)
					{
						if(intSecFrom >= intSecTo)
						{
							alert("Please enter correct time from!");
							t_intSecFrom.focus();
							event.returnValue=false;
						}
					}
					else if(intMinFrom > intMinTo)
					{
						alert("Please enter correct time from!");
						t_intMinFrom.focus();
						event.returnValue=false;
					}
				}
				else if((intHourFrom > intHourTo && intHourFrom != '12') || (intHourFrom < intHourTo && intHourTo == '12'))
				{
					alert("Please enter correct time from!");
					t_intHourFrom.focus();
					event.returnValue=false;
				}
			}
		}
	}
	else
	{	
		if (intTimeFrom == "PM" && intTimeTo == "AM")
		{
			alert("Please enter correct time from!");
			t_strTimeFrom.focus();
			event.returnValue=false;			
			
		}
		else if(intTimeFrom == intTimeTo)
		{
			if(intHourFrom == "00")
			{
				alert("Please enter correct time from!");
				t_intHourFrom.focus();
				event.returnValue=false;
			}
			else if(intHourTo == "00")
			{
				alert("Please enter correct time to!");
				t_intHourTo.focus();
				event.returnValue=false;
			}
			else if(intHourFrom == intHourTo)
			{
				if(intMinFrom == intMinTo)
				{
					if(intSecFrom >= intSecTo)
					{
						alert("Please enter correct time from!");
						t_intSecFrom.focus();
						event.returnValue=false;
					}
				}
				else if(intMinFrom > intMinTo)
				{
					alert("Please enter correct time from!");
					t_intMinFrom.focus();
					event.returnValue=false;
				}
			}
			else if((intHourFrom > intHourTo && intHourFrom != '12') || (intHourFrom < intHourTo && intHourTo == '12'))
			{
				alert("Please enter correct time from!");
				t_intHourFrom.focus();
				event.returnValue=false;
			}
		}
	}
}

function checkTimeInOut(t_dtmHrIn, t_dtmMnIn, t_dtmScIn, t_dtmHrOut, t_dtmMnOut, t_dtmScOut, t_intBatch)
{
	if(document.all.cboAMPMOutAM.value == "AM" || t_intBatch != 1)
	{	
		if(t_dtmHrIn.value == t_dtmHrOut.value)
		{
			if(t_dtmMnIn.value == t_dtmMnOut.value)
			{
				if(t_dtmScIn.value > t_dtmScOut.value)
				{
					t_dtmScIn.focus();
					return 1;
				}
				else
				{
					return 0;
				}
			}
			else if(t_dtmMnIn.value > t_dtmMnOut.value)
			{
				t_dtmMnIn.focus();
				return 1;
			}
			else
			{
				return 0;
			}
		}
		else if(t_dtmHrIn.value > t_dtmHrOut.value || (t_intBatch == 1 && t_dtmHrOut.value == 12))
		{	//AM in: 8:00:00 AM out: 12:00:00 AM mali!!!! khit more than ang out sa in mali yan.
			var intContinueError = 1
			if(t_intBatch == 2 && t_dtmHrIn.value == 12)
			{   //PM in: 12:00:00 PM out: 5:00:00 PM tama!!!! khit morethan ang out sa in tama yan
				intContinueError = 0
			}
			
			if(intContinueError)
			{
				t_dtmHrIn.focus();
				return 1;
			}
			else
			{
				return 0;
			}
		}
	}
}

function trapEntryTime(t_dtmHrInAM, t_dtmMnInAM, t_dtmScInAM, t_dtmHrOutAM, t_dtmMnOutAM, t_dtmScOutAM, t_dtmHrInPM, t_dtmMnInPM, t_dtmScInPM, t_dtmHrOutPM, t_dtmMnOutPM, t_dtmScOutPM, t_dtmHrInOT, t_dtmMnInOT, t_dtmScInOT, t_dtmHrOutOT, t_dtmMnOutOT, t_dtmScOutOT)
{
	var intError = 0;
	
	intError = checkTimeInOut(t_dtmHrInOT, t_dtmMnInOT, t_dtmScInOT, t_dtmHrOutOT, t_dtmMnOutOT, t_dtmScOutOT, 3)
	if(checkTimeInOut(t_dtmHrInPM, t_dtmMnInPM, t_dtmScInPM, t_dtmHrOutPM, t_dtmMnOutPM, t_dtmScOutPM, 2))
	{
		intError = checkTimeInOut(t_dtmHrInPM, t_dtmMnInPM, t_dtmScInPM, t_dtmHrOutPM, t_dtmMnOutPM, t_dtmScOutPM, 2)	
	}
	if(checkTimeInOut(t_dtmHrInAM, t_dtmMnInAM, t_dtmScInAM, t_dtmHrOutAM, t_dtmMnOutAM, t_dtmScOutAM, 1))
	{
		intError = checkTimeInOut(t_dtmHrInAM, t_dtmMnInAM, t_dtmScInAM, t_dtmHrOutAM, t_dtmMnOutAM, t_dtmScOutAM, 1)
	}
	if(intError)
	{
		alert("Please enter correct time from!");
		event.returnValue=false;
	}
}

function daysApplied(t_intDayFrom, t_intDayTo, t_strLeaveDay)
{
	var intDaysApp = t_intDayTo - t_intDayFrom + 1;
	
	if(t_strLeaveDay)
	{
		intDaysApp = intDaysApp * 0.5;
	}
	
	document.frmOverride.txtDaysApp.value = intDaysApp
}

function trapFormEntry(t_strDstntn, t_strPurpose, t_intMonthFrom, t_intYearFrom, t_intDayFrom, t_intMonthTo, t_intYearTo, t_intDayTo)
{
	var strDstntn = t_strDstntn.value
	var strPurpose = t_strPurpose.value
	var intMonthFrom = t_intMonthFrom.value
	var intMonthTo = t_intMonthTo.value
	var intYearFrom = t_intYearFrom.value
	var intYearTo = t_intYearTo.value
	var intDayFrom = t_intDayFrom.value
	var intDayTo = t_intDayTo.value
	if(strDstntn.length == 0)
	{
		alert("Please enter destination!");
		t_strDstntn.focus();
		event.returnValue=false;
	}	
	else if(strPurpose.length == 0)
	{
		alert("Please enter purpose!");
		t_strPurpose.focus();
		event.returnValue=false;
	}
	else if(intYearFrom > intYearTo)
	{
		alert("Please enter correct year from!");
		t_intYearFrom.focus();
		event.returnValue=false;
	}
	else if(intYearFrom == intYearTo)
	{
		if(intMonthFrom == intMonthTo)
		{	
			if(Number(intDayFrom) > Number(intDayTo))
			{
				alert("Please enter correct day from!");
				t_intDayFrom.focus();
				event.returnValue=false;
			}				
		}
		else if(intMonthFrom > intMonthTo)
		{
			alert("Please enter correct month from!");
			t_intMonthFrom.focus();
			event.returnValue=false;
		}
	}
}

function trapSingleEntry(t_strText, t_strNoValue)
{
	var strText = t_strText.value
	
	if(strText.length == 0)
	{
		alert("Please enter "+t_strNoValue+"!")
		t_strText.focus();
		event.returnValue=false;
	}
}
</script>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="hrmis.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" --> 
<link href="hrmis.css" rel="stylesheet" type="text/css">
<!-- InstanceEndEditable -->
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onContextMenu="return false" onLoad="history.forward();MM_preloadImages('images/compensationover.jpg','images/librariesover.jpg','images/reportsover.jpg','images/attendanceclick.jpg','images/201over.jpg','images/notificationover.jpg','images/attendance2.jpg','images/leavebalance2.jpg','images/updateleavebal2.jpg','images/leavemonetization2.jpg','images/terminalleave2.jpg','images/filedrequest2.jpg','images/dtr2.jpg','images/override2.jpg','images/logout2.jpg')">
<div align="center"> 
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr> 
    <td valign="bottom"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="INNERTBL">
        <tr> 
            <td width="30%" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td><img src="images/hrmodule.jpg" width="170" height="23"></td>
                </tr>
              </table></td>
            <td valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td valign="bottom"> 
                    <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Officer" && $t_strAccessPermission == 123456) 
{
?>
                    <table width="80%" border="0" align="right" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td width="35%"><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('NOTIFICATION','','images/notificationover.jpg',1);statusBar(); return true;"><img src="images/notification.jpg" alt="NOTIFICATION" name="NOTIFICATION" width="96" height="29" border="0"></a></td>
                        <td width="6%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('PROFILE','','images/201over.jpg',1);statusBar(); return true;"><img src="images/201.jpg" alt="PROFILE" name="PROFILE" width="67" height="29" border="0"></a></td>
                        <td width="16%"><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('ATTENDANCE','','images/attendanceclick.jpg',1);statusBar(); return true;"><img src="images/attendanceclick.jpg" alt="ATTENDANCE" name="ATTENDANCE" width="88" height="29" border="0"></a></td>
                        <td width="11%"><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('REPORTS','','images/reportsover.jpg',1);statusBar(); return true;"><img src="images/reports.jpg" alt="REPORTS" name="REPORTS" width="60" height="29" border="0"></a></td>
                        <td width="12%"><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('LIBRARIES','','images/librariesover.jpg',1);statusBar(); return true;"><img src="images/libraries.jpg" alt="LIBRARIES" name="LIBRARIES" width="67" height="29" border="0"></a></td>
                        <td width="20%"><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('COMPENSATION','','images/compensationover.jpg',1);statusBar(); return true;"><img src="images/compensation.jpg" alt="COMPENSATION" name="COMPENSATION" width="104" height="29" border="0"></a></td>
                      </tr>
                    </table>
                    <? } ?>
                  </td>
                </tr>
                <tr> 
                  <td valign="bottom"> 
                    <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 13) 
{
?>
                    <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td width="71%"><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('NOTIFICATION2','','images/notificationover.jpg',1);statusBar(); return true;"><img src="images/notification.jpg" alt="NOTIFICATION2" name="NOTIFICATION2" width="96" height="29" border="0"></a></td>
                        <td width="29%"><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('ATTENDANCE2','','images/attendanceclick.jpg',1);statusBar(); return true;"><img src="images/attendanceclick.jpg" alt="ATTENDANCE2" name="ATTENDANCE2" width="88" height="29" border="0"></a></td>
                      </tr>
                    </table>
                    <? } ?>
                  </td>
                </tr>
                <tr> 
                  <td valign="bottom"> 
                    <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 23) 
{
?>
                    <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('PROFILE3','','images/201over.jpg',1);statusBar(); return true;"><img src="images/201.jpg" alt="PROFILE3" name="PROFILE3" width="67" height="29" border="0"></a></td>
                        <td><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('ATTENDANCE3','','images/attendanceclick.jpg',1);statusBar(); return true;"><img src="images/attendanceclick.jpg" alt="ATTENDANCE3" name="ATTENDANCE3" width="88" height="29" border="0"></a></td>
                      </tr>
                    </table>
                    <? } ?>
                  </td>
                </tr>
                <tr> 
                  <td valign="bottom"> 
                    <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 34) 
{
?>
                    <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td width="65%"><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('ATTENDANCE4','','images/attendanceclick.jpg',1);statusBar(); return true;"><img src="images/attendanceclick.jpg" alt="ATTENDANCE4" name="ATTENDANCE4" width="88" height="29" border="0"></a></td>
                        <td width="35%"><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('REPORTS4','','images/reportsover.jpg',1);statusBar(); return true;"><img src="images/reports.jpg" alt="REPORTS4" name="REPORTS4" width="60" height="29" border="0"></a></td>
                      </tr>
                    </table>
                    <? } ?>
                  </td>
                </tr>
                <tr> 
                  <td valign="bottom"> 
                    <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 35) 
{
?>
                    <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td width="65%"><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('ATTENDANCE5','','images/attendanceclick.jpg',1);statusBar(); return true;"><img src="images/attendanceclick.jpg" alt="ATTENDANCE5" name="ATTENDANCE5" width="88" height="29" border="0"></a></td>
                        <td width="35%"><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('LIBRARIES5','','images/librariesover.jpg',1);statusBar(); return true;"><img src="images/libraries.jpg" alt="LIBRARIES5" name="LIBRARIES5" width="67" height="29" border="0"></a></td>
                      </tr>
                    </table>
                    <? } ?>
                  </td>
                </tr>
                <tr> 
                  <td valign="bottom"> 
                    <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 36) 
{
?>
                    <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td width="65%"><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('ATTENDANCE6','','images/attendanceclick.jpg',1);statusBar(); return true;"><img src="images/attendanceclick.jpg" alt="ATTENDANCE6" name="ATTENDANCE6" width="88" height="29" border="0"></a></td>
                        <td width="35%"><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('COMPENSATION6','','images/compensationover.jpg',1);statusBar(); return true;"><img src="images/compensation.jpg" alt="COMPENSATION6" name="COMPENSATION6" width="104" height="29" border="0"></a></td>
                      </tr>
                    </table>
                    <? } ?>
                  </td>
                </tr>
                <tr>
                  <td valign="bottom">
                    <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 3) 
{
?>
                    <table width="10%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblATTENDANCE">
                      <tr> 
                        <td width="65%"><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('ATTENDANCE61','','images/attendanceclick.jpg',1);statusBar(); return true;"><img src="images/attendanceclick.jpg" alt="ATTENDANCE6" name="ATTENDANCE61" width="88" height="29" border="0" id="ATTENDANCE61"></a></td>
                      </tr>
                    </table>
                    <? } ?>
                  </td>
                </tr>
                <tr>
                  <td valign="bottom">
                    <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == 1234567) 
{
?>
                    <table width="80%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblATTENDANCECASHIER">
                      <tr> 
                        <td width="35%"><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('NOTIFICATION1','','images/notificationover.jpg',1);statusBar(); return true;"><img src="images/notification.jpg" alt="NOTIFICATION" name="NOTIFICATION1" width="96" height="29" border="0" id="NOTIFICATION1"></a></td>
                        <td width="6%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('PROFILE1','','images/201over.jpg',1);statusBar(); return true;"><img src="images/201.jpg" alt="PROFILE" name="PROFILE1" width="67" height="29" border="0" id="PROFILE1"></a></td>
                        <td width="16%"><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('ATTENDANCE1','','images/attendanceclick.jpg',1);statusBar(); return true;"><img src="images/attendanceclick.jpg" alt="ATTENDANCE" name="ATTENDANCE1" width="88" height="29" border="0" id="ATTENDANCE1"></a></td>
                        <td width="11%"><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('REPORTS1','','images/reportsover.jpg',1);statusBar(); return true;"><img src="images/reports.jpg" alt="REPORTS" name="REPORTS1" width="60" height="29" border="0" id="REPORTS1"></a></td>
                        <td width="12%"><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('LIBRARIES1','','images/librariesover.jpg',1);statusBar(); return true;"><img src="images/libraries.jpg" alt="LIBRARIES" name="LIBRARIES1" width="67" height="29" border="0" id="LIBRARIES1"></a></td>
                        <td width="20%"><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('COMPENSATION1','','images/compensationover.jpg',1);statusBar(); return true;"><img src="images/compensation.jpg" alt="COMPENSATION" name="COMPENSATION1" width="104" height="29" border="0" id="COMPENSATION1"></a></td>
                      </tr>
                    </table>
                    <? } ?>
                  </td>
                </tr>
              </table></td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="8" colspan="2"><div align="center">Welcome <strong><? echo $_SESSION['strLoginName']; ?></strong>. 
          You are currently working at the HR Module.</div></td>
        </tr>
        <tr valign="top" bgcolor="#E9F3FE"> 
          <td height="8" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="16%" height="350"><table width="150" height="348" border="0" cellpadding="0" cellspacing="0" bgcolor="#E9F3FE">
                    <tr> 
                      <td valign="top"><table width="100%" height="350" border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td valign="top"><table width="90%" height="325" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="NAVTBL">
                                <tr>
                                  <td height="78" valign="top">
								  <form name="frmAttendance" method="get" action="Attendancesummary.php">
                                      <input name="txtSearch" type="text" id="txtSearch" size="15" maxlength="30" value="<? echo $txtSearch;?>">
                                      <a href="Attendancesummary.php?strEmpNmbr=<? echo $strEmpNmbr; ?>" onMouseOut="" onMouseOver=""><input type="image" src="images/go.jpg" alt="Go" name="Go" width="19" height="17" border="0" align="absmiddle" onClick="checkDate();"></a> 
                                      <br>
									  <?
									  $objAttendance->radioTwoOption("optField",$optField, "Employee Number", "empNmbr", "Employee Name", "empName", "<br>");
									  ?>
									  <br>
                                      Month 
                                      <select name="cboMonth" size="1">
										<?
										$objAttendance->comboMonth($cboMonth);
										?>
                                      </select>
                                      <br>
                                      Year&nbsp;&nbsp; 
                                      <select name="cboYear" size="1">
										<?
										$objAttendance->comboYear($cboYear);										
										?>
                                      </select>
                                      <br><input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr?>">
                                    </form></td>
                                </tr>
                                <tr> 
                                  
                              <td height="187" valign="top">
                                <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == 1234567) 
{
?>
                                <table width="109" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        
                                    <td width="109" height="13"><a href="Attendancesummary.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" 
																	onMouseOut="document.attendancesummary.src='images/attendance1.jpg'" 
																	onMouseOver="document.attendancesummary.src='images/attendance2.jpg'"> 
                                      </a><a href="Attendancesummary.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('AttendanceSummary','','images/attendance2.jpg',1); statusBar(); return true;"><img src="images/attendance1.jpg" alt="AttendanceSummary" name="AttendanceSummary" width="108" height="27" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        
                                    <td height="13"><a href="Leavebalance.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" 
														onMouseOut="document.leavebalance.src='images/leavebalance.jpg'" 
														onMouseOver="document.leavebalance.src='images/leavebalance2.jpg'"> 
                                      </a><a href="Leavebalance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('LeaveBalance','','images/leavebalance2.jpg',1);statusBar(); return true;"><img src="images/leavebalance.jpg" alt="LeaveBalance" name="LeaveBalance" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        
                                    <td height="13"><a href="Updateleavebalance.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" 
														onMouseOut="document.updateleavebalance.src='images/updateleavebal.jpg'" 
														onMouseOver="document.updateleavebalance.src='images/updateleavebal2.jpg'"> 
                                      </a><a href="Updateleavebalance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('UpdateLeaveBalance','','images/updateleavebal2.jpg',1);statusBar(); return true;"><img src="images/updateleavebal.jpg" alt="UpdateLeaveBalance" name="UpdateLeaveBalance" width="108" height="28" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        
                                    <td height="13"><a href="Monetization.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" 
														onMouseOut="document.leavemonetization.src='images/leavemonetization.jpg'" 
														onMouseOver="document.leavemonetization.src='images/leavemonetization2.jpg'"> 
                                      </a><a href="Monetization.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('LeaveMonetization','','images/leavemonetization2.jpg',1);statusBar(); return true;"><img src="images/leavemonetization.jpg" alt="LeaveMonetization" name="LeaveMonetization" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        
                                    <td height="13"><a href="TerminalLeave.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" 
														onMouseOut="document.terminalleave.src='images/terminalleave.jpg'" 
														onMouseOver="document.terminalleave.src='images/terminalleave2.jpg'"> 
                                      </a><a href="TerminalLeave.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore()"  onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('TerminalLeave','','images/terminalleave2.jpg',1);statusBar(); return true;"><img src="images/terminalleave.jpg" alt="TerminalLeave" name="TerminalLeave" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        
                                    <td height="13"><a href="FiledRequest.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>&strFR=OB" 
														onMouseOut="document.filedrequest.src='images/filedrequest.jpg'" 
														onMouseOver="document.filedrequest.src='images/filedrequest2.jpg'"> 
                                      </a><a href="FiledRequest.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>&strFR=OB" onMouseOut="MM_swapImgRestore()"  onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('FiledRequest','','images/filedrequest2.jpg',1);statusBar(); return true;"><img src="images/filedrequest.jpg" alt="FiledRequest" name="FiledRequest" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        
                                    <td height="13"><a href="DTR.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" 
														onMouseOut="document.dtr.src='images/dtr.jpg'" 
														onMouseOver="document.dtr.src='images/dtr2.jpg'"> 
                                      </a><a href="DTR.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore()"  onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('DailyTimeRecord','','images/dtr2.jpg',1);statusBar(); return true;"><img src="images/dtr.jpg" alt="DailyTimeRecord" name="DailyTimeRecord" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        
                                    <td height="13"><a href="Overridemodule.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboMonthFC=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&cboYearFC=<? echo $cboYear?>&p=<? echo $p?>&strOvrd=FC&strLetter=<? echo $strLetter?>" 
														onMouseOut="document.override.src='images/override.jpg'" 
														onMouseOver="document.override.src='images/override2.jpg'"> 
                                      </a><a href="Overridemodule.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboMonthFC=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&cboYearFC=<? echo $cboYear?>&p=<? echo $p?>&strOvrd=FC&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore()"  onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('Override','','images/override2.jpg',1);statusBar(); return true;"><img src="images/override.jpg" alt="Override" name="Override" width="108" height="20" border="0"></a></td>
                                      </tr>									  
                                      <tr> 
                                        
                                    <td height="13"><a href="index.php" 
														onMouseOut="document.logout.src='images/logout.jpg'" 
														onMouseOver="document.logout.src='images/logout2.jpg'"> 
                                      </a><a href="index.php" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('Logout','','images/logout2.jpg',1);statusBar(); return true;"><img src="images/logout.jpg" alt="Logout" name="Logout" width="108" height="20" border="0"></a></td>
                                      </tr>									  
                                    </table>
<? 
} else { 
?>
                                <table width="109" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                  <tr> 
                                    <td width="109" height="13"><a href="Attendancesummary.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" 
																	onMouseOut="document.attendancesummary.src='images/attendance1.jpg'" 
																	onMouseOver="document.attendancesummary.src='images/attendance2.jpg'"> 
                                      </a><a href="Attendancesummary.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('AttendanceSummary1','','images/attendance2.jpg',1);statusBar(); return true;"><img src="images/attendance1.jpg" alt="AttendanceSummary" name="AttendanceSummary1" width="108" height="27" border="0" id="AttendanceSummary1"></a></td>
                                  </tr>
                                  <tr> 
                                    <td height="13"><a href="Leavebalance.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" 
														onMouseOut="document.leavebalance.src='images/leavebalance.jpg'" 
														onMouseOver="document.leavebalance.src='images/leavebalance2.jpg'"> 
                                      </a><a href="Leavebalance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('LeaveBalance1','','images/leavebalance2.jpg',1);statusBar(); return true;"><img src="images/leavebalance.jpg" alt="LeaveBalance" name="LeaveBalance1" width="108" height="20" border="0" id="LeaveBalance1"></a></td>
                                  </tr>
                                  <tr> 
                                    <td height="13"><a href="Updateleavebalance.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" 
														onMouseOut="document.updateleavebalance.src='images/updateleavebal.jpg'" 
														onMouseOver="document.updateleavebalance.src='images/updateleavebal2.jpg'"> 
                                      </a><a href="Updateleavebalance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('UpdateLeaveBalance1','','images/updateleavebal2.jpg',1);statusBar(); return true;"><img src="images/updateleavebal.jpg" alt="UpdateLeaveBalance" name="UpdateLeaveBalance1" width="108" height="28" border="0" id="UpdateLeaveBalance1"></a></td>
                                  </tr>
                                  <tr> 
                                    <td height="13"><a href="Monetization.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" 
														onMouseOut="document.leavemonetization.src='images/leavemonetization.jpg'" 
														onMouseOver="document.leavemonetization.src='images/leavemonetization2.jpg'"> 
                                      </a><a href="Monetization.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('LeaveMonetization1','','images/leavemonetization2.jpg',1);statusBar(); return true;"><img src="images/leavemonetization.jpg" alt="LeaveMonetization" name="LeaveMonetization1" width="108" height="20" border="0" id="LeaveMonetization1"></a></td>
                                  </tr>
                                  <tr> 
                                    <td height="13"><a href="TerminalLeave.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" 
														onMouseOut="document.terminalleave.src='images/terminalleave.jpg'" 
														onMouseOver="document.terminalleave.src='images/terminalleave2.jpg'"> 
                                      </a><a href="TerminalLeave.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('TerminalLeave1','','images/terminalleave2.jpg',1);statusBar(); return true;"><img src="images/terminalleave.jpg" alt="TerminalLeave" name="TerminalLeave1" width="108" height="20" border="0" id="TerminalLeave1"></a></td>
                                  </tr>
                                  <tr> 
                                    <td height="13"><a href="FiledRequest.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>&strFR=OB" 
														onMouseOut="document.filedrequest.src='images/filedrequest.jpg'" 
														onMouseOver="document.filedrequest.src='images/filedrequest2.jpg'"> 
                                      </a><a href="FiledRequest.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>&strFR=OB" onMouseOut="MM_swapImgRestore()"  onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('FiledRequest1','','images/filedrequest2.jpg',1);statusBar(); return true;"><img src="images/filedrequest.jpg" alt="FiledRequest" name="FiledRequest1" width="108" height="20" border="0" id="FiledRequest1"></a></td>
                                  </tr>
                                  <tr> 
                                    <td height="13"><a href="DTR.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" 
														onMouseOut="document.dtr.src='images/dtr.jpg'" 
														onMouseOver="document.dtr.src='images/dtr2.jpg'"> 
                                      </a><a href="DTR.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore()"  onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('DailyTimeRecord1','','images/dtr2.jpg',1);statusBar(); return true;"><img src="images/dtr.jpg" alt="DailyTimeRecord" name="DailyTimeRecord1" width="108" height="20" border="0" id="DailyTimeRecord1"></a></td>
                                  </tr>
                                  <tr> 
                                    <td height="13"><a href="Overridemodule.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboMonthFC=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&cboYearFC=<? echo $cboYear?>&p=<? echo $p?>&strOvrd=FC&strLetter=<? echo $strLetter?>" 
														onMouseOut="document.override.src='images/override.jpg'" 
														onMouseOver="document.override.src='images/override2.jpg'"> 
                                      </a><a href="Overridemodule.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboMonthFC=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&cboYearFC=<? echo $cboYear?>&p=<? echo $p?>&strOvrd=FC&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore()"  onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('Override1','','images/override2.jpg',1);statusBar(); return true;"><img src="images/override.jpg" alt="Override" name="Override1" width="108" height="20" border="0" id="Override1"></a></td>
                                  </tr>
                                  <tr> 
                                    <td height="13"><a href="index.php" 
														onMouseOut="document.logout.src='images/logout.jpg'" 
														onMouseOver="document.logout.src='images/logout2.jpg'"> 
                                      </a><a href="index.php" onMouseOut="MM_swapImgRestore()"  onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('Logout1','','images/logout2.jpg',1);statusBar(); return true;"><img src="images/logout.jpg" alt="Logout" name="Logout1" width="108" height="20" border="0" id="Logout1"></a></td>
                                  </tr>
                                </table>
                                <? } ?>
                              </td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
                <td width="84%" valign="top"><table width="99%" height="329" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODYTBL">
                    <tr> 
                      
                  <td height="329"><!-- InstanceBeginEditable name="BODY" --> 
<? 
	$strMonthName = $objAttendance->intToMonthName($cboMonth);
	$strMonthFull = $objAttendance->intToMonthFull($cboMonth);
?>
                    <table width="99%" height="301" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td height="25" class="header"><p>OVERRIDE </p></td>
                          </tr>
                          <tr> 
                            <td height="84"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
                                <tr> 
                                  <td width="80%" height="74"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr bgcolor="#99CCFF" class="radio"> 
                                        <td width="20%" align="right">Employee No.:&nbsp;&nbsp;</td>
                                        <td width="80%"><strong><? echo $arrEmpPersonal["empNumber"]?></strong></td>
                                      </tr>
                                      <tr bgcolor="#99CCFF" class="radio"> 
                                        <td align="right">Name:&nbsp;&nbsp;</td>
                                        <td class="radio"><strong><? echo $arrEmpPersonal["surname"].", ".$arrEmpPersonal["firstname"]." ".$arrEmpPersonal["Middlename"]?></strong></td>
                                      </tr>
                                      <tr bgcolor="#99CCFF" class="radio"> 
                                        <td align="right">Division:&nbsp;&nbsp;</td>
                                        <td class="radio"><strong><? echo $arrEmpPersonal["divisionCode"]?></strong></td>
                                      </tr>
                                      <tr bgcolor="#99CCFF" class="radio"> 
                                        <td height="20" align="right">Pay Ending:&nbsp;&nbsp;</td>
                                        <?
										if(strlen($cboYear) != 0  && strlen($cboMonth) != 0)
										{
										?>
                                        <td class="radio"><strong><? echo $strMonthFull." ".$cboYear?></strong></td>
										<?
										}
										else
										{
										?>
										<td class="radio"><strong><? echo date('F')." ".date('Y')?></strong></td>
										<?
										}
										?>
                                      </tr>                                    </table></td>
                                  <td width="20%"><table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td align="right" height="70" bgcolor="#99CCFF"><img src="EmployeeImage.php?strEmpNmbr=<? echo $arrEmpPersonal["empNumber"];?>" width="70" height="70"></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td height="16"> <div align="center"> </div></td>
                          </tr>
                          <tr> 
                            <td height="21"><hr></td>
                          </tr>
<?
$arrOvrrdMsg = $objAttendance->warningMsgOvrrd($arrEmpPersonal["empNumber"], $cboYear, $cboMonth, $_SESSION['arrDay']);
if(is_array($arrOvrrdMsg) && $blnRemove != 1)
{
?>	
							<tr>
							<td align="center"><table width="80%" height="200">
							<tr><td class="errorsearch"><? echo $arrOvrrdMsg["message"]?></td></tr>
							<tr><td>
							<br><img src='images/indicator2.jpg' border='0'>
							<a href='Override.php?strEmpBrwsNmbr=<? echo $strEmpBrwsNmbr?>&cboDay=<? echo $arrOvrrdMsg["day"]?>&blnRemove=1&btnOverride=<? echo $btnOverride?><? echo $objAttendance->varstr?>'>Proceed</a>
							<br><br><img src='images/indicator2.jpg' border='0'>
							<a href='DTR.php?strEmpBrwsNmbr=<? echo $strEmpBrwsNmbr?><? echo $objAttendance->varstr?>'>Cancel</a>
							</td></tr>
							</table></td>
							</tr>
<?
}
else
{
?>
                          <tr> 
                            <td height="13"><font class="note">(*) denotes required field.</font></td>
                          </tr>
						  <form action="Override.php" method="get" name="frmOverride">						  
                          <tr> 
                            <td height="119"><div align="center">
<?
switch($btnOverride)
{		
	case "TIME":
?>
                                <table width="90%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCFF">
								  <tr>
									<td colspan='2' height="20">&nbsp;&nbsp;&nbsp;
									<? 
									echo $strMonthFull." ";
									if(count($chkDate))
									{
										foreach($chkDate as $intDate=>$value)
										{
											$strDay = $strDay.$intDate.", ";
										}
									}
									echo substr($strDay,0,-2)." ";
									echo $cboYear;
									?></td>
								  </tr>
							  <tr><td>
							  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							  Morning
							  </td></tr>								  
								  								  
                                  <tr> 
                                    <td class="paragraph" width="200" valign="middle"> Time In :&nbsp;&nbsp;</td>
                                    <td width="354"> 
									 Hour 
									<?
									if($arrTime["inAM"] != NULLTIME && $arrTime["inAM"] != 0)
									{
										$objAttendance->comboHour("cboHourInAM", date('h', strtotime($arrTime["inAM"])));
									?>&nbsp;&nbsp;
									 Min 
									 <?
										$objAttendance->comboMinSec("cboMinInAM", date('i', strtotime($arrTime["inAM"])));
									?>&nbsp;&nbsp;
									 Sec
									 <?
										$objAttendance->comboMinSec("cboSecInAM", date('s', strtotime($arrTime["inAM"])));
									}
									else
									{
										$objAttendance->comboHour("cboHourInAM");
									?>&nbsp;&nbsp;
									 Min 
									 <?
										$objAttendance->comboMinSec("cboMinInAM");
									?>&nbsp;&nbsp;
									 Sec
									 <?
										$objAttendance->comboMinSec("cboSecInAM");									
									}
									?>&nbsp;&nbsp;
									 <select name="cboAMPMInAM">
									 <option value="AM">AM</option>
									 </select>
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph" valign="middle"> Time Out :&nbsp;&nbsp;</td>
                                    <td> Hour 
										<?
									if($arrTime["outAM"] != NULLTIME && $arrTime["outAM"] != 0)
									{
											$objAttendance->comboHour("cboHourOutAM", date('h', strtotime($arrTime["outAM"])));
										?>&nbsp;&nbsp;
										 Min 
										 <?
											$objAttendance->comboMinSec("cboMinOutAM", date('i', strtotime($arrTime["outAM"])));
										?>&nbsp;&nbsp;
										 Sec
										 <?
											$objAttendance->comboMinSec("cboSecOutAM", date('s', strtotime($arrTime["outAM"])));
										?>&nbsp;&nbsp;
										<?
										$objAttendance->comboAMPM("cboAMPMOutAM", date('A', strtotime($arrTime["outAM"])));
									}
									else
									{
											$objAttendance->comboHour("cboHourOutAM");
										?>&nbsp;&nbsp;
										 Min 
										 <?
											$objAttendance->comboMinSec("cboMinOutAM");
										?>&nbsp;&nbsp;
										 Sec
										 <?
											$objAttendance->comboMinSec("cboSecOutAM");
										?>&nbsp;&nbsp;
										<?
										$objAttendance->comboAMPM("cboAMPMOutAM");
									}
										?>
                                    </td>
                                  </tr>
  				  <tr><td>
  				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  Afternoon
				  </td></tr>								  
								  
                                  <tr> 
                                    <td class="paragraph" valign="middle"> Time In :&nbsp;&nbsp;</td>
                                    <td> 
									Hour 
									<?
									if($arrTime["inPM"] != NULLTIME && $arrTime["inPM"] != 0)
									{
										$objAttendance->comboHour("cboHourInPM", date('h', strtotime($arrTime["inPM"])));
									?>&nbsp;&nbsp;
									 Min 
									 <?
										$objAttendance->comboMinSec("cboMinInPM", date('i', strtotime($arrTime["inPM"])));
									?>&nbsp;&nbsp;
									 Sec
									 <?
										$objAttendance->comboMinSec("cboSecInPM", date('s', strtotime($arrTime["inPM"])));
									}
									else
									{
										$objAttendance->comboHour("cboHourInPM");
									?>&nbsp;&nbsp;
									 Min 
									 <?
										$objAttendance->comboMinSec("cboMinInPM");
									?>&nbsp;&nbsp;
									 Sec
									 <?
										$objAttendance->comboMinSec("cboSecInPM");									
									}
									?>&nbsp;&nbsp; 
									<select name="cboAMPMInPM">
									 <option value="PM">PM</option>
									 </select>
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph" valign="middle"> Time Out :&nbsp;&nbsp;</td>
                                    <td> Hour 
									<?
									if($arrTime["outPM"] != NULLTIME && $arrTime["outPM"] != 0)
									{									
										$objAttendance->comboHour("cboHourOutPM", date('h', strtotime($arrTime["outPM"])));
									?>&nbsp;&nbsp;
									 Min 
									 <?
										$objAttendance->comboMinSec("cboMinOutPM", date('i', strtotime($arrTime["outPM"])));
									?>&nbsp;&nbsp;
									 Sec
									 <?
										$objAttendance->comboMinSec("cboSecOutPM", date('s', strtotime($arrTime["outPM"])));
									}
									else
									{
										$objAttendance->comboHour("cboHourOutPM");
									?>&nbsp;&nbsp;
									 Min 
									 <?
										$objAttendance->comboMinSec("cboMinOutPM");
									?>&nbsp;&nbsp;
									 Sec
									 <?
										$objAttendance->comboMinSec("cboSecOutPM");									
									}
									?>&nbsp;&nbsp;
									<select name="cboAMPMOutPM">
									 <option value="PM">PM</option>
									 </select>
                                    </td>
                                  </tr>
  				  <tr><td>
  				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  Overtime
				  </td></tr>								  
								  
                                  <tr> 
                                    <td class="paragraph" valign="middle"> Time In :&nbsp;&nbsp;</td>
                                    <td> 
									Hour 
									<?
									if($arrTime["inOT"] != NULLTIME && $arrTime["inOT"] != 0)
									{									
										$objAttendance->comboHour("cboHourInOT", date('h', strtotime($arrTime["inOT"])));
									?>&nbsp;&nbsp;
									 Min 
									 <?
										$objAttendance->comboMinSec("cboMinInOT", date('i', strtotime($arrTime["inOT"])));
									?>&nbsp;&nbsp;
									 Sec
									 <?
										$objAttendance->comboMinSec("cboSecInOT", date('s', strtotime($arrTime["inOT"])));
									}
									else
									{
										$objAttendance->comboHour("cboHourInOT");
									?>&nbsp;&nbsp;
									 Min 
									 <?
										$objAttendance->comboMinSec("cboMinInOT");
									?>&nbsp;&nbsp;
									 Sec
									 <?
										$objAttendance->comboMinSec("cboSecInOT");									
									}
									?>&nbsp;&nbsp;
									<select name="cboAMPMInOT">
									 <option value="PM">PM</option>
									 </select>
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph" valign="middle"> Time Out :&nbsp;&nbsp;</td>
                                    <td> 
									Hour 
									<?
									if($arrTime["outOT"] != NULLTIME && $arrTime["outOT"] != 0)
									{									
										$objAttendance->comboHour("cboHourOutOT", date('h', strtotime($arrTime["outOT"])));
									?>&nbsp;&nbsp;
									 Min 
									 <?
										$objAttendance->comboMinSec("cboMinOutOT", date('i', strtotime($arrTime["outOT"])));
									?>&nbsp;&nbsp;
									 Sec
									 <?
										$objAttendance->comboMinSec("cboSecOutOT", date('s', strtotime($arrTime["outOT"])));
									}
									else
									{
										$objAttendance->comboHour("cboHourOutOT");
									?>&nbsp;&nbsp;
									 Min 
									 <?
										$objAttendance->comboMinSec("cboMinOutOT");
									?>&nbsp;&nbsp;
									 Sec
									 <?
										$objAttendance->comboMinSec("cboSecOutOT");
									}
									?>&nbsp;&nbsp; 
									<select name="cboAMPMOutOT">
									 <option value="PM">PM</option>
									 </select>	
                                    </td>
                                  </tr>								  
								  <tr> 
									<td height="10" colspan="2">							  
									<input type="hidden" name="txtSearch" value="<? echo $txtSearch?>">
								  <input type="hidden" name="optField" value="<? echo $optField?>">
								  <input type="hidden" name="cboMonth" value="<? echo $cboMonth?>">
								  <input type="hidden" name="cboYear" value="<? echo $cboYear?>">
								  <input type="hidden" name="p" value="<? echo $p?>">
								  <input type="hidden" name="strLetter" value="<? echo $strLetter?>">
								<input type="hidden" name="strEmpBrwsNmbr" value="<? echo $strEmpBrwsNmbr?>">
								<input type="hidden" name="strEmpNmbr" value="<? echo $strEmpNmbr?>">
								</td>
								  </tr>						  								  
								  <tr>
									<td colspan="2" height="30" align="center" valign="middle" bgcolor="#C1E2FF"> 
										<input type="submit" name="btnOverride" value="OVERRIDE TIME" onClick="trapEntryTime(document.all.cboHourInAM, document.all.cboMinInAM, document.all.cboSecInAM, document.all.cboHourOutAM, document.all.cboMinOutAM, document.all.cboSecOutAM, document.all.cboHourInPM, document.all.cboMinInPM, document.all.cboSecInPM, document.all.cboHourOutPM, document.all.cboMinOutPM, document.all.cboSecOutPM, document.all.cboHourInOT, document.all.cboMinInOT, document.all.cboSecInOT, document.all.cboHourOutOT, document.all.cboMinOutOT, document.all.cboSecOutOT)">
									</td>
								  </tr>								  
                                </table>
<?
		break;
	case "OB":
?>
                                
                              <table width="90%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCFF">
                                <!--DWLayoutTable-->
                                <tr> 
                                  <td colspan="2" height="15"> </td>
                                </tr>
                                <tr> 
                                  <td height="19" valign="baseline" class="paragraph"> Official Business:&nbsp;&nbsp;&nbsp;</td>
                                  <td> <input type="radio" name="optOB" value="Y" checked>
                                    Yes 
                                    <input type="radio" name="optOB" value="N">
                                    No </td>
                                </tr>
                                <tr> 								
                                <tr> 
                                  <td width="150" height="25" valign="baseline" class="paragraph"> 
                                    Date From &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                  <td width="404" valign="top">Year: 
                                    <select name="cboYearFrom"  onChange="updateList(cboMonthFrom.selectedIndex,this[this.selectedIndex].text,'cboDayFrom')">
									<? 
									$objAttendance->comboYear($cboYear);
									?>
                                    </select>&nbsp;&nbsp;&nbsp;
									Month:&nbsp;<select name="cboMonthFrom" onChange="updateList(this.selectedIndex,cboYearFrom[cboYearFrom.selectedIndex].text,'cboDayFrom')">
									<?
									$objAttendance->comboMonth($cboMonth);
									?>																	  
                                    </select>&nbsp;&nbsp;&nbsp;
                                    Day: <select name="cboDayFrom" >
									<?
									$objAttendance->comboDay($_SESSION['dayFrom']);
									?>									
                                    </select></td>
                                </tr>
                                <tr> 
                                  <td width="150" height="25" valign="baseline" class="paragraph"> 
                                    Date To &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                  <td width="404" valign="top">Year: 
                                    <select name="cboYearTo" onChange="updateList(cboMonthTo.selectedIndex,this[this.selectedIndex].text,'cboDayTo')">
									<? 
									$objAttendance->comboYear($cboYear);									?>
                                    </select>&nbsp;&nbsp;&nbsp;
									Month:&nbsp;<select name="cboMonthTo" onChange="updateList(this.selectedIndex,cboYearTo[cboYearTo.selectedIndex].text,'cboDayTo')">
									<?
									$objAttendance->comboMonth($cboMonth);
									?>																	  
                                    </select>&nbsp;&nbsp;&nbsp;
                                    Day: <select name="cboDayTo">
									<?
									$objAttendance->comboDay($_SESSION['dayTo']);
									?>									
                                    </select></td>
                                </tr>
                                <tr> 
                                  <td height="25" valign="baseline" class="paragraph"> Time From:&nbsp;&nbsp;&nbsp;</td>
                                  <td> Hour 
							<?
								$objAttendance->comboHour("cboHourFrom");
							?>&nbsp;&nbsp;
							 Min 
							 <?
								$objAttendance->comboMinSec("cboMinFrom");
							?>&nbsp;&nbsp;
							 Sec
							 <?
								$objAttendance->comboMinSec("cboSecFrom");
							?>&nbsp;&nbsp;
                                    &nbsp;
									<select name="cboTimeFrom">
                                      <option value="AM">AM</option>
                                      <option value="PM">PM</option>
                                    </select>
								</td>
                                </tr>
                                <tr> 
                                  <td height="19" valign="baseline" class="paragraph"> Time To:&nbsp;&nbsp;&nbsp;</td>
                                  <td> Hour 
								<?
									$objAttendance->comboHour("cboHourTo");
								?>&nbsp;&nbsp;
								 Min 
								 <?
									$objAttendance->comboMinSec("cboMinTo");
								?>&nbsp;&nbsp;
								 Sec
								 <?
									$objAttendance->comboMinSec("cboSecTo");
								?>&nbsp;&nbsp; 
								  &nbsp;<select name="cboTimeTo">
                                      <option value="AM">AM</option>
                                      <option value="PM" selected>PM</option>
                                    </select>
                                  </td>
                                </tr>
                                <tr> 
                                  <td height="19" valign="baseline" class="paragraph"> Place:&nbsp;&nbsp;&nbsp;</td>
                                  <td> <input name="txtPlace" type="text" size="20" maxlength="100" value="">
								  <font class="note">*</font>
                                  </td>
                                </tr>
                                <tr> 
                                  <td height="19" valign="top" class="paragraph"> Purpose:&nbsp;&nbsp;&nbsp;</td>
                                  <td> <textarea name="txtPurpose" cols="20"></textarea>
                                    <font class="note">* </font></td>
                                </tr>
                                <tr> 
                                  <td height="19" colspan="2"> <input type="hidden" name="txtSearch" value="<? echo $txtSearch?>"> 
                                    <input type="hidden" name="optField" value="<? echo $optField?>"> 
                                    <input type="hidden" name="cboMonth" value="<? echo $cboMonth?>"> 
                                    <input type="hidden" name="cboYear" value="<? echo $cboYear?>"> 
									<input type="hidden" name="p" value="<? echo $p?>">
									<input type="hidden" name="strLetter" value="<? echo $strLetter?>">
									<input type="hidden" name="strEmpBrwsNmbr" value="<? echo $strEmpBrwsNmbr?>">
									<input type="hidden" name="strEmpNmbr" value="<? echo $strEmpNmbr?>">
                                  </td>
                                </tr>
                                <tr> 
                                  <td colspan="2" height="30" align="center" valign="middle" bgcolor="#C1E2FF"> 
                                    <input type="submit" name="btnOverride" value="OVERRIDE OB" onClick="trapEntryOB(txtPlace, 'place', txtPurpose, cboMonthFrom, cboMonthTo, cboDayFrom, cboDayTo, cboYearFrom, cboYearTo, cboHourFrom, cboHourTo, cboMinFrom, cboMinTo, cboSecFrom, cboSecTo, cboTimeFrom, cboTimeTo)"> 
                                  </td>
                                </tr>
                              </table>
<?		
		break;
	case "LEAVE":
?>
                              <table width="90%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCFF">
                                <!--DWLayoutTable-->
                                <tr> 
                                  <td colspan="2" height="15"></td>
                                </tr>
                                <tr> 
                                  <td colspan="2" valign="baseline" class="title">
								  <div align="center">
								  Certify Leave Credits as of <? echo $strMonthFull." ".$cboYear?> <br>
								  <?
									$intVL = $objAttendance->getLeftSLVL($cboMonth, $cboYear, $arrEmpPersonal["empNumber"], "VL");
									
									if($intVL < 0)
									{
										$intVL = 0;
									}
									
									$intSL = $objAttendance->getLeftSLVL($cboMonth, $cboYear, $arrEmpPersonal["empNumber"], "SL");									  
	
									if($intSL < 0)
									{
										$intSL = 0;						
									}
									
									$intPL = $objAttendance->accmltLeave($arrEmpPersonal["empNumber"], $cboYear, "PL");
									
									if($intVL > 10)
									{
										$intFL = $objAttendance->accmltLeave($arrEmpPersonal["empNumber"], $cboYear, "FL");
									}
									else
									{
										$intFL = 0;
									}
								  ?>
								  Vacation Leave Left: <? echo number_format($intVL, 3, '.','');?><br>
								  Sick Leave Left: <? echo number_format($intSL, 3, '.','');?><br>
								  Privilege Leave Left: <? echo number_format($intPL, 3, '.','');?><br>
								  Force Leave Left: <? echo number_format($intFL, 3, '.','');?><br>
								  <br>
								  </div>
								  </td>
                                </tr>								
                                <tr> 
                                  <td height="25" valign="baseline" class="paragraph"> Type of Leave:&nbsp;&nbsp;&nbsp;</td>
                                  <td><select name="cboLeaveType" onChange="changeSpecific();">
<?
$objAttendance->comboLeaveType($cboLeaveType, $strEmpBrwsNmbr, $cboMonth, $cboYear);
?>
                                    </select> </td>
                                </tr>
<?
$intSpcfcLeave = $objAttendance->checkSpecificLeave($cboLeaveType);
if($intSpcfcLeave != 0)
{
?>
                                <tr> 
                                  <td height="25" valign="baseline" class="paragraph"> Specific Type of Leave:&nbsp;&nbsp;&nbsp;</td>
                                  <td>
								  <select name="cboSpecifyLeave" onChange="changeSpecific();">
<?
$objAttendance->comboSpecifyLeave("cboSpecifyLeave", $cboSpecifyLeave, $cboLeaveType, 'changeSpecific();');   //specific leave type eg: birthday, hospital
?>
								</select>
                                  </td>
                                </tr>
<?
}
?>
								<tr>
                                  <td height="25" valign="baseline" class="paragraph"></td>
                                  <td>
<?
if($cboSpecifyLeave == 'Personal Milestone')
{
	$objAttendance->radioTwoOption("optLeaveDay", $optLeaveDay, "Whole day", "W", "Half day", "H", "&nbsp;&nbsp;&nbsp;", "daysApplied(cboDayFrom.selectedIndex, cboDayFrom.selectedIndex, optLeaveDay[1].checked)");
}
else
{
	$objAttendance->radioTwoOption("optLeaveDay", $optLeaveDay, "Whole day", "W", "Half day", "H", "&nbsp;&nbsp;&nbsp;", "daysApplied(cboDayFrom.selectedIndex, cboDayTo.selectedIndex, optLeaveDay[1].checked)");
}
?>
									</td>
								</tr>
<?
if($cboSpecifyLeave == 'Personal Milestone')
{
?>
                                <tr> 
                                  <td width="150" height="25" valign="baseline" class="paragraph"> 
                                    Date &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                  <td width="404" valign="top">Year: 
                                    <select name="cboYearFrom" onChange="updateList(cboMonthFrom.selectedIndex,this[this.selectedIndex].text,'cboDayFrom')">
									<? 
									$objAttendance->comboYear($cboYear);
									?>
                                    </select>&nbsp;&nbsp;&nbsp;
									Month:&nbsp;<select name="cboMonthFrom" onChange="updateList(this.selectedIndex,cboYearFrom[cboYearFrom.selectedIndex].text,'cboDayFrom')">
									<?
									$objAttendance->comboMonth($cboMonth);
									?>																	  
                                    </select>&nbsp;&nbsp;&nbsp;
                                    Day: <select name="cboDayFrom" >
									<?
									$objAttendance->comboDay($_SESSION['dayFrom']);
									?>									
                                    </select></td>
                                </tr>

<?
}
else
{
?>								
                                <tr> 
                                  <td width="150" height="25" valign="baseline" class="paragraph"> 
                                    Date From &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                  <td width="404" valign="top">Year: 
                                    <select name="cboYearFrom" onChange="updateList(cboMonthFrom.selectedIndex,this[this.selectedIndex].text,'cboDayFrom')">
									<? 
									$objAttendance->comboYear($cboYear);
									?>
                                    </select>&nbsp;&nbsp;&nbsp;
									Month:&nbsp;<select name="cboMonthFrom" onChange="updateList(this.selectedIndex,cboYearFrom[cboYearFrom.selectedIndex].text,'cboDayFrom')">
									<?
									$objAttendance->comboMonth($cboMonth);
									?>																	  
                                    </select>&nbsp;&nbsp;&nbsp;
                                    Day: <select name="cboDayFrom"  onChange="daysApplied(this.selectedIndex, cboDayTo.selectedIndex, optLeaveDay[1].checked)">
									<?
									$objAttendance->comboDay($_SESSION['dayFrom']);
									?>									
                                    </select></td>
                                </tr>
                                <tr> 
                                  <td width="150" height="25" valign="baseline" class="paragraph"> 
                                    Date To &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                  <td width="404" valign="top">                                    Year: 
                                    <select name="cboYearTo" onChange="updateList(cboMonthTo.selectedIndex,this[this.selectedIndex].text,'cboDayTo')">
									<? 
									$objAttendance->comboYear($cboYear);
									?>
                                    </select>&nbsp;&nbsp;&nbsp;
									Month:&nbsp;<select name="cboMonthTo" onChange="updateList(this.selectedIndex,cboYearTo[cboYearFrom.selectedIndex].text,'cboDayTo')">
									<?
									$objAttendance->comboMonth($cboMonth);
									?>																	  
                                    </select>&nbsp;&nbsp;&nbsp;
                                    Day: <select name="cboDayTo" onChange="daysApplied(cboDayFrom.selectedIndex, this.selectedIndex, optLeaveDay[1].checked)">
									<?
									$objAttendance->comboDay($_SESSION['dayTo']);
									?>									
                                    </select></td>
                                </tr>
<?
}
?>								
                                <tr> 
                                  <td height="19" valign="top" class="paragraph"> # of Day(s) Applied:&nbsp;&nbsp;&nbsp;</td>
                                  <td> 
								  <?
								  $intDaysApp = $_SESSION['dayTo'] - $_SESSION['dayFrom'] + 1;
								  ?>
								  <input type="text" name="txtDaysApp" maxlength="2" size="2" readonly value="<? echo $intDaysApp?>">
								  <font class="note">*</font>
								  </td>
                                </tr>
                                <tr> 
                                  <td height="19" valign="top" class="paragraph"> Specify Reason(s):&nbsp;&nbsp;&nbsp;</td>
                                  <td> <textarea name="txtReason" cols="20"></textarea>
								  <font class="note">*</font>
								  </td>
                                </tr>
                                <tr> 
                                  <td height="19" colspan="2"> 
								  <input type="hidden" name="txtSearch" value="<? echo $txtSearch?>"> 
                                    <input type="hidden" name="optField" value="<? echo $optField?>"> 
                                    <input type="hidden" name="cboMonth" value="<? echo $cboMonth?>"> 
                                    <input type="hidden" name="cboYear" value="<? echo $cboYear?>"> 
									<input type="hidden" name="p" value="<? echo $p?>">
									<input type="hidden" name="strLetter" value="<? echo $strLetter?>">
									<input type="hidden" name="strEmpBrwsNmbr" value="<? echo $strEmpBrwsNmbr?>">
									<input type="hidden" name="strEmpNmbr" value="<? echo $strEmpNmbr?>">
                                  </td>
                                </tr>
                                <tr> 
                                  <td colspan="2" height="30" align="center" valign="middle" bgcolor="#C1E2FF"> 
                                    <input type="submit" name="btnOverride" value="OVERRIDE LEAVE" onClick="trapEntryLeave()"> 
                                  </td>
                                </tr>
                              </table>
<?
		break;
		case "OVERTIME":

?>					
							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="titlebar">
                                      <tr bgcolor="#99CCFF"><td height="10" colspan="2"></td></tr>
									  <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" width="30%" height="45">Purpose:&nbsp;</td>
                                        
                                    <td width="70%">
                                      <textarea name="txtPurpose"></textarea>
									  <font class="note">*</font></td>
                                      </tr>									  									  
                                      <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" height="45">Expected Output:&nbsp;</td>
                                        <td><textarea name="txtOutput"></textarea>
										<font class="note">*</font></td>
                                      </tr>
									  <tr bgcolor="#99CCFF">
									  <td align="right" class="paragraph" height="45">Document Number:&nbsp;</td>
									  <td><input type="text" name="txtDocNmbr"></td>
									  </tr>
                                      <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" height="25" valign="middle">Date From:&nbsp;</td>
                                        <td>Year: 
                                    <select name="cboYearFrom" onChange="updateList(cboMonthFrom.selectedIndex,this[this.selectedIndex].text,'cboDayFrom')">
									<? 
									$objAttendance->comboYear($cboYear);
									?>
                                    </select>&nbsp;&nbsp;&nbsp;
									Month:&nbsp;<select name="cboMonthFrom" onChange="updateList(this.selectedIndex,cboYearFrom[cboYearFrom.selectedIndex].text,'cboDayFrom')">
									<?
									$objAttendance->comboMonth($cboMonth);
									?>																	  
                                    </select>&nbsp;&nbsp;&nbsp;
                                    Day: <select name="cboDayFrom" >
									<?
									$objAttendance->comboDay($_SESSION['dayFrom']);
									?>									
                                    </select></td>
                                      </tr>
                                      <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" height="25" valign="middle">Date To:&nbsp;</td>
                                        <td>Year: 
                                    <select name="cboYearTo" onChange="updateList(cboMonthTo.selectedIndex,this[this.selectedIndex].text,'cboDayTo')">
									<? 
									$objAttendance->comboYear($cboYear);									?>
                                    </select>&nbsp;&nbsp;&nbsp;
									Month:&nbsp;<select name="cboMonthTo" onChange="updateList(this.selectedIndex,cboYearFrom[cboYearTo.selectedIndex].text,'cboDayTo')">
									<?
									$objAttendance->comboMonth($cboMonth);
									?>																	  
                                    </select>&nbsp;&nbsp;&nbsp;
                                    Day: <select name="cboDayTo">
									<?
									$objAttendance->comboDay($_SESSION['dayTo']);
									?>									
                                    </select>
                                    </td>
                                      </tr>
                                      <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" height="25" valign="middle">Time From:&nbsp;</td>
                                        <td>Hour 
							<?
								$objAttendance->comboHour("cboHourFrom");
							?>&nbsp;&nbsp;
							 Min 
							 <?
								$objAttendance->comboMinSec("cboMinFrom");
							?>&nbsp;&nbsp;
							 Sec
							 <?
								$objAttendance->comboMinSec("cboSecFrom");
							?>&nbsp;&nbsp;
                                    &nbsp;
							<?
							$dtmDateFrom = $objAttendance->combineDate($cboYear, $cboMonth, $_SESSION['dayTo']);
							$strDay = date("D", strtotime($dtmDateFrom));
							if($strDay == "Sat" || $strDay == "Sun")
							{
							?>
									
									<select name="cboTimeFrom">
                                      <option value="AM">AM</option>
                                      <option value="PM">PM</option>
                                    </select>
							<?
							}
							else
							{
							?>
									<select name="cboTimeFrom">
                                      <option value="PM">PM</option>
                                    </select>							
							<?
							}
							?>
							</td>
                                      </tr>
                                      <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" height="25" valign="middle">Time To:&nbsp;</td>
                                        <td>Hour 
								<?
									$objAttendance->comboHour("cboHourTo");
								?>&nbsp;&nbsp;
								 Min 
								 <?
									$objAttendance->comboMinSec("cboMinTo");
								?>&nbsp;&nbsp;
								 Sec
								 <?
									$objAttendance->comboMinSec("cboSecTo");
								?>&nbsp;&nbsp; 
								  &nbsp;
							<?
							$dtmDateFrom = $objAttendance->combineDate($cboYear, $cboMonth, $_SESSION['dayTo']);
							$strDay = date("D", strtotime($dtmDateFrom));
							if($strDay == "Sat" || $strDay == "Sun")
							{
							?>
								  
								  <select name="cboTimeTo">
                                      <option value="AM">AM</option>
                                      <option value="PM">PM</option>
                                    </select>
							<?
							}
							else
							{
							?>
								  <select name="cboTimeTo">
                                      <option value="PM">PM</option>
                                    </select>
							<?
							}
							?>
							</td>
                                      </tr>
									  <tr bgcolor="#99CCFF">
									  <td align="center" class="title" colspan="2" height="10" valign="middle">
								  <input type="hidden" name="txtSearch" value="<? echo $txtSearch?>"> 
                                    <input type="hidden" name="optField" value="<? echo $optField?>"> 
                                    <input type="hidden" name="cboMonth" value="<? echo $cboMonth?>"> 
                                    <input type="hidden" name="cboYear" value="<? echo $cboYear?>"> 
									<input type="hidden" name="p" value="<? echo $p?>">
									<input type="hidden" name="strLetter" value="<? echo $strLetter?>">
									<input type="hidden" name="strEmpBrwsNmbr" value="<? echo $strEmpBrwsNmbr?>">
									<input type="hidden" name="strEmpNmbr" value="<? echo $strEmpNmbr?>">									  
									  </td>
									  </tr>
									<tr> 
                                        <td align="center" class="title" colspan="2" height="30" valign="middle">
										<input type="submit" name="btnOverride" value="OVERRIDE OVERTIME" onClick="trapEntryOB(txtOutput, 'expected output', txtPurpose, cboMonthFrom, cboMonthTo, cboDayFrom, cboDayTo, cboYearFrom, cboYearTo, cboHourFrom, cboHourTo, cboMinFrom, cboMinTo, cboSecFrom, cboSecTo, cboTimeFrom, cboTimeTo)">
										</td>
                                      </tr>									  
                                    </table>
<?
			break;
		case "TRIP TICKET":

?>	
							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="titlebar">
                                      <tr bgcolor="#99CCFF"><td height="10" colspan="2"></td></tr>
									  <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" width="30%">Destination:&nbsp;</td>
                                    <td width="70%">
                                      <input type="text" name="txtDestination">
									  <font class="note">*</font></td>
                                      </tr>									  									  
                                      <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" height="25" valign="middle">Date From:&nbsp;</td>
                                        <td>Year: 
                                    <select name="cboYearFrom" onChange="updateList(cboMonthFrom.selectedIndex,this[this.selectedIndex].text,'cboDayFrom')">
									<? 
									$objAttendance->comboYear($cboYear);
									?>
                                    </select>&nbsp;&nbsp;&nbsp;
									Month:&nbsp;<select name="cboMonthFrom" onChange="updateList(this.selectedIndex,cboYearFrom[cboYearFrom.selectedIndex].text,'cboDayFrom')">
									<?
									$objAttendance->comboMonth($cboMonth);
									?>																	  
                                    </select>&nbsp;&nbsp;&nbsp;
                                    Day: <select name="cboDayFrom" >
									<?
									$objAttendance->comboDay($_SESSION['dayFrom']);
									?>									
                                    </select></td>
                                      </tr>
                                      <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" height="25" valign="middle">Date To:&nbsp;</td>
                                        <td>Year: 
                                    <select name="cboYearTo" onChange="updateList(cboMonthTo.selectedIndex,this[this.selectedIndex].text,'cboDayTo')">
									<? 
									$objAttendance->comboYear($cboYear);									?>
                                    </select>&nbsp;&nbsp;&nbsp;
									Month:&nbsp;<select name="cboMonthTo" onChange="updateList(this.selectedIndex,cboYearFrom[cboYearTo.selectedIndex].text,'cboDayTo')">
									<?
									$objAttendance->comboMonth($cboMonth);
									?>																	  
                                    </select>&nbsp;&nbsp;&nbsp;
                                    Day: <select name="cboDayTo">
									<?
									$objAttendance->comboDay($_SESSION['dayTo']);
									?>									
                                    </select></td>
                                      </tr>
                                      <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" height="45">Purpose:&nbsp;</td>
                                        <td><textarea name="txtPurpose"></textarea>
										<font class="note">*</font></td>
                                      </tr>
                                      <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" height="25" valign="middle">Will Claim Perdiem:&nbsp;</td>
                                        <td>
									  <?
									  $objAttendance->radioTwoOption("optPerdiem",$optPerdiem, "Yes", "Y", "No", "N", "&nbsp;");
									  ?>
									</td>
                                      </tr>
									  <tr bgcolor="#99CCFF">
									  <td align="center" class="title" colspan="2" height="10" valign="middle">
								  <input type="hidden" name="txtSearch" value="<? echo $txtSearch?>"> 
                                    <input type="hidden" name="optField" value="<? echo $optField?>"> 
                                    <input type="hidden" name="cboMonth" value="<? echo $cboMonth?>"> 
                                    <input type="hidden" name="cboYear" value="<? echo $cboYear?>"> 
									<input type="hidden" name="p" value="<? echo $p?>">
									<input type="hidden" name="strLetter" value="<? echo $strLetter?>">
									<input type="hidden" name="strEmpBrwsNmbr" value="<? echo $strEmpBrwsNmbr?>">
									<input type="hidden" name="strEmpNmbr" value="<? echo $strEmpNmbr?>">									  
									  </td>
									  </tr>									  									  
									<tr> 
                                        <td align="center" class="title" colspan="2" height="30" valign="middle">
										<input type="submit" name="btnOverride" value="OVERRIDE TRIP TICKET"  onClick="trapFormEntry(txtDestination, txtPurpose, cboMonthFrom, cboYearFrom, cboDayFrom, cboMonthTo, cboYearTo, cboDayTo)">
										</td>
                                      </tr>									  
                                    </table>
<?
			break;
		case "TRAVEL ORDER":

?>	
							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="titlebar">
                                      <tr bgcolor="#99CCFF"><td height="10" colspan="2"></td></tr>
									  <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" width="30%">Destination:&nbsp;</td>
                                    <td width="70%">
                                      <input type="text" name="txtDestination">
									  <font class="note">*</font></td>
                                      </tr>									  									  
                                      <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" height="25" valign="middle">Date From:&nbsp;</td>
                                        <td>Year: 
                                    <select name="cboYearFrom"  onChange="updateList(cboMonthFrom.selectedIndex,this[this.selectedIndex].text,'cboDayFrom')">
									<? 
									$objAttendance->comboYear($cboYear);
									?>
                                    </select>&nbsp;&nbsp;&nbsp;
									Month:&nbsp;<select name="cboMonthFrom" onChange="updateList(this.selectedIndex,cboYearFrom[cboYearFrom.selectedIndex].text,'cboDayFrom')">
									<?
									$objAttendance->comboMonth($cboMonth);
									?>																	  
                                    </select>&nbsp;&nbsp;&nbsp;
                                    Day: <select name="cboDayFrom" >
									<?
									$objAttendance->comboDay($_SESSION['dayFrom']);
									?>									
                                    </select></td>
                                      </tr>
                                      <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" height="25" valign="middle">Date To:&nbsp;</td>
                                        <td>Year: 
                                    <select name="cboYearTo" onChange="updateList(cboMonthTo.selectedIndex,this[this.selectedIndex].text,'cboDayTo')">
									<? 
									$objAttendance->comboYear($cboYear);									?>
                                    </select>&nbsp;&nbsp;&nbsp;
									Month:&nbsp;<select name="cboMonthTo" onChange="updateList(this.selectedIndex,cboYearFrom[cboYearTo.selectedIndex].text,'cboDayTo')">
									<?
									$objAttendance->comboMonth($cboMonth);
									?>																	  
                                    </select>&nbsp;&nbsp;&nbsp;
                                    Day: <select name="cboDayTo">
									<?
									$objAttendance->comboDay($_SESSION['dayTo']);
									?>									
                                    </select></td>
                                      </tr>
                                      <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" height="45">Purpose:&nbsp;</td>
                                        <td><textarea name="txtPurpose"></textarea>
										<font class="note">*</font></td>
                                      </tr>
                                      <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" height="25" valign="middle">Source of Fund:&nbsp;</td>
                                        <td>
										<select name="cboFund">
                                      <option value="Fund 101">Fund 101</option>
                                      <option value="Fund 202">Fund 202</option>
                                    </select>
									</td>
                                      </tr>									  
                                      <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" height="25" valign="middle">Transportation:&nbsp;</td>
                                        <td>
										<select name="cboTranspo">
                                      <option value="Official Vehicle">Official 
                                      Vehicle</option>
                                      <option value="Non-agency">Non-agency</option>
                                      <option value="Personal">Personal</option>
                                    </select>
									</td>
                                      </tr>									  
                                      <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" height="25" valign="middle">Will Claim Perdiem:&nbsp;</td>
                                        <td>
									  <?
									  $objAttendance->radioTwoOption("optPerdiem",$optPerdiem, "Yes", "Y", "No", "N", "&nbsp;");
									  ?>
									</td>
                                      </tr>
									  <tr bgcolor="#99CCFF">
									  <td align="center" class="title" colspan="2" height="10" valign="middle">
								  <input type="hidden" name="txtSearch" value="<? echo $txtSearch?>"> 
                                    <input type="hidden" name="optField" value="<? echo $optField?>"> 
                                    <input type="hidden" name="cboMonth" value="<? echo $cboMonth?>"> 
                                    <input type="hidden" name="cboYear" value="<? echo $cboYear?>"> 
									<input type="hidden" name="p" value="<? echo $p?>">
									<input type="hidden" name="strLetter" value="<? echo $strLetter?>">
									<input type="hidden" name="strEmpBrwsNmbr" value="<? echo $strEmpBrwsNmbr?>">
									<input type="hidden" name="strEmpNmbr" value="<? echo $strEmpNmbr?>">									  
									  </td>
									  </tr>									  									  
									<tr> 
                                        <td align="center" class="title" colspan="2" height="30" valign="middle">
										<input type="submit" name="btnOverride" value="OVERRIDE TRAVEL ORDER" onClick="trapFormEntry(txtDestination, txtPurpose, cboMonthFrom, cboYearFrom, cboDayFrom, cboMonthTo, cboYearTo, cboDayTo)">
										</td>
                                      </tr>									  
                                    </table>
<?
			break;
		case "MEETING":

?>	
							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="titlebar">
                                      <tr bgcolor="#99CCFF"><td height="40" colspan="2"></td></tr>
									  <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" width="30%" height="25">Title Meeting:&nbsp;</td>
                                    <td width="70%">
                                      <input name="txtMeeting" type="text">
									  <font class="note">*</font></td>
                                      </tr>									  									  
                                      <tr bgcolor="#99CCFF"> 
                                        <td align="right" class="paragraph" height="25" valign="middle">Date :&nbsp;</td>
                                        <td>Year: 
                                    <select name="cboYear" onChange="updateList(cboMonth.selectedIndex,this[this.selectedIndex].text,'cboDay')">
									<? 
									$objAttendance->comboYear($cboYear);
									?>
                                    </select>&nbsp;&nbsp;&nbsp;
									Month:&nbsp;<select name="cboMonth" onChange="updateList(this.selectedIndex,cboYearFrom[cboYearFrom.selectedIndex].text,'cboDayFrom')">
									<?
									$objAttendance->comboMonth($cboMonth);
									?>																	  
                                    </select>&nbsp;&nbsp;&nbsp;
                                    Day: <select name="cboDay">
									<?
									$objAttendance->comboDay($_SESSION['dayTo']);
									?>									
                                    </select></td>
                                      </tr>
									  <tr bgcolor="#99CCFF">
									  <td align="center" class="title" colspan="2" height="45" valign="middle">
								    <input type="hidden" name="txtSearch" value="<? echo $txtSearch?>"> 
                                    <input type="hidden" name="optField" value="<? echo $optField?>"> 
                                    <input type="hidden" name="cboMonth" value="<? echo $cboMonth?>"> 
                                    <input type="hidden" name="cboYear" value="<? echo $cboYear?>"> 
									<input type="hidden" name="p" value="<? echo $p?>">
									<input type="hidden" name="strLetter" value="<? echo $strLetter?>">
									<input type="hidden" name="strEmpBrwsNmbr" value="<? echo $strEmpBrwsNmbr?>">
									<input type="hidden" name="strEmpNmbr" value="<? echo $strEmpNmbr?>">									  
									  </td>
									  </tr>
									<tr> 
                                        <td align="center" class="title" colspan="2" height="30" valign="middle">
										<input type="submit" name="btnOverride" value="OVERRIDE MEETING" onClick="trapSingleEntry(txtMeeting, 'meeting title')">
										</td>
                                      </tr>									  
                                    </table>
<?
			break;
	}   //end of switch
}   //end of continue page
}
?>			
                              </div></td>
                          </tr>
						 </form>
                        </table>

					  <!-- InstanceEndEditable --></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="20" colspan="2"><table width="100%" height="20" border="0" cellpadding="0" cellspacing="0" bgcolor="#002E7F" id="OUTERTBL4">
              <tr> 
                <td height="13"><div align="center"> 
                    <p class="login"><font color="#FFFFFF">Copyright &copy; 2003 
                      Department of Science and Technology</font></p>
                  </div></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</div>
</body>
<!-- InstanceEnd --></html>
