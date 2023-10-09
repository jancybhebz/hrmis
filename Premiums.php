<html><!-- InstanceBegin template="/Templates/Compensation.dwt" codeOutsideHTMLIsLocked="false" -->
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
<link href="hrmis.css" rel="stylesheet" type="text/css">
<link href="hrmis.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/notificationover.jpg','images/attendanceover.jpg','images/reportsover.jpg','images/201over.jpg','images/librariesover.jpg','images/compensationclick.jpg','images/personnel2.jpg','images/income2.jpg','images/deduction2.jpg','images/remittances2.jpg','images/employer2.jpg','images/w2over.jpg','images/go2.jpg','images/premiums_loans2.jpg','images/otherbenefits2.jpg')"><div align="center"> 
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr> 
    <td><table width="100%" height="420" border="0" align="center" cellpadding="0" cellspacing="0" id="INNERTBL">
        <tr> 
          <td width="40%" height="44" valign="baseline"><img src="images/hrmodule.jpg" width="170" height="23"></td>
          <td width="60%" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="44"><table border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <a href="http://dbmis.dost.gov.ph/hrmis/Notification.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Notification','','images/notificationover.jpg',1)"><img src="images/notification.jpg" alt="Notification" name="Notification" width="96" height="29" border="0"></a><a href="http://dbmis.dost.gov.ph/hrmis/Addemployee.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Profile','','images/201over.jpg',1)"><img src="images/201.jpg" alt="Personnel Profile" name="Profile" width="67" height="29" border="0"></a><a href="http://dbmis.dost.gov.ph/hrmis/Searchattendance.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Attendance','','images/attendanceover.jpg',1)"><img src="images/attendance.jpg" alt="Attendance" name="Attendance" width="88" height="29" border="0"></a><a href="http://dbmis.dost.gov.ph/hrmis/Report.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Reports','','images/reportsover.jpg',1)"><img src="images/reports.jpg" alt="Reports" name="Reports" width="60" height="29" border="0"></a><a href="http://dbmis.dost.gov.ph/hrmis/Holiday.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Libraries','','images/librariesover.jpg',1)"><img src="images/libraries.jpg" alt="Libraries" name="Libraries" width="67" height="29" border="0"></a><a href="Personnelinfo.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Compensation','','images/compensationclick.jpg',1)"><img src="images/compensationclick.jpg" alt="Compensation" name="Compensation" width="104" height="29" border="0"></a></td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="8" colspan="2"><div align="center">Welcome <strong><? echo $arrEmpPersonal['firstname']  . "  " . $arrEmpPersonal['middlename'] . "  ". $arrEmpPersonal['surname']; ?></strong>. 
              You are currently working at the HR Module.</div></td>
        </tr>
        <tr valign="top" bgcolor="#E9F3FE"> 
          <td height="338" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="16%" height="338"><table width="150" height="338" border="0" cellpadding="0" cellspacing="0" bgcolor="#E9F3FE">
                    <tr> 
                      <td height="338" valign="top"><table width="100%" height="329" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="329" valign="top"><!-- InstanceBeginEditable name="navigation" -->
                              <table width="90%" height="327" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="NAVTBL">
                                <tr> 
                                  <td height="113" valign="baseline"><form name="form1" method="post" action="">
                                      <input name="employeeSearch" type="text" id="employeeSearch" size="15" maxlength="30">
                                      <a href="http://dbmis.dost.gov.ph/hrmis/Searchemployee.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Go','','images/go2.jpg',1)"><img src="images/go.jpg" alt="Go" name="Go" width="19" height="17" border="0" align="absmiddle"></a> 
                                      <br>
                                      <input type="radio" name="radiobutton" value="radiobutton">
                                      Employee Number<br>
                                      <input type="radio" name="radiobutton" value="radiobutton">
                                      Employee Name<br>
                                      Month 
                                      <select name="month" size="1" id="month">
                                      </select>
                                      <br>
                                      Year 
                                      <select name="year" size="1" id="year">
                                      </select>
                                      <br>
                                    </form></td>
                                </tr>
                                <tr> 
                                  <td height="205" valign="top"><table width="108" height="169" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td height="20"><a href="http://dbmis.dost.gov.ph/hrmis/Personnelinfo.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image26','','images/personnel2.jpg',1)"><img src="images/personnel1.jpg" alt="Personnel Profile" name="Image26" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="http://dbmis.dost.gov.ph/hrmis/Employeeincome.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Income','','images/income2.jpg',1)"><img src="images/income.jpg" alt="Income" name="Income" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="http://dbmis.dost.gov.ph/hrmis/Employeedeductions.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Deductions','','images/deduction2.jpg',1)"><img src="images/deduction.jpg" alt="Deductions" name="Deductions" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="http://dbmis.dost.gov.ph/hrmis/Premiums.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Premiums','','images/premiums2.jpg',1)"><img src="images/premiums.jpg" alt="Premiums" name="Premiums" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="http://dbmis.dost.gov.ph/hrmis/Loans.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Loans','','images/loans2.jpg',1)"><img src="images/loans.jpg" alt="Loans" name="Loans" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="http://dbmis.dost.gov.ph/hrmis/Remittances.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Remittances','','images/remittances2.jpg',1)"><img src="images/remittances.jpg" alt="Remittances" name="Remittances" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="29"><a href="http://dbmis.dost.gov.ph/hrmis/Employercontribution.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Contribution','','images/employer2.jpg',1)"><img src="images/employer.jpg" alt="Employer Contribution" name="Contribution" width="108" height="29" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="http://dbmis.dost.gov.ph/hrmis/W2.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('W2','','images/w2over.jpg',1)"><img src="images/w2.jpg" alt="W2" name="W2" width="108" height="20" border="0"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table>
                              <!-- InstanceEndEditable --></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
                <td width="84%" valign="top"><table width="99%" height="339" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODYTBL">
                    <tr> 
                      <td height="337"><!-- InstanceBeginEditable name="BODY" --> 
                        <table width="99%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td height="25" class="header"><p>Premiums</p></td>
                          </tr>
                          <tr> 
                            <td><table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" class="border">
                                <tr> 
                                  <td width="394" height="74"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" class="border">
                                      <tr bgcolor="#99CCFF" class="radio"> 
                                        <td width="85">Employee No.:</td>
                                        <td width="281"><strong>CO-MIS</strong></td>
                                      </tr>
                                      <tr bgcolor="#99CCFF" class="radio"> 
                                        <td>Surname:</td>
                                        <td class="radio"><strong>Gamboa</strong></td>
                                      </tr>
                                      <tr bgcolor="#99CCFF" class="radio"> 
                                        <td>First Name:</td>
                                        <td class="radio"><strong>Joanne</strong></td>
                                      </tr>
                                      <tr bgcolor="#99CCFF" class="radio"> 
                                        <td height="20">Middle Name:</td>
                                        <td class="radio"><strong>Doctolero</strong></td>
                                      </tr>
                                    </table></td>
                                  <td width="200"><table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td height="70" bgcolor="#99CCFF">&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                                <tr class="title"> 
                                  <td width="5%">Code</td>
                                  <td width="15%">Monthly Amortization</td>
                                  <td width="10%">Voucher No.</td>
                                  <td width="12%">Voucher Date</td>
                                  <td width="11%">Amount Granted</td>
                                  <td width="11%">Date Granted</td>
                                  <td width="13%">Start Date</td>
                                  <td width="10%">End Date</td>
                                  <td width="13%">Loan Balance</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                        </table>
                        <p>&nbsp;</p>
                        <!-- InstanceEndEditable --></td>
                    </tr>
                  </table>
                </td>
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
