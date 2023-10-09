<?php 
/* 
File Name: Update201request.php 
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
Date of Revision: January 09, 2004
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
include("../hrmis/class/Update201request.php");
$objUpdate201request = new update201Request;

if($btnSubmit == "Add")
{
	switch($str201Rqst)
	{
		case "Education":
			$dtmFrom = $objUpdate201request->combineDate($cboSchlYearFrom, $cboSchlMonthFrom, $cboSchlDayFrom);
			$dtmTo = $objUpdate201request->combineDate($cboSchlYearTo, $cboSchlMonthTo, $cboSchlDayTo);
			$objUpdate201request->addEdctn($intRequestID, $cboLevelCode, $txtSchlName, $txtCourse, $txtUnits, $txtHonors, $dtmFrom, $dtmTo);
			$str201Rqst = '';
			break;

		case "Training":
			$dtmCnct = $objUpdate201request->combineDate($cboTrngCnctYear, $cboTrngCnctMonth, $cboTrngCnctDay);
			$dtmDateFrom = $objUpdate201request->combineDate($cboTrngYearFrm, $cboTrngMonthFrm, $cboTrngDayFrm);
			$dtmDateTo = $objUpdate201request->combineDate($cboTrngYearTo, $cboTrngMonthTo, $cboTrngDayTo);			
			$objUpdate201request->addTrng($intRequestID, $cboTraining, $dtmCnct, $txtTrngConducted, $txtTrngVenue, $dtmDateFrom, $dtmDateTo, $txtTrngHours, $txtTrngCost);

			$str201Rqst = '';
			break;

		case "Examination":
			$dtmExamDate = $objUpdate201request->combineDate($cboExamYear, $cboExamMonth, $cboExamDay);
			$dtmDateRelease = $objUpdate201request->combineDate($cboReleaseYear, $cboReleaseMonth, $cboReleaseDay);
			$objUpdate201request->addExam($intRequestID, $cboExam, $dtmExamDate, $txtExamRate, $txtExamPlace, $txtLicenseNumber, $dtmDateRelease);
			
			$str201Rqst = '';
			break;

		case "Children":
			$dtmChild = $objUpdate201request->combineDate($cboYear, $cboMonth, $cboDay);
			$objUpdate201request->addChild($intRequestID, $txtChildName, $dtmChild);

			$str201Rqst = '';
			break;

		case "Reference":

			$objUpdate201request->addReference($intRequestID, $txtRefName, $txtRefAddress, $txtRefContact);
			$str201Rqst = '';
			break;		

		case "Voluntary":
			$dtmVWDateFrom = $objUpdate201request->combineDate($cboVWDateFromYear, $cboVWDateFromMonth, $cboVWDateFromDay);
			$dtmVWDateTo = $objUpdate201request->combineDate($cboVWDateToYear, $cboVWDateToMonth, $cboVWDateToDay);
			$objUpdate201request->addVoluntaryWork($intRequestID, $txtVWName, $txtVWAddress, $dtmVWDateFrom, $dtmVWDateTo, $intVWHours, $txtVWPosition);

			$str201Rqst = '';
			break;
	
	}
	
}
elseif($btnSubmit == "Update")
{
	switch($str201Rqst)
	{
	
		case "Profile":
			$objUpdate201request->updateProfile($intRequestID, $txtSurname, $txtMiddlename, $cboCivilStatus, $txtWeight, $txtResidentialAddress, $txtZipCode1, $txtTelephone1, $txtPermanentAddress, $txtZipCode2, $txtTelephone2, $txtEmail, $txtMobile, $txtSpouse, $txtSpouseWork, $txtSpouseBusName, $txtSpouseBusAddress, $txtSpouseTelephone);
			
			$str201Rqst = '';
			break;

		case "Tax":
			$dtmTax = $objUpdate201request->combineDate($cboYear, $cboMonth, $cboDay);
			$objUpdate201request->updateTax($intRequestID, $txtTaxNo, $txtTaxPlace, $dtmTax);
			
			$str201Rqst = '';
			break;
	}
}
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
                        <td height="32" class="header"><p>update 201 REQUEST(S)</p></td>
                      </tr>
                      <tr> 
                        <td height="9"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td> 
                                <?
							  $objUpdate201request->viewUpdate201Request($strEmpNmbr); //View list of employee/s request (Update201request.php)
								
								?>
                              </td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td height="4">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="5"> <form action="<? $PHP_SELF; ?>" method="get" name="frmUpdate201request">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr> 
                                <td> </td>
                              </tr>
                              <tr> 
                                <td><hr></td>
                              </tr>
                              <tr> 
                                <td>&nbsp;</td>
                              </tr>
                              <tr> 
                                <td> </td>
                              </tr>
                              <tr> 
                                <td> 
                                  <? 
if(strlen($intRequestID) != 0)
{
	$arrRqst = $objUpdate201request->getRqstDetails($intRequestID);
}								  
if ($str201Rqst == 'Children') 
{
?>
                                  <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                                    <tr> 
                                      <td colspan="2" class="alterrow">Children</td>
                                    </tr>
                                    <tr> 
                                      <td width="61%"><table width="105%" border="0" cellspacing="0" cellpadding="0">
                                          <tr> 
                                            <td colspan="2" height="10"></td>
                                          </tr>
                                          <tr> 
                                            <td width="30%" class="paragraph">Name 
                                              of Children :</td>
                                            <td width="70%"><input name="txtChildName" type="text" size="30" maxlength="50" readonly value="<? echo $arrRqst[1];?>"></td>
                                          </tr>
                                          <tr> 
                                            <td width="30%" height="25" align="right" valign="middle" class="paragraph"> 
                                              Date of Birth :</td>
                                            <td width="70%"> 
                                              <?
											$cboMonth = date('n', strtotime($arrRqst[2]));
											$cboDay = date('j', strtotime($arrRqst[2]));
											$cboYear = date('Y', strtotime($arrRqst[2]));
										?>
                                              &nbsp; Mon 
                                              <select name="cboMonth" readonly>
                                                <?
								  	$objUpdate201request->comboMonth($cboMonth);
								  ?>
                                              </select> &nbsp;&nbsp; Day 
                                              <select name="cboDay" readonly>
                                                <?
								  	$objUpdate201request->comboDay($cboDay);
								  ?>
                                              </select> &nbsp;&nbsp;Year 
                                              <select name="cboYear" readonly>
                                                <?
								  	$objUpdate201request->comboYearChildren($cboYear);
								  ?>
                                              </select> <input name="str201Rqst" type="hidden" value="<? echo $str201Rqst;?>"> 
                                              <input name="intRequestID" type="hidden" value="<? echo $intRequestID;?>"> 
                                              <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr; ?>"> 
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td colspan="2" height="10"></td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                    <tr> 
                                      <td colspan="2"><div align="center"> 
                                          <input name="btnSubmit" type="submit" value="Add">
                                        </div></td>
                                    </tr>
                                  </table></td>
                              </tr>
                              <tr> 
                                <td> 
                                  <? 
} 
elseif ($str201Rqst == 'Reference') 
{
?>
                                </td>
                              </tr>
                              <tr> 
                                <td> </td>
                              </tr>
                              <tr> 
                                <td><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                                    <tr> 
                                      <td colspan="2" class="alterrow">Reference</td>
                                    </tr>
                                    <tr> 
                                      <td width="61%"><table width="105%" border="0" cellspacing="0" cellpadding="0">
                                          <tr> 
                                            <td colspan="2" height="10"></td>
                                          </tr>
                                          <tr> 
                                            <td width="30%" class="paragraph">Name 
                                              of Reference :</td>
                                            <td width="70%"><input name="txtRefName" type="text" size="30" maxlength="50" readonly value="<? echo $arrRqst[1];?>"></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Address :</td>
                                            <td><input name="txtRefAddress" type="text" size="30" maxlength="255" readonly value="<? echo $arrRqst[2];?>"></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Contact Number 
                                              :</td>
                                            <td><input name="txtRefContact" type="text" size="30" maxlength="15" readonly value="<? echo $arrRqst[3];?>"> 
                                              <input name="str201Rqst" type="hidden" value="<? echo $str201Rqst;?>"> 
                                              <input name="intRequestID" type="hidden" value="<? echo $intRequestID;?>"> 
                                              <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr; ?>">	
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td colspan="2" height="10"></td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                    <tr> 
                                      <td colspan="2"><div align="center"><strong> 
                                          </strong> 
                                          <input name="btnSubmit" type="submit" value="Add">
                                        </div></td>
                                    </tr>
                                  </table>
                                  <? 
} 
elseif ($str201Rqst == 'Tax') 
{
	$arrTax = $objUpdate201request->getCurrentTax($intRequestID);
?>
                                </td>
                              </tr>
                              <tr> 
                                <td><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                                    <tr class="alterrow"> 
                                      <td colspan="2">Community Tax Certificate</td>
                                    </tr>
                                    <tr> 
                                      <td width="30%"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr> 
                                            <td colspan="2" height="10"></td>
                                          </tr>
                                          <tr> 
                                            <td colspan="2" height="20" class="td">Current 
                                              Tax Number</td>
                                          </tr>
                                          <tr> 
                                            <td width="50%" class="paragraph"  height="25">Comm 
                                              Tax No. :</td>
                                            <td width="50%">&nbsp;<? echo $arrTax['comTaxNumber']?></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph"  height="25">Issued 
                                              At :</td>
                                            <td>&nbsp;<? echo $arrTax['issuedAt']?></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph"  height="25">Issued 
                                              On :</td>
                                            <td width="50%">&nbsp;<? echo $arrTax['issuedOn']?></td>
                                          </tr>
                                          <tr> 
                                            <td colspan="2" height="10"></td>
                                          </tr>
                                        </table></td>
                                      <td width="70%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr> 
                                            <td colspan="2" height="10"></td>
                                          </tr>
                                          <tr> 
                                            <td colspan="2" height="20" class="td">Replace 
                                              with this?</td>
                                          </tr>
                                          <tr> 
                                            <td width="30%" class="paragraph" height="25">Community 
                                              Tax No. :</td>
                                            <td width="70%"><input name="txtTaxNo" type="text" size="30" maxlength="50" readonly value="<? echo $arrRqst[1];?>"></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph"  height="25">Issued 
                                              At :</td>
                                            <td><input name="txtTaxPlace" type="text" size="30" maxlength="50" readonly value="<? echo $arrRqst[2];?>"></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph"  height="25">Issued 
                                              On :</td>
                                            <td width="50%"> 
                                              <?
											$cboMonth = date('n', strtotime($arrRqst[3]));
											$cboDay = date('j', strtotime($arrRqst[3]));
											$cboYear = date('Y', strtotime($arrRqst[3]));

										?>
                                              &nbsp; Mon 
                                              <select name="cboMonth" readonly>
                                                <?
								  	$objUpdate201request->comboMonth($cboMonth);
								  ?>
                                              </select> &nbsp;&nbsp; Day 
                                              <select name="cboDay" readonly>
                                                <?
								  	$objUpdate201request->comboDay($cboDay);
								  ?>
                                              </select> &nbsp;&nbsp;Year 
                                              <select name="cboYear">
                                                <?
								  	$objUpdate201request->comboYear($cboYear);
								  ?>
                                              </select> <input name="str201Rqst" type="hidden" value="<? echo $str201Rqst;?>"> 
                                              <input name="intRequestID" type="hidden" value="<? echo $intRequestID;?>"> 
                                              <input name="strEmpNmbr" type="hidden" id="strEmpNmbr3" value="<? echo $strEmpNmbr; ?>">	
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td colspan="2" height="10"></td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                    <tr> 
                                      <td colspan="2" height="35" valign="middle"><div align="center"> 
                                          <input name="btnSubmit" type="submit" value="Update">
                                        </div></td>
                                    </tr>
                                  </table>
                                  <?
}
elseif ($str201Rqst == 'Education') 
{
?>
                                </td>
                              </tr>
                              <tr> 
                                <td> </td>
                              </tr>
                              <tr> 
                                <td><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                                    <tr> 
                                      <td colspan="2" class="alterrow">Education</td>
                                    </tr>
                                    <tr> 
                                      <td width="61%"><table width="105%" border="0" cellspacing="0" cellpadding="0">
                                          <tr> 
                                            <td colspan="3" height="10"></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph" width="30%"> 
                                              Level Code :</td>
                                            <td colspan="3" width="70%"> 
                                              <?php 
											$cboLevelCode = $arrRqst[1];
										$objEdu = mysql_query ("SELECT levelCode, levelDesc FROM tblEducationalLevel");
										echo "<SELECT NAME=\"cboLevelCode\">\r";
										while($arrEdu= mysql_fetch_array($objEdu))
										{
											if ($cboLevelCode == $arrEdu["levelCode"])
											{
												print "<OPTION VALUE=\"".strtoupper($arrEdu["levelCode"])."\" selected>".strtoupper($arrEdu["levelDesc"])."\r";
											}
										  	print "<OPTION VALUE=\"".strtoupper($arrEdu["levelCode"])."\">".strtoupper($arrEdu["levelDesc"])."\r";
										} 
										echo "</SELECT>\r";
										?>
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">School Name 
                                              :</td>
                                            <td colspan="3"> <input name="txtSchlName" type="text" size="60" maxlength="80" readonly value="<? echo $arrRqst[2];?>"> 
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Course :</td>
                                            <td colspan="3"> <input name="txtCourse" type="text" size="50" maxlength="50" readonly value="<? echo $arrRqst[3];?>"> 
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Units Earned 
                                              :</td>
                                            <td colspan="3"> <input name="txtUnits" type="text" size="20" maxlength="10" readonly value="<? echo $arrRqst[4];?>"> 
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Honors :</td>
                                            <td colspan="3"> <input name="txtHonors" type="text" size="60" maxlength="80" readonly value="<? echo $arrRqst[5];?>"> 
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Date From :</td>
                                            <td> 
                                              <?
											$cboSchlMonthFrom = date('n', strtotime($arrRqst[6]));
											$cboSchlDayFrom = date('j', strtotime($arrRqst[6]));
											$cboSchlYearFrom = date('Y', strtotime($arrRqst[6]));

											$cboSchlMonthTo = date('n', strtotime($arrRqst[7]));
											$cboSchlDayTo = date('j', strtotime($arrRqst[7]));
											$cboSchlYearTo = date('Y', strtotime($arrRqst[7]));
										  ?>
                                              <select name="cboSchlMonthFrom" size="1" readonly>
                                                <?
											$objUpdate201request->comboMonth($cboSchlMonthFrom);
											?>
                                              </select> <select name="cboSchlDayFrom" size="1" readonly>
                                                <?
											$objUpdate201request->comboDay($cboSchlDayFrom);
											?>
                                              </select> <select name="cboSchlYearFrom" size="1" readonly>
                                                <?
											$objUpdate201request->comboYearOld($cboSchlYearFrom);
									   		?>
                                              </select> </td>
                                            <td class="paragraph">Date To :</td>
                                            <td> <select name="cboSchlMonthTo" size="1" readonly>
                                                <?
											$objUpdate201request->comboMonth($cboSchlMonthTo);
											?>
                                              </select> <select name="cboSchlDayTo" size="1" readonly>
                                                <?
											$objUpdate201request->comboDay($cboSchlDayTo);
											?>
                                              </select> <select name="cboSchlYearTo" size="1" readonly>
                                                <?
											$objUpdate201request->comboYearOld($cboSchlYearTo);
									   		?>
                                              </select> <input name="str201Rqst" type="hidden" value="<? echo $str201Rqst;?>"> 
                                              <input name="intRequestID" type="hidden" value="<? echo $intRequestID;?>"> 
                                              <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>">	
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td colspan="3" height="10"></td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                    <tr> 
                                      <td colspan="2"><div align="center"><strong> 
                                          </strong> 
                                          <input name="btnSubmit" type="submit" value="Add">
                                        </div></td>
                                    </tr>
                                  </table>
                                  <?
}
elseif ($str201Rqst == 'Training') 
{
?>
                                </td>
                              </tr>
                              <tr> 
                                <td> </td>
                              </tr>
                              <tr> 
                                <td><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                                    <tr> 
                                      <td colspan="2" class="alterrow">Training</td>
                                    </tr>
                                    <tr> 
                                      <td width="61%"><table width="105%" border="0" cellspacing="0" cellpadding="0">
                                          <tr> 
                                            <td colspan="2" height="10"></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Training Title 
                                              :</td>
                                            <td> 
                                              <?php 
											$cboTraining = $arrRqst[1];
										$objTrng = mysql_query ("SELECT trainingCode, trainingTitle FROM tblTraining");
										echo "<SELECT NAME=\"cboTraining\">\r";
										while($arrTrng = mysql_fetch_array($objTrng))
										{
											if ($cboTraining == $arrTrng["trainingCode"])
											{
												print "<OPTION VALUE=\"".strtoupper($arrTrng["trainingCode"])."\" selected>".strtoupper($arrTrng["trainingTitle"])."\r";
											}
										  	print "<OPTION VALUE=\"".strtoupper($arrTrng["trainingCode"])."\">".strtoupper($arrTrng["trainingTitle"])."\r";
										}
										echo "</SELECT>\r";
										?>
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Number of Hours 
                                              :</td>
                                            <td><input name="txtTrngHours" type="text" size="10" maxlength="4" readonly value="<? echo $arrRqst[2];?>"> 
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Venue :</td>
                                            <td><input name="txtTrngVenue" type="text" size="50" maxlength="50" readonly value="<? echo $arrRqst[3];?>"></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Conducted By 
                                              :</td>
                                            <td><input name="txtTrngConducted" type="text" size="50" maxlength="50" readonly value="<? echo $arrRqst[4];?>"></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Cost :</td>
                                            <td><input name="txtTrngCost" type="text" size="15" maxlength="10" readonly value="<? echo $arrRqst[5];?>"></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Contract Dates 
                                              :</td>
                                            <td> 
                                              <?
											$cboTrngCnctMonth = date('n', strtotime($arrRqst[6]));
											$cboTrngCnctDay = date('j', strtotime($arrRqst[6]));
											$cboTrngCnctYear = date('Y', strtotime($arrRqst[6]));

											$cboTrngMonthFrm = date('n', strtotime($arrRqst[7]));
											$cboTrngDayFrm = date('j', strtotime($arrRqst[7]));
											$cboTrngYearFrm = date('Y', strtotime($arrRqst[7]));

											$cboTrngMonthTo = date('n', strtotime($arrRqst[8]));
											$cboTrngDayTo = date('j', strtotime($arrRqst[8]));
											$cboTrngYearTo = date('Y', strtotime($arrRqst[8]));
											
											$cboTrngHrFrm = date('h', strtotime($arrRqst[9]));
											$cboTrngMinFrm = date('i', strtotime($arrRqst[9]));
											$cboTrngSecFrm = date('s', strtotime($arrRqst[9]));
											$cboTrngAMPMFrm = date('A', strtotime($arrRqst[9]));

											$cboTrngHrTo = date('h', strtotime($arrRqst[10]));
											$cboTrngMinTo = date('i', strtotime($arrRqst[10]));
											$cboTrngSecTo = date('s', strtotime($arrRqst[10]));
											$cboTrngAMPMTo = date('A', strtotime($arrRqst[10]));																						
										  ?>
                                              <select name="cboTrngCnctMonth" size="1" readonly>
                                                <?
										$objUpdate201request->comboMonth($cboTrngCnctMonth);
										?>
                                              </select> <select name="cboTrngCnctDay" size="1" readonly>
                                                <?
										$objUpdate201request->comboDay($cboTrngCnctDay);
										?>
                                              </select> <select name="cboTrngCnctYear" size="1" readonly>
                                                <?
										$objUpdate201request->comboYearOld($cboTrngCnctYear);
									   ?>
                                              </select></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Start Date :</td>
                                            <td><select name="cboTrngMonthFrm" size="1" readonly>
                                                <?
										$objUpdate201request->comboMonth($cboTrngMonthFrm);
										?>
                                              </select> <select name="cboTrngDayFrm" size="1" readonly>
                                                <?
										$objUpdate201request->comboDay($cboTrngDayFrm);
										?>
                                              </select> <select name="cboTrngYearFrm" size="1" readonly>
                                                <?
										$objUpdate201request->comboYearOld($cboTrngYearFrm);
									   ?>
                                              </select></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">End Date :</td>
                                            <td><select name="cboTrngMonthTo" size="1" readonly>
                                                <?
										$objUpdate201request->comboMonth($cboTrngMonthTo);
										?>
                                              </select> <select name="cboTrngDayTo" size="1" readonly>
                                                <?
										$objUpdate201request->comboDay($cboTrngDayTo);
										?>
                                              </select> <select name="cboTrngYearTo" size="1" readonly>
                                                <?
										$objUpdate201request->comboYearOld($cboTrngYearTo);
									   ?>
                                              </select> <input name="str201Rqst" type="hidden" id="str201Rqst" value="<? echo $str201Rqst;?>"> 
                                              <input name="intRequestID" type="hidden" value="<? echo $intRequestID;?>"> 
                                              <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>"></td>
                                          </tr>
                                          <tr> 
                                            <td colspan="2">&nbsp;</td>
                                          </tr>
                                          <tr> 
                                          <tr> 
                                            <td colspan="2" height="10"></td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                    <tr> 
                                      <td colspan="2"><div align="center"><strong> 
                                          </strong> 
                                          <input name="btnSubmit" type="submit" value="Add">
                                        </div></td>
                                    </tr>
                                  </table>
                                  <?
}
elseif ($str201Rqst == 'Examination') 
{
?>
                                </td>
                              </tr>
                              <tr> 
                                <td> </td>
                              </tr>
                              <tr> 
                                <td><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                                    <tr> 
                                      <td colspan="2" class="alterrow">Examination</td>
                                    </tr>
                                    <tr> 
                                      <td width="61%"><table width="105%" border="0" cellspacing="0" cellpadding="0">
                                          <tr> 
                                            <td colspan="2" height="10"></td>
                                          </tr>
                                          <tr> 
                                            <td width="30%" height="19" class="paragraph"> 
                                              Exam Code : </td>
                                            <td colspan="2" width="70%"> 
                                              <?php 
									  	$cboExam = $arrRqst[1];
										$objExam = mysql_query ("SELECT examCode FROM tblExamType");
										echo "<SELECT NAME=\"cboExam\">\r";
										while($arrExam = mysql_fetch_array($objExam)) 
										{
											if ($cboExam == $arrExam["examCode"])
											{
												print "<OPTION VALUE=\"".strtoupper($arrExam["examCode"])."\" selected>".strtoupper($arrExam["examCode"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($arrExam["examCode"])."\">".strtoupper($arrExam["examCode"])."\r";
										} 
										echo "</SELECT>\r";
										?>
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Place of Examination 
                                              :</td>
                                            <td colspan="2"> <input name="txtExamPlace" type="text" readonly value="<? echo $arrRqst[2];?>" size="25" maxlength="50"></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Rating :</td>
                                            <td width="124"><input name="txtExamRate" type="text" readonly value="<? echo $arrRqst[3];?>" size="20" maxlength="15"> 
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Date of Examination 
                                              :</td>
                                            <td> 
                                              <?
											$cboExamMonth = date('n', strtotime($arrRqst[4]));
											$cboExamDay = date('j', strtotime($arrRqst[4]));
											$cboExamYear = date('Y', strtotime($arrRqst[4]));
?>
                                              <select name="cboExamYear" size="1" readonly >
                                                <?
										$objUpdate201request->comboYearOld($cboExamYear);
									   ?>
                                              </select> 
                                              <select name="cboExamMonth" size="1" readonly >
                                                <?
										$objUpdate201request->comboMonth($cboExamMonth);
										?>
                                              </select> <select name="cboExamDay" size="1" readonly >
                                                <?
										$objUpdate201request->comboDay($cboExamDay);
										?>
                                              </select>
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">License Number 
                                              : </td>
                                            <td><input name="txtLicenseNumber" type="text" readonly value="<? echo $arrRqst[5];?>" size="25" maxlength="50"></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Date Release 
                                              : </td>
                                            <td> 
                                              <?
											$cboReleaseMonth = date('n', strtotime($arrRqst[6]));
											$cboReleaseDay = date('j', strtotime($arrRqst[6]));
											$cboReleaseYear = date('Y', strtotime($arrRqst[6]));
?>
                                              <select name="cboReleaseYear" size="1" readonly>
                                                <?
										$objUpdate201request->comboYearOld($cboReleaseYear);
									   ?>
                                              </select>
                                              <select name="cboReleaseMonth" size="1" readonly>
                                                <?
										$objUpdate201request->comboMonth($cboReleaseMonth);
										?>
                                              </select> <select name="cboReleaseDay" size="1" readonly>
                                                <?
										$objUpdate201request->comboDay($cboReleaseDay);
										?>
                                              </select>
                                              <input name="str201Rqst" type="hidden" value="<? echo $str201Rqst;?>" readonly> 
                                              <input name="intRequestID" type="hidden" value="<? echo $intRequestID;?>" readonly> 
                                              <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>"></td>
                                          </tr>
                                          <tr> 
                                            <td colspan="2" height="10"></td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                    <tr> 
                                      <td height="23" colspan="2"><div align="center"><strong> 
                                          </strong> 
                                          <input name="btnSubmit" type="submit" value="Add">
                                        </div></td>
                                    </tr>
                                  </table>
                                  <?
}
elseif ($str201Rqst == 'Voluntary') 
{
?>
                                </td>
                              </tr>
                              <tr>
                                <td><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                                    <tr> 
                                      <td colspan="2" class="alterrow">Voluntary 
                                        Works </td>
                                    </tr>
                                    <tr> 
                                      <td width="61%"><table width="105%" border="0" cellspacing="0" cellpadding="0">
                                          <tr> 
                                            <td colspan="2" height="10"></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Name of Organization 
                                              :</td>
                                            <td> <input name="txtVWName" type="text" value="<? echo $arrRqst[1];?>" size="50" maxlength="50" readonly="readonly">
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Address :</td>
                                            <td><textarea name="txtVWAddress" readonly="readonly" id="txtVWAddress"><? echo $arrRqst[2];?></textarea>
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Inclusive Date 
                                              From :</td>
                                            <td>
                                              <?
											$cboVWDateFromMonth = date('n', strtotime($arrRqst[3]));
											$cboVWDateFromDay = date('j', strtotime($arrRqst[3]));
											$cboVWDateFromYear = date('Y', strtotime($arrRqst[3]));
?>
                                              <select name="cboVWDateFromYear" size="1">
                                                <?
											$objUpdate201request->comboYearOld($cboVWDateFromYear);
									   		?>
                                              </select> <select name="cboVWDateFromMonth" size="1">
                                                <?
											$objUpdate201request->comboMonth($cboVWDateFromMonth);
											?>
                                              </select> <select name="cboVWDateFromDay" size="1">
                                                <?
											$objUpdate201request->comboDay($cboVWDateFromDay);
											?>
                                              </select></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Inclusive Date 
                                              To :</td>
                                            <td>
                                              <?
											$cboVWDateToMonth = date('n', strtotime($arrRqst[4]));
											$cboVWDateToDay = date('j', strtotime($arrRqst[4]));
											$cboVWDateToYear = date('Y', strtotime($arrRqst[4]));
?>
                                              <select name="cboVWDateToYear" size="1">
                                                <?
											$objUpdate201request->comboYearOld($cboVWDateToYear);
										   	?>
                                              </select> <select name="cboVWDateToMonth" size="1" accesskey>
                                                <?
											$objUpdate201request->comboMonth($cboVWDateToMonth);
											?>
                                              </select> <select name="cboVWDateToDay" size="1">
                                                <?
											$objUpdate201request->comboDay($cboVWDateToDay);
											?>
                                              </select></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Number of Hours 
                                              : </td>
                                            <td><input name="intVWHours" type="text" value="<? echo $arrRqst[5];?>" size="20" maxlength="6" readonly="readonly"></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Position / Nature 
                                              of Work : </td>
                                            <td> <input name="txtVWPosition" type="text" value="<? echo $arrRqst[6];?>" size="30" maxlength="50" readonly="readonly">
                                              <input name="str201Rqst" type="hidden" value="<? echo $str201Rqst;?>">
                                              <input name="intRequestID" type="hidden" value="<? echo $intRequestID;?>">
                                              <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>"></td>
                                          </tr>
                                          <tr> 
                                            <td colspan="2">&nbsp;</td>
                                          </tr>
                                          <tr> 
                                          <tr> 
                                            <td colspan="2" height="10"></td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                    <tr> 
                                      <td colspan="2"><div align="center"><strong> 
                                          </strong> 
                                          <input name="btnSubmit" type="submit" value="Add">
                                        </div></td>
                                    </tr>
                                  </table></td>
                              </tr>
                              <tr> 
                                <td>&nbsp;</td>
                              </tr>
                              <tr> 
                                <td> 
                                  <?
}
elseif ($str201Rqst == 'Profile') 
{
	$arrPrfl = $objUpdate201request->getCurrentProfile($intRequestID);
?>
                                </td>
                              </tr>
                              <tr> 
                                <td> </td>
                              </tr>
                              <tr> 
                                <td><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                                    <tr class="alterrow"> 
                                      <td colspan="2">Profile</td>
                                    </tr>
                                    <tr> 
                                      <td width="43%"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="6">
                                          <tr> 
                                            <td colspan="2" height="20" class="td">Current 
                                              Profile</td>
                                          </tr>
                                          <tr> 
                                            <td width="39%" height="18" class="paragraph"> 
                                              Surname : </td>
                                            <td width="61%">&nbsp;<? echo $arrPrfl['surname']?></td>
                                          </tr>
                                          <tr> 
                                            <td height="9" class="paragraph">Middle 
                                              Name : </td>
                                            <td>&nbsp;<? echo $arrPrfl['middlename']?></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Civil Status 
                                              :</td>
                                            <td>&nbsp;<? echo $arrPrfl['civilStatus']?></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Weight : </td>
                                            <td>&nbsp;<? echo $arrPrfl['weight']?></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Residential 
                                              : </td>
                                            <td><? echo $arrPrfl['residentialAddress']?></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Zip Code :</td>
                                            <td><? echo $arrPrfl['zipCode1']?></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Telephone :</td>
                                            <td><? echo $arrPrfl['telephone1']?></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Permanent :</td>
                                            <td><? echo $arrPrfl['permanentAddress']?></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Zip Code :</td>
                                            <td><? echo $arrPrfl['zipCode2']?></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Telephone :</td>
                                            <td><? echo $arrPrfl['telephone2']?></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Email Address 
                                              : </td>
                                            <td><? echo $arrPrfl['email']?></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Mobile Number 
                                              : </td>
                                            <td><? echo $arrPrfl['mobile']?></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Spouse Name 
                                              : </td>
                                            <td>&nbsp;<? echo $arrPrfl['spouse']?></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Occupation :</td>
                                            <td>&nbsp;<? echo $arrPrfl['spouseWork']?></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Employer :</td>
                                            <td><? echo $arrPrfl['spouseBusName']?></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Address : </td>
                                            <td><? echo $arrPrfl['spouseBusAddress']?></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Telephone :</td>
                                            <td><? echo $arrPrfl['spouseTelephone']?></td>
                                          </tr>
                                        </table></td>
                                      <td width="57%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr> 
                                            <td colspan="2" height="10"></td>
                                          </tr>
                                          <tr> 
                                            <td colspan="2" height="20" class="td">Replace 
                                              with this profile?</td>
                                          </tr>
                                          <tr> 
                                            <td width="32%" height="19" class="paragraph"> 
                                              Surname : </td>
                                            <td width="68%"><input name="txtSurname" type="text" size="30" maxlength="50" readonly value="<? echo $arrRqst[1];?>"></td>
                                          </tr>
                                          <tr> 
                                            <td height="9" class="paragraph">Middle 
                                              Name : </td>
                                            <td><input name="txtMiddlename" type="text" size="30" maxlength="50" readonly value="<? echo $arrRqst[2];?>"></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Civil Status 
                                              :</td>
                                            <td> 
                                              <? 
														$t_strCivilStatus = $arrRqst[3];
														$objUpdate201request->civilStatus("cboCivilStatus", $t_strCivilStatus);
														?>
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Weight : </td>
                                            <td><input name="txtWeight" type="text" size="5" maxlength="5" readonly value="<? echo $arrRqst[4];?>"></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Residential 
                                              : </td>
                                            <td><textarea name="txtResidentialAddress" cols="25" readonly="readonly"><? echo $arrRqst[5];?></textarea></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Zip Code :</td>
                                            <td><input name="txtZipCode1" type="text" value="<? echo $arrRqst[6];?>" size="5" maxlength="4" readonly></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Telephone :</td>
                                            <td><input name="txtTelephone1" type="text" value="<? echo $arrRqst[7];?>" size="15" maxlength="15" readonly></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Permanent :</td>
                                            <td><textarea name="txtPermanentAddress" cols="25" readonly="readonly"><? echo $arrRqst[8];?></textarea></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Zip Code :</td>
                                            <td><input name="txtZipCode2" type="text" value="<? echo $arrRqst[9];?>" size="5" maxlength="4" readonly></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Telephone :</td>
                                            <td><input name="txtTelephone2" type="text" value="<? echo $arrRqst[10];?>" size="15" maxlength="15" readonly></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Email Address 
                                              : </td>
                                            <td><input name="txtEmail" type="text" size="25" maxlength="50" readonly value="<? echo $arrRqst[11];?>"></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Mobile Number 
                                              : </td>
                                            <td><input name="txtMobile" type="text" size="15" maxlength="15" readonly value="<? echo $arrRqst[12];?>"> 
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Spouse Name 
                                              : </td>
                                            <td><input name="txtSpouse" type="text" size="30" maxlength="80" readonly value="<? echo $arrRqst[13];?>"></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Occupation :</td>
                                            <td><input name="txtSpouseWork" type="text" size="30" maxlength="50" readonly value="<? echo $arrRqst[14];?>"></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Employer/Business 
                                              :</td>
                                            <td> 
                                              <textarea name="txtSpouseBusName" cols="25" readonly="readonly" id="txtSpouseBusName"><? echo $arrRqst[15];?></textarea></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Business Address 
                                              : </td>
                                            <td><textarea name="txtSpouseBusAddress" cols="25" readonly="readonly"><? echo $arrRqst[16];?></textarea></td>
                                          </tr>
                                          <tr> 
                                            <td class="paragraph">Telephone :</td>
                                            <td> <input name="txtSpouseTelephone" type="text" value="<? echo $arrRqst[17];?>" size="15" maxlength="15" readonly> 
                                              <input name="str201Rqst" type="hidden" id="str201Rqst" value="<? echo $str201Rqst;?>" readonly> 
                                              <input name="intRequestID" type="hidden" id="intRequestID" value="<? echo $intRequestID;?>" readonly> 
                                              <input name="strEmpNmbr" type="hidden" id="strEmpNmbr7" value="<? echo $strEmpNmbr; ?>"></td>
                                          </tr>
                                          <tr> 
                                            <td colspan="2" height="10"></td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                    <tr> 
                                      <td colspan="2"><div align="center"><strong> 
                                          </strong> 
                                          <input name="btnSubmit" type="submit" value="Update">
                                        </div></td>
                                    </tr>
                                  </table>
                                  <?
}
?>
                                </td>
                              </tr>
                              <tr> 
                                <td> </td>
                              </tr>
                              <tr> 
                                <td> </td>
                              </tr>
                            </table>
                          </form></td>
                      </tr>
                    </table>
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