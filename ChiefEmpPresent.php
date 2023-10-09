<?
/* 
File Name: ChiefEmpPresent.php 
----------------------------------------------------------------------
Purpose of this file: 
To view the present employees in the office under the chief.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: May 21, 2004
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
require("../hrmis/class/Chiefnotifyleave.php");
require("../hrmis/class/LoginDTR.php");
$objLog = new LoginDTR;
$objLog->setvar(array("strEmpNmbr"=>$strEmpNmbr, 'strOrder'=>$strOrder)); //for maintain state
$objChief = new chiefNotifyLeave;
$arrEmpPersonal = $objChief->checkGetEmpNmbr("Employee", $strEmpNmbr);
$strDvsnCode = $objChief->getChiefDivision($strEmpNmbr);
?>
<html><!-- InstanceBegin template="/Templates/Chiefnotificationtmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/class/JSgeneral.php");
?>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!-- onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar()" onFocus="statusBar()"

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

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/201over.jpg','images/attendanceover.jpg','images/notificationclick.jpg','images/requestsover.jpg','images/logout2.jpg'); history.forward();" onContextMenu="return false"><div align="center"> 
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
                  <div align="right"><a href="Chiefinformation.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Empprofile','','images/201over.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201.jpg" alt="Empprofile" name="Empprofile" width="67" height="29" border="0"></a><a href="ChiefDTR.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Empattendance','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="Empattendance" name="Empattendance" width="88" height="29" border="0"></a><a href="ChiefOB.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Emprequest','','images/requestsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/requests.jpg" alt="Emprequest" name="Emprequest" width="88" height="31" border="0"></a><a href="Chiefrequeststatus.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Empnotify','','images/notificationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notificationclick.jpg" alt="Empnotify" name="Empnotify" width="96" height="29" border="0"></a> 
                  </div></td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="8" colspan="2"><div align="center">Welcome <strong><? echo $_SESSION['strLoginName']; ?></strong>. 
              You are currently working at the Division Chief Module.</div></td>
        </tr>
        <tr valign="top" bgcolor="#E9F3FE"> 
          <td height="328" colspan="2"><table width="100%" height="313" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="19%" height="313"><table width="150" height="228" border="0" cellpadding="0" cellspacing="0" bgcolor="#E9F3FE">
                    <tr> 
                      <td height="228" valign="top"><table width="95%" height="313" border="0" align="right" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td height="313" valign="top"><table width="100%" height="338" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="NAVTBL">
                                <tr> 
                                  <td height="338" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr> 
                                        <td><table width="95%" height="47" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                            <tr> 
                                              <td height="3"><img src="images/tasks.jpg" width="64" height="24"></td>
                                            </tr>
                                            <tr> 
                                              <td height="3"> 
                                                <?php 
								//Leave Request Module
								include("../hrmis/class/Connect.php");
								
								$objDivCode = mysql_query("SELECT divisionCode FROM tblEmpPosition 
												WHERE empNumber='$strEmpNmbr'");
								$arrDivCode = mysql_fetch_array($objDivCode);
								$strDivCode = $arrDivCode['divisionCode'];
								$strRequestStatus = "Filed Request";
								
		 $objCntOB = mysql_query("SELECT COUNT(tblEmpRequest.requestCode) AS countOB
		 								FROM tblEmpRequest 
										INNER JOIN tblEmpPersonal 
											ON tblEmpRequest.empNumber=tblEmpPersonal.empNumber 
										INNER JOIN tblEmpPosition 
											ON tblEmpPersonal.empNumber=tblEmpPosition.empNumber 
										WHERE tblEmpRequest.statusDate = '0000-00-00' 
											AND tblEmpRequest.requestCode LIKE 'OB' 
											AND tblEmpRequest.requestStatus = '$strRequestStatus' 
											AND tblEmpPosition.divisionCode = '$strDivCode' 
											AND tblEmpPersonal.empNumber != '$strEmpNmbr'");
			$arrCntOB = mysql_fetch_array($objCntOB);
			$intCntOB = $arrCntOB['countOB'];
			
		$objCntLeave = mysql_query("SELECT COUNT(tblEmpRequest.requestCode) AS countLeave 
									 FROM tblEmpRequest 
									 	INNER JOIN tblEmpPersonal 
											ON tblEmpRequest.empNumber=tblEmpPersonal.empNumber 
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber=tblEmpPosition.empNumber 
									WHERE tblEmpRequest.statusDate = '0000-00-00' 
											AND tblEmpRequest.requestCode LIKE 'Leave' 
											AND tblEmpRequest.requestStatus = '$strRequestStatus' 
											AND tblEmpPosition.divisionCode = '$strDivCode'
											AND tblEmpPersonal.empNumber != '$strEmpNmbr'");
		$arrCntLeave = mysql_fetch_array($objCntLeave);
		$intCntLeave = $arrCntLeave['countLeave'];
		
		$objCntTO = mysql_query("SELECT COUNT(tblEmpRequest.requestCode) AS countTO 
									 FROM tblEmpRequest 
									 	INNER JOIN tblEmpPersonal 
											ON tblEmpRequest.empNumber=tblEmpPersonal.empNumber 
										INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber=tblEmpPosition.empNumber 
									WHERE tblEmpRequest.statusDate = '0000-00-00' 
											AND tblEmpRequest.requestCode LIKE 'TO' 
											AND tblEmpRequest.requestStatus = '$strRequestStatus' 
											AND tblEmpPosition.divisionCode = '$strDivCode'
											AND tblEmpPersonal.empNumber != '$strEmpNmbr'");
		$arrCntTO = mysql_fetch_array($objCntTO);
		$intCntTO = $arrCntTO['countTO'];
								
								if ($intCntLeave <> 0){ 
								// if number of entries is more than 1
								printf("<a href=\"Chiefnotifyleave.php?strEmpNmbr=$strEmpNmbr\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf($intCntLeave ); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Leave Request");
								printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
								printf("{&nbsp;");
								printf("0"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Leave Request");
								printf("</a>");
								} 
								
								?>
                                              </td>
                                            </tr>
                                            <tr> 
                                              <td height="3"> 
                                                <?
								
								if ($intCntOB  <> 0){ 
								// if number of entries is more than 1
								printf("<a href=\"ChiefnotifyOB.php?strEmpNmbr=$strEmpNmbr\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf($intCntOB); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("OB Request");
								printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
								printf("{&nbsp;");
								printf("0"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("OB Request");
								printf("</a>");
								} 
								
								?>
                                              </td>
                                            </tr>
                                            <tr> 
                                              <td height="3"> 
                                                <?
								
								if ($intCntTO  <> 0){ 
								// if number of entries is more than 1
								printf("<a href=\"ChiefnotifyTO.php?strEmpNmbr=$strEmpNmbr\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
								printf("{&nbsp;");
								printf($intCntTO); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Travel Order");
								printf("</a>");
								} 
								// if number of entries is less than 1 
								else { 
								printf("{&nbsp;");
								printf("0"); //prints number 
								printf("&nbsp;}");
								printf("&nbsp;&nbsp;");
								printf("Travel Order");
								printf("</a>");
								} 
								
								?>
                                              </td>
                                            </tr>
                                            <tr> 
                                              <td height="1">&nbsp;</td>
                                            </tr>
                                            <tr>
                                              <td height="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                              <td height="3">&nbsp;</td>
                                            </tr>
                                            <tr> 
                                              <td height="3"><img src="images/reminders.jpg" width="93" height="32"></td>
                                            </tr>
                                            <tr> 
                                              <td height="1"> 
                                                <?
										printf("<a href=\"ChiefEmpPresent.php?strEmpNmbr=$strEmpNmbr\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar();\" onFocus=\"statusBar();\">");
										printf("Employees Present");
										printf("</a>");
										?>
                                              </td>
                                            </tr>
                                            <tr> 
                                              <td height="1"> 
                                                <?
										printf("<a href=\"ChiefEmpAbsent.php?strEmpNmbr=$strEmpNmbr\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">");
										printf("Employees Absent");
										printf("</a>");
										?>
                                              </td>
                                            </tr>
                                            <tr> 
                                              <td height="1"> 
                                                <?
										printf("&nbsp;<a href=\"ChiefEmpOnLeave.php?strEmpNmbr=$strEmpNmbr\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">Employees On Leave</a>");
										?>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td height="1"> 
                                                <?
										printf("&nbsp;<a href=\"ChiefEmpOnObToTt.php?strEmpNmbr=$strEmpNmbr\" onMouseOver=\"statusBar(); return true;\" onClick=\"statusBar();\" onMouseUp=\"statusBar()\" onFocus=\"statusBar()\">Employees On OB/TO/TT</a>");
										?>
                                              </td>
                                            </tr>
                                            <tr> 
                                              <td height="2">&nbsp;</td>
                                            </tr>
                                            <tr> 
                                              <td height="3">&nbsp;</td>
                                            </tr>
                                            <td height="20"><div align="center"><a href="index.php" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('logout','','images/logout2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/logout.jpg" alt="logout" name="logout" width="108" height="20" border="0"></a></div></td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                    </table> </td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
                <td width="81%" valign="top"><table width="98%" height="338" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODYTBL">
                    <tr> 
                      <td height="338"> <!-- InstanceBeginEditable name="Body" -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr height="30" valign="middle" class="header">
                            <td colspan="4">EMPLOYEES PRESENT FOR THE DAY</td>
                          </tr>
							<tr>
							<td width="20%"></td>
							<td width="40%" height="20"><a href="ChiefEmpPresent.php?strEmpNmbr=<? echo $strEmpNmbr?>&strOrder=name" onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar()" onFocus="statusBar()">Employee Name</a></td>
							<td width="30%" height="20"><a href="ChiefEmpPresent.php?strEmpNmbr=<? echo $strEmpNmbr?>&strOrder=time" onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar()" onFocus="statusBar()">Time In</a></td>
							<td width="10%"></td>
							</tr>
							<?
							$objLog->empInside($strOrder, 10, $p, $strDvsnCode);
							?>
							<tr><td height="20" colspan="4" align="center"><? $objLog->output();?></td></tr>
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
