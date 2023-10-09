<?php 
/* 
File Name: Legalinfo.php
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
include("../hrmis/class/Legalinfo.php");
$objLegalinfo= new legalinfo;
$objLegalinfo->trapButton($txtSearch, $strLetter, "Searchemployee.php", "Profile.php");
$objLegalinfo->setvar(array('txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>$cboMonth, 'cboYear'=>$cboYear)); //for maintain state
$arrEmpPersonal = $objLegalinfo->checkGetEmpNmbr("201", $txtSearch, $optField, $cboMonth, $cboYear, 1, $p);
//$objLegalinfo->addLegalinfo($t_strEmpNumber, $t_strRelatedThird, $t_strRelatedFourth, $t_strRelatedDegreeParticulars, $t_strAdminCase, $t_strCrimeCase, $t_strDetailsOffense, $t_strViolateLaw, $t_strViolateLawParticulars, $t_strAdminOffense, $t_strAdminOffenseParticulars, $t_strForcedResign, $t_strForcedResignParticulars, $t_strCandidate, $t_strCandidateParticulars, $t_strComTaxNumber, $t_strIssuedAt, $t_strIssuedOnMonth, $t_strIssuedOnDay,$t_strIssuedOnYear, $t_strGSISNumber, $t_strPAGIBIGNumber, $t_strPHILHEALTHNumber, $t_strOPLNumber1, $t_strOPLNumber2, $t_strOPLNumber3, $Submit);   //Load addEmployees information function
$objLegalinfo->editLegalInfo($txtSearch, $optField, $p, $t_strEmpNumber, $t_strRelatedThird, $t_strRelatedFourth, $t_strRelatedDegreeParticulars, $t_strAdminCase, $t_strCrimeCase, $t_strDetailsOffense, $t_strViolateLaw, $t_strViolateLawParticulars, $t_strAdminOffense, $t_strAdminOffenseParticulars, $t_strForcedResign, $t_strForcedResignParticulars, $t_strCandidate, $t_strCandidateParticulars, $Submit, $t_strOldEmpNumber, $t_strOldRelatedThird, $t_strOldRelatedFourth, $t_strOldRelatedDegreeParticulars, $t_strOldAdminCase, $t_strOldCrimeCase, $t_strOldDetailsOffense, $t_strOldViolateLaw, $t_strOldViolateLawParticulars, $t_strOldAdminOffense, $t_strOldAdminOffenseParticulars, $t_strOldForcedResign, $t_strOldForcedResignParticulars, $t_strOldCandidate, $t_strOldCandidateParticulars);   //Edit employee legal information
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

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/notificationover.jpg','images/attendanceover.jpg','images/reportsover.jpg','images/librariesover.jpg','images/compensationover.jpg','images/201click.jpg','images/personnel2.jpg','images/education2.jpg','images/trainings2.jpg','images/servicerecords2.jpg','images/examinations2.jpg','images/legal2.jpg','images/children2.jpg','images/position2.jpg','images/reference2.jpg','images/logout2.jpg'); history.forward()" onContextMenu="return false"><div align="center"> 
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
                                        <td><a href="Profile.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Personnel','','images/personnel2.jpg',1)"><img src="images/personnel1.jpg" alt="Personnel Profile" name="Personnel" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Education.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Education','','images/education2.jpg',1)"><img src="images/education1.jpg" alt="Education" name="Education" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Trainings.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Trainings','','images/trainings2.jpg',1)"><img src="images/trainings1.jpg" alt="Trainings" name="Trainings" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Servicerecords.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('ServiceRecords','','images/servicerecords2.jpg',1)"><img src="images/servicerecords1.jpg" alt="Service Records" name="ServiceRecords" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="Examinations.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Examinations','','images/examinations2.jpg',1)"><img src="images/examinations1.jpg" alt="Examinations" name="Examinations" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="Legalinfo.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('LegalInfo','','images/legal2.jpg',1)"><img src="images/legal1.jpg" alt="Legal Info" name="LegalInfo" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="Children.php?txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Children','','images/children2.jpg',1)"><img src="images/children1.jpg" alt="Children" name="Children" width="108" height="20" border="0"></a></td>
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
                            <td height="326"><p class="header">LEGAL INFORMATION</p>
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
							  $objLegalinfo->viewLegalInfo($txtSearch, $optField, $p, $t_strRelatedThird, $t_strRelatedFourth, $t_strRelatedDegreeParticulars, $t_strAdminCase, $t_strCrimeCase, $t_strDetailsOffense, $t_strViolateLaw, $t_strViolateLawParticulars, $t_strAdminOffense, $t_strAdminOffenseParticulars, $t_strForcedResign, $t_strForcedResignParticulars, $t_strCandidate, $t_strCandidateParticulars, $arrEmpPersonal["empNumber"]);   //view employee Legal Information
							  ?>
                              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td><div align="right"> 
                                      <? $objLegalinfo->output();?>
                                    </div></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                              </table> 
                              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                              <?
							  if($Submit == 'EDIT')
							  {
							  ?>
                                  <tr> 
                                    <td width="820" colspan="2" class="header">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td colspan="2">
									<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <form method=post action="<? $PHP_SELF; ?>" name="frmLegalInfo">
                                        <tr> 
                                          <td width="29%" height="91">Related 
                                            by consanguinity or affinity to the 
                                            appointing or recommending authority, 
                                            or to the chief bureau or office or 
                                            to the person who has immediate supervision 
                                            over you in the office, bureau or 
                                            department where you will be appointed. 
                                            <br>
                                            Within the third degree? 
                                            <?
									  if($t_strRelatedThird == "Y" || $t_strRelatedThird == "")
									  {
									  	echo "<input name='t_strRelatedThird' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strRelatedThird' type='radio' value='Y'>";
									  }
									  ?>
                                            Yes 
                                            <?
									  if($t_strRelatedThird == "N")
									  {
									  	echo "<input name='t_strRelatedThird' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strRelatedThird' type='radio' value='N'>";
									  }
									  ?>
                                            No 
                                            <input type="hidden" name="t_strOldRelatedThird" value="<? echo $t_strRelatedThird; ?>"> 
                                            <br>
                                            Within the fourth degree (for local 
                                            Government)? 
                                            <?
									  if($t_strRelatedFourth == "Y" || $t_strRelatedFourth == "")
									  {
									  	echo "<input name='t_strRelatedFourth' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strRelatedFourth' type='radio' value='Y'>";
									  }
									  ?>
                                            Yes 
                                            <?
									  if($t_strRelatedFourth == "N")
									  {
									  	echo "<input name='t_strRelatedFourth' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strRelatedFourth' type='radio' value='N'>";
									  }
									  ?>
                                            No 
                                            <input name="t_strOldRelatedFourth" type="hidden" value="<? echo $t_strRelatedFourth; ?>"> 
                                            <br>
                                            Particulars 
                                            <input name="t_strRelatedDegreeParticulars" type="text" value="<? echo $t_strRelatedDegreeParticulars; ?>"  size="80" maxlength="100"> 
                                            <input name="t_strOldRelatedDegreeParticulars" type="hidden" value="<? echo $t_strRelatedDegreeParticulars; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td><hr></td>
                                        </tr>
                                        <tr> 
                                          <td height="61">With Pending<br>
                                            administrative case? 
                                            <?
									  if($t_strAdminCase == "Y" || $t_strAdminCase == "")
									  {
									  	echo "<input name='t_strAdminCase' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strAdminCase' type='radio' value='Y'>";
									  }
									  ?>
                                            Yes 
                                            <?
									  if($t_strAdminCase == "N")
									  {
									  	echo "<input name='t_strAdminCase' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strAdminCase' type='radio' value='N'>";
									  }
									  ?>
                                            No 
                                            <input name="t_strOldAdminCase" type="hidden" value="<? echo $t_strAdminCase; ?>"> 
                                            <br>
                                            criminal case? 
                                            <?
									  if($t_strCrimeCase == "Y" || $t_strCrimeCase == "")
									  {
									  	echo "<input name='t_strCrimeCase' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strCrimeCase' type='radio' value='Y'>";
									  }
									  ?>
                                            Yes 
                                            <?
									  if($t_strCrimeCase == "N")
									  {
									  	echo "<input name='t_strCrimeCase' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strCrimeCase' type='radio' value='N'>";
									  }
									  ?>
                                            No 
                                            <input name="t_strOldCrimeCase" type="hidden" value="<? echo $t_strCrimeCase; ?>"> 
                                            <br>
                                            Details of the offense 
                                            <input name="t_strDetailsOffense" type="text" value="<? echo $t_strDetailsOffense; ?>" size="67" maxlength="100"> 
                                            <input name="t_strOldDetailsOffense" type="hidden" value="<? echo $t_strDetailsOffense; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td><hr></td>
                                        </tr>
                                        <tr> 
                                          <td height="15"> Convicted of any crime 
                                            or violation of any law, decree, ordinance 
                                            or regulations by any court or tribunal.<br>
                                            <?
									  if($t_strViolateLaw == "Y" || $t_strViolateLaw == "")
									  {
									  	echo "<input name='t_strViolateLaw' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strViolateLaw' type='radio' value='Y'>";
									  }
									  ?>
                                            Yes 
                                            <?
									  if($t_strViolateLaw == "N")
									  {
									  	echo "<input name='t_strViolateLaw' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strViolateLaw' type='radio' value='N'>";
									  }
									  ?>
                                            No 
                                            <input name="t_strOldViolateLaw" type="hidden" id="t_strOldViolateLaw" value="<? echo $t_strViolateLaw; ?>"> 
                                            <br>
                                            Particulars 
                                            <input name="t_strViolateLawParticulars" type="text" value="<? echo $t_strViolateLawParticulars; ?>" size="80" maxlength="100"> 
                                            <input name="t_strOldViolateLawParticulars" type="hidden" value="<? echo $t_strViolateLawParticulars; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td height="13"><hr></td>
                                        </tr>
                                        <tr> 
                                          <td> Convicted of any administrative 
                                            offense 
                                            <?
									  if($t_strAdminOffense == "Y" || $t_strAdminOffense == "")
									  {
									  	echo "<input name='t_strAdminOffense' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strAdminOffense' type='radio' value='Y'>";
									  }
									  ?>
                                            Yes 
                                            <?
									  if($t_strAdminOffense == "N")
									  {
									  	echo "<input name='t_strAdminOffense' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strAdminOffense' type='radio' value='N'>";
									  }
									  ?>
                                            No 
                                            <input name="t_strOldAdminOffense" type="hidden" id="t_strOldAdminOffense" value="<? echo $t_strAdminOffense; ?>"> 
                                            <br>
                                            Particulars 
                                            <input name="t_strAdminOffenseParticulars" type="text" value="<? echo $t_strAdminOffenseParticulars; ?>" size="80" maxlength="100"> 
                                            <input name="t_strOldAdminOffenseParticulars" type="hidden" value="<? echo $t_strAdminOffenseParticulars; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td><hr></td>
                                        </tr>
                                        <tr> 
                                          <td height="16"> Retired, force to resign 
                                            or drop from employment in the public 
                                            or private sector. 
                                            <?
									  if($t_strForcedResign == "Y" || $t_strForcedResign == "")
									  {
									  	echo "<input name='t_strForcedResign' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strForcedResign' type='radio' value='Y'>";
									  }
									  ?>
                                            Yes 
                                            <?
									  if($t_strForcedResign == "N")
									  {
									  	echo "<input name='t_strForcedResign' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strForcedResign' type='radio' value='N'>";
									  }
									  ?>
                                            No 
                                            <input name="t_strOldForcedResign" type="hidden" id="t_strOldForcedResign" value="<? echo $t_strForcedResign; ?>"> 
                                            <br>
                                            Particulars 
                                            <input name="t_strForcedResignParticulars" type="text" id="t_strForcedResignParticulars" value="<? echo $t_strForcedResignParticulars; ?>" size="80" maxlength="100"> 
                                            <input name="t_strOldForcedResignParticulars" type="hidden" id="t_strOldForcedResignParticulars" value="<? echo $t_strForcedResignParticulars; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td height="17"><hr></td>
                                        </tr>
                                        <tr> 
                                          <td> Been a candidate in a national 
                                            or local election (except barangay 
                                            election) . 
                                            <?
									  if($t_strCandidate == "Y" || $t_strCandidate == "")
									  {
									  	echo "<input name='t_strCandidate' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strCandidate' type='radio' value='Y'>";
									  }
									  ?>
                                            Yes 
                                            <?
									  if($t_strCandidate == "N")
									  {
									  	echo "<input name='t_strCandidate' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strCandidate' type='radio' value='N'>";
									  }
									  ?>
                                            No
<input name="t_strOldCandidate" type="hidden" id="t_strOldCandidate" value="<? echo $t_strCandidate; ?>"> 
                                            <br>
                                            Particulars 
                                            <input name="t_strCandidateParticulars" type="text" id="t_strCandidateParticulars" value="<? echo $t_strCandidateParticulars; ?>" size="80" maxlength="100"> 
                                            <input name="t_strOldCandidateParticulars" type="hidden" id="t_strOldCandidateParticulars" value="<? echo $t_strCandidateParticulars; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td><hr></td>
                                        </tr>
                                        <tr> 
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td><div align="center"> 
                                              <input name="Submit" type="submit" value="Submit">
                                            </div></td>
                                        </tr>
                                      </form>
                                    </table>
									  </td>
                                  </tr>
                                  <tr> 
                                    <td height="1" colspan="2"><div align="right"></div></td>
                                  </tr>
                                  <tr> 
                                    <td height="4" colspan="2"><div align="center"> 
                                      </div></td>
                                  </tr>
                              </table>
                            </td>
                          </tr>
						  <?
						  }
						  ?>
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
