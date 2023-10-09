<html>
<head>
<!-- TemplateBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<!-- TemplateEndEditable --> 
<!-- Design/Images Made By : Angelo Campos Evangelista  -->
<!-- Template Made By : Pearliezl Samoy Dy Tioco  -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!-- onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar()" onFocus="statusBar()"

<!--
function openPrint() {

	var strEmpNmbr = "<? echo $strEmpNmbr; ?>";
	var t_strUserLevel = "<? echo $t_strUserLevel; ?>";
	var t_strUserPermission = "<? echo $t_strUserPermission; ?>";
	var t_strAccessPermission = "<? echo $t_strAccessPermission; ?>";
	strPage = "hr.html?strEmpNmbr="+strEmpNmbr+"&t_strUserLevel="+t_strUserLevel+"&t_strUserPermission="+t_strUserPermission+"&t_strAccessPermission="+t_strAccessPermission;
	window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=960,height=625');

}

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
<link href="../hrmis.css" rel="stylesheet" type="text/css">
<!-- TemplateBeginEditable name="head" --><!-- TemplateEndEditable -->
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('../images/education2.jpg','../images/trainings2.jpg','../images/examinations2.jpg','../images/position2.jpg','../images/requestsover.jpg','../images/notificationover.jpg','../images/logout2.jpg','../images/attendanceover.jpg','../images/personal-information2.jpg','../images/family-background2.jpg','../images/work-experience2.jpg','../images/voluntary-work2.jpg','../images/other-information2.jpg'); history.forward()" onContextMenu="return false"><div align="center"> 
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr> 
    <td height="397"><table width="100%" height="396" border="0" align="center" cellpadding="0" cellspacing="0" id="INNERTBL">
        <tr> 
          <td width="58%" height="44" valign="bottom"><img src="../images/empmodule.jpg" width="170" height="23"> 
          </td>
          <td width="42%" valign="top"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="44"><table border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <div align="right"><a href="Employeeinformation.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar()" onFocus="statusBar()"><img src="../images/201click.jpg" alt="emp201" name="emp201" width="67" height="29" border="0"></a><a href="EmpDTR.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Empattendance','','../images/attendanceover.jpg',1);statusBar(); return true;" onClick="statusBar();"><img src="../images/attendance.jpg" alt="Empattendance" name="Empattendance" width="88" height="29" border="0"></a><a href="EmpOB.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Emprequest','','../images/requestsover.jpg',1);statusBar(); return true;" onClick="statusBar();"><img src="../images/requests.jpg" alt="Emprequest" name="Emprequest" width="88" height="31" border="0"></a><a href="Empnotify.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()"  onMouseOver="MM_swapImage('Empnotify','','../images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="../images/notification.jpg" alt="Empnotify" name="Empnotify" width="96" height="29" border="0"></a> 
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
                                  <td height="289" valign="top"><table width="108" height="187" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td><a href="Employeeinformation.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onClick="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('profile','','../images/personal-information2.jpg',1); statusBar(); return true;"><img src="../images/personal-information.jpg" alt="profile" name="profile" width="108" height="27" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Employeefamily.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onClick="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('familybackground','','../images/family-background2.jpg',1); statusBar(); return true;"><img src="../images/family-background.jpg" alt="familybackground" name="familybackground" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Employeeeducation.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onClick="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('Education','','../images/education2.jpg',1); statusBar(); return true;"><img src="../images/education1.jpg" alt="Education" name="Education" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Employeeexaminations.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onClick="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('examinations','','../images/examinations2.jpg',1); statusBar(); return true;"><img src="../images/examinations1.jpg" alt="examinations" name="examinations" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Employeeworkexperience.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onClick="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('workexperience','','../images/work-experience2.jpg',1); statusBar(); return true;"><img src="../images/work-experience.jpg" alt="workexperience" name="workexperience" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Employeevoluntarywork.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onClick="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('voluntarywork','','../images/voluntary-work2.jpg',1); statusBar(); return true;"><img src="../images/voluntary-work.jpg" alt="voluntarywork" name="voluntarywork" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Employeetrainings.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onClick="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('Trainings','','../images/trainings2.jpg',1); statusBar(); return true;"><img src="../images/trainings1.jpg" alt="Trainings" name="Trainings" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Employeeotherinfo.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onClick="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('otherinformation','','../images/other-information2.jpg',1); statusBar(); return true;"><img src="../images/other-information.jpg" alt="otherinformation" name="otherinformation" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="Employeepositiondetails.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onClick="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('PositionDetails','','../images/position2.jpg',1); statusBar(); return true;"><img src="../images/position1.jpg" alt="Position Details" name="PositionDetails" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr>  
                                        <td><a href="index.php" onMouseOut="MM_swapImgRestore(); statusBar()" onClick="statusBar();" onFocus="statusBar();" onMouseOver="MM_swapImage('logout','','../images/logout2.jpg',1); statusBar(); return true;"><img src="../images/logout.jpg" alt="logout" name="logout" width="108" height="20" border="0"></a></td>
                                      </tr>
                                    </table>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td><table width="80" border="0" align="center" cellpadding="0" cellspacing="0" id="HOWTO">
                                            <tr>
                                              <td><a href="javascript:openPrint()"><img src="../images/howto.jpg" width="78" height="21" border="0"></a></td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td>&nbsp;</td>
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
                      <td height="312"><!-- TemplateBeginEditable name="BODY" --> 
                        <!-- TemplateEndEditable --></td>
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
</html>
