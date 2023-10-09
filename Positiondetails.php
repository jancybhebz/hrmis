<?php 
/* 
File Name: Positiondetails.php
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
Date of Revision: November 18, 2003
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
include("../hrmis/class/Positiondetails.php");
$objPosition= new position;
$objPosition->trapButton($txtSearch, $strLetter, "Searchemployee.php", "Profile.php");
$objPosition->setvar(array('txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>$cboMonth, 'cboYear'=>$cboYear)); //for maintain state
$arrEmpPersonal = $objPosition->checkGetEmpNmbr("201", $txtSearch, $optField, $cboMonth, $cboYear, 1, $p);
$objPosition->editPosition($txtSearch, $optField, $p, $arrEmpPersonal["empNumber"], $t_strAppointmentCode, $t_strServiceCode, $t_strSectionCode, $t_strPositionCode, $t_strDivisionCode, $t_strTaxStatCode, $t_strItemNumber, $t_strFirstDayAgency, $t_intStep, $t_strFirstDayGov, $t_strPersonnelAction, $t_strEmploymentBasis, $t_strCategoryService, $t_strNatureOfWork, $t_strHPFactor, $t_strPayrollSwitch, $t_strDTRSwitch, $t_intDependents, $t_strHealthProvider, $t_strEffectiveMonth, $t_strEffectiveDay, $t_strEffectiveYear, $t_strPositionMonth, $t_strPositionDay, $t_strPositionYear, $t_strLongevityMonth, $t_strLongevityDay, $t_strLongevityYear, $t_intActualSalary, $t_strContractEndMonth, $t_strContractEndDay, $t_strContractEndYear, $Submit, $t_strOldEmpNumber, $t_strOldAppointmentCode, $t_strOldServiceCode, $t_strOldSectionCode, $t_strOldPositionCode, $t_strOldDivisionCode, $t_strOldTaxStatus, $t_strOldItemNumber, $t_intOldStep, $t_strOldPersonnelAction, $t_strOldEffectiveMonth, $t_strOldEffectiveDay, $t_strOldEffectiveYear, $t_strOldPositionMonth, $t_strOldPositionDay, $t_strOldPositionYear, $t_strOldLongevityMonth, $t_strOldLongevityDay, $t_strOldLongevityYear, $t_intOldActualSalary, $t_strOldContractEndMonth, $t_strOldContractEndDay, $t_strOldContractEndYear);   //Load editEmployees position
?>
<html><!-- InstanceBegin template="/Templates/201tmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/class/JSgeneral.php");
?>
<script language="JavaScript">
function openPrint()
{
	var strMonth = "<? echo $cboMonth ?>";
	var strYear = "<? echo $cboYear ?>";
	var strEmpNmbr = "<? echo $arrEmpPersonal['empNumber']?>";
	var strPage = "PrintPosition.php?strEmpNmbr="+strEmpNmbr+"&strMonth="+strMonth+"&strYear="+strYear;
	window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=630,height=500');
}

</script>

<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!--
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

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/notificationover.jpg','images/attendanceover.jpg','images/reportsover.jpg','images/librariesover.jpg','images/compensationover.jpg','images/201click.jpg','images/education2.jpg','images/trainings2.jpg','images/examinations2.jpg','images/position2.jpg','images/reference2.jpg','images/logout2.jpg','images/family-background2.jpg','images/work-experience2.jpg','images/voluntary-work2.jpg','images/other%20information2.jpg','images/personal-information2.jpg'); history.forward()" onContextMenu="return false"><div align="center"> 
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr> 
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="INNERTBL">
        <tr> 
          <td width="40%" height="43" valign="baseline"><img src="images/hrmodule.jpg" width="170" height="23"></td>
          <td width="60%" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="19"><table border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <a href="Notification.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Notification','','images/notificationover.jpg',1)"><img src="images/notification.jpg" alt="Notification" name="Notification" width="96" height="29" border="0"></a><a href="Addemployee.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Profile','','images/201click.jpg',1)"><img src="images/201click.jpg" alt="Personnel Profile" name="Profile" width="67" height="29" border="0"></a><a href="Searchattendance.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Attendance','','images/attendanceover.jpg',1)"><img src="images/attendance.jpg" alt="Attendance" name="Attendance" width="88" height="29" border="0"></a><a href="Report.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Reports','','images/reportsover.jpg',1)"><img src="images/reports.jpg" alt="Reports" name="Reports" width="60" height="29" border="0"></a><a href="Holiday.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Libraries','','images/librariesover.jpg',1)"><img src="images/libraries.jpg" alt="Libraries" name="Libraries" width="67" height="29" border="0"></a><a href="Personnelinfo.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Compensation','','images/compensationover.jpg',1)"><img src="images/compensation.jpg" alt="Compensation" name="Compensation" width="104" height="29" border="0"></a></td>
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
                                  <td height="339" valign="top"> <form name="frm201" method="get" action="Profile.php">
                                      <input name="txtSearch" type="text" size="15" maxlength="30" value="<? echo $txtSearch;?>">
                                      <a href="Profile.php" onMouseOut="" onMouseOver="">
                                      <input type="image" src="images/go.jpg" alt="Go" name="Go" width="19" height="17" border="0" align="absmiddle">
                                      </a> <br>
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
                                      &nbsp; <br>
                                    </form>
                                    <table width="108" height="187" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td><a href="Profile.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('profile','','images/personal-information2.jpg',1)"><img src="images/personal-information.jpg" alt="profile" name="profile" width="108" height="27" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Familybackground.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('familybackground','','images/family-background2.jpg',1)"><img src="images/family-background.jpg" alt="familybackground" name="familybackground" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Education.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Education','','images/education2.jpg',1)"><img src="images/education1.jpg" alt="Education" name="Education" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Examinations.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('examinations','','images/examinations2.jpg',1)"><img src="images/examinations1.jpg" alt="examinations" name="examinations" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Workexperience.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('workexperience','','images/work-experience2.jpg',1)"><img src="images/work-experience.jpg" alt="workexperience" name="workexperience" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Voluntarywork.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('voluntarywork','','images/voluntary-work2.jpg',1)"><img src="images/voluntary-work.jpg" alt="voluntarywork" name="voluntarywork" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Trainings.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Trainings','','images/trainings2.jpg',1)"><img src="images/trainings1.jpg" alt="Trainings" name="Trainings" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Otherinformation.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('otherinformation','','images/other%20information2.jpg',1)"><img src="images/other-information.jpg" alt="otherinformation" name="otherinformation" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="Positiondetails.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('PositionDetails','','images/position2.jpg',1)"><img src="images/position1.jpg" alt="Position Details" name="PositionDetails" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Reference.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Reference','','images/reference2.jpg',1)"><img src="images/reference.jpg" alt="Reference" name="Reference" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="index.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('logout','','images/logout2.jpg',1)"><img src="images/logout.jpg" alt="logout" name="logout" width="108" height="20" border="0"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
                <td width="84%" valign="top"><table width="99%" height="339" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODYTBL">
                    <tr> 
                      <td height="339"><!-- InstanceBeginEditable name="BODY" -->
                        <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td><p class="header">POSITION DETAILS</p>
                              <form method=post action="<? $PHP_SELF; ?>" name="frmPosition">
                                <? 
							  $objPosition->viewPosition($txtSearch, $optField, $p, $t_strAppointmentCode, $t_strServiceCode, $t_strSectionCode, $t_strPositionCode, $t_strDivisionCode, $t_strTaxStatCode, $t_strItemNumber, $t_strFirstDayAgency, $t_intStep, $t_strFirstDayGov, $t_strPersonnelAction, $t_strEmploymentBasis, $t_strCategoryService, $t_strNatureOfWork, $t_strHPFactor, $t_strPayrollSwitch, $t_strDTRSwitch, $t_intDependents, $t_strHealthProvider, $t_strEffectiveDate, $t_strPositionDate, $t_strLongevityDate, $t_intActualSalary, $t_strContractEndDate, $arrEmpPersonal["empNumber"]);   //Add employee position details
							  ?>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td><div align="right">
                                        <? $objPosition->output(); ?>
                                      </div></td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                  </tr>
                                </table>
                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="OUTERTBLSUBMIT">
                                  <tr> 
                                    <td> 
									
                                      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="INNERTBLSUBMIT">
                                       	<? 
										if ($Submit == 'EDIT')
										{
										?>
									 <tr> 
                                          <td width="28%" class="paragraph"> <input name="t_strOldEmpNumber" type="hidden" value="<? echo $t_strEmpNumber; ?> ">
                                            Appointment Code :</td>
                                          <td width="29%"> 
                                            <?php 
										$result = mysql_query ("SELECT * FROM tblAppointment");
										echo "<SELECT NAME=\"t_strAppointmentCode\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strAppointmentCode == $row["appointmentCode"])
											{
												print "<OPTION VALUE=\"".($row["appointmentCode"])."\" selected>".($row["appointmentDesc"])."\r";
											}
										  print "<OPTION VALUE=\"".($row["appointmentCode"])."\">".($row["appointmentDesc"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                            <input name="t_strOldAppointmentCode" type="hidden" value="<? echo $t_strAppointmentCode; ?>"> 
                                          </td>
                                          <td width="20%" class="paragraph"> Service 
                                            Code : </td>
                                          <td width="23%"> 
                                        <?php 
										$result = mysql_query("SELECT * FROM tblServiceCode ");	
										echo "<SELECT NAME=\"t_strServiceCode\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strServiceCode == $row["serviceCode"])
											{
												print "<OPTION VALUE=\"".($row["serviceCode"])."\" selected>".($row["serviceCode"])."\r";
											}
										  print "<OPTION VALUE=\"".($row["serviceCode"])."\">".($row["serviceCode"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                            <input name="t_strOldServiceCode" type="hidden" value="<? echo $t_strServiceCode; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Section Code :</td>
                                          <td>
                                            <?php 
										$result = mysql_query ("SELECT sectionCode FROM tblSection");
										echo "<SELECT NAME=\"t_strSectionCode\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strSectionCode == $row["sectionCode"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["sectionCode"])."\" selected>".strtoupper($row["sectionCode"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["sectionCode"])."\">".strtoupper($row["sectionCode"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                            <input name="t_strOldSectionCode" type="hidden" value="<? echo $t_strSectionCode; ?>"> 
                                          </td>
                                          <td class="paragraph">Position Code 
                                            :</td>
                                          <td>
                                            <?php 
										$result = mysql_query ("SELECT * FROM tblPosition");
										echo "<SELECT NAME=\"t_strPositionCode\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strPositionCode == $row["positionCode"])
											{
												print "<OPTION VALUE=\"".($row["positionCode"])."\" selected>".($row["positionDesc"])."\r";
											}
										  print "<OPTION VALUE=\"".($row["positionCode"])."\">".($row["positionDesc"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                            <input name="t_strOldPositionCode" type="hidden" value="<? echo $t_strPositionCode; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Division Code 
                                            : </td>
                                          <td>
                                            <?php 
										$result = mysql_query ("SELECT * FROM tblDivision");
										echo "<SELECT NAME=\"t_strDivisionCode\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strDivisionCode == $row["divisionCode"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["divisionCode"])."\" selected>".strtoupper($row["divisionCode"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["divisionCode"])."\">".strtoupper($row["divisionCode"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                            <input name="t_strOldDivisionCode" type="hidden" value="<? echo $t_strDivisionCode; ?>"> 
                                          </td>
                                          <td class="paragraph">Tax Status :</td>
                                          <td> 
                                            <?php 
											$result = mysql_query ("SELECT taxStatus FROM tblTaxExempt");
											echo "<SELECT NAME=\"t_strTaxStatCode\">\r";
											if ($row = mysql_fetch_array($result)) {
											do {
												if ($t_strTaxStatCode == $row["taxStatus"])
												{
													print "<OPTION VALUE=\"".($row["taxStatus"])."\" selected>".($row["taxStatus"])."\r";
												}
											  print "<OPTION VALUE=\"".($row["taxStatus"])."\">".($row["taxStatus"])."\r";
											} while($row = mysql_fetch_array($result));
											} else {print "no results!";}
											echo "</SELECT>\r";
											?>
                                            <input name="t_strOldTaxStatCode" type="hidden" value="<? echo $t_strTaxStatCode; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Item Number :</td>
                                          <td> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblPlantilla");
											echo "<SELECT NAME=\"t_strItemNumber\">\r";
											echo "<option></option>";
											if ($row = mysql_fetch_array($result)) {
											do {
												if ($t_strItemNumber == $row["itemNumber"])
												{
													print "<OPTION VALUE=\"".strtoupper($row["itemNumber"])."\" >".strtoupper($row["itemNumber"])."\r";
												}
											  print "<OPTION VALUE=\"".strtoupper($row["itemNumber"])."\">".strtoupper($row["itemNumber"])."\r";
											} while($row = mysql_fetch_array($result));
											} else {print "no results!";}
											echo "</SELECT>\r";
											?>
                                            <input name="t_strOldItemNumber" type="hidden" value="<? echo $t_strItemNumber; ?>"> 
                                          </td>
                                          <td class="paragraph">First Day Agency 
                                            : </td>
                                          <td> 
                                            <?
									 if($t_strFirstDayAgency == "Y" || $t_strFirstDayAgency == "")
									  {
									  	echo "<input name='t_strFirstDayAgency' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strFirstDayAgency' type='radio' value='Y'>";
									  }
									  ?>
                                            Yes 
                                            <?
									 if($t_strFirstDayAgency == "N")
									  {
									  	echo "<input name='t_strFirstDayAgency' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strFirstDayAgency' type='radio' value='N'>";
									  } 
									  ?>
                                            No 
                                            <input name="t_strOldFirstDayAgency" type="hidden" value="<? echo $t_strFirstDayAgency; ?>">
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Step Number :</td>
                                          <td>
                                            <?php 
										$result = mysql_query ("SELECT stepNumber FROM tblSalarySched");
										echo "<SELECT NAME=\"t_intStep\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_intStep == $row["stepNumber"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["stepNumber"])."\" selected>".strtoupper($row["stepNumber"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["stepNumber"])."\">".strtoupper($row["stepNumber"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                            <input name="t_intOldStep" type="hidden" value="<? echo $t_intStep; ?>"> 
                                          </td>
                                          <td class="paragraph">First Day Gov't 
                                            :</td>
                                          <td> 
                                            <?
											 if($t_strFirstDayGov == "Y" || $t_strFirstDayGov == "")
											  {
												echo "<input name='t_strFirstDayGov' type='radio' value='Y' checked>";
											  }
											  else
											  {
												echo "<input name='t_strFirstDayGov' type='radio' value='Y'>";
											  }
											  ?>
                                            Yes 
                                            <?
											 if($t_strFirstDayGov == "N")
											  {
												echo "<input name='t_strFirstDayGov' type='radio' value='N' checked>";
											  }
											  else
											  {
												echo "<input name='t_strFirstDayGov' type='radio' value='N'>";
											  } 
											  ?>
                                            No 
                                            <input name="t_strOldFirstDayGov" type="hidden" value="<? echo $t_strFirstDayGov; ?>">
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Personnel Action 
                                            :</td>
                                          <td> <input name="t_strPersonnelAction" type="text" value="<? echo $t_strPersonnelAction; ?>" size="20" maxlength="20">
                                            <input name="t_strOldPersonnelAction" type="hidden" value="<? echo $t_strPersonnelAction; ?>"> 
                                          </td>
                                          <td class="paragraph">Employment Basis 
                                            :</td>
                                          <td> 
                                             <?
											 if($t_strEmploymentBasis == "FullTime" || $t_strEmploymentBasis == "")
											  {
												echo "<input name='t_strEmploymentBasis' type='radio' value='FullTime' checked>";
											  }
											  else
											  {
												echo "<input name='t_strEmploymentBasis' type='radio' value='FullTime'>";
											  }
											  ?>
                                            Full Time 
                                             <?
											 if($t_strEmploymentBasis == "PartTime")
											  {
												echo "<input name='t_strEmploymentBasis' type='radio' value='PartTime' checked>";
											  }
											  else
											  {
												echo "<input name='t_strEmploymentBasis' type='radio' value='PartTime'>";
											  } 
											  ?>
                                          Part Time
                                            <input name="t_strOldEmploymentBasis" type="hidden" value="<? echo $t_strEmploymentBasis; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Category Service 
                                            :</td>
                                          <td> <input name="t_strCategoryService" type="text" value="<? echo "$t_strCategoryService"; ?>" size="20" maxlength="20">
                                            <input name="t_strOldCategoryService" type="hidden" id="t_strOldCategoryService" value="<? echo "$t_strCategoryService"; ?>"> 
                                          </td>
                                          <td class="paragraph">Nature of Work 
                                            :</td>
                                          <td> <input name="t_strNatureOfWork" type="text"  value="<? echo "$t_strNatureOfWork"; ?>" size="20" maxlength="20"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td height="20" class="paragraph">HP Factor :</td>
                                          <td> <input name="t_strHPFactor" type="text" value="<? echo "$t_strHPFactor"; ?>" size="10" maxlength="2">
                                            <input name="t_strOldHPFactor" type="hidden" value="<? echo "$t_strHPFactor"; ?>"></td>
                                          <td class="paragraph">Payroll Switch 
                                            :</td>
                                          <td>
                                            <?
									 if($t_strPayrollSwitch == "Y" || $t_strPayrollSwitch == "")
									  {
									  	echo "<input name='t_strPayrollSwitch' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strPayrollSwitch' type='radio' value='Y'>";
									  }
									  ?>
                                            Yes 
                                            <?
									 if($t_strPayrollSwitch == "N")
									  {
									  	echo "<input name='t_strPayrollSwitch' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strPayrollSwitch' type='radio' value='N'>";
									  } 
									  ?>
                                            No 
                                            <input name="t_strOldPayrollSwitch" type="hidden" value="<? echo "$t_strPayrollSwitch"; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">DTR Switch :</td>
                                          <td>
                                            <?
									 if($t_strDTRSwitch == "Y" || $t_strDTRSwitch == "")
									  {
									  	echo "<input name='t_strDTRSwitch' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strDTRSwitch' type='radio' value='Y'>";
									  }
									  ?>
                                            Yes 
                                            <?
									 if($t_strDTRSwitch == "N")
									  {
									  	echo "<input name='t_strDTRSwitch' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strDTRSwitch' type='radio' value='N'>";
									  } 
									  ?>
                                            No 
                                            <input name="t_strOldDTRSwitch" type="hidden" value="<? echo "$t_strDTRSwitch"; ?>">
                                          </td>
                                          <td class="paragraph">No. of Dependents 
                                            :</td>
                                          <td> <input name="t_intDependents" type="text" value="<? echo "$t_intDependents"; ?>" size="10" maxlength="2"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph"> w/ Health Insurance 
                                            Provider :</td>
                                          <td> 
                                            <?
									 if($t_strHealthProvider == "Y" || $t_strHealthProvider == "")
									  {
									  	echo "<input name='t_strHealthProvider' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strHealthProvider' type='radio' value='Y'>";
									  }
									  ?>
                                            Yes 
                                            <?
									 if($t_strHealthProvider == "N")
									  {
									  	echo "<input name='t_strHealthProvider' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strHealthProvider' type='radio' value='N'>";
									  } 
									  ?>
                                            No 
                                            <input name="t_strOldHealthProvider" type="hidden" value="<? echo "$t_strHealthProvider"; ?>">
                                          </td>
                                          <td class="paragraph">Effectivity Date 
                                            :</td>
                                          <td> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strEffectiveMonth\">"; 
											$yyyymmdd = $t_strEffectiveDate;
											list($t_strEffectiveMonth) = array(substr($yyyymmdd,5,2));
											$objPosition->comboMonth($t_strEffectiveMonth);
											echo "</SELECT>";
											?>
                                            <input name="t_strOldEffectiveMonth" type="hidden" value="<? echo $t_strEffectiveMonth; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strEffectiveDay\">\r";
											$yyyymmdd = $t_strEffectiveDate;
											list($t_strEffectiveDay) = array(substr($yyyymmdd,8,2));
											$objPosition->comboDay($t_strEffectiveDay);
											echo "</SELECT>\r";
											?>
                                            <input name="t_strOldEffectiveDay" type="hidden" value="<? echo $t_strEffectiveDay; ?>"> 
                                            <?php 
										$result = mysql_query ("SELECT * FROM tblEmpPosition");
										echo "<SELECT NAME=\"t_strEffectiveYear\">\r";
										$yyyymmdd = $t_strEffectiveDate;
                                        list($t_strEffectiveYear) = array(substr($yyyymmdd,0,4));
										$objPosition->comboYearOld($t_strEffectiveYear);
										echo "</SELECT>\r";
										?>
                                            <input name="t_strOldEffectiveYear" type="hidden" value="<? echo $t_strEffectiveYear; ?>"> 
                                            <input name="t_strOldEffectiveDate" type="hidden" value="<? echo $t_strEffectiveDate; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Position Date 
                                            :</td>
                                          <td>
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strPositionMonth\">"; 
											$yyyymmdd = $t_strPositionDate;
											list($t_strPositionMonth) = array(substr($yyyymmdd,5,2));
											$objPosition->comboMonth($t_strPositionMonth);
											echo "</SELECT>";
											?>
                                            <input name="t_strOldPositionMonth" type="hidden" value="<? echo "$t_strPositionMonth"; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strPositionDay\">\r";
											$yyyymmdd = $t_strPositionDate;
											list($t_strPositionDay) = array(substr($yyyymmdd,8,2));
											$objPosition->comboDay($t_strPositionDay);
											echo "</SELECT>\r";
											?>
                                            <input name="t_strOldPositionDay" type="hidden" value="<? echo "$t_strPositionDay"; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strPositionYear\">\r";
											$yyyymmdd = $t_strPositionDate;
											list($t_strPositionYear) = array(substr($yyyymmdd,0,4));
											$objPosition->comboYearOld($t_strPositionYear);
											echo "</SELECT>\r";
											?>
                                            <input name="t_strOldPositionYear" type="hidden" value="<? echo "$t_strPositionYear"; ?>"> 
                                            <input name="t_strOldPositionDate" type="hidden" value="<? echo "$t_strPositionDate"; ?>"> 
                                          </td>
                                          <td class="paragraph"> Longevity Date 
                                            : </td>
                                          <td>
                                            <?php 
										$result = mysql_query ("SELECT * FROM tblEmpPosition");
									    echo "<SELECT NAME=\"t_strLongevityMonth\">"; 
										$yyyymmdd = $t_strLongevityDate;
                                        list($t_strLongevityMonth) = array(substr($yyyymmdd,5,2));
										$objPosition->comboMonth($t_strLongevityMonth);
										echo "</SELECT>";
										?>
                                            <input name="t_strOldLongevityMonth" type="hidden" value="<? echo "$t_strLongevityMonth"; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strLongevityDay\">\r";
											$yyyymmdd = $t_strLongevityDate;
											list($t_strLongevityDay) = array(substr($yyyymmdd,8,2));
											$objPosition->comboDay($t_strLongevityDay);
											echo "</SELECT>\r";
											?>
                                            <input name="t_strOldLongevityDay" type="hidden" value="<? echo $t_strLongevityDay; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strLongevityYear\">\r";
											$yyyymmdd = $t_strLongevityDate;
											list($t_strLongevityYear) = array(substr($yyyymmdd,0,4));
											$objPosition->comboYearOld($t_strLongevityYear);
											echo "</SELECT>\r";
											?>
                                            <input name="t_strOldLongevityYear" type="hidden" value="<? echo $t_strLongevityYear; ?>"> 
                                            <input name="t_strOldLongevityDate" type="hidden" value="<? echo $t_strLongevityDate; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Actual Salary:</td>
                                          <td><input name="t_intActualSalary" type="text" value="<? echo "$t_intActualSalary"; ?>" size="20" maxlength="10">
                                            <input name="t_intOldActualSalary" type="hidden" value="<? echo "$t_intActualSalary";  ?>"> 
                                          </td>
                                          <td class="paragraph">Contract End Date 
                                            : </td>
                                          <td>
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strContractEndMonth\">"; 
											$yyyymmdd = $t_strContractEndDate;
											list($t_strContractEndMonth) = array(substr($yyyymmdd,5,2));
											$objPosition->comboMonth($t_strContractEndMonth);
											echo "</SELECT>";
											?>
                                            <input name="t_strOldContractEndMonth" type="hidden" value="<? echo $t_strContractEndMonth; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strContractEndDay\">\r";
											$yyyymmdd = $t_strContractEndDate;
											list($t_strContractEndDay) = array(substr($yyyymmdd,8,2));
											$objPosition->comboDay($t_strContractEndDay);
											echo "</SELECT>\r";
											?>
                                            <input name="t_strOldContractEndDay" type="hidden" value="<? echo $t_strContractEndDay; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strContractEndYear\">\r";
											$yyyymmdd = $t_strContractEndDate;
											list($t_strContractEndYear) = array(substr($yyyymmdd,0,4));
											$objPosition->comboYearOld($t_strContractEndYear);
											echo "</SELECT>\r";
											?>
                                            <input name="t_strOldContractEndYear" type="hidden" value="<? echo $t_strContractEndYear; ?>"> 
                                            <input name="t_strOldContractEndDate" type="hidden" value="<? echo $t_strContractEndDate; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td class="paragraph">&nbsp;</td>
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">&nbsp;</td>
                                          <td><div align="right">
                                              <input name="txtSearch" type="hidden" value="<? echo $txtSearch; ?>">
                                              <input type="hidden" name="optField" value="<? echo $optField; ?>">
                                              <input name="t_strEmpNumber" type="hidden" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                              <input type="hidden" name="p" value="<? echo $p; ?>">
                                              <input name="Submit" type="submit" value="Submit">
                                            </div></td>
                                          <td class="paragraph">&nbsp;</td>
                                          <td>
                                            
                                          </td>
                                        </tr>
										<?
										}
										?>
                                      </table>
									  
                                      
                                    </td>
                                  </tr>
                                </table>
                              </form> 
							  </td>
                          </tr>
                        </table>
                        <!-- InstanceEndEditable --></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="16" colspan="2"><table width="100%" height="20" border="0" cellpadding="0" cellspacing="0" bgcolor="#002E7F" id="OUTERTBL4">
              <tr> 
                <td><div align="center"> 
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
