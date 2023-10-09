<?
session_start();
include("../hrmis/class/Security.php");

require("../hrmis/class/Compute.php");
$objCompute = new Compute;
$objCompute->setvar(array('strEmpNmbr'=>$strEmpNmbr, 'txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>$cboMonth1, 'cboYear'=>$cboYear1)); //for maintain state
$arrEmpPersonal = $objCompute->checkGetEmpNmbr("Cashier", $txtSearch, $optField, $cboMonth1, $cboYear1, 1, $p);
$info = $objCompute->viewInfo($arrEmpPersonal["empNumber"]);
//require("../hrmis/class/AttendanceCompensation.php");
//$objAttComp = new AttendanceCompensation; 
//$workDays = $objAttComp->getWorkingDays($arrEmpPersonal["empNumber"], $arrEmpPersonal["leaveEntitled"], $arrEmpPersonal["appointmentCode"], $cboMonth, $cboYear);
//echo $arrEmpPersonal['empNumber'].", ".$arrEmpPersonal['leaveEntitled'].", ".$arrEmpPersonal['appointmentCode'].", $cboMonth, $cboYear";
$workDays = $objCompute->getWeekdays($cboMonth1, $cboYear1);
$daysAbsent = $objCompute->getEmpAbsent($arrEmpPersonal["empNumber"], $cboMonth1, $cboYear1);
$holidays = $objCompute->getMonthHoliday($cboMonth1, $cboYear1);
if ($info['longevityDate'] == '0000-00-00') {
$yearService = '0';
}
else {
$currentdate = date ("Y m", mktime(0,0,0,date("m") ,date("d") ,date("Y")));
$lastmonth = date ("m", mktime(0,0,0,date("m")-1 ,date("d") ,date("Y")));
$yearService = $currentdate - $info['longevityDate']; }

//$subsistence = $objCompute->computeIncome($info['actualSalary'],"subsistence", $info['hpFactor'], $workDays, $daysAbsent, $holidays, $yearService, $info['mcSwitch']);
//$laundry = $objCompute->computeIncome($info['actualSalary'],"laundryAllow", $info['hpFactor'], $workDays, $daysAbsent, $holidays, $yearService, $info['mcSwitch']);
$magnaCarta = ($objCompute->computeIncome($info['actualSalary'],"subsistence", $info['hpFactor'], $workDays, $daysAbsent, $holidays, $yearService, $info['mcSwitch']) + $objCompute->computeIncome($info['actualSalary'],"laundryAllow", $info['hpFactor'], $workDays, $daysAbsent, $holidays, $yearService, $info['mcSwitch']));
?>
<script>
<!--
function MM_click()
{

//Subsistence
if ( window.document.myBenefits.chkBenefit1.checked == true ) {
	var sa  = "<? echo $objCompute->computeIncome($info['actualSalary'],"subsistence", $info['hpFactor'], $workDays, $daysAbsent, $holidays, $yearService) ?>";
	myBenefits.strIncome1.value = sa; }
else {
  	myBenefits.strIncome1.value = 0;
}

//Laundry
if ( window.document.myBenefits.chkBenefit2.checked == true ) {
	var la  = "<? echo $objCompute->computeIncome($info['actualSalary'],"laundryAllow", $info['hpFactor'], $workDays, $daysAbsent, $holidays, $yearService) ?>";
	myBenefits.strIncome2.value = la; }
else {
  	myBenefits.strIncome2.value = 0;
}
//Hazard Pay
if ( window.document.myBenefits.chkBenefit3.checked == true ) {
	var hp  = "<? echo $objCompute->computeIncome($info['actualSalary'],"hazardPay", $info['hpFactor'], $workDays, $daysAbsent, $holidays, $yearService) ?>";
	myBenefits.strIncome3.value = hp; }
else {
  	myBenefits.strIncome3.value = 0;
}

//Longevity
if ( window.document.myBenefits.chkBenefit4.checked == true ) {
	var lo  = "<? echo $objCompute->computeIncome($info['actualSalary'],"longevityAllow", $info['hpFactor'], $workDays, $daysAbsent, $holidays, $yearService) ?>";
	myBenefits.strIncome4.value = lo; }
else {
  	myBenefits.strIncome4.value = 0;
}

}
//-->
</script>
<html><!-- InstanceBegin template="/Templates/Cashier.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/class/JSgeneral.php");
?>
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
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <form name="myBenefits" method="post" action="">
                            <tr> 
                              <td height="24" valign="top" class="header"><p>OTHER 
                                  BENEFITS <br>
                                </p></td>
                            </tr>
                            <tr> 
                              <td class="header"></td>
                            </tr>
                            <tr> 
                              <td height="170"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr> 
                                    <td colspan="2" valign="top"><table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" class="border">
                                        <tr> 
                                          <td width="480" height="73"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCFF">
                                              <tr> 
                                                <td width="168" class="paragraph">Employee 
                                                  Number : </td>
                                                <td width="310"><strong>&nbsp;<? echo $arrEmpPersonal['empNumber']; ?> 
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
                                            </table></td>
                                          <td width="72" bgcolor="#99CCFF"> <img src="Getdata.php?t_strEmpNumber=<? echo $arrEmpPersonal["empNumber"]; ?>"  width="70" height="70"></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" valign="top">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td height="54" colspan="2" valign="top"> 
                                      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr> 
                                          <td class="paragraph">MONTH</td>
                                          <td> <select name="cboMonth1" size="1">
                                              <?
										$objCompute->comboMonth($cboMonth);
										?>
                                            </select></td>
                                          <td class="paragraph">YEAR</td>
                                          <td width="15%"> <select name="cboYear1" size="1">
                                              <?
										$objCompute->comboYear($cboYear);										
										?>
                                            </select></td>
                                          <td width="11%"><input type="submit" name="Submit" value="Go"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td class="paragraph">&nbsp;</td>
                                          <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td width="32%" class="paragraph">Year/s 
                                            of Service: </td>
                                          <td width="16%"><input name="yearService" type="text" class="tbtext" size="20" maxlength="30" readonly value="<? echo $yearService; ?>"></td>
                                          <td width="26%" class="paragraph">Subsistence: 
                                          </td>
                                          <td colspan="2"> <input name="strIncome" type="text" class="tbtext" size="20" maxlength="30" readonly value="<? echo $objCompute->computeIncome($info['actualSalary'],"subsistence", $info['hpFactor'], $workDays, $daysAbsent, $holidays, $yearService, $info['mcSwitch']); ?>"> 
                                            <input name="strIncome" type="hidden" class="tbtext" size="20" maxlength="30" readonly value="<? echo $magnaCarta; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">HP % Factor: </td>
                                          <td><input name="hpFactor" type="text" class="tbtext" size="20" maxlength="30" readonly value="<? echo $info['hpFactor']; ?>"></td>
                                          <td class="paragraph">Laundry Allowance</td>
                                          <td colspan="2"><input name="strIncome" type="text" class="tbtext" size="20" maxlength="30" readonly value="<? echo $objCompute->computeIncome($info['actualSalary'],"laundryAllow", $info['hpFactor'], $workDays, $daysAbsent, $holidays, $yearService, $info['mcSwitch']); ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Days Absent (Previous 
                                            Month):</td>
                                          <td><input name="daysAbsent" type="text" class="tbtext" size="20" maxlength="30" readonly value="<? echo $daysAbsent; ?>"></td>
                                          <td class="paragraph">&nbsp;&nbsp;Hazard 
                                            Pay:</td>
                                          <td colspan="2"><input name="strIncome" type="text" class="tbtext" size="20" maxlength="30" readonly value="<? echo $objCompute->computeIncome($info['actualSalary'],"hazardPay", $info['hpFactor'], $workDays, $daysAbsent, $holidays, $yearService, $info['hazardSwitch']); ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Working Days:</td>
                                          <td><input name="workDays" type="text" class="tbtext" size="20" maxlength="30" readonly value="<? echo $workDays; ?>"></td>
                                          <td class="paragraph">&nbsp;&nbsp;Longetivity 
                                            Allowance: </td>
                                          <td colspan="2"><input name="strIncome" type="text" class="tbtext" size="20" maxlength="30" readonly value="<? echo $objCompute->computeIncome($info['actualSalary'],"longevityAllow", $info['hpFactor'], $workDays, $daysAbsent, $holidays, $yearService, $info['longevitySwitch']); ?> "></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">No. of Holidays 
                                            (No work):</td>
                                          <td><input name="holidays" type="text" class="tbtext" size="20" maxlength="30" readonly value="<? echo $holidays; ?>"></td>
                                          <td class="paragraph">&nbsp;&nbsp;Total 
                                            Benefits :</td>
                                          <td colspan="2"><input name="total" type="text" class="tbtext" size="20" maxlength="30" readonly value="<? echo $objCompute->computeTotal($benefitsTotal); ?> "> 
                                            <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr; ?>"></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td height="13" colspan="2" valign="top">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td width="12%" height="13" valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr> 
                              <td align="right"><div align="center"> </div></td>
                            </tr>
                            <tr> 
                              <td align="right"><span class="bodytext">
                                <? $objCompute->output();?>
                                </span>&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                            <tr> 
                              <td align="right">&nbsp;</td>
                            </tr>
                          </form>
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
