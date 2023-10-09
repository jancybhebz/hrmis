<?php 
/* 
File Name: Servicerecords.php
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
Date of Revision: November 21, 2003
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
include("../hrmis/class/Servicerecords.php");
$objService= new service;
$objService->trapButton($txtSearch, $strLetter, "Searchemployee.php", "Profile.php");
$objService->setvar(array('txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>$cboMonth, 'cboYear'=>$cboYear)); //for maintain state
$arrEmpPersonal = $objService->checkGetEmpNmbr("201", $txtSearch, $optField, $cboMonth, $cboYear, 1, $p);
$objService->addServiceRecords($t_strEmpNumber, $t_dtmServiceFromMonth, $t_dtmServiceFromDay, $t_dtmServiceFromYear, $t_dtmServiceToMonth, $t_dtmServiceToDay, $t_dtmServiceToYear, $t_strPositionCode, $t_strAppointmentCode, $t_strStationAgency, $t_intSalary, $t_intLeaveWoPay, $t_strBranch, $t_strSeparationCause, $t_dtmSeparationMonth, $t_dtmSeparationDay, $t_dtmSeparationYear, $Submit);  //Load add service records information function
$objService->editServiceRecords($t_dtmServiceFromMonth, $t_dtmServiceFromDay, $t_dtmServiceFromYear, $t_dtmServiceToMonth, $t_dtmServiceToDay, $t_dtmServiceToYear, $t_strPositionCode, $t_strAppointmentCode, $t_strStationAgency, $t_intSalary, $t_intLeaveWoPay, $t_strBranch, $t_strSeparationCause, $t_dtmSeparationMonth, $t_dtmSeparationDay, $t_dtmSeparationYear, $Submit, $t_strEmpNumber, $t_dtmOldServiceFromMonth, $t_dtmOldServiceFromDay, $t_dtmOldServiceFromYear, $t_dtmOldServiceToMonth, $t_dtmOldServiceToDay, $t_dtmOldServiceToYear, $t_strOldPositionCode, $t_dtmOldSeparationMonth, $t_dtmOldSeparationDay, $t_dtmOldSeparationYear, $t_strOldSeparationCause); //edit employee service records
$strConfirm=$objService->deleteServiceRecords($txtSearch, $optField, $p, $t_dtmServiceFromDate, $t_dtmServiceToDate, $t_strPositionCode, $t_strAppointmentCode, $t_intSalary, $t_strBranch, $t_strStationAgency, $t_intLeaveWoPay, $t_strSeparationCause, $t_dtmSeparationDate, $t_strEmpNumber, $Submit);  //delete of service records from database
?>
<html><!-- InstanceBegin template="/Templates/201tmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/class/JSgeneral.php");
?>
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
                            <td height="312"><p class="header">WORK EXPERIENCE</p>
                              <table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" class="border">
                                <tr> 
                                  <td width="480" height="73"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCFF">
                                      <tr> 
                                        <td width="141" class="paragraph">Employee 
                                          Number : </td>
                                        <td width="339"><strong>&nbsp;<? echo $arrEmpPersonal['empNumber']; ?> 
                                          <input name="txtSearch2" type="hidden" id="txtSearch2" value="<? echo $txtSearch; ?>">
                                          <input name="optField2" type="hidden" id="optField2" value="<? echo $optField; ?>">
                                          <input name="t_strEmpNumber2" type="hidden" id="t_strEmpNumber2" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                          <input name="p2" type="hidden" id="p22" value="<? echo $p; ?>">
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
                              </table>
                              <hr>
                              	<? 
								$arrEmpService=$objService->viewServiceRecords($txtSearch, $optField, $p, $t_dtmServiceFromDate, $t_dtmServiceToDate, $t_strPositionCode, $t_strAppointmentCode, $t_strStationAgency, $t_intSalary, $t_intLeaveWoPay, $t_strBranch, $t_strSeparationCause, $t_dtmSeparationDate, $arrEmpPersonal["empNumber"]);  //View list of service records
								?>
                              <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <form action="<? $PHP_SELF; ?>" method="post" name="frmServiceRecords">
                                  <tr> 
                                    <td width="604" class="header"><div align="justify"></div></td>
                                  </tr>
                                  <tr> 
                                    <td height="99"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <?
										if($strConfirm)
										{
										?>
                                        <tr> 
                                          <td width="824" colspan="3" class="titlebar">Are 
                                            you sure you want to delete <? echo $t_strPositionCode; ?>, 
                                            <? echo $t_strStationAgency; ?> and 
                                            <? echo $t_strAppointmentCode; ?> 
                                            ??? 
                                            <input name="t_strOldStationAgency" type="hidden" value="<? echo "$t_strStationAgency"; ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="3"><div align="center"> 
                                              <input name="Submit" type="submit" value="OK">
                                              <input type="submit" name="Submit" value="Cancel">
                                            </div></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="3">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="3">&nbsp;</td>
                                        </tr>
                                        <?
										}
								  		elseif ($Submit == 'Edit')
								  			{
							   			?>
                                      </table>
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <br>
                                        <tr> 
                                          <td width="27%" class="paragraph"> Inclusive 
                                            Date From :</td>
                                          <td width="26%"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblServiceRecord");
											echo "<SELECT NAME=\"t_dtmServiceFromMonth\">"; 
											$yyyymmdd = $t_dtmServiceFromDate;
											list($t_dtmServiceFromMonth) = array(substr($yyyymmdd,5,2));
											$objService->comboMonth($t_dtmServiceFromMonth);
											echo "</SELECT>";
											?>
                                            <input name="t_dtmOldServiceFromMonth" type="hidden" value="<? echo $t_dtmServiceFromMonth; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblServiceRecord");
											echo "<SELECT NAME=\"t_dtmServiceFromDay\">"; 
											$yyyymmdd = $t_dtmServiceFromDate;
											list($t_dtmServiceFromDay) = array(substr($yyyymmdd,8,2));
											$objService->comboDay($t_dtmServiceFromDay);
											echo "</SELECT>";
											?>
                                            <input name="t_dtmOldServiceFromDay" type="hidden" value="<? echo $t_dtmServiceFromDay; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblServiceRecord");
											echo "<SELECT NAME=\"t_dtmServiceFromYear\">"; 
											$yyyymmdd = $t_dtmServiceFromDate;
											list($t_dtmServiceFromYear) = array(substr($yyyymmdd,0,4));
											$objService->comboYearOld($t_dtmServiceFromYear);
											echo "</SELECT>";
											?>
                                            <input name="t_dtmOldServiceFromYear" type="hidden" value="<? echo $t_dtmServiceFromYear; ?>"> 
                                            <input name="t_strOldServiceFromDate" type="hidden" value="<? echo $t_strServiceFromDate; ?>"> 
                                          </td>
                                          <td width="18%" class="paragraph">Date 
                                            To :</td>
                                          <td width="29%"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblServiceRecord");
											echo "<SELECT NAME=\"t_dtmServiceToMonth\">"; 
											$yyyymmdd = $t_dtmServiceToDate;
											list($t_dtmServiceToMonth) = array(substr($yyyymmdd,5,2));
											$objService->comboMonth($t_dtmServiceToMonth);
											echo "</SELECT>";
											?>
                                            <input name="t_dtmOldServiceToMonth" type="hidden" value="<? echo $t_dtmServiceToMonth; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblServiceRecord");
											echo "<SELECT NAME=\"t_dtmServiceToDay\">"; 
											$yyyymmdd = $t_dtmServiceToDate;
											list($t_dtmServiceToDay) = array(substr($yyyymmdd,8,2));
											$objService->comboDay($t_dtmServiceToDay);
											echo "</SELECT>";
											?>
                                            <input name="t_dtmOldServiceToDay" type="hidden" value="<? echo $t_dtmServiceToDay; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblServiceRecord");
											echo "<SELECT NAME=\"t_dtmServiceToYear\">"; 
											$yyyymmdd = $t_dtmServiceToDate;
											list($t_dtmServiceToYear) = array(substr($yyyymmdd,0,4));
											$objService->comboYearOld($t_dtmServiceToYear);
											echo "</SELECT>";
											?>
                                            <input name="t_dtmOldServiceToYear" type="hidden" value="<? echo $t_dtmServiceToYear; ?>"> 
                                            <input name="t_strOldServiceToDate" type="hidden" value="<? echo $t_strServiceToDate; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Designation :</td>
                                          <td> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblPosition");
											echo "<SELECT NAME=\"t_strPositionCode\">\r";
											if ($row = mysql_fetch_array($result)) {
											do {
												if ($t_strPositionCode == $row["positionCode"])
												{
													print "<OPTION VALUE=\"".strtoupper($row["positionCode"])."\" selected>".strtoupper($row["positionCode"])."\r";
												}
											  print "<OPTION VALUE=\"".strtoupper($row["positionCode"])."\">".strtoupper($row["positionCode"])."\r";
											} while($row = mysql_fetch_array($result));
											} else {print "no results!";}
											echo "</SELECT>\r";
											?>
                                            <input name="t_strOldPositionCode" type="hidden" value="<? echo $t_strPositionCode; ?>"> 
                                          </td>
                                          <td class="paragraph">Status :</td>
                                          <td> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblAppointment");
											echo "<SELECT NAME=\"t_strAppointmentCode\">\r";
											if ($row = mysql_fetch_array($result)) {
											do {
												if ($t_strAppointmentCode == $row["appointmentCode"])
												{
													print "<OPTION VALUE=\"".strtoupper($row["appointmentCode"])."\" selected>".strtoupper($row["appointmentCode"])."\r";
												}
											  print "<OPTION VALUE=\"".strtoupper($row["appointmentCode"])."\">".strtoupper($row["appointmentCode"])."\r";
											} while($row = mysql_fetch_array($result));
											} else {print "no results!";}
											echo "</SELECT>\r";
											?>
                                            <input name="t_strOldAppointmentCode" type="hidden" value="<? echo $t_strAppointmentCode; ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Station Agency 
                                            :</td>
                                          <td> <input name="t_strStationAgency" type="text" value="<? echo "$t_strStationAgency"; ?>" size="20" maxlength="20"> 
                                          </td>
                                          <td class="paragraph">Salary :</td>
                                          <td><input name="t_intSalary" type="text" value="<? echo "$t_intSalary"; ?>" size="20" maxlength="10"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Leave/Absences 
                                            W/O Pay :</td>
                                          <td> <input name="t_intLeaveWoPay" type="text" value="<? echo "$t_intLeaveWoPay"; ?>" size="20" maxlength="6"> 
                                          </td>
                                          <td class="paragraph">Branch : </td>
                                          <td><input name="t_strBranch" type="text" value="<? echo "$t_strBranch"; ?>" size="20" maxlength="30"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Separation Cause 
                                            :</td>
                                          <td> 
                                            <?php 
											$query = "SELECT * FROM tblSeparationCause";
											$result = mysql_query($query);
											echo "<SELECT NAME=\"t_strSeparationCause\">\r";
											echo "<option></option>";
											if ($row = mysql_fetch_array($result)) {
											do {
												if ($t_strSeparationCause == $row["separationCause"])
												{
													print "<OPTION VALUE=\"".($row["separationCause"])."\" selected>".($row["separationCause"])."\r";
												}
											  print "<OPTION VALUE=\"".($row["separationCause"])."\">".($row["separationCause"])."\r";
											} while($row = mysql_fetch_array($result));
											} else {print "no results!";}
											echo "</SELECT>\r";
											?>
                                            <input name="t_strOldSeparationCause" type="hidden" value="<? echo $t_strSeparationCause; ?>"> 
                                          </td>
                                          <td class="paragraph">Separation Date 
                                            :</td>
                                          <td> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblServiceRecord");
											echo "<SELECT NAME=\"t_dtmSeparationMonth\">"; 
											$yyyymmdd = $t_dtmSeparationDate;
											list($t_dtmSeparationMonth) = array(substr($yyyymmdd,5,2));
											$objService->comboMonth($t_dtmSeparationMonth);
											echo "</SELECT>";
											?>
                                            <input name="t_dtmOldSeparationMonth" type="hidden" value="<? echo "$t_dtmSeparationMonth"; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblServiceRecord");
											echo "<SELECT NAME=\"t_dtmSeparationDay\">"; 
											$yyyymmdd = $t_dtmSeparationDate;
											list($t_dtmSeparationDay) = array(substr($yyyymmdd,8,2));
											$objService->comboDay($t_dtmSeparationDay);
											echo "</SELECT>";
											?>
                                            <input name="t_dtmOldSeparationDay" type="hidden" value="<? echo "$t_dtmSeparationDay"; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblServiceRecord");
											echo "<SELECT NAME=\"t_dtmSeparationYear\">"; 
											$yyyymmdd = $t_dtmSeparationDate;
											list($t_dtmSeparationYear) = array(substr($yyyymmdd,0,4));
											$objService->comboYearOld($t_dtmSeparationYear);
											echo "</SELECT>";
											?>
                                            <input name="t_dtmOldSeparationYear" type="hidden" value="<? echo "$t_dtmSeparationYear"; ?>"> 
                                            <input name="t_strOldSeparationDate" type="hidden" value="<? echo $t_strSeparationDate; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td class="paragraph">&nbsp;</td>
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph"><input name="txtSearch" type="hidden" value="<? echo $txtSearch; ?>"> 
                                            <input name="optField" type="hidden" value="<? echo $optField; ?>"> 
                                            <input name="t_strEmpNumber" type="hidden" value="<? echo $arrEmpPersonal["empNumber"]; ?>"> 
                                            <input name="p" type="hidden" value="<? echo $p; ?>"></td>
                                          <td><input name="Submit" type="submit" value="Submit"> 
                                            <input name="Submit" type="submit" value="Cancel"></td>
                                          <td class="paragraph">&nbsp;</td>
                                          <td>&nbsp;</td>
                                        </tr>
                                        <?
								   			} else {
								  			?>
                                        <tr> 
                                          <td class="paragraph">&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td class="paragraph">&nbsp;</td>
                                          <td>&nbsp;</td>
                                        </tr>
                                      </table>
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr> 
                                          <td width="27%" class="paragraph"> Inclusive 
                                            Date From :</td>
                                          <td width="26%"> <select name="t_dtmServiceFromMonth" size="1">
                                              <?
											$objService->comboMonth(t_strServiceFromMonth);
											?>
                                            </select> <select name="t_dtmServiceFromDay" size="1">
                                              <?
											$objService->comboDay(t_strServiceFromDay);
											?>
                                            </select> <select name="t_dtmServiceFromYear" size="1">
                                              <?
											$objService->comboYearOld(t_strServiceFromYear);
									   		?>
                                            </select> </td>
                                          <td width="18%" class="paragraph">Date 
                                            To :</td>
                                          <td width="29%"><select name="t_dtmServiceToMonth" size="1">
                                              <?
											$objService->comboMonth(t_strServiceToMonth);
											?>
                                            </select> <select name="t_dtmServiceToDay" size="1">
                                              <?
											$objService->comboDay(t_strServiceToDay);
											?>
                                            </select> <select name="t_dtmServiceToYear" size="1">
                                              <?
											$objService->comboYearOld(t_strServiceToYear);
										   	?>
                                            </select></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Designation :</td>
                                          <td> 
                                            <?php 
											$result = mysql_query ("SELECT positionCode FROM tblPosition");
											echo "<SELECT NAME=\"t_strPositionCode\">\r";
											if ($row = mysql_fetch_array($result)) {
											do {
												if ($t_strPositionCode == $row["positionCode"])
												{
													print "<OPTION VALUE=\"".strtoupper($row["positionCode"])."\" selected>".strtoupper($row["positionCode"])."\r";
												}
											  print "<OPTION VALUE=\"".strtoupper($row["positionCode"])."\">".strtoupper($row["positionCode"])."\r";
											} while($row = mysql_fetch_array($result));
											} else {print "no results!";}
											echo "</SELECT>\r";
											?>
                                          </td>
                                          <td class="paragraph">Status :</td>
                                          <td> 
                                            <?php 
											$result = mysql_query ("SELECT appointmentCode FROM tblAppointment");
											echo "<SELECT NAME=\"t_strAppointmentCode\">\r";
											if ($row = mysql_fetch_array($result)) {
											do {
												if ($t_strAppointmentCode == $row["appointmentCode"])
												{
													print "<OPTION VALUE=\"".strtoupper($row["appointmentCode"])."\" selected>".strtoupper($row["appointmentCode"])."\r";
												}
											  print "<OPTION VALUE=\"".strtoupper($row["appointmentCode"])."\">".strtoupper($row["appointmentCode"])."\r";
											} while($row = mysql_fetch_array($result));
											} else {print "no results!";}
											echo "</SELECT>\r";
											?>
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Station Agency 
                                            :</td>
                                          <td> <input name="t_strStationAgency" type="text" size="20" maxlength="20"> 
                                          </td>
                                          <td class="paragraph">Salary :</td>
                                          <td><input name="t_intSalary" type="text" size="20" maxlength="10"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Leave/Absences 
                                            w/o Pay :</td>
                                          <td> <input name="t_intLeaveWoPay" type="text" size="20" maxlength="6"> 
                                          </td>
                                          <td class="paragraph">Branch : </td>
                                          <td><input name="t_strBranch" type="text" size="20" maxlength="30"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Separation Cause 
                                            :</td>
                                          <td> 
                                            <?php 
										$result = mysql_query ("SELECT * FROM tblSeparationCause");
										echo "<SELECT NAME=\"t_strSeparationCause\">\r";
										echo "<option></option>";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strSeparationCause == $row["separationCause"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["separationCause"])."\" selected>".strtoupper($row["separationCause"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["separationCause"])."\">".strtoupper($row["separationCause"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                            <input name="t_strOldSeparationCause" type="hidden" id="t_strOldSeparationCause" value="<? echo $t_strSeparationCause; ?>"> 
                                          </td>
                                          <td class="paragraph">Separation Date 
                                            : </td>
                                          <td> <select name="t_dtmSeparationMonth" size="1">
                                              <?
											echo "<option></option>";
											$objService->comboMonth(t_dtmSeparationMonth);
											?>
                                            </select> <select name="t_dtmSeparationDay" size="1">
                                              <?
											echo "<option></option>";  
											$objService->comboDay(t_dtmSeparationDay);
											?>
                                            </select> <select name="t_dtmSeparationYear" size="1">
                                              <?
											echo "<option></option>"; 
											$objService->comboYearOld(t_dtmSeparationYear);
											?>
                                            </select> </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td class="paragraph">&nbsp;</td>
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph"><input name="txtSearch" type="hidden" value="<? echo $txtSearch; ?>"> 
                                            <input name="optField" type="hidden" value="<? echo $optField; ?>"> 
                                            <input name="t_strEmpNumber" type="hidden" value="<? echo $arrEmpPersonal["empNumber"]; ?>"> 
                                            <input name="p" type="hidden" value="<? echo $p; ?>"></td>
                                          <td><div align="center"> 
                                              <input name="Submit" type="submit" id="Submit" value="ADD">
                                              <input name="Reset" type="reset" id="Submit" value="Clear">
                                            </div></td>
                                          <td class="paragraph">&nbsp;</td>
                                          <td>&nbsp;</td>
                                        </tr>
                                        <?
					 					 			}
										 			?>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td height="4"><div align="center"> </div></td>
                                  </tr>
                                  <tr> 
                                    <td height="4"><div align="right">
                                        <? $objService->output(); ?>
                                      </div></td>
                                  </tr>
                                  <tr>
                                    <td height="4">&nbsp;</td>
                                  </tr>
                                </form>
                              </table>
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