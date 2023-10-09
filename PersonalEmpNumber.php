<?php 
/* 
File Name: PersonalEmpNumber.php
----------------------------------------------------------------------
Purpose of this file: 
To add employees information to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: November 02, 2004 (Version 2.0.0)
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
include("../hrmis/class/PersonalEmpNumber.php");
$objEmployee= new PersonalEmpNumber;
$objEmployee->setvar(array('strEmpNmbr'=>$strEmpNmbr, 'txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>date("n"), 'cboYear'=>date("Y"), 'strLetter'=>$strLetter)); //for maintain state
$objEmployee->trapButton($txtSearch, $strLetter, "Personalsearch.php", "Personalinformation.php");
$arrEmpPersonal = $objEmployee->checkGetEmpNmbr("201", $txtSearch, $optField, date("n"), date("Y"), 1, $p, $strLetter);

// -------------------------  employee number  ----------------------------------  //

$objEmployee->tblEmpAccount($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);		//  edit empNumber on tblEmpAccount
$objEmployee->tblEmpAddIncome($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);	//  edit empNumber on tblEmpAddIncome
$objEmployee->tblEmpAgencyShare($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);	//  edit empNumber on tblEmpAgencyShare
$objEmployee->tblEmpChild($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);		//  edit empNumber on tblEmpChild
$objEmployee->tblEmpDeduction($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);	//  edit empNumber on tblEmpDeduction
$objEmployee->tblEmpDeductRemit($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);	//  edit empNumber on tblEmpDeductRemit
$objEmployee->tblEmpDTR($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);			//  edit empNumber on tblEmpDTR
$objEmployee->tblEmpDuties($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);		//  edit empNumber on tblEmpDuties
$objEmployee->tblEmpExam($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);		//  edit empNumber on tblEmpExam
$objEmployee->tblEmpIncome($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);		//  edit empNumber on tblEmpIncome
$objEmployee->tblEmpLeave($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);		//  edit empNumber on tblEmpLeave
$objEmployee->tblEmpLeaveBalance($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);//  edit empNumber on tblEmpLeaveBalance
$objEmployee->tblEmpMeeting($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);		//  edit empNumber on tblEmpMeeting
$objEmployee->tblEmpMonetization($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);//  edit empNumber on tblEmpMonetization
$objEmployee->tblEmpOB($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);			//  edit empNumber on tblEmpOB
$objEmployee->tblEmpOvertime($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);	//  edit empNumber on tblEmpOvertime
$objEmployee->tblEmpPersonal($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);	//  edit empNumber on tblEmpPersonal
$objEmployee->tblEmpPicture($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);		//  edit empNumber on tblEmpPicture
$objEmployee->tblEmpPosition($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);	//  edit empNumber on tblEmpPosition
$objEmployee->tblEmpReference($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);	//  edit empNumber on tblEmpReference
$objEmployee->tblEmpRequest($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);		//  edit empNumber on tblEmpRequest
$objEmployee->tblEmpSchool($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);		//  edit empNumber on tblEmpSchool
$objEmployee->tblEmpTraining($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);	//  edit empNumber on tblEmpTraining
$objEmployee->tblEmpTravelOrder($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);	//  edit empNumber on tblEmpTravelOrder
$objEmployee->tblEmpTripTicket($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);	//  edit empNumber on tblEmpTripTicket
$objEmployee->tblEmpVoluntaryWork($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);//  edit empNumber on tblEmpVoluntaryWork
$objEmployee->tblIncomeDetails($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);	//  edit empNumber on tblIncomeDetails
$objEmployee->tblNonTaxable($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);		//  edit empNumber on tblNonTaxable
$objEmployee->tblSection($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);		//  edit empNumber on tblSection
$objEmployee->tblServiceRecord($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber);	//  edit empNumber on tblServiceRecord
?>
<html><!-- InstanceBegin template="/Templates/Personaltmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/class/JSgeneral.php");
?>
<script language="JavaScript">

function validateEmpNumber()
{
if (document.frmEmpNumber.t_strOldEmpNumber.value=="")
{
alert("Please input employee number!")
return false
}

return true
}

</script>
<!-- InstanceEndEditable --> 
<!-- Design/Images Made By : Angelo Campos Evangelista  -->
<!-- Template Made By : Pearliezl Samoy Dy Tioco  -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!-- onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar()" onFocus="statusBar()" -->

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
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/education2.jpg','images/trainings2.jpg','images/examinations2.jpg','images/position2.jpg','images/logout2.jpg','images/family-background2.jpg','images/work-experience2.jpg','images/voluntary-work2.jpg','images/personal-information2.jpg','images/other-information2.jpg','images/notificationover.jpg','images/201click.jpg','images/attendanceover.jpg','images/reportsover.jpg','images/librariesover.jpg','images/compensationover.jpg','images/dutiesandresponsibilities2.jpg','images/editmodifyemployeenumber2.jpg'); history.forward()" onContextMenu="return false"><div align="center"> 
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr> 
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="tblHRMODULE">
        <tr> 
          <td valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0" id="tblModule">
              <tr> 
                <td><img src="images/hrmodule.jpg" width="170" height="23"></td>
              </tr>
            </table></td>
          <td valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0" id="tblSECTION1">
              <tr> 
                <td valign="bottom"><table border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <?   //  HR module for 201 templates
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
                      <td><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION1','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="NOTIFICATION1" name="NOTIFICATION1" width="96" height="29" border="0"></a></td>
                      <td><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE1','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE1" name="PROFILE1" width="67" height="29" border="0"></a></td>
                      <td><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE1','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="ATTENDANCE1" name="ATTENDANCE1" width="88" height="29" border="0"></a></td>
                      <td><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS1','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS1" name="REPORTS1" width="60" height="29" border="0"></a></td>
                      <td><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES1','','images/librariesover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/libraries.jpg" alt="LIBRARIES1" name="LIBRARIES1" width="67" height="29" border="0"></a></td>
                      <td><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION1','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION1" name="COMPENSATION1" width="104" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 12) 
{
?>
                  <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNotificationProfile">
                    <tr> 
                      <td><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>%20" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION2','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="NOTIFICATION2" name="NOTIFICATION2" width="96" height="29" border="0"></a></td>
                      <td width="55%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission;?>%20" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE2','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE2" name="PROFILE2" width="67" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 23) 
{
?>
                  <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblPROFILEATTENDANCE">
                    <tr> 
                      <td><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE3','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE3" name="PROFILE3" width="67" height="29" border="0"></a></td>
                      <td width="73%"><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE3','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="ATTENDANCE3" name="ATTENDANCE3" width="88" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 24) 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblPROFILEREPORTS">
                    <tr> 
                      <td width="59%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE4','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE4" name="PROFILE4" width="67" height="29" border="0"></a></td>
                      <td width="41%"><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS4','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS4" name="REPORTS4" width="60" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 25) 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblPROFILELIBRARIES">
                    <tr> 
                      <td width="59%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE5','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE5" name="PROFILE5" width="67" height="29" border="0"></a></td>
                      <td width="41%"><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES5','','images/librariesover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/libraries.jpg" alt="LIBRARIES5" name="LIBRARIES5" width="67" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 26) 
{
?>
                  <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblPROFILECOMPENSATION">
                    <tr> 
                      <td width="14%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE6','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE6" name="PROFILE6" width="67" height="29" border="0"></a></td>
                      <td width="86%"><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION6','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION6" name="COMPENSATION6" width="104" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr>
                <td valign="bottom">
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 2) 
{
?>
                  <table width="10%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblPROFILECOMPENSATION">
                    <tr> 
                      <td width="14%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE61','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE6" name="PROFILE61" width="67" height="29" border="0" id="PROFILE61"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr>
                <td valign="bottom">
                  <?   //  HR module for 201 templates
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
                      <td><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION11','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="NOTIFICATION1" name="NOTIFICATION11" width="96" height="29" border="0" id="NOTIFICATION11"></a></td>
                      <td><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE11','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE1" name="PROFILE11" width="67" height="29" border="0" id="PROFILE11"></a></td>
                      <td><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE11','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="ATTENDANCE1" name="ATTENDANCE11" width="88" height="29" border="0" id="ATTENDANCE11"></a></td>
                      <td><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS11','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS1" name="REPORTS11" width="60" height="29" border="0" id="REPORTS11"></a></td>
                      <td><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES11','','images/librariesover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/libraries.jpg" alt="LIBRARIES1" name="LIBRARIES11" width="67" height="29" border="0" id="LIBRARIES11"></a></td>
                      <td><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION11','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION1" name="COMPENSATION11" width="104" height="29" border="0" id="COMPENSATION11"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
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
                <td width="16%" height="348"><table width="150" height="348" border="0" cellpadding="0" cellspacing="0" bgcolor="#E9F3FE">
                    <tr> 
                      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td><table width="90%" height="339" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="NAVTBL">
                                <tr> 
                                  <td height="339" valign="top"> <form name="frm201" method="get" action="Personalinformation.php?strEmpNmbr=<? echo $strEmpNmbr;?>">
                                      <input name="txtSearch" type="text" size="15" maxlength="30" value="<? echo $txtSearch;?>">
                                      <a href="Personalinformation.php?strEmpNmbr=<? echo $strEmpNmbr?>" onMouseOut="statusBar()" onFocus="statusBar()" onMouseOver=" statusBar(); return true;" onClick="statusBar();"> 
                                      <input type="image" src="images/go.jpg" alt="Go" name="Go" width="19" height="17" border="0" align="absmiddle">
                                      </a> 
                                      <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr;?>">
                                      <br>
                                      <?
									  if($optField == "empNmbr" || $optField == "")
									  {
									  	echo "<input name='optField' type='radio' value='empNmbr' checked>";
									  }
									  else
									  {
									  	echo "<input name='optField' type='radio' value='empNmbr'>";
									  }
									  ?>
                                      Employee Number<br>
                                      <?
									  if($optField == "empName")
									  {
									  	echo "<input name='optField' type='radio' value='empName' checked>";
									  }
									  else
									  {
									  	echo "<input name='optField' type='radio' value='empName'>";
									  }
									  ?>
                                      Employee Name<br>
                                      <br>
                                      &nbsp;<br>
                                    </form>
                                    <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == 1234567) 
{
?>
                                    <table width="108" height="187" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td><a href="Personalinformation.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('profile','','images/personal-information2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/personal-information.jpg" alt="profile" name="profile" width="108" height="27" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalfamily.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('familybackground','','images/family-background2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/family-background.jpg" alt="familybackground" name="familybackground" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personaleducation.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Education','','images/education2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/education1.jpg" alt="Education" name="Education" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalexaminations.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('examinations','','images/examinations2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/examinations1.jpg" alt="examinations" name="examinations" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalworkexperience.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('workexperience','','images/work-experience2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/work-experience.jpg" alt="workexperience" name="workexperience" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalvoluntarywork.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('voluntarywork','','images/voluntary-work2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/voluntary-work.jpg" alt="voluntarywork" name="voluntarywork" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personaltrainings.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Trainings','','images/trainings2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/trainings1.jpg" alt="Trainings" name="Trainings" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalotherinfo.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('otherinformation','','images/other-information2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/other-information.jpg" alt="otherinformation" name="otherinformation" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="10"><a href="Personalpositiondetails.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PositionDetails','','images/position2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/position1.jpg" alt="Position Details" name="PositionDetails" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="5"><a href="Personalduties.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('duties&responsibilities','','images/dutiesandresponsibilities2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/dutiesandresponsibilities.jpg" alt="duties&responsibilities" name="duties&responsibilities" width="108" height="27" border="0"></a></td>
                                      </tr>
                                      <tr>
                                        <td height="5"><a href="PersonalEmpNumber.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore();statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('empNumber','','images/editmodifyemployeenumber2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/editmodifyemployeenumber.jpg" alt="empNumber" name="empNumber" width="108" height="27" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="index.php" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('logout','','images/logout2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/logout.jpg" alt="logout" name="logout" width="108" height="20" border="0"></a></td>
                                      </tr>
                                    </table>
<? 
} else { 
?>
                                    <table width="108" height="187" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td><a href="Personalinformation.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('profile1','','images/personal-information2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/personal-information.jpg" alt="profile" name="profile1" width="108" height="27" border="0" id="profile1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalfamily.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('familybackground1','','images/family-background2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/family-background.jpg" alt="familybackground" name="familybackground1" width="108" height="20" border="0" id="familybackground1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personaleducation.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Education1','','images/education2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/education1.jpg" alt="Education" name="Education1" width="108" height="20" border="0" id="Education1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalexaminations.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('examinations1','','images/examinations2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/examinations1.jpg" alt="examinations" name="examinations1" width="108" height="20" border="0" id="examinations1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalworkexperience.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('workexperience1','','images/work-experience2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/work-experience.jpg" alt="workexperience" name="workexperience1" width="108" height="20" border="0" id="workexperience1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalvoluntarywork.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('voluntarywork1','','images/voluntary-work2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/voluntary-work.jpg" alt="voluntarywork" name="voluntarywork1" width="108" height="20" border="0" id="voluntarywork1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personaltrainings.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Trainings1','','images/trainings2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/trainings1.jpg" alt="Trainings" name="Trainings1" width="108" height="20" border="0" id="Trainings1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalotherinfo.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('otherinformation1','','images/other-information2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/other-information.jpg" alt="otherinformation" name="otherinformation1" width="108" height="20" border="0" id="otherinformation1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="10"><a href="Personalpositiondetails.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PositionDetails1','','images/position2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/position1.jpg" alt="Position Details" name="PositionDetails1" width="108" height="20" border="0" id="PositionDetails1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="5"><a href="Personalduties.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('duties','','images/dutiesandresponsibilities2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/dutiesandresponsibilities.jpg" alt="duties" name="duties" width="108" height="27" border="0"></a></td>
                                      </tr>
                                      <tr>
                                        <td height="5"><a href="PersonalEmpNumber.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('empNumber2','','images/editmodifyemployeenumber2.jpg',1);statusBar(); return true;" onClick="statusBar();"><img src="images/editmodifyemployeenumber.jpg" alt="empNumber2" name="empNumber2" width="108" height="27" border="0"></a></td>
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
                <td width="84%" valign="top"><table width="99%" height="369" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODYTBL">
                    <tr> 
                      <td height="339"><!-- InstanceBeginEditable name="BODY" -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td height="27" class="header"><p>MODIFY EMPLOYEE 
                                NUMBER </p></td>
                          </tr>
                          <tr> 
                            <td class="header"><table width="40%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td> 
                                    <?
								  $objEmployee->navigateEmployee(date("n"), date("Y"));
								  ?>
                                  </td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td> 
                              <? 
						 if ($Submit == 'Update') 
						 { 
						 	echo "Employee number has been updated. Thanks You.";
						 } else {
						  ?>
                            </td>
                          </tr>
                          <form name="frmEmpNumber" method="post" action="<? $PHP_SELF; ?>" onSubmit="return validateEmpNumber()">
                            <tr> 
                              <td><table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" class="border">
                                  <tr> 
                                    <td width="481" height="73"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCFF">
                                        <tr> 
                                          <td width="141" class="paragraph">Employee 
                                            Number : </td>
                                          <td width="339"><strong>&nbsp;<? echo $arrEmpPersonal['empNumber']; ?> 
                                            <input name="txtSearch" type="hidden" id="txtSearch" value="<? echo $txtSearch; ?>">
                                            <input name="optField" type="hidden" value="<? echo $optField; ?>">
                                            <input name="t_strEmpNumber" type="hidden" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                            <input name="p" type="hidden" id="p" value="<? echo $p; ?>">
                                            </strong></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Employee Name 
                                            : </td>
                                          <td><strong>&nbsp;<? echo $arrEmpPersonal['surname']  . ", " . $arrEmpPersonal['firstname'] . "  ". $arrEmpPersonal['middlename']; ?></strong></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Division : </td>
                                          <td><strong>&nbsp;<? echo $arrEmpPersonal['divisionCode']; ?></strong></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Position : </td>
                                          <td><strong>&nbsp;<? echo $arrEmpPersonal['positionCode'] ; ?></strong></td>
                                        </tr>
                                      </table></td>
                                    <td width="72" bgcolor="#99CCFF"> <img src="Getdata.php?t_strEmpNumber=<? echo $arrEmpPersonal["empNumber"]; ?>"  width="70" height="70"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr> 
                              <td><hr></td>
                            </tr>
                            <tr> 
                              <td>&nbsp; </td>
                            </tr>
                            <tr> 
                              <td> <table width="90%" border="1" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td colspan="3">&nbsp;</td>
                                  </tr>
                                  <tr class="alterrow"> 
                                    <td width="34%"> Enter Employee Number :</td>
                                    <td width="32%"><input name="t_strEmpNumber" type="text" id="t_strEmpNumber" value="<? echo $arrEmpPersonal['empNumber']; ?>" size="20" maxlength="15" readonly="readonly"> 
                                    </td>
                                    <td width="34%"><input name="t_strOldEmpNumber" type="text" id="t_strOldEmpNumber" size="20" maxlength="15"> 
                                      <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr; ?>"> 
                                      <span class="required">* </span></td>
                                  </tr>
                                  <tr> 
                                    <td colspan="3">&nbsp;</td>
                                  </tr>
                                  <tr class="alterrow"> 
                                    <td colspan="3"><div align="center"> 
                                        <input name="txtSearch" type="hidden" id="txtSearch" value="<? echo $txtSearch; ?>">
                                        <input name="optField" type="hidden" id="optField" value="<? echo $optField; ?>">
                                        <input name="t_strEmpNumber" type="hidden" id="t_strEmpNumber" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                        <input name="p" type="hidden" value="<? echo $p; ?>">
                                        <input type="submit" name="Submit" value="Update">
                                      </div></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr> 
                              <td>&nbsp;</td>
                            </tr>
                          </form>
                          <tr> 
                            <td> 
                              <? } ?>
                            </td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td><table width="10%" border="0" align="right" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td> 
                                    <? $objEmployee->output(); ?>
                                  </td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td> </td>
                          </tr>
                        </table>
                        <!-- InstanceEndEditable --></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="13" colspan="2"><table width="100%" height="13" border="0" cellpadding="0" cellspacing="0" bgcolor="#002E7F" id="OUTERTBL4">
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
