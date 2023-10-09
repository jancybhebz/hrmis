<?
/* 
File Name: FileRequest.php 
----------------------------------------------------------------------
Purpose of this file: 
View employees request on Official Business, Travel order, overtime, etc
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
require("../hrmis/class/Attendance.php");
$objAttendance = new Attendance;
$objAttendance->setvar(array('strEmpNmbr'=>$strEmpNmbr, 'txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>$cboMonth, 'cboYear'=>$cboYear, 'strLetter'=>$strLetter, 'strFR'=>$strFR)); //for maintain state
$objAttendance->trapButton($txtSearch, $strLetter, "SearchNoMatch.php", "Attendancesummary.php");
$arrEmpPersonal = $objAttendance->checkGetEmpNmbr("Attendance", $txtSearch, $optField, $cboMonth, $cboYear, 1, $p, $strLetter);
?>
<html><!-- InstanceBegin template="/Templates/Attendancetmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/javascript/Attendance.js");
include("../hrmis/class/JSgeneral.php")
?>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="hrmis.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
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
$strMonthFull = $objAttendance->intToMonthFull($cboMonth);
?>					  
					                          <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td height="26"><p class="header">FILED REQUEST</p>
								<p align="center">
								  <?
								  $objAttendance->navigateEmployee($cboMonth, $cboYear);
								  ?>								
								</p>							
							<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
                                <tr> 
                                  <td width="80%" height="74"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                                      <tr bgcolor="#99CCFF" class="radio"> 
                                        <td width="20%" valign="middle" align="right">Employee No.:&nbsp;&nbsp;</td>
                                        <td width="80%" valign="middle"><strong><? echo $arrEmpPersonal["empNumber"]?></strong></td>
                                      </tr>
                                      <tr bgcolor="#99CCFF" class="radio"> 
                                        
                                    <td valign="middle" align="right">Name:&nbsp;&nbsp;</td>
                                        <td valign="middle"><strong><? echo $arrEmpPersonal["surname"].", ".$arrEmpPersonal["firstname"]." ".$arrEmpPersonal["middlename"]?></strong></td>
                                      </tr>
                                      <tr bgcolor="#99CCFF" class="radio"> 
                                        <td valign="middle" align="right">Division:&nbsp;&nbsp;</td>
                                        <td valign="middle" align="left"><strong><? echo $arrEmpPersonal["divisionCode"]?></strong></td>
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
                                      </tr>									  
                                    </table></td>
                                  <td width="20%"><table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td height="70" align="right" valign="middle" bgcolor="#99CCFF"><img src="EmployeeImage.php?strEmpNmbr=<? echo $arrEmpPersonal["empNumber"];?>" width="70" height="70"></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td height="20" valign="bottom"></td>
                          </tr>
						  <tr><td colspan="5">
						  <table width="90%" align="center" cellpadding="1" cellspacing="1">
							<tr><td class="radio">
						  <a href="FiledRequest.php?p=<? echo $p?><? echo $objAttendance->varstr?>&strFR=OB" onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();">
						  <?
						  $objAttendance->alterArrow($strFR, "OB");
						  ?>					  
						  &nbsp;&nbsp; Official Business</a>
						  </td>
						  <td class="radio">
						  <a href="FiledRequest.php?p=<? echo $p?><? echo $objAttendance->varstr?>&strFR=L" onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();">
						  <?
						  $objAttendance->alterArrow($strFR, "L");
						  ?>					  
						  &nbsp;&nbsp; Leave</a>
						  </td>
						  <td class="radio">
						  <a href="FiledRequest.php?p=<? echo $p?><? echo $objAttendance->varstr?>&strFR=OT" onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();">
						  <?
						  $objAttendance->alterArrow($strFR, "OT");
						  ?>					  
						  &nbsp;&nbsp; Overtime</a>
						  </td></tr>
						  <tr><td class="radio">
						  <a href="FiledRequest.php?p=<? echo $p?><? echo $objAttendance->varstr?>&strFR=TO" onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();">
						  <?
						  $objAttendance->alterArrow($strFR, "TO");
						  ?>					  
						  &nbsp;&nbsp; Travel Order</a>
						  </td>
						  <td class="radio">
						  <a href="FiledRequest.php?p=<? echo $p?><? echo $objAttendance->varstr?>&strFR=TT" onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();">
						  <?
						  $objAttendance->alterArrow($strFR, "TT");
						  ?>					  
						  &nbsp;&nbsp; Trip Ticket</a>
						  </td>
						<td class="radio">
						  <a href="FiledRequest.php?p=<? echo $p?><? echo $objAttendance->varstr?>&strFR=MET" onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();"">
						  <?
						  $objAttendance->alterArrow($strFR, "MET");
						  ?>					  
						  &nbsp;&nbsp; Meeting</a>
						  </td>						  
						  </tr>
						  </table>
						  <form action="Leavebalance.php" method="get">
						  <table width="90%" align="center" cellpadding="0" cellspacing="0">
<?
if ($strFR == "OB")
{
	$objEmpRqstOB = $objAttendance->filedRequestOB($arrEmpPersonal["empNumber"], $cboYear, $cboMonth, 5, $p);
?>						  
						  <tr> 
							<td height="20" bgcolor="#C6E2FE" class="header"><p><strong>OFFICIAL BUSINESS</strong></p></td>
						  </tr>
						  <tr><td>
					<?
					if(mysql_num_rows($objEmpRqstOB) == 0)
					{
					?>
					<table width="100%" align="center" cellpadding="0" cellspacing="0">
					<tr> 
	                                  <td colspan="6" height="140" align="center" valign="middle" class="errorsearch">This 
                                      employee does not file official business request for this month.</td>
					  </tr>
					</table>
					<?
					}
					else
					{
					?>
							  <table width="100%" align="center" cellpadding="1" cellspacing="1" class="titlebar">
							  <tr bgcolor="#99CCFF" class="title">
							  <td>DATE FILED</td>
							  <td>PLACE</td>
							          <td>FROM</td>							  							  
							  <td>TO</td>							  
							  </tr>
							  <tr><td colspan="4" height="10"></td></tr>
							  <?
							  while($arrEmpRqstOB = mysql_fetch_array($objEmpRqstOB))
							  {
							  	echo "<tr bgcolor='#99CCFF'>";
								echo "<td>".date("m/d/Y", strtotime($arrEmpRqstOB["dateFiled"]))."</td>";
								echo "<td>".$arrEmpRqstOB["obPlace"]."</td>";
								echo "<td>".date("m/d/Y", strtotime($arrEmpRqstOB["obDateFrom"]))."</td>";
								echo "<td>".date("m/d/Y", strtotime($arrEmpRqstOB["obDateTo"]))."</td>";
							  	echo "</tr>";								
							  }
							  ?>
							  </table>
					<?
					}
					?>
						  </td></tr>
<?
}
elseif($strFR == "L")
{
	$objEmpRqstLeave = $objAttendance->filedRequestLeave($arrEmpPersonal["empNumber"], $cboYear, $cboMonth, 5, $p);
?>
						  <tr> 
							<td height="20" bgcolor="#C6E2FE" class="header"><p><strong>LEAVE</strong></p></td>
						  </tr>
						  <tr><td>
					<?
					if(mysql_num_rows($objEmpRqstLeave) == 0)
					{
					?>
					<table width="100%" align="center" cellpadding="0" cellspacing="0">
					<tr> 
	                                  <td colspan="6" height="140" align="center" valign="middle" class="errorsearch">This 
                                      employee  does not file leave request for this month.</td>
					  </tr>
					</table>
					<?
					}
					else
					{
					?>

							  <table width="100%" align="center" cellpadding="1" cellspacing="1" class="titlebar">
							  <tr bgcolor="#99CCFF" class="title">
							  <td>DATE FILED</td>
							  <td>LEAVE TYPE</td>
							  <td>FROM</td>							  							  
							  <td>TO</td>							  
							  </tr>
							  <tr><td colspan="4" height="10"></td></tr>
							  <?
							  while($arrEmpRqst = mysql_fetch_array($objEmpRqstLeave))
							  {
							  	echo "<tr bgcolor='#99CCFF'>";
								echo "<td>".date("m/d/Y", strtotime($arrEmpRqst["dateFiled"]))."</td>";
								echo "<td>".$arrEmpRqst["leaveType"]."</td>";
								echo "<td>".date("m/d/Y", strtotime($arrEmpRqst["leaveFrom"]))."</td>";
								echo "<td>".date("m/d/Y", strtotime($arrEmpRqst["leaveTo"]))."</td>";
							  	echo "</tr>";								
							  }
							  ?>
							  </table>
					<?
					}
					?>
						  </td></tr>

<?
}
elseif($strFR == "OT")
{
	$objEmpRqstOT = $objAttendance->filedRequestOT($arrEmpPersonal["empNumber"], $cboYear, $cboMonth, 5, $p);
?>						  
						  <tr> 
							<td height="20" bgcolor="#C6E2FE" class="header"><p><strong>OVERTIME</strong></p></td>
						  </tr>
						  <tr><td>
					<?
					if(mysql_num_rows($objEmpRqstOT) == 0)
					{
					?>
					<table width="100%" align="center" cellpadding="0" cellspacing="0">
					<tr> 
	                                  <td colspan="6" height="140" align="center" valign="middle" class="errorsearch">This 
                                      employee  does not file overtime request for this month.</td>
					  </tr>
					</table>
					<?
					}
					else
					{
					?>
							  <table width="100%" align="center" cellpadding="1" cellspacing="1" class="titlebar">
							  <tr bgcolor="#99CCFF" class="title">
							  <td>DATE FILED</td>
							  <td>DOCUMENT #</td>
							  <td>FROM</td>							  							  
							  <td>TO</td>							  
							  </tr>
							  <tr><td colspan="4" height="10"></td></tr>
							  <?
							  while($arrEmpRqst = mysql_fetch_array($objEmpRqstOT))
							  {
							  	echo "<tr bgcolor='#99CCFF'>";
								echo "<td>".date("m/d/Y", strtotime($arrEmpRqst["dateFiled"]))."</td>";
								echo "<td>".$arrEmpRqst["docNumber"]."</td>";
								echo "<td>".date("m/d/Y", strtotime($arrEmpRqst["otDateFrom"]))."</td>";
								echo "<td>".date("m/d/Y", strtotime($arrEmpRqst["otDateTo"]))."</td>";
							  	echo "</tr>";								
							  }
							  ?>
							  </table>
					<?
					}
					?>
						  </td></tr>

<?
}
elseif($strFR == "TO")
{
	$objEmpRqstTO = $objAttendance->filedRequestTO($arrEmpPersonal["empNumber"], $cboYear, $cboMonth, 5, $p);
?>
						  <tr> 
							<td height="20" bgcolor="#C6E2FE" class="header"><p><strong>TRAVEL ORDER</strong></p></td>
						  </tr>
						  <tr><td>
					<?
					if(mysql_num_rows($objEmpRqstTO) == 0)
					{
					?>
					<table width="100%" align="center" cellpadding="0" cellspacing="0">
					<tr> 
	                                  <td colspan="6" height="140" align="center" valign="middle" class="errorsearch">This 
                                      employee  does not file travel order request for this month.</td>
					  </tr>
					</table>
					<?
					}
					else
					{
					?>
							  <table width="100%" align="center" cellpadding="1" cellspacing="1" class="titlebar">
							  <tr bgcolor="#99CCFF" class="title">
							  <td>DATE FILED</td>
							  <td>DESTINATION</td>
							  <td>FROM</td>							  							  
							  <td>TO</td>							  
							  </tr>
							  <tr><td colspan="4" height="10"></td></tr>
							  <?
							  while($arrEmpRqst = mysql_fetch_array($objEmpRqstTO))
							  {
							  	echo "<tr bgcolor='#99CCFF'>";
								echo "<td>".date("m/d/Y", strtotime($arrEmpRqst["dateFiled"]))."</td>";
								echo "<td>".$arrEmpRqst["destination"]."</td>";
								echo "<td>".date("m/d/Y", strtotime($arrEmpRqst["toDateFrom"]))."</td>";
								echo "<td>".date("m/d/Y", strtotime($arrEmpRqst["toDateTo"]))."</td>";
							  	echo "</tr>";								
							  }
							  ?>
							  </table>
					<?
					}
					?>
						  </td></tr>

<?
}
elseif($strFR == "TT")
{
	$objEmpRqstTT = $objAttendance->filedRequestTT($arrEmpPersonal["empNumber"], $cboYear, $cboMonth, 5, $p);
?>	  
						  <tr> 
							<td height="20" bgcolor="#C6E2FE" class="header"><p><strong>TRIP TICKET</strong></p></td>
						  </tr>
						  <tr><td>
					<?
					if(mysql_num_rows($objEmpRqstTT) == 0)
					{
					?>
					<table width="100%" align="center" cellpadding="0" cellspacing="0">
					<tr> 
	                                  <td colspan="6" height="140" align="center" valign="middle" class="errorsearch">This 
                                      employee  does not file trip ticket request for this month.</td>
					  </tr>
					</table>
					<?
					}
					else
					{
					?>
							  <table width="100%" align="center" cellpadding="1" cellspacing="1" class="titlebar">
							  <tr bgcolor="#99CCFF" class="title">
							  <td>DATE FILED</td>
							  <td>DESTINATION</td>
							  <td>FROM</td>							  							  
							  <td>TO</td>							  
							  </tr>
							  <tr><td colspan="4" height="10"></td></tr>
							  <?
							  while($arrEmpRqst = mysql_fetch_array($objEmpRqstTT))
							  {
							  	echo "<tr bgcolor='#99CCFF'>";
								echo "<td>".date("m/d/Y", strtotime($arrEmpRqst["dateFiled"]))."</td>";
								echo "<td>".$arrEmpRqst["destination"]."</td>";
								echo "<td>".date("m/d/Y", strtotime($arrEmpRqst["ttDateFrom"]))."</td>";
								echo "<td>".date("m/d/Y", strtotime($arrEmpRqst["ttDateTo"]))."</td>";
							  	echo "</tr>";								
							  }
							  ?>
							  </table>
					<?
					}
					?>
						  </td></tr>

<?
}
elseif($strFR == "MET")
{
	$objEmpRqstMeeting = $objAttendance->filedRequestMeeting($arrEmpPersonal["empNumber"], $cboYear, $cboMonth, 5, $p);
?>						  
  						  <tr> 
							<td height="20" bgcolor="#C6E2FE" class="header"><p><strong>MEETING</strong></p></td>
						  </tr>
						  <tr><td>
					<?
					if(mysql_num_rows($objEmpRqstMeeting) == 0)
					{
					?>
					<table width="100%" align="center" cellpadding="0" cellspacing="0">
					<tr> 
	                                  <td colspan="6" height="140" align="center" valign="middle" class="errorsearch">This 
                                      employee  does not file in-house meeting request for this month.</td>
					  </tr>
					</table>
					<?
					}
					else
					{
					?>
							  <table width="100%" align="center" cellpadding="1" cellspacing="1" class="titlebar">
							  <tr bgcolor="#99CCFF" class="title">
							  <td>DATE FILED</td>
							  <td>TIME</td>
							  <td>DATE</td>							  
							  </tr>
							  <tr><td colspan="4" height="10"></td></tr>
							  <?
							  while($arrEmpRqstOB = mysql_fetch_array($objEmpRqstMeeting))
							  {
							  	echo "<tr bgcolor='#99CCFF'>";
								echo "<td>".date("m/d/Y", strtotime($arrEmpRqstOB["dateFiled"]))."</td>";
								echo "<td>".$arrEmpRqstOB["meetingTitle"]."</td>";
								echo "<td>".date("m/d/Y", strtotime($arrEmpRqstOB["meetingDate"]))."</td>";
							  	echo "</tr>";								
							  }
							  ?>
							  </table>
					<?
					}
					?>
						  </td></tr>

<?
}
?>						  

						  </table></form>
						  </td></tr>
						  <tr><td colspan="5" height="10" align="right"><? 
						  $objAttendance->output(); 
						  ?></td></tr>
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
