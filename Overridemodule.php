<?
/* 
File Name: Overridemodule.php 
----------------------------------------------------------------------
Purpose of this file: 
Override many employees
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
session_register('arrayEmpNmbr');
require("../hrmis/class/Attendance.php");
$objAttendance = new Attendance;
$objAttendance->setvar(array('txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>$cboMonth, 'cboYear'=>$cboYear, 'strLetter'=>$strLetter)); //for maintain state
$arrEmpPersonal = $objAttendance->checkGetEmpNmbr("Attendance", $txtSearch, $optField, $cboMonth, $cboYear, 1, $p, $strLetter);

if(count($cboEmpSelected) != 0)
{
	$_SESSION['arrayEmpNmbr'] = $cboEmpSelected;
}
if($strLink)
{
	$_SESSION['arrayEmpNmbr'] = array();
}

if($btnOverride)
{
	switch($strOvrd)
	{
		case "FC":
			$_SESSION['arrayEmpNmbr'] = $cboEmpSelected;
			$strOvrd = $objAttendance->setEmpFlagCeremony($cboMonthFC, $cboDayFC, $cboYearFC, $cboEmpSelected);
			break;

		case "OB":
			$_SESSION['arrayEmpNmbr'] = $cboEmpSelected;
			$dtmTimeFrom = $objAttendance->combineHrMnSc($cboHourFrom, $cboMinFrom, $cboSecFrom);
			$dtmTimeTo = $objAttendance->combineHrMnSc($cboHourTo, $cboMinTo, $cboSecTo);
			$strOvrd = $objAttendance->setEmpOB($cboEmpSelected, $cboYearFrom, $cboMonthFrom, $cboDayFrom, $cboYearTo, $cboMonthTo, $cboDayTo, $dtmTimeFrom, $cboTimeFrom, $dtmTimeTo, $cboTimeTo, $txtPlace, $txtPurpose, $optOB);
			break;
			
		case "DTR":
			$_SESSION['arrayEmpNmbr'] = $cboEmpSelected;
			$objAttendance->excludedInDTR($cboEmpSelected);
			$strOvrd = "The selected employees has been removed from the daily time record";
			break;
	}
	$_SESSION['arrayEmpNmbr'] = array();
}
elseif($btnSubmit == 'EditFC')
{
	$dtmFCDate = $objAttendance->editPrvFC();
	$cboMonthFC = date('n', strtotime($dtmFCDate));
	$cboDayFC = date('j', strtotime($dtmFCDate));
	$cboYearFC = date('Y', strtotime($dtmFCDate));
}
elseif($btnSubmit == 'EditDTR')
{
	$objAttendance->retrieveExcludedInDTR();
}
?>
<html><!-- InstanceBegin template="/Templates/Attendancetmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="hrmis.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->
<?
include("../hrmis/class/JSgeneral.php");
include("../hrmis/javascript/Attendance.js");
?>

<script language="JavaScript">

function changeDay(month,year,target)
{
	 var monthLength = new Array(31,28,31,30,31,30,31,31,30,31,30,31)
     var obj = document.getElementById(target)
     monthLength[1] = 28
     if(year % 4 == 0 && year % 100 != 0)
          monthLength[1] = 29
     if(year % 400 == 0)
          monthLength[1] = 29
     obj.length = 0
     for(i = 1; i < monthLength[month]; i++)
     {
          dtmDate = new Date(year, month, i, 00, 00, 00);
		  if(dtmDate.getUTCDay() == 0)
		  {
			  obj.length++
			  obj[obj.length - 1].text = i
		  }
     }
}

function addOption(selectObject,optionText,optionValue) 
{
    var optionObject = new Option(optionText,optionValue)
    var optionRank = selectObject.options.length
	
    selectObject.options[optionRank]=optionObject
}

function testAdd() 
{
	var formObject = document.manyOverride, formSelected, form
	var intList, intSelected, intFlag = 1, intObject
	
	for(intObject=0; intObject<formObject.length; intObject++)
	{
		if(formObject.elements[intObject].type=='select-multiple' && formObject.elements[intObject].name=='cboEmpSelected[]') 
		{	
			formSelected = formObject.elements[intObject]
		}
	}
	if(formObject.cboEmpNmbr.selectedIndex != -1)
	{
		for(intList = 0; intList < formObject.cboEmpNmbr.options.length; intList++)
		{
			if (formObject.cboEmpNmbr.options[intList].selected) 
			{
				
				for(intSelected = 0; intSelected < formSelected.options.length; intSelected++)
				{
					if(formObject.cboEmpNmbr.options[intList].value == formSelected.options[intSelected].value)
					{
						alert("Already selected!")
						intFlag = 0;
					}
				}
				
				if(intFlag)
				{
					addOption(formSelected,formObject.cboEmpNmbr.options[intList].text,formObject.cboEmpNmbr.options[intList].value)
				}	
			} 			
			intFlag=1;   //add the last piece
		}
	}
	else 
	{
		alert("Select an option and click Add")
	}			
}

function testDelete() 
{
    var formObject = document.manyOverride
	var intSelected, formSelected, intObject

	for(intObject=0; intObject<formObject.length; intObject++)
	{
		if(formObject.elements[intObject].type=='select-multiple' && formObject.elements[intObject].name=='cboEmpSelected[]') 
		{	
			formSelected = formObject.elements[intObject]
		}
	}

	if(formSelected.selectedIndex != -1)
	{	
		for(intSelected = 0; intSelected < formSelected.options.length; intSelected++)
		{
			if (formSelected.options[intSelected].selected) 
			{
				formSelected.options[intSelected] = null
				intSelected = -1;	
			}	
		}
	}
	else 
	{
		alert("Select an option and click Add")
	}
	showEmpOfDivOfSec()			
}

function selectAllSelected()
{
    var formObject = document.manyOverride
	var intSelected, formSelected, intObject

	for(intObject=0; intObject<formObject.length; intObject++)
	{
		if(formObject.elements[intObject].type=='select-multiple' && formObject.elements[intObject].name=='cboEmpSelected[]') 
		{	
			formSelected = formObject.elements[intObject]
		}
	}

	for(intSelected = 0; intSelected < formSelected.options.length; intSelected++)
	{
		formSelected.options[intSelected].selected = true
	}
}

function selectAllEmployees(t_objEmp)
{
	var intSelected, formSelected, intObject

	for(intSelected = 0; intSelected < t_objEmp.options.length; intSelected++)
	{
		t_objEmp.options[intSelected].selected = true
	}
}

function showSelectCombo(t_strSelection)
{
	var strOvrd = "<? echo $strOvrd?>"
	var strEmpNmbr = "<? echo $strEmpNmbr?>"
	window.location = "Overridemodule.php?cboSelection="+t_strSelection+"&strOvrd="+strOvrd+"&strEmpNmbr="+strEmpNmbr;
}

function showEmpOfDivOfSec()
{
	selectAllSelected()
	document.manyOverride.submit();
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
					else if(intHourFrom > intHourTo)
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
				else if(intHourFrom > intHourTo)
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
			else if(intHourFrom > intHourTo)
			{
				alert("Please enter correct time from!");
				t_intHourFrom.focus();
				event.returnValue=false;
			}
		}
	}
}

</script>
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
					  <table width="100%" cellpadding="0" cellspacing="0">
					  <tr><td height="20"><p class="header">OVERRIDE</p></td></tr>
					  <tr><td height="20">
					  
					  <table width="90%" align="center" cellpadding="0" cellspacing="0">
					  <tr><td class="radio">
					  <a href="Overridemodule.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strOvrd=FC&cboMonthFC=<? echo $cboMonth?>&cboYearFC=<? echo $cboYear?>&strLink=1" onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();">
					  <?
					  $objAttendance->alterArrow($strOvrd, "FC");
					  ?>
					  &nbsp;&nbsp;Flag Ceremony</a>					  
					  </td></tr>
					  <tr><td class="radio">
					  <a href="Overridemodule.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strOvrd=OB&strLink=1&cboMonthFrom=<? echo $cboMonth?>&cboYearFrom=<? echo $cboYear?>&cboMonthTo=<? echo $cboMonth?>&cboYearTo=<? echo $cboYear?>"  onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();">
					  <?
					  $objAttendance->alterArrow($strOvrd, "OB");
					  ?>					  
					  &nbsp;&nbsp;Official Business</a>
					  </td></tr>
					  <tr><td class="radio">
					  <a href="Overridemodule.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strOvrd=DTR&strLink=1&cboMonthFrom=<? echo $cboMonth?>&cboYearFrom=<? echo $cboYear?>&cboMonthTo=<? echo $cboMonth?>&cboYearTo=<? echo $cboYear?>" onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();">
					  <?
					  $objAttendance->alterArrow($strOvrd, "DTR");
					  ?>					  
					  &nbsp;&nbsp;Exclude in DTR</a>
					  </td></tr>
					  <tr><td height="20"></td></tr>
					  <tr><td>
					  <form action="Overridemodule.php" method="get" name="manyOverride">
					  
<? 
if($strOvrd == "OB" || $strOvrd == "FC" || $strOvrd == "DTR")
{
?>					  
					  <table cellpadding="0" cellspacing="0" width="100%">
					  <tr><td><hr></td></tr>
					  <tr>
                                      <td height="30" class="radio"><strong>First:</strong> 
                                        Select type of employees from the dropdown. 
                                        If Per Division or Per Section is selected, 
                                        another dropdown will appear to choose 
                                        division or section.  
										<? if($strOvrd == "FC")
										{
										?>
										To edit the previous 
                                        flag ceremony entry, please click 
										<a href="Overridemodule.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strOvrd=FC&btnSubmit=EditFC">here</a>.</td>
										<?
										}
										elseif($strOvrd == "DTR")
										{
										?>
										To edit the recent 
										excluded DTR list, please click <a href="Overridemodule.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strOvrd=DTR&btnSubmit=EditDTR">here</a>.
										<?
										}
										?>
                                    </tr>
					  <tr><td height="15"></td></tr>
					  <tr><td height="30">Select Employees: <select name="cboSelection" onChange="showSelectCombo(document.all.cboSelection.value)">
                                                      <?
										  if($cboSelection == "All Employees")
										  {
										  ?>
                                                      <option value="All Employees" selected>All 
                                                      Employees</option>
                                                      <?
										  }
										  else
										  {
										  ?>
                                                      <option value="All Employees">All 
                                                      Employees</option>
                                                      <?
										  }
										  
										  if($cboSelection == "Per Division")
										  {
										  ?>
                                                      <option value="Per Division" selected>Per 
                                                      Division</option>
                                                      <?
										  }
										  else
										  {
										  ?>
                                                      <option value="Per Division">Per 
                                                      Division</option>
                                                      <?
										  }
										  
										  if($cboSelection == "Per Section")
										  {										  
										  ?>
                                                      <option value="Per Section" selected>Per 
                                                      Section</option>
                                                      <?
										  }
										  else
										  {
										  ?>
                                                      <option value="Per Section">Per 
                                                      Section</option>
                                                      <?
										  }
										  ?>
                                                    </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 									<? 	
									if($cboSelection == "Per Division")
									{								
										echo "Select Division: ";
										$objAttendance->comboDivision("cboDivision", $cboDivision, "showEmpOfDivOfSec()");
									}
									else if($cboSelection == "Per Section")
									{
										echo "Select Section: ";
										$objAttendance->comboSection("cboSection", $cboSection, "showEmpOfDivOfSec()");	
									}
									?>

						</td></tr>
						<tr><td height="60">
						<table cellpadding="0" cellspacing="0" width="100%">
						<tr><td height="60">
						<p><br>
						Highlight employees <br>
						For multiple selections,<br>
						PC: hold down <Ctrl> key<br>
						MAC: hold down <Command> key <br>
						</p>
						Employees: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a onClick="selectAllEmployees(document.manyOverride.cboEmpNmbr)" href="#">Select All</a><br>
						<? 
						$objAttendance->comboEmployee("cboEmpNmbr", $cboSelection, $cboDivision);
						?>
						</td>
						<td align="center" valign="middle">
						<p align="left">Click the Add button to add<br>selected employee(s)</p>
						<p>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<input name="btnSubmit" type="button" value="Add >>" onclick="testAdd()">
						</p>
						<p>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<input name='btnSubmit' type='button' value='<< Remove' onclick="testDelete()">
						</p>
						</td><td>
						<p>
						To remove employee(s)<br>from your selected employees<br>
						highlight the employee(s)<br>you would like to remove<br>
						then click the up remove button.<br>
						</p>
						Selected Employees: <br>
<?
					 $intArrElmt = count($_SESSION['arrayEmpNmbr']);
					 if($intArrElmt != 0)
					 {
					 	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
						echo "<select name='cboEmpSelected[]' size='10' multiple>";
					 	foreach($_SESSION['arrayEmpNmbr'] as $key=>$strEmplyNmbr)
					  	{
							$objEmpName = mysql_query("SELECT firstname, surname 
														FROM tblEmpPersonal
														WHERE empNumber='$strEmplyNmbr'");
							$arrEmpName = mysql_fetch_array($objEmpName);
							echo "<option value='$strEmplyNmbr'> $strEmplyNmbr | ".
							$arrEmpName['surname'].", ".$arrEmpName['firstname'].
							"</option>";
					  	}
						echo "</select>";
					}
					else
					{
					 	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
						echo "<select name='cboEmpSelected[]' size='10' multiple>";
						echo "</select>";
					}
					  ?>						
						</td></tr>
						</table></td></tr>
					  <tr><td colspan="4" height="20" valign="middle" align="right"></td></tr>
					  </table>
<?
}
?>
					  <table cellpadding="0" cellspacing="0" width="100%">
<?
switch($strOvrd)
{
	case "FC":
?>					  
					  <tr><td colspan="4" align="center" height="10" valign="bottom"><hr></td></tr>
					  <tr class="radio">
                                      <td height="35" colspan="2"><b>Then:</b> 
                                        Select month, year and day from the date 
                                        combo boxes below.</td>
                      </tr>					  
					  <tr>
					  	<td valign="middle" height="20" align="center" colspan="2">
						Year: &nbsp;&nbsp;
						<select name="cboYearFC" onChange="changeDay(cboMonthFC.selectedIndex,this[this.selectedIndex].text,'cboDayFC')">
						<? 
						$objAttendance->comboYear($cboYearFC);
						?>
						</select>&nbsp;&nbsp;&nbsp;&nbsp;Month: &nbsp;&nbsp; 
						<select name="cboMonthFC" onChange="changeDay(this.selectedIndex,cboYearFC[cboYearFC.selectedIndex].text,'cboDayFC')">
						<? 
						$objAttendance->comboMonth($cboMonthFC);
						?>
                        </select>&nbsp;&nbsp;&nbsp;Day: &nbsp;&nbsp;
                        <?
						if(strlen($cboMonthFC) == 0 && strlen($cboYearFC) == 0 && strlen($cboDayFC) == 0)
						{
							$cboMonthFC = date('n');
							$cboYearFC = date('Y');
						}
						$objAttendance->comboMonday("cboDayFC", $cboMonthFC, $cboYearFC, $cboDayFC);
						?>
                         </td>
					  </tr>
					  <tr class="radio">
					  <td height="10" colspan="2">
  					<input type="hidden" name="txtSearch" value="<? echo $txtSearch?>">
				  <input type="hidden" name="optField" value="<? echo $optField?>">
				  <input type="hidden" name="cboMonth" value="<? echo $cboMonth?>">
				  <input type="hidden" name="cboYear" value="<? echo $cboYear?>">
				  <input type="hidden" name="p" value="<? echo $p?>">
				  <input type="hidden" name="strOvrd" value="<? echo $strOvrd?>">
				<input type="hidden" name="strEmpNmbr" value="<? echo $strEmpNmbr?>">
					</td>
					  </tr>
					  <tr><td colspan="4" align="center" height="10" valign="bottom"><hr></td></tr>
<?
		break;
		
	case "OB":
?>
					  <tr><td colspan="4" align="center" height="10" valign="bottom"><hr></td></tr>
					  <tr class="radio">
                        <td height="25" colspan="2"><b>Then:</b> Fill-up the official business form. </td>
                      </tr>					  
                                <tr> 
                                  <td height="19" valign="baseline" class="paragraph"> Official Business:&nbsp;&nbsp;&nbsp;</td>
                                  <td> <?
								   $objAttendance->radioTwoOption("optOB", $optOB, "Yes", "Y", "No", "N", "&nbsp;&nbsp;&nbsp;");
								   ?></td>
                                </tr>
                                <tr> 								
                                <tr> 
                                  <td width="150" height="25" valign="baseline" class="paragraph"> 
                                    Date From: &nbsp;&nbsp;</td>
                                  <td width="404" valign="top">Year 
                                    <select name="cboYearFrom" onChange="updateList(cboMonthFrom.selectedIndex,this[this.selectedIndex].text,'cboDayFrom')">
									<? 
									$objAttendance->comboYear($cboYearFrom);
									?>
                                    </select>&nbsp;&nbsp;&nbsp;
									Month&nbsp;<select name="cboMonthFrom" onChange="updateList(this.selectedIndex,cboYearFrom[cboYearFrom.selectedIndex].text,'cboDayFrom')">
									<?
									$objAttendance->comboMonth($cboMonthFrom);
									?>																	  
                                    </select>&nbsp;&nbsp;&nbsp;
                                    Day <select name="cboDayFrom">
									<?
									$objAttendance->comboDay($cboDayFrom);
									?>									
                                    </select></td>
                                </tr>
                                <tr> 
                                  <td width="150" height="25" valign="baseline" class="paragraph"> 
                                    Date To: &nbsp;&nbsp;</td>
                                  <td width="404" valign="top">Year 
                                    <select name="cboYearTo" onChange="updateList(cboMonthTo.selectedIndex,this[this.selectedIndex].text,'cboDayTo')">
									<? 
									$objAttendance->comboYear($cboYearTo);
									?>
                                    </select>&nbsp;&nbsp;&nbsp;
									Month&nbsp;<select name="cboMonthTo" onChange="updateList(this.selectedIndex,cboYearFrom[cboYearTo.selectedIndex].text,'cboDayTo')">
									<?
									$objAttendance->comboMonth($cboMonthTo);
									?>																	  
                                    </select>&nbsp;&nbsp;&nbsp;
                                    Day <select name="cboDayTo">
									<?
									$objAttendance->comboDay($cboDayTo);
									?>									
                                    </select></td>
                                </tr>
                                <tr> 
                                  <td height="25" valign="baseline" class="paragraph"> Time From:&nbsp;&nbsp;&nbsp;</td>
                                  <td>Hour 
							<?
								$objAttendance->comboHour("cboHourFrom", $cboHourFrom);
							?>&nbsp;&nbsp;
							 Min 
							 <?
								$objAttendance->comboMinSec("cboMinFrom", $cboMinFrom);
							?>&nbsp;&nbsp;
							 Sec
							 <?
								$objAttendance->comboMinSec("cboSecFrom", $cboSecFrom);
							?>&nbsp;&nbsp;
                                    &nbsp;
							<? 
							$objAttendance->comboAMPM("cboTimeFrom", $cboTimeFrom)
							?> 
									</td>
                                </tr>
                                <tr> 
                                  <td height="19" valign="baseline" class="paragraph"> Time To:&nbsp;&nbsp;&nbsp;</td>
                                  <td> Hour 
								<?
									$objAttendance->comboHour("cboHourTo", $cboHourTo);
								?>&nbsp;&nbsp;
								 Min 
								 <?
									$objAttendance->comboMinSec("cboMinTo", $cboMinTo);
								?>&nbsp;&nbsp;
								 Sec
								 <?
									$objAttendance->comboMinSec("cboSecTo", $cboSecTo);
								?>&nbsp;&nbsp;&nbsp;
								<? 
								$objAttendance->comboAMPM("cboTimeTo", $cboTimeTo)
								?> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td height="19" valign="baseline" class="paragraph"> Place:&nbsp;&nbsp;&nbsp;</td>
                                  <td> <input name="txtPlace" type="text" size="20" maxlength="100" value="<? echo $txtPlace?>">
								  <font class="note">*</font> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td height="19" valign="top" class="paragraph"> Purpose:&nbsp;&nbsp;&nbsp;</td>
                                  <td> <input name="txtPurpose" type="text" size="40" maxlength="500" value="<? echo $txtPurpose?>">
								  <font class="note">*</font></td>
                                </tr>
                                <tr> 
                                  <td height="19" colspan="2">
								  	<input type="hidden" name="txtSearch" value="<? echo $txtSearch?>"> 
                                    <input type="hidden" name="optField" value="<? echo $optField?>"> 
                                    <input type="hidden" name="cboMonth" value="<? echo $cboMonth?>"> 
                                    <input type="hidden" name="cboYear" value="<? echo $cboYear?>"> 
									<input type="hidden" name="p" value="<? echo $p?>">
									<input type="hidden" name="strOvrd" value="<? echo $strOvrd?>">
									<input type="hidden" name="strEmpNmbr" value="<? echo $strEmpNmbr?>">
                                  </td>
                                </tr>
					  <tr><td colspan="4" align="center" height="10" valign="bottom"><hr></td></tr>
<?		
		break;
	
	case "DTR":
		
?>
					  <tr><td colspan="4" align="center" height="10" valign="bottom"><hr></td></tr>
					  <tr><td colspan="4" align="center" height="10" valign="bottom">
 					<input type="hidden" name="txtSearch" value="<? echo $txtSearch?>">
				  <input type="hidden" name="optField" value="<? echo $optField?>">
				  <input type="hidden" name="cboMonth" value="<? echo $cboMonth?>">
				  <input type="hidden" name="cboYear" value="<? echo $cboYear?>">
				  <input type="hidden" name="p" value="<? echo $p?>">
				  <input type="hidden" name="strOvrd" value="<? echo $strOvrd?>">
				<input type="hidden" name="strEmpNmbr" value="<? echo $strEmpNmbr?>">
				</td></tr>								
<?		
		break;
	default:

		echo "<tr><td class='errorsearch' align='center' height='30' valign='middle'>$strOvrd<td></tr>";
		break;
}
?>		  
					  </table>
<? 
if($strOvrd == "OB" || $strOvrd == "FC" || $strOvrd == "DTR")
{
?>					  
					  <table width="100%">					  
					  <tr><td colspan="4" class="radio"><strong>Finally:</strong> Click the "Override" button to save the changes</td></tr>
					  <tr><td colspan="4" align="center" height="40" valign="bottom"><input name="btnOverride" type="submit" value="Override" onClick="selectAllSelected();trapEntryOB(txtPlace, 'place', txtPurpose, cboMonthFrom, cboMonthTo, cboDayFrom, cboDayTo, cboYearFrom, cboYearTo, cboHourFrom, cboHourTo, cboMinFrom, cboMinTo, cboSecFrom, cboSecTo, cboTimeFrom, cboTimeTo)">&nbsp;&nbsp;<input name="btnCancel" type="button" value="Cancel">
					  </td></tr>
					  </table>
<?
}
?>
					  </form>
					  </td></tr>
					  </table>

					  </td></tr>
					  <tr><td height="10"></td></tr>
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
