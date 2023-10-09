<?php 
/* 
File Name: Personalotherinfo.php
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
Date of Revision: March 18, 2004 (Version 2.0.0)
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
include("../hrmis/class/Personalotherinfo.php");
$objEmployee= new personalOtherInfo;
$objEmployee->setvar(array('strEmpNmbr'=>$strEmpNmbr, 'txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>date("n"), 'cboYear'=>date("Y"), 'strLetter'=>$strLetter)); //for maintain state
$objEmployee->trapButton($txtSearch, $strLetter, "Personalsearch.php", "Personalinformation.php");
$arrEmpPersonal = $objEmployee->checkGetEmpNmbr("201", $txtSearch, $optField, date("n"), date("Y"), 1, $p, $strLetter);

// -------------------------  Skills / Recognition / Organization   ----------------------------------  //

$objEmployee->editSkills($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strSkills, $t_strNADR, $t_strMIAO, $t_strEmpNumber, $Submit, $t_strOldSkills);  //edit employee other information

// -------------------------  Legal Information   ----------------------------------  //

$objEmployee->editLegalInfo($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strRelatedThird, $t_strRelatedFourth, $t_strRelatedDegreeParticulars, $t_strAdminCase, $t_strAdminCaseParticulars, $t_strViolateLaw, $t_strViolateLawParticulars, $t_strForcedResign, $t_strForcedResignParticulars, $t_strCandidate, $t_strCandidateParticulars, $t_strIndigenous, $t_strIndigenousParticulars, $t_strDisabled, $t_strDisabledParticulars, $t_strSoloParent, $t_strSoloParentParticulars, $t_strEmpNumber, $Submit, $t_strOldEmpNumber, $t_strOldRelatedThird);   //Edit employee legal information

// -------------------------  Character Reference   ----------------------------------  //

$objEmployee->addReference($strEmpNmbr, $t_strEmpNumber, $t_strRefName, $t_strRefAddress, $t_intRefTelephone, $Submit);   //Add employee reference
$objEmployee->editReference($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strEmpNumber, $t_strRefName, $t_strRefAddress, $t_intRefTelephone, $Submit, $t_strOldRefName, $t_strOldEmpNumber); //edit employee reference									 				
$strConfirm=$objEmployee->deleteReference($strEmpNmbr, $t_strEmpNumber, $t_strRefName, $t_strRefAddress, $t_intRefTelephone, $Submit); //Delete employee reference

// -------------------------  Pledge/Oath taking   ----------------------------------  //

$objEmployee->editPledge($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strSignature, $t_dtmDateAccMonth, $t_dtmDateAccDay, $t_dtmDateAccYear, $t_strComTaxNumber, $t_strIssuedAt, $t_dtmIssuedOnMonth, $t_dtmIssuedOnDay, $t_dtmIssuedOnYear, $t_strEmpNumber, $Submit, $t_strOldComTaxNumber);  //edit employee's pledge details
?>
<html><!-- InstanceBegin template="/Templates/Personaltmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/class/JSgeneral.php");
?>
<script language="JavaScript">

function validateCharacter(field) 
{
	var valid = "ABCDEFGHIJKLMNOPQRSTUVWXYZ'+ +'abcdefghijklmnopqrstuvwxyz'+."
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Only characters are accepted!");
	field.focus();
	field.select();
    }
}

function validateTelephone(field) 
{
	var valid = "0123456789'+-+'"
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Only numbers and dash are accepted!");
	field.focus();
	field.select();
    }
}

function validateAddress(field) 
{
	var valid = "ABCDEFGHIJKLMNOPQRSTUVWXYZ'+ +'abcdefghijklmnopqrstuvwxyz0123456789'+-+',."
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Only characters, numbers, period, commas and dash are accepted!");
	field.focus();
	field.select();
    }
}

function validateTaxNumber(field) 
{
	var valid = "ABCDEFGHIJKLMNOPQRSTUVWXYZ'+ +'abcdefghijklmnopqrstuvwxyz0123456789'+-+'"
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Only characters, numbers and dash are accepted!");
	field.focus();
	field.select();
    }
}

function validate(){
var digits=".0123456789"
var temp
if (document.frmReference.t_strRefName.value=="") {
alert("Please input name of reference!")
return false
} else if (document.frmReference.t_strRefAddress.value=="") {
alert("Please input address!")
return false
} else if (document.frmReference.t_intRefTelephone.value=="") {
alert("Please input telephone!")
return false
}

for (var i=0;i<document.frmReference.t_intRefTelephone.value.length;i++){
temp=document.frmReference.t_intRefTelephone.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert("Invalid telephone !")
return false
      }
   }

return true
}

// ------  legal information -----  //

function DegreeParticulars()
{
	document.all.t_strRelatedDegreeParticulars.focus();
}
function AdminCaseParticulars()
{
	document.all.t_strAdminCaseParticulars.focus();
}
function ViolateLawParticulars()
{
	document.all.t_strViolateLawParticulars.focus();
}
function ForcedResignParticulars()
{
	document.all.t_strForcedResignParticulars.focus();
}
function CandidateParticulars()
{
	document.all.t_strCandidateParticulars.focus();
}
function IndigenousParticulars()
{
	document.all.t_strIndigenousParticulars.focus();
}
function DisabledParticulars()
{
	document.all.t_strDisabledParticulars.focus();
}
function SoloParentParticulars()
{
	document.all.t_strSoloParentParticulars.focus();
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
                            <td height="25"><p class="header">OTHER INFORMATION</p>
                              <table width="40%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td> 
                                    <?
								  $objEmployee->navigateEmployee(date("n"), date("Y"));
								  ?>
                                  </td>
                                </tr>
                                <tr> 
                                  <td>&nbsp;</td>
                                </tr>
                              </table>
                              <table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" class="border">
                                <tr> 
                                  <td width="480" height="73"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCFF">
                                      <tr> 
                                        <td width="141" class="paragraph">Employee 
                                          Number : </td>
                                        <td width="339"><strong>&nbsp;<? echo $arrEmpPersonal['empNumber']; ?> 
                                          <input name="txtSearch" type="hidden" value="<? echo $txtSearch; ?>">
                                          <input name="optField" type="hidden" value="<? echo $optField; ?>">
                                          <input name="t_strEmpNumber" type="hidden" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                          <input name="p" type="hidden" value="<? echo $p; ?>">
                                          </strong></td>
                                      </tr>
                                      <tr> 
                                        <td class="paragraph">Employee Name : 
                                        </td>
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
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td width="7%" height="21"> <img src="images/skills_organization.gif" width="22" height="22"></td>
                                        <td width="93%" class="note">SKILLS / 
                                          RECOGNITIONS / ORGANIZATIONS</td>
                                      </tr>
                                    </table>
                                    <? if ($Submit == 'EDIT') { ?>
                                    <table width="90%" border="1" align="center" cellpadding="0" cellspacing="0">
                                      <form action="<? $PHP_SELF; ?>" method="post" name="frmSkills">
                                        <tr> 
                                          <td colspan="3">&nbsp;</td>
                                        </tr>
                                        <tr class="alterrow"> 
                                          <td width="34%">Special Skills / Hobbies</td>
                                          <td width="33%">Non-Academic Distinctions 
                                            / Recognition</td>
                                          <td width="33%">Membership in Association 
                                            / Organization</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="3"><input name="t_strEmpNumber" type="hidden" value="<? echo "$t_strEmpNumber"; ?>"></td>
                                        </tr>
                                        <tr class="border"> 
                                          <td> <textarea name="t_strSkills" maxlength="10000" cols="20" onBlur="validateAddress(this)"><? echo "$t_strSkills"; ?></textarea> 
                                            <input name="t_strOldSkills" type="hidden" value="<? echo "$t_strSkills"; ?>"> 
                                          </td>
                                          <td><textarea name="t_strNADR" cols="20" onBlur="validateAddress(this)"><? echo "$t_strNADR"; ?></textarea></td>
                                          <td> <textarea name="t_strMIAO" cols="20" onBlur="validateAddress(this)"><? echo "$t_strMIAO"; ?></textarea> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td colspan="3">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="3"><div align="center"> 
                                              <input type="submit" name="Submit" value="Submit">
                                            </div></td>
                                        </tr>
                                      </form>
                                    </table>
                                    <? } else { ?>
                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td> 
                                          <? $objEmployee->viewSkills($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strSkills, $t_strNADR, $t_strMIAO, $arrEmpPersonal["empNumber"]);   //View list of employee's other information
									?>
                                        </td>
                                      </tr>
                                    </table>
                                    <? } ?>
                                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table>
                                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td><hr></td>
                                      </tr>
                                    </table>
                                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td width="5%" height="19"><img src="images/legal_information.gif" width="22" height="14"></td>
                                        <td width="95%"><span class="note">LEGAL 
                                          INFORMATION</span><span class="text"> 
                                          </span></td>
                                      </tr>
                                    </table>
                                    <? if ($Submit == 'Modify') { ?>
                                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td><div align="right"> 
                                            <? $objEmployee->output();?>
                                          </div></td>
                                      </tr>
                                    </table>
                                    <table width="90%" border="1" align="center" cellpadding="0" cellspacing="0">
                                      <form action="<? $PHP_SELF;?>" method="post" name="frmLegalInfo">
                                        <tr> 
                                          <td width="29%" height="15" class="alterrow">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td height="46"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td>Are you related by consanguinity 
                                                  or affinity to any of the following 
                                                  appointing authority, recommending 
                                                  authority, chief of office/ 
                                                  bureau/department or person 
                                                  who has immediate supervision 
                                                  over you in the office, Bureau 
                                                  or Dapartment where you will 
                                                  be appointed? <br> <table width="95%" border="0" align="center" cellpadding="5" cellspacing="1">
                                                    <tr> 
                                                      <td>Within the third degree 
                                                        (for national Government 
                                                        employees) ? 
                                                        <?
									  if($t_strRelatedThird == "Y" || $t_strRelatedThird == "")
									  {
									  	echo "<input name='t_strRelatedThird' type='radio' value='Y' checked onClick=\"DegreeParticulars();\">";
									  }
									  else
									  {
									  	echo "<input name='t_strRelatedThird' type='radio' value='Y' onClick=\"DegreeParticulars();\">";
									  }
									  ?>
                                                        Yes 
                                                        <?
									  if($t_strRelatedThird == "N")
									  {
									  	echo "<input name='t_strRelatedThird' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strRelatedThird' type='radio' value='N'>";
									  }
									  ?>
                                                        No 
                                                        <input type="hidden" name="t_strOldRelatedThird" value="<? echo $t_strRelatedThird; ?>"> 
                                                        <span class="text"> <br>
                                                        </span>Within the fourth 
                                                        degree (for local Government 
                                                        employees) ? 
                                                        <?
									  if($t_strRelatedFourth == "Y" || $t_strRelatedFourth == "")
									  {
									  	echo "<input name='t_strRelatedFourth' type='radio' value='Y' checked onClick=\"DegreeParticulars();\">";
									  }
									  else
									  {
									  	echo "<input name='t_strRelatedFourth' type='radio' value='Y' onClick=\"DegreeParticulars();\">";
									  }
									  ?>
                                                        Yes 
                                                        <?
									  if($t_strRelatedFourth == "N")
									  {
									  	echo "<input name='t_strRelatedFourth' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strRelatedFourth' type='radio' value='N'>";
									  }
									  ?>
                                                        No 
                                                        <input name="t_strOldRelatedFourth" type="hidden" value="<? echo $t_strRelatedFourth; ?>"> 
                                                        <br>
                                                        If your answer is &quot;YES&quot;, 
                                                        give particulars 
                                                        <input name="t_strRelatedDegreeParticulars" type="text" value="<? echo $t_strRelatedDegreeParticulars; ?>"  size="50" maxlength="80" onBlur="validateCharacter(this)"> 
                                                        <input name="t_strOldRelatedDegreeParticulars" type="hidden" value="<? echo $t_strRelatedDegreeParticulars; ?>"> 
                                                      </td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                            </table>
                                            <hr></td>
                                        </tr>
                                        <tr> 
                                          <td height="38" class="text"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td>Have you ever been declared 
                                                  guilty of any administrative 
                                                  offense ? 
                                                  <?
									  if($t_strAdminCase == "Y" || $t_strAdminCase == "")
									  {
									  	echo "<input name='t_strAdminCase' type='radio' value='Y' checked  onClick=\"AdminCaseParticulars();\">";
									  }
									  else
									  {
									  	echo "<input name='t_strAdminCase' type='radio' value='Y' onClick=\"AdminCaseParticulars();\">";
									  }
									  ?>
                                                  Yes 
                                                  <?
									  if($t_strAdminCase == "N")
									  {
									  	echo "<input name='t_strAdminCase' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strAdminCase' type='radio' value='N'>";
									  }
									  ?>
                                                  No 
                                                  <input name="t_strOldAdminCase" type="hidden" value="<? echo $t_strAdminCase; ?>"> 
                                                  <br>
                                                  If your answer is &quot;YES&quot;, 
                                                  give details of offense 
                                                  <input name="t_strAdminCaseParticulars" type="text" value="<? echo $t_strAdminCaseParticulars; ?>" size="50" maxlength="80" onBlur="validateCharacter(this)"> 
                                                  <input name="t_strOldDetailsOffense" type="hidden" value="<? echo $t_strDetailsOffense; ?>"> 
                                                </td>
                                              </tr>
                                            </table>
                                            <hr></td>
                                        </tr>
                                        <tr> 
                                          <td height="70" class="text"> <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td>Have you ever been convicted 
                                                  of any crime or violation of 
                                                  any law, decree, ordinance or 
                                                  regulations by any court or 
                                                  tribunal? 
                                                  <?
									  if($t_strViolateLaw == "Y" || $t_strViolateLaw == "")
									  {
									  	echo "<input name='t_strViolateLaw' type='radio' value='Y' checked onClick=\"ViolateLawParticulars();\">";
									  }
									  else
									  {
									  	echo "<input name='t_strViolateLaw' type='radio' value='Y' onClick=\"ViolateLawParticulars();\">";
									  }
									  ?>
                                                  Yes 
                                                  <?
									  if($t_strViolateLaw == "N")
									  {
									  	echo "<input name='t_strViolateLaw' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strViolateLaw' type='radio' value='N'>";
									  }
									  ?>
                                                  No 
                                                  <input name="t_strOldViolateLaw" type="hidden" id="t_strOldViolateLaw2" value="<? echo $t_strViolateLaw; ?>"> 
                                                  <br>
                                                  If your answer is &quot;YES&quot;, 
                                                  give details of offense 
                                                  <input name="t_strViolateLawParticulars" type="text" value="<? echo $t_strViolateLawParticulars; ?>" size="50" maxlength="80" onBlur="validateCharacter(this)"> 
                                                  <input name="t_strOldViolateLawParticulars" type="hidden" value="<? echo $t_strViolateLawParticulars; ?>"> 
                                                </td>
                                              </tr>
                                            </table>
                                            <hr></td>
                                        </tr>
                                        <tr> 
                                          <td height="93"> <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td><p>Have you ever been forced 
                                                    to retire/resign or dropped 
                                                    from employment in the public 
                                                    or private sector?<br>
                                                    <?
									  if($t_strForcedResign == "Y" || $t_strForcedResign == "")
									  {
									  	echo "<input name='t_strForcedResign' type='radio' value='Y' checked onClick=\"ForcedResignParticulars();\">";
									  }
									  else
									  {
									  	echo "<input name='t_strForcedResign' type='radio' value='Y' onClick=\"ForcedResignParticulars();\">";
									  }
									  ?>
                                                    Yes 
                                                    <?
									  if($t_strForcedResign == "N")
									  {
									  	echo "<input name='t_strForcedResign' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strForcedResign' type='radio' value='N'>";
									  }
									  ?>
                                                    No 
                                                    <input name="t_strOldForcedResign" type="hidden" id="t_strOldForcedResign2" value="<? echo $t_strForcedResign; ?>">
                                                  </p>
                                                  <p>If your answer is &quot;YES&quot;, 
                                                    give reasons 
                                                    <input name="t_strForcedResignParticulars" type="text" onBlur="validateCharacter(this)" value="<? echo $t_strForcedResignParticulars; ?>" size="50" maxlength="80">
                                                    <input name="t_strOldForcedResignParticulars" type="hidden" id="t_strOldForcedResignParticulars2" value="<? echo $t_strForcedResignParticulars; ?>">
                                                  </p></td>
                                              </tr>
                                            </table>
                                            <hr> </td>
                                        </tr>
                                        <tr> 
                                          <td height="16"> <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td height="75">Have you ever 
                                                  been a candidate in a national 
                                                  or local election(except Barangay 
                                                  election)? 
                                                  <?
									  if($t_strCandidate == "Y" || $t_strCandidate == "")
									  {
									  	echo "<input name='t_strCandidate' type='radio' value='Y' checked onClick=\"CandidateParticulars();\">";
									  }
									  else
									  {
									  	echo "<input name='t_strCandidate' type='radio' value='Y' onClick=\"CandidateParticulars();\">";
									  }
									  ?>
                                                  Yes 
                                                  <?
									  if($t_strCandidate == "N")
									  {
									  	echo "<input name='t_strCandidate' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strCandidate' type='radio' value='N'>";
									  }
									  ?>
                                                  No 
                                                  <input name="t_strOldCandidate" type="hidden" value="<? echo $t_strCandidate; ?>"> 
                                                  <p>If your answer is &quot;YES&quot;, 
                                                    give date of elections and 
                                                    other particulars 
                                                    <input name="t_strCandidateParticulars" type="text" value="<? echo $t_strCandidateParticulars; ?>" size="30" maxlength="80" onBlur="validateCharacter(this)">
                                                    <input name="t_strOldCandidateParticulars" type="hidden" value="<? echo $t_strCandidateParticulars; ?>">
                                                  </p></td>
                                              </tr>
                                            </table>
                                            <hr> </td>
                                        </tr>
                                        <tr> 
                                          <td height="156"> <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td><p>Pursuant to (a) indigenous 
                                                    People's Act (RA 8371); (b) 
                                                    Magna Carta for Disabled Persons 
                                                    (RA 7277); and (c) Solo Parents 
                                                    Welfare Act of 2000 (RA 8972)</p>
                                                  <p>*please answer the following 
                                                    items</p></td>
                                              </tr>
                                            </table>
                                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td>a. Are you a member of any 
                                                  indigenous group? <br> 
                                                  <?
									  if($t_strIndigenous == "Y" || $t_strIndigenous == "")
									  {
									  	echo "<input name='t_strIndigenous' type='radio' value='Y' checked onClick=\"IndigenousParticulars();\">";
									  }
									  else
									  {
									  	echo "<input name='t_strIndigenous' type='radio' value='Y' onClick=\"IndigenousParticulars();\">";
									  }
									  ?>
                                                  Yes 
                                                  <?
									  if($t_strIndigenous == "N")
									  {
									  	echo "<input name='t_strIndigenous' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strIndigenous' type='radio' value='N'>";
									  }
									  ?>
                                                  No 
                                                  <input name="t_strOldIndigenous" type="hidden" value="<? echo $t_strIndigenous; ?>"> 
                                                </td>
                                                <td>If you answer is &quot;YES&quot;, 
                                                  please specify<br> <input name="t_strIndigenousParticulars" type="text" value="<? echo "$t_strIndigenousParticulars"; ?>" size="30" maxlength="80" onBlur="validateCharacter(this)"> 
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td>b. Are you differently abled? 
                                                  <?
									  if($t_strDisabled == "Y" || $t_strDisabled == "")
									  {
									  	echo "<input name='t_strDisabled' type='radio' value='Y' checked onClick=\"DisabledParticulars();\">";
									  }
									  else
									  {
									  	echo "<input name='t_strDisabled' type='radio' value='Y' onClick=\"DisabledParticulars();\">";
									  }
									  ?>
                                                  Yes 
                                                  <?
									  if($t_strDisabled == "N")
									  {
									  	echo "<input name='t_strDisabled' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strDisabled' type='radio' value='N'>";
									  }
									  ?>
                                                  No 
                                                  <input name="t_strOldDisabled" type="hidden" value="<? echo $t_strDisabled; ?>"> 
                                                </td>
                                                <td>If you answer is &quot;YES&quot;, 
                                                  please specify<br> <input name="t_strDisabledParticulars" type="text" value="<? echo "$t_strDisabledParticulars"; ?>" size="30" maxlength="80" onBlur="validateCharacter(this)"> 
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td>c. Are you a solo parent? 
                                                  <?
									  if($t_strSoloParent == "Y" || $t_strSoloParent == "")
									  {
									  	echo "<input name='t_strSoloParent' type='radio' value='Y' checked onClick=\"SoloParentParticulars();\">";
									  }
									  else
									  {
									  	echo "<input name='t_strSoloParent' type='radio' value='Y' onClick=\"SoloParentParticulars();\">";
									  }
									  ?>
                                                  Yes 
                                                  <?
									  if($t_strSoloParent == "N")
									  {
									  	echo "<input name='t_strSoloParent' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strSoloParent' type='radio' value='N'>";
									  }
									  ?>
                                                  No 
                                                  <input name="t_strOldSoloParent" type="hidden" value="<? echo $t_strSoloParent; ?>"> 
                                                </td>
                                                <td>If you answer is &quot;YES&quot;, 
                                                  please specify<br> <input name="t_strSoloParentParticulars" type="text" value="<? echo "$t_strSoloParentParticulars"; ?>" size="30" maxlength="80" onBlur="validateCharacter(this)"> 
                                                </td>
                                              </tr>
                                            </table>
                                            <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr; ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td><div align="center"><strong> 
                                              <input name="txtSearch" type="hidden" id="txtSearch" value="<? echo $txtSearch; ?>">
                                              <input name="optField" type="hidden" value="<? echo $optField; ?>">
                                              <input name="t_strEmpNumber" type="hidden" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                              <input name="p" type="hidden" value="<? echo $p; ?>">
                                              </strong> 
                                              <input name="Submit" type="submit" value="Submit">
                                            </div></td>
                                        </tr>
                                      </form>
                                    </table>
                                    <? } else { ?>
                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td> 
                                          <? 
							$objEmployee->viewLegalInfo($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strRelatedThird, $t_strRelatedFourth, $t_strRelatedDegreeParticulars, $t_strAdminCase, $t_strAdminCaseParticulars, $t_strViolateLaw, $t_strViolateLawParticulars, $t_strForcedResign, $t_strForcedResignParticulars, $t_strCandidate, $t_strCandidateParticulars, $t_strIndigenous, $t_strIndigenousParticulars, $t_strDisabled, $t_strDisabledParticulars, $t_strSoloParent, $t_strSoloParentParticulars, $arrEmpPersonal["empNumber"]);  //view employee Legal Information
							  ?>
                                        </td>
                                      </tr>
                                    </table>
                                    <? } ?>
                                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table>
                                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td><hr></td>
                                      </tr>
                                    </table>
                                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td width="7%" height="25"><img src="images/chraracter_reference.gif" width="29" height="23"></td>
                                        <td width="93%" valign="middle" class="note">CHARACTER 
                                          REFERENCE </td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr> 
                                  <td> 
                                    <? 
								$arrEmpReference=$objEmployee->viewReference($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strRefName, $t_strRefAddress, $t_strRefTelephone, $arrEmpPersonal["empNumber"]);   //View Reference
								?>
                                  </td>
                                </tr>
                                <tr> 
                                  <td> <br> 
                                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <form action="<? $PHP_SELF; ?>" method="post" name="frmReference" onSubmit="return validate()">
                                        <?
								if($strConfirm)
								{
								?>
                                        <tr> 
                                          <td colspan="3" class="titlebar">Are 
                                            you sure you want to delete <? echo $t_strRefName; ?>, 
                                            <? echo $t_strRefAddress; ?> and <? echo $t_intRefTelephone; ?> 
                                            ??? 
                                            <input name="t_strOldRefName" type="hidden" value="<? echo "$t_strRefName"; ?>">
                                            <input name="strEmpNmbr" type="hidden" id="strEmpNmbr3" value="<? echo $strEmpNmbr; ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="3"><div align="center"> 
                                              <input name="txtSearch" type="hidden" value="<? echo $txtSearch; ?>">
                                              <input name="optField" type="hidden" value="<? echo $optField; ?>">
                                              <input name="t_strEmpNumber" type="hidden" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                              <input name="p" type="hidden" value="<? echo $p; ?>">
                                              <input name="Submit" type="submit" value="OK">
                                              <input type="submit" name="Submit" value="Cancel">
                                            </div></td>
                                        </tr>
                                        <?
								}
								  elseif ($Submit == 'Edit')
								  {
							   ?>
                                        <tr> 
                                          <td width="142" height="19" class="paragraph"> 
                                            <input name="t_strOldEmpNumber" type="hidden" value="<? echo $arrEmpPersonal['empNumber']; ?>">
                                            Name:</td>
                                          <td width="412" colspan="3"> <input name="t_strRefName" type="text"  value="<? echo "$t_strRefName"; ?>" size="50" maxlength="80" onBlur="validateCharacter(this)"> 
                                            <input name="t_strOldRefName" type="hidden" value="<? echo "$t_strRefName"; ?>">
                                            <span class="required"> *</span> </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Address:</td>
                                          <td colspan="3"> <input name="t_strRefAddress" type="text" value="<? echo "$t_strRefAddress"; ?>" size="70" maxlength="80" onBlur="validateAddress(this)">
                                            <span class="required"> *</span> </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Telephone Number:</td>
                                          <td colspan="3"><input name="t_intRefTelephone" type="text" value="<? echo "$t_intRefTelephone"; ?>" size="20" maxlength="15" onBlur="validateTelephone(this)">
                                            <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>">
                                            <span class="required"> *</span> </td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4" class="paragraph">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4" class="paragraph"> <div align="center"> 
                                              <input name="txtSearch" type="hidden" value="<? echo $txtSearch; ?>">
                                              <input name="optField" type="hidden" value="<? echo $optField; ?>">
                                              <input name="t_strEmpNumber" type="hidden" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                              <input name="p" type="hidden" value="<? echo $p; ?>">
                                              <input name="Submit" type="submit" value="Submit">
                                              <input name="Submit" type="submit" value="Cancel">
                                            </div></td>
                                        </tr>
                                        <?
								   } else {
								  ?>
                                        <tr> 
                                          <td width="142" height="19" class="paragraph">Name 
                                            : </td>
                                          <td width="412" colspan="3"> <input name="t_strRefName" type="text" size="50" maxlength="80" onBlur="validateCharacter(this)"> 
                                            <input name="t_strOldEmpNumber" type="hidden"  value="<? echo $arrEmpPersonal['empNumber']; ?>">
                                            <span class="required"> *</span> </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Address : </td>
                                          <td colspan="3"> <input name="t_strRefAddress" type="text" size="70" maxlength="80" onBlur="validateAddress(this)">
                                            <span class="required"> *</span> </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Telephone Number 
                                            : </td>
                                          <td colspan="3"><input name="t_intRefTelephone" type="text" size="20" maxlength="15" onBlur="validateTelephone(this)">
                                            <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>">
                                            <span class="required"> *</span></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4" class="paragraph">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4" class="paragraph"> <div align="center"> 
                                              <input name="txtSearch" type="hidden" value="<? echo $txtSearch; ?>">
                                              <input type="hidden" name="optField" value="<? echo $optField; ?>">
                                              <input name="t_strEmpNumber" type="hidden" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                              <input name="p" type="hidden" value="<? echo $p; ?>">
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
                                  <td>&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td> <table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td><hr></td>
                                      </tr>
                                    </table>
                                    <table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td width="5%" height="19"><img src="images/pledge_details.gif" width="14" height="12"></td>
                                        <td width="95%"><span class="note"> PLEDGE 
                                          DETAILS </span></td>
                                      </tr>
                                    </table>
                                    <? if ($Submit == 'Add/Modify') { ?>
                                    <table width="85%" border="1" align="center" cellpadding="0" cellspacing="0">
                                      <form action="<? $PHP_SELF; ?>" method="post" name="frmPledge">
                                        <tr> 
                                          <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td width="29%" class="paragraph"><input name="t_strOldEmpNumber2" type="hidden" id="t_strEmpNumber" value="<? echo "$t_strEmpNumber"; ?>">
                                            Signature :</td>
                                          <td width="69%">&nbsp; <input name="t_strSignature" type="text" value="<? echo "$t_strSignature"; ?>" readonly size="30" maxlength="50" onBlur="validateCharacter(this)"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Date Accomplished 
                                            :</td>
                                          <td>&nbsp; 
                                           <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPersonal");
											echo "<SELECT NAME=\"t_dtmDateAccYear\" onChange=\"updateList(t_dtmDateAccMonth.selectedIndex,this[this.selectedIndex].text,'t_dtmDateAccDay')\">"; 
											$yyyymmdd = $t_dtmDateAccomplished;
											list($t_dtmDateAccYear) = array(substr($yyyymmdd,0,4));
											$objEmployee->comboYearOld($t_dtmDateAccYear);
											echo "</SELECT>";
											?>
                                            <input name="t_dtmOldDateAccYear" type="hidden" value="<? echo $t_dtmBirthYear; ?>"><?php 
											$result = mysql_query ("SELECT * FROM tblEmpPersonal");
											echo "<SELECT NAME=\"t_dtmDateAccMonth\" onChange=\"updateList(this.selectedIndex,t_dtmDateAccYear[t_dtmDateAccYear.selectedIndex].text,'t_dtmDateAccDay')\">"; 
											$yyyymmdd = $t_dtmDateAccomplished;
											list($t_dtmDateAccMonth) = array(substr($yyyymmdd,5,2));
											$objEmployee->comboMonth($t_dtmDateAccMonth);
											echo "</SELECT>";
											?>
                                            <input name="t_dtmOldDateAccMonth" type="hidden" value="<? echo "$t_dtmDateAccMonth"; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPersonal");
											echo "<SELECT NAME=\"t_dtmDateAccDay\">"; 
											$yyyymmdd = $t_dtmDateAccomplished;
											list($t_dtmDateAccDay) = array(substr($yyyymmdd,8,2));
											$objEmployee->comboDay($t_dtmDateAccDay);
											echo "</SELECT>";
											?>
                                            <input name="t_dtmOldDateAccDay" type="hidden" value="<? echo "$t_dtmDateAccDay"; ?>"> 
                                             
                                            <input name="t_dtmOldDateAccomplished" type="hidden" value="<? echo $t_dtmDateAccomplished; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Community Tax 
                                            Certificate :</td>
                                          <td>&nbsp; <input name="t_strComTaxNumber" type="text" value="<? echo "$t_strComTaxNumber"; ?>" size="30" maxlength="100" onBlur="validateTaxNumber(this)"> 
                                            <input name="t_strOldComTaxNumber" type="hidden" value="<? echo "$t_strComTaxNumber"; ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Issued At :</td>
                                          <td>&nbsp; <input name="t_strIssuedAt" type="text" value="<? echo "$t_strIssuedAt"; ?>" size="30" maxlength="100" onBlur="validateCharacter(this)"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Issued On :</td>
                                          <td>&nbsp; 
                                           <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPersonal");
											echo "<SELECT NAME=\"t_dtmIssuedOnYear\" onChange=\"updateList(t_dtmIssuedOnMonth.selectedIndex,this[this.selectedIndex].text,'t_dtmIssuedOnDay')\">"; 
											$yyyymmdd = $t_dtmIssuedOn;
											list($t_dtmIssuedOnYear) = array(substr($yyyymmdd,0,4));
											$objEmployee->comboYearOld($t_dtmIssuedOnYear);
											echo "</SELECT>";
											?>
                                            <input name="t_dtmOldIssuedOnYear" type="hidden" value="<? echo $t_dtmIssuedOnYear; ?>"> <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPersonal");
											echo "<SELECT NAME=\"t_dtmIssuedOnMonth\" onChange=\"updateList(this.selectedIndex,t_dtmIssuedOnYear[t_dtmIssuedOnYear.selectedIndex].text,'t_dtmIssuedOnDay')\">"; 
											$yyyymmdd = $t_dtmIssuedOn;
											list($t_dtmIssuedOnMonth) = array(substr($yyyymmdd,5,2));
											$objEmployee->comboMonth($t_dtmIssuedOnMonth);
											echo "</SELECT>";
											?>
                                            <input name="t_dtmOldIssuedOnMonth" type="hidden" value="<? echo "$t_dtmIssuedOnMonth"; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPersonal");
											echo "<SELECT NAME=\"t_dtmIssuedOnDay\">"; 
											$yyyymmdd = $t_dtmIssuedOn;
											list($t_dtmIssuedOnDay) = array(substr($yyyymmdd,8,2));
											$objEmployee->comboDay($t_dtmIssuedOnDay);
											echo "</SELECT>";
											?>
                                            <input name="t_dtmOldIssuedOnDay" type="hidden" value="<? echo "$t_dtmIssuedOnDay"; ?>"> 
                                             
                                            <input name="t_dtmOldIssuedOn" type="hidden" value="<? echo $t_dtmIssuedOn; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td colspan="2"><input name="strEmpNmbr" type="hidden" id="strEmpNmbr6" value="<? echo $strEmpNmbr; ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="2"><div align="center"> 
                                              <input name="Submit" type="submit" value="Submit">
                                            </div></td>
                                        </tr>
                                      </form>
                                    </table>
                                    <? } else { ?>
                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td> 
                                          <? $objEmployee->viewPledge($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strSignature, $t_dtmDateAccomplished, $t_strComTaxNumber, $t_strIssuedAt, $t_dtmIssuedOn, $arrEmpPersonal["empNumber"]);  //View list of employee's signature, ctc
										?>
                                        </td>
                                      </tr>
                                    </table>
                                    <? } ?>
                                  </td>
                                </tr></form>
                              </table></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td class="paragraph"> 
                                    <? $objEmployee->output(); ?>
                                  </td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
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