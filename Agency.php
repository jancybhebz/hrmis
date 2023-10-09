<?php 
/* 
File Name: Agency.php
----------------------------------------------------------------------
Purpose of this file: 
To add and delete agency to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: October 17, 2003
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
include("../hrmis/class/Agency.php");   //Load database connection									
include("../hrmis/class/JSgeneral.php");
$objAgency= new agency;   //Load agency function
$arrEmpPersonal2 = $objAgency->checkGetEmpNmbr("Employee", $strEmpNmbr);

	$objAgency->editAgency($strEmpNmbr, $t_strAgencyName, $t_strAbbreviation, $t_intAgencyTin, $t_strAddress, $t_intTelephone, $t_strSalarySchedule, $t_dtmLBStartMonth, $t_dtmLBStartYear, $t_intGSISEmpShare, $t_intGSISEmprShare, $t_intPAGIBIGEmpShare, $t_intPAGIBIGEmprShare, $t_intPHILHEALTHEmpShare, $t_intPHILHEALTHEmprShare, $t_intPHILHEALTHPercentage, $t_intLongevityMultiply, $t_intLongevityYear, $t_intHPFactor, $t_intSubsistence, $t_dtmLBStartMonth, $t_dtmLBStartYear, $Submit, $t_strOldAgencyName);    //Edit agency	
	$objAgency->addAgency($strEmpNmbr, $t_strAgencyName, $t_strAbbreviation, $t_intAgencyTin, $t_strAddress, $t_intTelephone,$t_strSalarySchedule, $t_dtmLBStartMonth, $t_dtmLBStartYear, $t_intGSISEmpShare, $t_intGSISEmprShare, $t_intPAGIBIGEmpShare, $t_intPAGIBIGEmprShare, $t_intPHILHEALTHEmpShare, $t_intPHILHEALTHEmprShare, $t_intPHILHEALTHPercentage, $t_intLongevityMultiply, $t_intLongevityYear, $t_intHPFactor, $t_intSubsistence, $t_dtmLBStartMonth, $t_dtmLBStartYear, $Submit);   //Load addAgency function

?>
<html><!-- InstanceBegin template="/Templates/hrmistmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
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
<script language="JavaScript" type="text/JavaScript">
<!--

function validateCharacter(field) 
{
	var valid = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Spaces are not allowed! \n Only characters are accepted!");
	field.focus();
	field.select();
    }
}

function validateCharacterAndSpace(field) 
{
	var valid = "ABCDEFGHIJKLMNOPQRSTUVWXYZ'+ +'abcdefghijklmnopqrstuvwxyz"
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
	alert("Invalid entry!  Only numbers are accepted!");
	field.focus();
	field.select();
    }
}

function validateTelephone(field) 
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

function validateAddress(field) 
{
	var valid = "ABCDEFGHIJKLMNOPQRSTUVWXYZ'+ +'abcdefghijklmnopqrstuvwxyz0123456789'+-+'+,+'+."
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

function CheckFileFormat(sFilePath, bSubmitPressed)
{
		if (sFilePath.replace(/\s/g, '') != '')
		{
			var iLastIndex = sFilePath.lastIndexOf('.', sFilePath.length - 1);
	  var sFileExtension = sFilePath.substr(iLastIndex + 1);
	  if ((sFileExtension != 'jpg') && (sFileExtension != 'gif') &&
	  (sFileExtension != 'jpeg'))                                {
			  window.alert('Please select a .jpg/.jpeg or .gif file.');
		 if (bSubmitPressed) return false;
	  }
		}
}

function validate(){
var digits="0123456789"
var temp
if (document.frmAgency.t_strAgencyName.value=="") {
alert("Please input agency name!")
return false
} else if (document.frmAgency.t_strAbbreviation.value=="") {
alert("Please input agency code!")
return false
} else if (document.frmAgency.t_strAddress.value=="") {
alert("Please input address!")
return false
}

return true
}

//-->
</script>
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
                        <table width="99%" height="637" border="0" cellpadding="0" cellspacing="0" id="BODY">
                          <tr> 
                            <td height="24" class="header"> <p>AGENCY INFORMATION</p></td>
                          </tr>
                          <tr> 
                            <td height="6" class="header"> 
                              <? 
							if ($Submit != " ")
							{
							?>
                              <? $objAgency->viewAgency($strEmpNmbr); ?>
                            </td>
                          </tr>
                          <tr> 
                            <td height="3" class="header"> 
                              <? 
							if ($Submit == 'Edit')
							{
							?>
                              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <form enctype="multipart/form-data" action="<?php $PHP_SELF; ?>" method="post" name="frmAgency" onSubmit="return validate()">
                                  <input type="hidden" name="MAX_FILE_SIZE" value="30000">
                                  <tr> 
                                    <td width="194" height="19" class="paragraph"> 
                                      Agency Name :</td>
                                    <td width="360"> <input name="t_strAgencyName" type="text" value="<? echo $t_strAgencyName; ?>" size="50" maxlength="70" onBlur="validateCharacterAndSpace(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="2" class="paragraph">Agency Code 
                                      : </td>
                                    <td><input name="t_strAbbreviation" type="text" value="<? echo $t_strAbbreviation; ?>" size="50" maxlength="10" onBlur="validateCharacter(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td height="2" class="paragraph"> TIN Number 
                                      :</td>
                                    <td><input name="t_intAgencyTin" type="text" id="t_intAgencyTin" value="<? echo $t_intAgencyTin;  ?>" size="20" maxlength="50"></td>
                                  </tr>
                                  <tr> 
                                    <td height="3" class="paragraph">Address : 
                                    </td>
                                    <td><input name="t_strAddress" type="text" value="<? echo $t_strAddress; ?>" size="75" maxlength="255" onBlur="validateAddress(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td height="2" class="paragraph">Telephone 
                                      : </td>
                                    <td><input name="t_intTelephone" type="text" value="<? echo $t_intTelephone; ?>" size="15" maxlength="10" onBlur="validateTelephone(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph"> Picture (Banner/Logo) 
                                      :</td>
                                    <td> <input name="filename" type="text" value="<? echo $filename;  ?>" size="20" maxlength="50" readonly> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Salary Schedule :</td>
                                    <td> <select name="t_strSalarySchedule" size="0">
                                        <?
									   if ($t_strSalarySchedule == 'Weekly') 
									   {
									      echo "<option value=\"Weekly\" selected>Weekly</option>";
									   } else {
									      echo "<option value=\"Weekly\">Weekly</option>";
									   }
									   ?>
                                        <?
									   if ($t_strSalarySchedule == 'Bi-Monthly') 
									   {
									      echo "<option value=\"Bi-Monthly\" selected>Bi-Monthly</option>";
									   } else {
									      echo "<option value=\"Bi-Monthly\">Bi-Monthly</option>";
									   }
									   ?>
                                        <?
									   if ($t_strSalarySchedule == 'Monthly') 
									   {
									      echo "<option value=\"Monthly\" selected>Monthly</option>";
									   } else {
									      echo "<option value=\"Monthly\">Monthly</option>";
									   }
									   ?>
                                      </select> </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Start Date :</td>
                                    <td><span class="paragraph">Month :</span> 
                                      <?
										$result = mysql_query ("SELECT lbStartMonth FROM tblAgency WHERE lbStartMonth='$t_dtmLBStartMonth'");
									    echo "<SELECT NAME=\"t_dtmLBStartMonth\">"; 
										$Month = $t_dtmLBStartMonth;
                                        list($t_dtmLBStartMonth) = array(substr($Month,0,2));
										$objAgency->comboMonth($t_dtmLBStartMonth);
										echo "</SELECT>";
										?>
                                      <span class="paragraph"> Year :</span> 
                                      <?
										$result = mysql_query ("SELECT lbStartYear FROM tblAgency WHERE lbStartYear='$t_dtmLBStartYear'");
									    echo "<SELECT NAME=\"t_dtmLBStartYear\">"; 
										$Year = $t_dtmLBStartYear;
                                        list($t_dtmLBStartYear) = array(substr($Year,0,4));
										$objAgency->comboYear($t_dtmLBStartYear);
										echo "</SELECT>";
										?>
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph"><hr></td>
                                    <td><hr></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">GSIS Employee Share 
                                      :</td>
                                    <td> <input name="t_intGSISEmpShare" type="text" value="<? echo $t_intGSISEmpShare; ?>" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">GSIS Employer Share 
                                      :</td>
                                    <td> <input name="t_intGSISEmprShare" type="text" value="<? echo $t_intGSISEmprShare; ?>" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">PAGIBIG Employee Share 
                                      :</td>
                                    <td> <input name="t_intPAGIBIGEmpShare" type="text" value="<? echo $t_intPAGIBIGEmpShare; ?>" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">PAGIBIG Employer Share 
                                      :</td>
                                    <td> <input name="t_intPAGIBIGEmprShare" type="text" value="<? echo $t_intPAGIBIGEmprShare; ?>" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">PhilHealth Employee 
                                      Share :</td>
                                    <td> <input name="t_intPHILHEALTHEmpShare" type="text" value="<? echo $t_intPHILHEALTHEmpShare; ?>" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">PhilHealth Employer 
                                      Share :</td>
                                    <td> <input name="t_intPHILHEALTHEmprShare" type="text" value="<? echo $t_intPHILHEALTHEmprShare; ?>" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">PhilHealth Percentage 
                                      :</td>
                                    <td> <input name="t_intPHILHEALTHPercentage" type="text" value="<? echo $t_intPHILHEALTHPercentage; ?>" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Longevity Multiply :</td>
                                    <td> <input name="t_intLongevityMultiply" type="text" value="<? echo $t_intLongevityMultiply; ?>" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Longevity Year :</td>
                                    <td> <input name="t_intLongevityYear" type="text" value="<? echo $t_intLongevityYear; ?>" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">HP Factor :</td>
                                    <td> <input name="t_intHPFactor" type="text" value="<? echo $t_intHPFactor; ?>" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Subsistence :</td>
                                    <td> <input name="t_intSubsistence" type="text" value="<? echo $t_intSubsistence; ?>" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                      <input name="t_strOldAgencyName" type="hidden" value="<? echo $t_strAgencyName; ?>"> 
                                      <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph"> </td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph"> </td>
                                    <td><input name="Submit" type="submit" value="Submit"> 
                                      <input name="Submit" type="submit" value="Cancel"> 
                                    </td>
                                  </tr>
                                </form>
                              </table>
                              <? } // Endif (Submit=='Edit')?>
                            </td>
                          </tr>
                          <tr> 
                            <td height="3" class="header"> 
                              <?
							} else {
							?>
                            </td>
                          </tr>
                          <tr> 
                            <td height="562" valign="top"> 
                              <?php
// code that will be executed if the form has been submitted:

if ($Submit) {

// connect to the database
// (you may have to adjust the hostname,username or password)

include("../hrmis/class/Connect.php");
$data = addslashes(fread(fopen($form_data, "r"), filesize($form_data)));
$result=MYSQL_QUERY("INSERT INTO tblAgencyImages (agencyLogo,filename,filesize,filetype) ". "VALUES ('$data','$form_data_name','$form_data_size','$form_data_type')");
//$id= mysql_insert_id();
//print "<p>Agency Banner has been added to the database: <b>$form_data</b>";
MYSQL_CLOSE();
} else {  

// else show the form to submit new data:
?>
                              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <form enctype="multipart/form-data" action="<?php $PHP_SELF; ?>" method="post" name="frmAgency" onSubmit="return validate()">
                                  <input type="hidden" name="MAX_FILE_SIZE" value="30000">
                                  <tr> 
                                    <td width="194" height="9" class="paragraph">Agency 
                                      Name :</td>
                                    <td width="360"> <input name="t_strAgencyName" type="text" size="50" maxlength="50" onBlur="validateCharacterAndSpace(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td height="2" class="paragraph">Agency Code 
                                      : </td>
                                    <td><input name="t_strAbbreviation" type="text" size="50" maxlength="10" onBlur="validateCharacter(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td height="2" class="paragraph">Tin Number 
                                      : </td>
                                    <td><input name="t_intAgencyTin" type="text" id="t_intAgencyTin" size="20" maxlength="50"></td>
                                  </tr>
                                  <tr> 
                                    <td height="3" class="paragraph">Address : 
                                    </td>
                                    <td><input name="t_strAddress" type="text" size="75" maxlength="255" onBlur="validateAddress(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td height="2" class="paragraph">Telephone 
                                      : </td>
                                    <td><input name="t_intTelephone" type="text" id="t_intTelephone" size="15" maxlength="10" onBlur="validateTelephone(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph"> Picture (Agency Logo) 
                                      :</td>
                                    <td> <input type="file" name="form_data" size="40"> 
                                      <input type="hidden" name="MAX_FILE_SIZE" value="1000000"> 
                                      <input name="t_strAgencyName" type="hidden" id="t_strAgencyName"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Salary Schedule :</td>
                                    <td> <select name="t_strSalarySchedule" size="0">
                                        <option value="Weekly">Weekly</option>
                                        <option value="Bi-Monthly">Bi-Monthly</option>
                                        <option value="Monthly">Monthly</option>
                                      </select> </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Start Date :</td>
                                    <td><span class="paragraph">Month :</span> 
                                      <select name="t_dtmLBStartMonth" size="1">
                                        <?
										$objAgency->comboMonth(t_dtmLBStartMonth);
										?>
                                      </select> <span class="paragraph"> Year 
                                      :</span> <select name="t_dtmLBStartYear" size="1">
                                        <?
										$objAgency->comboYearOld(t_dtmLBStartYear);
									   ?>
                                      </select></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph"><hr></td>
                                    <td><hr></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">GSIS Employee Share 
                                      :</td>
                                    <td> <input name="t_intGSISEmpShare" type="text" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">GSIS Employer Share 
                                      :</td>
                                    <td> <input name="t_intGSISEmprShare" type="text" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">PAGIBIG Employee Share 
                                      :</td>
                                    <td> <input name="t_intPAGIBIGEmpShare" type="text" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">PAGIBIG Employer Share 
                                      :</td>
                                    <td> <input name="t_intPAGIBIGEmprShare" type="text" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">PhilHealth Employee 
                                      Share :</td>
                                    <td> <input name="t_intPHILHEALTHEmpShare" type="text" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">PhilHealth Employer 
                                      Share :</td>
                                    <td> <input name="t_intPHILHEALTHEmprShare" type="text" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">PhilHealth Percentage 
                                      :</td>
                                    <td> <input name="t_intPHILHEALTHPercentage" type="text" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Longevity Multiply :</td>
                                    <td> <input name="t_intLongevityMultiply" type="text" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Longevity Year :</td>
                                    <td> <input name="t_intLongevityYear" type="text" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">HP Factor :</td>
                                    <td> <input name="t_intHPFactor" type="text" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Subsistence :</td>
                                    <td> <input name="t_intSubsistence" type="text" size="20" maxlength="5" onBlur="validateAmount(this)"> 
                                      <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr; ?>"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph"> </td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph"> </td>
                                    <td><input name="Submit" type="submit" value="ADD"> 
                                      <input type="reset" name="Reset" value="Clear"></td>
                                  </tr>
                                </form>
                              </table>
                              <?
									  }  //Endif add agency module
									  ?>
                            </td>
                          </tr>
                          <tr> 
                            <td height="6" valign="top"> 
                              <?
							}   //endif all module
							?>
                            </td>
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
