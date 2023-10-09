<?
session_start();
include("../hrmis/class/Security.php");
require("../hrmis/class/Override.php");
$objOverride = new Override;
require("../hrmis/class/Update.php");
$objUpdate = new Update;
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_change() {
	var strEmpNmbr = "<? echo $strEmpNmbr ?>";
	var empNumber = document.myDUpdate.empNumber.value
	var cboMonth = document.myDUpdate.cboMonth.value
	var cboYear = document.myDUpdate.cboYear.value
	var strDeductAmount = "<? $strDeductAmount ?>";
	var deductionCode=document.myDUpdate.deductionCode.value
	window.location = "CDeductionupdate.php?strEmpNmbr="+strEmpNmbr+"&empNumber="+empNumber+"&cboMonth="+cboMonth+"&cboYear="+cboYear+"&deductionCode="+deductionCode;
	
}

function MM_change1() {
	var empNumber1 = document.myDUpdate.empNumber.value
	document.myDUpdate.empNumber1.value = empNumber1
}
//-->
</script>
<html><!-- InstanceBegin template="/Templates/Cashierupdate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/class/JSgeneral.php");
?>
<!-- InstanceEndEditable --> 
<!-- Design/Images made by:  Angelo Campos Evangelista  -->
<!-- Template made by:  Pearliezl Samoy Dy Tioco  -->
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
<link href="hrmis.css" rel="stylesheet" type="text/css">
<link href="hrmis.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/compensationover.jpg','images/updateclick.jpg','images/reportsover.jpg','images/deduction2.jpg','images/systemrecords2.jpg','images/logout2.jpg','images/notificationover.jpg'); history.forward()" onContextMenu="return false"><div align="center"> 
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="INNERTBL">
        <tr> 
          <td width="40%" height="44" valign="baseline"><table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/compensmodule.jpg" width="211" height="23"></td>
              </tr>
            </table></td>
          <td valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td valign="bottom"><table border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <?   //  Cashier module for update templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 2 && $t_strUserPermission == "Cashier Officer" && $t_strAccessPermission == "0123") 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="7%"><a href="CNotification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('notification','','images/notificationover.jpg',1)"><img src="images/notification.jpg" alt="notification" name="notification" width="96" height="29" border="0"></a><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION" name="COMPENSATION" width="104" height="29" border="0"></a></td>
                      <td width="27%"><a href="CDeductionupdate.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('UPDATE','','images/updateclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/updateclick.jpg" alt="UPDATE" name="UPDATE" width="60" height="30" border="0"></a></td>
                      <td width="66%"><a href="CMonthlyreport.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS" name="REPORTS" width="60" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  Cashier module for update templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 2 && $t_strUserPermission == "Cashier Assistant" && $t_strAccessPermission == 02) 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="7%"><a href="CNotification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('notification2','','images/notificationover.jpg',1)"><img src="images/notification.jpg" alt="notification2" name="notification2" width="96" height="29" border="0"></a></td>
                      <td width="27%"><a href="CDeductionupdate.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('UPDATE4','','images/updateclick.jpg',1); statusBar(); return true" onClick="statusBar();"><img src="images/updateclick.jpg" alt="UPDATE" name="UPDATE4" width="60" height="30" border="0" id="UPDATE4"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  Cashier module for update templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 2 && $t_strUserPermission == "Cashier Assistant" && $t_strAccessPermission == 12) 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="35%"><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION2','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION2" name="COMPENSATION2" width="104" height="29" border="0"></a></td>
                      <td width="65%"><a href="CDeductionupdate.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('UPDATE2','','images/updateclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/updateclick.jpg" alt="UPDATE2" name="UPDATE2" width="60" height="30" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td> 
                  <?   //  Cashier module for update templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 2 && $t_strUserPermission == "Cashier Assistant" && $t_strAccessPermission == 23) 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="65%"><a href="CDeductionupdate.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('UPDATE3','','images/updateclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/updateclick.jpg" alt="UPDATE3" name="UPDATE3" width="60" height="30" border="0"></a></td>
                      <td width="35%"><a href="CMonthlyreport.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS3','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS3" name="REPORTS3" width="60" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td> 
                  <?   //  Cashier module for update templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == 1234567) 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblHRCASHIER">
                    <tr> 
                      <td width="7%"><a href="CNotification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('notification3','','images/notificationover.jpg',1)"><img src="images/notification.jpg" alt="notification3" name="notification3" width="96" height="29" border="0"></a><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION1','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION" name="COMPENSATION1" width="104" height="29" border="0" id="COMPENSATION1"></a></td>
                      <td width="27%"><a href="CDeductionupdate.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('UPDATE1','','images/updateclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/updateclick.jpg" alt="UPDATE" name="UPDATE1" width="60" height="30" border="0" id="UPDATE1"></a></td>
                      <td width="66%"><a href="CMonthlyreport.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS1','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS" name="REPORTS1" width="60" height="29" border="0" id="REPORTS1"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="8" colspan="2"><div align="center">Welcome <strong><? echo $_SESSION['strLoginName']; ?></strong>. 
              You are currently working at the Cashier Module.</div></td>
        </tr>
        <tr valign="top" bgcolor="#E9F3FE"> 
          <td height="347" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="16%" height="347"><table width="150" height="338" border="0" cellpadding="0" cellspacing="0" bgcolor="#E9F3FE">
                    <tr> 
                      <td height="338" valign="top"><table width="100%" height="329" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="329" valign="top"> <table width="90%" height="338" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="NAVTBL">
                                <tr> 
                                  <td height="13" valign="baseline">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td height="315" valign="baseline"><table width="108" height="58" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td height="20"><a href="CDeductionupdate.php?strEmpNmbr=<? echo $strEmpNmbr; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Deductions','','images/deduction2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/deduction.jpg" alt="Deductions" name="Deductions" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="CSystemrecord.php?strEmpNmbr=<? echo $strEmpNmbr; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('SystemRecords','','images/systemrecords2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/systemrecords.jpg" alt="System Records" name="SystemRecords" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="10"><a href="index.php" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LOGOUT','','images/logout2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/logout.jpg" alt="LOGOUT" name="LOGOUT" width="108" height="20" border="0"></a></td>
                                      </tr>
                                    </table> <table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr> 
                                        <td> 
                                          <?   //  Cashier module for update templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == 1234567) 
{
?>
                                          <a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar()" onFocus="statusBar()"><img src="images/gotohr.jpg" alt="Back to HR Module" width="93" height="28" border="0"></a> 
                                          <? } ?>
                                        </td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table>
                              </td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
                <td width="84%" valign="top"><table width="99%" height="340" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODYTBL">
                    <tr> 
                      <td height="340"><!-- InstanceBeginEditable name="BODY" --> 
                        <table width="99%" border="0" cellspacing="0" cellpadding="0">
                          <form name="myDUpdate" method="get" action="">
                            <tr> 
                              <td height="25" class="header"><p>DEDUCTIONS</p></td>
                            </tr>
                            <tr> 
                              <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr> 
                                    <td width="31%" class="paragraph">Employee 
                                      Name :</td>
                                    <td width="69%"> <select name="empNumber" size="1" class="tbtext"" onChange="MM_change1()">
                                        <?
