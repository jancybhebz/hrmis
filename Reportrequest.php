<?php 
/* 
File Name: Reportrequest.php 
----------------------------------------------------------------------
Purpose of this file: 
To welcome user.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: January 26, 2004
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
include("../hrmis/class/Reportrequest.php");
$objReportrequest = new reportRequest;
$objReportrequest->notifyReportRequest($strEmpNmbr, $t_strRequestID, $t_strRequestCode, $t_strEmpNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strRequestDetails, $t_strRequestStatus, $t_dtmStatusDate, $t_strRemarks, $t_strSignatory, $Submit, $t_strOldRequestStatus);   // to notify report request from employee module (Reportrequest.php)
?>
<html><!-- InstanceBegin template="/Templates/Notificationtmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" --> 
<title>Human Resource Management Information System</title>
<?
include("../hrmis/class/JSgeneral.php");
?>
<!-- InstanceEndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<!-- Design/Images Made By : Angelo Campos Evangelista  -->
<!-- Template Made By : Pearliezl Samoy Dy Tioco  -->
<script language="JavaScript" type="text/JavaScript">
<!-- onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar()" onFocus="statusBar()"  -->

function openPrint() {

	var strEmpNmbr = "<? echo $strEmpNmbr; ?>";
	var t_strUserLevel = "<? echo $t_strUserLevel; ?>";
	var t_strUserPermission = "<? echo $t_strUserPermission; ?>";
	var t_strAccessPermission = "<? echo $t_strAccessPermission; ?>";
	strPage = "HRindex.php?strEmpNmbr="+strEmpNmbr+"&t_strUserLevel="+t_strUserLevel+"&t_strUserPermission="+t_strUserPermission+"&t_strAccessPermission="+t_strAccessPermission;
	window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=960,height=625');

}

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

</script>
<link href="hrmis.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/notificationclick.jpg','images/librariesover.jpg','images/logout2.jpg','images/201over.jpg','images/attendanceover.jpg','images/reportsover.jpg','images/compensationover.jpg'); history.forward()" onContextMenu="return false">
<div align="center">
  <table width="778" border="0" cellpadding="0" cellspacing="0" id="tblHRMODULE">
    <tr> 
      <td valign="bottom"><a href="Notification.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Notification','','images/notificationclick.jpg',1)"> 
        </a> <a href="Holiday.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Libraries','','images/librariesover.jpg',1)"> 
        </a>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="39%" valign="bottom"><table width="69%" border="0" cellpadding="0" cellspacing="0" id="tblModule">
                <tr> 
                  <td><img src="images/hrmodule.jpg" width="170" height="23"></td>
                </tr>
              </table></td>
            <td width="61%" valign="bottom"> 
              <table width="100%" border="0" cellpadding="0" cellspacing="0" id="tblSECTION">
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
                    <table width="80%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATION">
                      <tr> 
                        <td width="24%"><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('notification','','images/notificationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notificationclick.jpg" alt="notification" name="notification" width="96" height="29" border="0"></a></td>
                        <td width="17%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('201profile','','images/201over.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201.jpg" alt="201profile" name="201profile" width="67" height="29" border="0"></a></td>
                        <td width="22%"><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('attendancenotification','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="attendancenotification" name="attendancenotification" width="88" height="29" border="0"></a></td>
                        <td width="12%"><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('reportnotification','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="reportnotification" name="reportnotification" width="60" height="29" border="0"></a></td>
                        <td width="11%"><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('librariesnotification','','images/librariesover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/libraries.jpg" alt="librariesnotification" name="librariesnotification" width="67" height="29" border="0"></a></td>
                        <td width="14%"><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('compensationnotification','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="compensationnotification" name="compensationnotification" width="104" height="29" border="0"></a></td>
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
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 12) 
{
?>
                    <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATION&amp;201">
                      <tr> 
                        <td width="91%"><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION1','','images/notificationclick.jpg',0); statusBar(); return true;" onClick="statusBar();"><img src="images/notificationclick.jpg" alt="NOTIFICATION" name="NOTIFICATION1" width="96" height="29" border="0" id="NOTIFICATION1"></a></td>
                        <td width="9%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>%20" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE1','','images/201over.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201.jpg" alt="PROFILE" name="PROFILE1" width="67" height="29" border="0" id="PROFILE1"></a></td>
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
                    <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATION&amp;ATTENDANCE">
                      <tr> 
                        <td width="42%"><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION3','','images/notificationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notificationclick.jpg" alt="NOTIFICATION3" name="NOTIFICATION3" width="96" height="29" border="0"></a></td>
                        <td width="58%"><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE3','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="ATTENDANCE3" name="ATTENDANCE3" width="88" height="29" border="0"></a></td>
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
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 14) 
{
?>
                    <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATION&amp;REPORTS">
                      <tr> 
                        <td width="60%"><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION4','','images/notificationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notificationclick.jpg" alt="NOTIFICATION4" name="NOTIFICATION4" width="96" height="29" border="0"></a></td>
                        <td width="40%"><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS4','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS4" name="REPORTS4" width="60" height="29" border="0"></a></td>
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
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 15) 
{
?>
                    <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATIONLIBRARIES">
                      <tr> 
                        <td><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION5','','images/notificationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notificationclick.jpg" alt="NOTIFICATION5" name="NOTIFICATION5" width="96" height="29" border="0"></a></td>
                        <td><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES5','','images/librariesover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/libraries.jpg" alt="LIBRARIES5" name="LIBRARIES5" width="67" height="29" border="0"></a></td>
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
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 16) 
{
?>
                    <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATIONCOMPENSATION">
                      <tr> 
                        <td><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION51','','images/notificationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notificationclick.jpg" alt="NOTIFICATION5" name="NOTIFICATION51" width="96" height="29" border="0" id="NOTIFICATION51"></a></td>
                        <td><a href="Personnelinfo.phpstrEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION6','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION6" name="COMPENSATION6" width="104" height="29" border="0"></a></td>
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
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 1) 
{
?>
                    <table width="15%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATION">
                      <tr> 
                        <td><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION511','','images/notificationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notificationclick.jpg" alt="NOTIFICATION5" name="NOTIFICATION511" width="96" height="29" border="0" id="NOTIFICATION51"></a></td>
                      </tr>
                    </table>
                    <? } ?>
                  </td>
                </tr>
                <tr>
                  <td valign="bottom">
                    <?   //  HR and Cashier module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == 1234567) 
{
?>
                    <table width="80%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATIONCASHIER">
                      <tr> 
                        <td width="32%"><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION2','','images/notificationclick.jpg',0); statusBar(); return true;" onClick="statusBar();"><img src="images/notificationclick.jpg" alt="NOTIFICATION" name="NOTIFICATION2" width="96" height="29" border="0" id="NOTIFICATION2"></a></td>
                        <td width="4%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE2','','images/201over.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201.jpg" alt="PROFILE" name="PROFILE2" width="67" height="29" border="0" id="PROFILE2"></a></td>
                        <td width="18%"><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE1','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="ATTENDANCE" name="ATTENDANCE1" width="88" height="29" border="0" id="ATTENDANCE1"></a></td>
                        <td width="12%"><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS1','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS" name="REPORTS1" width="60" height="29" border="0" id="REPORTS1"></a></td>
                        <td width="13%"><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES1','','images/librariesover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/libraries.jpg" alt="LIBRARIES" name="LIBRARIES1" width="67" height="29" border="0" id="LIBRARIES1"></a></td>
                        <td width="21%"><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION1','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION" name="COMPENSATION1" width="104" height="29" border="0" id="COMPENSATION1"></a></td>
                      </tr>
                    </table>
                    <? } ?>
                  </td>
                </tr>
              </table> </td>
          </tr>
        </table></td>
    </tr>
    <tr bgcolor="#E9F3FE"> 
      <td><div align="center">Welcome <strong><? echo $_SESSION['strLoginName']; ?></strong>. 
          You are currently working at the HR Module.</div></td>
    </tr>
    <tr> 
      <td height="398"><table width="100%" height="398" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td width="22%" height="398" valign="top" bgcolor="#E9F3FE"><table width="95%" height="389" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="NAVTBL">
                <tr> 
                  <td valign="top"> <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                      <tr> 
                        <td height="12"><img src="images/tasks.jpg" width="64" height="24"></td>
                      </tr>
                      <tr> 
                        <td height="12"> 
                          <?   //  HR and Cashier module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == 1234567) 
{
?>
                        </td>
                      </tr>
                      <tr> 
                        <td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td> 
                                <?php 
								//Leave Request Module
								include("../hrmis/class/Connect.php");
								
								$t_strRequestStatusLeave = "Approved";
								$result = mysql_query("SELECT tblEmpRequest.requestID, tblEmpRequest.requestCode, tblEmpRequest.requestDetails, tblEmpRequest.requestStatus, tblEmpRequest.statusDate, tblEmpRequest.remarks, tblEmpRequest.signatory, tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename FROM tblEmpRequest INNER JOIN tblEmpPersonal ON tblEmpRequest.empNumber=tblEmpPersonal.empNumber WHERE tblEmpRequest.requestCode LIKE 'Leave' AND tblEmpRequest.requestStatus = '$t_strRequestStatusLeave' ");
								$num = mysql_num_rows($result); 
								
								if ($num <> 0){ 
								// if number of entries is more than 1
								printf("<a href=\"Leaverequest.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Leave Request");
								printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Leave Request");
								printf("</a>");
								} 
								
								?>
                              </td>
                            </tr>
                            <tr> 
                              <td> 
                                <?php
								//OB Request Module 
								include("../hrmis/class/Connect.php");
								
								$t_strRequestStatusOB = "Approved";								
								$result = mysql_query("SELECT tblEmpRequest.requestID, tblEmpRequest.requestCode, tblEmpRequest.requestDetails, tblEmpRequest.requestStatus, tblEmpRequest.statusDate, tblEmpRequest.remarks, tblEmpRequest.signatory, tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename FROM tblEmpRequest INNER JOIN tblEmpPersonal ON tblEmpRequest.empNumber=tblEmpPersonal.empNumber WHERE tblEmpRequest.requestCode LIKE 'OB' AND tblEmpRequest.requestStatus = '$t_strRequestStatusOB' ");
								$num = mysql_num_rows($result); 
								
								if ($num <> 0){ 
								// if number of entries is more than 1
								printf("<a href=\"OBrequest.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("OB Request");
								printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("OB Request");
								printf("</a>");
								} 
								
								?>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <?php
								//TO Request Module 
								include("../hrmis/class/Connect.php");
								
								$t_strRequestStatusTO = "Approved";								
								$result = mysql_query("SELECT tblEmpRequest.requestID, tblEmpRequest.requestCode, tblEmpRequest.requestDetails, tblEmpRequest.requestStatus, tblEmpRequest.statusDate, tblEmpRequest.remarks, tblEmpRequest.signatory, tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename FROM tblEmpRequest INNER JOIN tblEmpPersonal ON tblEmpRequest.empNumber=tblEmpPersonal.empNumber WHERE tblEmpRequest.requestCode LIKE 'TO' AND tblEmpRequest.requestStatus = '$t_strRequestStatusTO' ");
								$num = mysql_num_rows($result); 
								
								if ($num <> 0){ 
								// if number of entries is more than 1
								printf("<a href=\"TOrequest.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("TO Request");
								printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("TO Request");
								printf("</a>");
								} 
								
								?>
                              </td>
                            </tr>
                            <tr> 
                              <td> 
                                <?php 
								//Report Request Module
								include("../hrmis/class/Connect.php");
								
								$t_strRequestStatusReport = "Filed Request";
								$result = mysql_query("SELECT tblEmpRequest.requestID, tblEmpRequest.requestCode, tblEmpRequest.requestDetails, tblEmpRequest.requestStatus, tblEmpRequest.statusDate, tblEmpRequest.remarks, tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename FROM tblEmpRequest INNER JOIN tblEmpPersonal ON tblEmpRequest.empNumber=tblEmpPersonal.empNumber WHERE tblEmpRequest.requestCode LIKE 'Report' AND tblEmpRequest.requestStatus = '$t_strRequestStatusReport' ");
								$num = mysql_num_rows($result); 
								
								if ($num <> 0){ 
								// if number of entries is more than 1
								printf("<a href=\"Reportrequest.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Report Request");
								printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
								//printf("<a href=\"Reportrequest.php\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Report Request");
								printf("</a>");
								} 
								
								?>
                              </td>
                            </tr>
                            <tr> 
                              <td> 
                                <?php 
								//Update 201 Request Module
								include("../hrmis/class/Connect.php");
								
								$t_strRequestStatus201 = "Filed Request";
								$result = mysql_query("SELECT tblEmpRequest.requestID, tblEmpRequest.requestCode, tblEmpRequest.requestDetails, tblEmpRequest.requestStatus, tblEmpRequest.statusDate, tblEmpRequest.remarks, tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename FROM tblEmpRequest INNER JOIN tblEmpPersonal ON tblEmpRequest.empNumber=tblEmpPersonal.empNumber WHERE tblEmpRequest.requestCode LIKE '201' AND tblEmpRequest.requestStatus = '$t_strRequestStatus201' "); 
								$num = mysql_num_rows($result); 
								
								if ($num <> 0){ 
								// if number of entries is more than 1
								printf("<a href=\"Update201request.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Update 201 Request");
								printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
								//printf("<a href=\"Update201request.php\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Update 201 Request");
								printf("</a>");
								} 
								
								?>
                              </td>
                            </tr>
                            <tr> 
                              <td> 
                                <?php 
//Step Increment (statusOfAppointment equals In-Service, CurrentMonth equals month of PositionDate, CurrentYear minus PositionDateYear, AppointmentCode = Perm and Stepincrement divided by 3 equals 1)
include("../hrmis/class/Connect.php");

$t_dtmCurYear = date("Y");
$t_dtmCurMonth = date("m");
$t_dtmCURDate = $t_dtmCurYear . "-" . $t_dtmCurMonth . "-"; 

$resultStep = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname,
									tblEmpPosition.effectiveDate, tblEmpPosition.stepNumber, tblEmpPosition.actualSalary, 
									tblEmpPosition.salaryGradeNumber, tblEmpPosition.positionCode, tblEmpPosition.assignPlace,
									tblEmpPosition.appointmentCode, tblEmpPosition.dateIncremented, tblEmpPosition.positionDate,
									tblEmpPosition.tmpPositionDate,tblEmpPosition.statusOfAppointment,tblEmpPosition.appointmentCode
	   					  		FROM tblEmpPersonal
						 		 INNER JOIN tblEmpPosition
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								 INNER JOIN tblPosition	
								 	ON tblEmpPosition.positionCode = tblPosition.positionCode 
	");
$ctrnum = 0;
while($arrStep = mysql_fetch_array($resultStep))
{

	$dtmYearNow = date("Y");
	$dtmMonthNow = date("m");
	$t_strEmployeeNumber = $arrStep['empNumber'];
	$t_intStepNum = $arrStep['stepNumber'];
	$t_strPermanent = $arrStep['appointmentCode'];	// Perm
  	$t_strSalaryGrade = $arrQuery['salaryGradeNumber'];
	$t_strInService = $arrStep['statusOfAppointment'];	//In-Service
	$t_strEmpSurname = $arrStep['surname'];
	$t_dtmPositionDate = $arrStep['tmpPositionDate'];
	$dtmDateOfPosition = explode('-',$t_dtmPositionDate);
	$intYearDate =  $dtmDateOfPosition[0];
	$intMonthDate = $dtmDateOfPosition[1]; 
	$intDayDate = $dtmDateOfPosition[2];
	
	$intYearOld = intval($intYearDate);
	$t_intStepIncrementOfThree = $dtmYearNow - $intYearOld;
	
	if(($dtmMonthNow <= $intMonthDate)&&(($t_intStepIncrementOfThree / 3) == 1)&&($t_strInService == "In-Service")&&($t_strPermanent == "Perm"))  
	{
		$ctrnum = $ctrnum + 1;
	}
}	//end while

if ($ctrnum <> 0)
{
// if number of entries is more than 1
printf("<a href=\"Stepincrement.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
printf("{&nbsp;");
printf("$ctrnum"); //prints number 
printf("&nbsp;}");
printf("&nbsp;&nbsp;");
printf("Step Increment"); 
printf("</a>");
} 
else { 
// if number of entries is less than 1 
printf("{&nbsp;");
printf("$ctrnum"); //prints number 
printf("&nbsp;}");
printf("&nbsp;&nbsp;");
printf("Step Increment");
printf("</a>");
}  

								?>
                              </td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td> 
                          <? 
} else {
?>
                        </td>
                      </tr>
                      <tr> 
                        <td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td> 
                                <?php 
								//Leave Request Module
								include("../hrmis/class/Connect.php");
								
								$t_strRequestStatusLeave = "Approved";
								$result = mysql_query("SELECT tblEmpRequest.requestID, tblEmpRequest.requestCode, tblEmpRequest.requestDetails, tblEmpRequest.requestStatus, tblEmpRequest.statusDate, tblEmpRequest.remarks, tblEmpRequest.signatory, tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename FROM tblEmpRequest INNER JOIN tblEmpPersonal ON tblEmpRequest.empNumber=tblEmpPersonal.empNumber WHERE tblEmpRequest.requestCode LIKE 'Leave' AND tblEmpRequest.requestStatus = '$t_strRequestStatusLeave' ");
								$num = mysql_num_rows($result); 
								
								if ($num <> 0){ 
								// if number of entries is more than 1
								printf("<a href=\"Leaverequest.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Leave Request");
								printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Leave Request");
								printf("</a>");
								} 
								
								?>
                              </td>
                            </tr>
                            <tr> 
                              <td> 
                                <?php
								//OB Request Module 
								include("../hrmis/class/Connect.php");
								
								$t_strRequestStatusOB = "Approved";								
								$result = mysql_query("SELECT tblEmpRequest.requestID, tblEmpRequest.requestCode, tblEmpRequest.requestDetails, tblEmpRequest.requestStatus, tblEmpRequest.statusDate, tblEmpRequest.remarks, tblEmpRequest.signatory, tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename FROM tblEmpRequest INNER JOIN tblEmpPersonal ON tblEmpRequest.empNumber=tblEmpPersonal.empNumber WHERE tblEmpRequest.requestCode LIKE 'OB' AND tblEmpRequest.requestStatus = '$t_strRequestStatusOB' ");
								$num = mysql_num_rows($result); 
								
								if ($num <> 0){ 
								// if number of entries is more than 1
								printf("<a href=\"OBrequest.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("OB Request");
								printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("OB Request");
								printf("</a>");
								} 
								
								?>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <?php
								//TO Request Module 
								include("../hrmis/class/Connect.php");
								
								$t_strRequestStatusTO = "Approved";								
								$result = mysql_query("SELECT tblEmpRequest.requestID, tblEmpRequest.requestCode, tblEmpRequest.requestDetails, tblEmpRequest.requestStatus, tblEmpRequest.statusDate, tblEmpRequest.remarks, tblEmpRequest.signatory, tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename FROM tblEmpRequest INNER JOIN tblEmpPersonal ON tblEmpRequest.empNumber=tblEmpPersonal.empNumber WHERE tblEmpRequest.requestCode LIKE 'TO' AND tblEmpRequest.requestStatus = '$t_strRequestStatusTO' ");
								$num = mysql_num_rows($result); 
								
								if ($num <> 0){ 
								// if number of entries is more than 1
								printf("<a href=\"TOrequest.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("TO Request");
								printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("TO Request");
								printf("</a>");
								} 
								
								?>
                              </td>
                            </tr>
                            <tr> 
                              <td> 
                                <?php 
								//Report Request Module
								include("../hrmis/class/Connect.php");
								
								$t_strRequestStatusReport = "Filed Request";
								$result = mysql_query("SELECT tblEmpRequest.requestID, tblEmpRequest.requestCode, tblEmpRequest.requestDetails, tblEmpRequest.requestStatus, tblEmpRequest.statusDate, tblEmpRequest.remarks, tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename FROM tblEmpRequest INNER JOIN tblEmpPersonal ON tblEmpRequest.empNumber=tblEmpPersonal.empNumber WHERE tblEmpRequest.requestCode LIKE 'Report' AND tblEmpRequest.requestStatus = '$t_strRequestStatusReport' ");
								$num = mysql_num_rows($result);  
								
								if ($num <> 0){ 
								// if number of entries is more than 1
								printf("<a href=\"Reportrequest.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Report Request");
								printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
								//printf("<a href=\"Reportrequest.php\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Report Request");
								printf("</a>");
								} 
								
								?>
                              </td>
                            </tr>
                            <tr> 
                              <td> 
                                <?php 
								//Update 201 Request Module
								include("../hrmis/class/Connect.php");
								
								$t_strRequestStatus201 = "Filed Request";
								$result = mysql_query("SELECT tblEmpRequest.requestID, tblEmpRequest.requestCode, tblEmpRequest.requestDetails, tblEmpRequest.requestStatus, tblEmpRequest.statusDate, tblEmpRequest.remarks, tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename FROM tblEmpRequest INNER JOIN tblEmpPersonal ON tblEmpRequest.empNumber=tblEmpPersonal.empNumber WHERE tblEmpRequest.requestCode LIKE '201' AND tblEmpRequest.requestStatus = '$t_strRequestStatus201' ");
								$num = mysql_num_rows($result); 
								
								if ($num <> 0){ 
								// if number of entries is more than 1
								printf("<a href=\"Update201request.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;"); 
								printf("Update 201 Request");
								printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
								//printf("<a href=\"Update201request.php\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Update 201 Request");
								printf("</a>");
								} 
								
								?>
                              </td>
                            </tr>
                            <tr> 
                              <td> 
                                <?php 
//Step Increment (statusOfAppointment equals In-Service, CurrentMonth equals month of PositionDate, CurrentYear minus PositionDateYear, AppointmentCode = Perm and Stepincrement divided by 3 equals 1)
include("../hrmis/class/Connect.php");

$t_dtmCurYear = date("Y");
$t_dtmCurMonth = date("m");
$t_dtmCURDate = $t_dtmCurYear . "-" . $t_dtmCurMonth . "-"; 

$resultStep = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname,
									tblEmpPosition.effectiveDate, tblEmpPosition.stepNumber, tblEmpPosition.actualSalary, 
									tblEmpPosition.salaryGradeNumber, tblEmpPosition.positionCode, tblEmpPosition.assignPlace,
									tblEmpPosition.appointmentCode, tblEmpPosition.dateIncremented, tblEmpPosition.positionDate,
									tblEmpPosition.tmpPositionDate,tblEmpPosition.statusOfAppointment,tblEmpPosition.appointmentCode
	   					  		FROM tblEmpPersonal
						 		 INNER JOIN tblEmpPosition
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								 INNER JOIN tblPosition	
								 	ON tblEmpPosition.positionCode = tblPosition.positionCode 
	");
$ctrnum = 0;
while($arrStep = mysql_fetch_array($resultStep))
{

	$dtmYearNow = date("Y");
	$dtmMonthNow = date("m");
	$t_strEmployeeNumber = $arrStep['empNumber'];
	$t_intStepNum = $arrStep['stepNumber'];
	$t_strPermanent = $arrStep['appointmentCode'];	// Perm
  	$t_strSalaryGrade = $arrQuery['salaryGradeNumber'];
	$t_strInService = $arrStep['statusOfAppointment'];	//In-Service
	$t_strEmpSurname = $arrStep['surname'];
	$t_dtmPositionDate = $arrStep['tmpPositionDate'];
	$dtmDateOfPosition = explode('-',$t_dtmPositionDate);
	$intYearDate =  $dtmDateOfPosition[0];
	$intMonthDate = $dtmDateOfPosition[1]; 
	$intDayDate = $dtmDateOfPosition[2];
	
	$intYearOld = intval($intYearDate);
	$t_intStepIncrementOfThree = $dtmYearNow - $intYearOld;
	
	if(($dtmMonthNow <= $intMonthDate)&&(($t_intStepIncrementOfThree / 3) == 1)&&($t_strInService == "In-Service")&&($t_strPermanent == "Perm"))  
	{
		$ctrnum = $ctrnum + 1;
	}
}	//end while

if ($ctrnum <> 0)
{
// if number of entries is more than 1
printf("<a href=\"Stepincrement.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
printf("{&nbsp;");
printf("$ctrnum"); //prints number 
printf("&nbsp;}");
printf("&nbsp;&nbsp;");
printf("Step Increment"); 
printf("</a>");
} 
else { 
// if number of entries is less than 1 
printf("{&nbsp;");
printf("$ctrnum"); //prints number 
printf("&nbsp;}");
printf("&nbsp;&nbsp;");
printf("Step Increment");
printf("</a>");
}  

								?>
                              </td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td height="13"> 
                          <? 
}   // endif 
?>
                        </td>
                      </tr>
                      <tr> 
                        <td height="16"><img src="images/reminders.jpg"></td>
                      </tr>
                      <tr> 
                        <td height="16"> 
                          <?   //  HR and Cashier module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == 1234567) 
{
?>
                        </td>
                      </tr>
                      <tr> 
                        <td height="6"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td> 
                                <?php 
								//Birthday Module
								include("../hrmis/class/Connect.php");
								$var="-".date("m")."-";
								$result = mysql_query("SELECT firstname, birthday FROM tblEmpPersonal WHERE birthday LIKE '%$var%' "); 
								$num = mysql_num_rows($result); 
								
								if ($num <> 0){ 
								// if number of entries is more than 1
								printf("<a href=\"Birthday.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Birthday");
								printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
								//printf("<a href=\"Birthday.php\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Birthday");
								printf("</a>");
								} 
								
								?>
                              </td>
                            </tr>
                            <tr> 
                              <td> 
                                <?php 
								//Finish Contract Module
								include("../hrmis/class/Connect.php");
								
								$Year=date("Y")."-".date("m")."-";
								$result = mysql_query("SELECT * FROM tblEmpPosition LEFT JOIN tblEmpPersonal ON tblEmpPosition.empNumber=tblEmpPersonal.empNumber WHERE tblEmpPosition.contractEndDate LIKE '%$Year%'"); 
								$num = mysql_num_rows($result); 

								if ($num <> 0){ 
								// if number of entries is more than 1
								printf("<a href=\"Finishcontract.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Employees Movement");
								printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
								//printf("<a href=\"Finishcontract.php\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Employees Movement"); 
								printf("</a>");
								} 
								
								?>
                              </td>
                            </tr>
                            <tr> 
                              <td> 
                                <?php 
								//Lates/Undertime Module
								include("../hrmis/class/Connect.php");
require_once("../hrmis/class/Attendance.php");

$objTardy = new Attendance;
$curYear= date('Y');
$curMonth = date("m");
$intPreviousMonthYr = $objTardy->getPreMonth($curMonth,$curYear);
$intPreviousMonth = $intPreviousMonthYr['month'];
$intPrevCurYear = $intPreviousMonthYr['year'];

$objEmpTardy = mysql_query("SELECT empNumber
							 FROM tblEmpPersonal
							 ORDER BY surname asc");

$num=0;
while($arrEmployees = mysql_fetch_array($objEmpTardy))
{
	$arrTardyUnd = $objTardy->getLateUndPrMonth($arrEmployees["empNumber"], $intPreviousMonth, $intPrevCurYear);
	
	if($arrTardyUnd["count"] >= 10)
	{
		$num = $num + 1;
	}
}
								if ($num <> 0){ 
								// if number of entries is more than 1
								printf("<a href=\"Tardiness.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Lates/Undertime");
								printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Lates/Undertime");
								printf("</a>");
								} 
	 																																																	
								?>
                              </td>
                            </tr>
                            <tr> 
                              <td> 
                                <?php 
								//Vacant Position
								include("../hrmis/class/Connect.php");
								
								$objVacantPositions = mysql_query("SELECT tblEmpPersonal.empNumber,
								 		tblEmpPosition.itemNumber, tblEmpPosition.divisionCode,
										tblEmpPosition.statusOfAppointment, tblEmpPosition.positionCode,
										tblPosition.positionDesc
								   FROM tblEmpPersonal
								   INNER JOIN tblEmpPosition
									  ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								   INNER JOIN tblPlantilla
								   	  ON tblEmpPosition.itemNumber = tblPlantilla.itemNumber
								   INNER JOIN tblPosition
								   	  ON tblEmpPosition.positionCode = tblPosition.positionCode
								   INNER JOIN tblDivision
								   	  ON tblEmpPosition.divisionCode = tblDivision.divisionCode
								   WHERE statusOfAppointment != 'In-Service'");
								 
								if ($num = mysql_num_rows($objVacantPositions))
								{
									if($strAppointmentStatus != 'In-Service')
									{
									$strEmpNum = $num['empNumber'];
									$strItemNum = $num['itemNumber'];
									$strDivsionCode = $num['divisionCode'];
									$strAppointmentStatus = $num['statusOfAppointment'];
									$strPositionCode = $num['positionCode'];
									$strPositionDesc = $num['positionDesc'];
										
									}
								}

								if ($num <> 0){ 
								printf("<a href=\"Vacantposition.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Vacant Position");
								printf("</a>");
								}  // if number of entries is less than 1 
								else { 
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Vacant Position");
								printf("</a>");
								} 
								
								?>
                              </td>
                            </tr>
                            <tr> 
                              <td height="18"> 
                                <?php 
								//Retiree for this year
								include("../hrmis/class/Connect.php");
								
								$dtmCurYear = date("Y");
								$dtmPrevYear = $dtmCurYear - 65;
								$dtmJanYear = $dtmPrevYear . "-" . "01-01";
								$dtmDecYear = $dtmPrevYear . "-" . "12-31";
								
								$resultRetirees = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname,
									tblEmpPersonal.birthday, tblEmpPosition.statusOfAppointment
								FROM tblEmpPersonal
								INNER JOIN tblEmpPosition
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								WHERE tblEmpPosition.statusOfAppointment = 'In-Service'
								AND tblEmpPersonal.birthday >= '$dtmJanYear' 
								AND tblEmpPersonal.birthday <= '$dtmDecYear'");
								
															
								if($num = mysql_num_rows($resultRetirees))
								{

									if($strStatusOfAppointment == 'In-Service' && $t_intRetireeAge == 65)
									{
									$t_strNumber = $num['empNumber'];
									$strSurname = $num['surname'];
									$dtmDateOfBirth = $num['birthday'];
									$strStatusOfAppointment = $num['statusOfAppointment'];
									$dtmBirthdate = explode('-', $dtmDateOfBirth);
									$dtmBdayYear = $dtmBirthdate[0];
									$dtmBdayMonth = $dtmBirthdate[1];
									$dtmBdayDay = $dtmBirthdate[2];
									$t_dtmBdayYear = intval($dtmBdayYear);
									
									$t_intRetireeAge = $dtmCurYear - $t_dtmBdayYear;
									}	
								}
								
								if ($num <> 0)
								{ 
								// if number of entries is more than 1
									printf("<a href=\"Retiree.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
									printf("{&nbsp;");
									printf("$num"); //prints number 
									printf("&nbsp;}");
									printf("&nbsp;&nbsp;");
									printf("Retiree");
									printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
									printf("{&nbsp;");
									printf("$num"); //prints number 
									printf("&nbsp;}");
									printf("&nbsp;&nbsp;");
									printf("Retiree");
									printf("</a>");
								} 
								?>
                              </td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td height="7"> 
                          <? 
} else {
?>
                        </td>
                      </tr>
                      <tr> 
                        <td> <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td> 
                                <?php 
								//Birthday Module
								include("../hrmis/class/Connect.php");
								$var="-".date("m")."-";
								$result = mysql_query("SELECT firstname, birthday FROM tblEmpPersonal WHERE birthday LIKE '%$var%' "); 
								$num = mysql_num_rows($result); 
								
								if ($num <> 0){ 
								// if number of entries is more than 1
								printf("<a href=\"Birthday.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Birthday");
								printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
								//printf("<a href=\"Birthday.php\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}"); 
								printf("&nbsp;&nbsp;");
								printf("Birthday");
								printf("</a>");
								} 
								
								?>
                              </td>
                            </tr>
                            <tr> 
                              <td> 
                                <?php 
								//Finish Contract Module
								include("../hrmis/class/Connect.php");
								
								$Year=date("Y")."-".date("m")."-";
								$result = mysql_query("SELECT * FROM tblEmpPosition LEFT JOIN tblEmpPersonal ON tblEmpPosition.empNumber=tblEmpPersonal.empNumber WHERE tblEmpPosition.contractEndDate LIKE '%$Year%'"); 
								$num = mysql_num_rows($result); 

								if ($num <> 0){ 
								// if number of entries is more than 1
								printf("<a href=\"Finishcontract.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Employees Movement");
								printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Employees Movement");
								printf("</a>");
								} 
								
								?>
                              </td>
                            </tr>
                            <tr> 
                              <td> 
                                <?php 
								//Lates/Undertime Module
								include("../hrmis/class/Connect.php");
require_once("../hrmis/class/Attendance.php");

$objTardy = new Attendance;
$curYear= date('Y');
$curMonth = date("m");
$intPreviousMonthYr = $objTardy->getPreMonth($curMonth,$curYear);
$intPreviousMonth = $intPreviousMonthYr['month'];
$intPrevCurYear = $intPreviousMonthYr['year'];

$objEmpTardy = mysql_query("SELECT empNumber
							 FROM tblEmpPersonal
							 ORDER BY surname asc");

$num=0;
while($arrEmployees = mysql_fetch_array($objEmpTardy))
{
	$arrTardyUnd = $objTardy->getLateUndPrMonth($arrEmployees["empNumber"], $intPreviousMonth, $intPrevCurYear);
	
	if($arrTardyUnd["count"] >= 10)
	{
		$num = $num + 1;
	}
}
								if ($num <> 0){ 
								// if number of entries is more than 1
								printf("<a href=\"Tardiness.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Lates/Undertime");
								printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Lates/Undertime");
								printf("</a>");
								} 
	 																																																	
								?>
                              </td>
                            </tr>
                            <tr> 
                              <td> 
                                <?php 
								//Vacant Position
								include("../hrmis/class/Connect.php");
								
								$objVacantPositions = mysql_query("SELECT tblEmpPersonal.empNumber,
								 		tblEmpPosition.itemNumber, tblEmpPosition.divisionCode,
										tblEmpPosition.statusOfAppointment, tblEmpPosition.positionCode,
										tblPosition.positionDesc
								   FROM tblEmpPersonal
								   INNER JOIN tblEmpPosition
									  ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								   INNER JOIN tblPlantilla
								   	  ON tblEmpPosition.itemNumber = tblPlantilla.itemNumber
								   INNER JOIN tblPosition
								   	  ON tblEmpPosition.positionCode = tblPosition.positionCode
								   INNER JOIN tblDivision
								   	  ON tblEmpPosition.divisionCode = tblDivision.divisionCode
								   WHERE statusOfAppointment != 'In-Service'");
								 
								if ($num = mysql_num_rows($objVacantPositions))
								{
									if($strAppointmentStatus != 'In-Service')
									{
									$strEmpNum = $num['empNumber'];
									$strItemNum = $num['itemNumber'];
									$strDivsionCode = $num['divisionCode'];
									$strAppointmentStatus = $num['statusOfAppointment'];
									$strPositionCode = $num['positionCode'];
									$strPositionDesc = $num['positionDesc'];
										
									}
								}

								if ($num <> 0){ 
								printf("<a href=\"Vacantposition.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Vacant Position");
								printf("</a>");
								}  // if number of entries is less than 1 
								else { 
								printf("{&nbsp;");
								printf("$num"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Vacant Position");
								printf("</a>");
								} 
								
								?>
                              </td>
                            </tr>
                            <tr> 
                              <td height="18"> 
								<?php 
								//Retiree for this year
								include("../hrmis/class/Connect.php");
								
								$dtmCurYear = date("Y");
								$dtmPrevYear = $dtmCurYear - 65;
								$dtmJanYear = $dtmPrevYear . "-" . "01-01";
								$dtmDecYear = $dtmPrevYear . "-" . "12-31";
								
								$resultRetirees = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname,
									tblEmpPersonal.birthday, tblEmpPosition.statusOfAppointment
								FROM tblEmpPersonal
								INNER JOIN tblEmpPosition
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								WHERE tblEmpPosition.statusOfAppointment = 'In-Service'
								AND tblEmpPersonal.birthday >= '$dtmJanYear' 
								AND tblEmpPersonal.birthday <= '$dtmDecYear'");
								
															
								if($num = mysql_num_rows($resultRetirees))
								{

									if($strStatusOfAppointment == 'In-Service' && $t_intRetireeAge == 65)
									{
									$t_strNumber = $num['empNumber'];
									$strSurname = $num['surname'];
									$dtmDateOfBirth = $num['birthday'];
									$strStatusOfAppointment = $num['statusOfAppointment'];
									$dtmBirthdate = explode('-', $dtmDateOfBirth);
									$dtmBdayYear = $dtmBirthdate[0];
									$dtmBdayMonth = $dtmBirthdate[1];
									$dtmBdayDay = $dtmBirthdate[2];
									$t_dtmBdayYear = intval($dtmBdayYear);
									
									$t_intRetireeAge = $dtmCurYear - $t_dtmBdayYear;
									}	
								}
								
								if ($num <> 0)
								{ 
								// if number of entries is more than 1
									printf("<a href=\"Retiree.php?strEmpNmbr=$strEmpNmbr&t_strUserLevel=$t_strUserLevel&t_strUserPermission=$t_strUserPermission&t_strAccessPermission=$t_strAccessPermission\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
									printf("{&nbsp;");
									printf("$num"); //prints number 
									printf("&nbsp;}");
									printf("&nbsp;&nbsp;");
									printf("Retiree");
									printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
									printf("{&nbsp;");
									printf("$num"); //prints number 
									printf("&nbsp;}");
									printf("&nbsp;&nbsp;");
									printf("Retiree");
									printf("</a>");
								} 
								?>
                              </td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td>
                          <? 
}   // endif 
?>
                        </td>
                      </tr>
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td><img src="images/howto.jpg" width="78" height="21"> 
                        </td>
                      </tr>
                      <tr> 
                        <td><table width="75%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td><p><a href="javascript:openPrint()">* 
                                  HR Module</a></p></td>
                            </tr>
                            <tr> 
                              <td><p>&nbsp;</p></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td height="25" align="center" valign="middle">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="20"><div align="center"><a href="index.php" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('logout','','images/logout2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/logout.jpg" alt="logout" name="logout" width="108" height="20" border="0"></a> 
                          </div></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
            <td width="78%" valign="top" bgcolor="#E9F3FE"><table width="99%" height="389" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF">
                <tr> 
                  <td><!-- InstanceBeginEditable name="BODY" --> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td height="32" class="header"><p>report REQUEST(S)</p></td>
                      </tr>
                      <tr> 
                        <td height="9"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td> 
                                <?
							  $objReportrequest->viewReportRequest($strEmpNmbr); //View list of employee/s request (Reportrequest.php)
							  ?>
                              </td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td height="4">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="5"> <form action="<? $PHP_SELF; ?>" method="post" name="frmReportrequest">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr> 
                                <td> 
                                  <? if ($Submit == 'View') 
								    { 
								 ?>
                                </td>
                              </tr>
                              <tr> 
                                <td><hr></td>
                              </tr>
                              <tr> 
                                <td> 
                                  <? if ($t_strReportType == 'Remittance') 
								    { 
								 ?>
                                </td>
                              </tr>
                              <tr> 
                                <td> <table width="90%" border="1" align="center" cellpadding="0" cellspacing="0">
                                    <tr class="title"> 
                                      <td colspan="4">&nbsp; </td>
                                    </tr>
                                    <tr> 
                                      <td width="32%" class="paragraph"><strong> 
                                        <input name="t_strSignatory" type="hidden" value="<? echo $_SESSION['strLoginName']; ?>">
                                        </strong>Type of Reports : </td>
                                      <td width="68%" colspan="3"><input name="t_strReportType" type="text" readonly value="<? echo $t_strReportType; ?>" size="20" maxlength="20"></td>
                                    </tr>
                                    <tr> 
                                      <td width="32%" class="paragraph">Type of 
                                        Remittance :</td>
                                      <td colspan="3"><input name="t_strRemittanceDesc" type="text" id="t_strRemittanceDesc" value="<? echo $t_strRemittanceDesc; ?>" size="50" maxlength="50" readonly></td>
                                    </tr>
                                    <tr> 
                                      <td width="32%" class="paragraph">Report 
                                        Date :</td>
                                      <td colspan="3"><input name="t_dtmReportDate" type="text" readonly value="<? echo $t_dtmReportDate; ?>" size="20" maxlength="20"></td>
                                    </tr>
                                    <tr> 
                                      <td width="32%" class="paragraph">Remarks 
                                        : </td>
                                      <td colspan="3"><input name="t_strRemarks" type="text" value="<? echo $t_strRemarks; ?>" size="20" maxlength="20">
                                        <strong> 
                                        <input name="t_strRequestStatus" type="hidden" value="<? echo "Notified"; ?>">
                                        <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr; ?>">
                                        </strong></td>
                                    </tr>
                                    <tr> 
                                      <td colspan="4"> <div align="justify"></div></td>
                                    </tr>
                                    <tr> 
                                      <td colspan="4"><div align="center"><strong> 
                                          </strong> 
                                          <input name="Submit" type="submit" value="Notify">
                                        </div></td>
                                    </tr>
                                  </table></td>
                              </tr>
                              <tr> 
                                <td> 
                                  <? } else
								    { 
								 ?>
                                </td>
                              </tr>
                              <tr> 
                                <td><table width="90%" border="1" align="center" cellpadding="0" cellspacing="0">
                                    <tr class="title"> 
                                      <td colspan="4">&nbsp; </td>
                                    </tr>
                                    <tr> 
                                      <td width="32%" class="paragraph"><strong> 
                                        <input name="t_strSignatory" type="hidden" id="t_strSignatory" value="<? echo $_SESSION['strLoginName']; ?>">
                                        </strong>Type of Reports : </td>
                                      <td width="68%" colspan="3"><input name="t_strReportType2" type="text" readonly value="<? echo $t_strReportType; ?>" size="20" maxlength="20"></td>
                                    </tr>
                                    <tr> 
                                      <td width="32%" class="paragraph">Report 
                                        Date :</td>
                                      <td colspan="3"><input name="t_strRemittanceDesc" type="text" id="t_strRemittanceDesc3" value="<? echo $t_strRemittanceDesc; ?>" size="20" maxlength="20" readonly></td>
                                    </tr>
                                    <tr> 
                                      <td width="32%" class="paragraph">Remarks 
                                        : </td>
                                      <td colspan="3"><input name="t_strRemarks" type="text" id="t_strRemarks" value="<? echo $t_strRemarks; ?>" size="20" maxlength="20">
                                        <strong> 
                                        <input name="t_strRequestStatus" type="hidden" id="t_strRequestStatus" value="<? echo "Notified"; ?>">
                                        <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr; ?>">
                                        </strong></td>
                                    </tr>
                                    <tr> 
                                      <td colspan="4"> <div align="justify"></div></td>
                                    </tr>
                                    <tr> 
                                      <td colspan="4"><div align="center"><strong> 
                                          </strong> 
                                          <input name="Submit" type="submit" id="Submit" value="Notify">
                                        </div></td>
                                    </tr>
                                  </table></td>
                              </tr>
                              <tr>
                                <td>
                                  <? } 
								 ?>
                                </td>
                              </tr>
                              <tr> 
                                <td> 
                                  <? } ?>
                                </td>
                              </tr>
                            </table>
                          </form></td>
                      </tr>
                    </table>
                    <p>&nbsp;</p>
                    <!-- InstanceEndEditable --></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="13"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#002E7F">
          <tr> 
            <td height="13"><div align="center"><font color="#FFFFFF">Copyright 
                &copy; 2003 Department of Science and Technology</font></div></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>
</body>
<!-- InstanceEnd --></html>
