<?php 
/* 
File Name: Useraccount.php
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, view and delete useraccount and password to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: April 23, 2004 (Version 2.0.0)
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
session_start();
include("../hrmis/class/Security.php");
include("../hrmis/class/Useraccount.php");   //Load database connection
$objUserAccount= new Useraccount;   //Load userAccount function

if ($t_intUserLevel == 1)	//HR Module 123456
{
	$objUserAccount->addHRModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strNotification, $t_str201, $t_strAttendance, $t_strReports, $t_strLibraries, $t_strCompensation, $t_strNotification1, $Submit);   //Add username and password (hr module)

	$objUserAccount->editHRModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strNotification, $t_str201, $t_strAttendance, $t_strReports, $t_strLibraries, $t_strCompensation, $t_strNotification1, $Submit, $t_strOldEmpNumber); //Edit username and password (hr module)

} elseif ($t_intUserLevel == 2)   //Cashier Module 0123
{
	$objUserAccount->addCashierModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strCashierNotification, $t_strCashierCompensation, $t_strCashierUpdate, $t_strCashierReport, $t_strCashierCompensation1, $Submit);   //Add username and password (cashier module)

	$objUserAccount->editCashierModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strCashierNotification, $t_strCashierCompensation, $t_strCashierUpdate, $t_strCashierReport, $t_strCashierCompensation1, $Submit, $t_strOldEmpNumber); //Edit username and password (cashier module)
	
} elseif ($t_intUserLevel == 3)   ///Chief Module 1234
{ 
	$objUserAccount->addEmployeeChiefDirectorModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strAccessPermission, $Submit);   //Add username and password

$objUserAccount->editEmployeeChiefDirectorModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strAccessPermission, $Submit, $t_strOldEmpNumber); //Edit username and password (employee, chief, director modules)	
	
} elseif ($t_intUserLevel == 4)   //Director Module 134
{ 
	$objUserAccount->addEmployeeChiefDirectorModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strAccessPermission, $Submit);   //Add username and password

$objUserAccount->editEmployeeChiefDirectorModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strAccessPermission, $Submit, $t_strOldEmpNumber); //Edit username and password (employee, chief, director modules)	
	
} elseif ($t_intUserLevel == 5)   //Employee Module 1234
{
	$objUserAccount->addEmployeeChiefDirectorModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strAccessPermission, $Submit);   //Add username and password

$objUserAccount->editEmployeeChiefDirectorModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strAccessPermission, $Submit, $t_strOldEmpNumber); //Edit username and password (employee, chief, director modules)	

} elseif ($t_intUserLevel == 12)  //HR and Cashier Module 1234567
{
	$objUserAccount->addHRAndCashierModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strAccessPermission, $Submit);  //Add username and password hr and cashier module	

	$objUserAccount->editHRAndCashierModule($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strAccessPermission, $Submit, $t_strOldEmpNumber); //Edit username and password (hrandcashier modules)
}   //end if $t_inUserLevel


$strConfirm = $objUserAccount->deleteUserAccount($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strHRUserPermission, $t_strAccessPermission, $Submit);   //Load deleteUserAccount function
?>
<html><!-- InstanceBegin template="/Templates/hrmistmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/class/JSgeneral.php");
?>
<script language="JavaScript">

function countChoices(obj) {
max = 2; // max. number allowed at a time

<!-- Original:  Glenn Wang (brief@ix.netcom.com) -->

t_strNotification = obj.form.t_strNotification.checked;  // your checkboxes here
t_str201 = obj.form.t_str201.checked;
t_strAttendance = obj.form.t_strAttendance.checked;  
t_strReports = obj.form.t_strReports.checked;  
t_strLibraries = obj.form.t_strLibraries.checked;  
t_strCompensation = obj.form.t_strCompensation.checked;  // add more if necessary

count = (t_strNotification ? 1 : 0) + (t_str201 ? 1 : 0) + (t_strAttendance ? 1 : 0) + (t_strReports ? 1 : 0) + (t_strLibraries ? 1 : 0) + (t_strCompensation ? 1 : 0);
// If you have more checkboxes on your form
// add more  (box_ ? 1 : 0)  's separated by '+'

if (count > max) {
alert("Oops!  You can only choose up to " + max + " choices!");
obj.checked = false;
   }
}

function cashierChoices(obj) {
max = 2; // max. number allowed at a time

<!-- Original:  Glenn Wang (brief@ix.netcom.com) -->

t_strCashierNotification = obj.form.t_strCashierNotification.checked;  // your checkboxes here
t_strCashierCompensation = obj.form.t_strCashierCompensation.checked;  // your checkboxes here
t_strCashierUpdate = obj.form.t_strCashierUpdate.checked;
t_strCashierReport = obj.form.t_strCashierReport.checked;            // add more if necessary

count = (t_strCashierNotification ? 1 : 0) + (t_strCashierCompensation ? 1 : 0) + (t_strCashierUpdate ? 1 : 0) + (t_strCashierReport ? 1 : 0);
// If you have more checkboxes on your form
// add more  (box_ ? 1 : 0)  's separated by '+'

if (count > max) {
alert("Oops!  You can only choose up to " + max + " choices!");
obj.checked = false;
   }
}

function permissionRequirement()
{
	var strEmpNmbr = "<? echo $strEmpNmbr; ?>";
	var strUserData = document.all.t_intUserLevel.value;
	var strEmpNumber = "<? echo $t_strEmpNumber; ?>";
	var strUserName = "<? echo $t_strUserName; ?>";
	var strUserPassword = "<? echo $t_strUserPassword; ?>";
	var strHRUserPermission = "<? echo $t_strHRUserPermission; ?>";
	var strCashierPermission = "<? echo $t_strCashierPermission; ?>";
	var strAccessPermission = "<? echo $t_strAccessPermission; ?>";
	var strSubmit = "<? echo $Submit; ?>";
	
	window.location = "Useraccount.php?strEmpNmbr="+strEmpNmbr+"&t_strEmpNumber="+strEmpNumber+"&t_strUserName="+strUserName+"&t_strUserPassword="+strUserPassword+"&t_strHRUserPermission="+strHRUserPermission+"&t_strCashierPermission="+strCashierPermission+"&t_strAccessPermission="+strAccessPermission+"&t_intUserLevel="+strUserData+"&Submit="+strSubmit;
}

function hrRequirement()
{
	var strEmpNmbr = "<? echo $strEmpNmbr; ?>";
	var strUserData = "<? echo $t_intUserLevel; ?>";
	var strHRUserPermission = document.all.t_strHRUserPermission.value;
	var strEmpNumber = "<? echo $t_strEmpNumber; ?>";
	var strUserName = "<? echo $t_strUserName; ?>";
	var strUserPassword = "<? echo $t_strUserPassword; ?>";
	var strAccessPermission = "<? echo $t_strAccessPermission; ?>";
	var strSubmit = "<? echo $Submit; ?>";

	//var strNotification = "<? echo $t_strNotification; ?>";
	//var str201 = "<? echo $t_str201; ?>";
	//var strAttendance = "<? echo $t_strAttendance; ?>";
	//var strReports = "<? echo $t_strReports; ?>";
	//var strLibraries = "<? echo $t_strLibraries; ?>";
	//var strCompensation = "<? echo $t_strCompensation; ?>";
	
	window.location = "Useraccount.php?strEmpNmbr="+strEmpNmbr+"&t_strEmpNumber="+strEmpNumber+"&t_strUserName="+strUserName+"&t_strUserPassword="+strUserPassword+"&t_strHRUserPermission="+strHRUserPermission+"&t_strAccessPermission="+strAccessPermission+"&t_intUserLevel="+strUserData+"&Submit="+strSubmit;
	
}

function cashierRequirement()
{
	var strEmpNmbr = "<? echo $strEmpNmbr; ?>";
	var strUserData = document.all.t_intUserLevel.value;
	var strCashierSectionData = document.all.t_strCashierPermission.value;
	var strEmpNumber = "<? echo $t_strEmpNumber; ?>";
	var strUserName = "<? echo $t_strUserName; ?>";
	var strUserPassword = "<? echo $t_strUserPassword; ?>";
	var strAccessPermission = document.all.t_strAccessPermission.value;
	var strSubmit = "<? echo $Submit; ?>";
	
	window.location = "Useraccount.php?strEmpNmbr="+strEmpNmbr+"&t_strEmpNumber="+strEmpNumber+"&t_strUserName="+strUserName+"&t_strUserPassword="+strUserPassword+"&t_intUserLevel="+strUserData+"&t_strCashierPermission="+strCashierSectionData+"&t_strAccessPermission="+strAccessPermission+"&Submit="+strSubmit;
}

function validate(){
var digits=".0123456789"
var temp
if (document.frmUserAccount.t_strEmpNumber.value=="") {
alert("Please input employee number!")
return false
} else if (document.frmUserAccount.t_strUserName.value=="") {
alert("Please input user name!")
return false
} else if (document.frmUserAccount.t_strUserPassword.value=="") {
alert("Please input password!")
return false
} else if (document.frmUserAccount.t_intUserLevel.value=="") {
alert("Please input user level!")
return false
}

for (var i=0;i<document.frmUserAccount.t_intUserLevel.value.length;i++){
temp=document.frmUserAccount.t_intUserLevel.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert("Invalid user level !")
return false
      }
   }

for (var i=0;i<document.frmSalarySchedule.t_intStepNumber.value.length;i++){
temp=document.frmSalarySchedule.t_intStepNumber.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert("Invalid step number !")
return false
      }
   }

for (var i=0;i<document.frmSalarySchedule.t_intActualSalary.value.length;i++){
temp=document.frmSalarySchedule.t_intActualSalary.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert("Invalid actual salary !")
return false
      }
   }

return true
}

//-->

<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->
<!-- Original:  jgw (jgwang@csua.berkeley.edu ) -->
<!-- Web Site:  http://www.csua.berkeley.edu/~jgwang/ -->
<!-- Begin
function checkCapsLock( e ) {
	var myKeyCode=0;
	var myShiftKey=false;
	var myMsg='Caps Lock is On.\n\nTo prevent entering your password incorrectly,\nyou should press Caps Lock to turn it off.';

	// Internet Explorer 4+
	if ( document.all ) {
		myKeyCode=e.keyCode;
		myShiftKey=e.shiftKey;

	// Netscape 4
	} else if ( document.layers ) {
		myKeyCode=e.which;
		myShiftKey=( myKeyCode == 16 ) ? true : false;

	// Netscape 6
	} else if ( document.getElementById ) {
		myKeyCode=e.which;
		myShiftKey=( myKeyCode == 16 ) ? true : false;

	}

	// Upper case letters are seen without depressing the Shift key, therefore Caps Lock is on
	if ( ( myKeyCode >= 65 && myKeyCode <= 90 ) && !myShiftKey ) {
		alert( myMsg );

	// Lower case letters are seen while depressing the Shift key, therefore Caps Lock is on
	} else if ( ( myKeyCode >= 97 && myKeyCode <= 122 ) && myShiftKey ) {
		alert( myMsg );

	}
}
//  End -->

function disableDateCombo()
{
	document.all.t_strNotification.disabled = true;
	document.all.t_str201.disabled = true;		
	document.all.t_strAttendance.disabled = true;
	document.all.t_strReports.disabled = true;
	document.all.t_strLibraries.disabled = true;
	document.all.t_strCompensation.disabled = true;
	document.all.t_strNotification1.disabled = false;
}

function enableDateCombo()
{
	document.all.t_strNotification.disabled = false;
	document.all.t_str201.disabled = false;		
	document.all.t_strAttendance.disabled = false;
	document.all.t_strReports.disabled = false;
	document.all.t_strLibraries.disabled = false;
	document.all.t_strCompensation.disabled = false;
	document.all.t_strNotification1.disabled = true;
}

function cashierDisableDateCombo()
{
	document.all.t_strCashierNotification.disabled = true;
	document.all.t_strCashierCompensation.disabled = true;
	document.all.t_strCashierUpdate.disabled = true;		
	document.all.t_strCashierReport.disabled = true;
	document.all.t_strCashierCompensation1.disabled = false;
}

function cashierEnableDateCombo()
{
	document.all.t_strCashierNotification.disabled = false;
	document.all.t_strCashierCompensation.disabled = false;
	document.all.t_strCashierUpdate.disabled = false;		
	document.all.t_strCashierReport.disabled = false;
	document.all.t_strCashierCompensation1.disabled = true;
}

</script>
<!-- InstanceEndEditable --> 
<!-- Design/Images made by:  Angelo Campos Evangelista  -->
<!-- Template made by:  Pearliezl Samoy Dy Tioco  -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!-- onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar()" onFocus="statusBar()"  -->

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
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
<link href="hrmis.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" --> 
<!-- InstanceEndEditable -->
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/appointment2.jpg','images/deduction2.jpg','images/division2.jpg','images/educational2.jpg','images/exam2.jpg','images/holiday2.jpg','images/income2.jpg','images/leave2.jpg','images/plantilla2.jpg','images/project2.jpg','images/section2.jpg','images/service2.jpg','images/tax2.jpg','images/useraccount2.jpg','images/agency2.jpg','images/notificationover.jpg','images/attendanceover.jpg','images/reportsover.jpg','images/compensationover.jpg','images/philhealth2.jpg','images/taxexemp2.jpg','images/trainingcode2.jpg','images/salaryschedule2.jpg','images/separationcause2.jpg','images/positioncode2.jpg','images/logout2.jpg','images/contact2.jpg','images/signatory2.jpg','images/attendancescheme2.jpg','images/201over.jpg','images/librariesclick.jpg','images/dailyquote2.jpg','images/backup2.jpg'); history.forward()" onContextMenu="return false"><div align="center"> 
<table width="778" height="940" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr> 
    <td height="945"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="INNERTBL">
        <tr> 
          <td valign="bottom"><table width="90%" border="0" cellpadding="0" cellspacing="0" id="tblHRMODULE">
              <tr>
                <td><img src="images/hrmodule.jpg" width="170" height="23"></td>
              </tr>
            </table></td>
          <td width="67%" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td valign="bottom">
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" id="tblSECTION1">
                    <tr> 
                      <td valign="bottom"><table border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                        </table>
                        <?   //  HR module for libraries templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Officer" && $t_strAccessPermission == 123456) 
{
?>
                        <table width="78%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATION">
                          <tr> 
                            <td valign="bottom"><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION1','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="NOTIFICATION1" name="NOTIFICATION1" width="96" height="29" border="0"></a></td>
                            <td valign="bottom"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE1','','images/201over.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201.jpg" alt="PROFILE1" name="PROFILE1" width="67" height="29" border="0"></a></td>
                            <td valign="bottom"><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE1','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="ATTENDANCE1" name="ATTENDANCE1" width="88" height="29" border="0"></a></td>
                            <td valign="bottom"><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS1','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS1" name="REPORTS1" width="60" height="29" border="0"></a></td>
                            <td valign="bottom"><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES1','','images/librariesclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/librariesclick.jpg" alt="LIBRARIES1" name="LIBRARIES1" width="67" height="29" border="0"></a></td>
                            <td valign="bottom"><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION1','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION1" name="COMPENSATION1" width="104" height="29" border="0"></a></td>
                          </tr>
                        </table>
                        <? } ?>
                      </td>
                    </tr>
                    <tr> 
                      <td valign="bottom"> 
                        <?   //  HR module for libraries templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 15) 
{
?>
                        <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATION">
                          <tr> 
                            <td width="95%"><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION11','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="NOTIFICATION1" name="NOTIFICATION11" width="96" height="29" border="0" id="NOTIFICATION11"></a></td>
                            <td width="5%"><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES11','','images/librariesclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/librariesclick.jpg" alt="LIBRARIES1" name="LIBRARIES11" width="67" height="29" border="0" id="LIBRARIES11"></a></td>
                          </tr>
                        </table>
                        <? } ?>
                      </td>
                    </tr>
                    <tr> 
                      <td valign="bottom"> 
                        <?   //  HR module for libraries templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 25) 
{
?>
                        <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATION">
                          <tr> 
                            <td width="95%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE12','','images/201over.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201.jpg" alt="PROFILE1" name="PROFILE12" width="67" height="29" border="0" id="PROFILE12"></a></td>
                            <td width="5%"><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES12','','images/librariesclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/librariesclick.jpg" alt="LIBRARIES1" name="LIBRARIES12" width="67" height="29" border="0" id="LIBRARIES12"></a></td>
                          </tr>
                        </table>
                        <? } ?>
                      </td>
                    </tr>
                    <tr> 
                      <td valign="bottom"> 
                        <?   //  HR module for libraries templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 35) 
{
?>
                        <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATION">
                          <tr> 
                            <td width="92%"><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE13','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="ATTENDANCE1" name="ATTENDANCE13" width="88" height="29" border="0" id="ATTENDANCE13"></a></td>
                            <td width="8%"><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES13','','images/librariesclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/librariesclick.jpg" alt="LIBRARIES1" name="LIBRARIES13" width="67" height="29" border="0" id="LIBRARIES13"></a></td>
                          </tr>
                        </table>
                        <? } ?>
                      </td>
                    </tr>
                    <tr> 
                      <td valign="bottom"> 
                        <?   //  HR module for libraries templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 45) 
{
?>
                        <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATION">
                          <tr> 
                            <td width="90%"><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS14','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS1" name="REPORTS14" width="60" height="29" border="0" id="REPORTS14"></a></td>
                            <td width="10%"><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES14','','images/librariesclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/librariesclick.jpg" alt="LIBRARIES1" name="LIBRARIES14" width="67" height="29" border="0" id="LIBRARIES14"></a></td>
                          </tr>
                        </table>
                        <? } ?>
                      </td>
                    </tr>
                    <tr> 
                      <td valign="bottom"> 
                        <?   //  HR module for libraries templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel']; 
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 56) 
{
?>
                        <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATION">
                          <tr> 
                            <td width="87%"><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES15','','images/librariesclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/librariesclick.jpg" alt="LIBRARIES1" name="LIBRARIES15" width="67" height="29" border="0" id="LIBRARIES15"></a></td>
                            <td width="13%"><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION15','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION1" name="COMPENSATION15" width="104" height="29" border="0" id="COMPENSATION15"></a></td>
                          </tr>
                        </table>
                        <? } ?>
                      </td>
                    </tr>
                    <tr> 
                      <td valign="bottom"> 
                        <?   //  HR module for libraries templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel']; 
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 5) 
{
?>
                        <table width="10%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblLIBRARIES">
                          <tr> 
                            <td width="87%"><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES151','','images/librariesclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/librariesclick.jpg" alt="LIBRARIES1" name="LIBRARIES151" width="67" height="29" border="0" id="LIBRARIES15"></a></td>
                          </tr>
                        </table>
                        <? } ?>
                      </td>
                    </tr>
                    <tr>
                      <td valign="bottom">
                        <?   //  HR module for libraries templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == 1234567) 
{
?>
                        <table width="78%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATIONCASHIER">
                          <tr> 
                            <td valign="bottom"><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION12','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="NOTIFICATION1" name="NOTIFICATION12" width="96" height="29" border="0" id="NOTIFICATION12"></a></td>
                            <td valign="bottom"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE11','','images/201over.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201.jpg" alt="PROFILE1" name="PROFILE11" width="67" height="29" border="0" id="PROFILE11"></a></td>
                            <td valign="bottom"><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE11','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="ATTENDANCE1" name="ATTENDANCE11" width="88" height="29" border="0" id="ATTENDANCE11"></a></td>
                            <td valign="bottom"><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS11','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS1" name="REPORTS11" width="60" height="29" border="0" id="REPORTS11"></a></td>
                            <td valign="bottom"><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES16','','images/librariesclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/librariesclick.jpg" alt="LIBRARIES1" name="LIBRARIES16" width="67" height="29" border="0" id="LIBRARIES16"></a></td>
                            <td valign="bottom"><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION11','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION1" name="COMPENSATION11" width="104" height="29" border="0" id="COMPENSATION11"></a></td>
                          </tr>
                        </table>
                        <? } ?>
                      </td>
                    </tr>
                  </table></td>
              </tr></table></td></tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="8" colspan="2"><div align="center">Welcome <strong><? echo $_SESSION['strLoginName']; ?></strong>. 
              You are currently working at the HR Module.</div></td>
        </tr>
        <tr valign="top" bgcolor="#E9F3FE"> 
          <td height="570" colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="16%" height="570"><table width="150" height="527" border="0" cellpadding="0" cellspacing="0" bgcolor="#E9F3FE">
                    <tr> 
                      <td height="527" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" id="tblLEFTNAVIGATION">
                          <tr> 
                            <td height="567" valign="top"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="NAVTBL">
                                <tr> 
                                  <td height="563" valign="top">
                                    <?   //  HR module for libraries templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == 1234567) 
{
?>
                                    <table width="108" height="300" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td> <a href="Agency.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Agency','','images/agency2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/agency.jpg" alt="Agency" name="Agency" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Appointment.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Appointment','','images/appointment2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/appointment.jpg" alt="Appointment" name="Appointment" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Attendancescheme.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('attendancescheme','','images/attendancescheme2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendancescheme.jpg" alt="attendancescheme" name="attendancescheme" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Backup.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Backup','','images/backup2.jpg',1)"><img src="images/backup.jpg" alt="Backup" name="Backup" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Contact.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Contact','','images/contact2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/contact.jpg" alt="Contact" name="Contact" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Dailyquote.php?strEmpNmbr=<? echo $strEmpNmbr; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('DAILYQUOTE','','images/dailyquote2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/dailyquote.jpg" alt="DAILYQUOTE" name="DAILYQUOTE" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Deduction.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Deduction','','images/deduction2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/deduction.jpg" alt="Deduction" name="Deduction" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Division.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Division','','images/division2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/division.jpg" alt="Division" name="Division" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Level.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Educational','','images/educational2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/educational.jpg" alt="Educational" name="Educational" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Examtype.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Exam','','images/exam2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/exam.jpg" alt="Exam" name="Exam" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Holiday','','images/holiday2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/holiday.jpg" alt="Holiday" name="Holiday" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Income.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Income','','images/income2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/income.jpg" alt="Income" name="Income" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Leave.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Leave','','images/leave2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/leave.jpg" alt="Leave" name="Leave" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Philhealthrange.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Philhealth','','images/philhealth2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/philhealth.jpg" alt="Philhealth Range" name="Philhealth" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Plantilla.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Plantilla','','images/plantilla2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/plantilla.jpg" alt="Plantilla" name="Plantilla" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Positioncode.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Positioncode','','images/positioncode2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/positioncode.jpg" alt="Position Code" name="Positioncode" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Projectcode.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Project','','images/project2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/project.jpg" alt="Project" name="Project" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Salaryschedule.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Salaryschedule','','images/salaryschedule2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/salaryschedule.jpg" alt="Salary Schedule" name="Salaryschedule" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Section.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Section','','images/section2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/section.jpg" alt="Section" name="Section" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Separationcause.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Separationcause','','images/separationcause2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/separationcause.jpg" alt="Separation Cause" name="Separationcause" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Servicecode.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Service','','images/service2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/service.jpg" alt="Service" name="Service" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Signatory.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Signatory','','images/signatory2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/signatory.jpg" alt="Signatory" name="Signatory" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Taxexemption.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Tax Exemption','','images/taxexemp2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/taxexemp.jpg" alt="Tax Exemption" name="Tax Exemption" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Taxrange.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Tax','','images/tax2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/tax.jpg" alt="Tax" name="Tax" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Trainingcode.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Training Code','','images/trainingcode2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/trainingcode.jpg" alt="Training Code" name="Training Code" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Useraccount.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Useraccount','','images/useraccount2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/useraccount.jpg" alt="User Account" name="Useraccount" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="index.php" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('logout','','images/logout2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/logout.jpg" alt="logout" name="logout" width="108" height="20" border="0"></a></td>
                                      </tr>
                                    </table>
<? 
} else {
?>
                                    <table width="108" height="300" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td> <a href="Agency.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Agency1','','images/agency2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/agency.jpg" alt="Agency" name="Agency1" width="108" height="20" border="0" id="Agency1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Appointment.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Appointment1','','images/appointment2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/appointment.jpg" alt="Appointment" name="Appointment1" width="108" height="20" border="0" id="Appointment1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Attendancescheme.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('attendancescheme1','','images/attendancescheme2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendancescheme.jpg" alt="attendancescheme" name="attendancescheme1" width="108" height="20" border="0" id="attendancescheme1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Backup.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Backup2','','images/backup2.jpg',1)"><img src="images/backup.jpg" alt="Backup2" name="Backup2" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Contact.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Contact1','','images/contact2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/contact.jpg" alt="Contact" name="Contact1" width="108" height="20" border="0" id="Contact1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Dailyquote.php?strEmpNmbr=<? echo $strEmpNmbr; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('DAILYQUOTE1','','images/dailyquote2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/dailyquote.jpg" alt="DAILYQUOTE" name="DAILYQUOTE1" width="108" height="20" border="0" id="DAILYQUOTE1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Deduction.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Deduction1','','images/deduction2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/deduction.jpg" alt="Deduction" name="Deduction1" width="108" height="20" border="0" id="Deduction1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Division.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Division1','','images/division2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/division.jpg" alt="Division" name="Division1" width="108" height="20" border="0" id="Division1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Level.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Educational1','','images/educational2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/educational.jpg" alt="Educational" name="Educational1" width="108" height="20" border="0" id="Educational1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Examtype.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Exam1','','images/exam2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/exam.jpg" alt="Exam" name="Exam1" width="108" height="20" border="0" id="Exam1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Holiday1','','images/holiday2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/holiday.jpg" alt="Holiday" name="Holiday1" width="108" height="20" border="0" id="Holiday1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Income.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Income1','','images/income2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/income.jpg" alt="Income" name="Income1" width="108" height="20" border="0" id="Income1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Leave.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Leave1','','images/leave2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/leave.jpg" alt="Leave" name="Leave1" width="108" height="20" border="0" id="Leave1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Philhealthrange.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Philhealth1','','images/philhealth2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/philhealth.jpg" alt="Philhealth Range" name="Philhealth1" width="108" height="20" border="0" id="Philhealth1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Plantilla.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Plantilla1','','images/plantilla2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/plantilla.jpg" alt="Plantilla" name="Plantilla1" width="108" height="20" border="0" id="Plantilla1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Positioncode.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Positioncode1','','images/positioncode2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/positioncode.jpg" alt="Position Code" name="Positioncode1" width="108" height="20" border="0" id="Positioncode1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Projectcode.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Project1','','images/project2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/project.jpg" alt="Project" name="Project1" width="108" height="20" border="0" id="Project1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Salaryschedule.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Salaryschedule1','','images/salaryschedule2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/salaryschedule.jpg" alt="Salary Schedule" name="Salaryschedule1" width="108" height="20" border="0" id="Salaryschedule1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Section.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Section1','','images/section2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/section.jpg" alt="Section" name="Section1" width="108" height="20" border="0" id="Section1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Separationcause.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Separationcause1','','images/separationcause2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/separationcause.jpg" alt="Separation Cause" name="Separationcause1" width="108" height="20" border="0" id="Separationcause1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Servicecode.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Service1','','images/service2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/service.jpg" alt="Service" name="Service1" width="108" height="20" border="0" id="Service1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Signatory.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Signatory1','','images/signatory2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/signatory.jpg" alt="Signatory" name="Signatory1" width="108" height="20" border="0" id="Signatory1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Taxexemption.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Tax Exemption1','','images/taxexemp2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/taxexemp.jpg" alt="Tax Exemption" name="Tax Exemption1" width="108" height="20" border="0" id="Tax Exemption1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Taxrange.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Tax1','','images/tax2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/tax.jpg" alt="Tax" name="Tax1" width="108" height="20" border="0" id="Tax1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Trainingcode.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Training Code1','','images/trainingcode2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/trainingcode.jpg" alt="Training Code" name="Training Code1" width="108" height="20" border="0" id="Training Code1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Useraccount.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Useraccount1','','images/useraccount2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/useraccount.jpg" alt="User Account" name="Useraccount1" width="108" height="20" border="0" id="Useraccount1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="index.php" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('logout1','','images/logout2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/logout.jpg" alt="logout" name="logout1" width="108" height="20" border="0" id="logout1"></a></td>
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
                <td width="84%" valign="top"><table width="99%" height="563" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODYTBL">
                    <tr> 
                      <td height="563"><!-- InstanceBeginEditable name="BODY" --> 

                        <table width="99%" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODY">
                          <tr> 
                            <td height="25" class="header"><p>USER ACCOUNT</p></td>
                          </tr>
                          <tr> 
                            <td valign="top"> 
                              <div align="center"></div>
                              <div align="center"></div>
                              <div align="center"></div></td>
                          </tr>
                          <tr> 
                            <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
							<form action="<?php $PHP_SELF; ?>" method="post" name="frmUserAccount" onSubmit="return validate()">
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>
                                      <?
							      if($strConfirm)
							      {
							      ?>
								  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td colspan="3" class="titlebar">Are 
                                          you sure you want to delete <? echo $t_strUserName; ?> 
                                          and <? echo $t_strUserPassword; ?> ??? 
                                          <input name="t_strUserName" type="hidden" value="<? echo $t_strUserName; ?>">
                                            <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr; ?>">
                                          </td>
                                      </tr>
                                      <tr> 
                                        <td colspan="3"><div align="center"> 
                                            <input type="submit" name="Submit" value="OK">
                                            <input type="submit" name="Submit" value="Cancel">
                                          </div></td>
                                      </tr>
                                      <tr> 
                                        <td colspan="3">&nbsp;</td>
                                      </tr>
                                    </table>
                                      <?
								  }
								     elseif ($Submit == 'Edit')
								     {
								  ?>
                                      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td width="26%" class="paragraph">Access 
                                            Level :</td>
                                          <td width="74%" colspan="3"> <select name="t_intUserLevel" size="1" onChange="permissionRequirement(document.all.t_intUserLevel.value)">
                                              <?
									  if ($t_intUserLevel == '1') 
									  {
									  ?>
                                              <option value="1" selected>HR Module</option>
                                              <? 
									  } else {
									  ?>
                                              <option value="1">HR Module</option>
                                              <?
									  }
									  ?>
                                              <?
									  if ($t_intUserLevel == '2') 
									  {
									  ?>
                                              <option value="2" selected>Cashier 
                                              Module</option>
                                              <?
									  } else { 
									  ?>
                                              <option value="2">Cashier Module</option>
                                              <?
									  }
									  ?>
                                              <?
									  if ($t_intUserLevel == '3') 
									  {
									  ?>
                                              <option value="3" selected>Chief 
                                              Module</option>
                                              <?
									  } else {
									  ?>
                                              <option value="3">Chief Module</option>
                                              <?
									  }
									  ?>
                                              <?
									  if ($t_intUserLevel == '4') 
									  {
									  ?>
                                              <option value="4" selected>Director 
                                              Module</option>
                                              <?
									  } else {
									  ?>
                                              <option value="4">Director Module</option>
                                              <?
									  }
									  ?>
                                              <?
									  if ($t_intUserLevel == '5') 
									  {
									  ?>
                                              <option value="5" selected>Employee 
                                              Module</option>
                                              <?
									  } else {
									  ?>
                                              <option value="5">Employee Module</option>
                                              <?
									  }
									  ?>
                                              <?
									  if ($t_intUserLevel == '12') 
									  {
									  ?>
                                              <option value="12" selected>HR&amp;Cashier 
                                              Module</option>
                                              <?
									  } else {
									  ?>
                                              <option value="12">HR&amp;Cashier 
                                              Module</option>
                                              <?
									  }
									  ?>
                                            </select>
                                            <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"><table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td colspan="4"> 
                                                  <? 
									if ($t_intUserLevel == 1)  // HR Module
									{
									?>
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td colspan="4"> 
                                                  <?
									 if($t_strHRUserPermission == "HR Assistant" || $t_strHRUserPermission == "")
									  {
									  	echo "<input name='t_strHRUserPermission' type='radio' value='HR Assistant' checked onClick='enableDateCombo();'>";
									  }
									  else
									  {
									  	echo "<input name='t_strHRUserPermission' type='radio' value='HR Assistant' onClick='enableDateCombo();'>";
									  }
									  ?>
                                                  <span class="text">Assistant</span></td>
                                              </tr>
                                              <tr> 
                                                <td width="25%" rowspan="2">&nbsp;</td>
                                                <td width="23%"> <span class="text"> 
                                                  <?  //HR module for notification(1) hr assistant
									 $result = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$t_strEmpNumber'");
									 $row = mysql_fetch_array($result);
									 $t_strAccessPermission= $row['accessPermission'];
									 $t_strHRUserPermission = $row['userPermission'];
									 if ($t_strAccessPermission{0} == 1) {
										 list($t_strNotification)=array(substr($t_strAccessPermission,0,2));
										 if($t_strNotification == "12" || $t_strNotification == "13" || $t_strNotification == "14" || $t_strNotification == "15" || $t_strNotification == "16")
										  {
											echo "<input name='t_strNotification' type='checkbox' value='1' checked>";
										  }
										  else
										  {
											echo "<input name='t_strNotification' type='checkbox' value='1' onClick='countChoices(this)'>";
										  }
									 } else {
									 list($t_strNotification)=array(substr($t_strAccessPermission,0,2));
										 if($t_strNotification == "12" || $t_strNotification == "13" || $t_strNotification == "14" || $t_strNotification == "15" || $t_strNotification == "16")
										  {
											echo "<input name='t_strNotification' type='checkbox' value='1' checked>";
										  }
										  else
										  {
											echo "<input name='t_strNotification' type='checkbox' value='1' onClick='countChoices(this)'>";
										  }
									 }	
									 ?>
                                                  </span> <span class="text">Notification</span></td>
                                                <td width="22%"> <span class="text"> 
                                                  <?  //HR module for attendance(3) hr assistant
									 $result = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$t_strEmpNumber'");
									 $row = mysql_fetch_array($result);
									 $t_strAccessPermission= $row['accessPermission'];
									 $t_strHRUserPermission = $row['userPermission'];
									 if ($t_strAccessPermission{0} == 1) {
										 list($t_strAttendance)=array(substr($t_strAccessPermission,0,2));
										 if($t_strAttendance == "13" || $t_strAttendance == "23" || $t_strAttendance == "34" || $t_strAttendance == "35" || $t_strAttendance == "36")
										  {
											echo "<input name='t_strAttendance' type='checkbox' value='3' checked>";
										  }
										  else
										  {
											echo "<input name='t_strAttendance' type='checkbox' value='3' onClick='countChoices(this)'>";
										  }
									 } else {
									 list($t_strAttendance)=array(substr($t_strAccessPermission,0,2));
										 if($t_strAttendance == "13" || $t_strAttendance == "23" || $t_strAttendance == "34" || $t_strAttendance == "35" || $t_strAttendance == "36")
										  {
											echo "<input name='t_strAttendance' type='checkbox' value='3' checked>";
										  }
										  else
										  {
											echo "<input name='t_strAttendance' type='checkbox' value='3' onClick='countChoices(this)'>";
										  }
									 }	
									 ?>
                                                  </span> <span class="text">Attendance</span> 
                                                </td>
                                                <td width="30%"> <span class="text"> 
                                                  <?  //HR module for Libraries(5) hr assistant
									 $result = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$t_strEmpNumber'");
									 $row = mysql_fetch_array($result);
									 $t_strAccessPermission= $row['accessPermission'];
									 $t_strHRUserPermission = $row['userPermission'];
									 if ($t_strAccessPermission{0} == 1) {
										 list($t_strLibraries)=array(substr($t_strAccessPermission,0,2));
										 if($t_strLibraries == "15" || $t_strLibraries == "25" || $t_strLibraries == "35" || $t_strLibraries == "45" || $t_strLibraries == "56")
										  {
											echo "<input name='t_strLibraries' type='checkbox' value='5' checked>";
										  }
										  else
										  {
											echo "<input name='t_strLibraries' type='checkbox' value='5' onClick='countChoices(this)'>";
										  }
									 } else {
									 list($t_strLibraries)=array(substr($t_strAccessPermission,0,2));
										 if($t_strLibraries == "15" || $t_strLibraries == "25" || $t_strLibraries == "35" || $t_strLibraries == "45" || $t_strLibraries == "56")
										  {
											echo "<input name='t_strLibraries' type='checkbox' value='5' checked>";
										  }
										  else
										  {
											echo "<input name='t_strLibraries' type='checkbox' value='5' onClick='countChoices(this)'>";
										  }
									 }	
									 ?>
                                                  </span> <span class="text">Libraries</span></td>
                                              </tr>
                                              <tr> 
                                                <td> <span class="text"> 
                                                  <?  //HR module for 201(2) hr assistant
									 $result = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$t_strEmpNumber'");
									 $row = mysql_fetch_array($result);
									 $t_strAccessPermission= $row['accessPermission'];
									 $t_strHRUserPermission = $row['userPermission'];
									 if ($t_strAccessPermission{0} == 1) {
										 list($t_str201)=array(substr($t_strAccessPermission,0,2));
										 if($t_str201 == "12" || $t_str201 == "23" || $t_str201 == "24" || $t_str201 == "25" || $t_str201 == "26")
										  {
											echo "<input name='t_str201' type='checkbox' value='2' checked>";
										  }
										  else
										  {
											echo "<input name='t_str201' type='checkbox' value='2' onClick='countChoices(this)'>";
										  }
									 } else {
									 list($t_str201)=array(substr($t_strAccessPermission,0,2));
										 if($t_str201 == "12" || $t_str201 == "23" || $t_str201 == "24" || $t_str201 == "25" || $t_str201 == "26")
										  {
											echo "<input name='t_str201' type='checkbox' value='2' checked>";
										  }
										  else
										  {
											echo "<input name='t_str201' type='checkbox' value='2' onClick='countChoices(this)'>";
										  }
									 }	
									 ?>
                                                  </span> <span class="text"> 
                                                  201 Section</span></td>
                                                <td width="22%"> <span class="text"> 
                                                  <?  //HR module for Reports(4) hr assistant
									 $result = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$t_strEmpNumber'");
									 $row = mysql_fetch_array($result);
									 $t_strAccessPermission= $row['accessPermission'];
									 $t_strHRUserPermission = $row['userPermission'];
									 if ($t_strAccessPermission{0} == 1) {
										 list($t_strReports)=array(substr($t_strAccessPermission,0,2));
										 if($t_strReports == "14" || $t_strReports == "24" || $t_strReports == "34" || $t_strReports == "45" || $t_strReports == "46")
										  {
											echo "<input name='t_strReports' type='checkbox' value='4' checked>";
										  }
										  else
										  {
											echo "<input name='t_strReports' type='checkbox' value='4' onClick='countChoices(this)'>";
										  }
									 } else {
									 list($t_strReports)=array(substr($t_strAccessPermission,0,2));
										 if($t_strReports == "14" || $t_strReports == "24" || $t_strReports == "34" || $t_strReports == "45" || $t_strReports == "46")
										  {
											echo "<input name='t_strReports' type='checkbox' value='4' checked>";
										  }
										  else
										  {
											echo "<input name='t_strReports' type='checkbox' value='4' onClick='countChoices(this)'>";
										  }
									 }	
									 ?>
                                                  </span> <span class="text"> 
                                                  Reports</span></td>
                                                <td width="30%"> <span class="text"> 
                                                  <?  //HR module for Compensation(6) hr assistant
									 $result = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$t_strEmpNumber'");
									 $row = mysql_fetch_array($result);
									 $t_strAccessPermission= $row['accessPermission'];
									 $t_strHRUserPermission = $row['userPermission'];
									 if ($t_strAccessPermission{0} == 1) {
										 list($t_strCompensation)=array(substr($t_strAccessPermission,0,2));
										 if($t_strCompensation == "16" || $t_strCompensation == "26" || $t_strCompensation == "36" || $t_strCompensation == "46" || $t_strCompensation == "56")
										  {
											echo "<input name='t_strCompensation' type='checkbox' value='6' checked>";
										  }
										  else
										  {
											echo "<input name='t_strCompensation' type='checkbox' value='6' onClick='countChoices(this)'>";
										  }
									 } else {
									 list($t_strCompensation)=array(substr($t_strAccessPermission,0,2));
										 if($t_strCompensation == "16" || $t_strCompensation == "26" || $t_strCompensation == "36" || $t_strCompensation == "46" || $t_strCompensation == "56")
										  {
											echo "<input name='t_strCompensation' type='checkbox' value='6' checked>";
										  }
										  else
										  {
											echo "<input name='t_strCompensation' type='checkbox' value='6' onClick='countChoices(this)'>";
										  }
									 }	
									 ?>
                                                  </span> <span class="text">Compensation</span></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="4">&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="4"> 
                                                  <?
									 if($t_strHRUserPermission == "HR Officer" || $t_strHRUserPermission == "")
									  {
									  	echo "<input name='t_strHRUserPermission' type='radio' value='HR Officer' checked onClick='disableDateCombo();'>";
									  }
									  else
									  {
									  	echo "<input name='t_strHRUserPermission' type='radio' value='HR Officer' onClick='disableDateCombo();'>";
									  }
									  ?>
                                                  <span class="text">HRMO (Access 
                                                  all sections)</span></td>
                                              </tr>
                                              <tr> 
                                                <td>&nbsp;</td>
                                                <td><span class="text">
                                                  <?  //HR module for HR officer(123456)
									 $result = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$t_strEmpNumber'");
									 $row = mysql_fetch_array($result);
									 $t_strAccessPermission= $row['accessPermission'];
									 $t_strHRUserPermission = $row['userPermission'];
									 if ($t_strAccessPermission{0} == 1) {
										 list($t_strNotification1)=array(substr($t_strAccessPermission,0,6));
										 if($t_strNotification1 == "123456" || $t_strNotification1 == "")
										  {
											echo "<input name='t_strNotification1' type='checkbox' value='123456' checked>";
										  }
										  else
										  {
											echo "<input name='t_strNotification1' type='checkbox' value='123456' onClick='countChoices(this)'>";
										  }
									 } else {
									 list($t_strNotification1)=array(substr($t_strAccessPermission,0,6));
										 if($t_strNotification1 == "123456")
										  {
											echo "<input name='t_strNotification1' type='checkbox' value='123456' checked>";
										  }
										  else
										  {
											echo "<input name='t_strNotification1' type='checkbox' value='123456' onClick='countChoices(this)'>";
										  }
									 }	
									 ?>
                                                  all sections </span></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="4">&nbsp;</td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp; </td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"><table width="35%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td> <? 
									} elseif ($t_intUserLevel == 5)  // Employee Module
									{
									?>
                                                </td>
                                                <td width="57%"><select name="t_strAccessPermission" size="5" multiple disabled id="t_strAccessPermission" style="width:120">
                                                    <option>EMPLOYEE MODULE...</option>
                                                    <option>-&gt; 201 Section</option>
                                                    <option>-&gt; Attendance Section</option>
                                                    <option>-&gt; Request Section</option>
                                                    <option>-&gt; Notification 
                                                    Section</option>
                                                  </select> <input name="t_strHRUserPermission" type="hidden" id="t_strHRUserPermission" value="<? echo "Employee"; ?>"> 
                                                  <input name="t_strAccessPermission" type="hidden" id="t_strAccessPermission" value="<? echo "1234"; ?>"></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"><table width="35%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td width="43%"> <? 
									} elseif ($t_intUserLevel == 3)  // Chief Module
									{
									?>
                                                </td>
                                                <td width="57%"><select name="t_strAccessPermission" size="5" multiple disabled id="t_strAccessPermission" style="width:120">
                                                    <option>CHIEF MODULE...</option>
                                                    <option>-&gt; 201 Section</option>
                                                    <option>-&gt; Attendance Section</option>
                                                    <option>-&gt; Request Section</option>
                                                    <option>-&gt; Notification 
                                                    Section</option>
                                                  </select> <input name="t_strHRUserPermission" type="hidden" id="t_strHRUserPermission" value="<? echo "Chief"; ?>"> 
                                                  <input name="t_strAccessPermission" type="hidden" id="t_strAccessPermission" value="<? echo "1234"; ?>"></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"><table width="35%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td width="42%"> <? 
									} elseif ($t_intUserLevel == 4)  // Director Module
									{
									?>
                                                </td>
                                                <td width="58%"><select name="t_strAccessPermission" size="4" multiple disabled id="t_strAccessPermission" style="width:120">
                                                    <option>DIRECTOR MODULE...</option>
                                                    <option>-&gt; 201 Section</option>
                                                    <option>-&gt; Request Section</option>
                                                    <option>-&gt; Notification 
                                                    Section</option>
                                                  </select> <input name="t_strHRUserPermission" type="hidden" id="t_strHRUserPermission3" value="<? echo "Director"; ?>"> 
                                                  <input name="t_strAccessPermission" type="hidden" id="t_strAccessPermission4" value="<? echo "134"; ?>"></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"><table width="35%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td width="43%"> <? 
									} elseif ($t_intUserLevel == 12)  // HR & Cashier Module
									{
									?>
                                                </td>
                                                <td width="57%"><select name="t_strAccessPermission" size="7" multiple disabled id="t_strAccessPermission" style="width:130">
                                                    <option>HR &amp; Cashier Module...</option>
                                                    <option value="Notification Section">-&gt; 
                                                    Notification Section</option>
                                                    <option value="201 Section">-&gt; 
                                                    201 Section</option>
                                                    <option value="Attendance Section">-&gt; 
                                                    Attendance Section</option>
                                                    <option value="Reports Section">-&gt; 
                                                    Reports Section</option>
                                                    <option value="Libraries Section">-&gt; 
                                                    Libraries Section</option>
                                                    <option value="Compensation Section">-&gt; 
                                                    Compensation Section</option>
                                                  </select> <input name="t_strHRUserPermission" type="hidden" id="t_strHRUserPermission" value="<? echo "HR&Cashier Officer"; ?>"> 
                                                  <input name="t_strAccessPermission" type="hidden" id="t_strAccessPermission" value="<? echo "1234567"; ?>"></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"><table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td colspan="5"> 
                                                  <? 
									} else    //if ($t_intUserLevel == 2)  Cashier Module
									{
									?>
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td colspan="5"> 
                                                  <?
									 if($t_strHRUserPermission == "Cashier Assistant" || $t_strHRUserPermission == "")
									  {
									  	echo "<input name='t_strHRUserPermission' type='radio' value='Cashier Assistant' checked onClick='cashierEnableDateCombo();'>";
									  }
									  else
									  {
									  	echo "<input name='t_strHRUserPermission' type='radio' value='Cashier Assistant' onClick='cashierEnableDateCombo();'>";
									  }
									  ?>
                                                  <span class="text"> Assistant</span></td>
                                              </tr>
                                              <tr> 
                                                <td width="16%">&nbsp;</td>
                                                <td width="23%"> <span class="text"> 
                                                  <?  //Cashier module for notification cashier assistant
									 $result = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$t_strEmpNumber'");
									 $row = mysql_fetch_array($result);
									 $t_strAccessPermission= $row['accessPermission'];
									 $t_strHRUserPermission = $row['userPermission'];
									 if ($t_strAccessPermission{0} == 1 && $t_strHRUserPermission{0} == "Cashier Assistant") {
										 list($t_strCashierNotification)=array(substr($t_strAccessPermission,0,2));
										 if($t_strCashierNotification == "01" || $t_strCashierNotification == "02" || $t_strCashierNotification == "03")
										  {
											echo "<input name='t_strCashierNotification' type='checkbox' value='0' checked>";
										  }
										  else
										  {
											echo "<input name='t_strCashierNotification' type='checkbox' value='0' onClick='cashierChoices(this)'>";
										  }
									 } else {
									 list($t_strCashierNotification)=array(substr($t_strAccessPermission,0,2));
										 if($t_strCashierNotification == "01" || $t_strCashierNotification == "02" || $t_strCashierNotification == "03")
										  {
											echo "<input name='t_strCashierNotification' type='checkbox' value='0' checked>";
										  }
										  else
										  {
											echo "<input name='t_strCashierNotification' type='checkbox' value='0' onClick='cashierChoices(this)'>";
										  }
									 }	
									 ?>
                                                  Notification</span></td>
                                                <td width="27%"><span class="text"> 
                                                  <?  //Cashier module for compensation cashier assistant
									 $result = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$t_strEmpNumber'");
									 $row = mysql_fetch_array($result);
									 $t_strAccessPermission= $row['accessPermission'];
									 $t_strHRUserPermission = $row['userPermission'];
									 if ($t_strAccessPermission{0} == 1 && $t_strHRUserPermission{0} == "Cashier Assistant") {
										 list($t_strCashierCompensation)=array(substr($t_strAccessPermission,0,2));
										 if($t_strCashierCompensation == "01" || $t_strCashierCompensation == "12" || $t_strCashierCompensation == "13")
										  {
											echo "<input name='t_strCashierCompensation' type='checkbox' value='1' checked>";
										  }
										  else
										  {
											echo "<input name='t_strCashierCompensation' type='checkbox' value='1' onClick='cashierChoices(this)'>";
										  }
									 } else {
									 list($t_strCashierCompensation)=array(substr($t_strAccessPermission,0,2));
										 if($t_strCashierCompensation == "01" || $t_strCashierCompensation == "12" || $t_strCashierCompensation == "13")
										  {
											echo "<input name='t_strCashierCompensation' type='checkbox' value='1' checked>";
										  }
										  else
										  {
											echo "<input name='t_strCashierCompensation' type='checkbox' value='1' onClick='cashierChoices(this)'>";
										  }
									 }	
									 ?>
                                                  Compensation </span> </td>
                                                <td width="20%"> <span class="text"> 
                                                  <?  //Cashier module for update cashier assistant
									 $result = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$t_strEmpNumber'");
									 $row = mysql_fetch_array($result);
									 $t_strAccessPermission= $row['accessPermission'];
									 if ($t_strAccessPermission{0} == 1) {
										 list($t_strCashierUpdate)=array(substr($t_strAccessPermission,0,2));
										 if($t_strCashierUpdate == "02" || $t_strCashierUpdate == "12" || $t_strCashierUpdate == "23")
										  {
											echo "<input name='t_strCashierUpdate' type='checkbox' value='2' checked>";
										  }
										  else
										  {
											echo "<input name='t_strCashierUpdate' type='checkbox' value='2' onClick='cashierChoices(this)'>";
										  }
									 } else {
									 list($t_strCashierUpdate)=array(substr($t_strAccessPermission,0,2));
										 if($t_strCashierUpdate == "02" || $t_strCashierUpdate == "12" || $t_strCashierUpdate == "23")
										  {
											echo "<input name='t_strCashierUpdate' type='checkbox' value='2' checked>";
										  }
										  else
										  {
											echo "<input name='t_strCashierUpdate' type='checkbox' value='2' onClick='cashierChoices(this)'>";
										  }
									 }	
									 ?>
                                                  Update </span></td>
                                                <td width="14%"><span class="text">
                                                  <?  //Cashier module for reports cashier assistant
									 $result = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$t_strEmpNumber'");
									 $row = mysql_fetch_array($result);
									 $t_strAccessPermission= $row['accessPermission'];
									 if ($t_strAccessPermission{0} == 1) {
										 list($t_strCashierReport)=array(substr($t_strAccessPermission,0,2));
										 if($t_strCashierReport == "03" || $t_strCashierReport == "13" || $t_strCashierReport == "23")
										  {
											echo "<input name='t_strCashierReport' type='checkbox' value='3' checked>";
										  }
										  else
										  {
											echo "<input name='t_strCashierReport' type='checkbox' value='3' onClick='cashierChoices(this)'>";
										  }
									 } else {
									 list($t_strCashierReport)=array(substr($t_strAccessPermission,0,2));
										 if($t_strCashierReport == "03" || $t_strCashierReport == "13" || $t_strCashierReport == "23")
										  {
											echo "<input name='t_strCashierReport' type='checkbox' value='3' checked>";
										  }
										  else
										  {
											echo "<input name='t_strCashierReport' type='checkbox' value='3' onClick='cashierChoices(this)'>";
										  }
									 }	
									 ?>
                                                  </span> <span class="text">Reports</span></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="5">&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="5"> 
                                                  <?
									 if($t_strHRUserPermission == "Cashier Officer" || $t_strHRUserPermission == "")
									  {
									  	echo "<input name='t_strHRUserPermission' type='radio' value='Cashier Officer' checked onClick='cashierDisableDateCombo();'>";
									  }
									  else
									  {
									  	echo "<input name='t_strHRUserPermission' type='radio' value='Cashier Officer' onClick='cashierDisableDateCombo();'>";
									  }
									  ?>
                                                  <span class="text">Cashier Officer 
                                                  (Access all sections)</span></td>
                                              </tr>
                                              <tr> 
                                                <td>&nbsp;</td>
                                                <td><span class="text"> 
                                                  <?  //Cashier module for compensation cashier officer
									 $result = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$t_strEmpNumber'");
									 $row = mysql_fetch_array($result);
									 $t_strAccessPermission= $row['accessPermission'];
									 $t_strHRUserPermission = $row['userPermission'];
									 if ($t_strAccessPermission{0} == 1 && $t_strHRUserPermission{0} == "Cashier Officer") {
										 list($t_strCashierCompensation1)=array(substr($t_strAccessPermission,0,4));
										 if($t_strCashierCompensation1 == "0123" || $t_strCashierCompensation1 == "")
										  {
											echo "<input name='t_strCashierCompensation1' type='checkbox' value='0123' checked>";
										  }
										  else
										  {
											echo "<input name='t_strCashierCompensation1' type='checkbox' value='0123' onClick='cashierChoices(this)'>";
										  }
									 } else {
									 list($t_strCashierCompensation1)=array(substr($t_strAccessPermission,0,4));
										 if($t_strCashierCompensation1 == "0123")
										  {
											echo "<input name='t_strCashierCompensation1' type='checkbox' value='0123' checked>";
										  }
										  else
										  {
											echo "<input name='t_strCashierCompensation1' type='checkbox' value='0123' onClick='cashierChoices(this)'>";
										  }
									 }	
									 ?>
                                                  all sections </span></td>
                                                <td><span class="text"> </span></td>
                                                <td colspan="2">&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="5">&nbsp;</td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"> <? 
									}   //Endif ($t_intUserLevel)
									?>
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td class="paragraph">Employee 
                                                  No. :</td>
                                                <td width="63%"><select name="select">
                                                    <?php 
												$objUserAccount->comboEmpNumber($t_strEmpNumber);
												?>
                                                  </select></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph">Username 
                                                  :</td>
                                                <td><input name="t_strUserName" type="text" value="<? echo $t_strUserName; ?>" size="20" maxlength="20"></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph">Password 
                                                  :</td>
                                                <td><input name="t_strUserPassword" type="password" value="<? echo $t_strUserPassword; ?>" size="10" maxlength="8"> 
                                                  <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>"></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4" class="paragraph"> <div align="center"> 
                                              <input name="Submit" type="submit" value="Submit">
                                              <input name="Submit" type="submit" value="Cancel">
                                            </div></td>
                                        </tr>
                                      </table>
                                     <?
									 } else {
									 ?>
                                      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td width="248%" colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"><table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td width="27%" class="paragraph">Access 
                                                  Level :</td>
                                                <td width="73%"><select name="t_intUserLevel" size="1" id="t_intUserLevel" onChange="permissionRequirement(document.all.t_intUserLevel.value)">
                                                    <?
									  if ($t_intUserLevel == '2') 
									  {
									  ?>
                                                    <option value="2" selected>Cashier 
                                                    Module</option>
                                                    <?
									  } else { 
									  ?>
                                                    <option value="2">Cashier 
                                                    Module</option>
                                                    <?
									  }
									  ?>
                                                    <?
									  if ($t_intUserLevel == '3') 
									  {
									  ?>
                                                    <option value="3" selected>Chief 
                                                    Module</option>
                                                    <?
									  } else {
									  ?>
                                                    <option value="3">Chief Module</option>
                                                    <?
									  }
									  ?>
                                                    <?
									  if ($t_intUserLevel == '4') 
									  {
									  ?>
                                                    <option value="4" selected>Director 
                                                    Module</option>
                                                    <?
									  } else {
									  ?>
                                                    <option value="4">Director 
                                                    Module</option>
                                                    <?
									  }
									  ?>
                                                    <?
									  if ($t_intUserLevel == '5') 
									  {
									  ?>
                                                    <option value="5" selected>Employee 
                                                    Module</option>
                                                    <?
									  } else {
									  ?>
                                                    <option value="5">Employee 
                                                    Module</option>
                                                    <?
									  }
									  ?>
                                                    <?
									  if ($t_intUserLevel == '1') 
									  {
									  ?>
                                                    <option value="1" selected>HR 
                                                    Module</option>
                                                    <? 
									  } else {
									  ?>
                                                    <option value="1">HR Module</option>
                                                    <?
									  }
									  ?>
                                                    <?
									  if ($t_intUserLevel == '12') 
									  {
									  ?>
                                                    <option value="12" selected>HR&amp;Cashier 
                                                    Module</option>
                                                    <?
									  } else {
									  ?>
                                                    <option value="12">HR&amp;Cashier 
                                                    Module</option>
                                                    <?
									  }
									  ?>
                                                  </select> <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr; ?>"></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"><table width="60%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td colspan="4"> 
                                                  <? 
									if ($t_intUserLevel == 1)  // HR Module
									{
									?>
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td colspan="4"><input name="t_strHRUserPermission" type="radio" onClick="enableDateCombo();" value="HR Assistant" checked> 
                                                  <span class="text">Assistant 
                                                  </span></td>
                                              </tr>
                                              <tr> 
                                                <td width="12%" rowspan="2"><span class="text"> 
                                                  </span></td>
                                                <td width="27%"><input name="t_strNotification" type="checkbox" onClick="countChoices(this)" value="1"> 
                                                  <span class="text">Notification 
                                                  </span></td>
                                                <td width="24%"><input name="t_strAttendance" type="checkbox" onClick="countChoices(this)" value="3"> 
                                                  <span class="text">Attendance</span></td>
                                                <td width="37%"><input name="t_strLibraries" type="checkbox" onClick="countChoices(this)" value="5"> 
                                                  <span class="text">Libraries</span></td>
                                              </tr>
                                              <tr> 
                                                <td><input name="t_str201" type="checkbox" onClick="countChoices(this)" value="2"> 
                                                  <span class="text"> 201 Section</span> 
                                                </td>
                                                <td width="24%"><input name="t_strReports" type="checkbox" onClick="countChoices(this)" value="4"> 
                                                  <span class="text">Reports</span></td>
                                                <td width="37%"> <input name="t_strCompensation" type="checkbox" onClick="countChoices(this)" value="6"> 
                                                  <span class="text">Compensation 
                                                  </span></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="4"><span class="text"> 
                                                  </span></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="4"><input name="t_strHRUserPermission" type="radio" value="HR Officer" onClick="disableDateCombo();">
                                                  <span class="text"> HRMO </span></td>
                                              </tr>
                                              <tr> 
                                                <td>&nbsp;</td>
                                                <td><input name="t_strNotification1" type="checkbox" onClick="countChoices(this)" value="123456">
                                                  <span class="text">all sections 
                                                  </span></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="4"><span class="text"> 
                                                  </span></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td><table width="35%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td> 
                                                  <? 
									} elseif ($t_intUserLevel == 5)  // Employee Module
									{
									?>
                                                </td>
                                                <td width="57%"><select name="t_strAccessPermission" size="5" multiple style="width:120" disabled>
                                                    <option>EMPLOYEE MODULE...</option>
                                                    <option>-&gt; 201 Section</option>
                                                    <option>-&gt; Attendance Section</option>
                                                    <option>-&gt; Request Section</option>
                                                    <option>-&gt; Notification 
                                                    Section</option>
                                                  </select> <input name="t_strHRUserPermission" type="hidden" value="<? echo "Employee"; ?>"> 
                                                  <input name="t_strAccessPermission" type="hidden" value="<? echo "1234"; ?>"></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"><table width="35%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td width="43%"> 
                                                  <? 
									} elseif ($t_intUserLevel == 3)  // Chief Module
									{
									?>
                                                </td>
                                                <td width="57%"><select name="t_strAccessPermission" size="5" multiple disabled style="width:120">
                                                    <option>CHIEF MODULE...</option>
                                                    <option>-&gt; 201 Section</option>
                                                    <option>-&gt; Attendance Section</option>
                                                    <option>-&gt; Request Section</option>
                                                    <option>-&gt; Notification 
                                                    Section</option>
                                                  </select> <input name="t_strHRUserPermission" type="hidden" value="<? echo "Chief"; ?>"> 
                                                  <input name="t_strAccessPermission" type="hidden" value="<? echo "1234"; ?>"></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"><table width="35%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td width="42%"> 
                                                  <? 
									} elseif ($t_intUserLevel == 4)  // Director Module
									{
									?>
                                                </td>
                                                <td width="58%"><select name="t_strAccessPermission" size="4" multiple disabled style="width:120">
                                                    <option>DIRECTOR MODULE...</option>
                                                    <option>-&gt; 201 Section</option>
                                                    <option>-&gt; Request Section</option>
                                                    <option>-&gt; Notification 
                                                    Section</option>
                                                  </select> <input name="t_strHRUserPermission" type="hidden" id="t_strHRUserPermission" value="<? echo "Director"; ?>"> 
                                                  <input name="t_strAccessPermission" type="hidden" id="t_strAccessPermission" value="<? echo "134"; ?>"></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"><table width="35%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td width="43%"> <? 
									} elseif ($t_intUserLevel == 12)  // HR & Cashier Module
									{
									?>
                                                </td>
                                                <td width="57%"><select name="t_strAccessPermission" size="7" multiple disabled style="width:130">
                                                    <option>HR &amp; Cashier Module...</option>
                                                    <option value="Notification Section">-&gt; 
                                                    Notification Section</option>
                                                    <option value="201 Section">-&gt; 
                                                    201 Section</option>
                                                    <option value="Attendance Section">-&gt; 
                                                    Attendance Section</option>
                                                    <option value="Reports Section">-&gt; 
                                                    Reports Section</option>
                                                    <option value="Libraries Section">-&gt; 
                                                    Libraries Section</option>
                                                    <option value="Compensation Section">-&gt; 
                                                    Compensation Section</option>
                                                  </select> <input name="t_strHRUserPermission" type="hidden" value="<? echo "HR&Cashier Officer"; ?>"> 
                                                  <input name="t_strAccessPermission" type="hidden" value="<? echo "1234567"; ?>"></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"><table width="75%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td colspan="5"> 
                                                  <? 
									} else    //if ($t_intUserLevel == 2)  Cashier Module
									{
									?>
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td colspan="5"><input name="t_strHRUserPermission" type="radio" onClick="cashierEnableDateCombo();" value="Cashier Assistant" checked> 
                                                  <span class="text">Assistant</span></td>
                                              </tr>
                                              <tr> 
                                                <td width="11%">&nbsp;</td>
                                                <td width="24%"><input name="t_strCashierNotification" type="checkbox" onClick="cashierChoices(this)" value="0">
                                                  <span class="text">Notification</span></td>
                                                <td width="28%"><input name="t_strCashierCompensation" type="checkbox" onClick="cashierChoices(this)" value="1"> 
                                                  <span class="text">Compensation</span></td>
                                                <td width="18%"><input name="t_strCashierUpdate" type="checkbox" onClick="cashierChoices(this)" value="2"> 
                                                  <span class="text">Update</span></td>
                                                <td width="19%"> <input name="t_strCashierReport" type="checkbox" onClick="cashierChoices(this)" value="3"> 
                                                  <span class="text"> Reports</span></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="5">&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="5"><input name="t_strHRUserPermission" type="radio" value="Cashier Officer" onClick="cashierDisableDateCombo();"> 
                                                  <span class="text">Cashier Officer 
                                                  </span></td>
                                              </tr>
                                              <tr> 
                                                <td>&nbsp;</td>
                                                <td colspan="2"><span class="text"> 
                                                  <input name="t_strCashierCompensation1" type="checkbox" value="0123">
                                                  all sections</span></td>
                                                <td>&nbsp;</td>
                                                <td><span class="text"> </span></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="5">&nbsp;</td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"> 
                                            <? 
									}   //Endif ($t_intUserLevel)
									?>
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td><table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td width="39%" class="paragraph">Employee 
                                                  No. : </td>
                                                <td width="61%"> 
												<select name="t_strEmpNumber">
												<?php 
												$objUserAccount->comboEmpNumber($t_strEmpNumber);
												?>
												</select>
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph">Username 
                                                  :</td>
                                                <td><input name="t_strUserName" type="text" size="20" maxlength="20"></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph">Password 
                                                  :</td>
                                                <td><input name="t_strUserPassword" type="password" onKeyPress="checkCapsLock( event )" size="10" maxlength="4"> 
                                                  <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>"></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4" class="paragraph"> <div align="center"> 
                                              <input name="Submit" type="submit" value="ADD">
                                              <input name="Reset" type="reset" value="Clear">
                                            </div></td>
                                        </tr>
                                      </table>
                                        <?
								     }
								     ?>                                      
                                    </td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr></form>
                              </table></td>
                          </tr>
                          <tr> 
                            <td valign="top"><hr></td>
                          </tr>
                          <tr> 
                            <td valign="top"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td> 
                                    <?php
									$objUserAccount->viewUserAccount($strEmpNmbr, $t_strEmpNumber, $t_strUserName, $t_strUserName, $t_strUserPassword, $t_intUserLevel, $t_strUserPermission, $t_strCashierPermission, $t_strAccessPermission);   //Load viewUserAccount function
									?>
                                  </td>
                                </tr>
                              </table></td>
                          </tr>
                        </table>
                        <!-- InstanceEndEditable --></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="12" colspan="2"><table width="100%" height="13" border="0" cellpadding="0" cellspacing="0" bgcolor="#002E7F" id="OUTERTBL4">
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
</body>
<!-- InstanceEnd --></html>