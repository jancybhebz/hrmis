<?php 
/* 
File Name: Profile.php
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
Date of Revision: November 14, 2003
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
include("../hrmis/class/Profile.php");
$objProfile= new profile;
$objProfile->trapButton($txtSearch, $strLetter, "Searchemployee.php", "Profile.php");
$objProfile->setvar(array('txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>$cboMonth, 'cboYear'=>$cboYear)); //for maintain state
$arrEmpPersonal = $objProfile->checkGetEmpNmbr("201", $txtSearch, $optField, $cboMonth, $cboYear, 1, $p);
$arrEmpPersonal2 = $objProfile->checkGetEmpNmbr("Employee", $strEmpNmbr);
$objProfile->editProfile($txtSearch, $optField, $p, $t_strEmpNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strSex, $t_strCivilStatus, $t_strMaidenName, $t_strSpouse, $t_strSpouseWork, $t_strBirthMonth, $t_strBirthDay, $t_strBirthYear, $t_strTin, $t_strCitizenship, $t_strBloodType, $t_strBirthPlace, $t_intHeight, $t_intWeight, $t_strResidentialAddress, $t_intZipCode1, $t_strTelephone1, $t_strPermanentAddress, $t_intZipCode2, $t_strTelephone2, $t_strMobile, $t_strEmail, $t_strFatherName, $t_strFatherBirthPlace, $t_strMotherName, $t_strMotherBirthPlace, $t_strSkills, $t_strQualifications, $t_strComTaxNumber, $t_strIssuedAt, $t_strIssuedOnMonth, $t_strIssuedOnDay, $t_strIssuedOnYear, $t_strGSISNumber, $t_strPagibigNumber, $t_strPhilHealthNumber, $t_strOplNumber1, $t_strOplNumber2, $t_strOplNumber3, $Submit, $t_strOldEmpNumber, $t_strOldSurname, $t_strOldBirthMonth, $t_strOldBirthDay, $t_strOldBirthYear, $t_strOldIssuedOnMonth, $t_strOldIssuedOnDay, $t_strOldIssuedOnYear);   //Edit employee profile
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

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/notificationover.jpg','images/attendanceover.jpg','images/reportsover.jpg','images/librariesover.jpg','images/compensationover.jpg','images/201click.jpg','images/education2.jpg','images/trainings2.jpg','images/examinations2.jpg','images/position2.jpg','images/reference2.jpg','images/logout2.jpg','images/family-background2.jpg','images/work-experience2.jpg','images/voluntary-work2.jpg','images/personal-information2.jpg','images/other-information2.jpg'); history.forward()" onContextMenu="return false"><div align="center"> 
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
                                        <td><a href="Otherinformation.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('otherinformation','','images/other-information2.jpg',1)"><img src="images/other-information.jpg" alt="otherinformation" name="otherinformation" width="108" height="20" border="0"></a></td>
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
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td><p class="header">PROFILE </p>
                              <form method=post action="<? $PHP_SELF; ?>" name="frmProfile">
                                <? 
							  $objProfile->viewProfile($txtSearch, $optField, $p, $t_strSex, $t_strCivilStatus, $t_strMaidenName, $t_strSpouse, $t_strSpouseWork, $t_strBirthDate, $t_strTin, $t_strCitizenship, $t_strBloodType, $t_strBirthPlace, $t_intHeight, $t_intWeight, $t_intCityNumber, $t_strCityStreet, $t_strCityBrgy, $t_strCityTown, $t_strCity, $t_intCityZipCode, $t_intProvNumber, $t_strProvStreet, $t_strProvBrgy, $t_strProvTown, $t_strProvince, $t_intProvZipCode, $t_strTelephone, $t_strMobile, $t_strEmail, $t_strFatherName, $t_strFatherBirthPlace, $t_strMotherName, $t_strMotherBirthPlace, $t_strSkills, $t_strQualifications, $t_strComTaxNumber, $t_strIssuedAt, $t_strIssuedOn, $t_strGSISNumber, $t_strPagibigNumber, $t_strPhilHealthNumber, $t_strOplNumber1, $t_strOplNumber2, $t_strOplNumber3, $arrEmpPersonal["empNumber"]);   //View employee profile
							  ?>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td><div align="right">
                                        <? $objProfile->output(); ?>
                                      </div></td>
                                  </tr>
                                </table>
                                <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td class="row"><div align="center"> 
                                        <input name="txtSearch" type="hidden" id="txtSearch" value="<? echo $txtSearch; ?>">
                                        <input name="optField" type="hidden" id="optField" value="<? echo $optField; ?>">
                                        <input name="t_strEmpNumber" type="hidden" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                        <input name="p" type="hidden" id="p" value="<? echo $p; ?>">
                                      </div></td>
                                  </tr>
                                  <?
								  if ($Submit == 'EDIT')
								  {
								  ?>
                                  <hr>
                                  <tr> 
                                    <td class="row"> <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td width="25%" class="paragraph">Last 
                                            Name : </td>
                                          <td width="75%"><input name="t_strSurname" type="text" value="<? echo "$t_strSurname"; ?>" size="50" maxlength="50"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">First Name : </td>
                                          <td width="75%"> <input name="t_strFirstname" type="text" value="<? echo "$t_strFirstname"; ?>" size="50" maxlength="50"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Middle Name : 
                                          </td>
                                          <td width="75%"> <input name="t_strMiddlename" type="text" value="<? echo "$t_strMiddlename"; ?>" size="50" maxlength="50"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph"><input name="t_strOldEmpNumber" type="hidden" value="<? echo $arrEmpPersonal['empNumber']; ?>">
                                            Sex : </td>
                                          <td width="75%"> 
                                            <? 
										  	$objProfile->gender("t_strSex", $t_strSex);   
										  	?>
                                            <input name="t_strOldSex" type="hidden" value="<? echo "$t_strSex"; ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Civil Status:</td>
                                          <td> 
                                            <? 
										  	$objProfile->civilStatus("t_strCivilStatus", $t_strCivilStatus);   
										  	?>
                                            <input name="t_strOldCivilStatus" type="hidden" value="<? echo "$t_strCivilStatus"; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Maiden Name: </td>
                                          <td><input name="t_strMaidenName" type="text" value="<? echo "$t_strMaidenName"; ?>" size="50" maxlength="50"> 
                                            <input name="t_strOldMaidenName" type="hidden" id="t_strOldMaidenName" value="<? echo "$t_strMaidenName"; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Spouse Name: </td>
                                          <td><input name="t_strSpouse" type="text" value="<? echo "$t_strSpouse"; ?>" size="50" maxlength="80"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Occupation:</td>
                                          <td><input name="t_strSpouseWork" type="text" value="<? echo "$t_strSpouseWork"; ?>" size="50" maxlength="50"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Birth Date : </td>
                                          <td> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPersonal");
											echo "<SELECT NAME=\"t_strBirthMonth\">"; 
											$yyyymmdd = $t_strBirthDate;
											list($t_strBirthMonth) = array(substr($yyyymmdd,5,2));
											$objProfile->comboMonth($t_strBirthMonth);
											echo "</SELECT>";
											?>
                                            <input name="t_strOldBirthMonth" type="hidden" value="<? echo "$t_strBirthMonth"; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPersonal");
											echo "<SELECT NAME=\"t_strBirthDay\">"; 
											$yyyymmdd = $t_strBirthDate;
											list($t_strBirthDay) = array(substr($yyyymmdd,8,2));
											$objProfile->comboDay($t_strBirthDay);
											echo "</SELECT>";
											?>
                                            <input name="t_strOldBirthDay" type="hidden" value="<? echo "$t_strBirthDay"; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPersonal");
											echo "<SELECT NAME=\"t_strBirthYear\">"; 
											$yyyymmdd = $t_strBirthDate;
											list($t_strBirthYear) = array(substr($yyyymmdd,0,4));
											$objProfile->comboYearOld($t_strBirthYear);
											echo "</SELECT>";
											?>
                                            <input name="t_strOldBirthYear" type="hidden" value="<? echo $t_strBirthYear; ?>"> 
                                            <input name="t_strOldBirthDate" type="hidden" value="<? echo $t_strBirthDate; ?>"> 
                                          </td>
                                        </tr>
                                      </table>
                                      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td><hr></td>
                                        </tr>
                                      </table>
                                      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td bgcolor="#99CCFF"><div align="center">OTHER 
                                              INFORMATION </div></td>
                                        </tr>
                                      </table>
                                      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td><hr></td>
                                        </tr>
                                      </table>
                                      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td width="25%" class="paragraph">TIN 
                                            Number : </td>
                                          <td width="27%"><input name="t_strTin" type="text" value="<? echo "$t_strTin"; ?>"  size="20" maxlength="15"></td>
                                          <td width="22%" class="paragraph">Birth 
                                            Place :</td>
                                          <td width="26%"> <input name="t_strBirthPlace" type="text" value="<? echo "$t_strBirthPlace"; ?>"  size="20" maxlength="50"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Citizenship :</td>
                                          <td> <input name="t_strCitizenship" type="text" value="<? echo "$t_strCitizenship"; ?>" size="20" maxlength="10"></td>
                                          <td class="paragraph">Height :</td>
                                          <td> <input name="t_intHeight" type="text" value="<? echo "$t_intHeight"; ?>" size="20" maxlength="10"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Blood Type :</td>
                                          <td> <input name="t_strBloodType" type="text" value="<? echo "$t_strBloodType"; ?>" size="20" maxlength="2"> 
                                          </td>
                                          <td class="paragraph">Weight :</td>
                                          <td> <input name="t_intWeight" type="text" value="<? echo "$t_intWeight"; ?>" size="20" maxlength="10"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td height="19" class="paragraph">City 
                                            Number :</td>
                                          <td> <input name="t_intCityNumber" type="text" value="<? echo "$t_intCityNumber"; ?>" size="20" maxlength="4"> 
                                          </td>
                                          <td class="paragraph">City Street :</td>
                                          <td> <input name="t_strCityStreet" type="text" value="<? echo "$t_strCityStreet"; ?>" size="20" maxlength="30"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">City Brgy. :</td>
                                          <td> <input name="t_strCityBrgy" type="text" value="<? echo "$t_strCityBrgy"; ?>" size="20" maxlength="30"> 
                                          </td>
                                          <td class="paragraph">Town/Municipality 
                                            :</td>
                                          <td> <input name="t_strCityTown" type="text" value="<? echo "$t_strCityTown"; ?>" size="20" maxlength="30"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">City :</td>
                                          <td> <input name="t_strCity" type="text" value="<? echo "$t_strCity"; ?>" size="20" maxlength="30"> 
                                          </td>
                                          <td class="paragraph">Zip Code :</td>
                                          <td> <input name="t_intCityZipCode" type="text" value="<? echo "$t_intCityZipCode"; ?>" size="20" maxlength="4"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Provincial No. 
                                            :</td>
                                          <td> <input name="t_intProvNumber" type="text" value="<? echo "$t_intProvNumber"; ?>" size="20" maxlength="30"> 
                                          </td>
                                          <td class="paragraph">Provincial Street 
                                            :</td>
                                          <td> <input name="t_strProvStreet" type="text" value="<? echo "$t_strProvStreet"; ?>" size="20" maxlength="30"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Provincial Brgy.:</td>
                                          <td> <input name="t_strProvBrgy" type="text" value="<? echo "$t_strProvBrgy"; ?>" size="20" maxlength="30"> 
                                          </td>
                                          <td class="paragraph">Town/Municipality 
                                            :</td>
                                          <td> <input name="t_strProvTown" type="text" value="<? echo "$t_strProvTown"; ?>" size="20" maxlength="30"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Provincial : </td>
                                          <td> <input name="t_strProvince" type="text" value="<? echo "$t_strProvince"; ?>" size="20" maxlength="30"> 
                                          </td>
                                          <td class="paragraph">Zip Code :</td>
                                          <td> <input name="t_intProvZipCode" type="text" id="t_intProvZipCode" value="<? echo "$t_intProvZipCode"; ?>" size="20" maxlength="4"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph"> Telephone :</td>
                                          <td> <input name="t_strTelephone" type="text" value="<? echo "$t_strTelephone"; ?>" size="20" maxlength="15"> 
                                          </td>
                                          <td class="paragraph">Mobile Number 
                                            :</td>
                                          <td> <input name="t_strMobile" type="text" value="<? echo "$t_strMobile"; ?>" size="20" maxlength="15"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Father's Name 
                                            :</td>
                                          <td> <input name="t_strFatherName" type="text" value="<? echo "$t_strFatherName"; ?>" size="20" maxlength="50"> 
                                          </td>
                                          <td class="paragraph">Birth Place :</td>
                                          <td> <input name="t_strFatherBirthPlace" type="text" value="<? echo "$t_strFatherBirthPlace"; ?>" size="20" maxlength="50"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Mother's Name 
                                            :</td>
                                          <td> <input name="t_strMotherName" type="text" value="<? echo "$t_strMotherName"; ?>" size="20" maxlength="50"> 
                                          </td>
                                          <td class="paragraph">Birth Place :</td>
                                          <td> <input name="t_strMotherBirthPlace" type="text" value="<? echo "$t_strMotherBirthPlace"; ?>" size="20" maxlength="50"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Special Skills 
                                            :</td>
                                          <td> <input name="t_strSkills" type="text" value="<? echo "$t_strSkills"; ?>" size="20" maxlength="50"> 
                                          </td>
                                          <td class="paragraph">Other Qualifications 
                                            :</td>
                                          <td> <input name="t_strQualifications" type="text" value="<? echo "$t_strQualifications"; ?>" size="20" maxlength="50"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Community Tax 
                                            No. : </td>
                                          <td> <input name="t_strComTaxNumber" type="text" value="<? echo "$t_strComTaxNumber"; ?>" size="20" maxlength="15"> 
                                          </td>
                                          <td class="paragraph">Issued At :</td>
                                          <td> <input name="t_strIssuedAt" type="text" value="<? echo "$t_strIssuedAt"; ?>" size="20" maxlength="15"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td height="21" class="paragraph">Issued 
                                            On :</td>
                                          <td> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPersonal");
											echo "<SELECT NAME=\"t_strIssuedOnMonth\">"; 
											$yyyymmdd = $t_strIssuedOn;
											list($t_strIssuedOnMonth) = array(substr($yyyymmdd,5,2));
											$objProfile->comboMonth($t_strIssuedOnMonth);
											echo "</SELECT>";
											?>
                                            <input name="t_strOldIssuedOnMonth" type="hidden" id="t_strOldIssuedOnMonth" value="<? echo "$t_strIssuedOnMonth"; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPersonal");
											echo "<SELECT NAME=\"t_strIssuedOnDay\">"; 
											$yyyymmdd = $t_strIssuedOn;
											list($t_strIssuedOnDay) = array(substr($yyyymmdd,8,2));
											$objProfile->comboDay($t_strIssuedOnDay);
											echo "</SELECT>";
											?>
                                            <input name="t_strOldIssuedOnDay" type="hidden" id="t_strOldIssuedOnDay" value="<? echo "$t_strIssuedOnDay"; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPersonal");
											echo "<SELECT NAME=\"t_strIssuedOnYear\">"; 
											$yyyymmdd = $t_strIssuedOn;
											list($t_strIssuedOnYear) = array(substr($yyyymmdd,0,4));
											$objProfile->comboYear($t_strIssuedOnYear);
											echo "</SELECT>";
											?>
                                            <input name="t_strOldIssuedOnYear" type="hidden" value="<? echo "$t_strIssuedOnYear"; ?>"> 
                                            <input name="t_strOldIssuedOn" type="hidden" value="<? echo "$t_strIssuedOn"; ?>"> 
                                          </td>
                                          <td class="paragraph">Email Address 
                                            :</td>
                                          <td><input name="t_strEmail" type="text" value="<? echo "$t_strEmail"; ?>" size="20" maxlength="50"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">GSIS No.:</td>
                                          <td> <input name="t_strGSISNumber" type="text" value="<? echo "$t_strGSISNumber"; ?>" size="20" maxlength="15"> 
                                          </td>
                                          <td class="paragraph">PHILHEALTH No.:</td>
                                          <td> <input name="t_strPhilHealthNumber" type="text" value="<? echo "$t_strPhilHealthNumber"; ?>" size="20" maxlength="15"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td height="19" class="paragraph">PAGIBIG 
                                            No.:</td>
                                          <td> <input name="t_strPagibigNumber" type="text" value="<? echo "$t_strPagibigNumber"; ?>" size="20" maxlength="15"> 
                                          </td>
                                          <td class="paragraph">OPL No. 2:</td>
                                          <td> <input name="t_strOplNumber2" type="text" value="<? echo "$t_strOplNumber2"; ?>" size="20" maxlength="15"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">OPL No. 1:</td>
                                          <td> <input name="t_strOplNumber1" type="text" value="<? echo "$t_strOplNumber1"; ?>" size="20" maxlength="15"> 
                                          </td>
                                          <td class="paragraph">OPL No. 3:</td>
                                          <td> <input name="t_strOplNumber3" type="text" value="<? echo "$t_strOplNumber3"; ?>" size="20" maxlength="15"> 
                                          </td>
                                        </tr>
                                      </table>
                                      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td><hr></td>
                                        </tr>
                                      </table>
                                      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td bgcolor="#99CCFF"><div align="center"> 
                                              <input name="Submit" type="submit" value="Submit">
                                              <input name="txtSearch" type="hidden" value="<? echo $txtSearch; ?>">
                                              <input name="optField" type="hidden" value="<? echo $optField; ?>">
                                              <input name="t_strEmpNumber" type="hidden" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                              <input name="p" type="hidden" value="<? echo $p; ?>">
                                            </div></td>
                                        </tr>
                                      </table>
                                      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td><hr></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <?
								}
								?>
                                </table>
                              </form></td>
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