$objOverride->comboEmpList($empNumber);
?>
                                      </select>
                                      <input type="hidden" name="empNumber1">
                                      <span class="text"><strong> 
                                      <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>">
                                      </strong></span></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Month : </td>
                                    <td> <select name="cboMonth">
                                        <?
										$objOverride->comboMonth($cboMonth);
									  ?>
                                      </select> </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Year :</td>
                                    <td> <select name="cboYear">
                                        <?
										$objOverride->comboYear($cboYear);
									  ?>
                                      </select> </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Deduction Code :</td>
                                    <td> <select name="deductionCode" size="1" class="tbtext" onChange="MM_change()">
                                        <?
$objOverride->comboDeductCode($deductionCode);
?>
                                      </select>
                                      <? 
											$strDeductAmount = $objOverride->valueAmount($deductionCode, $empNumber, $cboMonth, $cboYear); 
											?>
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Amount :</td>
                                    <td> <input type="text" name="deductAmount" value="<? echo $strDeductAmount ?>"> 
                                    </td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr> 
                              <td> <div align="center"><span class="text"><strong> 
                                  <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>">
                                  </strong></span> 
                                  <input type="submit" name="Submit" value="ADD">
                                  <input name="Submit" type="submit" id="Submit" value="UPDATE">
                                  <input name="Submit" type="submit" id="Submit" value="DELETE">
                                </div></td>
                            </tr>
                          </form>
                        </table>
                        <p><? $objOverride->overrideDeduct($strEmpNmbr, $empNumber, $deductionCode, $deductAmount, $cboMonth, $cboYear, $Submit); ?></p>
                        <!-- InstanceEndEditable --></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="13" colspan="2"><table width="100%" height="13" border="0" cellpadding="0" cellspacing="0" bgcolor="#002E7F" id="OUTERTBL4">
              <tr> 
                <td height="13"><div align="center"> 
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
