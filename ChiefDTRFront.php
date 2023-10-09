<?
/* 
File Name: ChiefDTRFront.php 
----------------------------------------------------------------------
Purpose of this file: 
Contains instructions on how to use the search facility.
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
include("../hrmis/class/Attendance.php");
$objAttendance = new Attendance;
if (strlen($cboMonth) == 0)
{
	$cboMonth = date('n');
}
if (strlen($cboYear) == 0)
{
	$cboYear = date('Y');
}
$objAttendance->setvar(array('txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>$cboMonth, 'cboYear'=>$cboYear, 'strLetter'=>$strLetter, 'strEmpNmbr'=>$strEmpNmbr)); //for maintain state
$strDvsnCode = $objAttendance->getChiefDivision($strEmpNmbr);
$arrEmpPersonal =$objAttendance->checkGetEmpNmbr("Employee", $strEmpNmbr);
?>
<html><!-- InstanceBegin template="/Templates/Chiefattendancetmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/class/JSgeneral.php");
?>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
// onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar()" onFocus="statusBar()"

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

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/201over.jpg','images/requestsover.jpg','images/attendanceclick.jpg','images/notificationover.jpg','images/dtr2.jpg','images/logout2.jpg','images/printdtr2.jpg'); history.forward()" onContextMenu="return false"><div align="center"> 
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
                  <div align="right"><a href="Chiefinformation.php?strEmpNmbr=<? echo $strEmpNmbr; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('Empprofile','','images/201over.jpg',1); statusBar(); return true;"><img src="images/201.jpg" alt="Empprofile" name="Empprofile" width="67" height="29" border="0"></a><a href="ChiefDTRFront.php?strEmpNmbr=<? echo $strEmpNmbr; ?>" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Empattendance','','images/attendanceclick.jpg',1); statusBar(); return true;"><img src="images/attendanceclick.jpg" alt="Empattendance" name="Empattendance" width="88" height="29" border="0"></a><a href="ChiefOB.php?strEmpNmbr=<? echo $strEmpNmbr; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('Emprequest','','images/requestsover.jpg',1); statusBar(); return true;"><img src="images/requests.jpg" alt="Emprequest" name="Emprequest" width="88" height="31" border="0"></a><a href="Chiefrequeststatus.php?strEmpNmbr=<? echo $strEmpNmbr; ?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('Empnotify','','images/notificationover.jpg',1); statusBar(); return true;"><img src="images/notification.jpg" alt="Empnotify" name="Empnotify" width="96" height="29" border="0"></a> 
                  </div></td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="8" colspan="2"><div align="center">Welcome <strong><? echo $arrEmpPersonal['firstname']  . "  " . $arrEmpPersonal['middlename'] . "  ". $arrEmpPersonal['surname']; ?></strong>. 
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
                                  <td height="338" valign="top"><table width="90%" height="161" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td height="13">&nbsp;</td>
                                      </tr>
                                <tr> 
                                  <td height="78" valign="top">
								  <form name="frmAttendance" method="get" action="ChiefDTR.php">
                                      <input name="txtSearch" type="text" id="txtSearch" size="10" maxlength="30" value="<? echo $txtSearch;?>">
                                      <a href="ChiefDTR.php" onMouseOut="" onMouseOver=""><input type="image" src="images/go.jpg" alt="Go" name="Go" width="19" height="17" border="0" align="absmiddle" onClick="checkDate();"></a> 
                                      <br>
									  <?
									  $objAttendance->radioTwoOption("optField",$optField, "Empolyee Number", "empNmbr", "Employee Name", "empName", "<br>");
									  ?><input type="hidden" name="strEmpNmbr" value="<? echo $strEmpNmbr?>">
                                            <br>
                                      Month 
                                      <select name="cboMonth" size="1">
										<?
										$objAttendance->comboMonth($cboMonth);
										?>
                                      </select>
                                      <br>
                                      Year&nbsp;&nbsp; 
                                      <select name="cboYear" size="1">
										<?
										$objAttendance->comboYear($cboYear);										
										?>
                                      </select>
                                      <br>
                                    </form></td>
                                </tr>									  
                                      <tr> 
                                        <td height="66"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tr> 
                                              <td>&nbsp;</td>
                                            </tr>
                                            <tr> 
                                              <td><a href="ChiefDTR.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('dtr','','images/dtr2.jpg',1); statusBar(); return true;"><img src="images/dtr.jpg" alt="dtr" name="dtr" width="108" height="20" border="0"></a></td>
                                            </tr>
                                            <tr>  
                                              <td><a href="ChiefDTRPrint.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('printdtr','','images/printdtr2.jpg',1); statusBar(); return true;"><img src="images/printdtr.jpg" alt="printdtr" name="printdtr" width="108" height="20" border="0"></a></td>
                                            </tr>
                                            <tr> 
                                              <td><a href="index.php" onMouseOut="MM_swapImgRestore()" onClick="statusBar();" onMouseUp="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('logout','','images/logout2.jpg',1); statusBar(); return true;"><img src="images/logout.jpg" alt="logout" name="logout" width="108" height="20" border="0"></a></td>
                                            </tr>
                                          </table></td>
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
						<tr><td height="21"></td></tr>
					  <tr><td>								
					  		<p align="center">
								  <?
								  if(strlen($cboMonth) == 0 && strlen($cboYear) == 0)
								  {
								  	$cboMonth = date('n');
									$cboYear = date('Y');
								  }
								  $objAttendance->navigateEmployee($cboMonth, $cboYear,  'ChiefDTR.php', $strDvsnCode);
								  ?>								
								</p>
						</td></tr>	
						<tr><td height="21"></td></tr>					
					  <tr>
					  <td align="center">
                        <table width="90%" border="0" cellspacing="0" cellpadding="0">
						<tr><td  valign="top" class="errorsearch">
                          To browse the Employee Attendance 
                          Record:<br>
                              <ul>
                                
                            <li> Search desired employee name or employee number 
                              on the search inteface located on the left hand 
                              side of the screen.<br><br>
                                  </li>
                                
                            <li> Navigate the links A-Z by selecting the starting 
                              letter of the desired employee surname.<br>
                                </li>
                              </ul>
							  </td>
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
