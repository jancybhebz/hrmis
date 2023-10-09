<?php 
/* 
File Name: Salaryschedule.php
----------------------------------------------------------------------
Purpose of this file: 
To add, edit and delete salary schedule to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: October 24, 2003
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
include("../hrmis/class/Salaryschedule.php");   //Load database connection
$objSalary= new salarySchedule;   //Load salary schedule function
$objSalary->addSalarySchedule($strEmpNmbr, $t_intSalaryGradeNumber, $t_intStepNumber, $t_intActualSalary, $Submit); //Load salary schedule function
$objSalary->editSalarySchedule($strEmpNmbr, $t_intSalaryGradeNumber, $t_intStepNumber, $t_intActualSalary, $Submit, $t_intOldSalaryGradeNumber, $t_intOldStepNumber, $t_intOldActualSalary);  //edit salary schedule
$strConfirm = $objSalary->deleteSalarySchedule($strEmpNmbr, $t_intSalaryGradeNumber, $t_intStepNumber, $t_intActualSalary, $Submit); //Load salary schedule function
?>
<html><!-- InstanceBegin template="/Templates/hrmistmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/class/JSgeneral.php");
?>
<script language="JavaScript">
<!-- Begin
nextfield = "t_intSalaryGradeNumber"; // name of first box on page
netscape = "";
ver = navigator.appVersion; len = ver.length;
for(iln = 0; iln < len; iln++) if (ver.charAt(iln) == "(") break;
netscape = (ver.charAt(iln+1).toUpperCase() != "C");

function keyDown(DnEvents) { // handles keypress
// determines whether Netscape or Internet Explorer
k = (netscape) ? DnEvents.which : window.event.keyCode;
if (k == 13) { // enter key pressed
if (nextfield == 'Submit') return true; // submit, we finished all fields
else { // we're not done yet, send focus to next box
eval('document.frmSalarySchedule.' + nextfield + '.focus()');
return false;
      }
   }
}
document.onkeydown = keyDown; // work together to analyze keystrokes
if (netscape) document.captureEvents(Event.KEYDOWN|Event.KEYUP);
//  End -->


function validateNumber(field) 
{
	var valid = "0123456789"
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Only numbers are accepted!");
	field.focus();
	field.select();
    }
}

function validateAmount(field) 
{
	var valid = "0123456789'+.+'"
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Only numbers and period/point are accepted!");
	field.focus();
	field.select();
    }
}

function validate(){
var digits=".0123456789"
var temp
if (document.frmSalarySchedule.t_intSalaryGradeNumber.value=="") {
alert("Please input salary grade number!")
return false
} else if (document.frmSalarySchedule.t_intStepNumber.value=="") {
alert("Please input step number!")
return false
} else if (document.frmSalarySchedule.t_intActualSalary.value=="") {
alert("Please input actual salary!")
return false
}

for (var i=0;i<document.frmSalarySchedule.t_intSalaryGradeNumber.value.length;i++){
temp=document.frmSalarySchedule.t_intSalaryGradeNumber.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert("Invalid salary grade number !")
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
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODY">
                          <tr> 
                            <td height="22" class="header"><p>SALARY SCHEDULE</p></td>
                          </tr>
                          <tr> 
                            <td valign="top"> 
                              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <form action="<?php $PHP_SELF; ?>" method="post" name="frmSalarySchedule" onSubmit="return validate()">
                                  <? 
								 if ($strConfirm)
								 {
								 ?>
                                  <tr class="titlebar"> 
                                    <td colspan="4"><div align="center">Are you 
                                        sure you want to delete <? echo $t_intSalaryGradeNumber; ?>, 
                                        <? echo $t_intStepNumber; ?> and <? echo $t_intActualSalary; ?> 
                                        ??? 
                                        <input name="t_intSalaryGradeNumber" type="hidden" value="<? echo $t_intSalaryGradeNumber; ?>">
                                        <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr; ?>">
                                      </div></td>
                                  </tr>
                                  <tr> 
                                    <td colspan="4" class="paragraph"><div align="center"> 
                                        <input type="submit" name="Submit" value="OK">
                                        <input type="submit" name="Submit" value="Cancel">
                                      </div></td>
                                  </tr>
                                  <?
								 } 
								    elseif($Submit == 'Edit')
								    {
								?>
                                  <tr> 
                                    <td weight="270" colspan="3" class="paragraph">Salary Grade 
                                      Number : </td>
                                    <td ><input name="t_intSalaryGradeNumber" type="text" value="<? echo "$t_intSalaryGradeNumber"; ?>" size="5" maxlength="2" onBlur="validateNumber(this)">
                                      <span class="required"> *</span> </td>
                                  </tr>
                                  <tr> 
                                    <td colspan="3" class="paragraph">Step Number 
                                      :</td>
                                    <td><input name="t_intStepNumber" type="text" value="<? echo "$t_intStepNumber"; ?>" size="5" maxlength="2" onBlur="validateNumber(this)">
                                      <span class="required"> *</span> </td>
                                  </tr>
                                  <tr> 
                                    <td colspan="3" class="paragraph">Actual Salary 
                                      :</td>
                                    <td> <input name="t_intActualSalary" type="text" value="<? echo "$t_intActualSalary"; ?>" size="20" maxlength="10" onBlur="validateAmount(this)">
                                      <span class="required"> *</span> 
                                      <input name="t_intOldSalaryGradeNumber" type="hidden" value="<? echo "$t_intSalaryGradeNumber"; ?>">
                                      <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td colspan="4" class="paragraph">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td colspan="4" class="paragraph"><div align="center"> 
                                        <input type="submit" name="Submit" value="Submit">
                                        <input type="submit" name="Submit" value="Cancel">
                                      </div></td>
                                  </tr>
                                  <?
									} else {
									?>
                                  <tr> 
                                    <td weight="270" colspan="3" class="paragraph">Salary Grade 
                                      Number :</td>
                                    <td><input name="t_intSalaryGradeNumber" type="text" size="5" maxlength="2" onFocus="nextfield ='t_intStepNumber';" onBlur="validateNumber(this)">
                                      <span class="required"> *</span> </td>
                                  </tr>
                                  <tr> 
                                    <td colspan="3" class="paragraph">Step Number 
                                      :</td>
                                    <td><input name="t_intStepNumber" type="text" size="5" maxlength="2" onFocus="nextfield ='t_intActualSalary';" onBlur="validateNumber(this)">
                                      <span class="required"> *</span> </td>
                                  </tr>
                                  <tr> 
                                    <td colspan="3" class="paragraph">Actual Salary 
                                      :</td>
                                    <td> <input name="t_intActualSalary" type="text" size="20" maxlength="10" onFocus="nextfield ='Submit';" onBlur="validateAmount(this)">
                                      <span class="required"> *</span> 
                                      <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr; ?>"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td colspan="4" class="paragraph">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td colspan="4" class="paragraph"><div align="center"> 
                                        <input name="Submit" type="submit" value="ADD">
                                        <input type="reset" name="Reset" value="Clear">
                                      </div></td>
                                  </tr>
                                  <?
								    }
								    ?>
                                </form>
                              </table></td>
                          </tr>
                          <tr> 
                            <td height="13" valign="top"><hr></td>
                          </tr>
                          <tr> 
                            <td height="6" valign="top">&nbsp; </td>
                          </tr>
                          <tr>
                            <td height="7" valign="top"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td width="6%" class="alterrow">SG</td>
                                  <td width="11%" class="alterrow">Step 1</td>
                                  <td width="11%" class="alterrow">Step 2</td>
                                  <td width="11%" class="alterrow">Step 3</td>
                                  <td width="11%" class="alterrow">Step 4</td>
                                  <td width="11%" class="alterrow">Step 5</td>
                                  <td width="11%" class="alterrow">Step 6</td>
                                  <td width="11%" class="alterrow">Step 7</td>
                                  <td width="11%" class="alterrow">Step 8 </td>
                                </tr>
                                <tr> 
                                  <td colspan="9">&nbsp;</td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG1StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG1StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG1StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG1StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG1StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG1StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG1StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG1StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG2StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG2StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG2StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG2StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG2StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG2StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG2StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG2StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG3StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG3StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG3StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG3StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG3StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG3StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG3StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG3StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG4StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG4StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG4StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG4StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG4StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG4StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG4StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG4StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG5StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG5StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG5StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG5StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG5StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG5StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG5StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG5StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG6StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG6StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG6StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG6StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG6StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG6StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG6StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG6StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG7StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG7StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG7StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG7StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG7StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG7StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG7StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG7StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeEight($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG8StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG8StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG8StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG8StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG8StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG8StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG8StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG8StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeNine($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG9StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG9StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG9StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG9StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG9StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG9StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG9StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG9StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeTen($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG10StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG10StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG10StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG10StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG10StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG10StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG10StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG10StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeEleven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG11StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG11StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG11StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG11StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG11StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG11StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG11StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG11StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeTwelve($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG12StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG12StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG12StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG12StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG12StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG12StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG12StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG12StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeThirteen($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG13StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG13StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG13StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG13StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG13StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG13StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG13StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG13StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeFourteen($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG14StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG14StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG14StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG14StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG14StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG14StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG14StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG14StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeFifteen($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG15StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG15StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG15StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG15StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG15StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG15StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG15StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG15StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeSixteen($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG16StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG16StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG16StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG16StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG16StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG16StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG16StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG16StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeSeventeen($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG17StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG17StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG17StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG17StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG17StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG17StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG17StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG17StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeEighteen($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG18StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG18StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG18StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG18StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG18StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG18StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG18StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG18StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeNineteen($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG19StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG19StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG19StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG19StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG19StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG19StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG19StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG19StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeTwenty($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG20StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG20StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG20StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG20StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG20StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG20StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG20StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG20StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeTwentyOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG21StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG21StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG21StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG21StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG21StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG21StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG21StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG21StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeTwentyTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG22StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG22StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG22StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG22StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG22StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG22StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG22StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG22StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeTwentyThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG23StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG23StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG23StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG23StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG23StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG23StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG23StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG23StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeTwentyFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG24StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG24StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG24StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG24StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG24StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG24StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG24StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG24StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeTwentyFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG25StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG25StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG25StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG25StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG25StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG25StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG25StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG25StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeTwentySix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG26StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG26StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG26StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG26StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG26StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG26StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG26StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG26StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeTwentySeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG27StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG27StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG27StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG27StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG27StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG27StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG27StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG27StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeTwentyEight($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG28StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG28StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG28StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG28StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG28StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG28StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG28StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG28StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeTwentyNine($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG29StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG29StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG29StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG29StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG29StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG29StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG29StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG29StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeThirty($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG30StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG30StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG30StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG30StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG30StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG30StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG30StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG30StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeThirtyOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG31StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG31StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG31StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG31StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG31StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG31StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG31StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG31StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeThirtyTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG32StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG32StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG32StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG32StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG32StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG32StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG32StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG32StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr class="border"> 
                                  <td> 
                                    <? $objSalary->viewSalaryGradeThirtyThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG33StepNumberOne($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG33StepNumberTwo($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG33StepNumberThree($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG33StepNumberFour($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG33StepNumberFive($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG33StepNumberSix($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG33StepNumberSeven($strEmpNmbr); ?>
                                  </td>
                                  <td> 
                                    <? $objSalary->viewSG33StepNumberEight($strEmpNmbr); ?>
                                  </td>
                                </tr>
                                <tr> 
                                  <td colspan="9">&nbsp;</td>
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
