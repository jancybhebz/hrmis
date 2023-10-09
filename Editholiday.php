<?php 
/* 
File Name: Editholiday.php
----------------------------------------------------------------------
Purpose of this file: 
To modify useraccount and password to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: October 16, 2003
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

?>
<html><!-- InstanceBegin template="/Templates/hrmistmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
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
<!-- InstanceBeginEditable name="head" --> 
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
<!-- InstanceEndEditable -->
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/appointment2.jpg','images/deduction2.jpg','images/division2.jpg','images/educational2.jpg','images/exam2.jpg','images/holiday2.jpg','images/income2.jpg','images/leave2.jpg','images/plantilla2.jpg','images/project2.jpg','images/section2.jpg','images/service2.jpg','images/tax2.jpg','images/useraccount2.jpg','images/agency2.jpg','images/notificationover.jpg','images/attendanceover.jpg','images/reportsover.jpg','images/compensationover.jpg','images/201over.jpg','images/philhealth2.jpg','images/taxexemp2.jpg','images/trainingcode2.jpg','images/librariesclick.jpg','images/salaryschedule2.jpg','images/separationcause2.jpg','images/positioncode2.jpg','images/requesttype2.jpg','images/logout2.jpg'); history.forward();" onContextMenu="return false"><div align="center"> 
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr> 
    <td><table width="100%" height="566" border="0" align="center" cellpadding="0" cellspacing="0" id="INNERTBL">
        <tr> 
          <td width="38%" height="44" valign="baseline"><img src="images/hrmodule.jpg" width="170" height="23"></td>
          <td width="62%" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="44"><table border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <a href="Notification.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Notification','','images/notificationover.jpg',1)"><img src="images/notification.jpg" alt="Notification" name="Notification" width="96" height="29" border="0"></a><a href="Addemployee.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Profile','','images/201over.jpg',1)"><img src="images/201.jpg" alt="Personnel Profile" name="Profile" width="67" height="29" border="0"></a><a href="Searchattendance.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Attendance','','images/attendanceover.jpg',1)"><img src="images/attendance.jpg" alt="Attendance" name="Attendance" width="88" height="29" border="0"></a><a href="Report.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Reports','','images/reportsover.jpg',1)"><img src="images/reports.jpg" alt="Reports" name="Reports" width="60" height="29" border="0"></a><a href="Holiday.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Libraries','','images/librariesclick.jpg',1)"><img src="images/librariesclick.jpg" alt="Libraries" name="Libraries" width="67" height="29" border="0"></a><a href="Personnelinfo.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Compensation','','images/compensationover.jpg',1)"><img src="images/compensation.jpg" alt="Compensation" name="Compensation" width="104" height="29" border="0"></a></td></tr></table></td></tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="8" colspan="2"><div align="center">Welcome <strong><? echo $_SESSION['strLoginName']; ?></strong>. 
              You are currently working at the HR Module.</div></td>
        </tr>
        <tr valign="top" bgcolor="#E9F3FE"> 
          <td height="491" colspan="2"><table width="100%" height="491" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="16%" height="491"><table width="150" height="443" border="0" cellpadding="0" cellspacing="0" bgcolor="#E9F3FE">
                    <tr> 
                      <td height="443" valign="top"><table width="100%" height="443" border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td height="443" valign="top"><table width="90%" height="485" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="NAVTBL">
                                <tr> 
                                  <td height="485" valign="top"><table width="108" height="300" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td><a href="Agency.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Agency','','images/agency2.jpg',1)"><img src="images/agency.jpg" alt="Agency" name="Agency" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Appointment.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Appointment','','images/appointment2.jpg',1)"><img src="images/appointment.jpg" alt="Appointment" name="Appointment" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Deduction.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Deduction','','images/deduction2.jpg',1)"><img src="images/deduction.jpg" alt="Deduction" name="Deduction" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Division.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Division','','images/division2.jpg',1)"><img src="images/division.jpg" alt="Division" name="Division" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Level.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Educational','','images/educational2.jpg',1)"><img src="images/educational.jpg" alt="Educational" name="Educational" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Examtype.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Exam','','images/exam2.jpg',1)"><img src="images/exam.jpg" alt="Exam" name="Exam" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Holiday.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Holiday','','images/holiday2.jpg',1)"><img src="images/holiday.jpg" alt="Holiday" name="Holiday" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Income.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Income','','images/income2.jpg',1)"><img src="images/income.jpg" alt="Income" name="Income" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Leave.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Leave','','images/leave2.jpg',1)"><img src="images/leave.jpg" alt="Leave" name="Leave" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Philhealthrange.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Philhealth','','images/philhealth2.jpg',1)"><img src="images/philhealth.jpg" alt="Philhealth Range" name="Philhealth" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Plantilla.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Plantilla','','images/plantilla2.jpg',1)"><img src="images/plantilla.jpg" alt="Plantilla" name="Plantilla" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Positioncode.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Positioncode','','images/positioncode2.jpg',1)"><img src="images/positioncode.jpg" alt="Position Code" name="Positioncode" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Projectcode.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Project','','images/project2.jpg',1)"><img src="images/project.jpg" alt="Project" name="Project" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Requesttype.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('requesttype','','images/requesttype2.jpg',1)"><img src="images/requesttype.jpg" alt="requesttype" name="requesttype" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Salaryschedule.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Salaryschedule','','images/salaryschedule2.jpg',1)"><img src="images/salaryschedule.jpg" alt="Salary Schedule" name="Salaryschedule" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Section.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Section','','images/section2.jpg',1)"><img src="images/section.jpg" alt="Section" name="Section" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Separationcause.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Separationcause','','images/separationcause2.jpg',1)"><img src="images/separationcause.jpg" alt="Separation Cause" name="Separationcause" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Servicecode.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Service','','images/service2.jpg',1)"><img src="images/service.jpg" alt="Service" name="Service" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Taxexemption.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Tax Exemption','','images/taxexemp2.jpg',1)"><img src="images/taxexemp.jpg" alt="Tax Exemption" name="Tax Exemption" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Taxrange.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Tax','','images/tax2.jpg',1)"><img src="images/tax.jpg" alt="Tax" name="Tax" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Trainingcode.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Training Code','','images/trainingcode2.jpg',1)"><img src="images/trainingcode.jpg" alt="Training Code" name="Training Code" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Useraccount.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Useraccount','','images/useraccount2.jpg',1)"><img src="images/useraccount.jpg" alt="User Account" name="Useraccount" width="108" height="20" border="0"></a></td>
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
                <td width="84%" valign="top"><table width="99%" height="486" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODYTBL">
                    <tr> 
                      <td height="486"><!-- InstanceBeginEditable name="BODY" --> 

                        <table width="99%" height="195" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODY">
                          <tr> 
                            <td height="25" class="header"><p>HOLIDAY</p></td>
                          </tr>
                          <tr> 
                            <td height="18" valign="top"> <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td> 
                                    <?php
									include("../hrmis/class/Holiday.php");   //Load database connection									
									$objHoliday= new holiday;   //Load holiday function
									$objHoliday->addHoliday($t_strHolidayCode, $t_strHolidayName, $t_strHolidayMonth, $t_strHolidayDay, $t_strFixedHoliday, $Submit);   //Load addHoliday function
									$objHoliday->editHoliday($t_strHolidayCode, $t_strHolidayName, $t_strHolidayMonth, $t_strHolidayDay, $t_strFixedHoliday, $Submit, $t_strOldHolidayCode);   //Load editHoliday function
									$strConfirm = $objHoliday->deleteHoliday($t_strHolidayCode, $t_strHolidayName, $t_strHolidayMonth, $t_strHolidayDay, $t_strFixedHoliday, $Submit);   //Load deleteHoliday function
									$objHoliday->viewHoliday($t_strHolidayCode, $t_strHolidayName, $t_strHolidayMonth, $t_strHolidayDay, $t_strFixedHoliday);   //Load viewHoliday function
									?>
                                  </td>
                                </tr>
                              </table> 
                              <div align="center"></div>
                              <div align="center"></div>
                              <div align="center"></div></td>
                          </tr>
                          <tr>
                            <td height="13" valign="top"><hr></td>
                          </tr>
                          <tr> 
                            <td height="106" valign="top"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <form action="<?php $PHP_SELF; ?>" method="get" name="frmDivision">
                                  <?
							  if($strConfirm)
							  {
							  ?>
                                  <?
								}
								else
								{
								?>
                                  <tr> 
                                    <td width="121" height="19" class="paragraph">Holiday 
                                      Code : </td>
                                    <td width="433" colspan="3"> <input name="t_strHolidayCode" type="text" id="t_strHolidayCode" value="<? echo $t_strHolidayCode; ?>" size="20" maxlength="20"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Holiday Name : </td>
                                    <td colspan="3"> <input name="t_strHolidayName" type="text" id="t_strHolidayName" value="<? echo $t_strHolidayName; ?>" size="30" maxlength="30"> 
                                      <input name="t_strOldHolidayCode" type="hidden" id="t_strOldHolidayCode" value="<? echo $t_strHolidayCode; ?>"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Holiday Month : </td>
                                    <td colspan="3"> <select name="t_strHolidayMonth" size="1" id="t_strHolidayMonth">
                                        <?
											for($intCounter=1; $intCounter<=12; $intCounter++)
											{
												$strMonthFull = $objHoliday->intToMonthFull($intCounter);											
												if($t_strHolidayMonth == $intCounter)
												{
													echo "<option value='$intCounter' selected>$strMonthFull</option>";	
												}
												else
												{
													echo "<option value='$intCounter'>$strMonthFull</option>";
												}											
											}
										?>
                                      </select>
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Holiday Day : </td>
                                    <td colspan="3"><select name="t_strHolidayDay" size="1" id="t_strHolidayDay">
                                        <?
									    for($intCounter=1; $intCounter<=31; $intCounter++)
										{
										    $objHoliday->comboDay($intCounter);
											if($t_strHolidayDay == $intCounter)
											{
												echo "<option value='$intCounter' selected>$intCounter</option>";  
										    }
											else 
											{
												echo "<option value='$intCounter'>$intCounter</option>";
											}
										} 
										?>
                                      </select></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Fixed Holiday : </td>
                                    <td colspan="3"> 
                                      <?
									  if($t_strFixedHoliday == "Y" || $t_strFixedHoliday == "")
									  {
									  	echo "<input name='t_strFixedHoliday' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strFixedHoliday' type='radio' value='Y'>";
									  }
									  ?>
                                      Yes 
                                      <?
									  if($t_strFixedHoliday == "N")
									  {
									  	echo "<input name='t_strFixedHoliday' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strFixedHoliday' type='radio' value='N'>";
									  }
									  ?>
                                      No</td>
                                  </tr>
                                  <tr> 
                                    <td colspan="4" class="paragraph">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td colspan="4" class="paragraph"> <div align="center"> 
                                        <input name="Submit" type="submit" onClick="MM_validateForm('t_strUserName','','R','t_strUserPassword','','R','t_strUserLevel','','RisNum');return document.MM_returnValue" value="Submit" >
                                      </div></td>
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
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="12" colspan="2"><table width="100%" height="12" border="0" cellpadding="0" cellspacing="0" bgcolor="#002E7F" id="OUTERTBL4">
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
