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
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
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
                        <table width="99%" height="112" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODY">
                          <tr> 
                            <td height="25" class="header"><p>DEDUCTION TYPE</p></td>
                          </tr>
                          <tr> 
                            <td valign="top"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td colspan="3" class="paragraph">Deduction Type : </td>
                                  <td width="433"> <input name="deductionType" type="text" id="deductionType" size="30" maxlength="30"> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td colspan="4" class="paragraph">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td colspan="4" class="paragraph"> <div align="center"> 
                                      <input type="submit" name="Submit2" value="Submit">
                                      <input type="reset" name="Reset" value="Clear">
                                    </div></td>
                                </tr>
                              </table></td>
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
