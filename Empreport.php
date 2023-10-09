<?php 
/* 
File Name: Empreport.php 
----------------------------------------------------------------------
Purpose of this file: 
To employee report request.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: January 15, 2004
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
include("../hrmis/class/Empreport.php");
$objEmpReport = new empReport;
$arrEmpPersonal = $objEmpReport->checkGetEmpNmbr("Employee", $strEmpNmbr);

if ($t_strEmpReport == 'DTR') 
{
	// Function DTR Report 
	$objEmpReport->addDTR($t_strEmpNumber, $t_strEmpReport, $t_strReportRequestCode, $t_dtmDTRMonth, $t_dtmDTRYear, $t_dtmStatusDate, $t_strRequestStatus, $Submit);   //Add employee daily time record on table employee request
} elseif ($t_strEmpReport == 'Remittance') 
{
	//	Function Remittances Report Request
	$objEmpReport->addRemittances($t_strEmpNumber, $t_strEmpReport, $t_strReportRequestCode, $t_strRemittanceDesc, $t_dtmRemittanceMonth, $t_dtmRemittanceYear, $t_dtmStatusDate, $t_strRequestStatus, $Submit);  //Add employee remittances report request
} elseif ($t_strEmpReport == 'Payslip') 
{
	//	Function Payslip Report Request
	$objEmpReport->addPayslip($t_strEmpNumber, $t_strEmpReport, $t_strReportRequestCode, $t_dtmPayslipMonth, $t_dtmPayslipYear, $t_dtmStatusDate, $t_strRequestStatus, $Submit);   //Add employee payslip request
} elseif ($t_strEmpReport == 'CEC')
{
	// Function Certificate of Compensation Request
	$objEmpReport->addCEC($t_strEmpNumber, $t_strEmpReport, $t_strCECRequestCode, $t_dtmCECMonth, $t_dtmCECYear, $t_dtmStatusDate, $t_strRequestStatus, $Submit);   //Add employee certificate of compensation request 
} elseif ($t_strEmpReport == 'SR')
{
	// Function Certificate of Compensation Request
	$objEmpReport->addServiceRecord($t_strEmpNumber, $t_strEmpReport, $t_strCECRequestCode, $t_dtmStatusDate, $t_strRequestStatus, $Submit);   //Add employee certificate of compensation request 
}
?>
<html><!-- InstanceBegin template="/Templates/Employeerequesttmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/class/JSgeneral.php");
?>
<script language="JavaScript">

function reportRequirement()
{
	var strEmpNmbr = "<? echo $strEmpNmbr ?>";
	var strEmpData = document.frmEmpReport.t_strEmpReport.value;
	
	window.location = "Empreport.php?strEmpNmbr="+strEmpNmbr+"&t_strEmpReport="+strEmpData;
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
							<form action="<? $PHP_SELF; ?>" method="post" name="frmEmpReport">
							    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td height="22" class="header"><p>REPORTS</p></td>
                                  </tr>
                                  <tr> 
                                    <td>&nbsp;</td>
                                  </tr>
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
                                                <td class="paragraph">Division 
                                                  Head : </td>
                                                <td><strong>&nbsp;<? echo $arrEmpPersonal['divisionHead'] . " - " . $arrEmpPersonal['divisionHeadTitle'] ; ?></strong></td>
                                              </tr>
                                            </table></td>
                                          <td width="72" bgcolor="#99CCFF"> <img src="Getdata.php?t_strEmpNumber=<? echo $arrEmpPersonal["empNumber"]; ?>"  width="70" height="70"></td>
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
										  	echo "Your report request has been submitted.";
										  ?>
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td> 
                                            <?
										  } else {
										  ?>
                                          </td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td width="30%" class="paragraph">Type 
                                            of Reports : </td>
                                          <td width="70%"> <select name="t_strEmpReport" size="1" onChange="reportRequirement();">
                                              <option>Select Report Type ...</option>
                                              <?
													if($t_strEmpReport == 'DTR')
													{
													?>
                                              <option value="DTR" selected>Daily 
                                              Time Record</option>
                                              <?
													}else
													{
													?>
                                              <option value="DTR">Daily Time Record</option>
                                              <?
													}
													?>
											<?
													if($t_strEmpReport == 'SR')
													{
													?>
                                              <option value="SR" selected>Service Record</option>
                                              <?
													}else
													{
													?>
                                              <option value="SR">Service Record</option>
                                              <?
													}
													?>
                                              <? 
													if($t_strEmpReport == 'Remittance')
													{
													?>
                                              <option value="Remittance" selected>Remittances</option>
                                              <?
													} else 
													{
													?>
                                              <option value="Remittance">Remittances</option>
                                              <?
													}
													?>
                                              <?
													if($t_strEmpReport == 'Payslip')
													{
													?>
                                              <option value="Payslip" selected>Payslip</option>
                                              <?
													} else
													{
													?>
                                              <option value="Payslip">Payslip</option>
                                              <?
													}
													?>
                                              <?
													if($t_strEmpReport == 'CEC')
													{
													?>
                                              <option value="CEC" selected>Certificate 
                                              of Compensation</option>
                                              <?
													} else
													{
													?>
                                              <option value="CEC">Certificate 
                                              of Compensation</option>
                                              <?
													}
													?>
                                            </select> <strong> </strong> <strong> 
                                            <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>">
                                            </strong> </td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td> 
                                      <? //Daily Time Record 
if ($t_strEmpReport == 'DTR') 
{
?>
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr class="title"> 
                                          <td colspan="4"> 
                                            <!-- Daily Time Record -->
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td width="35%" class="paragraph"> Month 
                                            : </td>
                                          <td width="16%"> <select name="t_dtmDTRMonth" size="1">
                                              <?
													$objEmpReport->comboMonth(date('n'));
													?>
                                            </select> </td>
                                          <td width="8%" class="paragraph">Year 
                                            : </td>
                                          <td width="41%"> <select name="t_dtmDTRYear" size="1">
                                              <?
													$objEmpReport->comboYear(date('Y'));
												   	?>
                                            </select>
                                            <input name="t_strRequestStatus" type="hidden" id="t_strRequestStatus" value="<? echo "Filed Request"; ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">&nbsp;</td>
                                          <td colspan="3">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"> <div align="justify"></div></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"><div align="center"><strong> 
                                              <input name="t_dtmStatusDate" type="hidden" id="t_dtmStatusDate" value="<? echo date("Y-m-d"); ?>">
                                              </strong> 
                                              <input name="Submit" type="submit" value="Submit">
                                              <input name="Reset" type="reset" value="Clear">
                                            </div></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td> 
                                      <? // Remittances  
	} elseif ($t_strEmpReport == 'Remittance') 
	{
?>
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr class="title"> 
                                          <td colspan="4"> 
                                            <!-- Remittances -->
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td width="31%" class="paragraph">Type 
                                                  of Remittances : </td>
                                                <td width="69%"> 
                                                  <? 
										  	$objEmpReport->comboRemittances(t_strRemittanceDesc);
										  	?>
                                                </td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr>
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td width="35%" class="paragraph">Month 
                                            : </td>
                                          <td width="16%"> <select name="t_dtmRemittanceMonth" size="1">
                                              <?
													$objEmpReport->comboMonth(date('n'));
													?>
                                            </select> </td>
                                          <td width="8%" class="paragraph">Year 
                                            : </td>
                                          <td width="41%"> <select name="t_dtmRemittanceYear" size="1">
                                              <?
													$objEmpReport->comboYear(date('Y'));
												   	?>
                                            </select>
                                            <input name="t_strRequestStatus" type="hidden" id="t_strRequestStatus" value="<? echo "Filed Request"; ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">&nbsp;</td>
                                          <td colspan="3">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"> <div align="justify"></div></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"><div align="center"><strong> 
                                              <input name="t_dtmStatusDate" type="hidden" id="t_dtmStatusDate" value="<? echo date("Y-m-d"); ?>">
                                              </strong> 
                                              <input name="Submit" type="submit" value="Submit">
                                              <input name="Reset" type="reset" value="Clear">
                                            </div></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td> 
                                      <? //  Payslip  
	} elseif ($t_strEmpReport == 'Payslip') 
	{
?>
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr class="title"> 
                                          <td colspan="4"> 
                                            <!-- Payslip -->
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td width="35%" class="paragraph">Month 
                                            : </td>
                                          <td width="16%"> <select name="t_dtmPayslipMonth" size="1">
                                              <?
													$objEmpReport->comboMonth(date('n'));
													?>
                                            </select> </td>
                                          <td width="8%" class="paragraph">Year 
                                            : </td>
                                          <td width="41%"> <select name="t_dtmPayslipYear" size="1">
                                              <?
													$objEmpReport->comboYear(date('Y'));
												   	?>
                                            </select>
                                            <input name="t_strRequestStatus" type="hidden" id="t_strRequestStatus3" value="<? echo "Filed Request"; ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">&nbsp;</td>
                                          <td colspan="3">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"> <div align="justify"></div></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"><div align="center"><strong> 
                                              <input name="t_dtmStatusDate" type="hidden" id="t_dtmStatusDate" value="<? echo date("Y-m-d"); ?>">
                                              </strong> 
                                              <input name="Submit" type="submit" value="Submit">
                                              <input name="Reset" type="reset" value="Clear">
                                            </div></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td> 
                                      <? //  Payslip  
	} elseif ($t_strEmpReport == 'SR') 
	{
?>
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr class="title"> 
                                          <td colspan="4"> 
                                            <!-- Payslip -->
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">&nbsp;</td>
                                          <td colspan="3">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"> <div align="justify"></div></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"><div align="center"><strong> 
                                              <input name="t_dtmStatusDate" type="hidden" id="t_dtmStatusDate" value="<? echo date("Y-m-d"); ?>">
                                              </strong> 
                                              <input name="Submit" type="submit" value="Submit">
                                              <input name="Reset" type="reset" value="Clear">
                                            </div></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td> 
                                      <? //  Certificate of Compensation  
	} elseif ($t_strEmpReport == 'CEC') 
	{
?>
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr class="title"> 
                                          <td colspan="4"> 
                                            <!-- Certificate of Compensation -->
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td width="35%" class="paragraph">Month 
                                            : </td>
                                          <td width="16%"> <select name="t_dtmCECMonth" size="1">
                                              <?
													$objEmpReport->comboMonth(date('n'));
													?>
                                            </select> </td>
                                          <td width="8%" class="paragraph">Year 
                                            : </td>
                                          <td width="41%"> <select name="t_dtmCECYear" size="1">
                                              <?
													$objEmpReport->comboYear(date('Y'));
												   	?>
                                            </select>
                                            <input name="t_strRequestStatus" type="hidden" id="t_strRequestStatus4" value="<? echo "Filed Request"; ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">&nbsp;</td>
                                          <td colspan="3">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"> <div align="justify"></div></td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"><div align="center"><strong> 
                                              <input name="t_dtmStatusDate" type="hidden" id="t_dtmStatusDate" value="<? echo date("Y-m-d"); ?>">
                                              </strong> 
                                              <input name="Submit" type="submit" value="Submit">
                                              <input name="Reset" type="reset" value="Clear">
                                            </div></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr>
                                    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                          <td>
										  <?
										  }		// Endif ($Submit == 'Submit')
										  ?>
										  </td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td> 
                                      <? 
								  }   //End if
								  ?>
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td>&nbsp;</td>
                                  </tr>
                                </table>
                              </form></td>
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
