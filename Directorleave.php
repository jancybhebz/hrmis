<?php 
/* 
File Name: Directorleave.php 
----------------------------------------------------------------------
Purpose of this file: 
To welcome user.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: January 23, 2004
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
include("../hrmis/class/Directorleave.php");
$objDirectorLeave = new directorLeave;
$arrEmpPersonal = $objDirectorLeave->checkGetEmpNmbr("Employee", $strEmpNmbr);

if ($Submit)
{
	//  function privilege leave
	$objDirectorLeave->addRequest($t_strEmpNumber, $cboLeaveType, "Leave", $t_strRequestStatus, $cboSpecifyLeave, $cboFromMonth, $cboFromDay, $cboFromYear, $cboToMonth, $cboToDay, $cboToYear, $txtReason, $t_dtmStatusDate);   //Add director privilege leave request
}
?>
<html><!-- InstanceBegin template="/Templates/Directorrequesttmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/class/JSgeneral.php");
?>
<script language="JavaScript">

function changeSpecific()
{
	var strEmpNmbr = "<? echo $strEmpNmbr ?>";
	var strEmpData = document.frmDirectorLeave.cboLeaveType.value;
	
	window.location = "Directorleave.php?strEmpNmbr="+strEmpNmbr+"&cboLeaveType="+strEmpData;
}

</script>

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
 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/notificationover.jpg','images/201over.jpg','images/requestclick.jpg','images/201update2.jpg','images/reports2-navigation.jpg','images/logout2.jpg'); history.forward()" onContextMenu="return false"><div align="center"> 
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr> 
    <td><table width="100%" height="426" border="0" align="center" cellpadding="0" cellspacing="0" id="INNERTBL">
        <tr> 
          <td width="59%" height="44" valign="bottom"> <img src="images/execommodule.jpg" width="169" height="23"></td>
          <td width="41%" valign="top"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="13"><table border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <div align="right"><a href="Directorinformation.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Empprofile','','images/201over.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201.jpg" alt="Empprofile" name="Empprofile" width="67" height="29" border="0"></a><a href="Director201update.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Emprequest','','images/requestclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/requestclick.jpg" alt="Emprequest" name="Emprequest" width="88" height="31" border="0"></a><a href="Directorrequeststatus.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('empNotification','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="empNotification" name="empNotification" width="96" height="29" border="0"></a> 
                  </div></td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="8" colspan="2"><div align="center">Welcome <strong><? echo $_SESSION['strLoginName']; ?></strong>. 
              You are currently working at the Director Module.</div></td>
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
                                  <td height="338" valign="top"><table width="108" height="73" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td height="13">&nbsp;</td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Director201update.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()"onMouseOver="MM_swapImage('Empupdate','','images/201update2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201update.jpg" alt="Empupdate" name="Empupdate" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Directorreport.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Empreports','','images/reports2-navigation.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports-navigation.jpg" alt="Empreports" name="Empreports" width="108" height="20" border="0"></a></td>
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
                                  <td> <form action="<? $PHP_SELF; ?>" name="frmDirectorLeave" method="post">
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr> 
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
                                              <tr> 
                                                <td width="480" height="73"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCFF">
                                                    <tr> 
                                                      <td width="141" class="paragraph">Employee 
                                                        Number : </td>
                                                      <td width="339"><strong>&nbsp;<? echo $arrEmpPersonal['empNumber']; ?> 
                                                        <input name="txtSearch" type="hidden" value="<? echo $txtSearch; ?>">
                                                        <input name="optField" type="hidden" value="<? echo $optField; ?>">
                                                        <input name="t_strEmpNumber" type="hidden" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                                        <input name="p" type="hidden" value="<? echo $p; ?>">
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
                                                <td>&nbsp;</td>
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
                                              <tr class="titlebar"> 
                                                <td colspan="4">Certify Leave 
                                                  Credits as of &nbsp;<? echo date("F d, Y"); ?></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="4" class="titlebar"> 
                                                  <?
													$intVL =  $objDirectorLeave->getLeftSLVL(date('n'), date('Y'), $strEmpNmbr, "VL");
													
													if($intVL < 0)
													{
														$intVL = 0;
													}
													
													$intSL =  $objDirectorLeave->getLeftSLVL(date('n'), date('Y'), $strEmpNmbr, "SL");									  
					
													if($intSL < 0)
													{
														$intSL = 0;						
													}
												?>
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td width="29%" class="paragraph">Sick 
                                                  Leave :</td>
                                                <td width="18%" class="titlebar"> 
                                                  <? echo number_format($intSL, 3, '.','');?> 
                                                </td>
                                                <td width="28%" class="paragraph">Vacation 
                                                  Leave :</td>
                                                <td width="25%" class="titlebar"> 
                                                  <? echo number_format($intVL, 3, '.','');?> 
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
                                                <td width="30%" class="paragraph">Type 
                                                  of Leave :</td>
                                                <td width="70%"> <strong> 
                                                  <select name="cboLeaveType" onChange="changeSpecific();">
                                                    <?
												 $objDirectorLeave->comboLeaveType($cboLeaveType, $strEmpNmbr, date('n'), date('Y'));
												?>
                                                  </select>
                                                  <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>">
                                                  </strong> </td>
                                              </tr>
                                              <tr> 
                                                <td width="31%" class="paragraph"> 
                                                  Specific Type of Leave:</td>
                                                <td width="69%"> 
                                                  <?
$objDirectorLeave->comboSpecifyLeave("cboSpecifyLeave", $cboSpecifyLeave, $cboLeaveType);   //specific leave type eg: birthday, hospital
?>
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph">Leave From 
                                                  :</td>
                                                <td><select name="cboFromMonth" size="1">
                                                    <?
										$objDirectorLeave->comboMonth(date("n"));
										?>
                                                  </select> <select name="cboFromDay" size="1">
                                                    <?
										$objDirectorLeave->comboDay(date("j"));
										?>
                                                  </select> <select name="cboFromYear" size="1">
                                                    <?
										$objDirectorLeave->comboYear(date("Y"));
									   ?>
                                                  </select></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph">Leave To 
                                                  :</td>
                                                <td><select name="cboToMonth" size="1">
                                                    <?
										$objDirectorLeave->comboMonth(date("n"));
										?>
                                                  </select> <select name="cboToDay" size="1">
                                                    <?
										$objDirectorLeave->comboDay(date("j"));
										?>
                                                  </select> <select name="cboToYear" size="1">
                                                    <?
										$objDirectorLeave->comboYear(date("Y"));
									   ?>
                                                  </select></td>
                                              </tr>
                                              <tr> 
                                                <td height="19" valign="top" class="paragraph"> 
                                                  Specify Reason(s):&nbsp;&nbsp;&nbsp;</td>
                                                <td> <textarea name="txtReason" cols="20"></textarea> 
                                                  <input name="t_strRequestStatus" type="hidden" value="<? echo "Approved"; ?>"></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"> <div align="justify"></div></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><div align="center"><strong> 
                                                    <input name="t_dtmStatusDate" type="hidden" value="<? echo date("Y-m-d"); ?>">
                                                    </strong> 
                                                    <input name="Submit" type="submit" value="Submit">
                                                    <input name="Reset" type="reset" value="Clear">
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
                                        <tr> 
                                          <td>&nbsp;</td>
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
