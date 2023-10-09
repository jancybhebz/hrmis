<?
session_start();
include("../hrmis/class/Security.php");
require("../hrmis/class/General.php");
$objReport = new General;
?>
<html><!-- InstanceBegin template="/Templates/Cashierreport.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/class/JSgeneral.php");
?>
<script language="JavaScript">
function openPrint()
{
	var strCshrReport = "ERMTN";
	var strPage, intCshrYear1, intCshrYear;
	var strCshrSubReport, strEmpNmbr;
	
	intCshrYear = document.all.cboYear.value;	
	intCshrYear1 = document.all.cboYear1.value;
	
	try
	{
		var strEmpNmbr = document.all.cboEmpNmbr.value;
	}
	catch(error)
	{
	
	}
	
	try
	{
		var strEmpSelect = document.all.cboEmpSelected.value;
	}
	catch(error)
	{
	
	}

	try
	{
		var strDivSec = document.all.cboDivision.value;
	}
	catch(error)
	{
		try
		{
			var strDivSec = document.all.cboSection.value;
		}
		catch(error)
		{
			strDivSec = "";
		}
	}
	
	if(strCshrReport == "ERMTN")
	{
		strCshrSubReport = document.all.cboRemittance.value;
		strPage = "CashierReportData.php?strCshrReport="+strCshrReport+"&strEmpSelect="+strEmpSelect+"&strDivSec="+strDivSec+"&strEmpNmbr="+strEmpNmbr+"&intCshrYear="+intCshrYear+"&intCshrYear1="+intCshrYear1+"&strCshrSubReport="+strCshrSubReport;
	}

	window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');
}

function reportRequirement()
{
	var strReport = "ERMTN";
	var strEmpNmbr = "<? echo $strEmpNmbr; ?>";
	var strCshrSubReport = document.all.cboRemittance.value;
	window.location = "CRemittancereport.php?strEmpNmbr="+strEmpNmbr+"&cboRprt="+strReport+"&strCshrSubReport="+strCshrSubReport;
}

function showSelectCombo(t_strEmpSelect)
{
	var strEmpNmbr = "<? echo $strEmpNmbr; ?>";
	var strReport = "ERMTN";
	var strCshrSubReport = document.all.cboRemittance.value;
	window.location = "CRemittancereport.php?strEmpNmbr="+strEmpNmbr+"&cboRprt="+strReport+"&strCshrSubReport="+strCshrSubReport+"&cboEmpSelected="+t_strEmpSelect;
}

function showEmpOfDivOfSec()
{
	var strEmpNmbr = "<? echo $strEmpNmbr; ?>";
	var strReport = "ERMTN";
	var strCshrSubReport = document.all.cboRemittance.value;
	var strEmpSelect = document.all.cboEmpSelected.value;

	try
	{
		var strDivSec = document.all.cboDivision.value;
	}
	catch(error)
	{
		var strDivSec = document.all.cboSection.value;
	}
	
	window.location = "CRemittancereport.php?strEmpNmbr="+strEmpNmbr+"&cboRprt="+strReport+"&cboEmpSelected="+strEmpSelect+"&cboDivision="+strDivSec+"&cboSection="+strDivSec+"&strCshrSubReport="+strCshrSubReport;
}


