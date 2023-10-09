<?php 
/* 
File Name: Examinations.php
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
Date of Revision: November 24, 2003
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
include("../hrmis/class/Examinations.php");
$objEmployeeExam= new examinations;
$objEmployeeExam->trapButton($txtSearch, $strLetter, "Searchemployee.php", "Profile.php");
$objEmployeeExam->setvar(array('txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>$cboMonth, 'cboYear'=>$cboYear)); //for maintain state
$arrEmpPersonal = $objEmployeeExam->checkGetEmpNmbr("201", $txtSearch, $optField, $cboMonth, $cboYear, 1, $p);
$objEmployeeExam->addEmployeeExam($t_strEmpNumber, $t_strExamCode, $t_strExamMonth, $t_strExamDay, $t_strExamYear, $t_intExamRating, $t_strExamPlace, $Submit);   //Load add Employee Exam 
$objEmployeeExam->editEmployeeExam($t_strExamCode, $t_strExamMonth, $t_strExamDay, $t_strExamYear, $t_intExamRating, $t_strExamPlace, $Submit, $t_strEmpNumber, $t_strOldExamCode, $t_strOldExamMonth, $t_strOldExamDay, $t_strOldExamYear); //edit employee examinations
$strConfirm=$objEmployeeExam->deleteEmployeeExam($t_strEmpNumber, $t_strExamCode, $t_strExamDate, $t_intExamRating, $t_strExamPlace, $Submit); //Delete employee examination
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
                            <td><p class="header">Examinations</p>
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
								$arrEmployeeExam=$objEmployeeExam->viewEmployeeExam($txtSearch, $optField, $p, $t_strExamCode, $t_strExamDate, $t_intExamRating, $t_strExamPlace, $arrEmpPersonal["empNumber"]);   //View employee examination
								?>
								<br>
                              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <form method="post" action="<? $PHP_SELF; ?>" name="frmEmployeeExam">
                                  <?
								  if($strConfirm)
								  {
								  ?>
                                  <tr> 
                                    <td colspan="3" class="titlebar">Are you sure 
                                      you want to delete <? echo $t_strExamCode; ?>, 
                                      <? echo $t_strExamPlace; ?>, <? echo $t_intExamRating; ?> 
                                      and <? echo $t_strExamDate; ?> ??? 
                                      <input name="t_strOldEmpNumber" type="hidden" id="t_strOldEmpNumber2" value="<? echo $arrEmpPersonal['empNumber']; ?>"></td>
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
                                  <tr> 
                                    <td width="142" height="19" class="paragraph"> 
                                      <input name="t_strOldEmpNumber" type="hidden" value="<? echo $arrEmpPersonal['empNumber']; ?>">
                                      Exam Description : </td>
                                    <td colspan="2"> 
                                      <?php 
										$result = mysql_query ("SELECT * FROM tblExamType");
										echo "<SELECT NAME=\"t_strExamCode\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strExamCode == $row["examCode"])
											{
												print "<OPTION VALUE=\"".($row["examCode"])."\" selected>".($row["examDesc"])."\r";
											}
										  print "<OPTION VALUE=\"".($row["examCode"])."\">".($row["examDesc"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                      <input name="t_strOldExamCode" type="hidden" value="<? echo $t_strExamCode; ?>"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Place of Examination 
                                      :</td>
                                    <td colspan="2"> <input name="t_strExamPlace" type="text" value="<? echo "$t_strExamPlace"; ?>" size="25" maxlength="50"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Rating :</td>
                                    <td width="124"><input name="t_intExamRating" type="text" value="<? echo "$t_intExamRating"; ?>" size="20" maxlength="15"> 
                                    </td>
                                    <td class="paragraph">Date of Examination 
                                      : 
                                      <?php 
										$result = mysql_query ("SELECT * FROM tblEmpExam");
									    echo "<SELECT NAME=\"t_strExamMonth\">"; 
										$yyyymmdd = $t_strExamDate;
                                        list($t_strExamMonth) = array(substr($yyyymmdd,5,2));
										$objEmployeeExam->comboMonth($t_strExamMonth);
										echo "</SELECT>";
										?>
                                      <input name="t_strOldExamMonth" type="hidden" value="<? echo "$t_strExamMonth"; ?>"> 
                                      <?php 
										$result = mysql_query ("SELECT * FROM tblEmpExam");
										echo "<SELECT NAME=\"t_strExamDay\">\r";
										$yyyymmdd = $t_strExamDate;
                                        list($t_strExamDay) = array(substr($yyyymmdd,8,2));
										$objEmployeeExam->comboDay($t_strExamDay);
										echo "</SELECT>\r";
										?>
                                      <input name="t_strOldExamDay" type="hidden" value="<? echo "$t_strExamDay"; ?>"> 
                                      <?php 
										$result = mysql_query ("SELECT * FROM tblEmpExam");
										echo "<SELECT NAME=\"t_strExamYear\">\r";
										$yyyymmdd = $t_strExamDate;
                                        list($t_strExamYear) = array(substr($yyyymmdd,0,4));
										$objEmployeeExam->comboYearOld($t_strExamYear);
										echo "</SELECT>\r";
										?>
                                      <input name="t_strOldExamYear" type="hidden" value="<? echo "$t_strExamYear"; ?>"> 
                                      <input name="t_strOldExamDate" type="hidden" id="t_strOldExamDate" value="<? echo "$t_strExamDate"; ?>"> </a> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td colspan="3" class="paragraph">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td colspan="3" class="paragraph"> <div align="center"> 
                                        <input name="txtSearch" type="hidden" id="txtSearch" value="<? echo $txtSearch; ?>">
                                        <input name="optField" type="hidden" id="optField" value="<? echo $optField; ?>">
                                        <input name="t_strEmpNumber" type="hidden" id="t_strEmpNumber" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                        <input name="p" type="hidden" id="p" value="<? echo $p; ?>">
                                        <input name="Submit" type="submit" value="Submit" >
                                        <input name="Submit" type="submit" value="Cancel">
                                      </div></td>
                                  </tr>
                                  <tr> 
                                    <td colspan="3" class="paragraph">&nbsp;</td>
                                  </tr>
                                  <?
								     } else {
								     ?>
                                  <tr> 
                                    <td width="142" height="19" class="paragraph">Exam 
                                      Description : </td>
                                    <td colspan="2"> 
                                      <?php 
										$result = mysql_query ("SELECT examCode, examDesc FROM tblExamType");
										echo "<SELECT NAME=\"t_strExamCode\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strExamDesc == $row["examCode"])
											{
												print "<OPTION VALUE=\"".($row["examCode"])."\" selected>".($row["examDesc"])."\r";
											}
										  print "<OPTION VALUE=\"".($row["examCode"])."\">".($row["examDesc"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                      <input name="t_strOldExamCode" type="hidden" value="<? echo $t_strExamCode; ?>"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Place of Examination 
                                      :</td>
                                    <td colspan="2"> <input name="t_strExamPlace" type="text" size="25" maxlength="50"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Rating :</td>
                                    <td><input name="t_intExamRating" type="text" size="20" maxlength="15"></td>
                                    <td width="264" class="paragraph">Date of 
                                      Examination : 
                                      <select name="t_strExamMonth" size="1">
                                        <?
										$objEmployeeExam->comboMonth(t_strExamMonth);
										?>
                                      </select> <select name="t_strExamDay" size="1">
                                        <?
										$objEmployeeExam->comboDay(t_strExamDay);
										?>
                                      </select> <select name="t_strExamYear" size="1">
                                        <?
										$objEmployeeExam->comboYearOld(t_strExamYear);
									   ?>
                                      </select> </a></td>
                                  </tr>
                                  <tr> 
                                    <td colspan="3" class="paragraph">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td colspan="3" class="paragraph"> <div align="center"> 
                                        <input name="txtSearch" type="hidden" id="txtSearch" value="<? echo $txtSearch; ?>">
                                        <input type="hidden" name="optField" value="<? echo $optField; ?>">
                                        <input name="t_strEmpNumber" type="hidden" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                        <input type="hidden" name="p" value="<? echo $p; ?>">
                                        <input name="Submit" type="submit" value="ADD" >
                                        <input type="reset" name="Reset" value="Clear">
                                      </div></td>
                                  </tr>
                                  <tr> 
                                    <td colspan="3" class="paragraph">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" class="paragraph">
                                      <? $objEmployeeExam->output(); ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" class="paragraph">&nbsp;</td>
                                  </tr>
                                  <?
					 					   }
										   ?>
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
