<?php 
/* 
File Name: Chiefleave.php 
----------------------------------------------------------------------
Purpose of this file: 
To welcome user.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco, Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: September 10, 2004
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
include("../hrmis/class/Empleave.php");
$objEmpLeave = new empLeave;
$arrEmpPersonal = $objEmpLeave->checkGetEmpNmbr("Employee", $strEmpNmbr);

if ($Submit)
{
	//  function privilege leave
	$objEmpLeave->addRequest($strEmpNumber, $cboLeaveType, "Leave", $cboSpecifyLeave, $cboMonthFrom, $cboDayFrom, $cboYearFrom, $cboMonthTo, $cboDayTo, $cboYearTo, $txtReason, $t_strRequestStatus);   //Add employee privilege leave request
}
?>
<html><!-- InstanceBegin template="/Templates/Chiefrequesttmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<? 
include("../hrmis/class/JSgeneral.php");
include("../hrmis/javascript/Leave.js");
include("../hrmis/javascript/FormValidation.js");
?>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!-- onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar()" onFocus="statusBar()"

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
 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/notificationover.jpg','images/201over.jpg','images/requestclick.jpg','images/officialbusiness2.jpg','images/201update2.jpg','images/reports2-navigation.jpg','images/leaverequest2.jpg','images/logout2.jpg','images/attendanceover.jpg'); history.forward();" onContextMenu="return false"><div align="center"> 
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr> 
    <td><table width="100%" height="426" border="0" align="center" cellpadding="0" cellspacing="0" id="INNERTBL">
        <tr> 
          <td width="59%" height="44" valign="bottom"> <img src="images/divchiefmodule.jpg" width="170" height="23"></td>
          <td width="41%" valign="top"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="13"><table border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <div align="right"><a href="Chiefinformation.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Empprofile','','images/201over.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201.jpg" alt="Empprofile" name="Empprofile" width="67" height="29" border="0"></a><a href="ChiefDTR.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Empattendance','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="Empattendance" name="Empattendance" width="88" height="29" border="0"></a><a href="ChiefOB.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Emprequest','','images/requestclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/requestclick.jpg" alt="Emprequest" name="Emprequest" width="88" height="31" border="0"></a><a href="Chiefrequeststatus.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('empNotification','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="empNotification" name="empNotification" width="96" height="29" border="0"></a> 
                  </div></td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="8" colspan="2"><div align="center">Welcome <strong><? echo $_SESSION['strLoginName']; ?></strong>. 
              You are currently working at the Division Chief Module.</div></td>
        </tr>
        <tr valign="top" bgcolor="#E9F3FE"> 
          <td height="328" colspan="2"><table width="100%" height="313" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="16%" height="313"><table width="150" height="228" border="0" cellpadding="0" cellspacing="0" bgcolor="#E9F3FE">
                    <tr> 
                      <td height="228" valign="top"><table width="100%" height="313" border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td height="313" valign="top"><table width="90%" height="338" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="NAVTBL">
                                <tr> 
                                  <td height="338" valign="top"><table width="108" height="59" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td height="13"><a href="ChiefOB.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('EmpOB','','images/officialbusiness2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/officialbusiness.jpg" name="EmpOB" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="Chiefleave.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('empLeaveRequest','','images/leaverequest2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/leaverequest.jpg" name="empLeaveRequest" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="ChiefTO.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('empTORequest','','images/travelorder2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/travelorder.jpg" name="empTORequest" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Chief201update.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Empupdate','','images/201update2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201update.jpg" name="Empupdate" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Chiefreport.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Empreports','','images/reports2-navigation.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports-navigation.jpg" name="Empreports" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr>
                                        <td><a href="index.php" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('logout','','images/logout2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/logout.jpg" alt="logout" name="logout" width="108" height="20" border="0"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
                <td width="84%" valign="top"><table width="99%" height="338" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODYTBL">
                    <tr> 
                      <td height="338"> <!-- InstanceBeginEditable name="Body" -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td height="22" class="header"><p>Leave</p></td>
                                </tr>
                                <tr> 
                                  <td height="12" class="header"> </td>
                                </tr>
                                <tr> 
                                  <td> <form action="<? $PHP_SELF; ?>" name="frmChiefLeave" method="post">
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr> 
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
                                              <tr> 
                                                <td width="480" height="73"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCFF">
                                                    <tr> 
                                                      <td width="141" class="paragraph">Employee 
                                                        Number : </td>
                                                      <td width="339"><strong>&nbsp;<? echo $arrEmpPersonal['empNumber']; ?> 
                                                        <input name="strEmpNumber" type="hidden" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                                        </strong></td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph">Employee 
                                                        Name : </td>
                                                      <td><strong>&nbsp;<? echo $arrEmpPersonal['surname']  . ", " . $arrEmpPersonal['firstname'] . "  ". $arrEmpPersonal['middlename']; ?></strong></td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph">Division 
                                                        : </td>
                                                      <td><strong>&nbsp;<? echo $arrEmpPersonal['divisionCode']; ?></strong></td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph">Position 
                                                        : </td>
                                                      <td><strong>&nbsp;<? echo $arrEmpPersonal['positionCode'] ; ?></strong></td>
                                                    </tr>
                                                  </table></td>
                                                <td width="72" bgcolor="#99CCFF"> 
                                                  <img src="Getdata.php?t_strEmpNumber=<? echo $arrEmpPersonal["empNumber"]; ?>"  width="70" height="70"></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td><hr></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td> 
                                                  <? 
											if ($Submit == 'Submit') 
											{ 
												echo "Your leave request has been submitted.";
											?>
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td></td>
                                              </tr>
                                              <tr> 
                                                <td> 
                                                  <? } else { ?>
                                                </td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                <tr> 
                                                <td><font class="note">(*) denotes required field.</font></td>
                                              </tr>
											    <tr> 
                                                <td>&nbsp;</td>
                                              </tr>
											  <tr class="titlebar"> 
                                                <td colspan="4">Certify Leave 
                                                  Credits as of &nbsp;<? echo date("F d, Y"); ?></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="4" class="titlebar"> 
												<div align="center">
                                                  <?
													$intVL =  $objEmpLeave->getLeftSLVL(date('n'), date('Y'), $strEmpNmbr, "VL");
													
													if($intVL < 0)
													{
														$intVL = 0;
													}
													
													$intSL =  $objEmpLeave->getLeftSLVL(date('n'), date('Y'), $strEmpNmbr, "SL");									  
					
													if($intSL < 0)
													{
														$intSL = 0;						
													}
													
													$intPL =  $objEmpLeave->accmltLeave($strEmpNmbr, date('Y'), "PL");
													
													if($intVL > 10)
													{
														$intFL = $objEmpLeave->accmltLeave($strEmpNmbr, date('Y'), "FL");													
													}
													else
													{
														$intFL =  0;
													}
												?>
												Vacation Leave Left: <? echo number_format($intVL, 3, '.','');?><br>
								  Sick Leave Left: <? echo number_format($intSL, 3, '.','');?><br>
								  Privilege Leave Left: <? echo number_format($intPL, 3, '.','');?><br>
								  Force Leave Left: <? echo number_format($intFL, 3, '.','');?>
								  <br></div>
                                                </td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td><hr></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td class="titlebar">Details of Application</td>
                                        </tr>
                                        <tr> 
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td width="30%" class="paragraph" height="25">Type 
                                                  of Leave :</td>
                                                <td width="70%"> <strong> 
                                                  <select name="cboLeaveType" onChange="changeSpecific('chief');">
                                                    <?
												 $objEmpLeave->comboLeaveType($cboLeaveType, $strEmpNmbr, date('n'), date('Y'));
												?>
                                                  </select>
                                                  </strong> </td>
                                              </tr>
<?
$intSpcfcLeave = $objEmpLeave->checkSpecificLeave($cboLeaveType);
if($intSpcfcLeave != 0)
{
?>
                                              <tr> 
                                                <td width="31%" class="paragraph" height="25"> 
                                                  Specific Type of Leave:</td>
                                                <td width="69%"> 
<select name="cboSpecifyLeave" onChange="changeSpecific('chief');">
<?
$objEmpLeave->comboSpecifyLeave("cboSpecifyLeave", $cboSpecifyLeave, $cboLeaveType);   //specific leave type eg: birthday, hospital
?>
</select>
                                                </td>
                                              </tr>
<?
}
?>											  
								<tr>
                                  <td height="25" valign="baseline" class="paragraph"></td>
                                  <td>
								  
<?
if($cboSpecifyLeave == 'Personal Milestone')
{
	$objEmpLeave->radioTwoOption("optLeaveDay", $optLeaveDay, "Whole day", "W", "Half day", "H", "&nbsp;&nbsp;&nbsp;", "daysApplied(cboDayFrom.selectedIndex, cboDayFrom.selectedIndex, optLeaveDay[1].checked)");
}
else
{
	$objEmpLeave->radioTwoOption("optLeaveDay", $optLeaveDay, "Whole day", "W", "Half day", "H", "&nbsp;&nbsp;&nbsp;", "daysApplied(cboDayFrom.selectedIndex, cboDayTo.selectedIndex, optLeaveDay[1].checked)");
}
?>
									</td>
								</tr>
<?
if($cboSpecifyLeave == 'Personal Milestone')
{
?>
                                              <tr> 
                                                <td height="25" class="paragraph">Leave 
                                                  :</td>
                                                <td><select name="cboYearFrom"  onChange="updateList(cboMonthFrom.selectedIndex,this[this.selectedIndex].text,'cboDayFrom')">
                                                    <?
										$objEmpLeave->comboYear(date("Y"));
									   ?>
                                                  </select>
												  <select name="cboMonthFrom" onChange="updateList(this.selectedIndex,cboYearFrom[cboYearFrom.selectedIndex].text,'cboDayFrom')">
                                                    <?
										$objEmpLeave->comboMonth(date("n"));
										?>
                                                  </select> <select name="cboDayFrom" >
                                                    <?
										$objEmpLeave->comboDay(date("j"));
										?>
                                                  </select> </td>
                                              </tr>
<?
}
else
{
?>
                                              <tr> 
                                                <td class="paragraph" height="25">Leave From 
                                                  :</td>
                                                <td><select name="cboYearFrom"  onChange="updateList(cboMonthFrom.selectedIndex,this[this.selectedIndex].text,'cboDayFrom')">
                                                    <?
										$objEmpLeave->comboYear(date("Y"));
									   ?>
                                                  </select>
												  <select name="cboMonthFrom"  onChange="updateList(this.selectedIndex,cboYearFrom[cboYearFrom.selectedIndex].text,'cboDayFrom')">
                                                    <?
										$objEmpLeave->comboMonth(date("n"));
										?>
                                                  </select> <select name="cboDayFrom" onChange="daysApplied(this.selectedIndex, cboDayTo.selectedIndex, optLeaveDay[1].checked)">
                                                    <?
										$objEmpLeave->comboDay(date("j"));
										?>
                                                  </select> </td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">Leave To 
                                                  :</td>
                                                <td><select name="cboYearTo"  onChange="updateList(cboMonthTo.selectedIndex,this[this.selectedIndex].text,'cboDayTo')">
                                                    <?
										$objEmpLeave->comboYear(date("Y"));
									   ?>
                                                  </select>
												  <select name="cboMonthTo" onChange="updateList(this.selectedIndex,cboYearTo[cboYearFrom.selectedIndex].text,'cboDayTo')">
                                                    <?
										$objEmpLeave->comboMonth(date("n"));
										?>
                                                  </select> <select name="cboDayTo" onChange="daysApplied(cboDayFrom.selectedIndex, this.selectedIndex, optLeaveDay[1].checked)">
                                                    <?
										$objEmpLeave->comboDay(date("j"));
										?>
                                                  </select> </td>
                                              </tr>
<?
}
?>											  
<tr> 
                                  <td height="19" valign="top" class="paragraph"> # of Day(s) Applied:&nbsp;&nbsp;&nbsp;</td>
                                  <td> 
								  <input type="text" name="txtDaysApp" maxlength="2" size="2" readonly value="1">
								  <font class="note">*</font>
								  </td>
                                </tr>
                                              <tr> 
                                                <td valign="top" class="paragraph" height="25"> 
                                                  Specify Reason(s):&nbsp;&nbsp;&nbsp;</td>
                                                <td> <textarea name="txtReason" cols="20" onBlur="validateAlpha(this)"></textarea>
                                                  <font class="note">* 
                                                  <input name="t_strRequestStatus" type="hidden" id="t_strRequestStatus" value="<? echo "Filed Request"; ?>">
                                                  </font></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"> <div align="justify"></div></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><div align="center"><strong> 
                                                    </strong> 
                                                    <input name="Submit" type="submit" value="Submit" onClick="trapEntryLeave()">
                                                    <input name="Reset" type="reset" value="Clear">
													<input type="button" name="print" value="Print/Preview" onClick="trapEntryLeave();openPrint()">
                                                  </div></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"> 
                                                  <? } ?>
                                                </td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td> </td>
                                        </tr>
                                      </table>
                                    </form></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table>
                        <!-- InstanceEndEditable --> </td>
                    </tr>
                  </table></td>
              </tr>
            </table> </td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="13" colspan="2"><table width="100%" height="12" border="0" cellpadding="0" cellspacing="0" bgcolor="#002E7F" id="OUTERTBL4">
              <tr> 
                <td height="12"><div align="center"> 
                    <p class="login"><font color="#FFFFFF">Copyright &copy; 2003 
                      Department of Science and Technology</font></p>
                  </div></td>
              </tr>
            </table>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