</script>
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

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/monthlyreports2.jpg','images/logout2.jpg','images/yearend2.jpg','images/compensationover.jpg','images/updateover.jpg','images/reportsclick.jpg','images/notificationover.jpg','images/employeeremittance2.jpg'); history.forward()" onContextMenu="return false"><div align="center"> 
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr> 
    <td><table width="100%" height="403" border="0" align="center" cellpadding="0" cellspacing="0" id="INNERTBL">
        <tr> 
          <td valign="bottom"><table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/compensmodule.jpg" width="211" height="23"></td>
              </tr>
            </table></td>
          <td valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 2 && $t_strUserPermission == "Cashier Officer" && $t_strAccessPermission == "0123") 
{
?>
                  <table width="30%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblCASHIER">
                    <tr> 
                      <td width="63%"><a href="CNotification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('notification','','images/notificationover.jpg',1)"><img src="images/notification.jpg" alt="notification" name="notification" width="96" height="29" border="0"></a><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION" name="COMPENSATION" width="104" height="29" border="0"></a></td>
                      <td width="12%"><a href="CDeductionupdate.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('UPDATE','','images/updateover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/update.jpg" alt="UPDATE" name="UPDATE" width="60" height="28" border="0"></a></td>
                      <td width="25%"><a href="CMonthlyreport.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS','','images/reportsclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reportsclick.jpg" alt="REPORTS" name="REPORTS" width="60" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 2 && $t_strUserPermission == "Cashier Assistant" && $t_strAccessPermission == 03) 
{
?>
                  <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblCOMPENSATIONREPORTS">
                    <tr> 
                      <td width="86%"><a href="CNotification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('notification2','','images/notificationover.jpg',1)"><img src="images/notification.jpg" alt="notification2" name="notification2" width="96" height="29" border="0"></a></td>
                      <td width="14%"><a href="CMonthlyreport.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS21','','images/reportsclick.jpg',1); statusBar(); return true" onClick="statusBar();"><img src="images/reportsclick.jpg" alt="REPORTS2" name="REPORTS21" width="60" height="29" border="0" id="REPORTS21"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 2 && $t_strUserPermission == "Cashier Assistant" && $t_strAccessPermission == 13) 
{
?>
                  <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblCOMPENSATIONREPORTS">
                    <tr> 
                      <td width="86%"><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION2','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION2" name="COMPENSATION2" width="104" height="29" border="0"></a></td>
                      <td width="14%"><a href="CMonthlyreport.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS2','','images/reportsclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reportsclick.jpg" alt="REPORTS2" name="REPORTS2" width="60" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 2 && $t_strUserPermission == "Cashier Assistant" && $t_strAccessPermission == 23) 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblUPDATEREPORTS">
                    <tr> 
                      <td width="38%"><a href="CDeductionupdate.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('UPDATE3','','images/updateover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/update.jpg" alt="UPDATE3" name="UPDATE3" width="60" height="28" border="0"></a></td>
                      <td width="62%"><a href="CMonthlyreport.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS3','','images/reportsclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reportsclick.jpg" alt="REPORTS3" name="REPORTS3" width="60" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == 1234567) 
{
?>
                  <table width="30%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblHRCASHIERMODULE">
                    <tr> 
                      <td width="63%"><a href="CNotification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('notification3','','images/notificationover.jpg',1)"><img src="images/notification.jpg" alt="notification3" name="notification3" width="96" height="29" border="0"></a><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION1','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION" name="COMPENSATION1" width="104" height="29" border="0" id="COMPENSATION1"></a></td>
                      <td width="12%"><a href="CDeductionupdate.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('UPDATE1','','images/updateover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/update.jpg" alt="UPDATE" name="UPDATE1" width="60" height="28" border="0" id="UPDATE1"></a></td>
                      <td width="25%"><a href="CMonthlyreport.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS1','','images/reportsclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reportsclick.jpg" alt="REPORTS" name="REPORTS1" width="60" height="29" border="0" id="REPORTS1"></a></td>
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
          <td height="328" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="16%" height="327"><table width="150" height="287" border="0" cellpadding="0" cellspacing="0" bgcolor="#E9F3FE">
                    <tr> 
                      <td height="287" valign="top"><table width="100%" height="321" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="321" valign="top"> <table width="90%" height="321" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="NAVTBL">
                                <tr> 
                                  <td height="24" valign="baseline">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td height="296" valign="top"><table width="108" height="60" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td height="5"><a href="CMonthlyreport.php?strEmpNmbr=<? echo $strEmpNmbr; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('MonthlyReports','','images/monthlyreports2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/monthlyreports.jpg" alt="Monthly Reports" name="MonthlyReports" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="5"><a href="CRemittancereport.php?strEmpNmbr=<? echo $strEmpNmbr; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('EmployeeRemittanceReports','','images/employeeremittance2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/employeeremittance.jpg" alt="Employee Remittance Reports" name="EmployeeRemittanceReports" width="108" height="29" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="10"><a href="CYearendreport.php?strEmpNmbr=<? echo $strEmpNmbr; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('yearendreport','','images/yearend2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/yearend.jpg" alt="yearendreport" name="yearendreport" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="index.php" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('logout','','images/logout2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/logout.jpg" alt="logout" name="logout" width="108" height="20" border="0"></a></td>
                                      </tr>
                                    </table>
                                    <table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
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
                <td width="84%" valign="top"><table width="99%" height="321" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODYTBL">
                    <tr> 
                      <td height="321"><!-- InstanceBeginEditable name="BODY" -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td height="24" class="header"><p>Employee remittance 
                                REPORTS</p>
                              </td>
                          </tr>
                          <tr>
                            <td>
						
							    <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td width="22%" class="paragraph">Remittances 
                                    :</td>
                                  <td colspan="3"> 
                                    <? 
										$objReport->comboDeductionType("cboRemittance", "reportRequirement();", $strCshrSubReport);
										?>
                                  </td>
                                </tr>
                                <tr> 
                                  <td class="paragraph">&nbsp;</td>
                                  <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td class="paragraph">Select Name Per :</td>
                                  <td colspan="3"> <select name="cboEmpSelected" onChange="showSelectCombo(document.all.cboEmpSelected.value)">
                                      <?
										  if($cboEmpSelected == "All Employees")
										  {
										  ?>
                                      <option value="All Employees" selected>All 
                                      Employees</option>
                                      <?
										  }
										  else
										  {
										  ?>
                                      <option value="All Employees">All Employees</option>
                                      <?
										  }
										  
										  if($cboEmpSelected == "Per Division")
										  {
										  ?>
                                      <option value="Per Division" selected>Per 
                                      Division</option>
                                      <?
										  }
										  else
										  {
										  ?>
                                      <option value="Per Division">Per Division</option>
                                      <?
										  }
										  
										  if($cboEmpSelected == "Per Section")
										  {										  
										  ?>
                                      <option value="Per Section" selected>Per 
                                      Section</option>
                                      <?
										  }
										  else
										  {
										  ?>
                                      <option value="Per Section">Per Section</option>
                                      <?
										  }
										  ?>
                                    </select> &nbsp; 
                                    <? 	
									if($cboEmpSelected == "Per Division")
									{								
										echo "Select Division: ";
										$objReport->comboDivision("cboDivision", $cboDivision, "showEmpOfDivOfSec()");
									}
									else if($cboEmpSelected == "Per Section")
									{
										echo "Select Section: ";
										$objReport->comboSection("cboSection", $cboSection, "showEmpOfDivOfSec()");	
									}
									?>
                                  </td>
                                </tr>
                                <tr> 
                                  <td class="paragraph">&nbsp;</td>
                                  <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td class="paragraph">Employees :</td>
                                  <td colspan="3"> 
                                    <? 
									if(strlen($cboDivision) != 0 && strlen($cboSection) != 0)
									{
										$objReport->comboEmpReport("cboEmpNmbr", $cboEmpNmbr, $cboReports, $cboEmpSelected, $cboDivision);
									}
									else
									{
										$objReport->comboEmpReport("cboEmpNmbr", $cboEmpNmbr, $cboReports);
									}
									?>
                                  </td>
                                </tr>
                                <tr> 
                                  <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td class="paragraph">From Year :</td>
                                  <td width="20%"><select name="cboYear">
                                      <?
										$objReport->comboYear($cboYear);
									  ?>
                                    </select> </td>
                                  <td width="14%" class="paragraph">To Year :</td>
                                  <td width="44%"><select name="cboYear1">
                                      <?
										$objReport->comboYear($cboYear);
									  ?>
                                    </select> </td>
                                </tr>
                                <tr> 
                                  <td colspan="4">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td colspan="4"> <div align="center"> 
                                      <input type="submit" name="Submit" value="PRINT/PREVIEW" onClick="openPrint()">
                                    </div></td>
                                </tr>
                              </table>
                             </td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                        </table>
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
