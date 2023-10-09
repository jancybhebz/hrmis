<?php 
/* 
File Name: Empchildren.php
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
Date of Revision: December 19, 2003
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
include("../hrmis/class/Empchildren.php");
$objEmployee= new children;
$arrEmpPersonal = $objEmployee->checkGetEmpNmbr("Employee", $strEmpNmbr);
?>
<html><!-- InstanceBegin template="/Templates/Employeetmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
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

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/personnel2.jpg','images/education2.jpg','images/trainings2.jpg','images/servicerecords2.jpg','images/examinations2.jpg','images/legal2.jpg','images/children2.jpg','images/position2.jpg','images/reference2.jpg','images/requestsover.jpg','images/notificationover.jpg','images/logout2.jpg','images/attendanceover.jpg'); history.forward();" onContextMenu="return false"><div align="center"> 
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr> 
    <td height="397"><table width="100%" height="396" border="0" align="center" cellpadding="0" cellspacing="0" id="INNERTBL">
        <tr> 
          <td width="58%" height="44" valign="bottom"><img src="images/empmodule.jpg" width="170" height="23"> 
          </td>
          <td width="42%" valign="top"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="44"><table border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <div align="right"><a href="Empprofile.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>"><img src="images/201click.jpg" alt="emp201" name="emp201" width="67" height="29" border="0"></a><a href="EmpDTR.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Empattendance','','images/attendanceover.jpg',1)"><img src="images/attendance.jpg" alt="Empattendance" name="Empattendance" width="88" height="29" border="0"></a><a href="EmpOB.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Emprequest','','images/requestsover.jpg',1)"><img src="images/requests.jpg" alt="Emprequest" name="Emprequest" width="88" height="31" border="0"></a><a href="Empnotify.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Empnotify','','images/notificationover.jpg',1)"><img src="images/notification.jpg" alt="Empnotify" name="Empnotify" width="96" height="29" border="0"></a> 
                  </div></td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="8" colspan="2"><div align="center">Welcome <strong><? echo $_SESSION['strLoginName']; ?></strong>. 
              You are currently working at the Employee Module.</div></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="321" colspan="2" valign="top"><table width="100%" height="313" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="16%" height="313"><table width="150" height="228" border="0" cellpadding="0" cellspacing="0" bgcolor="#E9F3FE">
                    <tr> 
                      <td height="228" valign="top"><table width="100%" height="313" border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td height="313" valign="top"><table width="90%" height="313" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="NAVTBL">
                                <tr> 
                                  <td height="289" valign="top"><table width="108" height="184" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td><a href="Empprofile.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Personnel','','images/personnel2.jpg',1)"><img src="images/personnel1.jpg" alt="Personnel Profile" name="Personnel" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Empeducation.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Education','','images/education2.jpg',1)"><img src="images/education1.jpg" alt="Education" name="Education" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Emptrainings.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Trainings','','images/trainings2.jpg',1)"><img src="images/trainings1.jpg" alt="Trainings" name="Trainings" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Empservicerecords.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('ServiceRecords','','images/servicerecords2.jpg',1)"><img src="images/servicerecords1.jpg" alt="Service Records" name="ServiceRecords" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="Empexaminations.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Examinations','','images/examinations2.jpg',1)"><img src="images/examinations1.jpg" alt="Examinations" name="Examinations" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="Emplegalinfo.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('LegalInfo','','images/legal2.jpg',1)"><img src="images/legal1.jpg" alt="Legal Info" name="LegalInfo" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="Empchildren.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Children','','images/children2.jpg',1)"><img src="images/children1.jpg" alt="Children" name="Children" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="Emppositiondetails.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('PositionDetails','','images/position2.jpg',1)"><img src="images/position1.jpg" alt="Position Details" name="PositionDetails" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="10"><a href="Empreference.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Reference','','images/reference2.jpg',1)"><img src="images/reference.jpg" alt="Reference" name="Reference" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="10"><a href="index.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('logout','','images/logout2.jpg',1)"><img src="images/logout.jpg" alt="logout" name="logout" width="108" height="20" border="0"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
                <td width="84%" valign="top"><table width="99%" height="312" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODYTBL">
                    <tr> 
                      <td height="312"><!-- InstanceBeginEditable name="BODY" -->
                        <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <form method="post" action="<? $PHP_SELF; ?>" name="frmEmpChild" >
                            <tr> 
                              <td><p class="header">CHILDREN</p>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
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
                                          <td class="paragraph">Employee Name 
                                            : </td>
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
									 $objEmployee->viewChild($txtSearch, $optField, $p, $t_strChildName, $t_strChildBirthDate, $arrEmpPersonal["empNumber"]); //View list of employee children information
									 ?>
                                <br>
                              </td>
                            </tr>
                          </form>
                        </table>
                        <!-- InstanceEndEditable --></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="13" colspan="2"><table width="100%" height="12" border="0" cellpadding="0" cellspacing="0" bgcolor="#002E7F" id="OUTERTBL4">
              <tr> 
                <td height="12"><div align="center"> 
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
