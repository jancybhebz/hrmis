<?php 
/* 
File Name: Education.php
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
Date of Revision: November 19, 2003
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
include("../hrmis/class/Education.php");
$objEducation= new education;
$objEducation->trapButton($txtSearch, $strLetter, "Searchemployee.php", "Profile.php");
$objEducation->setvar(array('txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>$cboMonth, 'cboYear'=>$cboYear)); //for maintain state
$arrEmpPersonal = $objEducation->checkGetEmpNmbr("201", $txtSearch, $optField, $cboMonth, $cboYear, 1, $p);
$objEducation->addEducation($t_strEmpNumber, $t_strLevelCode, $t_strSchoolName, $t_strCourse, $t_strUnits, $t_strSchoolFromMonth, $t_strSchoolFromDay, $t_strSchoolFromYear, $t_strSchoolToMonth, $t_strSchoolToDay, $t_strSchoolToYear, $t_strHonors, $Submit);   //Add employee educational attainment
$objEducation->editEducation($t_strEmpNumber, $t_strLevelCode, $t_strSchoolName, $t_strCourse, $t_strUnits, $t_strSchoolFromMonth, $t_strSchoolFromDay, $t_strSchoolFromYear, $t_strSchoolToMonth, $t_strSchoolToDay, $t_strSchoolToYear, $t_strHonors, $Submit, $t_strOldSchoolName, $t_strOldLevelCode, $t_strOldSchoolFromMonth, $t_strOldSchoolFromDay, $t_strOldSchoolFromYear, $t_strOldSchoolToMonth, $t_strOldSchoolToDay, $t_strOldSchoolToYear);   //Edit employee educational attainment
$strConfirm=$objEducation->deleteEducation($t_strEmpNumber, $t_strLevelCode, $t_strSchoolName, $t_strCourse, $t_strUnits, $t_strSchoolFromMonth, $t_strSchoolFromDay, $t_strSchoolFromYear, $t_strSchoolToMonth, $t_strSchoolToDay, $t_strSchoolToYear, $t_strHonors, $Submit);  //Delete employee educational attainment
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
                            <td><p class="header">EDUCATION</p>
                              <table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" class="border">
                                <tr> 
                                  <td width="480" height="73"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCFF">
                                      <tr> 
                                        <td width="141" class="paragraph">Employee 
                                          Number : </td>
                                        <td width="339"><strong>&nbsp;<? echo $arrEmpPersonal['empNumber']; ?> 
                                          <input name="txtSearch2" type="hidden" id="txtSearch2" value="<? echo $txtSearch; ?>">
                                          <input name="optField2" type="hidden" id="optField" value="<? echo $optField; ?>">
                                          <input name="t_strEmpNumber2" type="hidden" id="t_strEmpNumber" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
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
								$arrEmpEducation=$objEducation->viewEducation($txtSearch, $optField, $p, $t_strLevelCode, $t_strSchoolName, $t_strCourse, $t_strUnits, $t_strSchoolFromMonth, $t_strSchoolFromDay, $t_strSchoolFromYear, $t_strSchoolToMonth, $t_strSchoolToDay, $t_strSchoolToYear, $t_strHonors, $arrEmpPersonal["empNumber"]);  //View list of employee educational attainment								
								?>
                              <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <form method="post" action="<? $PHP_SELF; ?>" name="frmEmpEducation">
                                  <tr> 
                                    <td>&nbsp; </td>
                                  </tr>
                                  <tr> 
                                    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <?
								  if ($strConfirm)
								  {
								  ?>
                                        <tr> 
                                          <td width="770" colspan="3" class="titlebar">Are 
                                            you sure you want to delete <? echo $t_strLevelCode; ?>, 
                                            <? echo $t_strSchoolName; ?>, <? echo $t_strCourse; ?>, 
                                            <? echo $t_strUnits; ?> and <? echo $t_strHonors; ?> 
                                            ??? 
                                            <input name="t_strLevelCode" type="hidden" id="t_strLevelCode" value="<? echo $t_strLevelCode; ?>"></td>
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
                                        <?
									} 
									elseif ($Submit == 'Edit')
									   {
									?>
                                      </table>
                                      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td width="26%" class="paragraph">&nbsp;</td>
                                          <td colspan="3">&nbsp; </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph"><input name="t_strOldEmpNumber" type="hidden" value="<? echo $arrEmpPersonal['empNumber']; ?>">
                                            Level Description :</td>
                                          <td colspan="3"> 
                                            <?php 
										$result = mysql_query ("SELECT levelCode, levelDesc FROM tblEducationalLevel");
										echo "<SELECT NAME=\"t_strLevelCode\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strLevelCode == $row["levelCode"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["levelCode"])."\" selected>".strtoupper($row["levelDesc"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["levelCode"])."\">".strtoupper($row["levelDesc"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                            <input name="t_strOldLevelCode" type="hidden" value="<? echo $t_strLevelCode; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">School Name :</td>
                                          <td colspan="3"> <input name="t_strSchoolName" type="text" value="<? echo "$t_strSchoolName"; ?>" size="60" maxlength="80"> 
                                            <input name="t_strOldSchoolName" type="hidden" value="<? echo "$t_strSchoolName"; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Course :</td>
                                          <td colspan="3"> <input name="t_strCourse" type="text" value="<? echo "$t_strCourse"; ?>" size="50" maxlength="50"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Units Earned :</td>
                                          <td colspan="3"> <input name="t_strUnits" type="text" value="<? echo "$t_strUnits"; ?>" size="20" maxlength="10"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Honors :</td>
                                          <td colspan="3"> <input name="t_strHonors" type="text" value="<? echo "$t_strHonors"; ?>" size="60" maxlength="80"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Date From :</td>
                                          <td width="31%"> 
                                            <?php 
										$result = mysql_query ("SELECT * FROM tblEmpSchool");
									    echo "<SELECT NAME=\"t_strSchoolFromMonth\">"; 
										$yyyymmdd = $t_strSchoolFromDate;
                                        list($t_strSchoolFromMonth) = array(substr($yyyymmdd,5,2));
										$objEducation->comboMonth($t_strSchoolFromMonth);
										echo "</SELECT>";
										?>
                                            <input name="t_strOldSchoolFromMonth" type="hidden" value="<? echo "$t_strSchoolFromMonth"; ?>"> 
                                            <?php 
										$result = mysql_query ("SELECT * FROM tblEmpSchool");
										echo "<SELECT NAME=\"t_strSchoolFromDay\">\r";
										$yyyymmdd = $t_strSchoolFromDate;
                                        list($t_strSchoolFromDay) = array(substr($yyyymmdd,8,2));
										$objEducation->comboDay($t_strSchoolFromDay);
										echo "</SELECT>\r";
										?>
                                            <input name="t_strOldSchoolFromDay" type="hidden" value="<? echo "$t_strSchoolFromDay"; ?>"> 
                                            <?php 
										$result = mysql_query ("SELECT * FROM tblEmpSchool");
										echo "<SELECT NAME=\"t_strSchoolFromYear\">\r";
										$yyyymmdd = $t_strSchoolFromDate;
                                        list($t_strSchoolFromYear) = array(substr($yyyymmdd,0,4));
										$objEducation->comboYearOld($t_strSchoolFromYear);
										echo "</SELECT>\r";
										?>
                                            <input name="t_strOldSchoolFromYear" type="hidden" value="<? echo "$t_strSchoolFromYear"; ?>"> 
                                            <input name="t_strOldSchoolFromDate" type="hidden" value="<? echo "$t_strSchoolFromDate"; ?>"> 
                                          </td>
                                          <td width="12%" class="paragraph">Date 
                                            To :</td>
                                          <td width="31%"> 
                                            <?php 
										$result = mysql_query ("SELECT * FROM tblEmpSchool");
									    echo "<SELECT NAME=\"t_strSchoolToMonth\">"; 
										$yyyymmdd = $t_strSchoolToDate;
                                        list($t_strSchoolToMonth) = array(substr($yyyymmdd,5,2));
										$objEducation->comboMonth($t_strSchoolToMonth);
										echo "</SELECT>";
										?>
                                            <input name="t_strOldSchoolToMonth" type="hidden" value="<? echo "$t_strSchoolToMonth"; ?>"> 
                                            <?php 
										$result = mysql_query ("SELECT * FROM tblEmpSchool");
										echo "<SELECT NAME=\"t_strSchoolToDay\">\r";
										$yyyymmdd = $t_strSchoolToDate;
                                        list($t_strSchoolToDay) = array(substr($yyyymmdd,8,2));
										$objEducation->comboDay($t_strSchoolToDay);
										echo "</SELECT>\r";
										?>
                                            <input name="t_strOldSchoolToDay" type="hidden" value="<? echo "$t_strSchoolToDay"; ?>"> 
                                            <?php 
										$result = mysql_query ("SELECT * FROM tblEmpSchool");
										echo "<SELECT NAME=\"t_strSchoolToYear\">\r";
										$yyyymmdd = $t_strSchoolToDate;
                                        list($t_strSchoolToYear) = array(substr($yyyymmdd,0,4));
										$objEducation->comboYearOld($t_strSchoolToYear);
										echo "</SELECT>\r";
										?>
                                            <input name="t_strOldSchoolToYear" type="hidden" value="<? echo "$t_strSchoolToYear"; ?>"> 
                                            <input name="t_strOldSchoolToDate" type="hidden" value="<? echo "$t_strSchoolToDate"; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">&nbsp;</td>
                                          <td colspan="3">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">&nbsp;</td>
                                          <td colspan="3"><input name="Submit" type="submit" id="Submit" value="Submit"> 
                                            <input name="Submit" type="submit" id="Submit" value="Cancel"> 
                                            <input name="txtSearch" type="hidden" id="txtSearch"  value="<? echo $txtSearch; ?>"> 
                                            <input name="optField" type="hidden" value="<? echo $optField; ?>"> 
                                            <input name="t_strEmpNumber" type="hidden" value="<? echo $arrEmpPersonal["empNumber"]; ?>"> 
                                            <input name="p" type="hidden" value="<? echo $p; ?>"></td>
                                        </tr>
                                        <?
										} 
										else {
										?>
                                        <tr> 
                                          <td class="paragraph">&nbsp;</td>
                                          <td colspan="3">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph"> Level Code :</td>
                                          <td colspan="3"> 
                                            <?php 
										$result = mysql_query ("SELECT levelCode, levelDesc FROM tblEducationalLevel");
										echo "<SELECT NAME=\"t_strLevelCode\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strLevelCode == $row["levelCode"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["levelCode"])."\" selected>".strtoupper($row["levelDesc"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["levelCode"])."\">".strtoupper($row["levelDesc"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                            <input name="t_strOldLevelCode" type="hidden" id="t_strOldLevelCode" value="<? echo $t_strLevelCode; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">School Name :</td>
                                          <td colspan="3"> <input name="t_strSchoolName" type="text" size="60" maxlength="80"> 
                                            <input name="t_strOldEmpNumber" type="hidden" value="<? echo $arrEmpPersonal['empNumber']; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Course :</td>
                                          <td colspan="3"> <input name="t_strCourse" type="text" size="50" maxlength="50"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Units Earned :</td>
                                          <td colspan="3"> <input name="t_strUnits" type="text" size="20" maxlength="10"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Honors :</td>
                                          <td colspan="3"> <input name="t_strHonors" type="text" size="60" maxlength="80"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Date From :</td>
                                          <td> <select name="t_strSchoolFromMonth" size="1">
                                              <?
											$objEducation->comboMonth(t_strSchoolFromMonth);
											?>
                                            </select> <select name="t_strSchoolFromDay" size="1">
                                              <?
											$objEducation->comboDay(t_strSchoolFromDay);
											?>
                                            </select> <select name="t_strSchoolFromYear" size="1">
                                              <?
											$objEducation->comboYearOld(t_strSchoolFromYear);
									   		?>
                                            </select> </td>
                                          <td class="paragraph">Date To :</td>
                                          <td> <select name="t_strSchoolToMonth" size="1">
                                              <?
											$objEducation->comboMonth(t_strSchoolToMonth);
											?>
                                            </select> <select name="t_strSchoolToDay" size="1">
                                              <?
											$objEducation->comboDay(t_strSchoolToDay);
											?>
                                            </select> <select name="t_strSchoolToYear" size="1">
                                              <?
											$objEducation->comboYearOld(t_strSchoolToYear);
									   		?>
                                            </select></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">&nbsp;</td>
                                          <td colspan="3">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">&nbsp;</td>
                                          <td colspan="3"><input name="Submit" type="submit" value="ADD"> 
                                            <input type="reset" name="Reset" value="Clear"> 
                                            <input name="txtSearch" type="hidden" value="<? echo $txtSearch; ?>"> 
                                            <input name="optField" type="hidden" value="<? echo $optField; ?>"> 
                                            <input name="t_strEmpNumber" type="hidden" value="<? echo $arrEmpPersonal["empNumber"]; ?>"> 
                                            <input name="p" type="hidden" value="<? echo $p; ?>"></td>
                                        </tr>
                                        <?
										}
										?>
                                      </table></td>
                                  </tr>
                                  <tr>
                                    <td><div align="right">
                                        <? $objEducation->output(); ?>
                                      </div></td>
                                  </tr>
                                  <tr> 
                                    <td>&nbsp;</td>
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
