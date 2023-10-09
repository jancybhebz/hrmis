<?php 
/* 
File Name: EmpTO.php 
----------------------------------------------------------------------
Purpose of this file: 
To add employees information to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Brian Jill DG. Sarandi
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
include("../hrmis/class/EmpTrvlOrdr.php");
$objEmpTO = new EmpTrvlOrdr;
$arrEmpPersonal = $objEmpTO->checkGetEmpNmbr("Employee", $strEmpNmbr);
if ($btnSubmit == 'Submit')
{ 	 
	$objEmpTO->addRequest($strEmpNmbr, "TO", $txtDestination, $cboYearFrom, $cboMonthFrom, $cboDayFrom, $cboYearTo, $cboMonthTo, $cboDayTo, $txtPurpose, $cboFund, $cboTranspo, $optPerdiem, $t_strRequestStatus);   //Edit employee TO
}
?>
<html><!-- InstanceBegin template="/Templates/Employeerequesttmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/class/JSgeneral.php");
include("../hrmis/javascript/TravelOrder.js");
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

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/notificationover.jpg','images/201over.jpg','images/requestclick.jpg','images/officialbusiness2.jpg','images/reports2-navigation.jpg','images/leaverequest2.jpg','images/logout2.jpg','images/attendanceover.jpg','images/201update2.jpg','images/travelorder2.jpg'); history.forward()" onContextMenu="return false"><div align="center"> 
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr> 
    <td><table width="100%" height="426" border="0" align="center" cellpadding="0" cellspacing="0" id="INNERTBL">
        <tr> 
          <td width="59%" height="44" valign="bottom"><img src="images/empmodule.jpg" width="170" height="23"> 
          </td>
          <td width="41%" valign="top"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="13"><table border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <div align="right"><a href="Employeeinformation.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Empprofile','','images/201over.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201.jpg" alt="Empprofile" name="Empprofile" width="67" height="29" border="0"></a><a href="EmpDTR.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Empattendance','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="Empattendance" name="Empattendance" width="88" height="29" border="0"></a><a href="EmpOB.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Emprequest','','images/requestclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/requestclick.jpg" alt="Emprequest" name="Emprequest" width="88" height="31" border="0"></a><a href="Empnotify.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('empNotification','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="empNotification" name="empNotification" width="96" height="29" border="0"></a> 
                  </div></td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="8" colspan="2"><div align="center">Welcome <strong><? echo $_SESSION['strLoginName']; ?></strong>. 
              You are currently working at the Employee Module.</div></td>
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
                                        <td height="13"><a href="EmpOB.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('EmpOB','','images/officialbusiness2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/officialbusiness.jpg" alt="EmpOB" name="EmpOB" width="108" height="20" border="0"></a></td>
                                      </tr>
									  <?
									  if($arrEmpPersonal["leaveEntitled"] == 'Y')
									  { 
									  ?>
                                      <tr> 
                                        <td height="20"><a href="Empleave.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('empLeaveRequest','','images/leaverequest2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/leaverequest.jpg" alt="empLeaveRequest" name="empLeaveRequest" width="108" height="20" border="0"></a></td>
                                      </tr>
									  <?
									  }
									  ?>
									  <tr> 
                                        <td><a href="EmpTO.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('travelorder','','images/travelorder2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/travelorder.jpg" alt="travelorder" name="travelorder" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Emp201update.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('201update','','images/201update2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201update.jpg" alt="201update" name="201update" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Empreport.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Empreports','','images/reports2-navigation.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports-navigation.jpg" alt="Empreports" name="Empreports" width="108" height="20" border="0"></a></td>
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
                            <td> 
                              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td height="22" class="header"><p>TRAVEL ORDER</p></td>
                                </tr>
                                <tr> 
                                  <td height="12" class="header"> </td>
                                </tr>
                                <tr> 
                                  <td> <form name="frmEmpOB" method="get" action="EmpTO.php">
                                      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
                                        <tr> 
                                          <td width="480" height="73"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCFF">
                                              <tr> 
                                                <td width="141" class="paragraph">Employee 
                                                  Number : </td>
                                                <td width="339"><strong>&nbsp;<? echo $arrEmpPersonal['empNumber']; ?> 
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
                                                <td class="paragraph">Division 
                                                  Head : </td>
                                                <td><strong>&nbsp;<? echo $arrEmpPersonal['divisionHead'] . " - " . $arrEmpPersonal['divisionHeadTitle'] ; ?></strong></td>
                                              </tr>
                                            </table></td>
                                          <td width="72" bgcolor="#99CCFF"> <img src="Getdata.php?t_strEmpNumber=<? echo $arrEmpPersonal["empNumber"]; ?>"  width="70" height="70"></td>
                                        </tr>
                                      </table>
                                      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td><hr></td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td> 
                                            <? 
											if ($btnSubmit == 'Submit') 
											{ 
												echo "Your Travel Order request has been submitted.";
											?>
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td></td>
                                        </tr>
                                        <tr> 
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td> 
                                            <?
											 } 
											 else 
											 { 
											 ?>
							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="titlebar">
							<tr> 
                                          <td colspan="2"><font class="note">(*) denotes required field.</font></td>
                                        </tr>
										<tr> 
                                          <td>&nbsp;</td>
                                        </tr>
                                      <tr><td height="10" colspan="2"></td></tr>
									  <tr> 
                                        <td align="right" class="paragraph" width="30%">Destination:&nbsp;</td>
                                    <td width="70%">
                                      <input type="text" name="txtDestination" onBlur="validateAlpha(this)">
									  <font class="note">*</font></td>
                                      </tr>									  									  
                                      <tr > 
                                        <td align="right" class="paragraph" height="25" valign="middle">Date From:&nbsp;</td>
                                        <td>Year: 
                                    <select name="cboYearFrom"  onChange="updateList(cboMonthFrom.selectedIndex,this[this.selectedIndex].text,'cboDayFrom')">
									<? 
									$objEmpTO->comboYear($cboYear);
									?>
                                    </select>&nbsp;&nbsp;&nbsp;
									Month:&nbsp;<select name="cboMonthFrom" onChange="updateList(this.selectedIndex,cboYearFrom[cboYearFrom.selectedIndex].text,'cboDayFrom')">
									<?
									$objEmpTO->comboMonth($cboMonth);
									?>																	  
                                    </select>&nbsp;&nbsp;&nbsp;
                                    Day: <select name="cboDayFrom" >
									<?
									$objEmpTO->comboDay($_SESSION['dayFrom']);
									?>									
                                    </select>
                                    </td>
                                      </tr>
                                      <tr > 
                                        <td align="right" class="paragraph" height="25" valign="middle">Date To:&nbsp;</td>
                                        <td>Year: 
                                    <select name="cboYearTo" onChange="updateList(cboMonthTo.selectedIndex,this[this.selectedIndex].text,'cboDayTo')">
									<? 
									$objEmpTO->comboYear($cboYear);									?>
                                    </select>&nbsp;&nbsp;&nbsp;
									Month:&nbsp;<select name="cboMonthTo" onChange="updateList(this.selectedIndex,cboYearFrom[cboYearTo.selectedIndex].text,'cboDayTo')">
									<?
									$objEmpTO->comboMonth($cboMonth);
									?>																	  
                                    </select>&nbsp;&nbsp;&nbsp;
                                    Day: <select name="cboDayTo">
									<?
									$objEmpTO->comboDay($_SESSION['dayTo']);
									?>									
                                    </select>
                                    </td>
                                      </tr>
                                      <tr > 
                                        <td align="right" class="paragraph" height="45">Purpose:&nbsp;</td>
                                        <td><textarea name="txtPurpose" onBlur="validateAlpha(this)"></textarea>
										<font class="note">*</font></td>
                                      </tr>
                                      <tr > 
                                        <td align="right" class="paragraph" height="25" valign="middle">Source of Fund:&nbsp;</td>
                                        <td>
										<select name="cboFund">
                                      <option value="Fund 101">Fund 101</option>
                                      <option value="Fund 202">Fund 202</option>
                                    </select>
									</td>
                                      </tr>									  
                                      <tr > 
                                        <td align="right" class="paragraph" height="25" valign="middle">Transportation:&nbsp;</td>
                                        <td>
										<select name="cboTranspo">
                                      <option value="Official Vehicle">Official 
                                      Vehicle</option>
                                      <option value="Non-agency">Non-agency</option>
                                      <option value="Personal">Personal</option>
                                    </select>
									</td>
                                      </tr>									  
                                      <tr > 
                                        <td align="right" class="paragraph" height="25" valign="middle">Will Claim Perdiem:&nbsp;</td>
                                                <td> 
                                                  <?
									  $objEmpTO->radioTwoOption("optPerdiem",$optPerdiem, "Yes", "Y", "No", "N", "&nbsp;");
									  ?>
                                                  <font class="note">
                                                  <input name="t_strRequestStatus" type="hidden" id="t_strRequestStatus" value="<? echo "Filed Request"; ?>">
                                                  </font> </td>
                                      </tr>
									  <tr >
									  <td align="center" class="title" colspan="2" height="10" valign="middle">
										<input name="strEmpNmbr" type="hidden" value="<? echo $arrEmpPersonal['empNumber']; ?>">									  </td>
									  </tr>									  									  
									<tr> 
                                        <td align="center" class="title" colspan="2" height="30" valign="middle">
										<input type="submit" name="btnSubmit" value="Submit" onClick="trapFormEntry(txtDestination, txtPurpose, cboMonthFrom, cboYearFrom, cboDayFrom, cboMonthTo, cboYearTo, cboDayTo)">
										<input type="reset" name="Reset" value="Clear">
										<input type="button" name="print" value="Print/Preview" onClick="trapFormEntry(txtDestination, txtPurpose, cboMonthFrom, cboYearFrom, cboDayFrom, cboMonthTo, cboYearTo, cboDayTo);openPrint(txtDestination, txtPurpose, cboMonthFrom, cboYearFrom, cboDayFrom, cboMonthTo, cboYearTo, cboDayTo, cboFund, cboTranspo, optPerdiem)">
										</td>
                                      </tr>									  
                                    </table>
											<?
											}
											?>
											</td>
                                        </tr>
                                        <tr> 
                                          <td> 
                                          </td>
                                        </tr>
                                      </table>
                                    </form></td>
                                </tr>
                              </table>
                            </td>
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
