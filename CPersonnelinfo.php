<?
session_start();
include("../hrmis/class/Security.php");
require("../hrmis/class/Compute.php");
$objCompute = new Compute;
$objCompute->setvar(array('strEmpNmbr'=>$strEmpNmbr, 'txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>$cboMonth, 'cboYear'=>$cboYear)); //for maintain state
//$objCompute->trapButton($txtSearch, $strLetter, "CPersonnelsearch.php", "CPersonnelinfo.php");
$arrEmpPersonal = $objCompute->checkGetEmpNmbr("Cashier", $txtSearch, $optField, $cboMonth, $cboYear, 1, $p, $strLetter);
$info = $objCompute->viewInfo($arrEmpPersonal["empNumber"]);
$taxCode = $info['taxStatCode'];
$dependents = $info['dependents'];
$objCompute->computeDeduction($arrEmpPersonal["empNumber"], $info['actualSalary'],"itw",$taxCode,$dependents,$info['itwSwitch'], $cboMonth, $info['healthProvider'] );
$objCompute->computeDeduction($arrEmpPersonal["empNumber"], $info['actualSalary'],"lifeRetshare",$taxCode,$dependents,$info['lifeRetSwitch'], $cboMonth, $info['healthProvider']);
$objCompute->computeDeduction($arrEmpPersonal["empNumber"], $info['actualSalary'],"pagIbigshare",$taxCode,$dependents,$info['pagibigSwitch'], $cboMonth, $info['healthProvider']);
$objCompute->computeDeduction($arrEmpPersonal["empNumber"], $info['actualSalary'],"lifeRet",$taxCode,$dependents, $info['lifeRetSwitch'], $cboMonth, $info['healthProvider']);
$objCompute->computeDeduction($arrEmpPersonal["empNumber"], $info['actualSalary'],"pagIbig",$taxCode,$dependents, $info['pagibigSwitch'], $cboMonth, $info['healthProvider']);
$objCompute->computeDeduction($arrEmpPersonal["empNumber"], $info['actualSalary'],"philHealth",$taxCode,$dependents, $info['philhealthSwitch'], $cboMonth, $info['healthProvider']);
$objCompute->getDeduction($empNumber);
$dtotal = $objCompute->computeTotalDeduction($deductionTotal);
$monthSal = $info['actualSalary'];
//$netPay = $monthSal - $dtotal;
require("../hrmis/class/Personnelinfo.php");
$objPersonnel = new Personnel;
?>
<html><!-- InstanceBegin template="/Templates/Cashier.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<!-- InstanceEndEditable --> 
<!-- Design/Images Made By : Angelo Campos Evangelista  -->
<!-- Template Made By : Pearliezl Samoy Dy Tioco  -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!-- onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar()" onFocus="statusBar()"
 
function openPrint() {

	var strEmpNmbr = "<? echo $strEmpNmbr; ?>";
	var t_strUserLevel = "<? echo $t_strUserLevel; ?>";
	var t_strUserPermission = "<? echo $t_strUserPermission; ?>";
	var t_strAccessPermission = "<? echo $t_strAccessPermission; ?>";
	strPage = "Cashierindex.php?strEmpNmbr="+strEmpNmbr+"&t_strUserLevel="+t_strUserLevel+"&t_strUserPermission="+t_strUserPermission+"&t_strAccessPermission="+t_strAccessPermission;
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
<link href="hrmis.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<link href="hrmis.css" rel="stylesheet" type="text/css">
<link href="hrmis.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/remittances2.jpg','images/personnel2.jpg','images/income2.jpg','images/logout2.jpg','images/otherbenefits2.jpg','images/premiums_loans2.jpg','images/compensationclick.jpg','images/updateover.jpg','images/reportsover.jpg','images/deductionsummary2.jpg','images/notificationover.jpg','images/taxdetails2.jpg'); history.forward()" onContextMenu="return false"><div align="center"> 
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr> 
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="INNERTBL">
        <tr> 
          <td width="41%" valign="bottom"><table width="90%" border="0" cellspacing="0" cellpadding="0">
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
                  <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 2 && $t_strUserPermission == "Cashier Officer" && $t_strAccessPermission == "0123") 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblCASHIER">
                    <tr> 
                      <td height="29"><a href="CNotification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('notification','','images/notificationover.jpg',1)"><img src="images/notification.jpg" alt="notification" name="notification" width="96" height="29" border="0"></a><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION','','images/compensationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensationclick.jpg" alt="COMPENSATION" name="COMPENSATION" width="104" height="29" border="0"></a></td>
                      <td><a href="CDeductionupdate.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('UPDATE1','','images/updateover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/update.jpg" alt="UPDATE1" name="UPDATE1" width="60" height="28" border="0"></a></td>
                      <td><a href="CMonthlyreport.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS1','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS1" name="REPORTS1" width="60" height="29" border="0"></a></td>
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
if ($t_strUserLevel == 2 && $t_strUserPermission == "Cashier Assistant" && $t_strAccessPermission == "01") 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblCASHIER">
                    <tr> 
                      <td height="29"><a href="CNotification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('notification23','','images/notificationover.jpg',1)"><img src="images/notification.jpg" alt="notification2" name="notification23" width="96" height="29" border="0"></a><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION4','','images/compensationclick.jpg',1); statusBar(); return true" onClick="statusBar();"><img src="images/compensationclick.jpg" alt="COMPENSATION" name="COMPENSATION4" width="104" height="29" border="0" id="COMPENSATION4"></a></td>
                      <td>&nbsp;</td>
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
if ($t_strUserLevel == 2 && $t_strUserPermission == "Cashier Assistant" && $t_strAccessPermission == "12") 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblCOMPENSATIONUPDATE">
                    <tr> 
                      <td><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION2','','images/compensationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensationclick.jpg" alt="COMPENSATION2" name="COMPENSATION2" width="104" height="29" border="0"></a></td>
                      <td><a href="CDeductionupdate.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('UPDATE','','images/updateover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/update.jpg" alt="UPDATE" name="UPDATE" width="60" height="28" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td> 
                  <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 2 && $t_strUserPermission == "Cashier Assistant" && $t_strAccessPermission == "13") 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblCOMPENSATIONREPORTS">
                    <tr> 
                      <td><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION3','','images/compensationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensationclick.jpg" alt="COMPENSATION3" name="COMPENSATION3" width="104" height="29" border="0"></a></td>
                      <td><a href="CMonthlyreport.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS3','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS3" name="REPORTS3" width="60" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td> 
                  <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == "1234567") 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblHRCASHIERMODULE">
                    <tr> 
                      <td height="29"><a href="CNotification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('notification3','','images/notificationover.jpg',1)"><img src="images/notification.jpg" alt="notification3" name="notification3" width="96" height="29" border="0"></a><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION1','','images/compensationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensationclick.jpg" alt="COMPENSATION" name="COMPENSATION1" width="104" height="29" border="0" id="COMPENSATION1"></a></td>
                      <td><a href="CDeductionupdate.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('UPDATE11','','images/updateover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/update.jpg" alt="UPDATE1" name="UPDATE11" width="60" height="28" border="0" id="UPDATE11"></a></td>
                      <td><a href="CMonthlyreport.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS11','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS1" name="REPORTS11" width="60" height="29" border="0" id="REPORTS11"></a></td>
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
          <td height="350" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="16%" height="411"><table width="150" height="406" border="0" cellpadding="0" cellspacing="0" bgcolor="#E9F3FE">
                    <tr> 
                      <td height="406" valign="top"><table width="100%" height="403" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="403" valign="top"> <table width="90%" height="403" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="NAVTBL">
                                <tr> 
                                  <td height="113" valign="baseline"><form name="form1" method="post">
                                      <input name="txtSearch" type="text" size="15" maxlength="30" value="<? echo $txtSearch;?>">
                                      <a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>" onMouseOut="statusBar()" onFocus="statusBar()" onMouseOver="statusBar(); return true;" onClick="statusBar();">
                                      <input type="image" src="images/go.jpg" alt="Go" name="Go" width="19" height="17" border="0" align="absmiddle">
                                      </a> <br>
                                      <? 
									  if($optField == "empNmbr" || $optField == "")
									  {
									  	echo "<input name='optField' type='radio' value='empNmbr' checked>";
									  }
									  else
									  {
									  	echo "<input name='optField' type='radio' value='empNmbr'>";
									  }
									  ?>
                                      Employee Number<br>
                                      <?
									  if($optField == "empName")
									  {
									  	echo "<input name='optField' type='radio' value='empName' checked>";
									  }
									  else
									  {
									  	echo "<input name='optField' type='radio' value='empName'>";
									  }
									  ?>
                                      Employee Name<br>
                                      Month 
                                      <select name="cboMonth" size="1">
                                        <?
										$objCompute->comboMonth($cboMonth);
										?>
                                      </select>
                                      <br>
                                      Year&nbsp;&nbsp; 
                                      <select name="cboYear" size="1">
                                        <?
										$objCompute->comboYear($cboYear);										
										?>
                                      </select>
                                      <br>
                                    </form></td>
                                </tr>
                                <tr> 
                                  <td height="290" valign="top"><table width="108" height="150" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td height="20"><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch; ?>&optField=<? echo $optField; ?>&cboMonth=<? echo $cboMonth; ?>&cboYear=<? echo $cboYear; ?>&p=<? echo $p; ?>&strLetter=<? echo $strLetter; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PersonnelProfile','','images/personnel2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/personnel1.jpg" alt="Personnel Profile" name="PersonnelProfile" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="CEmployeeincome.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Income','','images/income2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/income.jpg" alt="Income" name="Income" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="10"><a href="CEmployeebenefits.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch; ?>&optField=<? echo $optField; ?>&cboMonth=<? echo $cboMonth; ?>&cboYear=<? echo $cboYear; ?>&p=<? echo $p; ?>&strLetter=<? echo $strLetter; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('otherbenefits','','images/otherbenefits2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/otherbenefits.jpg" alt="otherbenefits" name="otherbenefits" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="CEmployeedeductions.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch; ?>&optField=<? echo $optField; ?>&cboMonth=<? echo $cboMonth; ?>&cboYear=<? echo $cboYear; ?>&p=<? echo $p; ?>&strLetter=<? echo $strLetter; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('deductionsummary','','images/deductionsummary2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/deductionsummary.jpg" alt="deductionsummary" name="deductionsummary" width="108" height="29" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="CLoans.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Premiums/Loans','','images/premiums_loans2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/premiums_loans.jpg" alt="Premiums/Loans" name="Premiums/Loans" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="10"><a href="CRemittances.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Remittances','','images/remittances2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/remittances.jpg" alt="Remittances" name="Remittances" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr>
                                        <td height="10"><a href="CTaxdetails.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('TaxDetails','','images/taxdetails2.jpg',1)"><img src="images/taxdetails.jpg" alt="TaxDetails" name="TaxDetails" width="108" height="20" border="0"></a></td>
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
                                    </table> 
                                    <table width="60%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr> 
                                        <td><a href="javascript:openPrint()"><img src="images/howto.jpg" width="78" height="21" border="0"></a></td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                              
                            </td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
                <td width="84%" valign="top"><table width="99%" height="406" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODYTBL">
                    <tr> 
                      <td height="406"><!-- InstanceBeginEditable name="BODY" --> 
<?
$strMonthFull = $objCompute->intToMonthFull($cboMonth);
?>						  
                        <table width="99%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td height="25" class="header"><p>PERSONNEL PROFILE</p>
                             </td>
                          </tr>
                          <tr> 
                            <td><table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" class="border">
                                <tr> 
                                  <td width="480" height="73"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCFF">
                                      <tr> 
                                        <td width="168" class="paragraph">Employee 
                                          Number : </td>
                                        <td width="310"><strong>&nbsp;<? echo $arrEmpPersonal['empNumber']; ?> 
                                          <input name="txtSearch" type="hidden" id="txtSearch" value="<? echo $txtSearch; ?>">
                                          <input name="optField" type="hidden" id="optField" value="<? echo $optField; ?>">
                                          <input name="t_strEmpNumber" type="hidden" id="t_strEmpNumber" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                          <input name="p" type="hidden" id="p" value="<? echo $p; ?>">
                                          <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>">
										 
                                          </strong></td>
                                      </tr>
                                      <tr> 
                                        <td class="paragraph">Employee Name : 
                                        </td>
                                        <td><strong>&nbsp;<? echo $arrEmpPersonal['surname']  . ", " . $arrEmpPersonal['firstname'] . "  ". $arrEmpPersonal['middlename']; ?></strong></td>
                                      </tr>
                                      <tr> 
                                        <td class="paragraph">Division : </td>
                                        <td><strong>&nbsp;<? echo $arrEmpPersonal['divisionCode']; ?></strong></td>
                                      </tr>
                                    </table></td>
                                  <td width="72" bgcolor="#99CCFF"> <img src="Getdata.php?t_strEmpNumber=<? echo $arrEmpPersonal["empNumber"]; ?>"  width="70" height="70"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td><table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td width="24%" class="paragraph">Appointment 
                                    Status:</td>
                                  <td width="34%"> <input name="appointmentCode" type="text" size="15" readonly value="<? echo $info['statusOfAppointment']; ?>"></td>
                                  <td width="23%" class="paragraph">TIN:</td>
                                  <td width="19%"> <input name="tin" type="text" value="<? echo $info['tin']; ?>" size="15" readonly> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td class="paragraph">Salary:</td>
                                  <td> <input name="actualSalary" type="text" value="<? echo $info['actualSalary']; ?>" size="15" readonly> 
                                  </td>
                                  <td class="paragraph">GSIS Number:</td>
                                  <td> <input name="gsisNumber" type="text" value="<? echo $info['gsisNumber']; ?>" size="15" readonly> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td class="paragraph">Division Code:</td>
                                  <td> <input name="divisionCode" type="text" value="<? echo $info['divisionCode']; ?>" size="15" readonly> 
                                  </td>
                                  <td class="paragraph">PhilHealth Number:</td>
                                  <td> <input name="philHealthNumber" type="text" value="<? echo $info['philHealthNumber']; ?>" size="15" readonly> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td class="paragraph">Position Code:</td>
                                  <td> <input name="positionCode" type="text" value="<? echo $info['positionCode']; ?>" size="15" readonly> 
                                  </td>
                                  <td class="paragraph">OPL No. 1 :</td>
                                  <td> <input name="oplNo1" type="text" value="<? echo $info['oplNo1']; ?>" size="15" readonly> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td class="paragraph">Appointment Code:</td>
                                  <td> <input name="appointmentCode" type="text" value="<? echo $info['appointmentCode']; ?>" size="15" readonly> 
                                  </td>
                                  <td class="paragraph">OPL No. 2 :</td>
                                  <td> <input name="oplNo2" type="text" value="<? echo $info['oplNo2']; ?>" size="15" readonly> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td class="paragraph">Project Code:</td>
                                  <td> <input name="projectCode" type="text" value="<? echo $info['projectCode']; ?>" size="15" readonly> 
                                  </td>
                                  <td class="paragraph">OPL No. 3 :</td>
                                  <td> <input name="oplNo3" type="text" readonly value="<? echo $info['oplNo3']; ?>" size="15"> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td class="paragraph">Service Code:</td>
                                  <td> <input name="serviceCode" type="text" value="<? echo $info['serviceCode']; ?>" size="15" readonly> 
                                  </td>
                                  <td class="paragraph">PAGIBIG Number:</td>
                                  <td> <input name="pagibigNumber" type="text" value="<? echo $info['pagibigNumber']; ?>" size="15" readonly> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td class="paragraph">Birth Date:</td>
                                  <td><input name="birthday" type="text" value="<? echo $info['birthday']; ?>" size="15" readonly> 
                                  </td>
                                  <td class="paragraph">Tax Status Code:</td>
                                  <td> <input name="taxStatCode" type="text" value="<? echo $info['taxStatCode']; ?>" size="15" readonly> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td rowspan="2" class="paragraph">Address:</td>
                                  <td rowspan="2"><textarea name="city" cols="20" readonly="readonly"><? echo $info['city']; ?></textarea> 
                                  </td>
                                  <td class="paragraph">Dependents:</td>
                                  <td> <input name="dependents" type="text" value="<? echo $info['dependents']; ?>" size="15" readonly> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td class="paragraph">with Health Insurance:</td>
                                  <td><input name="healthProvider" type="text" value="<? echo $info['healthProvider']; ?>" size="15" readonly></td>
                                </tr>
                                <tr> 
                                  <td rowspan="2" class="paragraph">&nbsp;</td>
                                  <td rowspan="2">&nbsp;</td>
                                  <td class="paragraph">&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td class="paragraph">&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td class="paragraph">&nbsp;</td>
                                  <td class="paragraph">Basic Salary:</td>
                                  <td class="paragraph"> <input type="text" readonly name="actualSalary1" value="<? echo $info['actualSalary']; ?>"> 
                                  </td>
                                  <td> 
                                    <? $objCompute->computeDeduction($arrEmpPersonal["empNumber"], $info['actualSalary'],"itw",$taxCode,$dependents,"Y", $cboMonth, $info['healthProvider']); ?>
                                    <? $objCompute->sumDeduction($arrEmpPersonal["empNumber"]); ?>
                                    <? $objCompute->viewITW($arrEmpPersonal["empNumber"], $strDeduct1); ?>
									<? $objCompute->computeTotalDeduction($deductionTotal); ?>
                                    <? $dTotal = ($objCompute->viewITW($arrEmpPersonal["empNumber"], $strDeduct1) + $objCompute->computeTotalDeduction($deductionTotal)); ?>
                                  </td>
                                </tr>
                                <tr> 
                                  <td class="paragraph">&nbsp;</td>
                                  <td class="paragraph">Total Deduction:</td>
                                  <td class="paragraph"> <input type="text" name="dtotal" readonly value="<? echo $dTotal; ?> "> 
                                  </td>
                                  <td> 
                                    <? $netPay = $monthSal - $dTotal; ?>
                                  </td>
                                </tr>
                                <tr> 
                                  <td class="paragraph">&nbsp;</td>
                                  <td class="paragraph">Net Pay:</td>
                                  <td class="paragraph"> <input type="text" name="netPay" readonly value="<? echo $netPay; ?>"> 
                                  </td>
                                  <td><input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr; ?>"></td>
                                </tr>
                                <tr> 
                                  <td colspan="4" class="paragraph"><hr></td>
                                </tr>
                                <form name="switchForm" method="get" action="">
                                  <? if($Submit == "Edit")
								{ ?>
                                  <tr> 
                                    <td class="paragraph">Payroll Switch:</td>
                                    <td> 
                                      <?
									 if($payrollSwitch == "Y" || $payrollSwitch == "")
									  {
									  	echo "<input name='payrollSwitch' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='payrollSwitch' type='radio' value='Y'>";
									  }
									  ?>
                                      Yes 
                                      <?
									 if($payrollSwitch == "N")
									  {
									  	echo "<input name='payrollSwitch' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='payrollSwitch' type='radio' value='N'>";
									  } 
									  ?>
                                      No 
                                      <input name="payrollSwitch1" type="hidden" value="<? echo $info['payrollSwitch']; ?>"></td>
                                    <td class="paragraph">Longevity Switch:</td>
                                    <td> 
                                      <?
									 if($longevitySwitch == "Y" || $longevitySwitch == "")
									  {
									  	echo "<input name='longevitySwitch' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='longevitySwitch' type='radio' value='Y'>";
									  }
									  ?>
                                      Yes 
                                      <?
									 if($longevitySwitch == "N")
									  {
									  	echo "<input name='longevitySwitch' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='longevitySwitch' type='radio' value='N'>";
									  } 
									  ?>
                                      No 
                                      <input name="longevitySwitch1" type="hidden" value="<? echo $info['longevitySwitch']; ?>"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">MC Switch:</td>
                                    <td> 
                                      <?
									 if($mcSwitch == "Y" || $mcSwitch == "")
									  {
									  	echo "<input name='mcSwitch' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='mcSwitch' type='radio' value='Y'>";
									  }
									  ?>
                                      Yes 
                                      <?
									 if($mcSwitch == "N")
									  {
									  	echo "<input name='mcSwitch' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='mcSwitch' type='radio' value='N'>";
									  } 
									  ?>
                                      No 
                                      <input name="mcSwitch1" type="hidden" value="<? echo $info['mcSwitch']; ?>"> 
                                    </td>
                                    <td class="paragraph">Hazard Switch:</td>
                                    <td> 
                                      <?
									 if($hazardSwitch == "Y" || $hazardSwitch == "")
									  {
									  	echo "<input name='hazardSwitch' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='hazardSwitch' type='radio' value='Y'>";
									  }
									  ?>
                                      Yes 
                                      <?
									 if($hazardSwitch == "N")
									  {
									  	echo "<input name='hazardSwitch' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='hazardSwitch' type='radio' value='N'>";
									  } 
									  ?>
                                      No 
                                      <input name="hazardSwitch1" type="hidden" value="<? echo $info['hazardSwitch']; ?>"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">With Health Insurance:</td>
                                    <td> 
                                      <?
									 if($healthProvider == "Y" || $healthProvider == "")
									  {
									  	echo "<input name='healthProvider' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='healthProvider' type='radio' value='Y'>";
									  }
									  ?>
                                      Yes 
                                      <?
									 if($healthProvider == "N")
									  {
									  	echo "<input name='healthProvider' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='healthProvider' type='radio' value='N'>";
									  } 
									  ?>
                                      No 
                                      <input name="healthProvider1" type="hidden" value="<? echo $info['healthProvider']; ?>"> 
                                    </td>
                                    <td class="paragraph">&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td height="21" colspan="4" class="paragraph">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td height="21" colspan="4" class="paragraph"><div align="center"><strong> 
                                        <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>">
                                        <input name="txtSearch" type="hidden" id="txtSearch" value="<? echo $txtSearch; ?>">
                                        <input name="optField" type="hidden" id="optField" value="<? echo $optField; ?>">
                                        <input name="t_strEmpNumber" type="hidden" id="t_strEmpNumber" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                        <input name="p" type="hidden" id="p" value="<? echo $p; ?>">
                                        </strong> 
                                        <input type="submit" name="Submit" value="SUBMIT">
                                      </div></td>
                                  </tr>
                                  <? } else  {
 								   ?>
                                  <tr> 
                                    <td class="paragraph">Include in Payroll:</td>
                                    <td> &nbsp;&nbsp;<b><? echo $info['payrollSwitch']; ?> 
                                      <input name="payrollSwitch" type="hidden" value="<? echo $info['payrollSwitch']; ?>">
                                      </b></td>
                                    <td class="paragraph">Include in Longevity 
                                      Pay:</td>
                                    <td> &nbsp;&nbsp;<b><? echo $info['longevitySwitch']; ?> 
                                      <input name="longevitySwitch" type="hidden" value="<? echo $info['longevitySwitch']; ?>">
                                      </b></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Include in MC:</td>
                                    <td> &nbsp;&nbsp;<b><? echo $info['mcSwitch']; ?> 
                                      <input name="mcSwitch" type="hidden" value="<? echo $info['mcSwitch']; ?>">
                                      </b></td>
                                    <td class="paragraph">Include in Hazard Pay:</td>
                                    <td> &nbsp;&nbsp;<b><? echo $info['hazardSwitch']; ?> 
                                      <input name="hazardSwitch" type="hidden" value="<? echo $info['hazardSwitch']; ?>">
                                      </b></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">With Health Insurance:</td>
                                    <td> &nbsp;&nbsp;<b><? echo $info['healthProvider']; ?> 
                                      <input name="healthProvider" type="hidden" value="<? echo $info['healthProvider']; ?>">
                                      </b></td>
                                    <td class="paragraph">&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td colspan="4" class="paragraph">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td colspan="4" class="paragraph"><div align="center"><strong> 
                                        <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>">
                                        <input name="p" type="hidden" id="p" value="<? echo $p; ?>">
                                        <input name="t_strEmpNumber" type="hidden" id="t_strEmpNumber" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                        <input name="optField" type="hidden" id="optField" value="<? echo $optField; ?>">
                                        <input name="txtSearch" type="hidden" id="txtSearch" value="<? echo $txtSearch; ?>">
                                        </strong> 
                                        <input type="submit" name="Submit" value="Edit">
                                      </div></td>
                                  </tr>
                                  <? } ?>
                                  <tr> 
                                    <td class="paragraph"> 
                                      <? $objPersonnel->inputInfo($strEmpNmbr, $t_strEmpNumber, $payrollSwitch1, $mcSwitch1, $longevitySwitch1, $hazardSwitch1 , $healthProvider1, $payrollSwitch, $mcSwitch, $longevitySwitch, $hazardSwitch, $healthProvider, $Submit, $p, $txtSearch, $optField); ?>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td class="paragraph">&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td colspan="4" class="paragraph"><div align="right" class="paragraph"></div>
                                      <div align="right" class="paragraph"> 
                                        <? $objCompute->output();?>
                                      </div></td>
                                  </tr>
                                </form>
                              </table></td>
                          </tr>
                          <tr> 
                            <td height="13">&nbsp;</td>
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
