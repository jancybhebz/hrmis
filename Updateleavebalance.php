<?
/* 
File Name: Updateleavebalance.php 
----------------------------------------------------------------------
Purpose of this file: 
Update leave balance of all employees
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
$objAttendance->setvar(array('strEmpNmbr'=>$strEmpNmbr, 'txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>$cboMonth, 'cboYear'=>$cboYear, 'strLetter'=>$strLetter)); //for maintain state
if($btnUpdateLB)
{
	$objAttendance->updateLeaveBalance($intNxtMonth, $intNxtYear);   //update the leave balance 
}

$arrLastLB = $objAttendance->getLastRcrdFrmLeaveBlnc();
$strMonthFull = $objAttendance->intToMonthFull($arrLastLB['periodMonth']);
$arrNxtYear = $objAttendance->getNextMonth($arrLastLB['periodMonth'], $arrLastLB['periodYear']);
$strNxtMonthFull = $objAttendance->intToMonthFull($arrNxtYear['month']);

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
function openPrint()
{
	var strMonth = "<? echo $cboMonth ?>";
	var strYear = "<? echo $cboYear ?>";
	var strEmpNmbr = "<? echo $arrEmpPersonal['empNumber']?>";
	var strPage = "ReportData.php?intHeadFoot=1&strReports=LB&strEmpNmbr="+strEmpNmbr+"&intMonthFrom="+strMonth+"&intMonthTo="+strMonth+"&intYearFrom="+strYear+"&intYearTo="+strYear;
	window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=630,height=500');
}

function trapAheadMonthUpdate()
{
	var intNextMonth = document.all.intNxtMonth.value;
	var intNextYear = document.all.intNxtYear.value;
	var dtmDateNow = new Date();
	
	if((parseInt(intNextMonth) >= dtmDateNow.getMonth() + 1) && (parseInt(intNextYear) >= dtmDateNow.getYear()))
	{
		alert('You cannot update months that are ahead and current month.');
		event.returnValue=false;		
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
				  <?
				  ?>
				<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td><p class="header">UPDATE LEAVE BALANCE</p></td>
                          </tr>
                          <tr> 
                            <td> <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td colspan="4" class="td" height="25">&nbsp;</td>
                                </tr>							
                                <tr> 
                                  <td colspan="4" class="td"><p><b>LEAVE BALANCE AS OF <? echo $strMonthFull." ".$arrLastLB['periodYear']; ?></b></p></td>
                                </tr>
                                <tr> 
                                  <td colspan="4" class="td" height="10"></td>
                                </tr>
                                <tr> 
                                  <td colspan="4" align="center">
								  <p>
								  WP = Absent Undertime With Pay&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								  WOP = Absent Undertime Without Pay&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								  BAL = Balance
								  </p>
								  </td>
                                </tr>
                                <tr> 
                                  <td colspan="4" class="td">
								  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
                                      <tr> 
                                        <td colspan="8" bgcolor="#C6E2FE" class="subtitle">&nbsp;</td>
                                      </tr>
                                      <tr bgcolor="#80bfff"> 
									  	<td align="center" rowspan="2" valign="middle"><strong>EMPLOYEE</strong></td>
                                        <td align="center" rowspan="2" valign="middle"><strong>EARNED</strong></td>
                                        <td align="center" colspan='3'><strong>VACATION LEAVE</strong></td>
                                        <td align="center" colspan='3'><strong>SICK LEAVE</strong></td>																				
                                      </tr>
									  <tr bgcolor="#80bfff">
                                        <td align="center"><strong>WP</strong></td>
                                        <td align="center"><strong>BAL</strong></td>
                                        <td align="center"><strong>WOP</strong></td>
                                        <td align="center"><strong>WP</strong></td>
                                        <td align="center"><strong>BAL</strong></td>
                                        <td align="center"><strong>WOP</strong></td>
									  </tr>
                                      <tr> 
                                        <td colspan="8" height="10"></td>
                                      </tr>
									<?
									$objAttendance->viewAllRecentLeaveBalance(10,$p);
									?>
									<tr><td align="right" colspan="9"><? $objAttendance->output();?></td></tr>
                                    </table></td>
                                </tr>
                                <tr> 
                                  <td colspan="4" class="td"><div align="justify"></div></td>
                                </tr>
                                <tr> 
                                  <td colspan="4" class="td"></td>
                                </tr>
								<tr> 
                                  <td colspan="4" class="td"></td>
                                </tr>
								<tr><td height="30"></td></tr>								
						  <tr><td class="note" colspan="2" height="40" valign="middle"><p align="center"><i>&quot;If the employee reach the compulsory retirement age
						  of 65 but the service has been extended, the employee will NO LONGER EARN leave credits.&quot;</i></p></td></tr>

								<tr> 
                              <td colspan="4" class="warning"> WARNING: &nbsp;You 
                                are about to update the LEAVE BALANCE of all employees 
                                for the month of <? echo $strNxtMonthFull." ".$arrNxtYear['year']?>. 
                                Please check that all Leaves, OBs, Flag Ceremonies, 
                                Time-in and Time-out of every employee has been 
                                overriden correctly. Blank attendance records 
                                shall be considered Vacation Leaves. </td>
                                </tr>
								<tr><td height="20"></td></tr>
								<form method="post" action="">
								<tr>
								<td align="center">Month : <? echo $strNxtMonthFull?></td>
								</tr>
								<tr>
								<td align="center">Year : <? echo $arrNxtYear['year']?></td>
								</tr>
								<tr> 
                                 <td colspan="4" height="30" align="center" valign="middle">
								 <input type="submit" name="btnUpdateLB" value="UPDATE" onClick="trapAheadMonthUpdate();">
								 </td>
								</tr>
								<tr><td>
								    <input type="hidden" name="txtSearch" value="<? echo $txtSearch?>"> 
                                    <input type="hidden" name="optField" value="<? echo $optField?>"> 
                                    <input type="hidden" name="cboMonth" value="<? echo $cboMonth?>"> 
                                    <input type="hidden" name="cboYear" value="<? echo $cboYear?>"> 
									<input type="hidden" name="p" value="<? echo $p?>">
									<input type="hidden" name="strLetter" value="<? echo $strLetter?>">
									<input type="hidden" name="strEmpNmbr" value="<? echo $strEmpNmbr?>">
									<input type="hidden" name="intNxtMonth" value="<? echo $arrNxtYear['month']?>">
									<input type="hidden" name="intNxtYear" value="<? echo $arrNxtYear['year']?>">
								</td></tr>
								</form>	
                              </table></td>
                          </tr>
                          <tr>
                            <td height="20" valign="bottom"></td>
                          </tr>
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
